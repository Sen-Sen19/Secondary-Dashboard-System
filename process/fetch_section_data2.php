<?php
include 'conn.php';

$section = $_POST['section'] ?? null;
$shift = $_POST['shift'] ?? null;
$username = $_POST['username'] ?? null;

if (!$username) {
    echo json_encode(['error' => 'Username not provided.']);
    exit;
}

if (!$section || !$shift) {
    echo json_encode(['error' => 'Missing shift or section.']);
    exit;
}

$query = "
    SELECT *
    FROM [secondary_dashboard_db].[dbo].[section_page]
    WHERE section = ? AND shift = ?
      AND manpower IS NOT NULL AND manpower <> '' AND manpower <> '0'
    ORDER BY process ASC, machine_no ASC
";

$params = [$section, $shift];
$stmt = sqlsrv_query($conn, $query, $params);

$data = [];
if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
}

echo json_encode($data);
