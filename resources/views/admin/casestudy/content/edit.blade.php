@extends('admin.layout.backend')

@section('title') {{ __('Edit Case Study Contents') }} @endsection
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Edit Case Study Contents') }}</h4>
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
                            <form action="{{ route('admin.casestudies.contents.update',['id' => @$casestudy->uuid, 'uuid' => @$content->uuid]) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
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
                                <div class="mb-4 row" style="display:none;">
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
                                    <label for="cover_description"
                                            class="col-sm-3 col-form-label">{{ __('Content') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="content"
                                            class="ckeditor form-control @if ($errors->has('content')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter Content Description') }}" >{{ @old('content',@$content->content)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Image') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small></label>
                                    <div class="col-sm-9"> 
                                        @if ($content->image1)
                                            <img src="{{ asset('storage/'.$content->image1) }}" alt="" class="img-fluid" style="width:250px;">
                                            <button type="button" class="btn btn-primary w-md" onclick="delete_image('{{ $content->uuid }}');"
                                            class="close">Delete</button>
                                            @endif
                                        <input id="image" name="image" type="file" class="form-control mb-2 @if ($errors->has('*//')) is-invalid @endif" value="{{ @old('image') }}">
                                           <small>(The image must not be greater than 2 MB)</small><br></br><div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div>
                                  <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="mobile_image">{{ __('Mobile Image') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled" data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and
                                            WEBP only.")</small></label>
                                    <div class="col-sm-9"> 
                                        @if ($content->mobile_image)
                                            <img src="{{ asset('storage/'.$content->mobile_image) }}" alt="" class="img-fluid" style="width:250px;">
                                            <button type="button" class="btn btn-primary w-md" onclick="delete_image1('{{ $content->uuid }}');"
                                            class="close">Delete</button>
                                            @endif
                                        <input id="mobile_image" name="mobile_image" type="file" class="form-control mb-2 @if ($errors->has('*//')) is-invalid @endif" value="{{ @old('mobile_image') }}">
                                          <small>(The image must not be greater than 2 MB)</small><br></br> <div class="invalid-feedback">{{ $errors->first('mobile_image') }}</div>
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
                                    <label for="order" class="col-sm-3 col-form-label mb-2">{{ __('Section') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="section" class="form-control" required>
                                            <option value="">Choose a Section</option>
                                            <option @if($content->section === "type1") selected @endif value="type1">Banner with background</option>
                                            <option @if($content->section === "type2") selected @endif value="type2">Overview</option>
                                            <option @if($content->section === "type3") selected @endif value="type3">Left side content and right side image</option>
                                            <option @if($content->section === "type4") selected @endif value="type4">Left side image and right side content</option>
                                            <option @if($content->section === "type5") selected @endif value="type5">Full width section</option>
                                            <option @if($content->section === "type6") selected @endif value="type6">Full width icon box slider</option>
                                            <option @if($content->section === "type7") selected @endif value="type7">Content with icon box slider</option>

                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('order') }}
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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
   });
   $('#service').on('change', function() {
            var service = this.value;
            $("#sub_service").html('');
            $.ajax({
                url: "{{ route('admin.casestudies.change_service') }}",
                type: "GET",
                data: {
                    service: service,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    // console.log(result)
                    $('#sub_service').html(
                        '<option value="">Select Sub Service</option>');
                    $.each(result, function(key, value) {
                        $("#sub_service").append('<option value="' + value
                            .uuid + '">' + value.name + '</option>');
                    });
                    // $('#city-dd').html('<option value="">City</option>');
                }
            });
        });
        $('#sub_service').on('change', function() {
            var subservice = this.value;
            $("#inner_service").html('');
            $.ajax({
                url: "{{ route('admin.casestudies.change_subservice') }}",
                type: "GET",
                data: {
                    subservice: subservice,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    // console.log(result)
                     
                        $('#inner_service').html(
                        '<option value="">Select Inner Service</option>');
                        $.each(result, function(key, value) {
                            $("#inner_service").append('<option value="' + value
                                .uuid + '">' + value.name + '</option>');
                        });
                    
                   
                    // $('#city-dd').html('<option value="">City</option>');
                }
            });
        });
        function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.case-study-contents.image_delete') }}",
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
                    url: "{{ route('admin.case-study-contents.image_delete_one') }}",
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
