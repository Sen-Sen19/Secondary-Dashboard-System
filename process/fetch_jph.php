<?php
include 'conn.php';
header('Content-Type: application/json');

// Fetch all JPH data
$sql = "SELECT [process], [jph], [last_updated], [ip_address]
        FROM [secondary_dashboard_db].[dbo].[jph]";

$stmt = sqlsrv_query($conn, $sql);

$data = [];

if ($stmt !== false) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        if ($row['last_updated'] instanceof DateTime) {
            $row['last_updated'] = $row['last_updated']->format('Y-m-d H:i:s');
        }
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Failed to fetch JPH data']);
}
?>
