<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Eduleb')</title>
    <!-- Links of CSS files -->
    <!-- Meta -->
    <link rel="shortcut icon" href="{{asset("assets/img/fb.svg") }}" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Eduleb - Education HTML Template">
    {{-- <meta name="crsf-token" content="{{ crsf_token()}}"> --}}
    <meta name="keywords"
        content="agency, business, corporate, creative, html5, modern, multipurpose, One Page, parallax, startup">
    <!-- SITE TITLE -->

    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Google Font -->
    {{-- <link --}}
        {{-- href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" --}}
        {{-- rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/themify-icons.css') }}">
    <!--- owl carousel Css-->
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/css/owl.theme.css') }}">
    <!--jquery-simple-mobilemenu Css-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-simple-mobilemenu.css') }}">
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    @yield('CSS')
</head>

<body data-spy="scroll" data-offset="80">
    <!-- START PRELOADER -->
    {{-- <div class="preloaders">
        <span class="loader"></span>
    </div>
    <!-- END PRELOADER --> --}}

    <!-- START NAVBAR -->
    <div id="navigation" class="navbar-light bg-faded site-navigation">
        <div class="container-fluid">
            <div class="row">
                <div class="col-20 align-self-center">
                    <div class="site-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt=""></a>
                    </div>
                </div><!--- END Col -->

                <div class="col-60 d-flex">
                    <nav id="main-menu">
                        <ul>

                            <li><a href="{{ route('home') }}">Home</a></li>

                            <li><a href="{{ route('about') }}">About</a></li>

                            <li><a href="{{ route('courses.index') }}">Course</a></li>

                            </li>

                            <li><a href="{{ route('instractors.index') }}">Instructor</a></li>

                            <li><a href="{{ route('FAQ.index') }}">Faq</a></li>
                            <li><a href="{{ route('pricing') }}">Pricing Plan</a></li>
                            <li><a href="{{ route('blogs.index') }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                </div><!--- END Col -->

            <div class="col-20 d-none d-xl-block text-end align-self-center">
    @auth
        <!-- قائمة منسدلة للمستخدم المسجل (Dropdown) -->
        <div class="dropdown d-inline-block">
            <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2 border-0 bg-transparent text-blue-800"
                    type="button"
                    id="userDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="font-size: larger; font-weight: 600;">
                <!-- صورة مصغرة للمستخدم أو اسم حسابة -->
                <span>{{ auth()->user()->name }}</span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                <!-- رابط لوحة التحكم -->
                <li>
                    <a class="dropdown-item py-2 px-3 fw-medium" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <!-- زر تسجيل الخروج -->
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 px-3 text-danger fw-medium d-flex align-items-center justify-content-between w-100">
                            <span>Sign Out</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M15.6666 7.6666 V 4.3333 c 0 -0.736 -0.5973 -1.3333 -1.3333 -1.3333 H 5.6667 c -0.736 0 -1.3333 0.5973 -1.3333 1.3333 V 19.6666 c 0 0.736 0.5973 1.3333 1.3333 1.3333 h 8.6666 c 0.736 0 1.3333 -0.5973 1.3333 -1.3333 v -3.3333" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
                                <polyline points="19.3333 8.3333 22.9999 12 19.3333 15.6666" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></polyline>
                                <line x1="22.9999" y1="12" x2="15" y2="12" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                            </svg>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    @endauth

    @guest
        <!-- أزرار تسجيل الدخول وإنشاء الحساب للزوار -->
        <div class="d-inline-flex align-items-center gap-3">
            <a href="{{ route('login') }}" class="header-btn text-blue-800 text-decoration-none d-flex align-items-center gap-1" style="font-size: larger">
                <span>Sign In</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M 9.6666 7.0104 V 4.3333 C 9.6666 3.5973 10.264 3 11 3 H 19.6666 C 20.4026 3 20.9999 3.5973 20.9999 4.3333 V 19.6666 C 20.9999 20.4026 20.4026 20.9999 19.6666 20.9999 H 11 C 10.264 20.9999 9.6666 20.4026 9.6666 19.6666 V 16.9896" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                    <path d="M 5.3333 15.6666 L 9 12 L 5.3333 8.3333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                    <path d="M 9 12 H 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                </svg>
            </a>

            <a href="{{ route('register') }}" class="header-btn text-blue-800 text-decoration-none d-flex align-items-center gap-1" style="font-size: larger">
                <span>Sign Up</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C11.5858 21.25 11.25 21.5858 11.25 22C11.25 22.4142 11.5858 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 12.4142 1.58579 12.75 2 12.75C2.41421 12.75 2.75 12.4142 2.75 12Z" fill="currentColor" />
                    <path d="M5 12.25C4.58579 12.25 4.25 12.5858 4.25 13C4.25 13.4142 4.58579 13.75 5 13.75H9.18934L2.46967 20.4697C2.17678 20.7626 2.17678 21.2374 2.46967 21.5303C2.76256 21.8232 3.23744 21.8232 3.53033 21.5303L10.25 14.8107V19C10.25 19.4142 10.5858 19.75 11 19.75C11.4142 19.75 11.75 19.4142 11.75 19V13C11.75 12.5858 11.4142 12.25 11 12.25H5Z" fill="currentColor" />
                </svg>
            </a>
        </div>
    @endguest
</div><!--- END Col -->
                <ul class="mobile_menu">
                    <li><a href="{{ route('home') }}">Home </a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('courses.index') }}">Course</a></li>
                    <li><a href="{{ route('instractors.index') }}">Instructor</a></li>
                    <li><a href="{{ route('pricing') }}">Pricing Plan</a></li>
                    <li><a href="{{ route('FAQ.index') }}">Faq Page</a></li>
                    <li><a href="{{ route('blogs.index') }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    @auth<li><a href="#">

                                <form style="padding: 0%" action="{{ route('logout') }}" method="POST">
                                    <button
                                        style="border: none;background-color: black;padding: 0%;font-weight: 300;font-family: Arial, Helvetica, sans-serif"
                                        type="submit" class="header-btn text-white">Sign Out <svg class="mb-1"
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M 15.6666 7.6666 V 4.3333 c 0 -0.736 -0.5973 -1.3333 -1.3333 -1.3333 H 5.6667 c -0.736 0 -1.3333 0.5973 -1.3333 1.3333 V 19.6666 c 0 0.736 0.5973 1.3333 1.3333 1.3333 h 8.6666 c 0.736 0 1.3333 -0.5973 1.3333 -1.3333 v -3.3333"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                            <polyline points="19.3333 8.3333 22.9999 12 19.3333 15.6666" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5"></polyline>
                                            <line x1="22.9999" y1="12" x2="15" y2="12"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></line>
                                            <path
                                                d="M 4.6093 3.5307 l 4.428 2.7453 c 0.392 0.2427 0.6307 0.672 0.6307 1.1333 v 9.1826 c 0 0.4613 -0.2387 0.8893 -0.6307 1.1333 l -4.4293 2.7467"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"></path>
                                        </svg></button>
                                </form>
                        </li>
                        </a>
                    @endauth
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="header-btn text-blue-800">Sign In <svg class="mb-1"
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M 9.6666 7.0104 V 4.3333 C 9.6666 3.5973 10.264 3 11 3 H 19.6666 C 20.4026 3 20.9999 3.5973 20.9999 4.3333 V 19.6666 C 20.9999 20.4026 20.4026 20.9999 19.6666 20.9999 H 11 C 10.264 20.9999 9.6666 20.4026 9.6666 19.6666 V 16.9896"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" fill="none"></path>
                                    <path d="M 5.3333 15.6666 L 9 12 L 5.3333 8.3333" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                        fill="none"></path>
                                    <path d="M 9 12 H 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" fill="none"></path>
                                    <path
                                        d="M 20.7239 3.5307 L 16.296 6.276 C 15.904 6.5187 15.6653 6.948 15.6653 7.4093 V 16.592 C 15.6653 17.0533 15.904 17.4813 16.296 17.7253 L 20.7253 20.4719"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" fill="none"></path>
                                </svg></a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="header-btn text-blue-800">Sign Up <svg
                                    class="mb-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C11.5858 21.25 11.25 21.5858 11.25 22C11.25 22.4142 11.5858 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 12.4142 1.58579 12.75 2 12.75C2.41421 12.75 2.75 12.4142 2.75 12Z"
                                        fill="currentColor" />
                                    <path
                                        d="M5 12.25C4.58579 12.25 4.25 12.5858 4.25 13C4.25 13.4142 4.58579 13.75 5 13.75H9.18934L2.46967 20.4697C2.17678 20.7626 2.17678 21.2374 2.46967 21.5303C2.76256 21.8232 3.23744 21.8232 3.53033 21.5303L10.25 14.8107V19C10.25 19.4142 10.5858 19.75 11 19.75C11.4142 19.75 11.75 19.4142 11.75 19V13C11.75 12.5858 11.4142 12.25 11 12.25H5Z"
                                        fill="currentColor" />
                                </svg></a>
                        </li>
                    @endguest
                </ul>
            </div><!--- END ROW -->

        </div><!--- END CONTAINER -->
        <div class="col-20  d-xl-block text-end align-self-center">


        </div><!--- END Col -->
    </div>
    <!-- END NAVBAR -->




    @yield('content')

    <!-- START FOOTER -->
    <div class="footer section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single_footer">
                        <a href="index.html"><img alt=""></a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae risus nec dui venenatis
                            dignissim.</p>
                        <div class="social_profile">
                            <ul>
                                <li><a class="f_facebook" href="#"><i class="fa-solid fa-x"></i></a></li>
                                <li><a class="f_twitter" href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li><a class="f_instagram"href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a class="f_linkedin" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-2 col-sm-6 col-xs-12">
                    <div class="single_footer">
                        <h4>About Eduleb</h4>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Instructor Registration</a></li>
                            <li><a href="#">Become A Teacher</a></li>
                            <li><a href="#">All Instrustors</a></li>
                            <li><a href="#">Asked Question</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-2 col-sm-6 col-xs-12">
                    <div class="single_footer">
                        <h4>Popular Courese</h4>
                        <ul>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Arts & design</a></li>
                            <li><a href="#">Visual Design</a></li>
                            <li><a href="#">Graphic Design</a></li>
                            <li><a href="#">Code Inspection</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                        </ul>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single_footer">
                        <h4>Contact Info</h4>
                        <div class="sf_contact">
                            <span class="ti-map"></span>
                            <p>2570 Quadra Street Victoria Road, New York, Canada</p>
                        </div>
                        <div class="sf_contact">
                            <span class="ti-mobile"></span>
                            <p>+88 457 845 695</p>
                        </div>
                        <div class="sf_contact">
                            <span class="ti-mobile"></span>
                            <p><a href="tel:+88457845695">Contact Whatsapp</a></p>
                        </div>
                        <div class="sf_contact">
                            <span class="ti-email"></span>
                            <p>example@yourmail.com</p>
                        </div>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-2 col-sm-6 col-xs-12">
                    <div class="single_footer">
                        <h4>Download App</h4>
                        <p>Download our app from app store and goole play store.</p>
                        <a href="index.html"><img class="foot_img" alt=""></a>
                        <a href="index.html"><img class="foot_img" alt=""></a>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </div>
    <!-- END FOOTER -->

    <!-- START FOOTER COPYRIGHT -->
    <div class="foot_copy">
        <div class="footer_copyright">
            <p>&copy; 2024. All Rights Reserved by <a href="https://bestwpware.com/">Bestwpware</a> • Distributed by <a
                    href="https://themewagon.com">ThemeWagon</a></p>
        </div>
    </div>
    <!-- END FOOTER COPYRIGHT -->



    <!-- Links of JS files -->

    <!-- Latest jQuery -->
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <!-- Latest compiled and minified Bootstrap -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- modernizer JS -->
    <script src="{{ asset('assets/js/modernizr-2.8.3.min.js') }}"></script>
    <!-- jquery-simple-mobilemenu.min -->
    <script src="{{ asset('assets/js/jquery-simple-mobilemenu.js') }}"></script>
    <!-- owl-carousel min js  -->
    <script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <!-- magnific-popup js -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- countTo js -->
    <script src="{{ asset('assets/js/jquery.inview.min.js') }}"></script>
    <!-- scrolltopcontrol js -->
    <script src="{{ asset('assets/js/scrolltopcontrol.js') }}"></script>
    <!-- WOW - Reveal Animations When You Scroll -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- scripts js -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    @yield('JS')

</body>

</html>
