<?php
include 'conn.php';

if (!isset($_GET['date']) || !isset($_GET['section']) || !isset($_GET['process'])) {
    echo json_encode([]);
    exit;
}

$date = $_GET['date'];
$section = $_GET['section'];
$process = $_GET['process'];

$sql = "SELECT DISTINCT machine_no
        FROM [dbo].[section_backup]
        WHERE CAST([date] AS DATE) = ? AND section = ? AND process = ?";
$params = [$date, $section, $process];
$stmt = sqlsrv_query($conn, $sql, $params);

$machines = [];

if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $machines[] = $row['machine_no'];
    }
}

echo json_encode($machines);
?>
