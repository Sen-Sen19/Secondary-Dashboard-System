<?php

require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $section  = $_POST['section'];
    $password = $_POST['password']; 
    $type     = $_POST['type'];
    $shift    = $_POST['shift']; // ✅ Add shift

    $sql = "INSERT INTO account (username, section, password, type, shift) 
            VALUES (?, ?, ?, ?, ?)"; // ✅ Add shift to SQL

    $params = array($username, $section, $password, $type, $shift); // ✅ Add shift to params
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false || sqlsrv_execute($stmt) === false) {
        echo "❌ Account insert error: " . print_r(sqlsrv_errors(), true);
        exit;
    }

    echo "✅ Account created successfully!";
}
?>
