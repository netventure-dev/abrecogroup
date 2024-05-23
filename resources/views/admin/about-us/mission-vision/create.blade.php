@extends('admin.layout.backend')

@section('title') {{ __('About Us List') }} @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@endsection
@section('content')

    @component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title') @endslot
    @endcomponent
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('Create List') }}</h4>
                <div class="page-title-right">
                <a href="{{ route('admin.mission-vision.index') }}"
                            class="btn btn-primary w-md">{{ __('Mission and Vision') }}</a>
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
                            <form action="{{ route('admin.mission-vision.store') }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Mission Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="mission_title" name="mission_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter  Mission Title') }}" required value="{{ @old('mission_title') }}">
                                        <div class="invalid-feedback">{{ $errors->first('mission_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="schema" class="col-sm-3 col-form-label">{{ __('Mission Content') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="mission_content" class="form-control summernote  @if ($errors->has('mission_content')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Mission Content') }}">{{ @old('mission_content', @$data->mission_content) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('mission_content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Mission Image') }} <span
                                        class="text-danger">*</span><br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small><a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        <input id="mission_image" name="mission_image" type="file" class="form-control mb-2 @if ($errors->has('mission_image')) is-invalid @endif" value="{{ @old('mission_image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br>
                                        <div class="invalid-feedback">{{ $errors->first('mission_image') }}</div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Vision Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="vision_title" name="vision_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('vision_title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter  Vision Title') }}" required value="{{ @old('vision_title') }}">
                                        <div class="invalid-feedback">{{ $errors->first('vision_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="schema" class="col-sm-3 col-form-label">{{ __('Vision Content') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="vision_content" class="form-control summernote  @if ($errors->has('vision_content')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Mission Content') }}">{{ @old('vision_content', @$data->vision_content) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('vision_content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Vision Image') }} <span
                                        class="text-danger">*</span><br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small><a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        <input id="vision_image" name="vision_image" type="file" class="form-control mb-2 @if ($errors->has('vision_image')) is-invalid @endif" value="{{ @old('vision_image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br>
                                        <div class="invalid-feedback">{{ $errors->first('vision_image') }}</div>
                                    </div>
                                </div>
                               
                               
                              
                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">{{ __('Submit') }}</button>
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
