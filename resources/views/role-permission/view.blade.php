<x-app-layout>
    @push('title')
        {{ __('labels.view_role') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-column flex-lg-row">
                    <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                        <div class="card card-flush">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="mb-0">{{ $Roles->name }}</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                @php
                                    $allActions = ['index', 'create', 'edit', 'show', 'update', 'destroy', 'store'];
                                    $groupedPermissions = $Roles->permissions->groupBy('controller');
                                @endphp
                                <div class="d-flex flex-column text-gray-600">
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
                                                : {{ __('labels.all_permissions') }}
                                            @else
                                                : {{ $permissionNames->join(', ') }}
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end ">
                                <a href="{{ route('role-permission.edit', $Roles->id) }}"
                                    class="btn btn-light btn-active-primary me-2">{{ __('labels.edit') }}
                                </a>
                                <form action="{{ route('role-permission.destroy', $Roles->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-light-danger btn-active-primary ConfirmDelete">{{ __('labels.delete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex-lg-row-fluid ms-lg-10">
                        <div class="card card-flush mb-6 mb-xl-9">
                            <div class="card-header pt-5">
                                <div class="card-title">
                                    <h2 class="d-flex align-items-center">{{ __('labels.user_assigned') }}
                                        <span class="text-gray-600 fs-6 ms-1">({{ $users->count() }})</span>
                                    </h2>
                                </div>
                                <div class="card-toolbar">
                                    <div class="d-flex align-items-center position-relative my-1"
                                        data-kt-view-roles-table-toolbar="base">
                                        <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" class="form-control w-250px ps-15" placeholder="{{ __('labels.search_user') }}"
                                            name="search" value="{{ request('search') }}" id="InputSearch"
                                            data-search-url="{{ route('role-permission.show', $Roles->id) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-50px">{{ __('labels.id') }}</th>
                                                <th class="min-w-150px">{{ __('labels.user') }}</th>
                                                <th class="min-w-125px">{{ __('labels.joined_date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600 tablebody">
                                            @include('role-permission.row', ['data' => $users])
                                        </tbody>
                                    </table>
                                    <div id="pagination-container">
                                        {!! $users->appends(Request::all())->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
