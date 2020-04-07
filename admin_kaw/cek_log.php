<?php
include 'koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];
$pass = md5($password);
$cek      = mysqli_query($connect, "select * from user where username='$username' and password='$pass'");
$result   = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);

if($result>0){
	if ($data['status'] == 'admin') {
	    session_start();
	    $_SESSION['username'] = $data['username'];
	    // $data['level'] level digunaan untu memanggil value level dari username yang telah login dan disimpan dalam $_SESSION['level']
	    $_SESSION['status'] 	  = $data['status'];
	    echo "<script>alert('Selamat Datang, Admin.');location.href='hal_admin.php'</script>";

	}elseif($data['status'] == 'penyewa'){
	    session_start();
	    $_SESSION['username'] = $data['username'];
	    // $data['level'] level digunaan untu memanggil value level dari username yang telah login dan disimpan dalam $_SESSION['level']
	    $_SESSION['status'] 	  = $data['status'];
	    echo "<script>alert('Selamat Datang, Pelanggan.');document.location.href='welcome_user.php'</script>";
	    header("Location: ../index.php");
	}
}else{
    header("location:index.php");
}
?>