<x-app-layout>
    @push('title')
        {{ __('labels.subject') }}
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
                                    placeholder="{{ __('labels.search_subject') }}" name="search"
                                    value="{{ request('search') }}" id="InputSearch"
                                    data-search-url="{{ route('subject.index') }}" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('subject.create') }}" class="btn btn-light-primary">
                                <i class="ki-duotone ki-plus-square fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>{{ __('labels.add_subject') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="">{{ __('labels.sr_no') }}</th>
                                        <th class="min-w-125px">{{ __('labels.subject') }}</th>
                                        <th class="text-end min-w-100px">{{ __('labels.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600 tablebody">
                                    @include('subject.row', ['data' => $data, 'i' => $i])
                                </tbody>
                            </table>
                            <div id="pagination-container">
                                {!! $data->appends(Request::all())->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
