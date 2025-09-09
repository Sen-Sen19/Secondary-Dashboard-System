<?php
include 'conn.php';


$sql = "
 -- =============================================================================== PLAN OUTPUT ===============================================================================


WITH PlanOutput AS (
    SELECT
        [section] AS section,
        'Plan Output per day' AS general_process,
SUM([uv_iii_1] + [uv_iii_2] + [uv_iii_4] + [uv_iii_5] + [uv_iii_7] + [uv_iii_8]) AS uv_iii,
SUM(arc_welding) AS arc_welding,
SUM([aluminum_coating_uv_ii]) AS aluminum_coating_uv_ii,
SUM([servo_crimping]) AS servo_crimping,
SUM(ultrasonic_welding) AS ultrasonic_welding,
SUM([cap_insertion]) AS cap_insertion,
SUM([twisting_primary_aluminum_short_wires_l_1_3000mm] + [twisting_primary_aluminum_long_wires_l_3001mm]) AS twisting_primary_aluminum,
SUM([twisting_secondary_aluminum_short_wires_l_1_3000mm] + [twisting_secondary_aluminum_long_wires_l_3001mm]) AS twisting_secondary_aluminum,
SUM([airbag]) AS airbag,
SUM([a_b_sub_pc]) AS a_b_sub_pc,
SUM([manual_insertion_to_connector]) AS manual_insertion_to_connector,
SUM([v_type_twisting]) AS v_type_twisting,
SUM([twisting_primary_normal_short_wires_l_1_3000mm] + [twisting_primary_normal_long_wires_l_3001mm]) AS twisting_primary,
SUM([twisting_secondary_normal_short_wires_l_1_3000mm] + [twisting_secondary_normal_long_wires_l_3001mm]) AS twisting_secondary,
SUM([manual_crimping_2tons_with_gomusen] + [manual_crimping_2tons_normal_single_crimp] + [manual_crimping_2tons_normal_double_crimp] + [manual_crimping_2tons_to_be_joint_on_sw] + [manual_crimping_2tons_nsc_weld]) AS manual_crimping_2tons,
SUM([manual_crimping_4tons_normal_terminal] + [manual_crimping_4tons_la_terminal] + [manual_crimping_nf_f]) AS manual_crimping_4tons,
SUM([manual_crimping_5tons]) AS manual_crimping_5tons,
SUM([intermediate_ripping_uas_manual_nf_f]) AS intermediate_ripping_uas_manual_nf_f,
SUM([intermediate_ripping_uas_joint]) AS intermediate_ripping_uas_joint,
SUM([intermediate_stripping_kb10]) AS intermediate_stripping_kb10,
SUM([intermediate_stripping_kb10_nsc_weld]) AS intermediate_stripping_kb10_nsc_weld,
SUM([joint_crimping_2tons_ps_800] + [joint_crimping_2tons_ps_700]+[joint_crimping_2tons_ps_017_126] + [joint_crimping_2tons_nsc_weld] ) AS joint_crimping_2_tons,
SUM([joint_crimping_4tons_ps_200]) AS joint_crimping_4tons_ps_200,
SUM([joint_crimping_5tons]) AS joint_crimping_5tons,
SUM([manual_taping_dispenser]) AS manual_taping_dispenser,
SUM([joint_taping_13mm] + [joint_taping_12mm]+[joint_taping_11mm]) AS joint_taping,
SUM([intermediate_welding_electrode_1] + [intermediate_welding_electrode_2] + [intermediate_welding_electrode_3] + [intermediate_welding_electrode_4] + [intermediate_welding_electrode_5]) AS intermediate_welding,
SUM([intermediate_welding_0_13_electrode_1] + [intermediate_welding_0_13_electrode_2]) AS intermediate_welding_0_13,
SUM([welding_at_head_electrode_1] + [welding_at_head_electrode_2] + [welding_at_head_electrode_3] + [welding_at_head_electrode_4] + [welding_at_head_electrode_5]) AS welding_at_head,
SUM([welding_at_head_0_13_electrode_1] + [welding_at_head_0_13_electrode_2]) AS welding_at_head_0_13,
SUM([silicon_injection]) AS silicon_injection,
SUM([welding_cap_insertion]) AS welding_cap_insertion,
SUM([welding_taping_13mm]) AS welding_taping_13mm,
SUM([hs_components_insertion]) AS heat_shrink,
SUM([heat_shrink_la_terminal]) AS heat_shrink_la_terminal,
SUM([heat_shrink_joint_crimping]) AS heat_shrink_joint_crimping,
SUM([heat_shrink_welding]) AS heat_shrink_welding,
SUM([casting_c385]) AS casting_c385,
SUM([stmac_shieldwire_nissan]) AS stmac_shieldwire_nissan,
SUM([quick_stripping_927_auto] + [quick_stripping_311_manual]) AS quick_stripping,
SUM([manual_heat_shrink_blower_sumitube]) AS manual_heat_shrink_blower_sumitube,
SUM([drainwire_tip]) AS drainwire_tip,
SUM([manual_crimping_shieldwire_2t] + [manual_crimping_shieldwire_4t]) AS manual_crimping_shieldwire,
SUM([joint_crimping_2tons_ps_800_s_2_sw] + [joint_crimping_2tons_ps_017_ss_2_sw]) AS joint_crimping_2_tons_sw,
SUM([manual_blue_taping_dispenser_sw]) AS manual_blue_taping_dispenser_sw,
SUM([shieldwire_taping]) AS shieldwire_taping,
SUM([hs_components_insertion_sw]) AS hs_components_insertion_sw,
SUM([heat_shrink_joint_crimping_sw]) AS heat_shrink_joint_crimping_sw,
SUM([waterproof_pad_press_joint] + [waterproof_pad_press_weld]) AS waterproof_pad_press,
SUM([low_viscosity]) AS low_viscosity,
SUM([air_water_leak_test]) AS air_water_leak_test,
SUM([hirose_sheath_stripping_927r] + [hirose_unistrip] + [hirose_acetate_taping] + [hirose_manual_crimping_2_tons] + [hirose_copper_taping] + [hirose_hgt17ap_crimping]) AS hirose,
SUM([casting_c373] + [casting_c377] + [casting_c371])  AS casting_battery,
SUM([stmac_aluminum]) AS stmac_aluminum,
SUM([manual_crimping_20tons]) AS manual_crimping_20tons,
SUM([manual_heat_shrink_blower_battery]) AS manual_heat_shrink_blower_battery,
SUM([joint_crimping_20tons]) AS joint_crimping_20tons,
SUM([dip_soldering_battery]) AS dip_soldering_battery,
SUM([ultrasonic_dip_soldering_aluminum]) AS ultrasonic_dip_soldering_aluminum,
SUM([la_molding] + [air_water_leak_test_2]) AS la_molding,
SUM([pressure_welding_dome_lamp])  AS pressure_welding_dome_lamp,
SUM([ferrule_casting_c373] + [ferrule_parts_insertion] + [ferrule_braided_wire_folding] )  AS ferrule_process,
SUM([gomusen_insertion]) AS gomusen_insertion,
SUM([point_marking])  AS point_marking,


SUM(
ISNULL([uv_iii_1],0) +
ISNULL([uv_iii_2],0) +
ISNULL([uv_iii_4],0) +
ISNULL([uv_iii_5],0) +
ISNULL([uv_iii_7],0) +
ISNULL([uv_iii_8],0) +
ISNULL([arc_welding],0) +
ISNULL([aluminum_coating_uv_ii],0) +
ISNULL([servo_crimping],0) +
ISNULL([ultrasonic_welding],0) +
ISNULL([cap_insertion],0) +
ISNULL([twisting_primary_aluminum_short_wires_l_1_3000mm],0) +
ISNULL([twisting_primary_aluminum_long_wires_l_3001mm],0) +
ISNULL([twisting_secondary_aluminum_short_wires_l_1_3000mm],0) +
ISNULL([twisting_secondary_aluminum_long_wires_l_3001mm],0) +
ISNULL([airbag],0) +
ISNULL([a_b_sub_pc],0) +
ISNULL([manual_insertion_to_connector],0) +
ISNULL([v_type_twisting],0) +
ISNULL([twisting_primary_normal_short_wires_l_1_3000mm],0) +
ISNULL([twisting_primary_normal_long_wires_l_3001mm],0) +
ISNULL([twisting_secondary_normal_short_wires_l_1_3000mm],0) +
ISNULL([twisting_secondary_normal_long_wires_l_3001mm],0) +
ISNULL([manual_crimping_2tons_with_gomusen],0) +
ISNULL([manual_crimping_2tons_normal_single_crimp],0) +
ISNULL([manual_crimping_2tons_normal_double_crimp],0) +
ISNULL([manual_crimping_2tons_to_be_joint_on_sw],0) +
ISNULL([manual_crimping_2tons_nsc_weld],0) +
ISNULL([manual_crimping_4tons_normal_terminal],0) +
ISNULL([manual_crimping_4tons_la_terminal],0) +
ISNULL([manual_crimping_nf_f],0) +
ISNULL([manual_crimping_5tons],0) +
ISNULL([intermediate_ripping_uas_manual_nf_f],0) +
ISNULL([intermediate_ripping_uas_joint],0) +
ISNULL([intermediate_stripping_kb10],0) +
ISNULL([intermediate_stripping_kb10_nsc_weld],0) +
ISNULL([joint_crimping_2tons_ps_800],0) +
ISNULL([joint_crimping_2tons_ps_700],0) +
ISNULL([joint_crimping_2tons_ps_017_126],0) +
ISNULL([joint_crimping_2tons_nsc_weld],0) +
ISNULL([joint_crimping_4tons_ps_200],0) +
ISNULL([joint_crimping_5tons],0) +
ISNULL([manual_taping_dispenser],0) +
ISNULL([joint_taping_11mm],0) +
ISNULL([joint_taping_12mm],0) +
ISNULL([joint_taping_13mm],0) +
ISNULL([joint_taping_13mm_nsc_weld],0) +
ISNULL([intermediate_welding_electrode_1],0) +
ISNULL([intermediate_welding_electrode_2],0) +
ISNULL([intermediate_welding_electrode_3],0) +
ISNULL([intermediate_welding_electrode_4],0) +
ISNULL([intermediate_welding_electrode_5],0) +
ISNULL([intermediate_welding_0_13_electrode_1],0) +
ISNULL([intermediate_welding_0_13_electrode_2],0) +
ISNULL([welding_at_head_electrode_1],0) +
ISNULL([welding_at_head_electrode_2],0) +
ISNULL([welding_at_head_electrode_3],0) +
ISNULL([welding_at_head_electrode_4],0) +
ISNULL([welding_at_head_electrode_5],0) +
ISNULL([welding_at_head_0_13_electrode_1],0) +
ISNULL([welding_at_head_0_13_electrode_2],0) +
ISNULL([silicon_injection],0) +
ISNULL([welding_cap_insertion],0) +
ISNULL([welding_taping_13mm],0) +
ISNULL([hs_components_insertion],0) +
ISNULL([heat_shrink_la_terminal],0) +
ISNULL([heat_shrink_joint_crimping],0) +
ISNULL([heat_shrink_welding],0) +
ISNULL([casting_c385],0) +
ISNULL([stmac_shieldwire_nissan],0) +
ISNULL([quick_stripping_927_auto],0) +
ISNULL([quick_stripping_311_manual],0) +
ISNULL([manual_heat_shrink_blower_sumitube],0) +
ISNULL([drainwire_tip],0) +
ISNULL([manual_crimping_shieldwire_2t],0) +
ISNULL([manual_crimping_shieldwire_4t],0) +
ISNULL([joint_crimping_2tons_ps_800_s_2_sw],0) +
ISNULL([joint_crimping_2tons_ps_017_ss_2_sw],0) +
ISNULL([manual_blue_taping_dispenser_sw],0) +
ISNULL([shieldwire_taping],0) +
ISNULL([hs_components_insertion_sw],0) +
ISNULL([heat_shrink_joint_crimping_sw],0) +
ISNULL([waterproof_pad_press_joint],0) +
ISNULL([waterproof_pad_press_weld],0) +
ISNULL([low_viscosity],0) +
ISNULL([air_water_leak_test],0) +
ISNULL([hirose_sheath_stripping_927r],0) +
ISNULL([hirose_unistrip],0) +
ISNULL([hirose_acetate_taping],0) +
ISNULL([hirose_manual_crimping_2_tons],0) +
ISNULL([hirose_copper_taping],0) +
ISNULL([hirose_hgt17ap_crimping],0) +
ISNULL([casting_c373],0) +
ISNULL([casting_c377],0) +
ISNULL([casting_c371],0) +
ISNULL([stmac_aluminum],0) +
ISNULL([manual_crimping_20tons],0) +
ISNULL([manual_heat_shrink_blower_battery],0) +
ISNULL([joint_crimping_20tons],0) +
ISNULL([dip_soldering_battery],0) +
ISNULL([ultrasonic_dip_soldering_aluminum],0) +
ISNULL([la_molding],0) +
ISNULL([air_water_leak_test_2],0) +
ISNULL([pressure_welding_dome_lamp],0) +
ISNULL([ferrule_casting_c373],0) +
ISNULL([ferrule_parts_insertion],0) +
ISNULL([ferrule_braided_wire_folding],0) +
ISNULL([outside_ferrule_insertion],0) +
ISNULL([ferrule_manual_crimping_2t],0) +
ISNULL([ferrule_crimping],0) +
ISNULL([ferrule_joint_crimping_2t],0) +
ISNULL([ferrule_welding_at_head],0) +
ISNULL([ferrule_welding_taping],0) +
ISNULL([gomusen_insertion],0) +
ISNULL([point_marking],0) 
        ) AS Total
    FROM 
        [secondary_dashboard_db].[dbo].[sp_total_shots]
    GROUP BY 
           [section]
    UNION ALL
    SELECT
        'Overall',
        'Plan Output per day',
 SUM([uv_iii_1] + [uv_iii_2] + [uv_iii_4] + [uv_iii_5] + [uv_iii_7] + [uv_iii_8]),
 SUM(arc_welding),
 SUM([aluminum_coating_uv_ii]),
 SUM([servo_crimping]),
 SUM(ultrasonic_welding),
 SUM([cap_insertion]),
 SUM([twisting_primary_aluminum_short_wires_l_1_3000mm] + [twisting_primary_aluminum_long_wires_l_3001mm]),
 SUM([twisting_secondary_aluminum_short_wires_l_1_3000mm] + [twisting_secondary_aluminum_long_wires_l_3001mm]),
 SUM([airbag]),
 SUM([a_b_sub_pc]),
 SUM([manual_insertion_to_connector]),
 SUM([v_type_twisting]),
 SUM([twisting_primary_normal_short_wires_l_1_3000mm] + [twisting_primary_normal_long_wires_l_3001mm]),
 SUM([twisting_secondary_normal_short_wires_l_1_3000mm] + [twisting_secondary_normal_long_wires_l_3001mm]),
 SUM([manual_crimping_2tons_with_gomusen] + [manual_crimping_2tons_normal_single_crimp] + [manual_crimping_2tons_normal_double_crimp] + [manual_crimping_2tons_to_be_joint_on_sw] + [manual_crimping_2tons_nsc_weld]),
 SUM([manual_crimping_4tons_normal_terminal] + [manual_crimping_4tons_la_terminal] + [manual_crimping_nf_f]),
 SUM([manual_crimping_5tons]),
 SUM([intermediate_ripping_uas_manual_nf_f]),
 SUM([intermediate_ripping_uas_joint]),
 SUM([intermediate_stripping_kb10]),
 SUM([intermediate_stripping_kb10_nsc_weld]),
 SUM([joint_crimping_2tons_ps_800] + [joint_crimping_2tons_ps_700]+[joint_crimping_2tons_ps_017_126] + [joint_crimping_2tons_nsc_weld] ),
 SUM([joint_crimping_4tons_ps_200]),
 SUM([joint_crimping_5tons]),
 SUM([manual_taping_dispenser]),
 SUM([joint_taping_13mm] + [joint_taping_12mm]+[joint_taping_11mm]),
 SUM([intermediate_welding_electrode_1] + [intermediate_welding_electrode_2] + [intermediate_welding_electrode_3] + [intermediate_welding_electrode_4] + [intermediate_welding_electrode_5]),
 SUM([intermediate_welding_0_13_electrode_1] + [intermediate_welding_0_13_electrode_2]),
 SUM([welding_at_head_electrode_1] + [welding_at_head_electrode_2] + [welding_at_head_electrode_3] + [welding_at_head_electrode_4] + [welding_at_head_electrode_5]),
 SUM([welding_at_head_0_13_electrode_1] + [welding_at_head_0_13_electrode_2]),
 SUM([silicon_injection]),
 SUM([welding_cap_insertion]),
 SUM([welding_taping_13mm]),
 SUM([hs_components_insertion]),
 SUM([heat_shrink_la_terminal]),
 SUM([heat_shrink_joint_crimping]),
 SUM([heat_shrink_welding]),
 SUM([casting_c385]),
 SUM([stmac_shieldwire_nissan]),
 SUM([quick_stripping_927_auto] + [quick_stripping_311_manual]),
 SUM([manual_heat_shrink_blower_sumitube]),
 SUM([drainwire_tip]),
 SUM([manual_crimping_shieldwire_2t] + [manual_crimping_shieldwire_4t]),
 SUM([joint_crimping_2tons_ps_800_s_2_sw] + [joint_crimping_2tons_ps_017_ss_2_sw]) AS joint_crimping_2_tons_sw,
 SUM([manual_blue_taping_dispenser_sw]),
 SUM([shieldwire_taping]),
 SUM([hs_components_insertion_sw]),
 SUM([heat_shrink_joint_crimping_sw]),
 SUM([waterproof_pad_press_joint] + [waterproof_pad_press_weld]),
 SUM([low_viscosity]),
 SUM([air_water_leak_test]),
 SUM([hirose_sheath_stripping_927r] + [hirose_unistrip] + [hirose_acetate_taping] + [hirose_manual_crimping_2_tons] + [hirose_copper_taping] + [hirose_hgt17ap_crimping]),
 SUM([casting_c373] + [casting_c377] + [casting_c371]),
 SUM([stmac_aluminum]),
 SUM([manual_crimping_20tons]),
 SUM([manual_heat_shrink_blower_battery]),
 SUM([joint_crimping_20tons]),
 SUM([dip_soldering_battery]),
 SUM([ultrasonic_dip_soldering_aluminum]),
 SUM([la_molding] + [air_water_leak_test_2]),
 SUM([pressure_welding_dome_lamp]),
 SUM([ferrule_casting_c373] + [ferrule_parts_insertion] + [ferrule_braided_wire_folding] ),
 SUM([gomusen_insertion]) AS gomusen_insertion,
 SUM([point_marking]),


      SUM(
ISNULL([uv_iii_1],0) +
ISNULL([uv_iii_2],0) +
ISNULL([uv_iii_4],0) +
ISNULL([uv_iii_5],0) +
ISNULL([uv_iii_7],0) +
ISNULL([uv_iii_8],0) +
ISNULL([arc_welding],0) +
ISNULL([aluminum_coating_uv_ii],0) +
ISNULL([servo_crimping],0) +
ISNULL([ultrasonic_welding],0) +
ISNULL([cap_insertion],0) +
ISNULL([twisting_primary_aluminum_short_wires_l_1_3000mm],0) +
ISNULL([twisting_primary_aluminum_long_wires_l_3001mm],0) +
ISNULL([twisting_secondary_aluminum_short_wires_l_1_3000mm],0) +
ISNULL([twisting_secondary_aluminum_long_wires_l_3001mm],0) +
ISNULL([airbag],0) +
ISNULL([a_b_sub_pc],0) +
ISNULL([manual_insertion_to_connector],0) +
ISNULL([v_type_twisting],0) +
ISNULL([twisting_primary_normal_short_wires_l_1_3000mm],0) +
ISNULL([twisting_primary_normal_long_wires_l_3001mm],0) +
ISNULL([twisting_secondary_normal_short_wires_l_1_3000mm],0) +
ISNULL([twisting_secondary_normal_long_wires_l_3001mm],0) +
ISNULL([manual_crimping_2tons_with_gomusen],0) +
ISNULL([manual_crimping_2tons_normal_single_crimp],0) +
ISNULL([manual_crimping_2tons_normal_double_crimp],0) +
ISNULL([manual_crimping_2tons_to_be_joint_on_sw],0) +
ISNULL([manual_crimping_2tons_nsc_weld],0) +
ISNULL([manual_crimping_4tons_normal_terminal],0) +
ISNULL([manual_crimping_4tons_la_terminal],0) +
ISNULL([manual_crimping_nf_f],0) +
ISNULL([manual_crimping_5tons],0) +
ISNULL([intermediate_ripping_uas_manual_nf_f],0) +
ISNULL([intermediate_ripping_uas_joint],0) +
ISNULL([intermediate_stripping_kb10],0) +
ISNULL([intermediate_stripping_kb10_nsc_weld],0) +
ISNULL([joint_crimping_2tons_ps_800],0) +
ISNULL([joint_crimping_2tons_ps_700],0) +
ISNULL([joint_crimping_2tons_ps_017_126],0) +
ISNULL([joint_crimping_2tons_nsc_weld],0) +
ISNULL([joint_crimping_4tons_ps_200],0) +
ISNULL([joint_crimping_5tons],0) +
ISNULL([manual_taping_dispenser],0) +
ISNULL([joint_taping_11mm],0) +
ISNULL([joint_taping_12mm],0) +
ISNULL([joint_taping_13mm],0) +
ISNULL([joint_taping_13mm_nsc_weld],0) +
ISNULL([intermediate_welding_electrode_1],0) +
ISNULL([intermediate_welding_electrode_2],0) +
ISNULL([intermediate_welding_electrode_3],0) +
ISNULL([intermediate_welding_electrode_4],0) +
ISNULL([intermediate_welding_electrode_5],0) +
ISNULL([intermediate_welding_0_13_electrode_1],0) +
ISNULL([intermediate_welding_0_13_electrode_2],0) +
ISNULL([welding_at_head_electrode_1],0) +
ISNULL([welding_at_head_electrode_2],0) +
ISNULL([welding_at_head_electrode_3],0) +
ISNULL([welding_at_head_electrode_4],0) +
ISNULL([welding_at_head_electrode_5],0) +
ISNULL([welding_at_head_0_13_electrode_1],0) +
ISNULL([welding_at_head_0_13_electrode_2],0) +
ISNULL([silicon_injection],0) +
ISNULL([welding_cap_insertion],0) +
ISNULL([welding_taping_13mm],0) +
ISNULL([hs_components_insertion],0) +
ISNULL([heat_shrink_la_terminal],0) +
ISNULL([heat_shrink_joint_crimping],0) +
ISNULL([heat_shrink_welding],0) +
ISNULL([casting_c385],0) +
ISNULL([stmac_shieldwire_nissan],0) +
ISNULL([quick_stripping_927_auto],0) +
ISNULL([quick_stripping_311_manual],0) +
ISNULL([manual_heat_shrink_blower_sumitube],0) +
ISNULL([drainwire_tip],0) +
ISNULL([manual_crimping_shieldwire_2t],0) +
ISNULL([manual_crimping_shieldwire_4t],0) +
ISNULL([joint_crimping_2tons_ps_800_s_2_sw],0) +
ISNULL([joint_crimping_2tons_ps_017_ss_2_sw],0) +
ISNULL([manual_blue_taping_dispenser_sw],0) +
ISNULL([shieldwire_taping],0) +
ISNULL([hs_components_insertion_sw],0) +
ISNULL([heat_shrink_joint_crimping_sw],0) +
ISNULL([waterproof_pad_press_joint],0) +
ISNULL([waterproof_pad_press_weld],0) +
ISNULL([low_viscosity],0) +
ISNULL([air_water_leak_test],0) +
ISNULL([hirose_sheath_stripping_927r],0) +
ISNULL([hirose_unistrip],0) +
ISNULL([hirose_acetate_taping],0) +
ISNULL([hirose_manual_crimping_2_tons],0) +
ISNULL([hirose_copper_taping],0) +
ISNULL([hirose_hgt17ap_crimping],0) +
ISNULL([casting_c373],0) +
ISNULL([casting_c377],0) +
ISNULL([casting_c371],0) +
ISNULL([stmac_aluminum],0) +
ISNULL([manual_crimping_20tons],0) +
ISNULL([manual_heat_shrink_blower_battery],0) +
ISNULL([joint_crimping_20tons],0) +
ISNULL([dip_soldering_battery],0) +
ISNULL([ultrasonic_dip_soldering_aluminum],0) +
ISNULL([la_molding],0) +
ISNULL([air_water_leak_test_2],0) +
ISNULL([pressure_welding_dome_lamp],0) +
ISNULL([ferrule_casting_c373],0) +
ISNULL([ferrule_parts_insertion],0) +
ISNULL([ferrule_braided_wire_folding],0) +
ISNULL([outside_ferrule_insertion],0) +
ISNULL([ferrule_manual_crimping_2t],0) +
ISNULL([ferrule_crimping],0) +
ISNULL([ferrule_joint_crimping_2t],0) +
ISNULL([ferrule_welding_at_head],0) +
ISNULL([ferrule_welding_taping],0) +
ISNULL([gomusen_insertion],0) +
ISNULL([point_marking],0) 
) AS Total

    FROM 
        [secondary_dashboard_db].[dbo].[sp_total_shots]
),

 -- =============================================================================== WIPPD ===============================================================================


WIPPD AS (

    SELECT 
        section,
        'WIP (Previous day)' AS general_process,
ISNULL([UV-III], 0) AS  uv_iii,
ISNULL([Arc Welding], 0) AS  arc_welding,
ISNULL([Aluminum Coating UV II], 0) AS  aluminum_coating_uv_ii,
ISNULL([Servo Crimping], 0) AS  servo_crimping,
ISNULL([Ultrasonic Welding], 0) AS  ultrasonic_welding,
ISNULL([Cap Insertion], 0) AS  cap_insertion,
ISNULL([Twisting Primary Aluminum], 0) AS  twisting_primary_aluminum,
ISNULL([Twisting Secondary Aluminum], 0) AS  twisting_secondary_aluminum,
ISNULL([Airbag], 0) AS  airbag,
ISNULL([A/B Sub PC], 0) AS  a_b_sub_pc,
ISNULL([Manual Insertion to Connector], 0) AS  manual_insertion_to_connector,
ISNULL([V Type Twisting], 0) AS  v_type_twisting,
ISNULL([Twisting Primary], 0) AS  twisting_primary,
ISNULL([Twisting Secondary], 0) AS  twisting_secondary,
ISNULL([Manual Crimping 2Tons], 0) AS  manual_crimping_2tons,
ISNULL([Manual Crimping 4Tons], 0) AS  manual_crimping_4tons,
ISNULL([Manual Crimping 5Tons], 0) AS  manual_crimping_5tons,
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) AS  intermediate_ripping_uas_manual_nf_f,
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) AS  intermediate_ripping_uas_joint,
ISNULL([Intermediate stripping(KB10)], 0) AS  intermediate_stripping_kb10,
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) AS  intermediate_stripping_kb10_nsc_weld,
ISNULL([Joint Crimping 2Tons], 0) AS  joint_crimping_2_tons,
ISNULL([Joint Crimping 4Tons(PS-200)], 0) AS  joint_crimping_4tons_ps_200,
ISNULL([Joint Crimping 5Tons], 0) AS  joint_crimping_5tons,
ISNULL([Manual Taping (Dispenser)], 0) AS  manual_taping_dispenser,
ISNULL([Joint Taping], 0) AS  joint_taping,
ISNULL([Intermediate Welding], 0) AS  intermediate_welding,
ISNULL([Intermediate Welding 0.13], 0) AS  intermediate_welding_0_13,
ISNULL([Welding at Head], 0) AS  welding_at_head,
ISNULL([Welding at Head 0.13], 0) AS  welding_at_head_0_13,
ISNULL([Silicon Injection], 0) AS  silicon_injection,
ISNULL([Welding Cap Insertion], 0) AS  welding_cap_insertion,
ISNULL([Welding Taping(13mm)], 0) AS  welding_taping_13mm,
ISNULL([Heatshrink], 0) AS  heat_shrink,
ISNULL([Heat Shrink LA terminal], 0) AS  heat_shrink_la_terminal,
ISNULL([Heat Shrink (Joint Crimping)], 0) AS  heat_shrink_joint_crimping,
ISNULL([Heat Shrink (Welding)], 0) AS  heat_shrink_welding,
ISNULL([Casting C385], 0) AS  casting_c385,
ISNULL([STMAC Shieldwire(Nissan)], 0) AS  stmac_shieldwire_nissan,
ISNULL([Quick Stripping], 0) AS  quick_stripping,
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) AS  manual_heat_shrink_blower_sumitube,
ISNULL([Drainwire Tip], 0) AS  drainwire_tip,
ISNULL([Manual Crimping Shieldwire], 0) AS  manual_crimping_shieldwire,
ISNULL([Joint Crimping 2TonsSW], 0) AS  joint_crimping_2_tons_sw,
ISNULL([Manual Blue Taping(Dispenser)SW], 0) AS  manual_blue_taping_dispenser_sw,
ISNULL([Shieldwire Taping], 0) AS  shieldwire_taping,
ISNULL([HS Components Insertion SW], 0) AS  hs_components_insertion_sw,
ISNULL([Heat Shrink (Joint Crimping)SW], 0) AS  heat_shrink_joint_crimping_sw,
ISNULL([Waterproof pad Press], 0) AS  waterproof_pad_press,
ISNULL([Low Vicosity], 0) AS  low_viscosity,
ISNULL([Air/Water leak test], 0) AS  air_water_leak_test,
ISNULL([HIROSE], 0) AS  hirose,
ISNULL([Casting Battery], 0) AS  casting_battery,
ISNULL([STMACAluminum], 0) AS  stmac_aluminum,
ISNULL([Manual Crimping 20Tons], 0) AS  manual_crimping_20tons,
ISNULL([Manual Heat Shrink (Blower)Battery], 0) AS  manual_heat_shrink_blower_battery,
ISNULL([Joint Crimping 20Tons], 0) AS  joint_crimping_20tons,
ISNULL([Dip Soldering (Battery)], 0) AS  dip_soldering_battery,
ISNULL([Ultrasonic Dip SolderingAluminum], 0) AS  ultrasonic_dip_soldering_aluminum,
ISNULL([La molding], 0) AS  la_molding,
ISNULL([Pressure Welding(Dome Lamp)], 0) AS  pressure_welding_dome_lamp,
ISNULL([Ferrule Process], 0) AS  ferrule_process,
ISNULL([Gomusen Insertion], 0) AS  gomusen_insertion,
ISNULL([Point Marking], 0) AS  point_marking,

