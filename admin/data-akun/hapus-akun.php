<?php 
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}

include "../connection/Connection.php";
$id_user = $_GET['id_user']; 
$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM user WHERE id_user = '$id_user'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeletePaket) {
	header("Location: data-akun.php");
}
?>