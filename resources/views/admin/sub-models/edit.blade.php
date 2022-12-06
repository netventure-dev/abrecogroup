@extends('admin.layout.backend')

@section('title') {{__('Edit sub-models')}} @endsection

@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{__('Edit sub-models')}}</h4>
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
                        <form action="{{ route('admin.sub-models.update',$subModels->id) }}" method="post"
                            class="custom-validation" enctype="multipart/form-data" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="mb-4 row">
                                <label for="name" class="col-sm-3 col-form-label">{{__('Name')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" type="text"
                                            class="form-control @if ($errors->has('name')) is-invalid  @endif"
                                            placeholder="{{__('Enter Name')}}" required value="{{ @old('name',$subModels->name) }}">
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label" for="brand">Brand
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select id="brand" name="brand"
                                        class="form-control select2 @if ($errors->has('store')) is-invalid @endif"
                                        required>
                                        <option value="">Select</option>
                                        @foreach ($brands as $data)
                                            <option @if($data->id == $subModels->brand_id) selected @endif value={{ $data->id }}>{{ $data->name }}</option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('brand') }}</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label" for="difficulties">Difficulty
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select id="difficulties" name="difficulties"
                                        class="form-control select2 @if ($errors->has('store')) is-invalid @endif"
                                        required>
                                        <option value="">Select</option>
                                        @foreach ($datas as $data)
                                            <option @if($data->id == $subModels->difficulty_id) selected @endif value={{ $data->id }}>{{ $data->name }}</option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('difficulties') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="horizontal-firstname-input"
                                    class="col-sm-3 col-form-label">{{ __('Status') }}</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline col-form-label">
                                        <input @if($subModels->status == 1) checked @endif class="form-check-input" type="checkbox" value="1"
                                            id="defaultCheck1" name="status" >
                                        <label class="form-check-label" for="defaultCheck1">
                                            Active
                                        </label>
                                    </div>
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
