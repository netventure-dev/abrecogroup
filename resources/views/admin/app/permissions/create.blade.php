@extends('admin.layout.backend')

@section('title') {{__('Create Permission')}} @endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

@endsection

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{__('Create Permission')}}</h4>
            <div class="page-title-right">
                
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<!-- start permission create form -->
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-lg-6">
                        <x-form action="{{ route('admin.permissions.store') }}" method="post" class="custom-validation">
                            @include('admin.app.permissions.form-inputs')
                            <div class="row justify-content-end">
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary w-md">{{__('Create')}}</button>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end permission create form -->

@endsection

@section('script')
<!-- Plugins js -->
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{asset('assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
<script src="{{asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{asset('assets/js/pages/task-create.init.js') }}"></script>
<script src="{{asset('assets/js/pages/form-mask.init.js') }}"></script>
@endsection