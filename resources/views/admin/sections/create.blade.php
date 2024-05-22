@extends('admin.layout.backend')

@section('title') {{ __('Create Section') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Section') }}</h4>
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
                            <form action="{{ route('admin.sections.store') }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Title') }}" required value="{{ @old('title') }}">
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
                                            placeholder="{{ __('Enter Title') }}" required>{{ @old('title') }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="sub_title" class="col-sm-3 col-form-label mb-2">{{ __('Sub Title') }}</label>
                                    <div class="col-sm-9">
                                        <input id="sub_title" name="sub_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('sub_title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter sub title') }}"  value="{{ @old('sub_title') }}">
                                        <div class="invalid-feedback">{{ $errors->first('sub_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="cover_description"
                                            class="col-sm-3 col-form-label">{{ __('Content') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="content"
                                            class="ckeditor form-control @if ($errors->has('content')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter Content Description') }}" >{{ @old('content')}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="cover_description"
                                            class="col-sm-3 col-form-label">{{ __('Extra Content') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="content2"
                                            class="ckeditor form-control @if ($errors->has('content2')) is-invalid @endif"style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter Content') }}" >{{ @old('content2')}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content2') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Image') }}<a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a> <br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                        <input id="image" name="image" type="file" class="form-control mb-2 @if ($errors->has('image')) is-invalid @endif" value="{{ @old('image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br></br>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div>
                                 <div class="mb-4 row">
                                    <label for="alt_text" class="col-sm-3 col-form-label mb-2">{{ __('Alt image text') }}</label>
                                    <div class="col-sm-9">
                                        <input id="alt_text" name="alt_text" type="text"
                                            class="form-control mb-2 @if ($errors->has('alt_text')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Alt text') }}"  value="{{ @old('alt_text') }}">
                                        <div class="invalid-feedback">{{ $errors->first('alt_text') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="b_image">{{ __('Background Image') }}<a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                        <input id="b_image" name="b_image" type="file" class="form-control mb-2 @if ($errors->has('b_image')) is-invalid @endif" value="{{ @old('b_image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br></br>
                                        <div class="invalid-feedback">{{ $errors->first('b_image') }}</div>
                                    </div>
                                </div>
                                 <div class="mb-4 row">
                                    <label for="alt_background" class="col-sm-3 col-form-label mb-2">{{ __('Alt background text') }}</label>
                                    <div class="col-sm-9">
                                        <input id="alt_background" name="alt_background" type="text"
                                            class="form-control mb-2 @if ($errors->has('alt_background')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Alt text') }}"  value="{{ @old('alt_background') }}">
                                        <div class="invalid-feedback">{{ $errors->first('alt_background') }}
                                        </div>
                                    </div>
                                </div>
                                 <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="logo">{{ __('Mobile Image') }}<a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                        <input id="logo" name="logo" type="file" class="form-control mb-2 @if ($errors->has('logo')) is-invalid @endif" value="{{ @old('logo') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br></br>
                                        <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="button_title"
                                            class="col-sm-3 col-form-label">{{ __('Button Title') }}
                                            </label>
                                    <div class="col-sm-9">
                                        <input id="button_title" name="button_title" type="text"
                                        class="form-control mb-2 @if ($errors->has('button_title')) is-invalid  @endif"
                                        placeholder="{{ __('Enter Button Title') }}"  value="{{ @old('button_title') }}">
                                        <div class="invalid-feedback">{{ $errors->first('button_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Link') }}</label>
                                    <div class="col-sm-9">
                                        <input id="link" name="link" type="text"
                                            class="form-control mb-2 @if ($errors->has('link')) is-invalid  @endif"
                                            placeholder="{{ __('Enter link') }}"  value="{{ @old('link') }}">
                                        <div class="invalid-feedback">{{ $errors->first('link') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="logo">{{ __('Order') }}<span
                                        class="text-danger">*</span><a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        <input id="order" required name="order" type="number" class="form-control mb-2 @if ($errors->has('order')) is-invalid @endif" value="{{ @old('order') }}">
                                        <div class="invalid-feedback">{{ $errors->first('order') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="horizontal-firstname-input"
                                        class="col-sm-3 col-form-label">{{ __('Status') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status1"
                                                value="1" @if (!@old('status')) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if (@old('status')) checked @endif>
                                            <label class="form-check-label" for="status2">{{ __('Inactive') }}</label>
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
