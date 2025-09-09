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

    .shift-toggle {
    display: flex;
    width: 100px;
    height: 38px;

    overflow: hidden;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
    cursor: pointer;
    border: 2px solid #ccc;
    margin-bottom: 20px; 
}

.shift-half {
    flex: 1;
    text-align: center;
    line-height: 38px;
    font-weight: bold;
    transition: all 0.3s ease;
    color: #000;
}

/* Initial state: Yellow right, Purple left */
#shiftA {
    background-color: #4B0082; /* Purple = Night */
    color: white;
}

#shiftB {
    background-color: #FFD700; /* Yellow = Day */
    color: black;
}
.shift_modal-body {
  display: flex;
  flex-direction: column;
  align-items: center; /* horizontal center */
  justify-content: center; /* vertical center */
  min-height: 200px; /* or adjust as needed */
}

  #feList .text-truncate {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }


  #referenceModal .modal-body {
    background-color: #f8f9fa;
  }
</style>



<div id="loadingSpinner"
    style="display: none; position: fixed; z-index: 9999; top: 50%; left: 50%; transform: translate(-60%, -60%)">
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
                        <li class="breadcrumb-item active">Manpower</li>
                        
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
                                <i class="fas fa-table"></i> Manpower 
                                
   <input type="date" id="dateInput" style="display:none;" />
   <div class="info">
                        <span class="d-block"
                            id="username"><?= htmlspecialchars(strtoupper($_SESSION['username'])); ?></span>
                    </div>
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

                             
                             <div class="col-md-2 d-flex justify-content-center">
<button class="btn btn-primary custom-btn" id="generateBtn"
    data-toggle="modal" data-target="#shiftModal"
    style="height: 35px; width: 100%;">
    <i class="fas fa-cogs mr-2"></i>Generate 
</button>
</div>
   <!-- Export Button -->
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-secondary custom-btn" id="exportBtn"
                                        style="height: 35px; width: 100%;">
                                        <i class="fas fa-file-export mr-2"></i>Export
                                    </button>
                                </div>
                                <!-- Import Button -->
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-warning custom-btn" id="importBtn" data-toggle="modal"
                                        data-target="#importModal" style="height: 35px; width: 100%;">
                                        <i class="fas fa-file-import mr-2"></i>Import
                                    </button>
                                </div>

                             
<!-- Shift Toggle -->




<div class="col-md-2 d-flex justify-content-center">
    <button class="btn btn-info custom-btn" id="referenceBtn"
        data-toggle="modal" data-target="#referenceModal"
        style="height: 35px; width: 100%;">
        <i class="fas fa-book-open mr-2"></i>
        Reference
    </button>
</div>



                            </div>

                            <div id="manpower_tb" class="table-responsive">
                                <table id="scTable" class="table table-sm table-head-fixed text-nowrap table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Skill Level</th>
                                            <th>Section</th>
                                            <th>Process</th>
                                            <th>Machine No</th>
                                            <th>Shift</th>
                              
                             

                                        </tr>
                                    </thead>
                                    <tbody id="mpBody">

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
<!-- Shift Modal -->
<div class="modal fade" id="shiftModal" tabindex="-1" role="dialog" aria-labelledby="shiftModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="shiftModalLabel">Select Shift Type</h5>
        <button type="button"class="close text-white"  data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body text-center">
        <div id="shiftToggle" class="my-3 p-3 rounded" style="cursor:pointer; width: 150px; margin: auto; font-weight: bold;">
          Loading...
        </div>
        <!-- <p>
          <span class="badge" style="background-color: #FFD700; color: black;">Day Shift</span> |
          <span class="badge" style="background-color: purple; color: white;">Night Shift</span>
        </p> -->
        <button class="btn btn-success mt-3" id="generateShiftBtn">
          <i class="fas fa-cogs mr-2"></i>Apply Shift
        </button>
        <div id="loadingSpinner" style="display: none;">Loading...</div>
      </div>
    </div>
  </div>
</div>

