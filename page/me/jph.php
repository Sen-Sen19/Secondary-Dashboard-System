<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/me_bar.php'; ?>

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
                    </h3>
                    <div class="info" style="display: none;">
                        <span class="d-block"
                            id="username"><?= htmlspecialchars(strtoupper($_SESSION['username'])); ?></span>
                    </div>

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
                                        <th>Process</th>
             
                                        <th>JPH</th>
      

                                        <th>Last Updated</th>
                                        <th>IP Address </th>
                                    </tr>
                                </thead>
                                <tbody id="planTableBody">
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
    </section>
</div>





<script>
   document.addEventListener('DOMContentLoaded', function () {
    fetchPlanData();
});

function fetchPlanData() {
    fetch(`../../process/fetch_jph.php`)
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
                    <td>${row.process}</td>
                    <td>${row.jph}</td>
                    <td>${row.last_updated}</td>
                    <td>${row.ip_address}</td>
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
function exportPlan() {
    const table = document.getElementById("planTable");
    let csvContent = "";

    // Get headers, excluding last 2 columns
    const headers = table.querySelectorAll("thead th");
    const headerCount = headers.length;
    const headerRow = Array.from(headers)
        .slice(0, headerCount - 2)
        .map(th => `"${th.innerText.trim()}"`)
        .join(",");
    csvContent += headerRow + "\r\n";

    // Get body rows, excluding last 2 columns
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(row => {
        const cols = row.querySelectorAll("td");
        const rowData = Array.from(cols)
            .slice(0, cols.length - 2)
            .map(td => `"${td.innerText.trim()}"`)
            .join(",");
        csvContent += rowData + "\r\n";
    });

    // Trigger file download
    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = `jph_export_${new Date().toISOString().slice(0, 10)}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a)
}


    function triggerFileInput() {
        document.getElementById("csvFile").click();
    }

    // Handle the file upload when the user selects a file
document.getElementById('csvFile').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        let formData = new FormData();
        formData.append('csv', file);

        // Send the file to PHP using AJAX
        fetch('../../process/import_jph.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
              Swal.fire({
    title: 'Success!',
    text: data,
    icon: 'success',
    showConfirmButton: false,
    timer: 1500 // Auto-close after 1.5 seconds
}).then(() => {
    location.reload();
});

            })
            .catch(error => {
                console.error('Error uploading file:', error);
Swal.fire({
    title: 'Success!',
    text: data,
    icon: 'success',
    showConfirmButton: false,
}).then(() => {
    // Reload the page after SweetAlert closes
    location.reload();
});

            });
    }
});

</script>



<?php include 'plugins/me_footer.php'; ?>