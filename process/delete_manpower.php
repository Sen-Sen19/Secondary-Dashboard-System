<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emp_no = $_POST['emp_no'];
    $original_section = $_POST['original_section'];
    $original_process = $_POST['original_process'];

    // Validate if the original section and process are provided
    if (empty($emp_no) || empty($original_section) || empty($original_process)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
        exit();
    }

    // Begin a transaction
    sqlsrv_begin_transaction($conn);

    try {
        // 1. Delete the employee from the [manpower] table
        $deleteSql = "DELETE FROM [secondary_dashboard_db].[dbo].[manpower]
                      WHERE [emp_no] = ? AND [section] = ? AND [process] = ?";
        $deleteParams = [$emp_no, $original_section, $original_process];
        $deleteStmt = sqlsrv_query($conn, $deleteSql, $deleteParams);

        if ($deleteStmt === false) {
            throw new Exception('Error deleting employee from manpower.');
        }

        // 2. Reset the manpower and skill_level in the [section] table
        $resetSql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                     SET [manpower] = '0', [skill_level] = '0'
                     WHERE [section] = ? AND [process] = ?";
        $resetParams = [$original_section, $original_process];
        $resetStmt = sqlsrv_query($conn, $resetSql, $resetParams);

        if ($resetStmt === false) {
            throw new Exception('Error resetting manpower and skill_level in section.');
        }

        // Commit the transaction
        sqlsrv_commit($conn);

        echo json_encode(['status' => 'success', 'message' => 'Employee deleted and section updated.']);
    } catch (Exception $e) {
        // Rollback the transaction if there's an error
        sqlsrv_rollback($conn);

        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        // Clean up
        if (isset($deleteStmt)) sqlsrv_free_stmt($deleteStmt);
        if (isset($resetStmt)) sqlsrv_free_stmt($resetStmt);
        sqlsrv_close($conn);
    }
}
?>
