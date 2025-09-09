<?php
include 'conn.php';
header('Content-Type: application/json');

// Get username from GET parameter
$username = $_GET['username'] ?? null;

if (!$username) {
    echo json_encode(['error' => 'Username missing']);
    exit;
}

// Step 1: Get user's section and shift
$sqlUser = "SELECT TOP 1 [section], [shift] FROM [secondary_dashboard_db].[dbo].[account] WHERE [username] = ?";
$paramsUser = [$username];
$stmtUser = sqlsrv_query($conn, $sqlUser, $paramsUser);

if ($stmtUser === false || ($userRow = sqlsrv_fetch_array($stmtUser, SQLSRV_FETCH_ASSOC)) === false) {
    echo json_encode(['error' => 'User not found']);
    exit;
}

$userSection = $userRow['section'] ?? '';
$userShift = $userRow['shift'] ?? '';

if (!$userSection || !$userShift) {
    echo json_encode(['error' => 'Section or Shift missing for user']);
    exit;
}

// Extract just the number from "Section 1" => "1"
$userSectionNumber = trim(str_replace('Section', '', $userSection));

// Step 2: Fetch plans matching both section and shift
$sqlPlan = "SELECT [main_product], [product], [plan], [section], [block], [ip_address], [last_updated]
            FROM [secondary_dashboard_db].[dbo].[plan]
            WHERE [section] = ? AND [shift] = ?";
$paramsPlan = [$userSectionNumber, $userShift];
$stmtPlan = sqlsrv_query($conn, $sqlPlan, $paramsPlan);

$data = [];

if ($stmtPlan !== false) {
    while ($row = sqlsrv_fetch_array($stmtPlan, SQLSRV_FETCH_ASSOC)) {
        if ($row['last_updated'] instanceof DateTime) {
            $row['last_updated'] = $row['last_updated']->format('Y-m-d H:i:s');
        }
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Plan query failed']);
}
?>
