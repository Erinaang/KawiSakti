<?php 
session_start();

include "koneksi/koneksi.php";
$idKeranjang = $_GET['id_keranjang']; 
$queryDeleteKeranjang = mysqli_query($mysqli, "DELETE FROM keranjang WHERE id_keranjang = '$idKeranjang'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeleteKeranjang) {
	header("Location: profilBar.php");
}
