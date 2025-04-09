<div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
        <div class="modal-header" id="kt_modal_StatusModel_header">
            <h2 class="fw-bold">{{ __('labels.activity') }}</h2>
            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                <i class="ki-duotone ki-cross fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <div class="modal-body px-5 my-7">
            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_StatusModel_scroll"
                data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_StatusModel_header"
                data-kt-scroll-wrappers="#kt_modal_StatusModel_scroll" data-kt-scroll-offset="300px">
                <div class="timeline-label">
                    @foreach ($activity as $act)
                        <div class="timeline-item">
                            <div class="timeline-label w-200px fw-bold text-gray-800 fs-6">
                                {{ Helper::datetimeFormat($act->created_at) }}</div>
                            <div class="timeline-badge">
                                <i
                                    class="fa fa-genderless text-{{ $act->officer_name == null ? Helper::statusColor($act->status) : 'info' }} fs-1"></i>
                            </div>
                            <div class="fw-mormal timeline-content text-muted ps-3">
                                @if ($act->officer_name != null)
                                    <div>{{ $act->officer_name ?? '' }}</div>
                                    <div>{{ $act->officer_designation ?? '' }}</div>
                                    <div>{{ $act->remark ?? '' }}</div>
                                @else
                                    {{ $act->status }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