<!-- Reference Modal -->
<div class="modal fade" id="referenceModal" tabindex="-1" role="dialog" aria-labelledby="referenceModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 95vw;">

    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="referenceModalLabel"><i class="fas fa-book-open mr-2"></i>Process Reference</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
  <div class="container-fluid">
    <div class="row" id="feList">
      <!-- JS-generated columns will go here -->
    </div>
  </div>
</div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>



<script>
document.addEventListener("DOMContentLoaded", function () {
const copyToClipboard = (text, btn) => {
  const textarea = document.createElement('textarea');
  textarea.value = text;
  textarea.setAttribute('readonly', '');
  textarea.style.position = 'absolute';
  textarea.style.left = '-9999px';
  document.body.appendChild(textarea);

  textarea.select();
  textarea.setSelectionRange(0, text.length); // for mobile compatibility

  try {
    const successful = document.execCommand('copy');
    if (successful) {
      console.log('✅ Copied:', text);
      btn.textContent = 'Copied!';
      setTimeout(() => { btn.textContent = 'Copy'; }, 1500);
    } else {
      console.error('❌ execCommand reported failure.');
    }
  } catch (err) {
    console.error('❌ Copy failed:', err);
  }

  document.body.removeChild(textarea);
};


  const fallbackCopy = (text, btn) => {
    const textarea = document.createElement("textarea");
    textarea.value = text;
    textarea.setAttribute("readonly", "");
    textarea.style.position = "absolute";
    textarea.style.left = "-9999px";
    document.body.appendChild(textarea);

    const selectAndCopy = () => {
      textarea.select();
      textarea.setSelectionRange(0, text.length); // Just in case
      try {
        const successful = document.execCommand("copy");
        if (successful) {
          console.log('Copied using fallback execCommand:', text);
          btn.textContent = 'Copied!';
          setTimeout(() => { btn.textContent = 'Copy'; }, 1500);
        } else {
          console.error('Fallback execCommand failed.');
        }
      } catch (err) {
        console.error('Fallback copy error:', err);
      }
      document.body.removeChild(textarea);
    };

    // Delay to avoid modal stealing focus
    setTimeout(selectAndCopy, 10);
  };

  $('#referenceModal').on('show.bs.modal', function () {
    const feList = document.getElementById('feList');
    feList.innerHTML = '<div class="col-12 text-center py-3">Loading...</div>';

    fetch('../../process/fetch_fe_name.php')
      .then(response => response.json())
      .then(data => {
        if (!Array.isArray(data)) {
          feList.innerHTML = '<div class="col-12 text-danger text-center">Error loading data.</div>';
          return;
        }

        data.sort((a, b) => a.localeCompare(b));
        feList.innerHTML = '';
        const chunkSize = 10;
        const totalChunks = Math.ceil(data.length / chunkSize);

        for (let i = 0; i < totalChunks; i++) {
          const colDiv = document.createElement('div');
          colDiv.className = 'col-lg-3 col-md-4 col-sm-6 mb-4';

          const card = document.createElement('div');
          card.className = 'border rounded p-3 h-100 shadow-sm bg-white';

          const header = document.createElement('h6');
          header.textContent = `Group ${i + 1}`;
          header.className = 'text-primary fw-bold mb-3 text-center';
          card.appendChild(header);

          for (let j = 0; j < chunkSize; j++) {
            const index = i * chunkSize + j;
            if (index >= data.length) break;

            const fe = data[index];

            const itemRow = document.createElement('div');
            itemRow.className = 'mb-2 d-flex justify-content-between align-items-center';

    const feInput = document.createElement('input');
feInput.type = 'text';
feInput.className = 'form-control form-control-sm me-2';
feInput.value = fe;
feInput.setAttribute('readonly', '');
feInput.style.flex = '1';

// Style cleanup for no border + white bg
feInput.style.border = 'none';
feInput.style.backgroundColor = 'white';
feInput.style.boxShadow = 'none';
feInput.style.outline = 'none';
feInput.style.padding = '0';
feInput.style.margin = '0';
feInput.style.fontSize = '0.9rem';
feInput.style.color = '#000';


const copyBtn = document.createElement('button');
copyBtn.className = 'btn btn-sm btn-outline-primary';
copyBtn.textContent = 'Copy';
copyBtn.addEventListener('click', function () {
  feInput.select();
  feInput.setSelectionRange(0, fe.length); // For mobile
  try {
    const success = document.execCommand('copy');
    if (success) {
      console.log('Copied:', fe);
      copyBtn.textContent = 'Copied!';
      setTimeout(() => { copyBtn.textContent = 'Copy'; }, 1500);
    } else {
      console.error('execCommand failed');
    }
  } catch (err) {
    console.error('execCommand error:', err);
  }
});




         itemRow.appendChild(feInput);

            itemRow.appendChild(copyBtn);
            card.appendChild(itemRow);
          }

          colDiv.appendChild(card);
          feList.appendChild(colDiv);
        }
      })
      .catch(() => {
        feList.innerHTML = '<div class="col-12 text-danger text-center">Failed to fetch data.</div>';
      });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const username = document.getElementById("username").textContent.trim();
  const shiftToggle = document.getElementById('shiftToggle');
  const loadingSpinner = document.getElementById('loadingSpinner');

  let userShiftKey = null;        // "A" or "B"
  let currentShiftType = 'Dayshift'; // default

  // 1. Fetch user's assigned shift (A or B)
  fetch('../../process/admin_get_shift_section.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username })
  })
  .then(res => res.json())
  .then(data => {
    console.log("Fetched Shift:", data);

    userShiftKey = data.shift?.trim().toUpperCase(); // "A" or "B"
    currentShiftType = 'Dayshift'; // start with default

    updateToggleDisplay();
  })
  .catch(err => {
    console.error("Fetch error:", err);
    shiftToggle.textContent = "Error loading shift";
    shiftToggle.style.backgroundColor = 'gray';
  });

  // 2. Toggle UI
  function updateToggleDisplay() {
    shiftToggle.textContent = currentShiftType;
    if (currentShiftType === 'Dayshift') {
      shiftToggle.style.backgroundColor = '#FFD700';
      shiftToggle.style.color = 'black';
    } else {
      shiftToggle.style.backgroundColor = '#4B0082';
      shiftToggle.style.color = 'white';
    }
  }

  shiftToggle.addEventListener('click', () => {
    currentShiftType = (currentShiftType === 'Dayshift') ? 'Nightshift' : 'Dayshift';
    updateToggleDisplay();
  });

  // 3. Send updated shift to server
  document.getElementById('generateShiftBtn').addEventListener('click', () => {
    if (!userShiftKey || !currentShiftType) return;

    loadingSpinner.style.display = 'block';

    const payload = {
      username,
      shifts: {
        [userShiftKey]: currentShiftType
      }
    };

    console.log("Final Payload:", payload); // 🔍 debug output

    fetch('../../process/update_shift.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
      Swal.fire({
        icon: 'success',
        title: data.message || 'Shift updated!',
        showConfirmButton: false,
        timer: 2000,
        didClose: () => location.reload()
      });
    })
    .catch(error => {
      console.error("Update error:", error);
      Swal.fire({
        icon: 'error',
        title: 'Failed to update shift.',
        showConfirmButton: false,
        timer: 2000
      });
    })
    .finally(() => {
      loadingSpinner.style.display = 'none';
    });
  });
});



