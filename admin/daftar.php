<?php
session_start();
include 'connection/Connection.php';

function randomPass($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

if (isset($_POST['daftarSubmit'])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$telp = $_POST['telp'];
	$username = $_POST['username'];
	$password = randomPass();
	$passEnc = md5($password);

	$sql_u = "SELECT * FROM user WHERE USERNAME='$username'";
	$sql_e = "SELECT * FROM user WHERE EMAIL='$email'";
	$res_u = mysqli_query($mysqli, $sql_u) or die("data salah: " . mysqli_error($mysqli));
	$res_e = mysqli_query($mysqli, $sql_e) or die("data salah: " . mysqli_error($mysqli));

	if (mysqli_num_rows($res_u) > 0) {
		$name_error = "Sorry... username already taken";
	} else if (mysqli_num_rows($res_e) > 0) {
		$email_error = "Sorry... email already taken";
	} else {
		error_reporting(E_ALL);
		require '../PHPMailer/src/PHPMailer.php';
		require '../PHPMailer/src/SMTP.php';
		require '../PHPMailer/src/Exception.php';
		$mail =  new PHPMailer\PHPMailer1\PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->SMTPAuth 	= true;
		$mail->Host 		= "smtp.gmail.com";
		$mail->Port 		= 465;
		$mail->SMTPSecure 	= "ssl";
		$mail->Username     = "erinaangg@gmail.com"; //username yang ngirim
		$mail->Password     = "maternal781998";   //password email yang ngirim
		$mail->From            = "erinaangg@gmail.com"; //email pengirim
		$mail->FromName        = "Kawi Sakti";      //nama pengirim
		$mail->AddAddress($email, "Dengan PT Kawi Sakti disini."); //email yang tujuan dan nama
		$mail->Subject      =  "Pendaftaran User PT KSM"; //subject
		$mail->Body     	=  "<b>Terima Kasih telah mendaftar menjadi User PT Kawi Sakti Megah</b><br>
			<p> Nama " . $nama . " </p><br>
			<p> Email " . $email . " </p><br>
			<p> Password " . $password . " </p><br>
			<p> Password yang tertera di atas dapat digunakan untuk login pada aplikasi, kami menyarankan untuk mengganti password dengan password yang anda inginkan </p><br>
			";
		// $mail->AddAttachment("/cpanel.png","filesaya");
		if ($mail->Send()) {
			$queryIdUser = mysqli_query($mysqli, "INSERT INTO user SET NAMA = '$nama', EMAIL='$email', ALAMAT='$alamat', NO_TELP='$telp', USERNAME='$username', PASSWORD='$passEnc', STATUS='penyewa'") or die("data salah: " . mysqli_error($mysqli));
			// header("Location: login.php");
			echo "<script>alert('Silahkan cek di email anda untuk mendapatkan kata sandinya');location.href='login.php'</script>";
		} else {
			echo error_reporting(E_ALL);
		}
	}
}
?>
<!DOCTYPE html>
<html>
<br>
<br>
<br>
<head>
	<title>Selamat Datang di PT Kawi Sakti Megah</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>

<body>
	<!-- <h1>Register</h1>
	<h3>Buat akun baru</h3>
	<br> -->
	<div class="container">
					<style>
			p {
			background-color: #64B5F6;
			border: 5px solid black;
			outline: #0D47A1 solid 10px;
			margin: 3px;  
			padding: 35px;
			text-align: center;
			font-weight: bold;
			font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
			}
			</style>
			</head>
			<body>

			<h3><p class="thicker" style="color: #1A237E"><b> R E G I S T E R - A K U N - PT. K S M </p></h3></b>
		</div>
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
				<div class="tbl-kirim">
					<input type="submit" name="daftarSubmit" value="Buat Akun">
				</div>
			</form>
		</div>
	</div>
</body>

</html>