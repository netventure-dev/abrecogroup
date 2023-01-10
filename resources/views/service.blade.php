@extends('layout.front_end')
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
                     <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button>
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
                        <a href="{{ $content2->button_link }}" target="_blank"> 
                            <button type="submit" class="btn btn-warning mb-2">{{ $content2->button_title }}</button>
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
                            <a href="{{ $content2->button_link }}" target="_blank"> <button type="submit"
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
                        <a href="{{ $content4->button_link }}" target="_blank"> 
                            <button type="submit" class="btn btn-warning mb-2">{{ $content4->button_title }}</button>
                        </a>
                    @endif
                </div>
            </div>
                {{-- <div class="row col-md-12 section2-2" order='{{ @$content4->order }}'>
                    <div class="col-md-6">
                        {!! $content4->description !!}
                        @if (@$content4->button_title)
                            <a href="{{ $content4->button_link }}" target="_blank"> <button type="submit"
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
                            <a href="{{ $content5->button_link }}" target="_blank"> 
                                <button type="submit" class="btn btn-warning mb-2">{{ $content5->button_title }}</button>
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
                            <a href="{{ $content6->button_link }}" target="_blank"> 
                                <button type="submit" class="btn btn-warning mb-2">{{ $content6->button_title }}</button>
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
                    <div class="text-center">
                        @if (@$content7->button_title)
                            <a href="{{ $content7->button_link }}" target="_blank"> 
                                <button type="submit" class="btn btn-warning mb-2">{{ $content7->button_title }}</button>
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
                            <a href="{{ $content8->button_link }}" target="_blank"> <button type="submit"
                                    class="btn btn-warning mb-2">{{ $content8->button_title }}</button></a>
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
                            <a href="{{ $content9->button_link }}" target="_blank"> 
                                <button type="submit" class="btn btn-warning mb-2">{{ $content9->button_title }}</button>
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
                            <a href="{{ $content10->button_link }}" target="_blank"> 
                                <button type="submit" class="btn btn-warning mb-2">{{ $content10->button_title }}</button>
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
                            <a href="{{ $content11->button_link }}" target="_blank"> 
                                <button type="submit" class="btn btn-warning mb-2">{{ $content11->button_title }}</button>
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
                            <a href="{{ $content12->button_link }}" target="_blank"> 
                                <button type="submit" class="btn btn-warning mb-2">{{ $content12->button_title }}</button>
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
                            <a href="{{ $content14->button_link }}" target="_blank"> 
                                <button type="submit" class="btn btn-warning mb-2">{{ $content14->button_title }}</button>
                            </a>
                        @endif
                    </div>
                </div>
        </section>
    @endif

    @if ($faqs)
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


@endsection
