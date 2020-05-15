<?php 
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}

include "../connection/Connection.php";
$id_pengiriman = $_GET['id_pengiriman']; 
$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM pengiriman WHERE id_pengiriman = '$id_pengiriman'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeletePaket) {
	header("Location: data-pengiriman.php");
}
?>