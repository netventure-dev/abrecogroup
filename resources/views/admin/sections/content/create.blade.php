@extends('admin.layout.backend')

@section('title') {{ __('Create Section Content') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Section Content') }}</h4>
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
                            <form action="{{ route('admin.sections.content.store',@$section->uuid) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="description"
                                            class="col-sm-3 col-form-label">{{ __('Icon Content') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea required name="content"
                                            class="ckeditor form-control @if ($errors->has('content')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter content') }}">{{ @old('content')}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="icon">{{ __('Icon') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9"> 
                                        <input id="icon" name="icon" type="file" class="form-control mb-2 @if ($errors->has('icon')) is-invalid @endif" value="{{ @old('image') }}">
                                        <div class="invalid-feedback">{{ $errors->first('icon') }}</div>
                                    </div>
                                </div>
                                 <div class="mb-4 row">
                                    <label for="alt_text" class="col-sm-3 col-form-label mb-2">{{ __('Alt text') }}</label>
                                    <div class="col-sm-9">                                        
                                            <textarea name="alt_text" class="form-control @if ($errors->has('alt_text')) is-invalid @endif" ro
                                                placeholder="{{ __('Enter Alt text') }}" >{{ @old('alt_text') }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('alt_text') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}</label>
                                    <div class="col-sm-9">                                        
                                            <textarea name="title" class="form-control @if ($errors->has('title')) is-invalid @endif" ro
                                                placeholder="{{ __('Enter title') }}" >{{ @old('title') }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="order" class="col-sm-3 col-form-label mb-2">{{ __('Order') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="order" name="order" type="number" min="1" max="15"
                                            class="form-control mb-2 @if ($errors->has('order')) is-invalid  @endif"
                                            placeholder="{{ __('Enter order') }}" required value="{{ @old('order') }}">
                                        <div class="invalid-feedback">{{ $errors->first('order') }}
                                        </div>
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
                                    <label for="button_link"
                                            class="col-sm-3 col-form-label">{{ __('Button Link') }}
                                           </label>
                                    <div class="col-sm-9">
                                        <input id="button_link" name="button_link" type="text"
                                        class="form-control mb-2 @if ($errors->has('button_link')) is-invalid  @endif"
                                        placeholder="{{ __('Enter Button Link') }}"  value="{{ @old('button_link') }}">
                                        <div class="invalid-feedback">{{ $errors->first('button_link') }}
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
