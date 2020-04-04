<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Construction - WeBuilder Template</title>

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
        <header class="main_header_area transparent_menu">
            <div class="header_top_area">
                <div class="container">
                    <div class="pull-left">
                        <a href="#"><i class="fa fa-phone"></i>(0341) 350003</a>
                        <a href="#"><i class="fa fa-map-marker"></i> Jl. Janti Barat Blok A/17 A Malang </a>
                        <a href="#"><i class="mdi mdi-clock"></i>08 AM - 04 PM</a>
                    </div>
                    <div class="pull-right">
                        <ul class="header_social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
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
                            <a class="navbar-brand" href="#"><img src="img/logo-white.png" alt=""><img src="img/logo.png" alt=""></a>
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
                                }else{
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
        
        <!--================Main Slider Area =================-->
        <section class="main_slider_area slider_2">
            <div id="main_slider" class="rev_slider" data-version="5.3.1.6">
                <ul> 
                    <li data-index="rs-2972" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="img/home-slider/slider-1.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Web Show" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                      <!--   MAIN IMAGE -->
                        <img src="img/home-slider/slider-2.jpg"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
                       <!--  LAYERS -->
                       <div class="slider_text_box">
                            <div class="tp-caption first_text" 
                            data-x="['center','center','center','center']" 
                            data-y="['middle','middle','middle','middle']" 
                            data-hoffset="['0','0','0','0']" 
                            data-voffset="['-38','-38','-38','-20','-20']" 
                            data-fontsize="['28','28','28','28']"
                            data-lineheight="['38','38','38','38']"
                            data-width="none"
                            data-height="none"
                            data-whitespace="nowrap"
                            data-type="text" 
                            data-responsive_offset="on" 
                            data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1750,"ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                            data-textAlign="['left','left','left','left']"
                            data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingbottom="[0,0,0,0]"
                            data-paddingleft="[0,0,0,0]">Selamat Datang di PT.KAWI SAKTI MEGAH <br><br> <br><br> <br><br>   </div>

                            <br> <br> <br>
                                
                            <div class="tp-caption secand_text" 
                            data-x="['center','center','center','center']" 
                            data-y="['middle','middle','middle','middle']" 
                            data-hoffset="['0','0','0','0']" 
                            data-voffset="['38','38','38','38','38']" 
                            data-fontsize="['70','70','70','50','50']"
                            data-lineheight="['100','100','100','70','70']"
                            data-width="['none','none','none','none']"
                            data-height="none"
                            data-whitespace="['nowrap','nowrap','nowrap','nowrap','nowrap']"
                            data-type="text" 
                            data-responsive_offset="on" 
                            data-frames='[{"from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":1700,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"x:left(R);","ease":"Power3.easeIn"}]'
                            data-textAlign="['center','center','center','center']"
                            data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingbottom="[10,10,10,10]"
                            data-paddingleft="[0,0,0,0]"> Rental Scaffolding <br> and <br> Construction </div>

                        </div>
                    </li>
                    <li data-index="rs-2973" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="img/home-slider/slider-1.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Web Show" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                       <!--  MAIN IMAGE -->
                        <img src="img/home-slider/slider-1.jpg"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
                      <!--   LAYERS -->
                        <div class="slider_text_box">
                            <div class="tp-caption first_text" 
                            data-x="['center','center','center','center']" 
                            data-y="['middle','middle','middle','middle']" 
                            data-hoffset="['0','0','0','0']" 
                            data-voffset="['-38','-38','-38','-20','-20']" 
                            data-fontsize="['28','28','28','28']"
                            data-lineheight="['38','38','38','38']"
                            data-width="none"
                            data-height="none"
                            data-whitespace="nowrap"
                            data-type="text" 
                            data-responsive_offset="on" 
                            data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1750,"ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                            data-textAlign="['left','left','left','left']"
                            data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingbottom="[0,0,0,0]"
                            data-paddingleft="[0,0,0,0]"> Rental Scaffolding <br> and <br> Construction</div>
                                
                            <div class="tp-caption secand_text" 
                            data-x="['center','center','center','center']" 
                            data-y="['middle','middle','middle','middle']" 
                            data-hoffset="['0','0','0','0']" 
                            data-voffset="['38','38','38','38','38']" 
                            data-fontsize="['110','110','110','50','50']"
                            data-lineheight="['100','100','100','70','70']"
                            data-width="['none','none','none','none']"
                            data-height="none"
                            data-whitespace="['nowrap','nowrap','nowrap','nowrap','nowrap']"
                            data-type="text" 
                            data-responsive_offset="on" 
                            data-frames='[{"from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":1700,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"x:left(R);","ease":"Power3.easeIn"}]'
                            data-textAlign="['center','center','center','center']"
                            data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingbottom="[10,10,10,10]"
                            data-paddingleft="[0,0,0,0]">we innovate </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!--================End Main Slider Area =================-->
        <!--================Get Quote Area =================-->
       <!--  <section class="get_quote_area">
            <div class="container">
                <div class="pull-left">
                    <h4>Looking for a quality and affordable constructor for your next project?</h4>
                </div>
                <div class="pull-right">
                    <a class="get_btn" href="#">GET A QUOTE</a>
                </div>
            </div>
        </section> -->
        <!--================End Get Quote Area =================-->
        
        <!--================Feature Content Area =================-->
        <section class="feature_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="f_content_item">
                            <i class="fa fa-ge" aria-hidden="true"></i>
                            <a href="#"><h4>innovative</h4></a>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="f_content_item">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <a href="#"><h4>first building</h4></a>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="f_content_item">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <a href="#"><h4>save money</h4></a>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Feature Content Area =================-->
        
        <!--================Best Company Area =================-->
        <section class="best_company_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="b_companu_l_text">
                            <h4>Sejarah Perusahaan</h4><br>
                            <p>
                            Bermula sejak tahun 1978, Kawi Sakti Megah adalah perusahaan Perentalan Scaffolding dan rancang bangun yang melayani jasa-jasa pembangunan. awalnya Kawi Sakti Megah Hanyalah sebuah perusahaan dengan nama Gunung Kawi Awning yang bergerak dalam bidang pengerjaan Awning dan Pagar <br> </p> <p> dengan modal pengalaman dan reputasi perusahaan yang selalu "Belajar" untuk maju, pada tahun 1998 kam mencoba mengembangkan sayap usaha dengan mendirikan Kawi Sakti Megah dengan harapan memenuhi tuntutan pasar yang lebih besar yaitu ikut berpartisipasi melayani masyarakat demi membangun masa depan </p>
                          <!--   <a class="slider_btn" href="#">read more</a> -->
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="b_company_image">
                            <img src="img/b-company-img.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Best Company Area =================-->
        
        <!--================Our Service2 Area =================-->
        <section class="our_service_area2">
            <div class="container">
                <div class="main_c_b_title">
                    <h2>Our<br class="title_br">Services</h2>
                    <h6>All About US</h6>
                </div>
                <div class="row service2_inner">
                    <div class="col-md-4 col-sm-6">
                        <div class="service2_item">
                            <div class="service2_item_inner">
                                <div class="service2_item_inner_content">
                                    <div class="service_icon">
                                        <img src="img/icon/s-icon-6.png" alt="">
                                <img src="img/icon/s-icon-hover-6.png" alt="">
                            </div>
                            <a href="#"><h4>Penyewaan Skafolding</h4></a>
                            <p>Melayani penyewaan Skafolding dengan ketepatan waktu pengiriman dan kemudahan peminjaman</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service2_item">
                            <div class="service2_item_inner">
                                <div class="service2_item_inner_content">
                                    <div class="service_icon">
                                         <img src="img/icon/s-icon-2.png" alt="">
                                <img src="img/icon/s-icon-hover-2.png" alt="">
                            </div>
                            <a href="#"><h4>Konsultasi PRA Konstruksi</h4></a>
                            <p>Jasa Konsultasi bagi anda yang membutuhkan bantuan dalam hal perencanaan , design ataupun estimasi biaya</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service2_item">
                            <div class="service2_item_inner">
                                <div class="service2_item_inner_content">
                                    <div class="service_icon">
                                        <img src="img/icon/s-icon-3.png" alt="">
                                <img src="img/icon/s-icon-hover-3.png" alt="">
                            </div>
                            <a href="#"><h4>Perawatan Gedung</h4></a>
                            <p>Layanan Perawatan gedung secara umum, pengecekan bangunan </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service2_item">
                            <div class="service2_item_inner">
                                <div class="service2_item_inner_content">
                                    <div class="service_icon">
                                          <img src="img/icon/s-icon-1.png" alt="">
                                <img src="img/icon/s-icon-hover-1.png" alt="">
                            </div>
                            <a href="#"><h4>Rancang Bangun</h4></a>
                            <p>Melayani perencanaan pembangunan hingga akhir proses pmbangunan sebagai konsultan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service2_item">
                            <div class="service2_item_inner">
                                <div class="service2_item_inner_content">
                                    <div class="service_icon">
                                         <img src="img/icon/s-icon-5.png" alt="">
                                <img src="img/icon/s-icon-hover-5.png" alt="">
                            </div>
                            <a href="#"><h4>RENOVASI</h4></a>
                            <p>Jasa Renovasi bagi para clien yang menginginkan perubahan untuk cust</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service2_item">
                            <div class="service2_item_inner">
                                <div class="service2_item_inner_content">
                                    <div class="service_icon">
                                       <img src="img/icon/s-icon-4.png" alt="">
                                <img src="img/icon/s-icon-hover-4.png" alt="">
                            </div>
                            <a href="#"><h4>Supplier</h4></a>
                            <p>Menerima juga jasa budang penyediaan peralatan kantor serta kelengkapan AC <br></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Our Service2 Area =================-->
        
        <!--================Our Project2 Area =================-->

        <!--================End Our Project2 Area =================-->
        
        <!--================Quoto Slider Area =================-->
        <section class="quoto_slider_area">
            <div class="container">
                <div class="quoto_slider_inner">
                    <div class="quoto_slider owl-carousel">
                        <div class="item">
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            <h4><span>weBuilder </span>theme one of the best for constraction website</h4>
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings.</p>
                            <h3>--  WeBuilder, CEO, WeBuilder</h3>
                        </div>
                        <div class="item">
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            <h4><span>weBuilder </span>theme one of the best for constraction website</h4>
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings.</p>
                            <h3>--  WeBuilder, CEO, WeBuilder</h3>
                        </div>
                        <div class="item">
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            <h4><span>weBuilder </span>theme one of the best for constraction website</h4>
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings.</p>
                            <h3>--  WeBuilder, CEO, WeBuilder</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Quoto Slider Area =================-->
        
        <!--================Our Team2 Area =================-->
    
        <!--================End Our Team2 Area =================-->
        
        <!--================Latest News Area =================-->
        <section class="latest_news_area">
            <div class="container">
                <div class="main_c_b_title">
                    <h2>latest <br class="title_br" />news</h2>
                    <h6>Construction World</h6>
                </div>
                <div class="row latest_news_inner">
                    <div class="col-md-4 col-sm-6">
                        <div class="latest_news_item">
                            <div class="news_image">
                                <img src="img/blog/l-news/l-news-1.jpg" alt="">
                                <div class="l_date">
                                    <h5>14</h5>
                                    <h6>Aug</h6>
                                </div>
                            </div>
                            <div class="news_content">
                                <a href="#"><h4>The Road To Success Is Always Under Construction</h4></a>
                                <h6>Posted By <a href="#">Admin</a></h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                <div class="pull-left">
                                    <a href="#">2 Comments</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="latest_news_item">
                            <div class="news_image">
                                <img src="img/blog/l-news/l-news-2.jpg" alt="">
                                <div class="l_date">
                                    <h5>14</h5>
                                    <h6>Aug</h6>
                                </div>
                            </div>
                            <div class="news_content">
                                <a href="#"><h4>The Road To Success Is Always Under Construction</h4></a>
                                <h6>Posted By <a href="#">Admin</a></h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                <div class="pull-left">
                                    <a href="#">2 Comments</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="latest_news_item">
                            <div class="news_image">
                                <img src="img/blog/l-news/l-news-3.jpg" alt="">
                                <div class="l_date">
                                    <h5>14</h5>
                                    <h6>Aug</h6>
                                </div>
                            </div>
                            <div class="news_content">
                                <a href="#"><h4>The Road To Success Is Always Under Construction</h4></a>
                                <h6>Posted By <a href="#">Admin</a></h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                <div class="pull-left">
                                    <a href="#">2 Comments</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Latest News Area =================-->
        
        <!--================Clients Area =================-->
        <!--================End Clients Area =================-->
        
        <!--================Subscrib Form Area =================-->
        <section class="subscribe_area">
            <div class="container">
                <div class="pull-left">
                    <h4>Subscribe our email newsletter today to recieve our special offer</h4>
                </div>
                <div class="pull-right">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Your Email Address">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Subscrib Form Area =================-->
        
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
                                            <a href="#"><p>Pengerjaan Gedung UMM 1</p></a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                        </div>
                                        <div class="media-body">
                                            <a href="#"><p>Pengerjaan kantor BCA Sukun</p></a>
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
                    <h4><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></h4>
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