<?php
include 'conn.php';
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$date = $_GET['date'] ?? date('Y-m-d');

// Aggregate unmet output per section
$sql = "
    SELECT section, SUM([daily_result]) AS gap
    FROM [secondary_dashboard_db].[dbo].[section_backup]
    WHERE [date] = ?
      AND LOWER([details]) = 'actual running output'
      AND [daily_result] > 0
    GROUP BY section
    ORDER BY gap DESC
";

$params = [$date];
$stmt = sqlsrv_query($conn, $sql, $params);

$results = [];
if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $results[] = [
            'section' => $row['section'],
            'gap' => (int)$row['gap']
        ];
    }
} else {
    error_log("Query failed: " . print_r(sqlsrv_errors(), true));
}

$top10 = array_slice($results, 0, 10);

header('Content-Type: application/json');
echo json_encode($top10);
