<div class="modal fade" id="modal-time-to-prepare" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="mt-0 modal-title" id="modal-title-new-item">{{ __('Order time to prepare in minutes') }}
                </h5>
                <button type="button" id="modal_prepare_close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form role="form" method="GET" id="form-time-to-prepare" action="#">
                            <input type="hidden" name="time_to_prepare" id="time_to_prepare" />
                            <div class="button-items">
                                @for ($i = 5; $i <= 150; $i += 5) <button type="button"
                                        class="btn btn-outline-primary waves-effect waves-light w-sm btn-time-to-prepare"
                                        value="{{ $i }}">
                                        {{ $i }}</button>
                                @endfor
                            </div>
                            <div class="pt-4 text-center button-items">
                                <button type="submit" id="btn-submit-time-prepare"
                                    class="h-auto px-4 py-2 btn btn-sm btn-primary d-none ">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
