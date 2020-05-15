<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}
include "../connection/Connection.php";

$username = $_SESSION['username'];

$queryAdmin = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'") or die("data salah: " . mysqli_error($mysqli));

while ($show = mysqli_fetch_array($queryAdmin)) {
  $namaAdmin = $show['nama'];
  $idAdmin = $show['id_user'];

}

$id_transaksi = $_GET['id_transaksi'];
$tanggal = $_GET['tanggal'];
$id_penyewa= $_GET['id_penyewa'];
$status = $_GET['status'];
$id_pengiriman = $_GET['id_pengiriman'];

$queryKembali = mysqli_query($mysqli, "UPDATE transaksi SET id_admin='$idAdmin', status='Selesai' WHERE id_transaksi='$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));

$queryRiwayat = mysqli_query($mysqli, "UPDATE `keranjang` SET status='Selesai' WHERE `tanggal`='$tanggal' and id_penyewa='$id_penyewa' and status='Dikirim'") or die("data salah: " . mysqli_error($mysqli));

if ($queryKembali) {

    echo '<script>
    alert("Transaksi telah diproses.");
    location.href="../data-transaksi/data-transaksi.php";
    </script>
    ';
}
?>