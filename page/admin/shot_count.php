<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<style>
    .table-responsive {
        height: 45vh;
        overflow: auto;
        display: inline-block;
        margin-top: 50px;
        border-top: 1px solid gray;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-sm th,
    .table-sm td {
        padding: 10px;
        text-align: center;
    }

    .table-head-fixed thead {
        position: sticky;
        top: 0;
        background-color: rgb(255, 255, 255);
        color: black;
        z-index: 1;
        font-weight: bold;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
</style>



<div id="loadingSpinner"
    style="display: none; position: fixed; z-index: 9999; top: 50%; left: 50%; transform: translate(-50%, -50%)">
    <img src="../../dist/img/loading.gif" alt="Loading..." width="100">
</div>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Shot Count</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-table"></i> Shot Count
                            </h3>



                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="row mb-2">
                            </div>

                            <div class="row mt-1 align-items-center">

                                <!-- Dropdown -->
                                <div class="col-md-3 d-flex justify-content-center">
                                    <select class="form-control" id="sectionSelect">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>

                                <!-- Search Textbox -->
                                <div class="col-md-3 d-flex justify-content-center">
                                    <input type="text" class="form-control" id="searchInput"
                                        placeholder="Base Product..." style="height: 35px;">
                                </div>

                                <!-- Search Button -->
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-success custom-btn" id="searchBtn"
                                        style="height: 35px; width: 100%;">
                                        <i class="fas fa-search mr-2"></i>Search
                                    </button>
                                </div>
                                <!-- Import Button -->
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-primary custom-btn" id="importBtn" data-toggle="modal"
                                        data-target="#importModal" style="height: 35px; width: 100%;">
                                        <i class="fas fa-file-import mr-2"></i>Import
                                    </button>
                                </div>

                                <!-- Export Button -->
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-secondary custom-btn" id="exportBtn"
                                        style="height: 35px; width: 100%;">
                                        <i class="fas fa-file-export mr-2"></i>Export
                                    </button>
                                </div>

                            </div>

                            <div id="shot_count_tb" class="table-responsive">
                                <table id="scTable" class="table table-sm table-head-fixed text-nowrap table-hover">
                                    <thead>
                                        <tr>
                                            <th>Section</th>
                                            <th>Car Model</th>
                                            <th>Base Product</th>
                                            <th>Block</th>
                                            <th>Block 2</th>
                                            <th>Product</th>
                                            <th>Line No</th>
                                            <th>UV-III 1</th>
                                            <th>UV-III 2</th>
                                            <th>UV-III 4</th>
                                            <th>UV-III 5</th>
                                            <th>UV-III 7</th>
                                            <th>UV-III 8</th>
                                            <th>Arc Welding</th>
                                            <th>Aluminum Coating UV-II</th>
                                            <th>Servo Crimping</th>
                                            <th>Ultrasonic Welding</th>
                                            <th>Cap Insertion</th>
                                            <th>Twisting Primary (Aluminum Short Wires) L=1~3000mm</th>
                                            <th>Twisting Primary (Aluminum Long Wires) L=3001mm~</th>
                                            <th>Twisting Secondary (Aluminum Short Wires) L=1~3000mm</th>
                                            <th>Twisting Secondary (Aluminum Long Wires)</th>
                                            <th>Airbag</th>
                                            <th>A/B Sub PC</th>
                                            <th>Manual Insertion to Connector</th>
                                            <th>V type twisting</th>
                                            <th>Twisting Primary (Normal Short Wires) L=1~3000mm</th>
                                            <th>Twisting Primary (Normal Long Wires) L=3001mm~</th>
                                            <th>Twisting Secondary (Normal Short Wires) L=1~3000mm</th>
                                            <th>Twisting Secondary (Normal Long Wires) L=3001mm~</th>
                                            <th>Manual Crimping 2Tons (with gomusen)</th>
                                            <th>Manual Crimping 2Tons (normal-single crimp)</th>
                                            <th>Manual Crimping 2Tons (normal-double crimp)</th>
                                            <th>Manual Crimping 2Tons (to be joint on SW)</th>
                                            <th>Manual Crimping 2Tons NSC/ Weld</th>
                                            <th>Manual Crimping 4Tons (normal terminal)</th>
                                            <th>Manual Crimping 4Tons (LA terminal)</th>
                                            <th>Manual Crimping (NF-F)</th>
                                            <th>Manual Crimping 5Tons</th>
                                            <th>Intermediate ripping (UAS) Manual-NF-F</th>
                                            <th>Intermediate ripping (UAS) Joint</th>
                                            <th>Intermediate stripping (KB10)</th>
                                            <th>Intermediate stripping (KB10) NSC/ Weld</th>
                                            <th>Joint Crimping 2Tons (PS-800)</th>
                                            <th>Joint Crimping 2Tons (PS-700)</th>
                                            <th>Joint Crimping 2Tons (PS-017/126)</th>
                                            <th>Joint Crimping 2Tons NSC/ Weld</th>
                                            <th>Joint Crimping 4Tons (PS-200)</th>
                                            <th>Joint Crimping 5Tons</th>
                                            <th>Manual Taping (Dispenser)</th>
                                            <th>Joint Taping (11mm)</th>
                                            <th>Joint Taping (12mm)</th>
                                            <th>Joint Taping (13mm)</th>
                                            <th>Joint Taping (13mm) NSC/ Weld</th>
                                            <th>Intermediate Welding (Electrode 1)</th>
                                            <th>Intermediate Welding (Electrode 2)</th>
                                            <th>Intermediate Welding (Electrode 3)</th>
                                            <th>Intermediate Welding (Electrode 4)</th>
                                            <th>Intermediate Welding (Electrode 5)</th>
                                            <th>Intermediate Welding 0.13 (Electrode 1)</th>
                                            <th>Intermediate Welding 0.13 (Electrode 2)</th>
                                            <th>Welding at Head (Electrode 1)</th>
                                            <th>Welding at Head (Electrode 2)</th>
                                            <th>Welding at Head (Electrode 3)</th>
                                            <th>Welding at Head (Electrode 4)</th>
                                            <th>Welding at Head (Electrode 5)</th>
                                            <th>Welding at Head 0.13 (Electrode 1)</th>
                                            <th>Welding at Head 0.13 (Electrode 2)</th>
                                            <th>Silicon Injection</th>
                                            <th>Welding Cap Insertion</th>
                                            <th>Welding Taping (13mm)</th>
                                            <th>HS Components Insertion</th>
                                            <th>Heat Shrink LA terminal</th>
                                            <th>Heat Shrink (Joint Crimping)</th>
                                            <th>Heat Shrink (Welding)</th>
                                            <th>Casting C385</th>
                                            <th>STMAC Shieldwire (Nissan)</th>
                                            <th>Quick Stripping 927 (Auto)</th>
                                            <th>Quick Stripping 311 (Manual)</th>
                                            <th>Manual Heat Shrink (Blower) Sumitube</th>
                                            <th>Drainwire Tip</th>
                                            <th>Manual Crimping Shieldwire 2T</th>
                                            <th>Manual Crimping Shieldwire 4T</th>
                                            <th>Joint Crimping 2Tons (PS-800/S-2) SW</th>
                                            <th>Joint Crimping 2Tons (PS-017/SS-2) SW</th>
                                            <th>Manual Blue Taping (Dispenser) SW</th>
                                            <th>Shieldwire Taping</th>
                                            <th>HS Components Insertion SW</th>
                                            <th>Heat Shrink (Joint Crimping) SW</th>
                                            <th>Waterproof pad Press - Joint</th>
                                            <th>Waterproof Pad Press - Weld</th>
                                            <th>Low Viscosity</th>
                                            <th>Air/Water leak test</th>
                                            <th>HIROSE (Sheath stripping) 927R</th>
                                            <th>HIROSE (Unistrip)</th>
                                            <th>HIROSE (Acetate Taping)</th>
                                            <th>HIROSE (Manual Crimping) 2 tons</th>
                                            <th>HIROSE (Copper taping)</th>
                                            <th>HIROSE (HGT17AP crimping)</th>
                                            <th>Casting C373</th>
                                            <th>Casting C377</th>
                                            <th>Casting C371</th>
                                            <th>STMAC Aluminum</th>
                                            <th>Manual Crimping 20Tons</th>
                                            <th>Manual Heat Shrink (Blower) Battery</th>
                                            <th>Joint Crimping 20Tons</th>
                                            <th>Dip Soldering (Battery)</th>
                                            <th>Ultrasonic Dip Soldering Aluminum</th>
                                            <th>LA molding</th>
                                            <th>Air/Water leak test</th>
                                            <th>Pressure Welding (Dome Lamp)</th>
                                            <th>Ferrule - Casting C373</th>
                                            <th>Ferrule - Parts Insertion</th>
                                            <th>Ferrule - Braided wire folding</th>
                                            <th>Outside ferrule insertion</th>
                                            <th>Ferrule - Manual Crimping 2T</th>
                                            <th>Ferrule Crimping</th>
                                            <th>Ferrule - Joint Crimping 2T</th>
                                            <th>Ferrule - Welding at head</th>
                                            <th>Ferrule - Welding Taping</th>
                                            <th>Gomusen Insertion</th>
                                            <th>Point Marking</th>
   

                                        </tr>
                                    </thead>
                                    <tbody id="scBody">

                                    </tbody>


                                </table>

                            </div>
                            <div id="dataCount">
                                Total Rows: <span id="totalCount">0</span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<Script>
    // -----------------------------------------------------------Import -----------------------------------------------------------
    document.getElementById("importBtn").addEventListener("click", function () {
        const input = document.createElement("input");
        input.type = "file";
        input.accept = ".csv";

        input.onchange = async () => {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append("csv_file", file);


            document.getElementById("loadingSpinner").style.display = "block";

            try {
                const res = await fetch("../../process/import_shot_count.php", {
                    method: "POST",
                    body: formData
                });

                const text = await res.text();


                document.getElementById("loadingSpinner").style.display = "none";


                Swal.fire({
                    title: "Import Done!",
                    text: text,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1000
                });

            } catch (err) {
                document.getElementById("loadingSpinner").style.display = "none";
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong during import.",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        };

        input.click();
    });


    // -----------------------------------------------------------Fetch -----------------------------------------------------------
    let offset = 0;
    const limit = 200;
    let loading = false;
    let allLoaded = false;
    let totalRows = 0; // To store total rows count

    function loadRows() {
        if (loading || allLoaded) return;
        loading = true;

        fetch(`../../process/fetch_shot_count.php?offset=${offset}&limit=${limit}`)
            .then(res => res.json())
            .then(data => {
                if (!data || !Array.isArray(data.rows) || data.rows.length === 0) {
                    allLoaded = true;
                    return;
                }


                if (offset === 0) {
                    totalRows = data.total;
                    document.getElementById('totalCount').textContent = totalRows;
                }

                const scBody = document.getElementById('scBody');
                data.rows.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
          <td>${row.section ?? ''}</td>
          <td>${row.car_model ?? ''}</td>
          <td>${row.base_product ?? ''}</td>
          <td>${row.block ?? ''}</td>
          <td>${row.block_2 ?? ''}</td>
          <td>${row.product ?? ''}</td>
          <td>${row.line_no ?? ''}</td>
          <td>${row.uv_iii_1  ?? ''}</td>
<td>${row.uv_iii_2  ?? ''}</td>
<td>${row.uv_iii_4  ?? ''}</td>
<td>${row.uv_iii_5  ?? ''}</td>
<td>${row.uv_iii_7  ?? ''}</td>
<td>${row.uv_iii_8  ?? ''}</td>
<td>${row.arc_welding  ?? ''}</td>
<td>${row.aluminum_coating_uv_ii  ?? ''}</td>
<td>${row.servo_crimping  ?? ''}</td>
<td>${row.ultrasonic_welding  ?? ''}</td>
<td>${row.cap_insertion  ?? ''}</td>
<td>${row.twisting_primary_aluminum_short_wires_l_1_3000mm  ?? ''}</td>
<td>${row.twisting_primary_aluminum_long_wires_l_3001mm  ?? ''}</td>
<td>${row.twisting_secondary_aluminum_short_wires_l_1_3000mm  ?? ''}</td>
<td>${row.twisting_secondary_aluminum_long_wires_l_3001mm  ?? ''}</td>
<td>${row.airbag  ?? ''}</td>
<td>${row.a_b_sub_pc  ?? ''}</td>
<td>${row.manual_insertion_to_connector  ?? ''}</td>
<td>${row.v_type_twisting  ?? ''}</td>
<td>${row.twisting_primary_normal_short_wires_l_1_3000mm  ?? ''}</td>
<td>${row.twisting_primary_normal_long_wires_l_3001mm  ?? ''}</td>
<td>${row.twisting_secondary_normal_short_wires_l_1_3000mm  ?? ''}</td>
<td>${row.twisting_secondary_normal_long_wires_l_3001mm  ?? ''}</td>
<td>${row.manual_crimping_2tons_with_gomusen  ?? ''}</td>
<td>${row.manual_crimping_2tons_normal_single_crimp  ?? ''}</td>
<td>${row.manual_crimping_2tons_normal_double_crimp  ?? ''}</td>
<td>${row.manual_crimping_2tons_to_be_joint_on_sw  ?? ''}</td>
<td>${row.manual_crimping_2tons_nsc_weld  ?? ''}</td>
<td>${row.manual_crimping_4tons_normal_terminal  ?? ''}</td>
<td>${row.manual_crimping_4tons_la_terminal  ?? ''}</td>
<td>${row.manual_crimping_nf_f  ?? ''}</td>
<td>${row.manual_crimping_5tons  ?? ''}</td>
<td>${row.intermediate_ripping_uas_manual_nf_f  ?? ''}</td>
<td>${row.intermediate_ripping_uas_joint  ?? ''}</td>
<td>${row.intermediate_stripping_kb10  ?? ''}</td>
<td>${row.intermediate_stripping_kb10_nsc_weld  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_800  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_700  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_017_126  ?? ''}</td>
<td>${row.joint_crimping_2tons_nsc_weld  ?? ''}</td>
<td>${row.joint_crimping_4tons_ps_200  ?? ''}</td>
<td>${row.joint_crimping_5tons  ?? ''}</td>
<td>${row.manual_taping_dispenser  ?? ''}</td>
<td>${row.joint_taping_11mm  ?? ''}</td>
<td>${row.joint_taping_12mm  ?? ''}</td>
<td>${row.joint_taping_13mm  ?? ''}</td>
<td>${row.joint_taping_13mm_nsc_weld  ?? ''}</td>
<td>${row.intermediate_welding_electrode_1  ?? ''}</td>
<td>${row.intermediate_welding_electrode_2  ?? ''}</td>
<td>${row.intermediate_welding_electrode_3  ?? ''}</td>
<td>${row.intermediate_welding_electrode_4  ?? ''}</td>
<td>${row.intermediate_welding_electrode_5  ?? ''}</td>
<td>${row.intermediate_welding_0_13_electrode_1  ?? ''}</td>
<td>${row.intermediate_welding_0_13_electrode_2  ?? ''}</td>
<td>${row.welding_at_head_electrode_1  ?? ''}</td>
<td>${row.welding_at_head_electrode_2  ?? ''}</td>
<td>${row.welding_at_head_electrode_3  ?? ''}</td>
<td>${row.welding_at_head_electrode_4  ?? ''}</td>
<td>${row.welding_at_head_electrode_5  ?? ''}</td>
<td>${row.welding_at_head_0_13_electrode_1  ?? ''}</td>
<td>${row.welding_at_head_0_13_electrode_2  ?? ''}</td>
<td>${row.silicon_injection  ?? ''}</td>
<td>${row.welding_cap_insertion  ?? ''}</td>
<td>${row.welding_taping_13mm  ?? ''}</td>
<td>${row.hs_components_insertion  ?? ''}</td>
<td>${row.heat_shrink_la_terminal  ?? ''}</td>
<td>${row.heat_shrink_joint_crimping  ?? ''}</td>
<td>${row.heat_shrink_welding  ?? ''}</td>
<td>${row.casting_c385  ?? ''}</td>
<td>${row.stmac_shieldwire_nissan  ?? ''}</td>
<td>${row.quick_stripping_927_auto  ?? ''}</td>
<td>${row.quick_stripping_311_manual  ?? ''}</td>
<td>${row.manual_heat_shrink_blower_sumitube  ?? ''}</td>
<td>${row.drainwire_tip  ?? ''}</td>
<td>${row.manual_crimping_shieldwire_2t  ?? ''}</td>
<td>${row.manual_crimping_shieldwire_4t  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_800_s_2_sw  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_017_ss_2_sw  ?? ''}</td>
<td>${row.manual_blue_taping_dispenser_sw  ?? ''}</td>
<td>${row.shieldwire_taping  ?? ''}</td>
<td>${row.hs_components_insertion_sw ?? ''}</td>
<td>${row.heat_shrink_joint_crimping_sw  ?? ''}</td>
<td>${row.waterproof_pad_press_joint  ?? ''}</td>
<td>${row.waterproof_pad_press_weld  ?? ''}</td>
<td>${row.low_viscosity  ?? ''}</td>
<td>${row.air_water_leak_test  ?? ''}</td>
<td>${row.hirose_sheath_stripping_927r  ?? ''}</td>
<td>${row.hirose_unistrip  ?? ''}</td>
<td>${row.hirose_acetate_taping  ?? ''}</td>
<td>${row.hirose_manual_crimping_2_tons  ?? ''}</td>
<td>${row.hirose_copper_taping  ?? ''}</td>
<td>${row.hirose_hgt17ap_crimping  ?? ''}</td>
<td>${row.casting_c373  ?? ''}</td>
<td>${row.casting_c377  ?? ''}</td>
<td>${row.casting_c371  ?? ''}</td>
<td>${row.stmac_aluminum  ?? ''}</td>
<td>${row.manual_crimping_20tons  ?? ''}</td>
<td>${row.manual_heat_shrink_blower_battery  ?? ''}</td>
<td>${row.joint_crimping_20tons  ?? ''}</td>
<td>${row.dip_soldering_battery  ?? ''}</td>
<td>${row.ultrasonic_dip_soldering_aluminum  ?? ''}</td>
<td>${row.la_molding  ?? ''}</td>
<td>${row.air_water_leak_test_2?? ''}</td>
<td>${row.pressure_welding_dome_lamp?? ''}</td>
<td>${row.ferrule_casting_c373  ?? ''}</td>
<td>${row.ferrule_parts_insertion  ?? ''}</td>
<td>${row.ferrule_braided_wire_folding  ?? ''}</td>
<td>${row.outside_ferrule_insertion  ?? ''}</td>
<td>${row.ferrule_manual_crimping_2t  ?? ''}</td>
<td>${row.ferrule_crimping  ?? ''}</td>
<td>${row.ferrule_joint_crimping_2t  ?? ''}</td>
<td>${row.ferrule_welding_at_head  ?? ''}</td>
<td>${row.ferrule_welding_taping  ?? ''}</td>
<td>${row.gomusen_insertion  ?? ''}</td>
<td>${row.point_marking  ?? ''}</td>




          
        `;
                    scBody.appendChild(tr);
                });

                offset += limit;
                loading = false;
            })
            .catch(error => {
                console.error('Lazy load error:', error);
                loading = false;
            });
    }


    loadRows();

    // -----------------------------------------------------------Export -----------------------------------------------------------

    document.getElementById('shot_count_tb').addEventListener('scroll', () => {
        const container = document.getElementById('shot_count_tb');
        if (container.scrollTop + container.clientHeight >= container.scrollHeight - 200) {
            loadRows();
        }
    });

    document.getElementById("exportBtn").addEventListener("click", async () => {
        try {
            const res = await fetch("../../process/export_shot_count.php");
            const blob = await res.blob();

            const url = window.URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "Shot_Count_export.csv";
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        } catch (error) {
            console.error("Export failed:", error);
            alert("Failed to export data.");
        }
    });

    fetch('../../process/fetch_section.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(function (section) {
                const option = document.createElement('option');
                option.value = section;
                option.textContent = section;
                document.getElementById('sectionSelect').appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching sections:', error));




    // -----------------------------------------------------------Search -----------------------------------------------------------

    document.getElementById("searchBtn").addEventListener("click", () => {
        const section = document.getElementById("sectionSelect").value;
        const baseProduct = document.getElementById("searchInput").value.trim();

        // Reset table and variables
        document.getElementById("scBody").innerHTML = "";
        offset = 0;
        allLoaded = false;

        // Reload with filters
        loadRows(section, baseProduct);
    });

    function loadRows(section = "", baseProduct = "") {
        if (loading || allLoaded) return;
        loading = true;

        const url = `../../process/fetch_shot_count.php?offset=${offset}&limit=${limit}&section=${encodeURIComponent(section)}&base_product=${encodeURIComponent(baseProduct)}`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                if (!data || !Array.isArray(data.rows) || data.rows.length === 0) {
                    allLoaded = true;
                    return;
                }

                if (offset === 0) {
                    totalRows = data.total;
                    document.getElementById('totalCount').textContent = totalRows;
                }

                const scBody = document.getElementById('scBody');
                data.rows.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${row.section ?? ''}</td>
          <td>${row.car_model ?? ''}</td>
          <td>${row.base_product ?? ''}</td>
          <td>${row.block ?? ''}</td>
          <td>${row.block_2 ?? ''}</td>
          <td>${row.product ?? ''}</td>
          <td>${row.line_no ?? ''}</td>
          <td>${row.uv_iii_1  ?? ''}</td>
<td>${row.uv_iii_2  ?? ''}</td>
<td>${row.uv_iii_4  ?? ''}</td>
<td>${row.uv_iii_5  ?? ''}</td>
<td>${row.uv_iii_7  ?? ''}</td>
<td>${row.uv_iii_8  ?? ''}</td>
<td>${row.arc_welding  ?? ''}</td>
<td>${row.aluminum_coating_uv_ii  ?? ''}</td>
<td>${row.servo_crimping  ?? ''}</td>
<td>${row.ultrasonic_welding  ?? ''}</td>
<td>${row.cap_insertion  ?? ''}</td>
<td>${row.twisting_primary_aluminum_short_wires_l_1_3000mm  ?? ''}</td>
<td>${row.twisting_primary_aluminum_long_wires_l_3001mm  ?? ''}</td>
<td>${row.twisting_secondary_aluminum_short_wires_l_1_3000mm  ?? ''}</td>
<td>${row.twisting_secondary_aluminum_long_wires_l_3001mm  ?? ''}</td>
<td>${row.airbag  ?? ''}</td>
<td>${row.a_b_sub_pc  ?? ''}</td>
<td>${row.manual_insertion_to_connector  ?? ''}</td>
<td>${row.v_type_twisting  ?? ''}</td>
<td>${row.twisting_primary_normal_short_wires_l_1_3000mm  ?? ''}</td>
<td>${row.twisting_primary_normal_long_wires_l_3001mm  ?? ''}</td>
<td>${row.twisting_secondary_normal_short_wires_l_1_3000mm  ?? ''}</td>
<td>${row.twisting_secondary_normal_long_wires_l_3001mm  ?? ''}</td>
<td>${row.manual_crimping_2tons_with_gomusen  ?? ''}</td>
<td>${row.manual_crimping_2tons_normal_single_crimp  ?? ''}</td>
<td>${row.manual_crimping_2tons_normal_double_crimp  ?? ''}</td>
<td>${row.manual_crimping_2tons_to_be_joint_on_sw  ?? ''}</td>
<td>${row.manual_crimping_2tons_nsc_weld  ?? ''}</td>
<td>${row.manual_crimping_4tons_normal_terminal  ?? ''}</td>
<td>${row.manual_crimping_4tons_la_terminal  ?? ''}</td>
<td>${row.manual_crimping_nf_f  ?? ''}</td>
<td>${row.manual_crimping_5tons  ?? ''}</td>
<td>${row.intermediate_ripping_uas_manual_nf_f  ?? ''}</td>
<td>${row.intermediate_ripping_uas_joint  ?? ''}</td>
<td>${row.intermediate_stripping_kb10  ?? ''}</td>
<td>${row.intermediate_stripping_kb10_nsc_weld  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_800  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_700  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_017_126  ?? ''}</td>
<td>${row.joint_crimping_2tons_nsc_weld  ?? ''}</td>
<td>${row.joint_crimping_4tons_ps_200  ?? ''}</td>
<td>${row.joint_crimping_5tons  ?? ''}</td>
<td>${row.manual_taping_dispenser  ?? ''}</td>
<td>${row.joint_taping_11mm  ?? ''}</td>
<td>${row.joint_taping_12mm  ?? ''}</td>
<td>${row.joint_taping_13mm  ?? ''}</td>
<td>${row.joint_taping_13mm_nsc_weld  ?? ''}</td>
<td>${row.intermediate_welding_electrode_1  ?? ''}</td>
<td>${row.intermediate_welding_electrode_2  ?? ''}</td>
<td>${row.intermediate_welding_electrode_3  ?? ''}</td>
<td>${row.intermediate_welding_electrode_4  ?? ''}</td>
<td>${row.intermediate_welding_electrode_5  ?? ''}</td>
<td>${row.intermediate_welding_0_13_electrode_1  ?? ''}</td>
<td>${row.intermediate_welding_0_13_electrode_2  ?? ''}</td>
<td>${row.welding_at_head_electrode_1  ?? ''}</td>
<td>${row.welding_at_head_electrode_2  ?? ''}</td>
<td>${row.welding_at_head_electrode_3  ?? ''}</td>
<td>${row.welding_at_head_electrode_4  ?? ''}</td>
<td>${row.welding_at_head_electrode_5  ?? ''}</td>
<td>${row.welding_at_head_0_13_electrode_1  ?? ''}</td>
<td>${row.welding_at_head_0_13_electrode_2  ?? ''}</td>
<td>${row.silicon_injection  ?? ''}</td>
<td>${row.welding_cap_insertion  ?? ''}</td>
<td>${row.welding_taping_13mm  ?? ''}</td>
<td>${row.hs_components_insertion  ?? ''}</td>
<td>${row.heat_shrink_la_terminal  ?? ''}</td>
<td>${row.heat_shrink_joint_crimping  ?? ''}</td>
<td>${row.heat_shrink_welding  ?? ''}</td>
<td>${row.casting_c385  ?? ''}</td>
<td>${row.stmac_shieldwire_nissan  ?? ''}</td>
<td>${row.quick_stripping_927_auto  ?? ''}</td>
<td>${row.quick_stripping_311_manual  ?? ''}</td>
<td>${row.manual_heat_shrink_blower_sumitube  ?? ''}</td>
<td>${row.drainwire_tip  ?? ''}</td>
<td>${row.manual_crimping_shieldwire_2t  ?? ''}</td>
<td>${row.manual_crimping_shieldwire_4t  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_800_s_2_sw  ?? ''}</td>
<td>${row.joint_crimping_2tons_ps_017_ss_2_sw  ?? ''}</td>
<td>${row.manual_blue_taping_dispenser_sw  ?? ''}</td>
<td>${row.shieldwire_taping  ?? ''}</td>
<td>${row.hs_components_insertion_sw ?? ''}</td>
<td>${row.heat_shrink_joint_crimping_sw  ?? ''}</td>
<td>${row.waterproof_pad_press_joint  ?? ''}</td>
<td>${row.waterproof_pad_press_weld  ?? ''}</td>
<td>${row.low_viscosity  ?? ''}</td>
<td>${row.air_water_leak_test  ?? ''}</td>
<td>${row.hirose_sheath_stripping_927r  ?? ''}</td>
<td>${row.hirose_unistrip  ?? ''}</td>
<td>${row.hirose_acetate_taping  ?? ''}</td>
<td>${row.hirose_manual_crimping_2_tons  ?? ''}</td>
<td>${row.hirose_copper_taping  ?? ''}</td>
<td>${row.hirose_hgt17ap_crimping  ?? ''}</td>
<td>${row.casting_c373  ?? ''}</td>
<td>${row.casting_c377  ?? ''}</td>
<td>${row.casting_c371  ?? ''}</td>
<td>${row.stmac_aluminum  ?? ''}</td>
<td>${row.manual_crimping_20tons  ?? ''}</td>
<td>${row.manual_heat_shrink_blower_battery  ?? ''}</td>
<td>${row.joint_crimping_20tons  ?? ''}</td>
<td>${row.dip_soldering_battery  ?? ''}</td>
<td>${row.ultrasonic_dip_soldering_aluminum  ?? ''}</td>
<td>${row.la_molding  ?? ''}</td>
<td>${row.air_water_leak_test_2?? ''}</td>
<td>${row.pressure_welding_dome_lamp?? ''}</td>
<td>${row.ferrule_casting_c373  ?? ''}</td>
<td>${row.ferrule_parts_insertion  ?? ''}</td>
<td>${row.ferrule_braided_wire_folding  ?? ''}</td>
<td>${row.outside_ferrule_insertion  ?? ''}</td>
<td>${row.ferrule_manual_crimping_2t  ?? ''}</td>
<td>${row.ferrule_crimping  ?? ''}</td>
<td>${row.ferrule_joint_crimping_2t  ?? ''}</td>
<td>${row.ferrule_welding_at_head  ?? ''}</td>
<td>${row.ferrule_welding_taping  ?? ''}</td>
<td>${row.gomusen_insertion  ?? ''}</td>
<td>${row.point_marking  ?? ''}</td>


                `;
                    scBody.appendChild(tr);
                });

                offset += limit;
                loading = false;
            })
            .catch(error => {
                console.error('Lazy load error:', error);
                loading = false;
            });
    }


</Script>











<?php include 'plugins/admin_footer.php'; ?>


</body>

</html>