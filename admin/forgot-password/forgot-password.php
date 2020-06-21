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
				<form action="send-forgot-password.php" method="POST">
					<div>
						<span><label>Email</label></span>
						<span><input type="email" name="email" class="email" class="textbox" placeholder="Masukan Email Terdaftar"></span>
					</div>
					<div>
						<span><label>Password Baru</label></span>
						<span><input type="password" name="pass" class="textbox" autofocus="autofocus"></span>
					</div>
					<div>
						<span><label>Konfirmasi Password Baru</label></span>
						<span><input type="password" name="confirmPass" class="textbox" autofocus></span>
						<?php 
						if (isset($_GET['edit'])) {
							echo '<input type="hidden" name="edit" value="true">';
						}else{
							echo '<input type="hidden" name="edit" value="false">';
						}
						?>
					</div>
					<hr>
					<div class="sign">
						<div class="submit">
							<input type="submit" name="kirim" value="Kirim">
						</div>
					</div>
				</form>
			</div>
		</div>
		<!---//end-main-->
	</div>
	
</body>

</html>