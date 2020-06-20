<?php 
session_start();
if (!isset($_SESSION["USERNAME"])) {
    header("Location: ../index.php");
}

include "../connection/Connection.php";
$id_user = $_GET['ID_USER']; 
$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM user WHERE ID_USER = '$id_user'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeletePaket) {
	header("Location: data-akun.php");
}
?>