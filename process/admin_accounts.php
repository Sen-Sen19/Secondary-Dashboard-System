<?php

include 'conn.php';

header('Content-Type: application/json');

try {
    $sql = "
        SELECT TOP (1000) [username], [password], [section], [type], [shift]
        FROM [secondary_dashboard_db].[dbo].[account]
    ";

    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        throw new Exception('SQL query execution failed: ' . print_r(sqlsrv_errors(), true));
    }

    $data = [];
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
   

        $row['Delete'] = '';
        $data[] = $row;
    }

    echo json_encode($data);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Error fetching data: ' . $e->getMessage()]);
}

sqlsrv_close($conn);
?>
