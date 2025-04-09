<x-app-layout>
    @push('title')
        {{ __('labels.edit_department') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <form action="{{ route('department.update', $data->id) }}" autocomplete="off" method="POST"
                        class="form ajax-form-submit" data-preloader="true" data-reset="false" data-refresh="true"
                        id="FormId" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.name') }}</span>
                                </label>
                                <input class="form-control" name="name" placeholder="Enter Name"
                                    data-bvalidator="required" value="{{ $data->name }}" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.email') }}</span>
                                </label>
                                <input class="form-control" name="email" placeholder="Enter Email"
                                    data-bvalidator="required" value="{{ $data->email }}" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.contact') }}</span>
                                </label>
                                <input class="form-control" name="contact" placeholder="Enter Contact Number"
                                    data-bvalidator="required" value="{{ $data->contact }}" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <a href="{{ route('department.index') }}"
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
