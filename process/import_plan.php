<?php
include('conn.php'); 

if (isset($_FILES['csv']) && $_FILES['csv']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['csv']['tmp_name'];

    $handle = fopen($fileTmpPath, "r");
    if ($handle !== FALSE) {
        $headers = fgetcsv($handle); // Skip header

        $csvData = [];
        while (($data = fgetcsv($handle)) !== FALSE) {
            if (count($data) >= 4) {
                $cleanData = array_map('trim', $data);
                $csvData[] = $cleanData;
            }
        }
        fclose($handle);

        if (count($csvData) === 0) {
            echo "No valid rows found in CSV.";
            exit;
        }

        $username = $_POST['username'] ?? 'unknown_user';
        $section = $_POST['section'] ?? '';
        $shift = $_POST['shift'] ?? '';

        if (!$section || !$shift) {
            echo "Missing section or shift.";
            exit;
        }

        // Delete old plan for the same section and shift
        $deleteSql = "DELETE FROM [secondary_dashboard_db].[dbo].[plan] WHERE [section] = ? AND [shift] = ?";
        $deleteParams = [$section, $shift];
        $deleteStmt = sqlsrv_query($conn, $deleteSql, $deleteParams);
        if ($deleteStmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Insert new rows
        $insertedCount = 0;
        foreach ($csvData as $data) {
            list($main_product, $product, $plan, $block) = $data;

            if (!$main_product && !$product && !$plan && !$block) continue;

            $last_updated = date('Y-m-d H:i:s');
            $ip_address = $_SERVER['REMOTE_ADDR'];

            $insertSql = "INSERT INTO [secondary_dashboard_db].[dbo].[plan] 
                ([main_product], [product], [plan], [block], [section], [shift], [last_updated], [ip_address], [username])
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $insertParams = [$main_product, $product, $plan, $block, $section, $shift, $last_updated, $ip_address, $username];
            $insertStmt = sqlsrv_query($conn, $insertSql, $insertParams);

            if ($insertStmt === false) {
                error_log("Insert failed: " . implode(', ', $data));
                die(print_r(sqlsrv_errors(), true));
            }

            $insertedCount++;
        }

        echo "CSV data has been successfully imported! Rows inserted: $insertedCount";
    } else {
        echo "Error reading the file.";
    }
} else {
    echo "No file uploaded or error in file upload.";
}

sqlsrv_close($conn);
