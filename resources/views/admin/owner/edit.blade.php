@extends('admin.layout.backend')

@section('title')
    {{ __('Edit Administrator') }}
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
                <h4 class="mb-sm-0 font-size-18">Edit Owner</h4>
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
                            <form action="{{ route('admin.owner.update', $owner->id) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data" id="myForm">
                                @csrf
                                @method('post')
                                <div class="mb-4 row">
                                    <label for="name" class="col-sm-3 col-form-label">{{ __('No_of_owners') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="no_of_owners" name="no_of_owners" type="text"
                                            class="form-control @if ($errors->has('no_of_owners')) is-invalid @endif"
                                            placeholder="{{ __('Enter Name') }}" required
                                            value="{{ @old('no_of_owners', $owner->no_of_owners) }}">
                                        <div class="invalid-feedback">{{ $errors->first('no_of_owners') }}</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="difficulty_id">Difficulty
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select id="difficulty_id" name="difficulty_id"
                                            class="form-control select2 @if ($errors->has('store')) is-invalid @endif"
                                            rquired>
                                            <option>Select</option>
                                            @foreach ($datas as $data)
                                                <option value={{ $data->point }}>{{ $data->name }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('difficulty_id') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="horizontal-firstname-input"
                                        class="col-sm-3 col-form-label">{{ __('Status') }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline col-form-label">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="defaultCheck1" name="status" checked>
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