// ---------------------------------------fetch------------------------------------
document.addEventListener("DOMContentLoaded", () => {
    const tbody = document.getElementById("mpBody");
    const spinner = document.getElementById("loadingSpinner");

    const username = document.getElementById("username").textContent.trim();
    spinner.style.display = "block";

    // Step 1: Get shift and section from server
    fetch('../../process/admin_get_shift_section.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: username })
    })
    .then(res => res.json())
    .then(user => {
        if (user.error) throw new Error(user.error);

        const shift = user.shift;
        const rawSection = user.section.replace(/^Section\s+/i, ''); // Moved inside

        // Step 2: Use shift and cleaned-up section to fetch manpower
        return fetch(`../../process/fetch_manpower.php?section=${encodeURIComponent(rawSection)}&shift=${encodeURIComponent(shift)}`);
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data.length > 0) {
            let rows = '';
            data.data.forEach(row => {
                rows += `<tr>
                    <td>${row.emp_no}</td>
                    <td>${row.full_name}</td>
                    <td>${row.skill_level}</td>
                    <td>${row.section}</td>
                    <td>${row.process}</td>
                    <td>${row.machine_no}</td>
                    <td>${row.shift}</td>
                </tr>`;
            });
            tbody.innerHTML = rows;
        } else {
            tbody.innerHTML = `<tr><td colspan="7">No data found for your shift and section.</td></tr>`;
            console.warn("No data:", data);
        }
        spinner.style.display = "none";
    })
    .catch(error => {
        tbody.innerHTML = `<tr><td colspan="7">Failed to load data</td></tr>`;
        console.error("Error:", error);
        spinner.style.display = "none";
    });
});







