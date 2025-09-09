WITH PlanOutput AS (
    SELECT
        [section] AS section,
        'Plan Output per day' AS general_process,
        SUM([uv_iii_1] + [uv_iii_2] + [uv_iii_4] + [uv_iii_5] + [uv_iii_7] + [uv_iii_8]) AS uv_iii,
        SUM(arc_welding) AS arc_welding,
        SUM(ultrasonic_welding) AS ultrasonic_welding,
        SUM([aluminum_coating_uv_ii]) AS aluminum_coating_uv_ii,
        SUM([servo_crimping]) AS servo_crimping,
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
        SUM([manual_heat_shrink_blower_sumitube]) AS manual_heat_shrink_blower_sumitube,
        SUM([drainwire_tip]) AS drainwire_tip,
        SUM([manual_crimping_shieldwire_2t] + [manual_crimping_shieldwire_4t]) AS manual_crimping_shieldwire,
        SUM([joint_crimping_2tons_ps_800_s_2_sw] + [joint_crimping_2tons_ps_017_ss_2_sw]) AS joint_crimping_2_tons_sw,
        SUM([manual_blue_taping_dispenser_sw]) AS manual_blue_taping_dispenser_sw,
        SUM([shieldwire_taping]) AS shieldwire_taping,
        SUM([hs_components_insertion_sw]) AS hs_components_insertion_sw,
        SUM([heat_shrink_joint_crimping_sw]) AS heat_shrink_joint_crimping_sw,
        SUM([low_viscosity]) AS low_viscosity,
        SUM([waterproof_pad_press_joint] + [waterproof_pad_press_weld]) AS waterproof_pad_press,
        SUM([air_water_leak_test]) AS air_water_leak_test,
        SUM([hirose_sheath_stripping_927r] + [hirose_unistrip] + [hirose_acetate_taping] + [hirose_manual_crimping_2_tons] + [hirose_copper_taping] + [hirose_hgt17ap_crimping]) AS hirose,
        SUM([casting_c373] + [casting_c377] + [casting_c371]) AS casting_battery,
        SUM([stmac_aluminum]) AS stmac_aluminum,
        SUM([quick_stripping_927_auto] + [quick_stripping_311_manual]) AS quick_stripping,
        SUM([manual_crimping_20tons]) AS manual_crimping_20tons,
        SUM([manual_heat_shrink_blower_battery]) AS manual_heat_shrink_blower_battery,
        SUM([joint_crimping_20tons]) AS joint_crimping_20tons,
        SUM([dip_soldering_battery]) AS dip_soldering_battery,
        SUM([ultrasonic_dip_soldering_aluminum]) AS ultrasonic_dip_soldering_aluminum,
        SUM([la_molding] + [air_water_leak_test_2]) AS la_molding,
        SUM([pressure_welding_dome_lamp]) AS pressure_welding_dome_lamp,
        SUM([ferrule_casting_c373] + [ferrule_parts_insertion] + [ferrule_braided_wire_folding] ) AS ferrule_process,
        SUM([gomusen_insertion]) AS gomusen_insertion,
        SUM([point_marking]) AS point_marking,

        -- Simplified total sum calculation
             SUM(
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
        SUM(ultrasonic_welding),
        SUM([aluminum_coating_uv_ii]),
        SUM([servo_crimping]),
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
        SUM([manual_heat_shrink_blower_sumitube]),
        SUM([drainwire_tip]),
        SUM([manual_crimping_shieldwire_2t] + [manual_crimping_shieldwire_4t]),
        SUM([joint_crimping_2tons_ps_800_s_2_sw] + [joint_crimping_2tons_ps_017_ss_2_sw])w,
        SUM([manual_blue_taping_dispenser_sw]),
        SUM([shieldwire_taping]),
        SUM([hs_components_insertion_sw]),
        SUM([heat_shrink_joint_crimping_sw]),
        SUM([low_viscosity]),
        SUM([waterproof_pad_press_joint] + [waterproof_pad_press_weld]),
        SUM([air_water_leak_test]),
        SUM([hirose_sheath_stripping_927r] + [hirose_unistrip] + [hirose_acetate_taping] + [hirose_manual_crimping_2_tons] + [hirose_copper_taping] + [hirose_hgt17ap_crimping]),
        SUM([casting_c373] + [casting_c377] + [casting_c371]) ,
        SUM([stmac_aluminum]),
        SUM([quick_stripping_927_auto] + [quick_stripping_311_manual]),
        SUM([manual_crimping_20tons]),
        SUM([manual_heat_shrink_blower_battery]),
        SUM([joint_crimping_20tons]),
        SUM([dip_soldering_battery]),
        SUM([ultrasonic_dip_soldering_aluminum]),
        SUM([la_molding] + [air_water_leak_test_2]),
        SUM([pressure_welding_dome_lamp]) ,
        SUM([ferrule_casting_c373] + [ferrule_parts_insertion] + [ferrule_braided_wire_folding] ) ,
        SUM([gomusen_insertion]) AS gomusen_insertion,
        SUM([point_marking]) ,


      SUM(
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

Combined AS (
   SELECT * FROM PlanOutput

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
   
    general_process DESC;
