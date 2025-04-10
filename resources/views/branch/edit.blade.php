<x-app-layout>
    @push('title')
        {{ __('labels.edit_branch') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <form action="{{ route('branch.update', base64UrlEncode($data->id)) }}" autocomplete="off" method="POST"
                        class="form ajax-form-submit" data-preloader="true" data-reset="false" data-refresh="true"
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
                                    <span class="required">{{ __('labels.address') }}</span>
                                </label>
                                <textarea name="address" rows="4" class="form-control" placeholder="{{ __('labels.enter_address') }}"
                                    data-bvalidator="required">{{ $data->address }}</textarea>
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.email') }}</span>
                                </label>
                                <input class="form-control" name="email" placeholder="{{ __('labels.enter_email') }}"
                                    data-bvalidator="required" value="{{ $data->email }}" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.contact') }}</span>
                                </label>
                                <input class="form-control" name="contact" placeholder="{{ __('labels.enter_contact') }}"
                                    data-bvalidator="required" value="{{ $data->contact }}" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <a href="{{ route('branch.index') }}"
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
</x-app-layout>
