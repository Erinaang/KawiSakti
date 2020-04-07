<!DOCTYPE html>
<?php
session_start();
include "koneksi/koneksi.php";
//GET IDUSER
// $username = $_SESSION['username'];
//SELECT DATA Riwayat

$queryMF170 = mysqli_query($mysqli, "SELECT * FROM paket WHERE frame ='MF-170' order by jumlah_set desc") or die("data salah: " . mysqli_error($mysqli));

$queryMF190 = mysqli_query($mysqli, "SELECT * FROM paket WHERE frame ='MF-190' order by jumlah_set desc") or die("data salah: " . mysqli_error($mysqli));

$queryLF90 = mysqli_query($mysqli, "SELECT * FROM paket WHERE frame ='LF-90' order by jumlah_set desc") or die("data salah: " . mysqli_error($mysqli));

if (isset($_GET['masa_sewa'])) {
    $masaSewa = $_GET['masa_sewa'];

    $queryMF170 = mysqli_query($mysqli, "SELECT * FROM paket WHERE frame ='MF-170' and masa_sewa='$masaSewa' order by jumlah_set desc") or die("data salah: " . mysqli_error($mysqli));

    $queryMF190 = mysqli_query($mysqli, "SELECT * FROM paket WHERE frame ='MF-190' and masa_sewa='$masaSewa' order by jumlah_set desc") or die("data salah: " . mysqli_error($mysqli));

    $queryLF90 = mysqli_query($mysqli, "SELECT * FROM paket WHERE frame ='LF-90' and masa_sewa='$masaSewa' order by jumlah_set desc") or die("data salah: " . mysqli_error($mysqli));
}

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>


    <!--================Header Area =================-->
    <header class="main_header_area">
        <div class="header_top_area">
            <div class="container">
                <div class="pull-left">
                    <a href="#"><i class="fa fa-phone"></i>(0341) 350003</a>
                    <a href="#"><i class="fa fa-map-marker"></i> Jl. Janti Barat Blok A/17 A Malang </a>
                    <a href="#"><i class="mdi mdi-clock"></i>08 AM - 04 PM</a>
                </div>
                <!--  <div class="pull-right">
                        <ul class="header_social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div> -->
            </div>
        </div>
        <div class="main_menu_area">
            <div class="container">
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt=""></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="projectBar.php">Project</a></li>
                            <li><a href="aboutUs.php">About Us</a></li>
                            <li><a href="skafoldBar.php">Skafold</a></li>
                            <?php if (!isset($_SESSION['username'])) {
                                echo '<li><a href="admin_kaw/index.php">Login</a></li>';
                            } else {
                                echo '<li><a href="profilBar.php">Profil</a></li>';
                                echo '<li><a href="admin_kaw/logout.php">Log Out</a></li>';
                            }

                            ?>

                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
    </header>
    <!--================Header Area =================-->

    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="container">
            <div class="banner_inner_text">
                <h4>- Rental Scaffolding -</h4>
                <ul>
                    <li><a href="#">Delivery</a></li>
                    <li class="active"><a href="#">With Packet</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!--================End Banner Area =================-->

    <!--================Our Project2 Area =================-->
    <section class="our_project2_area project_grid_two">
        <div class="container">
            <div class="main_c_b_title">
                <h2>Packet<br class="title_br">Skafolding</h2>
                <h6>Skafolding</h6>
            </div>
            <div class="product-status mg-b-30">
                <div class="container-fluid" style="background-color: #FFB74D">
                    MF-170
                    <div class="product-status-wrap">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <h4>Products List</h4><br>
                                <h6 style="color: black">MAIN FRAME - 170</h6>
                                <!-- <div class="add-product">
                                <a href="product-edit.html">Add Product</a>
                            </div> -->
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <b>
                                                <th>Masa Sewa (hari) </th>
                                                <th>Jumlah Set</th>
                                                <th>Harga (Rp.)</th>
                                                <th>Action</th>
                                        </tr> </b>
                                    </thead>
                                    <tbody>
                                        <?php while ($show = mysqli_fetch_array($queryMF170)) {
                                            $masaSewa = $show['masa_sewa']
                                        ?>
                                            <b>
                                                <td><?php echo $masaSewa; ?> Hari</td>
                                                <td><?php echo $show['jumlah_set']; ?> Set Scaffolding</td>
                                                <td>Rp. <?php echo $show['harga']; ?>,00</td>
                                                <td>
                                            </b>
                                            <a href="kirim-keranjang.php?id_paket=<?php echo $show['id_paket']; ?>&masa_sewa=<?php echo $masaSewa; ?>&submit" data-toggle="tooltip" title="Edit" class="btn btn-info pd-setting-ed" onClick='return confirm("Masukan ke keranjang?")'><i class="fa fa-cart-square-o" aria-hidden="true"> Cart</i></a>
                                            </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!--  MF-190 -->
        <div class="product-status mg-b-30">
            <div class="container">
                <div class="container-fluid" style="background-color: #FFB74D">
                    MF-190
                    <div class="product-status-wrap">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <h4>Products List</h4><br>
                                <h6 style="color: black">MAIN FRAME - 190</h6>
                                <!-- <div class="add-product">
                                <a href="product-edit.html">Add Product</a>
                            </div> -->
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <b>
                                                <th>Masa Sewa (hari) </th>
                                                <th>Jumlah Set</th>
                                                <th>Harga (Rp.)</th>
                                                <th>Action</th>
                                        </tr> </b>
                                    </thead>
                                    <tbody>
                                        <?php while ($show = mysqli_fetch_array($queryMF190)) { ?>
                                            <b>
                                                <td><?php echo $show['masa_sewa']; ?> Hari</td>
                                                <td><?php echo $show['jumlah_set']; ?> Set Scaffolding</td>
                                                <td>Rp. <?php echo $show['harga']; ?>,00</td>
                                                <td>
                                            </b>
                                            <a href="kirim-keranjang.php?id_paket=<?php echo $show['id_paket']; ?>&masa_sewa=<?php echo $masaSewa; ?>&submit" data-toggle="tooltip" title="Edit" class="btn btn-info pd-setting-ed" onClick='return confirm("Masukan ke keranjang?")'><i class="fa fa-cart-square-o" aria-hidden="true"> Cart</i></a>
                                            </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
        <br>
        <!-- LF-190 -->
        <div class="product-status mg-b-30">
            <div class="container">
                <div class="container-fluid" style="background-color: #FFB74D">
                    LF-190
                    <div class="product-status-wrap">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <h4>Products List</h4><br>
                                <h6 style="color: black">LEADER FRAME - 90</h6>
                                <!--  <div class="add-product">
                                <a href="product-edit.html">Add Product</a>
                            </div> -->
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <b>
                                                <th>Masa Sewa (hari) </th>
                                                <th>Jumlah Set</th>
                                                <th>Harga (Rp.)</th>
                                                <th>Action</th>
                                        </tr> </b>
                                    </thead>
                                    <tbody>
                                        <?php while ($show = mysqli_fetch_array($queryLF90)) { ?>
                                            <tr>
                                                <b>
                                                    <td><?php echo $show['masa_sewa']; ?> Hari</td>
                                                    <td><?php echo $show['jumlah_set']; ?> Set Scaffolding</td>
                                                    <td>Rp.<?php echo $show['harga']; ?>,00</td>
                                                    <td>
                                                </b>
                                                <a href="kirim-keranjang.php?id_paket=<?php echo $show['id_paket']; ?>&masa_sewa=<?php echo $masaSewa; ?>&submit" data-toggle="tooltip" title="Edit" class="btn btn-info pd-setting-ed" onClick='return confirm("Masukan ke keranjang?")'><i class="fa fa-cart-square-o" aria-hidden="true"> Cart</i></a>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================End Our Project2 Area =================-->


    <!--================Get Quote Area =================-->
    <section class="get_quote_area yellow_get_quote">
        <div class="container">
            <div class="pull-left">
                <h4>Looking for a quality and affordable constructor for your next project?</h4>
            </div>
            <div class="pull-right">
                <a class="get_btn_black" href="#">GET A QUOTE</a>
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
                            <img src="img/footer-logo.png" alt="">
                            <p>Kami melayani pengerjaan dengan konsultan Proyek Terbaik, serta mempunyai kulifikasi tinggi sebagai perusahaan bidang rental Sacffolding dan konstruktor </p>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <aside class="f_widget recent_widget">
                            <div class="f_w_title">
                                <h3>Recent Portofolio</h3>
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
                                <h3>Office Address</h3>
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
                                        <p>(0341) 350003 </p>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-left">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="media-body">
                                        <p>info@domain.com</p>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <aside class="f_widget give_us_widget">
                            <h5>Give Us A Call</h5>
                            <h4>(0341) 350003 </h4>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_copy_right">
            <div class="container">
                <h4>
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