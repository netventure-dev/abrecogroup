@extends('layout.front_end')
@section('content')
<style>
    .btn-disabled {
        opacity: 0.25 !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
    }
</style>
    <section class="pagebanner" style="background-image:url({{ asset('assets/front/images/feedback.webp') }});">
        <img src="{{ asset('assets/front/images/feedback.webp') }}" alt="banner" />
        <div class="carousel-caption d-md-block">
            <h2><span>Contact</span> Us</h2>
            <p>Need an expert? You are more than welcome to leave your contact info and we will be in touch shortly</p>
            <button type="button" class="btn btn-light book-service" data-toggle="modal" data-target="#popupform2">BOOK YOUR
                SERVICE</button>
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
                        Dubai, UAE
                    </p>

                    <h4>Phone</h4>
                    <p>
                        <i class="fa fa-phone"></i>
                        <a href="tel:+971522726486">+971 52 272 6486</a>
                    </p>

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3610.7187145848493!2d55.272628!3d25.178974!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f69d15dd1cbd7%3A0x5f4c9bd2e939a9f6!2sEUREKA%20TECHNICAL%20SERVICES%20LLC%20-%20MAINTENANCE%20COMPANY%20IN%20DUBAI!5e0!3m2!1sen!2sus!4v1681466049498!5m2!1sen!2sus"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6 pad-y-100" style="background: #ea2f33;">

                    <form action="{{ route('contact-us.store') }}" method="post" role="form"
                        class="myform php-email-form" data-aos="fade-up" data-aos-delay="100">
                        <h3 style="color:#fff;"><span style="color:#000;">GET IN TOUCH</span> WITH US</h3>
                        @csrf
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
                            <textarea required class="form-control" id="message" name="message" rows="4" cols="50"
                                placeholder="Message *"></textarea>
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
        <div class="modal fade" id="popupform2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h3 class="text-dark text-center" style="text-align:center !important;"><span>ESTIMATE</span>
                            RATES</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('services.store') }}" method="post" role="form" class="php-email-form">
                        <div class="modal-body pb-0">
                            @csrf
                            <div class="form-group">
                                <select required class="form-control" name="service" id="service">
                                    <option value="">Choose a Service *</option>
                                    @foreach ($services as $data)
                                        <option value="{{ $data->uuid }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
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
                            <button id="popup_form_data" onclick="form_button();" type="submit"
                                class="btn btn-danger px-5 text-uppercase"
                                style="border-radius: 50px;">Submit</button>
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
