<?php
session_start();
include 'connection/Connection.php';

// function randomPass($length = 10)
// {
// 	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
// 	$charactersLength = strlen($characters);
// 	$randomString = '';
// 	for ($i = 0; $i < $length; $i++) {
// 		$randomString .= $characters[rand(0, $charactersLength - 1)];
// 	}
// 	return $randomString;
// }

if (isset($_POST['daftarSubmit'])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$telp = $_POST['telp'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passEnc = md5($password);

	$sql_u = "SELECT * FROM user WHERE username='$username'";
	$sql_e = "SELECT * FROM user WHERE email='$email'";
	$res_u = mysqli_query($mysqli, $sql_u) or die("data salah: " . mysqli_error($mysqli));
	$res_e = mysqli_query($mysqli, $sql_e) or die("data salah: " . mysqli_error($mysqli));

	if (mysqli_num_rows($res_u) > 0) {
		$name_error = "Sorry... username already taken";
	} else if (mysqli_num_rows($res_e) > 0) {
		$email_error = "Sorry... email already taken";
	} else {
		$queryIdUser = mysqli_query($mysqli, "INSERT INTO user SET nama = '$nama', email='$email', alamat='$alamat', no_telp='$telp', username='$username', password='$passEnc', status='admin'") or die("data salah: " . mysqli_error($mysqli));
		$_SESSION['username'] = $username;
		// $data['level'] level digunaan untu memanggil value level dari username yang telah login dan disimpan dalam $_SESSION['level']
		$_SESSION['status'] 	  = 'admin';
		echo "<script>alert('Selamat Datang, Admin.');location.href='index.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Selamat Datang di PT Kawi Sakti Megah</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>

<body>
	<h1>Register</h1>
	<h3>Buat akun baru</h3>
	<div class="container">
		<?php echo !empty($statusPsn) ? '<p class="' . $jenisStatusPsn . '">' . $statusPsn . '</p>' : ''; ?>
		<div class="regisForm">
			<form action="" method="post">
				<input type="text" name="nama" placeholder="Nama" required="">
				<div <?php if (isset($email_error)) : ?> class="form_error" <?php endif ?>>
					<input type="email" name="email" placeholder="Email" required="">
					<?php if (isset($email_error)) : ?>
						<span><?php echo $email_error; ?></span>
					<?php endif ?>
				</div>
				<input type="text" name="alamat" placeholder="Alamat" required="">
				<input type="text" name="telp" placeholder="Nomor Telp" required="">
				<div <?php if (isset($name_error)) : ?> class="form_error" <?php endif ?>>
					<input type="text" name="username" placeholder="Username" required="">
					<?php if (isset($name_error)) : ?>
						<span><?php echo $name_error; ?></span>
					<?php endif ?>
				</div>
				<input type="password" name="password" placeholder="Password" required="">
				<!-- <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required=""> -->
				<div class="tbl-kirim">
					<input type="submit" name="daftarSubmit" value="Buat Akun">
				</div>
			</form>
		</div>
	</div>
</body>

</html>