ISNULL([UV-III], 0) +
ISNULL([Arc Welding], 0) +
ISNULL([Aluminum Coating UV II], 0) +
ISNULL([Servo Crimping], 0) +
ISNULL([Ultrasonic Welding], 0) +
ISNULL([Cap Insertion], 0) +
ISNULL([Twisting Primary Aluminum], 0) +
ISNULL([Twisting Secondary Aluminum], 0) +
ISNULL([Airbag], 0) +
ISNULL([A/B Sub PC], 0) +
ISNULL([Manual Insertion to Connector], 0) +
ISNULL([V Type Twisting], 0) +
ISNULL([Twisting Primary], 0) +
ISNULL([Twisting Secondary], 0) +
ISNULL([Manual Crimping 2Tons], 0) +
ISNULL([Manual Crimping 4Tons], 0) +
ISNULL([Manual Crimping 5Tons], 0) +
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) +
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) +
ISNULL([Joint Crimping 2Tons], 0) +
ISNULL([Joint Crimping 4Tons(PS-200)], 0) +
ISNULL([Joint Crimping 5Tons], 0) +
ISNULL([Manual Taping (Dispenser)], 0) +
ISNULL([Joint Taping], 0) +
ISNULL([Intermediate Welding], 0) +
ISNULL([Intermediate Welding 0.13], 0) +
ISNULL([Welding at Head], 0) +
ISNULL([Welding at Head 0.13], 0) +
ISNULL([Silicon Injection], 0) +
ISNULL([Welding Cap Insertion], 0) +
ISNULL([Welding Taping(13mm)], 0) +
ISNULL([Heatshrink], 0) +
ISNULL([Heat Shrink LA terminal], 0) +
ISNULL([Heat Shrink (Joint Crimping)], 0) +
ISNULL([Heat Shrink (Welding)], 0) +
ISNULL([Casting C385], 0) +
ISNULL([STMAC Shieldwire(Nissan)], 0) +
ISNULL([Quick Stripping], 0) +
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) +
ISNULL([Drainwire Tip], 0) +
ISNULL([Manual Crimping Shieldwire], 0) +
ISNULL([Joint Crimping 2TonsSW], 0) +
ISNULL([Manual Blue Taping(Dispenser)SW], 0) +
ISNULL([Shieldwire Taping], 0) +
ISNULL([HS Components Insertion SW], 0) +
ISNULL([Heat Shrink (Joint Crimping)SW], 0) +
ISNULL([Waterproof pad Press], 0) +
ISNULL([Low Vicosity], 0) +
ISNULL([Air/Water leak test], 0) +
ISNULL([HIROSE], 0) +
ISNULL([Casting Battery], 0) +
ISNULL([STMACAluminum], 0) +
ISNULL([Manual Crimping 20Tons], 0) +
ISNULL([Manual Heat Shrink (Blower)Battery], 0) +
ISNULL([Joint Crimping 20Tons], 0) +
ISNULL([Dip Soldering (Battery)], 0) +
ISNULL([Ultrasonic Dip SolderingAluminum], 0) +
ISNULL([La molding], 0) +
ISNULL([Pressure Welding(Dome Lamp)], 0) +
ISNULL([Ferrule Process], 0) +
ISNULL([Gomusen Insertion], 0) +
ISNULL([Point Marking], 0) 


   
        AS Total
    FROM (
        SELECT 
           CAST(REPLACE(section, 'Section ', '') AS VARCHAR) AS section,

            process,
            wip
        FROM 
            [secondary_dashboard_db].[dbo].[section_page]
        WHERE 
            details = 'Actual JPH'
            AND process IN (
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
'Low Vicosity',
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
)
    ) AS SourceTable
    PIVOT (
        SUM(wip)
        FOR process IN (
[UV-III],
[Arc Welding],
[Aluminum Coating UV II],
[Servo Crimping],
[Ultrasonic Welding],
[Cap Insertion],
[Twisting Primary Aluminum],
[Twisting Secondary Aluminum],
[Airbag],
[A/B Sub PC],
[Manual Insertion to Connector],
[V Type Twisting],
[Twisting Primary],
[Twisting Secondary],
[Manual Crimping 2Tons],
[Manual Crimping 4Tons],
[Manual Crimping 5Tons],
[Intermediate ripping(UAS)Manual-NF-F],
[Intermediate ripping (UAS)Joint stripping(KB10)],
[Intermediate stripping(KB10)],
[Intermediate stripping(KB10)NSC/Weld],
[Joint Crimping 2Tons],
[Joint Crimping 4Tons(PS-200)],
[Joint Crimping 5Tons],
[Manual Taping (Dispenser)],
[Joint Taping],
[Intermediate Welding],
[Intermediate Welding 0.13],
[Welding at Head],
[Welding at Head 0.13],
[Silicon Injection],
[Welding Cap Insertion],
[Welding Taping(13mm)],
[Heatshrink],
[Heat Shrink LA terminal],
[Heat Shrink (Joint Crimping)],
[Heat Shrink (Welding)],
[Casting C385],
[STMAC Shieldwire(Nissan)],
[Quick Stripping],
[Manual Heat Shrink(Blower)Sumitube],
[Drainwire Tip],
[Manual Crimping Shieldwire],
[Joint Crimping 2TonsSW],
[Manual Blue Taping(Dispenser)SW],
[Shieldwire Taping],
[HS Components Insertion SW],
[Heat Shrink (Joint Crimping)SW],
[Waterproof pad Press],
[Low Vicosity],
[Air/Water leak test],
[HIROSE],
[Casting Battery],
[STMACAluminum],
[Manual Crimping 20Tons],
[Manual Heat Shrink (Blower)Battery],
[Joint Crimping 20Tons],
[Dip Soldering (Battery)],
[Ultrasonic Dip SolderingAluminum],
[La molding],
[Pressure Welding(Dome Lamp)],
[Ferrule Process],
[Gomusen Insertion],
[Point Marking]
 )
    ) AS PivotTable

    UNION ALL

    SELECT 
        'Overall',
        'WIP (Previous day)',
SUM(ISNULL([UV-III], 0)),
SUM(ISNULL([Arc Welding], 0)),
SUM(ISNULL([Aluminum Coating UV II], 0)),
SUM(ISNULL([Servo Crimping], 0)),
SUM(ISNULL([Ultrasonic Welding], 0)),
SUM(ISNULL([Cap Insertion], 0)),
SUM(ISNULL([Twisting Primary Aluminum], 0)),
SUM(ISNULL([Twisting Secondary Aluminum], 0)),
SUM(ISNULL([Airbag], 0)),
SUM(ISNULL([A/B Sub PC], 0)),
SUM(ISNULL([Manual Insertion to Connector], 0)),
SUM(ISNULL([V Type Twisting], 0)),
SUM(ISNULL([Twisting Primary], 0)),
SUM(ISNULL([Twisting Secondary], 0)),
SUM(ISNULL([Manual Crimping 2Tons], 0)),
SUM(ISNULL([Manual Crimping 4Tons], 0)),
SUM(ISNULL([Manual Crimping 5Tons], 0)),
SUM(ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0)),
SUM(ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0)),
SUM(ISNULL([Intermediate stripping(KB10)], 0)),
SUM(ISNULL([Intermediate stripping(KB10)NSC/Weld], 0)),
SUM(ISNULL([Joint Crimping 2Tons], 0)),
SUM(ISNULL([Joint Crimping 4Tons(PS-200)], 0)),
SUM(ISNULL([Joint Crimping 5Tons], 0)),
SUM(ISNULL([Manual Taping (Dispenser)], 0)),
SUM(ISNULL([Joint Taping], 0)),
SUM(ISNULL([Intermediate Welding], 0)),
SUM(ISNULL([Intermediate Welding 0.13], 0)),
SUM(ISNULL([Welding at Head], 0)),
SUM(ISNULL([Welding at Head 0.13], 0)),
SUM(ISNULL([Silicon Injection], 0)),
SUM(ISNULL([Welding Cap Insertion], 0)),
SUM(ISNULL([Welding Taping(13mm)], 0)),
SUM(ISNULL([Heatshrink], 0)),
SUM(ISNULL([Heat Shrink LA terminal], 0)),
SUM(ISNULL([Heat Shrink (Joint Crimping)], 0)),
SUM(ISNULL([Heat Shrink (Welding)], 0)),
SUM(ISNULL([Casting C385], 0)),
SUM(ISNULL([STMAC Shieldwire(Nissan)], 0)),
SUM(ISNULL([Quick Stripping], 0)),
SUM(ISNULL([Manual Heat Shrink(Blower)Sumitube], 0)),
SUM(ISNULL([Drainwire Tip], 0)),
SUM(ISNULL([Manual Crimping Shieldwire], 0)),
SUM(ISNULL([Joint Crimping 2TonsSW], 0)),
SUM(ISNULL([Manual Blue Taping(Dispenser)SW], 0)),
SUM(ISNULL([Shieldwire Taping], 0)),
SUM(ISNULL([HS Components Insertion SW], 0)),
SUM(ISNULL([Heat Shrink (Joint Crimping)SW], 0)),
SUM(ISNULL([Waterproof pad Press], 0)),
SUM(ISNULL([Low Vicosity], 0)),
SUM(ISNULL([Air/Water leak test], 0)),
SUM(ISNULL([HIROSE], 0)),
SUM(ISNULL([Casting Battery], 0)),
SUM(ISNULL([STMACAluminum], 0)),
SUM(ISNULL([Manual Crimping 20Tons], 0)),
SUM(ISNULL([Manual Heat Shrink (Blower)Battery], 0)),
SUM(ISNULL([Joint Crimping 20Tons], 0)),
SUM(ISNULL([Dip Soldering (Battery)], 0)),
SUM(ISNULL([Ultrasonic Dip SolderingAluminum], 0)),
SUM(ISNULL([La molding], 0)),
SUM(ISNULL([Pressure Welding(Dome Lamp)], 0)),
SUM(ISNULL([Ferrule Process], 0)),
SUM(ISNULL([Gomusen Insertion], 0)),
SUM(ISNULL([Point Marking], 0)),
 SUM(
ISNULL([UV-III], 0) +
ISNULL([Arc Welding], 0) +
ISNULL([Aluminum Coating UV II], 0) +
ISNULL([Servo Crimping], 0) +
ISNULL([Ultrasonic Welding], 0) +
ISNULL([Cap Insertion], 0) +
ISNULL([Twisting Primary Aluminum], 0) +
ISNULL([Twisting Secondary Aluminum], 0) +
ISNULL([Airbag], 0) +
ISNULL([A/B Sub PC], 0) +
ISNULL([Manual Insertion to Connector], 0) +
ISNULL([V Type Twisting], 0) +
ISNULL([Twisting Primary], 0) +
ISNULL([Twisting Secondary], 0) +
ISNULL([Manual Crimping 2Tons], 0) +
ISNULL([Manual Crimping 4Tons], 0) +
ISNULL([Manual Crimping 5Tons], 0) +
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) +
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) +
ISNULL([Joint Crimping 2Tons], 0) +
ISNULL([Joint Crimping 4Tons(PS-200)], 0) +
ISNULL([Joint Crimping 5Tons], 0) +
ISNULL([Manual Taping (Dispenser)], 0) +
ISNULL([Joint Taping], 0) +
ISNULL([Intermediate Welding], 0) +
ISNULL([Intermediate Welding 0.13], 0) +
ISNULL([Welding at Head], 0) +
ISNULL([Welding at Head 0.13], 0) +
ISNULL([Silicon Injection], 0) +
ISNULL([Welding Cap Insertion], 0) +
ISNULL([Welding Taping(13mm)], 0) +
ISNULL([Heatshrink], 0) +
ISNULL([Heat Shrink LA terminal], 0) +
ISNULL([Heat Shrink (Joint Crimping)], 0) +
ISNULL([Heat Shrink (Welding)], 0) +
ISNULL([Casting C385], 0) +
ISNULL([STMAC Shieldwire(Nissan)], 0) +
ISNULL([Quick Stripping], 0) +
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) +
ISNULL([Drainwire Tip], 0) +
ISNULL([Manual Crimping Shieldwire], 0) +
ISNULL([Joint Crimping 2TonsSW], 0) +
ISNULL([Manual Blue Taping(Dispenser)SW], 0) +
ISNULL([Shieldwire Taping], 0) +
ISNULL([HS Components Insertion SW], 0) +
ISNULL([Heat Shrink (Joint Crimping)SW], 0) +
ISNULL([Waterproof pad Press], 0) +
ISNULL([Low Vicosity], 0) +
ISNULL([Air/Water leak test], 0) +
ISNULL([HIROSE], 0) +
ISNULL([Casting Battery], 0) +
ISNULL([STMACAluminum], 0) +
ISNULL([Manual Crimping 20Tons], 0) +
ISNULL([Manual Heat Shrink (Blower)Battery], 0) +
ISNULL([Joint Crimping 20Tons], 0) +
ISNULL([Dip Soldering (Battery)], 0) +
ISNULL([Ultrasonic Dip SolderingAluminum], 0) +
ISNULL([La molding], 0) +
ISNULL([Pressure Welding(Dome Lamp)], 0) +
ISNULL([Ferrule Process], 0) +
ISNULL([Gomusen Insertion], 0) +
ISNULL([Point Marking], 0) 
  )
    FROM (
        SELECT 
            section,
            process,
            wip
        FROM 
            [secondary_dashboard_db].[dbo].[section_page]
        WHERE 
            details = 'Actual JPH'
            AND process IN (
               'UV-III',
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
'Low Vicosity',
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
  )
    ) AS SourceTable
    PIVOT (
        SUM(wip)
        FOR process IN (
[UV-III],
[Arc Welding],
[Aluminum Coating UV II],
[Servo Crimping],
[Ultrasonic Welding],
[Cap Insertion],
[Twisting Primary Aluminum],
[Twisting Secondary Aluminum],
[Airbag],
[A/B Sub PC],
[Manual Insertion to Connector],
[V Type Twisting],
[Twisting Primary],
[Twisting Secondary],
[Manual Crimping 2Tons],
[Manual Crimping 4Tons],
[Manual Crimping 5Tons],
[Intermediate ripping(UAS)Manual-NF-F],
[Intermediate ripping (UAS)Joint stripping(KB10)],
[Intermediate stripping(KB10)],
[Intermediate stripping(KB10)NSC/Weld],
[Joint Crimping 2Tons],
[Joint Crimping 4Tons(PS-200)],
[Joint Crimping 5Tons],
[Manual Taping (Dispenser)],
[Joint Taping],
[Intermediate Welding],
[Intermediate Welding 0.13],
[Welding at Head],
[Welding at Head 0.13],
[Silicon Injection],
[Welding Cap Insertion],
[Welding Taping(13mm)],
[Heatshrink],
[Heat Shrink LA terminal],
[Heat Shrink (Joint Crimping)],
[Heat Shrink (Welding)],
[Casting C385],
[STMAC Shieldwire(Nissan)],
[Quick Stripping],
[Manual Heat Shrink(Blower)Sumitube],
[Drainwire Tip],
[Manual Crimping Shieldwire],
[Joint Crimping 2TonsSW],
[Manual Blue Taping(Dispenser)SW],
[Shieldwire Taping],
[HS Components Insertion SW],
[Heat Shrink (Joint Crimping)SW],
[Waterproof pad Press],
[Low Vicosity],
[Air/Water leak test],
[HIROSE],
[Casting Battery],
[STMACAluminum],
[Manual Crimping 20Tons],
[Manual Heat Shrink (Blower)Battery],
[Joint Crimping 20Tons],
[Dip Soldering (Battery)],
[Ultrasonic Dip SolderingAluminum],
[La molding],
[Pressure Welding(Dome Lamp)],
[Ferrule Process],
[Gomusen Insertion],
[Point Marking]

     )
    ) AS PivotTable
),

 -- =============================================================================== Target OUTPUT WIP+PLAN ===============================================================================

