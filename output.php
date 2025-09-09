<?php
include 'process/conn.php';

// Determine month/year/process from GET, default to current
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$selectedProcess = isset($_GET['process']) ? $_GET['process'] : null;

// Fetch distinct processes from DB
$processes = [];
$processQuery = "SELECT DISTINCT [process] FROM [secondary_dashboard_db].[dbo].[section_backup] ORDER BY [process]";
$stmtProcess = sqlsrv_query($conn, $processQuery);
if ($stmtProcess === false) {
    die(print_r(sqlsrv_errors(), true));
}
while ($row = sqlsrv_fetch_array($stmtProcess, SQLSRV_FETCH_ASSOC)) {
    $processes[] = $row['process'];
}

// Default to first process if none selected
if (!$selectedProcess && count($processes) > 0) {
    $selectedProcess = $processes[0];
}

// --- Fetch distinct years from DB ---
$years = [];
$yearQuery = "SELECT DISTINCT YEAR([date]) AS year FROM [secondary_dashboard_db].[dbo].[section_backup] ORDER BY year";
$stmtYear = sqlsrv_query($conn, $yearQuery);
if ($stmtYear === false) die(print_r(sqlsrv_errors(), true));

while ($row = sqlsrv_fetch_array($stmtYear, SQLSRV_FETCH_ASSOC)) {
    $years[] = (int)$row['year'];
}

// If the selected year is not in DB, default to first available year
if (!in_array($year, $years)) {
    $year = $years[0] ?? date('Y');
}

// Get first and last date of selected month
$startDate = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-01";
$endDate = date("Y-m-t", strtotime($startDate));

// Fetch all sections (regardless of process)
$sectionsQuery = "SELECT DISTINCT [section] FROM [secondary_dashboard_db].[dbo].[section_backup] ORDER BY [section]";
$sectionsResult = sqlsrv_query($conn, $sectionsQuery);
if ($sectionsResult === false) die(print_r(sqlsrv_errors(), true));

$allSections = [];
while ($row = sqlsrv_fetch_array($sectionsResult, SQLSRV_FETCH_ASSOC)) {
    $allSections[] = $row['section'];
}

// SQL query for the selected process
$sql = "
WITH Calendar AS (
    SELECT CAST('$startDate' AS DATE) AS cal_date
    UNION ALL
    SELECT DATEADD(DAY, 1, cal_date)
    FROM Calendar
    WHERE cal_date < '$endDate'
),
Shifts AS (
    SELECT 'Dayshift' AS shift
    UNION ALL
    SELECT 'Nightshift'
),
Sections AS (
    SELECT DISTINCT [section]
    FROM [secondary_dashboard_db].[dbo].[section_backup]
    WHERE process = ?
)
SELECT
    s.[section],
    COALESCE(SUM(b.[daily_result]), 0) AS total_output,
    c.cal_date AS [date],
    sh.shift
FROM Sections s
CROSS JOIN Calendar c
CROSS JOIN Shifts sh
LEFT JOIN [secondary_dashboard_db].[dbo].[section_backup] b
    ON b.[section] = s.[section]
    AND b.[date] = c.cal_date
    AND b.[nsds] = sh.shift
    AND b.[process] = ?
GROUP BY
    s.[section],
    c.cal_date,
    sh.shift
ORDER BY
    c.cal_date,
    s.[section],
    sh.shift
OPTION (MAXRECURSION 0);
";

