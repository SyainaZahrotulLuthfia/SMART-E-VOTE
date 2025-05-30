<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Smart E-Vote</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <!-- SweetAlert -->
    <!-- SweetAlert2 CSS (Lokal) -->
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- SweetAlert2 JS (Lokal) -->
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"> <span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                {{-- <form class="form-inline search-full col" action="#" method="get">
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative">
                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                                    placeholder="Search .." name="q" title="" autofocus>
                                <div class="spinner-border Typeahead-spinner" role="status"><span
                                        class="sr-only">Loading...</span></div><i class="close-search"
                                    data-feather="x"></i>
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form> --}}
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper"><a href="index.html"><img class="img-fluid"
                                src="{{ asset('assets/images/logo/black.png') }}" alt=""></a>
                    </div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle"
                            data-feather="align-center"></i>
                    </div>
                </div>

                <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                    <ul class="nav-menus">
                        {{-- <li> <span class="header-search">
                                <svg>
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#search') }}"></use>
                                </svg></span></li> --}}
                        <li>
                            <div class="mode">
                                <svg>
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#moon') }}"></use>
                                </svg>
                            </div>
                        </li>
                        <li class="profile-nav onhover-dropdown pe-0 py-0">
                            {{-- <div class="media profile-media"> <img class="b-r-10"
                                    src="{{ asset('assets/images/dashboard/5.png') }}" alt=""
                                    style="width: 35px; height: 35px;">
                                <div class="media-body"><span>{{ Auth::user()->name }}</span>
                                    <p class="mb-0">{{ Auth::user()->email }}
                                        <i class="middle fa fa-angle-down"></i>
                                    </p>
                                </div>
                            </div> --}}
                            <div class="media profile-media">
                                @if (auth()->user()->hasRole('admin'))
                                    <img class="b-r-10" src="{{ asset('assets/images/dashboard/5.png') }}"
                                        alt="Admin Profile" style="width: 35px; height: 35px;">
                                @elseif (auth()->user()->hasRole('student'))
                                    <img class="b-r-10" src="{{ asset('assets/images/dashboard/4.png') }}"
                                        alt="Student Profile" style="width: 35px; height: 35px;">
                                @else
                                    <img class="b-r-10" src="{{ asset('assets/images/dashboard/default.png') }}"
                                        alt="Default Profile" style="width: 35px; height: 35px;">
                                @endif

                                <div class="media-body">
                                    <span>{{ Auth::user()->name }}</span>
                                    <p class="mb-0">{{ Auth::user()->email }}
                                        <i class="middle fa fa-angle-down"></i>
                                    </p>
                                </div>
                            </div>

                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="#"><i data-feather="lock"></i><span>Password</span></a></li>
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i
                                            data-feather="log-out"> </i><span>Sign Out</span></a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper" sidebar-layout="stroke-svg">
                <div>
                    <div class="logo-wrapper"><a><img class="img-fluid for-light"
                                src="{{ asset('assets/images/logo/black.png') }}" alt="" width="130"
                                height="130"><img class="img-fluid for-dark"
                                src="{{ asset('assets/images/logo/light.png') }}" alt="" width="130"
                                height="130"></a>
                        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle"
                                data-feather="grid"> </i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href=""><img class="img-fluid"
                                src="{{ asset('assets/images/logo/iconlogo.png') }}" alt="" width="40"
                                height="40"></a>
                    </div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn">
                                    <a href="">
                                        <img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}"
                                            alt="">
                                    </a>
                                    <div class="mobile-back text-end"><span>Back</span><i
                                            class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>

                                @if (auth()->user()->hasRole('admin'))
                                    <li class="pin-title sidebar-main-title mt-0 pt-3">
                                        <div>
                                            <h6>Pinned</h6>
                                        </div>
                                    </li>
                                    <li class="sidebar-main-title">
                                        <div>
                                            <h6>Master</h6>
                                        </div>
                                    </li>
                                @endif

                                <!-- Admin-only links -->
                                @if (auth()->user()->hasRole('admin'))
                                    <li class="sidebar-list">
                                        <i class="fa fa-thumb-tack"></i>
                                        <a class="sidebar-link sidebar-title link-nav"
                                            href="{{ route('admin.dashboard') }}">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                                            </svg>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                                        <a class="sidebar-link sidebar-title link-nav"
                                            href="{{ route('classrooms.index') }}">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                                            </svg>
                                            <span>Kelas</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                                        <a class="sidebar-link sidebar-title link-nav"
                                            href="{{ route('votes.index') }}">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-calendar') }}">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-calendar') }}">
                                                </use>
                                            </svg>
                                            <span>Pemilihan</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-list">
                                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <svg class="stroke-icon" style="transform: scaleX(-1);">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#back-arrow') }}">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon" style="transform: scaleX(-1);">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#back-arrow') }}">
                                                </use>
                                            </svg>
                                            <span>Sign Out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endif

                                <!-- Student-only links -->
                                @if (auth()->user()->hasRole('student'))
                                    {{-- Dashboard --}}
                                    <li class="sidebar-list pt-2">
                                        <a class="sidebar-link sidebar-title link-nav"
                                            href="{{ route('student.dashboard') }}">
                                            <svg class="stroke-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                                            </svg>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    {{-- Sign Out --}}
                                    <li class="sidebar-list">
                                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <svg class="stroke-icon" style="transform: scaleX(-1);">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#back-arrow') }}">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon" style="transform: scaleX(-1);">
                                                <use href="{{ asset('assets/svg/icon-sprite.svg#back-arrow') }}">
                                                </use>
                                            </svg>
                                            <span>Sign Out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </nav>

                    @if (session('success'))
                        <script>
                            Swal.fire({
                                title: "Good job!",
                                text: "{{ session('success') }}",
                                icon: "success"
                            });
                        </script>
                    @endif
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h4>@yield('title', 'title')</h4>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <span class="text-secondary">@yield('breadcrumb', 'breadcrumb')</span>
                                        <span class="mb-0">@yield('page', 'page')</span>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">© Copyright 2025
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/js/header-slick.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/clock.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/dashboard/default.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/notify/index.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script> --}}
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- <script src="{{ asset('/assets/js/theme-customizer/customizer.js') }}"></script> --}}
    <script>
        new WOW().init();
    </script>
</body>

</html>
