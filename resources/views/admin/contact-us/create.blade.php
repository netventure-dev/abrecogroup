@extends('admin.layout.backend')

@section('title')
    {{ __('Create Contact Us') }}
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Contact Us') }}</h4>
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
                            <form action="{{ route('admin.contact-us.store') }}" method="post" class="custom-validation"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        {{-- <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid @endif"
                                            placeholder="{{ __('Enter Title') }}" required
                                            value="{{ @old('title', @$data->title) }}"> --}}
                                        <textarea id="title" name="title"
                                            class="form-control mb-2  @if ($errors->has('title')) is-invalid @endif"
                                            placeholder="{{ __('Enter Title') }}" required>{{ @old('title', @$data->title) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="canonical_tag"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Canonical Tag') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="canonical_tag" name="canonical_tag" type="text"
                                            class="form-control mb-2 @if ($errors->has('canonical_tag')) is-invalid @endif"
                                            placeholder="{{ __('Enter canonical tag') }}"
                                            value="{{ @old('canonical_tag', @$data->canonical_tag) }}">
                                        <div class="invalid-feedback">{{ $errors->first('canonical_tag') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="phone" class="col-sm-3 col-form-label mb-2">{{ __('Mobile') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="phone" name="phone" type="number"
                                            class="form-control mb-2 @if ($errors->has('phone')) is-invalid @endif"
                                            placeholder="{{ __('Enter phone') }}" required
                                            value="{{ @old('phone', @$data->phone) }}">
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="content" class="col-sm-3 col-form-label">{{ __('Content') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="content" class="form-control  @if ($errors->has('content')) is-invalid @endif" ro
                                            placeholder="{{ __('Enter Description') }}" required>{{ @old('content', @$data->description) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="address" class="col-sm-3 col-form-label">{{ __('address') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control  @if ($errors->has('address')) is-invalid @endif" ro
                                            placeholder="{{ __('Enter Description') }}" required>{{ @old('address', @$data->address) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('address') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="banner_image">{{ __('Banner Image') }}<span
                                            class="text-danger">*</span> <a href="#"
                                            class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small></label>
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
                                            <small>(The image must not be greater than 2 MB)</small><br></br>
                                            <div class="invalid-feedback">{{ $errors->first('banner_image') }}</div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="mobile_image">{{ __('Mobile Image') }}
                                    <a href="#"
                                            class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                            @if (@$data->mobile_image)
                                                <img src="{{ asset('/storage/' . @$data->mobile_image) }}" alt=""
                                                    class="img-fluid" style="width:100px;">
                                                <button type="button" class="btn btn-primary w-md"
                                                    onclick="delete_image1('{{ $data->uuid }}');"
                                                    class="close">Delete</button>
                                            @endif
                                            <input id="mobile_image" name="mobile_image" type="file"
                                                class="form-control mb-2 @if ($errors->has('mobile_image')) is-invalid @endif"
                                                value="{{ @old('mobile_image') }}">
                                            <small>(The mobile image must not be greater than 2 MB)</small><br></br>
                                            <div class="invalid-feedback">{{ $errors->first('mobile_image') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Link') }}</label>
                                    <div class="col-sm-9">
                                        <input id="link" name="link" type="text"
                                            class="form-control mb-2 @if ($errors->has('link')) is-invalid @endif"
                                            placeholder="{{ __('Enter link') }}"
                                            value="{{ @old('link', @$data->link) }}">
                                        <div class="invalid-feedback">{{ $errors->first('link') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="map_link"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Map Link') }}</label>
                                    <div class="col-sm-9">
                                        <input id="map_link" name="map_link" type="text"
                                            class="form-control mb-2 @if ($errors->has('map_link')) is-invalid @endif"
                                            placeholder="{{ __('Enter map link') }}"
                                            value="{{ @old('map_link', @$data->map_link) }}">
                                        <div class="invalid-feedback">{{ $errors->first('map_link') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_title"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Seo Title') }}</label>
                                    <div class="col-sm-9">
                                        <input id="seo_title" name="seo_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('seo_title')) is-invalid @endif"
                                            placeholder="{{ __('Enter seo title') }}"
                                            value="{{ @old('seo_title', @$data->seo_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('seo_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_keywords"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Seo keyword') }}</label>
                                    <div class="col-sm-9">
                                        <input id="seo_keywords" name="seo_keywords" type="text"
                                            class="form-control mb-2 @if ($errors->has('seo_keywords')) is-invalid @endif"
                                            placeholder="{{ __('Enter seo keyword') }}"
                                            value="{{ @old('seo_keywords', @$data->seo_keywords) }}">
                                        <div class="invalid-feedback">{{ $errors->first('seo_keywords') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_description"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Seo Description') }}</label>
                                    <div class="col-sm-9">
                                        <textarea id="seo_description" name="seo_description" type="text"
                                            class="form-control mb-2 @if ($errors->has('seo-description	')) is-invalid @endif"
                                            placeholder="{{ __('Enter Seo Description') }}"> {{ @old('seo_keywords', @$data->seo_description) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('seo_description	') }}
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

        function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.contact-us.image_delete') }}",
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
                    url: "{{ route('admin.contact-us.image_delete1') }}",
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
