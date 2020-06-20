<?php 
session_start();
include "koneksi/koneksi.php"; // ambil koneksi
$idItem = $_GET['ID_ITEM']; //ambil id_Item dari URL
$idTrans = $_GET['ID_TRANS']; //ambil id_Trans dari URL
$total = $_GET['TOTAL']; //ambil total dari URL

$kurangiTotal = mysqli_query($mysqli, "UPDATE transaksi SET TOTAL=TOTAL-'$total' WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //mengurangi total di transaki

$queryDeleteItem = mysqli_query($mysqli, "DELETE FROM transaksi_item WHERE ID_TRANSAKSI_ITEM = '$idItem'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

if ($queryDeleteItem) {
	header("Location: ProfilBar.php"); //go to page profilbar //go to page profilbar
}
