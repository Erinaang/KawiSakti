<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}
include "../connection/Connection.php";
$id_transaksi = $GET['id_transaksi'];
$queryConfirm = mysqli_query($mysqli, "UPDATE transaksi SET status='Dikirim' WHERE id_transaksi='$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));

if ($queryConfirm) {
    // header("Location: data-transaksi.php");
    echo "<script>alert('Transaksi telah dikirim.');location.href='data-transaksi.php'</script>";
}
?>