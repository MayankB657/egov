<x-app-layout>
    @push('title')
        Edit Permissions
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <form action="{{ route('permission-listing.update', $data->id) }}" autocomplete="off" method="POST"
                        class="form" id="FormId" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Permission Name</span>
                                </label>
                                <input class="form-control" value="{{ $data->name }}" name="name"
                                    placeholder="Enter Permission Name" data-bvalidator="required" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Controller Name</span>
                                </label>
                                <input class="form-control" value="{{ $data->controller }}"
                                    name="controller" placeholder="Enter Controller Name" data-bvalidator="required" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <a href="{{ route('permission-listing.index') }}" class="btn btn-light me-3">Discard</a>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
