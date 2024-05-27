@extends('admin.layout.backend')

@section('title') {{ __('Create Request Rate Settings') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Request Rate Settings') }}</h4>
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
                            <form action="{{ route('admin.request.settings.store') }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="cover_title" class="col-sm-3 col-form-label mb-2">{{ __('Cover Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="cover_title" name="cover_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('cover_title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Cover Title') }}" required value="{{ @old('cover_title',@$data->cover_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('cover_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="cover_content"
                                            class="col-sm-3 col-form-label">{{ __('Cover Content') }}
                                            <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="cover_content"
                                            class="form-control summernote @if ($errors->has('cover_content')) is-invalid @endif" ro placeholder="{{ __('Enter Description') }}" required>{{ @old('cover_content',@$data->cover_content)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('cover_content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="cover_image">{{ __('Cover Image') }}<span
                                        class="text-danger">*</span> <a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9">
                                        @if (isset($data->cover_image))
                                            <img src="{{ asset("/storage/".@$data->cover_image) }}" alt="" class="img-fluid" style="width:100px;">
                                        @endif
                                        <input id="cover_image" name="cover_image" type="file" class="form-control mb-2 @if ($errors->has('cover_image')) is-invalid @endif" value="{{ @old('cover_image') }}">
                                        <div class="invalid-feedback">{{ $errors->first('cover_image') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Link') }}</label>
                                    <div class="col-sm-9">
                                        <input id="link" name="link" type="text"
                                            class="form-control mb-2 @if ($errors->has('link')) is-invalid  @endif"
                                            placeholder="{{ __('Enter link') }}"  value="{{ @old('link',@$data->link) }}">
                                        <div class="invalid-feedback">{{ $errors->first('link') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_title"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Seo Title') }}</label>
                                    <div class="col-sm-9">
                                        <input id="seo_title" name="seo_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('seo_title')) is-invalid @endif"
                                            placeholder="{{ __('Enter seo title') }}" value="{{ @old('seo_title') }}">
                                        <div class="invalid-feedback">{{ $errors->first('seo_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_keyword"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Seo keyword') }}</label>
                                    <div class="col-sm-9">
                                        <input id="seo_keyword" name="seo_keyword" type="text"
                                            class="form-control mb-2 @if ($errors->has('seo_keyword')) is-invalid @endif"
                                            placeholder="{{ __('Enter seo keyword') }}"
                                            value="{{ @old('seo_keyword') }}">
                                        <div class="invalid-feedback">{{ $errors->first('seo_keyword') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_description"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Seo Description') }}</label>
                                    <div class="col-sm-9">
                                        <textarea id="seo_description" name="seo_description" type="text"
                                            class="form-control mb-2 @if ($errors->has('seo-description	')) is-invalid @endif"
                                            placeholder="{{ __('Enter Seo Description') }}">{{ @old('seo_description') }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('seo_description	') }}
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
</script>
@endsection
