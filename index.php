<?php
  include "koneksi.php";
  if(isset($_GET['pesan'])){
    if($_GET['pesan']=="gagal"){
      echo "<div class='alert' style='text-align:center; color:white;'>Username dan Password tidak sesuai !</div>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link href="img/pupr.png" rel="shortcut icon">

    <link href="css/aos.css" rel="stylesheet">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body style="background: -ms-linear-gradient(to bottom, #4b6cb7, #182848);
              background: -moz-linear-gradient(to bottom, #4b6cb7, #182848);
              background: -o-linear-gradient(to bottom, #4b6cb7, #182848);
              background: linear-gradient(to bottom, #4b6cb7, #182848);">

    <div class="container" style="margin-top: 40px;">
      <h1 style="text-align: center; color: white;" data-aos="fade-down" data-aos-duration="2000">E-LOGBOOK DATA CENTER PUSDATIN</h1>
      <div class="card card-login mx-auto mt-5" style="box-shadow: 2px 10px 30px rgba(0,0,0,0.8);" data-aos="fade-up" data-aos-duration="2000">
        <div class="card-header" style="text-align: center; font-weight: bold; color: #4b6cb7;">LOGIN</div>
        <div class="card-body">
          <form action="cek_login.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="username" id="username" name="username" class="form-control" placeholder="username" required="required" autofocus="autofocus">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="form-group" style="padding-bottom: 20px;">
              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="password" required="required">
                <label for="password">Password</label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="submit_login" value="Login">
          </form>
        </div>
      </div>
        <div style="text-align: center; padding-top: 30px;">
          <img src="img/logo.png" width="375px" height="100px" data-aos="zoom-in"  data-aos-duration="2000">
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!--Aos Scroll-->
    <script src="js/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>

<?php
     mysqli_close($koneksi);
     ob_end_flush();
?>
