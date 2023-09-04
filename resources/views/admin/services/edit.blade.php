@extends('admin.layout.backend')

@section('title') {{ __('Edit Service') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Edit Service') }}</h4>
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
                            <form action="{{ route('admin.services.update', $services->uuid) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="name" class="col-sm-3 col-form-label mb-2">{{ __('Name') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="name" name="name" type="text"
                                            class="form-control mb-2 @if ($errors->has('name')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Name') }}" required value="{{ @old('name',@$services->name) }}">
                                        <div class="invalid-feedback">{{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="cover_description"
                                            class="col-sm-3 col-form-label">{{ __('Cover Description') }}
                                            <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="cover_description"
                                            class="form-control @if ($errors->has('cover_description')) is-invalid @endif" ro placeholder="{{ __('Enter Cover Description Description') }}">{{ @old('cover_description',@$services->cover_description)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('cover_description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Cover Image') }} <span
                                        class="text-danger">*</span><a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9"> 
                                        @if (isset($services->cover_image))
                                            <img src="{{ asset('storage/'.$services->cover_image) }}" alt="" class="img-fluid" style="width:250px;">
                                        @endif
                                        <input id="image" name="image" type="file" class="form-control mb-2 @if ($errors->has('image')) is-invalid @endif" value="{{ @old('image') }}">
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div>
                                 <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Logo') }} <span
                                        class="text-danger">*</span><a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9"> 
                                        @if (isset($services->logo))
                                            <img src="{{ asset('storage/'.$services->logo) }}" alt="" class="img-fluid" style="width:250px;">
                                        @endif
                                        <input id="logo" name="logo" type="file" class="form-control mb-2 @if ($errors->has('logo')) is-invalid @endif" value="{{ @old('logo') }}">
                                        <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
                                    </div>
                                </div>
                                 <div class="mb-4 row">
                                    <label for="alt_text" class="col-sm-3 col-form-label mb-2">{{ __('Alt text') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="alt_text" name="alt_text" type="text"
                                            class="form-control mb-2 @if ($errors->has('alt_text')) is-invalid  @endif"
                                            placeholder="{{ __('Enter alt text') }}" required value="{{ @old('alt_text',@$services->alt_text) }}">
                                        <div class="invalid-feedback">{{ $errors->first('alt_text') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Title') }}" required value="{{ @old('title',@$services->title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="description"
                                            class="col-sm-3 col-form-label">{{ __('Description') }}
                                            <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="description"
                                            class="form-control @if ($errors->has('description')) is-invalid @endif" ro placeholder="{{ __('Enter Description') }}" required>{{ @old('description',@$services->description)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('description') }}
                                        </div>
                                    </div>
                                </div> 
                                <div class="mb-4 row">
                                    <label for="custom_url" class="col-sm-3 col-form-label mb-2">{{ __('Custom Url') }}</label>
                                    <div class="col-sm-9">
                                        <input id="custom_url" name="custom_url" type="text"
                                            class="form-control mb-2 @if ($errors->has('custom_url')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Url') }}"  value="{{ @old('custom_url',$services->custom_url) }}">
                                        <div class="invalid-feedback">{{ $errors->first('custom_url') }}
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
                                                value="1" @if ($services->status == 1) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if ($services->status == 0) checked @endif>
                                            <label class="form-check-label" for="status2">{{ __('Inactive') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="seo_title"
                                            class="col-sm-3 col-form-label">{{ __('Seo Title') }}
                                            </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        placeholder="Please provide the meta title" value="{{ @old('seo_title',@$services->seo_title) }}"
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
                                                >{{ @old('seo_description',@$services->seo_description) }}</textarea>
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
                                                >{{ @old('seo_keywords',@$services->seo_keywords) }}</textarea>
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
</script>
@endsection
