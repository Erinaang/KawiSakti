<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin/login.php");
}
include "koneksi/koneksi.php"; // ambil koneksi;

$index = 1; //buat nomor di tabel
$jaminan = $totalHarga = $denda = $telat = $totalDenda = $diskon = 0; //definisi variabel dengan nilai 0

date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d");

$idPenyewa = $_GET['ID_PENYEWA'];
$idTrans = $_GET['ID_TRANS'];

$cekDenda = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($cekDenda)) {
    $set = $show['SET_RUSAK'];
    $biaya = $show['BIAYA_RUSAK'];
    $denda = $denda + ($biaya * $set);
    $tglSewa = $show['TGL_SEWA'];
    $tglJatuhTempo = $show['TGL_JATUH_TEMPO'];
    $datetime1 = strtotime($time);
    $datetime2 = strtotime($tglJatuhTempo);
    $secs = $datetime1 - $datetime2;
    $telat = $secs / 86400;
    $totalTelat = 100000 * $telat;
}
$queryDenda = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN paket AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND  tr.ID_TRANSAKSI = '$idTrans'") or die("data salah: " . mysqli_error($mysqli));
$queryTelat = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN paket AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idPenyewa' AND tr.ID_TRANSAKSI = '$idTrans'") or die("data salah: " . mysqli_error($mysqli));


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
    <!-- The above 3 meta tags code*must* come first in the head; any other head content must come *after* these tags -->
    <title>PT KAWI SAKTI MEGAH - Construction</title>

    <!-- Icon css link -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Rev slider css -->
    <link href="vendors/revolution/css/settings.css" rel="stylesheet">
    <link href="vendors/revolution/css/layers.css" rel="stylesheet">
    <link href="vendors/revolution/css/navigation.css" rel="stylesheet">
    <link href="vendors/animate-css/animate.css" rel="stylesheet">
    <link href="vendors/owl-carousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Extra plugin css -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

</head>

