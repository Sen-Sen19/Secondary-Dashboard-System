<?php
$serverName = "172.25.115.167\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "secondary_dashboard_db",
    "Uid" => "sa",
    "PWD" => '#Sy$temGr0^p|115167'
);

// Establish the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Check if a file was uploaded
if ($_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
    $file = fopen($_FILES['csv_file']['tmp_name'], 'r');
    
    // Start transaction to ensure atomicity
    sqlsrv_begin_transaction($conn);

    try {
        // Delete existing data in the table before inserting new data
        $deleteQuery = "DELETE FROM [secondary_dashboard_db].[dbo].[sp_shot_count]";
        $deleteStmt = sqlsrv_query($conn, $deleteQuery);

        // Check if deletion was successful
        if ($deleteStmt === false) {
            throw new Exception("Error deleting existing data: " . print_r(sqlsrv_errors(), true));
        }

        // Skip the header row
        fgetcsv($file);

        // 🔐 Indices of string columns: section, car_model, base_product, block, block_2, product, line_no
        $stringColumns = [0, 1, 2, 3, 4, 5, 6];

        // Define the sanitizer that checks column index
        function sanitizeValueByIndex($value, $index, $stringColumns) {
            $trimmed = trim($value);
            if (in_array($index, $stringColumns)) {
                return $trimmed; // Preserve strings
            }
            return $trimmed === '' ? 0 : (is_numeric($trimmed) ? $trimmed : 0); // Clean numeric fields
        }

        while (($row = fgetcsv($file)) !== false) {
            // Sanitize using index-aware function
            $row = array_map(function($value, $index) use ($stringColumns) {
                return sanitizeValueByIndex($value, $index, $stringColumns);
            }, $row, array_keys($row));

            // 🔄 Your INSERT logic here (not shown in the original code)
        
            $sql = "INSERT INTO [secondary_dashboard_db].[dbo].[sp_shot_count] 
                ([section]
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
      
      )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                        ?, ?)";

            $params = array(
                $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], 
                $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], 
                $row[13], $row[14], $row[15], $row[16], $row[17], $row[18], 
                $row[19], $row[20], $row[21], $row[22], $row[23], $row[24], 
                $row[25], $row[26], $row[27], $row[28], $row[29], $row[30], 
                $row[31], $row[32], $row[33], $row[34], $row[35], $row[36], 
                $row[37], $row[38], $row[39], $row[40], $row[41], $row[42], 
                $row[43], $row[44], $row[45], $row[46], $row[47], $row[48],
                $row[49], $row[50], $row[51], $row[52], $row[53], $row[54],
                $row[55], $row[56], $row[57], $row[58], $row[59], $row[60],
                $row[61], $row[62], $row[63], $row[64], $row[65], $row[66],
                $row[67], $row[68], $row[69], $row[70], $row[71], $row[72],
                $row[73], $row[74], $row[75], $row[76], $row[77], $row[78],
                $row[79], $row[80], $row[81], $row[82], $row[83], $row[84], 
                $row[85], $row[86], $row[87], $row[88], $row[89], $row[90],
                $row[91], $row[92], $row[93], $row[94], $row[95], $row[96], 
                $row[97], $row[98], $row[99], $row[100],$row[101], $row[102], 
                $row[103], $row[104], $row[105], $row[106], $row[107], $row[108], 
                $row[109], $row[110], $row[111], $row[112], $row[113], $row[114], 
                $row[115], $row[116], $row[117], $row[118], $row[119], $row[120],
                $row[121]
            );

            // Execute the query
            $stmt = sqlsrv_query($conn, $sql, $params);

            // Check for errors in execution
            if ($stmt === false) {
                throw new Exception("Error executing SQL query: " . print_r(sqlsrv_errors(), true));
            }
        }

        // Commit transaction if everything is successful
        sqlsrv_commit($conn);

        echo "CSV file successfully imported!";
    } catch (Exception $e) {
        // Rollback in case of error
        sqlsrv_rollback($conn);
        echo "Error: " . $e->getMessage();
    }

    fclose($file);
} else {
    echo "No file uploaded.";
}

// Close the database connection
sqlsrv_close($conn);
?>
