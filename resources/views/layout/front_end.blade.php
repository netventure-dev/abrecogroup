<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EUREKA SERVICES</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Exo+2:wght@700&family=Oxanium:wght@600;800&family=Oxygen:wght@400;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;700&family=Oxanium:wght@600;800&family=Oxygen:wght@400;700&display=swap"
        rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    {{-- @dd($services); --}}
    <!-- HEADER -->
    <header class="fixed-top header_area">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/front/images/logo-new.webp') }}"
                    alt="EUREKA SERVICES" height="50px" width="auto" />EUREKA SERVICES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            SERVICES
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($services as $service)
                            <a class="dropdown-item" href="{{route('service.index',$service->slug)}}">{{$service->name}}</a>                                
                            @endforeach
                          
                            <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div> -->

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">REQUEST RATES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="contact-button">CONTAC US</a>
                    </li>

                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
            </div>
        </nav>

    </header>

    @yield('content')

    <footer class="footer section text-left">
        <div class="row">
            <div class="col-md-3">
                <h3>USEFUL LINKS</h3>
                <ul class="text-left">
                    <li><a href="#">Swimming pool Maintenance</a></li>
                    <li><a href="#">AC Maintenance & Services</a></li>
                    <li><a href="#">Plumbing & Sanitary Contracting</a></li>
                    <li><a href="#">Electrical Maintenance Works</a></li>
                    <li><a href="#">Carpentry & Flooring Contracting</a></li>
                </ul>

            </div>
            <div class="col-md-3 contact-details">
                <h3>GET IN TOUCH</h3>
                <!--Form-->
                <p class="text-left"><i class="fa fa-map-marker" aria-hidden="true"></i>
                    Eureka Technical Services LLC<br>
                    Office no: 1102, Shobha Ivory 2<br>
                    Business Bay, Dubai, UAE</p>
                <p class="text-left"><i class="fa fa-mobile" aria-hidden="true"></i>
                    <a href="tel:+971522726486">+971 52 272 6486</a>
                </p>

                <div class="Social-media">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <h3>REQUEST A QUOTE</h3>
                <form class="form-inline">
                    <label class="sr-only" for="inlineFormInputName2">Name</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2"
                        placeholder="Name">

                    <label class="sr-only" for="inlineFormInputPhone">Phone</label>
                    <input type="number" class="form-control mb-2 mr-sm-2" id="inlineFormInputPhone"
                        placeholder="Phone">

                    <!-- <label for="inputService">Select Services</label> -->
                    <select id="inputService" class="form-control mb-2 mr-sm-2">
                        <option selected>Select Services</option>
                        <option value="1">Swimming Pool Maintenance</option>
                        <option value="2">AC Maintenance & Services</option>
                        <option value="3">Plumbing & Sanitary Contracting</option>
                        <option value="4">Carpentry & Flooring Contracting</option>
                        <option value="5">Wallpaper Fixing</option>
                        <option value="6">Electrical Maintenance Works</option>
                        <option value="7">False Ceiling & Light Partitions</option>
                        <option value="8">Floor & Tyling Works </option>
                        <option value="9">Other Handyman Services</option>
                    </select>
                    <label class="sr-only" for="inlineFormInputLocation">Location</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputLocation"
                        placeholder="Location">

                    <button type="submit" class="btn btn-danger mb-2">Submit</button>
                </form>
            </div>
            <!--End Form-->
        </div>
        <div class="copy-right text-center mt-4">
            <p class="text-center"> © 2022 Eureka Services. All rights reserved. Digitally Empowered by <a
                    href="https://www.netventure.in/">NetVenture Digital Solutions Pvt. Ltd.</a> </p>
        </div>
        <!-- <div class="fixed-bottom text-center">No:1 Maintenance and Handyman Services Company in Dubai</div> -->

    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('assets/front/js/javascript.js') }}"></script>
    @yield('script')
</body>

</html>
