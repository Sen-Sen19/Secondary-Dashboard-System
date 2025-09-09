<?php
header('Content-Type: application/json');
include 'conn.php';


$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 200;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;


$section = isset($_GET['section']) ? $_GET['section'] : '';
$baseProduct = isset($_GET['base_product']) ? $_GET['base_product'] : '';


$whereClauses = [];
$whereParams = [];

if (!empty($section)) {
    $whereClauses[] = "section = ?";
    $whereParams[] = $section;
}
if (!empty($baseProduct)) {
    $whereClauses[] = "base_product LIKE ?";
    $whereParams[] = '%' . $baseProduct . '%';
}
$whereSQL = count($whereClauses) > 0 ? 'WHERE ' . implode(' AND ', $whereClauses) : '';


$countSql = "SELECT COUNT(*) AS total FROM [secondary_dashboard_db].[dbo].[sp_shot_count] $whereSQL";
$countStmt = sqlsrv_query($conn, $countSql, $whereParams);
$total = 0;
if ($countStmt && $row = sqlsrv_fetch_array($countStmt, SQLSRV_FETCH_ASSOC)) {
    $total = $row['total'];
}


$sql = "
    SELECT [section]
      ,[car_model]
      ,[base_product]
      ,[block]
      ,[block_2]
      ,[product]
      ,[line_no]
      ,[uv_iii_1]
      ,[uv_iii_2]
      ,[uv_iii_4]
      ,[uv_iii_5]
      ,[uv_iii_7]
      ,[uv_iii_8]
      ,[arc_welding]
      ,[aluminum_coating_uv_ii]
      ,[servo_crimping]
      ,[ultrasonic_welding]
      ,[cap_insertion]
      ,[twisting_primary_aluminum_short_wires_l_1_3000mm]
      ,[twisting_primary_aluminum_long_wires_l_3001mm]
      ,[twisting_secondary_aluminum_short_wires_l_1_3000mm]
      ,[twisting_secondary_aluminum_long_wires_l_3001mm]
      ,[airbag]
      ,[a_b_sub_pc]
      ,[manual_insertion_to_connector]
      ,[v_type_twisting]
      ,[twisting_primary_normal_short_wires_l_1_3000mm]
      ,[twisting_primary_normal_long_wires_l_3001mm]
      ,[twisting_secondary_normal_short_wires_l_1_3000mm]
      ,[twisting_secondary_normal_long_wires_l_3001mm]
      ,[manual_crimping_2tons_with_gomusen]
      ,[manual_crimping_2tons_normal_single_crimp]
      ,[manual_crimping_2tons_normal_double_crimp]
      ,[manual_crimping_2tons_to_be_joint_on_sw]
      ,[manual_crimping_2tons_nsc_weld]
      ,[manual_crimping_4tons_normal_terminal]
      ,[manual_crimping_4tons_la_terminal]
      ,[manual_crimping_nf_f]
      ,[manual_crimping_5tons]
      ,[intermediate_ripping_uas_manual_nf_f]
      ,[intermediate_ripping_uas_joint]
      ,[intermediate_stripping_kb10]
      ,[intermediate_stripping_kb10_nsc_weld]
      ,[joint_crimping_2tons_ps_800]
      ,[joint_crimping_2tons_ps_700]
      ,[joint_crimping_2tons_ps_017_126]
      ,[joint_crimping_2tons_nsc_weld]
      ,[joint_crimping_4tons_ps_200]
      ,[joint_crimping_5tons]
      ,[manual_taping_dispenser]
      ,[joint_taping_11mm]
      ,[joint_taping_12mm]
      ,[joint_taping_13mm]
      ,[joint_taping_13mm_nsc_weld]
      ,[intermediate_welding_electrode_1]
      ,[intermediate_welding_electrode_2]
      ,[intermediate_welding_electrode_3]
      ,[intermediate_welding_electrode_4]
      ,[intermediate_welding_electrode_5]
      ,[intermediate_welding_0_13_electrode_1]
      ,[intermediate_welding_0_13_electrode_2]
      ,[welding_at_head_electrode_1]
      ,[welding_at_head_electrode_2]
      ,[welding_at_head_electrode_3]
      ,[welding_at_head_electrode_4]
      ,[welding_at_head_electrode_5]
      ,[welding_at_head_0_13_electrode_1]
      ,[welding_at_head_0_13_electrode_2]
      ,[silicon_injection]
      ,[welding_cap_insertion]
      ,[welding_taping_13mm]
      ,[hs_components_insertion]
      ,[heat_shrink_la_terminal]
      ,[heat_shrink_joint_crimping]
      ,[heat_shrink_welding]
      ,[casting_c385]
      ,[stmac_shieldwire_nissan]
      ,[quick_stripping_927_auto]
      ,[quick_stripping_311_manual]
      ,[manual_heat_shrink_blower_sumitube]
      ,[drainwire_tip]
      ,[manual_crimping_shieldwire_2t]
      ,[manual_crimping_shieldwire_4t]
      ,[joint_crimping_2tons_ps_800_s_2_sw]
      ,[joint_crimping_2tons_ps_017_ss_2_sw]
      ,[manual_blue_taping_dispenser_sw]
      ,[shieldwire_taping]
      ,[hs_components_insertion_sw]
      ,[heat_shrink_joint_crimping_sw]
      ,[waterproof_pad_press_joint]
      ,[waterproof_pad_press_weld]
      ,[low_viscosity]
      ,[air_water_leak_test]
      ,[hirose_sheath_stripping_927r]
      ,[hirose_unistrip]
      ,[hirose_acetate_taping]
      ,[hirose_manual_crimping_2_tons]
      ,[hirose_copper_taping]
      ,[hirose_hgt17ap_crimping]
      ,[casting_c373]
      ,[casting_c377]
      ,[casting_c371]
      ,[stmac_aluminum]
      ,[manual_crimping_20tons]
      ,[manual_heat_shrink_blower_battery]
      ,[joint_crimping_20tons]
      ,[dip_soldering_battery]
      ,[ultrasonic_dip_soldering_aluminum]
      ,[la_molding]
      ,[air_water_leak_test_2]
      ,[pressure_welding_dome_lamp]
      ,[ferrule_casting_c373]
      ,[ferrule_parts_insertion]
      ,[ferrule_braided_wire_folding]
      ,[outside_ferrule_insertion]
      ,[ferrule_manual_crimping_2t]
      ,[ferrule_crimping]
      ,[ferrule_joint_crimping_2t]
      ,[ferrule_welding_at_head]
      ,[ferrule_welding_taping]
      ,[gomusen_insertion]
      ,[point_marking]

    FROM (
        SELECT *, ROW_NUMBER() OVER (ORDER BY [section]) AS rn
        FROM [secondary_dashboard_db].[dbo].[sp_shot_count]
        $whereSQL
    ) AS sub
    WHERE rn > ? AND rn <= ?
";

$params = array_merge($whereParams, [$offset, $offset + $limit]);
$stmt = sqlsrv_query($conn, $sql, $params);

$data = [];
if ($stmt !== false) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
    sqlsrv_free_stmt($stmt);
}

sqlsrv_close($conn);

echo json_encode([
    'total' => $total,
    'rows' => $data
]);
