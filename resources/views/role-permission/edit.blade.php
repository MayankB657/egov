<x-app-layout>
    @push('title')
        Edit Role
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div class="container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <form class="form" id="FormId" method="POST" action="{{ route('role-permission.update', $Roles->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label required fw-semibold fs-6">Role
                                    Name
                                </label>
                                <div class="col-lg-10 form-group">
                                    <input type="text" data-bvalidator="maxlen[20],required"
                                        class="form-control form-control-lg mb-3 mb-lg-0" name="RoleName"
                                        value="{{ $Roles->name }}" />
                                </div>
                            </div>
                            <div class="row mb-6">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <tbody class="text-gray-600 fw-bold">
                                            <tr>
                                                <td class="text-gray-800">Administrator Access
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                        title="Allows a full access to the system"></i>
                                                </td>
                                                <td>
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="RoleSelectAll" />
                                                        <span class="form-check-label" for="RoleSelectAll">Select
                                                            all</span>
                                                    </label>
                                                </td>
                                            </tr>
                                            @foreach ($AllPermission as $value)
                                                <tr>
                                                    <td class="text-gray-800">
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <span
                                                                class="form-check-label me-2 col-10">{{ $value->controller }}</span>
                                                            <input
                                                                class="form-check-input SelectRoleRow {{ $value->controller }}"
                                                                type="checkbox" />
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            @foreach (json_decode($value->permission) as $item)
                                                                @if (strpos($item->name, '.') !== false)
                                                                    @php
                                                                        $Split = explode('.', $item->name);
                                                                    @endphp
                                                                @endif
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                                    <input
                                                                        class="form-check-input CheckAll {{ $value->controller }}"
                                                                        type="checkbox"
                                                                        @if (in_array($item->id, $PermissionArray)) checked @endif
                                                                        value="{{ $item->id }}" name="permission[]" />
                                                                    <span class="form-check-label">
                                                                        @if (strpos($item->name, '.') !== false)
                                                                            {{ ucfirst($Split[1]) }}
                                                                        @else
                                                                            {{ ucfirst($item->name) }}
                                                                        @endif
                                                                    </span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ route('role-permission.index') }}"
                                class="btn btn-light btn-active-light-primary me-2">Discard</a>
                            <button type="submit" class="btn btn-primary">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
