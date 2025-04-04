<x-app-layout>
    @push('title')
        Users
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" class="form-control w-250px ps-13" placeholder="Search User"
                                    name="search" value="{{ request('search') }}" id="InputSearch"
                                    data-search-url="{{ route('users.index') }}" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Filter</button>
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <form action="{{ route('users.index') }}" method="GET">
                                        <div class="px-7 py-5">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-semibold">Role:</label>
                                                <select class="form-select fw-bold" name="filter_role"
                                                    data-kt-select2="true" data-placeholder="Select role"
                                                    data-allow-clear="true" data-hide-search="true">
                                                    <option></option>
                                                    @foreach ($RoleList as $role)
                                                        <option value="{{ $role->name }}"
                                                            @if (request('filter_role') == $role->name) selected @endif>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="reset"
                                                    class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                    data-kt-menu-dismiss="true"
                                                    data-kt-user-table-filter="reset">Reset</button>
                                                <button type="submit" class="btn btn-primary fw-semibold px-6"
                                                    data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                    </form>
                                </div>
                                @can('users.create')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#add_user">
                                        <i class="ki-duotone ki-plus fs-2"></i>Add User</button>
                                @endcan
                            </div>
                            <div class="modal fade" id="add_user" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <div class="modal-header" id="kt_modal_add_user_header">
                                            <h2 class="fw-bold">Add User</h2>
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                data-bs-dismiss="modal">
                                                <i class="ki-duotone ki-cross fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="modal-body px-5 my-7">
                                            <form id="FormId" class="form ajax-form-submit"
                                                action="{{ route('users.store') }}" enctype="multipart/form-data"
                                                method="POST" data-dismiss-modal="add_user" data-preloader="false"
                                                data-refresh="false">
                                                @csrf
                                                <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                                    id="kt_modal_add_user_scroll" data-kt-scroll="true"
                                                    data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                                                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                                                    data-kt-scroll-offset="300px">
                                                    <div class="row mb-6 mt-5">
                                                        <label
                                                            class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                                        <div class="col-lg-8">
                                                            <div class="image-input image-input-circle"
                                                                data-kt-image-input="true">
                                                                <div
                                                                    class="image-input-wrapper w-125px h-125px glowing-border">
                                                                </div>
                                                                <label
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="change"
                                                                    data-bs-toggle="tooltip" title="Change avatar">
                                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                                    <input type="file" name="photo" class="imgVal"
                                                                        accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="avatar_remove" />
                                                                </label>
                                                                <span
                                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                    data-kt-image-input-action="cancel"
                                                                    data-bs-toggle="tooltip" title="Cancel avatar">
                                                                    <i class="bi bi-x fs-2"></i>
                                                                </span>
                                                            </div>
                                                            <div class="form-text">Allowed file types: png, jpg, jpeg.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="fv-row mb-7 form-group">
                                                        <label class="required fw-semibold fs-6 mb-2">Full
                                                            Name</label>
                                                        <input type="text" name="name"
                                                            class="form-control mb-3 mb-lg-0" placeholder="Enter name"
                                                            data-bvalidator="required" />
                                                    </div>
                                                    <div class="fv-row mb-7 form-group">
                                                        <label class="required fw-semibold fs-6 mb-2">Email</label>
                                                        <input type="email" name="email"
                                                            class="form-control mb-3 mb-lg-0"
                                                            placeholder="example@domain.com"
                                                            data-bvalidator="email,required"
                                                            data-bvalidator-msg="Enter email address." />
                                                    </div>
                                                    <div class="fv-row mb-2 form-group" data-kt-password-meter="true">
                                                        <label
                                                            class="form-label required fs-6 fw-bold mb-2">Password</label>

                                                        <div class="position-relative mb-3">
                                                            <input class="form-control form-control-lg" type="password"
                                                                name="password" autocomplete="off"
                                                                data-bvalidator="required,passwordFormat"
                                                                placeholder="Enter Password"
                                                                data-bvalidator-msg="Paasword strength must be 100%." />
                                                            <span
                                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showPassword">
                                                                <i class="mb mb-eye-close text-muted fs-1"></i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-3"
                                                            data-kt-password-meter-control="highlight">
                                                            <div
                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                            </div>
                                                            <div
                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                            </div>
                                                            <div
                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                            </div>
                                                            <div
                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-text mb-5">Password must be at least 8 character
                                                        and contain number, a-z, A-Z.</div>
                                                    <div class="fv-row mb-7 form-group">
                                                        <label class="fw-semibold fs-6 mb-2">Address</label>
                                                        <textarea name="address" rows="4" class="form-control mb-3 mb-lg-0" placeholder="Enter address"></textarea>
                                                    </div>
                                                    <div class="fv-row mb-7 form-group">
                                                        <label class="required fw-semibold fs-6 mb-2">Language</label>
                                                        <div class="d-flex fv-row">
                                                            <select class="form-select fw-bold" data-control="select2"
                                                                data-dropdown-parent="body" data-hide-search="true"
                                                                data-placeholder="Select language"
                                                                data-bvalidator="required" name="language">
                                                                <option hidden></option>
                                                                @foreach (config('app.languages') ?? [] as $key => $lang)
                                                                    <option value="{{ $lang }}">
                                                                        {{ $key }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="fv-row mb-7 form-group">
                                                        <label class="required fw-semibold fs-6 mb-2">Role</label>
                                                        <div class="d-flex fv-row">
                                                            <select class="form-select fw-bold"
                                                                data-placeholder="Select role" data-bvalidator="required"
                                                                data-control="select2" data-dropdown-parent="body"
                                                                data-hide-search="true" name="role">
                                                                <option></option>
                                                                @foreach ($RoleList as $role)
                                                                    <option value="{{ $role->id }}">{{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center pt-10">
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
                            <div class="modal fade edit" id="edit_user" tabindex="-1" aria-hidden="true">
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="">Sr No</th>
                                        <th class="min-w-125px">User</th>
                                        <th class="min-w-125px">Role</th>
                                        <th class="min-w-125px">Last login</th>
                                        <th class="min-w-125px">Two-step</th>
                                        <th class="min-w-125px">Joined Date</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold tablebody">
                                    @include('users.row', ['data' => $data, 'i' => $i])
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
