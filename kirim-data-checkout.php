<?php
session_start();

include "koneksi/koneksi.php"; // ambil koneksi;
$jumlahSet = $total = $idPengiriman = 0; // definisi awal variabel

if (isset($_POST['submit'])) {
   $errors = array();
   $idPenyewa = $_GET['ID_PENYEWA']; //ambil id user dari URL
   $idTrans = $_GET['ID_TRANS']; //ambil jam pesan dari URL
   $tanggal = $_POST['tanggal']; // dari form checkout
   $alamat = $_POST['alamat']; // dari form checkout
   $proyek = $_POST['proyek'];

   //SELECT KERANJANG buat dimasukin ke tabel transaksi
   $selectKeranjang = mysqli_query($mysqli, "SELECT pk.MASA_SEWA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans' AND tr.STATUS='checkout'") or die("data salah: " . mysqli_error($mysqli));
   while ($show = mysqli_fetch_array($selectKeranjang)) {
      $masaSewa = $show['MASA_SEWA'];
   }

   //menghitung tanggal kembali berdasarkan tanggal sewa + masa sewa
   $tglJatuhTempo = date('Y-m-d', strtotime('+' . $masaSewa . ' days', strtotime(str_replace('/', '-', $tanggal)))) . PHP_EOL;

   date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
   $time = date("Y-m-d H:i:s");

   //masukin data ke transaksi
   $queryInsert = mysqli_query($mysqli, "UPDATE transaksi SET STATUS='belum konfirmasi', ALAMAT='$alamat', PROYEK='$proyek', JAM_PEMESANAN='$time', TGL_SEWA='$tanggal', 
      TGL_JATUH_TEMPO='$tglJatuhTempo' WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

   header("Location: ProfilBar.php"); //go to page profilbar
} else {
   echo "error";
}
