<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {!! SEO::generate() !!}
    <link
        href="https://fonts.googleapis.com/css2?family=Exo+2:wght@700&family=Oxanium:wght@600;800&family=Oxygen:wght@400;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;700&family=Oxanium:wght@600;800&family=Oxygen:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="{{ asset('assets/front/images/logo-new.webp') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/css.css') }}" rel="stylesheet">
    {!! @$gtm->head !!}


    @yield('css')



</head>

<body>

    {!! @$gtm->body !!}


    {{-- @dd($services); --}}
    <!-- HEADER -->
    <header class="fixed-top header_area">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{ route('home') }}"><img
                    src="{{ asset('assets/front/images/logo-new.webp') }}" alt="INTELLECT WORKS" height="80px"
                    width="auto" />INTELLECT WORKS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">HOME <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            SERVICES
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($services as $service)
                                <a class="dropdown-item"
                                    href="{{ route('service.index', $service->slug) }}">{{ $service->name }}</a>
                            @endforeach

                            <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div> -->

                    </li>
                    {{-- 
                     --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('request-a-quote.index') }}">REQUEST RATES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feedback.index') }}">FEEDBACK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact-us.index') }}" id="contact-button">CONTACT
                            US</a>
                    </li>

                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
            </div>
        </nav>

    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer section text-left">
        <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 quick-links">
                <h3>USEFUL LINKS</h3>
                <ul class="text-left">
                    @foreach ($services->take(5) as $service)
                        <li><a href="{{ route('service.index', $service->slug) }}">{{ $service->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @php
                $general = \DB::table('generals')->first();
            @endphp
            <div class="col-lg-3 col-md-6 contact-details">
                <h3>GET IN TOUCH</h3>
                <ul>
                    <li>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        {!! @$general->address !!}
                    </li>
                    <li>
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                        <a href="tel:{{ @$general->mobile }}">{{ @$general->mobile }}</a>
                    </li>
                </ul>

                <div class="Social-media">
                    <a target="_blank" href="{{ @$general->facebook }}"><i class="fa fa-facebook"></i></a>
                    <a target="_blank" href="{{ @$general->instagram }}"><i class="fa fa-instagram"></i></a>
                    <a target="_blank" href="{{ @$general->twitter }}"><i class="fa fa-twitter"></i></a>
                    <a target="_blank" href="{{ @$general->linkdln }}"><i class="fa fa-linkedin"></i></a>
                    <a target="_blank" href="{{ @$general->youtube }}"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
            @php
                $services = \DB::table('services')->get();
            @endphp
            <div class="col-lg-5 col-md-12 request-form" id="request_a_quote">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        @if(is_array(session('success')))
                            <ul>
                                @foreach (session('success') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ session('success') }}
                        @endif
                    </div>
                @endif
                <h3>REQUEST A QUOTE</h3>
                <form action="{{ route('request-a-quote.store') }}" method="post" role="form"
                        class="myform php-email-form" data-aos="fade-up" data-aos-delay="100">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" required class="form-control" id="name" name="name" value="{{ @old('name') }}" placeholder="Name *">
                            </div>
                            <div class="col">
                                <input type="tel" required class="form-control" id="phone" name="phone"value="{{ @old('phone') }}" placeholder="Phone *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" required id="email" name="email" value="{{ @old('email') }}" placeholder="Email *">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" required id="location" name="location" value="{{ @old('location') }}" placeholder="Location *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select id="service" required class="form-control" name="service">
                                    <option selected value="">Select Services *</option>
                                    @foreach ($services as $service)
                                        <option value="{{ @$service->uuid }}">{{ @$service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          
                        </div>
                        <div class="row">
                            <div class="col">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                        </div>
                        <div class="btn-wrap mt-3">
                            <button type="submit" class="">Submit</button>
                        </div>
                    </form>

            </div>
            <!--End Form-->
        </div>
        <div class="copy-right text-center mt-5">
            <p class="text-center"> © {{ date('Y') }} INTELLECT WORKS. All rights reserved. Digitally Empowered by
                <a href="https://www.netventure.in/" target="_blank">NetVenture</a>
            </p>
        </div>
        <!-- <div class="fixed-bottom text-center">No:1 Maintenance and Handyman Services Company in Dubai</div> -->

            </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('assets/front/js/javascript.js') }}"></script>
    @yield('script')
</body>

</html>
