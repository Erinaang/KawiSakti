<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
}
include "../connection/Connection.php";
$idTrans = $_GET['ID_TRANS'];
$transaksi = mysqli_query($mysqli, "SELECT* FROM transaksi WHERE ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));
?>

<!DOCTYPE HTML>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PT. Kawi Sakti Megah</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

    <script>
        /* Style the Image Used to Trigger the Modal */ #
        myImg, #myImg2 {
            border - radius: 5 px;
            cursor: pointer;
            transition: 0.3 s;
        }

        #
        myImg, #myImg2: hover {
                opacity: 0.7;
            }

            /* The Modal (background) */
            .modal, .modal2 {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z - index: 1; /* Sit on top */
                padding - top: 400 px; /* Location of the box */
                left: 0;
                top: 0;
                width: 10 % ; /* Full width */
                height: 10 % ; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background - color: rgb(0, 0, 0); /* Fallback color */
                background - color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
            }

            /* Modal Content (Image) */
            .modal - content {
                margin: auto;
                display: block;
                width: 20 % ;
                max - width: 300 px;
            }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        # caption {
            margin: auto;
            display: block;
            width: 20 % ;
            max - width: 300 px;
            text - align: center;
            color: #ccc;
            padding: 10 px 0;
            height: 150 px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal - content, #caption {
            animation - name: zoom;
            animation - duration: 0.6 s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15 px;
            right: 35 px;
            color: #f1f1f1;
            font - size: 40 px;
            font - weight: bold;
            transition: 0.3 s;
        }

        .close: hover,
            .close: focus {
                color: #bbb;
                text - decoration: none;
                cursor: pointer;
            }

        /* 100% Image Width on Smaller Screens */
        @media only screen and(max - width: 300 px) {
            .modal - content {
                width: 20 % ;
            }
        }
    </script>

</head>

<body>
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <!-- DATA TABEL TRANSAKSI -->
        <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="product-status-wrap">
                <br>
                    <a href="data-transaksi.php" class="btn btn-primary"> Kembali &times; </a>
                    <br><br><br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Bukti Pembayaran</th>
                                        <th>Bukti KTP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($show = mysqli_fetch_array($transaksi)) {
                                    ?>
                                        <tr>
                                            <td> <img id="myImg" src="../../img/Uploads/ktp/<?php echo $show["BUKTI_PEMBAYARAN"]; ?>" alt="Bukti Pembayaran" style="width:100%;max-width:300px"></td>
                                            <td>
                                                <img id="myImg2" src="../../img/Uploads/ktp/<?php echo $show["BUKTI_KTP"]; ?>" alt="Bukti KTP" style="width:100%;max-width:300px">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="myModal" class="modal">
                    <a href="bukti.php?ID_TRANS=<?php echo $idTrans; ?>"><span class="close">&times;</span></a>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
                <div id="myModal2" class="modal">
                    <a href="bukti.php?ID_TRANS=<?php echo $idTrans; ?>"><span class="close">&times;</span></a>
                    <img class="modal-content" id="img02">
                    <div id="caption"></div>
                </div>
            </div>
        </div>
        <!-- END TABEL TRANSAKSI -->
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


    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal2");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg2");
        var modalImg = document.getElementById("img02");
        var captionText = document.getElementById("caption2");
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close2")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
</body>

</html>