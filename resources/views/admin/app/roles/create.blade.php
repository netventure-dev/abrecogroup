@extends('admin.layout.backend')

@section('title') {{__('Create Role')}} @endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" type="text/css"
    href="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">


@endsection

@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start role create form -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <x-form action="{{ route('admin.roles.store') }}" method="post" class="custom-validation">
                    @include('admin.app.roles.form-inputs')
                    <div class="row ">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
</div>

<!-- end role create form -->


@endsection

@section('script')
<script>

$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

</script>
@endsection