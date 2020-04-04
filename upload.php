<?php
session_start();

include "koneksi/koneksi.php";

if (isset($_FILES['bukti_pembayaran'])) {
   $errors = array();
    $idUser = $_GET['id_user'];
   $tanggal = $_GET['tanggal'];
   $total = $_POST['total'];
   $file_name_bukti = $_FILES['bukti_pembayaran']['name'];
   $file_size = $_FILES['bukti_pembayaran']['size'];
   $file_tmp = $_FILES['bukti_pembayaran']['tmp_name'];
   $file_type = $_FILES['bukti_pembayaran']['type'];
   $file_ext = strtolower(end(explode('.', $_FILES['bukti_pembayaran']['name'])));

   $extensions = array("jpeg", "jpg", "png");

   if (in_array($file_ext, $extensions) === false) {
      $errors[] = "ekstensi tidak diperbolehkan, silahkan gunakan ekstensi JPEG atau PNG.";
   }

   if ($file_size > 2097152) {
      $errors[] = 'Ukuran maksimal foto adalah 2 MB';
   }

   if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "img/Uploads/" . $file_name_bukti);
      //JAM_UPLAOD
      date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
      $time = date("H:i:s");
      // $queryInsert = mysqli_query($mysqli, "UPDATE `transaksi` SET `bukti_pembayaran`='$file_name_bukti',`status`='Terkirim', total='$total' WHERE `tgl_sewa`='$tanggal' and id_penyewa='$idUser' and status='checkout'")or die("data salah: " . mysqli_error($mysqli));

   } else {
      print_r($errors);
   }
}

if (isset($_FILES['bukti_ktp'])) {
   $errors = array();
   $idUser = $_GET['id_user'];
   $tanggal = $_GET['tanggal'];
   $total = $_POST['total'];
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
      move_uploaded_file($file_tmp, "img/Uploads/" . $file_name);
      //JAM_UPLAOD
      date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
      $time = date("H:i:s");
      $queryInsert = mysqli_query($mysqli, "UPDATE `transaksi` SET `bukti_pembayaran`='$file_name_bukti',`bukti_ktp`='$file_name',`status`='Terkirim', total='$total' WHERE `tgl_sewa`='$tanggal' and id_penyewa='$idUser' and status='checkout'")or die("data salah: " . mysqli_error($mysqli));



      header("Location: profilBar.php");
   } else {
      print_r($errors);
   }
}
