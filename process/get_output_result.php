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

    $conditions[] = "[details] = 'Actual Running Output'";

    if (!empty($section)) {
        $conditions[] = "[section] = ?";
        $params[] = $section;
        $response['section'] = $section;
    }

    $processMap = [
'uv_iii' => 'UV-III',
'arc_welding' => 'Arc Welding',
'aluminum_coating_uv_ii' => 'Aluminum Coating UV II',
'servo_crimping' => 'Servo Crimping',
'ultrasonic_welding' => 'Ultrasonic Welding',
'cap_insertion' => 'Cap Insertion',
'twisting_primary_aluminum' => 'Twisting Primary Aluminum',
'twisting_secondary_aluminum' => 'Twisting Secondary Aluminum',
'airbag' => 'Airbag',
'a_b_sub_pc' => 'A/B Sub PC',
'manual_insertion_to_connector' => 'Manual Insertion to Connector',
'v_type_twisting' => 'V type twisting',
'twisting_primary' => 'Twisting Primary',
'twisting_secondary' => 'Twisting Secondary',
'manual_crimping_2tons' => 'Manual Crimping 2Tons',
'manual_crimping_4tons' => 'Manual Crimping 4Tons',
'manual_crimping_5tons' => 'Manual Crimping 5Tons',
'intermediate_ripping_uas_manual_nf_f' => 'Intermediate ripping(UAS)Manual-NF-F',
'intermediate_ripping_uas_joint' => 'Intermediate ripping (UAS)Joint stripping(KB10)',
'intermediate_stripping_kb10' => 'Intermediate stripping(KB10)',
'intermediate_stripping_kb10_nsc_weld' => 'Intermediatetripping(KB10)NSC/Weld',
'joint_crimping_2_tons' => 'Joint Crimping 2Tons',
'joint_crimping_4tons_ps_200' => 'Joint Crimping 4Tons(PS-200)',
'joint_crimping_5tons' => 'Joint Crimping 5Tons',
'manual_taping_dispenser' => 'Manual Taping (Dispenser)',
'joint_taping' => 'Joint Taping',
'intermediate_welding' => 'Intermediate Welding',
'intermediate_welding_0_13' => 'Intermediate Welding 0.13',
'welding_at_head' => 'Welding at Head',
'welding_at_head_0_13' => 'Welding at Head 0.13',
'silicon_injection' => 'Silicon Injection',
'welding_cap_insertion' => 'Welding Cap Insertion',
'welding_taping_13mm' => 'Welding Taping(13mm)',
'heat_shrink' => 'Heatshrink',
'heat_shrink_la_terminal' => 'Heat Shrink LA terminal',
'heat_shrink_joint_crimping' => 'Heat Shrink (Joint Crimping)',
'heat_shrink_welding' => 'Heat Shrink (Welding)',
'casting_c385' => 'Casting C385',
'stmac_shieldwire_nissan' => 'STMAC Shieldwire(Nissan)',
'quick_stripping' => 'Quick Stripping',
'manual_heat_shrink_blower_sumitube' => 'Manual Heat Shrink(Blower)Sumitube',
'drainwire_tip' => 'Drainwire Tip',
'manual_crimping_shieldwire' => 'Manual Crimping Shieldwire',
'joint_crimping_2_tons_sw' => 'Joint Crimping 2TonsSW',
'manual_blue_taping_dispenser_sw' => 'Manual Blue Taping(Dispenser)SW',
'shieldwire_taping' => 'Shieldwire Taping',
'hs_components_insertion_sw' => 'HS Components Insertion SW',
'heat_shrink_joint_crimping_sw' => 'Heat Shrink (Joint Crimping)SW',
'waterproof_pad_press' => 'Waterproof pad Press',
'low_viscosity' => 'Low Viscosity',
'air_water_leak_test' => 'Air/Water leak test',
'hirose' => 'HIROSE',
'casting_battery' => 'Casting Battery',
'stmac_aluminum' => 'STMACAluminum',
'manual_crimping_20tons' => 'Manual Crimping 20Tons',
'manual_heat_shrink_blower_battery' => 'Manual Heat Shrink (Blower)Battery',
'joint_crimping_20tons' => 'Joint Crimping 20Tons',
'dip_soldering_battery' => 'Dip Soldering (Battery)',
'ultrasonic_dip_soldering_aluminum' => 'Ultrasonic Dip SolderingAluminum',
'la_molding' => 'LA molding',
'pressure_welding_dome_lamp' => 'Pressure Welding(Dome Lamp)',
'ferrule_process' => 'Ferrule Process',
'gomusen_insertion' => 'Gomusen Insertion',
'point_marking' => 'Point Marking',


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
        FROM [secondary_dashboard_db].[dbo].[section_output]
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
