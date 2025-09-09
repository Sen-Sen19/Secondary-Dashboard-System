<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../dist/img/tir-logo.png" type="image/png">
  <title>Secondary Process Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="../../plugins/bootstrap/js/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/css/dashboard.css">

  <!-- Bootstrap CSS -->
  <link href="../../plugins/bootstrap/js/bootstrap.min_2.css" rel="stylesheet" />
  <script src="../../plugins/bootstrap/js/popper.min.js"></script>
  <!-- Bootstrap JS + Popper -->

  <script src="../../plugins/bootstrap/js/bootstrap.min_2.js"></script>




  <style>
    body {
      background-color: rgb(231, 231, 231);
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

    .custom-container5 {
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      height: 400px;

    }

    .custom-containerhalf {
      background-color: rgb(255, 255, 255);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      height: 250px;

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

    button.btn-primary {
      background-color: rgb(255, 255, 255) !important;
      /* no background */
      color: rgb(0, 0, 0) !important;
      /* dark blue text */
      border: 1px solid rgb(255, 255, 255);
      /* dark blue border */
      transition: background-color 0.3s, color 0.3s;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    button.btn-primary:hover {
      background-color: rgb(0, 0, 0);
      color: white;
    }
  </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="../../dist/img/tir-logo.png" alt="Logo">
      <span>Secondary Process Dashboard</span>
    </a>

<div class="d-flex align-items-center">
    <!-- New Button -->
    <a href="/secondary_system/output.php" class="btn btn-outline-light me-2">
     <i class="fas fa-clipboard-list"></i>
    </a>

    <!-- Reload Button -->
    <button class="btn btn-outline-light me-2" onclick="location.reload()">
        <i class="fas fa-sync-alt"></i>
    </button>

    <!-- Back Button -->
    <a href="../../index.php" class="btn btn-outline-light btn-back me-2">
        <i class="fas fa-arrow-right me-1"></i> Back
    </a>
</div>

  </div>
</nav>

  <!-- Division Bar -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 division-bar d-flex justify-content-center align-items-center">
        <span class="text-white" style="font-size: 1.25rem;">OVERALL PROCESS</span>
      </div>
    </div>
  </div>

  <div id="filterChathead">
    <i class="fas fa-calendar-alt" style="color: white; font-size: 20px;"></i>
  </div>


  <div id="filterPanel">
    <div class="container-fluid mt-2">
      <div class="row">
        <div class="col-md-12">
          <form>
            <div class="form-row">
              <div class="form-group col-md-12 text-center">
                <label for="dateInput" class="font-weight-bold d-block">Select Date:</label>
                <input type="date" class="form-control" id="dateInput">
              </div>
            </div>
          </form>


        </div>
      </div>
    </div>
  </div>





  <!-- -----------------------------------------------Overall Process----------------------------------------------->



  <div class="container-fluid mt-3">
    <div class="row g-3">

      <div class="col-md-4">
        <div class="custom-container" id="sectionButtons">
          <button data-section="Overall">Overall</button>
          <button data-section="1">Section 1</button>
          <button data-section="2">Section 2</button>
          <button data-section="3.1">Section 3</button>
          <button data-section="3.1">Section 3.1</button>
          <button data-section="4">Section 4</button>
          <button data-section="5">Section 5</button>
          <button data-section="6">Section 6</button>
          <button data-section="7">Section 7</button>
          <button data-section="8">Section 8</button>


        </div>
      </div>





      <!-- Output Gap Table -->
      <div class="col-md-2">
        <div class="persection-container d-flex flex-wrap justify-content-between gap-2">
          <div style="width: 100%; height: 100%; display: flex; flex-direction: column; overflow-x: hidden;">
            <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
              <thead style="background-color: #343a40; color: black; font-weight: bold;">
                <tr>
                  <th colspan="2" class="text-center">Output Gap</th>
                </tr>
              </thead>
            </table>
            <div style="flex: 1; overflow-y: auto; overflow-x: hidden;">
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
          <div style="width: 100%; height: 100%; display: flex; flex-direction: column; sssoverflow-x: hidden;">
            <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
              <thead style="background-color: #343a40; color: black; font-weight: bold;">
                <tr>
                  <th colspan="2" class="text-center">Machine Count Gap</th>
                </tr>
              </thead>
            </table>
            <div style="flex: 1; overflow-y: auto;overflow-x: hidden;">
              <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
                <tbody id="machineGapBody"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>




          <div class="col-md-2">
        <div class="persection-container d-flex flex-wrap justify-content-between gap-2">
          <div style="width: 100%; height: 100%; display: flex; flex-direction: column;overflow-x: hidden;">
            <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
              <thead style="background-color: #343a40; color: black; font-weight: bold;">
                <tr>
                  <th colspan="2" class="text-center">JPH GAP</th>
                </tr>
              </thead>
            </table>
            <div style="flex: 1; overflow-y: auto;overflow-x: hidden;">
              <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
                <tbody id="jphGapBody"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      
      <!-- Actual WT Table -->
      <div class="col-md-2">
        <div class="persection-container d-flex flex-wrap justify-content-between gap-2">
          <div style="width: 100%; height: 100%; display: flex; flex-direction: column;overflow-x: hidden;">
            <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
              <thead style="background-color: #343a40; color: black; font-weight: bold;">
                <tr>
                  <th colspan="2" class="text-center">Actual WT</th>
                </tr>
              </thead>
            </table>
            <div style="flex: 1; overflow-y: auto;overflow-x: hidden;">
              <table class="table table-bordered me-2" style="width: 100%; table-layout: fixed;">
                <tbody id="actualWTBody"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="col-md-2">
        <div class="custom-container d-flex flex-wrap justify-content-between gap-2">


        </div>

      </div> -->

    </div>
  </div>





  <!-- -----------------------------------------------Drill Down Per Category All Process ----------------------------------------------- -->

  <!-- Division Bar -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 division-bar d-flex justify-content-center align-items-center">
        <span class="text-white" style="font-size: 1.25rem;">DRILL-DOWN PER CATEGORY -ALL PROCESS</span>
      </div>
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












  <!-- -----------------------------------------------DRILL-DOWN PER PROCESS ----------------------------------------------- -->

  <!-- Division Bar -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 division-bar d-flex justify-content-center align-items-center">
        <span class="text-white" style="font-size: 1.25rem;">DRILL-DOWN PER PROCESS</span>
      </div>
    </div>
  </div>



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
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('uv_iii', 'UV-III')">UV-III</button></li>
              <li><button class="dropdown-item" type="button" onclick="selectProcess('arc_welding', 'Arc Welding')">Arc
                  Welding</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('aluminum_coating_uv_ii', 'Aluminum Coating UV II')">Aluminum Coating UV
                  II</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('servo_crimping', 'Servo Crimping')">Servo Crimping</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('ultrasonic_welding', 'Ultrasonic Welding')">Ultrasonic Welding</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('cap_insertion', 'Cap Insertion')">Cap Insertion</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('twisting_primary_aluminum', 'Twisting Primary Aluminum')">Twisting Primary
                  Aluminum</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('twisting_secondary_aluminum', 'Twisting Secondary Aluminum')">Twisting
                  Secondary Aluminum</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('airbag', 'Airbag')">Airbag</button></li>
              <li><button class="dropdown-item" type="button" onclick="selectProcess('a_b_sub_pc', 'A/B Sub PC')">A/B
                  Sub PC</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_insertion_to_connector', 'Manual Insertion to Connector')">Manual
                  Insertion to Connector</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('v_type_twisting', 'V type twisting')">V type twisting</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('twisting_primary', 'Twisting Primary')">Twisting Primary</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('twisting_secondary', 'Twisting Secondary')">Twisting Secondary</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_crimping_2tons', 'Manual Crimping 2Tons')">Manual Crimping
                  2Tons</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_crimping_4tons', 'Manual Crimping 4Tons')">Manual Crimping
                  4Tons</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_crimping_5tons', 'Manual Crimping 5Tons')">Manual Crimping
                  5Tons</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('intermediate_ripping_uas_manual_nf_f', 'Intermediate ripping(UAS)Manual-NF-F')">Intermediate
                  ripping(UAS)Manual-NF-F</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('intermediate_ripping_uas_joint', 'Intermediate ripping (UAS)Joint stripping(KB10)')">Intermediate
                  ripping (UAS)Joint stripping(KB10)</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('intermediate_stripping_kb10', 'Intermediate stripping(KB10)')">Intermediate
                  stripping(KB10)</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('intermediate_stripping_kb10_nsc_weld', 'Intermediatetripping(KB10)NSC/Weld')">Intermediatetripping(KB10)NSC/Weld</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('joint_crimping_2_tons', 'Joint Crimping 2Tons')">Joint Crimping 2Tons</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('joint_crimping_4tons_ps_200', 'Joint Crimping 4Tons(PS-200)')">Joint Crimping
                  4Tons(PS-200)</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('joint_crimping_5tons', 'Joint Crimping 5Tons')">Joint Crimping 5Tons</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_taping_dispenser', 'Manual Taping (Dispenser)')">Manual Taping
                  (Dispenser)</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('joint_taping', 'Joint Taping')">Joint Taping</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('intermediate_welding', 'Intermediate Welding')">Intermediate Welding</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('intermediate_welding_0_13', 'Intermediate Welding 0.13')">Intermediate Welding
                  0.13</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('welding_at_head', 'Welding at Head')">Welding at Head</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('welding_at_head_0_13', 'Welding at Head 0.13')">Welding at Head 0.13</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('silicon_injection', 'Silicon Injection')">Silicon Injection</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('welding_cap_insertion', 'Welding Cap Insertion')">Welding Cap
                  Insertion</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('welding_taping_13mm', 'Welding Taping(13mm)')">Welding Taping(13mm)</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('heat_shrink', 'Heatshrink')">Heatshrink</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('heat_shrink_la_terminal', 'Heat Shrink LA terminal')">Heat Shrink LA
                  terminal</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('heat_shrink_joint_crimping', 'Heat Shrink (Joint Crimping)')">Heat Shrink
                  (Joint Crimping)</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('heat_shrink_welding', 'Heat Shrink (Welding)')">Heat Shrink (Welding)</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('casting_c385', 'Casting C385')">Casting C385</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('stmac_shieldwire_nissan', 'STMAC Shieldwire(Nissan)')">STMAC
                  Shieldwire(Nissan)</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('quick_stripping', 'Quick Stripping')">Quick Stripping</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_heat_shrink_blower_sumitube', 'Manual Heat Shrink(Blower)Sumitube')">Manual
                  Heat Shrink(Blower)Sumitube</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('drainwire_tip', 'Drainwire Tip')">Drainwire Tip</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_crimping_shieldwire', 'Manual Crimping Shieldwire')">Manual Crimping
                  Shieldwire</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('joint_crimping_2_tons_sw', 'Joint Crimping 2TonsSW')">Joint Crimping
                  2TonsSW</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_blue_taping_dispenser_sw', 'Manual Blue Taping(Dispenser)SW')">Manual
                  Blue Taping(Dispenser)SW</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('shieldwire_taping', 'Shieldwire Taping')">Shieldwire Taping</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('hs_components_insertion_sw', 'HS Components Insertion SW')">HS
                  Components Insertion SW</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('heat_shrink_joint_crimping_sw', 'Heat Shrink (Joint Crimping)SW')">Heat Shrink
                  (Joint Crimping)SW</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('waterproof_pad_press', 'Waterproof pad Press')">Waterproof pad Press</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('low_viscosity', 'Low Viscosity')">Low Viscosity</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('air_water_leak_test', 'Air/Water leak test')">Air/Water leak test</button>
              </li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('hirose', 'HIROSE')">HIROSE</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('casting_battery', 'Casting Battery')">Casting Battery</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('stmac_aluminum', 'STMACAluminum')">STMACAluminum</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_crimping_20tons', 'Manual Crimping 20Tons')">Manual Crimping
                  20Tons</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('manual_heat_shrink_blower_battery', 'Manual Heat Shrink (Blower)Battery')">Manual
                  Heat Shrink (Blower)Battery</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('joint_crimping_20tons', 'Joint Crimping 20Tons')">Joint Crimping
                  20Tons</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('dip_soldering_battery', 'Dip Soldering (Battery)')">Dip Soldering
                  (Battery)</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('ultrasonic_dip_soldering_aluminum', 'Ultrasonic Dip SolderingAluminum')">Ultrasonic
                  Dip SolderingAluminum</button></li>
              <li><button class="dropdown-item" type="button" onclick="selectProcess('la_molding', 'LA molding')">LA
                  molding</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('pressure_welding_dome_lamp', 'Pressure Welding(Dome Lamp)')">Pressure
                  Welding(Dome Lamp)</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('ferrule_process', 'Ferrule Process')">Ferrule Process</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('gomusen_insertion', 'Gomusen Insertion')">Gomusen Insertion</button></li>
              <li><button class="dropdown-item" type="button"
                  onclick="selectProcess('point_marking', 'Point Marking')">Point Marking</button></li>


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
           SECTIONS WITH THE MOST UNMENT TARGETS
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
        <div id="outputChartContainer" class="chart-box"></div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="custom-container5">
        <div id="machineCountChartContainer" class="chart-box"></div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="custom-container5">
        <div id="jphChartContainer" class="chart-box"></div>
      </div>
    </div>

  </div>
</div>

<div class="container-fluid mt-4">
  <div class="row g-3">

    <div class="col-md-6">
      <div class="custom-container5">
        <div id="wtChart" class="chart-box"></div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="custom-container5">
        <div id="wipChart" class="chart-box"></div>
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
              <h3 class="text-center" style="color: black; font-weight: bold;">SECTION 8 SUMMARY</h3>
              <table class="table table-bordered text-center">
                <tbody>
                  <tr>
                    <th>Target Output</th>
                    <td id="target-output8"></td>
                    <th>Actual Output</th>
                    <td id="actual-output8"></td>
                    <th>Output Gap</th>
                    <td id="output-gap8"></td>
                  </tr>
                  <tr>
                    <th>Machine Count</th>
                    <td id="machine-count8"></td>
                    <th>Actual Machine</th>
                    <td id="actual-machine8"></td>
                    <th>Machine Gap</th>
                    <td id="machine-gap8"></td>
                  </tr>
                  <tr>
                    <th>Target JPH</th>
                    <td id="target-jph8"></td>
                    <th>Actual JPH</th>
                    <td id="actual-jph8"></td>
                    <th>JPH Gap</th>
                    <td id="jph-gap8"></td>
                  </tr>
                  <tr>
                    <th>Actual WT</th>
                    <td id="actual-wt8"></td>
                    <th>WIP</th>
                    <td id="wip8"></td>
                    <td colspan="2"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>


          <!-- <div class="col-md-6 mt-4">
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
          </div> -->


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








  <!-- -----------------------------------------------ACTUAL JPH And OUTPUT----------------------------------------------->



  <!-- Division Bar -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 division-bar d-flex justify-content-center align-items-center">
        <span class="text-white" style="font-size: 1.25rem;">ACTUAL JPH AND OUTPUT</span>
      </div>
    </div>
  </div>

  <div class="container-fluid mt-3">
    <div class="row g-3">

      <div class="col-md-3">
        <div class="custom-containerhalf d-flex flex-wrap justify-content-between gap-2 p-2">

          <!-- Section Dropdown -->
  <!-- Section Dropdown -->

<select id="sectionSelect" class="form-control">
  <option value="">Select Section:</option>
</select>


          <!-- Process Dropdown -->
          <select name="process" id="process" class="form-select mb-2">
            <option disabled selected value="">Select Process</option>



          </select>
          <!-- Machine No Dropdown -->
          <select name="machine_no" id="machine_no" class="form-select mb-2">
            <option disabled selected value="">Select Machine No</option>

            <!-- Add more machines as needed -->
          </select>


          <!-- Shift Dropdown -->
          <select name="shift" id="shift" class="form-select mb-2">
            <option disabled selected value="">Select Shift</option>
          </select>
        </div>
        <div class="col-md-12 d-flex justify-content-end mt-2">
          <button type="submit" class="btn btn-primary">Generate</button>
        </div>
      </div>


      <div class="col-md-9">
        <div class="custom-container d-flex flex-wrap justify-content-between gap-2">
          <div id="weeklyjphChart" style="width: 100%; height: 350px;"></div>
        </div>
      </div>
      
      <div class="col-md-3" style="visibility: hidden;">
        <div class="custom-container d-flex flex-wrap justify-content-between gap-2"></div>
      </div>

      <div class="col-md-9">
        <div class="custom-container d-flex flex-wrap justify-content-between gap-2">
          <div id="weeklyoutputChart" style="width: 100%; height: 350px;"></div>
        </div>
      </div>
    </div>
  </div>









  <script src="plugins/js/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <script>

document.addEventListener('DOMContentLoaded', function () {
  const sectionSelect   = document.getElementById('sectionSelect');
  const processSelect   = document.getElementById('process');
  const machineNoSelect = document.getElementById('machine_no');
  const shiftSelect     = document.getElementById('shift');
  const dateInput       = document.getElementById('dateInput');
  const generateBtn     = document.querySelector('.btn-primary');
  const actualJPHDisplay = document.getElementById('actualJPHDisplay');

  function resetDropdowns(ids) {
    ids.forEach(id => {
      const sel = document.getElementById(id);
      sel.innerHTML = `<option disabled selected value="">Select ${id.replace('_', ' ').toUpperCase()}</option>`;
    });
  }

  function fetchSectionsByDate(date) {
    fetch(`../../process/dashboard_fetch_section.php?date=${date}`)
      .then(r => r.json())
      .then(data => {
        sectionSelect.innerHTML = '<option value="">Select SECTION</option>';
        resetDropdowns(['process','machine_no','shift']);
        data.forEach(sec => {
          const o = new Option(sec, sec);
          sectionSelect.append(o);
        });
      })
      .catch(console.error);
  }

  function fetchProcesses(date, section) {
    fetch(`../../process/dashboard_fetch_process.php?date=${date}&section=${encodeURIComponent(section)}`)
      .then(r => r.json())
      .then(data => {
        processSelect.innerHTML = '<option disabled selected value="">Select Process</option>';
        resetDropdowns(['machine_no','shift']);
        data.forEach(pr => processSelect.append(new Option(pr, pr)));
      })
      .catch(console.error);
  }

  function fetchMachines(date, section, process) {
    fetch(`../../process/dashboard_fetch_machine.php?date=${date}&section=${encodeURIComponent(section)}&process=${encodeURIComponent(process)}`)
      .then(r => r.json())
      .then(data => {
        machineNoSelect.innerHTML = '<option disabled selected value="">Select Machine No</option>';
        data.forEach(m => machineNoSelect.append(new Option(m, m)));
      })
      .catch(console.error);
  }

  function fetchShifts(date, section, process) {
    fetch(`../../process/dashboard_fetch_shift.php?date=${date}&section=${encodeURIComponent(section)}&process=${encodeURIComponent(process)}`)
      .then(r => r.json())
      .then(data => {
        shiftSelect.innerHTML = '<option disabled selected value="">Select Shift</option>';
        data.forEach(s => shiftSelect.append(new Option(s, s)));
      })
      .catch(console.error);
  }

  // Init
  const today = new Date().toISOString().slice(0,10);
  dateInput.value = today;
  fetchSectionsByDate(today);

  // Listeners
  dateInput.addEventListener('change', e => fetchSectionsByDate(e.target.value));

  sectionSelect.addEventListener('change', () => {
    fetchProcesses(dateInput.value, sectionSelect.value);
  });

  processSelect.addEventListener('change', () => {
    const d = dateInput.value, s = sectionSelect.value, p = processSelect.value;
    if (d && s && p) {
      fetchMachines(d, s, p);
      fetchShifts(d, s, p);
    }
  });
generateBtn.addEventListener('click', () => {
  const d  = dateInput.value;
  const s  = sectionSelect.value;
  const p  = processSelect.value;
  const m  = machineNoSelect.value;
  const sh = shiftSelect.value;

  if (!s && !d && !p && !m && !sh) {
    alert("Please select at least one filter (e.g., section)");
    return;
  }

  const url = `../../process/dashboard_fetch_actual_jph.php?` +
              `date=${encodeURIComponent(d)}` +
              `&section=${encodeURIComponent(s)}` +
              `&process=${encodeURIComponent(p)}` +
              `&machine_no=${encodeURIComponent(m)}` +
              `&shift=${encodeURIComponent(sh)}`;

  fetch(url)
    .then(r => r.json())
    .then(({ actual_jph, actual_output }) => {
      console.log('Actual JPH:', actual_jph);
      console.log('Actual Running Output:', actual_output);
    fetchWeeklyChartData(d, s, p, m, sh); // draw the chart

    })
    .catch(console.error);
});

});
// Function to fetch 7-day history of Actual JPH and Output
function fetchWeeklyChartData(date, section, process, machine, shift) {
  const url = `../../process/dashboard_fetch_weekly_data.php?` +
              `date=${encodeURIComponent(date)}` +
              `&section=${encodeURIComponent(section)}` +
              `&process=${encodeURIComponent(process)}` +
              `&machine_no=${encodeURIComponent(machine)}` +
              `&shift=${encodeURIComponent(shift)}`;

  fetch(url)
    .then(res => res.json())
    .then(({ dates, actual_jph, actual_output }) => {
      renderHighchart('weeklyjphChart', 'JPH Average (Last 7 Days)', dates, actual_jph, '#1E90FF');
      renderHighchart('weeklyoutputChart', 'Total Actual Output (Last 7 Days)', dates, actual_output, '#28a745');
    }) 
    .catch(console.error);
}

// Render highchart
function renderHighchart(containerId, title, categories, data, color) {
  Highcharts.chart(containerId, {
    chart: {
      type: 'area'
    },
    title: {
      text: title
    },
    xAxis: {
      categories: categories,
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Value'
      }
    },
    series: [{
      name: title,
      data: data,
      color: color
    }]
  });
}


    // -----------------------------------------------Select Date-----------------------------------------------


    let today = new Date().toISOString().slice(0, 10);
    const dateInput = document.getElementById('dateInput');

    dateInput.value = today;
    console.log(dateInput.value);

    // Listen for changes and update value + log it
    dateInput.addEventListener('change', (event) => {
      const selectedDate = event.target.value;
      console.log(selectedDate);
      // If you want to explicitly update the value (though it's automatic), you can do:
      dateInput.value = selectedDate;

    });
    // -----------------------------------------------Fetch-----------------------------------------------

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
        fetch("../../process/fetch_summary.php")
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









    // -----------------------------------------------Overall Process-----------------------------------------------
    document.addEventListener('DOMContentLoaded', () => {
      const dateInput = document.getElementById('dateInput');
      // Initialize date input to today if empty
      if (!dateInput.value) {
        dateInput.value = new Date().toISOString().split('T')[0];
      }

      // Listen for date changes and trigger refresh for the active section
      dateInput.addEventListener('change', () => {
        // Find currently active button, if any
        const activeBtn = document.querySelector('#sectionButtons button.active');
        if (activeBtn) {
          activeBtn.click(); // reuse click handler to refresh tables with new date
        }
      });
    });

    document.getElementById('sectionButtons').addEventListener('click', (e) => {
      if (e.target.tagName === 'BUTTON') {
        // Deactivate all buttons, activate clicked one
        const buttons = document.querySelectorAll('#sectionButtons button');
        buttons.forEach(btn => btn.classList.remove('active'));
        e.target.classList.add('active');

        const section = e.target.getAttribute('data-section');

        // Use date input or fallback to today
        let selectedDate = document.getElementById('dateInput').value || new Date().toISOString().split('T')[0];
        document.getElementById('dateInput').value = selectedDate; // sync UI

        // Helper: build URL with cache buster
        const buildURL = (type) =>
          `../../process/fetch_gap.php?section=${encodeURIComponent(section)}&type=${type}&date=${selectedDate}&_=${Date.now()}`;

        // Helper: fetch and populate table body
        const updateTable = (url, tbodyId) => {
          fetch(url)
            .then(response => {
              if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
              return response.json();
            })
            .then(data => {
              const tbody = document.getElementById(tbodyId);
              tbody.innerHTML = '';
              if (data.error) {
                tbody.innerHTML = `<tr><td colspan="2">${data.error}</td></tr>`;
                return;
              }
              data.forEach(row => {
                tbody.innerHTML += `<tr><td>${row.process}</td><td>${row.gap}</td></tr>`;
              });
            })
            .catch(err => {
              console.error(`Failed to fetch ${tbodyId} data:`, err);
              document.getElementById(tbodyId).innerHTML = `<tr><td colspan="2">No data available.</td></tr>`;
            });
        };

        // Update all relevant tables on button click
// Update all relevant tables on button click
updateTable(buildURL('output'), 'outputGapBody');
updateTable(`../../process/fetch_gap2.php?section=${encodeURIComponent(section)}&date=${selectedDate}&_=${Date.now()}`, 'machineGapBody');
updateTable(buildURL('actual'), 'actualWTBody');
updateTable(buildURL('jph'), 'jphGapBody');   // ✅ NEW LINE

      }
    });






    // -----------------------------------------------DRILL-DOWN PER CATEGORY -ALL PROCESS-----------------------------------------------


    // Global selectedDate initialized with today's date
    let selectedDate = new Date().toISOString().slice(0, 10);


    const dropdownButton = document.getElementById("dropdownMenuButton");

    // Initialize date input value
    dateInput.value = selectedDate;

    // Update selectedDate when date input changes, then refresh the dropdown view
    dateInput.addEventListener('change', (event) => {
      selectedDate = event.target.value;
      console.log("Date changed to:", selectedDate);
      // Refresh dropdown table/chart with current dropdown selection text
      updateDropdownText(dropdownButton.innerText);
    });

    // Update dropdown button text and refresh data when dropdown selection changes
    function updateDropdownText(selection) {
      const button = dropdownButton;
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
          headers = ["Section", "Actual WIP"];
          break;

        default:
          thead.innerHTML = "";
          tbody.innerHTML = "";
          chartContainer.innerHTML = "";
          return; // no valid selection, exit early
      }

      thead.innerHTML = `<tr>${headers.map(h => `<th>${h}</th>`).join("")}</tr>`;
      tbody.innerHTML = "";

      fetch("../../process/fetch_per_category.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `category=${encodeURIComponent(selection)}&date=${encodeURIComponent(selectedDate)}`
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
                rowHTML += `<td>${row.wt}</td>`;
                series1.push(Number(row.wt));
                break;

              case "WIP":
                const actualWIP = Number(row.wip ?? 0);
                const targetWIP = 0; // Define this as 0 or actual target if available
                const diffWIP = targetWIP - actualWIP; // Negative if actual is higher (bad)

                rowHTML += `<td>${actualWIP}</td>`;
                series1.push(actualWIP);      // Optional: for other charts
                diffSeries.push(diffWIP);     // For the difference chart
                break;

            }

            tbody.innerHTML += `<tr>${rowHTML}</tr>`;
          });

          // Chart options based on selection
      let chartOptions;