$params = [$selectedProcess, $selectedProcess];
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Fetch data
$data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = [
        'section' => $row['section'],
        'date' => $row['date']->format('Y-m-d'),
        'shift' => $row['shift'],
        'total' => (int)$row['total_output']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Section Shift Dashboard</title>
<link rel="icon" type="image/png" href="dist/img/tir-logo.png">



<link href="plugins/bootstrap/js/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">


  <!-- Bootstrap CSS -->
  <link href="plugins/bootstrap/js/bootstrap.min_2.css" rel="stylesheet" />
  <script src="plugins/bootstrap/js/popper.min.js"></script>
  <!-- Bootstrap JS + Popper -->





<style>
/* ---------- Full Page Layout ---------- */
html, body {
    height: 100%;
    margin: 0;
    font-family: 'Inter', 'Segoe UI', sans-serif;
    background: #1c1c1c;
    color: #fff;
    display: flex;
    flex-direction: column;
}

/* ---------- Header ---------- */
h2 {
    margin: 20px;
    font-weight: 600;
    color: #e0e0e0;
    flex: 0 0 auto;
}

/* ---------- Form / Dropdowns ---------- */
form {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 20px;
    margin: 0 20px 10px 20px;
    backdrop-filter: blur(12px) saturate(180%);
    background-color: rgba(255, 255, 255, 0.05);
    padding: 15px 20px;
    border-radius: 15px;
    border: 1px solid rgba(255,255,255,0.1);
    flex: 0 0 auto;
}

form label {
    font-weight: 500;
    color: #ddd;
}

/* ---------- Dropdowns ---------- */
select {
    padding: 8px 14px;
    border-radius: 12px;
    border: none;
    background: #555;  /* dark gray for selected value */
    color: #fff;       /* white text */
    font-size: 14px;
    transition: all 0.3s ease;
}

/* Options text black */
select option {
    color: #000;
    background: #fff;
}

select:focus {
    outline: 2px solid #4a90e2;
    background: #666;
}

/* ---------- Table Wrapper ---------- */
.table-wrapper {
    flex: 1 1 auto;  /* fill remaining space */
    margin: 0 20px 20px 20px;
    display: flex;
    flex-direction: column;
}

/* ---------- Table ---------- */
table {
    border-collapse: collapse;
    width: 100%;
    table-layout: fixed;
    flex: 1 1 auto;   /* table takes remaining height */
}

th, td {
    padding: 10px 8px;
    text-align: center;
}

th {
    background: rgba(255,255,255,0.1);
    color: #fff;
    position: sticky;
    top: 0;
    font-weight: 600;
    font-size: 14px;
    border-bottom: 2px solid rgba(255,255,255,0.2);
}

/* ---------- Row Styling ---------- */
tr {
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
tr:nth-child(even) td {
    background: rgba(255,255,255,0.02);
}

/* ---------- Shift Labels ---------- */
.dayshift {
    background: #ffeb3b;
    color: #000;
    font-weight: bold;
    border-radius: 6px;
}
.nightshift { 
background: #8e24aa;
    color: #fff;
    font-weight: bold;
    border-radius: 6px;
}
.no-data {
    background: rgba(255,255,255,0.05);
    color: #888;
}
.cell-wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
}
.shift-label {
    font-size: 12px;
}

/* ---------- Responsive ---------- */
@media(max-width: 768px){
    form {
        flex-direction: column;
        align-items: flex-start;
    }
    table {
        min-width: 100%;
    }
}
</style>
</head>
<body>

<h2 class="d-flex align-items-center justify-content-between text-white fw-bold" style="font-size: 1.25rem;">
    <span>
        <?php echo htmlspecialchars($selectedProcess); ?> – <?php echo date("F Y", strtotime($startDate)); ?>
    </span>

    <a href="/secondary_system/page/dashboard/" 
       class="btn btn-outline-light btn-back">
        <i class="fas fa-arrow-right me-1"></i> Back
    </a>
</h2>








<form id="filterForm" method="get">
    <label for="process">Process:</label>
    <select name="process" id="process">
        <?php foreach ($processes as $p): ?>
            <option value="<?php echo htmlspecialchars($p); ?>" <?php if ($p === $selectedProcess) echo 'selected'; ?>>
                <?php echo htmlspecialchars($p); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="month">Month:</label>
    <select name="month" id="month"></select>

   <label for="year">Year:</label>
<select name="year" id="year">
    <?php foreach ($years as $y): ?>
        <option value="<?php echo $y; ?>" <?php if ($y === $year) echo 'selected'; ?>>
            <?php echo $y; ?>
        </option>
    <?php endforeach; ?>
</select>

</form>

<div class="table-wrapper">
  <table id="dataTable">
    <thead>
      <tr>
        <th>Section</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<script>
// Populate month/year dropdowns
const monthSelect = document.getElementById('month');
const yearSelect = document.getElementById('year');
const currentMonth = <?php echo $month; ?>;
const currentYear = <?php echo $year; ?>;

for (let m = 1; m <= 12; m++) {
    const option = document.createElement('option');
    option.value = m;
    option.textContent = new Date(0, m-1).toLocaleString('default', { month: 'long' });
    if(m === currentMonth) option.selected = true;
    monthSelect.appendChild(option);
}


// Auto-submit when dropdown changes
const filterForm = document.getElementById('filterForm');
['process','month','year'].forEach(id => {
    document.getElementById(id).addEventListener('change', () => {
        filterForm.submit();
    });
});

// Table generation
const rawData = <?php echo json_encode($data); ?>;
const allSections = <?php echo json_encode($allSections); ?>;

const tbody = document.querySelector("#dataTable tbody");
const theadRow = document.querySelector("#dataTable thead tr");

// Generate all dates of the selected month
const firstDate = new Date(currentYear, currentMonth-1, 1);
const lastDate = new Date(currentYear, currentMonth, 0);
const dates = [];
for (let d = new Date(firstDate); d <= lastDate; d.setDate(d.getDate() + 1)) {
    const dayStr = d.getFullYear() + '-' 
                 + String(d.getMonth() + 1).padStart(2,'0') + '-' 
                 + String(d.getDate()).padStart(2,'0');
    dates.push(dayStr);
}

// Build table header
dates.forEach(date => {
    const th = document.createElement("th");
    th.textContent = date.slice(5); // MM-DD
    theadRow.appendChild(th);
});

// Build table body
allSections.forEach(section => {
    const tr = document.createElement("tr");
    const th = document.createElement("th");
    th.textContent = section.replace('Section ', '');
    tr.appendChild(th);

    dates.forEach(date => {
        const td = document.createElement("td");
        const wrapper = document.createElement("div");
        wrapper.className = 'cell-wrapper';

        const dayData = rawData.find(d => d.section === section && d.date === date && d.shift === 'Dayshift');
        const nightData = rawData.find(d => d.section === section && d.date === date && d.shift === 'Nightshift');

        const dayDiv = document.createElement("div");
        dayDiv.className = dayData && dayData.total > 0 ? 'dayshift shift-label' : 'no-data shift-label';
        dayDiv.textContent = 'D';

        const nightDiv = document.createElement("div");
        nightDiv.className = nightData && nightData.total > 0 ? 'nightshift shift-label' : 'no-data shift-label';
        nightDiv.textContent = 'N';

        wrapper.appendChild(dayDiv);
        wrapper.appendChild(nightDiv);
        td.appendChild(wrapper);
        tr.appendChild(td);
    });

    tbody.appendChild(tr);
});
</script>

</body>
</html>
