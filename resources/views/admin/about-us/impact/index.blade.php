@extends('admin.layout.backend')

@section('title')
    {{ __('Create Our Impact') }}
@endsection
@section('css')
<style>
        #successme {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            width: 300px;
            border: 1px solid #28a745;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
        }

        #successme .close {
            position: absolute;
            top: 0;
            right: 5px;
            color: inherit;
            opacity: 0.5;
        }

        #successme .close:hover {
            opacity: 1;
        }

        #st_messagem {
            padding: 10px;
            margin: 0;
        }
    </style>
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
                <h4 class="mb-sm-0 font-size-18">{{ __('Create Our Impact') }}</h4>
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
                            <form action="{{ route('admin.impact.settings.store') }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                              
                                <div class="mb-4 row">
                            <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Impact Title') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input id="title" name="title" type="text" class="form-control mb-2 @if ($errors->has('title')) is-invalid @endif" placeholder="{{ __('Enter Mission Title') }}"  value="{{@old('title', @$data->title) }}" required>
                                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            </div>
                        </div>
                               
                                <div class="mb-4 row">
                                    <label for="content" class="col-sm-3 col-form-label">{{ __('Content') }}
                                        <span class="text-danger"></span></label>
                                    <div class="col-sm-9">
                                        <textarea name="content" class="form-control summernote  @if ($errors->has('content')) is-invalid @endif"
                                            style="width: 100% !important; height: 200px !important;" ro placeholder="{{ __('Enter Content') }}" >{{ @old('content', @$data->content) }}</textarea>
                                        <div class="invalid-feedback">{{ $errors->first('content') }}
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 row">
                        <div class="col-lg-12">
                            <div class="block-content">
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <p class="mb-0">{{ session('error') }}</p>
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <p class="mb-0">{{ session('success') }}</p>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div id="error-box">
                                        <!-- Display errors here -->
                                    </div>
                                @endif
                                <div class="alert alert-success alert-dismissable d-none" id='successm' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <p class="mb-0" id='st_message'></p>
                                </div>

                                <div class="container">
                                    <div class="form-group row">
                                        <div class="col-md-12 @error('name') is-invalid @enderror">
                                            <form method="post" action="" enctype="multipart/form-data"
                                                class="dropzone" id="dropzone">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success alert-dismissable d-none" id="successme" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <p class="mb-0" id="st_messagem"></p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter" id='myTable'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order</th>
                                    <th>Image</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($life as $data)
                                    <tr>
                                        <td width='250px'>{{$loop->iteration}}</td>
                                        <td width='250px'><input type='number'   id='text-{{ $data->id }}' data-id='{{ $data->id }}' class='form-control order' value='{{$data->order}}' name='order'></td>
                                        <td><img src="{{ asset('storage/' . $data->image) }}" width="150px">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="event.preventDefault(); if(confirm('Are you sure to delete this image?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <form id="delete-data-{{ $data->id }}"
                                                action="{{ route('admin.impact.image.destroy', [$data->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                           

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end administrator create form -->
@endsection

@section('script')
    <!-- Plugins js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>

    <script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote('fontName', 'Poppins');
        });

        function delete_image(uuid) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: "{{ route('admin.about-us.settings.image_delete') }}",
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
     <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable({
                "pageLength": 25
            });
        });

        function throttle(f, delay) {
            var timer = null;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = window.setTimeout(function() {
                        f.apply(context, args);
                    },
                    delay || 500);
            };
        }


         // Initialize Dropzone on an element with the dropzone ID
         var myDropzone = new Dropzone("#dropzone", {
            url: "{{ route('admin.impact.image.store') }}", // Specify the URL for handling file uploads
            maxFilesize: 10,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.svg",
            addRemoveLinks: true,
            timeout: 60000,
            success: function(file, response) {
                $('#successm').removeClass('d-none');
                $("#st_message").html("<p> Images were uploaded!</p>");
                window.setTimeout(function() {
                    location.reload()
                }, 3000)
            },
            error: function(file, response) {
                return false;
            }
        });

        $('input').keyup(throttle(function() {
            var data = $(this).val();
            if (data) {
                $(this).css('border-color', '#d4dae3');
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.impact.image.order') }}",
                    data: {
                        data: data,
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status == '1') {
                            $('#successme').removeClass('d-none');
                            $("#st_messagem").html("<p> " + data.message + "</p>");
                            window.setTimeout(function() {
                                $('#successme').addClass('d-none');
                            }, 1000)
                        }
                    }
                });
            } else {
                $(this).css('border-color', 'red');
            }

        }));
    </script>
@endsection
