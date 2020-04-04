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
        <link href="vendors/flex-slider/flexslider.css" rel="stylesheet">
        
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
                        <a href="#"><i class="fa fa-phone"></i>(012) - 3456789</a>
                        <a href="#"><i class="fa fa-map-marker"></i>1234 Cafficic, California</a>
                        <a href="#"><i class="mdi mdi-clock"></i>08 AM - 10 PM</a>
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
                            <a class="navbar-brand" href="#"><img src="img/logo.png" alt=""></a>
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
        
        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="container">
                <div class="banner_inner_text">
                    <h4>Project Single Page</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li class="active"><a href="#">Project single page 01</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!--================End Banner Area =================-->
        
        <!--================PreConstruction Area =================-->
        <section class="preconstruction_area">
            <div class="row pre_construction_inner">
                <div class="col-md-6">
                    <div class="pre_construction_item">
                        <img src="img/pre-cons-left.jpg" alt="">
                        <div class="pre_hover">
                            <h4>PRE-CONSTRUCTION</h4>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                            <a class="slider_btn" href="#">Read Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pre_construction_right">
                        <img src="img/pre-cons-right.jpg" alt="">
                        <div class="pre_hover">
                            <h4>CIVIL & ARCHITECTURE</h4>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                            <a class="slider_btn" href="#">Read Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End PreConstruction Area =================-->
        
        <!--================Project Single Area =================-->
        <section class="project_single_area">
            <div class="container">
                <div class="project_single_inner">
                    <div class="project_single_slider">
                        <div id="slider" class="flexslider">
                            <ul class="slides">
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-s-1.jpg" alt=""></li>
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <li><img src="img/project/project-single-slider/project-thumb-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-2.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-3.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-4.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-1.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-2.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-3.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-4.jpg" alt=""></li>
                                <li><img src="img/project/project-single-slider/project-thumb-1.jpg" alt=""></li>
                            </ul>
                            <div class="custom-navigation">
                                <a href="#" class="flex-prev"><i class="fa fa-angle-left"></i></a>
                                <a href="#" class="flex-next"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="project_summery">
                                <h4 class="project_title">Project Summery</h4>
                                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed semper, lacus sed feugiat dictum.</p>
                                <ul>
                                    <li><a href="#">Client’s Name : <span>Md. Shafiqul Alom</span> </a></li>
                                    <li><a href="#">Catagory: <span>Repairing</span></a></li>
                                    <li><a href="#">Value: <span>$154543</span></a></li>
                                    <li><a href="#">Year Completed: <span>April 2010</span> </a></li>
                                    <li><a href="#">Area: <span>21,000 m2</span></a></li>
                                    <li><a href="#">Architect: <span>Masud & Rocky</span></a></li>
                                    <li><a href="#">Location: <span>123, ABC Road, London</span></a></li>
                                    <li><a href="#">Investors website: <span>www.domain.com</span></a></li>
                                </ul>
                            </div>
                            <div class="project_quote">
                                <h4 class="project_title">Owner Review</h4>
                                <div class="quote_inner">
                                    <p>Proin gravida nibh vel velit hace aauctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipissum, nec sagittis sem nibh id elit.  </p>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-o"></i></a>
                                </div>
                            </div>
                            <div class="panel-group project_collaps" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingfour">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="project_discription">
                                <h4 class="project_title">Project Summery</h4>
                                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed semper, lacus sed feugiat dictum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore. Proin gravida nibh vel velit hace aauctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipissum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit aasmet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio.</p>
                                <p>Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti hacsociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam.</p>
                                <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed semper, lacus sed feugiat dictum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore. Proin gravida nibh vel velit hace aauctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipissum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit aasmet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio.</p>
                            </div>
                            <div class="project_s_tab">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Tab 01</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Tab 02</a></li>
                                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Tab 03</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active fade in" id="home">
                                        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed semper, lacus sed feugiat dictum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                                        <p>Proin gravida nibh vel velit hace aauctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipissum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit aasmet mauris. Morbi accumsan ipsum velit.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="profile">
                                        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed semper, lacus sed feugiat dictum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                                        <p>Proin gravida nibh vel velit hace aauctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipissum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit aasmet mauris. Morbi accumsan ipsum velit.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="messages">
                                        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed semper, lacus sed feugiat dictum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                                        <p>Proin gravida nibh vel velit hace aauctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipissum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit aasmet mauris. Morbi accumsan ipsum velit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Project Single Area =================-->
        
        <!--================Our Latest Project Area =================-->
        <section class="our_latest_project">
            <div class="container">
                <h3 class="out_title">Our Latest projects</h3>
                <div class="our_latest_slider owl-carousel">
                    <div class="item">
                        <div class="project_item">
                            <img src="img/project/project-2/project-1.jpg" alt="">
                            <div class="project_hover">
                                <div class="project_hover_inner">
                                    <div class="project_hover_content">
                                        <a href="#"><h4>Jahanara Vila</h4></a>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium </p>
                                        <a class="view_btn" href="#">View Project</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="project_item">
                            <img src="img/project/project-2/project-2.jpg" alt="">
                            <div class="project_hover">
                                <div class="project_hover_inner">
                                    <div class="project_hover_content">
                                        <a href="#"><h4>Jahanara Vila</h4></a>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium </p>
                                        <a class="view_btn" href="#">View Project</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="project_item">
                            <img src="img/project/project-2/project-3.jpg" alt="">
                            <div class="project_hover">
                                <div class="project_hover_inner">
                                    <div class="project_hover_content">
                                        <a href="#"><h4>Jahanara Vila</h4></a>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium </p>
                                        <a class="view_btn" href="#">View Project</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Our Latest Project Area =================-->
        
        <!--================Get Quote Area =================-->
        <section class="get_quote_area project_contact">
            <div class="container">
                <div class="pull-left">
                    <h3>Save Your Money </h3>
                    <h4>Call us today or Contact us to get started your project.. </h4>
                </div>
                <div class="pull-right">
                    <a class="get_btn_black" href="#">Contact Us</a>
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
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusan-tium doloremque laudantium. ed quia consequuntur magni dolores eos qui ratione.</p>
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
                                    <h3>Recent Posts</h3>
                                </div>
                                <div class="recent_w_inner">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="img/blog/recent-post/recent-1.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <a href="#"><p>The road to success is always under con-struction</p></a>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="img/blog/recent-post/recent-2.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <a href="#"><p>The road to success is always under con-struction</p></a>
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
                                            <p>1234 Cafficic, California, USA</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="media-body">
                                            <p>(012) 3456789 </p>
                                            <p>(012) 3456789 </p>
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
                                <h4>(012) 3456789</h4>
                                <h5>or</h5>
                                <a class="get_bg_btn" href="#">GET A QUOTE</a>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_copy_right">
                <div class="container">
                    <h4><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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