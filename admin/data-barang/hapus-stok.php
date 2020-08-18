<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}

include "../connection/Connection.php";
$idStok = $_GET['ID_STOK'];

$selectFrame = mysqli_query($mysqli, "SELECT FRAME FROM stok WHERE ID_STOK='$idStok'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($selectFrame)) {
    $frame = $show['FRAME'];
}

$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM paket WHERE FRAME= '$frame'") or die("data salah: " . mysqli_error($mysqli));
$queryDeleteStok = mysqli_query($mysqli, "DELETE FROM stok WHERE ID_STOK = '$idStok'") or die("data salah: " . mysqli_error($mysqli));


if ($queryDeleteStok) {
    echo "<script>alert('Data berhasil dihapus');location.href='data-barang.php'</script>";
}
