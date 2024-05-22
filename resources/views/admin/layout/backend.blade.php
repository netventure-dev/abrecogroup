<!doctype html>
<html lang="en">

<head>
    @php
        $general = App\Models\General::first();
        $logo = @$general->logo;
        $fav = @$general->favicon;
    @endphp
    <meta charset="utf-8" />
    <title> Abreco Groups </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/' . @$fav) }}">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/assets/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
    @notify_css

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    @yield('css')
</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box" style="background-color:#060332 !important ">
                        <a class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo_small.png') }}" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo.jpg') }}" alt="" height="50">
                            </span>
                        </a>

                        <a class="logo logo-light">
                            <span class="logo-sm">
                                {{-- <img src="{{asset('assets/images/logo_small.png')}}" alt="" height="30"> --}}
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo1.png') }}" alt="" height="50">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    {{--  <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bx bx-search-alt"></span>
                        </div>
                    </form>  --}}

                    <div class="dropdown dropdown-mega d-none d-lg-block ms-2">
                        {{--  <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="false" aria-expanded="false">
                            <span key="t-megamenu">Mega Menu</span>
                            <i class="mdi mdi-chevron-down"></i>
                        </button>  --}}
                        <div class="dropdown-menu dropdown-megamenu">
                            <div class="row">
                                <div class="col-sm-8">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="font-size-14 mt-0" key="t-ui-components">UI Components</h5>
                                            <ul class="list-unstyled megamenu-list">
                                                <li>
                                                    <a href="javascript:void(0);" key="t-lightbox">Lightbox</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-range-slider">Range Slider</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-sweet-alert">Sweet Alert</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-rating">Rating</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-forms">Forms</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-tables">Tables</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-charts">Charts</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-md-4">
                                            <h5 class="font-size-14 mt-0" key="t-applications">Applications</h5>
                                            <ul class="list-unstyled megamenu-list">
                                                <li>
                                                    <a href="javascript:void(0);" key="t-ecommerce">Ecommerce</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-calendar">Calendar</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-email">Email</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-projects">Projects</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-tasks">Tasks</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-contacts">Contacts</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-md-4">
                                            <h5 class="font-size-14 mt-0" key="t-extra-pages">Extra Pages</h5>
                                            <ul class="list-unstyled megamenu-list">
                                                <li>
                                                    <a href="javascript:void(0);" key="t-light-sidebar">Light
                                                        Sidebar</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-compact-sidebar">Compact
                                                        Sidebar</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-horizontal">Horizontal
                                                        layout</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-maintenance">Maintenance</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-coming-soon">Coming Soon</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-timeline">Timeline</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-faqs">FAQs</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5 class="font-size-14 mt-0" key="t-ui-components">UI Components</h5>
                                            <ul class="list-unstyled megamenu-list">
                                                <li>
                                                    <a href="javascript:void(0);" key="t-lightbox">Lightbox</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-range-slider">Range
                                                        Slider</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-sweet-alert">Sweet Alert</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-rating">Rating</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-forms">Forms</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-tables">Tables</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" key="t-charts">Charts</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-sm-5">
                                            <div>
                                                <img src="{{ asset('assets/images/megamenu-img.png') }}"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        {{--  <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img id="header-lang-img" src="{{ asset('assets/images/flags/us.jpg')}}" alt="Header Language"
                                height="16">
                        </button>  --}}
                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                                <img src="{{ asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-1"
                                    height="12"> <span class="align-middle">English</span>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                <img src="{{ asset('assets/images/flags/spain.jpg') }}" alt="user-image"
                                    class="me-1" height="12"> <span class="align-middle">Spanish</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                <img src="{{ asset('assets/images/flags/germany.jpg') }}" alt="user-image"
                                    class="me-1" height="12"> <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                <img src="{{ asset('assets/images/flags/italy.jpg') }}" alt="user-image"
                                    class="me-1" height="12"> <span class="align-middle">Italian</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                <img src="{{ asset('assets/images/flags/russia.jpg') }}" alt="user-image"
                                    class="me-1" height="12"> <span class="align-middle">Russian</span>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        {{--  <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-customize"></i>
                        </button>  --}}
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <div class="px-lg-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/github.png') }}" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/bitbucket.png') }}"
                                                alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/dribbble.png') }}"
                                                alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/dropbox.png') }}"
                                                alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/mail_chimp.png') }}"
                                                alt="mail_chimp">
                                            <span>Mail Chimp</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{ asset('assets/images/brands/slack.png') }}" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        {{--  <button type="button" class="btn header-item noti-icon waves-effect"
                            data-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>  --}}
                    </div>

                    <div class="dropdown d-inline-block">
                        {{--  <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-bell bx-tada"></i>
                            <span class="badge bg-danger rounded-pill">3</span>
                        </button>  --}}
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small" key="t-view-all"> View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <a href="" class="text-reset notification-item">
                                    <div class="media">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                <i class="bx bx-cart"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1" key="t-your-order">Your order is placed</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-grammer">If several languages coalesce the
                                                    grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                        key="t-min-ago">3 min ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="text-reset notification-item">
                                    <div class="media">
                                        <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1">James Lemire</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-simplified">It will seem like simplified
                                                    English.</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                        key="t-hours-ago">1 hours ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="text-reset notification-item">
                                    <div class="media">
                                        <div class="avatar-xs me-3">
                                            <span class="avatar-title bg-success rounded-circle font-size-16">
                                                <i class="bx bx-badge-check"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1" key="t-shipped">Your item is shipped</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-grammer">If several languages coalesce the
                                                    grammar</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                        key="t-min-ago">3 min ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="" class="text-reset notification-item">
                                    <div class="media">
                                        <img src="{{ asset('assets/images/users/avatar-4.jpg') }}"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1" key="t-occidental">As a skeptical Cambridge friend
                                                    of mine occidental.</p>
                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span
                                                        key="t-hours-ago">1 hours ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 border-top d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View
                                        More..</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">Developer</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            {{--  <a class="dropdown-item" href="#"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i> <span
                                    key="t-profile">Profile</span></a>  --}}



                            <div class="dropdown-divider"></div>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item " href="{{ route('admin.settings.show') }}"><i
                                    class="fa fa-cog"></i> <span key="t-logout">Settings</span></a>

                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                    class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                    key="t-logout">Logout</span></a>

                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        {{--  <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog bx-spin"></i>
                        </button>  --}}
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu" style="background-color:#060332 !important">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>

                        <li>
                            <a href="{{ route('admin.home') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Dashboards</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.home-slider.index') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Home Slider</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sections.index') }}" class="waves-effect">
                                <i class="bx bxs-layer"></i>
                                <span key="t-file-manager">Sections</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Case Study</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.case-study-settings.create')}}" key="t-products">Settings</a></li>
                                <li><a href="{{route('admin.casestudies.index')}}" key="t-product-detail">List</a></li>
                                <li><a href="{{route('admin.mission-vision.index')}}" key="t-product-detail">Mission And Vision</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <a href="{{route('admin.casestudies.index')}}" class="waves-effect">
                                <i class="bx bx-book-open"></i>
                                <span key="t-file-manager">Case Study</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.case-study-settings.create')}}" class="waves-effect">
                                <i class="bx bx-book-open"></i>
                                <span key="t-file-manager">Case Study Settings</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="{{route('admin.services.index')}}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.sub-services.index')}}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Sub Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.inner-services.index')}}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Inner Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.industries.index')}}" class="waves-effect">
                                <i class="bx bxs-buildings"></i>
                                <span key="t-file-manager">Industry</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="{{route('admin.demo_industries.index')}}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Demo Industry</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="{{route('admin.our-projects.index')}}" class="waves-effect">
                                <i class="bx bx-detail"></i>
                                <span key="t-file-manager">Our Projects</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Why Choose Us</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.why-choose-us.settings.create')}}" key="t-products">Settings</a></li>
                                <li><a href="{{route('admin.why-choose-us.list.index')}}" key="t-product-detail">List</a></li>
                            </ul>
                        </li> --}}
                        <!-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Additional Pages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.additional-pages.create') }}" key="t-products">Add</a></li>
                                <li><a href="{{ route('admin.additional-pages.index') }}" key="t-product-detail">View</a></li>
                            </ul>
                        </li> -->
                        <li class="menu-title" key="t-apps">Pages</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Home Page</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{ route('admin.multi-faceted.create') }}" class="waves-effect">
                                        
                                        <span key="t-file-manager">Multi faceted</span>
                                      </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.inclusive.create') }}" class="waves-effect">
                                        
                                        <span key="t-file-manager">Inclusive Support</span>
                                      </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.dream.create') }}" class="waves-effect">
                                        
                                        <span key="t-file-manager">Dream Destination</span>
                                      </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.news.index') }}" class="waves-effect">
                                        
                                        <span key="t-file-manager">News</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.office-location.index') }}" class="waves-effect">
                                        <span key="t-file-manager">Office Location</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.logo.index') }}" class="waves-effect">
                                        <span key="t-file-manager">Logo</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.testimonials.index') }}" class="waves-effect">
                                        <span key="t-file-manager">Employee testimonial</span>
                                    </a>
                                </li>
                                {{-- <li><a href="{{ route('admin.mission-vision.index') }}"
                                        key="t-product-detail">Mission And Vision</a></li>  --}}
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Our Business</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.business-settings.create') }}"
                                        key="t-products">Settings</a></li>
                                        <li><a href="{{ route('admin.business-list.index') }}"
                                            key="t-product-detail">List</a></li>
                                {{-- <li><a href="{{ route('admin.mission-vision.index') }}"
                                        key="t-product-detail">Mission And Vision</a></li>  --}}
                            </ul>
                        </li>
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Milestone</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.milestone.settings.create')}}" key="t-products">Settings</a></li>
                                <li><a href="{{route('admin.about-us.list.index')}}" key="t-product-detail">List</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <a href="{{route('admin.contact-us.create')}}" class="waves-effect">
                                <i class="bx bx-user-voice"></i>
                                <span key="t-file-manager">Contact Us</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="#" class="waves-effect">
                                <i class="bx bxs-message-dots"></i>
                                <span key="t-file-manager">Feedback</span>
                            </a>
                        </li> --}}

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Milestone</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.milestone.settings.create') }}"
                                        key="t-products">Settings</a></li>
                                <li><a href="{{ route('admin.milestone.list.index') }}"
                                        key="t-product-detail">List</a></li>
                            </ul>
                        </li>
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Blogs</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.blog-settings.create') }}" key="t-products">Settings</a></li>
                                <li><a href="{{ route('admin.blog-list.index') }}" key="t-product-detail">List</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Request Rates</span>    
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.request.settings.create')}}" key="t-products">Settings</a></li>
                                <li><a href="{{route('admin.request.list.index')}}" key="t-product-detail">Content</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Policy</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="{{ route('admin.policy.index') }}" key="t-product-detail">Privacy
                                        Policy</a></li>
                            </ul>
                        </li> --}}

                        {{-- <li class="menu-title" key="t-apps">Reports</li>
                        <li>
                            <a href="{{ route('admin.requestenquiry.index') }}" class="waves-effect">
                                <i class="bx bx-notepad"></i>
                                <span key="t-file-manager">Service Enquiries</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.careerenquiry.index') }}" class="waves-effect">
                                <i class="bx bxs-food-menu"></i>
                                <span key="t-file-manager">Career Enquiries</span>
                            </a>
                        </li> --}}

                        {{--  <li>
                            <a href="{{route('admin.feedbackenquiry.index')}}" class="waves-effect">
                                <i class="bx bx-message-rounded-dots"></i>
                                <span key="t-file-manager">Feedback</span>
                            </a>
                        </li>  --}}

                      
                      
                       

                      
                        <li>
                            <a href="{{ route('admin.contact-us.create') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Contact</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.enquiries.index') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Contact Request</span>
                            </a>
                        </li>
                        <li class="menu-title" key="t-apps">Settings</li>

                        <li>
                            <a href="{{ route('admin.general.create') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">General</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('admin.editSitemap') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Sitemap</span>
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Career Opening</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.career-opening-settings.create') }}"
                                        key="t-products">Settings</a></li>
                                <li><a href="{{ route('admin.career-opening.index') }}"
                                        key="t-product-detail">List</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <a href="{{route('admin.service-care.index')}}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Services Care</span>
                            </a>
                        </li> --}}
                        
                        <!-- <li>
                            <a href="{{ route('admin.schema.index') }}" class="waves-effect">
                                <i class="bx bx-receipt"></i>
                                <span key="t-file-manager">Schema</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="{{ route('admin.seo.index') }}" class="waves-effect">
                                <i class="bx bx-search"></i>
                                <span key="t-file-manager">SEO</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('admin.roles.index') }}" class=" waves-effect">
                                <i class="bx bxs-user-detail"></i>
                                <span>{{ __('Roles') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.permissions.index') }}" class=" waves-effect">
                                <i class="bx bxs-user-detail"></i>
                                <span>{{ __('Permissions') }}</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            {{-- @include('admin.layouts.footer') --}}
        </div>

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">

                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                {{-- <div class="p-4">
                    <div class="mb-2">
                        <img src="{{ asset('assets/images/layouts/layout-1.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="{{ asset('assets/images/layouts/layout-2.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch"
                            data-bsStyle="{{ asset('assets/css/bootstrap-dark.min.css')}}"
                            data-appStyle="{{ asset('assets/css/app-dark.min.css')}}">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="{{ asset('assets/images/layouts/layout-3.jpg')}}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch"
                            data-appStyle="{{ asset('assets/css/app-rtl.min.css')}}">
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>


                </div> --}}

            </div> <!-- end slimscroll-menu-->
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        {{--  <script>document.write(new Date().getFullYear())</script> © Skote.  --}}
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            © <?php echo date('Y'); ?> Abreco Groups. All Rights Reserved. Digitally Empowered by <a
                                href="https://www.netventure.in/"> NetVenture Digital Solutions Pvt. Ltd. </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

        <!-- apexcharts -->
        {{-- <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

        <!-- dashboard init -->
        {{-- <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script> --}}

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#careerreportdatatable-table').on('init.dt', function() {
                    $('.no-sort').removeClass('sorting sorting_asc sorting_desc');
                });
                $('#contactusreportdatatable-table').on('init.dt', function() {
                    $('.no-sort').removeClass('sorting sorting_asc sorting_desc');
                });
                $('#requestquotereportdatatable-table').on('init.dt', function() {
                    $('.no-sort').removeClass('sorting sorting_asc sorting_desc');
                });

            });
        </script>
        @notify_js
        @notify_render
        @yield('script')

</body>

</html>
