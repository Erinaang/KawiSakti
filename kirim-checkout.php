<?php

session_start();
if (!isset($_SESSION["username"])) { // Kalo ga login, harus ke login dulu
    header("Location: admin/login.php");
}

include "koneksi/koneksi.php"; // ambil koneksi;

$idUser = $_GET['id_user']; //ambil id_user dari URL
$jamPesan = $_GET['tanggal']; //ambil jam_pesan dari URL


date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d H:i:s");

$queryCheckout = mysqli_query($mysqli, "UPDATE keranjang SET status = 'checkout', jam_pemesanan='$time' WHERE id_penyewa='$idUser' AND jam_pemesanan='$jamPesan' ") or die("data salah: " . mysqli_error($mysqli));

header("Location: profilBar.php"); //go to page profilbar
