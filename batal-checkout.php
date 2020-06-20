<?php 
session_start();
include "koneksi/koneksi.php"; // ambil koneksi
$idTrans = $_GET['ID_TRANS'];

$deleteItem = mysqli_query($mysqli, "DELETE FROM transaksi_item WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

$deleteTransaksi = mysqli_query($mysqli, "DELETE FROM transaksi WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

if ($deleteTransaksi) {
	header("Location: ProfilBar.php"); //go to page profilbar //go to page profilbar
}