if (["Output", "JPH"].includes(selection)) {
  // Flip logic: Actual - Target
  let diffSeriesFlipped = series2.map((actual, i) => actual - series1[i]);

  let maxDiff = Math.max(...diffSeriesFlipped);
  let minDiff = Math.min(...diffSeriesFlipped);
  let maxAbs = Math.max(Math.abs(maxDiff), Math.abs(minDiff));

  chartOptions = {
    chart: { type: 'column' },
    title: { text: `${selection} Difference (Actual - Target)` },
    xAxis: {
      categories: chartCategories,
      crosshair: true,
      title: {
        text: 'Section',
        style: {
          fontWeight: 'bold',
          color: '#333'
        }
      }
    },
    yAxis: {
      min: -maxAbs,
      max: maxAbs,
      title: { text: 'Actual - Target' },
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
          (value > 0
            ? `Actual ${selection} exceeded Target by <b>${value}</b>`
            : `Target ${selection} exceeded Actual by <b>${Math.abs(value)}</b>`);
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
      name: 'Actual - Target',
      data: diffSeriesFlipped.map(value => ({
        y: value,
        color: {
          linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
          stops: value > 0
            ? [[0, '#12e2ed'], [1, '#0078ff']]  // Actual > Target → Up (Blue)
            : [[0, '#cd2100'], [1, '#ff6662']]  // Target > Actual → Down (Red)
        }
      }))
    }]
  };

} else if (selection === "WIP") {
  const minY = Math.min(0, ...series1);
  const maxY = Math.max(0, ...series1);
  const maxAbs = Math.max(Math.abs(minY), Math.abs(maxY));

  chartOptions = {
    chart: { type: 'column' },
    title: { text: `Actual WIP per Section` },
    xAxis: {
      categories: chartCategories,
      crosshair: true,
      title: {
        text: 'Section',
        style: {
          fontWeight: 'bold',
          color: '#333'
        }
      }
    },
    yAxis: {
      min: -maxAbs,
      max: maxAbs,
      title: { text: 'Calculated WIP Value' },
      plotLines: [{ color: '#030100', width: 1, value: 0 }]
    },
    tooltip: {
      formatter: function () {
        const value = this.y;
        return `<b>${this.key}</b><br/>WIP: <b>${value}</b>`;
      }
    },
    plotOptions: {
      column: {
        borderRadius: 5,
        pointWidth: 30,
        colorByPoint: false
      }
    },
    series: [{
      name: 'Actual WIP',
      data: series1.map(value => ({
        y: value,
        color: {
          linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
          stops: value < 0
            ? [[0, '#cd2100'], [1, '#ff6662']] // Red gradient
            : [[0, '#12e2ed'], [1, '#0078ff']] // Blue gradient
        }
      }))
    }],
    credits: { enabled: false },
    legend: { enabled: false }
  };
} else if (selection === "Machine Count") {
  // Calculate difference Actual - Expected Machine Count
  let diffMachines = series2.map((actual, i) => actual - series1[i]);
  let maxDiff = Math.max(...diffMachines);
  let minDiff = Math.min(...diffMachines);
  let maxAbs = Math.max(Math.abs(maxDiff), Math.abs(minDiff));

  chartOptions = {
    chart: { type: 'column' },
    title: { text: 'Machine Count Difference (Actual - Expected)' },
    xAxis: {
      categories: chartCategories,
      crosshair: true,
      title: {
        text: 'Section',
        style: { fontWeight: 'bold', color: '#333' }
      }
    },
    yAxis: {
      min: -maxAbs,
      max: maxAbs,
      title: { text: 'Actual - Expected' },
      plotLines: [{ color: '#666', width: 2, value: 0, zIndex: 5 }]
    },
    tooltip: {
      formatter: function () {
        return `<b>${this.key}</b><br/>` +
          (this.y > 0
            ? `Actual Machine Count exceeded Expected by <b>${this.y}</b>`
            : `Expected Machine Count exceeded Actual by <b>${Math.abs(this.y)}</b>`);
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
      name: 'Actual - Expected',
      data: diffMachines.map(value => ({
        y: value,
        color: {
          linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
          stops: value > 0
            ? [[0, '#12e2ed'], [1, '#0078ff']]   // Positive → Blue
            : [[0, '#cd2100'], [1, '#ff6662']]   // Negative → Red
        }
      }))
    }],
    credits: { enabled: false },
    legend: { enabled: false }
  };


} else if (selection === "Actual WT") {
  const minY = Math.min(0, ...series1);
  const maxY = Math.max(0, ...series1);

  chartOptions = {
    chart: { type: 'column' },
    title: { text: `Actual Working Time per Section` },
    xAxis: {
      categories: chartCategories,
      crosshair: true,
      title: {
        text: 'Section',
        style: {
          fontWeight: 'bold',
          color: '#333'
        }
      }
    },
    yAxis: {
      min: 0,
      max: maxY,
      title: { text: 'Actual WT' },
      plotLines: [{ color: '#000', width: 1, value: 0 }]
    },
    tooltip: {
      formatter: function () {
        return `<b>${this.key}</b><br/>WT: <b>${this.y}</b>`;
      }
    },
    plotOptions: {
      column: {
        borderRadius: 5,
        pointWidth: 30,
        colorByPoint: false
      }
    },
    series: [{
      name: 'Actual WT',
      data: series1.map(value => ({
        y: value,
        color: {
          linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
          stops: [[0, '#12e2ed'], [1, '#0078ff']]
        }
      }))
    }],
    credits: { enabled: false },
    legend: { enabled: false }
  };
}

