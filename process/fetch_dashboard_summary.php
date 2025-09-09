<?php
header('Content-Type: application/json');
require 'conn.php';

$date = $_GET['date'] ?? null;
$data = [];

if ($date) {
    // 🔹 Fetch summary_backup data
    $sql = "SELECT section,
                   CASE WHEN general_process = 'Actual Running Output' THEN 'Actual Output'
                        ELSE general_process END AS general_process,
                   total
            FROM [secondary_dashboard_db].[dbo].[summary_backup]
            WHERE CAST([date] AS DATE) = ?
            ORDER BY section";
    $params = [$date];
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = [
                'section' => (string)$row['section'],
                'general_process' => trim($row['general_process']),
                'total' => floatval($row['total']),
            ];
        }
    }

    // 🔹 Count ALL machines (machine count)
    $sql1 = "SELECT section, COUNT(*) AS machine_count
             FROM [secondary_dashboard_db].[dbo].[section_backup]
             WHERE CAST([date] AS DATE) = ?
               AND LTRIM(RTRIM(details)) = 'Actual JPH'
             GROUP BY section";
    $stmt1 = sqlsrv_query($conn, $sql1, $params);
    if ($stmt1) {
        while ($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
            $data[] = [
                'section' => (string)$row1['section'],
                'general_process' => 'Machine Count',
                'total' => intval($row1['machine_count']),
            ];
        }
    }

    // 🔹 Count machines with daily_result > 0 (actual machine)
    $sql2 = "SELECT section, COUNT(*) AS machine_count
             FROM [secondary_dashboard_db].[dbo].[section_backup]
             WHERE CAST([date] AS DATE) = ?
               AND LTRIM(RTRIM(details)) = 'Actual JPH'
               AND daily_result IS NOT NULL
               AND TRY_CAST(daily_result AS FLOAT) > 0
             GROUP BY section";
    $stmt2 = sqlsrv_query($conn, $sql2, $params);
    if ($stmt2) {
        while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
            $data[] = [
                'section' => (string)$row2['section'],
                'general_process' => 'Actual Machine',
                'total' => intval($row2['machine_count']),
            ];
        }
    }
}

echo json_encode($data);
?>
