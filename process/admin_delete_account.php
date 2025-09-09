<?php
include 'conn.php';
header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['usernames']) || !is_array($data['usernames']) || empty($data['usernames'])) {
        throw new Exception("No valid usernames provided.");
    }

    $usernames = $data['usernames'];

    // Build placeholders for parameterized query
    $placeholders = implode(',', array_fill(0, count($usernames), '?'));

    // Prepare and execute the delete query
    $sql = "DELETE FROM [secondary_dashboard_db].[dbo].[account] WHERE username IN ($placeholders)";
    $stmt = sqlsrv_prepare($conn, $sql, $usernames);

    if ($stmt === false || !sqlsrv_execute($stmt)) {
        throw new Exception('Failed to delete from account: ' . print_r(sqlsrv_errors(), true));
    }

    echo json_encode(['message' => '✅ Accounts deleted successfully.']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => '❌ Error deleting data: ' . $e->getMessage()]);
} finally {
    sqlsrv_close($conn);
}
