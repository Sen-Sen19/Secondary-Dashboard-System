<?php
$serverName = "172.25.115.167\SQLEXPRESS";
$connectionOptions = [
    "Database" => "secondary_dashboard_db",
    "Uid" => "sa",
    "PWD" => '#Sy$temGr0^p|115167'
];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
$stringColumns = [0, 1, 2, 3, 4, 5, 6];
$maxEmpNoLength = 10;

function sanitizeValueByIndex($value, $index, $stringColumns) {
    $trimmed = trim($value);
    $trimmed = preg_replace('/[\p{C}]/u', '', $trimmed); 
    if (in_array($index, $stringColumns)) {
        return $trimmed;
    }

    return $trimmed === '' ? 0 : (is_numeric($trimmed) ? $trimmed : 0);
}
$feNames = [];
$feNameQuery = "SELECT [fe_name] FROM [secondary_dashboard_db].[dbo].[column_name]";
$stmt = sqlsrv_query($conn, $feNameQuery);
if ($stmt === false) {
    die("Error fetching fe_names: " . print_r(sqlsrv_errors(), true));
}
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $feNames[] = $row['fe_name'];
}
sqlsrv_free_stmt($stmt);
function isValidProcess($process) {
    global $feNames;
    $normalizedProcess = strtolower(trim($process));
    $normalizedFeNames = array_map(function($name) {
        return strtolower(trim($name));
    }, $feNames);

    if (!in_array($normalizedProcess, $normalizedFeNames, true)) {
        error_log("Invalid process check failed: '$process' normalized as '$normalizedProcess'");
        error_log("Valid processes: " . implode(", ", $normalizedFeNames));
    }
    return in_array($normalizedProcess, $normalizedFeNames, true);
}
function hasRequiredFields($row) {
    return !empty($row[5]) && !empty($row[6]); 
}
function hasRequiredMainFields($row) {
    return !empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]);
}

$skippedRows = [];
if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
    $file = fopen($_FILES['csv_file']['tmp_name'], 'r');


    // Read header and first row
$header = fgetcsv($file);
$firstRow = fgetcsv($file);

if ($firstRow === false) {
    die("CSV file contains no data rows.");
}

$firstRow = array_pad($firstRow, 7, '');
$firstRow = array_map(function($value, $index) use ($stringColumns) {
    return sanitizeValueByIndex($value, $index, $stringColumns);
}, $firstRow, array_keys($firstRow));

// 🔥 THIS is your real section
$sectionToDelete = $firstRow[3];  // index 3 = Section
$shiftToDelete   = $firstRow[6];  // index 6 = Shift

if (empty($sectionToDelete) || empty($shiftToDelete)) {
    die("Section or Shift is missing in the first data row.");
}

sqlsrv_begin_transaction($conn);

