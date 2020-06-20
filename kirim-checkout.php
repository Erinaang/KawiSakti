<?php

session_start();
if (!isset($_SESSION["username"])) { // Kalo ga login, harus ke login dulu
    header("Location: admin/login.php");
}

include "koneksi/koneksi.php"; // ambil koneksi;

$idPenyewa = $_GET['ID_PENYEWA']; //ambil id_user dari URL
echo $jaminan = $_GET['JAMINAN'];



date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d H:i:s");

$updateCheckout = mysqli_query($mysqli, "UPDATE transaksi SET STATUS = 'checkout', JAMINAN='$jaminan', JAM_PEMESANAN='$time' WHERE ID_PENYEWA='$idPenyewa'") or die("data salah: " . mysqli_error($mysqli));

header("Location: profilBar.php"); //go to page profilbar
