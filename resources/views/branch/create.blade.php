<x-app-layout>
    @push('title')
        Add Branch
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <form action="{{ route('branch.store') }}" autocomplete="off" method="POST" class="form ajax-form-submit"
                        data-preloader="true" data-reset="true" data-refresh="true" id="FormId"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Name</span>
                                </label>
                                <input class="form-control" name="name" placeholder="Enter Name"
                                    data-bvalidator="required" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Department</span>
                                </label>
                                <select class="form-select fw-bold" data-placeholder="Select Department"
                                    data-bvalidator="required" name="department_id" data-control="select2">
                                    <option hidden></option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Address</span>
                                </label>
                                <textarea name="address" rows="4" class="form-control" placeholder="Enter Address" data-bvalidator="required"></textarea>
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Email</span>
                                </label>
                                <input class="form-control" name="email" placeholder="Enter Email"
                                    data-bvalidator="required" />
                            </div>
                            <div class="fv-row mb-7 form-group">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Contact</span>
                                </label>
                                <input class="form-control" name="contact" placeholder="Enter Contact Number"
                                    data-bvalidator="required" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <a href="{{ route('branch.index') }}" class="btn btn-light me-3">Discard</a>
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
