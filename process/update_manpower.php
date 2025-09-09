<?php
// Show errors (for debugging; remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'conn.php';

// Force JSON response
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capture POST data
    $emp_no = $_POST['emp_no'];
    $new_section = $_POST['new_section'];
    $new_process = $_POST['new_process'];
    $machine_no = $_POST['machine_no'];

    $original_section = $_POST['original_section'];
    $original_process = $_POST['original_process'];

    // Validate required fields
    if (empty($emp_no) || empty($original_section) || empty($original_process)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing required fields.'
        ]);
        exit();
    }

    // Begin a transaction
    sqlsrv_begin_transaction($conn);

    try {
        // 1. Set the original section/process/machine_no to 0 for manpower and skill_level
        $resetSql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                     SET [manpower] = '0', [skill_level] = '0'
                     WHERE [section] = ? AND [process] = ? AND [machine_no] = ?";
        $resetParams = [$original_section, $original_process, $machine_no];
        $resetStmt = sqlsrv_query($conn, $resetSql, $resetParams);

        if ($resetStmt === false) {
            throw new Exception('Error resetting original section/process.');
        }

        // 2. Update the manpower record
        $updateSql = "UPDATE [secondary_dashboard_db].[dbo].[manpower]
                      SET [section] = ?, [process] = ?, [machine_no] = ?
                      WHERE [emp_no] = ? AND [section] = ? AND [process] = ?";
        $updateParams = [$new_section, $new_process, $machine_no, $emp_no, $original_section, $original_process];
        $updateStmt = sqlsrv_query($conn, $updateSql, $updateParams);

        if ($updateStmt === false) {
            throw new Exception('Error updating manpower record.');
        }

        $getManpowerSql = "SELECT [full_name], [skill_level] FROM [dbo].[manpower]
                           WHERE [emp_no] = ?";
        $getManpowerParams = [$emp_no];
        $getManpowerStmt = sqlsrv_query($conn, $getManpowerSql, $getManpowerParams);

        if ($getManpowerStmt === false) {
            throw new Exception('Error fetching manpower data.');
        }

        $manpowerData = sqlsrv_fetch_array($getManpowerStmt, SQLSRV_FETCH_ASSOC);
        $full_name = $manpowerData['full_name'];
        $skill_level = $manpowerData['skill_level'];

        $updateSectionSql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                             SET [manpower] = ?, [skill_level] = ?
                             WHERE [section] = ? AND [process] = ? AND [machine_no] = ?";
        $updateSectionParams = [$full_name, $skill_level, $new_section, $new_process, $machine_no];
        $updateSectionStmt = sqlsrv_query($conn, $updateSectionSql, $updateSectionParams);

        if ($updateSectionStmt === false) {
            throw new Exception('Error updating new section with manpower data.');
        }

        // Commit the transaction if everything is successful
        sqlsrv_commit($conn);

        echo json_encode([
            'status' => 'success',
            'message' => 'Manpower record successfully updated.'
        ]);
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        sqlsrv_rollback($conn);

        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    } finally {
        // Clean up
        if (isset($resetStmt)) sqlsrv_free_stmt($resetStmt);
        if (isset($updateStmt)) sqlsrv_free_stmt($updateStmt);
        if (isset($getManpowerStmt)) sqlsrv_free_stmt($getManpowerStmt);
        if (isset($updateSectionStmt)) sqlsrv_free_stmt($updateSectionStmt);
        sqlsrv_close($conn);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
}
?>