// -------------------------------------import----------------------------------------------
document.getElementById("importBtn").addEventListener("click", function () {
    const input = document.createElement("input");
    input.type = "file";
    input.accept = ".csv";

    input.onchange = async () => {
        const file = input.files[0];
        if (!file) return;

        // ✅ STEP 1: Read the text content of the CSV
        const textContent = await file.text();

        // ✅ STEP 2: Validate column count
        const lines = textContent.trim().split('\n');
        const firstRow = lines[0].split(',');

        if (firstRow.length !== 7) {
            Swal.fire({
                title: "Invalid CSV Format",
                text: "Please import valid CSV file.",
                icon: "error",
                showConfirmButton: true
            });
            return; // ⛔ stop further execution
        }

        // ✅ STEP 3: Proceed to upload if valid
        const formData = new FormData();
        formData.append("csv_file", file);

        document.getElementById("loadingSpinner").style.display = "block";

        try {
            const res = await fetch("../../process/import_manpower.php", {
                method: "POST",
                body: formData
            });

            const text = await res.text();
            document.getElementById("loadingSpinner").style.display = "none";

            const hasSkippedRows = text.toLowerCase().includes("skipped rows") ||
                                   text.toLowerCase().includes("process '") ||
                                   text.toLowerCase().includes("invalid");

            if (hasSkippedRows) {
                Swal.fire({
                    title: "Import Completed with Warnings",
                    html: `<pre style="text-align:left; max-height:200px; overflow:auto;">${text}</pre>`,
                    icon: "warning",
                    showConfirmButton: true,
                    timerProgressBar: true,
                    willClose: () => location.reload()
                });
            } else {
                Swal.fire({
                    title: "Import Done!",
                    text: text,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => location.reload()
                });
            }
        } catch (err) {
            document.getElementById("loadingSpinner").style.display = "none";
            Swal.fire({
                title: "Error!",
                text: "Something went wrong during import.",
                icon: "error",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                willClose: () => location.reload()
            });
        }
    };

    input.click();
});







    // -----------------------------------------------------------Export -----------------------------------------------------------

    document.getElementById('exportBtn').addEventListener('click', () => {
  const table = document.getElementById('scTable');
  const rows = table.querySelectorAll('tr');
  let csvContent = '';

  rows.forEach(row => {
    // Get all cells, both th and td
    const cols = row.querySelectorAll('th, td');
    const rowData = [];

    cols.forEach(col => {
      // Escape any quotes and wrap content in quotes
      let data = col.innerText.replace(/"/g, '""');
      rowData.push(`"${data}"`);
    });

    csvContent += rowData.join(',') + '\n';
  });

  // Create a blob and trigger download
  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;

  // Filename with date stamp for style points
  const dateStr = new Date().toISOString().slice(0, 10);
  a.download = `Manpower_${dateStr}.csv`;
  document.body.appendChild(a);
  a.click();

  // Clean up
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
});




document.addEventListener("DOMContentLoaded", function () {
  
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
  let today = new Date().toISOString().slice(0, 10);
  document.getElementById('dateInput').value = today;

    document.addEventListener("DOMContentLoaded", function () {
  
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
});
</script>


<?php include 'plugins/admin_footer.php'; ?>


</body>

</html>