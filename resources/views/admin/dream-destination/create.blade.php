@extends('admin.layout.backend')

@section('title') {{ __('Create Dream Destination') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Dream Destination') }}</h4>
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
                            <form action="{{ route('admin.dream.store') }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea id="title" name="title"
                                            class="form-control mb-2  @if ($errors->has('title')) is-invalid @endif"
                                            placeholder="{{ __('Enter Title') }}" required>{{ @old('title', @$data->title) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="quote" class="col-sm-3 col-form-label mb-2">{{ __('Quote') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea id="quote" name="quote"
                                            class="form-control mb-2  @if ($errors->has('quote')) is-invalid @endif"
                                            placeholder="{{ __('Enter Quote') }}" >{{ @old('quote', @$data->quote) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('quote') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Image') }} <span
                                            class="text-danger"></span>
                                        <a href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a><br>
                                        <small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small>
                                    </label>
                                    <div class="col-sm-9">
                                        <input id="image" name="image" type="file"
                                            class="form-control mb-2 @if ($errors->has('image')) is-invalid @endif"
                                            value="{{ old('image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br></br>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>

                                        @if (isset($data->image))
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $data->image) }}" alt="Current Image"
                                                    style="max-width: 200px;">
                                                <p>Current Image</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="content" class="col-sm-3 col-form-label mb-2">{{ __('Content') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea id="content" name="content"
                                        class="form-control mb-2  @if ($errors->has('content')) is-invalid @endif"
                                        placeholder="{{ __('Enter Content') }}" required>{{ @old('content', @$data->content) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="author" class="col-sm-3 col-form-label mb-2">{{ __('Author') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea id="author" name="author"
                                        class="form-control mb-2  @if ($errors->has('author')) is-invalid @endif"
                                        placeholder="{{ __('Enter Author') }}" required>{{ @old('author', @$data->author) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('author') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="position" class="col-sm-3 col-form-label mb-2">{{ __('Position') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea id="position" name="position"
                                        class="form-control mb-2  @if ($errors->has('position')) is-invalid @endif"
                                        placeholder="{{ __('Enter Position') }}" required>{{ @old('position', @$data->position) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('position') }}
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
    </script>
@endsection
