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
                                    <label for="description" class="col-sm-3 col-form-label">{{ __('Content') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control  @if ($errors->has('description')) is-invalid @endif" ro
                                            placeholder="{{ __('Enter Description') }}" >{{ @old('description', @$data->description) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="address" class="col-sm-3 col-form-label">{{ __('address') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control  @if ($errors->has('address')) is-invalid @endif" ro
                                            placeholder="{{ __('Enter address') }}" required>{{ @old('address', @$data->address) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('address') }}
                                        </div>
                                    </div>
                                </div>
                               
                              
                                
                                <div class="mb-4 row">
                                    <label for="email"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Email') }}</label>
                                    <div class="col-sm-9">
                                        <input id="email" name="email" type="text"
                                            class="form-control mb-2 @if ($errors->has('email')) is-invalid @endif"
                                            placeholder="{{ __('Enter map link') }}"
                                            value="{{ @old('email', @$data->email) }}">
                                        <div class="invalid-feedback">{{ $errors->first('email') }}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="mb-4 row">
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
                                </div> --}}
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
