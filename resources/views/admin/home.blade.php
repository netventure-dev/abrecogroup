@extends('admin.layout.backend')
@section('css_after')
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            {{--  <div class="col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>INTELLECT WORKS Dashboard</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                        class="img-thumbnail rounded-circle">
                                </div>


                            </div>


                        </div>
                    </div>
                </div>



            </div>  --}}
              @php
               
                $contact = DB::table('contacts')->count();
                
            @endphp 

            <div class="col-xl-4">
                <a href="{{ route('admin.enquiries.index') }}">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">

                                <div class="col-5 align-self-end text-right">
                                    <img src="{{ asset('assets/images/enquiry.png') }}" alt="" class="img-fluid">
                                    {{--  <i class="ico-icon fa fa-times" style="background: #f00;width: 60px;height: 60px;line-height: 60px;text-align: center;border-radius: 100%;color: #fff;font-size: 24px;"></i>  --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <h5 class="font-size-15 text-truncate"> Total Contact Enquiries

                                        : {{ @$contact }}</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            @php

                $referal = DB::table('quotes')->count();

            @endphp

            <div class="col-xl-4">
                <a href="{{ route('admin.requestenquiry.index') }}">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">

                                <div class="col-5 align-self-end text-right">
                                    <img src="{{ asset('assets/images/service.png') }}" alt="" class="img-fluid">
                                    {{--  <i class="ico-icon fa fa-times" style="background: #f00;width: 60px;height: 60px;line-height: 60px;text-align: center;border-radius: 100%;color: #fff;font-size: 24px;"></i>  --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <h5 class="font-size-15 text-truncate"> Total Service Enquiries

                                        : {{ @$referal }}</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


             @php

                $data = DB::table('careers')->count();

            @endphp

            <div class="col-xl-4">
                <a href="{{ route('admin.careerenquiry.index') }}">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">

                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('assets/images/carrieren.png') }}" alt="" class="img-fluid">
                                    {{--  <i class="ico-icon fa fa-times" style="background: #f00;width: 60px;height: 60px;line-height: 60px;text-align: center;border-radius: 100%;color: #fff;font-size: 24px;"></i>  --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <h5 class="font-size-15 text-truncate">  Total Career Enquiries

                                    : {{ @$data }}</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        </div>


            </div>
    </div>
    <!-- end modal -->

    <!-- subscribeModal -->
    {{-- <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <div class="avatar-md mx-auto mb-4">
                                <div class="avatar-title bg-light rounded-circle text-primary h1">
                                    <i class="mdi mdi-email-open"></i>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-xl-10">
                                    <h4 class="text-primary">Subscribe !</h4>
                                    <p class="text-muted font-size-14 mb-4">Subscribe our newletter and get notification to stay update.</p>

                                    <div class="input-group bg-light rounded">
                                        <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">

                                        <button class="btn btn-primary" type="button" id="button-addon2">
                                            <i class="bx bxs-paper-plane"></i>
                                        </button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal --> --}}


@endsection
