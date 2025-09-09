<?php
include 'conn.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['section'])) {
    $selectedSection = $_POST['section'];

    // Export all if 'all' is selected
if ($selectedSection === 'all') {
    $query = "SELECT TOP (1000) [section], [general_process], 
 [total]
,[uv_iii]
,[arc_welding]
,[aluminum_coating_uv_ii]
,[servo_crimping]
,[ultrasonic_welding]
,[cap_insertion]
,[twisting_primary_aluminum]
,[twisting_secondary_aluminum]
,[airbag]
,[a_b_sub_pc]
,[manual_insertion_to_connector]
,[v_type_twisting]
,[twisting_primary]
,[twisting_secondary]
,[manual_crimping_2tons]
,[manual_crimping_4tons]
,[manual_crimping_5tons]
,[intermediate_ripping_uas_manual_nf_f]
,[intermediate_ripping_uas_joint]
,[intermediate_stripping_kb10]
,[intermediate_stripping_kb10_nsc_weld]
,[joint_crimping_2_tons]
,[joint_crimping_4tons_ps_200]
,[joint_crimping_5tons]
,[manual_taping_dispenser]
,[joint_taping]
,[intermediate_welding]
,[intermediate_welding_0_13]
,[welding_at_head]
,[welding_at_head_0_13]
,[silicon_injection]
,[welding_cap_insertion]
,[welding_taping_13mm]
,[heat_shrink]
,[heat_shrink_la_terminal]
,[heat_shrink_joint_crimping]
,[heat_shrink_welding]
,[casting_c385]
,[stmac_shieldwire_nissan]
,[quick_stripping]
,[manual_heat_shrink_blower_sumitube]
,[drainwire_tip]
,[manual_crimping_shieldwire]
,[joint_crimping_2_tons_sw]
,[manual_blue_taping_dispenser_sw]
,[shieldwire_taping]
,[hs_components_insertion_sw]
,[heat_shrink_joint_crimping_sw]
,[waterproof_pad_press]
,[low_viscosity]
,[air_water_leak_test]
,[hirose]
,[casting_battery]
,[stmac_aluminum]
,[manual_crimping_20tons]
,[manual_heat_shrink_blower_battery]
,[joint_crimping_20tons]
,[dip_soldering_battery]
,[ultrasonic_dip_soldering_aluminum]
,[la_molding]
,[pressure_welding_dome_lamp]
,[ferrule_process]
,[gomusen_insertion]
,[point_marking]


              FROM [secondary_dashboard_db].[dbo].[summary]
            ORDER BY 
    CASE 
        WHEN ISNUMERIC([section]) = 1 THEN CAST([section] AS FLOAT)
        ELSE 9999
    END,
    CASE [general_process]
        WHEN 'WIP (Previous day)' THEN 1
        WHEN 'Plan Output per day' THEN 2
        WHEN 'Target Output (WIP+Plan)' THEN 3
        WHEN 'Machine Count' THEN 4
        WHEN 'Target JPH' THEN 5
        WHEN 'Actual Output' THEN 6
        WHEN 'Actual JPH' THEN 7
        WHEN 'Actual WT' THEN 8
        WHEN 'WIP' THEN 9
        WHEN 'Plan Per Machine' THEN 10
        ELSE 999
    END
";
    $params = [];
}
 else {
        $query = "SELECT TOP (1000) [section], [general_process], 
 [total]
,[uv_iii]
,[arc_welding]
,[aluminum_coating_uv_ii]
,[servo_crimping]
,[ultrasonic_welding]
,[cap_insertion]
,[twisting_primary_aluminum]
,[twisting_secondary_aluminum]
,[airbag]
,[a_b_sub_pc]
,[manual_insertion_to_connector]
,[v_type_twisting]
,[twisting_primary]
,[twisting_secondary]
,[manual_crimping_2tons]
,[manual_crimping_4tons]
,[manual_crimping_5tons]
,[intermediate_ripping_uas_manual_nf_f]
,[intermediate_ripping_uas_joint]
,[intermediate_stripping_kb10]
,[intermediate_stripping_kb10_nsc_weld]
,[joint_crimping_2_tons]
,[joint_crimping_4tons_ps_200]
,[joint_crimping_5tons]
,[manual_taping_dispenser]
,[joint_taping]
,[intermediate_welding]
,[intermediate_welding_0_13]
,[welding_at_head]
,[welding_at_head_0_13]
,[silicon_injection]
,[welding_cap_insertion]
,[welding_taping_13mm]
,[heat_shrink]
,[heat_shrink_la_terminal]
,[heat_shrink_joint_crimping]
,[heat_shrink_welding]
,[casting_c385]
,[stmac_shieldwire_nissan]
,[quick_stripping]
,[manual_heat_shrink_blower_sumitube]
,[drainwire_tip]
,[manual_crimping_shieldwire]
,[joint_crimping_2_tons_sw]
,[manual_blue_taping_dispenser_sw]
,[shieldwire_taping]
,[hs_components_insertion_sw]
,[heat_shrink_joint_crimping_sw]
,[waterproof_pad_press]
,[low_viscosity]
,[air_water_leak_test]
,[hirose]
,[casting_battery]
,[stmac_aluminum]
,[manual_crimping_20tons]
,[manual_heat_shrink_blower_battery]
,[joint_crimping_20tons]
,[dip_soldering_battery]
,[ultrasonic_dip_soldering_aluminum]
,[la_molding]
,[pressure_welding_dome_lamp]
,[ferrule_process]
,[gomusen_insertion]
,[point_marking]

                FROM [secondary_dashboard_db].[dbo].[summary]
WHERE [section] = ?
ORDER BY 
    CASE [general_process]
        WHEN 'WIP (Previous day)' THEN 1
        WHEN 'Plan Output per day' THEN 2
        WHEN 'Target Output (WIP+Plan)' THEN 3
        WHEN 'Machine Count' THEN 4
        WHEN 'Target JPH' THEN 5
        WHEN 'Actual Output' THEN 6
        WHEN 'Actual JPH' THEN 7
        WHEN 'Actual WT' THEN 8
        WHEN 'WIP' THEN 9
        WHEN 'Plan Per Machine' THEN 10
        ELSE 999
    END";

        $params = [$selectedSection];
    }

    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die("Query failed: " . print_r(sqlsrv_errors(), true));
    }

    // CSV output headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="section_export.csv"');

    $output = fopen("php://output", "w");

    // Output column headers
    fputcsv($output, ['Section', 'General Process', 'Total',
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


]);

    // Output data rows
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        fputcsv($output, $row);
    }

    fclose($output);
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    exit;
} else {
    echo "Invalid request.";
}
?>
