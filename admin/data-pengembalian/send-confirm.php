<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: ../index.php");
}
include "../connection/Connection.php";
$index = 1;
$totalDendaAkhir = 0;
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
$detailItem = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

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
$mail->FromName     = "Kawi Sakti";      //nama pengirim
$mail->AddAddress($emailPenyewa, "Dengan PT Kawi Sakti disini."); //email yang tujuan dan nama
$mail->Subject      =  "Pemberitahuan dari PT KSM"; //subject
$mail->Body         =  '<b>proses penyewaan telah diselesaikan . Terimakasih sudah menyewa di PT kawi sakti megah</b><br> 

<h2>Denda</h2> <br>
<table class="table table-condensed">

<thead>
  <tr>
    <th>No.</th>
    <th>Frame</th>
    <th>Jumlah Set x Harga (Rp.)</th>
    <th>Total Harga (Rp.)</th>
  </tr>
</thead>
<tbody>';

//tabel yang ada di email
while ($show = mysqli_fetch_array($detailItem)) {
  $setRusak = $show['SET_RUSAK'];
  $biayaRusak = $show['BIAYA_RUSAK'];
  $totalDenda = $biayaRusak * $setRusak;
  $totalDendaAkhir = $totalDendaAkhir + $totalDenda;

  $mail->Body         .=    '<tr>
      <td>' . $index++ . '</td>
      <td>' . $show['FRAME'] . ' Hari</td>
      <td>' . $setRusak . ' Set x Rp. ' . $biayaRusak . ',00</td>
      <td>Rp. ' . $totalDenda . ',00</td>
    </tr>';
}
$mail->Body         .= '<tr>
    <td colspan="2"> </td>
    <td><b> Sub Total : </b></td>
    <td><b> Rp. ' . $totalDendaAkhir . '</b></td>
  </tr>
</tbody>
</table>
<br> <br> <br>';


if ($mail->Send()) {

  //update status keranjang dan transaksi menjadi "dikirim"
  $queryConfirm = mysqli_query($mysqli, "UPDATE transaksi SET STATUS='selesai' WHERE id_transaksi='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

  $sendLog = mysqli_query($mysqli, " SELECT *, us.NAMA as NAMA_PENYEWA, us.ALAMAT as ALAMAT_PENYEWA, pr.NAMA as JENIS_PENGIRIMAN FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_TRANSAKSI=$idTrans") or die("data salah: " . mysqli_error($mysqli));
  while ($show = mysqli_fetch_array($sendLog)) {
    $namaPenyewa = $show['NAMA_PENYEWA'];
    $noTelp= $show['NO_TELP'];
    $alamatPenyewa = $show['ALAMAT_PENYEWA'];
    $jenisPengiriman = $show['JENIS_PENGIRIMAN'];
    $ongkir = $show['BIAYA'];
    $bktPembayaran = $show['BUKTI_PEMBAYARAN'];
    $bktKtp = $show['BUKTI_KTP'];
    $alamat = $show['ALAMAT'];
    $proyek = $show['PROYEK'];
    $jamPesan = $show['JAM_PEMESANAN'];
    $tglSewa = $show['TGL_SEWA'];
    $tglKembali= $show['TGL_KEMBALI'];
    $status = $show['STATUS'];
    $frame = $show['FRAME'];
    $masaSewa = $show['MASA_SEWA'];
    $jmlSet = $show['JUMLAH_SET'];
    $harga = $show['HARGA'];
    $setRusak = $show['SET_RUSAK'];
    $biayaRusak = $show['BIAYA_RUSAK'];
    
    $updateStok = mysqli_query($mysqli, "UPDATE `stok` SET STOK=STOK+'$jmlSet' WHERE FRAME='$frame'") or die("data salah: " . mysqli_error($mysqli));

    $insertLog = mysqli_query($mysqli, "INSERT INTO `log_transaksi`(`ID_LOG_TRANSAKSI`,`NAMA_PENYEWA`, `NO_TELP`, `ALAMAT_PENYEWA`, `NAMA_ADMIN`, `JENIS_PENGIRIMAN`, `ONGKIR`, `BUKIT_PEMBAYARAN`, `BUKTI_KTP`, `ALAMAT`, `PROYEK`, `JAM_PEMESANAN`, `TGL_SEWA`, `TGL_KEMBALI`, `STATUS`) VALUES ('$idTrans','$namaPenyewa','$noTelp','$alamatPenyewa','$namaAdmin','$jenisPengiriman','$ongkir','$bktPembayaran','$bktKtp','$alamat','$proyek','$jamPesan','$tglSewa','$tglKembali','$status')");
    $insertLogItem = mysqli_query($mysqli, "INSERT INTO `log_item`(`ID_LOG_TRANSAKSI`, `FRAME`, `MASA_SEWA`, `JUMLAH_SET`, `HARGA`, `SET_RUSAK`, `BIAYA`) VALUES ('$idTrans','$frame','$masaSewa','$jmlSet','$harga','$setRusak','$biayaRusak')") or die("data salah: " . mysqli_error($mysqli));

  }


  if ($queryConfirm) {

    echo '<script>
    alert("Transaksi telah diproses.");
    location.href="../data-riwayat/data-riwayat.php";
    </script>
    ';
  }
} else {
  // echo "error:". error_reporting(E_ALL);
}
/// end kirim email
