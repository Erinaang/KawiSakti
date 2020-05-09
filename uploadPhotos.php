<?php
session_start();

include "koneksi/koneksi.php"; // ambil koneksi;

if (isset($_FILES['foto'])) {
   $errors = array();
   $file_name = $_FILES['foto']['name'];
   $file_size = $_FILES['foto']['size'];
   $file_tmp = $_FILES['foto']['tmp_name'];
   $file_type = $_FILES['foto']['type'];
   $file_ext = strtolower(end(explode('.', $_FILES['foto']['name'])));

   $extensions = array("jpeg", "jpg", "png");

   if (in_array($file_ext, $extensions) === false) {
      $errors[] = "ekstensi tidak diperbolehkan, silahkan gunakan ekstensi JPEG atau PNG.";
   }

   if ($file_size > 2097152) {
      $errors[] = 'Ukuran maksimal foto adalah 2 MB';
   }

   if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "img/users/" . $file_name);

      echo $file_name;
   } else {
      print_r($errors);
   }
}