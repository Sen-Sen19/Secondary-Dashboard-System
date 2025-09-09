<?php
include('conn.php'); 

if (isset($_FILES['csv']) && $_FILES['csv']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['csv']['tmp_name'];

    if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
        $headers = fgetcsv($handle); // Skip the header

        $sections = [];
        $csvData = []; 
        while (($data = fgetcsv($handle)) !== FALSE) {
            $sections[] = $data[4]; // Assuming 'section' is at index 4
            $csvData[] = $data;   
        }
        fclose($handle);

        $placeholders = implode(",", array_fill(0, count($sections), "?"));
        $deleteSql = "DELETE FROM [secondary_dashboard_db].[dbo].[plan] WHERE [section] IN ($placeholders)";
        $deleteStmt = sqlsrv_query($conn, $deleteSql, $sections);

        if ($deleteStmt === false) {
            die(print_r(sqlsrv_errors(), true)); 
        }

        foreach ($csvData as $data) {
            $date = $data[0];
            $product = $data[1];
            $plan = $data[2];
            $main_product = $data[3];
            $section = $data[4];
            $quantity = $data[5];
            $date2 = $data[6];
            $block = $data[7];
            $type = $data[8];
            $line = $data[9];
            $last_updated = date('Y-m-d H:i:s');
            $ip_address = $_SERVER['REMOTE_ADDR'];

            $insertSql = "INSERT INTO [secondary_dashboard_db].[dbo].[plan] 
                ([date], [product], [plan], [main_product], [section], [quantity], [date2], [block], [type], [line], [last_updated], [ip_address])
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertParams = array($date, $product, $plan, $main_product, $section, $quantity, $date2, $block, $type, $line, $last_updated, $ip_address);
            $insertStmt = sqlsrv_query($conn, $insertSql, $insertParams);

            if ($insertStmt === false) {
                die(print_r(sqlsrv_errors(), true)); 
            }
        }

        echo "CSV data has been successfully imported!";
    } else {
        echo "Error reading the file.";
    }
} else {
    echo "No file uploaded or error in file upload.";
}

sqlsrv_close($conn);
?>
