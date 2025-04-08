<x-app-layout>
    @push('title')
        Cases
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush mb-5">
                    <div class="card-body">
                        <form action="{{ route('case.index') }}" class="form ajax-get-submit" method="GET">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            {{ __('labels.subject') }}
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Subject"
                                            data-bvalidator="required" name="subject_id" data-control="select2">
                                            <option hidden></option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ $subject->id == request('subject_id') ? 'selected' : '' }}>
                                                    {{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            {{ __('labels.department') }}
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Department"
                                            data-bvalidator="required" name="department_id" data-control="select2">
                                            <option hidden></option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $department->id == request('department_id') ? 'selected' : '' }}>
                                                    {{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            {{ __('labels.branch') }}
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Branch"
                                            data-bvalidator="required" name="branch_id" data-control="select2">
                                            <option hidden></option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    {{ $branch->id == request('branch_id') ? 'selected' : '' }}>
                                                    {{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            {{ __('labels.status') }}
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Branch"
                                            data-bvalidator="required" name="status" data-control="select2">
                                            <option hidden></option>
                                            <option value="Received">Received</option>
                                            <option value="In Process">In Process</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Signed">Signed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-12">
                                    <div class="fv-row form-group text-end">
                                        <label class="fs-6 fw-semibold form-label mb-2">&nbsp;</label>
                                        <div>
                                            <button type="submit" class="btn btn-success me-3">
                                                {{ __('labels.apply') }}
                                            </button>
                                            <a href="{{ route('case.index') }}"
                                                class="btn btn-light">{{ __('labels.reset') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card card-flush">
                    <div class="card-header mt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" class="form-control w-250px ps-13" placeholder="Search Inward Letter"
                                    name="search" value="{{ request('search') }}" id="InputSearch"
                                    data-search-url="{{ route('case.index') }}" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('case.create') }}" class="btn btn-light-primary">
                                <i class="ki-duotone ki-plus-square fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>{{ __('labels.add_case') }}
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
                                        <th class="min-w-125px">{{ __('labels.description') }}</th>
                                        <th class="min-w-125px">{{ __('labels.letter_number') }}</th>
                                        <th class="min-w-125px">{{ __('labels.proposal_received_from') }}</th>
                                        <th class="min-w-125px">{{ __('labels.status') }}</th>
                                        <th class="min-w-125px">{{ __('labels.current_status') }}</th>
                                        <th class="min-w-125px">{{ __('labels.concerned_officer') }}</th>
                                        <th class="min-w-125px">{{ __('labels.created_at') }}</th>
                                        <th class="text-end min-w-100px">{{ __('labels.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600 tablebody">
                                    @include('case.row', ['data' => $data, 'i' => $i])
                                </tbody>
                            </table>
                            <div id="pagination-container">
                                {!! $data->appends(Request::all())->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="StatusModel" class="modal fade" tabindex="-1" aria-hidden="true"></div>
                <div id="CommentModel" class="modal fade" tabindex="-1" aria-hidden="true"></div>
                <div id="FollowupModel" class="modal fade" tabindex="-1" aria-hidden="true"></div>
            </div>
        </div>
    @endsection
    @push('js')
        <script>
            $(document).on('click', '.badgeStatus', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: base_url + '/get-case-activity/' + id,
                    type: "GET",
                    success: function(response) {
                        $('#StatusModel').html(response.html);
                        $('#StatusModel').modal('show');
                    }
                });
            });
            $(document).on('click', '.addComment', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: base_url + '/get-comment-model/' + id + '?type=case',
                    type: "GET",
                    success: function(response) {
                        $('#CommentModel').html(response.html);
                        $('#CommentModel').modal('show');
                        $('#CommentModel').find('form').bValidator();
                    }
                });
            });
            $(document).on('click', '.addFollowup', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: base_url + '/get-followup-model/' + id + '?type=case',
                    type: "GET",
                    success: function(response) {
                        $('#FollowupModel').html(response.html);
                        $('#FollowupModel').modal('show');
                        $('#FollowupModel').find('form').bValidator();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
