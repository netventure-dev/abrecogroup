@extends('admin.layout.backend')

@section('title') Create Size @endsection

@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Create Gst</h4>
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
                        <form action="{{ route('admin.gst.store')}}" method="post" class="custom-validation"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4 row">
                                <label for="gst" class="col-sm-3 col-form-label">{{__('Gst percentage')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="gst" type="number" name="gst"
                                        class="form-control @if ($errors->has('gst')) is-invalid  @endif"
                                        placeholder="Enter gst percentage" value="{{ @old('gst',@$gst->gst) }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('gst') }}</div>
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
      
    });
</script>
@endsection
