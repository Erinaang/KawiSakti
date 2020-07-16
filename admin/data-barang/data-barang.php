<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}
include "../connection/Connection.php";

$queryFrame = mysqli_query($mysqli, "SELECT * FROM paket GROUP BY FRAME") or die("data salah: " . mysqli_error($mysqli));

?>

<!DOCTYPE HTML>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Data Barang</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                            <a title="Data Barang" href=""><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Barang</span></a>
                        </li>
                        <li>
                            <a title="Data Transaksi" href="../data-transaksi/data-transaksi.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Transaksi</span></a>
                        </li>
                        <li>
                            <a title="Riwayat Transaksi" href="../data-riwayat/data-riwayat.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Riwayat Transaksi</span></a>
                        </li>
                        <li>
                            <a title="Data Pengembalian" href="../data-pengembalian/data-pengembalian.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Pengembalian</span></a>
                        </li>
                        <li>
                            <a title="Data Pengiriman" href="../data-pengiriman/data-pengiriman.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Pengiriman</span></a>
                        </li>
                        <li>
                            <a title="Data Pelanggan" href="../data-akun/data-akun.php"><i class="fas fa-user-shield"></i><span class="mini-click-non">Data Pelanggan</span></a>
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
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
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
                                                        <span class="admin-name">Setting |</span>
                                                        <i class="icon nalika-down-arrow nalika-angle-dw author-log-ic"></i>
                                                    </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="profile.php?username=<?php echo $_GET['username']; ?>"><span class="icon nalika-user author-log-ic"></span> Profile</a>
                                                        </li>
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
            <br>
            <br>
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
                                                <h2>Selamat Datang, Admin PT Kawi Sakti Megah</h2>
                                                <p>Welcome to PT Kawi Sakti Megah</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-cart-area mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-cart-inner">
                            <div id="example-basic">
                                <?php while ($show = mysqli_fetch_array($queryFrame)) {
                                    $frame = $show['FRAME']; ?>
                                    <h3> <?php echo $frame; ?></h3>
                                    <section>
                                        <h3 class="product-cart-dn"><?php echo $frame; ?></h3>
                                        <div class="product-list-cart">
                                            <div class="product-status-wrap border-pdt-ct">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <a href="tambah-barang.php" type="button" class="btn btn-primary">Tambah Barang</a>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h2><?php echo $frame; ?></h2>
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th>Frame</th>
                                                                    <th>Masa Sewa</th>
                                                                    <th>Jumlah Set</th>
                                                                    <th>Stok</th>                                                                  
                                                                    <th>Harga</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $queryPaket = mysqli_query($mysqli, "SELECT * FROM paket WHERE FRAME = '$frame'") or die("data salah A: " . mysqli_error($mysqli));
                                                                while ($showPaket = mysqli_fetch_array($queryPaket)) { ?>
                                                                    <tr>
                                                                        <td><?php echo $showPaket['FRAME']; ?></td>
                                                                        <td><?php echo $showPaket['MASA_SEWA']; ?></td>
                                                                        <td><?php echo $showPaket['JUMLAH_SET']; ?></td>
                                                                        <td><?php echo $showPaket['STOK']; ?></td>
                                                                        <td>Rp. <?php echo number_format($showPaket['HARGA'], 2, ",", "."); ?></td>
                                                                        <td>
                                                                            <a href="edit-barang.php?ID_PAKET=<?php echo $showPaket['ID_PAKET']; ?>" data-toggle="tooltip" title="Edit" class="btn btn-info pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"> Edit</i></a>
                                                                            <a href="hapus-barang.php?ID_PAKET=<?php echo $showPaket['ID_PAKET']; ?>" data-toggle="tooltip" title="Delete" class="btn btn-danger pd-setting-ed" onClick='return confirm("Apakah anda yakin menghapus data barang?")'><i class="fa fa-trash-o" aria-hidden="true">Hapus</i></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- jquery
		============================================ -->
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
        <!-- morrisjs JS
		============================================ -->
        <script src="../js/sparkline/jquery.sparkline.min.js"></script>
        <script src="../js/sparkline/jquery.charts-sparkline.js"></script>
        <!-- calendar JS
		============================================ -->
        <script src="../js/calendar/moment.min.js"></script>
        <script src="../js/calendar/fullcalendar.min.js"></script>
        <script src="../js/calendar/fullcalendar-active.js"></script>
        <!-- tab JS
		============================================ -->
        <script src="../js/tab.js"></script>
        <!-- wizard JS
		============================================ -->
        <script src="../js/wizard/jquery.steps.js"></script>
        <script src="../js/wizard/steps-active.js"></script>
        <!-- plugins JS
		============================================ -->
        <script src="../js/plugins.js"></script>
        <!-- main JS
		============================================ -->
        <script src="../js/main.js"></script>
</body>

</html>