@extends('admin.layout.backend')

@section('title') {{ __('Career Opening Settings') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Career Opening Settings') }}</h4>
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
                            <form action="{{ route('admin.career-opening-settings.store') }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Title') }}" required value="{{ @old('title',@$career->title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="sub_title" class="col-sm-3 col-form-label mb-2">{{ __('Sub Title') }}</label>
                                    <div class="col-sm-9">
                                        <input id="sub_title" name="sub_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('sub_title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Sub Title') }}" value="{{ @old('sub_title',@$career->sub_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('sub_title') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="canonical_tag" class="col-sm-3 col-form-label mb-2">{{ __('Canonical tag') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="canonical_tag" name="canonical_tag" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter canonical tag') }}"  value="{{ @old('canonical_tag',@$career->canonical_tag) }}">
                                        <div class="invalid-feedback">{{ $errors->first('canonical_tag') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="banner_image">{{ __('Banner Image') }} <a href="#"
                                            class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                            @if (@$career->banner_image)
                                                <img src="{{ asset('/storage/' . @$career->banner_image) }}" alt=""
                                                    class="img-fluid" style="width:100px;">
                                                <button type="button" class="btn btn-primary w-md"
                                                    onclick="delete_image('{{ $career->uuid }}');"
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
                                            @if (@$career->mobile_image)
                                                <img src="{{ asset('/storage/' . @$career->mobile_image) }}" alt=""
                                                    class="img-fluid" style="width:100px;">
                                                <button type="button" class="btn btn-primary w-md"
                                                    onclick="delete_image1('{{ $career->uuid }}');"
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
                                    <label for="seo_title"
                                            class="col-sm-3 col-form-label">{{ __('Seo Title') }}
                                            </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        placeholder="Please provide the meta title" value="{{ @old('seo_title',@$career->seo_title) }}"
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
                                                >{{ @old('seo_description',@$career->seo_description) }}</textarea>
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
                                                >{{ @old('seo_keywords',@$career->seo_keywords) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('seo_keywords') }}
                                        </div>
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

   function delete_image(uuid) {
            if (confirm("Are you sure?")) { 
                $.ajax({
                    url: "{{ route('admin.career-opening-settings.image_delete') }}",
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
                    url: "{{ route('admin.career-opening-settings.image_delete1') }}",
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
