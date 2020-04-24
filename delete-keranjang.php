<?php 
session_start();

include "koneksi/koneksi.php";
$idTransaksi = $_GET['id_transaksi']; 
$queryDeleteKeranjang = mysqli_query($mysqli, "DELETE FROM keranjang WHERE id_keranjang = '$idTransaksi'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeleteKeranjang) {
	header("Location: profilBar.php");
}
