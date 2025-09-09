<?php
include 'conn.php'; // Include the database connection

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['updates']) && !empty($data['updates'])) {
    $needsRecalculation7and8 = false;
    $needsRecalculation8and9 = false;
    $needsRecalculation9and10 = false;
    $needsRecalculation10and11 = false;
    $needsRecalculation11and12 = false;
    $needsRecalculation12and1 = false;
    $needsRecalculation1and2 = false;
    $needsRecalculation2and3 = false;
    $needsRecalculation3and4 = false;
    $needsRecalculation4and5 = false;
    $needsRecalculation5and6 = false;
    $recalculationProcess = null;
    $recalculationManpower = null;


    
    foreach ($data['updates'] as $update) {
        $field = $update['field'];
        $value = $update['value'];
        $process = $update['process'];
        $manpower = $update['manpower'];

        // Prepare SQL query based on the field
        if ($field === 'machine_no') {
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] SET [machine_no] = ? WHERE [process] = ? AND [manpower] = ?";
        } elseif ($field === 'specifications') {
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] SET [specifications] = ? WHERE [process] = ? AND [manpower] = ?";
        } elseif ($field === 'skill_level') {
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] SET [skill_level] = ? WHERE [process] = ? AND [manpower] = ?";
        } elseif ($field === 'target_jph') {
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] SET [target_jph] = ? WHERE [process] = ? AND [manpower] = ?";
        } elseif ($field === 'target_output') {
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] SET [target_output] = ? WHERE [process] = ? AND [manpower] = ?";
        } elseif ($field === '7') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [7] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        
            // Add query to copy the value from 'Actual JPH' to 'Actual Running Output'
            $copy_sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                         SET [7] = ? 
                         WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";    
        }
        
        elseif ($field === '8') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [8] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        } elseif ($field === '9') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [9] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '10') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [10] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '11') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [11] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '12') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [12] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '1') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [1] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '2') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [2] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '3') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [3] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '4') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [4] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '5') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [5] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        elseif ($field === '6') {  
            $sql = "UPDATE [secondary_dashboard_db].[dbo].[section] 
                    SET [6] = ? 
                    WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual JPH'";    
        }
        else {
            continue;
        }

        $params = [$value, $process, $manpower];
        $stmt = sqlsrv_prepare($conn, $sql, $params);

        if (!$stmt || !sqlsrv_execute($stmt)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()])); 
        }

        if ($field === '7' || $field === '8') {
            $needsRecalculation7and8 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '8' || $field === '9') {
            $needsRecalculation8and9 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '9' || $field === '10') {
            $needsRecalculation9and10 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '10' || $field === '11') {
            $needsRecalculation10and11 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '11' || $field === '12') {
            $needsRecalculation11and12 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '12' || $field === '1') {
            $needsRecalculation12and1 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '1' || $field === '2') {
            $needsRecalculation1and2 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '2' || $field === '3') {
            $needsRecalculation2and3 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '3' || $field === '4') {
            $needsRecalculation3and4 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
        }
        if ($field === '4' || $field === '5') {
            $needsRecalculation4and5 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;

        if ($field === '5' || $field === '6') {
            $needsRecalculation5and6 = true;
            $recalculationProcess = $process;
            $recalculationManpower = $manpower;
            }
        }
    }

    if ($field === '7') {
        $stmt_copy = sqlsrv_prepare($conn, $copy_sql, $params);
        if (!$stmt_copy || !sqlsrv_execute($stmt_copy)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }

    
    if ($needsRecalculation7and8 && $recalculationProcess && $recalculationManpower) {
        $sum7and8_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                         SET [8] = (
                             SELECT ISNULL(a.[7], 0) + ISNULL(b.[8], 0)
                             FROM [secondary_dashboard_db].[dbo].[section] a
                             JOIN [secondary_dashboard_db].[dbo].[section] b
                               ON a.[process] = b.[process]
                              AND a.[manpower] = b.[manpower]
                             WHERE a.[details] = 'Actual Running Output'
                               AND b.[details] = 'Actual JPH'
                               AND a.[process] = ?
                               AND a.[manpower] = ?
                         )
                         WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";

        $stmt_sum7and8 = sqlsrv_prepare($conn, $sum7and8_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);

        if (!$stmt_sum7and8 || !sqlsrv_execute($stmt_sum7and8)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()])); 
        }
    }

    if ($needsRecalculation8and9 && $recalculationProcess && $recalculationManpower) {
        $sum8and9_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                         SET [9] = (
                             SELECT ISNULL(a.[8], 0) + ISNULL(b.[9], 0)
                             FROM [secondary_dashboard_db].[dbo].[section] a
                             JOIN [secondary_dashboard_db].[dbo].[section] b
                               ON a.[process] = b.[process]
                              AND a.[manpower] = b.[manpower]
                             WHERE a.[details] = 'Actual Running Output'
                               AND b.[details] = 'Actual JPH'
                               AND a.[process] = ?
                               AND a.[manpower] = ?
                         )
                         WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";

        $stmt_sum8and9 = sqlsrv_prepare($conn, $sum8and9_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);

        if (!$stmt_sum8and9 || !sqlsrv_execute($stmt_sum8and9)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()])); 
        }
    }


    if ($needsRecalculation9and10 && $recalculationProcess && $recalculationManpower) {
        $sum9and10_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [10] = (
                              SELECT ISNULL(a.[9], 0) + ISNULL(b.[10], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum9and10 = sqlsrv_prepare($conn, $sum9and10_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum9and10 || !sqlsrv_execute($stmt_sum9and10)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }

    if ($needsRecalculation10and11 && $recalculationProcess && $recalculationManpower) {
        $sum10and11_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [11] = (
                              SELECT ISNULL(a.[10], 0) + ISNULL(b.[11], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum10and11 = sqlsrv_prepare($conn, $sum10and11_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum10and11 || !sqlsrv_execute($stmt_sum10and11)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }
    

    if ($needsRecalculation11and12 && $recalculationProcess && $recalculationManpower) {
        $sum11and12_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [12] = (
                              SELECT ISNULL(a.[11], 0) + ISNULL(b.[12], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum11and12 = sqlsrv_prepare($conn, $sum11and12_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum11and12 || !sqlsrv_execute($stmt_sum11and12)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }


    
    if ($needsRecalculation12and1 && $recalculationProcess && $recalculationManpower) {
        $sum12and1_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [1] = (
                              SELECT ISNULL(a.[12], 0) + ISNULL(b.[1], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum12and1 = sqlsrv_prepare($conn, $sum12and1_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum12and1 || !sqlsrv_execute($stmt_sum12and1)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }

    if ($needsRecalculation1and2 && $recalculationProcess && $recalculationManpower) {
        $sum1and2_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [2] = (
                              SELECT ISNULL(a.[1], 0) + ISNULL(b.[2], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum1and2 = sqlsrv_prepare($conn, $sum1and2_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum1and2 || !sqlsrv_execute($stmt_sum1and2)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }
    


    if ($needsRecalculation2and3 && $recalculationProcess && $recalculationManpower) {
        $sum2and3_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [3] = (
                              SELECT ISNULL(a.[2], 0) + ISNULL(b.[3], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum2and3 = sqlsrv_prepare($conn, $sum2and3_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum2and3 || !sqlsrv_execute($stmt_sum2and3)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }
    

    

    if ($needsRecalculation3and4 && $recalculationProcess && $recalculationManpower) {
        $sum3and4_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [4] = (
                              SELECT ISNULL(a.[3], 0) + ISNULL(b.[4], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum3and4 = sqlsrv_prepare($conn, $sum3and4_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum3and4 || !sqlsrv_execute($stmt_sum3and4)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }
    


    
    if ($needsRecalculation4and5 && $recalculationProcess && $recalculationManpower) {
        $sum4and5_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [5] = (
                              SELECT ISNULL(a.[4], 0) + ISNULL(b.[5], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum4and5 = sqlsrv_prepare($conn, $sum4and5_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum4and5 || !sqlsrv_execute($stmt_sum4and5)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }

    
    
    if ($needsRecalculation5and6 && $recalculationProcess && $recalculationManpower) {
        $sum5and6_sql = "UPDATE [secondary_dashboard_db].[dbo].[section]
                          SET [6] = (
                              SELECT ISNULL(a.[5], 0) + ISNULL(b.[6], 0)
                              FROM [secondary_dashboard_db].[dbo].[section] a
                              JOIN [secondary_dashboard_db].[dbo].[section] b
                                ON a.[process] = b.[process]
                               AND a.[manpower] = b.[manpower]
                              WHERE a.[details] = 'Actual Running Output'
                                AND b.[details] = 'Actual JPH'
                                AND a.[process] = ?
                                AND a.[manpower] = ?
                          )
                          WHERE [process] = ? AND [manpower] = ? AND [details] = 'Actual Running Output'";
    
        $stmt_sum5and6 = sqlsrv_prepare($conn, $sum5and6_sql, [
            $recalculationProcess, $recalculationManpower,
            $recalculationProcess, $recalculationManpower
        ]);
    
        if (!$stmt_sum5and6 || !sqlsrv_execute($stmt_sum5and6)) {
            die(json_encode(['success' => false, 'error' => sqlsrv_errors()]));
        }
    }

    
    


    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'No updates provided']);
}
?>
