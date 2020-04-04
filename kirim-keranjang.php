<?php 

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin_kaw/index.php.php");
}
include "koneksi/koneksi.php";

$masaSewa = $_GET['masa_sewa'];
date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d");

//GET IDUSER
$username = $_SESSION['username'];
$queryIdUser = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryIdUser)) { 
    $idUser = $show['id_user'];
}

if(isset($_GET['submit'])){
    $idPaket=$_GET['id_paket'];
    $tanggal = $time;

    $queryAddKeranjang = mysqli_query($mysqli, "INSERT INTO transaksi SET id_penyewa='$idUser', id_paket='$idPaket', tgl_sewa='$tanggal', status='cart'") or die("data salah: " . mysqli_error($mysqli));

if ($queryAddKeranjang) {
	header("Location: profilBar.php?masa_sewa=$masaSewa");
}
    

}


?>