TargetOutputWIP AS (
    SELECT
        [section] AS section,
        'Target Output (WIP+Plan)' AS general_process,
       SUM([uv_iii_1] + [uv_iii_2] + [uv_iii_4] + [uv_iii_5] + [uv_iii_7] + [uv_iii_8]) AS uv_iii,
SUM(arc_welding) AS arc_welding,
SUM([aluminum_coating_uv_ii]) AS aluminum_coating_uv_ii,
SUM([servo_crimping]) AS servo_crimping,
SUM(ultrasonic_welding) AS ultrasonic_welding,
SUM([cap_insertion]) AS cap_insertion,
SUM([twisting_primary_aluminum_short_wires_l_1_3000mm] + [twisting_primary_aluminum_long_wires_l_3001mm]) AS twisting_primary_aluminum,
SUM([twisting_secondary_aluminum_short_wires_l_1_3000mm] + [twisting_secondary_aluminum_long_wires_l_3001mm]) AS twisting_secondary_aluminum,
SUM([airbag]) AS airbag,
SUM([a_b_sub_pc]) AS a_b_sub_pc,
SUM([manual_insertion_to_connector]) AS manual_insertion_to_connector,
SUM([v_type_twisting]) AS v_type_twisting,
SUM([twisting_primary_normal_short_wires_l_1_3000mm] + [twisting_primary_normal_long_wires_l_3001mm]) AS twisting_primary,
SUM([twisting_secondary_normal_short_wires_l_1_3000mm] + [twisting_secondary_normal_long_wires_l_3001mm]) AS twisting_secondary,
SUM([manual_crimping_2tons_with_gomusen] + [manual_crimping_2tons_normal_single_crimp] + [manual_crimping_2tons_normal_double_crimp] + [manual_crimping_2tons_to_be_joint_on_sw] + [manual_crimping_2tons_nsc_weld]) AS manual_crimping_2tons,
SUM([manual_crimping_4tons_normal_terminal] + [manual_crimping_4tons_la_terminal] + [manual_crimping_nf_f]) AS manual_crimping_4tons,
SUM([manual_crimping_5tons]) AS manual_crimping_5tons,
SUM([intermediate_ripping_uas_manual_nf_f]) AS intermediate_ripping_uas_manual_nf_f,
SUM([intermediate_ripping_uas_joint]) AS intermediate_ripping_uas_joint,
SUM([intermediate_stripping_kb10]) AS intermediate_stripping_kb10,
SUM([intermediate_stripping_kb10_nsc_weld]) AS intermediate_stripping_kb10_nsc_weld,
SUM([joint_crimping_2tons_ps_800] + [joint_crimping_2tons_ps_700]+[joint_crimping_2tons_ps_017_126] + [joint_crimping_2tons_nsc_weld] ) AS joint_crimping_2_tons,
SUM([joint_crimping_4tons_ps_200]) AS joint_crimping_4tons_ps_200,
SUM([joint_crimping_5tons]) AS joint_crimping_5tons,
SUM([manual_taping_dispenser]) AS manual_taping_dispenser,
SUM([joint_taping_13mm] + [joint_taping_12mm]+[joint_taping_11mm]) AS joint_taping,
SUM([intermediate_welding_electrode_1] + [intermediate_welding_electrode_2] + [intermediate_welding_electrode_3] + [intermediate_welding_electrode_4] + [intermediate_welding_electrode_5]) AS intermediate_welding,
SUM([intermediate_welding_0_13_electrode_1] + [intermediate_welding_0_13_electrode_2]) AS intermediate_welding_0_13,
SUM([welding_at_head_electrode_1] + [welding_at_head_electrode_2] + [welding_at_head_electrode_3] + [welding_at_head_electrode_4] + [welding_at_head_electrode_5]) AS welding_at_head,
SUM([welding_at_head_0_13_electrode_1] + [welding_at_head_0_13_electrode_2]) AS welding_at_head_0_13,
SUM([silicon_injection]) AS silicon_injection,
SUM([welding_cap_insertion]) AS welding_cap_insertion,
SUM([welding_taping_13mm]) AS welding_taping_13mm,
SUM([hs_components_insertion]) AS heat_shrink,
SUM([heat_shrink_la_terminal]) AS heat_shrink_la_terminal,
SUM([heat_shrink_joint_crimping]) AS heat_shrink_joint_crimping,
SUM([heat_shrink_welding]) AS heat_shrink_welding,
SUM([casting_c385]) AS casting_c385,
SUM([stmac_shieldwire_nissan]) AS stmac_shieldwire_nissan,
SUM([quick_stripping_927_auto] + [quick_stripping_311_manual]) AS quick_stripping,
SUM([manual_heat_shrink_blower_sumitube]) AS manual_heat_shrink_blower_sumitube,
SUM([drainwire_tip]) AS drainwire_tip,
SUM([manual_crimping_shieldwire_2t] + [manual_crimping_shieldwire_4t]) AS manual_crimping_shieldwire,
SUM([joint_crimping_2tons_ps_800_s_2_sw] + [joint_crimping_2tons_ps_017_ss_2_sw]) AS joint_crimping_2_tons_sw,
SUM([manual_blue_taping_dispenser_sw]) AS manual_blue_taping_dispenser_sw,
SUM([shieldwire_taping]) AS shieldwire_taping,
SUM([hs_components_insertion_sw]) AS hs_components_insertion_sw,
SUM([heat_shrink_joint_crimping_sw]) AS heat_shrink_joint_crimping_sw,
SUM([waterproof_pad_press_joint] + [waterproof_pad_press_weld]) AS waterproof_pad_press,
SUM([low_viscosity]) AS low_viscosity,
SUM([air_water_leak_test]) AS air_water_leak_test,
SUM([hirose_sheath_stripping_927r] + [hirose_unistrip] + [hirose_acetate_taping] + [hirose_manual_crimping_2_tons] + [hirose_copper_taping] + [hirose_hgt17ap_crimping]) AS hirose,
SUM([casting_c373] + [casting_c377] + [casting_c371])  AS casting_battery,
SUM([stmac_aluminum]) AS stmac_aluminum,
SUM([manual_crimping_20tons]) AS manual_crimping_20tons,
SUM([manual_heat_shrink_blower_battery]) AS manual_heat_shrink_blower_battery,
SUM([joint_crimping_20tons]) AS joint_crimping_20tons,
SUM([dip_soldering_battery]) AS dip_soldering_battery,
SUM([ultrasonic_dip_soldering_aluminum]) AS ultrasonic_dip_soldering_aluminum,
SUM([la_molding] + [air_water_leak_test_2]) AS la_molding,
SUM([pressure_welding_dome_lamp])  AS pressure_welding_dome_lamp,
SUM([ferrule_casting_c373] + [ferrule_parts_insertion] + [ferrule_braided_wire_folding] )  AS ferrule_process,
SUM([gomusen_insertion]) AS gomusen_insertion,
SUM([point_marking])  AS point_marking,

SUM(
ISNULL([uv_iii_1],0) +
ISNULL([uv_iii_2],0) +
ISNULL([uv_iii_4],0) +
ISNULL([uv_iii_5],0) +
ISNULL([uv_iii_7],0) +
ISNULL([uv_iii_8],0) +
ISNULL([arc_welding],0) +
ISNULL([aluminum_coating_uv_ii],0) +
ISNULL([servo_crimping],0) +
ISNULL([ultrasonic_welding],0) +
ISNULL([cap_insertion],0) +
ISNULL([twisting_primary_aluminum_short_wires_l_1_3000mm],0) +
ISNULL([twisting_primary_aluminum_long_wires_l_3001mm],0) +
ISNULL([twisting_secondary_aluminum_short_wires_l_1_3000mm],0) +
ISNULL([twisting_secondary_aluminum_long_wires_l_3001mm],0) +
ISNULL([airbag],0) +
ISNULL([a_b_sub_pc],0) +
ISNULL([manual_insertion_to_connector],0) +
ISNULL([v_type_twisting],0) +
ISNULL([twisting_primary_normal_short_wires_l_1_3000mm],0) +
ISNULL([twisting_primary_normal_long_wires_l_3001mm],0) +
ISNULL([twisting_secondary_normal_short_wires_l_1_3000mm],0) +
ISNULL([twisting_secondary_normal_long_wires_l_3001mm],0) +
ISNULL([manual_crimping_2tons_with_gomusen],0) +
ISNULL([manual_crimping_2tons_normal_single_crimp],0) +
ISNULL([manual_crimping_2tons_normal_double_crimp],0) +
ISNULL([manual_crimping_2tons_to_be_joint_on_sw],0) +
ISNULL([manual_crimping_2tons_nsc_weld],0) +
ISNULL([manual_crimping_4tons_normal_terminal],0) +
ISNULL([manual_crimping_4tons_la_terminal],0) +
ISNULL([manual_crimping_nf_f],0) +
ISNULL([manual_crimping_5tons],0) +
ISNULL([intermediate_ripping_uas_manual_nf_f],0) +
ISNULL([intermediate_ripping_uas_joint],0) +
ISNULL([intermediate_stripping_kb10],0) +
ISNULL([intermediate_stripping_kb10_nsc_weld],0) +
ISNULL([joint_crimping_2tons_ps_800],0) +
ISNULL([joint_crimping_2tons_ps_700],0) +
ISNULL([joint_crimping_2tons_ps_017_126],0) +
ISNULL([joint_crimping_2tons_nsc_weld],0) +
ISNULL([joint_crimping_4tons_ps_200],0) +
ISNULL([joint_crimping_5tons],0) +
ISNULL([manual_taping_dispenser],0) +
ISNULL([joint_taping_11mm],0) +
ISNULL([joint_taping_12mm],0) +
ISNULL([joint_taping_13mm],0) +
ISNULL([joint_taping_13mm_nsc_weld],0) +
ISNULL([intermediate_welding_electrode_1],0) +
ISNULL([intermediate_welding_electrode_2],0) +
ISNULL([intermediate_welding_electrode_3],0) +
ISNULL([intermediate_welding_electrode_4],0) +
ISNULL([intermediate_welding_electrode_5],0) +
ISNULL([intermediate_welding_0_13_electrode_1],0) +
ISNULL([intermediate_welding_0_13_electrode_2],0) +
ISNULL([welding_at_head_electrode_1],0) +
ISNULL([welding_at_head_electrode_2],0) +
ISNULL([welding_at_head_electrode_3],0) +
ISNULL([welding_at_head_electrode_4],0) +
ISNULL([welding_at_head_electrode_5],0) +
ISNULL([welding_at_head_0_13_electrode_1],0) +
ISNULL([welding_at_head_0_13_electrode_2],0) +
ISNULL([silicon_injection],0) +
ISNULL([welding_cap_insertion],0) +
ISNULL([welding_taping_13mm],0) +
ISNULL([hs_components_insertion],0) +
ISNULL([heat_shrink_la_terminal],0) +
ISNULL([heat_shrink_joint_crimping],0) +
ISNULL([heat_shrink_welding],0) +
ISNULL([casting_c385],0) +
ISNULL([stmac_shieldwire_nissan],0) +
ISNULL([quick_stripping_927_auto],0) +
ISNULL([quick_stripping_311_manual],0) +
ISNULL([manual_heat_shrink_blower_sumitube],0) +
ISNULL([drainwire_tip],0) +
ISNULL([manual_crimping_shieldwire_2t],0) +
ISNULL([manual_crimping_shieldwire_4t],0) +
ISNULL([joint_crimping_2tons_ps_800_s_2_sw],0) +
ISNULL([joint_crimping_2tons_ps_017_ss_2_sw],0) +
ISNULL([manual_blue_taping_dispenser_sw],0) +
ISNULL([shieldwire_taping],0) +
ISNULL([hs_components_insertion_sw],0) +
ISNULL([heat_shrink_joint_crimping_sw],0) +
ISNULL([waterproof_pad_press_joint],0) +
ISNULL([waterproof_pad_press_weld],0) +
ISNULL([low_viscosity],0) +
ISNULL([air_water_leak_test],0) +
ISNULL([hirose_sheath_stripping_927r],0) +
ISNULL([hirose_unistrip],0) +
ISNULL([hirose_acetate_taping],0) +
ISNULL([hirose_manual_crimping_2_tons],0) +
ISNULL([hirose_copper_taping],0) +
ISNULL([hirose_hgt17ap_crimping],0) +
ISNULL([casting_c373],0) +
ISNULL([casting_c377],0) +
ISNULL([casting_c371],0) +
ISNULL([stmac_aluminum],0) +
ISNULL([manual_crimping_20tons],0) +
ISNULL([manual_heat_shrink_blower_battery],0) +
ISNULL([joint_crimping_20tons],0) +
ISNULL([dip_soldering_battery],0) +
ISNULL([ultrasonic_dip_soldering_aluminum],0) +
ISNULL([la_molding],0) +
ISNULL([air_water_leak_test_2],0) +
ISNULL([pressure_welding_dome_lamp],0) +
ISNULL([ferrule_casting_c373],0) +
ISNULL([ferrule_parts_insertion],0) +
ISNULL([ferrule_braided_wire_folding],0) +
ISNULL([outside_ferrule_insertion],0) +
ISNULL([ferrule_manual_crimping_2t],0) +
ISNULL([ferrule_crimping],0) +
ISNULL([ferrule_joint_crimping_2t],0) +
ISNULL([ferrule_welding_at_head],0) +
ISNULL([ferrule_welding_taping],0) +
ISNULL([gomusen_insertion],0) +
ISNULL([point_marking],0) 
        ) AS Total
    FROM 
        [secondary_dashboard_db].[dbo].[sp_total_shots]
    GROUP BY 
           [section]
    UNION ALL
    SELECT
        'Overall',
        'Target Output (WIP+Plan)',
 SUM([uv_iii_1] + [uv_iii_2] + [uv_iii_4] + [uv_iii_5] + [uv_iii_7] + [uv_iii_8]),
 SUM(arc_welding),
 SUM([aluminum_coating_uv_ii]),
 SUM([servo_crimping]),
 SUM(ultrasonic_welding),
 SUM([cap_insertion]),
 SUM([twisting_primary_aluminum_short_wires_l_1_3000mm] + [twisting_primary_aluminum_long_wires_l_3001mm]),
 SUM([twisting_secondary_aluminum_short_wires_l_1_3000mm] + [twisting_secondary_aluminum_long_wires_l_3001mm]),
 SUM([airbag]),
 SUM([a_b_sub_pc]),
 SUM([manual_insertion_to_connector]),
 SUM([v_type_twisting]),
 SUM([twisting_primary_normal_short_wires_l_1_3000mm] + [twisting_primary_normal_long_wires_l_3001mm]),
 SUM([twisting_secondary_normal_short_wires_l_1_3000mm] + [twisting_secondary_normal_long_wires_l_3001mm]),
 SUM([manual_crimping_2tons_with_gomusen] + [manual_crimping_2tons_normal_single_crimp] + [manual_crimping_2tons_normal_double_crimp] + [manual_crimping_2tons_to_be_joint_on_sw] + [manual_crimping_2tons_nsc_weld]),
 SUM([manual_crimping_4tons_normal_terminal] + [manual_crimping_4tons_la_terminal] + [manual_crimping_nf_f]),
 SUM([manual_crimping_5tons]),
 SUM([intermediate_ripping_uas_manual_nf_f]),
 SUM([intermediate_ripping_uas_joint]),
 SUM([intermediate_stripping_kb10]),
 SUM([intermediate_stripping_kb10_nsc_weld]),
 SUM([joint_crimping_2tons_ps_800] + [joint_crimping_2tons_ps_700]+[joint_crimping_2tons_ps_017_126] + [joint_crimping_2tons_nsc_weld] ),
 SUM([joint_crimping_4tons_ps_200]),
 SUM([joint_crimping_5tons]),
 SUM([manual_taping_dispenser]),
 SUM([joint_taping_13mm] + [joint_taping_12mm]+[joint_taping_11mm]),
 SUM([intermediate_welding_electrode_1] + [intermediate_welding_electrode_2] + [intermediate_welding_electrode_3] + [intermediate_welding_electrode_4] + [intermediate_welding_electrode_5]),
 SUM([intermediate_welding_0_13_electrode_1] + [intermediate_welding_0_13_electrode_2]),
 SUM([welding_at_head_electrode_1] + [welding_at_head_electrode_2] + [welding_at_head_electrode_3] + [welding_at_head_electrode_4] + [welding_at_head_electrode_5]),
 SUM([welding_at_head_0_13_electrode_1] + [welding_at_head_0_13_electrode_2]),
 SUM([silicon_injection]),
 SUM([welding_cap_insertion]),
 SUM([welding_taping_13mm]),
 SUM([hs_components_insertion]),
 SUM([heat_shrink_la_terminal]),
 SUM([heat_shrink_joint_crimping]),
 SUM([heat_shrink_welding]),
 SUM([casting_c385]),
 SUM([stmac_shieldwire_nissan]),
 SUM([quick_stripping_927_auto] + [quick_stripping_311_manual]),
 SUM([manual_heat_shrink_blower_sumitube]),
 SUM([drainwire_tip]),
 SUM([manual_crimping_shieldwire_2t] + [manual_crimping_shieldwire_4t]),
 SUM([joint_crimping_2tons_ps_800_s_2_sw] + [joint_crimping_2tons_ps_017_ss_2_sw]) AS joint_crimping_2_tons_sw,
 SUM([manual_blue_taping_dispenser_sw]),
 SUM([shieldwire_taping]),
 SUM([hs_components_insertion_sw]),
 SUM([heat_shrink_joint_crimping_sw]),
 SUM([waterproof_pad_press_joint] + [waterproof_pad_press_weld]),
 SUM([low_viscosity]),
 SUM([air_water_leak_test]),
 SUM([hirose_sheath_stripping_927r] + [hirose_unistrip] + [hirose_acetate_taping] + [hirose_manual_crimping_2_tons] + [hirose_copper_taping] + [hirose_hgt17ap_crimping]),
 SUM([casting_c373] + [casting_c377] + [casting_c371]),
 SUM([stmac_aluminum]),
 SUM([manual_crimping_20tons]),
 SUM([manual_heat_shrink_blower_battery]),
 SUM([joint_crimping_20tons]),
 SUM([dip_soldering_battery]),
 SUM([ultrasonic_dip_soldering_aluminum]),
 SUM([la_molding] + [air_water_leak_test_2]),
 SUM([pressure_welding_dome_lamp]),
 SUM([ferrule_casting_c373] + [ferrule_parts_insertion] + [ferrule_braided_wire_folding] ),
 SUM([gomusen_insertion]) AS gomusen_insertion,
 SUM([point_marking]),

      SUM(
ISNULL([uv_iii_1],0) +
ISNULL([uv_iii_2],0) +
ISNULL([uv_iii_4],0) +
ISNULL([uv_iii_5],0) +
ISNULL([uv_iii_7],0) +
ISNULL([uv_iii_8],0) +
ISNULL([arc_welding],0) +
ISNULL([aluminum_coating_uv_ii],0) +
ISNULL([servo_crimping],0) +
ISNULL([ultrasonic_welding],0) +
ISNULL([cap_insertion],0) +
ISNULL([twisting_primary_aluminum_short_wires_l_1_3000mm],0) +
ISNULL([twisting_primary_aluminum_long_wires_l_3001mm],0) +
ISNULL([twisting_secondary_aluminum_short_wires_l_1_3000mm],0) +
ISNULL([twisting_secondary_aluminum_long_wires_l_3001mm],0) +
ISNULL([airbag],0) +
ISNULL([a_b_sub_pc],0) +
ISNULL([manual_insertion_to_connector],0) +
ISNULL([v_type_twisting],0) +
ISNULL([twisting_primary_normal_short_wires_l_1_3000mm],0) +
ISNULL([twisting_primary_normal_long_wires_l_3001mm],0) +
ISNULL([twisting_secondary_normal_short_wires_l_1_3000mm],0) +
ISNULL([twisting_secondary_normal_long_wires_l_3001mm],0) +
ISNULL([manual_crimping_2tons_with_gomusen],0) +
ISNULL([manual_crimping_2tons_normal_single_crimp],0) +
ISNULL([manual_crimping_2tons_normal_double_crimp],0) +
ISNULL([manual_crimping_2tons_to_be_joint_on_sw],0) +
ISNULL([manual_crimping_2tons_nsc_weld],0) +
ISNULL([manual_crimping_4tons_normal_terminal],0) +
ISNULL([manual_crimping_4tons_la_terminal],0) +
ISNULL([manual_crimping_nf_f],0) +
ISNULL([manual_crimping_5tons],0) +
ISNULL([intermediate_ripping_uas_manual_nf_f],0) +
ISNULL([intermediate_ripping_uas_joint],0) +
ISNULL([intermediate_stripping_kb10],0) +
ISNULL([intermediate_stripping_kb10_nsc_weld],0) +
ISNULL([joint_crimping_2tons_ps_800],0) +
ISNULL([joint_crimping_2tons_ps_700],0) +
ISNULL([joint_crimping_2tons_ps_017_126],0) +
ISNULL([joint_crimping_2tons_nsc_weld],0) +
ISNULL([joint_crimping_4tons_ps_200],0) +
ISNULL([joint_crimping_5tons],0) +
ISNULL([manual_taping_dispenser],0) +
ISNULL([joint_taping_11mm],0) +
ISNULL([joint_taping_12mm],0) +
ISNULL([joint_taping_13mm],0) +
ISNULL([joint_taping_13mm_nsc_weld],0) +
ISNULL([intermediate_welding_electrode_1],0) +
ISNULL([intermediate_welding_electrode_2],0) +
ISNULL([intermediate_welding_electrode_3],0) +
ISNULL([intermediate_welding_electrode_4],0) +
ISNULL([intermediate_welding_electrode_5],0) +
ISNULL([intermediate_welding_0_13_electrode_1],0) +
ISNULL([intermediate_welding_0_13_electrode_2],0) +
ISNULL([welding_at_head_electrode_1],0) +
ISNULL([welding_at_head_electrode_2],0) +
ISNULL([welding_at_head_electrode_3],0) +
ISNULL([welding_at_head_electrode_4],0) +
ISNULL([welding_at_head_electrode_5],0) +
ISNULL([welding_at_head_0_13_electrode_1],0) +
ISNULL([welding_at_head_0_13_electrode_2],0) +
ISNULL([silicon_injection],0) +
ISNULL([welding_cap_insertion],0) +
ISNULL([welding_taping_13mm],0) +
ISNULL([hs_components_insertion],0) +
ISNULL([heat_shrink_la_terminal],0) +
ISNULL([heat_shrink_joint_crimping],0) +
ISNULL([heat_shrink_welding],0) +
ISNULL([casting_c385],0) +
ISNULL([stmac_shieldwire_nissan],0) +
ISNULL([quick_stripping_927_auto],0) +
ISNULL([quick_stripping_311_manual],0) +
ISNULL([manual_heat_shrink_blower_sumitube],0) +
ISNULL([drainwire_tip],0) +
ISNULL([manual_crimping_shieldwire_2t],0) +
ISNULL([manual_crimping_shieldwire_4t],0) +
ISNULL([joint_crimping_2tons_ps_800_s_2_sw],0) +
ISNULL([joint_crimping_2tons_ps_017_ss_2_sw],0) +
ISNULL([manual_blue_taping_dispenser_sw],0) +
ISNULL([shieldwire_taping],0) +
ISNULL([hs_components_insertion_sw],0) +
ISNULL([heat_shrink_joint_crimping_sw],0) +
ISNULL([waterproof_pad_press_joint],0) +
ISNULL([waterproof_pad_press_weld],0) +
ISNULL([low_viscosity],0) +
ISNULL([air_water_leak_test],0) +
ISNULL([hirose_sheath_stripping_927r],0) +
ISNULL([hirose_unistrip],0) +
ISNULL([hirose_acetate_taping],0) +
ISNULL([hirose_manual_crimping_2_tons],0) +
ISNULL([hirose_copper_taping],0) +
ISNULL([hirose_hgt17ap_crimping],0) +
ISNULL([casting_c373],0) +
ISNULL([casting_c377],0) +
ISNULL([casting_c371],0) +
ISNULL([stmac_aluminum],0) +
ISNULL([manual_crimping_20tons],0) +
ISNULL([manual_heat_shrink_blower_battery],0) +
ISNULL([joint_crimping_20tons],0) +
ISNULL([dip_soldering_battery],0) +
ISNULL([ultrasonic_dip_soldering_aluminum],0) +
ISNULL([la_molding],0) +
ISNULL([air_water_leak_test_2],0) +
ISNULL([pressure_welding_dome_lamp],0) +
ISNULL([ferrule_casting_c373],0) +
ISNULL([ferrule_parts_insertion],0) +
ISNULL([ferrule_braided_wire_folding],0) +
ISNULL([outside_ferrule_insertion],0) +
ISNULL([ferrule_manual_crimping_2t],0) +
ISNULL([ferrule_crimping],0) +
ISNULL([ferrule_joint_crimping_2t],0) +
ISNULL([ferrule_welding_at_head],0) +
ISNULL([ferrule_welding_taping],0) +
ISNULL([gomusen_insertion],0) +
ISNULL([point_marking],0) 
) AS Total

    FROM 
        [secondary_dashboard_db].[dbo].[sp_total_shots]
	),	


 -- =============================================================================== Target JPH ===============================================================================







 TargetJPH AS (

    SELECT 
        section,
        'Target JPH' AS general_process,
ISNULL([UV-III], 0) AS uv_iii,
ISNULL([Arc Welding], 0) AS arc_welding,
ISNULL([Aluminum Coating UV II], 0) AS aluminum_coating_uv_ii,
ISNULL([Servo Crimping], 0) AS servo_crimping,
ISNULL([Ultrasonic Welding], 0) AS ultrasonic_welding,
ISNULL([Cap Insertion], 0) AS cap_insertion,
ISNULL([Twisting Primary Aluminum], 0) AS twisting_primary_aluminum,
ISNULL([Twisting Secondary Aluminum], 0) AS twisting_secondary_aluminum,
ISNULL([Airbag], 0) AS airbag,
ISNULL([A/B Sub PC], 0) AS a_b_sub_pc,
ISNULL([Manual Insertion to Connector], 0) AS manual_insertion_to_connector,
ISNULL([V Type Twisting], 0) AS v_type_twisting,
ISNULL([Twisting Primary], 0) AS twisting_primary,
ISNULL([Twisting Secondary], 0) AS twisting_secondary,
ISNULL([Manual Crimping 2Tons], 0) AS manual_crimping_2tons,
ISNULL([Manual Crimping 4Tons], 0) AS manual_crimping_4tons,
ISNULL([Manual Crimping 5Tons], 0) AS manual_crimping_5tons,
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) AS intermediate_ripping_uas_manual_nf_f,
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) AS intermediate_ripping_uas_joint,
ISNULL([Intermediate stripping(KB10)], 0) AS intermediate_stripping_kb10,
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) AS intermediate_stripping_kb10_nsc_weld,
ISNULL([Joint Crimping 2Tons], 0) AS joint_crimping_2_tons,
ISNULL([Joint Crimping 4Tons(PS-200)], 0) AS joint_crimping_4tons_ps_200,
ISNULL([Joint Crimping 5Tons], 0) AS joint_crimping_5tons,
ISNULL([Manual Taping (Dispenser)], 0) AS manual_taping_dispenser,
ISNULL([Joint Taping], 0) AS joint_taping,
ISNULL([Intermediate Welding], 0) AS intermediate_welding,
ISNULL([Intermediate Welding 0.13], 0) AS intermediate_welding_0_13,
ISNULL([Welding at Head], 0) AS welding_at_head,
ISNULL([Welding at Head 0.13], 0) AS welding_at_head_0_13,
ISNULL([Silicon Injection], 0) AS silicon_injection,
ISNULL([Welding Cap Insertion], 0) AS welding_cap_insertion,
ISNULL([Welding Taping(13mm)], 0) AS welding_taping_13mm,
ISNULL([Heatshrink], 0) AS heat_shrink,
ISNULL([Heat Shrink LA terminal], 0) AS heat_shrink_la_terminal,
ISNULL([Heat Shrink (Joint Crimping)], 0) AS heat_shrink_joint_crimping,
ISNULL([Heat Shrink (Welding)], 0) AS heat_shrink_welding,
ISNULL([Casting C385], 0) AS casting_c385,
ISNULL([STMAC Shieldwire(Nissan)], 0) AS stmac_shieldwire_nissan,
ISNULL([Quick Stripping], 0) AS quick_stripping,
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) AS manual_heat_shrink_blower_sumitube,
ISNULL([Drainwire Tip], 0) AS drainwire_tip,
ISNULL([Manual Crimping Shieldwire], 0) AS manual_crimping_shieldwire,
ISNULL([Joint Crimping 2TonsSW], 0) AS joint_crimping_2_tons_sw,
ISNULL([Manual Blue Taping(Dispenser)SW], 0) AS manual_blue_taping_dispenser_sw,
ISNULL([Shieldwire Taping], 0) AS shieldwire_taping,
ISNULL([HS Components Insertion SW], 0) AS hs_components_insertion_sw,
ISNULL([Heat Shrink (Joint Crimping)SW], 0) AS heat_shrink_joint_crimping_sw,
ISNULL([Waterproof pad Press], 0) AS waterproof_pad_press,
ISNULL([Low Vicosity], 0) AS low_viscosity,
ISNULL([Air/Water leak test], 0) AS air_water_leak_test,
ISNULL([HIROSE], 0) AS hirose,
ISNULL([Casting Battery], 0) AS casting_battery,
ISNULL([STMACAluminum], 0) AS stmac_aluminum,
ISNULL([Manual Crimping 20Tons], 0) AS manual_crimping_20tons,
ISNULL([Manual Heat Shrink (Blower)Battery], 0) AS manual_heat_shrink_blower_battery,
ISNULL([Joint Crimping 20Tons], 0) AS joint_crimping_20tons,
ISNULL([Dip Soldering (Battery)], 0) AS dip_soldering_battery,
ISNULL([Ultrasonic Dip SolderingAluminum], 0) AS ultrasonic_dip_soldering_aluminum,
ISNULL([La molding], 0) AS la_molding,
ISNULL([Pressure Welding(Dome Lamp)], 0) AS pressure_welding_dome_lamp,
ISNULL([Ferrule Process], 0) AS ferrule_process,
ISNULL([Gomusen Insertion], 0) AS gomusen_insertion,
ISNULL([Point Marking], 0) AS point_marking,



ISNULL([UV-III], 0) +
ISNULL([Arc Welding], 0) +
ISNULL([Aluminum Coating UV II], 0) +
ISNULL([Servo Crimping], 0) +
ISNULL([Ultrasonic Welding], 0) +
ISNULL([Cap Insertion], 0) +
ISNULL([Twisting Primary Aluminum], 0) +
ISNULL([Twisting Secondary Aluminum], 0) +
ISNULL([Airbag], 0) +
ISNULL([A/B Sub PC], 0) +
ISNULL([Manual Insertion to Connector], 0) +
ISNULL([V Type Twisting], 0) +
ISNULL([Twisting Primary], 0) +
ISNULL([Twisting Secondary], 0) +
ISNULL([Manual Crimping 2Tons], 0) +
ISNULL([Manual Crimping 4Tons], 0) +
ISNULL([Manual Crimping 5Tons], 0) +
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) +
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) +
ISNULL([Joint Crimping 2Tons], 0) +
ISNULL([Joint Crimping 4Tons(PS-200)], 0) +
ISNULL([Joint Crimping 5Tons], 0) +
ISNULL([Manual Taping (Dispenser)], 0) +
ISNULL([Joint Taping], 0) +
ISNULL([Intermediate Welding], 0) +
ISNULL([Intermediate Welding 0.13], 0) +
ISNULL([Welding at Head], 0) +
ISNULL([Welding at Head 0.13], 0) +
ISNULL([Silicon Injection], 0) +
ISNULL([Welding Cap Insertion], 0) +
ISNULL([Welding Taping(13mm)], 0) +
ISNULL([Heatshrink], 0) +
ISNULL([Heat Shrink LA terminal], 0) +
ISNULL([Heat Shrink (Joint Crimping)], 0) +
ISNULL([Heat Shrink (Welding)], 0) +
ISNULL([Casting C385], 0) +
ISNULL([STMAC Shieldwire(Nissan)], 0) +
ISNULL([Quick Stripping], 0) +
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) +
ISNULL([Drainwire Tip], 0) +
ISNULL([Manual Crimping Shieldwire], 0) +
ISNULL([Joint Crimping 2TonsSW], 0) +
ISNULL([Manual Blue Taping(Dispenser)SW], 0) +
ISNULL([Shieldwire Taping], 0) +
ISNULL([HS Components Insertion SW], 0) +
ISNULL([Heat Shrink (Joint Crimping)SW], 0) +
ISNULL([Waterproof pad Press], 0) +
ISNULL([Low Vicosity], 0) +
ISNULL([Air/Water leak test], 0) +
ISNULL([HIROSE], 0) +
ISNULL([Casting Battery], 0) +
ISNULL([STMACAluminum], 0) +
ISNULL([Manual Crimping 20Tons], 0) +
ISNULL([Manual Heat Shrink (Blower)Battery], 0) +
ISNULL([Joint Crimping 20Tons], 0) +
ISNULL([Dip Soldering (Battery)], 0) +
ISNULL([Ultrasonic Dip SolderingAluminum], 0) +
ISNULL([La molding], 0) +
ISNULL([Pressure Welding(Dome Lamp)], 0) +
ISNULL([Ferrule Process], 0) +
ISNULL([Gomusen Insertion], 0) +
ISNULL([Point Marking], 0) 


        
        
        AS Total
     FROM (
        SELECT 
            REPLACE(section, 'Section ', '') AS section,
            process,
            MIN(target_jph) AS target_jph
        FROM 
            [secondary_dashboard_db].[dbo].[section_page]
        WHERE 
            details = 'Actual JPH'
            AND process IN (
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
'Low Vicosity',
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
               )
        GROUP BY 
            REPLACE(section, 'Section ', ''), process
    ) AS SourceTable
    PIVOT (
    SUM(target_jph)
    FOR process IN (
        [UV-III],
[Arc Welding],
[Aluminum Coating UV II],
[Servo Crimping],
[Ultrasonic Welding],
[Cap Insertion],
[Twisting Primary Aluminum],
[Twisting Secondary Aluminum],
[Airbag],
[A/B Sub PC],
[Manual Insertion to Connector],
[V Type Twisting],
[Twisting Primary],
[Twisting Secondary],
[Manual Crimping 2Tons],
[Manual Crimping 4Tons],
[Manual Crimping 5Tons],
[Intermediate ripping(UAS)Manual-NF-F],
[Intermediate ripping (UAS)Joint stripping(KB10)],
[Intermediate stripping(KB10)],
[Intermediate stripping(KB10)NSC/Weld],
[Joint Crimping 2Tons],
[Joint Crimping 4Tons(PS-200)],
[Joint Crimping 5Tons],
[Manual Taping (Dispenser)],
[Joint Taping],
[Intermediate Welding],
[Intermediate Welding 0.13],
[Welding at Head],
[Welding at Head 0.13],
[Silicon Injection],
[Welding Cap Insertion],
[Welding Taping(13mm)],
[Heatshrink],
[Heat Shrink LA terminal],
[Heat Shrink (Joint Crimping)],
[Heat Shrink (Welding)],
[Casting C385],
[STMAC Shieldwire(Nissan)],
[Quick Stripping],
[Manual Heat Shrink(Blower)Sumitube],
[Drainwire Tip],
[Manual Crimping Shieldwire],
[Joint Crimping 2TonsSW],
[Manual Blue Taping(Dispenser)SW],
[Shieldwire Taping],
[HS Components Insertion SW],
[Heat Shrink (Joint Crimping)SW],
[Waterproof pad Press],
[Low Vicosity],
[Air/Water leak test],
[HIROSE],
[Casting Battery],
[STMACAluminum],
[Manual Crimping 20Tons],
[Manual Heat Shrink (Blower)Battery],
[Joint Crimping 20Tons],
[Dip Soldering (Battery)],
[Ultrasonic Dip SolderingAluminum],
[La molding],
[Pressure Welding(Dome Lamp)],
[Ferrule Process],
[Gomusen Insertion],
[Point Marking]
    )
) AS PivotTable


    UNION ALL

    SELECT 
        'Overall',
        'Target JPH',
SUM(ISNULL([UV-III], 0)),
SUM(ISNULL([Arc Welding], 0)),
SUM(ISNULL([Aluminum Coating UV II], 0)),
SUM(ISNULL([Servo Crimping], 0)),
SUM(ISNULL([Ultrasonic Welding], 0)),
SUM(ISNULL([Cap Insertion], 0)),
SUM(ISNULL([Twisting Primary Aluminum], 0)),
SUM(ISNULL([Twisting Secondary Aluminum], 0)),
SUM(ISNULL([Airbag], 0)),
SUM(ISNULL([A/B Sub PC], 0)),
SUM(ISNULL([Manual Insertion to Connector], 0)),
SUM(ISNULL([V Type Twisting], 0)),
SUM(ISNULL([Twisting Primary], 0)),
SUM(ISNULL([Twisting Secondary], 0)),
SUM(ISNULL([Manual Crimping 2Tons], 0)),
SUM(ISNULL([Manual Crimping 4Tons], 0)),
SUM(ISNULL([Manual Crimping 5Tons], 0)),
SUM(ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0)),
SUM(ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0)),
SUM(ISNULL([Intermediate stripping(KB10)], 0)),
SUM(ISNULL([Intermediate stripping(KB10)NSC/Weld], 0)),
SUM(ISNULL([Joint Crimping 2Tons], 0)),
SUM(ISNULL([Joint Crimping 4Tons(PS-200)], 0)),
SUM(ISNULL([Joint Crimping 5Tons], 0)),
SUM(ISNULL([Manual Taping (Dispenser)], 0)),
SUM(ISNULL([Joint Taping], 0)),
SUM(ISNULL([Intermediate Welding], 0)),
SUM(ISNULL([Intermediate Welding 0.13], 0)),
SUM(ISNULL([Welding at Head], 0)),
SUM(ISNULL([Welding at Head 0.13], 0)),
SUM(ISNULL([Silicon Injection], 0)),
SUM(ISNULL([Welding Cap Insertion], 0)),
SUM(ISNULL([Welding Taping(13mm)], 0)),
SUM(ISNULL([Heatshrink], 0)),
SUM(ISNULL([Heat Shrink LA terminal], 0)),
SUM(ISNULL([Heat Shrink (Joint Crimping)], 0)),
SUM(ISNULL([Heat Shrink (Welding)], 0)),
SUM(ISNULL([Casting C385], 0)),
SUM(ISNULL([STMAC Shieldwire(Nissan)], 0)),
SUM(ISNULL([Quick Stripping], 0)),
SUM(ISNULL([Manual Heat Shrink(Blower)Sumitube], 0)),
SUM(ISNULL([Drainwire Tip], 0)),
SUM(ISNULL([Manual Crimping Shieldwire], 0)),
SUM(ISNULL([Joint Crimping 2TonsSW], 0)),
SUM(ISNULL([Manual Blue Taping(Dispenser)SW], 0)),
SUM(ISNULL([Shieldwire Taping], 0)),
SUM(ISNULL([HS Components Insertion SW], 0)),
SUM(ISNULL([Heat Shrink (Joint Crimping)SW], 0)),
SUM(ISNULL([Waterproof pad Press], 0)),
SUM(ISNULL([Low Vicosity], 0)),
SUM(ISNULL([Air/Water leak test], 0)),
SUM(ISNULL([HIROSE], 0)),
SUM(ISNULL([Casting Battery], 0)),
SUM(ISNULL([STMACAluminum], 0)),
SUM(ISNULL([Manual Crimping 20Tons], 0)),
SUM(ISNULL([Manual Heat Shrink (Blower)Battery], 0)),
SUM(ISNULL([Joint Crimping 20Tons], 0)),
SUM(ISNULL([Dip Soldering (Battery)], 0)),
SUM(ISNULL([Ultrasonic Dip SolderingAluminum], 0)),
SUM(ISNULL([La molding], 0)),
SUM(ISNULL([Pressure Welding(Dome Lamp)], 0)),
SUM(ISNULL([Ferrule Process], 0)),
SUM(ISNULL([Gomusen Insertion], 0)),
SUM(ISNULL([Point Marking], 0)),

