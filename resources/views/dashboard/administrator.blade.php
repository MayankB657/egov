<x-app-layout>
    @push('title')
        {{ __('labels.dashboard') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10">
            <div class="container-xxl">
                @if (!session()->has('no_trans_notice'))
                    <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-10"
                        id="no_trans_notice">
                        <i class="bi bi-translate fs-2hx text-primary me-4 mb-5 mb-sm-0"></i>
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <h4 class="fw-semibold">{{ __('labels.for_marathi_typing') }}</h4>
                            <span>{{ __('labels.we_recommend_installing_the') }}
                                <a href="https://chrome.google.com/webstore/detail/google-input-tools/mclkkofklkfljcocdinagocijmpgbhab"
                                    target="_blank">
                                    Google Input Tools Extension
                                </a> {{ __('labels.in_chrome_after_installing') }}</span>
                        </div>
                        <button type="button" id="DismissTranselationNotice"
                            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                            data-bs-dismiss="alert">
                            <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </button>
                    </div>
                @endif
                @can('inward-letter.index')
                    <div class="mb-3">
                        <h3 class="fw-bold text-gray-800 fs-2qx">{{ __('labels.inward_management') }}</h3>
                    </div>
                    <div class="row g-5 g-xl-8 mb-5">
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="card bg-body-white hoverable card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <i class="bi bi-envelope fs-2x"></i>
                                        </div>
                                        <div class="col-6 fs-3hx fw-bold text-end">{{ $inward->count() }}</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2 mt-2 fs-2">
                                        <div class="text-gray-900 fw-bold">{{ __('labels.total_inward') }}</div>
                                        <a href="{{ route('inward-letter.index') }}">
                                            <i class="bi bi-arrow-right-circle fs-2 text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="border border-primary border-dashed p-5">
                                <h3 class="fw-bold text-gray-800 mb-5">{{ __('labels.total_letters') }} -
                                    {{ $inward->where('letter_type', 'Letter')->count() }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('inward-letter.index', ['status' => 'Received']) }}"
                                        class="badge bg-primary p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.received') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'Letter')->where('status', 'Received')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'In Process']) }}"
                                        class="badge bg-warning p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_process') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'Letter')->where('status', 'In Process')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'Rejected']) }}"
                                        class="badge bg-danger p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.rejected') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'Letter')->where('status', 'Rejected')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'Signed']) }}"
                                        class="badge bg-success p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.signed') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'Letter')->where('status', 'Signed')->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="border border-primary border-dashed p-5">
                                <h3 class="fw-bold text-gray-800 mb-5">{{ __('labels.total_vip_letters') }} -
                                    {{ $inward->where('letter_type', 'VIP Letter')->count() }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('inward-letter.index', ['status' => 'Received', 'letter_type' => 'VIP Letter']) }}"
                                        class="badge bg-primary p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.received') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'VIP Letter')->where('status', 'Received')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'In Process', 'letter_type' => 'VIP Letter']) }}"
                                        class="badge bg-warning p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_process') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'VIP Letter')->where('status', 'In Process')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'Rejected', 'letter_type' => 'VIP Letter']) }}"
                                        class="badge bg-danger p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.rejected') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'VIP Letter')->where('status', 'Rejected')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'Signed', 'letter_type' => 'VIP Letter']) }}"
                                        class="badge bg-success p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.signed') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'VIP Letter')->where('status', 'Signed')->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="border border-primary border-dashed p-5">
                                <h3 class="fw-bold text-gray-800 mb-5">{{ __('labels.total_files') }} -
                                    {{ $inward->where('letter_type', 'File')->count() }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('inward-letter.index', ['status' => 'Received', 'letter_type' => 'File']) }}"
                                        class="badge bg-primary p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.received') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'File')->where('status', 'Received')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'In Process', 'letter_type' => 'File']) }}"
                                        class="badge bg-warning p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_process') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'File')->where('status', 'In Process')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'Rejected', 'letter_type' => 'File']) }}"
                                        class="badge bg-danger p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.rejected') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'File')->where('status', 'Rejected')->count() }}</span>
                                    </a>
                                    <a href="{{ route('inward-letter.index', ['status' => 'Signed', 'letter_type' => 'File']) }}"
                                        class="badge bg-success p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.signed') }} <span
                                            class="fs-2x fw-bold">{{ $inward->where('letter_type', 'File')->where('status', 'Signed')->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('outward-letter.index')
                    <div class="mb-3">
                        <h3 class="fw-bold text-gray-800 fs-2qx">{{ __('labels.outward_management') }}</h3>
                    </div>
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="card bg-body-white hoverable card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <i class="bi bi-envelope fs-2x"></i>
                                        </div>
                                        <div class="col-6 fs-3hx fw-bold text-end">{{ $outward->count() }}</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2 mt-2 fs-2">
                                        <div class="text-gray-900 fw-bold">{{ __('labels.total_outward') }}</div>
                                        <a href="{{ route('outward-letter.index') }}">
                                            <i class="bi bi-arrow-right-circle fs-2 text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="border border-primary border-dashed p-5">
                                <h3 class="fw-bold text-gray-800 mb-5">{{ __('labels.total_outward') }} -
                                    {{ $outward->count() }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('outward-letter.index', ['status' => 'Received']) }}"
                                        class="badge bg-primary p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.received') }} <span
                                            class="fs-2x fw-bold">{{ $outward->where('status', 'Received')->count() }}</span>
                                    </a>
                                    <a href="{{ route('outward-letter.index', ['status' => 'In Process']) }}"
                                        class="badge bg-warning p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_process') }} <span
                                            class="fs-2x fw-bold">{{ $outward->where('status', 'In Process')->count() }}</span>
                                    </a>
                                    <a href="{{ route('outward-letter.index', ['status' => 'Rejected']) }}"
                                        class="badge bg-danger p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.rejected') }} <span
                                            class="fs-2x fw-bold">{{ $outward->where('status', 'Rejected')->count() }}</span>
                                    </a>
                                    <a href="{{ route('outward-letter.index', ['status' => 'Signed']) }}"
                                        class="badge bg-success p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.signed') }} <span
                                            class="fs-2x fw-bold">{{ $outward->where('status', 'Signed')->count() }}</span>
                                    </a>
                                    <a href="{{ route('outward-letter.index', ['inout' => 'true']) }}"
                                        class="badge bg-info p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_out') }} <span
                                            class="fs-2x fw-bold">{{ $outward->where('inward_no', '!=', null)->count() }}</span>
                                    </a>
                                    <a href="{{ route('outward-letter.index', ['onlyout' => 'true']) }}"
                                        class="badge bg-dark p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px text-white">
                                        {{ __('labels.only_out') }} <span
                                            class="fs-2x fw-bold">{{ $outward->where('inward_no', null)->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('case.index')
                    <div class="mb-3">
                        <h3 class="fw-bold text-gray-800 fs-2qx">{{ __('labels.case_management') }}</h3>
                    </div>
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="card bg-body-white hoverable card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <i class="bi bi-envelope fs-2x"></i>
                                        </div>
                                        <div class="col-6 fs-3hx fw-bold text-end">{{ $case->count() }}</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2 mt-2 fs-2">
                                        <div class="text-gray-900 fw-bold">{{ __('labels.total_cases') }}</div>
                                        <a href="{{ route('case.index') }}">
                                            <i class="bi bi-arrow-right-circle fs-2 text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="border border-primary border-dashed p-5">
                                <h3 class="fw-bold text-gray-800 mb-5">{{ __('labels.total_letters') }} -
                                    {{ $case->where('topic_type', 'Letter')->count() }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('case.index', ['status' => 'Received']) }}"
                                        class="badge bg-primary p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.received') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'Letter')->where('status', 'Received')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'In Process']) }}"
                                        class="badge bg-warning p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_process') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'Letter')->where('status', 'In Process')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'Rejected']) }}"
                                        class="badge bg-danger p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.rejected') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'Letter')->where('status', 'Rejected')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'Signed']) }}"
                                        class="badge bg-success p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.signed') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'Letter')->where('status', 'Signed')->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="border border-primary border-dashed p-5">
                                <h3 class="fw-bold text-gray-800 mb-5">{{ __('labels.total_vip_letters') }} -
                                    {{ $case->where('topic_type', 'VIP Letter')->count() }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('case.index', ['status' => 'Received', 'letter_type' => 'VIP Letter']) }}"
                                        class="badge bg-primary p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.received') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'VIP Letter')->where('status', 'Received')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'In Process', 'letter_type' => 'VIP Letter']) }}"
                                        class="badge bg-warning p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_process') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'VIP Letter')->where('status', 'In Process')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'Rejected', 'letter_type' => 'VIP Letter']) }}"
                                        class="badge bg-danger p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.rejected') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'VIP Letter')->where('status', 'Rejected')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'Signed', 'letter_type' => 'VIP Letter']) }}"
                                        class="badge bg-success p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.signed') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'VIP Letter')->where('status', 'Signed')->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="border border-primary border-dashed p-5">
                                <h3 class="fw-bold text-gray-800 mb-5">{{ __('labels.total_files') }} -
                                    {{ $case->where('topic_type', 'File')->count() }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('case.index', ['status' => 'Received', 'letter_type' => 'File']) }}"
                                        class="badge bg-primary p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.received') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'File')->where('status', 'Received')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'In Process', 'letter_type' => 'File']) }}"
                                        class="badge bg-warning p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_process') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'File')->where('status', 'In Process')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'Rejected', 'letter_type' => 'File']) }}"
                                        class="badge bg-danger p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.rejected') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'File')->where('status', 'Rejected')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'Signed', 'letter_type' => 'File']) }}"
                                        class="badge bg-success p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.signed') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'File')->where('status', 'Signed')->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="border border-primary border-dashed p-5">
                                <h3 class="fw-bold text-gray-800 mb-5">{{ __('labels.total_notes') }} -
                                    {{ $case->where('topic_type', 'Note')->count() }}</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('case.index', ['status' => 'Received', 'letter_type' => 'Note']) }}"
                                        class="badge bg-primary p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.received') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'Note')->where('status', 'Received')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'In Process', 'letter_type' => 'Note']) }}"
                                        class="badge bg-warning p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.in_process') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'Note')->where('status', 'In Process')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'Rejected', 'letter_type' => 'Note']) }}"
                                        class="badge bg-danger p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.rejected') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'Note')->where('status', 'Rejected')->count() }}</span>
                                    </a>
                                    <a href="{{ route('case.index', ['status' => 'Signed', 'letter_type' => 'Note']) }}"
                                        class="badge bg-success p-4 fs-5 d-flex justify-content-between align-items-center rounded-3 min-w-125px">
                                        {{ __('labels.signed') }} <span
                                            class="fs-2x fw-bold">{{ $case->where('topic_type', 'Note')->where('status', 'Signed')->count() }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    @endsection
</x-app-layout>
