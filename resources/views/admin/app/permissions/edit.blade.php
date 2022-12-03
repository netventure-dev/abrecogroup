@extends('admin.layout.backend')

@section('title') {{__('Edit Permission')}} @endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css"
    href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

<!-- Summernote css -->
@endsection

@section('content')

<!-- start permission edit form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-form action="{{ route('admin.permissions.update', $permission) }}" method="put"
                    class="custom-validation">
                    @include('admin.app.permissions.form-inputs')
                    <div class="row ">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
</div>

<!-- end permission edit form -->

@endsection

@section('script')
<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/task-create.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-mask.init.js') }}"></script>
@endsection