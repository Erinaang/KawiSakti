<?php 
session_start();
include "../connection/Connection.php";
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}
$idUser = $_GET['ID_USER'];
$queryDeletePaket = mysqli_query($mysqli, "UPDATE `user` SET `DISPLAY`=0 WHERE `ID_USER` = $idUser") or die("data salah 2: " . mysqli_error($mysqli));
if ($queryDeletePaket) {
    // header("Location: data-akun.php");
    // echo "<script>alert('Data Akun berhasil dihapus');location.href='data-akun.php'</script>";
}
?>