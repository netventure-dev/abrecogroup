@extends('layout.front_end')
@section('content')

    <section class="pagebanner" style="background-image:url({{ asset('assets/front/images/feedback.webp') }});">
        <img src="{{ asset('assets/front/images/feedback.webp') }}" alt="banner" />
        <div class="carousel-caption d-md-block">
            <h2><span>Contact</span> Us</h2>
            <p>Need an expert? You are more than welcome to leave your contact info and we will be in touch shortly</p>
            <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button>
        </div>
    </section>

    <section class="section2 section d-flex py-0">
        <div class="container">
            <div class="row align-items- flex-reverse">
                <div class="col-md-6 pad-y-100 contact-detailed">
                    <h3><span>CONTACT</span> DETAILS</h3>

                    <h4>Address</h4>
                    <p>
                        <i class="fa fa-map-marker"></i>
                        Eureka Technical Services LLC<br>
                        Office no: 1102, Shobha Ivory 2 Business Bay,<br>
                        Dubai, UAE</p>

                    <h4>Phone</h4>
                    <p>
                        <i class="fa fa-phone"></i>
                        <a href="tel:+971522726486">+971 52 272 6486</a>
                    </p>

                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3610.7187145848493!2d55.272628!3d25.178974!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f69d15dd1cbd7%3A0x5f4c9bd2e939a9f6!2sEUREKA%20TECHNICAL%20SERVICES%20LLC%20-%20MAINTENANCE%20COMPANY%20IN%20DUBAI!5e0!3m2!1sen!2sus!4v1681466049498!5m2!1sen!2sus" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6 pad-y-100" style="background: #ea2f33;">
                    
                    <form action="{{ route('contact-us.store') }}" method="post" role="form"
                        class="myform php-email-form" data-aos="fade-up" data-aos-delay="100">
                        <h3 style="color:#fff;"><span style="color:#000;">GET IN TOUCH</span> WITH US</h3>
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
