@extends('admin.layout.backend')

@section('title') {{ __('Create Slider') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Slider') }}</h4>
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
                            <form action="{{ route('admin.home-slider.store') }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Title') }}" required value="{{ @old('title', @$data->title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea id="title" name="title" class="form-control mb-2 summernote @if ($errors->has('title')) is-invalid  @endif" placeholder="{{ __('Enter Title') }}" required>{{ @old('title') }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                    </div>
                                </div> -->
                                <div class="mb-4 row">
                                    <label for="sub_title" class="col-sm-3 col-form-label mb-2">{{ __('Sub Title') }}</label>
                                    <div class="col-sm-9">
                                        <input id="sub_title" name="sub_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('sub_title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter sub title') }}"  value="{{ @old('sub_title', @$data->sub_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('sub_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="canonical_tag" class="col-sm-3 col-form-label mb-2">{{ __('Canonical Tag') }}</label>
                                    <div class="col-sm-9">
                                        <input id="canonical_tag" name="canonical_tag" type="text"
                                            class="form-control mb-2 @if ($errors->has('canonical_tag')) is-invalid  @endif"
                                            placeholder="{{ __('Enter canonical tag') }}" value="{{ @old('canonical_tag',@$data->canonical_tag) }}">
                                        <div class="invalid-feedback">{{ $errors->first('canonical_tag') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="schema"
                                            class="col-sm-3 col-form-label">{{ __('Schema') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="schema"
                                            class="form-control  @if ($errors->has('schema')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Schema') }}" >{{ @old('schema',@$data->schema)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('schema') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="content"
                                            class="col-sm-3 col-form-label">{{ __('Content') }}
                                            <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="content"
                                            class="ckeditor form-control  @if ($errors->has('content')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Content Description') }}" required>{{ @old('content',@$data->description)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                               <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Slider Image') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                            @if (@$data->image)
                                                <img src="{{ asset('storage/' . $data->image) }}" alt=""
                                                    class="img-fluid" style="width:250px;">
                                                <button type="button" class="btn btn-primary w-md"
                                                    onclick="delete_image('{{@$data->uuid }}');"
                                                    class="close">Delete</button>
                                            @endif
                                            <input id="image" name="image" type="file"
                                                class="form-control mb-2 @if ($errors->has('image')) is-invalid @endif"
                                                value="{{ @old('image') }}">
                                            <small>(The image must not be greater than 2 MB)</small><br></br>
                                            <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div>

                               <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="mobile_image">{{ __('Mobile Slider Image') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                            @if (@$data->mobile_slider)
                                                <img src="{{ asset('storage/' . $data->mobile_slider) }}" alt=""
                                                    class="img-fluid" style="width:250px;">
                                                <button type="button" class="btn btn-primary w-md"
                                                    onclick="delete_image1('{{ @$data->uuid }}');"
                                                    class="close">Delete</button>
                                            @endif
                                            <input id="mobile_slider" name="mobile_slider" type="file"
                                                class="form-control mb-2 @if ($errors->has('mobile_slider')) is-invalid @endif"
                                                value="{{ @old('mobile_slider') }}">
                                            <small>(The image must not be greater than 2 MB)</small><br></br>
                                            <div class="invalid-feedback">{{ $errors->first('mobile_slider') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="button_title" class="col-sm-3 col-form-label mb-2">{{ __('Button Title') }}</label>
                                    <div class="col-sm-9">
                                        <input id="button_title" name="button_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('button_title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter button title') }}"   value="{{ @old('button_title',@$data->button_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('button_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Link') }}</label>
                                    <div class="col-sm-9">
                                        <input id="link" name="link" type="text"
                                            class="form-control mb-2 @if ($errors->has('link')) is-invalid  @endif"
                                            placeholder="{{ __('Enter link') }}" value="{{ @old('link',@$data->link) }}">
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
                                                value="1" @if ($data->status == 1) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if ($data->status == 0) checked @endif>
                                            <label class="form-check-label" for="status2">{{ __('Inactive') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mb-4 row">
                                    <label for="seo_title"
                                            class="col-sm-3 col-form-label">{{ __('Seo Title') }}
                                            </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        placeholder="Please provide the meta title" value="{{ @old('seo_title') }}"
                                        >
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
                                                placeholder="Please provide meta description"
                                                >{{ @old('seo_description') }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('seo_description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_keywords"
                                            class="col-sm-3 col-form-label">Meta Keywords <small>Seperated by comma</small>
                                            </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="seo_keywords" name="seo_keywords" rows="2"
                                                placeholder="Please provide meta keywords"
                                                >{{ @old('seo_keywords') }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('seo_keywords') }}
                                        </div>
                                    </div>
                                </div> -->
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
    function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.home-slider.image_delete') }}",
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
                    url: "{{ route('admin.home-slider.image_delete_one') }}",
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
