<?php
session_start();

include "../connection/Connection.php";
$id_transaksi = $_GET['id_transaksi'];
$querySelectTrans = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($querySelectTrans)) {
	$idPenyewa = $show['id_penyewa'];
	$tanggal = $show['tgl_sewa'];
}
$queryDeleteTransaksi = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));

$queryDeleteKeranjang = mysqli_query($mysqli, "DELETE FROM keranjang WHERE id_penyewa='$idPenyewa' AND tanggal ='$tanggal'") or die("data salah: " . mysqli_error($mysqli));


if ($queryDeleteTransaksi) {
	// header("Location: transaksi.php");
	echo "<script>alert('Transaksi telah dihapus.');location.href='data-transaksi.php'</script>";
}
