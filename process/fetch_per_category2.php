<?php

include 'conn.php';

$category = $_POST['category'] ?? '';
$data = [];

switch ($category) {
    case 'Output':
        $sql = "
            SELECT
                t.section,
                t.total AS target_output,
                a.total AS actual_output,
                (t.total - a.total) AS result
            FROM summary t
            JOIN summary a ON t.section = a.section
            WHERE t.general_process = 'Target Output (WIP+Plan)'
              AND a.general_process = 'Actual Output'
              AND t.section <> 'Overall'
            ORDER BY t.section
        ";
        break;

    case 'Machine Count':
        $sql = "
            SELECT
                t.section,
                t.total AS machine_count,
                a.total AS actual_machine,
                (t.total - a.total) AS result
            FROM summary t
            JOIN summary a ON t.section = a.section
            WHERE t.general_process = 'Calculated Machine Count'
              AND a.general_process = 'Actual Machine Count'
              AND t.section <> 'Overall'
            ORDER BY t.section
        ";
        break;

    case 'JPH':
        $sql = "
            SELECT
                t.section,
                t.total AS target_jph,
                a.total AS actual_jph,
                (t.total - a.total) AS result
            FROM summary t
            JOIN summary a ON t.section = a.section
            WHERE t.general_process = 'Target JPH'
              AND a.general_process = 'Actual JPH'
              AND t.section <> 'Overall'
            ORDER BY t.section
        ";
        break;

    case 'Actual WT':
        $sql = "
            SELECT
                section,
                total AS actual_wt
            FROM summary
            WHERE general_process = 'Actual WT'
              AND section <> 'Overall'
            ORDER BY section
        ";
        break;

    case 'WIP':
        $sql = "
            SELECT
                section,
                total AS wip
            FROM summary
            WHERE general_process = 'WIP'
              AND section <> 'Overall'
            ORDER BY section
        ";
        break;

    default:
        echo json_encode(['error' => 'Invalid category']);
        exit;
}

$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    echo json_encode(['error' => sqlsrv_errors()]);
    exit;
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

echo json_encode($data);
?>
