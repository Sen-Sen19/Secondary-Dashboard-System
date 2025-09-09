<?php

session_start();
$username = $_SESSION['username'] ?? null; // Or however you store username
header('Content-Type: application/json');
include 'conn.php';

// Assume you already know who's logged in. 
// (Maybe via SESSION, COOKIE, or hardcode for now for testing?)

// For quick testing: $username = 'testuser';
if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'Session username missing', 'session' => $_SESSION]);
    exit;
}

$sql = "SELECT TOP 1 [emp_id], [username], [password], [full_name], [section], [type]
        FROM [secondary_dashboard_db].[dbo].[account]
        WHERE [username] = ?";

$params = [$username];
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt !== false && ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'User not found']);
}
?>
