<?php
header('Content-Type: application/json');
require_once 'conn.php';

$process = $_GET['process'] ?? '';
$date    = $_GET['date'] ?? date('Y-m-d');

// ✅ Full Process Map (shortened here for brevity; add all your processes)
$processMap = [
   'uv_iii' => 'UV-III',
   'arc_welding' => 'Arc Welding',
   'aluminum_coating_uv_ii' => 'Aluminum Coating UV II',
   'servo_crimping' => 'Servo Crimping',
   'ultrasonic_welding' => 'Ultrasonic Welding',
   'cap_insertion' => 'Cap Insertion',
      'aluminum_coating_uv_ii' => 'Aluminum Coating UV II',
   'servo_crimping' => 'Servo Crimping',
   'ultrasonic_welding' => 'Ultrasonic Welding',
   'cap_insertion' => 'Cap Insertion',
   'twisting_primary_aluminum' => 'Twisting Primary Aluminum',
   'twisting_secondary_aluminum' => 'Twisting Secondary Aluminum',
   'airbag' => 'Airbag',
   'a_b_sub_pc' => 'A/B Sub PC',
   'manual_insertion_to_connector' => 'Manual Insertion to Connector',
   'v_type_twisting' => 'V Type Twisting',
   'twisting_primary' => 'Twisting Primary',
   'twisting_secondary' => 'Twisting Secondary',
   'manual_crimping_2tons' => 'Manual Crimping 2Tons',
   'manual_crimping_4tons' => 'Manual Crimping 4Tons',
   'manual_crimping_5tons' => 'Manual Crimping 5Tons',
   'intermediate_ripping_uas_manual_nf_f' => 'Intermediate ripping(UAS)Manual-NF-F',
   'intermediate_ripping_uas_joint' => 'Intermediate ripping (UAS)Joint stripping(KB10)',
   'intermediate_stripping_kb10' => 'Intermediate stripping(KB10)',
   'intermediate_stripping_kb10_nsc_weld' => 'Intermediate stripping(KB10)NSC/Weld',
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
   'la_molding' => 'La molding',
   'pressure_welding_dome_lamp' => 'Pressure Welding(Dome Lamp)',
   'ferrule_process' => 'Ferrule Process',
   'gomusen_insertion' => 'Gomusen Insertion',
   'point_marking' => 'Point Marking',
   'looping' => 'Looping',
   'completion' => 'Completion',
   'shikakari_handler' => 'Shikakari Handler'
];

if (!isset($processMap[$process])) {
    echo json_encode(['error' => 'Invalid process']);
    exit;
}

$dbProcess = $processMap[$process];
$params = [$date];

// ✅ Initialize response data
$data = [
    'target_output' => 0,
    'actual_output' => 0,
    'output_gap'    => null,
    'machine_count' => 0,
    'actual_machine'=> 0,
    'machine_gap'   => null,
    'target_jph'    => 0,
    'actual_jph'    => 0,
    'jph_gap'       => null,
    'wt'            => [],
    'wip'           => null,
    'previous_wip'  => [],
    'top_unmet'     => []
];

/* ===================== 1. SUM OUTPUT ACROSS ALL SECTIONS ===================== */
$sqlOutput = "
    SELECT 
        SUM(CASE WHEN general_process LIKE 'target output%' THEN [$process] ELSE 0 END) AS target_output,
        SUM(CASE WHEN general_process IN ('actual output','actual running output') THEN [$process] ELSE 0 END) AS actual_output
    FROM [secondary_dashboard_db].[dbo].[summary_backup]
    WHERE section != 'Overall' AND CAST([date] AS DATE) = ?";
$stmtOutput = sqlsrv_query($conn, $sqlOutput, $params);
if ($row = sqlsrv_fetch_array($stmtOutput, SQLSRV_FETCH_ASSOC)) {
    $data['target_output'] = floatval($row['target_output']);
    $data['actual_output'] = floatval($row['actual_output']);
}
$data['output_gap'] = $data['actual_output'] - $data['target_output'];

/* ===================== 2. OUTPUT CHART PER SECTION ===================== */
$outputSQL = "
    SELECT section,
           SUM(CASE WHEN general_process LIKE 'target output%' THEN [$process] ELSE 0 END) AS target_output,
           SUM(CASE WHEN general_process IN ('actual output','actual running output') THEN [$process] ELSE 0 END) AS actual_output
    FROM [secondary_dashboard_db].[dbo].[summary_backup]
    WHERE section != 'Overall' AND CAST([date] AS DATE) = ?
    GROUP BY section";
