<x-app-layout>
    @push('title')
        {{ __('labels.department') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <div class="card-header mt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" class="form-control w-250px ps-13"
                                    placeholder="{{ __('labels.search_department') }}" name="search"
                                    value="{{ request('search') }}" id="InputSearch"
                                    data-search-url="{{ route('department.index') }}" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            @can('department.create')
                                <button class="btn btn-light-success me-3" data-bs-toggle="modal"
                                    data-bs-target="#import_department">
                                    <i class="fs-3 bi bi-database-down"></i>{{ __('labels.import') }}</button>
                                <a href="{{ route('department.create') }}" class="btn btn-light-primary">
                                    <i class="ki-duotone ki-plus-square fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>{{ __('labels.add_department') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="">{{ __('labels.sr_no') }}</th>
                                        <th class="min-w-125px">{{ __('labels.name') }}</th>
                                        <th class="text-end min-w-100px">{{ __('labels.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600 tablebody">
                                    @include('department.row', ['data' => $data, 'i' => $i])
                                </tbody>
                            </table>
                            <div id="pagination-container">
                                {!! $data->appends(Request::all())->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="import_department" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="modal_import_department_header">
                                <h2 class="fw-bold">{{ __('labels.import_department') }}</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <form id="FormId" class="form ajax-form-submit" action="{{ route('ImportDepartment') }}"
                                    enctype="multipart/form-data" method="POST" data-dismiss-modal="import_department"
                                    data-preloader="false" data-refresh="false" data-reset="true">
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                        id="modal_import_department_scroll" data-kt-scroll="true"
                                        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#modal_import_department_header"
                                        data-kt-scroll-wrappers="#modal_import_department_scroll"
                                        data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="required fw-semibold fs-6 mb-2">{{ __('labels.excel_file') }}</label>
                                            <input type="file" name="excel_file" class="form-control" accept="excel/*"
                                                data-bvalidator="required">
                                        </div>
                                        <span class="text-muted mt-6">
                                            <strong class="text-danger fw-bold">{{ __('labels.headers') }} :
                                            </strong>
                                            name, email, contact. {{ __('labels.download_sample_file') }}
                                            <a href="{{ url('/') }}/public/empty-files/empty-department.xlsx"
                                                download="">{{ __('labels.here') }}</a>
                                        </span>
                                    </div>
                                    <div class="text-center pt-10">
                                        <button type="reset" class="btn btn-light me-3"
                                            data-bs-dismiss="modal">{{ __('labels.discard') }}</button>
                                        <button type="submit" class="btn btn-success me-10 btn-submit">
                                            <span class="indicator-label">
                                                {{ __('labels.submit') }}
                                            </span>
                                            <span class="indicator-progress">
                                                {{ __('labels.please_wait') }} <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
