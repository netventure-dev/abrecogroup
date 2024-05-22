@extends('admin.layout.backend')

@section('title')
    {{ __('Create About Us') }}
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create About Us') }}</h4>
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
                            <form action="{{ route('admin.about-us.settings.store') }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                              
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea id="title" name="title"
                                            class="form-control mb-2  @if ($errors->has('title')) is-invalid @endif"
                                            placeholder="{{ __('Enter title') }}" required>{{ @old('title', @$data->title) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Sub Title') }}
                                    <span class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea id="sub_title" name="sub_title"
                                            class="form-control mb-2  @if ($errors->has('sub_title')) is-invalid @endif"
                                            placeholder="{{ __('Enter title') }}" required>{{ @old('sub_title', @$data->sub_title) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('sub_title') }}</div>
                                    </div>
                                </div>
                               
                                <div class="mb-4 row">
                                    <label for="content" class="col-sm-3 col-form-label">{{ __('Content') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="content" class="form-control summernote  @if ($errors->has('content')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Content') }}" >{{ @old('content', @$data->content) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="content" class="col-sm-3 col-form-label">{{ __(' Sub Content') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="sub_content" class="form-control summernote  @if ($errors->has('sub_content')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Sub Content') }}" >{{ @old('sub_content', @$data->sub_content) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('sub_content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="banner_image">{{ __('Banner Image') }}<span
                                            class="text-danger">*</span><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small> <a href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (@$data->image)
                                            <img src="{{ asset('/storage/' . @$data->image) }}" alt=""
                                                class="img-fluid" style="width:100px;">
                                            <button type="button" class="btn btn-primary w-md"
                                                onclick="delete_image('{{ $data->uuid }}');"
                                                class="close">Delete</button>
                                        @endif
                                        <input id="banner_image" name="banner_image" type="file"
                                            class="form-control mb-2 @if ($errors->has('banner_image')) is-invalid @endif"
                                            value="{{ @old('banner_image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br>
                                        <div class="invalid-feedback">{{ $errors->first('banner_image') }}</div>
                                    </div>
                                </div>
                                <!-- <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Image') }}<span
                                            class="text-danger">*</span><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small> <a href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (@$data->content_image)
                                            <img src="{{ asset('/storage/' . @$data->content_image) }}" alt=""
                                                class="img-fluid" style="width:100px;">
                                            <button type="button" class="btn btn-primary w-md"
                                                onclick="delete_image1('{{ $data->uuid }}');"
                                                class="close">Delete</button>
                                        @endif
                                        <input id="image" name="image" type="file"
                                            class="form-control mb-2 @if ($errors->has('image')) is-invalid @endif"
                                            value="{{ @old('image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br></br>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div> -->
                              
                                
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

        function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.about-us.settings.image_delete') }}",
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
