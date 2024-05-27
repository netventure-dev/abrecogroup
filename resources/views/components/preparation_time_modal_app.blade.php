<div class="modal fade" id="modal-time-to-prepare" tabindex="-1" role="dialog"
    aria-labelledby="modal-time-to-prepareLabel" aria-hidden="true" style="padding-right: 0 !important">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <form role="form" method="GET" id="form-time-to-prepare" action="#">
                <div class="pt-5 modal-body">
                    <h5 class="mb-3 text-center font-weight-bold">{{ __('Preparation time in minutes') }}</h5>
                    {{-- <input type="number" step="5" min="5" max="100"  onKeyDown="return false" class="form-control" value="5" name="time_to_prepare"  id="spinner" /> --}}
                    {{-- <input class="form-control single-input" name="time_to_prepare" id="check-minutes" value="" placeholder="Now"> --}}
                    <div class="custom-checkbox-filter">
                      

                        <div class="time">
                             <input type="hidden" name="time_to_prepare"  id="time_to_prepare" />

                            <div class="selected">
                                <span class="time-btn active" id="minutes">00<span>
                            </div>
                            <div id="time-picker" class="p-4 active">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-0 pb-5 text-center border-0 modal-footer d-block">
                    <button type="button" class="px-4 rounded btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="px-4 rounded btn btn-primary time_to_pre" id="btn-submit-time-prepare"
                        style="height:40px;font-size: 16px;">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>