$outputStmt = sqlsrv_query($conn, $outputSQL, $params);

$outputChartSections = [];
while ($r = sqlsrv_fetch_array($outputStmt, SQLSRV_FETCH_ASSOC)) {
    $outputChartSections[] = [
        'section' => $r['section'],
        'actual'  => (float)$r['actual_output'],
        'target'  => (float)$r['target_output']
    ];
}
$data['output_chart'] = $outputChartSections;


/* ===================== 3. MACHINE COUNT ===================== */
// --- 3. MACHINE COUNT (Dynamic) ---
$machineSQL = "
WITH MachineData AS (
    SELECT 
        s.[section],
        ISNULL(a.actual_machine_count,0) AS actual_machine_count,
        ISNULL(s.[$process],0) AS target_machine_count,
        (ISNULL(s.[$process],0) - ISNULL(a.actual_machine_count,0)) AS gap,
        s.[date]
    FROM [secondary_dashboard_db].[dbo].[summary_backup] s
    LEFT JOIN (
        SELECT 
            REPLACE([section],'Section ','') AS section_number,
            SUM(CASE WHEN [details]='Actual Running Output' AND [daily_result]>0 THEN 1 ELSE 0 END) AS actual_machine_count,
            [date]
        FROM [secondary_dashboard_db].[dbo].[section_backup]
        WHERE [date]=? AND [process]=?
        GROUP BY REPLACE([section],'Section ','') , [date]
    ) a
        ON CAST(s.[section] AS VARCHAR) = a.section_number
        AND s.[date] = a.[date]
    WHERE s.general_process='Machine Count'
      AND s.[date]=?
      AND s.[section] <> 'Overall'

    UNION ALL

    SELECT 
        'Total' AS [section],
        SUM(ISNULL(a.actual_machine_count,0)) AS actual_machine_count,
        SUM(ISNULL(s.[$process],0)) AS target_machine_count,
        SUM(ISNULL(s.[$process],0) - ISNULL(a.actual_machine_count,0)) AS gap,
        NULL AS [date]
    FROM [secondary_dashboard_db].[dbo].[summary_backup] s
    LEFT JOIN (
        SELECT 
            REPLACE([section],'Section ','') AS section_number,
            SUM(CASE WHEN [details]='Actual Running Output' AND [daily_result]>0 THEN 1 ELSE 0 END) AS actual_machine_count,
            [date]
        FROM [secondary_dashboard_db].[dbo].[section_backup]
        WHERE [date]=? AND [process]=?
        GROUP BY REPLACE([section],'Section ','') , [date]
    ) a
        ON CAST(s.[section] AS VARCHAR) = a.section_number
        AND s.[date] = a.[date]
    WHERE s.general_process='Machine Count'
      AND s.[date]=?
      AND s.[section] <> 'Overall'
)
SELECT *
FROM MachineData
ORDER BY 
    CASE WHEN [section]='Total' THEN 1 ELSE 0 END,
    [section];";

$machineStmt = sqlsrv_query($conn, $machineSQL, [$date,$dbProcess,$date,$date,$dbProcess,$date]);

$machineData = [];
$totalMachines = $runningMachines = $machineGap = 0;

while($row = sqlsrv_fetch_array($machineStmt, SQLSRV_FETCH_ASSOC)){
    if($row['section'] !== 'Total'){
        $machineData[] = [
            'section' => $row['section'],
            'actual_machine' => (int)$row['actual_machine_count'],
            'target_machine_count' => (float)$row['target_machine_count'],
            'machine_gap' => (float)$row['gap']
        ];
    } else {
        $totalMachines = (float)$row['target_machine_count'];
        $runningMachines = (int)$row['actual_machine_count'];
        $machineGap = (float)$row['gap'];
    }
}

// --- Top unmet machines ---
$machineUnmet = array_filter($machineData, fn($m)=>$m['machine_gap']<0);
usort($machineUnmet, fn($a,$b)=>$a['machine_gap'] <=> $b['machine_gap']);
$data['top_unmet']['machine'] = $machineUnmet[0]['section'] ?? '—';
$data['top_unmet']['machine_list'] = implode(' ', array_map(fn($x)=>$x['section'],$machineUnmet));

$data['machine_list'] = $machineData;
$data['machine_count'] = $totalMachines;
$data['actual_machine'] = $runningMachines;
$data['machine_gap'] = $machineGap;


/* ===================== 4. JPH PER SECTION ===================== */
$targetJph = $actualJph = [];

