@extends('admin.layout.backend')

@section('title')
    {{ __('Schema') }}
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    @component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title')
        @endslot
    @endcomponent
    <!-- start page title -->
    {{-- <div class="row"> --}}

    <div class="row">
        <div class="col-12">
            <h3>Schema</h3>
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="mb-sm-0 font-size-18">{{ __('Schema') }}</h4> --}}
                    <!-- <form action="{{ route('admin.schema.store') }}" method="POST">
                        @csrf
                        <div class="row flex-column flex-md-row">
                            <div class="col">
                                <input type="text" class="form-control my-1" id="slug" name="slug"
                                    placeholder="Please provide the slug" value="{{ @old('slug') }}">

                            </div>
                            <div class="col">
                                <input type="text" class="form-control my-1" id="title" name="title"
                                    placeholder="Please provide the title" value="{{ @old('title') }}">

                            </div>
                            <div class="col">
                                <textarea class="form-control my-1" id="description" name="description" rows="2"
                                    placeholder="Please provide description">{{ @old('description') }}</textarea>

                            </div>
                            <div class="col">
                                <button class="btn btn-primary w-100 my-1">Submit</button>
                            </div>
                        </div>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    <!-- end page title -->

    <!-- start data table -->

    <div class="row">
        <div class="col-md-12">
           
            <p id="msgbx" style="
        text-align: right;
        color: green;
    "></p>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- {{ $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap w-100'], false) }} --}}
                    <table class="table table-bordered table-striped yajra-datatable" style="    background: #b2b2b2;">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Page Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schema as $content)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><input type="text" class="form-control route_name" value="{{ $content->route_name }}"
                                            seo_id='{{ $content->uuid }}' name="route_name" id="route_name{{ $content->uuid }}"></td>
                                    <td><input type="text" class="form-control title" seo_id='{{ $content->uuid }}'
                                            id="title{{ $content->uuid }}" name="title" placeholder="Please provide the meta title"
                                            value="{{ $content->title }}"></td>
                                    <td>
                                        <textarea class="form-control description" id="description{{ $content->uuid }}" seo_id='{{ $content->uuid }}' name="description" rows="2"
                                            placeholder="Please provide meta description">{{ $content->description }}</textarea>
                                    </td>
                                    <!-- <td>
                                        <button type="button" class="last btn btn-primary delete" data-toggle="tooltip"
                                            title="Delete"
                                            onclick="event.preventDefault(); if(confirm('{{ __('Are you sure to delete this row') }}')){
                                    document.getElementById('delete-data-{{ $content->uuid }}').submit();}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <form id="delete-data-{{ $content->uuid }}"
                                            action="{{ route('admin.seo.destroy', ['id' => $content->uuid]) }}"
                                            method="POST">
                                            @csrf
                                        </form>
                                    </td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- end data table -->
@endsection

@section('script')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <!-- Plugins js -->
    {{-- <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> --}}

    <script>
        
        $('.route_name').on('keyup', function() {
            var id = $(this).attr("seo_id");
            var route = $('#route_name'+id).val()
            var url = "{{ route('admin.schema.update', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    route: route,
                    id: id
                },
                success: function(response) {
                    if (response) {
                        $('#msgbx').text(response.message);
                        setTimeout(function() {
                            $("#msgbx").text("");
                        }, 1500);
                    }
                }
            })
        });
        $('.title').on('keyup', function() {
            var id = $(this).attr("seo_id");
            var title = $('#title'+id).val()
            var url = "{{ route('admin.schema.update', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    title: title,
                    id: id
                },
                success: function(response) {
                    if (response) {
                        $('#msgbx').text(response.message);
                        setTimeout(function() {
                            $("#msgbx").text("");
                        }, 1500);
                    }
                }
            })
        });
        $('.description').on('keyup',  function() {
            var id = $(this).attr("seo_id");
            var description = $('#description'+id).val()
            var url = "{{ route('admin.schema.update', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    description: description,
                    id: id
                },
                success: function(response) {
                    if (response) {
                        $('#msgbx').text(response.message);
                        setTimeout(function() {
                            $("#msgbx").text("");
                        }, 1500);
                    }
                }
            })
        });
        $('.keywords').on('keyup',  function() {
            var id = $(this).attr("seo_id");
            var keywords = $('#keywords'+id).val()
            var url = "{{ route('admin.seo.update', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    keywords: keywords,
                    id: id
                },
                success: function(response) {
                    if (response) {
                        $('#msgbx').text(response.message);
                        setTimeout(function() {
                            $("#msgbx").text("");
                        }, 1500);
                    }
                }
            })
        });

        $('.head').on('keyup', function() {
            var head = $('#head').val()
            var url = "{{ route('admin.seo.gtm',) }}";          
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    head: head,
                },
                success: function(response) {
                    if (response) {
                        $('#msgbx1').text(response.message);
                        setTimeout(function() {
                            $("#msgbx1").text("");
                        }, 1500);
                    }
                }
            })
        });
        $('.body').on('keyup', function() {
            var body = $('#body').val()
            var url = "{{ route('admin.seo.gtm',) }}";          
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    body: body,
                },
                success: function(response) {
                    if (response) {
                        $('#msgbx1').text(response.message);
                        setTimeout(function() {
                            $("#msgbx1").text("");
                        }, 1500);
                    }
                }
            })
        });
    </script>
@endsection
