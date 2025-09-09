<?php
include 'conn.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Step 1: Get the user's section
    $sectionQuery = "SELECT section FROM [secondary_dashboard_db].[dbo].[account] WHERE username = ?";
    $params = array($username);
    $sectionResult = sqlsrv_query($conn, $sectionQuery, $params);

    $userSection = null;

    if ($sectionResult && sqlsrv_fetch($sectionResult)) {
        $userSection = sqlsrv_get_field($sectionResult, 0);
    }

    // Step 2: Fetch rows with non-empty manpower and sort
    if ($userSection) {
        $dataQuery = "
            SELECT *
            FROM [secondary_dashboard_db].[dbo].[section_page]
            WHERE section = ? AND manpower IS NOT NULL AND manpower <> '' AND manpower <> '0'
            ORDER BY process, manpower,
                CASE nsds
                    WHEN 'Dayshift' THEN 1
                    WHEN 'Nightshift' THEN 2
                    ELSE 3
                END
        ";
        $dataResult = sqlsrv_query($conn, $dataQuery, array($userSection));

        $data = array();

        if ($dataResult) {
            while ($row = sqlsrv_fetch_array($dataResult, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Section not found for user."]);
    }
} else {
    echo json_encode(["error" => "Username not provided."]);
}
?>
