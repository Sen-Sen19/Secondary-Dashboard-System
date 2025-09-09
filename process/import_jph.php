<?php
include('conn.php');

if (isset($_FILES['csv']) && $_FILES['csv']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['csv']['tmp_name'];

    if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
        $headers = fgetcsv($handle); // Skip the header row

        $csvData = [];
        $processes = [];

        while (($data = fgetcsv($handle)) !== FALSE) {
            if (count($data) >= 2) {
                $process = trim($data[0]);
                $jph = trim($data[1]);

                if ($process !== '' && $jph !== '') {
                    $csvData[] = [$process, $jph];
                    $processes[] = $process;
                }
            }
        }
        fclose($handle);

        // Remove duplicates and empty values
        $processes = array_filter(array_unique($processes), fn($p) => !empty($p));

        if (count($processes) > 0) {
            $placeholders = implode(",", array_fill(0, count($processes), "?"));
            $deleteSql = "DELETE FROM [secondary_dashboard_db].[dbo].[jph] WHERE [process] IN ($placeholders)";

         

            $deleteStmt = sqlsrv_query($conn, $deleteSql, $processes);

            if ($deleteStmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        } else {
            echo "No valid processes to delete.";
        }

        // Insert new rows
        foreach ($csvData as [$process, $jph]) {
            date_default_timezone_set('Asia/Manila');
            $last_updated = date('Y-m-d H:i:s');
            $ip_address = $_SERVER['REMOTE_ADDR'];

            $insertSql = "INSERT INTO [secondary_dashboard_db].[dbo].[jph] 
                ([process], [jph], [last_updated], [ip_address])
                VALUES (?, ?, ?, ?)";

            $insertParams = array($process, $jph, $last_updated, $ip_address);

          

            $insertStmt = sqlsrv_query($conn, $insertSql, $insertParams);

            if ($insertStmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }

        echo "CSV data has been successfully imported into the JPH table!";
    } else {
        echo "Error reading the file.";
    }
} else {
    echo "No file uploaded or error in file upload.";
}

sqlsrv_close($conn);
?>
