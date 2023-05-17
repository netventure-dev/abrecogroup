@extends('admin.layout.backend')

@section('title')
    {{ __('Create General Settings') }}
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')

    @component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title')
        @endslot
    @endcomponent
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('Create General Settings') }}</h4>
                <div class="page-title-right">

                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start administrator create form -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 row">
                        <div class="col-lg-11">
                            <form action="{{ route('admin.general.store') }}" method="post" class="custom-validation"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="address" class="col-sm-3 col-form-label">{{ __('Address') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control summernote @if ($errors->has('address')) is-invalid @endif" ro
                                            placeholder="{{ __('Enter Description') }}" required>{{ @old('address', @$data->address) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('address') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="phone" class="col-sm-3 col-form-label mb-2">{{ __('Mobile') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="phone" name="phone" type="text"
                                            class="form-control mb-2 @if ($errors->has('phone')) is-invalid @endif"
                                            placeholder="{{ __('Enter phone') }}" required
                                            value="{{ @old('phone', @$data->mobile) }}">
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="logo">{{ __('Logo') }}<a href="#"
                                            class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (isset($data->logo))
                                            <img src="{{ asset('/storage/' . @$data->logo) }}" alt=""
                                                class="img-fluid" style="width:100px;">
                                        @endif
                                        <input id="logo" name="logo" type="file"
                                            class="form-control mb-2 @if ($errors->has('logo')) is-invalid @endif"
                                            value="{{ @old('logo') }}">
                                        <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="favicon">{{ __('Favicon') }}<a href="#"
                                            class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (isset($data->favicon))
                                            <img src="{{ asset('/storage/' . @$data->favicon) }}" alt=""
                                                class="img-fluid" style="width:100px;">
                                        @endif
                                        <input id="favicon" name="favicon" type="file"
                                            class="form-control mb-2 @if ($errors->has('favicon')) is-invalid @endif"
                                            value="{{ @old('favicon') }}">
                                        <div class="invalid-feedback">{{ $errors->first('favicon') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Facebook') }}<span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="facebook" name="facebook" type="text"
                                            class="form-control mb-2 @if ($errors->has('facebook')) is-invalid @endif"
                                            placeholder="{{ __('Enter facebook link') }}" value="{{ @old('facebook', @$data->facebook) }}">
                                        <div class="invalid-feedback">{{ $errors->first('facebook') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Instagram') }}<span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="instagram" name="instagram" type="text"
                                            class="form-control mb-2 @if ($errors->has('instagram')) is-invalid @endif"
                                            placeholder="{{ __('Enter instagram link') }}" value="{{ @old('instagram', @$data->instagram) }}">
                                        <div class="invalid-feedback">{{ $errors->first('instagram') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Twitter') }}<span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="twitter" name="twitter" type="text"
                                            class="form-control mb-2 @if ($errors->has('twitter')) is-invalid @endif"
                                            placeholder="{{ __('Enter twitter link') }}" value="{{ @old('twitter', @$data->twitter) }}">
                                        <div class="invalid-feedback">{{ $errors->first('twitter') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Linkdln') }}<span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="linkdln" name="linkdln" type="text"
                                            class="form-control mb-2 @if ($errors->has('linkdln')) is-invalid @endif"
                                            placeholder="{{ __('Enter linkdln link') }}" value="{{ @old('linkdln', @$data->linkdln) }}">
                                        <div class="invalid-feedback">{{ $errors->first('linkdln') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Youtube') }}<span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="youtube" name="youtube" type="text"
                                            class="form-control mb-2 @if ($errors->has('youtube')) is-invalid @endif"
                                            placeholder="{{ __('Enter youtube link') }}" value="{{ @old('youtube', @$data->youtube) }}">
                                        <div class="invalid-feedback">{{ $errors->first('youtube') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary w-md">{{ __('Submit') }}</button>
                                        </div>
                                    </div>
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
            $('.summernote').summernote('fontName', 'Poppins');
        });
    </script>
@endsection
