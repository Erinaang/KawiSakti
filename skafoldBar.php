<?php
session_start();
include 'koneksi/koneksi.php';

$queryFilter = mysqli_query($mysqli, "SELECT FRAME FROM paket GROUP BY FRAME") or die("data salah: " . mysqli_error($mysqli));
$queryDetail = mysqli_query($mysqli, "SELECT FRAME, JUMLAH_SET FROM paket GROUP BY FRAME, JUMLAH_SET, MASA_SEWA") or die("data salah: " . mysqli_error($mysqli));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32" />
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
                            <li><a href="index.php">Beranda</a></li>
                            <li><a href="projectBar.php">Jenis Scafold</a></li>
                            <li><a href="AboutUs.php">Tentang Kami</a></li>
                            <li><a href="skafoldBar.php">Scaffolding</a></li>
                            <?php if (!isset($_SESSION['username'])) {
                                echo '<li><a href="admin/login.php">Login</a></li>';
                            } else {
                                echo '<li><a href="ProfilBar.php">Profil</a></li>';
                                echo '<li><a href="admin/logout.php">Log Out</a></li>';
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
                <h4>Pengenalan Jenis Scaffolding</h4>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li class="active"><a href="#">PT Kawi Sakti Megah</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!--================End Banner Area =================-->

    <!--================Our Project2 Area =================-->
    <section class="our_project2_area project_grid_three">
        <div class="container">
            <div class="main_c_b_title">
                <h2><br class="title_br">Scaffolding</h2>
                <h6>Jenis Scaffolding</h6>
            </div>
            <ul class="our_project_filter">
                <li class="active" data-filter="*"><a href="#">All</a></li>
                <?php while ($show = mysqli_fetch_array($queryFilter)) {
                    $frame = $show['FRAME']; ?>
                    <li data-filter=".<?php echo $frame; ?>"><a href="#"><?php echo $frame; ?></a></li>
                <?php } ?>
            </ul>
            <div class="row our_project_details">
                <?php while ($show = mysqli_fetch_array($queryDetail)) {
                    $frame = $show['FRAME'];
                    $jmlSet = $show['JUMLAH_SET']; ?>
                    <div class="col-md-12 col-sm-12 <?php echo $frame; ?>">
                        <div class="project_item">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Frame</th>
                                        <th>Masa Sewa (hari) </th>
                                        <th>Jumlah Set</th>
                                        <th>HARGA (Rp.)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $queryPaket = mysqli_query($mysqli, "SELECT * FROM paket WHERE FRAME = '$frame' AND JUMLAH_SET = '$jmlSet'") or die("data salah A: " . mysqli_error($mysqli));
                                    while ($showPaket = mysqli_fetch_array($queryPaket)) {
                                        $masaSewa = $showPaket['MASA_SEWA'];
                                        $idPaketKeranjang = $showPaket['ID_PAKET']; ?>
                                        <b>
                                            <tr>
                                                <td><?php echo $showPaket['FRAME']; ?></td>
                                                <td><?php echo $masaSewa; ?> Hari</td>
                                                <td><?php echo $showPaket['JUMLAH_SET']; ?> Set Scaffolding</td>
                                                <td>Rp. <?php echo number_format($showPaket['HARGA'], 2, ",", "."); ?></td>
                                                <td>
                                                    <a type="button" id="modalStok" data-id="<?php echo $idPaketKeranjang; ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Taruh Keranjang</a>
                                                </td>
                                            </tr>
                                        </b>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Keranjang</h4>
                        </div>
                        <form action="kirim-keranjang.php" method="post">
                            <div class="modal-body">
                                <p>Masukan jumlah stok</p>
                                <input type="number" class="form-control" id="stok" name="stok">
                                <input type="hidden" class="form-control" id="idPaket" name="ID_PAKET">
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" name="submit">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
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
                <h4>Tertarik Untuk Menyewa Scaffolding? </h4>
            </div>
            <div class="pull-right">
                <a class="get_btn_black" href="skafoldBar.php">Silahkan Pilih Jenisnya</a>
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
                            <img src="img/footer-logo.png">
                            <p>Kami melayani pengerjaan dengan konsultan Proyek Terbaik, serta mempunyai kulifikasi tinggi sebagai perusahaan bidang rental Sacffolding dan konstruktor </p>
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
                                <h3>Portofolio</h3>
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
                                        <p>(0341) 350003 </p>
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
                            <h5>Hubungi kami pada</h5>
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
    <script>
        $(document).on("click", "#modalStok", function() {
            var myPaketId = $(this).data('id');
            $(".modal-body #idPaket").val(myPaketId);
            // As pointed out in comments, 
            // it is unnecessary to have to manually call the modal.
            // $('#addBookDialog').modal('show');
        });
    </script>
</body>

</html>