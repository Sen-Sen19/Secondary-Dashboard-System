<?php
include 'conn.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$section = $_GET['section'] ?? '';
$date = $_GET['date'] ?? date('Y-m-d');

// Normalize section (e.g., "1" → "Section 1")
if (is_numeric($section)) {
    $section = 'Section ' . $section;
}

if (empty($section)) {
    http_response_code(400);
    echo json_encode(['error' => 'Section is required']);
    exit;
}

// Processes for machine count
$processes = [
 'UV-III',
'Arc Welding',
'Aluminum Coating UV II',
'Servo Crimping',
'Ultrasonic Welding',
'Cap Insertion',
'Twisting Primary Aluminum',
'Twisting Secondary Aluminum',
'Airbag',
'A/B Sub PC',
'Manual Insertion to Connector',
'V Type Twisting',
'Twisting Primary',
'Twisting Secondary',
'Manual Crimping 2Tons',
'Manual Crimping 4Tons',
'Manual Crimping 5Tons',
'Intermediate ripping(UAS)Manual-NF-F',
'Intermediate ripping (UAS)Joint stripping(KB10)',
'Intermediate stripping(KB10)',
'Intermediate stripping(KB10)NSC/Weld',
'Joint Crimping 2Tons',
'Joint Crimping 4Tons(PS-200)',
'Joint Crimping 5Tons',
'Manual Taping (Dispenser)',
'Joint Taping',
'Intermediate Welding',
'Intermediate Welding 0.13',
'Welding at Head',
'Welding at Head 0.13',
'Silicon Injection',
'Welding Cap Insertion',
'Welding Taping(13mm)',
'Heatshrink',
'Heat Shrink LA terminal',
'Heat Shrink (Joint Crimping)',
'Heat Shrink (Welding)',
'Casting C385',
'STMAC Shieldwire(Nissan)',
'Quick Stripping',
'Manual Heat Shrink(Blower)Sumitube',
'Drainwire Tip',
'Manual Crimping Shieldwire',
'Joint Crimping 2TonsSW',
'Manual Blue Taping(Dispenser)SW',
'Shieldwire Taping',
'HS Components Insertion SW',
'Heat Shrink (Joint Crimping)SW',
'Waterproof pad Press',
'Low Viscosity',
'Air/Water leak test',
'HIROSE',
'Casting Battery',
'STMACAluminum',
'Manual Crimping 20Tons',
'Manual Heat Shrink (Blower)Battery',
'Joint Crimping 20Tons',
'Dip Soldering (Battery)',
'Ultrasonic Dip SolderingAluminum',
'La molding',
'Pressure Welding(Dome Lamp)',
'Ferrule Process',
'Gomusen Insertion',
'Point Marking'
];

$results = [];
foreach ($processes as $proc) {
    if (strtolower($section) === 'overall') {
        $sql = "
            SELECT COUNT(*) AS machine_count
            FROM [secondary_dashboard_db].[dbo].[section_backup]
            WHERE [date] = ?
              AND LOWER([process]) = LOWER(?)
              AND LOWER([details]) = 'actual running output'
              AND [daily_result] > 0;
        ";
        $params = [$date, $proc];
    } else {
        $sql = "
            SELECT COUNT(*) AS machine_count
            FROM [secondary_dashboard_db].[dbo].[section_backup]
            WHERE [date] = ?
              AND [section] = ?
              AND LOWER([process]) = LOWER(?)
              AND LOWER([details]) = 'actual running output'
              AND [daily_result] > 0;
        ";
        $params = [$date, $section, $proc];
    }

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt && $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $results[] = [
            'process' => strtoupper($proc),
            'gap' => (int)$row['machine_count']
        ];
    } else {
        error_log("Query failed for process: $proc");
    }
}

// Sort by machine count
usort($results, fn($a, $b) => $b['gap'] <=> $a['gap']);
$top10 = array_slice($results, 0, 10);

header('Content-Type: application/json');
echo json_encode($top10);
