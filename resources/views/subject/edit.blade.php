<x-app-layout>
    @push('title')
        {{ __('labels.edit_subject') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <form action="{{ route('subject.update', base64UrlEncode($data->id)) }}" autocomplete="off" method="POST"
                        class="form ajax-form-submit" data-preloader="true" data-reset="true" data-refresh="true"
                        id="FormId" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.name') }}</span>
                                </label>
                                <input class="form-control" name="name" placeholder="{{ __('labels.enter_name') }}"
                                    data-bvalidator="required" value="{{ $data->name }}" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.department') }}</span>
                                </label>
                                <select class="form-select fw-bold" data-placeholder="{{ __('labels.select_department') }}"
                                    data-bvalidator="required" name="department_id" data-control="select2">
                                    <option hidden></option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $department->id == $data->department_id ? 'selected' : '' }}>
                                            {{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.branch') }}</span>
                                </label>
                                <select class="form-select fw-bold" data-placeholder="{{ __('labels.select_branch') }}"
                                    data-bvalidator="required" name="branch_id" data-control="select2">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $branch->id == $data->branch_id ? 'selected' : '' }}>
                                            {{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <a href="{{ route('subject.index') }}"
                                    class="btn btn-light me-3">{{ __('labels.discard') }}</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('labels.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
        <script>
            $(document).on('change', 'select[name="department_id"]', function() {
                var department_id = $(this).val();
                var branch_id = $('select[name="branch_id"]');
                branch_id.empty();
                branch_id.append('<option hidden></option>');
                $.ajax({
                    url: "{{ route('getBranches', ['department_id' => '__ID__']) }}".replace('__ID__',
                        department_id),
                    type: "GET",
                    success: function(data) {
                        $.each(data.branches, function(key, value) {
                            branch_id.append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        branch_id.select2({
                            placeholder: "Select Branch",
                        });
                        branch_id.val(null).trigger('change');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
