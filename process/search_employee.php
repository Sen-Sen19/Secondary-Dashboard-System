<?php

$serverName = "172.25.116.188";
$connectionOptions = array(
    "Database" => "emp_mgt_db",
    "Uid" => "sa",
    "PWD" => "SystemGroup@2022"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(json_encode(["error" => sqlsrv_errors()]));
}

$emp_no = $_GET['emp_no'] ?? '';

if (!$emp_no) {
    echo json_encode(["error" => "Missing emp_no"]);
    exit;
}

// Query for full name
$sql1 = "SELECT full_name FROM [dbo].[m_employees] WHERE emp_no = ?";
$stmt1 = sqlsrv_query($conn, $sql1, [$emp_no]);

$full_name = null;
if ($stmt1 && sqlsrv_fetch($stmt1)) {
    $full_name = sqlsrv_get_field($stmt1, 0);
}

// Query for skill level
$sql2 = "SELECT skill_level FROM [dbo].[m_skill_level] WHERE emp_no = ?";
$stmt2 = sqlsrv_query($conn, $sql2, [$emp_no]);

$skill_level = null;
if ($stmt2 && sqlsrv_fetch($stmt2)) {
    $skill_level = sqlsrv_get_field($stmt2, 0);
}

echo json_encode([
    "fullname" => $full_name,
    "skill_level" => $skill_level
]);
?>
