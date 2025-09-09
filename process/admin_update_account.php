<?php
include 'conn.php';

if (isset($_POST['username'], $_POST['newPassword'], $_POST['section'], $_POST['type'])) {

    $username = $_POST['username'];
    $newPassword = $_POST['newPassword'];

    $section = $_POST['section'];
    $type = $_POST['type'];

    if ($username !== 'admin') {
        $sql = "UPDATE account SET password = ?,  section = ?, type = ? WHERE username = ?";
        $params = array($newPassword, $section, $type, $username);


        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            $error_message = print_r(sqlsrv_errors(), true);
            http_response_code(500); 
            echo "Failed to update account. SQL Error: " . $error_message;
        } else {
            echo "Account updated successfully!";
        }
    } else {
        http_response_code(403); 
        echo "Error: You do not have permission to change the admin account.";
    }

    sqlsrv_close($conn);
} else {
    http_response_code(400); 
    echo "Error: Missing POST data.";
}
