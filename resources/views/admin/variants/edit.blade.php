@extends('admin.layout.backend')

@section('title') {{__('Edit Variant')}} @endsection

@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{__('Edit Brand')}}</h4>
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
                        <form action="{{ route('admin.variants.update',$variant->id) }}" method="post"
                            class="custom-validation" enctype="multipart/form-data" id="myForm">
                            @csrf
                            @method('post')
                            <div class="mb-4 row">
                                <label for="name" class="col-sm-3 col-form-label">{{__('Name')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid  @endif"
                                        placeholder="Enter Name" required value="{{ @old('name',$variant->name) }}">
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label" for="brand">Brands
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select id="brand" name="brand"
                                        class="form-control select2 @if ($errors->has('store')) is-invalid @endif"
                                        rquired>
                                        <option>Select</option>
                                        @foreach ($brands as $brand)
                                            <option @if($brand->id == $variant->brand_id) selected @endif  value={{ $brand->id }}>{{ $brand->name }}</option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('brand') }}</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label" for="sub_model">Sub Models
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select id="sub_model" name="sub_model"
                                        class="form-control select2 @if ($errors->has('store')) is-invalid @endif"
                                        rquired>
                                        <option>Select</option>
                                        @foreach ($sub_models as $sub_model)
                                            <option @if($sub_model->id == $variant->sub_model_id) selected @endif  value={{ $sub_model->id }}>{{ $sub_model->name }}</option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('sub_model') }}</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-sm-3 col-form-label" for="fuel_type">Fuel Type
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select id="fuel_type" name="fuel_type"
                                        class="form-control select2 @if ($errors->has('store')) is-invalid @endif"
                                        rquired>
                                        <option>Select</option>
                                        @foreach ($fuels as $fuel)
                                            <option @if($fuel->id == $variant->fuel_id) selected @endif value={{ $fuel->id }}>{{ $fuel->name }}</option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('fuel_type') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="on_road_price" class="col-sm-3 col-form-label">{{__('On Road Price')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="on_road_price" name="on_road_price" type="number"
                                        class="form-control @if ($errors->has('on_road_price')) is-invalid  @endif"
                                        placeholder="Enter On Road Price" required value="{{ @old('on_road_price',$variant->on_road_price) }}">
                                    <div class="invalid-feedback">{{ $errors->first('on_road_price') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="offer" class="col-sm-3 col-form-label">{{__('Offer')}}</label>
                                <div class="col-sm-9">
                                    <input id="offer" name="offer" type="number"
                                        class="form-control @if ($errors->has('offer')) is-invalid  @endif"
                                        placeholder="Enter offer in Rs" value="{{ @old('offer',$variant->offer) }}">
                                    <div class="invalid-feedback">{{ $errors->first('offer') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="horizontal-firstname-input"
                                    class="col-sm-3 col-form-label">{{ __('Status') }}<span
                                    class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline col-form-label">
                                        <input @if($variant->status == 1) checked @endif class="form-check-input" type="checkbox" value="1"
                                            id="defaultCheck1" name="status" checked>
                                        <label class="form-check-label" for="defaultCheck1">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Update</button>
                                    </div>
                                </div>
                            </div>
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
