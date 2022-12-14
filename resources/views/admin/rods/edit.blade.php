@extends('admin.layout.backend')

@section('title')
    {{ __('Edit Rod') }}
@endsection

@section('content')
    @component('admin.common-components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title')
        @endslot
    @endcomponent
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Rod</h4>
                <div class="page-title-right">

                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start Rod edit form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 row">
                        <div class="col-lg-7">
                            <form action="{{ route('admin.rods.update', $rod->id) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data" id="myForm">
                                @csrf
                                @method('post')
                                <div class="mb-4 row">
                                    <label for="rods" class="col-sm-3 col-form-label">No. of rods<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="rods" name="rods" type="text"
                                            class="form-control @if ($errors->has('rods')) is-invalid @endif"
                                            placeholder="Enter no. of rods" required value="{{ @old('rods',@$rod->no_of_rods) }}">
                                        <div class="invalid-feedback">{{ $errors->first('rods') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="rate" class="col-sm-3 col-form-label">Weight<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="weight" name="weight" type="number"
                                            class="form-control @if ($errors->has('weight',@$rod->weight)) is-invalid @endif"
                                            placeholder="Enter weight in kgs" required value="{{ @old('weight',@$rod->weight) }}">
                                        <div class="invalid-feedback">{{ $errors->first('weight') }}</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="size_id">Size
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select id="size_id" name="size_id"
                                            class="form-control select2 @if ($errors->has('store')) is-invalid @endif"
                                            required>
                                            <option>Select</option>
                                            @foreach ($sizes as $data)
                                                <option @if($data->id == $rod->size_id) selected @endif value={{ $data->id }}>{{ $data->size }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('size_id') }}</div>
                                    </div>
                                </div>
                                
                                <div class="mb-4 row">
                                    <label for="rate" class="col-sm-3 col-form-label">Rate</label>
                                    <div class="col-sm-9">
                                        <input id="rate" name="rate" type="number"
                                            class="form-control @if ($errors->has('rate')) is-invalid @endif"
                                            placeholder="Enter rate" value="{{ @old('rate',@$rod->rate) }}">
                                        <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="horizontal-firstname-input"
                                        class="col-sm-3 col-form-label">{{ __('Status') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline col-form-label">
                                            <input @if($rod->status == 1) checked @endif class="form-check-input" type="checkbox" value="1"
                                                id="defaultCheck1" name="status" >
                                            <label class="form-check-label" for="defaultCheck1">
                                                Active

                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Update</button>
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
        $(document).ready(function() {
            $("#generate-password").click(function() {
                $('#password').val(randomPassword(8));
            });
            $('#show-password').click(function() {
                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $('#password').attr('type', 'text');
                } else {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>
@endsection
