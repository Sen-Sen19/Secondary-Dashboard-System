<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/user_bar.php'; ?>


<style>
    
    .content-wrapper {
    padding-bottom: 50px; /* 👈 extra space for scrolling under sticky/fixed footer */
}

    /* Make the table header sticky */
    #summaryTable thead {
        position: sticky;
        top: 0;
        z-index: 1;
        /* Ensures it stays above other table rows when scrolling */
        background-color: #f8f9fa;
        /* You can customize this to match your design */
    }

    /* Set the table height to 200px and make the body scrollable */
    .table-responsive {
        max-height: 700px;
        overflow-y: auto;
    }

    /* Optional: Ensure the header's background color remains consistent */
    #summaryTable th {
    background-color: #f8f9fa;
    }

    .table-container {
        overflow-x: auto;
        max-width: 100%;
    }

    #summaryTable thead tr:first-child th[colspan="3"]:nth-of-type(1) {
        /* Flow */
        position: sticky;
        top: 0;
        left: 0;
        width: 290px;
        background-color: #fff;
        z-index: 9999;
        border-bottom: 1px solid #ccc;
    }



    /* And so on for all the rest of the groups */

    #summaryTable th:nth-child(1),
    #summaryTable td:nth-child(1) {
        position: sticky;
        left: 0px;
        /* Match previous column width */
        width: 120px;
        background-color: #fff;

    }

    #summaryTable tr.data-row th:nth-child(1),
    #summaryTable tr.data-row td:nth-child(1) {
        position: sticky;
        left: 0;
        width: 120px;
        background-color: #fff;
    }


    #summaryTable th:nth-child(2),
    #summaryTable td:nth-child(2) {
        position: sticky;
        left: 77px;
        /* Match previous column width */
        width: 120px;
        background-color: #fff;

    }

    #summaryTable th:nth-child(3),
    #summaryTable td:nth-child(3) {
        position: sticky;
        left: 175px;
        /* 120px + 120px */
        width: 130px;
        background-color: #fff;

    }
</style>

