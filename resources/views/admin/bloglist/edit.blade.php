@extends('admin.layout.backend')

@section('title')
    {{ __('Edit Slider') }}
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Edit blog') }}</h4>
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
                            <form action="{{ route('admin.blog-list.update', $blog->uuid) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid @endif"
                                            placeholder="{{ __('Enter Title') }}" required
                                            value="{{ @old('title', @$blog->title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mb-4 row">
                                        <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea id="title" name="title"
                                                class="form-control mb-2 summernote @if ($errors->has('title')) is-invalid @endif"
                                                placeholder="{{ __('Enter Title') }}" required>{{ @old('title', @$blog->title) }}</textarea>
                                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                        </div>
                                    </div> -->
                                <div class="mb-4 row">
                                    <label for="canonical_tag"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Canonical Tag') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="canonical_tag" name="canonical_tag" type="text"
                                            class="form-control mb-2 @if ($errors->has('canonical_tag')) is-invalid @endif"
                                            placeholder="{{ __('Enter canonical tag') }}"
                                            value="{{ @old('canonical_tag', @$blog->canonical_tag) }}">
                                        <div class="invalid-feedback">{{ $errors->first('canonical_tag') }}
                                        </div>
                                    </div>
                                </div>
                                  <div class="mb-4 row">
                                    <label for="schema"
                                            class="col-sm-3 col-form-label">{{ __('Schema') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="schema"
                                            class="form-control  @if ($errors->has('schema')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Schema') }}" >{{ @old('schema',@$blog->schema)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('schema') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="author"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Author') }}</label>
                                    <div class="col-sm-9">
                                        <input id="author" name="author" type="text"
                                            class="form-control mb-2 @if ($errors->has('author')) is-invalid @endif"
                                            placeholder="{{ __('Enter author name') }}"
                                            value="{{ @old('author', @$blog->author) }}">
                                        <div class="invalid-feedback">{{ $errors->first('author') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="schedule_date"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Schedule Date') }}</label>
                                    <div class="col-sm-9">
                                        <input id="schedule_date" name="schedule_date" type="date"
                                            class="form-control mb-2 @if ($errors->has('schedule_date')) is-invalid @endif" value="{{ @old('schedule_date', @$blog->blog_date) }}">
                                        <div class="invalid-feedback">{{ $errors->first('schedule_date') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="description" class="col-sm-3 col-form-label">{{ __('Description') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="ckeditor form-control @if ($errors->has('description')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter  Description') }}" required>{{ @old('content', @$blog->description) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Slider Image') }}<span
                                            class="text-danger">*</span> <a href="#"
                                            class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                            @if ($blog->image)
                                                <img src="{{ asset("/storage/".$blog->image) }}" alt=""
                                                    class="img-fluid" style="width:100px;">
                                                <button type="button" class="btn btn-primary w-md"
                                                    onclick="delete_image('{{ $blog->uuid }}');"
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
                                    <label for="horizontal-firstname-input"
                                        class="col-sm-3 col-form-label">{{ __('Status') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status1"
                                                value="1" @if ($blog->status == 1) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if ($blog->status == 0) checked @endif>
                                            <label class="form-check-label" for="status2">{{ __('Inactive') }}</label>
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
                                            value="{{ @old('seo_title', @$blog->seo_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('seo_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_keyword"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Seo Keyword') }}</label>
                                    <div class="col-sm-9">
                                        <input id="seo_keyword" name="seo_keyword" type="text"
                                            class="form-control mb-2 @if ($errors->has('seo_keyword')) is-invalid @endif"
                                            placeholder="{{ __('Enter seo keywords') }}"
                                            value="{{ @old('seo_keyword', @$blog->seo_keywords) }}">
                                        <div class="invalid-feedback">{{ $errors->first('seo_keyword') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_description"
                                        class="col-sm-3 col-form-label">{{ __('Seo Description') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="seo_description" class="form-control @if ($errors->has('seo_description')) is-invalid @endif"
                                            placeholder="{{ __('Enter seo description') }}">{{ @old('seo_description', @$blog->seo_description) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('seo_description') }}
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script>
         $(document).ready(function () {
            $('.ckeditor').ckeditor({
                enterMode: CKEDITOR.ENTER_BR,
                autoParagraph: false
            });
    });

        function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.blog-list.image_delete') }}",
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
