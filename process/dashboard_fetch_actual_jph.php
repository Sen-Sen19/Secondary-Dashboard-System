<?php
include 'conn.php';

// Initialize filters
$params = [];
$conditions = [];

// Add dynamic filters
if (!empty($_GET['date'])) {
    $conditions[] = "CAST([date] AS DATE) = ?";
    $params[] = $_GET['date'];
}
if (!empty($_GET['section'])) {
    $conditions[] = "section = ?";
    $params[] = $_GET['section'];
}
if (!empty($_GET['process'])) {
    $conditions[] = "process = ?";
    $params[] = $_GET['process'];
}
if (!empty($_GET['machine_no'])) {
    $conditions[] = "machine_no = ?";
    $params[] = $_GET['machine_no'];
}
if (!empty($_GET['shift'])) {
    $conditions[] = "nsds = ?";
    $params[] = $_GET['shift'];
}

// Build WHERE clause
$whereClause = "";
if (!empty($conditions)) {
    $whereClause = " AND " . implode(" AND ", $conditions);
}

// Fetch Average JPH
$sql1 = "SELECT AVG(daily_result) AS avg_jph
         FROM [dbo].[section_backup]
         WHERE details = 'Actual JPH' $whereClause";

$stmt1 = sqlsrv_query($conn, $sql1, $params);
$actualJPH = null;
if ($stmt1 && $row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
    $actualJPH = $row['avg_jph'];
}

// Fetch Average Running Output
$sql2 = "SELECT AVG(daily_result) AS avg_output
         FROM [dbo].[section_backup]
         WHERE details = 'Actual Running Output' $whereClause";

$stmt2 = sqlsrv_query($conn, $sql2, $params);
$actualOutput = null;
if ($stmt2 && $row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
    $actualOutput = $row['avg_output'];
}

// Return both values as JSON
echo json_encode([
    'average_jph' => $actualJPH,
    'average_output' => $actualOutput
]);
?>
