<div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
        <div class="modal-header" id="kt_modal_CommentModel_header">
            <h2 class="fw-bold">{{ __('labels.add_comment') }}</h2>
            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                <i class="ki-duotone ki-cross fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <div class="modal-body px-5 my-7">
            <form class="form FormClass ajax-form-submit" action="{{ $type == 'case' ? route('AddCaseComment') : route('AddLetterComment') }}" enctype="multipart/form-data"
                method="POST" data-dismiss-modal="CommentModel" data-preloader="false"
                data-refresh="false">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_CommentModel_scroll"
                    data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_CommentModel_header"
                    data-kt-scroll-wrappers="#kt_modal_CommentModel_scroll" data-kt-scroll-offset="300px">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 required fw-semibold form-label mb-2">
                            {{ __('labels.comment') }}
                        </label>
                        <textarea name="comment" data-bvalidator="required" rows="4" class="form-control" placeholder="Enter Comment"></textarea>
                    </div>
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            PDF or Iamge (Multiple)
                        </label>
                        <input class="form-control" type="file" name="media_files[]" multiple
                            data-bvalidator="extension[jpg:jpeg:png:pdf]"
                            data-bvalidator-msg="Please select file of type png, jpg, jpeg or pdf." />
                    </div>
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{ __('labels.discard') }}</button>
                        <button type="submit" class="btn btn-success me-10 btn-submit">
                            <span class="indicator-label">
                                {{ __('labels.submit') }}
                            </span>
                            <span class="indicator-progress">
                                {{ __('labels.please_wait') }} <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
