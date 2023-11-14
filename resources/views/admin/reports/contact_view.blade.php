@extends('admin.layout.backend')

@section('title')
    {{ __('Edit Career Opening') }}
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('View') }}</h4>
                <div class="page-title-right">

                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    @component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title')
        @endslot
    @endcomponent
    <!-- start administrator create form -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 row">
                        <div class="col-lg-11">
                            <form action="" method="post" class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('Name') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="name" name="name" type="text"
                                            class="form-control mb-2 @if ($errors->has('name')) is-invalid @endif"
                                            placeholder="{{ __('Enter Name') }}" required
                                            value="{{ @old('name', @$quote->name) }}" readonly>
                                        <div class="invalid-feedback">{{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('Email') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="email" name="email" type="text"
                                            class="form-control mb-2 @if ($errors->has('email')) is-invalid @endif"
                                            placeholder="{{ __('Enter Email') }}" required
                                            value="{{ @old('email', @$quote->email) }}" readonly>
                                        <div class="invalid-feedback">{{ $errors->first('email') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('job') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="job" name="job" type="text"
                                            class="form-control mb-2 @if ($errors->has('job')) is-invalid @endif"
                                            placeholder="{{ __('Enter Job') }}" required
                                            value="{{ @old('service', @$quote->job) }}" readonly>
                                        <div class="invalid-feedback">{{ $errors->first('job') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('Phone') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="phone" name="phone" type="text"
                                            class="form-control mb-2 @if ($errors->has('phone')) is-invalid @endif"
                                            placeholder="{{ __('Enter Phone') }}" required
                                            value="{{ @old('phone', @$quote->phone) }}" readonly>
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}
                                        </div>
                                    </div>
                                </div>
                               <div class="mb-4 row">
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('Organization') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="organization" name="organization" type="text"
                                            class="form-control mb-2 @if ($errors->has('organization')) is-invalid @endif"
                                            placeholder="{{ __('Enter Organization') }}" required
                                            value="{{ @old('organization', @$quote->organization) }}" readonly>
                                        <div class="invalid-feedback">{{ $errors->first('organization') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('Message') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea id="message" name="message" class="form-control mb-2 @if ($errors->has('message')) is-invalid @endif"
                                            placeholder="{{ __('Enter Message') }}" required readonly>{{ old('message', @$quote->message) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                                    </div>

                                </div>


                                {{-- <a href="{{ asset('storage/' . @$quote['resume']) }}">View</a> --}}

                        </div>
                        </form>
                    </div>
                    <div class="col-lg-6"> </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- end administrator create form -->
@endsection

@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
                    $(document).ready(function() {
                        $('.summernote').summernote('fontName', 'Poppins');
                    });
    </script>
@endsection

