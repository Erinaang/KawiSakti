<?php 
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}

include "../connection/Connection.php";
$id_paket = $_GET['ID_PAKET']; 
$queryDeletePaket = mysqli_query($mysqli, "DELETE FROM paket WHERE ID_PAKET = '$id_paket'") or die("data salah: " . mysqli_error($mysqli));

if ($queryDeletePaket) {
	echo "<script>alert('Data berhasil dihapus');location.href='data-barang.php'</script>";
}
?>