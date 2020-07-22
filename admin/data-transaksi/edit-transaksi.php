<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}
include "../connection/Connection.php";
//GET IDUSER
// $username = $_SESSION['username'];
//SELECT DATA
$id_transaksi = $_GET['id_transaksi'];
$query = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'") or die("data salah: " . mysqli_error($mysqli));

if (isset($_POST['submit'])) {

    $id_penyewa = $_POST['id_penyewa'];
    $id_admin = $_POST['id_admin'];
    $id_pengiriman = $_POST['id_pengiriman'];
    $total = $_POST['total'];
    $jaminan = $_POST['jaminan'];
    $bukti_pembayaran = $_POST['bukti_pembayaran'];
    $bukti_ktp = $_POST['bukti_ktp'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $tgl_sewa = $_POST['tgl_sewa'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $status = $_POST['status'];
} ?>

<!DOCTYPE HTML>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PT. Kawi Sakti Megah </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- nalika Icon CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/nalika-icon.css">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.css">
    <link rel="stylesheet" href="../css/owl.transitions.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/normalize.css">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/meanmenu.min.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="../css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="../css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="../style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="../js/vendor/modernizr-2.8.3.min.js"></script>



</head>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <br>
                <a><img class="main-logo" src="../img/logo/logo3.png" alt="" /></a>
                <br>
                <strong><img src="img/logo/logosn.png" alt="" width="60px" /></strong>
            </div>
            <div class="nalika-profile">
                <div class="profile-dtl">

                    <h2> <b>A<span class="min-dtn">DMIN</span></b></h2>
                </div>

            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li>
                            <a title="Data Barang" href="data-barang/data-barang.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Barang</span></a>
                        </li>
                        <li>
                            <a title="Data Transaksi" href="data-transaksi/data-transaksi.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Transaksi</span></a>
                        </li>
                        <li>
                            <a title="Riwayat Transaksi" href="../data-riwayat/data-riwayat.php"><i class="icon nalika-folder icon-wrap" style="color:#fbfffbb0"></i><span class="mini-sub-pro">Riwayat Transaksi</span></a>
                        </li>
                        <li>
                            <a title="Data Pengembalian" href="data-pengembalian/data-pengembalian.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Pengembalian</span></a>
                        </li>
                        <li>
                            <a title="Data Pengiriman" href="data-pengiriman/data-pengiriman.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Pengiriman</span></a>
                        </li>
                        <li>
                            <a title="Data Pelanggan" href="data/ kaundata-akun.php"><i class="fas fa-user-shield" style="color:#fbfffbb0"></i><span class="mini-sub-pro">Data Pelanggan</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area" style="background-color: #1d3542">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">


                                            <button type="button" id="sidebarCollapse" class='fa fa-exchange' style='font-size:36px; color:#000; padding-top: 10px' onmouseover="this.style.transform='scale(1.3)'" onmouseout="this.style.transform='scale(1)'"><span class="tooltiptext"></span></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n hd-search-rp">
                                            <div class="breadcome-heading">
                                                <form role="search" style="visibility: hidden;" action="pencarian.php?username=<?php echo $_GET['username']; ?>" method="GET">
                                                    <input type="text" name="cari" placeholder="🔎 Seacrh.." class="form-control">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">

                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                        <i class="icon nalika-settings author-log-ic"></i>
                                                        <span class="admin-name">Log out |</span>
                                                        <i class="icon nalika-down-arrow nalika-angle-dw author-log-ic"></i>
                                                    </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <!-- <li><a href="profile.php?username=<?php echo $_GET['username']; ?>"><span class="icon nalika-user author-log-ic"></span> Profile</a>
                                                        </li> -->
                                                        <li><a href="../logout.php"><span class="icon nalika-unlocked author-log-ic"></span> Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->

            <!-- Mobile Menu end -->

            <div class="section-admin container-fluid">
                <div class="row admin text-center">
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcomb-wp">
                                            <div class="breadcomb-icon">
                                                <i class="icon nalika-home"></i>
                                            </div>
                                            <div class="breadcomb-ctn">
                                                <h2>Selamat Datang, ADMIN PT. Kawi Sakti Megah</h2>
                                                <!-- <p>Welcome to PT Kawi Sakti Megah</span></p> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--  <?php
                                            if (!empty($_POST['program'])) { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcomb-report">
                                            <form method="post" action="export.php?username=<?php echo $_GET['username']; ?>&select=<?php echo $_POST['program']; ?>" align="center"> 

                                            Download File : <input type="submit" name="export" value="Excel Export" class="btn btn-success" /> 

                                            </form>
                                        </div>
                                    </div>
                                <?php } ?> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                                <ul id="myTab3" class="tab-review-design">
                                    <li class="active"><a href="#edit"><i class="icon nalika-edit" aria-hidden="true"></i> Edit Data Transaksi</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <form action="" method="post">
                                        <?php while ($show = mysqli_fetch_array($query)) { ?>
                                            <div class="product-tab-list tab-pane fade active in" id="edit">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="review-content-section">
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> ID Penyewa :</i></span>
                                                                <input name="id_penyewa" type="text" class="form-control" value="<?php echo $show['id_penyewa']; ?>">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> ID Admin :</i></span>
                                                                <input name="id_admin" type="text" class="form-control" value="<?php echo $show['id_admin']; ?>">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> ID Pengiriman :</i></span>
                                                                <input name="id_pengiriman" type="text" class="form-control" value="<?php echo $show['id_pengiriman']; ?>">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Total :</i></span>
                                                                <input name="total" type="text" class="form-control" value="<?php echo $show['total']; ?>">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Jaminan :</i></span>
                                                                <input name="jaminan" type="text" class="form-control" value="<?php echo $show['jaminan']; ?>">
                                                            </div>
                                                            <div class="input-group mg-b-pro-edt">
                                                                <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Bukti Pembayaran :</i></span>
                                                                <input name="bukti_pembayaran" type="text" class="form-control" value="<?php echo $show['bukti_pembayaran']; ?>">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="input-group mg-b-pro-edt">
                                                            <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Bukti KTP :</i></span>
                                                            <input name="bukti_ktp" type="text" class="form-control" value="<?php echo $show['bukti_ktp']; ?>">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Alamat :</i></span>
                                                            <input name="alamat" type="text" class="form-control" value="<?php echo $show['alamat']; ?>">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Kota :</i></span>
                                                            <input name="kota" type="text" class="form-control" value="<?php echo $show['kota']; ?>">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Tanggal Sewa :</i></span>
                                                            <input name="tgl_sewa" type="text" class="form-control" value="<?php echo $show['tgl_sewa']; ?>">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Tanggal Kembali :</i></span>
                                                            <input name="tgl_kembali" type="text" class="form-control" value="<?php echo $show['tgl_kembali']; ?>">
                                                        </div>
                                                        <div class="input-group mg-b-pro-edt">
                                                            <span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"> Status :</i></span>
                                                            <input name="status" type="text" class="form-control" value="<?php echo $show['status']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="text-center custom-pro-edt-ds">
                                                        <!-- <input type="submit" name="submit" value="Save" class="btn btn-ctl-bt waves-effect waves-light m-r-10"> -->
                                                        <a href="data-transaksi.php" type="submit" class="btn btn-ctl-bt waves-effect waves-light">Save</a>
                                                        <a href="data-transaksi.php" type="button" class="btn btn-ctl-bt waves-effect waves-light">Discard</a>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- <div class="footer-copy-right">
                            <p>Copyright © 2018 <a href="https://colorlib.com/wp/templates/">Colorlib</a> All rights reserved.</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <script src="../js/vendor/jquery-1.12.4.min.js"></script>
        <!-- bootstrap JS
        ============================================ -->
        <script src="../js/bootstrap.min.js"></script>
        <!-- wow JS
        ============================================ -->
        <script src="../js/wow.min.js"></script>
        <!-- price-slider JS
        ============================================ -->
        <script src="../js/jquery-price-slider.js"></script>
        <!-- meanmenu JS
        ============================================ -->
        <script src="../js/jquery.meanmenu.js"></script>
        <!-- owl.carousel JS
        ============================================ -->
        <script src="../js/owl.carousel.min.js"></script>
        <!-- sticky JS
        ============================================ -->
        <script src="../js/jquery.sticky.js"></script>
        <!-- scrollUp JS
        ============================================ -->
        <script src="../js/jquery.scrollUp.min.js"></script>
        <!-- mCustomScrollbar JS
        ============================================ -->
        <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="../js/scrollbar/mCustomScrollbar-active.js"></script>
        <!-- metisMenu JS
        ============================================ -->
        <script src="../js/metisMenu/metisMenu.min.js"></script>
        <script src="../js/metisMenu/metisMenu-active.js"></script>
        <!-- sparkline JS
        ============================================ -->
        <script src="../js/sparkline/jquery.sparkline.min.js"></script>
        <script src="../js/sparkline/jquery.charts-sparkline.js"></script>
        <!-- calendar JS
        ============================================ -->
        <script src="../js/calendar/moment.min.js"></script>
        <script src="../js/calendar/fullcalendar.min.js"></script>
        <script src="../js/calendar/fullcalendar-active.js"></script>
        <!-- float JS
        ============================================ -->
        <script src="../js/flot/jquery.flot.js"></script>
        <script src="../js/flot/jquery.flot.resize.js"></script>
        <script src="../js/flot/curvedLines.js"></script>
        <script src="../js/flot/flot-active.js"></script>
        <!-- plugins JS
        ============================================ -->
        <script src="../js/plugins.js"></script>
        <!-- main JS
        ============================================ -->
        <script src="../js/main.js"></script>


</body>
</html>