<?php
session_start();
include "koneksi/koneksi.php"; // ambil koneksi
$idTrans = $_GET['ID_TRANS'];

$selectTI = mysqli_query($mysqli, " SELECT * FROM `transaksi` AS t JOIN `transaksi_item` AS ti ON t.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE t.ID_TRANSAKSI=$idTrans") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($selectTI)) {
	echo $jmlSet = $show['JUMLAH_SET'];
	echo $frame = $show['FRAME'];

	$updateStok = mysqli_query($mysqli, "UPDATE `stok` SET STOK=STOK+'$jmlSet' WHERE FRAME='$frame'") or die("data salah: " . mysqli_error($mysqli));
}
$deleteItem = mysqli_query($mysqli, "DELETE FROM transaksi_item WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id
$deleteTransaksi = mysqli_query($mysqli, "DELETE FROM transaksi WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

if ($deleteTransaksi) {
	header("Location: ProfilBar.php"); //go to page profilbar //go to page profilbar
}
