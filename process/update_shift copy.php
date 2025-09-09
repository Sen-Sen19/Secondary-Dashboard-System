<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    echo json_encode(['message' => 'Invalid JSON input.']);
    exit;
}

// Check for shifts A and B
if (!isset($data['shifts']['A']) || !isset($data['shifts']['B'])) {
    echo json_encode(['message' => 'Invalid input: missing shifts A or B.']);
    exit;
}

// Check for username
if (!isset($data['username'])) {
    echo json_encode(['message' => 'Invalid input: missing username.']);
    exit;
}

require 'conn.php';

$shiftAType = $data['shifts']['A'];
$shiftBType = $data['shifts']['B'];
$username = $data['username'];

// Fetch the section for this username
$section = getUserSection($conn, $username);
if ($section === null) {
    echo json_encode(['message' => "User section not found for username: $username"]);
    exit;
}

// Optional: use or log the section as needed
// For example, you could send it back in the response or use it in update logic

// Update shifts
if (!updateShift($conn, 'A', $shiftAType)) exit;
if (!updateShift($conn, 'B', $shiftBType)) exit;
if (!updateShift($conn, 'ADS', 'Dayshift', false)) exit; // fixed to always Dayshift

// After updating shifts, insert/update manpower data
insertManpower2($conn, normalizeSection($section));


function normalizeSection($sectionString) {
    // Converts "Section 1" to "1"
    return trim(str_replace('Section ', '', $sectionString));
}

echo json_encode([
    'message' => 'Shifts Updated!',
    'section' => $section,    // returning section info just in case
]);

// --- Helper functions ---

function getUserSection($conn, $username) {
    $sql = "SELECT TOP 1 [section] FROM [secondary_dashboard_db].[dbo].[account] WHERE [username] = ?";
    $params = [$username];
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        return null;
    }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row ? $row['section'] : null;
}

function updateShift($conn, $shift, $nsds, $useParam = true) {
    $sql = "UPDATE [secondary_dashboard_db].[dbo].[manpower] SET nsds = ? WHERE shift = ?";
    $params = $useParam ? [$nsds, $shift] : [$nsds];

    $stmt = $useParam ? sqlsrv_query($conn, $sql, $params) : sqlsrv_query($conn, "UPDATE [secondary_dashboard_db].[dbo].[manpower] SET nsds = ? WHERE shift = '$shift'", [$nsds]);

    if ($stmt === false) {
        $errors = sqlsrv_errors();
        echo json_encode(['message' => "Error updating shift $shift.", 'error' => $errors]);
        return false;
    }
    return true;
}

