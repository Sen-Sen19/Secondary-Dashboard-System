<?php
include 'conn.php';

// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get parameters with defaults
$section = $_GET['section'] ?? 'Overall';
$type = $_GET['type'] ?? 'output';
$date = $_GET['date'] ?? date('Y-m-d');

// Debug logging
error_log("fetch_gap.php called with section=$section, type=$type, date=$date");

// Build WHERE clause
if ($section === 'Overall') {
    $sectionFilter = "WHERE [date] = ?";
    $params = [$date];
} else {
    $sectionFilter = "WHERE [section] = ? AND [date] = ?";
    $params = [$section, $date];
}

// SQL query
$sql = "
 SELECT general_process,
       uv_iii,
       arc_welding,
       aluminum_coating_uv_ii,
       servo_crimping,
       ultrasonic_welding,
       cap_insertion,
       twisting_primary_aluminum,
       twisting_secondary_aluminum,
       airbag,
       a_b_sub_pc,
       manual_insertion_to_connector,
       v_type_twisting,
       twisting_primary,
       twisting_secondary,
       manual_crimping_2tons,
       manual_crimping_4tons,
       manual_crimping_5tons,
       intermediate_ripping_uas_manual_nf_f,
       intermediate_ripping_uas_joint,
       intermediate_stripping_kb10,
       intermediate_stripping_kb10_nsc_weld,
       joint_crimping_2_tons,
       joint_crimping_4tons_ps_200,
       joint_crimping_5tons,
       manual_taping_dispenser,
       joint_taping,
       intermediate_welding,
       intermediate_welding_0_13,
       welding_at_head,
       welding_at_head_0_13,
       silicon_injection,
       welding_cap_insertion,
       welding_taping_13mm,
       heat_shrink,
       heat_shrink_la_terminal,
       heat_shrink_joint_crimping,
       heat_shrink_welding,
       casting_c385,
       stmac_shieldwire_nissan,
       quick_stripping,
       manual_heat_shrink_blower_sumitube,
       drainwire_tip,
       manual_crimping_shieldwire,
       joint_crimping_2_tons_sw,
       manual_blue_taping_dispenser_sw,
       shieldwire_taping,
       hs_components_insertion_sw,
       heat_shrink_joint_crimping_sw,
       waterproof_pad_press,
       low_viscosity,
       air_water_leak_test,
       hirose,
       casting_battery,
       stmac_aluminum,
       manual_crimping_20tons,
       manual_heat_shrink_blower_battery,
       joint_crimping_20tons,
       dip_soldering_battery,
       ultrasonic_dip_soldering_aluminum,
       la_molding,
       pressure_welding_dome_lamp,
       ferrule_process,
       gomusen_insertion
  FROM secondary_dashboard_db.dbo.summary_backup
  $sectionFilter
";

// Prepare and execute statement
$stmt = sqlsrv_query($conn, $sql, $params);

if (!$stmt) {
    http_response_code(500);
    $errors = sqlsrv_errors();
    error_log("SQL error: " . print_r($errors, true));
    echo json_encode(['error' => 'Query failed', 'details' => $errors]);
    exit;
}

$source1 = $source2 = [];
$hasData = false;

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $hasData = true;
    $gp = trim(strtolower($row['general_process']));

    if ($type === 'output') {
        if ($gp === 'plan output per day') $source1 = $row;
        if ($gp === 'target jph') $source2 = $row;
    } elseif ($type === 'actual') {
        if ($gp === 'actual wt') $source1 = $row;
    } elseif ($type === 'jph') {   // ✅ NEW LOGIC
        if ($gp === 'target jph') $source1 = $row;
        if ($gp === 'actual jph') $source2 = $row;
    }
}

if (!$hasData || (empty($source1) && ($type !== 'actual' || empty($source2)))) {
    http_response_code(404);
    echo json_encode(['error' => 'No data found for the given section and date']);
    exit;
}

$processes = [
    'uv_iii',
    'arc_welding',
    'aluminum_coating_uv_ii',
    'servo_crimping',
    'ultrasonic_welding',
    'cap_insertion',
    'twisting_primary_aluminum',
    'twisting_secondary_aluminum',
    'airbag',
    'a_b_sub_pc',
    'manual_insertion_to_connector',
    'v_type_twisting',
    'twisting_primary',
    'twisting_secondary',
    'manual_crimping_2tons',
    'manual_crimping_4tons',
    'manual_crimping_5tons',
    'intermediate_ripping_uas_manual_nf_f',
    'intermediate_ripping_uas_joint',
    'intermediate_stripping_kb10',
    'intermediate_stripping_kb10_nsc_weld',
    'joint_crimping_2_tons',
    'joint_crimping_4tons_ps_200',
    'joint_crimping_5tons',
    'manual_taping_dispenser',
    'joint_taping',
    'intermediate_welding',
    'intermediate_welding_0_13',
    'welding_at_head',
    'welding_at_head_0_13',
    'silicon_injection',
    'welding_cap_insertion',
    'welding_taping_13mm',
    'heat_shrink',
    'heat_shrink_la_terminal',
    'heat_shrink_joint_crimping',
    'heat_shrink_welding',
    'casting_c385',
    'stmac_shieldwire_nissan',
    'quick_stripping',
    'manual_heat_shrink_blower_sumitube',
    'drainwire_tip',
    'manual_crimping_shieldwire',
    'joint_crimping_2_tons_sw',
    'manual_blue_taping_dispenser_sw',
    'shieldwire_taping',
    'hs_components_insertion_sw',
    'heat_shrink_joint_crimping_sw',
    'waterproof_pad_press',
    'low_viscosity',
    'air_water_leak_test',
    'hirose',
    'casting_battery',
    'stmac_aluminum',
    'manual_crimping_20tons',
    'manual_heat_shrink_blower_battery', 
    'joint_crimping_20tons',
    'dip_soldering_battery',
    'ultrasonic_dip_soldering_aluminum',
    'la_molding',
    'pressure_welding_dome_lamp',
    'ferrule_process',
    'gomusen_insertion'
];

$gaps = [];
foreach ($processes as $proc) {
    if ($type === 'actual') {
        $val = floatval($source1[$proc] ?? 0);
        $gaps[] = ['process' => strtoupper(str_replace('_', ' ', $proc)), 'gap' => $val];
    } elseif ($type === 'jph') {
        $v1 = floatval($source2[$proc] ?? 0); // Actual JPH
        $v2 = floatval($source1[$proc] ?? 0); // Target JPH
        $gap = $v2 - $v1; // GAP = Target − Actual
        $gaps[] = ['process' => strtoupper(str_replace('_', ' ', $proc)), 'gap' => $gap];
    } else {
        $v1 = floatval($source1[$proc] ?? 0);
        $v2 = floatval($source2[$proc] ?? 0);
        $gap = $v1 - $v2;
        $gaps[] = ['process' => strtoupper(str_replace('_', ' ', $proc)), 'gap' => $gap];
    }
}

// Sort descending by gap
usort($gaps, fn($a, $b) => $b['gap'] <=> $a['gap']);

// Limit top 10 results
$top10 = array_slice($gaps, 0, 10);

// Return JSON
header('Content-Type: application/json');
echo json_encode($top10);
