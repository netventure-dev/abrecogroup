@extends('admin.layout.backend')

@section('title')
    {{ __('Edit Demo Industry Content') }}
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Edit Demo Industry Content') }}</h4>
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
                            <form
                                action="{{ route('admin.demo_industries.content.update', ['id' => @$services->uuid, 'uuid' => @$content->uuid]) }}"
                                method="post" class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Title') }}" required value="{{ @old('title',@$content->title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div> 
                                <div class="mb-4 row">
                                    <label for="sub_title" class="col-sm-3 col-form-label mb-2">{{ __('Sub Title') }}</label>
                                    <div class="col-sm-9">
                                        <input id="sub_title" name="sub_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('sub_title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter sub title') }}"  value="{{ @old('sub_title',@$content->subtitle) }}">
                                        <div class="invalid-feedback">{{ $errors->first('sub_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="description"
                                            class="col-sm-3 col-form-label">{{ __('Description') }}
                                            <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="description"
                                            class="form-control @if ($errors->has('description')) is-invalid @endif" placeholder="{{ __('Enter Description') }}" required>{{ @old('description',@$content->description)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="content"
                                            class="col-sm-3 col-form-label">{{ __('Content') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="content"
                                            class="form-control @if ($errors->has('content')) is-invalid @endif" placeholder="{{ __('Enter Content Description') }}" >{{ @old('content',@$content->content)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Image') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9"> 
                                        @if (isset($content->image))
                                            <img src="{{ asset('storage/'.$content->image) }}" alt="" class="img-fluid" style="width:250px;">
                                        @endif
                                        <input id="image" name="image" type="file" class="form-control mb-2 @if ($errors->has('*//')) is-invalid @endif" value="{{ @old('image') }}">
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="mobile_image">{{ __('Mobile Image') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9"> 
                                        @if (isset($content->mobile_image))
                                            <img src="{{ asset('storage/'.$content->mobile_image) }}" alt="" class="img-fluid" style="width:250px;">
                                        @endif
                                        <input id="mobile_image" name="mobile_image" type="file" class="form-control mb-2 @if ($errors->has('mobile_image')) is-invalid @endif" value="{{ @old('mobile_image') }}">
                                        <div class="invalid-feedback">{{ $errors->first('mobile_image') }}</div>
                                    </div>
                                </div>  
                                <div class="mb-4 row">
                                    <label for="button_title"
                                            class="col-sm-3 col-form-label">{{ __('Button Title') }}
                                            </label>
                                    <div class="col-sm-9">
                                        <input id="button_title" name="button_title" type="text"
                                        class="form-control mb-2 @if ($errors->has('button_title')) is-invalid  @endif"
                                        placeholder="{{ __('Enter Button Title') }}"  value="{{ @old('button_title',@$content->button_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('button_title') }}
                                        </div>
                                    </div>
                                </div> 
                                <div class="mb-4 row">
                                    <label for="link" class="col-sm-3 col-form-label mb-2">{{ __('Link') }}</label>
                                    <div class="col-sm-9">
                                        <input id="link" name="link" type="text"
                                            class="form-control mb-2 @if ($errors->has('link')) is-invalid  @endif"
                                            placeholder="{{ __('Enter link') }}"  value="{{ @old('link',@$content->link) }}">
                                        <div class="invalid-feedback">{{ $errors->first('link') }}
                                        </div>
                                    </div>
                                </div>    
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="logo">{{ __('Order') }}<span
                                        class="text-danger">*</span><a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a></label>
                                    <div class="col-sm-9"> 
                                        <input id="order" required name="order" type="number" class="form-control mb-2 @if ($errors->has('order')) is-invalid @endif" value="{{ @old('order',@$content->order) }}">
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
                                                value="1" @if ($content->status == 1) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if ($content->status == 0) checked @endif>
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

    <script>
         $(document).ready(function() { 
           $('.summernote').summernote('fontName', 'Poppins');
   });

        $(".duplicate").click(function() {
            $("#target").clone().appendTo("#destination");
            $('.deleteButtonClass').removeClass('d-none');
        });

        $(".deleteButtonClass").click(function() {
            $('#destination').remove();
        });
    </script>
@endsection
