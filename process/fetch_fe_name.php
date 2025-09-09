<?php
header('Content-Type: application/json');
include 'conn.php';

$feNames = [];

$sql = "SELECT [fe_name] FROM [secondary_dashboard_db].[dbo].[column_name] 
        WHERE [fe_name] IS NOT NULL 
        ORDER BY [fe_name] ASC";  // 👈 Sort alphabetically

$stmt = sqlsrv_query($conn, $sql);

if ($stmt !== false) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $feNames[] = $row['fe_name'];
    }
    echo json_encode($feNames);
} else {
    echo json_encode(['error' => 'Failed to fetch data']);
}
?>
