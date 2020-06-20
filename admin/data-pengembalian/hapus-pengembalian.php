<?php 
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}

include "../connection/Connection.php";

$idTrans = $_GET['ID_TRANS']; //ambil id_Trans dari URL

$queryDeleteItem = mysqli_query($mysqli, "DELETE FROM transaksi_item WHERE ID_TRANSAKSI = '$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //delete keranjang berdasarkan id

$queryDeleteTransaksi = mysqli_query($mysqli, "DELETE FROM transaksi WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli)); //mengurangi total di transaki

if ($queryDeleteTransaksi) {
	header("Location: data-pengembalian.php"); //go to page data-transaksi
}
