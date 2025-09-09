<?php
include 'conn.php';

$date     = $_GET['date'] ?? null;
$section  = $_GET['section'] ?? null;
$process  = $_GET['process'] ?? null;
$machine  = $_GET['machine_no'] ?? null;
$shift    = $_GET['shift'] ?? null;

if (!$date) {
    echo json_encode([]);
    exit;
}

// ✅ Build WHERE conditions
$params = [];
$conditions = [];

$conditions[] = "CAST([date] AS DATE) BETWEEN DATEADD(DAY, -6, ?) AND ?";
$params[] = $date;
$params[] = $date;

if ($section) { $conditions[] = "section = ?"; $params[] = $section; }
if ($process) { $conditions[] = "process = ?"; $params[] = $process; }
if ($machine) { $conditions[] = "machine_no = ?"; $params[] = $machine; }
if ($shift)   { $conditions[] = "nsds = ?"; $params[] = $shift; }

$whereClause = " AND " . implode(" AND ", $conditions);

// ✅ Query: Average per machine per day (for JPH) and Sum for Output
$sql = "
WITH MachineDaily AS (
    SELECT 
        CAST([date] AS DATE) AS log_date,
        details,
        machine_no,
        AVG(daily_result) AS machine_avg
    FROM section_backup
    WHERE details IN ('Actual JPH', 'Actual Running Output')
      $whereClause
    GROUP BY CAST([date] AS DATE), details, machine_no
)
SELECT 
    log_date,
    details,
    CASE 
        WHEN details = 'Actual JPH' THEN AVG(machine_avg)   -- ✅ JPH averaged
        ELSE SUM(machine_avg)                               -- ✅ Output summed
    END AS avg_val
FROM MachineDaily
GROUP BY log_date, details
ORDER BY log_date ASC
";

// ✅ Execute query
$stmt = sqlsrv_query($conn, $sql, $params);

// ✅ Organize data
$data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $d = $row['log_date']->format('Y-m-d');
    if (!isset($data[$d])) {
        $data[$d] = ['Actual JPH' => 0, 'Actual Running Output' => 0];
    }
   $data[$d][$row['details']] = round((float)$row['avg_val'], 2);

}

// ✅ Prepare arrays for chart
$dates = [];
$actual_jph = [];
$actual_output = [];

$start = new DateTime($date);
for ($i = 6; $i >= 0; $i--) {
    $curr = clone $start;
    $curr->modify("-$i days");
    $day = $curr->format('Y-m-d');

    $dates[] = $day;
    $actual_jph[] = $data[$day]['Actual JPH'] ?? 0;
    $actual_output[] = $data[$day]['Actual Running Output'] ?? 0;
}

// ✅ Return JSON response
echo json_encode([
    'dates' => $dates,
    'actual_jph' => $actual_jph,
    'actual_output' => $actual_output
]);
?>
