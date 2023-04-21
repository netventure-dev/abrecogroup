@extends('layout.front_end')
@section('content')
    <style>
        .btn-disabled {
            opacity: 0.25 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }
    </style>
    <section class="pagebanner" style="background-image:url({{ asset('assets/front/images/feedback-bg.webp') }});">
        <img src="{{ asset('assets/front/images/feedback.webp') }}" alt="banner" />
        <div class="carousel-caption d-md-block">
            <h2><span>CUSTOMER</span> FEEDBACK</h2>
            <p>We would love to hear you thoughts, suggestions, concerns or problems with anything so we can improve!</p>
            {{--  <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button>  --}}
            <button type="button" class="btn btn-light book-service" data-toggle="modal" data-target="#popupform1">BOOK YOUR
                SERVICE</button>

        </div>
    </section>

    <section class="section2 section d-flex" style="">
        <div class="container">
            <div class="row justify-content-center align-item-center">
                <div class="col-md-8 pad-y-100 my-5" style="background: #00000096;">

                    <form action="{{ route('feedback.store') }}" method="post" role="form" class="myform php-email-form"
                        data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-light txt-center" style="text-align:center !important;"><span>CUSTOMER</span>
                            FEEDBACK</h3>
                        {{-- <p class="text-center text-light mb-4">We would love to hear you thoughts, suggestions, concerns or problems with anything so we can improve!</p> --}}
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
        <div class="modal fade" id="popupform1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                function form_button() {
                    if ($('input[name="name"]').val() != '' && $('input[name="email"]').val() != '' && $('input[name="phone"]')
                        .val() != '' && $('input[name="location"]').val() != '') {

                        $('#popup_form_data').addClass('btn-disabled');
                    } else {
                        // remove class from button
                        $('#popup_form_data').removeClass('btn-disabled');
                    }

                }
            </script>
        @endsection
