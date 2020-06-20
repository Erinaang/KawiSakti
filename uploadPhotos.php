<?php
session_start();

include "koneksi/koneksi.php"; // ambil koneksi;

$username = $_SESSION['username'];
if (isset($_POST['submit'])) {
   $errors = array();
   $file_name = $_FILES['foto']['name'];
   $file_size = $_FILES['foto']['size'];
   $file_tmp = $_FILES['foto']['tmp_name'];
   $file_type = $_FILES['foto']['type'];
   $tmp = explode('.', $_FILES['foto']['name']);
   $file_ext = strtolower(end($tmp));

   $extensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG");

   if (in_array($file_ext, $extensions) === false) {
      $errors[] = "ekstensi tidak diperbolehkan, silahkan gunakan ekstensi JPEG atau PNG.";
   }

   if ($file_size > 2097152) {
      $errors[] = 'Ukuran maksimal foto adalah 2 MB';
   }

   if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "img/users/" . $file_name); //masukin ke folder

      $queryUser = mysqli_query($mysqli, "UPDATE user SET FOTO='$file_name' WHERE USERNAME='$username'") or die("data salah: " . mysqli_error($mysqli));

      header("Location: ProfilBar.php");
   } else {
      print_r($errors);
   }
}