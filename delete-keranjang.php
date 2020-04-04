<?php 
session_start();

include "koneksi/koneksi.php";
$idTransaksi = $_GET['id_transaksi']; 
$queryDeleteKeranjang = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_transaksi = '$idTransaksi'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeleteKeranjang) {
	header("Location: keranjang.php");
}
    



?>