if (chartOptions) Highcharts.chart(chartContainer, chartOptions);

        });
    }

    // Initialize placeholder chart on DOM ready
    document.addEventListener("DOMContentLoaded", () => {
      Highcharts.chart('categoryChart', {
        chart: { type: 'column' },
        title: { text: 'Select a Category to Display Chart' },
        xAxis: { categories: [] },
        yAxis: {
          min: -10,
          max: 10,
          plotLines: [{ color: '#000', width: 1, value: 0 }],
          title: { text: null }
        },
        series: [{
          name: 'Placeholder',
          data: []
        }],
        credits: { enabled: false }
      });

      // fetch("../../process/fetch_overall_summary.php")
      //   .then(response => {
      //     if (!response.ok) throw new Error("Network response was not ok");
      //     return response.text();
      //   })
      //   .then(data => {
      //     console.log("Fetched data:", data);
      //   })
      //   .catch(error => {
      //     console.error("Fetch error:", error);
      //   });

      // Optionally, trigger initial load for default dropdown text
      updateDropdownText(dropdownButton.innerText);
    });

    // Also, make sure your dropdown items call updateDropdownText when clicked, for example:
    // <a class="dropdown-item" href="#" onclick="updateDropdownText('Output')">Output</a>
    // etc.

















    // -----------------------------------------------DRILL-DOWN PER PROCESS-----------------------------------------------
