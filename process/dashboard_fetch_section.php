<?php
include 'conn.php'; // Adjust path if needed

if (!isset($_GET['date'])) {
    echo json_encode([]);
    exit;
}

$date = $_GET['date'];

$sql = "SELECT DISTINCT section 
        FROM [dbo].[section_backup] 
        WHERE CAST([date] AS DATE) = ?";
$params = [$date];
$stmt = sqlsrv_query($conn, $sql, $params);

$sections = [];

if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $sections[] = $row['section'];
    }
}

echo json_encode($sections);
?>
