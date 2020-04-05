<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin_kaw/index.php");
}
include "koneksi/koneksi.php";

//GET IDUSER
$username = $_SESSION['username'];
$queryUser = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'") or die("data salah: " . mysqli_error($mysqli));

if (isset($_POST["submit"])) {
    $idUser = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $noTelp = $_POST['noTelp'];
    $alamat = $_POST['alamat'];

    $queryEdit = mysqli_query($mysqli, "UPDATE user SET nama='$nama', email='$email', no_telp='$noTelp', alamat='$alamat' WHERE id_user = '$idUser'") or die("data salah: " . mysqli_error($mysqli));

    header("Location: ProfilBar.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document profile</title>
</head>
<body>
    <?php while ($show = mysqli_fetch_array($queryUser)) { ?>
    <form action="" method="post">
        <input type="text" name="nama" placeholder="nama" value="<?php echo $show['nama']; ?>"><br>
        <input type="text" name="email" placeholder="email" value="<?php echo $show['email']; ?>"><br>
        <input type="text" name="noTelp" placeholder="noTelp" value="<?php echo $show['no_telp']; ?>"><br>
        <input type="text" name="alamat" placeholder="alamat" value="<?php echo $show['alamat']; ?>"><br>
        <input type="hidden" name="id_user" value="<?php echo $show['id_user'];?>">
        <input type="submit" value="submit" name="submit">
    </form>
    <?php } ?>
</body>
</html>