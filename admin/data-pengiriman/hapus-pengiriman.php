<?php 
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}

include "../connection/Connection.php";
$idPengiriman = $_GET['ID_PENGIRIMAN']; 

$queryUpdateTransaksi= mysqli_query($mysqli, "UPDATE `transaksi` SET ID_PENGIRIMAN=NULL WHERE ID_PENGIRIMAN='$idPengiriman'") or die("data salah: " . mysqli_error($mysqli));

$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM pengiriman WHERE ID_PENGIRIMAN = '$idPengiriman'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeletePaket) {
	header("Location: data-pengiriman.php");
}
?>