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
   $tanggal = $_POST['tanggal']; // dari form checkout
   $alamat = $_POST['alamat']; // dari form checkout
   $kota = $_POST['kota']; // dari form checkout
   $proyek = $_POST['proyek'];
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
      $selectKeranjang = mysqli_query($mysqli, "SELECT SUM(JUMLAH_SET) AS jml, pk.MASA_SEWA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans' AND tr.STATUS='checkout'") or die("data salah: " . mysqli_error($mysqli));
      while ($show = mysqli_fetch_array($selectKeranjang)) {
         $jumlahSet = $jumlahSet + $show['jml'];
         $masaSewa = $show['MASA_SEWA'];
      }

      //menghitung tanggal kembali berdasarkan tanggal sewa + masa sewa
      $tgl_kembali = date('Y-m-d', strtotime('+' . $masaSewa . ' days', strtotime(str_replace('/', '-', $tanggal)))) . PHP_EOL;


      if ($jumlahSet < 150) { //kalo jumlahnya kurang dari 150 
         $idPengiriman = 1; //pickup
      } elseif ($jumlahSet < 500 || $jumlahSet > 500) { //kalo kurang dari 500 dan lebih dari 500
         $idPengiriman = 2; // truk kecil
      } elseif ($jumlahSet > 700) { // kalo lebih dari 700
         $idPengiriman = 3; //truk besar
      }
      date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
      $time = date("Y-m-d H:i:s");

      //masukin data ke transaksi
      $queryInsert = mysqli_query($mysqli, "UPDATE transaksi SET ID_PENGIRIMAN='$idPengiriman', STATUS='terkirim', BUKTI_PEMBAYARAN='$file_name_bukti', 
      BUKTI_KTP='$file_name', ALAMAT='$alamat', PROYEK='$proyek', JAM_PEMESANAN='$time', TGL_SEWA='$tanggal', 
      TGL_KEMBALI='$tgl_kembali' WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

      header("Location: ProfilBar.php"); //go to page profilbar
   } else {
      // print_r($errors);
   }
}
