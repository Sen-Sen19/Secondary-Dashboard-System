<?php
include 'conn.php';

if (!isset($_GET['date']) || !isset($_GET['section']) || !isset($_GET['process'])) {
    echo json_encode([]);
    exit;
}

$date = $_GET['date'];
$section = $_GET['section'];
$process = $_GET['process'];

$sql = "SELECT DISTINCT nsds 
        FROM [dbo].[section_backup]
        WHERE CAST([date] AS DATE) = ? AND section = ? AND process = ?";
$params = [$date, $section, $process];
$stmt = sqlsrv_query($conn, $sql, $params);

$shifts = [];

if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $shifts[] = $row['nsds'];  // Use the real column name
    }
}

echo json_encode($shifts);
?>
