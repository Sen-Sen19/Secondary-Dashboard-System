<?php
include 'conn.php';

// Receive POST input
$data = json_decode(file_get_contents("php://input"), true);
$username = isset($data['username']) ? strtoupper($data['username']) : null;

if (!$username) {
    echo "Username is missing.";
    exit;
}

// Get shift and section for the user
$userQuery = "SELECT [shift], [section] FROM [secondary_dashboard_db].[dbo].[account] WHERE [username] = ?";
$userStmt = sqlsrv_query($conn, $userQuery, [$username]);

if ($userStmt === false || !($user = sqlsrv_fetch_array($userStmt, SQLSRV_FETCH_ASSOC))) {
    echo "Failed to retrieve user shift and section.";
    exit;
}

$shift = $user['shift'];
$sectionRaw = $user['section'];

// Normalize section: "Section 1" => "1"
preg_match('/\d+(\.\d+)?/', $sectionRaw, $matches);
$section = $matches[0] ?? null;


if (!$section || !$shift) {
    echo "Invalid section or shift.";
    exit;
}

// Delete previous data for same shift and section
$deleteSql = "
DELETE FROM [secondary_dashboard_db].[dbo].[sp_total_shots]
WHERE [shift] = ? AND [section] = ?
";
$deleteStmt = sqlsrv_query($conn, $deleteSql, [$shift, $section]);

if ($deleteStmt === false) {
    echo "Error deleting existing data:\n";
    die(print_r(sqlsrv_errors(), true));
}

