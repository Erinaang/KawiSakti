<?php 
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}

include "../connection/Connection.php";

$idTrans = $_GET['ID_TRANS']; //ambil id_Trans dari URL
$selectTI = mysqli_query($mysqli, " SELECT * FROM `transaksi` AS t JOIN `transaksi_item` AS ti ON t.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE t.ID_TRANSAKSI=$idTrans") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($selectTI)) {
	echo $jmlSet = $show['JUMLAH_SET'];
	echo $frame = $show['FRAME'];

	$updateStok = mysqli_query($mysqli, "UPDATE `stok` SET STOK=STOK+'$jmlSet' WHERE FRAME='$frame'") or die("data salah: " . mysqli_error($mysqli));
}
$queryDeleteItem = mysqli_query($mysqli, "DELETE FROM transaksi_item WHERE ID_TRANSAKSI = '$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

$queryDeleteTransaksi = mysqli_query($mysqli, "DELETE FROM transaksi WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //mengurangi total di transaki

if ($queryDeleteTransaksi) {
	header("Location: data-pengembalian.php"); //go to page data-transaksi
}
