<?php 
session_start();
include "koneksi/koneksi.php"; // ambil koneksi
$idKeranjang = $_GET['id_keranjang']; //ambil id_keranjang dari URL
$queryDeleteKeranjang = mysqli_query($mysqli, "DELETE FROM keranjang WHERE id_keranjang = '$idKeranjang'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

if ($queryDeleteKeranjang) {
	header("Location: ProfilBar.php"); //go to page profilbar //go to page profilbar
}
