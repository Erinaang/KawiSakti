<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin/login.php");
}
include "koneksi/koneksi.php"; // ambil koneksi;

$index = 1; //buat nomor di tabel
$jaminan = $totalHarga = 0; //definisi variabel dengan nilai 0

$idPenyewa = $_GET['ID_PENYEWA'];
$idTrans = $_GET['ID_TRANS'];

$queryDetail = mysqli_query($mysqli, "SELECT * FROM `transaksi` WHERE ID_PENYEWA ='$idPenyewa' AND ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryDetail)) {
    $tglSewa = $show['TGL_SEWA'];
    $status = $show['STATUS'];
}

$queryItem = mysqli_query($mysqli, "SELECT us.NAMA, ti.HARGA_ITEM, pk.JUMLAH_SET,tr.ID_TRANSAKSI, tr.TGL_SEWA, tr.TGL_KEMBALI, tr.STATUS, tr.ID_PENYEWA, tr.ALAMAT, pr.BIAYA, pk.MASA_SEWA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.ID_TRANSAKSI = '$idTrans'") or die("data salah: " . mysqli_error($mysqli));

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

    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <!--  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

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
                    <div class="col-md-8">
                        <center>
                            <h3> Detail Barang yang Dipesan </h3>
                        </center>
                        <br>
                        <h4> <b> Tanggal Penyewaan &emsp; &emsp;&emsp; : <?php echo $tglSewa; ?> </b> </h4>
                        <h4> <b> Status Pengiriman &emsp;&emsp;&emsp;&emsp; : <?php echo $status; ?> </b> </h4>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Masa Sewa (hari) </th>
                                            <th>Jumlah Set x Harga (Rp.)</th>
                                            <th>Total (Rp.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($show = mysqli_fetch_array($queryItem)) {
                                            $idTrans = $show['ID_TRANSAKSI'];
                                            $idPenyewa = $show['ID_PENYEWA'];
                                            $ongkir = $show['BIAYA'];
                                            $hargaItem = $show['HARGA_ITEM'];
                                            $jumlahSet = $show['JUMLAH_SET'];
                                            $status = $show['STATUS'];

                                            $totalPaket = $hargaItem * $jumlahSet;
                                            $totalHarga = $totalHarga + $totalPaket;
                                            $jaminan = $totalHarga * (30 / 100);
                                            $totalPembayaran = $totalHarga + $ongkir + $jaminan;
                                        ?>
                                            <tr>
                                                <td><?php echo $index++; ?></td>
                                                <td><?php echo $show['MASA_SEWA']; ?> Hari</td>
                                                <td><?php echo $show['JUMLAH_SET']; ?> Set x Rp. <?php echo $show['HARGA_ITEM']; ?>,00</td>
                                                <td>Rp. <?php echo number_format ($totalPaket, 2, ",", "."); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="2"> </td>
                                            <td><b> Sub Total : </b></td>
                                            <td><b> Rp. <?php echo number_format ($totalHarga, 2, ",", ".");  ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> </td>
                                            <td><b> Jaminan : </b></td>
                                            <td><b>Rp. <?php echo number_format ($jaminan, 2, ",", "."); ?> (30%) </b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> </td>
                                            <td><b> Biaya Pengiriman : </b></td>
                                            <td><b>Rp. <?php echo number_format ($ongkir, 2, ",", "."); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> </td>
                                            <td><b> Total Harga : </b></td>
                                            <td><b>Rp. <?php echo number_format ($totalPembayaran, 2, ",", "."); ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <b> <a href="ProfilBar.php" class="btn btn-info" role="button">Kembali ke Menu Profil</a></b>
                            <br><br>
                        </div>
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