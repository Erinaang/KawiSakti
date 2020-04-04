<?php

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin_kaw/index.php.php");
}
include "koneksi/koneksi.php";

$idUser = $_GET['id_user'];
$tanggal = $_GET['tanggal'];
date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d");

//GET IDUSER
$username = $_SESSION['username'];
$queryCheckout = mysqli_query($mysqli, "UPDATE transaksi SET status = 'checkout' WHERE id_penyewa='$idUser' AND tgl_sewa='$tanggal' ") or die("data salah: " . mysqli_error($mysqli));

header("Location: ProfilBar.php");