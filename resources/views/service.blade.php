@extends('layout.front_end')
@section('css')
<style>
    .btn-disabled {
        opacity: 0.25 !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
    }
</style>
@endsection
@section('content')

    <section class="slider-section">
        <div class="slides owl-theme owl-carousel">
            <div class="shadow-sm border-radius-new">
                <img src="{{ asset('storage/' . $service->cover_image) }}" class="img-fluid d-block" alt="EUREKA SERVICES">
                <div class="carousel-caption d-md-block">
                    @php 
                     $firstWord = strtok($service->name, " ");
                     $restOfSentence = strtok("");
                    @endphp
                    <h2><span>{{ $firstWord }}</span> {{$restOfSentence}}</h2>
                    <p>{!! $service->cover_description !!} </p>
                     <button type="button" class="btn btn-light book-service" data-toggle="modal"
                     data-target="#popupform-service">BOOK YOUR SERVICE</button>
                </div>
            </div>
        </div>
    </section>

    @php
        $content1 = $content->where('order', 1)->first();
        $content1_list1 = App\Models\ServiceContentList::where('service_content_id', @$content1->uuid)
            ->take(3)
            ->get();
        $content1_list2 = App\Models\ServiceContentList::where('service_content_id', @$content1->uuid)
            ->skip(3)
            ->take(3)
            ->get();
        $content2 = $content
            ->where('order', 2)
            ->where('image_position', '2')
            ->first();
        $content3 = $content->where('order', 3)->first();
        $content4 = $content
            ->where('order', 4)
            ->where('image_position', '3')
            ->first();
        $content5 = $content
            ->where('order', 5)
            ->where('image_position', '2')
            ->first();
        $content6 = $content
            ->where('order', 6)
            ->where('image_position', '3')
            ->first();
        $content7 = $content
            ->where('order', 7)
            ->where('image_position', '2')
            ->first();
        $content8 = $content
            ->where('order', 8)
            ->where('image_position', '1')
            ->first();
        
        $content9 = $content->where('order', 9)->first();
        $content10 = $content->where('order', 10)->first();
        $content11 = $content->where('order', 11)->first();
        $content12 = $content->where('order', 12)->first();
        $content13 = $content->where('order', 13)->first();
        $content14 = $content->where('order', 14)->first();
    @endphp
    @if ($content1)
        <section class="service section d-flex" order='{{ $content1->order }}'>
            <div class="container">
                <div class="row col-md-12 text-center section1">
                    <h2>{!! @$content1->title !!}</h2>
                    {!! @$content1->description !!}
                </div>
                <div class="row col-md-12  align-items-center">

                    <div class="col-md-6">

                        <ul class="list-group">
                            @foreach ($content1_list1 as $data)
                                <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i>
                                    {{ $data->data }}
                                </li>
                            @endforeach


                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            @foreach ($content1_list2 as $data)
                                <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i>
                                    {{ $data->data }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="section2 section d-flex" order='{{ @$content2->order }}'>
        <div class="container">
            @if ($content2)
            <div class="col-md-12">

                <!-- left image -->
                <img src="{{ asset('storage/' . $content2->image) }}" 
                class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES">

                <!-- right image -->
                <!-- <img src="{{ asset('storage/' . $content2->image) }}" 
                class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> -->

                <h3>{!! @$content2->title !!}</h3>
                {!! $content2->description !!}
                <div class="text-center">
                    @if (@$content2->button_title)
                        <a> 
                            <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                            data-target="#popupform-service">{{ $content2->button_title }}</button>
                        </a>
                    @endif
                </div>
            </div>
                {{-- <div class="row col-md-12  align-items-center">
                    <div class="col-md-6 mt-5">
                        <img src="{{ asset('storage/' . $content2->image) }}" class="float-left pr-4  rounded img-fluid d-block"
                            alt="EUREKA SERVICES">
                    </div>
                    <div class="col-md-6">
                        <h3>{!! @$content2->title !!}</h3>
                        {!! $content2->description !!}
                        @if (@$content2->button_title)
                            <a href="{{ $content2->button_link }}" > <button type="submit"
                                    class="btn btn-warning mb-2"> {{ $content2->button_title }}</button><a>
                        @endif
                    </div>
                </div> --}}
            @endif
            @if ($content3)
                <div class="row col-md-12 m-1 section2-1" order='{{ @$content3->order }}'>
                    {!! $content3->description !!}
                </div>
            @endif

            @if ($content4)
            <div class="col-md-12"  order='{{ @$content4->order }}'>

                <!-- left image -->
                {{-- <img src="{{ asset('storage/' . $content4->image) }}" 
                class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> --}}

                <!-- right image -->
               <img src="{{ asset('storage/' . $content4->image) }}" 
                class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> 

                <h3>{!! @$content4->title !!}</h3>
                {!! $content4->description !!}
                <div class="text-center">
                    @if (@$content4->button_title)
                        <a> 
                            <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                            data-target="#popupform-service"">{{ $content4->button_title }}</button>
                        </a>
                    @endif
                </div>
            </div>
                {{-- <div class="row col-md-12 section2-2" order='{{ @$content4->order }}'>
                    <div class="col-md-6">
                        {!! $content4->description !!}
                        @if (@$content4->button_title)
                            <a href="{{ $content4->button_link }}" > <button type="submit"
                                    class="btn btn-warning mb-2">{{ $content4->button_title }}</button></a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $content4->image) }}" class="img-fluid rounded d-block"
                            alt="EUREKA SERVICES">
                    </div>
                </div> --}}
            @endif

        </div>
    </section>

    @if ($content5)
        <section class="section3 section d-flex" order='{{ @$content5->order }}'>
            <div class="container">
                <div class="col-md-12">

                    <!-- left image -->
                    <img src="{{ asset('storage/' . $content5->image) }}" 
                    class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES">

                    <!-- right image -->
                    <!-- <img src="{{ asset('storage/' . $content5->image) }}" 
                    class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> -->

                    <h3>{!! @$content5->title !!}</h3>
                    {!! $content5->description !!}
                    <div class="text-center">
                        @if (@$content5->button_title)
                            <a> 
                                <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                                data-target="#popupform-service">{{ $content5->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>
               
        </section>
    @endif
    @if ($content6)
        <section class="section4 section d-flex" order='{{ @$content6->order }}'>
            <div class="container">
                <div class="col-md-12">

                    <!-- left image -->
                    {{-- <img src="{{ asset('storage/' . $content6->image) }}" 
                    class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> --}}

                    <!-- right image -->
                     <img src="{{ asset('storage/' . $content6->image) }}" 
                    class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> 

                    <h3>{!! @$content6->title !!}</h3>
                    {!! $content6->description !!}
                    <div class="text-center">
                        @if (@$content6->button_title)
                            <a> 
                                <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                                data-target="#popupform-service">{{ $content6->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </section>
    @endif
    @if ($content7)
        <section class="section5 section d-flex" order='{{ @$content7->order }}'>
            <div class="container">
                <div class="col-md-12">

                    <!-- left image -->
                    <img src="{{ asset('storage/' . $content7->image) }}" 
                    class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES">

                    <!-- right image -->
                    <!-- <img src="{{ asset('storage/' . $content7->image) }}" 
                    class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> -->

                    <h3>{!! @$content7->title !!}</h3>
                    {!! $content7->description !!}
                    <br>
                    <div class="text-center">
                        @if (@$content7->button_title)
                            <a> 
                                <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                                data-target="#popupform-service">{{ $content7->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>

        </section>
    @endif
    @if ($content8)
        <section class="section6 section d-flex" style="background: url('{{ asset('storage/' . $content8->image) }}');"
            order='{{ @$content8->order }}'>
            <div class="container">                
                <div class="row col-md-12  align-items-center">
                    <div class="col-md-6 mt-5 sec6-desc">
                        <h3 class="text-white">{!! @$content8->title !!}</h3>
                        {!! $content8->description !!}
                        @if (@$content8->button_title)<br>
                            <a> <button type="submit"
                                    class="btn btn-warning mb-2" data-toggle="modal"
                                    data-target="#popupform-service">{{ $content8->button_title }}</button></a>
                        @endif
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
        </section>
    @endif
    @if (@$content13)
        <section class="service section d-flex" order='{{ $content13->order }}' 13>
            <div class="container">
                <div class="row col-md-12 text-center section1  align-items-center">
                    <h2>{!! @$content13->title !!}</h2>
                    {!! @$content13->description !!}
                </div>
            </div>
        </section>
    @endif
    @if (@$content9)
        <section class="section3 section d-flex" order='{{ @$content9->order }}' 9>
            <div class="container">
                <div class="col-md-12">

                    <!-- left image -->
                    {{-- <img src="{{ asset('storage/' . $content10->image) }}" 
                    class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> --}}

                    <!-- right image -->
                     <img src="{{ asset('storage/' . $content9->image) }}" 
                    class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> 

                    <h3>{!! @$content9->title !!}</h3>
                    {!! $content9->description !!}
                    <div class="text-center">
                        @if (@$content9->button_title)
                            <a > 
                                <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                                data-target="#popupform-service">{{ $content9->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>
        </section>
    @endif
    @if (@$content10)
        <section class="section4 section d-flex" order='{{ @$content10->order }}' 10>
            <div class="container">
                <div class="col-md-12">

                    <!-- left image -->
                    <img src="{{ asset('storage/' . $content10->image) }}" 
                    class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES">

                    <!-- right image -->
                    <!-- <img src="{{ asset('storage/' . $content10->image) }}" 
                    class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> -->

                    <h3>{!! @$content10->title !!}</h3>
                    {!! $content10->description !!}
                    <div class="text-center">
                        @if (@$content10->button_title)
                            <a > 
                                <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                                data-target="#popupform-service">{{ $content10->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if (@$content11)
        <section class="section3 section d-flex" order='{{ @$content11->order }}' 11>
            <div class="container">
                <div class="col-md-12">

                    <!-- left image -->
                    {{-- <img src="{{ asset('storage/' . $content10->image) }}" 
                    class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> --}}

                    <!-- right image -->
                    <img src="{{ asset('storage/' . $content11->image) }}" 
                    class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> 

                    <h3>{!! @$content11->title !!}</h3>
                    {!! $content11->description !!}
                    <div class="text-center">
                        @if (@$content11->button_title)
                            <a > 
                                <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                                data-target="#popupform-service">{{ $content11->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>
        </section>
    @endif

    @if (@$content12)
        <section class="section4 section d-flex" order='{{ @$content12->order }}' 12>
            <div class="container">
                <div class="col-md-12">

                    <!-- left image -->
                    <img src="{{ asset('storage/' . $content12->image) }}" 
                    class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES">

                    <!-- right image -->
                    {{-- <img src="{{ asset('storage/' . $content11->image) }}" 
                    class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES">  --}}

                    <h3>{!! @$content12->title !!}</h3>
                    {!! $content12->description !!}
                    <div class="text-center">
                        @if (@$content12->button_title)
                            <a> 
                                <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                                data-target="#popupform-service">{{ $content12->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>
                
        </section>
    @endif
    @if (@$content14)
        <section class="section3 section d-flex" order='{{ @$content14->order }}' 14>
            <div class="container">
                <div class="col-md-12">

                    <!-- left image -->
                    {{-- <img src="{{ asset('storage/' . $content12->image) }}" 
                    class="float-left pr-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES"> --}}

                    <!-- right image -->
                    <img src="{{ asset('storage/' . $content14->image) }}" 
                    class="float-right pl-4 pb-4 w-50 shadow rounded img-fluid img1 m-0" alt="EUREKA SERVICES">  

                    <h3>{!! @$content14->title !!}</h3>
                    {!! $content14->description !!}
                    <div class="text-center">
                        @if (@$content14->button_title)
                            <a> 
                                <button type="submit" class="btn btn-warning mb-2" data-toggle="modal"
                                data-target="#popupform-service">{{ $content14->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>
        </section>
    @endif

    @if ($faqs->count())
        <section class="faq section">
            <div class="container">
                <h3><span>FAQ</span></h3>
                <div class="accordion" id="accordionExample">
                    @foreach ($faqs as $faq)
                        <div class="card">
                            <div class="card-header" id="heading{{ $faq->id }}">
                                <h2 class="mb-0">
                                    <button
                                        class="btn btn-link btn-block text-left @if (!$loop->first) collapsed @endif"
                                        type="button" data-toggle="collapse" data-target="#collapse{{ $faq->id }}"
                                        aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                        <i class="fa fa-plus" aria-hidden="true"></i>   {{ $faq->title }}
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse{{ $faq->id }}"
                                class="collapse @if ($loop->first) show @endif"
                                aria-labelledby="heading{{ $faq->id }}" data-parent="#accordionExample">
                                <div class="card-body">
                                 {!! $faq->description !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- POPUP FORM --}}
<div class="modal fade" id="popupform-service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header border-bottom-0">
            <h3 class="text-dark text-center" style="text-align:center !important;"><span>Book A</span>Service</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="my-form-button" action="{{ route('services.store') }}" method="post" role="form" class="php-email-form">
            <div class="modal-body pb-0">
                @csrf
                {{--  <div class="form-group">
                    <select required class="form-control" name="service" id="service">
                        <option selected value="{{ $service->uuid }}">{{ $service->name }}</option>
                    </select>
                </div>  --}}
                 <div class="form-group">
                    <input required type="text"readonly class="form-control" id="service" name="service"
                        value="{{ $service->uuid }}">{{ $service->name }} placeholder="">
                </div>
                 
                <div class="form-group">
                    <input required type="text" class="form-control" id="name" name="name"
                        value="{{ @old('name') }}" placeholder="Full Name *">
                </div>
                <div class="form-group">
                    <input required type="email" class="form-control" id="email" name="email"
                        value="{{ @old('email') }}" placeholder="Email Address *">
                </div>
                <div class="form-group">
                    <input required type="tel" class="form-control" id="phone" name="phone"
                        value="{{ @old('phone') }}" placeholder="Phone Number *">
                </div>
                <div class="form-group">
                    <input required type="tel" class="form-control" id="location" name="location"
                        value="{{ @old('location') }}" placeholder="Location *">
                </div>
                <div class="form-group">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center pt-0">
                <button id="popup_form_data" onclick="form_button();" type="submit" class="btn btn-danger px-5 text-uppercase" style="border-radius: 50px;">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
@section('script')
    <script type="text/javascript">
        //submit the form to the worldline
        //document.txnSubmitFrm.submit();
        function form_button(){
            if ($('input[name="name"]').val() != '' && $('input[name="email"]').val() != '' && $('input[name="phone"]').val() != '' && $('input[name="location"]').val() != '') {
             
                $('#popup_form_data').addClass('btn-disabled');
            } else {
                // remove class from button
                $('#popup_form_data').removeClass('btn-disabled');
            }
            
        }

    </script>
@endsection