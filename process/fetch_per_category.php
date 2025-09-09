<?php

include 'conn.php';

$category = $_POST['category'] ?? '';
$date = $_POST['date'] ?? '';

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    echo json_encode(['error' => 'Invalid date format']);
    exit;
}

switch ($category) {
    case 'Output':
        $sql = "
            SELECT
                t.section,
                t.total AS target_output,
                ISNULL(a.total, 0) AS actual_output,
                (t.total - ISNULL(a.total, 0)) AS result
            FROM summary_backup t
            LEFT JOIN summary_backup a 
                ON t.section = a.section 
               AND t.[date] = a.[date]
               AND a.general_process = 'Actual Running Output'
            WHERE t.general_process = 'Target Output (WIP+Plan)'
              AND t.section <> 'Overall'
              AND t.[date] = ?
            ORDER BY t.section
        ";
        $params = [$date];
        break;

    case 'Machine Count':
        $sql = "
            SELECT 
                s.section,
                COUNT(DISTINCT s.section + '_' + CAST(s.machine_no AS VARCHAR)) AS machine_count,
                COUNT(DISTINCT CASE WHEN s.daily_result > 0 THEN s.section + '_' + CAST(s.machine_no AS VARCHAR) END) AS actual_machine,
                (
                    COUNT(DISTINCT s.section + '_' + CAST(s.machine_no AS VARCHAR)) -
                    COUNT(DISTINCT CASE WHEN s.daily_result > 0 THEN s.section + '_' + CAST(s.machine_no AS VARCHAR) END)
                ) AS result
            FROM section_backup s
            WHERE CAST(s.[date] AS DATE) = ?
            GROUP BY s.section
            ORDER BY s.section
        ";
        $params = [$date];
        break;

    case 'JPH':
        $sql = "
            SELECT
                t.section,
                t.total AS target_jph,
                a.total AS actual_jph,
                (t.total - a.total) AS result
            FROM summary_backup t
            JOIN summary_backup a 
                ON t.section = a.section 
               AND t.[date] = a.[date]
            WHERE t.general_process = 'Target JPH'
              AND a.general_process = 'Actual JPH'
              AND t.section <> 'Overall'
              AND t.[date] = ?
            ORDER BY t.section
        ";
        $params = [$date];
        break;

    case 'Actual WT':
    $sql = "
        SELECT
            section,
            ROUND(AVG(CAST(wt AS FLOAT)), 2) AS wt
        FROM section_backup
        WHERE
            details = 'Target Running Output'
            AND wt > 0
            AND [date] = ?
        GROUP BY section
        ORDER BY section
    ";
    $params = [$date];
    break;


    case 'WIP':
        $sql = "
            SELECT
                section,
                total AS wip
            FROM summary_backup
            WHERE general_process = 'WIP'
              AND section <> 'Overall'
              AND [date] = ?
            ORDER BY section
        ";
        $params = [$date];
        break;

    default:
        echo json_encode(['error' => 'Invalid category']);
        exit;
}

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(['error' => sqlsrv_errors()]);
    exit;
}

$data = [];

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

echo json_encode($data);
?>
