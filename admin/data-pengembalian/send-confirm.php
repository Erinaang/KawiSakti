<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("Location: ../index.php");
}
include "../connection/Connection.php";
$index = 1;
$totalDendaAkhir = $denda = $telat = 0;

//ambil dari URL
$idTrans = $_GET['ID_TRANS'];
$idPenyewa = $_GET['ID_PENYEWA'];

date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$today = date("Y-m-d");

//ambil id dan nama admin berdasarkan USERNAME (yang lagi login)
$username = $_SESSION['username'];

//SELECT USER ADMIN
$queryAdmin = mysqli_query($mysqli, "SELECT * FROM user WHERE USERNAME='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryAdmin)) {
  $namaAdmin = $show['NAMA'];
  $idAdmin = $show['ID_USER'];
}

/// SELECT data barang di email
$detailItem = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

$cekDenda = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($cekDenda)) {
  $set = $show['SET_RUSAK'];
  $biaya = $show['BIAYA_RUSAK'];
  $denda = $biaya * $set;
}

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
$mail->Body         =  '<b>proses penyewaan telah diselesaikan . Terimakasih sudah menyewa di PT kawi sakti megah</b><br>';
if ($denda >= 1) {
  $mail->Body .= '
  <h2>Denda</h2> <br>
  <table border="2">
  
  <thead>
    <tr>
      <th>No.</th>
      <th>Frame</th>
      <th>Jumlah Set x Harga (Rp.)</th>
      <th>Total Harga (Rp.)</th>
    </tr>
  </thead>
  <tbody>';
}

//tabel yang ada di email
while ($show = mysqli_fetch_array($detailItem)) {
  $tglSewa = $show['TGL_SEWA'];
  $tglJatuhTempo = $show['TGL_JATUH_TEMPO'];
  $datetime1 = strtotime($today);
  $datetime2 = strtotime($tglJatuhTempo);
  $secs = $datetime1 - $datetime2;
  $telat = $secs / 86400;

  $totalTelat = 100000 * $telat;

  $setRusak = $show['SET_RUSAK'];
  $biayaRusak = $show['BIAYA_RUSAK'];
  $totalDenda = $biayaRusak * $setRusak;
  $totalDendaAkhir = $totalDendaAkhir + $totalDenda;

  $total = $totalDendaAkhir + $totalTelat;
  if ($denda >= 1) {
    $mail->Body .= '<tr>
                      <td>' . $index++ . '</td>
                      <td>' . $show['FRAME'] . ' Hari</td>
                      <td>' . $setRusak . ' Set x Rp. ' . $biayaRusak . ',00</td>
                      <td>Rp. ' . number_format($totalDenda, 2, ",", ".") . ',00</td>
                    </tr>';
  }
}
if ($denda >= 1) {
  $mail->Body   .= '<tr>
                      <td colspan="2"> </td>
                      <td><b> Sub Total : </b></td>
                      <td><b> Rp. ' . number_format($totalDendaAkhir, 2, ",", ".") . '</b></td>
                    </tr>
                    </tbody>
                    </table>
                    <br>';
}


if ($telat >= 1) {
  $mail->Body  .=
    '<h2>Keterlambatan</h2> <br>
                <table border="2">
                  <thead>
                      <th>Judul</th>
                      <th>Tgl Sewa</th>
                      <th>Tgl Jatuh Tempo</th>
                      <th>Terlambatan</th>
                  </thead>
                  <tbody>
                      <tr>
                          <td>Keterlambatan</td>
                          <td>' . $tglSewa . '</td>
                          <td>' . $tglJatuhTempo . '</td>
                          <td>' . $telat . ' Hari</td>
                      </tr>
                  </tbody>
                </table>
                <br>';
}

if ($denda > 0 && $telat > 0) {
  $mail->Body  .= 'Total Pembayaran tambahan yaitu sebesar Rp.' . number_format($total, 2, ",", ".") . '(Total Denda + Total Keterlambatan Rp.100.000,00/hari)
                  <br><br>';
} elseif ($denda > 0 && $telat == 0) {
  $mail->Body  .= 'Total Pembayaran tambahan yaitu sebesar Rp.' . number_format($total, 2, ",", ".") . '(Total Denda)
                  <br><br>';
} elseif ($denda == 0 && $telat > 0) {
  $mail->Body  .= 'Total Pembayaran tambahan yaitu sebesar Rp.' . number_format($total, 2, ",", ".") . '(Total Keterlambatan Rp.100.000,00/hari)
                  <br><br>';
}

$mail->Body  .= 'Terima Kasih <br>
                  Malang, ' . $tglKembali . '<br><br><br>
                  PT. Kawi Sakti Megah';


if ($mail->Send()) {


  //update status keranjang dan transaksi menjadi "dikirim"
  $queryConfirm = mysqli_query($mysqli, "UPDATE transaksi SET TGL_KEMBALI='$today', STATUS='selesai' WHERE id_transaksi='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

  $sendLog = mysqli_query($mysqli, " SELECT *, us.NAMA as NAMA_PENYEWA, us.ALAMAT as ALAMAT_PENYEWA, pr.NAMA as JENIS_PENGIRIMAN, tr.STATUS AS statusTrans FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_TRANSAKSI=$idTrans") or die("data salah: " . mysqli_error($mysqli));
  while ($show = mysqli_fetch_array($sendLog)) {
    $namaPenyewa = $show['NAMA_PENYEWA'];
    $noTelp = $show['NO_TELP'];
    $alamatPenyewa = $show['ALAMAT_PENYEWA'];
    $jenisPengiriman = $show['JENIS_PENGIRIMAN'];
    $ongkir = $show['BIAYA'];
    $bktPembayaran = $show['BUKTI_PEMBAYARAN'];
    $bktKtp = $show['BUKTI_KTP'];
    $alamat = $show['ALAMAT'];
    $proyek = $show['PROYEK'];
    $jamPesan = $show['JAM_PEMESANAN'];
    $tglSewa = $show['TGL_SEWA'];
    $tglJatuhTempo = $show['TGL_JATUH_TEMPO'];
    $tglKembali = $show['TGL_KEMBALI'];
    $status = $show['statusTrans'];
    $frame = $show['FRAME'];
    $masaSewa = $show['MASA_SEWA'];
    $jmlSet = $show['JUMLAH_SET'];
    $harga = $show['HARGA'];
    $setRusak = $show['SET_RUSAK'];
    $biayaRusak = $show['BIAYA_RUSAK'];
    $diskon = $show['DISKON'];

    $updateStok = mysqli_query($mysqli, "UPDATE `stok` SET STOK=STOK+'$jmlSet' WHERE FRAME='$frame'") or die("data salah: " . mysqli_error($mysqli));

    $insertLog = mysqli_query($mysqli, "INSERT INTO `log_transaksi`(`ID_LOG_TRANSAKSI`,`NAMA_PENYEWA`, `NO_TELP`, `ALAMAT_PENYEWA`, `NAMA_ADMIN`, `JENIS_PENGIRIMAN`, `ONGKIR`, `BUKIT_PEMBAYARAN`, `BUKTI_KTP`, `ALAMAT`, `PROYEK`, `JAM_PEMESANAN`, `TGL_SEWA`, `TGL_JATUH_TEMPO`,`TGL_KEMBALI`, `DISKON`,`STATUS`) VALUES ('$idTrans','$namaPenyewa','$noTelp','$alamatPenyewa','$namaAdmin','$jenisPengiriman','$ongkir','$bktPembayaran','$bktKtp','$alamat','$proyek','$jamPesan','$tglSewa','$tglJatuhTempo','$tglKembali','$diskon','$status')");
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
