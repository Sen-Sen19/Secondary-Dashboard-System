<?php
include 'conn.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } else if (is_string($mixed)) {
        return mb_convert_encoding($mixed, 'UTF-8', 'UTF-8');
    }
    return $mixed;
}

// Get 'section' from GET params if exists
$section = isset($_GET['section']) ? trim($_GET['section']) : '';
$shift = isset($_GET['shift']) ? trim($_GET['shift']) : '';

$sql = "SELECT [emp_no], [full_name], [skill_level], [section], [process], [machine_no], [shift]
        FROM [secondary_dashboard_db].[dbo].[manpower]";
$params = [];

$conditions = [];
if ($section !== '') {
    $conditions[] = "[section] = ?";
    $params[] = $section;
}
if ($shift !== '') {
    $conditions[] = "[shift] = ?";
    $params[] = $shift;
}
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}
$sql .= " ORDER BY [section] ASC";

// Prepare and execute statement with parameters if any
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    $errors = sqlsrv_errors();
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "SQL query failed", "details" => $errors]);
    exit;
}

$data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

$data = utf8ize($data);

$response = [
    "success" => true,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($response);

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
