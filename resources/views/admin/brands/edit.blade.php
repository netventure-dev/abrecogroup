@extends('admin.layout.backend')

@section('title') {{__('Edit Administrator')}} @endsection

@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{__('Edit Administrator')}}</h4>
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
                        <form action="{{ route('admin.administrator.update',$admin->id) }}" method="post"
                            class="custom-validation" enctype="multipart/form-data" id="myForm">
                            @csrf
                            @method('post')
                            <div class="mb-4 row">
                                <label for="name" class="col-sm-3 col-form-label">{{__('Name')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="name" name="name" type="text"
                                            class="form-control @if ($errors->has('name')) is-invalid  @endif"
                                            placeholder="{{__('Enter Name')}}" required value="{{ @old('name',$admin->name) }}">
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="email" class="col-sm-3 col-form-label">{{__('Email')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="email" type="text" name="email"
                                            class="form-control @if ($errors->has('email')) is-invalid  @endif"
                                            placeholder="{{__('Enter Email')}}" value="{{ @old('email',$admin->email) }}"
                                            required>
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
                                        <option value="{{ $role->id }}" @if(@old('role',$admin->
                                            roles->first()->id)==$role->id)
                                            selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('role') }}</div>
                                </div>
                            </div> --}}
                            <div class="mb-4 row">
                                <label for="password" class="col-sm-3 col-form-label">{{__('Password')}}
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group auth-pass-inputgroup">
                                        <input id="password" name="password" type="password"
                                            class="form-control @if ($errors->has('password')) is-invalid  @endif"
                                            placeholder="{{__('Enter Password')}}"
                                            aria-describedby="button-addon"
                                            data-parsley-errors-container="#errorContainer" data-parsley-minlength="8">
                                        <button class="btn btn-light    " type="button" id="password-addon"><i
                                                class="mdi mdi-eye-outline"></i></button>
                                        <a id="generate-password" href="javascript:void(0)"
                                            class="text-primary w-100 text-end">{{__('Generate Random Password')}}</a>
                                    </div>
                                    <span
                                            class="text-muted">{{__("Leave the field empty if you don't want to change the password.")}}</span>
                                    <div id="errorContainer"></div>
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                </div>
                            </div> 
                            <div class="mb-4 row">
                                <label for="avatar" class="col-sm-3 col-form-label">{{__('Avatar')}} 
                                    <a href="#" class="tool_tip js-tooltip-enabled"
                                        data-toggle="tooltip"
                                        title="{{__('Supported File Formats:- jpeg, png, jpg only. Not more than 1024 KB.')}}"><i
                                            class="fa fa-info-circle"></i></a></label>
                                <div class="col-sm-9">
                                    @if($admin->avatar)
                                    <div class="col-md-1">
                                        <img src="{{ asset("/storage/$admin->avatar" ) }}" style="height:60px;"
                                            alt="{{ $admin->name }}" class="img-fluid">
                                    </div>
                                    @endif
                                    <input id="avatar" name="avatar" type="file"
                                        class="form-control @if ($errors->has('avatar')) is-invalid  @endif"
                                        data-parsley-fileextension='jpg,png,jpeg' data-parsley-max-file-size="1024">
                                    <div class="invalid-feedback">{{ $errors->first('avatar') }}</div>
                                    <a target="_blank" href="https://www.reduceimages.com/"
                                        class="text-primary">{{__('Want to resize the image')}}</a>
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
