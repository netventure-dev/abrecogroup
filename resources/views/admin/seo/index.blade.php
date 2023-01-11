@extends('admin.layout.backend')

@section('title')
    {{ __('SEO') }}
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
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="mb-sm-0 font-size-18">{{ __('SEO') }}</h4> --}}
                    <form action="{{route('admin.seo.store')}}" method="POST">
                        @csrf
                        <div class="row flex-column flex-md-row">
                            <div class="col">
                                <input type="text" class="form-control my-1" id="slug" name="slug"
                                placeholder="Please provide the slug" value="{{ @old('slug') }}"
                                >
                               
                            </div>
                            <div class="col">
                                <input type="text" class="form-control my-1" id="seo_title" name="seo_title"
                                placeholder="Please provide the meta title" value="{{ @old('seo_title') }}"
                                >
                               
                            </div>
                            <div class="col">
                                <textarea class="form-control my-1" id="seo_description" name="seo_description" rows="2"
                                placeholder="Please provide meta description"
                                >{{ @old('seo_description') }}</textarea>
                               
                            </div>
                            <div class="col">
                                <textarea class="form-control my-1" id="seo_keywords" name="seo_keywords" rows="2"
                                placeholder="Please provide meta keywords"
                                >{{ @old('seo_keywords') }}</textarea>
                               
                            </div>
                            <div class="col">
                                <button class="btn btn-primary w-100 my-1">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
    <!-- end page title -->

    <!-- start data table -->

    <div class="row">
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
                                <th>Keyword</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach ($seo as $content) 
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $content->route_name }}</td>
                                <td>{{$content->seo_title}}</td>
                                <td>{{$content->seo_description}}</td>
                                <td>{{$content->seo_keywords}}</td>
                                 <td> 
                                <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this row')}}')){
                                    document.getElementById('delete-data-{{ $content->uuid }}').submit();}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <form id="delete-data-{{ $content->uuid }}" action="{{ route('admin.seo.destroy',['id' => $content->uuid]) }}"
                                    method="POST">
                                    @csrf
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

    <!-- end data table -->

@endsection

@section('script')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <!-- Plugins js -->
    {{-- <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> --}}
@endsection