// Insert only matching rows
$insertSql = "
INSERT INTO [secondary_dashboard_db].[dbo].[sp_total_shots] (
    [section],
    [car_model],
    [base_product],
    [block],
    [block_2],
    [product],
    [line_no],
    [uv_iii_1],
    [uv_iii_2],
    [uv_iii_4],
    [uv_iii_5],
    [uv_iii_7],
    [uv_iii_8],
    [arc_welding],
  [aluminum_coating_uv_ii],
[servo_crimping],
[ultrasonic_welding],
[cap_insertion],
[twisting_primary_aluminum_short_wires_l_1_3000mm],
[twisting_primary_aluminum_long_wires_l_3001mm],
[twisting_secondary_aluminum_short_wires_l_1_3000mm],
[twisting_secondary_aluminum_long_wires_l_3001mm],
[airbag],
[a_b_sub_pc],
[manual_insertion_to_connector],
[v_type_twisting],
[twisting_primary_normal_short_wires_l_1_3000mm],
[twisting_primary_normal_long_wires_l_3001mm],
[twisting_secondary_normal_short_wires_l_1_3000mm],
[twisting_secondary_normal_long_wires_l_3001mm],
[manual_crimping_2tons_with_gomusen],
[manual_crimping_2tons_normal_single_crimp],
[manual_crimping_2tons_normal_double_crimp],
[manual_crimping_2tons_to_be_joint_on_sw],
[manual_crimping_2tons_nsc_weld],
[manual_crimping_4tons_normal_terminal],
[manual_crimping_4tons_la_terminal],
[manual_crimping_nf_f],
[manual_crimping_5tons],
[intermediate_ripping_uas_manual_nf_f],
[intermediate_ripping_uas_joint],
[intermediate_stripping_kb10],
[intermediate_stripping_kb10_nsc_weld],
[joint_crimping_2tons_ps_800],
[joint_crimping_2tons_ps_700],
[joint_crimping_2tons_ps_017_126],
[joint_crimping_2tons_nsc_weld],
[joint_crimping_4tons_ps_200],
[joint_crimping_5tons],
[manual_taping_dispenser],
[joint_taping_11mm],
[joint_taping_12mm],
[joint_taping_13mm],
[joint_taping_13mm_nsc_weld],
[intermediate_welding_electrode_1],
[intermediate_welding_electrode_2],
[intermediate_welding_electrode_3],
[intermediate_welding_electrode_4],
[intermediate_welding_electrode_5],
[intermediate_welding_0_13_electrode_1],
[intermediate_welding_0_13_electrode_2],
[welding_at_head_electrode_1],
[welding_at_head_electrode_2],
[welding_at_head_electrode_3],
[welding_at_head_electrode_4],
[welding_at_head_electrode_5],
[welding_at_head_0_13_electrode_1],
[welding_at_head_0_13_electrode_2],
[silicon_injection],
[welding_cap_insertion],
[welding_taping_13mm],
[hs_components_insertion],
[heat_shrink_la_terminal],
[heat_shrink_joint_crimping],
[heat_shrink_welding],
[casting_c385],
[stmac_shieldwire_nissan],
[quick_stripping_927_auto],
[quick_stripping_311_manual],
[manual_heat_shrink_blower_sumitube],
[drainwire_tip],
[manual_crimping_shieldwire_2t],
[manual_crimping_shieldwire_4t],
[joint_crimping_2tons_ps_800_s_2_sw],
[joint_crimping_2tons_ps_017_ss_2_sw],
[manual_blue_taping_dispenser_sw],
[shieldwire_taping],
[hs_components_insertion_sw],
[heat_shrink_joint_crimping_sw],
[waterproof_pad_press_joint],
[waterproof_pad_press_weld],
[low_viscosity],
[air_water_leak_test],
[hirose_sheath_stripping_927r],
[hirose_unistrip],
[hirose_acetate_taping],
[hirose_manual_crimping_2_tons],
[hirose_copper_taping],
[hirose_hgt17ap_crimping],
[casting_c373],
[casting_c377],
[casting_c371],
[stmac_aluminum],
[manual_crimping_20tons],
[manual_heat_shrink_blower_battery],
[joint_crimping_20tons],
[dip_soldering_battery],
[ultrasonic_dip_soldering_aluminum],
[la_molding],
[air_water_leak_test_2],
[pressure_welding_dome_lamp],
[ferrule_casting_c373],
[ferrule_parts_insertion],
[ferrule_braided_wire_folding],
[outside_ferrule_insertion],
[ferrule_manual_crimping_2t],
[ferrule_crimping],
[ferrule_welding_at_head],
[ferrule_joint_crimping_2t],
[ferrule_welding_taping],
[gomusen_insertion],
[point_marking],
    [shift]
)
SELECT 
    s.[section],
    s.[car_model],
    s.[base_product],
    s.[block],
    s.[block_2],
    s.[product],
    s.[line_no],
     ISNULL(CAST(s.[uv_iii_1] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[uv_iii_2] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[uv_iii_4] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[uv_iii_5] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[uv_iii_7] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[uv_iii_8] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[arc_welding] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[aluminum_coating_uv_ii] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[servo_crimping] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ultrasonic_welding] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[cap_insertion] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[twisting_primary_aluminum_short_wires_l_1_3000mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[twisting_primary_aluminum_long_wires_l_3001mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[twisting_secondary_aluminum_short_wires_l_1_3000mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[twisting_secondary_aluminum_long_wires_l_3001mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[airbag] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[a_b_sub_pc] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_insertion_to_connector] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[v_type_twisting] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[twisting_primary_normal_short_wires_l_1_3000mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[twisting_primary_normal_long_wires_l_3001mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[twisting_secondary_normal_short_wires_l_1_3000mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[twisting_secondary_normal_long_wires_l_3001mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_2tons_with_gomusen] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_2tons_normal_single_crimp] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_2tons_normal_double_crimp] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_2tons_to_be_joint_on_sw] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_2tons_nsc_weld] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_4tons_normal_terminal] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_4tons_la_terminal] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_nf_f] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_5tons] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_ripping_uas_manual_nf_f] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_ripping_uas_joint] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_stripping_kb10] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_stripping_kb10_nsc_weld] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_2tons_ps_800] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_2tons_ps_700] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_2tons_ps_017_126] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_2tons_nsc_weld] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_4tons_ps_200] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_5tons] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_taping_dispenser] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_taping_11mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_taping_12mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_taping_13mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_taping_13mm_nsc_weld] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_welding_electrode_1] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_welding_electrode_2] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_welding_electrode_3] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_welding_electrode_4] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_welding_electrode_5] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_welding_0_13_electrode_1] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[intermediate_welding_0_13_electrode_2] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_at_head_electrode_1] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_at_head_electrode_2] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_at_head_electrode_3] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_at_head_electrode_4] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_at_head_electrode_5] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_at_head_0_13_electrode_1] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_at_head_0_13_electrode_2] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[silicon_injection] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_cap_insertion] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[welding_taping_13mm] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[hs_components_insertion] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[heat_shrink_la_terminal] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[heat_shrink_joint_crimping] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[heat_shrink_welding] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[casting_c385] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[stmac_shieldwire_nissan] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[quick_stripping_927_auto] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[quick_stripping_311_manual] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_heat_shrink_blower_sumitube] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[drainwire_tip] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_shieldwire_2t] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_shieldwire_4t] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_2tons_ps_800_s_2_sw] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_2tons_ps_017_ss_2_sw] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_blue_taping_dispenser_sw] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[shieldwire_taping] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[hs_components_insertion_sw] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[heat_shrink_joint_crimping_sw] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[waterproof_pad_press_joint] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[waterproof_pad_press_weld] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[low_viscosity] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[air_water_leak_test] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[hirose_sheath_stripping_927r] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[hirose_unistrip] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[hirose_acetate_taping] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[hirose_manual_crimping_2_tons] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[hirose_copper_taping] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[hirose_hgt17ap_crimping] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[casting_c373] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[casting_c377] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[casting_c371] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[stmac_aluminum] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_crimping_20tons] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[manual_heat_shrink_blower_battery] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[joint_crimping_20tons] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[dip_soldering_battery] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ultrasonic_dip_soldering_aluminum] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[la_molding] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[air_water_leak_test_2] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[pressure_welding_dome_lamp] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ferrule_casting_c373] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ferrule_parts_insertion] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ferrule_braided_wire_folding] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[outside_ferrule_insertion] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ferrule_manual_crimping_2t] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ferrule_crimping] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ferrule_welding_at_head] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ferrule_joint_crimping_2t] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[ferrule_welding_taping] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
    ISNULL(CAST(s.[gomusen_insertion] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
      ISNULL(CAST(s.[point_marking] AS FLOAT), 0) * ISNULL(CAST(p.[plan] AS FLOAT), 0),
  
    ?
FROM 
    [secondary_dashboard_db].[dbo].[sp_shot_count] s
JOIN 
    [secondary_dashboard_db].[dbo].[plan] p
    ON s.[base_product] = p.[main_product]
WHERE 
    p.[shift] = ? AND p.[section] = ?;
";

$insertParams = [$shift, $shift, (string)$section];

$insertStmt = sqlsrv_query($conn, $insertSql, $insertParams);

if ($insertStmt === false) {
    echo "Error executing insert query:\n";
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Total shots for shift {$shift} and section {$section} computed successfully!";
}

sqlsrv_free_stmt($deleteStmt);
sqlsrv_free_stmt($insertStmt);
sqlsrv_close($conn);
?>
