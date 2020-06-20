<?php
include 'connection/Connection.php';
$username = $_POST['username'];
$password = $_POST['password'];
$pass = md5($password);$cek = mysqli_query($mysqli, "SELECT * FROM user WHERE USERNAME='$username' and password='$pass'") or die("data salah: " . mysqli_error($mysqli));
$result   = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);

if($result>0){
	if ($data['STATUS'] == 'admin') { // kalo yang loginnya admin
	    session_start();
	    $_SESSION['username'] = $data['username'];
	     $_SESSION['status'] 	  = $data['status'];
	    echo "<script>alert('Selamat Datang, Admin.');location.href='index.php'</script>";

	}elseif($data['STATUS'] == 'penyewa'){// kalo yang loginnya penyewa
	    session_start();
	    $_SESSION['username'] = $data['USERNAME'];
	    // $data['level'] level digunaan untu memanggil value level dari username yang telah login dan disimpan dalam $_SESSION['level']
	    $_SESSION['status'] 	  = $data['STATUS'];
	    echo "<script>alert('Selamat Datang, Pelanggan.');document.location.href='../index.php'</script>";
	}
}else{
    header("location:login.php");
}
?>