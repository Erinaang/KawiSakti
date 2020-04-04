<?php
"profil bar";
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: admin_kaw/index.php");
}
include "koneksi/koneksi.php";
$total = 0;;

date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$time = date("Y-m-d");
$masaSewa = $totalCheckout = $jaminan = $bayar = 0;
$masaSewa = $_GET['masa_sewa'];

//GET IDUSER
$username = $_SESSION['username'];
$queryIdUser = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryIdUser)) {
    $idUser = $show['id_user'];
    $nama = $show['nama'];
    $no_telp = $show['no_telp'];
    $alamat = $show['alamat'];
    $foto = $show['foto'];
}


//SELECT DATA
$queryKeranjang = mysqli_query($mysqli, "SELECT * FROM transaksi AS tr JOIN paket AS pk ON tr.id_paket = pk.id_paket WHERE id_penyewa='$idUser' AND status='cart'") or die("data salah: " . mysqli_error($mysqli));

$queryCheckout = mysqli_query($mysqli, "SELECT * FROM transaksi AS tr JOIN paket AS pk ON tr.id_paket = pk.id_paket WHERE id_penyewa='$idUser' AND status='checkout'") or die("data salah: " . mysqli_error($mysqli));

$queryRiwayat = mysqli_query($mysqli, "SELECT * FROM transaksi AS tr JOIN paket AS pk ON tr.id_paket = pk.id_paket WHERE id_penyewa='$idUser' AND status='Terkirim'") or die("data salah: " . mysqli_error($mysqli));


?>

<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

