<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../dist/img/tir-logo.png" type="image/png">
  <title>Secondary Process Dashboard</title>

  <link href="../../plugins/bootstrap/js/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: rgb(234, 234, 234);
      color: white;
    }

    .custom-container {
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      height: 400px;
      padding: 20px;
      position: relative;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      
      gap: 8px;
    }

    .custom-container2 {
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      height: 450px;
      padding: 20px;
    }

    .custom-container3 {
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      height: 300px;
      padding: 20px;
    }

    .custom-container4 {
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      height: 80px;
      padding: 20px;

      margin-bottom: 20px;
    }
    
    .custom-container5 {
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      height: 400px;

    }

    .custom-title {
      background-color: rgb(137, 137, 137);
      border-radius: 8px;
      height: 60px;
      padding: 20px;
      display: flex;
      justify-content: center;
    }

    .custom-title h5 {
      font-size: 1.5rem !important;
      font-weight: bold !important;
      align-items: center;
      text-align: center;
    }

    .navbar {
      background-color: rgb(58, 58, 58);
    }

    .navbar-brand img {
      height: 30px;
      margin-right: 10px;
    }

    .btn-back {
      color: white;
      border-color: white;
    }

    .btn-back:hover {
      background-color: black;
      color: #121212;
    }


    .custom-container button {
      background-color: #5a6268;
      border: none;
      color: white;
      padding: 2px 18px;
      font-size: 14px;
      height: 32px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.1s;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .custom-container button.active {
      background-color: #007bff;
    }

    .custom-container button:active {
      transform: scale(0.98);
    }

    /* Bigger "Overall" button */
    .custom-container button.overall {
      grid-column: span 2;
      font-weight: bold;
      height: 32px;
      /* Double the height */
      font-size: 16px;
    }


    /* Dropdown */
    .dropdown {
      width: 90%;
      margin: 0 auto;
    }

    /* Scrollable table */
    .table-responsive {
      max-height: 350px;
      overflow-y: auto;
    }

    table {
      width: 100%;
      table-layout: fixed;
      font-size: 0.9rem;
    }

    th {
      position: sticky;
      top: 0;
      background-color: #f8f9fa;
      z-index: 1;
      font-size: 0.9rem !important;
    }

    td {
      font-size: 0.7rem !important;
    }



    .persection-container {
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      height: 400px;
      padding: 20px;
      position: relative;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      
      gap: 8px;
    }
    
    
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="../../dist/img/tir-logo.png" alt="Logo">
        <span>Secondary Process Dashboard</span>
      </a>
      <a href="../../index.php" class="btn btn-outline-light btn-back">Back</a>
    </div>
  </nav>

  <div class="container-fluid mt-3 mb-5">



    <!-- ---------------------------------------------------------- OVERALL PROCESS ----------------------------------------------------------  -->

    <div class="col-md-12">
      <div class="custom-title">
        <h5>OVERALL PROCESS</h5>
      </div>
    </div>


    <div class="container-fluid mt-3">
      <div class="row g-3">

        <div class="col-md-2">
          <div class="custom-container" id="sectionButtons">
            <button class="overall" data-section="Overall">Overall</button>
            <button data-section="1">Section 1</button>
            <button data-section="2">Section 2</button>
            <button>Section 3</button>
            <button>Section 3.1</button>
            <button>Section 4</button>
            <button>Section 5</button>
            <button>Section 6</button>
            <button>Section 7</button>
            <button>Section 9</button>
            <button>Battery</button>
          </div>
        </div>




        <!-- 9-column wide -->
        <!-- Output Gap Table -->
<div class="col-md-2">
  <div class="persection-container d-flex flex-wrap justify-content-between gap-2">
    <div style="width: 100%; height: 100%; display: flex; flex-direction: column;">
      <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
        <thead style="background-color: #343a40; color: black; font-weight: bold;">
          <tr><th colspan="2" class="text-center">Output Gap</th></tr>
        </thead>
      </table>
      <div style="flex: 1; overflow-y: auto;">
        <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
          <tbody id="outputGapBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Machine Count Gap Table -->
<div class="col-md-2">
  <div class="persection-container d-flex flex-wrap justify-content-between gap-2">
    <div style="width: 100%; height: 100%; display: flex; flex-direction: column;">
      <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
        <thead style="background-color: #343a40; color: black; font-weight: bold;">
          <tr><th colspan="2" class="text-center">Machine Count Gap</th></tr>
        </thead>
      </table>
      <div style="flex: 1; overflow-y: auto;">
        <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
          <tbody id="machineGapBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>




        <div class="col-md-2">
          <div class="custom-container d-flex flex-wrap justify-content-between gap-2">


          </div>
          
        </div>
       <!-- Actual WT Table -->
<div class="col-md-2">
  <div class="persection-container d-flex flex-wrap justify-content-between gap-2">
    <div style="width: 100%; height: 100%; display: flex; flex-direction: column;">
      <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
        <thead style="background-color: #343a40; color: black; font-weight: bold;">
          <tr><th colspan="2" class="text-center">Actual WT</th></tr>
        </thead>
      </table>
      <div style="flex: 1; overflow-y: auto;">
        <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
          <tbody id="actualWTBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

        <div class="col-md-2">
          <div class="custom-container d-flex flex-wrap justify-content-between gap-2">


          </div>
          
        </div>

      </div>
    </div>






    <!------------------------------------------------------------ DRILL-DOWN PER CATEGORY -ALL PROCESS ------------------------------------------------------------>
    <div class="container-fluid mt-5"></div>
    <div class="col-md-12">
      <div class="custom-title">
        <h5>DRILL-DOWN PER CATEGORY -ALL PROCESS</h5>
      </div>
    </div>

    <div class="container-fluid mt-3">
      <div class="row g-3">
        <div class="col-md-3">
          <div class="custom-container2">
            <!-- Dropdown Menu -->
            <div class="dropdown mb-3 w-100">
              <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false">
                Category Selection
              </button>
              <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                <li><button class="dropdown-item" type="button" onclick="updateDropdownText('Output')">Output</button>
                </li>
                <li><button class="dropdown-item" type="button" onclick="updateDropdownText('Machine Count')">Machine
                    Count</button></li>
                <li><button class="dropdown-item" type="button" onclick="updateDropdownText('JPH')">JPH</button></li>
                <li><button class="dropdown-item" type="button" onclick="updateDropdownText('Actual WT')">Actual
                    WT</button></li>
                <li><button class="dropdown-item" type="button" onclick="updateDropdownText('WIP')">WIP</button></li>
                
              </ul>
            </div>

            <!-- Table Container -->
            <div class="table-responsive">
              <table class="table table-bordered" id="dynamicTable">
                <thead>
                  <!-- Headers will go here -->
                </thead>
                <tbody id="tableBody">
                  <!-- Rows will be inserted here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- 9-column wide -->
        <div class="col-md-9">
          <div class="custom-container2" id="categoryChart">


          </div>
        </div>
      </div>
    </div>













    <!------------------------------------------------------------ DRILL-DOWN PER PROCESS ------------------------------------------------------------>

    <div class="container-fluid mt-5"></div>
    <div class="col-md-12">
      <div class="custom-title">
        <h5>DRILL-DOWN PER PROCESS</h5>
      </div>
    </div>

    <!-- Container Row -->
    <div class="container-fluid mt-3">
      <div class="row g-3">

        <div class="col-md-3">
          <div class="custom-container4" style="position: relative; width: 100%; overflow: visible;">
            <div class="dropdown mb-1 w-100">
              <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="processDropdownButton"
                data-bs-toggle="dropdown" aria-expanded="false"
                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                Process Selection
              </button>
              <ul class="dropdown-menu" aria-labelledby="processDropdownButton"
                style="width: 100%; left: 0; right: auto; box-sizing: border-box;">
                <li><button class="dropdown-item" type="button" onclick="selectProcess('uv_iii', 'UV III')">UV
                    III</button></li>
                <li><button class="dropdown-item" type="button"
                    onclick="selectProcess('arc_welding', 'Arc Welding')">Arc Welding</button></li>
                <li><button class="dropdown-item" type="button"
                    onclick="selectProcess('aluminum_coating_uv_ii', 'Aluminum Coating UV II')">Aluminum Coating UV
                    II</button></li>
                       
                      <li><button class="dropdown-item" type="button"
                    onclick="selectProcess('airbag', 'Airbag')">Airbag
                   </button></li>
              </ul>
            </div>
          </div>
        </div>



        <div class="col-md-9">
          <div class="custom-container4" style="visibility: hidden;"></div>
        </div>







        <div class="col-md-6">
          <div class="custom-container3">
            <h3 class="text-center" style="color: black; font-weight: bold;">OVERALL SUMMARY</h3>
            <table class="table table-bordered text-center">
              <tbody>
                <tr>
                  <th>Target Output</th>
                  <td id="target-output"></td>
                  <th>Actual Output</th>
                  <td id="actual-output"></td>
                  <th>Output Gap</th>
                  <td id="output-gap"></td>
                </tr>
                <tr>
                  <th>Machine Count</th>
                  <td id="machine-count"></td>
                  <th>Actual Machine</th>
                  <td id="actual-machine"></td>
                  <th>Machine Gap</th>
                  <td id="machine-gap"></td>
                </tr>
                <tr>
                  <th>Target JPH</th>
                  <td id="target-jph"></td>
                  <th>Actual JPH</th>
                  <td id="actual-jph"></td>
                  <th>JPH Gap</th>
                  <td id="jph-gap"></td>
                </tr>
                <tr>
                  <th>Actual WT</th>
                  <td id="actual-wt"></td>
                  <th>WIP</th>
                  <td id="wip"></td>
                  <td colspan="2"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>


        <div class="col-md-6">
          <div class="custom-container3" style="height: 100%; display: flex; flex-direction: column;">
            <h3 class="text-center" style="color: black; font-weight: bold; ">
              OVERVIEW OF UNMET CATEGORIES
            </h3>
            <table class="table table-bordered text-center"
              style="flex-grow: 1; width: 100%; table-layout: fixed; height: 100%; border-collapse: separate; border-spacing: 0;">
              <thead>
                <tr>
                  <th style="vertical-align: middle; border-right: 1px solid #dee2e6;">UNMET OUTPUT</th>
                  <th style="vertical-align: middle; border-right: 1px solid #dee2e6;">UNMET MACHINE COUNT</th>
                  <th style="vertical-align: middle;">UNMET JPH</th>
                </tr>
              </thead>
              <tbody style="height: 100%;">
                <tr style="height: 100%;">
                  <td id="unmet-output" style="vertical-align: middle;"></td>
                  <td id="unmet-machine-count" style="vertical-align: middle;"></td>
                  <td id="unmet-jph" style="vertical-align: middle;"></td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>









        <div class="container-fluid mt-4">
          <div class="row g-3">

          <div class="col-md-4">
  <div class="custom-container5">
    <div id="wipChartContainer" ></div>
  </div>
</div>


            <div class="col-md-4">
              <div class="custom-container">

              </div>
            </div>


            <div class="col-md-4">
              <div class="custom-container">

              </div>
            </div>



          </div>
        </div>






        <div class="container-fluid mt-4">
          <div class="row g-3">

            <div class="col-md-6">
              <div class="custom-container">

              </div>
            </div>


            <div class="col-md-6">
              <div class="custom-container">

              </div>
            </div>


          </div>
        </div>



        <div class="container-fluid mt-4">
          <div class="row"> <!-- Add this wrapper -->
            <div class="col-md-6">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 1 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output1"></td>
                      <th>Actual Output</th>
                      <td id="actual-output1"></td>
                      <th>Output Gap</th>
                      <td id="output-gap1"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count1"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine1"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap1"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph1"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph1"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap1"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt1"></td>
                      <th>WIP</th>
                      <td id="wip1"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>



            <div class="col-md-6">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 2 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output2"></td>
                      <th>Actual Output</th>
                      <td id="actual-output2"></td>
                      <th>Output Gap</th>
                      <td id="output-gap2"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count2"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine2"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap2"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph2"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph2"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap2"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt2"></td>
                      <th>WIP</th>
                      <td id="wip2"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>







            <div class="col-md-6 mt-4">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 3 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output3"></td>
                      <th>Actual Output</th>
                      <td id="actual-output3"></td>
                      <th>Output Gap</th>
                      <td id="output-gap3"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count3"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine3"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap3"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph3"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph3"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap3"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt3"></td>
                      <th>WIP</th>
                      <td id="wip3"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-6 mt-4">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 3.1 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output3.1"></td>
                      <th>Actual Output</th>
                      <td id="actual-output3.1"></td>
                      <th>Output Gap</th>
                      <td id="output-gap3.1"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count3.1"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine3.1"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap3.1"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph3.1"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph3.1"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap3.1"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt3.1"></td>
                      <th>WIP</th>
                      <td id="wip3.1"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-6 mt-4">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 4 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output4"></td>
                      <th>Actual Output</th>
                      <td id="actual-output4"></td>
                      <th>Output Gap</th>
                      <td id="output-gap4"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count4"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine4"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap4"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph4"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph4"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap4"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt4"></td>
                      <th>WIP</th>
                      <td id="wip4"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-6 mt-4">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 5 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output5"></td>
                      <th>Actual Output</th>
                      <td id="actual-output5"></td>
                      <th>Output Gap</th>
                      <td id="output-gap5"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count5"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine5"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap5"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph5"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph5"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap5"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt5"></td>
                      <th>WIP</th>
                      <td id="wip5"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>

            <div class="col-md-6 mt-4">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 6 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output6"></td>
                      <th>Actual Output</th>
                      <td id="actual-output6"></td>
                      <th>Output Gap</th>
                      <td id="output-gap6"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count6"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine6"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap6"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph6"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph6"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap6"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt6"></td>
                      <th>WIP</th>
                      <td id="wip6"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>


            <div class="col-md-6 mt-4">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 7 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output7"></td>
                      <th>Actual Output</th>
                      <td id="actual-output7"></td>
                      <th>Output Gap</th>
                      <td id="output-gap7"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count7"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine7"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap7"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph7"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph7"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap7"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt7"></td>
                      <th>WIP</th>
                      <td id="wip7"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>


            <div class="col-md-6 mt-4">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 9 SUMMARY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-output9"></td>
                      <th>Actual Output</th>
                      <td id="actual-output9"></td>
                      <th>Output Gap</th>
                      <td id="output-gap9"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-count9"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machine9"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gap9"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jph9"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jph9"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gap9"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wt9"></td>
                      <th>WIP</th>
                      <td id="wip9"></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>


            <div class="col-md-6 mt-4">
              <div class="custom-container3">
                <h3 class="text-center" style="color: black; font-weight: bold;">BATTERY</h3>
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <th>Target Output</th>
                      <td id="target-outputBattery"></td>
                      <th>Actual Output</th>
                      <td id="actual-outputBattery"></td>
                      <th>Output Gap</th>
                      <td id="output-gapBattery"></td>
                    </tr>
                    <tr>
                      <th>Machine Count</th>
                      <td id="machine-countBattery"></td>
                      <th>Actual Machine</th>
                      <td id="actual-machineBattery"></td>
                      <th>Machine Gap</th>
                      <td id="machine-gapBattery"></td>
                    </tr>
                    <tr>
                      <th>Target JPH</th>
                      <td id="target-jphBattery"></td>
                      <th>Actual JPH</th>
                      <td id="actual-jphBattery"></td>
                      <th>JPH Gap</th>
                      <td id="jph-gapBattery"></td>
                    </tr>
                    <tr>
                      <th>Actual WT</th>
                      <td id="actual-wtBattery"></td>
                      <th>WIP</th>
                      <td id="wipBattery"></td>
                      <td colspan="2"></td>
                    </tr>
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
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <script>



    const container = document.getElementById('sectionButtons');
    container.addEventListener('click', (e) => {
      if (e.target.tagName === 'BUTTON') {
        container.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
        e.target.classList.add('active');
      }
    });




    // -------------------------------------------- Gap -------------------------------------------

    document.getElementById('sectionButtons').addEventListener('click', (e) => {
  if (e.target.tagName === 'BUTTON') {
    const buttons = document.querySelectorAll('#sectionButtons button');
    buttons.forEach(btn => btn.classList.remove('active'));
    e.target.classList.add('active');

    const section = e.target.getAttribute('data-section');

    // Fetch Output Gap
    fetch(`../../process/fetch_gap2.php?section=${section}&type=output`)
      .then(response => response.json())
      .then(data => {
        const tbody = document.getElementById('outputGapBody');
        tbody.innerHTML = '';
        data.forEach(row => {
          tbody.innerHTML += `<tr><td>${row.process}</td><td>${row.gap}</td></tr>`;
        });
      });

    // Fetch Machine Count Gap
    fetch(`../../process/fetch_gap2.php?section=${section}&type=machine`)
      .then(response => response.json())
      .then(data => {
        const tbody = document.getElementById('machineGapBody');
        tbody.innerHTML = '';
        data.forEach(row => {
          tbody.innerHTML += `<tr><td>${row.process}</td><td>${row.gap}</td></tr>`;
        });
      });
      fetch(`../../process/fetch_gap2.php?section=${section}&type=machine`)
      .then(res => res.json())
      .then(data => {
        const tbody = document.getElementById('machineGapBody');
        tbody.innerHTML = '';
        data.forEach(row => {
          tbody.innerHTML += `<tr><td>${row.process}</td><td>${row.gap}</td></tr>`;
        });
      });

    // Actual WT
    fetch(`../../process/fetch_gap2.php?section=${section}&type=actual`)
      .then(res => res.json())
      .then(data => {
        const tbody = document.getElementById('actualWTBody');
        tbody.innerHTML = '';
        data.forEach(row => {
          tbody.innerHTML += `<tr><td>${row.process}</td><td>${row.gap}</td></tr>`;
        });
      });
  }
});
// Empty chart renderer
function renderEmptyChart() {
  Highcharts.chart('wipChartContainer', {
    chart: { type: 'column', height: 400 },
    title: { text: 'Actual JPH - Target JPH per Section' },
    xAxis: {
      categories: ['No Process Selected'],
      crosshair: true,
      title: { text: 'Section' },
      labels: { rotation: -45 }
    },
    yAxis: {
      min: -1,
      max: 1,
      title: { text: 'JPH Difference' },
      plotLines: [{
        color: '#666',
        width: 2,
        value: 0,
        zIndex: 5
      }]
    },
    tooltip: {
      shared: true,
      valueDecimals: 2
    },
    series: [{
      name: 'No Data',
      data: [{ y: 0, color: '#cccccc' }]
    }],
    credits: { enabled: false }
  });
}

// Call it on page load
document.addEventListener('DOMContentLoaded', function () {
  renderEmptyChart();
});

// Your original selectProcess function
function selectProcess(value, label) {
  document.getElementById('processDropdownButton').textContent = label;

  fetch('../../process/fetch_per_process.php?process=' + value)
    .then(response => response.json())
    .then(data => {
      // Update text values
      document.getElementById('target-output').textContent = data.target_output ?? '';
      document.getElementById('actual-output').textContent = data.actual_output ?? '';
      document.getElementById('output-gap').textContent = data.output_gap ?? '';

      document.getElementById('machine-count').textContent = data.machine_count ?? '';
      document.getElementById('actual-machine').textContent = data.actual_machine ?? '0';
      document.getElementById('machine-gap').textContent = data.machine_gap ?? '';

      document.getElementById('target-jph').textContent = data.target_jph ?? '';
      document.getElementById('actual-jph').textContent = data.actual_jph ?? '';
      document.getElementById('jph-gap').textContent = data.jph_gap ?? '';

      document.getElementById('actual-wt').textContent = data.actual_wt ?? '0';
      document.getElementById('wip').textContent = data.wip ?? '';

      const sorted = (data.wip_chart || []).sort((a, b) => b.value - a.value);
      const categories = sorted.map(item => item.section);
      const values = sorted.map(item => ({
        y: item.value,
        color: {
          linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
          stops: item.value < 0
            ? [
                [0, '#cd2100'], // red top
                [1, '#ff6662']  // red bottom
              ]
            : [
                [0, '#12e2ed'], // blue top
                [1, '#0078ff']  // blue bottom
              ]
        }
      }));

      const maxAbsValue = Math.max(
        Math.abs(Math.min(...values.map(v => v.y))),
        Math.abs(Math.max(...values.map(v => v.y)))
      );

      Highcharts.chart('wipChartContainer', {
        chart: { type: 'column', height: 400 },
        title: { text: 'Actual JPH - Target JPH per Section' },
        xAxis: {
          categories,
          crosshair: true,
          title: { text: 'Section' },
          labels: { rotation: -45 }
        },
        yAxis: {
          min: -maxAbsValue,
          max: maxAbsValue,
          title: { text: 'JPH Difference' },
          plotLines: [{
            color: '#666',
            width: 2,
            value: 0,
            zIndex: 5
          }]
        },
        tooltip: {
          shared: true,
          valueDecimals: 2
        },
        series: [{
          name: label,
          data: values
        }],
        credits: { enabled: false }
      });
    })
    .catch(err => console.error('Error fetching data:', err));
}





    document.addEventListener("DOMContentLoaded", () => {
      fetch('../../process/fetch_dashboard_summary.php')
        .then(res => res.json())
        .then(data => {
          const sections = {};

          // Collect data by section and process
          data.forEach(row => {
            const section = row.section;
            const process = row.general_process.trim();
            const value = parseFloat(row.total) || 0;

            if (!sections[section]) sections[section] = {};
            sections[section][process] = value;
          });

          const setText = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.textContent = val.toLocaleString(undefined, { maximumFractionDigits: 2 });
          };

        
          Object.keys(sections).forEach(section => {
            const d = sections[section];

            const targetOutput = parseFloat(d["Target Output (WIP+Plan)"] || 0);
            const actualOutput = parseFloat(d["Actual Output"] || 0);
            const outputGap = targetOutput - actualOutput;

            const machineCount = parseFloat(d["Machine Count"] || 0);
            const actualMachine = parseFloat(d["Actual Machine"] || 0);
            const machineGap = machineCount - actualMachine;

            const targetJPH = parseFloat(d["Target JPH"] || 0);
            const actualJPH = parseFloat(d["Actual JPH"] || 0);
            const jphGap = targetJPH - actualJPH;

            const actualWT = parseFloat(d["Actual WT"] || 0);
            const wip = parseFloat(d["WIP"] || 0);

            setText(`target-output${section}`, targetOutput);
            setText(`actual-output${section}`, actualOutput);
            setText(`output-gap${section}`, outputGap);

            setText(`machine-count${section}`, machineCount);
            setText(`actual-machine${section}`, actualMachine);
            setText(`machine-gap${section}`, machineGap);

            setText(`target-jph${section}`, targetJPH);
            setText(`actual-jph${section}`, actualJPH);
            setText(`jph-gap${section}`, jphGap);

            setText(`actual-wt${section}`, actualWT);
            setText(`wip${section}`, wip);
          });
        })
        .catch(error => {
          console.error("Failed to fetch dashboard summary:", error);
        });
    });

    // --------------------------------------------------------Save and Fetch Data-------------------------------------------------

 
    





    


    // --------------------------------------------------------Drill Down per Category - ALL Process-------------------------------------------------

  function updateDropdownText(selection) {
  const button = document.getElementById("dropdownMenuButton");
  button.innerText = selection;

  const thead = document.querySelector("#dynamicTable thead");
  const tbody = document.getElementById("tableBody");
  const chartContainer = document.getElementById("categoryChart");

  let headers = [];
  let chartCategories = [];

  switch (selection) {
    case "Output":
      headers = ["Section", "Target Output", "Actual Output"];
      break;
    case "Machine Count":
      headers = ["Section", "Machine Count", "Actual Machine"];
      break;
    case "JPH":
      headers = ["Section", "Target JPH", "Actual JPH"];
      break;
    case "Actual WT":
      headers = ["Section", "Actual WT"];
      break;
    case "WIP":
      headers = ["Section", "Actual WIP", "Target WIP"];
      break;
  }

  thead.innerHTML = `<tr>${headers.map(h => `<th>${h}</th>`).join("")}</tr>`;
  tbody.innerHTML = "";

  fetch("../../process/fetch_per_category2.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `category=${encodeURIComponent(selection)}`
  })
    .then(response => response.json())
    .then(data => {
      if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="${headers.length}">No data found</td></tr>`;
        chartContainer.innerHTML = "";
        return;
      }

      let series1 = [], series2 = [], diffSeries = [];
      chartCategories = data.map(row => row.section);

      tbody.innerHTML = "";

      data.forEach(row => {
        let rowHTML = `<td>${row.section}</td>`;

        switch (selection) {
          case "Output":
            const targetOut = Number(row.target_output);
            const actualOut = Number(row.actual_output);
            rowHTML += `<td>${targetOut}</td><td>${actualOut}</td>`;
            series1.push(targetOut);
            series2.push(actualOut);
            diffSeries.push(targetOut - actualOut);
            break;

          case "Machine Count":
            rowHTML += `<td>${row.machine_count}</td><td>${row.actual_machine}</td>`;
            series1.push(Number(row.machine_count));
            series2.push(Number(row.actual_machine));
            break;

          case "JPH":
            const targetJPH = Number(row.target_jph);
            const actualJPH = Number(row.actual_jph);
            rowHTML += `<td>${targetJPH}</td><td>${actualJPH}</td>`;
            series1.push(targetJPH);
            series2.push(actualJPH);
            diffSeries.push(targetJPH - actualJPH);
            break;

          case "Actual WT":
            rowHTML += `<td>${row.actual_wt}</td>`;
            series1.push(Number(row.actual_wt));
            break;

          case "WIP":
            const wipActual = Number(row.wip ?? 0);
            const wipTarget = Number(row.wip_target ?? 0);
            rowHTML += `<td>${wipActual}</td><td>${wipTarget}</td>`;
            series1.push(wipActual);
            series2.push(wipTarget);
            diffSeries.push(wipTarget - wipActual);
            break;
        }

        tbody.innerHTML += `<tr>${rowHTML}</tr>`;
      });

      let chartOptions;

      if (selection === "Output" || selection === "JPH" || selection === "WIP") {
        let maxDiff = Math.max(...diffSeries);
        let minDiff = Math.min(...diffSeries);
        let maxAbs = Math.max(Math.abs(maxDiff), Math.abs(minDiff));

        chartOptions = {
          chart: { type: 'column' },
          title: { text: `${selection} Difference (Target - Actual)` },
          xAxis: {
            categories: chartCategories,
            crosshair: true
          },
          yAxis: {
            min: -maxAbs,
            max: maxAbs,
            title: { text: 'Target - Actual' },
            plotLines: [{
              color: '#666',
              width: 2,
              value: 0,
              zIndex: 5
            }]
          },
          legend: { enabled: false },
          credits: { enabled: false },
          tooltip: {
            formatter: function () {
              const value = this.y;
              return `<b>${this.key}</b><br/>` +
                (value < 0
                  ? `Actual ${selection} exceeded Target by <b>${Math.abs(value)}</b>`
                  : `Target ${selection} exceeded Actual by <b>${value}</b>`);
            }
          },
          plotOptions: {
            column: {
              borderRadius: 5,
              pointWidth: 30,
              colorByPoint: true
            }
          },
          series: [{
            name: 'Target - Actual',
            data: diffSeries.map(value => ({
              y: value,
              color: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: value < 0
                  ? [[0, '#cd2100'], [1, '#ff6662']]
                  : [[0, '#12e2ed'], [1, '#0078ff']]
              }
            }))
          }]
        };

    } else if (selection === "WIP") {
  let maxDiff = Math.max(...diffSeries);
  let minDiff = Math.min(...diffSeries);
  let maxAbs = Math.max(Math.abs(maxDiff), Math.abs(minDiff));

  chartOptions = {
    chart: { type: 'column' },
    title: { text: `WIP Difference (Target - Actual)` },
    xAxis: {
      categories: chartCategories,
      crosshair: true
    },
    yAxis: {
      min: -maxAbs,
      max: maxAbs,
      title: { text: 'Target - Actual' },
      plotLines: [{
        color: '#666',
        width: 2,
        value: 0,
        zIndex: 5
      }]
    },
    legend: { enabled: false },
    credits: { enabled: false },
    tooltip: {
      formatter: function () {
        const value = this.y;
        return `<b>${this.key}</b><br/>` +
          (value < 0
            ? `Actual WIP exceeded Target by <b>${Math.abs(value)}</b>`
            : `Target WIP exceeded Actual by <b>${value}</b>`);
      }
    },
    plotOptions: {
      column: {
        borderRadius: 5,
        pointWidth: 30,
        colorByPoint: true
      }
    },
    series: [{
      name: 'Target - Actual',
      data: diffSeries.map(value => ({
        y: value,
        color: {
          linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
          stops: value < 0
            ? [[0, '#cd2100'], [1, '#ff6662']]
            : [[0, '#12e2ed'], [1, '#0078ff']]
        }
      }))
    }]
  };
}

      Highcharts.chart(chartContainer, chartOptions);
    });
}


  </script>

</body>

</html>