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
$queryAdmin = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryAdmin)) {
  $namaAdmin = $show['nama'];
  $idAdmin = $show['id_user'];
}

//ambil dari URL
$id_transaksi = $_GET['id_transaksi'];
$jam_pesan = $_GET['jam_pesan'];
$id_penyewa = $_GET['id_penyewa'];
$status = $_GET['status'];
$id_pengiriman = $_GET['id_pengiriman'];

/// SELECT data barang di email
$UpdateIDadmin = mysqli_query($mysqli, "UPDATE transaksi SET id_admin='$idAdmin' WHERE id_transaksi='$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));


/// SELECT data barang di email
$tabelDiEmail = mysqli_query($mysqli, "SELECT * FROM keranjang AS kr JOIN paket AS pk ON kr.id_paket = pk.id_paket WHERE id_penyewa='$id_penyewa' AND status='$status' AND jam_pemesanan='$jam_pesan'") or die("data salah: " . mysqli_error($mysqli));

//SELECT PENGIRIMAN => buat ambil ongkir
$queryPengiriman = mysqli_query($mysqli, "SELECT * FROM pengiriman WHERE id_pengiriman='$id_pengiriman'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryPengiriman)) {
  $ongkir = $show['biaya'];
}

//SELECT TRANSAKSI => buat ambil data transaksi
$queryTransaksi = mysqli_query($mysqli, "SELECT pny.nama as penyewa, pny.email as email_user, adm.nama as admin, tr.* FROM transaksi AS tr JOIN user AS pny ON tr.id_penyewa = pny.id_user JOIN user AS adm ON tr.id_admin = adm.id_user WHERE id_transaksi='$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryTransaksi)) {
  $namaPenyewa = $show['penyewa'];
  $namaAdmin = $show['admin'];
  $email = $show['email_user'];
  $jam_pesan= $show['jam_pemesanan'];
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
<<<<<<< HEAD
$mail->AddAddress($email, "Hallo, Kawi Sakti disini."); //email yang tujuan dan nama
$mail->Subject      =  "Percobaan"; //subject
$mail->Body         =  '<b>Proses transaksi penyewaan scaffolding telah diselesaikan. Terimakasih sudah menyewa di PT. Kawi Sakti Megah</b><br> 
=======
$mail->AddAddress($email, "Dengan PT Kawi Sakti disini."); //email yang tujuan dan nama
$mail->Subject      =  "Pemberitahuan dari PT KSM"; //subject
$mail->Body         =  '<b>proses penyewaan telah diselesaikan . Terimakasih sudah menyewa di PT kawi sakti megah</b><br> 
>>>>>>> e064170465eef5530ed1c9e418ba9166e939c157
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
while ($show = mysqli_fetch_array($tabelDiEmail)) {
  $setRusak = $show['set_rusak'];
  $biayaRusak = $show['biaya_rusak'];
  $totalDenda = $biayaRusak * $setRusak;
  $totalDendaAkhir = $totalDendaAkhir + $totalDenda;

  $mail->Body         .=    '<tr>
      <td>' . $index++ . '</td>
      <td>' . $show['frame'] . ' Hari</td>
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
  $queryKembali = mysqli_query($mysqli, "UPDATE transaksi SET id_admin='$idAdmin', status='Selesai' WHERE id_transaksi='$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));

$queryRiwayat = mysqli_query($mysqli, "UPDATE `keranjang` SET status='Selesai' WHERE `jam_pemesanan`='$jam_pesan' and id_penyewa='$id_penyewa'") or die("data salah: " . mysqli_error($mysqli));


  if ($queryKembali) {

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
