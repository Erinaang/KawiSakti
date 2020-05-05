<?php
session_start();
include "../connection/Connection.php";

$username = $_SESSION['username'];

$queryAdmin = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'") or die("data salah: " . mysqli_error($mysqli));

while ($show = mysqli_fetch_array($queryAdmin)) {
  $namaAdmin = $show['nama'];
  $idAdmin = $show['id_user'];
}

$id_transaksi = $_GET['id_transaksi'];
$tanggal = $_GET['tanggal'];
$id_penyewa = $_GET['id_penyewa'];
$status = $_GET['status'];
$id_pengiriman = $_GET['id_pengiriman'];


/// kirim email
$queryPrint = mysqli_query($mysqli, "SELECT * FROM keranjang AS kr JOIN paket AS pk ON kr.id_paket = pk.id_paket WHERE id_penyewa='$id_penyewa' AND status='$status' AND tanggal='$tanggal'") or die("data salah: " . mysqli_error($mysqli));

$queryPengiriman = mysqli_query($mysqli, "SELECT * FROM pengiriman WHERE id_pengiriman='$id_pengiriman'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryPengiriman)) {
  $ongkir = $show['biaya'];
}

$queryTransaksi = mysqli_query($mysqli, "SELECT pny.nama as penyewa, adm.nama as admin, tr.* FROM transaksi AS tr JOIN user AS pny ON tr.id_penyewa = pny.id_user JOIN user AS adm ON tr.id_admin = adm.id_user WHERE id_transaksi='$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryTransaksi)) {
  $totalHarga = $show['total'];
  $jaminan = $show['jaminan'];
  $tglSewa = $show['tgl_sewa'];
  $tglKembali = $show['tgl_kembali'];
  $namaPenyewa = $show['penyewa'];
  $namaAdmin = $show['admin'];
}

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
$mail->Username     = "kikirabdullah@gmail.com"; //username SMTP
$mail->Password     = "k1k1r12k499";   //password SMTP
$mail->From            = "kikirabdullah@gmail.com"; //sender email
$mail->FromName     = "Kawi Sakti";      //sender name
$mail->AddAddress("kikirabdullah@gmail.com", "Hallo, Kawi Sakti disini."); //recipient: email and name
$mail->Subject      =  "Percobaan";
$mail->Body         =  '<b>Barang Anda akan dikirim</b><br>

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
while ($show = mysqli_fetch_array($queryPrint)) {
  $total = $total + $show['total'];
  $jaminan = $total * (30 / 100);

  $mail->Body         .=    '<tr>
      <td>' . $index++ . '</td>
      <td>' . $show['masa_sewa'] . ' Hari</td>
      <td>' . $show['jumlah_set'] . ' Set x Rp. ' . $show['harga'] . ',00</td>
      <td>Rp. ' . $show['total'] . ',00</td>
    </tr>';
}
$mail->Body         .= '<tr>
    <td colspan="2"> </td>
    <td><b> Sub Total : </b></td>
    <td><b> Rp. ' . $total . '</b></td>
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
    <td><b>Rp. ' . $totalHarga . '</b></td>
  </tr>
</tbody>
</table>';
// $mail->AddAttachment("/cpanel.png","filesaya");
if ($mail->Send()) {
  $queryConfirm = mysqli_query($mysqli, "UPDATE transaksi SET id_admin='$idAdmin', status='Dikirim' WHERE id_transaksi='$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));

  $queryRiwayat = mysqli_query($mysqli, "UPDATE `keranjang` SET status='Dikirim' WHERE `tanggal`='$tanggal' and id_penyewa='$id_penyewa' and status='Terkirim'") or die("data salah: " . mysqli_error($mysqli));


  if ($queryConfirm) {

    echo '<script>
    alert("Transaksi telah diproses.");
    location.href="data-transaksi.php";
    </script>
    ';
  }
} else {
  echo error_reporting(E_ALL);
}
/// end kirim email