<body>
    <!--================Header Area =================-->
    <header class="main_header_area">
        <div class="header_top_area">
            <div class="container">
                <div class="pull-left">
                    <a href="#"><i class="fa fa-phone"></i>(0341) 350-003</a>
                    <a href="#"><i class="fa fa-map-marker"></i> Jl. Janti Barat Blok A/17 A Malang </a>
                    <a href="#"><i class="mdi mdi-clock"></i>08 AM - 04 PM</a>
                </div>
            </div>
        </div>
    </header>
    <!--================Header Area =================-->
    <div class="container-fluid">
        <div class="product-status mg-b-30">
            <div class="container-fluid" style="background-color: #FFB74D">
                <div class="container">
                    <div class="col-md-12">
                        <center>
                            <h3> Rincian Denda</h3>
                        </center>
                        <?php if ($denda >= 1) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Denda</h3>
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Frame</th>
                                                <th>Masa Sewa (hari) </th>
                                                <th>Jumlah Set x Harga (Rp.)</th>
                                                <th>Total (Rp.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($show = mysqli_fetch_array($queryDenda)) {
                                                $setRusak = $show['SET_RUSAK'];
                                                $biayaRusak = $show['BIAYA_RUSAK'];
                                                $total = $setRusak * $biayaRusak;
                                                $totalDenda = $totalDenda + $total;
                                            ?>
                                                <tr>
                                                    <td><?php echo $index++; ?></td>
                                                    <td><?php echo $show['FRAME']; ?> Hari</td>
                                                    <td><?php echo $show['MASA_SEWA']; ?> Hari</td>
                                                    <td><?php echo $setRusak; ?> Set x Rp. <?php echo $biayaRusak; ?>,00</td>
                                                    <td>Rp. <?php echo number_format($total, 2, ",", "."); ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td> <b> Total Denda : </b></td>
                                                <td><b> Rp. <?php echo number_format($totalDenda, 2, ",", "."); ?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($telat >= 1) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Keterlambatan</h3>
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Judul </th>
                                                <th>Tanggal Sewa</th>
                                                <th>Tanggal Jatuh Tempo</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Terlambat</th>
                                                <th>Total (Rp.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $index = 1;
                                            while ($show = mysqli_fetch_array($queryTelat)) {
                                                $tglSewa = $show['TGL_SEWA'];
                                                $tglJatuhTempo = $show['TGL_JATUH_TEMPO'];
                                                $tglKembali = $show['TGL_KEMBALI'];
                                                $datetime1 = strtotime($time);
                                                $datetime2 = strtotime($tglJatuhTempo);
                                                $secs = $datetime1 - $datetime2;
                                                $telat = $secs / 86400;
                                                $totalTelat = 100000 * $telat;
                                            ?>
                                                <tr>
                                                    <td><?php echo $index++; ?></td>
                                                    <td>Keterlambatan</td>
                                                    <td><?php echo $tglSewa; ?></td>
                                                    <td><?php echo $tglJatuhTempo; ?></td>
                                                    <td><?php echo $tglKembali; ?></td>
                                                    <td><?php echo $telat . " Hari x Rp.100.000,00"; ?></td>
                                                    <td>Rp. <?php echo number_format($totalTelat, 2, ",", "."); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php }
                        $telat= 0;
                        $totalSemua = $totalDenda + $totalTelat;
                        if ($denda > 0 && $telat > 0) {
                            echo '<p>Total Pembayaran tambahan yaitu sebesar Rp.' . number_format($totalSemua, 2, ",", ".") . '(Total Denda + Total Keterlambatan)</p>';
                        } elseif ($denda > 0 && $telat == 0) {
                            echo '<p>Total Pembayaran tambahan yaitu sebesar Rp.' . number_format($totalSemua, 2, ",", ".") .  '(Total Denda)</p>';
                        } elseif ($denda == 0 && $telat > 0) {
                            echo  '<p>Total Pembayaran tambahan yaitu sebesar Rp.' . number_format($totalSemua, 2, ",", ".") .  '(Total Keterlambatan)</p>';
                        }
                        ?>
                        <br><br>
                        <a class="btn btn-primary" href="ProfilBar.php">Kembali Ke Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- </section> -->
    <br>
    <br>
    <!--================Get Quote Area =================-->
    <section class="get_quote_area yellow_get_quote">
        <div class="container">
            <div class="pull-left">
                <h4>Tertarik Untuk Menyewa? </h4>
            </div>
            <div class="pull-right">
                <a class="get_btn_black" href="#">Klik Disini Untuk Menyewa</a>
            </div>
        </div>
    </section>
    <!--================End Get Quote Area =================-->

    <!--================Footer Area =================-->
    <footer class="footer_area">
        <div class="footer_widgets_area">
            <div class="container">
                <div class="row footer_widgets_inner">
                    <div class="col-md-3 col-sm-6">
                        <aside class="f_widget about_widget">
                            <img src="img/logo.png">
                            <p>Kami melayani pengerjaan dengan konsultan proyek terbaik, serta mempunyai kualifikasi tinggi sebagai perusahaan bidang rental scaffolding dan konstruktor </p>
                            <!-- <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul> -->
                        </aside>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <aside class="f_widget recent_widget">
                            <div class="f_w_title">
                                <h3> Portofolio</h3>
                            </div>
                            <div class="recent_w_inner">
                                <div class="media">
                                    <div class="media-left">
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <p>Pengerjaan Gedung UMM 1</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <p>Pengerjaan kantor BCA Sukun</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <aside class="f_widget address_widget">
                            <div class="f_w_title">
                                <h3>Alamat Kantor</h3>
                            </div>
                            <div class="address_w_inner">
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <div class="media-body">
                                        <p> Jl. Janti Barat Blok A/17 A Malang</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="media-body">
                                        <p>(0341) 350-003 </p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="media-body">
                                        <p>kawisaktimalang@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <aside class="f_widget give_us_widget">
                            <h5>Hubungi Kami</h5>
                            <h4>(0341) 350-003 </h4>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_copy_right">
            <div class="container">
                <h4>
                    <center><a href=''></a> Copyright &#169; 2020</a></center>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </h4>
            </div>
        </div>
    </footer>
    <!--================End Footer Area =================-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Rev slider js -->
    <script src="vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>

    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="vendors/counterup/waypoints.min.js"></script>
    <script src="vendors/counterup/jquery.counterup.min.js"></script>
    <script src="vendors/flex-slider/jquery.flexslider-min.js"></script>

    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>

    <script src="js/theme.js"></script>
</body>

</html>