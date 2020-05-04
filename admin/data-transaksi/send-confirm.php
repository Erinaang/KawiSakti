<?php
session_start();
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

$queryConfirm = mysqli_query($mysqli, "UPDATE transaksi SET id_admin='$idAdmin', status='Dikirim' WHERE id_transaksi='$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));


$queryRiwayat = mysqli_query($mysqli, "UPDATE `keranjang` SET status='Dikirim' WHERE `tanggal`='$tanggal' and id_penyewa='$id_penyewa' and status='Terkirim'") or die("data salah: " . mysqli_error($mysqli));

// if ($queryConfirm) {

    echo '<script>
    window.open("../../print.php?id_transaksi=' . $id_transaksi . '&id_penyewa=' . $id_penyewa . '&tanggal=' . $tanggal . '&status=' . $status . '&id_pengiriman=' . $id_pengiriman.'","_blank");
    alert("Transaksi telah diproses.");
    
    location.href="data-transaksi.php";
    
    
    </script>
    ';
// }
?>