<x-app-layout>
    @push('title')
        {{ __('labels.add_department') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <form action="{{ route('department.store') }}" autocomplete="off" method="POST"
                        class="form ajax-form-submit" data-preloader="true" data-reset="true" data-refresh="true"
                        id="FormId" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.name') }}</span>
                                </label>
                                <input class="form-control" name="name" placeholder="{{ __('labels.enter_name') }}"
                                    data-bvalidator="required" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.email') }}</span>
                                </label>
                                <input class="form-control" name="email" placeholder="{{ __('labels.enter_email') }}"
                                    data-bvalidator="required" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">{{ __('labels.contact') }}</span>
                                </label>
                                <input class="form-control" name="contact" placeholder="{{ __('labels.enter_contact') }}"
                                    data-bvalidator="required" />
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
