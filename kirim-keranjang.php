<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin/login.php");
}
include "koneksi/koneksi.php"; // ambil koneksi;

$masaSewa = $_GET['masa_sewa'];
date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d");

//GET IDUSER dari USERNAME (yg lagi login)
$username = $_SESSION['username'];
$queryIdUser = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryIdUser)) {
    $idUser = $show['id_user'];
}

if (isset($_GET['submit'])) {
    $idPaket = $_GET['id_paket'];
    $jamPesan = $time;

    
//ambil data paket berdasarkan ID yang bakal dimasukin ke keranjang
    $selectPaket = mysqli_query($mysqli, "SELECT * FROM paket WHERE id_paket='$idPaket'") or die("data salah: " . mysqli_error($mysqli));
    while ($show = mysqli_fetch_array($selectPaket)) {
        $jumlahSet = $show['jumlah_set'];
        $harga = $show['harga'];
        $total = $jumlahSet * $harga;
    }


//masukin data dari paket ke keranjang
    $queryAddKeranjang = mysqli_query($mysqli, "INSERT INTO keranjang SET id_penyewa='$idUser', id_paket='$idPaket', jam_pemesanan = '$jamPesan', status='cart', total='$total'") or die("data salah: " . mysqli_error($mysqli));

    if ($queryAddKeranjang) {
        header("Location: profilBar.php"); //go to page profilbar
    }
}
