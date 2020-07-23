<?php
session_start();
include "koneksi/koneksi.php"; // ambil koneksi
$idItem = $_GET['ID_ITEM']; //ambil id_Item dari URL
$idTrans = $_GET['ID_TRANS']; //ambil id_Trans dari URL

$selectTI = mysqli_query($mysqli, " SELECT * FROM `transaksi_item` AS t JOIN `paket` AS pk ON t.ID_PAKET = pk.ID_PAKET WHERE t.ID_TRANSAKSI_ITEM=$idItem") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($selectTI)) {
	$jmlSet = $show['JUMLAH_SET'];
	$frame = $show['FRAME'];
	$updateStok = mysqli_query($mysqli, "UPDATE `stok` SET STOK=STOK+'$jmlSet' WHERE FRAME='$frame'") or die("data salah: " . mysqli_error($mysqli));
}
$queryDeleteItem = mysqli_query($mysqli, "DELETE FROM transaksi_item WHERE ID_TRANSAKSI_ITEM = '$idItem'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id
if ($queryDeleteItem) {
	header("Location: ProfilBar.php"); //go to page profilbar
}
