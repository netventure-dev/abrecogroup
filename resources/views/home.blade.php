@extends('layout.front_end')
@section('content')
    <section class="slider-section">
        <div class="slides owl-theme owl-carousel">
            @if ($home_sliders->count() > 0)
                @foreach ($home_sliders as $home_slider)
                    <div class="shadow-sm border-radius-new">
                        <img src="{{ asset('storage/' . @$home_slider->image) }}" class="img-fluid d-block"
                            alt="EUREKA SERVICES">
                        <div class="carousel-caption d-md-block">
                            <h1>{{ @$home_slider->title }}</h1>
                            <p>{!! @$home_slider->description !!}</p>
                            <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <section class="eureka-technical-services section">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 text-center">
                    {!! @$technical_service->title !!}
                    {!! @$technical_service->description !!}
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-md-8">
                    @if ($technical_services_list->count() > 0)
                        @foreach ($technical_services_list as $technical_service_list)
                            <div class="icon-box-icon-list">
                                <div class="icon-box-icons">
                                    <i class="fa fa-ticket"></i>
                                </div>
                                <div class="icon-box-contents">
                                    <h3>{{ @$technical_service_list->title }} </h3>
                                    {!! @$technical_service_list->description !!}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('storage/'.@$technical_service->image) }}" class="img-fluid" alt="EUREKA SERVICES">
                </div>
            </div>
        </div>
    </section>
    <section class="our-services section">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 text-center">
                    <h2><span>OUR</span> SERVICES</h2>
                </div>
            </div>
            <!-- Row1-->
            <div class="row align-items-start">
              @if ($serivices->count() > 0)
                @foreach ($serivices as $technical_service_list)
                    <div class="col-md-4 text-center">
                        <div class="box">
                            <div class="box-icon">
                                <div class="image"><img src="{{ asset('storage/'.@$) }}" class="img-circle"
                                        alt="EUREKA SERVICES" height="auto" width="80%"></div>
                                <div class="info">
                                    <h3 class="title">SWIMMING POOL MAINTENANCE</h3>
                                    <p>
                                        We provide a wide selection of first-rate swimming pool cleaning and
                                        maintenance services for both residential and commercial pools around the U.A.E.
                                    </p>
                                    <div class="more">
                                        <a href="#" title="Title Link">
                                            ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="space"></div>
                        </div>
                    </div>
                  @endforeach
                @endif
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-icon">
                            <div class="image"><img src="{{ asset('assets/front/images/ia4.webp') }}" class="img-circle"
                                    alt="EUREKA SERVICES" height="auto" width="80%"></div>
                            <div class="info">
                                <h3 class="title">AC MAINTENANCE <br>& SERVICES</h3>
                                <p>
                                    The best HVAC maintenance in Dubai, including split and central air
                                    conditioning systems for all air conditioning requirements.
                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-icon">
                            <div class="image"><img src="{{ asset('assets/front/images/ia5.webp') }}" class="img-circle"
                                    alt="EUREKA SERVICES" height="auto" width="80%"></div>
                            <div class="info">
                                <h3 class="title">PLUMBING & SANITARY CONTRACTING</h3>
                                <p>
                                    Why is my drain becoming blocked so frequently? There are many variables, but you should
                                    prioritize
                                    hiring a plumber
                                    to unclog your drains.
                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
            </div>
            <!-- End Row1-->

            <!-- Row2-->
            <div class="row align-items-start">
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-icon">
                            <div class="image"><img src="{{ asset('assets/front/images/ia3.webp') }}" class="img-circle"
                                    alt="EUREKA SERVICES" height="auto" width="80%"></div>
                            <div class="info">
                                <h3 class="title">ELECTRICAL MAINTENANCE <br>WORKS</h3>
                                <p>
                                    Eureka Technical Services skilled, experienced specialists will perform electrical
                                    repairs to the
                                    highest standards, minimizing danger.
                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-icon">
                            <div class="image"><img src="{{ asset('assets/front/images/ia6.webp') }}" class="img-circle"
                                    alt="EUREKA SERVICES" height="auto" width="80%"></div>
                            <div class="info">
                                <h3 class="title">CARPENTRY & FLOORING<br>CONTRACTING</h3>
                                <p>
                                    Carpentry services of the highest caliber are offered by Eureka Technical Services for a
                                    variety of
                                    domestic and commercial projects.

                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-icon">
                            <div class="image"><img src="{{ asset('assets/front/images/ia9.webp') }}" class="img-circle"
                                    alt="EUREKA SERVICES" height="auto" width="80%"></div>
                            <div class="info">
                                <h3 class="title">FALSE CEILING & LIGHT PARTITIONS INSTALLATION</h3>
                                <p>
                                    Eureka Technical Services provides the best quality installation services for all types
                                    of false
                                    ceilings and light partitions in Dubai.

                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
            </div>
            <!-- End Row2-->

            <!-- Row3-->
            <div class="row align-items-start">
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-icon">
                            <div class="image"><img src="{{ asset('assets/front/images/ia8.webp') }}"
                                    class="img-circle" alt="EUREKA SERVICES" height="auto" width="80%"></div>
                            <div class="info">
                                <h3 class="title">FLOOR & TILING <br>WORKS</h3>
                                <p>
                                    Have you gotten rid of the broken, loose, chipped, and discolored tiles? Hire
                                    professionals to fix
                                    your tile damage.
                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-icon">
                            <div class="image"><img src="{{ asset('assets/front/images/ia7.webp') }}"
                                    class="img-circle" alt="EUREKA SERVICES" height="auto" width="80%"></div>
                            <div class="info">
                                <h3 class="title">WALLPAPER<br> FIXING</h3>
                                <p>
                                    Eureka Technical Services is the most economical firm in Dubai for the wallpaper
                                    installation and
                                    the wallpaper fixing.
                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-icon">
                            <div class="image"><img src="{{ asset('assets/front/images/handyman-services.webp') }}"
                                    class="img-circle" alt="EUREKA SERVICES" height="auto" width="80%"></div>
                            <div class="info">
                                <h3 class="title">HANDYMAN<br> SERVICES</h3>
                                <p>
                                    Eureka Technical Services gives you the best handyman services in Dubai for your
                                    apartment, villa and
                                    office.
                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
            </div>
            <!-- End Row3-->

        </div>
    </section>
    <section class="our-projects section">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 text-center">
                    <h2><span>OUR</span> PROJECTS</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row align-items-start projects-section">
                <div class="col-md-6 text-center projects-section1">
                    <div class="col-12 projects owl-theme owl-carousel">
                        <div class="shadow-sm border-radius-new">
                            <img src="{{ asset('assets/front/images/before-after1.webp') }}" class="img-fluid">
                        </div>
                        <div class="shadow-sm m-4 border-radius-new">
                            <img src="{{ asset('assets/front/images/before-after2.webp') }}" class="img-fluid">
                        </div>
                        <div class="shadow-sm m-4 border-radius-new">
                            <img src="{{ asset('assets/front/images/before-after4.webp') }}" class="img-fluid">
                        </div>
                        <div class="shadow-sm m-4 border-radius-new">
                            <img src="{{ asset('assets/front/images/before-after-13.webp') }}" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center projects-section2 align-middle">
                    <div class="row align-items-start">
                        <div class="col-md-6 mb-4 mt-5">
                            <img src="{{ asset('assets/front/images/before-after-2.webp') }}" class="img-fluid"
                                alt="EUREKA SERVICES">
                        </div>
                        <div class="col-md-6 mt-5">
                            <img src="{{ asset('assets/front/images/before-after2-1.webp') }}" class="img-fluid"
                                alt="EUREKA SERVICES">
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-md-6 mb-4">
                            <img src="{{ asset('assets/front/images/before-after1-1.webp') }}" class="img-fluid"
                                alt="EUREKA SERVICES">
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('assets/front/images/before-after4-1.webp') }}" class="img-fluid"
                                alt="EUREKA SERVICES">
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="satisfied-clients text-center section">
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto text-center">
                    <h2 class="font-weight-bolder mb-4 "><SPAN>SATISFIED</SPAN> CLIENTS</h2>
                    <div class="col-12 testimonials owl-theme owl-carousel">
                        <div class="">
                            <img src="https://annedece.sirv.com/Images/commos.png" class="pb-4 comms">
                            <p class="p-4 shadow-sm  border-radius-new text-muted text-center">Excellent work and team.
                                The Eureka Technical Services team did an excellent job of identifying the problem,
                                replacing the
                                entire unit, and replacing the connecting pipes for the water pressure pump kit that was
                                broken. </p>
                            <div class="pt-3">
                                <div class="author-img">
                                    <img src="{{ asset('assets/front/images/john.webp') }}" class="rounded mx-auto mb-2">
                                </div>
                                <div>
                                    <h5 class="name text-center">John Joseph</h5>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <img src="https://annedece.sirv.com/Images/commos.png" class="pb-4 comms">
                            <p class="p-4 shadow-sm  border-radius-new text-muted text-center"> They did an amazing job,
                                they fixed ceiling lights for me as well
                                as hanging mirrors and wall pots. They arrived on time, very professional, competent,
                                polite, and left
                                the place spotless. Thanks to the team for such good work! </p>
                            <div class="pt-3">
                                <div class="author-img"> <img src="{{ asset('assets/front/images/moideen.webp') }}"
                                        class="rounded mx-auto mb-2"> </div>
                                <div>
                                    <h5 class="name text-center">Moideen Shafwan</h5>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <img src="https://annedece.sirv.com/Images/commos.png" class="pb-4 comms">
                            <p class="p-4 shadow-sm  border-radius-new text-muted text-center"> The team who arrived was on
                                the ball; they corrected issues that I
                                had neglected for far too long and went above and beyond what I had anticipated from them.
                                Any more
                                problems
                                I have, I wouldn't think twice to call them in. </p>
                            <div class="pt-3">
                                <div class="author-img"> <img src="{{ asset('assets/front/images/michel.webp') }}"
                                        class="rounded mx-auto mb-2"> </div>
                                <div>
                                    <h5 class="name text-center">Michel Alatt</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="blog section">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 text-center">
                    <h2><span>READ OUR</span> BLOGS</h2>
                </div>
            </div>
            <div class="row align-items-start">

                <div class="col-md-6 single-blog">
                    <img src="{{ asset('assets/front/images/blog.webp') }}" class="img-fluid" alt="EUREKA SERVICES"
                        height="auto" width="100%">
                    <h4>Wallpaper or Paint? Which Suits Best for Your Apartment in Dubai</h4>
                    <p>First, let’s start by defining each of these terms. Wallpaper is a printed
                        material that is applied to the surface of a wall using a paste or a wall-covering adhesive. </p>
                    <a href="#">Learn More...</a>
                </div>
                <div class="col-md-6 blog-list">

                    <div class="mb-3 blogs">
                        <a href="" class="d-flex">
                            <img src="{{ asset('assets/front/images/blog-1.webp') }}" class="img-fluid mr-2"
                                alt="EUREKA SERVICES" height="auto" width="20%">
                            <p>Factors That Make Plumbing System Maintenance Essential</p>
                        </a>
                    </div>
                    <div class="mb-3 blogs blogs">
                        <a href="" class="d-flex">
                            <img src="{{ asset('assets/front/images/blog-2.webp') }}" class="img-fluid mr-2"
                                alt="EUREKA SERVICES" height="auto" width="20%">
                            <p>Why is proper maintenance service Important for your swimming pool?</p>
                        </a>
                    </div>
                    <div class="mb-3 blogs">
                        <a href="" class="d-flex">
                            <img src="{{ asset('assets/front/images/blog-3.webp') }}" class="img-fluid mr-2"
                                alt="EUREKA SERVICES" height="auto" width="20%">
                            <p>4 Subtle Signs That It’s Time To Get Your Air Conditioning Serviced</p>
                        </a>
                    </div>
                    <div class="mb-3 blogs">
                        <a href="" class="d-flex">
                            <img src="{{ asset('assets/front/images/blog-4.webp') }}" class="img-fluid mr-2"
                                alt="EUREKA SERVICES" height="auto" width="20%">
                            <p>Why Annual Home Upkeep is Crucial in Dubai: The Benefits You’ll Get</p>
                        </a>
                    </div>
                    <div class="mb-3 blogs">
                        <a href="" class="d-flex">
                            <img src="{{ asset('assets/front/images/blog-5.webp') }}" class="img-fluid mr-2"
                                alt="EUREKA SERVICES" height="auto" width="20%">
                            <p>Rather Than Doing it Themselves, Why Would Someone in Dubai Hire A Professional Electrician
                                Services?
                            </p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
