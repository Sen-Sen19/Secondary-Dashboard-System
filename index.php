<?php
require 'process/login.php';

if (isset($_SESSION['username'])) {
  if ($_SESSION['type'] == 'user') {
    header('location: page/user/');
    exit;
  } elseif ($_SESSION['type'] == 'admin') {
    header('location: page/admin/');
    exit;
    } elseif ($_SESSION['type'] == 'me') {
    header('location: page/me/');
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Secondary Output System</title>

  <link rel="icon" href="dist/img/tir-logo.png" type="image/x-icon">

  <link rel="stylesheet" href="dist/css/font.min.css">

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<style>
  body {
    background: url('dist/img/background.jpg') no-repeat center center fixed;
    background-size: cover;

  }

  .form-box {
    background-color: rgb(47, 137, 255);
    padding-top: 40px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);

  }
</style>

<div class="form-box">

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="dist/img/tir-logo.png" style="height:150px; ">
        <h2 style="color:rgb(255, 255, 255);"><b>Secondary Output System</h2>
      </div>

      <div class="card">
        <div class="card-body login-card-body">


          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="login_form">
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                  autocomplete="off" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                  autocomplete="off" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <button type="submit" class="btn btn-block" name="Login" value="login"
                  style="background-color: rgb(47, 137, 255); border-color: rgb(47, 137, 255); color: white;">Login</button>
                               <a href="Secondary_Process_System_WI2.pdf" target="_blank">
                  <button type="button" class="btn btn-block"
                    style="background-color:rgba(32, 10, 10, 1); border-color:rgb(100, 100, 100); color: white; margin-top:7px;">
                    Work Instruction
                  </button>
                </a>
                <a href="page/dashboard/">
                  <button type="button" class="btn btn-block"
                    style="background-color:rgb(74, 176, 216); border-color:rgb(74, 176, 216); color: white; margin-top:7px;">
                    Dashboard
                  </button>
                </a>
              </div>
            </div>
            <div class="row">
              <div class="col">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
</body>


<script src="plugins/jquery/dist/jquery.min.js"></script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>


</body>

</html>