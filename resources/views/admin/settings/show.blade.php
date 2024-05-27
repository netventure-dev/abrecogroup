@extends('admin.layout.backend')

@section('content')
    <div class="content">
        <!-- Row #1 -->
        <h2 class="content-heading">Admin Settings</h2>


        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 float-left">
                    <!-- Bootstrap Register -->
                    <div class="block">
                        <div class="block-header block-header-default">

                        </div>
                        <div class="block-content">
                            <div class="block block-themed">
                                <!--Alert messages-->
                                @if (session('Error'))
                                    <div class="alert alert-danger alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>{{ session('Error') }}
                                    </div>
                                @endif
                                @if (session('Success'))
                                    <div class="alert alert-success alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>{{ session('Success') }}
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="block-content">
                        <form action="{{ route('admin.settings.store') }}" method="post" id="setting_form">
                            @csrf
                            <div class="form-group row">
                                <label class="col-12" for="register1-password">Email</label>
                                <div class="col-md-12">
                                    <input type="email"

                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                        id="email" name="email" value="{{$user->email}}">
                                    <div class="invalid-email">{{ $errors->first('email') }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="register1-password2">Name</label>
                                <div class="col-md-12">
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        id="name" name="name" value="{{$user->name}}">
                                    <div class="invalid-name">{{ $errors->first('name') }}</div>
                                </div>

                            </div>
                            <br>
                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Update
                                        </button>
                                    </div>

                               </div>
                            </div>
                        </form>
                    </div>
                    <br><br>
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Reset Password</h3>
                    </div>

                    <div class="block-content">
                        <form action="{{ route('admin.profile.update') }}" method="post" id="setting_form">
                            @csrf
                            <div class="form-group row">
                                <label class="col-12" for="register1-password">Password</label>
                                <div class="col-md-12">
                                    <input type="password"
                                        class="form-control @if ($errors->has('password')) is-invalid @endif"
                                        id="password" name="password">
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="register1-password2">Confirm Password</label>
                                <div class="col-md-12">
                                    <input type="password"
                                        class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                        id="password_confirmation" name="password_confirmation">
                                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                </div>
                            </div>
                                <br>
                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md"> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END Row #1 -->
    </div>
    </div>
    </div>
@endsection
@section('js_after')
    <script>
        $("#setting_form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please enter password",
                    minlength: "Please enter password of minimum length 8",
                },
                password_confirmation: {
                    required: "Please enter confirm password",
                    minlength: "Please enter password of minimum length 8",
                    equalTo: "Password mismatch",
                }
            },
            errorClass: 'invalid-feedback',
            errorElement: 'div',
            errorPlacement: (error, e) => {
                $(e).parents('.form-group > div').append(error);
            },
            highlight: e => {
                $(e).closest('.form-material').removeClass('is-invalid').addClass('is-invalid');
            },
            success: e => {
                $(e).closest('.form-material').removeClass('is-invalid');
                $(e).remove();
            }
        });

        function reset_f() {
            $('#setting_form')[0].reset();
            $("#password-error").hide();
            $("#password_confirmation-error").hide();
        }
    </script>
@endsection

