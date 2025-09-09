<?php
include('conn.php');

// Read raw POST data
$data = json_decode(file_get_contents("php://input"), true);
$username = isset($data['username']) ? strtoupper($data['username']) : null;

if (!$username) {
    echo json_encode(['error' => 'No username provided']);
    exit;
}

// Query DB for shift and section
$sql = "SELECT [shift], [section] FROM [secondary_dashboard_db].[dbo].[account] WHERE [username] = ?";
$params = array($username);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(['error' => 'Query failed', 'details' => sqlsrv_errors()]);
    exit;
}

if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo json_encode([
        'username' => $username,
        'shift' => $row['shift'],
        'section' => $row['section']
    ]);
} else {
    echo json_encode(['error' => 'No user found for this username']);
}
