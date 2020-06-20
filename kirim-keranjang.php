<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin/login.php");
}
include "koneksi/koneksi.php"; // ambil koneksi;

$masaSewa = $_GET['MASA_SEWA'];
date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d");

//GET ID USER dari USERNAME (yg lagi login)
$username = $_SESSION['username'];
$queryIdUser = mysqli_query($mysqli, "SELECT * FROM user WHERE USERNAME='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryIdUser)) {
    $idUser = $show['ID_USER'];
}

if (isset($_GET['submit'])) {
    $idPaket = $_GET['ID_PAKET'];
    $jamPesan = $time;

    
//ambil data paket berdasarkan ID yang bakal dimasukin ke keranjang
    $selectPaket = mysqli_query($mysqli, "SELECT * FROM paket WHERE id_paket='$idPaket'") or die("data salah: " . mysqli_error($mysqli));
    while ($show = mysqli_fetch_array($selectPaket)) {
        $jumlahSet = $show['JUMLAH_SET'];
        $harga = $show['HARGA'];
        $total = $jumlahSet * $harga;
    }


//masukin data dari paket ke keranjang
    $queryAddKeranjang = mysqli_query($mysqli, "INSERT INTO transaksi_item SET ID_PENYEWA='$idUser', ID_PAKET='$idPaket', JAM_PEMESANAN = '$jamPesan', status='cart', TOTAL='$total'") or die("data salah: " . mysqli_error($mysqli));

    if ($queryAddKeranjang) {
        header("Location: profilBar.php"); //go to page profilbar
    }
}
