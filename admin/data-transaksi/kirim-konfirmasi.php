<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}
include "../connection/Connection.php";
$index = 1;
$total = 0;
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
$mail->FromName     = "PT. Kawi Sakti Megah";      //nama pengirim
$mail->AddAddress($emailPenyewa, "Dengan PT. Kawi Sakti Megah disini."); //email yang tujuan dan nama
$mail->Subject      =  "Pemberitahuan dari PT Kawi Sakti Megah"; //subject
$mail->Body         =  '<b>Hai, pelanggan PT. Kawi Sakti Megah. Barang yang anda sewa telah dikonfirmasi.</b><br> 
                        <b> Silahkan mengunggah bukti pembayaran dan bukti ktp pada tab upload</b><br><br>';
if ($mail->Send()) {
    //update status keranjang dan transaksi menjadi "dikirim"
    $queryConfirm = mysqli_query($mysqli, "UPDATE transaksi SET STATUS='dikonfirmasi' WHERE id_transaksi='$idTrans'") or die("data salah: " . mysqli_error($mysqli));
    if ($queryConfirm) {
        echo '<script>
    alert("Transaksi telah dikonfirmasi.");
    location.href="data-transaksi.php";
    </script>
    ';
    }
} else {
    // echo "error:". error_reporting(E_ALL);
}
/// end kirim email
