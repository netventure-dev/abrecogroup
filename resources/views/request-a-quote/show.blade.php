@extends('layout.front_end')
@section('content')

    <section class="pagebanner" style="background-image:url({{ asset('assets/front/images/feedback.webp') }});">
        <img src="{{ asset('assets/front/images/feedback.webp') }}" alt="banner" />
        <div class="carousel-caption d-md-block">
            <h2><span>REQUEST</span> RATES</h2>
            <p>Eureka primarily focuses on utmost customer care, satisfaction, and transparency. We ensure a reliable and expert service to resolve your maintenance mayhems.</p>
            <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button>
        </div>
    </section>

    <section class="section2 section">
        <div class="container">
            <div class="row align-items- flex-reverse">
                <div class="col-md-12 text-center">
                    <h3 class="text-uppercase" style="text-align: center !important;"><span>Eureka</span>  Services Care</h3>
                    <P>  Eureka technical services is delighted to provide you with its annual maintenance contract and is proud to consider you as one of its customers. </p>
                    <p>More certainly your property is our priority by providing the following services: </p>
                </div>
            </div>
        </div>

        <div class='container packagecards'>
  <!-- Card 1 -->
  <div class='card'>
    <div class='card__info'>
      <h2 class='card__name'>EUREKA<br>PREMIUM CARE</h2>
      {{-- <p class='card__price' style='color: var(--color05)'>$19.99 <span class='card__priceSpan'>/month</span></p> --}}
    </div>
    <div class='card__content'>
      <div class='card__rows'>
        <p class='card__row'>10GB Disk Space</p>
        <p class='card__row'><i class="fa fa-wrench"></i>20 Domain Names</p>
        <p class='card__row'>10 E-Mail Address</p>
        <p class='card__row'><i class="fa fa-wrench"></i>100GB Monthly Bandwidth</p>
        <p class='card__row'>Fully Support</p>
        <p class='card__row'><i class="fa fa-wrench"></i>100GB Monthly Bandwidth</p>
      </div>
      {{-- <a href='#emptyLink' class='card__link' style='background-color: var(--color02)'>PURCHASE</a> --}}
    </div>
  </div>

  <!-- Card 2 -->
  <div class='card yellow'>
    <div class='card__info'>
      <h2 class='card__name'>EUREKA<br>ESSENTIAL CARE</h2>
      {{-- <p class='card__price' style='color: var(--color06)'>$29.99 <span class='card__priceSpan'>/month</span></p> --}}
    </div>
    <div class='card__content'>
      <div class='card__rows'>
        <p class='card__row'>10GB Disk Space</p>
        <p class='card__row'><i class="fa fa-wrench"></i>20 Domain Names</p>
        <p class='card__row'>10 E-Mail Address</p>
        <p class='card__row'><i class="fa fa-wrench"></i>100GB Monthly Bandwidth</p>
        <p class='card__row'>Fully Support</p>
        <p class='card__row'><i class="fa fa-wrench"></i>100GB Monthly Bandwidth</p>
      </div>
      {{-- <a href='#emptyLink' class='card__link' style='background-color: var(--color06)'>PURCHASE</a> --}}
    </div>
  </div>

  <!-- Card 3 -->
  <div class='card'>
    <div class='card__info'>
      <h2 class='card__name'>EUREKA<br>PROFESSIONAL CARE</h2>
      {{-- <p class='card__price' style='color: var(--color12)'>$49.99 <span class='card__priceSpan'>/month</span></p> --}}
    </div>
    <div class='card__content'>
      <div class='card__rows'>
        <p class='card__row'>10GB Disk Space</p>
        <p class='card__row'><i class="fa fa-wrench"></i>20 Domain Names</p>
        <p class='card__row'>10 E-Mail Address</p>
        <p class='card__row'><i class="fa fa-wrench"></i>100GB Monthly Bandwidth</p>
        <p class='card__row'>Fully Support</p>
        <p class='card__row'><i class="fa fa-wrench"></i>100GB Monthly Bandwidth</p>
      </div>
      {{-- <a href='#emptyLink' class='card__link' style='background-color: var(--color04)'>PURCHASE</a> --}}
    </div>
  </div>
</div>


    </section>

    <section class="section2 section d-flex" style="background: url({{ asset('assets/front/images/feedback-bg.webp') }});background-repeat: no-repeat; background-size: cover;">
        <div class="container" id="request_a_quote_data">
            <div class="row justify-content-center align-item-center">
                <div class="col-md-8 pad-y-100 my-5" style="background: #00000096;">
                  @if (session()->has('success-data'))
                      <div class="alert alert-success">
                          @if(is_array(session('success-data')))
                              <ul>
                                  @foreach (session('success-data') as $message)
                                      <li>{{ $message }}</li>
                                  @endforeach
                              </ul>
                          @else
                              {{ session('success-data') }}
                          @endif
                      </div>
                  @endif
                    <form action="{{ route('request-a-quote-rates.store') }}" method="post" role="form"
                        class="myform php-email-form" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-light txt-center" style="text-align:center !important;"><span>ESTIMATE</span> RATES</h3>
                        {{-- <p class="text-center text-light mb-4">We would love to hear you thoughts, suggestions, concerns or problems with anything so we can improve!</p> --}}
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="service" id="service">
                                <option value="">Choose a Service *</option> 
                                @foreach ( $services as $data )
                                    <option value="{{ $data->uuid}}">{{ $data->name}}</option>                                    
                                @endforeach
                            </select>
                        </div>
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
                            <input type="tel" class="form-control" id="location" name="location" value="{{ @old('location') }}" placeholder="Location *">
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