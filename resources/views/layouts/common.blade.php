<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Google tag (gtag.js) -->
    <meta name="google-site-verification" content="axQgz-PIIO4M7EE_054IAJINbqKpm2q8UqJ2nomWo9Q" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7SD1W56C8V"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-7SD1W56C8V');
    </script>
    <meta charset="UTF-8">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daatrade | Empowering B2B Connections</title>
    <!-- Start The SEO Framework by Sybre Waaijer -->
    <meta name="description" content="Empowering B2B Connections on daatrade&#8230;" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="daatrade | Empowering B2B Connections" />
    <meta property="og:description" content="Empowering B2B Connections on daatrade&#8230;" />
    <meta property="og:url" content="https://daatrade.com/" />
    <meta property="og:site_name" content="daatrade" />
    <link rel="canonical" href="https://daatrade.com/" />
    <!-- End The SEO Framework by Sybre Waaijer | 0.00117s -->
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/elegant-icons.css') }}" type="text/css">

    {{-- @unless (Request::is('register'))
        <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}" type="text/css">
    @endunless --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/icon.jpg') }}" />
    <style>
        .blog__details__text ul {
            margin: 2em;
        }

        .blog__details__text li {
            margin: 2em;
        }

        .hero__categories li {
            position: relative;
        }

        .hero__categories .submenu {
            display: none;
            position: absolute !important;
            top: 0 !important;
            left: 100% !important;
            min-width: 200PX !important;
            margin-left: 1px !important;
            Z-INDEX: 100 !important;
            background-color: #fff !important;
        }

        .hero__categories li:hover .submenu {
            display: block;
        }

        .hero__categories li .submenu .subchildmenu {
            display: none;
            position: absolute;
            left: 100%;
            top: 15px;
            width: 100%;
            z-index: 9;
            background: #ffffff;
        }

        .hero__categories li .submenu li:hover .subchildmenu {
            display: block;
        }

        .site-btn {
            border-radius: 20px 50px;
            /* This will make the button round */
            /* Add other styles as needed */
        }

        .hero__search__form {
            border-radius: 20px 50px;
        }

        .circle-container {
            width: 50px;
            /* Set the desired width and height of the circle */
            height: 50px;
            border-radius: 50%;
            /* This creates a circular shape */
            overflow: hidden;
            /* Hide the parts of the image outside the circle */
            margin: 0 auto;
            /* Center the circle */
        }

        .circle-image {
            width: 50px;
            /* Set the desired width and height of the circle */
            height: 50px;
            /* Make the image fill the circle container */
        }

        .image-gallery img {
            width: 100%;
            aspect-ratio: 3/2;
            object-fit: contain;
        }
    </style>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VD6FLXDN9D"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-VD6FLXDN9D');
    </script>
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Humberger Begin -->

    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('assets/img/logo.png') }}" alt="Daatrade"></a>
        </div>
        {{-- <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div> --}}
        <div class="humberger__menu__widget">
            <!--
            <div class="header__top__right__language">
                <img src="{{ asset('assets/img/language.png') }}" alt="Daatrade">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
-->
            <div class="header__top__right__auth">
                <a href="{{ route('login') }}" class="float-left"><i class="fa fa-user"></i>
                    Login</a> &nbsp; / &nbsp;
                <a href="{{ route('register') }}" class="float-right"> Register</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <!--
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="#">Shop Details</a></li>
                        <li><a href="#">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="#">Blog</a></li>
-->
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>

            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="https://facebook.com/daatrade"><i class="fa fa-facebook"></i></a>
            <a href="https://www.tiktok.com/@daatrade"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                </svg></a>
            <a href="https://www.linkedin.com/company/daatrade/"><i class="fa fa-linkedin"></i></a>
            <a href="https://youtube.com/@Daatrade?si=cSukgAziHrzWpSJG"><i class="fa fa-youtube"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> info@daatrade.com</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> info@daatrade.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="https://facebook.com/daatrade"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.tiktok.com/@daatrade"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                                    </svg></a>
                                <a href="https://www.linkedin.com/company/daatrade/"><i class="fa fa-linkedin"></i></a>
                                <a href="https://youtube.com/@Daatrade?si=cSukgAziHrzWpSJG"><i class="fa fa-youtube"></i></a>
                            </div>
                            <!--
                            <div class="header__top__right__language">
                                <img src="{{ asset('assets/img/language.png') }}" alt="Daatrade">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
