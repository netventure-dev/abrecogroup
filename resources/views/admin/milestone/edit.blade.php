@extends('admin.layout.backend')

@section('title') {{ __('Edit Industry') }} @endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@endsection
@section('content')

    @component('admin.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('title') @endslot
    @endcomponent
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('Edit Industry') }}</h4>
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
                        <div class="col-lg-11">
                        <form action="{{ route('admin.milestone.settings.update', $milestone->uuid) }}" method="post"
                                class="custom-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4 row">
                                    <label for="title" class="col-sm-3 col-form-label mb-2">{{ __('Title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input id="title" name="title" type="text"
                                            class="form-control mb-2 @if ($errors->has('title')) is-invalid  @endif"
                                            placeholder="{{ __('Enter Title') }}" required value="{{ @old('title',$milestone->title) }}">
                                        <div class="invalid-feedback">{{ $errors->first('title') }}
                                        </div>
                                    </div>
                                </div>    
                                <div class="mb-4 row">
                                    <label for="color-1" class="col-sm-3 col-form-label mb-2">{{ __('Color') }}<span class="text-danger">*</span></label>
                                    <div class="col-md-6 @error('color.1') is-invalid @enderror">
                                        <div class="form-material">
                                            <input type="text" class="form-control colorpicker" id="color-1" name="color[1]"
                                                   placeholder="Please provide color" value="{{ old('color.1',$milestone->color['1']) }}" required>
                                        </div>
                                        <div class="invalid-feedback">{{ $errors->first('color.1') }}</div>
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <label for="horizontal-firstname-input"
                                        class="col-sm-3 col-form-label">{{ __('Status') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status1"
                                                value="1" @if (@$milestone->status == 1) checked @endif>
                                            <label class="form-check-label" for="status1">{{ __('Active') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2"
                                                value="0" @if (@$milestone->status == 0) checked @endif>
                                            <label class="form-check-label" for="status2">{{ __('Inactive') }}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">{{ __('Submit') }}</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Spectrum.js -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Spectrum color picker
        $('.colorpicker').spectrum({
            preferredFormat: "hex", // Set preferred color format
            showInput: true, // Show input box for manual color input
            showPalette: true, // Show color palette
            palette: [ // Define color palette
                ["#ff0000", "#ff8000", "#ffff00"],
                ["#80ff00", "#00ff80", "#00ffff"],
                ["#0080ff", "#8000ff", "#ff0080"]
            ],
            // You can add more options as needed, refer to Spectrum.js documentation for more customization options
        });
    });
</script>

</script>
@endsection