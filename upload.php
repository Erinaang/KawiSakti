<?php
session_start();

include "koneksi/koneksi.php";
$jumlahSet = $idPengiriman = 0;

if (isset($_FILES['bukti_pembayaran'])) {
   $errors = array();
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
      move_uploaded_file($file_tmp, "img/Uploads/pembayaran/" . $file_name_bukti);
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
   echo $alamat = $_POST['alamat'];
   echo $kota = $_POST['kota'];
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
      move_uploaded_file($file_tmp, "img/Uploads/ktp/" . $file_name);

      $selectKeranjang = mysqli_query($mysqli, "SELECT *, sum(jumlah_set) as jml FROM keranjang AS kr JOIN paket AS pk ON kr.id_paket = pk.id_paket WHERE id_penyewa = '$idUser' AND tanggal='$tanggal' AND status='Checkout'") or die("data salah: " . mysqli_error($mysqli));
      while ($show = mysqli_fetch_array($selectKeranjang)) {
         $jumlahSet = $show['jml'];
         $masaSewa = $show['masa_sewa'];
         $total = $total + $show['total'];
         $jaminan = $total * (30 / 100);
         $total = $total + $jaminan;
      }
      $tgl_kembali = date('Y-m-d', strtotime('+' . $masaSewa . ' days', strtotime(str_replace('/', '-', $tanggal)))) . PHP_EOL;
      if ($jumlahSet < 150) {
         $idPengiriman = 1;
         $total = $total + 500000;
      } elseif ($jumlahSet < 500 || $jumlahSet > 500) {
         $idPengiriman = 2;
         $total = $total + 700000;
      } elseif ($jumlahSet > 700) {
         $idPengiriman = 3;
         $total = $total + 1000000;
      }

 
      $queryInsert = mysqli_query($mysqli, "INSERT INTO transaksi SET id_penyewa='$idUser', total='$total', jaminan='$jaminan', 
      id_pengiriman='$idPengiriman', status='Terkirim', bukti_pembayaran='$file_name_bukti', 
      bukti_ktp='$file_name', alamat='$alamat', kota='$kota', tgl_sewa='$tanggal', 
      tgl_kembali='$tgl_kembali'") or die("data salah: " . mysqli_error($mysqli));


      $queryRiwayat = mysqli_query($mysqli, "UPDATE `keranjang` SET status='Terkirim' WHERE `tanggal`='$tanggal' and id_penyewa='$idUser' and status='checkout'") or die("data salah: " . mysqli_error($mysqli));

      header("Location: profilBar.php");
   } else {
      print_r($errors);
   }
}
