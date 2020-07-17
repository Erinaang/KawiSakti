<?php 
session_start();
include "koneksi/koneksi.php"; // ambil koneksi
$idItem = $_GET['ID_ITEM']; //ambil id_Item dari URL
$idTrans = $_GET['ID_TRANS']; //ambil id_Trans dari URL

$queryDeleteItem = mysqli_query($mysqli, "DELETE FROM transaksi_item WHERE ID_TRANSAKSI_ITEM = '$idItem'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

if ($queryDeleteItem) {
	header("Location: ProfilBar.php"); //go to page profilbar //go to page profilbar
}
