<?php
include('conn.php');

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'];
$newPlan = $data['newPlan'];

// Get client IP address
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Get current timestamp
$now = date('Y-m-d H:i:s');

// Update the plan, ip_address, and last_updated
$sql = "UPDATE [dbo].[plan] 
        SET [plan] = ?, 
            [ip_address] = ?, 
            [last_updated] = ?
        WHERE [product] = ?";
$params = array($newPlan, $ipAddress, $now, $productId);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Error updating the plan', 'error' => sqlsrv_errors()]);
} else {
    echo json_encode([
        'success' => true,
        'ip_address' => $ipAddress,
        'last_updated' => $now
    ]);
}

sqlsrv_close($conn);
?>
