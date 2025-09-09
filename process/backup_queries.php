<?php
// Include database connection
include 'conn.php';

// SQL for both merge operations
$sql = "
;WITH RankedSource AS (
    SELECT *,
           ROW_NUMBER() OVER (
               PARTITION BY [section], [general_process], CAST(GETDATE() AS DATE)
               ORDER BY [section]
           ) AS rn
    FROM (
        SELECT
            [section],
            [general_process],
            [total],
[uv_iii],
[arc_welding],
[aluminum_coating_uv_ii],
[servo_crimping],
[ultrasonic_welding],
[cap_insertion],
[twisting_primary_aluminum],
[twisting_secondary_aluminum],
[airbag],
[a_b_sub_pc],
[manual_insertion_to_connector],
[v_type_twisting],
[twisting_primary],
[twisting_secondary],
[manual_crimping_2tons],
[manual_crimping_4tons],
[manual_crimping_5tons],
[intermediate_ripping_uas_manual_nf_f],
[intermediate_ripping_uas_joint],
[intermediate_stripping_kb10],
[intermediate_stripping_kb10_nsc_weld],
[joint_crimping_2_tons],
[joint_crimping_4tons_ps_200],
[joint_crimping_5tons],
[manual_taping_dispenser],
[joint_taping],
[intermediate_welding],
[intermediate_welding_0_13],
[welding_at_head],
[welding_at_head_0_13],
[silicon_injection],
[welding_cap_insertion],
[welding_taping_13mm],
[heat_shrink],
[heat_shrink_la_terminal],
[heat_shrink_joint_crimping],
[heat_shrink_welding],
[casting_c385],
[stmac_shieldwire_nissan],
[quick_stripping],
[manual_heat_shrink_blower_sumitube],
[drainwire_tip],
[manual_crimping_shieldwire],
[joint_crimping_2_tons_sw],
[manual_blue_taping_dispenser_sw],
[shieldwire_taping],
[hs_components_insertion_sw],
[heat_shrink_joint_crimping_sw],
[waterproof_pad_press],
[low_viscosity],
[air_water_leak_test],
[hirose],
[casting_battery],
[stmac_aluminum],
[manual_crimping_20tons],
[manual_heat_shrink_blower_battery],
[joint_crimping_20tons],
[dip_soldering_battery],
[ultrasonic_dip_soldering_aluminum],
[la_molding],
[pressure_welding_dome_lamp],
[ferrule_process],
[gomusen_insertion],
[point_marking],

            CAST(GETDATE() AS DATE) AS [date]
        FROM [secondary_dashboard_db].[dbo].[summary]
    ) AS sub
)
MERGE [secondary_dashboard_db].[dbo].[summary_backup] AS target
USING (
    SELECT * FROM RankedSource WHERE rn = 1
) AS source
ON target.[section] = source.[section]
   AND target.[general_process] = source.[general_process]
   AND target.[date] = source.[date]
WHEN MATCHED THEN
    UPDATE SET
        target.[total] = source.[total],
