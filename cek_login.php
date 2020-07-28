<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksi.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' and password='$password'");	
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai pendamping
	if($data['level_user']=="pendamping"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level_user'] = "pendamping";
		$_SESSION['nama'] = $nama;
		// alihkan ke halaman dashboard admin
		header("location:pendamping.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level_user']=="kasubag"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level_user'] = "kasubag";
		// alihkan ke halaman dashboard pegawai
		header("location:validasi.php");

	}else{
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
?>

<!-- Proses Untuk Logout Otomatis -->
<?php
$tanggal=date("Y-m-d H:i:s");

//fungsi untuk Logout otomatis
function login_validate() {
	//ukuran waktu dalam detik
	$timer= 3600;
	//untuk menambah masa validasi
	$_SESSION["expires_by"] = time() + $timer;
}

function login_check() {
	//berfungsi untuk mengambil nilai dari session yang pertama
	$exp_time = $_SESSION["expires_by"];
	
	//jika waktu sistem lebih kecil dari nilai waktu session
	if (time() < $exp_time) {
		//panggil fungsi dan tambah waktu session
		login_validate();
		return true; 
	}else{
		//jika waktu session lebih kecil dari waktu session atau lewat batas
		//maka akan dilakukan unset session
		unset($_SESSION["expires_by"]);
		return false; 
	}
}
?>