
<style>

.nav-link.active .nav-icon {
  filter: brightness(0) invert(1);
}

  .nav-link.active .nav-icon {
    filter: brightness(0) invert(1);
  }
  /* Sub-navigation active state styles */
.sub-sidebar .nav-link.active {
    background-color: white; /* White background */
    color: blue;             /* Blue font color */
}

.sub-sidebar .nav-link.active:hover {
    background-color: #f0f0f0; /* Optional: Light gray on hover */
    color: #0043ff;           /* Optional: Darker blue on hover */
}


  
</style>
<aside class="main-sidebar elevation-4 sidebar-light-primary"  style="background-color:white;" >

<a href="admin.php" class="brand-link d-flex align-items-center">
<img src="../../dist/img/tir-logo.png" alt="Logo" class="brand-image" style="opacity: .8">


  <span class="brand-text font-weight-light p-0" style="color: black;">Secondary Output</span>
</a>

<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
    <div class="image">
      <img src="../../dist/img/user_account.png" class="img-circle " alt="User Image" >
    </div>
      <div class="info">
        <a href="index.php" class="d-block"><?=htmlspecialchars(strtoupper($_SESSION['username']));?></a>
      </div>
    </div>

   
<!-- 
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="index.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>">

          <i class="nav-icon fas fa-box"></i>
            <p>Plan</p>
          </a>
        </li> -->


        <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="index.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>">
        <i class="fas fa-object-ungroup"></i>
            <p>Section</p>
          </a>
        </li>

        <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="summary.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'summary.php') ? 'active' : '' ?>">
      
        <img src="../../dist/img/writing.png" amaryt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
            <p>Summary</p>
          </a>
        </li>
       

            <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
        <a href="../dashboard/index.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == '../dashboard/index.php') ? 'active' : '' ?>">
        <i class="fas fa-chart-bar"></i>
            <p>Dashboard</p>
          </a>
        </li>


        
      
<!-- w
        <li class="nav-item">
          <a href="export.php" class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/tube_inspection/page/user/export.php") ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file-export"></i>
            <p>Export</p>
          </a>
        </li> -->


      


      
        <?php include 'logout.php';?>
      </ul>
    </nav>
  
  </div>
  
</aside>