$jphSQL = "
    SELECT section,
           SUM(CASE WHEN general_process LIKE 'target jph%' THEN [$process] ELSE 0 END) AS target_jph,
           SUM(CASE WHEN general_process LIKE 'actual jph%' THEN [$process] ELSE 0 END) AS actual_jph
    FROM [secondary_dashboard_db].[dbo].[summary_backup]
    WHERE section != 'Overall' AND CAST([date] AS DATE) = ?
    GROUP BY section";
$jphStmt = sqlsrv_query($conn, $jphSQL, [$date]);
while ($row = sqlsrv_fetch_array($jphStmt, SQLSRV_FETCH_ASSOC)) {
    $sec = $row['section'];
    $targetJph[$sec] = floatval($row['target_jph']);
    $actualJph[$sec] = floatval($row['actual_jph']);
}

$data['target_jph'] = array_sum($targetJph);
$data['actual_jph'] = array_sum($actualJph);
$data['jph_gap']    = $data['actual_jph'] - $data['target_jph'];

/* ===================== 5a. WIP Chart (per section) ===================== */
$wipSQL = "
    SELECT section, [$process] AS value
    FROM [secondary_dashboard_db].[dbo].[summary_backup]
    WHERE section != 'Overall' 
      AND general_process = 'WIP (Previous day)' 
      AND CAST([date] AS DATE) = ?";
$wipStmt = sqlsrv_query($conn, $wipSQL, [$date]);

$previousWip = [];
while($row = sqlsrv_fetch_array($wipStmt, SQLSRV_FETCH_ASSOC)){
    $previousWip[] = [
        'section' => $row['section'],
        'value'   => floatval($row['value'])
    ];
}

$data['previous_wip'] = $previousWip;
$data['wip'] = array_sum(array_column($previousWip,'value')); // overall summary


/* ===================== 5b. Overall WIP (summary) ===================== */
$overallWipSQL = "
    SELECT [$process] AS value
    FROM [secondary_dashboard_db].[dbo].[summary_backup]
    WHERE general_process = 'WIP (Previous day)'
      AND section = 'Overall'
      AND CAST([date] AS DATE) = ?";
$overallWipStmt = sqlsrv_query($conn, $overallWipSQL, [$date]);
$overallWip = 0;
if ($row = sqlsrv_fetch_array($overallWipStmt, SQLSRV_FETCH_ASSOC)) {
    $overallWip = floatval($row['value']);
}
$data['wip'] = $overallWip;


/* ===================== WT ===================== */
// 1️⃣ Chart per section
$wtSQL = "
    SELECT section, [$process] AS value
    FROM [secondary_dashboard_db].[dbo].[summary_backup]
    WHERE section != 'Overall' AND general_process LIKE 'actual wt%' AND CAST([date] AS DATE) = ?";
$wtStmt = sqlsrv_query($conn, $wtSQL, [$date]);
$wtData = [];
while($row = sqlsrv_fetch_array($wtStmt, SQLSRV_FETCH_ASSOC)){
    $wtData[] = [
        'section' => $row['section'],
        'value'   => floatval($row['value'])
    ];
}
$data['wt'] = $wtData;

// 2️⃣ Overall WT summary
$overallWtSQL = "
    SELECT [$process] AS value
    FROM [secondary_dashboard_db].[dbo].[summary_backup]
    WHERE general_process = 'Actual WT' 
      AND section = 'Overall' 
      AND CAST([date] AS DATE) = ?";
$overallWtStmt = sqlsrv_query($conn, $overallWtSQL, [$date]);
$overallWt = 0;
if($row = sqlsrv_fetch_array($overallWtStmt, SQLSRV_FETCH_ASSOC)){
    $overallWt = floatval($row['value']);
}
$data['wt_overall'] = $overallWt;

/* ===================== 7. JPH Chart & Top Unmet ===================== */
$chartData = [];
foreach ($actualJph as $sec => $val) {
    $diff = $val - ($targetJph[$sec] ?? 0);
    $chartData[] = ['section' => $sec, 'value' => $diff];
}
$data['wip_chart'] = $chartData;

$unmetJph = array_filter($chartData, fn($c) => $c['value'] < 0);
usort($unmetJph, fn($a, $b) => $a['value'] <=> $b['value']);
$data['top_unmet']['jph']      = isset($unmetJph[0]) ? "Section {$unmetJph[0]['section']}" : '—';
$data['top_unmet']['jph_list'] = implode(' ', array_map(fn($x) => "Section {$x['section']}", $unmetJph));

/* ===================== RETURN JSON ===================== */
echo json_encode($data);
exit;
?>