// Logout button will destroy the session, and 
// will unset the session variables 
// User will be headed to 'login.php' 
// after loggin out 
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!-- end riwayat  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
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
                <h4>- Profile User-</h4>
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
                                        Welcome to Account
                                        <strong>
                                            <?php echo $_SESSION['username']; ?>
                                        </strong> :)
                                    </p>
                                </h4>
                            </div>
                            <!--  <p>  
                <a href="index.php?logout='1'" style="color: red;"> 
                    Click here to Logout 
                </a> 
            </p>  -->
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

    <br>
    <br>
    <div class="container">
        <div class="row">
            <!--================ photo Profile  =================-->
            <div class="col-md-4">
                <img id="myImg" src="img/users/<?php echo $foto; ?>" width="200" height="150"><br>
                <a href="editUserProfile.php" class="btn btn-info">Edit Profil</a>
            </div>

            <div class="col-md-8">
                <p> Nama : <?php echo $nama; ?> </p>
                <p> No Telp : <?php echo $no_telp; ?> </p>
                <p> Alamat : <?php echo $alamat; ?> </p>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="tab">
                    <button class="tablinks" onclick="openTabs(event, 'Keranjang')">Keranjang</button>
                    <button class="tablinks" onclick="openTabs(event, 'Checkout')">Checkout</button>
                    <button class="tablinks" onclick="openTabs(event, 'Riwayat')">Riwayat</button>
                </div>

                <div id="Keranjang" class="tabcontent">
                    <div class="product-status-wrap">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <a href="kirim-checkout.php?id_user=<?php echo $idUser; ?>&tanggal=<?php echo $time; ?>" class="btn btn-primary">Checkout</a>

                                <?php
                                if (isset($_GET['masa_sewa'])) {
                                    echo '<a href="skafoldBar.php?masa_sewa=' . $masaSewa . '" class="btn btn-primary">Daftar Barang</a>';
                                } else {
                                    echo '<a href="skafoldBar.php" class="btn btn-primary">Daftar Barang</a>';
                                }

                                ?>
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Masa Sewa (hari) </th>
                                            <th>Jumlah Set x Harga (Rp.)</th>
                                            <th>Total Harga (Rp.)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($show = mysqli_fetch_array($queryKeranjang)) {
                                            $jumlahSet = $show['jumlah_set'];
                                            $hargaAwal = $show['harga'];
                                            $hargaTotal = $jumlahSet * $hargaAwal;
                                            $total = $total + $hargaTotal;
                                            $bayar = $total / 100 * 30;
                                            ?>
                                            <tr>
                                                <td><?php echo $show['masa_sewa']; ?> Hari</td>
                                                <td><?php echo $jumlahSet; ?> Set x Rp. <?php echo $hargaAwal; ?>,00</td>
                                                <td>Rp. <?php echo $hargaTotal; ?>,00</td>
                                                <td><a href="delete-keranjang.php?id_transaksi=<?php echo $show['id_transaksi']; ?>" data-toggle="tooltip" title="Delete" class="btn btn-danger pd-setting-ed" onClick='return confirm("Apakah Anda Yakin menghapus barang??")'><i class="fa fa-trash-square-o" aria-hidden="true"> Delete</i></a></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="2"> <b> Total Harga : </b></td>
                                            <td><b> Rp. <?php echo $total; ?>,00 + Rp. <?php echo $bayar; ?> (30%) </b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="Checkout" class="tabcontent">
                    <div class="product-status-wrap">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Masa Sewa (hari) </th>
                                            <th>Jumlah Set x Harga (Rp.)</th>
                                            <th>Total Harga (Rp.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($show = mysqli_fetch_array($queryCheckout)) {
                                            $jumlahSet = $show['jumlah_set'];
                                            $hargaAwal = $show['harga'];
                                            $hargaTotalCheckout = $jumlahSet * $hargaAwal;

                                            $totalCheckout = $totalCheckout + $hargaTotalCheckout;
                                            $jaminan = $totalCheckout / 100 * 30;
                                            ?>
                                            <tr>
                                                <td><?php echo $show['masa_sewa']; ?> Hari</td>
                                                <td><?php echo $jumlahSet; ?> Set x Rp. <?php echo $hargaAwal; ?>,00</td>
                                                <td>Rp. <?php echo $hargaTotalCheckout; ?>,00</td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="2"> <b> TotalCheckout Harga : </b></td>
                                            <td><b> Rp. <?php echo $totalCheckout; ?>,00 + Rp. <?php echo $jaminan; ?> (30%) </b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6"> <br><br>
                            <form action="upload.php?id_user=<?php echo $idUser; ?>&tanggal=<?php echo $time; ?>" method="POST" enctype="multipart/form-data">
                                <p>Bukti Pembayaran : <input type="file" name="bukti_pembayaran" /></p>
                                <p>Bukti KTP : <input type="file" name="bukti_ktp" /></p>
                                <input type="hidden" name="total" value="<?php echo $total + $jaminan; ?>">
                                <br>
                                <input class="btn btn-primary" value="Kirim" type="submit" />
                            </form>
                        </div>
                    </div>
                </div>

                <div id="Riwayat" class="tabcontent">
                    <div class="product-status-wrap">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <b>
                                                <th>Tanggal</th>
                                                <th>Masa Sewa (hari) </th>
                                                <th>Jumlah Set x Harga (Rp.)</th>
                                                <th>Total Harga (Rp.)</th>
                                                <th>Status</th>
                                        </tr> </b>
                                    </thead>
                                    <tbody>
                                        <?php while ($show = mysqli_fetch_array($queryRiwayat)) {

                                            $tanggal = $show['tgl_sewa'];
                                            $jumlahSet = $show['jumlah_set'];
                                            $hargaAwal = $show['harga'];
                                            $hargaTotal = $jumlahSet * $hargaAwal;
                                            $total = $show['total'];
                                            $bayar = $total / 100 * 30;
                                            ?>
                                            <tr>
                                                <b>
                                                    <td><?php echo $tanggal; ?></td>
                                                    <td><?php echo $show['masa_sewa']; ?> Hari</td>
                                                    <td><?php echo $jumlahSet; ?> Set x Rp. <?php echo $hargaAwal; ?>,00</td>
                                                    <td>Rp. <?php echo $hargaTotal; ?>,00</td>
                                                    <td><?php echo $show['status']; ?></td>

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
        </tr>
        </thead>
        </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    <br>
    <br>
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
</body>

</html>