    <?php
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);

    // 🔥 ADD THIS:
    function formatSection($section) {
        if (is_numeric($section)) {
            return 'Section ' . $section;
        }
        return $section;
    }

    if ($data === null) {
        echo json_encode(['message' => 'Invalid JSON input.']);
        exit;
    }

    // Validate username
    if (empty($data['username'])) {
        echo json_encode(['message' => 'Invalid input: missing username.']);
        exit;
    }

    $username = $data['username'];
    $shifts = $data['shifts'] ?? [];

    // Ensure at least shift A or B is present
    if (!array_key_exists('A', $shifts) && !array_key_exists('B', $shifts)) {
        error_log("Invalid shift input payload: " . print_r($data, true));
        echo json_encode(['message' => 'Invalid input: missing shifts A or B.']);
        exit;
    }

    require 'conn.php';

    // Get user's section and assigned shift
    list($section, $userShift) = getUserSectionAndShift($conn, $username);
    if ($section === null || $userShift === null) {
        echo json_encode(['message' => "User section or shift not found for username: $username"]);
        exit;
    }

    // Normalize section name
    $normalizedSection = normalizeSection($section);

    // Determine only the shift assigned to user
    if (!array_key_exists($userShift, $shifts)) {
        echo json_encode(['message' => "Shift '$userShift' not included in update."]);
        exit;
    }

    $shiftType = $shifts[$userShift];

    // Update only the user's shift
    if (!updateShift($conn, $userShift, $shiftType)) exit;

    // Optional: Always set ADS shift to Dayshift
    updateShift($conn, 'ADS', 'Dayshift', false);

    // Re-insert manpower section data for this user
    insertManpower2($conn, $normalizedSection, $userShift);

    // Final response
    echo json_encode([
        'message' => 'Shift updated!',
        'section' => $section,
    ]);

    // ------------------ Helper Functions ------------------

    function getUserSectionAndShift($conn, $username) {
        $sql = "SELECT TOP 1 [section], [shift] FROM [secondary_dashboard_db].[dbo].[account] WHERE [username] = ?";
        $params = [$username];
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt === false) return [null, null];
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        return $row ? [$row['section'], $row['shift']] : [null, null];
    }

    function updateShift($conn, $shift, $nsds, $useParam = true) {
        $sql = "UPDATE [secondary_dashboard_db].[dbo].[manpower] SET nsds = ? WHERE shift = ?";
        $params = $useParam ? [$nsds, $shift] : [$nsds];
        $stmt = $useParam
            ? sqlsrv_query($conn, $sql, $params)
            : sqlsrv_query($conn, "UPDATE [secondary_dashboard_db].[dbo].[manpower] SET nsds = ? WHERE shift = '$shift'", [$nsds]);

        if ($stmt === false) {
            $errors = sqlsrv_errors();
            echo json_encode(['message' => "Error updating shift $shift.", 'error' => $errors]);
            return false;
        }
        return true;
    }

    function normalizeSection($sectionString) {
        return trim(str_replace('Section ', '', $sectionString));
    }
    // ----------------------------------------------------------------------Insert Section----------------------------------------------------

    function fetchJphData($conn) {
        $sql = "SELECT [process], [jph] FROM [secondary_dashboard_db].[dbo].[jph]";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $map = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Use only process to generate the key
            $key = $row['process'];
            $map[$key] = $row['jph'];
        }
        return $map;
    }

    function insertManpower2($conn, $section, $userShift)
    {
        $sectionFormatted = formatSection($section); // '1' -> 'Section 1'

        // Delete existing data from section_page matching 'Section 1'
    $deleteSql = "DELETE FROM [secondary_dashboard_db].[dbo].[section_page] WHERE section = ? AND shift = ?";

        $stmtDelete = sqlsrv_prepare($conn, $deleteSql, [$sectionFormatted, $userShift]);

        if (!$stmtDelete || !sqlsrv_execute($stmtDelete)) {
            die(print_r(sqlsrv_errors(), true)); // Stop if delete fails
        }

        // Select manpower data for section '1' (unformatted!)
    $sqlSelect = "
        SELECT
        emp_no,
        full_name,
        skill_level,
        section,
        process,
        machine_no,
        shift,
        nsds
        FROM [secondary_dashboard_db].[dbo].[manpower]
        WHERE section = ? AND shift = ?";
    $stmtSelect = sqlsrv_query($conn, $sqlSelect, [$section, $userShift]);

        if ($stmtSelect === false) {
            echo json_encode(['message' => 'Error fetching data from manpower.', 'error' => sqlsrv_errors()]);
            exit;
        }

        // Fetch JPH data for processes
        $jphData = fetchJphData($conn);

        // Get current shift types for hour filling logic
        $shiftTypes = getShiftTypes($conn);
        $shiftType = detectShiftType($shiftTypes);

        $detailsOptions = [
            'Actual JPH',
            'Target Running Output',
            'Actual Running Output'
        ];

        while ($row = sqlsrv_fetch_array($stmtSelect, SQLSRV_FETCH_ASSOC)) {
            $empNo       = $row['emp_no'];
            $fullName    = $row['full_name'];
            $skillLevel  = $row['skill_level'];
            $section     = formatSection($row['section']);
            $process     = $row['process'];
            $machineNo   = $row['machine_no'];
            $shift       = $row['shift'];
            $nsds        = $row['nsds'];
        
            // Fetch the target JPH value for this process
            $targetJph = isset($jphData[$process]) ? $jphData[$process] : 0;  // Default to 0 if no match found

            // Dummy defaults to avoid undefined variable warnings
            $specifications = '';  
            $manpower = $fullName;       
            $targetOutput = 0;   
            $dailyResult = 0;    
        
            $hours = fillHoursByShift($shiftType);
        
            foreach ($detailsOptions as $detail) {
            insertsection_pageRow(
        $conn, $section, $process, $machineNo, $specifications, $manpower,
        $skillLevel, $targetJph, $targetOutput, $detail,
        $hours, $dailyResult, $shift, $nsds // 🔥 Add $shift here
    );

            }
        }
    }


    function getShiftTypes($conn) {
        $shiftSql = "SELECT shift, nsds FROM [secondary_dashboard_db].[dbo].[manpower] WHERE shift IN ('A','B')";
        $shiftStmt = sqlsrv_query($conn, $shiftSql);
        if ($shiftStmt === false) {
            $errors = sqlsrv_errors();
            echo json_encode(['message' => 'Error fetching shift types.', 'error' => $errors]);
            exit;
        }
        $shiftTypes = [];
        while ($shiftRow = sqlsrv_fetch_array($shiftStmt, SQLSRV_FETCH_ASSOC)) {
            $shiftTypes[$shiftRow['shift']] = $shiftRow['nsds'];
        }
        return $shiftTypes;
    }

    function detectShiftType($shiftTypes) {
        // Priority: Dayshift, Nightshift, else empty string
        if (in_array('Dayshift', $shiftTypes)) {
            return 'Dayshift';
        }
        if (in_array('Nightshift', $shiftTypes)) {
            return 'Nightshift';
        }
        return '';
    }

    function fillHoursByShift($shiftType) {
        $hours = array_fill(0, 24, null);

        if ($shiftType === 'Dayshift') {
            // Hours 6 to 17 (index 6 to 17) set to 0
            for ($i = 6; $i <= 17; $i++) {
                $hours[$i] = 0;
            }
        } elseif ($shiftType === 'Nightshift') {
            // Hours 18 to 23 and 0 to 5 set to 0
            for ($i = 18; $i <= 23; $i++) {
                $hours[$i] = 0;
            }
            for ($i = 0; $i <= 5; $i++) {
                $hours[$i] = 0;
            }
        }

        return $hours;
    }
    function insertsection_pageRow($conn, $section, $process, $machineNo, $specifications, $manpower, $skillLevel,
                                $targetJph, $targetOutput, $details, $hours, $dailyResult, $shift, $nsds)

    {
        // Calculate date_start (today 07:00:00) and date_end (tomorrow 06:59:59)
        $now = new DateTime(); // current datetime
        $dateStart = clone $now;
        $dateStart->setTime(7, 0, 0); // today at 07:00:00

        $dateEnd = clone $dateStart;
        $dateEnd->modify('+1 day')->setTime(6, 59, 59); // tomorrow at 06:59:59

        // Only adjust the hours array if the details are "Target Running Output"
        if ($details === 'Target Running Output') {
            if ($nsds === 'Dayshift') {
                // Set JPH into h7 for Dayshift (index 6)
                $hours[6] = $targetJph;  // h7 is the 7th hour (index 6 in the array)
            } elseif ($nsds === 'Nightshift') {
                // Set JPH into h18 for Nightshift (index 17)
                $hours[18] = $targetJph; // h18 is the 18th hour (index 17 in the array)
            }
        }

        // Prepare the SQL query for inserting data into section_page
    $sqlInsert = "INSERT INTO [secondary_dashboard_db].[dbo].[section_page]
                ([section], [process], [machine_no], [specifications], [manpower], [skill_level], [target_jph], [target_output], [details],
                [h1], [h2], [h3], [h4], [h5], [h6], [h7], [h8], [h9], [h10], [h11], [h12],
                [h13], [h14], [h15], [h16], [h17], [h18], [h19], [h20], [h21], [h22], [h23], [h24],
                [shift], [nsds], [daily_result], [wip], [date], [date_start], [date_end])
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                        ?, ?, ?, ?, ?, ?, 0, GETDATE(), ?, ?)";


        // Prepare parameters for the query
        $params = [
            $section, $process, $machineNo, $specifications, $manpower, $skillLevel,
            $targetJph, $targetOutput, $details
        ];

        // Add all 24 hour values to the parameters (either 0 or the JPH value as needed)
        for ($i = 0; $i < 24; $i++) {
            $params[] = $hours[$i] ?? 0;
        }

        // Add the remaining parameters (nsds, daily result, date start/end)
        $params[] = $shift; 
        $params[] = $nsds;
        $params[] = $dailyResult;
        $params[] = $dateStart->format('Y-m-d H:i:s');
        $params[] = $dateEnd->format('Y-m-d H:i:s');

        // Execute the insert query
        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $params);
        if ($stmtInsert === false) {
            $errors = sqlsrv_errors();
            echo json_encode(['message' => 'Error inserting data into section_page.', 'error' => $errors]);
            exit;
        }
    }



    ?>