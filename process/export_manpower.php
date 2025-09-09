<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=shot_count_export.csv');

include'conn.php'; // Make sure this connects to the right DB or has access to it

$output = fopen('php://output','w');

// CSV header row
fputcsv($output, ['ID','Full Name','Skill Level','Process', 'section', 'Machine No','Shift']);

// Query all data from the correct table
$sql = "SELECT emp_no, full_name, skill_level,'section', process, machine_no, shift

 FROM [secondary_dashboard_db].[dbo].[sp_shot_count]";
$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true)); // Show error if query fails
}

// Loop through and write each row to the CSV
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    fputcsv($output, [
        $row['emp_no'] ??'',
        $row['full_name'] ??'',
        $row['skill_level'] ??'',
        $row['section'] ??'',
        $row['process'] ??'',
        $row['machine_no'] ??'',
        $row['shift'] ??''

    ]);
}

fclose($output);
exit;
?>
