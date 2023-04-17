@extends('layout.front_end')
@section('content')

    <section class="pagebanner" style="background-image:url({{ asset('assets/front/images/about.webp') }});">
    <img src="{{ asset('assets/front/images/about.webp') }}" alt="banner" />
        <div class="carousel-caption d-md-block">
            <h2><span>About</span> Us</h2>
            <p>Need an expert? You are more than welcome to leave your contact info and we will be in touch shortly
            </p>
            <button type="button" class="btn btn-light book-service">BOOK YOUR SERVICE</button>
        </div>
    </section>

    <section class="section2 section d-flex">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('assets/front/images/about-us-.webp') }}" class="img-fluid d-block"
                        alt="EUREKA SERVICES">
                </div>
                <div class="col-md-6">
                    <h3><span>WHO</span> WE ARE</h3>
                    <p>Eureka Technical Services LLC is a mainstream resolution for maintenance hazards. We are established
                        in UAE as an ultimate solution for maintenance services and other technical services. Eureka is
                        professionally approved and licensed by the Government of Dubai.</p>

                    <h3><span>WHY</span> EUREKA</h3>
                    <p>Eureka stands as a reliable option with professional and experienced staff, and friendly services
                        without delay. We offer quality services with 100% customer satisfaction.</p>
                    <p>Eureka primarily focuses on utmost customer care, satisfaction, and transparency. And for that, we
                        always provide quality services by a dedicated professional team. We ensure a reliable and expert
                        service to resolve your maintenance mayhems.</p>

                    <ul class="elementor-inline-list-items">
                        <li class="elementor-inline-list-item">
                            <i aria-hidden="true" class="fa fa-check"></i>Professional Installers
                        </li>
                        <li class="elementor-inline-list-item">
                            <i aria-hidden="true" class="fa fa-check"></i>24/7 Support
                        </li>
                        <li class="elementor-inline-list-item">
                            <i aria-hidden="true" class="fa fa-check"></i>Friendly Advice
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section2 section d-flex" style="background: var(--grey);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h3 class="text-center"><span>WHO</span> WE ARE</h3>
                    <p class="text-center mb-5"> Our Brand Promise is made to assure each of our valued customers that they
                        will receive the highest-quality services at all times: </p>

                    <ul class="elementor-icon-list-items">
                        <li class="elementor-icon-list-item">
                            <img src="{{ asset('assets/front/images/award.svg') }}" alt="" />
                            <h4>Excellent Service</h4>
                            <span>We pledge to handle you with the utmost professionalism and respect.</span>
                        </li>
                        <li class="elementor-icon-list-item">
                            <img src="{{ asset('assets/front/images/check-bell.svg') }}" alt="" />
                            <h4>Recurrent Updates</h4>
                            <span>You will always be kept informed.</span>
                        </li>
                        <li class="elementor-icon-list-item">
                            <img src="{{ asset('assets/front/images/provision.svg') }}" alt="" />
                            <h4>Service Provision</h4>
                            <span>We'll be there on schedule.</span>
                        </li>
                        <li class="elementor-icon-list-item">
                            <img src="{{ asset('assets/front/images/worker.svg') }}" alt="" />
                            <h4>Qualified Experts</h4>
                            <span>You will receive courteous service from our certified experts.</span>
                        </li>
                        <li class="elementor-icon-list-item">
                            <img src="{{ asset('assets/front/images/repair.svg') }}" alt="" />
                            <h4>Customized for Your Needs</h4>
                            <span>We'll pay attention and provide shrewd solutions.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section2 section d-flex py-0" class="bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" style="background: #f9bf0f;">
                    <div class="elementor-widget-wrap p-5">
                        <div class="elementor-icon">
                            <i aria-hidden="true" class="fa fa-crosshairs"></i>
                        </div>
                        <h3>OUR <span class="text-light">MISSION</span></h3>
                        <p>Our top priority is to ensure your health and safety. To provide our customers with high-quality
                            service, we only work with the most qualified and
                            experienced technicians and customer service personnel. Rest assured that we are always
                            accessible to discuss any issues that arise with your residence or other property.
                        </p>
                    </div>
                </div>
                <div class="col-md-6" style="background: #ed5d60;">
                    <div class="elementor-widget-wrap p-5">
                        <div class="elementor-icon">
                            <i aria-hidden="true" class="fa fa-eye"></i>
                        </div>
                        <h3>OUR <span class="text-light">VISION</span></h3>
                        <p>Our top priority is to ensure your health and safety. To provide our customers with high-quality
                            service, we only work with the most qualified and
                            experienced technicians and customer service personnel. Rest assured that we are always
                            accessible to discuss any issues that arise with your residence or other property.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section2 section d-flex" style="background: var(--grey);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h3 class="text-center"><span>WHY</span> CHOOSE US</h3>
                    <p class="text-center mb-5">We at Eureka Technical Services LLC have you covered whether you need
                        maintenance done at home, in your office, in your warehouse, or at another place of business. With
                        the highest standards of labour, instruction, and customer service, we uphold our stellar
                        reputation, which is everything to us.</p>

                    <ul class="elementor-icon-left-list-items">
                        <li class="elementor-icon-left-list-item">
                            <div class="img-wrap">
                                <img src="{{ asset('assets/front/images/recommended.webp') }}" alt="" />
                            </div>
                            <div>
                                <h4>HIGHLY USED AND RECOMMENDED </h4>
                                <span>We operate in all locations and developments around Dubai and have finished more than
                                    100,000 jobs for more than 16,000 pleased clients.</span>
                            </div>
                        </li>
                        <li class="elementor-icon-left-list-item">
                            <div class="img-wrap">
                                <img src="{{ asset('assets/front/images/flexiblt-service.webp') }}" alt="" />
                            </div>
                            <div>
                                <h4>FLEXIBLE SERVICE OPTIONS </h4>
                                <span>Customers have the option of pre-scheduling services and repairs as needed or choosing
                                    the security of an annual maintenance contract, which offers them round-the-clock
                                    support with their property needs.</span>
                            </div>
                        </li>
                        <li class="elementor-icon-left-list-item">
                            <div class="img-wrap">
                                <img src="{{ asset('assets/front/images/punctuality.webp') }}" alt="" />
                            </div>
                            <div>
                                <h4>PUNCTUALITY </h4>
                                <span>We provide precise arrival times. According to our most recent statistics, we arrive
                                    at 98.5% of our tasks early or on time; on the odd occasion that we could be running
                                    late, we'll contact you to let you know.</span>
                            </div>
                        </li>
                        <li class="elementor-icon-left-list-item">
                            <div class="img-wrap">
                                <img src="{{ asset('assets/front/images/customer-satisfaction.webp') }}" alt="" />
                            </div>
                            <div>
                                <h4>CUSTOMER SATISFACTION GUARANTEED </h4>
                                <span>Since our customers are our top priority, we promise to treat you with courtesy and
                                    professionalism throughout the entire process.</span>
                            </div>
                        </li>
                        <li class="elementor-icon-left-list-item">
                            <div class="img-wrap">
                                <img src="{{ asset('assets/front/images/knowledge.webp') }}" alt="" />
                            </div>
                            <div>
                                <h4>KNOWLEDGEABLE BOOKINGS TEAM </h4>
                                <span>Our booking staff is made up of skilled call operators who receive direct assistance
                                    from licensed craftsmen. This guarantees a precise comprehension of the difficulties at
                                    hand, a better and faster diagnosis, and the capacity to offer an immediate quotation
                                    for the majority of projects.</span>
                            </div>
                        </li>
                        <li class="elementor-icon-left-list-item">
                            <div class="img-wrap">
                                <img src="{{ asset('assets/front/images/size.webp') }}" alt="" />
                            </div>
                            <div>
                                <h4>SIZE ISN'T AN ISSUE </h4>
                                <span>No task is too minor or too big, whether it is a leaking faucet or a full property AC,
                                    duct, and coil clean. All of your property care needs can be met by our sizable fleet of
                                    professionals, who are available seven days a week.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
