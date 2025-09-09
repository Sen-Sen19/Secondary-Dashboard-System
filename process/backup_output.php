<?php
// Include database connection
include 'conn.php';

// SQL for both merge operations
$sql = "

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
MERGE [secondary_dashboard_db].[dbo].[section_output] AS target
USING (
    SELECT * FROM RankedSection WHERE rn = 3
) AS source
ON target.[section] = source.[section]
   AND target.[process] = source.[process]
   AND target.[machine_no] = source.[machine_no]
   AND target.[manpower] = source.[manpower]
   AND target.[date] = source.[date]
   AND target.[nsds] = source.[nsds]
WHEN MATCHED THEN
    UPDATE SET
        target.[wip] = source.[wip],
         target.[wt] = source.[wt],
        target.[target_jph] = source.[target_jph],
        target.[target_output] = source.[target_output],
        target.[details] = source.[details],
        target.[daily_result] = source.[daily_result],
        target.[date_start] = source.[date_start]  -- Added here
WHEN NOT MATCHED THEN
    INSERT (
        [section], [process], [machine_no], [manpower], [wip], [wt],
        [target_jph], [target_output], [details], [daily_result], [date], [nsds], [date_start]  -- Added here
    )
    VALUES (
 source.[section], source.[process], source.[machine_no], source.[manpower], source.[wip], source.[wt],

        source.[target_jph], source.[target_output], source.[details], source.[daily_result], source.[date], source.[nsds], source.[date_start]  -- Added here
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
