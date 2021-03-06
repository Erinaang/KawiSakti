<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin/login.php");
}
include "koneksi/koneksi.php"; // ambil koneksi;

date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d");

//DEFINE VARIABLE
$jamPemesanan = $diskon = $totalPembayaranKeranjang = $total = $ongkir = $totalDendaAkhir = $totalPembayaranCheckout = $idPenyewa = $idAdmin = $idKeranjang = $jaminanCheckout = $totalCheckout = $masaSewa = $totalHarga = $jumlahSet = $jaminan = $bayar = 0;
$index = 1;
$username = $_SESSION['username'];
if (isset($_GET['MASA_SEWA'])) {
    $masaSewa = $_GET['MASA_SEWA'];
} else {
    $masaSewa = NULL;
}


//ambil data user berdasarkan username yang login buat ditampilin di profil
$profilUser = mysqli_query($mysqli, "SELECT * FROM user WHERE USERNAME='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($profilUser)) {
    $idUser = $show['ID_USER'];
    $nama = $show['NAMA'];
    $no_telp = $show['NO_TELP'];
    $alamat = $show['ALAMAT'];
    $foto = $show['FOTO'];
}

//SELECT KERANJANG => ambil data apa aja yang ada di keranjang berdasarkan status ='cart'
$queryKeranjang = mysqli_query($mysqli, "SELECT ti.ID_TRANSAKSI_ITEM, ti.ID_TRANSAKSI, pk.MASA_SEWA, pk.JUMLAH_SET, ti.HARGA_ITEM FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idUser' AND tr. STATUS='cart'") or die("data salah: " . mysqli_error($mysqli));

//SELECT CHECKOUT => ambil data apa aja yang ada di tabel checkout berdasarkan status ='checkout'
$queryCheckout = mysqli_query($mysqli, "SELECT tr.ID_TRANSAKSI, tr.DISKON, tr.JAM_PEMESANAN, ti.ID_TRANSAKSI_ITEM, pr.BIAYA, ti.ID_TRANSAKSI, pk.MASA_SEWA, pk.JUMLAH_SET, ti.HARGA_ITEM FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idUser' AND tr.STATUS='checkout'") or die("data salah: " . mysqli_error($mysqli));

//SELECT UPLOAD=> ambil data apa aja yang ada di tabel checkout berdasarkan status ='dikonfirmasi'
$queryUpload = mysqli_query($mysqli, "SELECT tr.ID_TRANSAKSI,tr.DISKON, tr.JAM_PEMESANAN, ti.ID_TRANSAKSI_ITEM, pr.BIAYA, ti.ID_TRANSAKSI, pk.MASA_SEWA, pk.JUMLAH_SET, ti.HARGA_ITEM FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_PENYEWA ='$idUser' AND tr.STATUS='dikonfirmasi'") or die("data salah: " . mysqli_error($mysqli));

//SELECT DENDA => ambil data apa aja yang ada di tabel checkout berdasarkan status ='denda'
$queryDenda = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI  WHERE tr.ID_PENYEWA ='$idUser' AND tr.STATUS='denda'") or die("data salah: " . mysqli_error($mysqli));

