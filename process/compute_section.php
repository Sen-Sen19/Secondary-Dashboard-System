<?php
ob_start();
include('conn.php');
header('Content-Type: application/json');

function respond($response) {
    ob_clean();
    echo json_encode($response);
    exit;
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $sql = "SELECT full_name FROM [secondary_dashboard_db].[dbo].[account] WHERE username = ?";
    $params = array($username);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        respond(["error" => sqlsrv_errors()]);
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($row) {
        $full_name = $row['full_name'];

        // Calculate and update Actual JPH
        $query = "SELECT [process], 
                    AVG(
                        CASE 
                            WHEN details = 'Actual JPH' THEN 
                                (([7]+[8]+[9]+[10]+[11]+[12]+[1]+[2]+[3]+[4]+[5]+[6])/
                                NULLIF(
                                    CASE WHEN [7] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [8] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [9] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [10] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [11] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [12] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [1] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [2] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [3] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [4] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [5] != 0 THEN 1 ELSE 0 END +
                                    CASE WHEN [6] != 0 THEN 1 ELSE 0 END,0)
                                )
                        END
                    ) AS average_jph
                  FROM [secondary_dashboard_db].[dbo].[section]
                  WHERE [manpower] = ?
                  GROUP BY [process]
                ";

        $stmt2 = sqlsrv_query($conn, $query, array($full_name));
        if ($stmt2 === false) {
            respond(["error" => sqlsrv_errors()]);
        }

        $data = [];
        while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row2;
        }

        foreach ($data as $row) {
            $process = $row['process'];
            $average_jph = round($row['average_jph'], 2);

            $updateQuery = "UPDATE [secondary_dashboard_db].[dbo].[section]
                            SET [daily_result] = ?
                            WHERE [process] = ? 
                              AND [manpower] = ? 
                              AND [details] = 'Actual JPH'";
            $updateParams = array($average_jph, $process, $full_name);
            $updateStmt = sqlsrv_query($conn, $updateQuery, $updateParams);
            if ($updateStmt === false) {
                respond(["error" => sqlsrv_errors()]);
            }
            sqlsrv_free_stmt($updateStmt);
        }

       
        $outputQuery = "SELECT [process], [7], [8], [9], [10], [11], [12], [1], [2], [3], [4], [5], [6]
                        FROM [secondary_dashboard_db].[dbo].[section]
                        WHERE [manpower] = ? AND [details] = 'Actual Running Output'";

        $stmt3 = sqlsrv_query($conn, $outputQuery, array($full_name));
        if ($stmt3 === false) {
            respond(["error" => sqlsrv_errors()]);
        }

        while ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
            $process = $row3['process'];
            $hourKeys = ['6','5','4','3','2','1','12','11','10','9','8','7'];
            $lastNonZero = 0;

            foreach ($hourKeys as $hour) {
                if (isset($row3[$hour]) && $row3[$hour] != 0) {
                    $lastNonZero = $row3[$hour];
                    break;
                }
            }

            $updateOutputQuery = "UPDATE [secondary_dashboard_db].[dbo].[section]
                                  SET [daily_result] = ?
                                  WHERE [process] = ? 
                                    AND [manpower] = ? 
                                    AND [details] = 'Actual Running Output'";
            $updateOutputParams = array($lastNonZero, $process, $full_name);
            $updateOutputStmt = sqlsrv_query($conn, $updateOutputQuery, $updateOutputParams);

            if ($updateOutputStmt === false) {
                respond(["error" => sqlsrv_errors()]);
            }

            sqlsrv_free_stmt($updateOutputStmt);
        }

        sqlsrv_free_stmt($stmt2);
        sqlsrv_free_stmt($stmt3);

        respond(["status" => "success", "message" => "Daily results updated successfully."]);
    } else {
        respond(["status" => "warning", "message" => "No full name found for this username."]);
    }

    sqlsrv_free_stmt($stmt);
} else {
    respond(["error" => "Username not provided!"]);
}
?>
