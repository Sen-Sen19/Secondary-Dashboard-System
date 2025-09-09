<?php
include 'conn.php';

header('Content-Type: application/json');

$response = [
    "section" => "All Sections",
    "process" => "All Processes",
    "shift" => "All Shifts",
    "startDate" => null,
    "endDate" => null,
    "data" => []
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $section = $_POST['section'] ?? '';
    $process = $_POST['process'] ?? '';
    $shift = $_POST['shift'] ?? '';
    $date = $_POST['date'] ?? '';

    if (!$date) {
        http_response_code(400);
        echo json_encode(["error" => "Date is required."]);
        exit;
    }

    $endDate = new DateTime($date);
    $startDate = clone $endDate;
    $startDate->modify('-6 days'); // 7 days total including $date

    $startDateStr = $startDate->format('Y-m-d');
    $endDateStr = $endDate->format('Y-m-d');

    $params = [];
    $conditions = [];

    $conditions[] = "CAST([date] AS DATE) BETWEEN ? AND ?";
    $params[] = $startDateStr;
    $params[] = $endDateStr;

    $conditions[] = "[details] = 'Actual JPH'";

    if (!empty($section)) {
        $conditions[] = "[section] = ?";
        $params[] = $section;
        $response['section'] = $section;
    }

    $processMap = [
        'iv_iii' => 'UV III',
        'arc_welding' => 'Arc Welding',
        'airbag' => 'Airbag',
        'joint_taping' => 'Joint Taping',
    ];
    if (!empty($process) && isset($processMap[$process])) {
        $conditions[] = "[process] = ?";
        $params[] = $processMap[$process];
        $response['process'] = $processMap[$process];
    }

    $shiftMap = [
        'dayshift' => 'Dayshift',
        'nightshift' => 'Nightshift',
    ];
    if (!empty($shift) && isset($shiftMap[$shift])) {
        $conditions[] = "[nsds] = ?";
        $params[] = $shiftMap[$shift];
        $response['shift'] = $shiftMap[$shift];
    }

    $whereClause = implode(" AND ", $conditions);

    $sql = "
        SELECT CAST([date] AS DATE) AS day, SUM([daily_result]) AS total_daily_result
        FROM [secondary_dashboard_db].[dbo].[section_backup]
        WHERE $whereClause
        GROUP BY CAST([date] AS DATE)
        ORDER BY day
    ";

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(["error" => "SQL Server query failed."]);
        exit;
    }

    // Initialize all dates with 0
    $resultsByDate = [];
    $currentDate = clone $startDate;
    while ($currentDate <= $endDate) {
        $resultsByDate[$currentDate->format('Y-m-d')] = 0;
        $currentDate->modify('+1 day');
    }

    // Fill results with DB data
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $dateKey = $row['day']->format('Y-m-d');
        $resultsByDate[$dateKey] = (int)($row['total_daily_result'] ?? 0);
    }

    // Build data array for JSON output
    $data = [];
    foreach ($resultsByDate as $day => $total) {
        $data[] = [
            "date" => $day,
            "total" => $total,
        ];
    }

    $response['startDate'] = $startDateStr;
    $response['endDate'] = $endDateStr;
    $response['data'] = $data;

    echo json_encode($response);
    exit;
}

// If not POST or missing data, return error JSON
http_response_code(400);
echo json_encode(["error" => "Invalid request method or missing parameters."]);

?>