//SELECT RIWAYAT=> ambil data apa aja yang ada di tabel riwayat berdasarkan status SELAIN !='checkout' dan !='cart'
$queryRiwayat = mysqli_query($mysqli, "SELECT us.NAMA, sum(ti.HARGA_ITEM * pk.JUMLAH_SET) as TOTAL , tr.DISKON,tr.ID_TRANSAKSI, tr.TGL_SEWA, tr.TGL_JATUH_TEMPO, tr.STATUS, tr.ID_PENYEWA, tr.ALAMAT, pr.BIAYA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.ID_PENYEWA ='$idUser' AND tr.STATUS!='cart' AND tr.STATUS!='checkout' GROUP BY ID_TRANSAKSI") or die("data salah: " . mysqli_error($mysqli));
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

    <!------ Include the above in your HEAD tag ---------->
    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>

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
                    <br>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <img src="img/logo.png" height="60px" srcset="">
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php">Beranda</a></li>
                            <li><a href="projectBar.php">Jenis Scaffolding</a></li>
                            <li><a href="AboutUs.php">Tentang Kami</a></li>
                            <li>
                                <?php
                                if ($masaSewa != 0) {
                                    echo '<a href="skafoldBar.php?MASA_SEWA=' . $masaSewa . '">Scaffolding</a>';
                                } else {
                                    echo '<a href="skafoldBar.php">Scaffolding</a>';
                                }

                                ?>
                            </li>
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
                <!-- <h4>- User Profile -</h4> -->
                <ul> <br>
                    <div class="content">
                        <?php if (isset($_SESSION['success'])) : ?>
                            <div class="error success">
                                <h3>
                                    <?php
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                    ?>
                                </h3>
                            </div>
                        <?php endif ?>
                        <!-- information of the user logged in -->
                        <!-- welcome message for the logged in user -->
                        <?php if (isset($_SESSION['username'])) : ?>
                            <div class="banner_inner_text">
                                <h4>
                                    <p>
                                        Selamat Datang Di Halaman Akun
                                        <strong>
                                            <?php echo $_SESSION['username']; ?>
                                        </strong>
                                    </p>
                                </h4>
                            </div>
                        <?php endif ?>
                    </div>
            </div>
            <!-- <li><a href="#">Delivery</a></li>
                        <li class="active"><a href="#">With Packet</a></li> -->
            </ul>
        </div>
        </div>
    </section>
    <!--================ Name  =================-->
    <!--================End name =================-->
    <!-- <section class="our_project2_area project_grid_two"> -->
    <br>
    <div class="container-fluid">
        <div class="product-status mg-b-30">
            <div class="container-fluid" style="background-color: #FFB74D">
                <div class="container">
                    <div class="row">
                        <!--================ photo Profile  =================-->
                        <div class="col-md-4">
                            <br>
                            <img id="myImg" src="img/users/<?php echo $foto; ?>" height="120"><br>
                            <br> <a href="editUserProfile.php" class="btn btn-info"> <b>
                                    <style:'<i class="fa fa-align-center" aria-hidden="true"> Edit Profil </i>
                                </b></a>
                        </div>

                        <div class="col-md-8">
                            <h3> Profil Saya </h3>
                            <br>
                            <b>
                                <h4>
                                    <p> Nama &emsp;&emsp; : <?php echo $nama; ?> </p>
                                </h4>
                            </b>
                            <b>
                                <h4>
                                    <p> No Telp &emsp; : <?php echo $no_telp; ?> </p>
                                </h4>
                            </b>
                            <b>
                                <h4>
                                    <p> Alamat&emsp;&emsp;: <?php echo $alamat; ?> </p>
                                </h4>
                            </b>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- TAB -->
                            <div class="tab">
                                <button class="tablinks" onclick="openTabs(event, 'Keranjang')"> <b> Keranjang </b></button>
                                <button class="tablinks" onclick="openTabs(event, 'Checkout')"> <b> Checkout </b> </button>
                                <button class="tablinks" onclick="openTabs(event, 'Upload')"> <b> Upload </b> </button>
                                <button class="tablinks" onclick="openTabs(event, 'Denda')"> <b> Denda </b> </button>
                                <button class="tablinks" onclick="openTabs(event, 'Riwayat')"> <b> Riwayat </b> </button>
                            </div>

                            <!-- KERANJANG -->
                            <div id="Keranjang" class="tabcontent">
                                <div class="product-status-wrap">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <?php
                                            //if => kalo masa sewa tidak sama dengan 0 maka klik daftar-barangnya ditambah masa sewa
                                            if ($masaSewa != 0) {
                                                echo '<a href="skafoldBar.php?MASA_SEWA=' . $masaSewa . '" class="btn btn-primary">Daftar Barang</a>'; //kalo masa sewa != 0
                                            } else {
                                                echo '<a href="skafoldBar.php" class="btn btn-primary"> <b> Daftar Barang </b> </a>'; //kalo masa sewa = 0
                                            }
                                            ?>
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Masa Sewa (hari) </th>
                                                        <th>Jumlah Set x Harga (Rp.)</th>
                                                        <th>Total Harga (Rp.)</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //menampilkan dari SELECT KERANJANG diatas
                                                    $index = 1;
                                                    while ($show = mysqli_fetch_array($queryKeranjang)) {
                                                        $idTrans = $show['ID_TRANSAKSI'];
                                                        $idTransItem = $show['ID_TRANSAKSI_ITEM'];
                                                        $masaSewa = $show['MASA_SEWA'];
                                                        $hargaItem = $show['HARGA_ITEM'];
                                                        $jumlahSet = $show['JUMLAH_SET'];

                                                        $totalPaket = $hargaItem * $jumlahSet;
                                                        $totalHarga = $totalHarga + $totalPaket;
                                                        $jaminan = $totalHarga * (30 / 100);
                                                        $totalPembayaranKeranjang = $totalHarga + $jaminan;

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $index++; ?></td>
                                                            <td><?php echo $masaSewa; ?> Hari</td>
                                                            <td><?php echo $jumlahSet; ?> Set x Rp. <?php echo number_format($hargaItem, 2, ",", "."); ?></td>
                                                            <td>Rp. <?php echo number_format($totalPaket, 2, ",", "."); ?></td>
                                                            <td><a href="delete-keranjang.php?ID_ITEM=<?php echo $idTransItem; ?>&ID_TRANS=<?php echo $idTrans;  ?>&TOTAL=<?php echo $totalPaket; ?>" data-toggle="tooltip" title="Delete" class="btn btn-danger pd-setting-ed" onClick='return confirm("Apakah anda yakin menghapus barang??")'><i class="fa fa-trash-square-o" aria-hidden="true"> Hapus</i></a></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="3"> <b> Total Harga : </b></td>
                                                        <td><b> Rp. <?php echo number_format($totalHarga, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table><br> <br>
                                            <a href="kirim-checkout.php?ID_PENYEWA=<?php echo $idUser; ?>&ID_TRANS=<?php echo $idTrans; ?>" onClick='return confirm("Silahkan masukkan alamat pengiriman dan tanggal penyewaan pada tab checkout")' class="btn btn-primary"> <b> Checkout </b> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CHECKOUT -->
                            <div id="Checkout" class="tabcontent">
                                <div class="product-status-wrap">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p id="demo"></p>
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Masa Sewa (hari) </th>
                                                        <th>Jumlah Set x Harga (Rp.)</th>
                                                        <th>Total Harga (Rp.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //menampilkan dari SELECT CHECKOUT diatas
                                                    $index = 1;
                                                    while ($show = mysqli_fetch_array($queryCheckout)) {
                                                        $idTrans = $show['ID_TRANSAKSI'];
                                                        $idTransItem = $show['ID_TRANSAKSI_ITEM'];
                                                        $ongkir = $show['BIAYA'];
                                                        $masaSewa = $show['MASA_SEWA'];
                                                        $hargaItem = $show['HARGA_ITEM'];
                                                        $jumlahSet = $show['JUMLAH_SET'];
                                                        $jamPemesanan = $show['JAM_PEMESANAN'];

                                                        $totalPaket = $hargaItem * $jumlahSet;
                                                        $totalHarga = $totalHarga + $totalPaket;
                                                        $jaminan = $totalHarga * 30 / 100;
                                                        $totalPembayaranCheckout = $totalHarga + $jaminan + $ongkir;


                                                        $cenvertedTime = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($jamPemesanan))); //merubah jampemesanan dari text menjadi date format
                                                        $minTglSewa = date('Y-m-d', strtotime('+3 day', strtotime($jamPemesanan)));
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $index++; ?></td>
                                                            <td><?php echo $show['MASA_SEWA']; ?> Hari</td>
                                                            <td><?php echo $show['JUMLAH_SET']; ?> Set x Rp. <?php echo number_format($show['HARGA_ITEM'], 2, ",", "."); ?></td>
                                                            <td>Rp. <?php echo number_format($totalPaket, 2, ",", "."); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="3"> <b> Total Harga : </b></td>
                                                        <td><b> Rp. <?php echo number_format($totalHarga, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"> <b> Jaminan : </b></td>
                                                        <td><b> Rp. <?php echo number_format($jaminan, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"> <b> Biaya Pengiriman : </b></td>
                                                        <td><b> Rp. <?php echo number_format($ongkir, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"> <b> Total Pembayaran : </b></td>
                                                        <td><b> Rp. <?php echo number_format($totalPembayaranCheckout, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form action="kirim-data-checkout.php?ID_PENYEWA=<?php echo $idUser; ?>&ID_TRANS=<?php echo $idTrans; ?>" method="POST" enctype="multipart/form-data">

                                        <div class="col-md-6"> <br><br>
                                            <div class="form-group"><br>
                                                <label for="exampleFormControlTextarea1"> <b>Alamat</b></label>
                                                <textarea class="form-control" name="alamat" placeholder="Masukkan alamat pengiriman secara lengkap" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1"><b> Nama Proyek</b></label>
                                                <input type="text" class="form-control" name="proyek" placeholder="Digunakan untuk proyek..." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1"><b> Tanggal Sewa</b></label>
                                                <input type="date" class="form-control" name="tanggal" min='<?php echo $minTglSewa; ?>' required />
                                            </div>
                                            <input class="btn btn-primary" name="submit" value="Kirim" type="submit" onClick='return confirm("Tunggu konfirmasi dari perusahaan kemudian lakukan pembayaran")' />
                                            <a class="btn btn-danger" href="batal-checkout.php?ID_TRANS=<?php echo $idTrans; ?>" onClick='return confirm("Apakah anda yakin ingin membatalkan transaksi?")'>Batalkan Transaksi</a>
                                        </div>
                                    </form>
                                    <br>
                                    <!-- <a class="btn btn-danger" href="batal-checkout.php?ID_TRANS=<?php echo $idTrans; ?>" onClick='return confirm("Apakah anda yakin ingin membatalkan transaksi? ")'>Batal Transaksi</a> -->
                                </div>
                            </div>

                            <!-- UPLOAD -->
                            <div id="Upload" class="tabcontent">
                                <div class="product-status-wrap">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p id="demoUpload"></p>
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Masa Sewa (hari) </th>
                                                        <th>Jumlah Set x Harga (Rp.)</th>
                                                        <th>Total Harga (Rp.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //menampilkan dari SELECT CHECKOUT diatas
                                                    $index = 1;
                                                    while ($show = mysqli_fetch_array($queryUpload)) {
                                                        $idTrans = $show['ID_TRANSAKSI'];
                                                        $idTransItem = $show['ID_TRANSAKSI_ITEM'];
                                                        $ongkir = $show['BIAYA'];
                                                        $masaSewa = $show['MASA_SEWA'];
                                                        $hargaItem = $show['HARGA_ITEM'];
                                                        $jumlahSet = $show['JUMLAH_SET'];
                                                        $jamPemesanan = $show['JAM_PEMESANAN'];
                                                        $diskon = $show['DISKON'];

                                                        //KALKULASI TOTAL
                                                        $totalPaket = $hargaItem * $jumlahSet;
                                                        $totalHarga = $totalHarga + $totalPaket;
                                                        $totalDiskon = $totalHarga - $diskon;
                                                        $persenDiskon = ($diskon / $totalHarga) * 100;
                                                        $jaminan = $totalDiskon * 30 / 100;
                                                        $totalPembayaranCheckout = $totalDiskon + $jaminan + $ongkir;

                                                        //END KALKULASI TOTAL
                                                        $cenvertedTime = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($jamPemesanan))); //merubah jampemesanan dari text menjadi date format
                                                        $minTglSewa = date('Y-m-d', strtotime('+3 day', strtotime($jamPemesanan)));
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $index++; ?></td>
                                                            <td><?php echo $show['MASA_SEWA']; ?> Hari</td>
                                                            <td><?php echo $show['JUMLAH_SET']; ?> Set x Rp. <?php echo number_format($show['HARGA_ITEM'], 2, ",", "."); ?>,00</td>
                                                            <td>Rp. <?php echo number_format($totalPaket, 2, ",", "."); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="3"> <b> Total Harga : </b></td>
                                                        <td><b> Rp. <?php echo number_format($totalHarga, 2, ",", "."); ?> </b></td>
                                                    </tr>
                                                    <?php if ($diskon > 0) {
                                                    ?>
                                                        <tr>
                                                            <td colspan="3"> <b> Diskon : </b></td>
                                                            <td><b>- Rp. <?php echo number_format($diskon, 2, ",", ".") . " (" . $persenDiskon . "%)"; ?> </b></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="3"> <b> Jaminan : </b></td>
                                                        <td><b> Rp. <?php echo number_format($jaminan, 2, ",", "."); ?> (30%) </b></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3"> <b> Ongkir : </b></td>
                                                        <td><b> Rp. <?php echo number_format($ongkir, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"> <b> Total Pembayaran : </b></td>
                                                        <td><b> Rp. <?php echo number_format($totalPembayaranCheckout, 2, ",", "."); ?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form action="upload.php?ID_PENYEWA=<?php echo $idUser; ?>&ID_TRANS=<?php echo $idTrans; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="col-md-6"><br><br>

                                            <h4>Lakukan pembayaran sejumlah total transaksi pada : </h4>
                                            <b>BCA 4480116858 Atas Nama Widodo Harsono</b><br>
                                            <p>Kemudian unggah bukti pembayaran dan scan KTP penyewa pada form dibawah ini</p><br>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1"> <b>Bukti Pembayaran</b></label>
                                                <input type="file" class="form-control" name="bukti_pembayaran" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1"><b> Bukti KTP </b></label>
                                                <input type="file" class="form-control" name="bukti_ktp" required>
                                            </div>
                                            <input class="btn btn-primary" value="Kirim" type="submit" />
                                            <a class="btn btn-danger" href="batal-checkout.php?ID_TRANS=<?php echo $idTrans; ?>" onClick='return confirm("Apakah anda yakin ingin membatalkan transaksi?")'>Batalkan Transaksi</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- UPLOAD -->
                            <div id="Denda" class="tabcontent">
                                <div class="product-status-wrap">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p id="demoDenda"></p>
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Tanggal Sewa</th>
                                                        <th>Tanggal Kembali</th>
                                                        <th>Total Denda (Rp.)</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //menampilkan dari SELECT CHECKOUT diatas
                                                    $index = 1;
                                                    while ($show = mysqli_fetch_array($queryDenda)) {
                                                        $idTrans = $show['ID_TRANSAKSI'];
                                                        $tglSewa = $show['TGL_SEWA'];
                                                        $tglJatuhTempo = $show['TGL_JATUH_TEMPO'];
                                                        $datetime1 = strtotime($time);
                                                        $datetime2 = strtotime($tglJatuhTempo);
                                                        $secs = $datetime1 - $datetime2;
                                                        $telat = $secs / 86400;
                                                        $totalTelat = 100000 * $telat;
                                                        $setRusak = $show['SET_RUSAK'];
                                                        $biayaRusak = $show['BIAYA_RUSAK'];
                                                        $totalDenda = $biayaRusak * $setRusak;
                                                        $totalDendaAkhir = $totalDendaAkhir + $totalDenda;
                                                        $total = $totalDendaAkhir + $totalTelat;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $index++; ?></td>
                                                            <td><?php echo $tglSewa; ?></td>
                                                            <td><?php echo $show['TGL_KEMBALI']; ?></td>
                                                            <td>Rp. <?php echo number_format($total, 2, ",", "."); ?></td>
                                                            <td><a href="<?php echo 'detail-denda.php?ID_PENYEWA=' . $idUser . '&ID_TRANS=' . $idTrans ?>" class="btn btn-info">Detail</a></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form action="uploadDenda.php?ID_PENYEWA=<?php echo $idUser; ?>&ID_TRANS=<?php echo $idTrans; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="col-md-6"><br><br>

                                            <h4>Lakukan pembayaran sejumlah total transaksi pada : </h4>
                                            <b>BCA 4480116858 Atas Nama Widodo Harsono</b><br>
                                            <p>Kemudian unggah bukti pembayaran dan scan KTP penyewa pada form dibawah ini</p><br>
                                            <br>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1"> <b>Bukti Pembayaran</b></label>
                                                <input type="file" class="form-control" name="bukti_pembayaran" required />
                                            </div>
                                            <input class="btn btn-primary" value="Kirim" type="submit" />
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- RIWAYAT -->
                            <div id="Riwayat" class="tabcontent">
                                <div class="product-status-wrap">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <b>
                                                            <th>No.</th>
                                                            <th>Tanggal Sewa</th>
                                                            <th>Total</th>
                                                            <th>Jaminan</th>
                                                            <th>Biaya Pengiriman</th>
                                                            <th>Total Pembayaran</th>
                                                            <th>Status</th>
                                                            <th>Aksi</th>
                                                        </b>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    //menampilkan data dari SELECT RIWAYAT diatas
                                                    $index = 1;
                                                    while ($show = mysqli_fetch_array($queryRiwayat)) {
                                                        $idTrans = $show['ID_TRANSAKSI'];
                                                        $ongkir = $show['BIAYA'];
                                                        $status = $show['STATUS'];
                                                        $diskon = $show['DISKON'];
                                                        $totalPaket = $show['TOTAL'];

                                                        $totalDiskon = $totalPaket - $diskon;
                                                        $persenDiskon = ($diskon / $totalPaket) * 100;
                                                        $jaminan = $totalDiskon * 30 / 100;
                                                        $totalPembayaran = $totalDiskon + $jaminan + $ongkir;
                                                    ?>
                                                        <tr>
                                                            <b>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><?php echo $show['TGL_SEWA']; ?></td>
                                                                <td>Rp. <?php echo number_format($totalPaket, 2, ",", ".");
                                                                        if ($diskon > 0) {
                                                                            echo $persenDiskon . "%";
                                                                        } ?></td>
                                                                <td>Rp. <?php echo number_format($jaminan, 2, ",", "."); ?></td>
                                                                <td>Rp. <?php echo number_format($ongkir, 2, ",", "."); ?></td>
                                                                <td>Rp. <?php echo number_format($totalPembayaran, 2, ",", ".") ?></td>
                                                                <td><?php echo $status ?></td>
                                                                <td>
                                                                    <?php if ($status != 'terkirim') { ?>
                                                                        <a href="<?php echo 'detail-barang.php?ID_PENYEWA=' . $idUser . '&ID_TRANS=' . $idTrans ?>" class="btn btn-info">Detail Transaksi</a>
                                                                    <?php } ?>
                                                                </td>
                                                            </b></tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
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
    </div>
    </div>
    <!-- </section> -->
    <br>
    <br>
    <!--================Get Quote Area =================-->
    <section class="get_quote_area yellow_get_quote">
        <div class="container">
            <div class="pull-left">
                <h4>Tertarik Untuk Menyewa Scaffolding? </h4>
            </div>
            <div class="pull-right">
                <a class="get_btn_black" href="skafoldBar.php">Klik Disini Untuk Menyewa</a>
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
    <script>
        openTabs(event, 'Riwayat');

        function openTabs(evt, nameTab) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(nameTab).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?php echo $cenvertedTime; ?>").getTime();
        // var countDownDate = new Date("2020-04-17 21:02:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;
            var idKeranjang = <?php echo $idKeranjang; ?>

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";
            document.getElementById("demoUpload").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                if (idKeranjang != 0) {
                    window.location = "delete-keranjang.php?id_transaksi=" + idKeranjang;
                    idKeranjang = 0;
                }

                if (idKeranjang == 0) {
                    document.getElementById("demo").innerHTML = "Exp";
                }
            }
        }, 1000);
    </script>
</body>

</html>