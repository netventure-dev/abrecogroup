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
                <h4 class="mb-sm-0 font-size-18">{{ __('Edit Abreco Value List') }}</h4>
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
                            <form action="{{ route('admin.life-value-list.update', $milestone->uuid) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid @endif"
                                            placeholder="{{ __('Enter Title') }}" required
                                            value="{{ old('title', $milestone->title ?? '') }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="content" class="col-sm-3 col-form-label">{{ __('content') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea name="content"
                                            class="ckeditor form-control  @if ($errors->has('content')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter Content Description') }}"
                                            required>{{ old('content', $milestone->content ?? '') }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}</div>
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
            var $editor = $(this);

            // Remove <p> tags
            $editor.find('p').each(function() {
                var $this = $(this);
                $this.replaceWith($this.html());
            });

            // Remove <span> tags
            $editor.find('span').each(function() {
                var $this = $(this);
                $this.replaceWith($this.html());
            });
        });
    </script>
@endsection
