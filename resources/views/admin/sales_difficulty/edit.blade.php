@extends('admin.layout.backend')

@section('title') Edit Sales Difficulty @endsection

@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Sales Difficulty </h4>
            <div class="page-title-right">

            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<!-- start administrator edit form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="mt-2 row">
                    <div class="col-lg-7">
                        <form action="{{ route('admin.sales-difficulty.update',$sales->id) }}" method="post"
                            class="custom-validation" enctype="multipart/form-data" id="myForm">
                            @csrf
                            @method('post')
                            <div class="mb-4 row">
                                <label for="name" class="col-sm-3 col-form-label">{{__('Name')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" type="text"
                                            class="form-control @if ($errors->has('name')) is-invalid  @endif"
                                            placeholder="Enter Name" required value="{{ @old('name',$sales->name) }}">
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="point" class="col-sm-3 col-form-label">{{__('Point')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="point" type="number" name="point"
                                        class="form-control @if ($errors->has('point')) is-invalid  @endif"
                                        placeholder="Enter Point" value="{{ @old('point',$sales->point) }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('point') }}</div>
                                </div>
                            </div>                      
                            <button class="btn btn-primary" type="submit">{{__('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end administrator edit form -->

@endsection

@section('script')
<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

<script>
    $(document).ready( function() {
        $("#generate-password").click( function() {
            $('#password').val(randomPassword(8));
        });
        $('#show-password').click(function(){
            if($(this).hasClass('fa-eye-slash')){
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $('#password').attr('type','text');
            }else{
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                $('#password').attr('type','password');
            }
        });
    });
</script>
@endsection
