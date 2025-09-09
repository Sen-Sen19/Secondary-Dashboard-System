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


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="col-sm-12">
            <div class="card card-gray-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i> Plan
                    
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
                    <div class="row mb-4">
                       



                        <div class="col-md-3">
                            <label for="searchInput" >Product</label>
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
    <button class="btn btn-success w-100" onclick="searchTable()">
        <i class="fas fa-search"></i> Search
    </button>
</div>

<div class="col-md-2 d-flex align-items-end">
    <input type="file" id="csvFile" class="d-none" accept=".csv" />
    <button class="btn btn-primary w-100" onclick="triggerFileInput()">
        <i class="fas fa-file-import"></i> Import
    </button>
</div>

<div class="col-md-2 d-flex align-items-end">
    <button class="btn btn-secondary w-100" onclick="exportPlan()">
        <i class="fas fa-file-export"></i> Export
    </button>
</div>

               
                    <div id="planTb" class="table-responsive">
                        <table id="planTable" class="table table-sm table-head-fixed text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th>Main Product</th>
                                    <th>Product</th>
                                    <th>Plan</th>
                                    <th>Section</th>
                                    <th>Block</th>

                                    <th>Last Updated</th>
                              
                                    
                                </tr>
                            </thead>
                            <tbody id="planTableBody">
                                <!-- Dynamic rows go here -->
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </section>
</div>





<script>


const username = document.getElementById("username").textContent.trim();
console.log("Username from DOM:", username);

fetch('../../process/admin_get_shift_section.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({ username: username })
})
.then(res => res.json())
.then(data => {
  console.log("Response from server:", data);
})
.catch(err => console.error("Fetch error:", err));





// -------------------------------------------Fetch-------------------------------------------
document.addEventListener('DOMContentLoaded', function () {
    fetchPlanData();
});

function fetchPlanData() {
const username = "<?= $_SESSION['username'] ?>";


    fetch(`../../process/fetch_overall_plan.php?username=${username}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("planTableBody");
            tbody.innerHTML = "";

            if (data.error) {
                tbody.innerHTML = `<tr><td colspan="7">${data.error}</td></tr>`;
                return;
            }

            data.forEach(row => {
                const tr = document.createElement("tr");

                tr.innerHTML = `
                    <td>${row.main_product}</td>
                    <td>${row.product}</td>
                    <td>${row.plan}</td>
                    <td>${row.section}</td>
                    <td>${row.block}</td>
                    <td>${row.last_updated}</td>
                  
                `;

                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error("Error fetching plan data:", error);
            const tbody = document.getElementById("planTableBody");
            tbody.innerHTML = `<tr><td colspan="7">Error loading data</td></tr>`;
        });
}



// -------------------------------------------Export-------------------------------------------
function exportPlan() {
    const table = document.getElementById("planTable");
    let csvContent = "";

    // Get headers (exclude 4th and 6th columns: indexes 3 and 5)
    const headers = table.querySelectorAll("thead th");
    const headerRow = Array.from(headers)
        .filter((_, index) => index !== 3 && index !== 5)
        .map(th => `"${th.innerText.trim()}"`)
        .join(",");
    csvContent += headerRow + "\r\n";

    // Get body rows (exclude 4th and 6th columns)
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(row => {
        const cols = row.querySelectorAll("td");
        const rowData = Array.from(cols)
            .filter((_, index) => index !== 3 && index !== 5)
            .map(td => `"${td.innerText.trim()}"`)
            .join(",");
        csvContent += rowData + "\r\n";
    });

    // Trigger file download
    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = `plan_export_${new Date().toISOString().slice(0,10)}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}


// -------------------------------------------Import-------------------------------------------
function triggerFileInput() {
    document.getElementById("csvFile").click();
}

document.getElementById('csvFile').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (event) {
        const csvContent = event.target.result;
        const lines = csvContent.trim().split('\n');
        const firstRow = lines[0].split(',');

        // Check if the first row has exactly 4 columns
        if (firstRow.length !== 4) {
            Swal.fire({
                title: 'Invalid CSV Format!',
                text: 'Please import valid Plan Format',
                icon: 'error',
                showConfirmButton: true
            });
            return;
        }

        const username = document.getElementById("username").textContent.trim();

        fetch('../../process/admin_get_shift_section.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username })
        })
        .then(res => res.json())
        .then(data => {
            const rawSection = data.section || '';
            const cleanSection = rawSection.replace(/[^0-9.]/g, '');


            const formData = new FormData();
            formData.append('csv', file);
            formData.append('username', username);
            formData.append('section', cleanSection);
            formData.append('shift', data.shift);

            return fetch('../../process/import_plan.php', {
                method: 'POST',
                body: formData
            });
        })
        .then(response => response.text())
        .then(result => {
            Swal.fire({
                title: 'Success!',
                text: result,
                icon: 'success',
                showConfirmButton: false,
                timer: 600
            });
            setTimeout(() => location.reload(), 700);
        })
        .catch(err => {
            console.error("Upload error:", err);
            Swal.fire({
                title: 'Error!',
                text: 'Upload failed.',
                icon: 'error',
                showConfirmButton: false,
                timer: 500
            });
        });
    };

    reader.readAsText(file);
});


    // -------------------------------------------Search-------------------------------------------
    function searchTable() {
    const searchInput = document.getElementById("searchInput").value.toLowerCase(); // Get search input and convert to lowercase
    const table = document.getElementById("planTable");
    const rows = table.querySelectorAll("tbody tr"); // Get all table rows in the body

    rows.forEach(row => {
        const productCell = row.cells[1]; // Get the 'Product' column (index 1)
        const productText = productCell.textContent.toLowerCase(); // Convert the product text to lowercase

        if (productText.indexOf(searchInput) !== -1) {
            row.style.display = ''; // Show row if it matches the search
        } else {
            row.style.display = 'none'; // Hide row if it doesn't match the search
        }
    });
}
</script>




<?php include 'plugins/admin_footer.php'; ?>

