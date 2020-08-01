<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}

include "../connection/Connection.php";
$idPaket = $_GET['ID_PAKET'];
// $queryDeletePaket = mysqli_query($mysqli, "DELETE FROM paket WHERE ID_PAKET = '$id_paket'") or die("data salah: " . mysqli_error($mysqli));

$selectFrame = mysqli_query($mysqli, "SELECT FRAME FROM paket WHERE ID_PAKET='$idPaket'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($selectFrame)) {
    $frame = $show['FRAME'];
}

$cek = mysqli_query($mysqli, "SELECT * FROM paket WHERE FRAME='$frame'") or die("data salah: " . mysqli_error($mysqli));
$result   = mysqli_num_rows($cek);

if ($result >= 2) {
    $queryDeletePaket = mysqli_query($mysqli, "DELETE FROM paket WHERE ID_PAKET = '$idPaket'") or die("data salah: " . mysqli_error($mysqli));
} else {
    $queryDeletePaket = mysqli_query($mysqli, "DELETE FROM paket WHERE ID_PAKET = '$idPaket'") or die("data salah: " . mysqli_error($mysqli));
    $queryDeleteStok = mysqli_query($mysqli, "DELETE FROM stok WHERE FRAME = '$frame'") or die("data salah: " . mysqli_error($mysqli));
}

if ($queryDeletePaket) {
    echo "<script>alert('Data berhasil dihapus');location.href='data-barang.php'</script>";
}
