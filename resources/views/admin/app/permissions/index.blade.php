@extends('admin.layout.backend')

@section('title') {{__('View Permissions')}} @endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/datatables/datatables.min.css') }}">
@endsection

@section('content')
 <!-- start page title -->
 <div class="row ">
    <div class="col-12 mt-5">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18 ">{{__('Permissions')}}</h4>
            {{-- @can('create', App\Models\Permission::class) --}}
                <div class="page-title-right mt-5">
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary w-md">{{__('Create Permission')}}</a>
                </div>
            {{-- @endcan --}}
        </div>
    </div>
</div>
<!-- data table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">{{__('Permissions')}}</h4>
                {{$dataTable->table()}}

            </div>
        </div>
    </div>
</div>

<!-- end data table -->

@endsection

@section('script')

<!-- Plugins js -->
<script src="{{asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

{{$dataTable->scripts()}}

@endsection