<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>@yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">

        <!-- Custom Css for Admin Panel -->
        <link href="{{asset('css/adminpanel_layout.css')}}" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    </head>

    <body class="fix-header fix-sidebar">
        <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>

        <!-- Main wrapper  -->
        <div id="main-wrapper">
            <!-- header header  -->
            <div class="header">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <!-- Logo -->
                    <div class="navbar-header">
                        <li class="nav-item">
                            <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)">
                            <div class="navbar-brand">
                                <img src="{{asset('images/logo_2.png')}}" class="dark-logo" height="30px" />
                                </div>
                            </a>
                        </li>

                        <li class="nav-item m-l-10">
                            <a class="nav-link  hidden-sm-down text-muted  ">
                                <div class="navbar-brand">
                                    <img src="{{asset('images/logo_2.png')}}" class="dark-logo" height="50px" />
                                </div>
                            </a>
                        </li>
                    </div>

                    <!-- End Logo -->
                    <div class="navbar-collapse">

                        <!-- toggle and nav items -->
                        <ul class="navbar-nav mr-auto mt-md-0">
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        </ul>

                        <ul class="navbar-nav mr-auto">
                            <p class='school-name'>Admin Panel</p>
                        </ul>

                        <!-- User profile and search -->
                        <ul class="navbar-nav my-lg-0">
                            <!-- Logout -->
                            <li class="nav-item hidden-sm-down">
                                <a class="nav-link hidden-sm-down text-muted"  href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                                    <i class="fa fa-power-off"></i> <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>

                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>

            <!-- End header header -->
            <!-- Left Sidebar  -->
            <div class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="nav-devider"></li>

                            <li>
                                <a href="{{route('employees')}}"><i class="fa fa-users"></i>Employees</a>
                            </li>

                            <li>
                                <a href="{{route('mcq_questions')}}"><i class="fa fa-question-circle"></i>MCQ Questions</a>
                            </li>

                            <li>
                                <a href="{{route('situation_assesment')}}"><i class="fa fa-video-camera"></i>Assesment Questions</a>
                            </li>

                            <li>
                                <a href="{{route('results')}}"><i class="fa fa-list-ul"></i>Results</a>
                            </li>

                            <li>
                                <a href="{{route('employers')}}"><i class="fa fa-user-circle"></i>Employers</a>
                            </li>

                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </div>
            <!-- End Left Sidebar  -->
            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <!-- Bread crumb -->
                <div class="row page-titles d-flex">
                    <div class="col-md-5 align-self-center mr-auto p-2">
                        <h3 class="text-primary">@yield('title')</h3>
                    </div>
                    <div class="p-2">
                        @yield('additional_content')
                    </div>
                </div>
                @if(!$errors->isEmpty())
                    <div class="admin_error_message">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                @endif

                @if(session('message'))
                    <div class="admin_success_message">{{session('message')}}</div>
                @endif

                <div class="container-fluid">
                    <div class="container">
                        @yield('content')
                    </div>

                </div>
            </div>
                <!-- End Container fluid  -->
                <!-- footer -->
            <footer class="footer"> © 2020 All rights reserved.</footer>
                <!-- End footer -->
        </div>
        <!-- End Wrapper -->


        <!-- Additional Modal -->

        <!-- All Jquery -->
        <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>

        <!-- Bootstrap JS -->
        <script src="{{asset('js/bootstrap.js')}}"></script>

        <!--Custom JavaScript for progressbar and menu -->
        <script src="{{asset('js/progressbar.js')}}"></script>

        <!-- Sidebar response for Mobile Version -->
        <script src="{{asset('js/sticky-kit.js')}}"></script>

        <script src="{{asset('js/adminpanel_layout.js')}}"></script>

        @yield('extra_script')

    </body>

</html>
