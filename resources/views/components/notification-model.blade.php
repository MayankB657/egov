@if (isset($notification))
    <div class="modal fade" id="modal_notification" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 d-flex flex-stack">
                    <div class="text-center">
                        <h3 class="mb-3">{{ $notification->data['title'] ?? 'No Title' }}</h3>
                    </div>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="separator d-flex flex-center mb-5"></div>
                <div class="modal-body scroll-y mx-5 pt-1 pb-1">
                    <div class="mb-5">
                        <div>{!! $notification->data['description'] ?? 'No Description' !!}</div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-light me-3 btn-sm">{{ __('labels.close') }}</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="MarkAsRead"
                        data-id="{{ $notification->id }}">{{ __('labels.mark_as_read') }}</button>
                </div>
            </div>
        </div>
    </div>
@endif
