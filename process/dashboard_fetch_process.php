<?php
include 'conn.php';

if (!isset($_GET['date']) || !isset($_GET['section'])) {
    echo json_encode([]);
    exit;
}

$date = $_GET['date'];
$section = $_GET['section'];

$sql = "SELECT DISTINCT process 
        FROM [dbo].[section_output] 
        WHERE CAST([date] AS DATE) = ? AND section = ?";
$params = [$date, $section];
$stmt = sqlsrv_query($conn, $sql, $params);

$processes = [];

if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $processes[] = $row['process'];
    }
}

echo json_encode($processes);
?>
