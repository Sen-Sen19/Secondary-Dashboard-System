<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/user_bar.php'; ?>
<style>
    .editable-input {
        width: 80px;
        /* Set the desired width */
        max-width: 100px;
        /* Optionally, add a max-width if you don't want them to expand too much */
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="col-sm-12">
            <div class="card card-gray-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-object-ungroup"></i> Section
                    </h3>
                    <div class="info">
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
                        <!-- <div class="col-md-2 d-flex justify-content-center">

                          
                            <button class="btn btn-primary custom-btn" id="generateBtn"
                                style="height: 35px; width: 100%;">
                                <i class="fas fa-cogs mr-2"></i>Compute
                            </button>

                        </div> -->
                        <div id="loading" style="display: none;">Loading...</div>
                    </div>

                    <div id="planTb" class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                        <table id="planTable" class="table table-sm table-head-fixed text-nowrap table-hover"
                            style="width: 100%; text-align: center;">
                            <thead>
                                <tr>
                                    <th>Process</th>
                                    <th>Machine No</th>
                                    <th>Specifications</th>
                                    <th>Manpower</th>
                                    <th>Skill Level</th>
                                    <th>WIP</th>

                                    <th>Target JPH</th>
                                    <th>Target Output</th>
                                    <th>Details</th>
                                    <!-- Day Shift (7 AM to 6 PM) -->
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>16</th>
                                    <th>17</th>
                                    <th>18</th>

                                    <!-- Night Shift Late (7 PM to 6 AM) -->
                                    <th>19</th>
                                    <th>20</th>
                                    <th>21</th>
                                    <th>22</th>
                                    <th>23</th>
                                    <th>24</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>



                                    <th>Daily Result</th>
                                </tr>
                            </thead>
                            <tbody id="planTableBody">
                                <!-- Data will be inserted here dynamically -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<script>

    document.addEventListener("DOMContentLoaded", function () {
        var username = document.getElementById('username').textContent.trim();

        function fetchData() {
            fetch('../../process/fetch_section_data2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'username=' + encodeURIComponent(username)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    const tableBody = document.getElementById('planTableBody');
                    tableBody.innerHTML = ''; // clear table
                    data.sort((a, b) => {
    // Compare by shift (nsds) first
    if (a.nsds < b.nsds) return -1;
    if (a.nsds > b.nsds) return 1;

    // Then by process
    if (a.process < b.process) return -1;
    if (a.process > b.process) return 1;

    // Then by manpower
    if (a.manpower < b.manpower) return -1;
    if (a.manpower > b.manpower) return 1;

    return 0; // all equal
});


                    const detailPriority = {
                        "Actual JPH": 1,
                        "Target Running Output": 2,
                        "Actual Running Output": 3
                    };

                    // Group by key
                    const groupedData = {};
                    data.forEach(row => {
                        const key = `${row.process}|${row.machine_no}|${row.manpower}`;
                        if (!groupedData[key]) groupedData[key] = [];
                        groupedData[key].push(row);
                    });

                    // Sort each group by details priority
                    Object.keys(groupedData).forEach(key => {
                        groupedData[key].sort((a, b) => {
                            return (detailPriority[a.details] || 999) - (detailPriority[b.details] || 999);
                        });
                    });
                    const sortedData = [];
                    Object.values(groupedData).forEach(group => {
                        sortedData.push(...group);
                    });

                    const groupedCounts = {};
                    sortedData.forEach(row => {
                        const key = `${row.process}|${row.machine_no}|${row.manpower}`;
                        groupedCounts[key] = (groupedCounts[key] || 0) + 1;
                    });

                    const groupRendered = {};
                    const manpowerStripeMap = {};
                    let stripeToggle = false;

                    sortedData.forEach(row => {
                        const key = `${row.process}|${row.machine_no}|${row.manpower}`;
                        const isFirst = !groupRendered[key];

                        if (!manpowerStripeMap[row.manpower]) {
                            stripeToggle = !stripeToggle;
                            manpowerStripeMap[row.manpower] = stripeToggle ? '#ffffff' : '#f9f9f9';
                        }
                        const bgColor = manpowerStripeMap[row.manpower];

                        const tr = document.createElement('tr');
                        tr.style.backgroundColor = bgColor;

                        if (isFirst) {
                            const rowspan = groupedCounts[key];

                            tr.innerHTML += `<td rowspan="${rowspan}" style="text-align:center; vertical-align:middle;">${row.process}</td>`;
                            tr.innerHTML += `<td rowspan="${rowspan}" style="text-align:center; vertical-align:middle;">${row.machine_no}</td>`;
                            tr.innerHTML += `<td rowspan="${rowspan}" style="text-align:center; vertical-align:middle;">${row.specifications}</td>`;
                            tr.innerHTML += `<td rowspan="${rowspan}" style="text-align:center; vertical-align:middle;">${row.manpower}</td>`;
                            tr.innerHTML += `<td rowspan="${rowspan}" style="text-align:center; vertical-align:middle;">${row.skill_level}</td>`;

                            const targetJphContent = `<input type="number" value="${row.target_jph}" class="editable-input" data-type="target_jph" data-process="${row.process}" data-machine_no="${row.machine_no}" data-section="${row.manpower}" />`;
                            const targetOutputContent = `<input type="number" value="${row.target_output}" class="editable-input" data-type="target_output" data-process="${row.process}" data-machine_no="${row.machine_no}" data-section="${row.manpower}" />`;
                            const wipContent = `<input type="number" value="${row.wip}" class="editable-input" data-type="wip" data-process="${row.process}" data-machine_no="${row.machine_no}" data-section="${row.manpower}" />`;

                            tr.innerHTML += `<td rowspan="${rowspan}" style="text-align:center; vertical-align:middle;">${wipContent}</td>`;
                            tr.innerHTML += `<td rowspan="${rowspan}" style="text-align:center; vertical-align:middle;">${targetJphContent}</td>`;
                            tr.innerHTML += `<td rowspan="${rowspan}" style="text-align:center; vertical-align:middle;">${targetOutputContent}</td>`;
                        }

                        tr.innerHTML += `<td>${row.details}</td>`;

                        const hourlyColumns = [
                            7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, // Day shift
                            19, 20, 21, 22, 23, 24,                     // Night shift (late)
                            1, 2, 3, 4, 5, 6                            // Night shift (early)
                        ];
                        hourlyColumns.forEach(h => {
    const shift = row.nsds;
    const hourEditable = (() => {
        if (row.details !== "Actual JPH") return false; // editable only for Actual JPH
        if (shift === "Dayshift") return h >= 7 && h <= 18;
        if (shift === "Nightshift") return (h >= 19 && h <= 24) || (h >= 1 && h <= 6);
        return false;
    })();

    let hourlyValue = row['h' + h];
    let tdStyle = '';

    // Color red if details is Target Running Output and hourly value >= target_output
    if (row.details === "Target Running Output" && Number(hourlyValue) >= Number(row.target_output)) {
        tdStyle = 'style="color:red"';
    }

    const hourlyContent = hourEditable
        ? `<input type="number" 
                  value="${hourlyValue}" 
                  class="editable-input" 
                  data-type="hourly" 
                  data-h="${h}" 
                  data-process="${row.process}" 
                  data-machine_no="${row.machine_no}" 
                  data-section="${row.manpower}" />`
        : hourlyValue;

    tr.innerHTML += `<td ${tdStyle}>${hourlyContent}</td>`;
});


                        tr.innerHTML += `<td style="color:green">${row.daily_result}</td>`;
                        tableBody.appendChild(tr);

                        groupRendered[key] = true;
                    });


                    // Reattach listeners to inputs
                    document.querySelectorAll('.editable-input').forEach(input => {
                        input.addEventListener('keydown', function (e) {
                            if (e.key === 'Enter') {
                                const inputData = {
                                    process: this.dataset.process,
                                    machine_no: this.dataset.machine_no,
                                    section: this.dataset.section,
                                    type: this.dataset.type,
                                    h: this.dataset.h,
                                    value: this.value
                                };

                                saveData(inputData);
                            }
                        });
                    });

                })
                .catch(error => {
                    alert('Error fetching data: ' + error.message);
                });
        }

        fetchData();

        function saveData(inputData) {
            fetch('../../process/update_value2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(inputData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data saved successfully!');
                        fetchData();
                    } else {
                        alert('Insertion failed. Please assign manpower first.');
                        // location.reload();
                    }
                })
                .catch(error => {
                    alert('Insertion failed. Please assign manpower first.');
                    // location.reload();
                });
        }
    });



</script>

<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/js/user_script.php'; ?>