SUM(
ISNULL([UV-III], 0) +
ISNULL([Arc Welding], 0) +
ISNULL([Aluminum Coating UV II], 0) +
ISNULL([Servo Crimping], 0) +
ISNULL([Ultrasonic Welding], 0) +
ISNULL([Cap Insertion], 0) +
ISNULL([Twisting Primary Aluminum], 0) +
ISNULL([Twisting Secondary Aluminum], 0) +
ISNULL([Airbag], 0) +
ISNULL([A/B Sub PC], 0) +
ISNULL([Manual Insertion to Connector], 0) +
ISNULL([V Type Twisting], 0) +
ISNULL([Twisting Primary], 0) +
ISNULL([Twisting Secondary], 0) +
ISNULL([Manual Crimping 2Tons], 0) +
ISNULL([Manual Crimping 4Tons], 0) +
ISNULL([Manual Crimping 5Tons], 0) +
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) +
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) +
ISNULL([Joint Crimping 2Tons], 0) +
ISNULL([Joint Crimping 4Tons(PS-200)], 0) +
ISNULL([Joint Crimping 5Tons], 0) +
ISNULL([Manual Taping (Dispenser)], 0) +
ISNULL([Joint Taping], 0) +
ISNULL([Intermediate Welding], 0) +
ISNULL([Intermediate Welding 0.13], 0) +
ISNULL([Welding at Head], 0) +
ISNULL([Welding at Head 0.13], 0) +
ISNULL([Silicon Injection], 0) +
ISNULL([Welding Cap Insertion], 0) +
ISNULL([Welding Taping(13mm)], 0) +
ISNULL([Heatshrink], 0) +
ISNULL([Heat Shrink LA terminal], 0) +
ISNULL([Heat Shrink (Joint Crimping)], 0) +
ISNULL([Heat Shrink (Welding)], 0) +
ISNULL([Casting C385], 0) +
ISNULL([STMAC Shieldwire(Nissan)], 0) +
ISNULL([Quick Stripping], 0) +
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) +
ISNULL([Drainwire Tip], 0) +
ISNULL([Manual Crimping Shieldwire], 0) +
ISNULL([Joint Crimping 2TonsSW], 0) +
ISNULL([Manual Blue Taping(Dispenser)SW], 0) +
ISNULL([Shieldwire Taping], 0) +
ISNULL([HS Components Insertion SW], 0) +
ISNULL([Heat Shrink (Joint Crimping)SW], 0) +
ISNULL([Waterproof pad Press], 0) +
ISNULL([Low Vicosity], 0) +
ISNULL([Air/Water leak test], 0) +
ISNULL([HIROSE], 0) +
ISNULL([Casting Battery], 0) +
ISNULL([STMACAluminum], 0) +
ISNULL([Manual Crimping 20Tons], 0) +
ISNULL([Manual Heat Shrink (Blower)Battery], 0) +
ISNULL([Joint Crimping 20Tons], 0) +
ISNULL([Dip Soldering (Battery)], 0) +
ISNULL([Ultrasonic Dip SolderingAluminum], 0) +
ISNULL([La molding], 0) +
ISNULL([Pressure Welding(Dome Lamp)], 0) +
ISNULL([Ferrule Process], 0) +
ISNULL([Gomusen Insertion], 0) +
ISNULL([Point Marking], 0) 

        )
    FROM (
        SELECT 
            section,
            process,
            target_jph
        FROM 
            [secondary_dashboard_db].[dbo].[section_page]
        WHERE 
            details = 'Actual JPH'
            AND process IN (
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
'Low Vicosity',
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



            )
    ) AS SourceTable
    PIVOT (
        SUM(target_jph)
        FOR process IN (
[UV-III],
[Arc Welding],
[Aluminum Coating UV II],
[Servo Crimping],
[Ultrasonic Welding],
[Cap Insertion],
[Twisting Primary Aluminum],
[Twisting Secondary Aluminum],
[Airbag],
[A/B Sub PC],
[Manual Insertion to Connector],
[V Type Twisting],
[Twisting Primary],
[Twisting Secondary],
[Manual Crimping 2Tons],
[Manual Crimping 4Tons],
[Manual Crimping 5Tons],
[Intermediate ripping(UAS)Manual-NF-F],
[Intermediate ripping (UAS)Joint stripping(KB10)],
[Intermediate stripping(KB10)],
[Intermediate stripping(KB10)NSC/Weld],
[Joint Crimping 2Tons],
[Joint Crimping 4Tons(PS-200)],
[Joint Crimping 5Tons],
[Manual Taping (Dispenser)],
[Joint Taping],
[Intermediate Welding],
[Intermediate Welding 0.13],
[Welding at Head],
[Welding at Head 0.13],
[Silicon Injection],
[Welding Cap Insertion],
[Welding Taping(13mm)],
[Heatshrink],
[Heat Shrink LA terminal],
[Heat Shrink (Joint Crimping)],
[Heat Shrink (Welding)],
[Casting C385],
[STMAC Shieldwire(Nissan)],
[Quick Stripping],
[Manual Heat Shrink(Blower)Sumitube],
[Drainwire Tip],
[Manual Crimping Shieldwire],
[Joint Crimping 2TonsSW],
[Manual Blue Taping(Dispenser)SW],
[Shieldwire Taping],
[HS Components Insertion SW],
[Heat Shrink (Joint Crimping)SW],
[Waterproof pad Press],
[Low Vicosity],
[Air/Water leak test],
[HIROSE],
[Casting Battery],
[STMACAluminum],
[Manual Crimping 20Tons],
[Manual Heat Shrink (Blower)Battery],
[Joint Crimping 20Tons],
[Dip Soldering (Battery)],
[Ultrasonic Dip SolderingAluminum],
[La molding],
[Pressure Welding(Dome Lamp)],
[Ferrule Process],
[Gomusen Insertion],
[Point Marking]

        )
    ) AS PivotTable
),

 -- =============================================================================== MACHINE COUNT ===============================================================================

