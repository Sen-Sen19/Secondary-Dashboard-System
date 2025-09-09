<?php
include('conn.php');
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(json_encode(["error" => sqlsrv_errors()]));
}

// Get POST data
$emp_no = $_POST['emp_no'] ?? '';
$full_name = $_POST['full_name'] ?? '';
$skill_level = $_POST['skill_level'] ?? '';
$section = $_POST['section'] ?? '';
$machine_no = $_POST['machine_no'] ?? '';
$process = $_POST['process'] ?? '';

if (!$emp_no || !$full_name || !$skill_level || !$section || !$machine_no || !$process) {
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

// 1. Insert into manpower
$sql = "INSERT INTO [dbo].[manpower] 
        (emp_no, full_name, skill_level, section, machine_no, process)
        VALUES (?, ?, ?, ?, ?, ?)";
$params = [$emp_no, $full_name, $skill_level, $section, $machine_no, $process];
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(["error" => sqlsrv_errors()]);
    exit;
}

// 2. Update matching section row
// First, get the existing manpower string if it exists
$checkSql = "SELECT [manpower] FROM [secondary_dashboard_db].[dbo].[section]
             WHERE [section] = ? AND [process] = ? AND [machine_no] = ?";
$checkParams = [$section, $process, $machine_no];
$checkStmt = sqlsrv_query($conn, $checkSql, $checkParams);

if ($checkStmt === false) {
    echo json_encode(["error" => sqlsrv_errors()]);
    exit;
}

$row = sqlsrv_fetch_array($checkStmt, SQLSRV_FETCH_ASSOC);
if ($row) {
    // Append full_name to existing manpower list
    $currentManpower = $row['manpower'];
    $newManpower = $currentManpower ? $currentManpower . ', ' . $full_name : $full_name;

    // Update manpower and skill_level
    $updateSql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                  SET [manpower] = ?, [skill_level] = ?
                  WHERE [section] = ? AND [process] = ? AND [machine_no] = ?";
    $updateParams = [$newManpower, $skill_level, $section, $process, $machine_no];
    $updateStmt = sqlsrv_query($conn, $updateSql, $updateParams);

    if ($updateStmt === false) {
        echo json_encode(["error" => sqlsrv_errors()]);
        exit;
    }
}

echo json_encode(["success" => true]);
?>
