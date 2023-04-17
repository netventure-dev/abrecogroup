@extends('layout.front_end')
@section('content')

    <section class="pagebanner" style="background-image:url({{ asset('assets/front/images/feedback-bg.webp') }});">
        <img src="{{ asset('assets/front/images/feedback.webp') }}" alt="banner" />
        <div class="carousel-caption d-md-block">
            <h2><span>CUSTOMER</span> FEEDBACK</h2>
            <p>We would love to hear you thoughts, suggestions, concerns or problems with anything so we can improve!</p>
            <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button>
        </div>
    </section>

    <section class="section2 section d-flex" style="">
        <div class="container">
            <div class="row justify-content-center align-item-center">
                <div class="col-md-8 pad-y-100 my-5" style="background: #00000096;">
                    
                    <form action="{{ route('feedback.store') }}" method="post" role="form"
                        class="myform php-email-form" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-light txt-center" style="text-align:center !important;"><span>CUSTOMER</span> FEEDBACK</h3>
                        {{-- <p class="text-center text-light mb-4">We would love to hear you thoughts, suggestions, concerns or problems with anything so we can improve!</p> --}}
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" value="{{ @old('name') }}" placeholder="Full Name *">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" value="{{ @old('email') }}" placeholder="Email Address *">
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ @old('phone') }}" placeholder="Phone Number *">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="message" name="message" rows="4" cols="50" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                        <div class="text-center">
                            <button type="submit" class="">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <section>
@endsection