MachineCount AS (
    SELECT 
        p.section,
        'Machine Count' AS general_process,
        CASE WHEN ISNULL(p.uv_iii, 0) = 0 OR ISNULL(t.uv_iii, 0) = 0 THEN 0 ELSE CEILING(p.uv_iii / (t.uv_iii * 15.0)) END AS uv_iii,
CASE WHEN ISNULL(p.arc_welding, 0) = 0 OR ISNULL(t.arc_welding, 0) = 0 THEN 0 ELSE CEILING(p.arc_welding / (t.arc_welding * 15.0)) END AS arc_welding,
CASE WHEN ISNULL(p.aluminum_coating_uv_ii, 0) = 0 OR ISNULL(t.aluminum_coating_uv_ii, 0) = 0 THEN 0 ELSE CEILING(p.aluminum_coating_uv_ii / (t.aluminum_coating_uv_ii * 15.0)) END AS aluminum_coating_uv_ii,
CASE WHEN ISNULL(p.servo_crimping, 0) = 0 OR ISNULL(t.servo_crimping, 0) = 0 THEN 0 ELSE CEILING(p.servo_crimping / (t.servo_crimping * 15.0)) END AS servo_crimping,
CASE WHEN ISNULL(p.ultrasonic_welding, 0) = 0 OR ISNULL(t.ultrasonic_welding, 0) = 0 THEN 0 ELSE CEILING(p.ultrasonic_welding / (t.ultrasonic_welding * 15.0)) END AS ultrasonic_welding,
CASE WHEN ISNULL(p.cap_insertion, 0) = 0 OR ISNULL(t.cap_insertion, 0) = 0 THEN 0 ELSE CEILING(p.cap_insertion / (t.cap_insertion * 15.0)) END AS cap_insertion,
CASE WHEN ISNULL(p.twisting_primary_aluminum, 0) = 0 OR ISNULL(t.twisting_primary_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.twisting_primary_aluminum / (t.twisting_primary_aluminum * 15.0)) END AS twisting_primary_aluminum,
CASE WHEN ISNULL(p.twisting_secondary_aluminum, 0) = 0 OR ISNULL(t.twisting_secondary_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.twisting_secondary_aluminum / (t.twisting_secondary_aluminum * 15.0)) END AS twisting_secondary_aluminum,
CASE WHEN ISNULL(p.airbag, 0) = 0 OR ISNULL(t.airbag, 0) = 0 THEN 0 ELSE CEILING(p.airbag / (t.airbag * 15.0)) END AS airbag,
CASE WHEN ISNULL(p.a_b_sub_pc, 0) = 0 OR ISNULL(t.a_b_sub_pc, 0) = 0 THEN 0 ELSE CEILING(p.a_b_sub_pc / (t.a_b_sub_pc * 15.0)) END AS a_b_sub_pc,
CASE WHEN ISNULL(p.manual_insertion_to_connector, 0) = 0 OR ISNULL(t.manual_insertion_to_connector, 0) = 0 THEN 0 ELSE CEILING(p.manual_insertion_to_connector / (t.manual_insertion_to_connector * 15.0)) END AS manual_insertion_to_connector,
CASE WHEN ISNULL(p.v_type_twisting, 0) = 0 OR ISNULL(t.v_type_twisting, 0) = 0 THEN 0 ELSE CEILING(p.v_type_twisting / (t.v_type_twisting * 15.0)) END AS v_type_twisting,
CASE WHEN ISNULL(p.twisting_primary, 0) = 0 OR ISNULL(t.twisting_primary, 0) = 0 THEN 0 ELSE CEILING(p.twisting_primary / (t.twisting_primary * 15.0)) END AS twisting_primary,
CASE WHEN ISNULL(p.twisting_secondary, 0) = 0 OR ISNULL(t.twisting_secondary, 0) = 0 THEN 0 ELSE CEILING(p.twisting_secondary / (t.twisting_secondary * 15.0)) END AS twisting_secondary,
CASE WHEN ISNULL(p.manual_crimping_2tons, 0) = 0 OR ISNULL(t.manual_crimping_2tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_2tons / (t.manual_crimping_2tons * 15.0)) END AS manual_crimping_2tons,
CASE WHEN ISNULL(p.manual_crimping_4tons, 0) = 0 OR ISNULL(t.manual_crimping_4tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_4tons / (t.manual_crimping_4tons * 15.0)) END AS manual_crimping_4tons,
CASE WHEN ISNULL(p.manual_crimping_5tons, 0) = 0 OR ISNULL(t.manual_crimping_5tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_5tons / (t.manual_crimping_5tons * 15.0)) END AS manual_crimping_5tons,
CASE WHEN ISNULL(p.intermediate_ripping_uas_manual_nf_f, 0) = 0 OR ISNULL(t.intermediate_ripping_uas_manual_nf_f, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_ripping_uas_manual_nf_f / (t.intermediate_ripping_uas_manual_nf_f * 15.0)) END AS intermediate_ripping_uas_manual_nf_f,
CASE WHEN ISNULL(p.intermediate_ripping_uas_joint, 0) = 0 OR ISNULL(t.intermediate_ripping_uas_joint, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_ripping_uas_joint / (t.intermediate_ripping_uas_joint * 15.0)) END AS intermediate_ripping_uas_joint,
CASE WHEN ISNULL(p.intermediate_stripping_kb10, 0) = 0 OR ISNULL(t.intermediate_stripping_kb10, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_stripping_kb10 / (t.intermediate_stripping_kb10 * 15.0)) END AS intermediate_stripping_kb10,
CASE WHEN ISNULL(p.intermediate_stripping_kb10_nsc_weld, 0) = 0 OR ISNULL(t.intermediate_stripping_kb10_nsc_weld, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_stripping_kb10_nsc_weld / (t.intermediate_stripping_kb10_nsc_weld * 15.0)) END AS intermediate_stripping_kb10_nsc_weld,
CASE WHEN ISNULL(p.joint_crimping_2_tons, 0) = 0 OR ISNULL(t.joint_crimping_2_tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_2_tons / (t.joint_crimping_2_tons * 15.0)) END AS joint_crimping_2_tons,
CASE WHEN ISNULL(p.joint_crimping_4tons_ps_200, 0) = 0 OR ISNULL(t.joint_crimping_4tons_ps_200, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_4tons_ps_200 / (t.joint_crimping_4tons_ps_200 * 15.0)) END AS joint_crimping_4tons_ps_200,
CASE WHEN ISNULL(p.joint_crimping_5tons, 0) = 0 OR ISNULL(t.joint_crimping_5tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_5tons / (t.joint_crimping_5tons * 15.0)) END AS joint_crimping_5tons,
CASE WHEN ISNULL(p.manual_taping_dispenser, 0) = 0 OR ISNULL(t.manual_taping_dispenser, 0) = 0 THEN 0 ELSE CEILING(p.manual_taping_dispenser / (t.manual_taping_dispenser * 15.0)) END AS manual_taping_dispenser,
CASE WHEN ISNULL(p.joint_taping, 0) = 0 OR ISNULL(t.joint_taping, 0) = 0 THEN 0 ELSE CEILING(p.joint_taping / (t.joint_taping * 15.0)) END AS joint_taping,
CASE WHEN ISNULL(p.intermediate_welding, 0) = 0 OR ISNULL(t.intermediate_welding, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_welding / (t.intermediate_welding * 15.0)) END AS intermediate_welding,
CASE WHEN ISNULL(p.intermediate_welding_0_13, 0) = 0 OR ISNULL(t.intermediate_welding_0_13, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_welding_0_13 / (t.intermediate_welding_0_13 * 15.0)) END AS intermediate_welding_0_13,
CASE WHEN ISNULL(p.welding_at_head, 0) = 0 OR ISNULL(t.welding_at_head, 0) = 0 THEN 0 ELSE CEILING(p.welding_at_head / (t.welding_at_head * 15.0)) END AS welding_at_head,
CASE WHEN ISNULL(p.welding_at_head_0_13, 0) = 0 OR ISNULL(t.welding_at_head_0_13, 0) = 0 THEN 0 ELSE CEILING(p.welding_at_head_0_13 / (t.welding_at_head_0_13 * 15.0)) END AS welding_at_head_0_13,
CASE WHEN ISNULL(p.silicon_injection, 0) = 0 OR ISNULL(t.silicon_injection, 0) = 0 THEN 0 ELSE CEILING(p.silicon_injection / (t.silicon_injection * 15.0)) END AS silicon_injection,
CASE WHEN ISNULL(p.welding_cap_insertion, 0) = 0 OR ISNULL(t.welding_cap_insertion, 0) = 0 THEN 0 ELSE CEILING(p.welding_cap_insertion / (t.welding_cap_insertion * 15.0)) END AS welding_cap_insertion,
CASE WHEN ISNULL(p.welding_taping_13mm, 0) = 0 OR ISNULL(t.welding_taping_13mm, 0) = 0 THEN 0 ELSE CEILING(p.welding_taping_13mm / (t.welding_taping_13mm * 15.0)) END AS welding_taping_13mm,
CASE WHEN ISNULL(p.heat_shrink, 0) = 0 OR ISNULL(t.heat_shrink, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink / (t.heat_shrink * 15.0)) END AS heat_shrink,
CASE WHEN ISNULL(p.heat_shrink_la_terminal, 0) = 0 OR ISNULL(t.heat_shrink_la_terminal, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_la_terminal / (t.heat_shrink_la_terminal * 15.0)) END AS heat_shrink_la_terminal,
CASE WHEN ISNULL(p.heat_shrink_joint_crimping, 0) = 0 OR ISNULL(t.heat_shrink_joint_crimping, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_joint_crimping / (t.heat_shrink_joint_crimping * 15.0)) END AS heat_shrink_joint_crimping,
CASE WHEN ISNULL(p.heat_shrink_welding, 0) = 0 OR ISNULL(t.heat_shrink_welding, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_welding / (t.heat_shrink_welding * 15.0)) END AS heat_shrink_welding,
CASE WHEN ISNULL(p.casting_c385, 0) = 0 OR ISNULL(t.casting_c385, 0) = 0 THEN 0 ELSE CEILING(p.casting_c385 / (t.casting_c385 * 15.0)) END AS casting_c385,
CASE WHEN ISNULL(p.stmac_shieldwire_nissan, 0) = 0 OR ISNULL(t.stmac_shieldwire_nissan, 0) = 0 THEN 0 ELSE CEILING(p.stmac_shieldwire_nissan / (t.stmac_shieldwire_nissan * 15.0)) END AS stmac_shieldwire_nissan,
CASE WHEN ISNULL(p.quick_stripping, 0) = 0 OR ISNULL(t.quick_stripping, 0) = 0 THEN 0 ELSE CEILING(p.quick_stripping / (t.quick_stripping * 15.0)) END AS quick_stripping,
CASE WHEN ISNULL(p.manual_heat_shrink_blower_sumitube, 0) = 0 OR ISNULL(t.manual_heat_shrink_blower_sumitube, 0) = 0 THEN 0 ELSE CEILING(p.manual_heat_shrink_blower_sumitube / (t.manual_heat_shrink_blower_sumitube * 15.0)) END AS manual_heat_shrink_blower_sumitube,
CASE WHEN ISNULL(p.drainwire_tip, 0) = 0 OR ISNULL(t.drainwire_tip, 0) = 0 THEN 0 ELSE CEILING(p.drainwire_tip / (t.drainwire_tip * 15.0)) END AS drainwire_tip,
CASE WHEN ISNULL(p.manual_crimping_shieldwire, 0) = 0 OR ISNULL(t.manual_crimping_shieldwire, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_shieldwire / (t.manual_crimping_shieldwire * 15.0)) END AS manual_crimping_shieldwire,
CASE WHEN ISNULL(p.joint_crimping_2_tons_sw, 0) = 0 OR ISNULL(t.joint_crimping_2_tons_sw, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_2_tons_sw / (t.joint_crimping_2_tons_sw * 15.0)) END AS joint_crimping_2_tons_sw,
CASE WHEN ISNULL(p.manual_blue_taping_dispenser_sw, 0) = 0 OR ISNULL(t.manual_blue_taping_dispenser_sw, 0) = 0 THEN 0 ELSE CEILING(p.manual_blue_taping_dispenser_sw / (t.manual_blue_taping_dispenser_sw * 15.0)) END AS manual_blue_taping_dispenser_sw,
CASE WHEN ISNULL(p.shieldwire_taping, 0) = 0 OR ISNULL(t.shieldwire_taping, 0) = 0 THEN 0 ELSE CEILING(p.shieldwire_taping / (t.shieldwire_taping * 15.0)) END AS shieldwire_taping,
CASE WHEN ISNULL(p.hs_components_insertion_sw, 0) = 0 OR ISNULL(t.hs_components_insertion_sw, 0) = 0 THEN 0 ELSE CEILING(p.hs_components_insertion_sw / (t.hs_components_insertion_sw * 15.0)) END AS hs_components_insertion_sw,
CASE WHEN ISNULL(p.heat_shrink_joint_crimping_sw, 0) = 0 OR ISNULL(t.heat_shrink_joint_crimping_sw, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_joint_crimping_sw / (t.heat_shrink_joint_crimping_sw * 15.0)) END AS heat_shrink_joint_crimping_sw,
CASE WHEN ISNULL(p.waterproof_pad_press, 0) = 0 OR ISNULL(t.waterproof_pad_press, 0) = 0 THEN 0 ELSE CEILING(p.waterproof_pad_press / (t.waterproof_pad_press * 15.0)) END AS waterproof_pad_press,
CASE WHEN ISNULL(p.low_viscosity, 0) = 0 OR ISNULL(t.low_viscosity, 0) = 0 THEN 0 ELSE CEILING(p.low_viscosity / (t.low_viscosity * 15.0)) END AS low_viscosity,
CASE WHEN ISNULL(p.air_water_leak_test, 0) = 0 OR ISNULL(t.air_water_leak_test, 0) = 0 THEN 0 ELSE CEILING(p.air_water_leak_test / (t.air_water_leak_test * 15.0)) END AS air_water_leak_test,
CASE WHEN ISNULL(p.hirose, 0) = 0 OR ISNULL(t.hirose, 0) = 0 THEN 0 ELSE CEILING(p.hirose / (t.hirose * 15.0)) END AS hirose,
CASE WHEN ISNULL(p.casting_battery, 0) = 0 OR ISNULL(t.casting_battery, 0) = 0 THEN 0 ELSE CEILING(p.casting_battery / (t.casting_battery * 15.0)) END AS casting_battery,
CASE WHEN ISNULL(p.stmac_aluminum, 0) = 0 OR ISNULL(t.stmac_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.stmac_aluminum / (t.stmac_aluminum * 15.0)) END AS stmac_aluminum,
CASE WHEN ISNULL(p.manual_crimping_20tons, 0) = 0 OR ISNULL(t.manual_crimping_20tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_20tons / (t.manual_crimping_20tons * 15.0)) END AS manual_crimping_20tons,
CASE WHEN ISNULL(p.manual_heat_shrink_blower_battery, 0) = 0 OR ISNULL(t.manual_heat_shrink_blower_battery, 0) = 0 THEN 0 ELSE CEILING(p.manual_heat_shrink_blower_battery / (t.manual_heat_shrink_blower_battery * 15.0)) END AS manual_heat_shrink_blower_battery,
CASE WHEN ISNULL(p.joint_crimping_20tons, 0) = 0 OR ISNULL(t.joint_crimping_20tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_20tons / (t.joint_crimping_20tons * 15.0)) END AS joint_crimping_20tons,
CASE WHEN ISNULL(p.dip_soldering_battery, 0) = 0 OR ISNULL(t.dip_soldering_battery, 0) = 0 THEN 0 ELSE CEILING(p.dip_soldering_battery / (t.dip_soldering_battery * 15.0)) END AS dip_soldering_battery,
CASE WHEN ISNULL(p.ultrasonic_dip_soldering_aluminum, 0) = 0 OR ISNULL(t.ultrasonic_dip_soldering_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.ultrasonic_dip_soldering_aluminum / (t.ultrasonic_dip_soldering_aluminum * 15.0)) END AS ultrasonic_dip_soldering_aluminum,
CASE WHEN ISNULL(p.la_molding, 0) = 0 OR ISNULL(t.la_molding, 0) = 0 THEN 0 ELSE CEILING(p.la_molding / (t.la_molding * 15.0)) END AS la_molding,
CASE WHEN ISNULL(p.pressure_welding_dome_lamp, 0) = 0 OR ISNULL(t.pressure_welding_dome_lamp, 0) = 0 THEN 0 ELSE CEILING(p.pressure_welding_dome_lamp / (t.pressure_welding_dome_lamp * 15.0)) END AS pressure_welding_dome_lamp,
CASE WHEN ISNULL(p.ferrule_process, 0) = 0 OR ISNULL(t.ferrule_process, 0) = 0 THEN 0 ELSE CEILING(p.ferrule_process / (t.ferrule_process * 15.0)) END AS ferrule_process,
CASE WHEN ISNULL(p.gomusen_insertion, 0) = 0 OR ISNULL(t.gomusen_insertion, 0) = 0 THEN 0 ELSE CEILING(p.gomusen_insertion / (t.gomusen_insertion * 15.0)) END AS gomusen_insertion,
CASE WHEN ISNULL(p.point_marking, 0) = 0 OR ISNULL(t.point_marking, 0) = 0 THEN 0 ELSE CEILING(p.point_marking / (t.point_marking * 15.0)) END AS point_marking,

        (
CASE WHEN ISNULL(p.uv_iii, 0) = 0 OR ISNULL(t.uv_iii, 0) = 0 THEN 0 ELSE CEILING(p.uv_iii / (t.uv_iii * 15.0)) END +
CASE WHEN ISNULL(p.arc_welding, 0) = 0 OR ISNULL(t.arc_welding, 0) = 0 THEN 0 ELSE CEILING(p.arc_welding / (t.arc_welding * 15.0)) END +
CASE WHEN ISNULL(p.aluminum_coating_uv_ii, 0) = 0 OR ISNULL(t.aluminum_coating_uv_ii, 0) = 0 THEN 0 ELSE CEILING(p.aluminum_coating_uv_ii / (t.aluminum_coating_uv_ii * 15.0)) END +
CASE WHEN ISNULL(p.servo_crimping, 0) = 0 OR ISNULL(t.servo_crimping, 0) = 0 THEN 0 ELSE CEILING(p.servo_crimping / (t.servo_crimping * 15.0)) END +
CASE WHEN ISNULL(p.ultrasonic_welding, 0) = 0 OR ISNULL(t.ultrasonic_welding, 0) = 0 THEN 0 ELSE CEILING(p.ultrasonic_welding / (t.ultrasonic_welding * 15.0)) END +
CASE WHEN ISNULL(p.cap_insertion, 0) = 0 OR ISNULL(t.cap_insertion, 0) = 0 THEN 0 ELSE CEILING(p.cap_insertion / (t.cap_insertion * 15.0)) END +
CASE WHEN ISNULL(p.twisting_primary_aluminum, 0) = 0 OR ISNULL(t.twisting_primary_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.twisting_primary_aluminum / (t.twisting_primary_aluminum * 15.0)) END +
CASE WHEN ISNULL(p.twisting_secondary_aluminum, 0) = 0 OR ISNULL(t.twisting_secondary_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.twisting_secondary_aluminum / (t.twisting_secondary_aluminum * 15.0)) END +
CASE WHEN ISNULL(p.airbag, 0) = 0 OR ISNULL(t.airbag, 0) = 0 THEN 0 ELSE CEILING(p.airbag / (t.airbag * 15.0)) END +
CASE WHEN ISNULL(p.a_b_sub_pc, 0) = 0 OR ISNULL(t.a_b_sub_pc, 0) = 0 THEN 0 ELSE CEILING(p.a_b_sub_pc / (t.a_b_sub_pc * 15.0)) END +
CASE WHEN ISNULL(p.manual_insertion_to_connector, 0) = 0 OR ISNULL(t.manual_insertion_to_connector, 0) = 0 THEN 0 ELSE CEILING(p.manual_insertion_to_connector / (t.manual_insertion_to_connector * 15.0)) END +
CASE WHEN ISNULL(p.v_type_twisting, 0) = 0 OR ISNULL(t.v_type_twisting, 0) = 0 THEN 0 ELSE CEILING(p.v_type_twisting / (t.v_type_twisting * 15.0)) END +
CASE WHEN ISNULL(p.twisting_primary, 0) = 0 OR ISNULL(t.twisting_primary, 0) = 0 THEN 0 ELSE CEILING(p.twisting_primary / (t.twisting_primary * 15.0)) END +
CASE WHEN ISNULL(p.twisting_secondary, 0) = 0 OR ISNULL(t.twisting_secondary, 0) = 0 THEN 0 ELSE CEILING(p.twisting_secondary / (t.twisting_secondary * 15.0)) END +
CASE WHEN ISNULL(p.manual_crimping_2tons, 0) = 0 OR ISNULL(t.manual_crimping_2tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_2tons / (t.manual_crimping_2tons * 15.0)) END +
CASE WHEN ISNULL(p.manual_crimping_4tons, 0) = 0 OR ISNULL(t.manual_crimping_4tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_4tons / (t.manual_crimping_4tons * 15.0)) END +
CASE WHEN ISNULL(p.manual_crimping_5tons, 0) = 0 OR ISNULL(t.manual_crimping_5tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_5tons / (t.manual_crimping_5tons * 15.0)) END +
CASE WHEN ISNULL(p.intermediate_ripping_uas_manual_nf_f, 0) = 0 OR ISNULL(t.intermediate_ripping_uas_manual_nf_f, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_ripping_uas_manual_nf_f / (t.intermediate_ripping_uas_manual_nf_f * 15.0)) END +
CASE WHEN ISNULL(p.intermediate_ripping_uas_joint, 0) = 0 OR ISNULL(t.intermediate_ripping_uas_joint, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_ripping_uas_joint / (t.intermediate_ripping_uas_joint * 15.0)) END +
CASE WHEN ISNULL(p.intermediate_stripping_kb10, 0) = 0 OR ISNULL(t.intermediate_stripping_kb10, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_stripping_kb10 / (t.intermediate_stripping_kb10 * 15.0)) END +
CASE WHEN ISNULL(p.intermediate_stripping_kb10_nsc_weld, 0) = 0 OR ISNULL(t.intermediate_stripping_kb10_nsc_weld, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_stripping_kb10_nsc_weld / (t.intermediate_stripping_kb10_nsc_weld * 15.0)) END +
CASE WHEN ISNULL(p.joint_crimping_2_tons, 0) = 0 OR ISNULL(t.joint_crimping_2_tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_2_tons / (t.joint_crimping_2_tons * 15.0)) END +
CASE WHEN ISNULL(p.joint_crimping_4tons_ps_200, 0) = 0 OR ISNULL(t.joint_crimping_4tons_ps_200, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_4tons_ps_200 / (t.joint_crimping_4tons_ps_200 * 15.0)) END +
CASE WHEN ISNULL(p.joint_crimping_5tons, 0) = 0 OR ISNULL(t.joint_crimping_5tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_5tons / (t.joint_crimping_5tons * 15.0)) END +
CASE WHEN ISNULL(p.manual_taping_dispenser, 0) = 0 OR ISNULL(t.manual_taping_dispenser, 0) = 0 THEN 0 ELSE CEILING(p.manual_taping_dispenser / (t.manual_taping_dispenser * 15.0)) END +
CASE WHEN ISNULL(p.joint_taping, 0) = 0 OR ISNULL(t.joint_taping, 0) = 0 THEN 0 ELSE CEILING(p.joint_taping / (t.joint_taping * 15.0)) END +
CASE WHEN ISNULL(p.intermediate_welding, 0) = 0 OR ISNULL(t.intermediate_welding, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_welding / (t.intermediate_welding * 15.0)) END +
CASE WHEN ISNULL(p.intermediate_welding_0_13, 0) = 0 OR ISNULL(t.intermediate_welding_0_13, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_welding_0_13 / (t.intermediate_welding_0_13 * 15.0)) END +
CASE WHEN ISNULL(p.welding_at_head, 0) = 0 OR ISNULL(t.welding_at_head, 0) = 0 THEN 0 ELSE CEILING(p.welding_at_head / (t.welding_at_head * 15.0)) END +
CASE WHEN ISNULL(p.welding_at_head_0_13, 0) = 0 OR ISNULL(t.welding_at_head_0_13, 0) = 0 THEN 0 ELSE CEILING(p.welding_at_head_0_13 / (t.welding_at_head_0_13 * 15.0)) END +
CASE WHEN ISNULL(p.silicon_injection, 0) = 0 OR ISNULL(t.silicon_injection, 0) = 0 THEN 0 ELSE CEILING(p.silicon_injection / (t.silicon_injection * 15.0)) END +
CASE WHEN ISNULL(p.welding_cap_insertion, 0) = 0 OR ISNULL(t.welding_cap_insertion, 0) = 0 THEN 0 ELSE CEILING(p.welding_cap_insertion / (t.welding_cap_insertion * 15.0)) END +
CASE WHEN ISNULL(p.welding_taping_13mm, 0) = 0 OR ISNULL(t.welding_taping_13mm, 0) = 0 THEN 0 ELSE CEILING(p.welding_taping_13mm / (t.welding_taping_13mm * 15.0)) END +
CASE WHEN ISNULL(p.heat_shrink, 0) = 0 OR ISNULL(t.heat_shrink, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink / (t.heat_shrink * 15.0)) END +
CASE WHEN ISNULL(p.heat_shrink_la_terminal, 0) = 0 OR ISNULL(t.heat_shrink_la_terminal, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_la_terminal / (t.heat_shrink_la_terminal * 15.0)) END +
CASE WHEN ISNULL(p.heat_shrink_joint_crimping, 0) = 0 OR ISNULL(t.heat_shrink_joint_crimping, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_joint_crimping / (t.heat_shrink_joint_crimping * 15.0)) END +
CASE WHEN ISNULL(p.heat_shrink_welding, 0) = 0 OR ISNULL(t.heat_shrink_welding, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_welding / (t.heat_shrink_welding * 15.0)) END +
CASE WHEN ISNULL(p.casting_c385, 0) = 0 OR ISNULL(t.casting_c385, 0) = 0 THEN 0 ELSE CEILING(p.casting_c385 / (t.casting_c385 * 15.0)) END +
CASE WHEN ISNULL(p.stmac_shieldwire_nissan, 0) = 0 OR ISNULL(t.stmac_shieldwire_nissan, 0) = 0 THEN 0 ELSE CEILING(p.stmac_shieldwire_nissan / (t.stmac_shieldwire_nissan * 15.0)) END +
CASE WHEN ISNULL(p.quick_stripping, 0) = 0 OR ISNULL(t.quick_stripping, 0) = 0 THEN 0 ELSE CEILING(p.quick_stripping / (t.quick_stripping * 15.0)) END +
CASE WHEN ISNULL(p.manual_heat_shrink_blower_sumitube, 0) = 0 OR ISNULL(t.manual_heat_shrink_blower_sumitube, 0) = 0 THEN 0 ELSE CEILING(p.manual_heat_shrink_blower_sumitube / (t.manual_heat_shrink_blower_sumitube * 15.0)) END +
CASE WHEN ISNULL(p.drainwire_tip, 0) = 0 OR ISNULL(t.drainwire_tip, 0) = 0 THEN 0 ELSE CEILING(p.drainwire_tip / (t.drainwire_tip * 15.0)) END +
CASE WHEN ISNULL(p.manual_crimping_shieldwire, 0) = 0 OR ISNULL(t.manual_crimping_shieldwire, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_shieldwire / (t.manual_crimping_shieldwire * 15.0)) END +
CASE WHEN ISNULL(p.joint_crimping_2_tons_sw, 0) = 0 OR ISNULL(t.joint_crimping_2_tons_sw, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_2_tons_sw / (t.joint_crimping_2_tons_sw * 15.0)) END +
CASE WHEN ISNULL(p.manual_blue_taping_dispenser_sw, 0) = 0 OR ISNULL(t.manual_blue_taping_dispenser_sw, 0) = 0 THEN 0 ELSE CEILING(p.manual_blue_taping_dispenser_sw / (t.manual_blue_taping_dispenser_sw * 15.0)) END +
CASE WHEN ISNULL(p.shieldwire_taping, 0) = 0 OR ISNULL(t.shieldwire_taping, 0) = 0 THEN 0 ELSE CEILING(p.shieldwire_taping / (t.shieldwire_taping * 15.0)) END +
CASE WHEN ISNULL(p.hs_components_insertion_sw, 0) = 0 OR ISNULL(t.hs_components_insertion_sw, 0) = 0 THEN 0 ELSE CEILING(p.hs_components_insertion_sw / (t.hs_components_insertion_sw * 15.0)) END +
CASE WHEN ISNULL(p.heat_shrink_joint_crimping_sw, 0) = 0 OR ISNULL(t.heat_shrink_joint_crimping_sw, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_joint_crimping_sw / (t.heat_shrink_joint_crimping_sw * 15.0)) END +
CASE WHEN ISNULL(p.waterproof_pad_press, 0) = 0 OR ISNULL(t.waterproof_pad_press, 0) = 0 THEN 0 ELSE CEILING(p.waterproof_pad_press / (t.waterproof_pad_press * 15.0)) END +
CASE WHEN ISNULL(p.low_viscosity, 0) = 0 OR ISNULL(t.low_viscosity, 0) = 0 THEN 0 ELSE CEILING(p.low_viscosity / (t.low_viscosity * 15.0)) END +
CASE WHEN ISNULL(p.air_water_leak_test, 0) = 0 OR ISNULL(t.air_water_leak_test, 0) = 0 THEN 0 ELSE CEILING(p.air_water_leak_test / (t.air_water_leak_test * 15.0)) END +
CASE WHEN ISNULL(p.hirose, 0) = 0 OR ISNULL(t.hirose, 0) = 0 THEN 0 ELSE CEILING(p.hirose / (t.hirose * 15.0)) END +
CASE WHEN ISNULL(p.casting_battery, 0) = 0 OR ISNULL(t.casting_battery, 0) = 0 THEN 0 ELSE CEILING(p.casting_battery / (t.casting_battery * 15.0)) END +
CASE WHEN ISNULL(p.stmac_aluminum, 0) = 0 OR ISNULL(t.stmac_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.stmac_aluminum / (t.stmac_aluminum * 15.0)) END +
CASE WHEN ISNULL(p.manual_crimping_20tons, 0) = 0 OR ISNULL(t.manual_crimping_20tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_20tons / (t.manual_crimping_20tons * 15.0)) END +
CASE WHEN ISNULL(p.manual_heat_shrink_blower_battery, 0) = 0 OR ISNULL(t.manual_heat_shrink_blower_battery, 0) = 0 THEN 0 ELSE CEILING(p.manual_heat_shrink_blower_battery / (t.manual_heat_shrink_blower_battery * 15.0)) END +
CASE WHEN ISNULL(p.joint_crimping_20tons, 0) = 0 OR ISNULL(t.joint_crimping_20tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_20tons / (t.joint_crimping_20tons * 15.0)) END +
CASE WHEN ISNULL(p.dip_soldering_battery, 0) = 0 OR ISNULL(t.dip_soldering_battery, 0) = 0 THEN 0 ELSE CEILING(p.dip_soldering_battery / (t.dip_soldering_battery * 15.0)) END +
CASE WHEN ISNULL(p.ultrasonic_dip_soldering_aluminum, 0) = 0 OR ISNULL(t.ultrasonic_dip_soldering_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.ultrasonic_dip_soldering_aluminum / (t.ultrasonic_dip_soldering_aluminum * 15.0)) END +
CASE WHEN ISNULL(p.la_molding, 0) = 0 OR ISNULL(t.la_molding, 0) = 0 THEN 0 ELSE CEILING(p.la_molding / (t.la_molding * 15.0)) END +
CASE WHEN ISNULL(p.pressure_welding_dome_lamp, 0) = 0 OR ISNULL(t.pressure_welding_dome_lamp, 0) = 0 THEN 0 ELSE CEILING(p.pressure_welding_dome_lamp / (t.pressure_welding_dome_lamp * 15.0)) END +
CASE WHEN ISNULL(p.ferrule_process, 0) = 0 OR ISNULL(t.ferrule_process, 0) = 0 THEN 0 ELSE CEILING(p.ferrule_process / (t.ferrule_process * 15.0)) END +
CASE WHEN ISNULL(p.gomusen_insertion, 0) = 0 OR ISNULL(t.gomusen_insertion, 0) = 0 THEN 0 ELSE CEILING(p.gomusen_insertion / (t.gomusen_insertion * 15.0)) END +
CASE WHEN ISNULL(p.point_marking, 0) = 0 OR ISNULL(t.point_marking, 0) = 0 THEN 0 ELSE CEILING(p.point_marking / (t.point_marking * 15.0)) END 

        ) AS Total
    FROM PlanOutput p
    LEFT JOIN TargetJPH t ON p.section = t.section
    WHERE p.section <> 'Overall'

    UNION ALL

    SELECT 
        'Overall' AS section,
        'Machine Count' AS general_process,
        SUM(sec.uv_iii) AS uv_iii,
SUM(sec.arc_welding) AS arc_welding,
SUM(sec.aluminum_coating_uv_ii) AS aluminum_coating_uv_ii,
SUM(sec.servo_crimping) AS servo_crimping,
SUM(sec.ultrasonic_welding) AS ultrasonic_welding,
SUM(sec.cap_insertion) AS cap_insertion,
SUM(sec.twisting_primary_aluminum) AS twisting_primary_aluminum,
SUM(sec.twisting_secondary_aluminum) AS twisting_secondary_aluminum,
SUM(sec.airbag) AS airbag,
SUM(sec.a_b_sub_pc) AS a_b_sub_pc,
SUM(sec.manual_insertion_to_connector) AS manual_insertion_to_connector,
SUM(sec.v_type_twisting) AS v_type_twisting,
SUM(sec.twisting_primary) AS twisting_primary,
SUM(sec.twisting_secondary) AS twisting_secondary,
SUM(sec.manual_crimping_2tons) AS manual_crimping_2tons,
SUM(sec.manual_crimping_4tons) AS manual_crimping_4tons,
SUM(sec.manual_crimping_5tons) AS manual_crimping_5tons,
SUM(sec.intermediate_ripping_uas_manual_nf_f) AS intermediate_ripping_uas_manual_nf_f,
SUM(sec.intermediate_ripping_uas_joint) AS intermediate_ripping_uas_joint,
SUM(sec.intermediate_stripping_kb10) AS intermediate_stripping_kb10,
SUM(sec.intermediate_stripping_kb10_nsc_weld) AS intermediate_stripping_kb10_nsc_weld,
SUM(sec.joint_crimping_2_tons) AS joint_crimping_2_tons,
SUM(sec.joint_crimping_4tons_ps_200) AS joint_crimping_4tons_ps_200,
SUM(sec.joint_crimping_5tons) AS joint_crimping_5tons,
SUM(sec.manual_taping_dispenser) AS manual_taping_dispenser,
SUM(sec.joint_taping) AS joint_taping,
SUM(sec.intermediate_welding) AS intermediate_welding,
SUM(sec.intermediate_welding_0_13) AS intermediate_welding_0_13,
SUM(sec.welding_at_head) AS welding_at_head,
SUM(sec.welding_at_head_0_13) AS welding_at_head_0_13,
SUM(sec.silicon_injection) AS silicon_injection,
SUM(sec.welding_cap_insertion) AS welding_cap_insertion,
SUM(sec.welding_taping_13mm) AS welding_taping_13mm,
SUM(sec.heat_shrink) AS heat_shrink,
SUM(sec.heat_shrink_la_terminal) AS heat_shrink_la_terminal,
SUM(sec.heat_shrink_joint_crimping) AS heat_shrink_joint_crimping,
SUM(sec.heat_shrink_welding) AS heat_shrink_welding,
SUM(sec.casting_c385) AS casting_c385,
SUM(sec.stmac_shieldwire_nissan) AS stmac_shieldwire_nissan,
SUM(sec.quick_stripping) AS quick_stripping,
SUM(sec.manual_heat_shrink_blower_sumitube) AS manual_heat_shrink_blower_sumitube,
SUM(sec.drainwire_tip) AS drainwire_tip,
SUM(sec.manual_crimping_shieldwire) AS manual_crimping_shieldwire,
SUM(sec.joint_crimping_2_tons_sw) AS joint_crimping_2_tons_sw,
SUM(sec.manual_blue_taping_dispenser_sw) AS manual_blue_taping_dispenser_sw,
SUM(sec.shieldwire_taping) AS shieldwire_taping,
SUM(sec.hs_components_insertion_sw) AS hs_components_insertion_sw,
SUM(sec.heat_shrink_joint_crimping_sw) AS heat_shrink_joint_crimping_sw,
SUM(sec.waterproof_pad_press) AS waterproof_pad_press,
SUM(sec.low_viscosity) AS low_viscosity,
SUM(sec.air_water_leak_test) AS air_water_leak_test,
SUM(sec.hirose) AS hirose,
SUM(sec.casting_battery) AS casting_battery,
SUM(sec.stmac_aluminum) AS stmac_aluminum,
SUM(sec.manual_crimping_20tons) AS manual_crimping_20tons,
SUM(sec.manual_heat_shrink_blower_battery) AS manual_heat_shrink_blower_battery,
SUM(sec.joint_crimping_20tons) AS joint_crimping_20tons,
SUM(sec.dip_soldering_battery) AS dip_soldering_battery,
SUM(sec.ultrasonic_dip_soldering_aluminum) AS ultrasonic_dip_soldering_aluminum,
SUM(sec.la_molding) AS la_molding,
SUM(sec.pressure_welding_dome_lamp) AS pressure_welding_dome_lamp,
SUM(sec.ferrule_process) AS ferrule_process,
SUM(sec.gomusen_insertion) AS gomusen_insertion,
SUM(sec.point_marking) AS point_marking,

        SUM(
            ISNULL(sec.uv_iii,0) + 
ISNULL(sec.arc_welding,0) + 
ISNULL(sec.aluminum_coating_uv_ii,0) + 
ISNULL(sec.servo_crimping,0) + 
ISNULL(sec.ultrasonic_welding,0) + 
ISNULL(sec.cap_insertion,0) + 
ISNULL(sec.twisting_primary_aluminum,0) + 
ISNULL(sec.twisting_secondary_aluminum,0) + 
ISNULL(sec.airbag,0) + 
ISNULL(sec.a_b_sub_pc,0) + 
ISNULL(sec.manual_insertion_to_connector,0) + 
ISNULL(sec.v_type_twisting,0) + 
ISNULL(sec.twisting_primary,0) + 
ISNULL(sec.twisting_secondary,0) + 
ISNULL(sec.manual_crimping_2tons,0) + 
ISNULL(sec.manual_crimping_4tons,0) + 
ISNULL(sec.manual_crimping_5tons,0) + 
ISNULL(sec.intermediate_ripping_uas_manual_nf_f,0) + 
ISNULL(sec.intermediate_ripping_uas_joint,0) + 
ISNULL(sec.intermediate_stripping_kb10,0) + 
ISNULL(sec.intermediate_stripping_kb10_nsc_weld,0) + 
ISNULL(sec.joint_crimping_2_tons,0) + 
ISNULL(sec.joint_crimping_4tons_ps_200,0) + 
ISNULL(sec.joint_crimping_5tons,0) + 
ISNULL(sec.manual_taping_dispenser,0) + 
ISNULL(sec.joint_taping,0) + 
ISNULL(sec.intermediate_welding,0) + 
ISNULL(sec.intermediate_welding_0_13,0) + 
ISNULL(sec.welding_at_head,0) + 
ISNULL(sec.welding_at_head_0_13,0) + 
ISNULL(sec.silicon_injection,0) + 
ISNULL(sec.welding_cap_insertion,0) + 
ISNULL(sec.welding_taping_13mm,0) + 
ISNULL(sec.heat_shrink,0) + 
ISNULL(sec.heat_shrink_la_terminal,0) + 
ISNULL(sec.heat_shrink_joint_crimping,0) + 
ISNULL(sec.heat_shrink_welding,0) + 
ISNULL(sec.casting_c385,0) + 
ISNULL(sec.stmac_shieldwire_nissan,0) + 
ISNULL(sec.quick_stripping,0) + 
ISNULL(sec.manual_heat_shrink_blower_sumitube,0) + 
ISNULL(sec.drainwire_tip,0) + 
ISNULL(sec.manual_crimping_shieldwire,0) + 
ISNULL(sec.joint_crimping_2_tons_sw,0) + 
ISNULL(sec.manual_blue_taping_dispenser_sw,0) + 
ISNULL(sec.shieldwire_taping,0) + 
ISNULL(sec.hs_components_insertion_sw,0) + 
ISNULL(sec.heat_shrink_joint_crimping_sw,0) + 
ISNULL(sec.waterproof_pad_press,0) + 
ISNULL(sec.low_viscosity,0) + 
ISNULL(sec.air_water_leak_test,0) + 
ISNULL(sec.hirose,0) + 
ISNULL(sec.casting_battery,0) + 
ISNULL(sec.stmac_aluminum,0) + 
ISNULL(sec.manual_crimping_20tons,0) + 
ISNULL(sec.manual_heat_shrink_blower_battery,0) + 
ISNULL(sec.joint_crimping_20tons,0) + 
ISNULL(sec.dip_soldering_battery,0) + 
ISNULL(sec.ultrasonic_dip_soldering_aluminum,0) + 
ISNULL(sec.la_molding,0) + 
ISNULL(sec.pressure_welding_dome_lamp,0) + 
ISNULL(sec.ferrule_process,0) + 
ISNULL(sec.gomusen_insertion,0) + 
ISNULL(sec.point_marking,0) 
        ) AS Total
    FROM (
        SELECT 
            p.section,
           CASE WHEN ISNULL(p.uv_iii, 0) = 0 OR ISNULL(t.uv_iii, 0) = 0 THEN 0 ELSE CEILING(p.uv_iii / (t.uv_iii * 15.0)) END AS uv_iii,
CASE WHEN ISNULL(p.arc_welding, 0) = 0 OR ISNULL(t.arc_welding, 0) = 0 THEN 0 ELSE CEILING(p.arc_welding / (t.arc_welding * 15.0)) END AS arc_welding,
CASE WHEN ISNULL(p.aluminum_coating_uv_ii, 0) = 0 OR ISNULL(t.aluminum_coating_uv_ii, 0) = 0 THEN 0 ELSE CEILING(p.aluminum_coating_uv_ii / (t.aluminum_coating_uv_ii * 15.0)) END AS aluminum_coating_uv_ii,
CASE WHEN ISNULL(p.servo_crimping, 0) = 0 OR ISNULL(t.servo_crimping, 0) = 0 THEN 0 ELSE CEILING(p.servo_crimping / (t.servo_crimping * 15.0)) END AS servo_crimping,
CASE WHEN ISNULL(p.ultrasonic_welding, 0) = 0 OR ISNULL(t.ultrasonic_welding, 0) = 0 THEN 0 ELSE CEILING(p.ultrasonic_welding / (t.ultrasonic_welding * 15.0)) END AS ultrasonic_welding,
CASE WHEN ISNULL(p.cap_insertion, 0) = 0 OR ISNULL(t.cap_insertion, 0) = 0 THEN 0 ELSE CEILING(p.cap_insertion / (t.cap_insertion * 15.0)) END AS cap_insertion,
CASE WHEN ISNULL(p.twisting_primary_aluminum, 0) = 0 OR ISNULL(t.twisting_primary_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.twisting_primary_aluminum / (t.twisting_primary_aluminum * 15.0)) END AS twisting_primary_aluminum,
CASE WHEN ISNULL(p.twisting_secondary_aluminum, 0) = 0 OR ISNULL(t.twisting_secondary_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.twisting_secondary_aluminum / (t.twisting_secondary_aluminum * 15.0)) END AS twisting_secondary_aluminum,
CASE WHEN ISNULL(p.airbag, 0) = 0 OR ISNULL(t.airbag, 0) = 0 THEN 0 ELSE CEILING(p.airbag / (t.airbag * 15.0)) END AS airbag,
CASE WHEN ISNULL(p.a_b_sub_pc, 0) = 0 OR ISNULL(t.a_b_sub_pc, 0) = 0 THEN 0 ELSE CEILING(p.a_b_sub_pc / (t.a_b_sub_pc * 15.0)) END AS a_b_sub_pc,
CASE WHEN ISNULL(p.manual_insertion_to_connector, 0) = 0 OR ISNULL(t.manual_insertion_to_connector, 0) = 0 THEN 0 ELSE CEILING(p.manual_insertion_to_connector / (t.manual_insertion_to_connector * 15.0)) END AS manual_insertion_to_connector,
CASE WHEN ISNULL(p.v_type_twisting, 0) = 0 OR ISNULL(t.v_type_twisting, 0) = 0 THEN 0 ELSE CEILING(p.v_type_twisting / (t.v_type_twisting * 15.0)) END AS v_type_twisting,
CASE WHEN ISNULL(p.twisting_primary, 0) = 0 OR ISNULL(t.twisting_primary, 0) = 0 THEN 0 ELSE CEILING(p.twisting_primary / (t.twisting_primary * 15.0)) END AS twisting_primary,
CASE WHEN ISNULL(p.twisting_secondary, 0) = 0 OR ISNULL(t.twisting_secondary, 0) = 0 THEN 0 ELSE CEILING(p.twisting_secondary / (t.twisting_secondary * 15.0)) END AS twisting_secondary,
CASE WHEN ISNULL(p.manual_crimping_2tons, 0) = 0 OR ISNULL(t.manual_crimping_2tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_2tons / (t.manual_crimping_2tons * 15.0)) END AS manual_crimping_2tons,
CASE WHEN ISNULL(p.manual_crimping_4tons, 0) = 0 OR ISNULL(t.manual_crimping_4tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_4tons / (t.manual_crimping_4tons * 15.0)) END AS manual_crimping_4tons,
CASE WHEN ISNULL(p.manual_crimping_5tons, 0) = 0 OR ISNULL(t.manual_crimping_5tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_5tons / (t.manual_crimping_5tons * 15.0)) END AS manual_crimping_5tons,
CASE WHEN ISNULL(p.intermediate_ripping_uas_manual_nf_f, 0) = 0 OR ISNULL(t.intermediate_ripping_uas_manual_nf_f, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_ripping_uas_manual_nf_f / (t.intermediate_ripping_uas_manual_nf_f * 15.0)) END AS intermediate_ripping_uas_manual_nf_f,
CASE WHEN ISNULL(p.intermediate_ripping_uas_joint, 0) = 0 OR ISNULL(t.intermediate_ripping_uas_joint, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_ripping_uas_joint / (t.intermediate_ripping_uas_joint * 15.0)) END AS intermediate_ripping_uas_joint,
CASE WHEN ISNULL(p.intermediate_stripping_kb10, 0) = 0 OR ISNULL(t.intermediate_stripping_kb10, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_stripping_kb10 / (t.intermediate_stripping_kb10 * 15.0)) END AS intermediate_stripping_kb10,
CASE WHEN ISNULL(p.intermediate_stripping_kb10_nsc_weld, 0) = 0 OR ISNULL(t.intermediate_stripping_kb10_nsc_weld, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_stripping_kb10_nsc_weld / (t.intermediate_stripping_kb10_nsc_weld * 15.0)) END AS intermediate_stripping_kb10_nsc_weld,
CASE WHEN ISNULL(p.joint_crimping_2_tons, 0) = 0 OR ISNULL(t.joint_crimping_2_tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_2_tons / (t.joint_crimping_2_tons * 15.0)) END AS joint_crimping_2_tons,
CASE WHEN ISNULL(p.joint_crimping_4tons_ps_200, 0) = 0 OR ISNULL(t.joint_crimping_4tons_ps_200, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_4tons_ps_200 / (t.joint_crimping_4tons_ps_200 * 15.0)) END AS joint_crimping_4tons_ps_200,
CASE WHEN ISNULL(p.joint_crimping_5tons, 0) = 0 OR ISNULL(t.joint_crimping_5tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_5tons / (t.joint_crimping_5tons * 15.0)) END AS joint_crimping_5tons,
CASE WHEN ISNULL(p.manual_taping_dispenser, 0) = 0 OR ISNULL(t.manual_taping_dispenser, 0) = 0 THEN 0 ELSE CEILING(p.manual_taping_dispenser / (t.manual_taping_dispenser * 15.0)) END AS manual_taping_dispenser,
CASE WHEN ISNULL(p.joint_taping, 0) = 0 OR ISNULL(t.joint_taping, 0) = 0 THEN 0 ELSE CEILING(p.joint_taping / (t.joint_taping * 15.0)) END AS joint_taping,
CASE WHEN ISNULL(p.intermediate_welding, 0) = 0 OR ISNULL(t.intermediate_welding, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_welding / (t.intermediate_welding * 15.0)) END AS intermediate_welding,
CASE WHEN ISNULL(p.intermediate_welding_0_13, 0) = 0 OR ISNULL(t.intermediate_welding_0_13, 0) = 0 THEN 0 ELSE CEILING(p.intermediate_welding_0_13 / (t.intermediate_welding_0_13 * 15.0)) END AS intermediate_welding_0_13,
CASE WHEN ISNULL(p.welding_at_head, 0) = 0 OR ISNULL(t.welding_at_head, 0) = 0 THEN 0 ELSE CEILING(p.welding_at_head / (t.welding_at_head * 15.0)) END AS welding_at_head,
CASE WHEN ISNULL(p.welding_at_head_0_13, 0) = 0 OR ISNULL(t.welding_at_head_0_13, 0) = 0 THEN 0 ELSE CEILING(p.welding_at_head_0_13 / (t.welding_at_head_0_13 * 15.0)) END AS welding_at_head_0_13,
CASE WHEN ISNULL(p.silicon_injection, 0) = 0 OR ISNULL(t.silicon_injection, 0) = 0 THEN 0 ELSE CEILING(p.silicon_injection / (t.silicon_injection * 15.0)) END AS silicon_injection,
CASE WHEN ISNULL(p.welding_cap_insertion, 0) = 0 OR ISNULL(t.welding_cap_insertion, 0) = 0 THEN 0 ELSE CEILING(p.welding_cap_insertion / (t.welding_cap_insertion * 15.0)) END AS welding_cap_insertion,
CASE WHEN ISNULL(p.welding_taping_13mm, 0) = 0 OR ISNULL(t.welding_taping_13mm, 0) = 0 THEN 0 ELSE CEILING(p.welding_taping_13mm / (t.welding_taping_13mm * 15.0)) END AS welding_taping_13mm,
CASE WHEN ISNULL(p.heat_shrink, 0) = 0 OR ISNULL(t.heat_shrink, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink / (t.heat_shrink * 15.0)) END AS heat_shrink,
CASE WHEN ISNULL(p.heat_shrink_la_terminal, 0) = 0 OR ISNULL(t.heat_shrink_la_terminal, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_la_terminal / (t.heat_shrink_la_terminal * 15.0)) END AS heat_shrink_la_terminal,
CASE WHEN ISNULL(p.heat_shrink_joint_crimping, 0) = 0 OR ISNULL(t.heat_shrink_joint_crimping, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_joint_crimping / (t.heat_shrink_joint_crimping * 15.0)) END AS heat_shrink_joint_crimping,
CASE WHEN ISNULL(p.heat_shrink_welding, 0) = 0 OR ISNULL(t.heat_shrink_welding, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_welding / (t.heat_shrink_welding * 15.0)) END AS heat_shrink_welding,
CASE WHEN ISNULL(p.casting_c385, 0) = 0 OR ISNULL(t.casting_c385, 0) = 0 THEN 0 ELSE CEILING(p.casting_c385 / (t.casting_c385 * 15.0)) END AS casting_c385,
CASE WHEN ISNULL(p.stmac_shieldwire_nissan, 0) = 0 OR ISNULL(t.stmac_shieldwire_nissan, 0) = 0 THEN 0 ELSE CEILING(p.stmac_shieldwire_nissan / (t.stmac_shieldwire_nissan * 15.0)) END AS stmac_shieldwire_nissan,
CASE WHEN ISNULL(p.quick_stripping, 0) = 0 OR ISNULL(t.quick_stripping, 0) = 0 THEN 0 ELSE CEILING(p.quick_stripping / (t.quick_stripping * 15.0)) END AS quick_stripping,
CASE WHEN ISNULL(p.manual_heat_shrink_blower_sumitube, 0) = 0 OR ISNULL(t.manual_heat_shrink_blower_sumitube, 0) = 0 THEN 0 ELSE CEILING(p.manual_heat_shrink_blower_sumitube / (t.manual_heat_shrink_blower_sumitube * 15.0)) END AS manual_heat_shrink_blower_sumitube,
CASE WHEN ISNULL(p.drainwire_tip, 0) = 0 OR ISNULL(t.drainwire_tip, 0) = 0 THEN 0 ELSE CEILING(p.drainwire_tip / (t.drainwire_tip * 15.0)) END AS drainwire_tip,
CASE WHEN ISNULL(p.manual_crimping_shieldwire, 0) = 0 OR ISNULL(t.manual_crimping_shieldwire, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_shieldwire / (t.manual_crimping_shieldwire * 15.0)) END AS manual_crimping_shieldwire,
CASE WHEN ISNULL(p.joint_crimping_2_tons_sw, 0) = 0 OR ISNULL(t.joint_crimping_2_tons_sw, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_2_tons_sw / (t.joint_crimping_2_tons_sw * 15.0)) END AS joint_crimping_2_tons_sw,
CASE WHEN ISNULL(p.manual_blue_taping_dispenser_sw, 0) = 0 OR ISNULL(t.manual_blue_taping_dispenser_sw, 0) = 0 THEN 0 ELSE CEILING(p.manual_blue_taping_dispenser_sw / (t.manual_blue_taping_dispenser_sw * 15.0)) END AS manual_blue_taping_dispenser_sw,
CASE WHEN ISNULL(p.shieldwire_taping, 0) = 0 OR ISNULL(t.shieldwire_taping, 0) = 0 THEN 0 ELSE CEILING(p.shieldwire_taping / (t.shieldwire_taping * 15.0)) END AS shieldwire_taping,
CASE WHEN ISNULL(p.hs_components_insertion_sw, 0) = 0 OR ISNULL(t.hs_components_insertion_sw, 0) = 0 THEN 0 ELSE CEILING(p.hs_components_insertion_sw / (t.hs_components_insertion_sw * 15.0)) END AS hs_components_insertion_sw,
CASE WHEN ISNULL(p.heat_shrink_joint_crimping_sw, 0) = 0 OR ISNULL(t.heat_shrink_joint_crimping_sw, 0) = 0 THEN 0 ELSE CEILING(p.heat_shrink_joint_crimping_sw / (t.heat_shrink_joint_crimping_sw * 15.0)) END AS heat_shrink_joint_crimping_sw,
CASE WHEN ISNULL(p.waterproof_pad_press, 0) = 0 OR ISNULL(t.waterproof_pad_press, 0) = 0 THEN 0 ELSE CEILING(p.waterproof_pad_press / (t.waterproof_pad_press * 15.0)) END AS waterproof_pad_press,
CASE WHEN ISNULL(p.low_viscosity, 0) = 0 OR ISNULL(t.low_viscosity, 0) = 0 THEN 0 ELSE CEILING(p.low_viscosity / (t.low_viscosity * 15.0)) END AS low_viscosity,
CASE WHEN ISNULL(p.air_water_leak_test, 0) = 0 OR ISNULL(t.air_water_leak_test, 0) = 0 THEN 0 ELSE CEILING(p.air_water_leak_test / (t.air_water_leak_test * 15.0)) END AS air_water_leak_test,
CASE WHEN ISNULL(p.hirose, 0) = 0 OR ISNULL(t.hirose, 0) = 0 THEN 0 ELSE CEILING(p.hirose / (t.hirose * 15.0)) END AS hirose,
CASE WHEN ISNULL(p.casting_battery, 0) = 0 OR ISNULL(t.casting_battery, 0) = 0 THEN 0 ELSE CEILING(p.casting_battery / (t.casting_battery * 15.0)) END AS casting_battery,
CASE WHEN ISNULL(p.stmac_aluminum, 0) = 0 OR ISNULL(t.stmac_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.stmac_aluminum / (t.stmac_aluminum * 15.0)) END AS stmac_aluminum,
CASE WHEN ISNULL(p.manual_crimping_20tons, 0) = 0 OR ISNULL(t.manual_crimping_20tons, 0) = 0 THEN 0 ELSE CEILING(p.manual_crimping_20tons / (t.manual_crimping_20tons * 15.0)) END AS manual_crimping_20tons,
CASE WHEN ISNULL(p.manual_heat_shrink_blower_battery, 0) = 0 OR ISNULL(t.manual_heat_shrink_blower_battery, 0) = 0 THEN 0 ELSE CEILING(p.manual_heat_shrink_blower_battery / (t.manual_heat_shrink_blower_battery * 15.0)) END AS manual_heat_shrink_blower_battery,
CASE WHEN ISNULL(p.joint_crimping_20tons, 0) = 0 OR ISNULL(t.joint_crimping_20tons, 0) = 0 THEN 0 ELSE CEILING(p.joint_crimping_20tons / (t.joint_crimping_20tons * 15.0)) END AS joint_crimping_20tons,
CASE WHEN ISNULL(p.dip_soldering_battery, 0) = 0 OR ISNULL(t.dip_soldering_battery, 0) = 0 THEN 0 ELSE CEILING(p.dip_soldering_battery / (t.dip_soldering_battery * 15.0)) END AS dip_soldering_battery,
CASE WHEN ISNULL(p.ultrasonic_dip_soldering_aluminum, 0) = 0 OR ISNULL(t.ultrasonic_dip_soldering_aluminum, 0) = 0 THEN 0 ELSE CEILING(p.ultrasonic_dip_soldering_aluminum / (t.ultrasonic_dip_soldering_aluminum * 15.0)) END AS ultrasonic_dip_soldering_aluminum,
CASE WHEN ISNULL(p.la_molding, 0) = 0 OR ISNULL(t.la_molding, 0) = 0 THEN 0 ELSE CEILING(p.la_molding / (t.la_molding * 15.0)) END AS la_molding,
CASE WHEN ISNULL(p.pressure_welding_dome_lamp, 0) = 0 OR ISNULL(t.pressure_welding_dome_lamp, 0) = 0 THEN 0 ELSE CEILING(p.pressure_welding_dome_lamp / (t.pressure_welding_dome_lamp * 15.0)) END AS pressure_welding_dome_lamp,
CASE WHEN ISNULL(p.ferrule_process, 0) = 0 OR ISNULL(t.ferrule_process, 0) = 0 THEN 0 ELSE CEILING(p.ferrule_process / (t.ferrule_process * 15.0)) END AS ferrule_process,
CASE WHEN ISNULL(p.gomusen_insertion, 0) = 0 OR ISNULL(t.gomusen_insertion, 0) = 0 THEN 0 ELSE CEILING(p.gomusen_insertion / (t.gomusen_insertion * 15.0)) END AS gomusen_insertion,
CASE WHEN ISNULL(p.point_marking, 0) = 0 OR ISNULL(t.point_marking, 0) = 0 THEN 0 ELSE CEILING(p.point_marking / (t.point_marking * 15.0)) END AS point_marking
        FROM PlanOutput p
        LEFT JOIN TargetJPH t ON p.section = t.section
        WHERE p.section <> 'Overall'
    ) AS sec
 ),
 -- =============================================================================== ACTUAL OUTPUT ===============================================================================
