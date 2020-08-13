<?php
session_start();

include "koneksi/koneksi.php"; // ambil koneksi;
$jumlahSet = $total = $idPengiriman = 0; // definisi awal variabel

$idTrans = $_GET['ID_TRANS'];

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
      move_uploaded_file($file_tmp, "img/Uploads/denda/" . $file_name_bukti); //dimasukin ke folder

      date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
      $time = date("Y-m-d H:i:s");

      //masukin data ke transaksi
      $queryInsert = mysqli_query($mysqli, "UPDATE transaksi SET STATUS='belum konfirmasi denda', BUKTI_DENDA='$file_name_bukti', TGL_PEMBAYARAN_DENDA='$time'  WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

      header("Location: ProfilBar.php"); //go to page profilbar
   } 
}
