<?php
session_start();
if (!isset($_SESSION["username"])) { // Kalo ga login, harus ke login dulu
    header("Location: admin/login.php");
}

include "koneksi/koneksi.php"; // ambil koneksi;

$idPenyewa = $_GET['ID_PENYEWA']; //ambil id_user dari URL
$idTrans = $_GET['ID_TRANS'];

date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d H:i:s");

//SELECT KERANJANG buat dimasukin ke tabel transaksi
$selectKeranjang = mysqli_query($mysqli, "SELECT SUM(JUMLAH_SET) AS jml FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans' AND tr.STATUS='cart'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($selectKeranjang)) {
   $jumlahSet = $show['jml'];
   $totalSet = $totalSet + $jumlahSet;
}

if ($totalSet < 150) { //kalo jumlahnya kurang dari 150 
   $idPengiriman = 1; //pickup
} elseif ($totalSet < 500 || $totalSet < 700) { //kalo kurang dari 500 dan lebih dari 500
   $idPengiriman = 2; // truk kecil
} elseif ($totalSet > 700) { // kalo lebih dari 700
   $idPengiriman = 3; //truk besar
}

$updateCheckout = mysqli_query($mysqli, "UPDATE transaksi SET ID_PENGIRIMAN='$idPengiriman', STATUS = 'checkout', JAM_PEMESANAN='$time' WHERE ID_PENYEWA='$idPenyewa' AND ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

header("Location: ProfilBar.php"); //go to page profilbar