ActualOutput AS (

    SELECT 
        REPLACE([section], 'Section ', '') AS section,
        'Actual Running Output' AS general_process,
SUM(CASE WHEN [process] = 'UV-III' THEN [daily_result] ELSE 0 END) AS uv_iii,
SUM(CASE WHEN [process] = 'Arc Welding' THEN [daily_result] ELSE 0 END) AS arc_welding,
SUM(CASE WHEN [process] = 'Aluminum Coating UV II' THEN [daily_result] ELSE 0 END) AS aluminum_coating_uv_ii,
SUM(CASE WHEN [process] = 'Servo Crimping' THEN [daily_result] ELSE 0 END) AS servo_crimping,
SUM(CASE WHEN [process] = 'Ultrasonic Welding' THEN [daily_result] ELSE 0 END) AS ultrasonic_welding,
SUM(CASE WHEN [process] = 'Cap Insertion' THEN [daily_result] ELSE 0 END) AS cap_insertion,
SUM(CASE WHEN [process] = 'Twisting Primary Aluminum' THEN [daily_result] ELSE 0 END) AS twisting_primary_aluminum,
SUM(CASE WHEN [process] = 'Twisting Secondary Aluminum' THEN [daily_result] ELSE 0 END) AS twisting_secondary_aluminum,
SUM(CASE WHEN [process] = 'Airbag' THEN [daily_result] ELSE 0 END) AS airbag,
SUM(CASE WHEN [process] = 'A/B Sub PC' THEN [daily_result] ELSE 0 END) AS a_b_sub_pc,
SUM(CASE WHEN [process] = 'Manual Insertion to Connector' THEN [daily_result] ELSE 0 END) AS manual_insertion_to_connector,
SUM(CASE WHEN [process] = 'V Type Twisting' THEN [daily_result] ELSE 0 END) AS v_type_twisting,
SUM(CASE WHEN [process] = 'Twisting Primary' THEN [daily_result] ELSE 0 END) AS twisting_primary,
SUM(CASE WHEN [process] = 'Twisting Secondary' THEN [daily_result] ELSE 0 END) AS twisting_secondary,
SUM(CASE WHEN [process] = 'Manual Crimping 2Tons' THEN [daily_result] ELSE 0 END) AS manual_crimping_2tons,
SUM(CASE WHEN [process] = 'Manual Crimping 4Tons' THEN [daily_result] ELSE 0 END) AS manual_crimping_4tons,
SUM(CASE WHEN [process] = 'Manual Crimping 5Tons' THEN [daily_result] ELSE 0 END) AS manual_crimping_5tons,
SUM(CASE WHEN [process] = 'Intermediate ripping(UAS)Manual-NF-F' THEN [daily_result] ELSE 0 END) AS intermediate_ripping_uas_manual_nf_f,
SUM(CASE WHEN [process] = 'Intermediate ripping (UAS)Joint stripping(KB10)' THEN [daily_result] ELSE 0 END) AS intermediate_ripping_uas_joint,
SUM(CASE WHEN [process] = 'Intermediate stripping(KB10)' THEN [daily_result] ELSE 0 END) AS intermediate_stripping_kb10,
SUM(CASE WHEN [process] = 'Intermediate stripping(KB10)NSC/Weld' THEN [daily_result] ELSE 0 END) AS intermediate_stripping_kb10_nsc_weld,
SUM(CASE WHEN [process] = 'Joint Crimping 2Tons' THEN [daily_result] ELSE 0 END) AS joint_crimping_2_tons,
SUM(CASE WHEN [process] = 'Joint Crimping 4Tons(PS-200)' THEN [daily_result] ELSE 0 END) AS joint_crimping_4tons_ps_200,
SUM(CASE WHEN [process] = 'Joint Crimping 5Tons' THEN [daily_result] ELSE 0 END) AS joint_crimping_5tons,
SUM(CASE WHEN [process] = 'Manual Taping (Dispenser)' THEN [daily_result] ELSE 0 END) AS manual_taping_dispenser,
SUM(CASE WHEN [process] = 'Joint Taping' THEN [daily_result] ELSE 0 END) AS joint_taping,
SUM(CASE WHEN [process] = 'Intermediate Welding' THEN [daily_result] ELSE 0 END) AS intermediate_welding,
SUM(CASE WHEN [process] = 'Intermediate Welding 0.13' THEN [daily_result] ELSE 0 END) AS intermediate_welding_0_13,
SUM(CASE WHEN [process] = 'Welding at Head' THEN [daily_result] ELSE 0 END) AS welding_at_head,
SUM(CASE WHEN [process] = 'Welding at Head 0.13' THEN [daily_result] ELSE 0 END) AS welding_at_head_0_13,
SUM(CASE WHEN [process] = 'Silicon Injection' THEN [daily_result] ELSE 0 END) AS silicon_injection,
SUM(CASE WHEN [process] = 'Welding Cap Insertion' THEN [daily_result] ELSE 0 END) AS welding_cap_insertion,
SUM(CASE WHEN [process] = 'Welding Taping(13mm)' THEN [daily_result] ELSE 0 END) AS welding_taping_13mm,
SUM(CASE WHEN [process] = 'Heatshrink' THEN [daily_result] ELSE 0 END) AS heat_shrink,
SUM(CASE WHEN [process] = 'Heat Shrink LA terminal' THEN [daily_result] ELSE 0 END) AS heat_shrink_la_terminal,
SUM(CASE WHEN [process] = 'Heat Shrink (Joint Crimping)' THEN [daily_result] ELSE 0 END) AS heat_shrink_joint_crimping,
SUM(CASE WHEN [process] = 'Heat Shrink (Welding)' THEN [daily_result] ELSE 0 END) AS heat_shrink_welding,
SUM(CASE WHEN [process] = 'Casting C385' THEN [daily_result] ELSE 0 END) AS casting_c385,
SUM(CASE WHEN [process] = 'STMAC Shieldwire(Nissan)' THEN [daily_result] ELSE 0 END) AS stmac_shieldwire_nissan,
SUM(CASE WHEN [process] = 'Quick Stripping' THEN [daily_result] ELSE 0 END) AS quick_stripping,
SUM(CASE WHEN [process] = 'Manual Heat Shrink(Blower)Sumitube' THEN [daily_result] ELSE 0 END) AS manual_heat_shrink_blower_sumitube,
SUM(CASE WHEN [process] = 'Drainwire Tip' THEN [daily_result] ELSE 0 END) AS drainwire_tip,
SUM(CASE WHEN [process] = 'Manual Crimping Shieldwire' THEN [daily_result] ELSE 0 END) AS manual_crimping_shieldwire,
SUM(CASE WHEN [process] = 'Joint Crimping 2TonsSW' THEN [daily_result] ELSE 0 END) AS joint_crimping_2_tons_sw,
SUM(CASE WHEN [process] = 'Manual Blue Taping(Dispenser)SW' THEN [daily_result] ELSE 0 END) AS manual_blue_taping_dispenser_sw,
SUM(CASE WHEN [process] = 'Shieldwire Taping' THEN [daily_result] ELSE 0 END) AS shieldwire_taping,
SUM(CASE WHEN [process] = 'HS Components Insertion SW' THEN [daily_result] ELSE 0 END) AS hs_components_insertion_sw,
SUM(CASE WHEN [process] = 'Heat Shrink (Joint Crimping)SW' THEN [daily_result] ELSE 0 END) AS heat_shrink_joint_crimping_sw,
SUM(CASE WHEN [process] = 'Waterproof pad Press' THEN [daily_result] ELSE 0 END) AS waterproof_pad_press,
SUM(CASE WHEN [process] = 'Low Vicosity' THEN [daily_result] ELSE 0 END) AS low_viscosity,
SUM(CASE WHEN [process] = 'Air/Water leak test' THEN [daily_result] ELSE 0 END) AS air_water_leak_test,
SUM(CASE WHEN [process] = 'HIROSE' THEN [daily_result] ELSE 0 END) AS hirose,
SUM(CASE WHEN [process] = 'Casting Battery' THEN [daily_result] ELSE 0 END) AS casting_battery,
SUM(CASE WHEN [process] = 'STMACAluminum' THEN [daily_result] ELSE 0 END) AS stmac_aluminum,
SUM(CASE WHEN [process] = 'Manual Crimping 20Tons' THEN [daily_result] ELSE 0 END) AS manual_crimping_20tons,
SUM(CASE WHEN [process] = 'Manual Heat Shrink (Blower)Battery' THEN [daily_result] ELSE 0 END) AS manual_heat_shrink_blower_battery,
SUM(CASE WHEN [process] = 'Joint Crimping 20Tons' THEN [daily_result] ELSE 0 END) AS joint_crimping_20tons,
SUM(CASE WHEN [process] = 'Dip Soldering (Battery)' THEN [daily_result] ELSE 0 END) AS dip_soldering_battery,
SUM(CASE WHEN [process] = 'Ultrasonic Dip SolderingAluminum' THEN [daily_result] ELSE 0 END) AS ultrasonic_dip_soldering_aluminum,
SUM(CASE WHEN [process] = 'La molding' THEN [daily_result] ELSE 0 END) AS la_molding,
SUM(CASE WHEN [process] = 'Pressure Welding(Dome Lamp)' THEN [daily_result] ELSE 0 END) AS pressure_welding_dome_lamp,
SUM(CASE WHEN [process] = 'Ferrule Process' THEN [daily_result] ELSE 0 END) AS ferrule_process,
SUM(CASE WHEN [process] = 'Gomusen Insertion' THEN [daily_result] ELSE 0 END) AS gomusen_insertion,
SUM(CASE WHEN [process] = 'Point Marking' THEN [daily_result] ELSE 0 END) AS point_marking,




        SUM(CASE 
            WHEN [process] IN (
        
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
'Low Vicosity',
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


            ) THEN [daily_result] 
            ELSE 0 
        END) AS Total
    FROM 
        [secondary_dashboard_db].[dbo].[section_page]
    WHERE 
        [details] = 'Actual Running Output'
        AND [process] IN (
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
'Low Vicosity',
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

        )
    GROUP BY 
        [section]

    UNION ALL

    SELECT 
        'Overall' AS section,
        'Actual Running Output' AS general_process,
SUM(CASE WHEN [process] = 'UV-III' THEN [daily_result] ELSE 0 END) AS uv_iii,
SUM(CASE WHEN [process] = 'Arc Welding' THEN [daily_result] ELSE 0 END) AS arc_welding,
SUM(CASE WHEN [process] = 'Aluminum Coating UV II' THEN [daily_result] ELSE 0 END) AS aluminum_coating_uv_ii,
SUM(CASE WHEN [process] = 'Servo Crimping' THEN [daily_result] ELSE 0 END) AS servo_crimping,
SUM(CASE WHEN [process] = 'Ultrasonic Welding' THEN [daily_result] ELSE 0 END) AS ultrasonic_welding,
SUM(CASE WHEN [process] = 'Cap Insertion' THEN [daily_result] ELSE 0 END) AS cap_insertion,
SUM(CASE WHEN [process] = 'Twisting Primary Aluminum' THEN [daily_result] ELSE 0 END) AS twisting_primary_aluminum,
SUM(CASE WHEN [process] = 'Twisting Secondary Aluminum' THEN [daily_result] ELSE 0 END) AS twisting_secondary_aluminum,
SUM(CASE WHEN [process] = 'Airbag' THEN [daily_result] ELSE 0 END) AS airbag,
SUM(CASE WHEN [process] = 'A/B Sub PC' THEN [daily_result] ELSE 0 END) AS a_b_sub_pc,
SUM(CASE WHEN [process] = 'Manual Insertion to Connector' THEN [daily_result] ELSE 0 END) AS manual_insertion_to_connector,
SUM(CASE WHEN [process] = 'V Type Twisting' THEN [daily_result] ELSE 0 END) AS v_type_twisting,
SUM(CASE WHEN [process] = 'Twisting Primary' THEN [daily_result] ELSE 0 END) AS twisting_primary,
SUM(CASE WHEN [process] = 'Twisting Secondary' THEN [daily_result] ELSE 0 END) AS twisting_secondary,
SUM(CASE WHEN [process] = 'Manual Crimping 2Tons' THEN [daily_result] ELSE 0 END) AS manual_crimping_2tons,
SUM(CASE WHEN [process] = 'Manual Crimping 4Tons' THEN [daily_result] ELSE 0 END) AS manual_crimping_4tons,
SUM(CASE WHEN [process] = 'Manual Crimping 5Tons' THEN [daily_result] ELSE 0 END) AS manual_crimping_5tons,
SUM(CASE WHEN [process] = 'Intermediate ripping(UAS)Manual-NF-F' THEN [daily_result] ELSE 0 END) AS intermediate_ripping_uas_manual_nf_f,
SUM(CASE WHEN [process] = 'Intermediate ripping (UAS)Joint stripping(KB10)' THEN [daily_result] ELSE 0 END) AS intermediate_ripping_uas_joint,
SUM(CASE WHEN [process] = 'Intermediate stripping(KB10)' THEN [daily_result] ELSE 0 END) AS intermediate_stripping_kb10,
SUM(CASE WHEN [process] = 'Intermediate stripping(KB10)NSC/Weld' THEN [daily_result] ELSE 0 END) AS intermediate_stripping_kb10_nsc_weld,
SUM(CASE WHEN [process] = 'Joint Crimping 2Tons' THEN [daily_result] ELSE 0 END) AS joint_crimping_2_tons,
SUM(CASE WHEN [process] = 'Joint Crimping 4Tons(PS-200)' THEN [daily_result] ELSE 0 END) AS joint_crimping_4tons_ps_200,
SUM(CASE WHEN [process] = 'Joint Crimping 5Tons' THEN [daily_result] ELSE 0 END) AS joint_crimping_5tons,
SUM(CASE WHEN [process] = 'Manual Taping (Dispenser)' THEN [daily_result] ELSE 0 END) AS manual_taping_dispenser,
SUM(CASE WHEN [process] = 'Joint Taping' THEN [daily_result] ELSE 0 END) AS joint_taping,
SUM(CASE WHEN [process] = 'Intermediate Welding' THEN [daily_result] ELSE 0 END) AS intermediate_welding,
SUM(CASE WHEN [process] = 'Intermediate Welding 0.13' THEN [daily_result] ELSE 0 END) AS intermediate_welding_0_13,
SUM(CASE WHEN [process] = 'Welding at Head' THEN [daily_result] ELSE 0 END) AS welding_at_head,
SUM(CASE WHEN [process] = 'Welding at Head 0.13' THEN [daily_result] ELSE 0 END) AS welding_at_head_0_13,
SUM(CASE WHEN [process] = 'Silicon Injection' THEN [daily_result] ELSE 0 END) AS silicon_injection,
SUM(CASE WHEN [process] = 'Welding Cap Insertion' THEN [daily_result] ELSE 0 END) AS welding_cap_insertion,
SUM(CASE WHEN [process] = 'Welding Taping(13mm)' THEN [daily_result] ELSE 0 END) AS welding_taping_13mm,
SUM(CASE WHEN [process] = 'Heatshrink' THEN [daily_result] ELSE 0 END) AS heat_shrink,
SUM(CASE WHEN [process] = 'Heat Shrink LA terminal' THEN [daily_result] ELSE 0 END) AS heat_shrink_la_terminal,
SUM(CASE WHEN [process] = 'Heat Shrink (Joint Crimping)' THEN [daily_result] ELSE 0 END) AS heat_shrink_joint_crimping,
SUM(CASE WHEN [process] = 'Heat Shrink (Welding)' THEN [daily_result] ELSE 0 END) AS heat_shrink_welding,
SUM(CASE WHEN [process] = 'Casting C385' THEN [daily_result] ELSE 0 END) AS casting_c385,
SUM(CASE WHEN [process] = 'STMAC Shieldwire(Nissan)' THEN [daily_result] ELSE 0 END) AS stmac_shieldwire_nissan,
SUM(CASE WHEN [process] = 'Quick Stripping' THEN [daily_result] ELSE 0 END) AS quick_stripping,
SUM(CASE WHEN [process] = 'Manual Heat Shrink(Blower)Sumitube' THEN [daily_result] ELSE 0 END) AS manual_heat_shrink_blower_sumitube,
SUM(CASE WHEN [process] = 'Drainwire Tip' THEN [daily_result] ELSE 0 END) AS drainwire_tip,
SUM(CASE WHEN [process] = 'Manual Crimping Shieldwire' THEN [daily_result] ELSE 0 END) AS manual_crimping_shieldwire,
SUM(CASE WHEN [process] = 'Joint Crimping 2TonsSW' THEN [daily_result] ELSE 0 END) AS joint_crimping_2_tons_sw,
SUM(CASE WHEN [process] = 'Manual Blue Taping(Dispenser)SW' THEN [daily_result] ELSE 0 END) AS manual_blue_taping_dispenser_sw,
SUM(CASE WHEN [process] = 'Shieldwire Taping' THEN [daily_result] ELSE 0 END) AS shieldwire_taping,
SUM(CASE WHEN [process] = 'HS Components Insertion SW' THEN [daily_result] ELSE 0 END) AS hs_components_insertion_sw,
SUM(CASE WHEN [process] = 'Heat Shrink (Joint Crimping)SW' THEN [daily_result] ELSE 0 END) AS heat_shrink_joint_crimping_sw,
SUM(CASE WHEN [process] = 'Waterproof pad Press' THEN [daily_result] ELSE 0 END) AS waterproof_pad_press,
SUM(CASE WHEN [process] = 'Low Vicosity' THEN [daily_result] ELSE 0 END) AS low_viscosity,
SUM(CASE WHEN [process] = 'Air/Water leak test' THEN [daily_result] ELSE 0 END) AS air_water_leak_test,
SUM(CASE WHEN [process] = 'HIROSE' THEN [daily_result] ELSE 0 END) AS hirose,
SUM(CASE WHEN [process] = 'Casting Battery' THEN [daily_result] ELSE 0 END) AS casting_battery,
SUM(CASE WHEN [process] = 'STMACAluminum' THEN [daily_result] ELSE 0 END) AS stmac_aluminum,
SUM(CASE WHEN [process] = 'Manual Crimping 20Tons' THEN [daily_result] ELSE 0 END) AS manual_crimping_20tons,
SUM(CASE WHEN [process] = 'Manual Heat Shrink (Blower)Battery' THEN [daily_result] ELSE 0 END) AS manual_heat_shrink_blower_battery,
SUM(CASE WHEN [process] = 'Joint Crimping 20Tons' THEN [daily_result] ELSE 0 END) AS joint_crimping_20tons,
SUM(CASE WHEN [process] = 'Dip Soldering (Battery)' THEN [daily_result] ELSE 0 END) AS dip_soldering_battery,
SUM(CASE WHEN [process] = 'Ultrasonic Dip SolderingAluminum' THEN [daily_result] ELSE 0 END) AS ultrasonic_dip_soldering_aluminum,
SUM(CASE WHEN [process] = 'La molding' THEN [daily_result] ELSE 0 END) AS la_molding,
SUM(CASE WHEN [process] = 'Pressure Welding(Dome Lamp)' THEN [daily_result] ELSE 0 END) AS pressure_welding_dome_lamp,
SUM(CASE WHEN [process] = 'Ferrule Process' THEN [daily_result] ELSE 0 END) AS ferrule_process,
SUM(CASE WHEN [process] = 'Gomusen Insertion' THEN [daily_result] ELSE 0 END) AS gomusen_insertion,
SUM(CASE WHEN [process] = 'Point Marking' THEN [daily_result] ELSE 0 END) AS point_marking,



        SUM(
            CASE 
                WHEN [process] IN (
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
'Low Vicosity',
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

                ) THEN [daily_result] 
                ELSE 0 
            END
        ) AS Total
    FROM 
        [secondary_dashboard_db].[dbo].[section_page]
    WHERE 
        [details] = 'Actual Running Output'
        AND [process] IN (
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
'Low Vicosity',
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
        )
),

 -- =============================================================================== WIP ===============================================================================

