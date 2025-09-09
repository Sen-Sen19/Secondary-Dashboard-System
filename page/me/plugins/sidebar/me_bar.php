
<style>

.nav-link.active .nav-icon {
  filter: brightness(0) invert(1);
}

  .nav-link.active .nav-icon {
    filter: brightness(0) invert(1);
  }
.sub-sidebar .nav-link.active {
    background-color: white;
    color: blue;        
}

.sub-sidebar .nav-link.active:hover {
    background-color: #f0f0f0; 
    color: #0043ff;          
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
      <img src="../../dist/img/admin.png" class="img-circle " alt="User Image" >
    </div>
      <div class="info">
        <a href="index.php" class="d-block"><?=htmlspecialchars(strtoupper($_SESSION['username']));?></a>
      </div>
    </div>

   
    <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="/secondary_system/page/me/" class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/secondary_system/page/me/") ? 'active' : '' ?>">
        <img src="../../dist/img/manage_account.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
        <p>Accounts </p>
      </a>
    </li>


    <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/secondary_system/page/me/shot_count.php" 
   class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/secondary_system/page/me/shot_count.php") ? 'active' : '' ?>">
        <img src="../../dist/img/counter.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
        <p>Shot Count </p>
      </a>
    </li>

<!-- 
    <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/secondary_system/page/me/total_shots.php" 
   class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/secondary_system/page/me/total_shots.php") ? 'active' : '' ?>">
        <img src="../../dist/img/calculator.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
        <p>Total Shots </p>
      </a>
    </li> -->



    <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/secondary_system/page/me/jph.php" 
   class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/secondary_system/page/me/jph.php") ? 'active' : '' ?>">
        <img src="../../dist/img/jph.png" alt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
        <p>JPH</p>
      </a>
    </li>



    
    <nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/secondary_system/page/me/summary.php" 
   class="nav-link <?= ($_SERVER['REQUEST_URI'] == "/secondary_system/page/me/summary.php") ? 'active' : '' ?>">
        <img src="../../dist/img/writing.png" amaryt="Pagination Icon" class="nav-icon" style="width: 20px; height: 20px;">
        <p>Summary </p>
      </a>
    </li>
      


      
        <?php include 'logout.php';?>
      </ul>
    </nav>
  
  </div>
  
</aside>
