@extends('admin.layout.backend')

@section('title') {{ __('Edit Inner Service') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Edit Inner Service') }}</h4>
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
                            <form action="{{ route('admin.inner-services.update', $innerservice->uuid) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="name" class="col-sm-3 col-form-label mb-2">{{ __('Services') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="sub_service_id">
                                            <option selected value="">--Select Service--</option>
                                            @foreach ($subservices as $service)
                                                <option @if($service->uuid == $innerservice->sub_service_id) selected @endif value="{{$service->uuid}}">{{$service->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                 <div class="mb-4 row">
                                    <label for="name" class="col-sm-3 col-form-label mb-2">{{ __('Name') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="name" name="name" type="text"
                                            class="form-control mb-2 @if ($errors->has('name')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Name') }}" required value="{{ @old('name',@$innerservice->name) }}">
                                        <div class="invalid-feedback">{{ $errors->first('name') }}
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mb-4 row">
                                    <label for="name" class="col-sm-3 col-form-label mb-2">{{ __('Name') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea id="name" name="name" class="form-control mb-2 summernote @if ($errors->has('name')) is-invalid @endif" placeholder="{{ __('Enter Name') }}" required>{{ @old('name', @$innerservice->name) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    </div>
                                </div> -->
                                <div class="mb-4 row">
                                    <label for="cover_description"
                                            class="col-sm-3 col-form-label">{{ __('Cover Description') }}
                                            <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="cover_description"
                                            class="ckeditor form-control @if ($errors->has('cover_description')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Cover Description Description') }}" required>{{ @old('cover_description',@$innerservice->cover_description)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('cover_description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Cover Image') }} <span
                                        class="text-danger">*</span><a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                        @if ($innerservice->cover_image)
                                            <img src="{{ asset('storage/'.$innerservice->cover_image) }}" alt="" class="img-fluid" style="width:250px;">
                                            <button type="button" class="btn btn-primary w-md" onclick="delete_image('{{ $innerservice->uuid }}');"
                                            class="close">Delete</button>
                                        @endif
                                        <input id="image" name="image" type="file" class="form-control mb-2 @if ($errors->has('image')) is-invalid @endif" value="{{ @old('image') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br></br>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div>
                                 <div class="mb-4 row">
                                    <label for="alt_text" class="col-sm-3 col-form-label mb-2">{{ __('Alt text') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="alt_text" name="alt_text" type="text"
                                            class="form-control mb-2 @if ($errors->has('alt_text')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Alt text') }}"  value="{{ @old('alt_text',@$innerservice->alt_text) }}">
                                        <div class="invalid-feedback">{{ $errors->first('alt_text') }}
                                        </div>
                                    </div>
                                </div>
                                 <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Logo') }} <span
                                        class="text-danger">*</span><a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                        @if ($innerservice->logo)
                                            <img src="{{ asset('storage/'.$innerservice->logo) }}" alt="" class="img-fluid" style="width:250px;">
                                            <button type="button" class="btn btn-primary w-md" onclick="delete_image1('{{ $innerservice->uuid }}');"
                                            class="close">Delete</button>
                                        @endif
                                        <input id="logo" name="logo" type="file" class="form-control mb-2 @if ($errors->has('logo')) is-invalid @endif" value="{{ @old('logo') }}">
                                        <small>(The image must not be greater than 2 MB)</small><br></br>
                                        <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Title') }}" required value="{{ @old('title',@$innerservice->title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea id="title" name="title" class="form-control mb-2 summernote @if ($errors->has('title')) is-invalid  @endif" placeholder="{{ __('Enter Title') }}" required>{{ @old('title', @$innerservice->title) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                    </div>
                                </div> -->
                                <div class="mb-4 row">
                                    <label for="canonical_tag" class="col-sm-3 col-form-label mb-2">{{ __('Canonical Tag') }}<span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <input id="canonical_tag" name="canonical_tag" type="text"
                                            class="form-control mb-2 @if ($errors->has('canonical_tag')) is-invalid  @endif"
                                            placeholder="{{ __('Enter canonical tag') }}"  value="{{ @old('canonical_tag',@$innerservice->canonical_tag) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="schema"
                                            class="col-sm-3 col-form-label">{{ __('Schema') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="schema"
                                            class="form-control  @if ($errors->has('schema')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Schema') }}">{{ @old('schema',@$innerservice->schema)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('schema') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="description"
                                            class="col-sm-3 col-form-label">{{ __('Description') }}
                                            <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="description"
                                            class="ckeditor form-control @if ($errors->has('description')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Description') }}" required>{{ @old('description',@$innerservice->description)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="custom_url" class="col-sm-3 col-form-label mb-2">{{ __('Custom Url') }}</label>
                                    <div class="col-sm-9">
                                        <input id="custom_url" name="custom_url" type="text"
                                            class="form-control mb-2 @if ($errors->has('custom_url')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Url') }}"  value="{{ @old('custom_url',$innerservice->custom_url) }}">
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
                                                value="1" @if ($innerservice->status == 1) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if ($innerservice->status == 0) checked @endif>
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
                                        placeholder="Please provide the meta title" value="{{ @old('seo_title',@$innerservice->seo_title) }}"
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
                                                >{{ @old('seo_description',@$innerservice->seo_description) }}</textarea>
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
                                                >{{ @old('seo_keywords',@$innerservice->seo_keywords) }}</textarea>
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });

   function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.inner-services.image_delete') }}",
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
                    url: "{{ route('admin.inner-services.image_delete1') }}",
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
