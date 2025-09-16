<?php
include 'conn.php';

// -------------------------
// Get Filters
// -------------------------
$date     = $_GET['date'] ?? null;
$section  = $_GET['section'] ?? null;
$process  = $_GET['process'] ?? null;
$machines = $_GET['machine_no'] ?? null; // comma-separated
$shift    = $_GET['shift'] ?? null;

if (!$date) {
    echo json_encode([]);
    exit;
}

// Convert machines string to array
$machineArray = $machines ? explode(',', $machines) : [];
$machinesSelected = !empty($machineArray);

// -------------------------
// Build WHERE clause
// -------------------------
$params = [$date, $date]; // for 7-day range
$conditions = ["CAST([date] AS DATE) BETWEEN DATEADD(DAY, -6, ?) AND ?"];

if ($section) { $conditions[] = "section = ?"; $params[] = $section; }
if ($process) { $conditions[] = "process = ?"; $params[] = $process; }
if ($shift)   { $conditions[] = "nsds = ?"; $params[] = $shift; }
if ($machineArray) {
    $placeholders = implode(',', array_fill(0, count($machineArray), '?'));
    $conditions[] = "machine_no IN ($placeholders)";
    $params = array_merge($params, $machineArray);
}

$whereClause = "";
if (!empty($conditions)) {
    $whereClause = " AND " . implode(" AND ", $conditions);
}

// -------------------------
// Fetch Data
// -------------------------
$sql = "
SELECT 
    CAST([date] AS DATE) AS log_date,
    machine_no,
    details,
    daily_result AS value
FROM section_backup
WHERE details IN ('Actual JPH','Actual Running Output')
  $whereClause
ORDER BY log_date ASC, machine_no ASC
";

$stmt = sqlsrv_query($conn, $sql, $params);

$data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $d = $row['log_date']->format('Y-m-d');
    $machine = (string)$row['machine_no']; // <<< important: cast to string
    $detail = $row['details'];
    $val = (float)$row['value'];

    $data[$detail][$machine][$d] = $val;
}

// -------------------------
// Prepare Dates Array (7-day window)
// -------------------------
$dates = [];
$start = new DateTime($date);
for ($i = 6; $i >= 0; $i--) {
    $curr = clone $start;
    $curr->modify("-$i days");
    $dates[] = $curr->format('Y-m-d');
}

// -------------------------
// Build Series
// -------------------------
$result = [];
foreach (['Actual JPH','Actual Running Output'] as $detail) {
    $series = [];

    if (isset($data[$detail])) {
        ksort($data[$detail]); // sort machines ascending
    }

    // TOTAL row only if no machines selected
    if (!$machinesSelected) {
        $total = [];
        foreach ($dates as $d) {
            $sum = $count = 0;
            foreach ($data[$detail] ?? [] as $machine => $vals) {
                if (isset($vals[$d])) {
                    $sum += $vals[$d];
                    $count++;
                }
            }
            if ($detail === 'Actual JPH') {
                $total[] = $count ? round($sum / $count, 2) : 0;
            } else {
                $total[] = $sum;
            }
        }
        $series[] = ['machine' => 'TOTAL', 'values' => $total];
    }

    // Individual machines
    foreach ($data[$detail] ?? [] as $machine => $vals) {
        $valsArr = [];
        foreach ($dates as $d) {
            $valsArr[] = $vals[$d] ?? 0;
        }
        $series[] = ['machine' => $machine, 'values' => $valsArr];
    }

    $result[$detail] = $series;
}

// -------------------------
// Output JSON
// -------------------------
echo json_encode([
    'dates' => $dates,
    'actual_jph' => $result['Actual JPH'] ?? [],
    'actual_output' => $result['Actual Running Output'] ?? []
], JSON_NUMERIC_CHECK); // ensures numbers stay numeric
?>
