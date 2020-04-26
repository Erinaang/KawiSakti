<?php 
session_start();

include "connection/Connection.php";
$id_transaksi = $_GET['id_transaksi']; 
$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeletePaket) {
	header("Location: transaksi.php");
}
?>