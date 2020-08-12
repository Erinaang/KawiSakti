<?php
include 'connection/Connection.php';
$username = $_POST['username'];
$password = $_POST['password'];
$pass = md5($password);

$cek = mysqli_query($mysqli, "SELECT * FROM user WHERE USERNAME='$username' and password='$pass' AND DISPLAY='1'") or die("data salah: " . mysqli_error($mysqli));
$result   = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);
session_start();

if($result>0){
	if ($data['STATUS'] == 'admin') { // kalo yang loginnya admin
	    $_SESSION['username'] = $data['USERNAME'];
	    $_SESSION['status'] 	  = $data['STATUS'];
	    echo "<script>alert('Selamat Datang, Admin.');location.href='index.php'</script>";
	}elseif($data['STATUS'] == 'penyewa'){// kalo yang loginnya admin
	    $_SESSION['username'] = $data['USERNAME'];
	    $_SESSION['status'] 	  = $data['STATUS'];
	    echo "<script>alert('Selamat Datang, Pelanggan.');document.location.href='../index.php'</script>";
	}
}else{
    header("location:login.php");
}
?>