function formatSection($section) {
    if (is_numeric($section)) {
        return 'Section ' . $section;
    }
    return $section;
}
// ----------------------------------------------SECTION INSERT------------------------------------------------
function fetchJphData($conn) {
    $sql = "SELECT [section], [process], [machine_no], [jph] FROM [secondary_dashboard_db].[dbo].[jph]";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $map = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // Normalize keys to match your format (e.g., "Section 3")
        $sectionKey = formatSection($row['section']);
        $key = $sectionKey . '|' . $row['process'] . '|' . $row['machine_no'];
        $map[$key] = $row['jph'];
    }
    return $map;
}
function insertManpower2($conn, $section) {
    $sectionFormatted = formatSection($section); // e.g. '1' -> 'Section 1'

    // Delete existing data
    $deleteSql = "DELETE FROM [secondary_dashboard_db].[dbo].[section_page] WHERE section = ?";
    $stmtDelete = sqlsrv_prepare($conn, $deleteSql, [$sectionFormatted]);
    if (!$stmtDelete || !sqlsrv_execute($stmtDelete)) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Fetch manpower data
    $sqlSelect = "SELECT emp_no, full_name, skill_level, section, process, machine_no, shift, nsds
                  FROM [secondary_dashboard_db].[dbo].[manpower]
                  WHERE section = ?";
    $stmtSelect = sqlsrv_query($conn, $sqlSelect, [$section]);
    if ($stmtSelect === false) {
        echo json_encode(['message' => 'Error fetching data from manpower.', 'error' => sqlsrv_errors()]);
        exit;
    }

    // Fetch jph map once
    $jphMap = fetchJphData($conn);

    $detailsOptions = ['Actual JPH', 'Target Running Output', 'Actual Running Output'];
    $grouped = [];

    while ($row = sqlsrv_fetch_array($stmtSelect, SQLSRV_FETCH_ASSOC)) {
$key = formatSection($row['section']) . '|' . $row['process'] . '|' . $row['machine_no'];

        $shiftLabel = ($row['nsds'] === 'Dayshift') ? 'DS' : 'NS';
        $nameWithShift = "{$row['full_name']} ({$shiftLabel})";

        if (!isset($grouped[$key])) {
            $grouped[$key] = [
                'section' => formatSection($row['section']),
                'process' => $row['process'],
                'machine_no' => $row['machine_no'],
                'manpower' => [],
                'nsds' => []
            ];
        }
        $grouped[$key]['manpower'][] = $nameWithShift;
        $grouped[$key]['nsds'][] = $row['nsds'];
    }

    $maxManpowerLength = 1000;

    foreach ($grouped as $key => $g) {
        $manpowerStrFull = implode(' | ', array_unique($g['manpower']));
        $manpowerStr = mb_substr($manpowerStrFull, 0, $maxManpowerLength);
        $nsdsStr = implode(' | ', array_unique($g['nsds']));
        $specifications = '';
        $targetOutput = 0;
        $dailyResult = 0;

        // Lookup target_jph from pre-fetched map, default to 0 if not found
        $targetJph = $jphMap[$key] ?? 0;

        // All 24 hours fields set to 0 or based on your logic
        $hours = array_fill(0, 24, 0);

        $dateStart = date("Y-m-d") . " 07:00:00";
        $dateEnd = date("Y-m-d", strtotime("+1 day")) . " 07:00:00";
        $currentDateTime = date("Y-m-d H:i:s");
foreach ($detailsOptions as $detail) {
    $hours = array_fill(0, 24, 0);

    if ($detail === 'Target Running Output') {
        $nsdsUnique = array_unique($g['nsds']);
        $hasDS = in_array('Dayshift', $nsdsUnique);
        $hasNS = in_array('Nightshift', $nsdsUnique);

        if ($hasDS && $hasNS) {
            // Both shifts — h7 (index 6)
            $hours[6] = $targetJph;
        } elseif ($hasDS) {
            // Only Dayshift — h7
            $hours[6] = $targetJph;
        } elseif ($hasNS) {
            // Only Nightshift — h19 (index 18)
            $hours[18] = $targetJph;
        }
    }

    $insertSql = "INSERT INTO [secondary_dashboard_db].[dbo].[section_page] 
        (section, process, machine_no, specifications, manpower, skill_level, wip, target_jph, target_output, details, 
        h1,h2,h3,h4,h5,h6,h7,h8,h9,h10,h11,h12,h13,h14,h15,h16,h17,h18,h19,h20,h21,h22,h23,h24, daily_result, date, nsds, date_start, date_end)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $params = array_merge([
        $g['section'],
        $g['process'],
        $g['machine_no'],
        $specifications,
        $manpowerStr,
        3, // Skill level
        0, // wip
        $targetJph,
        $targetOutput,
        $detail
    ], $hours, [
        $dailyResult,
        $currentDateTime,
        $nsdsStr,
        $dateStart,
        $dateEnd
    ]);

    $stmtInsert = sqlsrv_query($conn, $insertSql, $params);
    if (!$stmtInsert) {
        die(print_r(sqlsrv_errors(), true));
    }
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

function insertsection_pageRow($conn, $section, $process, $machineNo, $specifications, $manpower, $skillLevel, $targetJph, $targetOutput, $details, $hours, $dailyResult, $nsds)
{
    // Calculate date_start (today 07:00:00) and date_end (tomorrow 06:59:59)
    $now = new DateTime(); // current datetime
    $dateStart = clone $now;
    $dateStart->setTime(7, 0, 0); // today at 07:00:00

    $dateEnd = clone $dateStart;
    $dateEnd->modify('+1 day')->setTime(6, 59, 59); // tomorrow at 06:59:59

    $sqlInsert = "INSERT INTO [secondary_dashboard_db].[dbo].[section_page]
                  ([section], [process], [machine_no], [specifications], [manpower], [skill_level], [target_jph], [target_output], [details],
                   [h1], [h2], [h3], [h4], [h5], [h6], [h7], [h8], [h9], [h10], [h11], [h12],
                   [h13], [h14], [h15], [h16], [h17], [h18], [h19], [h20], [h21], [h22], [h23], [h24],
                   [nsds], [daily_result], [wip], [date], [date_start], [date_end])
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                          ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                          ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                          ?, ?, ?, ?, ?, 0, GETDATE(), ?, ?)";

    $params = [
        $section, $process, $machineNo, $specifications, $manpower, $skillLevel,
        $targetJph, $targetOutput, $details
    ];

    for ($i = 0; $i < 24; $i++) {
        $params[] = $hours[$i] ?? 0;
    }

    $params[] = $nsds;
    $params[] = $dailyResult;
    $params[] = $dateStart->format('Y-m-d H:i:s');
    $params[] = $dateEnd->format('Y-m-d H:i:s');

    $stmtInsert = sqlsrv_query($conn, $sqlInsert, $params);
    if ($stmtInsert === false) {
        $errors = sqlsrv_errors();
        echo json_encode(['message' => 'Error inserting data into section_page.', 'error' => $errors]);
        exit;
    }
}

?>