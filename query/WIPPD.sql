

WITH WIPPD AS (

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
ISNULL([Low Viscosity], 0) AS  low_viscosity,
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
ISNULL([Low Viscosity], 0) +
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
            wip
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
[Low Viscosity],
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
SUM(ISNULL([Low Viscosity], 0)),
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
ISNULL([Low Viscosity], 0) +
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
[Low Viscosity],
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
   SELECT * FROM WIPPD

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
