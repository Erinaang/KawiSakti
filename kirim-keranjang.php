<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin/login.php");
}
include "koneksi/koneksi.php"; // ambil koneksi;
date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d");
$idTransaksi = $status = $masaSewa= NULL;

//GET ID USER dari USERNAME (yg lagi login)
$username = $_SESSION['username'];
$queryIdUser = mysqli_query($mysqli, "SELECT * FROM user WHERE USERNAME='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryIdUser)) {
    $idUser = $show['ID_USER'];
}

$selectTransaksi = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE ID_PENYEWA='$idUser' ORDER BY ID_TRANSAKSI DESC LIMIT 1") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($selectTransaksi)) {
    $idTransaksi = $show['ID_TRANSAKSI'];
    $status = $show['STATUS'];
}

if (isset($_POST['submit'])) {
    $idPaket = $_POST['ID_PAKET'];
    $stok = $_POST['stok'];
    $jamPesan = $time;
    $total = NULL;

    if ($status === 'cart') {
        $selectPaket = mysqli_query($mysqli, "SELECT JUMLAH_SET , MASA_SEWA, HARGA FROM paket WHERE ID_PAKET='$idPaket'") or die("data salah:1 " . mysqli_error($mysqli));
        while ($show = mysqli_fetch_array($selectPaket)) {
            $jumlahSet = $show['JUMLAH_SET'];
            $harga = $show['HARGA'];
            $masaSewa = $show['MASA_SEWA'];
        }
        $insertTransaksiItem = mysqli_query($mysqli, "INSERT INTO transaksi_item SET ID_TRANSAKSI='$idTransaksi', ID_PAKET='$idPaket', HARGA_ITEM='$harga', STOK='$stok'") or die("data salah:2 " . mysqli_error($mysqli));
    } else {
        $insertTransaksi = mysqli_query($mysqli, "INSERT INTO transaksi SET ID_PENYEWA='$idUser', STATUS='cart'") or die("data salah:3 " . mysqli_error($mysqli));
        $selectTransaksi = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE ID_PENYEWA='$idUser' ORDER BY ID_TRANSAKSI DESC LIMIT 1") or die("data salah:4 " . mysqli_error($mysqli));
        while ($show = mysqli_fetch_array($selectTransaksi)) {
            $idTransaksi = $show['ID_TRANSAKSI'];
        }
        $selectPaket = mysqli_query($mysqli, "SELECT JUMLAH_SET , HARGA FROM paket WHERE ID_PAKET='$idPaket'") or die("data salah:5 " . mysqli_error($mysqli));
        while ($show = mysqli_fetch_array($selectPaket)) {
            $jumlahSet = $show['JUMLAH_SET'];
            $harga = $show['HARGA'];
            $total = $jumlahSet * $harga;
        }

        $insertTransaksiItem = mysqli_query($mysqli, "INSERT INTO transaksi_item SET ID_TRANSAKSI='$idTransaksi', ID_PAKET='$idPaket', HARGA_ITEM='$harga', STOK='$stok'") or die("data salah:6 " . mysqli_error($mysqli));
        $UpdateStokPaket = mysqli_query($mysqli, "UPDATE paket SET STOK=STOK-'$stok' WHERE ID_PAKET='$idPaket'") or die("data salah:6 " . mysqli_error($mysqli));
        
    }

    if ($insertTransaksiItem) {
        header("Location: profilBar.php?MASA_SEWA=$masaSewa"); //go to page profilbar
    }
}
