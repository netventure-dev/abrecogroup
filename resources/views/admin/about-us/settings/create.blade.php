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
                                {{-- <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Title') }}" required value="{{ @old('title',@$data->cover_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea id="title" name="title"
                                            class="form-control mb-2  @if ($errors->has('title')) is-invalid @endif"
                                            placeholder="{{ __('Enter title') }}" required>{{ @old('title', @$data->cover_title) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="canonical_tag"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Canonical tag') }}<span
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
                                    <label for="content" class="col-sm-3 col-form-label">{{ __('Schema') }}
                                        <span class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea name="schema" class="form-control  @if ($errors->has('schema')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Schema') }}" >{{ @old('schema', @$data->schema) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('schema') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="cover_content" class="col-sm-3 col-form-label">{{ __('Cover Content') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="cover_content" class="form-control @if ($errors->has('cover_content')) is-invalid @endif" ro
                                            placeholder="{{ __('Enter Description') }}" required>{{ @old('cover_content', @$data->cover_content) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('cover_content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="content" class="col-sm-3 col-form-label">{{ __('content') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="content" class="form-control  @if ($errors->has('content')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Description') }}" required>{{ @old('content', @$data->content) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="banner_image">{{ __('Banner Image') }}<span
                                            class="text-danger">*</span><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small> <a href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (@$data->banner_image)
                                            <img src="{{ asset('/storage/' . @$data->banner_image) }}" alt=""
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
                                <div class="mt-4 row">
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
                                </div>
                                <div class="mb-4 row">
                                    <label for="alt_text" class="col-sm-3 col-form-label mb-2">{{ __('Alt title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="alt_text" name="alt_text" type="text"
                                            class="form-control mb-2 @if ($errors->has('alt_text')) is-invalid @endif"
                                            placeholder="{{ __('Enter alt_text') }}" required
                                            value="{{ @old('alt_text', @$data->alt_text) }}">
                                        <div class="invalid-feedback">{{ $errors->first('alt_text') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Link') }}</label>
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
                                    <label for="horizontal-firstname-input"
                                        class="col-sm-3 col-form-label">{{ __('Status') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status1"
                                                value="1" @if (@$data->status == 1) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if (@$data->status == 0) checked @endif>
                                            <label class="form-check-label" for="status2">{{ __('Inactive') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_title" class="col-sm-3 col-form-label">{{ __('Seo Title') }}
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="seo_title" name="seo_title"
                                            placeholder="Please provide the meta title"
                                            value="{{ @old('seo_title', @$data->seo_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('seo_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_description"
                                        class="col-sm-3 col-form-label">{{ __('Seo Description') }}
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="seo_description" name="seo_description" rows="2"
                                            placeholder="Please provide meta description">{{ @old('seo_keywords', @$data->seo_description) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('seo_description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_keywords" class="col-sm-3 col-form-label">Meta Keywords
                                        <small>Seperated by comma</small>
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="seo_keywords" name="seo_keywords" rows="2"
                                            placeholder="Please provide meta keywords">{{ @old('seo_keywords', @$data->seo_keywords) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('seo_keywords') }}
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

        function delete_image1(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.about-us.settings.image_delete1') }}",
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
