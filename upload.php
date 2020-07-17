<?php
session_start();

include "koneksi/koneksi.php"; // ambil koneksi;
$jumlahSet = $total = $idPengiriman = 0; // definisi awal variabel

if (isset($_FILES['bukti_pembayaran'])) {
   $errors = array();
   $file_name_bukti = $_FILES['bukti_pembayaran']['name']; //ambil nama dari file yang diupload
   $file_size = $_FILES['bukti_pembayaran']['size']; //ambil ukuran dari file yang diupload
   $file_tmp = $_FILES['bukti_pembayaran']['tmp_name'];
   $file_type = $_FILES['bukti_pembayaran']['type']; //ambil tipe dari file yang diupload
   $file_ext = strtolower(end(explode('.', $_FILES['bukti_pembayaran']['name'])));

   $extensions = array("jpeg", "jpg", "png");

   if (in_array($file_ext, $extensions) === false) {
      $errors[] = "ekstensi tidak diperbolehkan, silahkan gunakan ekstensi JPEG atau PNG.";
   }

   if ($file_size > 2097152) {
      $errors[] = 'Ukuran maksimal foto adalah 2 MB';
   }

   if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "img/Uploads/pembayaran/" . $file_name_bukti); //dimasukin ke folder
   } else {
      print_r($errors);
   }
}

if (isset($_FILES['bukti_ktp'])) {
   $errors = array();
   $idPenyewa = $_GET['ID_PENYEWA']; //ambil id user dari URL
   $idTrans = $_GET['ID_TRANS']; //ambil jam pesan dari URL
   $file_name = $_FILES['bukti_ktp']['name'];
   $file_size = $_FILES['bukti_ktp']['size'];
   $file_tmp = $_FILES['bukti_ktp']['tmp_name'];
   $file_type = $_FILES['bukti_ktp']['type'];
   $file_ext = strtolower(end(explode('.', $_FILES['bukti_ktp']['name'])));

   $extensions = array("jpeg", "jpg", "png");

   if (in_array($file_ext, $extensions) === false) {
      $errors[] = "ekstensi tidak diperbolehkan, silahkan gunakan ekstensi JPEG atau PNG.";
   }

   if ($file_size > 2097152) {
      $errors[] = 'Ukuran maksimal foto adalah 2 MB';
   }

   if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "img/Uploads/ktp/" . $file_name); //masukin ke folder

      //SELECT KERANJANG buat dimasukin ke tabel transaksi
      $selectKeranjang = mysqli_query($mysqli, "SELECT pk.MASA_SEWA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans' AND tr.STATUS='checkout'") or die("data salah: " . mysqli_error($mysqli));
      while ($show = mysqli_fetch_array($selectKeranjang)) {
         $masaSewa = $show['MASA_SEWA'];
      }

      date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
      $time = date("Y-m-d H:i:s");

      //masukin data ke transaksi
      $queryInsert = mysqli_query($mysqli, "UPDATE transaksi SET STATUS='terkirim', BUKTI_PEMBAYARAN='$file_name_bukti', 
      BUKTI_KTP='$file_name', JAM_PEMESANAN='$time' WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

      header("Location: ProfilBar.php"); //go to page profilbar
   } else {
      // print_r($errors);
   }
}
