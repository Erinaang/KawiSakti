<?php 
session_start();
if (!isset($_SESSION["USERNAME"])) {
    header("Location: ../index.php");
}

include "../connection/Connection.php";
$idUser = $_GET['ID_USER'];

$queryDeletePaket = mysqli_query($mysqli, "UPDATE `transaksi` SET ID_PENYEWA=NULL WHERE ID_PENYEWA = '$idUser'") or die("data salah: " . mysqli_error($mysqli));

$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM user WHERE ID_USER = '$idUser'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeletePaket) {
	header("Location: data-akun.php");
}
?>