try {
    // ✅ Clean all previous rows with the same section AND shift
    $deleteSql = "DELETE FROM [secondary_dashboard_db].[dbo].[manpower] WHERE [section] = ? AND [shift] = ?";
    $deleteStmt = sqlsrv_query($conn, $deleteSql, [$sectionToDelete, $shiftToDelete]);
    if ($deleteStmt === false) {
        throw new Exception("Delete error: " . print_r(sqlsrv_errors(), true));
    }



    // ✅ Proceed to re-insert firstRow and loop through the rest as you already do

        $deletedCount = sqlsrv_rows_affected($deleteStmt);
        $insertSql = "INSERT INTO [secondary_dashboard_db].[dbo].[manpower] 
            ([emp_no], [full_name], [skill_level], [section], [process], [machine_no], [shift])
            VALUES (?, ?, ?, ?, ?, ?, ?)";
      $duplicateCheckSql = "SELECT COUNT(*) as cnt FROM [secondary_dashboard_db].[dbo].[manpower]
                      WHERE [full_name] = ? AND [machine_no] = ? AND [process] = ?";
$duplicateCheckStmt = sqlsrv_prepare($conn, $duplicateCheckSql, [null, null, null]);
if ($duplicateCheckStmt === false) {
    die("Error preparing duplicate check statement: " . print_r(sqlsrv_errors(), true));
}

// Modify insert logic for first row
if (isValidProcess($firstRow[4]) && !empty($firstRow[5]) && !empty($firstRow[6])) {
    // Check duplicate before insert
    $params = [$firstRow[1], $firstRow[5], $firstRow[4]];
    sqlsrv_execute(sqlsrv_prepare($conn, $duplicateCheckSql, $params));
    $dupCheckResult = sqlsrv_query($conn, $duplicateCheckSql, $params);
    $dupCount = 0;
    if ($dupCheckResult !== false) {
        $dupRow = sqlsrv_fetch_array($dupCheckResult, SQLSRV_FETCH_ASSOC);
        $dupCount = $dupRow['cnt'] ?? 0;
        sqlsrv_free_stmt($dupCheckResult);
    }
    if ($dupCount == 0) {
        if (strlen($firstRow[0]) > $maxEmpNoLength) {
            $firstRow[0] = substr($firstRow[0], 0, $maxEmpNoLength);
        }
        $insertStmt = sqlsrv_query($conn, $insertSql, $firstRow);
        if ($insertStmt === false) {
            throw new Exception("Insert error (first row): " . print_r(sqlsrv_errors(), true));
        }
    } else {
        $skippedRows[] = ['row' => $firstRow, 'reason' => "Duplicate record"];
    }
} else {
    $skippedRows[] = ['row' => $firstRow, 'reason' => "Process '{$firstRow[4]}' invalid"];
}

// Modify insert logic in loop
while (($row = fgetcsv($file)) !== false) {
    $row = array_pad($row, 7, '');
    $row = array_map(function($value, $index) use ($stringColumns) {
        return sanitizeValueByIndex($value, $index, $stringColumns);
    }, $row, array_keys($row));
    if (!isValidProcess($row[4])) {
        $skippedRows[] = ['row' => $row, 'reason' => "Process '{$row[4]}' invalid"];
        continue;
    }
    if (empty($row[5]) || empty($row[6])) {
        $skippedRows[] = ['row' => $row, 'reason' => "Missing machine_no or shift"];
        continue;
    }
    if (!hasRequiredMainFields($row)) {
        $skippedRows[] = ['row' => $row, 'reason' => "Missing emp_no/full_name/skill_level/section"];
        continue;
    }
    if (strlen($row[0]) > $maxEmpNoLength) {
        $row[0] = substr($row[0], 0, $maxEmpNoLength);
    }

    // Check duplicate before insert
    $params = [$row[1], $row[5], $row[4]];
    $dupCheckResult = sqlsrv_query($conn, $duplicateCheckSql, $params);
    $dupCount = 0;
    if ($dupCheckResult !== false) {
        $dupRow = sqlsrv_fetch_array($dupCheckResult, SQLSRV_FETCH_ASSOC);
        $dupCount = $dupRow['cnt'] ?? 0;
        sqlsrv_free_stmt($dupCheckResult);
    }
    if ($dupCount > 0) {
        $skippedRows[] = ['row' => $row, 'reason' => "Duplicate record"];
        continue;
    }

    $stmt = sqlsrv_query($conn, $insertSql, $row);
    if ($stmt === false) {
        $skippedRows[] = ['row' => $row, 'reason' => 'Insert failed: ' . print_r(sqlsrv_errors(), true)];
        continue;
    }
}
        sqlsrv_commit($conn);
        echo "CSV file successfully imported with section '$sectionToDelete' cleaned first!";
    } catch (Exception $e) {
        sqlsrv_rollback($conn);
        echo "Error during import: " . $e->getMessage();
    }
    fclose($file);
} else {
    echo "No file uploaded or file upload error.";
}
sqlsrv_close($conn);
if (!empty($skippedRows)) {
    echo "Skipped rows detected:\n";   
    echo str_pad("Emp No", 15) . str_pad("Process", 25) . "Reason\n";
    echo str_repeat("-", 65) . "\n";

    foreach ($skippedRows as $skip) {
        $empNo   = $skip['row'][0] ?? 'N/A';
        $process = $skip['row'][4] ?? 'N/A';
        $reason  = $skip['reason'] ?? 'Unknown reason';
        echo str_pad($empNo, 15) . str_pad($process, 25) . $reason . "\n";
    }
} else {
    echo "Import successful!";
}
?>
