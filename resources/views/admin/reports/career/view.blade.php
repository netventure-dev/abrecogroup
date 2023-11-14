{{-- @extends('admin.layout.backend')

@section('content')
@component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
    <div class="content">
        <!-- Row #1 -->
        <h2 class="content-heading">View Details</h2>
        <table style="width:100%">
            <tr>
                <td style="width:50%">Name</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->name }}</td>
            </tr>
            <tr>
                <td style="width:50%">Email</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->email }}</td>
            </tr>
            <tr>
                <td style="width:50%">Position</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->position }}</td>
            </tr>
            <tr>
                <td style="width:50%">Phone</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->phone }}</td>
            </tr>
            <tr>
                <td style="width:50%">Message</td>
                <td style="width:10%">:</td>
                <td style="width:40%">{{ @$quote->message }}</td>
            </tr>
            <tr>
                <td style="width:50%">Resume</td>
                <td style="width:10%">:</td>
                <td style="width:40%"><a href="{{asset('storage/'.@$quote['resume'])}}">View</a></td>

            </tr>
        </table>
    </div>
@endsection
@section('js_after')
@endsection --}}
{{-- @extends('admin.layout.backend')


@endsection --}}

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
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('Position') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="position" name="position" type="text"
                                            class="form-control mb-2 @if ($errors->has('position')) is-invalid @endif"
                                            placeholder="{{ __('Enter Position') }}" required
                                            value="{{ @old('service', @$quote->position) }}" readonly>
                                        <div class="invalid-feedback">{{ $errors->first('position') }}
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
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('Message') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea id="message" name="message" class="form-control mb-2 @if ($errors->has('message')) is-invalid @endif"
                                            placeholder="{{ __('Enter Message') }}" required readonly>{{ old('message', @$quote->message) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                                    </div>

                                </div>

                                <div class="mb-4 row">
                                    <label for="resume" class="col-sm-3 col-form-label mb-2">{{ __('Resume') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <a href="{{ asset('storage/' . @$quote['resume']) }}">View</a>


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
