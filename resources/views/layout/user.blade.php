
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>@yield('title')</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}?v=1">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}?v=1">
        <link rel="stylesheet" href="{{asset('css/style.css')}}?v=1.3">
        <link rel="stylesheet" href="{{asset('css/all.css')}}?v=1">
        <link rel="stylesheet" href="{{asset('css/user_panel_custom_style.css')}}?v=1.1">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}?v=1.1">

        <style>

            @font-face {
            font-family: MyRaleway;
            src: url("font/Raleway.ttf");
            }

            body {
                line-height: 26px;
                font-size: 16px;
                font-family: "MyRaleway", sans-serif;
                /* font-family: "Roboto", sans-serif; */
                font-weight: normal;
                color: #777777;
                /*background-image: -webkit-linear-gradient(0deg, #766dff 0%, #88f3ff 100%);*/
                background-image: url({{ asset('images/bg.jpg') }});    
                /* background-size: 50% 110%;*/
                background-size: contain;
                background-repeat: no-repeat;
                background-position: right;
                background-attachment: fixed
            }
        </style>
    </head>
    <body>


        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="d-flex container box_1620">
                        {{-- <p class="header_title">Online Assesment Tool</p> --}}
                        <img class="mr-auto p-2" src="{{asset('images/logo_2.png')}}" height="55px"/>
                        <img class="p-2" src="{{asset('images/logo_1.png')}}" height="60px"/>
					</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->

        <!--================Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="courses item-section">
                <div class="container">
                    <div class="col-md-4 pull-left mt-5">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('js/custom_script.js')}}"></script>
        <script src="{{asset('js/popper.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/stellar.js')}}"></script>
        {{-- <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="vendors/popup/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendors/counter-up/jquery.counterup.min.js"></script> --}}
        {{-- <script src="js/mail-script.js"></script> --}}
        <script src="{{asset('js/theme.js')}}"></script>

        @yield('extra_script')
    </body>
</html>
