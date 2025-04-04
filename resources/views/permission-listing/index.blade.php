<x-app-layout>
    @push('title')
        Permissions
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
                                <input type="text" class="form-control w-250px ps-13" placeholder="Search Permissions"
                                    name="search" value="{{ request('search') }}" id="InputSearch"
                                    data-search-url="{{ route('permission-listing.index') }}" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#add_permission">
                                <i class="ki-duotone ki-plus-square fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>Add Permission</button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="">Sr.No</th>
                                        <th class="min-w-125px">Name</th>
                                        <th class="min-w-250px">Permission</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600 tablebody">
                                    @include('permission-listing.row', ['data' => $data, 'i' => $i])
                                </tbody>
                            </table>
                            <div id="pagination-container">
                                {!! $data->appends(Request::all())->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="add_permission" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="fw-bold">Add a Permission</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body mx-5 mx-xl-15 my-7">
                                <form autocomplete="off" method="POST" class="form ajax-form-submit" id="FormId"
                                    enctype="multipart/form-data" action="{{ route('permission-listing.store') }}"
                                    data-preloader="false" data-refresh="false" data-dismiss-modal="add_permission">
                                    @csrf
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Permission Name</span>
                                        </label>
                                        <input class="form-control" placeholder="Enter a permission name"
                                            name="permission_name" data-bvalidator="required" />
                                    </div>
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Controller Name</span>
                                        </label>
                                        <input class="form-control" placeholder="Enter a permission name"
                                            name="controller_name" data-bvalidator="required" />
                                    </div>
                                    <div class="fv-row mb-7 form-group">
                                        <label class="form-check form-check-custom form-check-solid me-9">
                                            <input class="form-check-input" type="checkbox" value="on" name="resource"
                                                id="resources" />
                                            <span class="form-check-label" for="resources"><span
                                                    class="text-danger">Note</span>: Check if route is
                                                resource.</span>
                                        </label>
                                    </div>
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Role Name</span>
                                        </label>
                                        @foreach ($RoleList as $key => $item)
                                            <div class="col-lg-1">
                                                <div class="d-flex align-items-center mt-3">
                                                    <label class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" name="roles[]"
                                                            @if ($key == $RoleList->count() - 1) data-bvalidator="min[1],required" @endif
                                                            type="checkbox" value="{{ $item->name }}"
                                                            data-bvalidator-msg="Select minimum one role." />
                                                        <span class="fw-bold ps-2 fs-5 ">{{ $item->name }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="text-center">
                                        <button type="reset" class="btn btn-light me-3"
                                            data-bs-dismiss="modal">Discard</button>
                                        <button type="submit" class="btn btn-success me-10 btn-submit">
                                            <span class="indicator-label">
                                                Submit
                                            </span>
                                            <span class="indicator-progress">
                                                Please wait... <span
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
