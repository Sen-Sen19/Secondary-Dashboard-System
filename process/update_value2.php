<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $process = trim($_POST['process'] ?? '');
    $machine_no = trim($_POST['machine_no'] ?? '');
    $section = trim($_POST['section'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $value = trim($_POST['value'] ?? '');
    $hour = $_POST['h'] ?? null;

    if ($process === '' || $machine_no === '' || $section === '' || $type === '' || $value === '') {
        echo json_encode(['error' => 'Missing parameters']);
        exit;
    }

    $column = '';
    $extraCondition = '';

    if (in_array($type, ['wip','wt', 'target_jph', 'target_output'])) {
        $column = $type;
    } elseif ($type === 'hourly') {
        $hourInt = intval($hour);
        $maxHour = 24; // or whatever your system supports
        if ($hourInt < 1 || $hourInt > $maxHour) {
            echo json_encode(['error' => "Invalid hour value. Only h1 to h$maxHour allowed."]);
            exit;
        }
        $column = 'h' . $hourInt;
        $extraCondition = " AND [details] = 'Actual JPH'";
    } else {
        echo json_encode(['error' => 'Invalid type']);
        exit;
    }

    // Update the main table
    $sql = "UPDATE [secondary_dashboard_db].[dbo].[section_page]
            SET [$column] = ?
            WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? $extraCondition";

    $params = [$value, $process, $machine_no, $section];
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        $errors = sqlsrv_errors();
        error_log("Update failed: " . print_r($errors, true));
        echo json_encode(['error' => 'Database update failed', 'details' => $errors]);
        exit;
    }

    $rowsAffected = sqlsrv_rows_affected($stmt);
    if ($rowsAffected === false || $rowsAffected === 0) {
        echo json_encode(['error' => 'No rows updated - check your WHERE conditions']);
        exit;
    }
    if ($type === 'target_jph') {
        // Check shift info from any existing row (like from Actual JPH)
        $nsdsSql = "SELECT [nsds] FROM [secondary_dashboard_db].[dbo].[section_page]
                    WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";
        $nsdsStmt = sqlsrv_query($conn, $nsdsSql, [$process, $machine_no, $section]);
    
        if ($nsdsStmt && ($nsdsRow = sqlsrv_fetch_array($nsdsStmt, SQLSRV_FETCH_ASSOC))) {
            $nsds = strtolower(str_replace(' ', '', $nsdsRow['nsds'] ?? ''));
    
            // Map shift to correct hour
            $targetHourCol = null;
            if ($nsds === 'dayshift') {
                $targetHourCol = 'h7';
            } elseif ($nsds === 'nightshift') {
                $targetHourCol = 'h19';
            }
    
            if ($targetHourCol) {
                $updateTargetRunningSql = "UPDATE [secondary_dashboard_db].[dbo].[section_page]
                                           SET [$targetHourCol] = ?
                                           WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? 
                                           AND [details] = 'Target Running Output' AND REPLACE(LOWER([nsds]), ' ', '') = ?";
                $paramsTarget = [$value, $process, $machine_no, $section, $nsds];
                $stmtTarget = sqlsrv_query($conn, $updateTargetRunningSql, $paramsTarget);
    
                if ($stmtTarget === false) {
                    error_log("Target Running Output update via target_output failed: " . print_r(sqlsrv_errors(), true));
                    echo json_encode(['error' => 'Failed to update Target Running Output hourly column']);
                    exit;
                }
    
                $affected = sqlsrv_rows_affected($stmtTarget);
                error_log("Target Running Output updated in $targetHourCol with value $value. Rows affected: $affected");
            }
        }
    }
   // Cumulative logic for all hours (1 to 24)
if ($type === 'hourly') {
    $fetchJphSql = "SELECT [$column] as currentJph FROM [secondary_dashboard_db].[dbo].[section_page]
                    WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";
    $fetchJphStmt = sqlsrv_query($conn, $fetchJphSql, [$process, $machine_no, $section]);

    if ($fetchJphStmt === false) {
        error_log("Fetch Actual JPH failed: " . print_r(sqlsrv_errors(), true));
        echo json_encode(['error' => 'Failed to fetch Actual JPH']);
        exit;
    }

    $jphRow = sqlsrv_fetch_array($fetchJphStmt, SQLSRV_FETCH_ASSOC);
    $currentJph = floatval($jphRow['currentJph'] ?? 0);

    // Wrap-around previous hour: if current is 1, previous is 24
    $prevHour = $hourInt - 1;
    if ($prevHour < 1) {
        $prevHour = 24;
    }
    $prevHourCol = 'h' . $prevHour;

    $fetchPrevOutputSql = "SELECT [$prevHourCol] as prevOutput FROM [secondary_dashboard_db].[dbo].[section_page]
                           WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    $fetchPrevOutputStmt = sqlsrv_query($conn, $fetchPrevOutputSql, [$process, $machine_no, $section]);

    if ($fetchPrevOutputStmt === false) {
        error_log("Fetch previous Actual Running Output failed: " . print_r(sqlsrv_errors(), true));
        echo json_encode(['error' => 'Failed to fetch previous Actual Running Output']);
        exit;
    }

    $outputRow = sqlsrv_fetch_array($fetchPrevOutputStmt, SQLSRV_FETCH_ASSOC);
    $prevOutput = floatval($outputRow['prevOutput'] ?? 0);

    $newOutputValue = $currentJph + $prevOutput;

    $updateOutputSql = "UPDATE [secondary_dashboard_db].[dbo].[section_page]
                        SET [$column] = ?
                        WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    $updateOutputParams = [$newOutputValue, $process, $machine_no, $section];
    $updateOutputStmt = sqlsrv_query($conn, $updateOutputSql, $updateOutputParams);

    if ($updateOutputStmt === false) {
        error_log("Cumulative copy update failed: " . print_r(sqlsrv_errors(), true));
        echo json_encode(['error' => 'Cumulative copy update failed']);
        exit;
    }

    error_log("Cumulative updated $column for Actual Running Output with value $newOutputValue");
}















// === New function for Target Running Output update based on Actual Running Output changes ===
if ($type === 'hourly' && (($hourInt >= 7 && $hourInt <= 18) || ($hourInt >= 19 && $hourInt <= 24) || ($hourInt >= 1 && $hourInt <= 6))) {

    // Fetch NSDS to confirm shift
    $nsdsSql = "SELECT [nsds] FROM [secondary_dashboard_db].[dbo].[section_page]
                WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";
    $nsdsStmt = sqlsrv_query($conn, $nsdsSql, [$process, $machine_no, $section]);

    if ($nsdsStmt === false) {
        error_log("Fetch nsds failed: " . print_r(sqlsrv_errors(), true));
        echo json_encode(['error' => 'Failed to fetch nsds']);
        exit;
    }

    $nsdsRow = sqlsrv_fetch_array($nsdsStmt, SQLSRV_FETCH_ASSOC);
    $nsds = strtolower(str_replace(' ', '', $nsdsRow['nsds'] ?? ''));

    if ($nsds === 'dayshift') {
        // Skip Target Running Output update for h7
        if ($hourInt == 7) {
            // Only update Actual Running Output h7 elsewhere, no Target Running Output update here
            error_log("Skipping Target Running Output update for h7 on dayshift");
        } else {
            // Calculate Target Running Output for h8 and onwards
            if ($hourInt == 8) {
                // Target h8 = Target h7 * 2
                $targetH7Sql = "SELECT [h7] FROM [secondary_dashboard_db].[dbo].[section_page]
                                WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Target Running Output'";
                $targetH7Stmt = sqlsrv_query($conn, $targetH7Sql, [$process, $machine_no, $section]);
                $targetH7Row = sqlsrv_fetch_array($targetH7Stmt, SQLSRV_FETCH_ASSOC);
                $targetH7Val = floatval($targetH7Row['h7'] ?? 0);
    
                $targetValue = $targetH7Val * 2;
            } else {
                // For hour 9 and onwards
                $prevHour = $hourInt - 1;
    
                $targetPrevHourSql = "SELECT [h$prevHour], [h7] FROM [secondary_dashboard_db].[dbo].[section_page]
                                     WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Target Running Output'";
                $targetPrevHourStmt = sqlsrv_query($conn, $targetPrevHourSql, [$process, $machine_no, $section]);
                $targetPrevHourRow = sqlsrv_fetch_array($targetPrevHourStmt, SQLSRV_FETCH_ASSOC);
    
               $prevVal = isset($targetPrevHourRow["h$prevHour"]) ? floatval($targetPrevHourRow["h$prevHour"]) : null;

                $h7Val = floatval($targetPrevHourRow["h7"] ?? 0);
    
                $targetValue = $prevVal + $h7Val;
            }
    
            // Update Target Running Output for current hour
            $targetHourCol = 'h' . $hourInt;
            $updateTargetSql = "UPDATE [secondary_dashboard_db].[dbo].[section_page]
                                SET [$targetHourCol] = ?
                                WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Target Running Output'";
            $updateTargetStmt = sqlsrv_query($conn, $updateTargetSql, [$targetValue, $process, $machine_no, $section]);
    
            if ($updateTargetStmt === false) {
                error_log("Target Running Output update failed: " . print_r(sqlsrv_errors(), true));
                echo json_encode(['error' => 'Failed to update Target Running Output']);
                exit;
            }
    
            error_log("Updated Target Running Output $targetHourCol with value $targetValue");
        }




        } elseif ($nsds === 'nightshift') {
    // Skip Target Running Output update for h19
    if ($hourInt == 19) {
        // Only update Actual Running Output h19 elsewhere, no Target Running Output update here
        error_log("Skipping Target Running Output update for h19 on nightshift");
    } else {
        // Prepare input parameters array for reuse
        $params = [$process, $machine_no, $section];

        if ($hourInt == 20) {
            // Target h20 = Target h19 * 2
            $targetH19Sql = "SELECT [h19] FROM [secondary_dashboard_db].[dbo].[section_page]
                            WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Target Running Output'";
            $targetH19Stmt = sqlsrv_query($conn, $targetH19Sql, $params);

            if ($targetH19Stmt === false) {
                error_log("SQL query failed for h19 fetch: " . print_r(sqlsrv_errors(), true));
                echo json_encode(['error' => 'Query failed for h19 fetch']);
                exit;
            }

            $targetH19Row = sqlsrv_fetch_array($targetH19Stmt, SQLSRV_FETCH_ASSOC);
            $targetH19Val = floatval($targetH19Row['h19'] ?? 0);

            $targetValue = $targetH19Val * 2;

        } else {
            // For hour 21 and onwards
            $prevHour = $hourInt - 1;
            if ($prevHour < 1) {
                $prevHour = 24; // wrap-around logic for midnight hour
            }

            $targetPrevHourSql = "SELECT [h$prevHour], [h19] FROM [secondary_dashboard_db].[dbo].[section_page]
                                 WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Target Running Output'";
            $targetPrevHourStmt = sqlsrv_query($conn, $targetPrevHourSql, $params);

            if ($targetPrevHourStmt === false) {
                error_log("SQL query failed for previous hour fetch (h$prevHour): " . print_r(sqlsrv_errors(), true));
                echo json_encode(['error' => "Query failed for previous hour fetch (h$prevHour)"]);
                exit;
            }

            $targetPrevHourRow = sqlsrv_fetch_array($targetPrevHourStmt, SQLSRV_FETCH_ASSOC);

            $prevVal = isset($targetPrevHourRow["h$prevHour"]) ? floatval($targetPrevHourRow["h$prevHour"]) : null;
            $h19Val = isset($targetPrevHourRow["h19"]) ? floatval($targetPrevHourRow["h19"]) : null;

            // ✅ Null Check
            if ($prevVal === null || $h19Val === null) {
                error_log("Missing required hour values for Target Running Output calculation on nightshift h$hourInt");
                // You can choose to skip update or exit here
                return; // or continue; if inside loop
            } else {
                $targetValue = $prevVal + $h19Val;
            }
        }

        // Update Target Running Output for current hour
        $targetHourCol = 'h' . $hourInt;
        $updateTargetSql = "UPDATE [secondary_dashboard_db].[dbo].[section_page]
                            SET [$targetHourCol] = ?
                            WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Target Running Output'";
        $updateTargetStmt = sqlsrv_query($conn, $updateTargetSql, [$targetValue, $process, $machine_no, $section]);

        if ($updateTargetStmt === false) {
            error_log("Target Running Output update failed: " . print_r(sqlsrv_errors(), true));
            echo json_encode(['error' => 'Failed to update Target Running Output']);
            exit;
        }

        error_log("Updated Target Running Output $targetHourCol with value $targetValue");
    }
}




    

}


    // Copy logic for h7 and h19
    if (($column === 'h7' || $column === 'h19') && $extraCondition === " AND [details] = 'Actual JPH'") {
        $checkNsdsSql = "SELECT [nsds] FROM [secondary_dashboard_db].[dbo].[section_page]
                         WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";
        $checkNsdsStmt = sqlsrv_query($conn, $checkNsdsSql, [$process, $machine_no, $section]);

        if ($checkNsdsStmt === false) {
            error_log("Fetch nsds failed: " . print_r(sqlsrv_errors(), true));
            echo json_encode(['error' => 'Failed to fetch nsds']);
            exit;
        }

        $rowNsds = sqlsrv_fetch_array($checkNsdsStmt, SQLSRV_FETCH_ASSOC);
        $nsds = strtolower(str_replace(' ', '', $rowNsds['nsds'] ?? ''));

        $shouldCopy = false;

        if ($column === 'h7' && $nsds === 'dayshift') {
            $shouldCopy = true;
        } elseif ($column === 'h19' && $nsds === 'nightshift') {
            $shouldCopy = true;
        }

        if ($shouldCopy) {
            $copySql = "UPDATE [secondary_dashboard_db].[dbo].[section_page]
                        SET [$column] = ?
                        WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual Running Output' AND REPLACE(LOWER([nsds]), ' ', '') = ?";
            $copyParams = [$value, $process, $machine_no, $section, $nsds];
            $copyStmt = sqlsrv_query($conn, $copySql, $copyParams);

            if ($copyStmt === false) {
                error_log("Copy update failed: " . print_r(sqlsrv_errors(), true));
                echo json_encode(['error' => 'Copy update failed']);
                exit;
            }

            $copyRowsAffected = sqlsrv_rows_affected($copyStmt);
            error_log("Copied $column value to 'Actual Running Output' row. Rows affected: $copyRowsAffected");
        }
    }



































    function updateDailyResult($conn, $process, $machine_no, $section, $detailType) {
        // Get shift info (nsds) from Actual JPH (assuming shift is same for both details)
        $nsdsSql = "SELECT [nsds] FROM [secondary_dashboard_db].[dbo].[section_page]
                    WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";
        $nsdsStmt = sqlsrv_query($conn, $nsdsSql, [$process, $machine_no, $section]);
    
        if ($nsdsStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        $nsdsRow = sqlsrv_fetch_array($nsdsStmt, SQLSRV_FETCH_ASSOC);
        $nsds = strtolower(str_replace(' ', '', $nsdsRow['nsds'] ?? ''));
    
        // Define hour order based on shift
        if ($nsds === 'dayshift') {
            $orderedHours = ['h18', 'h17', 'h16', 'h15', 'h14', 'h13', 'h12', 'h11', 'h10', 'h9', 'h8', 'h7'];
        } else {
            $orderedHours = ['h6', 'h5', 'h4', 'h3', 'h2', 'h1', 'h24', 'h23', 'h22', 'h21', 'h20', 'h19'];
        }
    
        // Fetch the hourly values for the specified detail
        $fetchHoursSQL = "
            SELECT " . implode(',', $orderedHours) . "
            FROM [secondary_dashboard_db].[dbo].[section_page]
            WHERE process = ? AND machine_no = ? AND manpower = ? AND details = ?";
        $fetchHoursParams = array($process, $machine_no, $section, $detailType);
        $fetchHoursStmt = sqlsrv_query($conn, $fetchHoursSQL, $fetchHoursParams);
    
        if ($fetchHoursStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        $hoursRow = sqlsrv_fetch_array($fetchHoursStmt, SQLSRV_FETCH_ASSOC);
        if ($hoursRow) {
            $lastNonZero = 0;
            foreach ($orderedHours as $hourKey) {
                $val = $hoursRow[$hourKey];
                if (is_numeric($val) && $val > 0) {
                    $lastNonZero = $val;
                    break;
                }
            }
    
            // Update daily_result for this detail
            $updateDailySQL = "
                UPDATE [secondary_dashboard_db].[dbo].[section_page]
                SET daily_result = ?
                WHERE process = ? AND machine_no = ? AND manpower = ? AND details = ?";
            $updateDailyParams = array($lastNonZero, $process, $machine_no, $section, $detailType);
            $updateDailyStmt = sqlsrv_query($conn, $updateDailySQL, $updateDailyParams);
    
            if ($updateDailyStmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
    
    // Call the function for both Target and Actual Running Output:
    updateDailyResult($conn, $process, $machine_no, $section, 'Target Running Output');
    updateDailyResult($conn, $process, $machine_no, $section, 'Actual Running Output');
    

function updateDailyJPHResult($conn, $process, $machine_no, $section) {
    // Get shift info (nsds) from Actual JPH
    $nsdsSql = "SELECT [nsds] FROM [secondary_dashboard_db].[dbo].[section_page]
                WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";
    $nsdsStmt = sqlsrv_query($conn, $nsdsSql, [$process, $machine_no, $section]);

    if ($nsdsStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $nsdsRow = sqlsrv_fetch_array($nsdsStmt, SQLSRV_FETCH_ASSOC);
    $nsds = strtolower(str_replace(' ', '', $nsdsRow['nsds'] ?? ''));

    // Define hour keys based on shift
    if ($nsds === 'dayshift') {
        $hourKeys = ['h7', 'h8', 'h9', 'h10', 'h11', 'h12', 'h13', 'h14', 'h15', 'h16', 'h17', 'h18'];
    } else {
        $hourKeys = ['h19', 'h20', 'h21', 'h22', 'h23', 'h24', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
    }

    // Fetch the hourly values for 'Actual JPH'
    $fetchHoursSQL = "
        SELECT " . implode(',', $hourKeys) . "
        FROM [secondary_dashboard_db].[dbo].[section_page]
        WHERE process = ? AND machine_no = ? AND manpower = ? AND details = 'Actual JPH'";
    $fetchHoursStmt = sqlsrv_query($conn, $fetchHoursSQL, [$process, $machine_no, $section]);

    if ($fetchHoursStmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $hoursRow = sqlsrv_fetch_array($fetchHoursStmt, SQLSRV_FETCH_ASSOC);
    if ($hoursRow) {
        $sum = 0;
        $count = 0;
        foreach ($hourKeys as $hourKey) {
            $val = $hoursRow[$hourKey];
            if (is_numeric($val) && $val > 0) {
                $sum += $val;
                $count++;
            }
        }

        $average = ($count > 0) ? round($sum / $count, 0) : 0;

        // Update daily_result for 'Actual JPH'
        $updateDailySQL = "
            UPDATE [secondary_dashboard_db].[dbo].[section_page]
            SET daily_result = ?
            WHERE process = ? AND machine_no = ? AND manpower = ? AND details = 'Actual JPH'";
        $updateDailyParams = array($average, $process, $machine_no, $section);
        $updateDailyStmt = sqlsrv_query($conn, $updateDailySQL, $updateDailyParams);

        if ($updateDailyStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }
}

// Example usage
updateDailyJPHResult($conn, $process, $machine_no, $section);








    // Return updated value
    $selectSql = "SELECT [$column] FROM [secondary_dashboard_db].[dbo].[section_page]
                  WHERE [process] = ? AND [machine_no] = ? AND [manpower] = ? $extraCondition";
    $selectStmt = sqlsrv_query($conn, $selectSql, [$process, $machine_no, $section]);
    $row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC);
    $updatedValue = $row[$column] ?? null;

    echo json_encode([
        'success' => true,
        'rows_affected' => $rowsAffected,
        'updated_value' => $updatedValue,
    ]);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