target.[uv_iii] = source.[uv_iii],
target.[arc_welding] = source.[arc_welding],
target.[aluminum_coating_uv_ii] = source.[aluminum_coating_uv_ii],
target.[servo_crimping] = source.[servo_crimping],
target.[ultrasonic_welding] = source.[ultrasonic_welding],
target.[cap_insertion] = source.[cap_insertion],
target.[twisting_primary_aluminum] = source.[twisting_primary_aluminum],
target.[twisting_secondary_aluminum] = source.[twisting_secondary_aluminum],
target.[airbag] = source.[airbag],
target.[a_b_sub_pc] = source.[a_b_sub_pc],
target.[manual_insertion_to_connector] = source.[manual_insertion_to_connector],
target.[v_type_twisting] = source.[v_type_twisting],
target.[twisting_primary] = source.[twisting_primary],
target.[twisting_secondary] = source.[twisting_secondary],
target.[manual_crimping_2tons] = source.[manual_crimping_2tons],
target.[manual_crimping_4tons] = source.[manual_crimping_4tons],
target.[manual_crimping_5tons] = source.[manual_crimping_5tons],
target.[intermediate_ripping_uas_manual_nf_f] = source.[intermediate_ripping_uas_manual_nf_f],
target.[intermediate_ripping_uas_joint] = source.[intermediate_ripping_uas_joint],
target.[intermediate_stripping_kb10] = source.[intermediate_stripping_kb10],
target.[intermediate_stripping_kb10_nsc_weld] = source.[intermediate_stripping_kb10_nsc_weld],
target.[joint_crimping_2_tons] = source.[joint_crimping_2_tons],
target.[joint_crimping_4tons_ps_200] = source.[joint_crimping_4tons_ps_200],
target.[joint_crimping_5tons] = source.[joint_crimping_5tons],
target.[manual_taping_dispenser] = source.[manual_taping_dispenser],
target.[joint_taping] = source.[joint_taping],
target.[intermediate_welding] = source.[intermediate_welding],
target.[intermediate_welding_0_13] = source.[intermediate_welding_0_13],
target.[welding_at_head] = source.[welding_at_head],
target.[welding_at_head_0_13] = source.[welding_at_head_0_13],
target.[silicon_injection] = source.[silicon_injection],
target.[welding_cap_insertion] = source.[welding_cap_insertion],
target.[welding_taping_13mm] = source.[welding_taping_13mm],
target.[heat_shrink] = source.[heat_shrink],
target.[heat_shrink_la_terminal] = source.[heat_shrink_la_terminal],
target.[heat_shrink_joint_crimping] = source.[heat_shrink_joint_crimping],
target.[heat_shrink_welding] = source.[heat_shrink_welding],
target.[casting_c385] = source.[casting_c385],
target.[stmac_shieldwire_nissan] = source.[stmac_shieldwire_nissan],
target.[quick_stripping] = source.[quick_stripping],
target.[manual_heat_shrink_blower_sumitube] = source.[manual_heat_shrink_blower_sumitube],
target.[drainwire_tip] = source.[drainwire_tip],
target.[manual_crimping_shieldwire] = source.[manual_crimping_shieldwire],
target.[joint_crimping_2_tons_sw] = source.[joint_crimping_2_tons_sw],
target.[manual_blue_taping_dispenser_sw] = source.[manual_blue_taping_dispenser_sw],
target.[shieldwire_taping] = source.[shieldwire_taping],
target.[hs_components_insertion_sw] = source.[hs_components_insertion_sw],
target.[heat_shrink_joint_crimping_sw] = source.[heat_shrink_joint_crimping_sw],
target.[waterproof_pad_press] = source.[waterproof_pad_press],
target.[low_viscosity] = source.[low_viscosity],
target.[air_water_leak_test] = source.[air_water_leak_test],
target.[hirose] = source.[hirose],
target.[casting_battery] = source.[casting_battery],
target.[stmac_aluminum] = source.[stmac_aluminum],
target.[manual_crimping_20tons] = source.[manual_crimping_20tons],
target.[manual_heat_shrink_blower_battery] = source.[manual_heat_shrink_blower_battery],
target.[joint_crimping_20tons] = source.[joint_crimping_20tons],
target.[dip_soldering_battery] = source.[dip_soldering_battery],
target.[ultrasonic_dip_soldering_aluminum] = source.[ultrasonic_dip_soldering_aluminum],
target.[la_molding] = source.[la_molding],
target.[pressure_welding_dome_lamp] = source.[pressure_welding_dome_lamp],
target.[ferrule_process] = source.[ferrule_process],
target.[gomusen_insertion] = source.[gomusen_insertion],
target.[point_marking] = source.[point_marking]
WHEN NOT MATCHED THEN
    INSERT ([section], [general_process], [total], [uv_iii],
[arc_welding],
[aluminum_coating_uv_ii],
[servo_crimping],
[ultrasonic_welding],
[cap_insertion],
[twisting_primary_aluminum],
[twisting_secondary_aluminum],
[airbag],
[a_b_sub_pc],
[manual_insertion_to_connector],
[v_type_twisting],
[twisting_primary],
[twisting_secondary],
[manual_crimping_2tons],
[manual_crimping_4tons],
[manual_crimping_5tons],
[intermediate_ripping_uas_manual_nf_f],
[intermediate_ripping_uas_joint],
[intermediate_stripping_kb10],
[intermediate_stripping_kb10_nsc_weld],
[joint_crimping_2_tons],
[joint_crimping_4tons_ps_200],
[joint_crimping_5tons],
[manual_taping_dispenser],
[joint_taping],
[intermediate_welding],
[intermediate_welding_0_13],
[welding_at_head],
[welding_at_head_0_13],
[silicon_injection],
[welding_cap_insertion],
[welding_taping_13mm],
[heat_shrink],
[heat_shrink_la_terminal],
[heat_shrink_joint_crimping],
[heat_shrink_welding],
[casting_c385],
[stmac_shieldwire_nissan],
[quick_stripping],
[manual_heat_shrink_blower_sumitube],
[drainwire_tip],
[manual_crimping_shieldwire],
[joint_crimping_2_tons_sw],
[manual_blue_taping_dispenser_sw],
[shieldwire_taping],
[hs_components_insertion_sw],
[heat_shrink_joint_crimping_sw],
[waterproof_pad_press],
[low_viscosity],
[air_water_leak_test],
[hirose],
[casting_battery],
[stmac_aluminum],
[manual_crimping_20tons],
[manual_heat_shrink_blower_battery],
[joint_crimping_20tons],
[dip_soldering_battery],
[ultrasonic_dip_soldering_aluminum],
[la_molding],
[pressure_welding_dome_lamp],
[ferrule_process],
[gomusen_insertion],
[point_marking],

[date])
    VALUES (source.[section], source.[general_process], source.[total], source.[uv_iii],
source.[arc_welding],
source.[aluminum_coating_uv_ii],
source.[servo_crimping],
source.[ultrasonic_welding],
source.[cap_insertion],
source.[twisting_primary_aluminum],
source.[twisting_secondary_aluminum],
source.[airbag],
source.[a_b_sub_pc],
source.[manual_insertion_to_connector],
source.[v_type_twisting],
source.[twisting_primary],
source.[twisting_secondary],
source.[manual_crimping_2tons],
source.[manual_crimping_4tons],
source.[manual_crimping_5tons],
source.[intermediate_ripping_uas_manual_nf_f],
source.[intermediate_ripping_uas_joint],
source.[intermediate_stripping_kb10],
source.[intermediate_stripping_kb10_nsc_weld],
source.[joint_crimping_2_tons],
source.[joint_crimping_4tons_ps_200],
source.[joint_crimping_5tons],
source.[manual_taping_dispenser],
source.[joint_taping],
source.[intermediate_welding],
source.[intermediate_welding_0_13],
source.[welding_at_head],
source.[welding_at_head_0_13],
source.[silicon_injection],
source.[welding_cap_insertion],
source.[welding_taping_13mm],
source.[heat_shrink],
source.[heat_shrink_la_terminal],
source.[heat_shrink_joint_crimping],
source.[heat_shrink_welding],
source.[casting_c385],
source.[stmac_shieldwire_nissan],
source.[quick_stripping],
source.[manual_heat_shrink_blower_sumitube],
source.[drainwire_tip],
source.[manual_crimping_shieldwire],
source.[joint_crimping_2_tons_sw],
source.[manual_blue_taping_dispenser_sw],
source.[shieldwire_taping],
source.[hs_components_insertion_sw],
source.[heat_shrink_joint_crimping_sw],
source.[waterproof_pad_press],
source.[low_viscosity],
source.[air_water_leak_test],
source.[hirose],
source.[casting_battery],
source.[stmac_aluminum],
source.[manual_crimping_20tons],
source.[manual_heat_shrink_blower_battery],
source.[joint_crimping_20tons],
source.[dip_soldering_battery],
source.[ultrasonic_dip_soldering_aluminum],
source.[la_molding],
source.[pressure_welding_dome_lamp],
source.[ferrule_process],
source.[gomusen_insertion],
source.[point_marking],

source.[date]);
 



    
;WITH RankedSection AS (
    SELECT *,
           ROW_NUMBER() OVER (
               PARTITION BY [section], [process], [machine_no], [manpower], CAST([date] AS DATE), [nsds]
               ORDER BY [section]
           ) AS rn
    FROM (
        SELECT
            [section],
            [process],
            [machine_no],
            [manpower],
            [wip],
            [wt],
            [target_jph],
            [target_output],
            [details],
            [daily_result],
            CAST([date] AS DATE) AS [date],
            [nsds],
            [date_start]  -- Added here
        FROM [secondary_dashboard_db].[dbo].[section_page]
    ) AS sub
)
MERGE [secondary_dashboard_db].[dbo].[section_backup] AS target
USING (
    SELECT
        [section],
        [process],
        [machine_no],
        [manpower],
        [wip],
        [wt],
        [target_jph],
        [target_output],
        [details],
        [daily_result],
        CAST([date] AS DATE) AS [date],
        [nsds],
        [date_start]
    FROM [secondary_dashboard_db].[dbo].[section_page]
) AS source
ON target.[section] = source.[section]
   AND target.[process] = source.[process]
   AND target.[machine_no] = source.[machine_no]
   AND target.[manpower] = source.[manpower]
   AND target.[date] = source.[date]
   AND target.[nsds] = source.[nsds]
   AND target.[details] = source.[details]  -- Include this to differentiate rows
