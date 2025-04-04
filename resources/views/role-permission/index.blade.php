<x-app-layout>
    @push('title')
        Roles
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                    @foreach ($Role as $value)
                        <div class="col-md-4">
                            <div class="card card-flush h-md-100">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ ucfirst($value->name) }}</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-1">
                                    <div class="fw-bold text-gray-600 mb-5">Total users with this role:
                                        {{ $roleUserCounts[$value->name] ?? 0 }}</div>
                                    <div class="d-flex flex-column text-gray-600">
                                        @php
                                            $allActions = [
                                                'index',
                                                'create',
                                                'edit',
                                                'show',
                                                'update',
                                                'destroy',
                                                'store',
                                            ];
                                            $groupedPermissions = $value->permissions->groupBy('controller');
                                        @endphp
                                        @foreach ($groupedPermissions as $controllerName => $permissions)
                                            <div class="d-flex align-items-center py-2">
                                                <span
                                                    class="bullet bg-primary me-3"></span>{{ Str::replaceLast('Controller', '', $controllerName) }}
                                                @php
                                                    $permissionNames = $permissions->map(function ($permission) {
                                                        return explode('.', $permission->name)[1] ?? '';
                                                    });
                                                    $hasAllPermissions = collect($allActions)
                                                        ->diff($permissionNames)
                                                        ->isEmpty();
                                                @endphp
                                                @if ($hasAllPermissions)
                                                    : All permissions
                                                @else
                                                    : {{ $permissionNames->join(', ') }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer flex-wrap pt-0">
                                    <a href="{{ route('role-permission.show', $value->id) }}"
                                        class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                                    <a href="{{ route('role-permission.edit', $value->id) }}"
                                        class="btn btn-light btn-active-light-primary my-1">Edit
                                        Role</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-4">
                        <div class="card h-md-100">
                            <div class="card-body d-flex flex-center">
                                <button type="button" class="btn btn-clear d-flex flex-column flex-center"
                                    data-bs-toggle="modal" data-bs-target="#modal_add_role">
                                    <img src="{{ url('/') }}/public/images/4.png" alt=""
                                        class="mw-100 mh-150px mb-7" />
                                    <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal_add_role" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-750px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="fw-bold">Add a Role</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body mx-lg-5 my-7">
                                <form class="form ajax-form-submit" action="{{ route('role-permission.store') }}"
                                    method="POST" id="FormId" data-dismiss-modal="modal_add_role" data-preloader="false"
                                    data-refresh="false">
                                    @csrf
                                    <div class="d-flex flex-column me-n7 pe-7">
                                        <div class="fv-row form-group">
                                            <label class="fs-5 fw-bold form-label mb-2">
                                                <span class="required">Role name</span>
                                            </label>
                                            <input placeholder="Enter a role name" data-bvalidator="maxlen[20],required"
                                                class="form-control" name="role" />
                                        </div>
                                    </div>
                                    <div class="text-center pt-15">
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
        {!! $Role->appends(Request::all())->links() !!}
    @endsection
</x-app-layout>
