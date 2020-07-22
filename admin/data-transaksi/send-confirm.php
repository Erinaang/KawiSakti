<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: ../index.php");
}
include "../connection/Connection.php";
$index = 1;
$totalHarga = 0;
//ambil id dan nama admin berdasarkan USERNAME (yang lagi login)
$username = $_SESSION['username'];
$queryAdmin = mysqli_query($mysqli, "SELECT * FROM user WHERE USERNAME='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryAdmin)) {
  $namaAdmin = $show['NAMA'];
  $idAdmin = $show['ID_USER'];
}

//ambil dari URL
$idTrans = $_GET['ID_TRANS'];
$idPenyewa = $_GET['ID_PENYEWA'];

/// SELECT data barang di email
$UpdateIdAdmin = mysqli_query($mysqli, "UPDATE transaksi SET ID_ADMIN='$idAdmin' WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));


/// SELECT data barang di email
$detailItem = mysqli_query($mysqli, "SELECT tr.ID_TRANSAKSI, tr.JAM_PEMESANAN, ti.ID_TRANSAKSI_ITEM, pr.BIAYA, ti.ID_TRANSAKSI, pk.MASA_SEWA, pk.JUMLAH_SET, ti.HARGA_ITEM FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

$dataPenyewa = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `USER` AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($dataPenyewa)) {
  $namaPenyewa = $show['NAMA'];
  $emailPenyewa = $show['EMAIL'];
}
//KIRIM KE EMAIL
error_reporting(E_ALL);
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';
$mail =  new PHPMailer\PHPMailer1\PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->SMTPAuth     = true;
$mail->Host         = "smtp.gmail.com";
$mail->Port         = 465;
$mail->SMTPSecure     = "ssl";
$mail->Username     = "erinaangg@gmail.com"; //username yang ngirim
$mail->Password     = "maternal781998";   //password email yang ngirim
$mail->From            = "erinaangg@gmail.com"; //email pengirim
$mail->FromName     = "PT. Kawi Sakti Megah";      //nama pengirim
$mail->AddAddress($emailPenyewa, "Dengan PT. Kawi Sakti Megah disini."); //email yang tujuan dan nama
$mail->Subject      =  "Pemberitahuan dari PT Kawi Sakti Megah"; //subject
$mail->Body         =  '<b>Hai, pelanggan PT. Kawi Sakti Megah. Barang yang anda sewa akan segera dikirim.</b><br> 
                        <b> RINCIAN PESANAN</b><br><br>

<table class="table table-condensed">
<thead>
  <tr>
    <th>No.</th>
    <th>Masa Sewa (hari) </th>
    <th>Jumlah Set x Harga (Rp.)</th>
    <th>Total Harga (Rp.)</th>
  </tr>
</thead>
<tbody>
';

//tabel yang ada di email
while ($show = mysqli_fetch_array($detailItem)) {
  $idTrans = $show['ID_TRANSAKSI'];
  $idTransItem = $show['ID_TRANSAKSI_ITEM'];
  $ongkir = $show['BIAYA'];
  $masaSewa = $show['MASA_SEWA'];
  $hargaItem = $show['HARGA_ITEM'];
  $jumlahSet = $show['JUMLAH_SET'];
  $jamPemesanan = $show['JAM_PEMESANAN'];

  $totalPaket = $hargaItem * $jumlahSet;
  $totalHarga = $totalHarga + $totalPaket;
  $jaminan = $totalHarga * (30 / 100);
  $totalPembayaran = $totalHarga + $ongkir + $jaminan;

  $mail->Body         .=    '<tr>
      <td>' . $index++ . '</td>
      <td>' . $masaSewa . ' Hari</td>
      <td>' . $jumlahSet . ' Set x Rp. ' . $hargaItem . ',00</td>
      <td>Rp. ' . $totalPaket . ',00</td>
    </tr>';
}
$mail->Body         .= '<tr>
    <td colspan="2"> </td>
    <td><b> Sub Total : </b></td>
    <td><b> Rp. ' . $totalHarga . '</b></td>
  </tr>
  <tr>
    <td colspan="2"> </td>
    <td><b> Jaminan : </b></td>
    <td><b>Rp. ' . $jaminan . ' (30%) </b></td>
  </tr>
  <tr>
    <td colspan="2"> </td>
    <td><b> Ongkos Kirim : </b></td>
    <td><b>Rp. ' . $ongkir . '</b></td>
  </tr>
  <tr>
    <td colspan="2"> </td>
    <td><b> Total Harga : </b></td>
    <td><b>Rp. ' . $totalPembayaran . '</b></td>
  </tr>
</tbody>
</table>';
if ($mail->Send()) {

  //update status keranjang dan transaksi menjadi "dikirim"
  $queryConfirm = mysqli_query($mysqli, "UPDATE transaksi SET STATUS='dikirim' WHERE id_transaksi='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

  if ($queryConfirm) {

    echo '<script>
    alert("Transaksi telah diproses.");
    location.href="data-transaksi.php";
    </script>
    ';
  }
} else {
  // echo "error:" . error_reporting(E_ALL);
}
/// end kirim email