WIP AS (
    SELECT 
        a.section,
        'WIP' AS general_process,
       a.[uv_iii] - p.[uv_iii] AS uv_iii,
a.[arc_welding] - p.[arc_welding] AS arc_welding,
a.[aluminum_coating_uv_ii] - p.[aluminum_coating_uv_ii] AS aluminum_coating_uv_ii,
a.[servo_crimping] - p.[servo_crimping] AS servo_crimping,
a.[ultrasonic_welding] - p.[ultrasonic_welding] AS ultrasonic_welding,
a.[cap_insertion] - p.[cap_insertion] AS cap_insertion,
a.[twisting_primary_aluminum] - p.[twisting_primary_aluminum] AS twisting_primary_aluminum,
a.[twisting_secondary_aluminum] - p.[twisting_secondary_aluminum] AS twisting_secondary_aluminum,
a.[airbag] - p.[airbag] AS airbag,
a.[a_b_sub_pc] - p.[a_b_sub_pc] AS a_b_sub_pc,
a.[manual_insertion_to_connector] - p.[manual_insertion_to_connector] AS manual_insertion_to_connector,
a.[v_type_twisting] - p.[v_type_twisting] AS v_type_twisting,
a.[twisting_primary] - p.[twisting_primary] AS twisting_primary,
a.[twisting_secondary] - p.[twisting_secondary] AS twisting_secondary,
a.[manual_crimping_2tons] - p.[manual_crimping_2tons] AS manual_crimping_2tons,
a.[manual_crimping_4tons] - p.[manual_crimping_4tons] AS manual_crimping_4tons,
a.[manual_crimping_5tons] - p.[manual_crimping_5tons] AS manual_crimping_5tons,
a.[intermediate_ripping_uas_manual_nf_f] - p.[intermediate_ripping_uas_manual_nf_f] AS intermediate_ripping_uas_manual_nf_f,
a.[intermediate_ripping_uas_joint] - p.[intermediate_ripping_uas_joint] AS intermediate_ripping_uas_joint,
a.[intermediate_stripping_kb10] - p.[intermediate_stripping_kb10] AS intermediate_stripping_kb10,
a.[intermediate_stripping_kb10_nsc_weld] - p.[intermediate_stripping_kb10_nsc_weld] AS intermediate_stripping_kb10_nsc_weld,
a.[joint_crimping_2_tons] - p.[joint_crimping_2_tons] AS joint_crimping_2_tons,
a.[joint_crimping_4tons_ps_200] - p.[joint_crimping_4tons_ps_200] AS joint_crimping_4tons_ps_200,
a.[joint_crimping_5tons] - p.[joint_crimping_5tons] AS joint_crimping_5tons,
a.[manual_taping_dispenser] - p.[manual_taping_dispenser] AS manual_taping_dispenser,
a.[joint_taping] - p.[joint_taping] AS joint_taping,
a.[intermediate_welding] - p.[intermediate_welding] AS intermediate_welding,
a.[intermediate_welding_0_13] - p.[intermediate_welding_0_13] AS intermediate_welding_0_13,
a.[welding_at_head] - p.[welding_at_head] AS welding_at_head,
a.[welding_at_head_0_13] - p.[welding_at_head_0_13] AS welding_at_head_0_13,
a.[silicon_injection] - p.[silicon_injection] AS silicon_injection,
a.[welding_cap_insertion] - p.[welding_cap_insertion] AS welding_cap_insertion,
a.[welding_taping_13mm] - p.[welding_taping_13mm] AS welding_taping_13mm,
a.[heat_shrink] - p.[heat_shrink] AS heat_shrink,
a.[heat_shrink_la_terminal] - p.[heat_shrink_la_terminal] AS heat_shrink_la_terminal,
a.[heat_shrink_joint_crimping] - p.[heat_shrink_joint_crimping] AS heat_shrink_joint_crimping,
a.[heat_shrink_welding] - p.[heat_shrink_welding] AS heat_shrink_welding,
a.[casting_c385] - p.[casting_c385] AS casting_c385,
a.[stmac_shieldwire_nissan] - p.[stmac_shieldwire_nissan] AS stmac_shieldwire_nissan,
a.[quick_stripping] - p.[quick_stripping] AS quick_stripping,
a.[manual_heat_shrink_blower_sumitube] - p.[manual_heat_shrink_blower_sumitube] AS manual_heat_shrink_blower_sumitube,
a.[drainwire_tip] - p.[drainwire_tip] AS drainwire_tip,
a.[manual_crimping_shieldwire] - p.[manual_crimping_shieldwire] AS manual_crimping_shieldwire,
a.[joint_crimping_2_tons_sw] - p.[joint_crimping_2_tons_sw] AS joint_crimping_2_tons_sw,
a.[manual_blue_taping_dispenser_sw] - p.[manual_blue_taping_dispenser_sw] AS manual_blue_taping_dispenser_sw,
a.[shieldwire_taping] - p.[shieldwire_taping] AS shieldwire_taping,
a.[hs_components_insertion_sw] - p.[hs_components_insertion_sw] AS hs_components_insertion_sw,
a.[heat_shrink_joint_crimping_sw] - p.[heat_shrink_joint_crimping_sw] AS heat_shrink_joint_crimping_sw,
a.[waterproof_pad_press] - p.[waterproof_pad_press] AS waterproof_pad_press,
a.[low_viscosity] - p.[low_viscosity] AS low_viscosity,
a.[air_water_leak_test] - p.[air_water_leak_test] AS air_water_leak_test,
a.[hirose] - p.[hirose] AS hirose,
a.[casting_battery] - p.[casting_battery] AS casting_battery,
a.[stmac_aluminum] - p.[stmac_aluminum] AS stmac_aluminum,
a.[manual_crimping_20tons] - p.[manual_crimping_20tons] AS manual_crimping_20tons,
a.[manual_heat_shrink_blower_battery] - p.[manual_heat_shrink_blower_battery] AS manual_heat_shrink_blower_battery,
a.[joint_crimping_20tons] - p.[joint_crimping_20tons] AS joint_crimping_20tons,
a.[dip_soldering_battery] - p.[dip_soldering_battery] AS dip_soldering_battery,
a.[ultrasonic_dip_soldering_aluminum] - p.[ultrasonic_dip_soldering_aluminum] AS ultrasonic_dip_soldering_aluminum,
a.[la_molding] - p.[la_molding] AS la_molding,
a.[pressure_welding_dome_lamp] - p.[pressure_welding_dome_lamp] AS pressure_welding_dome_lamp,
a.[ferrule_process] - p.[ferrule_process] AS ferrule_process,
a.[gomusen_insertion] - p.[gomusen_insertion] AS gomusen_insertion,
a.[point_marking] - p.[point_marking] AS point_marking,


   a.Total - p.Total AS Total
    FROM ActualOutput a
    JOIN PlanOutput p ON a.section = p.section
),

-- =============================================================================== Plan Per Machine ===============================================================================

 PlanPerMachine AS (
    SELECT 
        p.section,
        'Plan Per Machine' AS general_process,
ISNULL(ROUND(p.uv_iii / NULLIF(m.uv_iii, 0), 2), 0) AS uv_iii,
ISNULL(ROUND(p.arc_welding / NULLIF(m.arc_welding, 0), 2), 0) AS arc_welding,
ISNULL(ROUND(p.aluminum_coating_uv_ii / NULLIF(m.aluminum_coating_uv_ii, 0), 2), 0) AS aluminum_coating_uv_ii,
ISNULL(ROUND(p.servo_crimping / NULLIF(m.servo_crimping, 0), 2), 0) AS servo_crimping,
ISNULL(ROUND(p.ultrasonic_welding / NULLIF(m.ultrasonic_welding, 0), 2), 0) AS ultrasonic_welding,
ISNULL(ROUND(p.cap_insertion / NULLIF(m.cap_insertion, 0), 2), 0) AS cap_insertion,
ISNULL(ROUND(p.twisting_primary_aluminum / NULLIF(m.twisting_primary_aluminum, 0), 2), 0) AS twisting_primary_aluminum,
ISNULL(ROUND(p.twisting_secondary_aluminum / NULLIF(m.twisting_secondary_aluminum, 0), 2), 0) AS twisting_secondary_aluminum,
ISNULL(ROUND(p.airbag / NULLIF(m.airbag, 0), 2), 0) AS airbag,
ISNULL(ROUND(p.a_b_sub_pc / NULLIF(m.a_b_sub_pc, 0), 2), 0) AS a_b_sub_pc,
ISNULL(ROUND(p.manual_insertion_to_connector / NULLIF(m.manual_insertion_to_connector, 0), 2), 0) AS manual_insertion_to_connector,
ISNULL(ROUND(p.v_type_twisting / NULLIF(m.v_type_twisting, 0), 2), 0) AS v_type_twisting,
ISNULL(ROUND(p.twisting_primary / NULLIF(m.twisting_primary, 0), 2), 0) AS twisting_primary,
ISNULL(ROUND(p.twisting_secondary / NULLIF(m.twisting_secondary, 0), 2), 0) AS twisting_secondary,
ISNULL(ROUND(p.manual_crimping_2tons / NULLIF(m.manual_crimping_2tons, 0), 2), 0) AS manual_crimping_2tons,
ISNULL(ROUND(p.manual_crimping_4tons / NULLIF(m.manual_crimping_4tons, 0), 2), 0) AS manual_crimping_4tons,
ISNULL(ROUND(p.manual_crimping_5tons / NULLIF(m.manual_crimping_5tons, 0), 2), 0) AS manual_crimping_5tons,
ISNULL(ROUND(p.intermediate_ripping_uas_manual_nf_f / NULLIF(m.intermediate_ripping_uas_manual_nf_f, 0), 2), 0) AS intermediate_ripping_uas_manual_nf_f,
ISNULL(ROUND(p.intermediate_ripping_uas_joint / NULLIF(m.intermediate_ripping_uas_joint, 0), 2), 0) AS intermediate_ripping_uas_joint,
ISNULL(ROUND(p.intermediate_stripping_kb10 / NULLIF(m.intermediate_stripping_kb10, 0), 2), 0) AS intermediate_stripping_kb10,
ISNULL(ROUND(p.intermediate_stripping_kb10_nsc_weld / NULLIF(m.intermediate_stripping_kb10_nsc_weld, 0), 2), 0) AS intermediate_stripping_kb10_nsc_weld,
ISNULL(ROUND(p.joint_crimping_2_tons / NULLIF(m.joint_crimping_2_tons, 0), 2), 0) AS joint_crimping_2_tons,
ISNULL(ROUND(p.joint_crimping_4tons_ps_200 / NULLIF(m.joint_crimping_4tons_ps_200, 0), 2), 0) AS joint_crimping_4tons_ps_200,
ISNULL(ROUND(p.joint_crimping_5tons / NULLIF(m.joint_crimping_5tons, 0), 2), 0) AS joint_crimping_5tons,
ISNULL(ROUND(p.manual_taping_dispenser / NULLIF(m.manual_taping_dispenser, 0), 2), 0) AS manual_taping_dispenser,
ISNULL(ROUND(p.joint_taping / NULLIF(m.joint_taping, 0), 2), 0) AS joint_taping,
ISNULL(ROUND(p.intermediate_welding / NULLIF(m.intermediate_welding, 0), 2), 0) AS intermediate_welding,
ISNULL(ROUND(p.intermediate_welding_0_13 / NULLIF(m.intermediate_welding_0_13, 0), 2), 0) AS intermediate_welding_0_13,
ISNULL(ROUND(p.welding_at_head / NULLIF(m.welding_at_head, 0), 2), 0) AS welding_at_head,
ISNULL(ROUND(p.welding_at_head_0_13 / NULLIF(m.welding_at_head_0_13, 0), 2), 0) AS welding_at_head_0_13,
ISNULL(ROUND(p.silicon_injection / NULLIF(m.silicon_injection, 0), 2), 0) AS silicon_injection,
ISNULL(ROUND(p.welding_cap_insertion / NULLIF(m.welding_cap_insertion, 0), 2), 0) AS welding_cap_insertion,
ISNULL(ROUND(p.welding_taping_13mm / NULLIF(m.welding_taping_13mm, 0), 2), 0) AS welding_taping_13mm,
ISNULL(ROUND(p.heat_shrink / NULLIF(m.heat_shrink, 0), 2), 0) AS heat_shrink,
ISNULL(ROUND(p.heat_shrink_la_terminal / NULLIF(m.heat_shrink_la_terminal, 0), 2), 0) AS heat_shrink_la_terminal,
ISNULL(ROUND(p.heat_shrink_joint_crimping / NULLIF(m.heat_shrink_joint_crimping, 0), 2), 0) AS heat_shrink_joint_crimping,
ISNULL(ROUND(p.heat_shrink_welding / NULLIF(m.heat_shrink_welding, 0), 2), 0) AS heat_shrink_welding,
ISNULL(ROUND(p.casting_c385 / NULLIF(m.casting_c385, 0), 2), 0) AS casting_c385,
ISNULL(ROUND(p.stmac_shieldwire_nissan / NULLIF(m.stmac_shieldwire_nissan, 0), 2), 0) AS stmac_shieldwire_nissan,
ISNULL(ROUND(p.quick_stripping / NULLIF(m.quick_stripping, 0), 2), 0) AS quick_stripping,
ISNULL(ROUND(p.manual_heat_shrink_blower_sumitube / NULLIF(m.manual_heat_shrink_blower_sumitube, 0), 2), 0) AS manual_heat_shrink_blower_sumitube,
ISNULL(ROUND(p.drainwire_tip / NULLIF(m.drainwire_tip, 0), 2), 0) AS drainwire_tip,
ISNULL(ROUND(p.manual_crimping_shieldwire / NULLIF(m.manual_crimping_shieldwire, 0), 2), 0) AS manual_crimping_shieldwire,
ISNULL(ROUND(p.joint_crimping_2_tons_sw / NULLIF(m.joint_crimping_2_tons_sw, 0), 2), 0) AS joint_crimping_2_tons_sw,
ISNULL(ROUND(p.manual_blue_taping_dispenser_sw / NULLIF(m.manual_blue_taping_dispenser_sw, 0), 2), 0) AS manual_blue_taping_dispenser_sw,
ISNULL(ROUND(p.shieldwire_taping / NULLIF(m.shieldwire_taping, 0), 2), 0) AS shieldwire_taping,
ISNULL(ROUND(p.hs_components_insertion_sw / NULLIF(m.hs_components_insertion_sw, 0), 2), 0) AS hs_components_insertion_sw,
ISNULL(ROUND(p.heat_shrink_joint_crimping_sw / NULLIF(m.heat_shrink_joint_crimping_sw, 0), 2), 0) AS heat_shrink_joint_crimping_sw,
ISNULL(ROUND(p.waterproof_pad_press / NULLIF(m.waterproof_pad_press, 0), 2), 0) AS waterproof_pad_press,
ISNULL(ROUND(p.low_viscosity / NULLIF(m.low_viscosity, 0), 2), 0) AS low_viscosity,
ISNULL(ROUND(p.air_water_leak_test / NULLIF(m.air_water_leak_test, 0), 2), 0) AS air_water_leak_test,
ISNULL(ROUND(p.hirose / NULLIF(m.hirose, 0), 2), 0) AS hirose,
ISNULL(ROUND(p.casting_battery / NULLIF(m.casting_battery, 0), 2), 0) AS casting_battery,
ISNULL(ROUND(p.stmac_aluminum / NULLIF(m.stmac_aluminum, 0), 2), 0) AS stmac_aluminum,
ISNULL(ROUND(p.manual_crimping_20tons / NULLIF(m.manual_crimping_20tons, 0), 2), 0) AS manual_crimping_20tons,
ISNULL(ROUND(p.manual_heat_shrink_blower_battery / NULLIF(m.manual_heat_shrink_blower_battery, 0), 2), 0) AS manual_heat_shrink_blower_battery,
ISNULL(ROUND(p.joint_crimping_20tons / NULLIF(m.joint_crimping_20tons, 0), 2), 0) AS joint_crimping_20tons,
ISNULL(ROUND(p.dip_soldering_battery / NULLIF(m.dip_soldering_battery, 0), 2), 0) AS dip_soldering_battery,
ISNULL(ROUND(p.ultrasonic_dip_soldering_aluminum / NULLIF(m.ultrasonic_dip_soldering_aluminum, 0), 2), 0) AS ultrasonic_dip_soldering_aluminum,
ISNULL(ROUND(p.la_molding / NULLIF(m.la_molding, 0), 2), 0) AS la_molding,
ISNULL(ROUND(p.pressure_welding_dome_lamp / NULLIF(m.pressure_welding_dome_lamp, 0), 2), 0) AS pressure_welding_dome_lamp,
ISNULL(ROUND(p.ferrule_process / NULLIF(m.ferrule_process, 0), 2), 0) AS ferrule_process,
ISNULL(ROUND(p.gomusen_insertion / NULLIF(m.gomusen_insertion, 0), 2), 0) AS gomusen_insertion,
ISNULL(ROUND(p.point_marking / NULLIF(m.point_marking, 0), 2), 0) AS point_marking,
   ISNULL(ROUND(p.Total / NULLIF(m.Total, 0), 2), 0) AS Total
    FROM 
        PlanOutput p
    JOIN 
        MachineCount m ON p.section = m.section
),
-- =============================================================================== Actual JPH===============================================================================
ActualJPH AS (
    SELECT 
        REPLACE([section], 'Section ', '') AS section,
        'Actual JPH' AS general_process,

    ROUND(ISNULL(AVG(CASE WHEN [process] = 'UV-III' THEN [daily_result] ELSE NULL END), 0), 2) AS uv_iii,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Arc Welding' THEN [daily_result] ELSE NULL END), 0), 2) AS arc_welding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Aluminum Coating UV II' THEN [daily_result] ELSE NULL END), 0), 2) AS aluminum_coating_uv_ii,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Servo Crimping' THEN [daily_result] ELSE NULL END), 0), 2) AS servo_crimping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Ultrasonic Welding' THEN [daily_result] ELSE NULL END), 0), 2) AS ultrasonic_welding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Cap Insertion' THEN [daily_result] ELSE NULL END), 0), 2) AS cap_insertion,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Twisting Primary Aluminum' THEN [daily_result] ELSE NULL END), 0), 2) AS twisting_primary_aluminum,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Twisting Secondary Aluminum' THEN [daily_result] ELSE NULL END), 0), 2) AS twisting_secondary_aluminum,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Airbag' THEN [daily_result] ELSE NULL END), 0), 2) AS airbag,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'A/B Sub PC' THEN [daily_result] ELSE NULL END), 0), 2) AS a_b_sub_pc,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Insertion to Connector' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_insertion_to_connector,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'V Type Twisting' THEN [daily_result] ELSE NULL END), 0), 2) AS v_type_twisting,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Twisting Primary' THEN [daily_result] ELSE NULL END), 0), 2) AS twisting_primary,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Twisting Secondary' THEN [daily_result] ELSE NULL END), 0), 2) AS twisting_secondary,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping 2Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_2tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping 4Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_4tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping 5Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_5tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate ripping(UAS)Manual-NF-F' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_ripping_uas_manual_nf_f,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate ripping (UAS)Joint stripping(KB10)' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_ripping_uas_joint,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate stripping(KB10)' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_stripping_kb10,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate stripping(KB10)NSC/Weld' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_stripping_kb10_nsc_weld,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 2Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_2_tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 4Tons(PS-200)' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_4tons_ps_200,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 5Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_5tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Taping (Dispenser)' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_taping_dispenser,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Taping' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_taping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate Welding' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_welding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate Welding 0.13' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_welding_0_13,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Welding at Head' THEN [daily_result] ELSE NULL END), 0), 2) AS welding_at_head,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Welding at Head 0.13' THEN [daily_result] ELSE NULL END), 0), 2) AS welding_at_head_0_13,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Silicon Injection' THEN [daily_result] ELSE NULL END), 0), 2) AS silicon_injection,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Welding Cap Insertion' THEN [daily_result] ELSE NULL END), 0), 2) AS welding_cap_insertion,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Welding Taping(13mm)' THEN [daily_result] ELSE NULL END), 0), 2) AS welding_taping_13mm,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heatshrink' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heat Shrink LA terminal' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink_la_terminal,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heat Shrink (Joint Crimping)' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink_joint_crimping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heat Shrink (Welding)' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink_welding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Casting C385' THEN [daily_result] ELSE NULL END), 0), 2) AS casting_c385,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'STMAC Shieldwire(Nissan)' THEN [daily_result] ELSE NULL END), 0), 2) AS stmac_shieldwire_nissan,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Quick Stripping' THEN [daily_result] ELSE NULL END), 0), 2) AS quick_stripping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Heat Shrink(Blower)Sumitube' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_heat_shrink_blower_sumitube,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Drainwire Tip' THEN [daily_result] ELSE NULL END), 0), 2) AS drainwire_tip,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping Shieldwire' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_shieldwire,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 2TonsSW' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_2_tons_sw,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Blue Taping(Dispenser)SW' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_blue_taping_dispenser_sw,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Shieldwire Taping' THEN [daily_result] ELSE NULL END), 0), 2) AS shieldwire_taping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'HS Components Insertion SW' THEN [daily_result] ELSE NULL END), 0), 2) AS hs_components_insertion_sw,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heat Shrink (Joint Crimping)SW' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink_joint_crimping_sw,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Waterproof pad Press' THEN [daily_result] ELSE NULL END), 0), 2) AS waterproof_pad_press,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Low Viscosity' THEN [daily_result] ELSE NULL END), 0), 2) AS low_viscosity,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Air/Water leak test' THEN [daily_result] ELSE NULL END), 0), 2) AS air_water_leak_test,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'HIROSE' THEN [daily_result] ELSE NULL END), 0), 2) AS hirose,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Casting Battery' THEN [daily_result] ELSE NULL END), 0), 2) AS casting_battery,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'STMACAluminum' THEN [daily_result] ELSE NULL END), 0), 2) AS stmac_aluminum,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping 20Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_20tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Heat Shrink (Blower)Battery' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_heat_shrink_blower_battery,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 20Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_20tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Dip Soldering (Battery)' THEN [daily_result] ELSE NULL END), 0), 2) AS dip_soldering_battery,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Ultrasonic Dip SolderingAluminum' THEN [daily_result] ELSE NULL END), 0), 2) AS ultrasonic_dip_soldering_aluminum,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'La molding' THEN [daily_result] ELSE NULL END), 0), 2) AS la_molding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Pressure Welding(Dome Lamp)' THEN [daily_result] ELSE NULL END), 0), 2) AS pressure_welding_dome_lamp,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Ferrule Process' THEN [daily_result] ELSE NULL END), 0), 2) AS ferrule_process,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Gomusen Insertion' THEN [daily_result] ELSE NULL END), 0), 2) AS gomusen_insertion,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Point Marking' THEN [daily_result] ELSE NULL END), 0), 2) AS point_marking,

        ROUND(ISNULL(AVG(CASE 
                WHEN [process] IN (
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
                ) THEN [daily_result] 
                ELSE NULL 
            END), 0), 2) AS Total
    FROM 
        [secondary_dashboard_db].[dbo].[section_page]
    WHERE 
        [details] = 'Actual JPH'
        AND [process] IN (
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
        )
    GROUP BY 
        [section]

    UNION ALL

    SELECT 
        'Overall' AS section,
        'Actual JPH' AS general_process,

