<?php
include '../../koneksi/koneksi.php';
if (isset($_POST['kirim'])) {
	$email = $_POST['email'];
	$newPass = $_POST['pass'];
	$confirmPass = $_POST['confirmPass'];
	$encPass = md5($newPass);
	$edit = $_POST['edit'];
	if ($newPass === $confirmPass) {

		$queryIdUser = mysqli_query($mysqli, "SELECT * FROM user WHERE email='$email'") or die("data salah: " . mysqli_error($mysqli));
		while ($show = mysqli_fetch_array($queryIdUser)) {
			$nama = $show['nama'];
		}
		require '../../PHPMailer/src/PHPMailer.php';
		require '../../PHPMailer/src/SMTP.php';
		require '../../PHPMailer/src/Exception.php';
		$mail =  new PHPMailer\PHPMailer1\PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->SMTPAuth 	= true;
		$mail->Host 		= "smtp.gmail.com";
		$mail->Port 		= 465;
		$mail->SMTPSecure 	= "ssl";
		$mail->Username 	= "kikirabdullah@gmail.com"; //username SMTP
		$mail->Password 	= "k1k1r12k499";   //password SMTP
		$mail->From    		= "kikirabdullah@gmail.com"; //sender email
		$mail->FromName 	= "Kawi Sakti";      //sender name
		$mail->AddAddress($email, "Hallo, Kawi Sakti disini."); //recipient: email and name
		$mail->Subject  	=  "Percobaan";
		$mail->Body     	=  "<b>Terima Kasih telah mendaftar</b><br>
			<p> Nama " . $nama . " </p><br>
			<p> Email " . $email . " </p><br>
			<p> Password " . $newPass . " </p><br>
			<p> Password yang tertera di atas dapat digunakan untuk login pada aplikasi, kami menyarankan untuk mengganti password dengan password yang anda inginkan </p><br>
			";

		// $mail->AddAttachment("/cpanel.png","filesaya");
		if ($mail->Send()) {
			if ($edit === 'true') {
				$queryEdit= mysqli_query($mysqli, "UPDATE user SET password='$encPass' where email='$email'") or die("data salah: " . mysqli_error($mysqli));
				header("Location: ../../ProfilBar.php");
			}
			$queryEdit = mysqli_query($mysqli, "UPDATE user SET password='$encPass' where email='$email'") or die("data salah: " . mysqli_error($mysqli));
		} else {
			
		}
	} else {
		header("Location: password-salah.php");
		
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../assets/style.css" rel='stylesheet' type='text/css' />
	<!--webfonts-->
	<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700|Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<!--//webfonts-->
	<link rel="shortcut icon" type="../image/x-icon" href="img/ksm.png">

	<link rel="stylesheet" href="../css/font-awesome.min.css">
</head>

<body>
	<div class="main">
		<!---start-main-->
		<div class="login">
			<div class="inset">
				<div class="row">
					<div class="col-md-12" align="center" style="color: green">
						<i class="fa fa-info-circle" aria-hidden="true">Perhatian</i>
					</div>
					<br>
					<div class="col-md-12">
						<p>Password anda telah kami kirimkan melalui email yang terdaftar.</p>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6" align="center">
						<a href="../login.php"> <b style="color: gray">Login</b></a> &nbsp;&nbsp;&nbsp;
						<a href="../daftar.php"> <b style="color: gray">Register</b></a>
					</div>
				</div>
			</div>
		</div>
		<!---//end-main-->
	</div>
</body>

</html>