WHEN MATCHED THEN
    UPDATE SET
        target.[wip] = source.[wip],
        target.[wt] = source.[wt],
        target.[target_jph] = source.[target_jph],
        target.[target_output] = source.[target_output],
        target.[daily_result] = source.[daily_result],
        target.[date_start] = source.[date_start],
        target.[details] = source.[details]
WHEN NOT MATCHED THEN
    INSERT (
        [section], [process], [machine_no], [manpower], [wip], [wt],
        [target_jph], [target_output], [details], [daily_result],
        [date], [nsds], [date_start]
    )
    VALUES (
        source.[section], source.[process], source.[machine_no], source.[manpower], source.[wip], source.[wt],
        source.[target_jph], source.[target_output], source.[details], source.[daily_result],
        source.[date], source.[nsds], source.[date_start]
    );
 

";

// Execute the SQL query
$stmt = sqlsrv_query($conn, $sql);

header("Content-Type: text/plain"); // For better browser output
if ($stmt === false) {
    echo "❌ Error running the MERGE queries:\n";
    print_r(sqlsrv_errors(), true);
} else {
    echo "✅ MERGE operations completed successfully.";
}

// Free resources
if ($stmt !== false) {
    sqlsrv_free_stmt($stmt);
}
sqlsrv_close($conn);
?>
