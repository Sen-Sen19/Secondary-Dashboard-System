<?php
include 'conn.php';

$section = $_POST['section'] ?? '';
$date = $_POST['date'] ?? '';

if (!$section || !$date) {
    echo json_encode(["error" => "Missing section or date"]);
    exit;
}

$sql = "
    SELECT DISTINCT [process]
    FROM [secondary_dashboard_db].[dbo].[section_output]
    WHERE [section] = ? AND CONVERT(date, [date]) = ?
";

$params = [$section, $date];
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(["error" => sqlsrv_errors()]);
    exit;
}

$processes = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $processes[] = $row['process'];
}

echo json_encode($processes);
?>
