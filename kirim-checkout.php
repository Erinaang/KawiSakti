<?php

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin/login.php");
}

include "koneksi/koneksi.php";

$idUser = $_GET['id_user'];
$tanggal = $_GET['tanggal'];
date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d H:i:s");

$queryCheckout = mysqli_query($mysqli, "UPDATE keranjang SET jam_pemesanan='$time', status = 'checkout' WHERE id_penyewa='$idUser' AND tanggal='$tanggal' ") or die("data salah: " . mysqli_error($mysqli));

header("Location: ProfilBar.php");
