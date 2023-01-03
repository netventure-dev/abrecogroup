@extends('layout.front_end')
@section('content')

    <section class="slider-section">
        <div class="slides owl-theme owl-carousel">
            <div class="shadow-sm border-radius-new">
                <img src="{{asset('storage/'.$service->cover_image)}}" class="img-fluid d-block" alt="EUREKA SERVICES">
                <div class="carousel-caption d-md-block">
                    <h2>{{$service->name}}</h2>
                    <p>{!! $service->cover_description !!} </p>
                    {{-- <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button> --}}
                </div>
            </div>
        </div>
    </section>

    @php 
    $content1 = $content->where('order',1)->first();
    $content1_list1 = App\Models\ServiceContentList::where('service_content_id',$content1->uuid)->take(3)->get();
    $content1_list2 = App\Models\ServiceContentList::where('service_content_id',$content1->uuid)->skip(3)->take(3)->get();
    $content2 = $content->where('order',2)->where('image_position','2')->first();
    $content3 = $content->where('order',3)->first();
    $content4 = $content->where('order',4)->where('image_position','3')->first();
    $content5 = $content->where('order',5)->where('image_position','2')->first();
    $content6 = $content->where('order',6)->where('image_position','3')->first();
    $content7 = $content->where('order',7)->where('image_position','2')->first();
    $content8 = $content->where('order',8)->where('image_position','1')->first();
    @endphp
    <section class="service section">
        <div class="container">
            <div class="row col-md-12 text-center section1">
                <h2>{!! @$content1->title!!}</h2>
               {!! @$content1->description !!}
            </div>
            <div class="row col-md-12">

                <div class="col-md-6">
                    
                    <ul class="list-group">
                        @foreach ($content1_list1 as $data)
                        <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i> {{$data->data}} </li>
                        @endforeach
                        
                       
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        @foreach ($content1_list2 as $data)
                        <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i> {{$data->data}} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section2 section">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-6 mt-5">
                    <img src="{{asset('storage/'.$content2->image)}}" class="rounded img-fluid d-block" alt="EUREKA SERVICES">
                </div>
                <div class="col-md-6">
                    <h3>{!!@$content2->title!!}</h3>
                    {!!$content2->description!!}
                   <a href="{{$content2->button_link}}" target="_blank"> <button type="submit" class="btn btn-warning mb-2"> {{$content2->button_title}}</button><a>
                </div>
            </div>
            <div class="row col-md-12 m-1 section2-1">
             {!!  $content3->description !!}
            </div>

            <div class="row col-md-12 section2-2">
                <div class="col-md-6">
                    {!!  $content4->description !!}
                    <a href="{{$content4->button_link}}" target="_blank">  <button type="submit" class="btn btn-warning mb-2">{{$content4->button_title}}</button></a>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('storage/'.$content4->image)}}" class="img-fluid rounded d-block" alt="EUREKA SERVICES">
                </div>
            </div>
        </div>
    </section>

    <section class="section3 section">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-6 mt-5">
                    <img src="{{asset('storage/'.$content5->image)}}" class="rounded img-fluid d-block" alt="EUREKA SERVICES">
                </div>
                <div class="col-md-6">
                    <h3>{!! @$content5->title !!}</h3>
                    {!!  $content5->description !!}
                    <a href="{{$content5->button_link}}" target="_blank">  <button type="submit" class="btn btn-warning mb-2">{{$content5->button_title}}</button></a>
                </div>
            </div>
    </section>

    <section class="section4 section">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-6 mt-5">
                    <h3>{!! @$content6->title !!}</h3>
                    {!!  $content6->description !!}
                    <a href="{{$content6->button_link}}" target="_blank">  <button type="submit" class="btn btn-warning mb-2">{{$content6->button_title}}</button></a>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('storage/'.$content6->image)}}" class="shadow rounded img-fluid ml-4 p-4 img1"
                        alt="EUREKA SERVICES">
                    {{-- <img src="{{asset('storage/'.$content6->image)}}" class="shadow rounded img-fluid img2" alt="EUREKA SERVICES"> --}}
                </div>
            </div>
    </section>

    <section class="section5 section">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-6 mt-5">
                    <img src="{{asset('storage/'.$content7->image)}}" class="rounded img-fluid d-block" alt="EUREKA SERVICES">
                </div>
                <div class="col-md-6">
                    <h3>{!! @$content7->title !!} </h3>
                    {!!  $content7->description !!}
                    <a href="{{$content7->button_link}}" target="_blank">  <button type="submit" class="btn btn-warning mb-2">{{$content7->button_title}}</button></a>
                </div>
            </div>
    </section>

    <section class="section6 section" style="background: url('{{asset('storage/'.$content8->image)}}');">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-6 mt-5 sec6-desc">
                    <h3 class="text-white">{!! @$content8->title !!}</h3>
                    {!!  $content8->description !!}
                    <a href="{{$content8->button_link}}" target="_blank"> <button type="submit" class="btn btn-warning mb-2">{{$content8->button_title}}</button></a>
                </div>
                <div class="col-md-6">
                </div>
            </div>
    </section>
    <section class="faq section">
        <div class="container">
            <h3><span>FAQ</span></h3>
            <div class="accordion" id="accordionExample">
                @foreach ($faqs as $faq)             
                <div class="card">
                    <div class="card-header" id="heading{{$faq->id}}">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left @if(!$loop->first) collapsed @endif" type="button" data-toggle="collapse"
                                data-target="#collapse{{$faq->id}}" aria-expanded="true" aria-controls="collapse{{$faq->id}}">
                                {{$faq->title}}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{$faq->id}}" class="collapse @if($loop->first)show @endif" aria-labelledby="heading{{$faq->id}}"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            {!! $faq->description !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @endsection
