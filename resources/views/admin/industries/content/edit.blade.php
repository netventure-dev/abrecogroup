@extends('admin.layout.backend')

@section('title')
    {{ __('Edit Industry Content') }}
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Edit Industry Content') }}</h4>
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
                                action="{{ route('admin.industries.content.update', ['id' => @$industries->uuid, 'uuid' => @$content->uuid]) }}"
                                method="post" class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}</label>
                                    <div class="col-sm-9">

                                        <textarea name="title" class="form-control @if ($errors->has('title')) is-invalid @endif" ro
                                            placeholder="{{ __('Enter title') }}" required>{{ @old('title', @$content->title) }}</textarea>
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
                                    <label for="cover_description"
                                            class="col-sm-3 col-form-label">{{ __('Content') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="content"
                                            class="ckeditor form-control @if ($errors->has('content')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" placeholder="{{ __('Enter Content Description') }}" >{{ @old('content',@$content->content)}}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="description" class="col-sm-3 col-form-label">{{ __('Description') }}</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="ckeditor form-control  @if ($errors->has('description')) is-invalid @endif" style="width: 100% !important; height: 200px !important;" ro
                                            placeholder="{{ __('Enter Description') }}">{{ @old('description', @$content->description) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('description') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="order" class="col-sm-3 col-form-label mb-2">{{ __('Order') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="order" name="order" type="number" min="1" max="15"
                                            class="form-control mb-2 @if ($errors->has('order')) is-invalid @endif"
                                            placeholder="{{ __('Enter order') }}" required
                                            value="{{ @old('order', @$content->order) }}">
                                        <div class="invalid-feedback">{{ $errors->first('order') }}
                                        </div>
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
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="image">{{ __('Cover Image') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                        @if ($content->image)
                                            <img src="{{ asset('storage/' . $content->image) }}" alt=""
                                                class="img-fluid" style="width:250px;">
                                                <button type="button" class="btn btn-primary w-md" onclick="delete_image('{{$content->uuid }}');"
                                                    class="close">Delete</button>
                                        @endif
                                        <input id="image" name="image" type="file"
                                            class="form-control mb-2 @if ($errors->has('image')) is-invalid @endif"
                                            value="{{ @old('image') }}"><small>(The image must not be greater than 2 MB)</small><br>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                </div>
                                <div class="mt-4 row">
                                    <label class="col-sm-3 col-form-label" for="mobile_image">{{ __('Mobile Image') }} <a
                                            href="#" class="tool_tip js-tooltip-enabled"
                                            data-toggle="tooltip"></a><br><small>("Accepted formats: JPG, JPEG, PNG, and WEBP only.")</small></label>
                                    <div class="col-sm-9">
                                        @if ($content->mobile_image)
                                            <img src="{{ asset('storage/' . $content->mobile_image) }}" alt=""
                                                class="img-fluid" style="width:250px;">
                                                <button type="button" class="btn btn-primary w-md" onclick="delete_image1('{{$content->uuid }}');"
                                                    class="close">Delete</button>
                                        @endif
                                        <input id="mobile_image" name="mobile_image" type="file"
                                            class="form-control mb-2 @if ($errors->has('mobile_image')) is-invalid @endif"
                                            value="{{ @old('mobile_image') }}">   <small>(The image must not be greater than 2 MB)</small><br>
                                        <div class="invalid-feedback">{{ $errors->first('mobile_image') }}</div>
                                    </div>
                                </div>
                                {{-- <div class="mb-4 row">
                                    <label for="image_position"
                                        class="col-sm-3 col-form-label mb-2">{{ __('Image Position') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select id="image_position" name="image_position"
                                            class="form-control mb-2 @if ($errors->has('image_position')) is-invalid @endif"
                                            placeholder="{{ __('Enter image_position') }}" required>
                                            <option value="">Select Position</option>
                                            <option @if (@$content->image_position == '1') selected @endif value="1">Center
                                            </option>
                                            <option @if (@$content->image_position == '2') selected @endif value="2">Left
                                            </option>
                                            <option @if (@$content->image_position == '3') selected @endif value="3">Right
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('image_position') }}
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="mb-4 row">
                                    <label for="button_title" class="col-sm-3 col-form-label">{{ __('Button Title') }}
                                    </label>
                                    <div class="col-sm-9">
                                        <input id="button_title" name="button_title" type="text"
                                            class="form-control mb-2 @if ($errors->has('button_title')) is-invalid @endif"
                                            placeholder="{{ __('Enter Button Title') }}"
                                            value="{{ @old('button_title', @$content->button_title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('button_title') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="button_link" class="col-sm-3 col-form-label">{{ __('Button Link') }}
                                    </label>
                                    <div class="col-sm-9">
                                        <input id="button_link" name="button_link" type="text"
                                            class="form-control mb-2 @if ($errors->has('button_link')) is-invalid @endif"
                                            placeholder="{{ __('Enter Button Link') }}"
                                            value="{{ @old('button_link', @$content->button_link) }}">
                                        <div class="invalid-feedback">{{ $errors->first('button_link') }}
                                        </div>
                                    </div>
                                </div>
                                {{-- @if (@$content->order == 1)
                                    @if (@$content_list)
                                        @foreach ($content_list as $list)
                                            <div class="mb-4 row textboxClass" id="target">
                                                <label for="list" class="col-sm-3 col-form-label">{{ __('List') }}
                                                </label>
                                                <div class="col-sm-7">
                                                    <input id="list" name="list[]" type="text"
                                                        class="form-control mb-2 @if ($errors->has('list')) is-invalid @endif"
                                                        placeholder="{{ __('Enter List Data') }}"
                                                        value="{{ @old('list', @$list->data) }}">
                                                    <div class="invalid-feedback">{{ $errors->first('list') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="col-sm-2">
                                        <button type="button" id='duplicate' class="duplicate btn btn-success">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="mb-4 row textboxClass" id="target">
                                        <label for="list" class="col-sm-3 col-form-label">{{ __('List') }}
                                        </label>
                                        <div class="col-sm-7">
                                            <input id="list" name="list[]" type="text"
                                                class="form-control mb-2 @if ($errors->has('list')) is-invalid @endif"
                                                placeholder="{{ __('Enter List Data') }}"
                                                value="{{ @old('list', @$content->list) }}">
                                            <div class="invalid-feedback">{{ $errors->first('list') }}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-4 row" id='destination'>
                                        <div class="col-sm-2">
                                            <button type="button" class="deleteButtonClass btn btn-danger d-none">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif --}}
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
        $('.ckeditor').ckeditor();
    });

   function delete_image(uuid) {

            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.industries.content.image_delete') }}",
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
                    url: "{{ route('admin.industries.content.image_delete1') }}",
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
