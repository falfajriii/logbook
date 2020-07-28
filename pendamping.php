<?php
  include "koneksi.php";
  $query = mysqli_query($koneksi, "SELECT * FROM kunjungan WHERE jam_klr = 0 ");
?>

<?php
    /*ob_start();
    session_start();
    if(!isset($_SESSION['akun_id_akun'])) header("location: login.php");
    include "koneksi.php";*/
    session_start();

 
    $username = $_SESSION['username'];
      $login = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");
      $row2 = mysqli_fetch_array($login);
    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level_user']==""){
    header("location:index.php?pesan=gagal");
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

    <title>Internal - Dashboard</title>
    <link href="img/pupr.png" rel="shortcut icon">

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    
    <!-- For Time-->
    <script type="text/javascript">
    // 1 detik = 1000
    window.setTimeout("waktu()",1000);  
    function waktu() {   
    var tanggal = new Date();  
    setTimeout("waktu()",1000);  
    document.getElementById("jam").innerHTML = tanggal.getHours()+" : "+tanggal.getMinutes()+" : "+tanggal.getSeconds();
    }
    </script>

    <!-- for Date-->
    <script language="JavaScript">
    var tanggallengkap = new String();
    var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
    namahari = namahari.split(" ");
    var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
    namabulan = namabulan.split(" ");
    var tgl = new Date();
    var hari = tgl.getDay();
    var tanggal = tgl.getDate();
    var bulan = tgl.getMonth();
    var tahun = tgl.getFullYear();
    tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;
    </script>
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark static-top" style="background: -ms-linear-gradient(to bottom, #4b6cb7, #182848);
              background: -moz-linear-gradient(to bottom, #4b6cb7, #182848);
              background: -o-linear-gradient(to bottom, #4b6cb7, #182848);
              background: linear-gradient(to bottom, #4b6cb7, #182848);">
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
      <a class="navbar-brand mr-1" href="pendamping.php">PUSDATIN</a>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <h4 style="color: white;"><?=$row2['nama']?></h4>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editprofil<?php echo $row2['id_user']; ?>">Edit Profil</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
            <img src="img/pupr.png" width="42.5px" height="40px">
        </li>
      </ul>

    </nav>

    <div id="wrapper">
      
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%);">
        <li class="nav-item active">
          <a class="nav-link" href="pendamping.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Kunjungan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kunjungan.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pengunjung</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pekerjaan.php">
            <i class="fas fa-fw fa-toolbox"></i>
            <span>Pekerjaan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="history.php">
            <i class="fas fa-fw fa-table"></i>
            <span>History Kunjungan</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb" style="font-size: 20px;">
            <div id="jam"></div>
            <div style="padding-left: 5px;">/ <script language="JavaScript">document.write(tanggallengkap);</script></div>          
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-fw fa-table"></i>
              Kunjungan Berlangsung</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="text-align: center;">
                      <th style="width: 25px;">No</th>
                      <th style="width: 100px;">Nama Pengunjung</th>
                      <th style="width: 125px;">Company</th>
                      <th style="width: 100px;">Tanggal</th>
                      <th>Keterangan Kunjungan</th>
                      <th style="width: 100px;">Jam Masuk</th>
                      <th style="width: 50px;">Keluar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x=1; ?>
                    <?php if(mysqli_num_rows($query)) {?>
                    <?php while($row = mysqli_fetch_array($query)) {?>
                    <tr style="text-align: center;">
                      <td style="text-align: center;"><?php echo $x;?></td>
                      <td style="text-align: left;"><?php echo $row['nm_kunjungan']?></td>
                      <td><?php echo $row['company']?></td>
                      <td><?php echo $row['tanggal']?> </td>
                      <td style="text-align: left;"><?php echo $row['keterangan']?> </td>                     
                      <td><?php echo $row['jam_msk']?> </td>
                      <td>
                        <a href="#keluar<?php echo $row['id_kunjungan'];?>" data-toggle="modal" data-target="">
                        <button type="button" class="btn btn-warning" style="color: white;"><i class="fas fa-sign-out-alt"></i></button>
                        </a>
                      </td>

                  <!-- Pengunjung Ingin Keluar-->
                  <div class="modal fade" id="keluar<?php echo $row['id_kunjungan'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form action="proses.php" method="post">
                      <input type="hidden" name="jamkeluar" value="<?php echo $row['id_kunjungan']; ?>">
                      <input type="hidden" name="pendamping" value="<?php echo $row2['nama']?>">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        </div>
                        <div class="modal-body">Apakah anda yakin pengunjung 
                          <span style="font-weight: bold; font-style: italic;"><?php echo $row['nm_kunjungan'];?></span> 
                          sudah selesai bertugas?
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                          <button class="btn btn-primary" type="submit" name="jam_klr" >Keluar</button>
                        </div>
                      </div>
                      </form>
                    </div>
                  </div>
                    </tr>
                    <?php $x++; ?>
                    <?php } ?>
                    <?php } ?>                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
               <span>Copyright © Alfajri 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

      <!-- Edit Data profil pendamping Modal-->
  <div class="modal fade bd-example-modal-lg" id="editprofil<?php echo $row2['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myLargeModalLabel">Edit Profil Pendamping</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-body">                              
        <form action="proses.php" method="post">
          <input type="hidden" name="editprofil" value="<?php echo $row2['id_user']; ?>">
            <div class="form-group">
              <label for="nik" class="col-form-label">username:</label>
              <input type="text" name="username" class="form-control" id="nik" value="<?php echo $row2['username']; ?>" required>
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">password:</label>
              <div class="input-group" id="show_hide_password">   
                <input type="password" name="password" class="form-control" id="password" value="<?php echo $row2['password'];?>" required>
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="editnama">nama:</label>
              <input type="text" name="editnama" class="form-control" id="editnama" value="<?php echo $row2['nama']; ?>" required>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary" name="edit_profil">Edit Profil</button>
            </div>
        </form>
      </div>
      </div>
    </div>
  </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Apakah anda yakin ingin keluar?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

    <script type="text/javascript">
            $(document).ready(function() {
          $("#show_hide_password").on('click', function(event) {
              event.preventDefault();
              if($('#show_hide_password input').attr("type") == "text"){
                  $('#show_hide_password input').attr('type', 'password');
                  $('#show_hide_password i').addClass( "fa-eye-slash" );
                  $('#show_hide_password i').removeClass( "fa-eye" );
              }else if($('#show_hide_password input').attr("type") == "password"){
                  $('#show_hide_password input').attr('type', 'text');
                  $('#show_hide_password i').removeClass( "fa-eye-slash" );
                  $('#show_hide_password i').addClass( "fa-eye" );
              }
          });
      });
    </script>

  </body>

</html>
<?php
     mysqli_close($koneksi);
     ob_end_flush();
?>