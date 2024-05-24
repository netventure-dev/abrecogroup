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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Mission and Vision') }}</h4>
                <div class="page-title-right">
                    <!-- <a href="{{ route('admin.mission-vision.index') }}" class="btn btn-primary w-md">{{ __('Mission and Vision') }}</a> -->
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start administrator create form -->
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.mission-vision.store') }}" method="post" class="custom-validation" enctype="multipart/form-data">
                @csrf
                <!-- Mission Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Create Mission') }}</h4>
                        <div class="mb-4 row">
                            <label for="mission_title" class="col-sm-3 col-form-label mb-2">{{ __('Mission Title') }}<span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <input id="mission_title" name="mission_title" type="text" class="form-control mb-2 @if ($errors->has('mission_title')) is-invalid @endif" placeholder="{{ __('Enter Mission Title') }}"  value="{{@old('mission_title', @$data->mission_title) }}">
                                <div class="invalid-feedback">{{ $errors->first('mission_title') }}</div>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="mission_content" class="col-sm-3 col-form-label">{{ __('Mission Content') }}</label>
                            <div class="col-sm-9">
                                <textarea name="mission_content" class="form-control summernote @if ($errors->has('mission_content')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter Mission Content') }}">{{ @old('mission_content', @$data->mission_content) }}</textarea>
                                <div class="invalid-feedback">{{ $errors->first('mission_content') }}</div>
                            </div>
                        </div>
                        <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="mission_image">{{ __('Mission Image') }}<span
                                            class="text-danger">*</span><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small> <a href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (@$data->mission_image)
                                            <img src="{{ asset('/storage/' . @$data->mission_image) }}" alt=""
                                                class="img-fluid" style="width:100px;">
                                            <button type="button" class="btn btn-primary w-md"
                                                onclick="delete_image1('{{ $data->uuid }}');"
                                                class="close">Delete</button>
                                        @endif
                                        <input id="mission_image" name="mission_image" type="file"
                                            class="form-control mb-2 @if ($errors->has('mission_image')) is-invalid @endif"
                                            value="{{ @old('mission_image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br>
                                        <div class="invalid-feedback">{{ $errors->first('mission_image') }}</div>
                                    </div>
                        </div>
                    </div>
                </div>
                
                <!-- Vision Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Create Vision') }}</h4>
                        <div class="mb-4 row">
                            <label for="vision_title" class="col-sm-3 col-form-label mb-2">{{ __('Vision Title') }}<span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <input id="vision_title" name="vision_title" type="text" class="form-control mb-2 @if ($errors->has('vision_title')) is-invalid @endif" placeholder="{{ __('Enter Vision Title') }}"  value="{{@old('vision_title', @$data->vision_title) }}">
                                <div class="invalid-feedback">{{ $errors->first('vision_title') }}</div>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="vision_content" class="col-sm-3 col-form-label">{{ __('Vision Content') }}</label>
                            <div class="col-sm-9">
                                <textarea name="vision_content" class="form-control summernote @if ($errors->has('vision_content')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter Vision Content') }}">{{ @old('vision_content', @$data->vision_content) }}</textarea>
                                <div class="invalid-feedback">{{ $errors->first('vision_content') }}</div>
                            </div>
                        </div>
                        <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="vision_image">{{ __('Vision Image') }}<span
                                            class="text-danger">*</span><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small> <a href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (@$data->vision_image)
                                            <img src="{{ asset('/storage/' . @$data->vision_image) }}" alt=""
                                                class="img-fluid" style="width:100px;">
                                            <button type="button" class="btn btn-primary w-md"
                                                onclick="delete_image('{{ $data->uuid }}');"
                                                class="close">Delete</button>
                                        @endif
                                        <input id="vision_image" name="vision_image" type="file"
                                            class="form-control mb-2 @if ($errors->has('vision_image')) is-invalid @endif"
                                            value="{{ @old('vision_image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br>
                                        <div class="invalid-feedback">{{ $errors->first('vision_image') }}</div>
                                    </div>
                         </div>
                    </div>
                    </div>
                </div>
                <!-- our values -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Create Values') }}</h4>
                        <div class="mb-4 row">
                            <label for="values_title" class="col-sm-3 col-form-label mb-2">{{ __('Values Title') }}<span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <input id="values_title" name="values_title" type="text" class="form-control mb-2 @if ($errors->has('values_title')) is-invalid @endif" placeholder="{{ __('Enter Values Title') }}"  value="{{@old('values_title', @$data->values_title) }}">
                                <div class="invalid-feedback">{{ $errors->first('values_title') }}</div>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="values_content" class="col-sm-3 col-form-label">{{ __('Values Content') }}</label>
                            <div class="col-sm-9">
                                <textarea name="values_content" class="form-control summernote @if ($errors->has('values_content')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter Vision Content') }}">{{ @old('values_content', @$data->values_content) }}</textarea>
                                <div class="invalid-feedback">{{ $errors->first('values_content') }}</div>
                            </div>
                        </div>
                        <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="values_image">{{ __('Values Image') }}<span
                                            class="text-danger">*</span><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small> <a href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (@$data->values_image)
                                            <img src="{{ asset('/storage/' . @$data->values_image) }}" alt=""
                                                class="img-fluid" style="width:100px;">
                                            <button type="button" class="btn btn-primary w-md"
                                                onclick="delete_image2('{{ $data->uuid }}');"
                                                class="close">Delete</button>
                                        @endif
                                        <input id="values_image" name="values_image" type="file"
                                            class="form-control mb-2 @if ($errors->has('values_image')) is-invalid @endif"
                                            value="{{ @old('values_image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br>
                                        <div class="invalid-feedback">{{ $errors->first('values_image') }}</div>
                                    </div>
                         </div>
                    </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                        <div>
                            <button type="submit" class="btn btn-primary w-md">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
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
            $('.summernote').summernote();
        });
        function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.mission-vision.image_delete') }}",
                    type: "get",
                    dataType: 'json',
                    data: {
                        uuid: uuid,
                    },
                    success: function(response) {
                        // if (response.status == "success") {
                        //     swal("success!", "Image deleted successfully!", "success")
                        // } else {
                        //     sweetAlert("Oops...", "Something went wrong!", "error");
                        // }
                        location.reload()
                    }
                });
            }
            return false;
        }

        function delete_image1(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.mission-vision.image_delete1') }}",
                    type: "get",
                    dataType: 'json',
                    data: {
                        uuid: uuid,
                    },
                    success: function(response) {
                        // if (response.status == "success") {
                        //     swal("success!", "Image deleted successfully!", "success")
                        // } else {
                        //     sweetAlert("Oops...", "Something went wrong!", "error");
                        // }
                        location.reload()
                    }
                });
            }
            return false;
        }
        function delete_image2(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.mission-vision.image_delete2') }}",
                    type: "get",
                    dataType: 'json',
                    data: {
                        uuid: uuid,
                    },
                    success: function(response) {
                        // if (response.status == "success") {
                        //     swal("success!", "Image deleted successfully!", "success")
                        // } else {
                        //     sweetAlert("Oops...", "Something went wrong!", "error");
                        // }
                        location.reload()
                    }
                });
            }
            return false;
        }
    </script>
@endsection
