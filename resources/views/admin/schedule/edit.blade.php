@extends('admin.layout.backend')

@section('title') Edit Schedule @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
    type="text/css">
@endsection
@section('content')

@component('admin.common-components.breadcrumb',['breadcrumbs' => $breadcrumbs])
@slot('title') @endslot
@endcomponent
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Schedule </h4>
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
                        <form action="{{ route('admin.schedule.update',$schedule->id) }}" method="post"
                            class="custom-validation" enctype="multipart/form-data" id="myForm">
                            @csrf
                            @method('post')
                            <div class="mb-4 row">
                                <label for="venue" class="col-sm-3 col-form-label">{{__('Venue')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="venue" type="text" name="venue"
                                        class="form-control @if ($errors->has('venue')) is-invalid  @endif"
                                        placeholder="Enter venue" value="{{ @old('venue',@$schedule->venue) }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('venue') }}</div>
                                </div>
                            </div>  
                            <div class="mb-4 row">
                                <label class="col-sm-3 col-form-label"
                                    for="schedule_date">{{ __('Date') }}<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="schedule_date" name="schedule_date" type="text"
                                        class="form-control input-mask @if ($errors->has('schedule_date')) is-invalid @endif"
                                    placeholder="{{ __('Enter Date from Available') }}"
                                    value="{{ @old('schedule_date',@$schedule->schedule_date) }}"
                                    data-date-format="dd-mm-yyyy" data-provide="datepicker"
                                    data-date-autoclose="true"
                                    autocomplete="off" required>
                                    <div class="invalid-feedback">{{ $errors->first('schedule_date') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="schedule_time" class="col-sm-3 col-form-label">{{__('Time')}}</label>
                                <div class="col-sm-9">
                                    <input id="timepicker" type="text" name="schedule_time"
                                        class="form-control @if ($errors->has('schedule_time')) is-invalid  @endif"
                                        placeholder="Enter time"  data-provide="timepicker" value="{{ @old('schedule_time',@$schedule->schedule_time) }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('schedule_time') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="speaker" class="col-sm-3 col-form-label">{{__('Speaker')}}</label>
                                <div class="col-sm-9">
                                    <input id="speaker" type="number" name="speaker"
                                        class="form-control @if ($errors->has('speaker')) is-invalid  @endif"
                                        placeholder="Enter speaker name" value="{{ @old('speaker',@$schedule->schedule_time) }}" >
                                    <div class="invalid-feedback">{{ $errors->first('speaker') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="topic" class="col-sm-3 col-form-label">{{__('topic')}}</label>
                                <div class="col-sm-9">
                                    <textarea id="topic" type="number" name="topic"
                                        class="form-control @if ($errors->has('topic')) is-invalid  @endif"
                                        placeholder="Enter topic name">{{ @old('topic',@$schedule->topic) }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->first('topic') }}</div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="horizontal-firstname-input"
                                    class="col-sm-3 col-form-label">{{ __('Status') }}</label>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline col-form-label">
                                        <input @if($schedule->status == 1) checked @endif class="form-check-input" type="checkbox" value="@if($schedule->status == 1) 1 @else 0 @endif"
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
<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

<script>
    var date = new Date();   
  $('#schedule_date').datepicker({
       format: 'dd-mm-yyyy',
       todayHighlight: true,
       startDate: date
   }).on('changeDate', function(e) {
       $(this).parsley().validate();
   });

</script>
@endsection
