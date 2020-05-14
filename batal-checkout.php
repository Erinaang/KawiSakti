<?php 
session_start();
include "koneksi/koneksi.php"; // ambil koneksi
$idPenyewa = $_GET['id_penyewa']; //ambil id_keranjang dari URL
$jam = $_GET['jam'];
$status= $_GET['status'];
$queryDeleteKeranjang = mysqli_query($mysqli, "DELETE FROM keranjang WHERE id_penyewa = '$idPenyewa' AND jam_pemesanan='$jam' AND status='$status'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

if ($queryDeleteKeranjang) {
	header("Location: profilBar.php"); //go to page profilbar //go to page profilbar
}