let selectedProcess = '';
let selectedLabel = '';

// ✅ Wait until DOM is ready before initializing anything
document.addEventListener('DOMContentLoaded', () => {
  renderEmptyChart('outputChartContainer', 'Select a process to load Output data');
  renderEmptyChart('machineCountChartContainer', 'Select a process to load Machine Count data');
  renderEmptyJphChart();
  renderEmptyChart('wipChart', 'No WIP data available');
  renderEmptyChart('wtChart', 'No WT data available');

  const dateInput = document.getElementById('dateInput');
  if (dateInput) {
    dateInput.addEventListener('change', () => {
      if (selectedProcess) fetchAndRender(selectedProcess, selectedLabel);
    });
  }
});
function fetchUnmetOutput() {
  const date = document.getElementById('dateInput').value;

  fetch(`../../process/fetch_per_process2.php?section=${selectedLabel}&date=${date}`)
    .then(r => r.json())
    .then(data => {
      const bigStyle = "font-size:40px; font-weight:bold; color:#ff2222;";
      if (data.length > 0) {
        safeSetHTML('unmet-output', `<span style="${bigStyle}">${data[0].section}</span>`);
        const listHTML = data.map(d => `${d.section}: ${d.gap}`).join('<br/>');
        safeSetHTML('unmet-output-list', `<div style="${bigStyle}">${listHTML}</div>`);
      } else {
        safeSetHTML('unmet-output', '—');
        safeSetHTML('unmet-output-list', '—');
      }
    })
    .catch(err => {
      console.error('Error fetching unmet output:', err);
      safeSetHTML('unmet-output', '—');
      safeSetHTML('unmet-output-list', '—');
    });
}
function fetchAndRender(process, label) {
  const date = document.getElementById('dateInput').value;

  fetch(`../../process/fetch_per_process.php?process=${process}&date=${date}`)
    .then(r => r.json())
    .then(data => {
      const bigStyle = "font-size:40px; font-weight:bold; color:#ff2222;";

      // --- Overall Summary ---
      safeSetText('target-output', data.target_output);
      safeSetText('actual-output', data.actual_output);
      safeSetText('output-gap', data.output_gap);
      safeSetText('machine-count', data.machine_count);
      safeSetText('actual-machine', data.actual_machine ?? '0');
      safeSetText('machine-gap', data.machine_gap);
      safeSetText('target-jph', data.target_jph);
      safeSetText('actual-jph', data.actual_jph);
      safeSetText('jph-gap', data.jph_gap);
      safeSetText('actual-wt', data.wt_overall ?? '0');
      safeSetText('wip', data.wip);

      // --- Sections with Most Unmet Targets ---
      safeSetHTML('unmet-output', `<span style="${bigStyle}">${data.top_unmet?.output ?? '—'}</span>`);
      safeSetHTML('unmet-jph', `<span style="${bigStyle}">${data.top_unmet?.jph ?? '—'}</span>`);

      // ✅ Fix: Add 'Section ' prefix to unmet machine count
      if (data.top_unmet?.machine) {
        safeSetHTML('unmet-machine-count', `<span style="${bigStyle}">Section ${data.top_unmet.machine}</span>`);
      } else {
        safeSetHTML('unmet-machine-count', '—');
      }

      // ✅ Fix: Add 'Section ' prefix to machine list
      if (data.top_unmet?.machine_list) {
        const listWithSection = data.top_unmet.machine_list
          .split(' ')
          .map(s => 'Section ' + s)
          .join(' ');
        safeSetHTML('unmet-machine-list', `<div style="${bigStyle}">${listWithSection}</div>`);
      } else {
        safeSetHTML('unmet-machine-list', '—');
      }

      // --- Render Charts ---
      renderWipChart(data.previous_wip);
      renderWtChart(data.wt);

      // JPH chart
      const wipChartData = Array.isArray(data.wip_chart) ? data.wip_chart : [];
      const sorted = wipChartData.sort((a, b) => b.value - a.value);
      if (sorted.length === 0) renderEmptyJphChart();
      else {
        const cats = sorted.map(i => i.section);
        const vals = sorted.map(i => ({
          y: i.value,
          color: i.value < 0
            ? { linearGradient: { x1:0,y1:0,x2:0,y2:1 }, stops:[[0,'#cd2100'],[1,'#ff6662']] }
            : { linearGradient: { x1:0,y1:0,x2:0,y2:1 }, stops:[[0,'#12e2ed'],[1,'#0078ff']] }
        }));
        const maxAbs = Math.max(...vals.map(v => Math.abs(v.y)), 1);
        renderChart('jphChartContainer', {
          type: 'column',
          title: `JPH Status per Section (${label})`,
          categories: cats,
          yTitle: 'JPH Difference',
          seriesName: 'JPH Diff',
          data: vals,
          min: -maxAbs,
          max: maxAbs
        });
      }

      fetchUnmetOutput(selectedLabel);

      // Output chart
      renderOutputChart(data.output_chart, label);

      // ✅ Fix: Read correct key from PHP
      const machineData = Array.isArray(data.machine_list) ? data.machine_list : [];
      renderMachineChart(machineData, label);

    })
    .catch(e => {
      console.error('Fetch error:', e);
      renderEmptyJphChart();
      renderEmptyChart('outputChartContainer','Error loading data');
      renderEmptyChart('machineCountChartContainer','Error loading data');
    });
}


