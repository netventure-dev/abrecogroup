@extends('admin.layout.backend')

@section('title') {{ __('Service Care') }} @endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}">
@endsection

@section('content')

    @component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title') @endslot
    @endcomponent
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('Service Care') }}</h4>
                <div class="page-title-right">
                    {{-- @can('create', App\Models\Admin::class) --}}
                        <a href="{{ route('admin.service-care.create') }}"
                            class="btn btn-primary w-md">{{ __('Create Service Care') }}</a>
                    {{-- @endcan --}}
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
                    {{ $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap w-100'], false) }}
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

    {{ $dataTable->scripts() }}

@endsection
