@extends('admin.layout.backend')

@section('title') {{__('View Roles')}} @endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}">
@endsection

@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start page title -->
<div class="row">
    <div class="col-12 mt-5">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{__('Roles')}}</h4>
            {{-- @can('create', App\Models\Role::class) --}}
                <div class="page-title-right">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary w-md">{{__('Create Role')}}</a>
                </div>
            {{-- @endcan --}}
        </div>
    </div>
</div>
<!-- end page title -->

<!-- data table -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">{{__('Roles')}}</h4>
                {{$dataTable->table()}}

            </div>
        </div>
    </div> 
</div> 

<!-- end data table -->

@endsection

@section('script')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

{{$dataTable->scripts()}}

@endsection