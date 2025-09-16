With ActualJPH AS (

    SELECT 
        REPLACE([section], 'Section ', '') AS section,
        'Actual JPH' AS general_process,
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
'Twisting Secondary'


            ) THEN [daily_result] 
            ELSE 0 
        END) AS Total
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
'Twisting Secondary'

        )
    GROUP BY 
        [section]

    UNION ALL

    SELECT 
        'Overall' AS section,
        'Actual JPH' AS general_process,
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
'Twisting Secondary'

                ) THEN [daily_result] 
                ELSE 0 
            END
        ) AS Total
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
'Twisting Secondary'

           )
  
),
Combined AS (
   SELECT * FROM ActualJPH

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