<!-- Existing HTML code continues... -->


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






                        <div class="card-body">

                            <form action="../../process/export_section.php" method="POST">
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <!-- Section Dropdown -->
                                        <div class="col-md-2">
                                            <label for="sectionSelect">Section</label>
                                            <select id="sectionSelect" name="section" class="form-control" required>
                                                <option value="">Select Section...</option>
                                                <option value="all">Entire Table</option>
                                                <option value="Overall">Overall</option>
                                                <option value="1">Section 1</option>
                                                <option value="2">Section 2</option>
                                                <option value="3">Section 3</option>
                                                <option value="3.1">Section 3.1</option>
                                                <option value="5">Section 5</option>
                                                <option value="6">Section 6</option>
                                                <option value="7">Section 7</option>
                                                <option value="8">Section 8</option>

                                            </select>
                                        </div>

                                        <!-- Export Button -->
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button class="btn btn-secondary w-100" type="submit">
                                                <i class="fas fa-file-export"></i> Export
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>





               <div class="table-responsive">
                                <table class="table table-head-fixed table-hover text-center" id="summaryTable">
                                    <thead>
                                                                             <tr>
                                            <th colspan="3" style="background-color: #FFFFFF;">Flow</th>
                                            <th colspan="8" style="background-color: #FFC000;">Aluminum Process</th>
                                            <th colspan="3" style="background-color: #FFE699;">Airbag Process</th>
                                            <th colspan="3" style="background-color: #B4C6E7;">Twisting Process</th>
                                            <th colspan="3" style="background-color:rgb(252, 212, 202);">Manual Crimping Process</th>
                                            <th colspan="4" style="background-color:rgb(134, 182, 138);">Midstripping</th>
                                            <th colspan="5" style="background-color:rgb(96, 132, 199);">Joint Crimping</th>
                                            <th colspan="7" style="background-color:rgb(252, 181, 133);">Welding Process</th>
                                            <th colspan="4" style="background-color:rgb(221, 207, 80);">Heatshrink</th>
                                            <th colspan="11" style="background-color:rgb(143, 146, 150);">Shieldwire Process</th>
                                            <th colspan="1" style="background-color:rgb(216, 222, 235);">Waterproof Pad Press</th>
                                            <!-- <th colspan="1" style="background-color:rgb(143, 146, 150);">Shieldwire Process</th> -->
                                            <th colspan="2" style="background-color:rgb(129, 0, 0);">Low Viscosity</th>
                                            <th colspan="1" style="background-color:rgb(213, 228, 219);">HIROSE</th>
                                            <th colspan="7" style="background-color:rgb(229, 230, 188);">Battery Process</th>
                                            <th colspan="1" style="background-color:rgb(255, 225, 232);">LA molding</th>
                                            <th colspan="1" style="background-color:rgb(176, 188, 209);">Dome Lamp</th>
                                            <th colspan="1" style="background-color:rgb(146, 189, 175);">Ferrule Process</th>
                                            <th colspan="2" style="background-color:rgb(161, 185, 230);">Non machine process</th>

                                        </tr>
                                        <tr>
                                            <th style="background-color: #FFFFFF;">Section</th>
                                            <th style="background-color: #FFFFFF;">General Process</th>
                                            <th style="background-color: #FFFFFF;">Total</th>
                                            <th style="background-color: #FFC000;">UV-III</th>
                                            <th style="background-color: #FFC000;">Arc Welding</th>
                                             <th style="background-color: #FFC000;">Aluminum Coating UV II</th>
                                            <th style="background-color: #FFC000;">Servo Crimping</th>
                                            <th style="background-color: #FFC000;">Ultrasonic Welding</th>
                                           
                                            <th style="background-color: #FFC000;">Cap Insertion</th>
                                            <th style="background-color: #FFC000;">Twisting Primary Aluminum</th>
                                            <th style="background-color: #FFC000;">Twisting Secondary Aluminum</th>
                                            <th style="background-color: #FFE699;">Airbag</th>
                                            <th style="background-color: #FFE699;">A/B Sub PC</th>
                                            <th style="background-color: #FFE699;">Manual Insertion to Connector</th>
                                            <th style="background-color: #B4C6E7;">V Type Twisting</th>
                                            <th style="background-color: #B4C6E7;">Twisting Primary</th>
                                            <th style="background-color: #B4C6E7;">Twisting Secondary</th>
                                            <th style="background-color: rgb(252, 212, 202);">Manual Crimping 2Tons</th>
                                            <th style="background-color: rgb(252, 212, 202);">Manual Crimping 4Tons</th>
                                            <th style="background-color: rgb(252, 212, 202);">Manual Crimping 5Tons</th>
                                            <th style="background-color: rgb(134, 182, 138);">Intermediate ripping(UAS)Manual-NF-F</th>
                                            <th style="background-color: rgb(134, 182, 138);">Intermediate ripping (UAS)Joint stripping(KB10)</th>
                                            <th style="background-color: rgb(134, 182, 138);">Intermediate stripping(KB10)</th>
                                            <th style="background-color: rgb(134, 182, 138);">Intermediate stripping(KB10)NSC/Weld</th>
                                            <th style="background-color: rgb(96, 132, 199);">Joint Crimping 2Tons</th>
                                            <th style="background-color: rgb(96, 132, 199);">Joint Crimping 4Tons(PS-200)</th>
                                            <th style="background-color: rgb(96, 132, 199);">Joint Crimping 5Tons</th>
                                            <th style="background-color: rgb(96, 132, 199);">Manual Taping (Dispenser)</th>
                                            <th style="background-color: rgb(96, 132, 199);">Joint Taping</th>
                                            <th style="background-color: rgb(252, 181, 133);">Intermediate Welding</th>
                                            <th style="background-color: rgb(252, 181, 133);">Intermediate Welding 0.13</th>
                                            <th style="background-color: rgb(252, 181, 133);">Welding at Head</th>
                                            <th style="background-color: rgb(252, 181, 133);">Welding at Head 0.13</th>
                                            <th style="background-color: rgb(252, 181, 133);">Silicon Injection</th>
                                            <th style="background-color: rgb(252, 181, 133);">Welding Cap Insertion</th>
                                            <th style="background-color: rgb(252, 181, 133);">Welding Taping(13mm)</th>
                                            <th style="background-color: rgb(221, 207, 80);">Heatshrink</th>
                                            <th style="background-color: rgb(221, 207, 80);">Heat Shrink LA terminal</th>
                                            <th style="background-color: rgb(221, 207, 80);">Heat Shrink (Joint Crimping)</th>
                                            <th style="background-color: rgb(221, 207, 80);">Heat Shrink (Welding)</th>
                                            <th style="background-color: rgb(143, 146, 150);">Casting C385</th>
                                            <th style="background-color: rgb(143, 146, 150);">STMAC Shieldwire(Nissan)</th>
                                            <th style="background-color: rgb(143, 146, 150);">Quick Stripping</th>
                                     
                                            
                                            <th style="background-color: rgb(143, 146, 150);">Manual Heat Shrink(Blower)Sumitube</th>
                                            <th style="background-color: rgb(143, 146, 150);">Drainwire Tip</th>
                                            <th style="background-color: rgb(143, 146, 150);">Manual Crimping Shieldwire</th>
                                            <th style="background-color: rgb(143, 146, 150);">Joint Crimping 2TonsSW</th>
                                            <th style="background-color: rgb(143, 146, 150);">Manual Blue Taping(Dispenser)SW</th>
                                            <th style="background-color: rgb(143, 146, 150);">Shieldwire Taping</th>
                                            <th style="background-color: rgb(143, 146, 150);">HS Components Insertion SW</th>
                                            <th style="background-color: rgb(143, 146, 150);">Heat Shrink (Joint Crimping)SW</th>
                                            <th style="background-color: rgb(216, 222, 235);">Waterproof pad Press</th>
                                            <!-- <th style="background-color: rgb(143, 146, 150);">Heat Shrink (Joint Crimping)SW</th> -->
                                            <th style="background-color: rgb(129, 0, 0);">Low Viscosity</th>
                                            <th style="background-color: rgb(129, 0, 0);">Air/Water leak test</th>
                                            <th style="background-color: rgb(213, 228, 219)">HIROSE</th>
                                            <th style="background-color: rgb(229, 230, 188);">Casting Battery</th>
                                                   <th style="background-color: rgb(229, 230, 188);">STMACAluminum</th>
                                              <th style="background-color:rgb(229, 230, 188);">Manual Crimping 20Tons</th>
                                            <th style="background-color: rgb(229, 230, 188);">Manual Heat Shrink (Blower)Battery</th>
                                            <th style="background-color: rgb(229, 230, 188);">Joint Crimping 20Tons</th>
                                            <th style="background-color: rgb(229, 230, 188);">Dip Soldering (Battery)</th>
                                            <th style="background-color: rgb(229, 230, 188);">Ultrasonic Dip SolderingAluminum</th>
                                            <th style="background-color: rgb(255, 225, 232);">La molding</th>
                                            <th style="background-color: rgb(176, 188, 209);">Pressure Welding(Dome Lamp)</th>
                                            <th style="background-color: rgb(146, 189, 175);">Ferrule Process</th>
                                            <th style="background-color: rgb(161, 185, 230);">Gomusen Insertion</th>
                                            <th style="background-color: rgb(161, 185, 230);">Point Marking</th>
                                        </tr>
                                    </thead>
                                    <div id="B4C6E7q"></div>
                                    <div class="table-container">
                                        <tbody id="summaryBody">
                                            <!-- Table rows will be loaded here -->
                                        </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
</div>
</div>
</div>
</section>
</div>
<script>



    document.addEventListener("DOMContentLoaded", function () {
        -
            fetch("../../process/fetch_overall_summary.php")
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.text();
                })
                .then(data => {
                    console.log("Fetched data:", data);

                })
                .catch(error => {
                    console.error("Fetch error:", error);
                });
    });
    fetch("../../process/backup_queries.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            console.log("Fetched data:", data);
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    fetch("../../process/backup_output.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            console.log("Fetched data:", data);
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });



    document.addEventListener("DOMContentLoaded", () => {
        const tbody = document.getElementById("summaryBody");
        const spinner = document.getElementById("loadingSpinner");

        spinner.style.display = "block";

        fetch("../../process/fetch_summary.php")
            .then(response => response.text())
            .then(data => {
                tbody.innerHTML = data;
                spinner.style.display = "none";
            })
            .catch(error => {
                tbody.innerHTML = `<tr><td colspan="14">Failed to load data</td></tr>`;
                console.error("Fetch error:", error);
                spinner.style.display = "none";
            });
    });


</script>




<?php include 'plugins/footer.php'; ?>


</body>

</html>