<?php
if (isset($_POST['submit'])) {
    $newPass = $_POST['pass'];
    $confirmPass = $_POST['newPass'];

    if ($newPass === $confirmPass) {
        header('Location: send-forgot-password.php');
    }else{
        echo "<script type='text/javascript'>alert('Password Beda');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/style.css" rel='stylesheet' type='text/css' />
    <!--webfonts-->
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700|Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <link rel="shortcut icon" type="image/x-icon" href="img/ksm.png">

    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body>
    <div class="main">
        <!---start-main-->
        <div class="login">
            <div class="inset">
                <form action="" method="POST">
                    <div>
                        <span><label>Password Baru</label></span>
                        <span><input type="password" name="pass" class="textbox" autofocus="autofocus"></span>
                    </div>
                    <div>
                        <span><label>Konfirmasi Password Baru</label></span>
                        <span><input type="password" name="confirmPass" class="textbox" autofocus></span>
                    </div>
                    <hr>
                    <div class="sign">
                        <div class="submit">
                            <input type="submit" name="submit" value="Kirim">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!---//end-main-->
    </div>
</body>

</html>