<?php
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');
//**********************************************************/
//			Proses untuk Edit data pengunjung
//**********************************************************/

if (isset($_POST['edit_data'])) {

	$editdata = $_POST['editdata'];
	$nama = $_POST['nama_pengunjung'];
	$nik = $_POST['nik'];
	$no_telp = $_POST['no_telp'];
	$instansi = $_POST['instansi'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
    // query update data
    $query = "UPDATE pengunjung SET nama_pengunjung = '$nama', email = '$email', nik = '$nik', 
    			no_telp = '$no_telp', instansi = '$instansi', alamat = '$alamat' where id_pengunjung = $editdata ";
    if(mysqli_query($koneksi, $query)){
         echo "<script>alert('Data berhasil diedit!'); window.location='kunjungan.php';</script>";
    }else{
        echo "Edit Data Gagal";
    }
}

//**********************************************************/
//			Proses untuk input data pengunjung baru
//**********************************************************/
else if (isset($_POST['data_baru'])){

$nama = $_POST['nama_pengunjung'];
$nik = $_POST['nik'];
$no_telp = $_POST['no_telp'];
$instansi = $_POST['instansi'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis').$foto;

// Set path folder tempat menyimpan fotonya
$path = "img/".$fotobaru;

if(move_uploaded_file($tmp, $path)){ 

	$query = mysqli_query($koneksi, "INSERT INTO pengunjung (id_pengunjung, nik, nama_pengunjung, no_telp, instansi, alamat, email, foto) 
	VALUES (id_pengunjung, '$nik','$nama','$no_telp','$instansi','$alamat','$email', '$fotobaru')") or die(mysqli_error($koneksi));;

	if($query) {
	    echo "<script>alert('Data berhasil ditambahkan!'); window.location='kunjungan.php';</script>";
	} else {
	    echo "<script>alert('Data gagal ditambahkan');</script>";
		}
	}
}

//**********************************************************/
//			Tambah Kunjungan
//**********************************************************/
elseif (isset($_POST['tambah_kunjungan'])) {

	$kunjungan = $_POST['kunjungan'];
	$nm = $_POST['nm_kunjungan'];
	$company = $_POST['company'];
	$tgl = date("Y-m-d");
	$keterangan = $_POST['keterangan'];
	$jam_msk = date("H.i")." WIB";
    // query insert data
	$query = mysqli_query($koneksi, "INSERT INTO kunjungan (id_kunjungan, nm_kunjungan, company, tanggal, keterangan, jam_msk) 
		VALUES (id_kunjungan, '$nm', '$company', '$tgl','$keterangan','$jam_msk')") or die(mysqli_error($koneksi));;

	if($query) {
	    echo "<script>alert('Silahkan Kunjungan anda Berhasil!'); window.location='pendamping.php';</script>";
	} else {
	    echo "<script>alert('Kunjungan gagal ditambahkan');</script>";
	}
}

//**********************************************************/
//			Jam Keluar
//**********************************************************/
elseif (isset($_POST['jam_klr'])) {

	$pendamping = $_POST['pendamping'];
	$jamkeluar = $_POST['jamkeluar'];
	$jam_klr = date("H.i")." WIB";
    // query update jam keluar
    $query = "UPDATE kunjungan SET jam_klr = '$jam_klr', pendamping = '$pendamping' where id_kunjungan = $jamkeluar ";
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('pengunjung dipersilahkan segera keluar data center!'); window.location='history.php';</script>";
    }else{
        echo "Tunggu Dulu Sebentar! Error";
    }
}

//**********************************************************/
//			Hapus Data Pengunjung
//**********************************************************/
elseif(isset($_POST['hapusdata'])) {

	  $hapus_pengunjung = $_POST['hapus_pengunjung'];
	  $hapus = $_POST['hapus_pengunjung'];
      $query = mysqli_query($koneksi, "DELETE FROM pengunjung WHERE id_pengunjung = $hapus");

    if($query) {
	    echo "<script>alert('Data Berhasil dihapus!'); window.location='kunjungan.php';</script>";
	} else {
	    echo "<script>alert('Data Gagal Dihapus');</script>";
	}
 
}

//**********************************************************/
//			Tambah Pekerjaan
//**********************************************************/
elseif (isset($_POST['kirimtugas'])) {

	$datapekerjaan = $_POST['datapekerjaan'];
	$nm_pendamping = $_POST['nm_pendamping'];
	$tgl = date("Y-m-d");
	$tugas = $_POST['tugas'];
	$status = "Menunggu";
    // query insert data
	$query = mysqli_query($koneksi, "INSERT INTO pekerjaan (id_pekerjaan, nama_pendamping, tgl, tugas, status) 
		VALUES (id_pekerjaan, '$nm_pendamping', '$tgl', '$tugas', '$status')") or die(mysqli_error($koneksi));;

	if($query) {
	    echo "<script>alert('Pekerjaan Berhasil diinput, Harap tunggu Validasi dari Kasubag!'); window.location='pekerjaan.php';</script>";
	} else {
	    echo "<script>alert('gagal ditambahkan');</script>";
	}

	// menampilkan semua error kecuali deprecated dan notice
	error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

	require 'phpmailer/PHPMailerAutoload.php';

	//$message = file_get_contents('pesan.html');

	$message = 'Haiii...Silahkan lihat sistem informasi data center. Karena, sedang ada pekerjaan berlanjung!';
	// membuat obyek phpmailer
	$mail = new PHPMailer(true);

	// memberitahu class untuk menggunakan SMTP
	$mail->IsSMTP();

	// mengaktifkan debug SMTP (untuk pengujian) atur 0 untuk menonaktifkan mode debugging, 1 untuk menampilkan hasil debug
	$mail->SMTPDebug = 0;

	// mengaktifkan otentikasi SMTP
	$mail->SMTPAuth = true;

	// menetapkan prefix ke server
	$mail->SMTPSecure = 'ssl';

	// atur Gmail sebagai server SMTP
	$mail->Host = 'smtp.gmail.com';

	// atur server SMTP untuk server Gmail
	$mail->Port = 465;

	// alamat gmail kamu
	$mail->Username = 'asimayo99@gmail.com';

	// password Anda harus disertakan dalam tanda kutip tunggal
	$mail->Password = 'indomaret123';

	// tambahkan subjek
	$mail->Subject = 'Pekerjaan Pendamping';

	// alamat email pengirim dan nama
	$mail->SetFrom('asimayo99@gmail.com', 'Data Center');

	// alamat email penerima
	$mail->AddAddress('muhamadfajri17@gmail.com');

	// jika kamu mengirim ke beberapa orangg, tambahkan baris ini lagi
	//$mail->AddAddress('tosend@domain.com');

	// jika kamu ingin mengirim Carbon copy (Cc)
	//$mail->AddCC('tosend@domain.com');

	// jika kamu ingin mengirim Blind carbon copy (Bcc)
	//$mail->AddBCC('tosend@domain.com');

	// tambahkan isi pesan
	$mail->MsgHTML($message);

	// tambahkan lampiran jika ada
	//$mail->AddAttachment('time.png');

	try {
	    // kirim email
	    $mail->Send();
	    $msg = "Email berhasil dikirim";
	} catch (phpmailerException $e) {
	    $msg = $e->getMessage();
	} catch (Exception $e) {
	    $msg = $e->getMessage();
	}
}

//**********************************************************/
//			Update Konfirmasi pengunjung
//**********************************************************/
elseif (isset($_POST['terkonfirmasi'])) {
	$idx= $_POST['id_update'];
	$status= "Terkonfirmasi";
    // query update status
    $query = "UPDATE pengunjung SET status = '$status' where id_pengunjung ='$idx' AND status = 'Menunggu'";
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Berhasil Konfirmasi!'); window.location='validasi.php';</script>";
    }else{
        echo "Tunggu Dulu Sebentar! Error";
    }
}

//**********************************************************/
//			Update Tolak Pengunjung
//**********************************************************/
elseif (isset($_POST['ditolak'])) {
	$idx= $_POST['id_update'];
	$status= "Ditolak";
    // query update status
    $query = "UPDATE pengunjung SET status = '$status' where id_pengunjung ='$idx' AND status = 'Menunggu'";
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Pekerjaan Berhasil Ditolak!'); window.location='validasi.php';</script>";
    }else{
        echo "Tunggu Dulu Sebentar! Error";
    }
}

//**********************************************************/
//			Update Konfirmasi Pekerjaan
//**********************************************************/
elseif (isset($_POST['konfirmasi'])) {
	$idx= $_POST['id'];
	$status= "Dikonfirmasi";
    // query update status
    $query = "UPDATE pekerjaan SET status = '$status' where id_pekerjaan='$idx' AND status = 'Menunggu'";
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Berhasil Konfirmasi!'); window.location='admin.php';</script>";
    }else{
        echo "Tunggu Dulu Sebentar! Error";
    }
}

//**********************************************************/
//			Update Tolak Pekerjaan
//**********************************************************/
elseif (isset($_POST['tolak'])) {
	$idx= $_POST['id'];
	$status= "Ditolak";
    // query update status
    $query = "UPDATE pekerjaan SET status = '$status' where id_pekerjaan='$idx' AND status = 'Menunggu'";
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Pekerjaan Berhasil Ditolak!'); window.location='admin.php';</script>";
    }else{
        echo "Tunggu Dulu Sebentar! Error";
    }
}

//**********************************************************/
//			Update Profile pendamping
//**********************************************************/
elseif (isset($_POST['edit_profil'])) {

	$editprofil = $_POST['editprofil'];
	$username = $_POST['username'];
	$editnama = $_POST['editnama'];
	$password = $_POST['password'];
    // query update data
    $query = "UPDATE user SET username = '$username', password = '$password', nama = '$editnama' WHERE id_user = $editprofil ";
    if(mysqli_query($koneksi, $query)){
         echo "<script>alert('Profil Berhasil Diedit!'); window.location='index.php';</script>";
    }else{
        echo "Edit Profil Gagal";
    }
}

//**********************************************************/
//			Update Profile Admin
//**********************************************************/
elseif (isset($_POST['edit_profil_admin'])) {

	$editprofil = $_POST['editprofil'];
	$username = $_POST['username'];
	$editnama = $_POST['editnama'];
	$password = $_POST['password'];
    // query update data
    $query = "UPDATE user SET username = '$username', password = '$password', nama = '$editnama' WHERE id_user = $editprofil ";
    if(mysqli_query($koneksi, $query)){
         echo "<script>alert('Profil Berhasil Diedit!'); window.location='index.php';</script>";
    }else{
        echo "Edit Profil Gagal";
    }
}

?>