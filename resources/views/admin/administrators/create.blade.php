@extends('admin.layout.backend')

@section('title') {{__('Create Administrator')}} @endsection

@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{__('Create Administrator')}}</h4>
            <div class="page-title-right">

            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<!-- start administrator create form -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="mt-2 row">
                    <div class="col-lg-7">
                        <form action="{{ route('admin.administrator.store') }}" method="post" class="custom-validation"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4 row">
                                <label for="name" class="col-sm-3 col-form-label">{{__('Name')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid  @endif"
                                        placeholder="Enter Name" required value="{{ @old('name') }}">
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="email" class="col-sm-3 col-form-label">{{__('Email')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="email" type="text" name="email"
                                        class="form-control @if ($errors->has('email')) is-invalid  @endif"
                                        placeholder="Enter Email" value="{{ @old('email') }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                </div>
                            </div>
                            {{-- <div class="mb-4 row">
                                <label for="role" class="col-sm-3 col-form-label">{{__('Role')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select id="role" name="role"
                                        class="form-select form-control @if ($errors->has('role')) is-invalid  @endif"
                                        required>
                                        <option value="">{{ __('Select Role') }}</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if(@old('role')==$role->id)
                                            selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('role') }}</div>
                                </div>
                            </div> --}}
                            <div class="mb-4 row">
                                <label for="password" class="col-sm-3 col-form-label">{{__('Password')}}<span
                                        style="color:red">*</span>
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group auth-pass-inputgroup">
                                        <input id="password" name="password" type="password"
                                            class="form-control @if ($errors->has('password')) is-invalid  @endif"
                                            placeholder="Enter Password" required
                                            aria-describedby="button-addon"
                                            data-parsley-errors-container="#errorContainer" data-parsley-minlength="8">
                                        <button class="btn btn-light " type="button" id="password-addon"><i
                                                class="mdi mdi-eye-outline"></i></button>
                                        <a id="generate-password" href="javascript:void(0)"
                                            class="text-primary w-100 text-end">{{__('Generate Random Password')}}</a>
                                    </div>
                                    <div id="errorContainer"></div>
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="avatar" class="col-sm-3 col-form-label">{{__('Avatar')}} <a href="#" class="tool_tip js-tooltip-enabled"
                                        data-toggle="tooltip"
                                        title="Supported File Formats:- jpeg, png, jpg only. Not more than 1024 KB."><i
                                            class="fa fa-info-circle"></i></a></label>
                                <div class="col-sm-9">
                                    <input id="avatar" name="avatar" type="file"
                                        class="form-control @if ($errors->has('avatar')) is-invalid  @endif"
                                        data-parsley-fileextension='jpg,png,jpeg' data-parsley-max-file-size="1024">
                                    <div class="invalid-feedback">{{ $errors->first('avatar') }}</div>
                                    <a target="_blank" href="https://www.reduceimages.com/"
                                        class="text-primary">Want to resize the image</a>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6"> </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end administrator create form -->

@endsection

@section('script')
<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
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
