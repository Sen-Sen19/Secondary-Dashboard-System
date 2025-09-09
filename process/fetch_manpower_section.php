<?php
include 'conn.php';

// Check if the username is provided via POST
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Step 1: Get the user's section from the account table
    $sectionQuery = "SELECT section FROM [secondary_dashboard_db].[dbo].[account] WHERE username = ?";
    $sectionResult = sqlsrv_query($conn, $sectionQuery, array($username));

    $userSection = null;

    if ($sectionResult && sqlsrv_fetch($sectionResult)) {
        $userSection = sqlsrv_get_field($sectionResult, 0);
    }

    // Step 2: Fetch manpower data if section is found
    if ($userSection) {
        $dataQuery = "
            SELECT TOP (1000) [emp_no], [full_name], [skill_level], [section], [machine_no], [process]
            FROM [secondary_dashboard_db].[dbo].[manpower]
            WHERE section = ?
        ";

        $dataResult = sqlsrv_query($conn, $dataQuery, array($userSection));

        $data = array();

        if ($dataResult) {
            while ($row = sqlsrv_fetch_array($dataResult, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "Failed to fetch manpower data."]);
        }
    } else {
        echo json_encode(["error" => "Section not found for user."]);
    }
} else {
    echo json_encode(["error" => "Username not provided."]);
}
?>
