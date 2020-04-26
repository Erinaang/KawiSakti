<?php 
session_start();

include "connection/Connection.php";
$id_paket = $_GET['id_paket']; 
$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM paket WHERE id_paket = '$id_paket'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeletePaket) {
	header("Location: data-barang.php");
}
?>