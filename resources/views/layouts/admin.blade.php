<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta name="google-site-verification" content="axQgz-PIIO4M7EE_054IAJINbqKpm2q8UqJ2nomWo9Q"/>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7SD1W56C8V"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-7SD1W56C8V');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/icon.jpg') }}" />
    <title>Daatrade Dashboard | Empowering B2B Connections</title>
    <!-- Custom CSS -->
    <link href="{{ asset('assets/admin/libs/flot/css/float-chart.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/admin/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        .circle-image {
            width: 50px;
            /* Set the desired width and height of the circle */
            height: 50px;
            /* Make the image fill the circle container */
        }
    </style>
    @livewireStyles
</head>

<body>
    @php
    use App\Models\User;
    $user=User::where('id',Auth::user()->id)->first();
    $role='';
    if($user)
    {
    $role=$user->role;
    }
    @endphp
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('assets/admin/images/logo-icon.png') }}" alt="homepage" class="light-logo" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            {{-- <img src="{{ asset('assets/admin/images/logo-text.png') }}" alt="homepage"
                            class="light-logo" /> --}}
                            <h3 class="mt-2">Daatrade</h3>
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="{{ asset('assets/admin/images/logo-text.png') }}" alt="homepage" class="light-logo" /> -->

                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Event today</h5>
                                                        <span class="mail-desc">Just a reminder that event</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5>
                                                        <span class="mail-desc">You can customize this template</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Pavan kumar</h5>
                                                        <span class="mail-desc">Just see the my admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Luanch Admin</h5>
                                                        <span class="mail-desc">Just see the my new admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img @if(isset($user->membership->plan_type))
                                @if ($user->membership->plan_type == '0')
                                src="{{ asset('assets/img/Badge-01.png') }}"
                                @elseif ($user->membership->plan_type == '1')
                                src="{{ asset('assets/img/Badge-02.png') }}"
                                @elseif ($user->membership->plan_type == '2')
                                src="{{ asset('assets/img/Badge-03.png') }}"
                                @elseif ($user->membership->plan_type == 'free')
                                src="{{ asset('assets/admin/images/users/1.jpg') }}"
                                @endif
                                @else
                                src="{{ asset('assets/admin/images/users/1.jpg') }}"
                                @endif
                                alt="user" class="rounded-circle" width="31" ></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                {{--<a class="dropdown-item" href="/membershipplan" target="_blank"><i class="ti-user m-r-5 m-l-5"></i>Upgrade Membership Plans</a>--}}
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('products') }}" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Products</span></a></li>
                        @if (Auth::check() && $role=='admin')
                        {{--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('membershipmanagement') }}" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Membership
                                    Management</span></a></li>--}}
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('vendormanagement') }}" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Vendor
                                    Management</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('buyermanagement') }}" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Buyer
                                    Management</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('subscribermanagement') }}" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Subscriber
                                    Management</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Page Management </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('editpage','about') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> About
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('editpage','benefitsupplier') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Supplier Benefits
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('editpage','benefitbuyer') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Buyer Benefits
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('editpage','registerbuyer') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">How to Register as Buyer
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('editpage','registersupplier') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">How to Register as Supplier
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('editpage','inquirybuyer') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">How to Post your Buying Inquiry
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('editpage','privacy') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Privacy Ploicy
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('editpage','faq') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> FAQ
                                        </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('newsletter') }}" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">News
                                    Letter</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Categories </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('categories') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Category
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('subcategories') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Sub Categories
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('subchildcategories') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Sub Child Categories
                                        </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Blogs </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('blogs.settings') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Settings
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('blogs.author') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Authors
                                        </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('blogs.categories') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Categories
                                        </span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Posts </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        <li class="sidebar-item"><a href="{{ route('posts.all.post') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> All
                                                    Posts
                                                </span></a></li>
                                        <li class="sidebar-item"><a href="{{ route('posts.add.post') }}" class="sidebar-link">
                                                <i class="mdi mdi-note-outline"></i>
                                                <span class="hide-menu"> Add Post </span>
                                            </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if (Auth::check() && ($role=='admin' || $role=='supplier'))
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('inquiries') }}" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Inquiries</span></a>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            @yield('content')
            <footer class="footer text-center">
                All Rights Reserved by Daatrade. Designed and Developed by <a href="#">Saremcotech</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/admin/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('assets/admin/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('assets/admin/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('assets/admin/dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="{{ asset('assets/admin/libs/flot/excanvas.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/flot/jquery.flot.crosshair.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/pages/chart/chart-page-init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tags-input').tagsinput({
                tagClass: 'badge badge-primary' // Apply Bootstrap class to each tag
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script>
        // Initialize Select2 on the dropdown
        $(document).ready(function() {
            $('#unit').select2();
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $(".upload__img-wrap").sortable({
                update: function(event, ui) {
                    getIdsOfImages();
                } //end update
            });
        });

        function getIdsOfImages() {
            var imagesList = [];
            $('.upload__img-box').each(function(index) {
                var img = $(this).find('div');

                var bg = img.css('background-image');
                bg = bg.replace('url(', '').replace(')', '').replace(/\"/gi, "");
                imagesList.push({
                    id: index,
                    src: bg,
                    isDragged: $(this).hasClass('ui-sortable-helper')
                });
            });
            $("#imageList").val(JSON.stringify(imagesList));
        }
    </script>
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <script>
        // Listen for the 'showToastr' event
        window.addEventListener('showToaster', function(event) {
            // Remove any existing Toastr notifications
            toastr.remove();

            // Check the type of notification and display accordingly
            if (event.detail.type === 'info') {
                toastr.info(event.detail.message);
            } else if (event.detail.type === 'success') {
                toastr.success(event.detail.message);
            } else if (event.detail.type === 'error') {
                toastr.error(event.detail.message);
            } else if (event.detail.type === 'warning') {
                toastr.warning(event.detail.message);
            } else {
                // If the type is not recognized, you can handle it as needed
                console.error('Unknown toastr type:', event.detail.type);
            }
        });
    </script>
    <script>
        $(window).on('hidden.bs.modal', function() {
            Livewire.emit('resetForms');
        });

        window.addEventListener('showEditAuthorModel', function(event) {
            $('#edit_author').modal('show');
        });
        window.addEventListener('hide_author_edit_modal', function(event) {
            $('#edit_author').modal('hide');
        });

        window.addEventListener('deleteAuthor', function(event) {
            swal.fire({
                title: event.detail.title,
                imageWidth: 48,
                imageHeight: 48,
                html: event.detail.html,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, delete',
                cancelButtonColor: '#d33', // Note the quotes around color values
                confirmButtonColor: '#3085d6', // Note the quotes around color values
                width: 300,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    Livewire.emit('deleteAuthorAction', event.detail.id);
                }
            });
        });

        window.addEventListener('hideCategoryModal', function(event) {
            $('#add_category').modal('hide');
        });
        window.addEventListener('showEditCategoryModal', function(event) {
            $('#add_category').modal('show');
        });
        window.addEventListener('hideSubCategoryModal', function(event) {
            $('#add_subcategory').modal('hide');
        });

        window.addEventListener('showEditSubCategoryModal', function(event) {
            $('#add_subcategory').modal('show');
        });
        window.addEventListener('hideSubCategoryModal', function(event) {
            $('#add_subcategory').modal('hide');
        });
        $('#add_category,#add_subcategory').on('hidden.bs.modal', function(e) {
            Livewire.emit('resetModalForms');
        });
    </script>

</body>

</html>