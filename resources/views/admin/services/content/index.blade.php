@extends('admin.layout.backend')

@section('title') {{ __('Services') }} @endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

    @component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title') @endslot
    @endcomponent
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('Service Content') }}</h4>
                <div class="page-title-right">
                         <a href="{{ route('admin.services.content.create',@$services->uuid) }}"
                            class="btn btn-primary w-md">{{ __('Create Content') }}</a> 
                </div>
            </div>
        </div>
    </div>
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
                                <th>Title</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{!! $content->title !!}</td>
                                <td>{{$content->order}}</td>
                                <td> <a href="{{ route('admin.services.content.edit',['id' => $services->uuid, 'uuid' =>$content->uuid]) }}" class="first btn btn-primary edit"> Edit</a>
                                <button type="button" class="last btn btn-primary delete" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('{{__('Are you sure to delete this row')}}')){
                                    document.getElementById('delete-data-{{ $content->uuid }}').submit();}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <form id="delete-data-{{ $content->uuid }}" action="{{ route('admin.services.content.destroy',['id' => $services->uuid, 'uuid' =>$content->uuid]) }}"
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