-->
                            <div class="header__top__right__auth">
                                <a href="{{ route('login') }}" class="float-left"><i class="fa fa-user"></i>
                                    Login</a> &nbsp; &nbsp;
                                <a href="{{ route('register') }}" class="float-right"><i class="fa fa-user"></i>Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="{{ URL('/') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="Daatrade"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="javascript:void(0);" onclick="scrollToBuyerSection()">Buyer Assistance</a>
                            </li>
                            <li><a href="javascript:void(0);" onclick="scrollToSupplierSection()">Supplier
                                    Registration</a></li>
                            {{-- <li><a href="#">For Buyers</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="#">Search Categories</a></li>
                                    <li><a href="#">Search Products</a></li>
                                    <li><a href="#">Search Supplier</a></li>
                                    <li><a href="#">New Buyer Guide</a></li>
                                    <li><a href="#">New Inquiry</a></li>
                                    <li><a href="#">Submit a Complain</a></li>
                                    <li><a href="#">Buyer Support</a></li>
                                    <li><a href="#">My Orders</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul>
                            </li>
                            <li><a href="#">For Suppliers</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="#">New Supplier Guide</a></li>
                                    <li><a href="#">Become a Verified Supplier</a></li>
                                    <li><a href="#">Supplier Dashboard</a></li>
                                    <li><a href="#">Search RFQ</a></li>
                                    <li><a href="#">Advertise with us</a></li>
                                    <li><a href="#">Supplier Support</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul>
                            </li> --}}
                            <li><a href="{{ route('blogs') }}">Blogs</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>

                            <!--                            <li><a href="{{ route('privacy') }}">Privacy</a></li>-->

                        </ul>
                    </nav>
                </div>
                {{-- <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    {{-- <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('layouts.categories')
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form method="post" action="{{ route('searchproduct') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" id="search" name="search" required placeholder="What do you need?">
    <button type="submit" class="site-btn">SEARCH</button>
    </form>
    </div>
    <div class="hero__search__phone">
        <div class="hero__search__phone__icon">
            <i class="fa fa-phone"></i>
        </div>
        <div class="hero__search__phone__text">
            <h5>+92 341 1115888</h5>
            <span>support 24/7 time</span>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section> --}}

    @unless (Request::is('blogs') || Request::is('blogs-details/*'))
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                @unless (Request::is('login') || Request::is('register'))
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        @include('layouts.categories')
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search mb-4">
                        <div class="hero__search__form">
                            <form method="post" action="{{ route('searchproduct') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="text" id="search" name="search" required placeholder="What do you need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+92 341 1115888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>

                </div>
                @endunless
            </div>
        </div>
    </section>
    @endunless
    <!-- Hero Section End -->
    @yield('content')
    <!-- Footer Section Begin -->


    <div class="modal" id="subscriptionmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 50px;">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Subscribe Now</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('save-subscribe') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @if ($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @if ($errors->has('email'))
                                <div class="error text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                                @if ($errors->has('country'))
                                <div class="error text-danger">{{ $errors->first('country') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="site-btn">
                                    {{ __('Subscribe') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="Daatrade"></a>
                        </div>
                        <ul>
                            <li>Address: Office # 17-C, OPF. Lahore. Pakistan.</li>
                            <li>Phone: +92 341 1115888</li>
                            <li>Email: info@daatrade.com</li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>DAATRADE SERVICES</h6>
                        <ul>
                            <li><a href="{{ route('membershipplan') }}">Membership Plans</a></li>
                            <li><a href="{{ route('about') }}">Why Daatrade?</a></li>
                            <li><a href="{{ route('contact') }}">Advertise with us</a></li>
                            <li><a href="{{ route('benefitpage','benefitbuyer') }}">Buyer Benefits</a></li>
                            <li><a href="{{ route('benefitpage','benefitsupplier') }}">Supplier Benefits</a></li>
                            <li><a href="{{ route('howtoregister','registerbuyer') }}">How to Register as Buyer</a></li>
                            <li><a href="{{ route('howtoregister','registersupplier') }}">How to Register as Supplier</a></li>
                            <li><a href="{{ route('inquirybuyer') }}">How to Post your Buying Inquiry</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <div style="margin-bottom: 20px;">
                            <button onclick="showsubscriptionmodal()" class="site-btn">Subscribe</button>
                        </div>

                    </div>
                </div>
                <div class="col-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <div class="image-gallery">
                            <img src="{{ asset('assets/img/cropped-TDAP_final-logo2-150x150.png') }}" alt="Image 1">
                            <img src="{{ asset('assets/img/invest_pakistan.png') }}" alt="Image 2">
                            <img src="{{ asset('assets/img/moc-logo-75-white.png') }}" alt="Image 3">
                            <img src="{{ asset('assets/img/sifc-logo-header.png') }}" alt="Image 4">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | Developed with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://daatrade.com/" target="_blank">Daatrade</a>
                            </p>
                        </div>
                        {{-- <div class="footer__copyright__payment"><img src="{{ asset('assets/img/payment-item.png') }}"
                        alt="Daatrade">
                    </div> --}}
                </div>
            </div>
        </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Js Plugins -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    {{-- @unless (Request::is('register'))
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    @endunless --}}
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        function showsubscriptionmodal() {
            $('#subscriptionmodal').modal('show');
        }

        function scrollToSupplierSection() {
            // Modify the URL to include "/contact#supplier-section"
            window.location.href = '/contact#supplier-section';

            // Scroll to the supplier section (optional, if you want to scroll after changing the URL)
            var supplierSection = document.getElementById('supplier-section');
            if (supplierSection) {
                supplierSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        function scrollToBuyerSection() {
            // Modify the URL to include "/contact#supplier-section"
            window.location.href = '/contact#buyer-section';

            // Scroll to the supplier section (optional, if you want to scroll after changing the URL)
            var supplierSection = document.getElementById('buyer-section');
            if (supplierSection) {
                supplierSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    </script>

</body>

</html>