ROUND(ISNULL(AVG(CASE WHEN [process] = 'UV-III' THEN [daily_result] ELSE NULL END), 0), 2) AS uv_iii,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Arc Welding' THEN [daily_result] ELSE NULL END), 0), 2) AS arc_welding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Aluminum Coating UV II' THEN [daily_result] ELSE NULL END), 0), 2) AS aluminum_coating_uv_ii,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Servo Crimping' THEN [daily_result] ELSE NULL END), 0), 2) AS servo_crimping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Ultrasonic Welding' THEN [daily_result] ELSE NULL END), 0), 2) AS ultrasonic_welding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Cap Insertion' THEN [daily_result] ELSE NULL END), 0), 2) AS cap_insertion,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Twisting Primary Aluminum' THEN [daily_result] ELSE NULL END), 0), 2) AS twisting_primary_aluminum,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Twisting Secondary Aluminum' THEN [daily_result] ELSE NULL END), 0), 2) AS twisting_secondary_aluminum,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Airbag' THEN [daily_result] ELSE NULL END), 0), 2) AS airbag,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'A/B Sub PC' THEN [daily_result] ELSE NULL END), 0), 2) AS a_b_sub_pc,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Insertion to Connector' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_insertion_to_connector,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'V Type Twisting' THEN [daily_result] ELSE NULL END), 0), 2) AS v_type_twisting,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Twisting Primary' THEN [daily_result] ELSE NULL END), 0), 2) AS twisting_primary,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Twisting Secondary' THEN [daily_result] ELSE NULL END), 0), 2) AS twisting_secondary,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping 2Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_2tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping 4Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_4tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping 5Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_5tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate ripping(UAS)Manual-NF-F' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_ripping_uas_manual_nf_f,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate ripping (UAS)Joint stripping(KB10)' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_ripping_uas_joint,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate stripping(KB10)' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_stripping_kb10,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate stripping(KB10)NSC/Weld' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_stripping_kb10_nsc_weld,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 2Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_2_tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 4Tons(PS-200)' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_4tons_ps_200,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 5Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_5tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Taping (Dispenser)' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_taping_dispenser,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Taping' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_taping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate Welding' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_welding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Intermediate Welding 0.13' THEN [daily_result] ELSE NULL END), 0), 2) AS intermediate_welding_0_13,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Welding at Head' THEN [daily_result] ELSE NULL END), 0), 2) AS welding_at_head,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Welding at Head 0.13' THEN [daily_result] ELSE NULL END), 0), 2) AS welding_at_head_0_13,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Silicon Injection' THEN [daily_result] ELSE NULL END), 0), 2) AS silicon_injection,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Welding Cap Insertion' THEN [daily_result] ELSE NULL END), 0), 2) AS welding_cap_insertion,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Welding Taping(13mm)' THEN [daily_result] ELSE NULL END), 0), 2) AS welding_taping_13mm,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heatshrink' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heat Shrink LA terminal' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink_la_terminal,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heat Shrink (Joint Crimping)' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink_joint_crimping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heat Shrink (Welding)' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink_welding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Casting C385' THEN [daily_result] ELSE NULL END), 0), 2) AS casting_c385,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'STMAC Shieldwire(Nissan)' THEN [daily_result] ELSE NULL END), 0), 2) AS stmac_shieldwire_nissan,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Quick Stripping' THEN [daily_result] ELSE NULL END), 0), 2) AS quick_stripping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Heat Shrink(Blower)Sumitube' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_heat_shrink_blower_sumitube,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Drainwire Tip' THEN [daily_result] ELSE NULL END), 0), 2) AS drainwire_tip,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping Shieldwire' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_shieldwire,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 2TonsSW' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_2_tons_sw,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Blue Taping(Dispenser)SW' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_blue_taping_dispenser_sw,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Shieldwire Taping' THEN [daily_result] ELSE NULL END), 0), 2) AS shieldwire_taping,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'HS Components Insertion SW' THEN [daily_result] ELSE NULL END), 0), 2) AS hs_components_insertion_sw,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Heat Shrink (Joint Crimping)SW' THEN [daily_result] ELSE NULL END), 0), 2) AS heat_shrink_joint_crimping_sw,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Waterproof pad Press' THEN [daily_result] ELSE NULL END), 0), 2) AS waterproof_pad_press,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Low Viscosity' THEN [daily_result] ELSE NULL END), 0), 2) AS low_viscosity,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Air/Water leak test' THEN [daily_result] ELSE NULL END), 0), 2) AS air_water_leak_test,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'HIROSE' THEN [daily_result] ELSE NULL END), 0), 2) AS hirose,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Casting Battery' THEN [daily_result] ELSE NULL END), 0), 2) AS casting_battery,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'STMACAluminum' THEN [daily_result] ELSE NULL END), 0), 2) AS stmac_aluminum,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Crimping 20Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_crimping_20tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Manual Heat Shrink (Blower)Battery' THEN [daily_result] ELSE NULL END), 0), 2) AS manual_heat_shrink_blower_battery,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Joint Crimping 20Tons' THEN [daily_result] ELSE NULL END), 0), 2) AS joint_crimping_20tons,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Dip Soldering (Battery)' THEN [daily_result] ELSE NULL END), 0), 2) AS dip_soldering_battery,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Ultrasonic Dip SolderingAluminum' THEN [daily_result] ELSE NULL END), 0), 2) AS ultrasonic_dip_soldering_aluminum,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'La molding' THEN [daily_result] ELSE NULL END), 0), 2) AS la_molding,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Pressure Welding(Dome Lamp)' THEN [daily_result] ELSE NULL END), 0), 2) AS pressure_welding_dome_lamp,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Ferrule Process' THEN [daily_result] ELSE NULL END), 0), 2) AS ferrule_process,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Gomusen Insertion' THEN [daily_result] ELSE NULL END), 0), 2) AS gomusen_insertion,
ROUND(ISNULL(AVG(CASE WHEN [process] = 'Point Marking' THEN [daily_result] ELSE NULL END), 0), 2) AS point_marking,


        ROUND(ISNULL(AVG(CASE 
                WHEN [process] IN (
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
                ) THEN [daily_result] 
                ELSE NULL 
            END), 0), 2) AS Total
    FROM 
        [secondary_dashboard_db].[dbo].[section_page]
    WHERE 
        [details] = 'Actual JPH'
        AND [process] IN (
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
        )
),

-- =============================================================================== WT ===============================================================================
WT AS (

    SELECT 
        section,
        'Actual WT' AS general_process,
ISNULL([UV-III], 0) AS uv_iii,
ISNULL([Arc Welding], 0) AS arc_welding,
ISNULL([Aluminum Coating UV II], 0) AS aluminum_coating_uv_ii,
ISNULL([Servo Crimping], 0) AS servo_crimping,
ISNULL([Ultrasonic Welding], 0) AS ultrasonic_welding,
ISNULL([Cap Insertion], 0) AS cap_insertion,
ISNULL([Twisting Primary Aluminum], 0) AS twisting_primary_aluminum,
ISNULL([Twisting Secondary Aluminum], 0) AS twisting_secondary_aluminum,
ISNULL([Airbag], 0) AS airbag,
ISNULL([A/B Sub PC], 0) AS a_b_sub_pc,
ISNULL([Manual Insertion to Connector], 0) AS manual_insertion_to_connector,
ISNULL([V Type Twisting], 0) AS v_type_twisting,
ISNULL([Twisting Primary], 0) AS twisting_primary,
ISNULL([Twisting Secondary], 0) AS twisting_secondary,
ISNULL([Manual Crimping 2Tons], 0) AS manual_crimping_2tons,
ISNULL([Manual Crimping 4Tons], 0) AS manual_crimping_4tons,
ISNULL([Manual Crimping 5Tons], 0) AS manual_crimping_5tons,
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) AS intermediate_ripping_uas_manual_nf_f,
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) AS intermediate_ripping_uas_joint,
ISNULL([Intermediate stripping(KB10)], 0) AS intermediate_stripping_kb10,
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) AS intermediate_stripping_kb10_nsc_weld,
ISNULL([Joint Crimping 2Tons], 0) AS joint_crimping_2_tons,
ISNULL([Joint Crimping 4Tons(PS-200)], 0) AS joint_crimping_4tons_ps_200,
ISNULL([Joint Crimping 5Tons], 0) AS joint_crimping_5tons,
ISNULL([Manual Taping (Dispenser)], 0) AS manual_taping_dispenser,
ISNULL([Joint Taping], 0) AS joint_taping,
ISNULL([Intermediate Welding], 0) AS intermediate_welding,
ISNULL([Intermediate Welding 0.13], 0) AS intermediate_welding_0_13,
ISNULL([Welding at Head], 0) AS welding_at_head,
ISNULL([Welding at Head 0.13], 0) AS welding_at_head_0_13,
ISNULL([Silicon Injection], 0) AS silicon_injection,
ISNULL([Welding Cap Insertion], 0) AS welding_cap_insertion,
ISNULL([Welding Taping(13mm)], 0) AS welding_taping_13mm,
ISNULL([Heatshrink], 0) AS heat_shrink,
ISNULL([Heat Shrink LA terminal], 0) AS heat_shrink_la_terminal,
ISNULL([Heat Shrink (Joint Crimping)], 0) AS heat_shrink_joint_crimping,
ISNULL([Heat Shrink (Welding)], 0) AS heat_shrink_welding,
ISNULL([Casting C385], 0) AS casting_c385,
ISNULL([STMAC Shieldwire(Nissan)], 0) AS stmac_shieldwire_nissan,
ISNULL([Quick Stripping], 0) AS quick_stripping,
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) AS manual_heat_shrink_blower_sumitube,
ISNULL([Drainwire Tip], 0) AS drainwire_tip,
ISNULL([Manual Crimping Shieldwire], 0) AS manual_crimping_shieldwire,
ISNULL([Joint Crimping 2TonsSW], 0) AS joint_crimping_2_tons_sw,
ISNULL([Manual Blue Taping(Dispenser)SW], 0) AS manual_blue_taping_dispenser_sw,
ISNULL([Shieldwire Taping], 0) AS shieldwire_taping,
ISNULL([HS Components Insertion SW], 0) AS hs_components_insertion_sw,
ISNULL([Heat Shrink (Joint Crimping)SW], 0) AS heat_shrink_joint_crimping_sw,
ISNULL([Waterproof pad Press], 0) AS waterproof_pad_press,
ISNULL([Low Vicosity], 0) AS low_viscosity,
ISNULL([Air/Water leak test], 0) AS air_water_leak_test,
ISNULL([HIROSE], 0) AS hirose,
ISNULL([Casting Battery], 0) AS casting_battery,
ISNULL([STMACAluminum], 0) AS stmac_aluminum,
ISNULL([Manual Crimping 20Tons], 0) AS manual_crimping_20tons,
ISNULL([Manual Heat Shrink (Blower)Battery], 0) AS manual_heat_shrink_blower_battery,
ISNULL([Joint Crimping 20Tons], 0) AS joint_crimping_20tons,
ISNULL([Dip Soldering (Battery)], 0) AS dip_soldering_battery,
ISNULL([Ultrasonic Dip SolderingAluminum], 0) AS ultrasonic_dip_soldering_aluminum,
ISNULL([La molding], 0) AS la_molding,
ISNULL([Pressure Welding(Dome Lamp)], 0) AS pressure_welding_dome_lamp,
ISNULL([Ferrule Process], 0) AS ferrule_process,
ISNULL([Gomusen Insertion], 0) AS gomusen_insertion,
ISNULL([Point Marking], 0) AS point_marking,







ISNULL([UV-III], 0) +
ISNULL([Arc Welding], 0) +
ISNULL([Aluminum Coating UV II], 0) +
ISNULL([Servo Crimping], 0) +
ISNULL([Ultrasonic Welding], 0) +
ISNULL([Cap Insertion], 0) +
ISNULL([Twisting Primary Aluminum], 0) +
ISNULL([Twisting Secondary Aluminum], 0) +
ISNULL([Airbag], 0) +
ISNULL([A/B Sub PC], 0) +
ISNULL([Manual Insertion to Connector], 0) +
ISNULL([V Type Twisting], 0) +
ISNULL([Twisting Primary], 0) +
ISNULL([Twisting Secondary], 0) +
ISNULL([Manual Crimping 2Tons], 0) +
ISNULL([Manual Crimping 4Tons], 0) +
ISNULL([Manual Crimping 5Tons], 0) +
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) +
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) +
ISNULL([Joint Crimping 2Tons], 0) +
ISNULL([Joint Crimping 4Tons(PS-200)], 0) +
ISNULL([Joint Crimping 5Tons], 0) +
ISNULL([Manual Taping (Dispenser)], 0) +
ISNULL([Joint Taping], 0) +
ISNULL([Intermediate Welding], 0) +
ISNULL([Intermediate Welding 0.13], 0) +
ISNULL([Welding at Head], 0) +
ISNULL([Welding at Head 0.13], 0) +
ISNULL([Silicon Injection], 0) +
ISNULL([Welding Cap Insertion], 0) +
ISNULL([Welding Taping(13mm)], 0) +
ISNULL([Heatshrink], 0) +
ISNULL([Heat Shrink LA terminal], 0) +
ISNULL([Heat Shrink (Joint Crimping)], 0) +
ISNULL([Heat Shrink (Welding)], 0) +
ISNULL([Casting C385], 0) +
ISNULL([STMAC Shieldwire(Nissan)], 0) +
ISNULL([Quick Stripping], 0) +
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) +
ISNULL([Drainwire Tip], 0) +
ISNULL([Manual Crimping Shieldwire], 0) +
ISNULL([Joint Crimping 2TonsSW], 0) +
ISNULL([Manual Blue Taping(Dispenser)SW], 0) +
ISNULL([Shieldwire Taping], 0) +
ISNULL([HS Components Insertion SW], 0) +
ISNULL([Heat Shrink (Joint Crimping)SW], 0) +
ISNULL([Waterproof pad Press], 0) +
ISNULL([Low Vicosity], 0) +
ISNULL([Air/Water leak test], 0) +
ISNULL([HIROSE], 0) +
ISNULL([Casting Battery], 0) +
ISNULL([STMACAluminum], 0) +
ISNULL([Manual Crimping 20Tons], 0) +
ISNULL([Manual Heat Shrink (Blower)Battery], 0) +
ISNULL([Joint Crimping 20Tons], 0) +
ISNULL([Dip Soldering (Battery)], 0) +
ISNULL([Ultrasonic Dip SolderingAluminum], 0) +
ISNULL([La molding], 0) +
ISNULL([Pressure Welding(Dome Lamp)], 0) +
ISNULL([Ferrule Process], 0) +
ISNULL([Gomusen Insertion], 0) +
ISNULL([Point Marking], 0) 



        
        
        AS Total
    FROM (
        SELECT 
            REPLACE(section, 'Section ', '') AS section,
            process,
            wt
        FROM 
            [secondary_dashboard_db].[dbo].[section_page]
        WHERE 
            details = 'Actual JPH'
            AND process IN (
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
'Low Vicosity',
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
            )
    ) AS SourceTable
    PIVOT (
        SUM(wt)
        FOR process IN (
      [UV-III],
[Arc Welding],
[Aluminum Coating UV II],
[Servo Crimping],
[Ultrasonic Welding],
[Cap Insertion],
[Twisting Primary Aluminum],
[Twisting Secondary Aluminum],
[Airbag],
[A/B Sub PC],
[Manual Insertion to Connector],
[V Type Twisting],
[Twisting Primary],
[Twisting Secondary],
[Manual Crimping 2Tons],
[Manual Crimping 4Tons],
[Manual Crimping 5Tons],
[Intermediate ripping(UAS)Manual-NF-F],
[Intermediate ripping (UAS)Joint stripping(KB10)],
[Intermediate stripping(KB10)],
[Intermediate stripping(KB10)NSC/Weld],
[Joint Crimping 2Tons],
[Joint Crimping 4Tons(PS-200)],
[Joint Crimping 5Tons],
[Manual Taping (Dispenser)],
[Joint Taping],
[Intermediate Welding],
[Intermediate Welding 0.13],
[Welding at Head],
[Welding at Head 0.13],
[Silicon Injection],
[Welding Cap Insertion],
[Welding Taping(13mm)],
[Heatshrink],
[Heat Shrink LA terminal],
[Heat Shrink (Joint Crimping)],
[Heat Shrink (Welding)],
[Casting C385],
[STMAC Shieldwire(Nissan)],
[Quick Stripping],
[Manual Heat Shrink(Blower)Sumitube],
[Drainwire Tip],
[Manual Crimping Shieldwire],
[Joint Crimping 2TonsSW],
[Manual Blue Taping(Dispenser)SW],
[Shieldwire Taping],
[HS Components Insertion SW],
[Heat Shrink (Joint Crimping)SW],
[Waterproof pad Press],
[Low Vicosity],
[Air/Water leak test],
[HIROSE],
[Casting Battery],
[STMACAluminum],
[Manual Crimping 20Tons],
[Manual Heat Shrink (Blower)Battery],
[Joint Crimping 20Tons],
[Dip Soldering (Battery)],
[Ultrasonic Dip SolderingAluminum],
[La molding],
[Pressure Welding(Dome Lamp)],
[Ferrule Process],
[Gomusen Insertion],
[Point Marking]

        )
    ) AS PivotTable

    UNION ALL

    SELECT 
        'Overall',
        'Actual WT',
SUM(ISNULL([UV-III], 0)),
SUM(ISNULL([Arc Welding], 0)),
SUM(ISNULL([Aluminum Coating UV II], 0)),
SUM(ISNULL([Servo Crimping], 0)),
SUM(ISNULL([Ultrasonic Welding], 0)),
SUM(ISNULL([Cap Insertion], 0)),
SUM(ISNULL([Twisting Primary Aluminum], 0)),
SUM(ISNULL([Twisting Secondary Aluminum], 0)),
SUM(ISNULL([Airbag], 0)),
SUM(ISNULL([A/B Sub PC], 0)),
SUM(ISNULL([Manual Insertion to Connector], 0)),
SUM(ISNULL([V Type Twisting], 0)),
SUM(ISNULL([Twisting Primary], 0)),
SUM(ISNULL([Twisting Secondary], 0)),
SUM(ISNULL([Manual Crimping 2Tons], 0)),
SUM(ISNULL([Manual Crimping 4Tons], 0)),
SUM(ISNULL([Manual Crimping 5Tons], 0)),
SUM(ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0)),
SUM(ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0)),
SUM(ISNULL([Intermediate stripping(KB10)], 0)),
SUM(ISNULL([Intermediate stripping(KB10)NSC/Weld], 0)),
SUM(ISNULL([Joint Crimping 2Tons], 0)),
SUM(ISNULL([Joint Crimping 4Tons(PS-200)], 0)),
SUM(ISNULL([Joint Crimping 5Tons], 0)),
SUM(ISNULL([Manual Taping (Dispenser)], 0)),
SUM(ISNULL([Joint Taping], 0)),
SUM(ISNULL([Intermediate Welding], 0)),
SUM(ISNULL([Intermediate Welding 0.13], 0)),
SUM(ISNULL([Welding at Head], 0)),
SUM(ISNULL([Welding at Head 0.13], 0)),
SUM(ISNULL([Silicon Injection], 0)),
SUM(ISNULL([Welding Cap Insertion], 0)),
SUM(ISNULL([Welding Taping(13mm)], 0)),
SUM(ISNULL([Heatshrink], 0)),
SUM(ISNULL([Heat Shrink LA terminal], 0)),
SUM(ISNULL([Heat Shrink (Joint Crimping)], 0)),
SUM(ISNULL([Heat Shrink (Welding)], 0)),
SUM(ISNULL([Casting C385], 0)),
SUM(ISNULL([STMAC Shieldwire(Nissan)], 0)),
SUM(ISNULL([Quick Stripping], 0)),
SUM(ISNULL([Manual Heat Shrink(Blower)Sumitube], 0)),
SUM(ISNULL([Drainwire Tip], 0)),
SUM(ISNULL([Manual Crimping Shieldwire], 0)),
SUM(ISNULL([Joint Crimping 2TonsSW], 0)),
SUM(ISNULL([Manual Blue Taping(Dispenser)SW], 0)),
SUM(ISNULL([Shieldwire Taping], 0)),
SUM(ISNULL([HS Components Insertion SW], 0)),
SUM(ISNULL([Heat Shrink (Joint Crimping)SW], 0)),
SUM(ISNULL([Waterproof pad Press], 0)),
SUM(ISNULL([Low Vicosity], 0)),
SUM(ISNULL([Air/Water leak test], 0)),
SUM(ISNULL([HIROSE], 0)),
SUM(ISNULL([Casting Battery], 0)),
SUM(ISNULL([STMACAluminum], 0)),
SUM(ISNULL([Manual Crimping 20Tons], 0)),
SUM(ISNULL([Manual Heat Shrink (Blower)Battery], 0)),
SUM(ISNULL([Joint Crimping 20Tons], 0)),
SUM(ISNULL([Dip Soldering (Battery)], 0)),
SUM(ISNULL([Ultrasonic Dip SolderingAluminum], 0)),
SUM(ISNULL([La molding], 0)),
SUM(ISNULL([Pressure Welding(Dome Lamp)], 0)),
SUM(ISNULL([Ferrule Process], 0)),
SUM(ISNULL([Gomusen Insertion], 0)),
SUM(ISNULL([Point Marking], 0)),




        SUM(
ISNULL([UV-III], 0) +
ISNULL([Arc Welding], 0) +
ISNULL([Aluminum Coating UV II], 0) +
ISNULL([Servo Crimping], 0) +
ISNULL([Ultrasonic Welding], 0) +
ISNULL([Cap Insertion], 0) +
ISNULL([Twisting Primary Aluminum], 0) +
ISNULL([Twisting Secondary Aluminum], 0) +
ISNULL([Airbag], 0) +
ISNULL([A/B Sub PC], 0) +
ISNULL([Manual Insertion to Connector], 0) +
ISNULL([V Type Twisting], 0) +
ISNULL([Twisting Primary], 0) +
ISNULL([Twisting Secondary], 0) +
ISNULL([Manual Crimping 2Tons], 0) +
ISNULL([Manual Crimping 4Tons], 0) +
ISNULL([Manual Crimping 5Tons], 0) +
ISNULL([Intermediate ripping(UAS)Manual-NF-F], 0) +
ISNULL([Intermediate ripping (UAS)Joint stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)], 0) +
ISNULL([Intermediate stripping(KB10)NSC/Weld], 0) +
ISNULL([Joint Crimping 2Tons], 0) +
ISNULL([Joint Crimping 4Tons(PS-200)], 0) +
ISNULL([Joint Crimping 5Tons], 0) +
ISNULL([Manual Taping (Dispenser)], 0) +
ISNULL([Joint Taping], 0) +
ISNULL([Intermediate Welding], 0) +
ISNULL([Intermediate Welding 0.13], 0) +
ISNULL([Welding at Head], 0) +
ISNULL([Welding at Head 0.13], 0) +
ISNULL([Silicon Injection], 0) +
ISNULL([Welding Cap Insertion], 0) +
ISNULL([Welding Taping(13mm)], 0) +
ISNULL([Heatshrink], 0) +
ISNULL([Heat Shrink LA terminal], 0) +
ISNULL([Heat Shrink (Joint Crimping)], 0) +
ISNULL([Heat Shrink (Welding)], 0) +
ISNULL([Casting C385], 0) +
ISNULL([STMAC Shieldwire(Nissan)], 0) +
ISNULL([Quick Stripping], 0) +
ISNULL([Manual Heat Shrink(Blower)Sumitube], 0) +
ISNULL([Drainwire Tip], 0) +
ISNULL([Manual Crimping Shieldwire], 0) +
ISNULL([Joint Crimping 2TonsSW], 0) +
ISNULL([Manual Blue Taping(Dispenser)SW], 0) +
ISNULL([Shieldwire Taping], 0) +
ISNULL([HS Components Insertion SW], 0) +
ISNULL([Heat Shrink (Joint Crimping)SW], 0) +
ISNULL([Waterproof pad Press], 0) +
ISNULL([Low Vicosity], 0) +
ISNULL([Air/Water leak test], 0) +
ISNULL([HIROSE], 0) +
ISNULL([Casting Battery], 0) +
ISNULL([STMACAluminum], 0) +
ISNULL([Manual Crimping 20Tons], 0) +
ISNULL([Manual Heat Shrink (Blower)Battery], 0) +
ISNULL([Joint Crimping 20Tons], 0) +
ISNULL([Dip Soldering (Battery)], 0) +
ISNULL([Ultrasonic Dip SolderingAluminum], 0) +
ISNULL([La molding], 0) +
ISNULL([Pressure Welding(Dome Lamp)], 0) +
ISNULL([Ferrule Process], 0) +
ISNULL([Gomusen Insertion], 0) +
ISNULL([Point Marking], 0) 
        )
    FROM (
        SELECT 
            section,
            process,
            wt
        FROM 
            [secondary_dashboard_db].[dbo].[section_page]
        WHERE 
            details = 'Actual JPH'
            AND process IN (
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
'Low Vicosity',
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


            )
    ) AS SourceTable
    PIVOT (
        SUM(wt)
        FOR process IN (
[UV-III],
[Arc Welding],
[Aluminum Coating UV II],
[Servo Crimping],
[Ultrasonic Welding],
[Cap Insertion],
[Twisting Primary Aluminum],
[Twisting Secondary Aluminum],
[Airbag],
[A/B Sub PC],
[Manual Insertion to Connector],
[V Type Twisting],
[Twisting Primary],
[Twisting Secondary],
[Manual Crimping 2Tons],
[Manual Crimping 4Tons],
[Manual Crimping 5Tons],
[Intermediate ripping(UAS)Manual-NF-F],
[Intermediate ripping (UAS)Joint stripping(KB10)],
[Intermediate stripping(KB10)],
[Intermediate stripping(KB10)NSC/Weld],
[Joint Crimping 2Tons],
[Joint Crimping 4Tons(PS-200)],
[Joint Crimping 5Tons],
[Manual Taping (Dispenser)],
[Joint Taping],
[Intermediate Welding],
[Intermediate Welding 0.13],
[Welding at Head],
[Welding at Head 0.13],
[Silicon Injection],
[Welding Cap Insertion],
[Welding Taping(13mm)],
[Heatshrink],
[Heat Shrink LA terminal],
[Heat Shrink (Joint Crimping)],
[Heat Shrink (Welding)],
[Casting C385],
[STMAC Shieldwire(Nissan)],
[Quick Stripping],
[Manual Heat Shrink(Blower)Sumitube],
[Drainwire Tip],
[Manual Crimping Shieldwire],
[Joint Crimping 2TonsSW],
[Manual Blue Taping(Dispenser)SW],
[Shieldwire Taping],
[HS Components Insertion SW],
[Heat Shrink (Joint Crimping)SW],
[Waterproof pad Press],
[Low Vicosity],
[Air/Water leak test],
[HIROSE],
[Casting Battery],
[STMACAluminum],
[Manual Crimping 20Tons],
[Manual Heat Shrink (Blower)Battery],
[Joint Crimping 20Tons],
[Dip Soldering (Battery)],
[Ultrasonic Dip SolderingAluminum],
[La molding],
[Pressure Welding(Dome Lamp)],
[Ferrule Process],
[Gomusen Insertion],
[Point Marking]
        )
    ) AS PivotTable
),

Combined AS (
      SELECT * FROM PlanOutput
   UNION ALL
   SELECT * FROM TargetJPH
   UNION ALL
   SELECT * FROM WIPPD
   UNION ALL
   SELECT * FROM ActualJPH
   UNION ALL
   SELECT * FROM TargetOutputWIP
   UNION ALL
   SELECT * FROM ActualOutput
   UNION ALL
   SELECT * FROM MachineCount
   UNION ALL
   SELECT * FROM WT
   UNION ALL
   SELECT * FROM WIP
   UNION ALL
   SELECT * FROM PlanPerMachine
)
Select*
FROM Combined
ORDER BY 
    CASE section
        WHEN 'Overall' THEN 0
        WHEN '1' THEN 1
        WHEN '2' THEN 2
        WHEN '3' THEN 3
        WHEN '3.1' THEN 3.1
        WHEN '4' THEN 4
        WHEN '5' THEN 5
        WHEN '6' THEN 6
        WHEN '7' THEN 7
        WHEN '8' THEN 8
        WHEN '9' THEN 9
        ELSE 10
    END,
    CASE general_process
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
        ELSE 11
    END,
    general_process DESC;


";

$selectStmt = sqlsrv_query($conn, $sql);

if ($selectStmt === false) {
    echo "<tr><td colspan='70'>Error fetching updated data</td></tr>";
    if (($errors = sqlsrv_errors()) != null) {
        foreach ($errors as $error) {
            echo "<tr><td colspan='70'>";
            echo "SQLSTATE: " . htmlspecialchars($error['SQLSTATE']) . "<br>";
            echo "Code: " . htmlspecialchars($error['code']) . "<br>";
            echo "Message: " . htmlspecialchars($error['message']);
            echo "</td></tr>";
        }
    }
} else {
    $overallData = [];
    $sectionsData = [];

    while ($row = sqlsrv_fetch_array($selectStmt, SQLSRV_FETCH_ASSOC)) {
        if ($row['section'] === 'Overall') {
            $overallData[$row['general_process']] = $row;
        } else {
            $sectionsData[] = $row;
        }
    }

    if (!empty($overallData)) {
        echo "<tr style='background-color: #727370 !important;'><td colspan='70'><strong style='color: #727370;'>Overall</strong></td></tr>";
        
        foreach (['Plan Output per day', 'Target Output (WIP+Plan)', 'Machine Count', 'Target JPH', 'Actual Output', 'Actual JPH', 'WIP'] as $process) {
            if (isset($overallData[$process])) {
                echo "<tr>";
                echo "<td>Overall</td>";
                echo "<td>" . $process . "</td>";
                foreach (['Total','uv_iii',
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
'gomusen_insertion',
'point_marking'] as $col) {
                    echo "<td>" . htmlspecialchars($overallData[$process][$col] ?? 'N/A') . "</td>";
                }
                echo "</tr>";
            }
        }
    }

    $currentSection = null;
    foreach ($sectionsData as $row) {
        if ($row['section'] !== 'Overall') {
            if ($currentSection !== $row['section']) {
                $currentSection = $row['section'];
                echo "<tr style='background-color: #727370;'><td colspan='70'><strong style='color:  #727370;'>" . htmlspecialchars($currentSection) . "</strong></td></tr>";
            }
            echo "<tr>";
            foreach (['section', 'general_process', 'Total', 'uv_iii',
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
'gomusen_insertion',
'point_marking'] as $col) {
                echo "<td>" . htmlspecialchars($row[$col] ?? 'N/A') . "</td>";
            }
            echo "</tr>";
        }
    }
}

sqlsrv_close($conn);

?>

