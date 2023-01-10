@extends('layout.front_end')
@section('content')
    @if ($home_sliders->count() > 0)
        <section class="slider-section">
            <div class="slides owl-theme owl-carousel">
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
            </div>
        </section>
    @endif
    @if ($technical_services_list->count() > 0)
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
                        @foreach ($technical_services_list as $technical_service_list)
                            <div class="icon-box-icon-list">
                                <div class="icon-box-icons">
                                    <i>
                                        <img src="{{ asset('storage/' . @$technical_service->image) }}" class="img-fluid"
                            alt="EUREKA SERVICES" style="width:50px;">
</i>
                                </div>
                                <div class="icon-box-contents">
                                    <h3>{{ @$technical_service_list->title }} </h3>
                                    {!! @$technical_service_list->description !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . @$technical_service->image) }}" class="img-fluid"
                            alt="EUREKA SERVICES">
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($services->count() > 0)
        <section class="our-services section">
            <div class="container paddingBlock">
                <div class="col-12 text-center">
                    <h2><span>OUR</span> SERVICES</h2>
                </div>
                <div class="equalHMRWrap eqWrap box">
                    @foreach ($services as $service)
                        <div class="equalHMR eq box-icon">
                            <div class="image">
                                <a href="#" title="Title Link">
                                    <img src="{{ asset('storage/' . @$service->logo) }}"
                                    class="img-circle" alt="EUREKA SERVICES" height="auto" width="80%">
                                </a>
                            </div>
                            <div class="info">
                                <h3 class="title"><a href="#" title="Title Link">{{ @$service->name }}</a></h3>
                                <p>{!! \Illuminate\Support\Str::limit($service->description, $limit = 150, $end = '...') !!}
                                </p>
                                <div class="more">
                                    <a href="#" title="Title Link">
                                        ENQUIRE NOW <i class="fa fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    
    @if ($our_projects->count() > 0)
        <section class="our-projects section">
            <div class="container">
                <div class="col-12 text-center">
                    <h2><span>OUR</span> PROJECTS</h2>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row align-items-start projects-section">
                    <div class="col-md-6 text-center projects-section1">
                        <div class="col-12 projects owl-theme owl-carousel">
                            @foreach ($our_projects as $our_project)
                                <div class="shadow-sm border-radius-new">
                                    <img src="{{ asset('storage/' . @$our_project->image) }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 text-center projects-section2 align-middle">
                        <div class="row align-items-start">
                            @foreach ($our_projects as $our_project)
                                <div class="col-md-6 mb-4 mt-5">
                                    <img src="{{ asset('storage/' . @$our_project->image) }}" class="img-fluid"
                                        alt="EUREKA SERVICES">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="satisfied-clients text-center section">
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto text-center">
                    <h2 class="font-weight-bolder mb-4 "><SPAN>SATISFIED</SPAN> CLIENTS</h2>
                    <div class="col-12 testimonials owl-theme owl-carousel">
                        @foreach ($testimonials as $testimonial)
                            <div class="">
                                <img src="https://annedece.sirv.com/Images/commos.png" class="pb-4 comms">
                                <div class="p-4 shadow-sm  border-radius-new text-muted text-center">
                                    {!! @$testimonial->description !!}
                                </div>
                                <div class="pt-3">
                                    <div class="author-img">
                                        <img src="{{ asset('storage/' . @$testimonial->image) }}"
                                            class="rounded mx-auto mb-2">
                                    </div>
                                    <div>
                                        <h5 class="name text-center">{{ @$testimonial->title }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                @foreach($blogLists as $key => $bloglist)
                @if($key == 0)
                    <div class="col-md-6 single-blog">
                        <img src="{{ asset('assets/front/images/blog.webp') }}" class="img-fluid" alt="EUREKA SERVICES"
                            height="auto" width="100%">
                        <h4>{{@$bloglist->title}}</h4>
                        <p>{!! \Illuminate\Support\Str::limit($bloglist->description, $limit = 150, $end = '...') !!}</p>
                        <a href="#">Learn More....</a>
                    </div>
                @endif
                @endforeach
                @if($blogLists->count() > 0)
                <div class="col-md-6 blog-list">
                    @foreach($blogLists as $key => $bloglist)
                    @if($key != 0)
                        <div class="mb-3 blogs">
                            <a href="" class="d-flex">
                                <img src="{{ asset('storage/'.$bloglist->image) }}" class="img-fluid mr-2"
                                    alt="EUREKA SERVICES" height="auto" width="20%">
                                <p>{{@$bloglist->title}}</p>
                            </a>
                        </div>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