// ✅ Process Selection
function selectProcess(value, label) {
  selectedProcess = value;
  selectedLabel = label;
  const btn = document.getElementById('processDropdownButton');
  if (btn) btn.textContent = label;
  fetchAndRender(value, label);
}

// ✅ Safe DOM updates
function safeSetText(id, value) { const el = document.getElementById(id); if(el) el.textContent = value ?? ''; }
function safeSetHTML(id, value) { const el = document.getElementById(id); if(el) el.innerHTML = value ?? ''; }

// ✅ Generic chart renderer
function renderChart(containerId, { type, title, categories, yTitle, seriesName, data, min, max }) {
  const container = document.getElementById(containerId);
  if (!container) return console.warn(`Container #${containerId} not found.`);
  Highcharts.chart(containerId, {
    chart:{ type:type||'column', height:400 },
    title:{ text:title||'' },
    xAxis:{ categories:categories||[], crosshair:true, labels:{ rotation:-45 }},
    yAxis:{ min:min??0, max:max??null, title:{ text:yTitle||'' }, plotLines:[{color:'#666', width:2, value:0, zIndex:5}]},
    tooltip:{ shared:true, valueDecimals:2 },
    series:[{ name:seriesName||'Data', data:data||[] }],
    credits:{ enabled:false }
  });
}

