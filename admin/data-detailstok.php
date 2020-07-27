<?php
error_reporting(0);

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}
include "connection/Connection.php";
$username = $_SESSION['username'];
$queryAdmin = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryAdmin)) {
    $tglSewa = $show['TGL_SEWA'];
    $idAdmin = $show['ID_USER'];
}
$index = 1;
$totalHarga = 0;
$idTrans = $_GET['ID_TRANS'];

$queryItem = mysqli_query($mysqli, "SELECT us.NAMA, ti.HARGA_ITEM, pk.JUMLAH_SET,tr.ID_TRANSAKSI, tr.TGL_SEWA, tr.TGL_JATUH_TEMPO, tr.STATUS, tr.ID_PENYEWA, tr.ALAMAT, pr.BIAYA, pk.MASA_SEWA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.ID_TRANSAKSI = '$idTrans'") or die("data salah: " . mysqli_error($mysqli));
?>


<!DOCTYPE HTML>
<html class="no-js" lang="en">
<head><meta charset="windows-1252">
    
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PT. Kawi Sakti Megah</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- nalika Icon CSS
        ============================================ -->
    <link rel="stylesheet" href="css/nalika-icon.css">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <br>
                <!-- <a><img class="main-logo" src="img/logo/logo3.png" alt="" /></a> -->
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
                            <a title="Riwayat Transaksi" href="data-riwayat/data-riwayat.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Riwayat Transaksi</span></a>
                        </li>
                        <li>
                            <a title="Data Pengembalian" href="data-pengembalian/data-pengembalian.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Pengembalian</span></a>
                        </li>
                        <li>
                            <a title="Data Pengiriman" href="data-pengiriman/data-pengiriman.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Pengiriman</span></a>
                        </li>
                        <li>
                            <a title="Data Pelanggan" href="data-akun/data-akun.php"><i class="fas fa-user-shield"></i><span class="mini-click-non">Data Pelanggan</span></a>
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
                                                    <input type="text" name="cari" placeholder="ðŸ”Ž Seacrh.." class="form-control">
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
                                                        <li><a href="logout.php"><span class="icon nalika-unlocked author-log-ic"></span> Log out</a>
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
            <br>
            <br>
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu" style="color:#3D5AFE">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Menu Admin <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                            <ul class="metismenu" id="menu1">
                                            <li>
                                            <a title="Data Barang" href="data-barang/data-barang.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Barang</span></a>
                                        </li>
                                        <li>
                                            <a title="Data Transaksi" href="data-transaksi.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Transaksi</span></a>
                                        </li>
                                        <li>
                                            <a title="Riwayat Transaksi" href="data-riwayat/data-riwayat.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Riwayat Transaksi</span></a>
                                        </li>
                                        <li>
                                            <a title="Data Pengembalian" href="data-pengembalian/data-pengembalian.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Pengembalian</span></a>
                                        </li>
                                        <li>
                                            <a title="Data Pengiriman" href="data-pengiriman/data-pengiriman.php"><i class="icon nalika-folder icon-wrap"></i><span class="mini-click-non">Data Pengiriman</span></a>
                                        </li>
                                        <li>
                                            <a title="Data Pelanggan" href="data-akun/data-akun.php"><i class="fas fa-user-shield"></i><span class="mini-click-non">Data Pelanggan</span></a>
                                        </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                                <!-- <i class="icon nalika-home"></i> -->
                                            </div>
                                            <div class="breadcomb-ctn">
                                                <h2>Selamat Datang, Admin PT. Kawi Sakti Megah</h2>
                                                <!-- <p>Welcome to PT. Kawi Sakti Megah </span></p> -->
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
                            <div class="container-fluid">
                                <!-- <div class="container-fluid"> -->
                                <div class="col-md-8">
                                    <center>
                                        <h3> Detail Stock Barang </h3>
                                    </center>
                                    <br>
                                    <h4> <b> Detail Barang Tanggal &emsp; &emsp; : <?php echo date('d-M-Y', strtotime($show['TGL_SEWA'])); ?> </b> </h4>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr align="left">
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
                                                        <tr align="left">
                                                            <td><?php echo $index++; ?></td>
                                                            <td><?php echo $show['MASA_SEWA']; ?> Hari</td>
                                                            <td><?php echo $show['JUMLAH_SET']; ?> Set x Rp.  <?php echo number_format($show['HARGA_ITEM'], 2, ",", "."); ?></td>
                                                            <td>Rp. <?php echo number_format($totalPaket, 2, ",", "."); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr align="left">
                                                        <td colspan="2"> </td>
                                                        <td><b> Sub Total : </b></td>
                                                        <td><b> Rp. <?php echo number_format($totalHarga, 2, ",", ".");  ?></b></td>
                                                    </tr>
                                                    <tr align="left">
                                                        <td colspan="2"> </td>
                                                        <td><b> Jaminan : </b></td>
                                                        <td><b>Rp. <?php echo number_format($jaminan, 2, ",", "."); ?> (30%) </b></td>
                                                    </tr>
                                                    <tr align="left">
                                                        <td colspan="2"> </td>
                                                        <td><b> Biaya Pengiriman : </b></td>
                                                        <td><b>Rp. <?php echo number_format($ongkir, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                    <tr align="left">
                                                        <td colspan="2"> </td>
                                                        <td><b> Total Harga : </b></td>
                                                        <td><b>Rp. <?php echo number_format($totalPembayaran, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <b> <a href="index.php">Kembali ke Menu Admin</a> </b> -->
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
        ============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
        ============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
        ============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
        ============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- sparkline JS
        ============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/jquery.charts-sparkline.js"></script>
    <!-- calendar JS
        ============================================ -->
    <script src="js/calendar/moment.min.js"></script>
    <script src="js/calendar/fullcalendar.min.js"></script>
    <script src="js/calendar/fullcalendar-active.js"></script>
    <!-- float JS
        ============================================ -->
    <script src="js/flot/jquery.flot.js"></script>
    <script src="js/flot/jquery.flot.resize.js"></script>
    <script src="js/flot/curvedLines.js"></script>
    <script src="js/flot/flot-active.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="js/main.js"></script>


</body>

</html>