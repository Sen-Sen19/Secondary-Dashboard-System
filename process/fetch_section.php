<?php
include('conn.php');

$query = "SELECT DISTINCT section FROM [secondary_dashboard_db].[dbo].[sp_shot_count] ORDER BY section ASC";
$result = sqlsrv_query($conn, $query);

$sections = [];
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $sections[] = $row['section'];
}

echo json_encode($sections);
?>