// ✅ Empty JPH chart
function renderEmptyJphChart() { renderEmptyChart('jphChartContainer', 'Select a process to load JPH data'); }
function renderEmptyChart(containerId, titleText) {
  renderChart(containerId, { type:'column', title:titleText, categories:[], yTitle:'Value', seriesName:'No data', data:[] });
}

// ✅ WIP Chart
function renderWipChart(wipData) {
  const sorted = (wipData||[]).sort((a,b)=>b.value-a.value);
  const cats = sorted.map(i=>i.section);
  const vals = sorted.map(i=>({y:i.value,color:{linearGradient:{x1:0,y1:0,x2:0,y2:1},stops:[[0,'#12e2ed'],[1,'#0078ff']]}}));
  renderChart('wipChart',{type:'bar',title:sorted.length?'WIP (Previous Day) per Section':'No WIP data available',categories:cats,yTitle:'WIP Quantity',seriesName:'WIP',data:vals});
}

// ✅ WT Chart
function renderWtChart(wtData) {
  const sorted = (wtData||[]).sort((a,b)=>b.value-a.value);
  const cats = sorted.map(i=>i.section);
  const vals = sorted.map(i=>({y:i.value,color:{linearGradient:{x1:0,y1:0,x2:0,y2:1},stops:[[0,'#f39c12'],[1,'#d35400']]}}));
  renderChart('wtChart',{type:'bar',title:sorted.length?'Actual WT per Section':'No WT data available',categories:cats,yTitle:'WT Value',seriesName:'WT',data:vals});
}

// ✅ Output Chart
function renderOutputChart(outputData, label) {
  if(!outputData||outputData.length===0){ renderEmptyChart('outputChartContainer','No Output data available'); return; }
  const chartValues = outputData.map(i=>({y:i.actual-i.target,section:i.section,color:(i.actual-i.target)<0?{linearGradient:{x1:0,y1:0,x2:0,y2:1},stops:[[0,'#cd2100'],[1,'#ff6662']]}:{linearGradient:{x1:0,y1:0,x2:0,y2:1},stops:[[0,'#12e2ed'],[1,'#0078ff']]}}));
  const categories = chartValues.map(i=>i.section);
  const maxAbs = Math.max(...chartValues.map(v=>Math.abs(v.y)));
  renderChart('outputChartContainer',{type:'column',title:`Output Difference per Section (${label})`,categories,categories,yTitle:'Actual - Target',seriesName:'Output Diff',data:chartValues,min:-maxAbs,max:maxAbs});
}
// ✅ Machine Count Chart
function renderMachineChart(machineData, label) {
  if (!machineData || machineData.length === 0) {
    renderEmptyChart('machineCountChartContainer', 'No Machine data available');
    return;
  }

  // Map values and ensure numeric
  const chartValues = machineData.map(i => {
    const actual = Number(i.actual_machine) || 0;
    const target = Number(i.target_machine_count) || 0;
    const diff = actual - target;

    return {
      y: diff,
      section: i.section,
      running: actual,
      total: target,
      color: diff < 0
        ? { linearGradient: { x1:0, y1:0, x2:0, y2:1 }, stops:[[0,'#cd2100'],[1,'#ff6662']] }
        : { linearGradient: { x1:0, y1:0, x2:0, y2:1 }, stops:[[0,'#12e2ed'],[1,'#0078ff']] }
    };
  });

  const categories = chartValues.map(i => i.section);
  const maxAbs = Math.max(...chartValues.map(v => Math.abs(v.y)), 1); // fallback 1 to avoid 0 range

  Highcharts.chart('machineCountChartContainer', {
    chart: { type: 'column', height: 400 },
    title: { text: `Machine Gap per Section (${label})` },
    xAxis: { categories, crosshair: true, labels: { rotation: -45 } },
    yAxis: { 
      min: -maxAbs, 
      max: maxAbs, 
      title: { text: 'Actual - Target Machines' }, 
      plotLines: [{color:'#666', width:2, value:0, zIndex:5}]
    },
    tooltip: {
      formatter: function() {
        return `<b>Section: ${this.point.section}</b><br/>
                Actual: ${this.point.running}<br/>
                Target: ${this.point.total}<br/>
                Gap: ${this.point.y}`;
      }
    },
    series: [{
      name: 'Machine Diff',
      data: chartValues
    }],
    credits: { enabled: false }
  });
}




    // -----------------------------------------------Dashboard Summary-----------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const dateInput = document.getElementById('dateInput');
  const today = new Date().toISOString().slice(0, 10);
  dateInput.value = today;

  const metrics = [
    'target-output', 'actual-output', 'output-gap',
    'machine-count', 'actual-machine', 'machine-gap',
    'target-jph', 'actual-jph', 'jph-gap',
    'actual-wt', 'wip'
  ];

  function setText(id, val) {
    const el = document.getElementById(id);
    if (el) el.textContent = val;
  }

  function clearDashboard() {
    const sections = ['1', '2', '3', '3.1', '4', '5', '6', '7', '8', '9'];
    sections.forEach(section => {
      metrics.forEach(metric => {
        setText(`${metric}${section}`, '0');
      });
    });
  }

  function fetchAndRender(date) {
    clearDashboard();

    fetch(`../../process/fetch_dashboard_summary.php?date=${date}`)
      .then(res => res.json())
      .then(data => {
        console.log("Fetched data:", data); // 🔹 DEBUG

        if (!data || data.length === 0) return;

        const sections = {};

        data.forEach(row => {
          // ✅ Normalize section ID to digits only (e.g., "Section 1" → "1")
          const sectionId = (row.section.match(/\d+(\.\d+)?/) || [row.section])[0];
          const process = row.general_process.trim();
          const value = parseFloat(row.total) || 0;

          if (!sections[sectionId]) sections[sectionId] = {};
          sections[sectionId][process] = value;
        });

        console.log("Processed sections:", sections); // 🔹 DEBUG

        Object.keys(sections).forEach(section => {
          const d = sections[section];
          const fmt = (v) => v.toLocaleString(undefined, { maximumFractionDigits: 2 });

          const targetOutput = parseFloat(d["Target Output (WIP+Plan)"] || 0);
          const actualOutput = parseFloat(d["Actual Output"] || 0);
          const machineCount = parseFloat(d["Machine Count"] || 0);
          const actualMachine = parseFloat(d["Actual Machine"] || 0);
          const targetJPH = parseFloat(d["Target JPH"] || 0);
          const actualJPH = parseFloat(d["Actual JPH"] || 0);
          const actualWT = parseFloat(d["Actual WT"] || 0);
          const wip = parseFloat(d["WIP"] || 0);

          const outputGap = targetOutput - actualOutput;
          const machineGap = machineCount - actualMachine;
          const jphGap = targetJPH - actualJPH;

          setText(`target-output${section}`, fmt(targetOutput));
          setText(`actual-output${section}`, fmt(actualOutput));
          setText(`output-gap${section}`, fmt(outputGap));

          setText(`machine-count${section}`, fmt(machineCount));
          setText(`actual-machine${section}`, fmt(actualMachine)); // ✅ NOW SHOWS CORRECT VALUE
          setText(`machine-gap${section}`, fmt(machineGap));

          setText(`target-jph${section}`, fmt(targetJPH));
          setText(`actual-jph${section}`, fmt(actualJPH));
          setText(`jph-gap${section}`, fmt(jphGap));

          setText(`actual-wt${section}`, fmt(actualWT));
          setText(`wip${section}`, fmt(wip));
        });
      })
      .catch(err => {
        console.error(err);
        clearDashboard();
      });
  }

  fetchAndRender(today);

  dateInput.addEventListener('change', (event) => {
    fetchAndRender(event.target.value);
  });
});

  </script>
  <?php include 'plugins/js/dashboard_script.php'; ?>
</body>

</html>