<x-app-layout>
    @push('title')
        View User
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-column flex-lg-row">
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <div class="card mb-5 mb-xl-8">
                            <div class="card-body">
                                <div class="d-flex flex-center flex-column py-5">
                                    @if ($user->photo == 'public/images/blank.svg')
                                        <div class="symbol symbol-100px symbol-circle mb-7">
                                            <div class="symbol-label fs-1 {{ Helper::randomBsColor() }}">
                                                {{ $user->name[0] }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="symbol symbol-100px symbol-circle mb-7">
                                            <img src="{{ url('/') }}/{{ $user->photo }}" alt="{{ $user->name[0] }}" />
                                        </div>
                                    @endif
                                    <a class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $user->name }}</a>
                                    <div class="mb-9">
                                        <div class="badge badge-lg badge-light-primary d-inline">
                                            {{ $user->roles->first()->name }}</div>
                                    </div>
                                </div>
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                        href="#user_view_details" role="button" aria-expanded="false"
                                        aria-controls="user_view_details">Details
                                        <span class="ms-2 rotate-180">
                                            <i class="ki-duotone ki-down fs-3"></i>
                                        </span>
                                    </div>
                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Click To Edit">
                                        <a data-url="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-sm btn-light-primary ajaxedit">Edit</a>
                                    </span>
                                </div>
                                <div class="modal fade edit" tabindex="-1" aria-hidden="true">
                                </div>
                                <div class="separator"></div>
                                <div id="user_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">
                                        <div class="fw-bold mt-5">Account ID</div>
                                        <div class="text-gray-600">ID-{{ $user->id }}</div>
                                        <div class="fw-bold mt-5">Email</div>
                                        <div class="text-gray-600">
                                            <a
                                                class="text-gray-600 text-hover-primary CopyEmail cursor-pointer">{{ $user->email }}</a>
                                        </div>
                                        <div class="fw-bold mt-5">Address</div>
                                        <div class="text-gray-600">{{ $user->address }}</div>
                                        <div class="fw-bold mt-5">Language</div>
                                        <div class="text-gray-600">
                                            {{ array_search($user->language, config('app.languages')) ?: $user->language }}
                                        </div>
                                        <div class="fw-bold mt-5">Last Login</div>
                                        <div class="text-gray-600">
                                            {{ $user->last_login != null ? Helper::datetimeFormat($user->last_login) : 'NA' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-5 mb-xl-8">
                            <div class="card-header border-0">
                                <div class="card-title">
                                    <h3 class="fw-bold m-0">Connected Accounts</h3>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <div
                                    class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                    <i class="ki-duotone ki-design-1 fs-2tx text-primary me-4"></i>
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <div class="fw-semibold">
                                            <div class="fs-6 text-gray-700">By connecting an account, you hereby agree
                                                to our
                                                <a href="#" class="me-1">privacy policy</a>and
                                                <a href="#">terms of use</a>.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-2">
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex">
                                            <img src="{{ url('/') }}/public/images/google-icon.svg"
                                                class="w-30px me-6" alt="" />
                                            <div class="d-flex flex-column">
                                                <a class="fs-5 text-gray-900 text-hover-primary fw-bold">Google</a>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <label
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" name="google" type="checkbox"
                                                    value="google" id="connected_accounts_google" disabled
                                                    {{ in_array('google', $user->sociallogin->pluck('type')->toArray()) ? 'checked' : '' }} />
                                                <span class="form-check-label fw-semibold text-muted"
                                                    for="connected_accounts_google"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed my-5"></div>
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex">
                                            <img src="{{ url('/') }}/public/images/facebook-3.svg" class="w-30px me-6"
                                                alt="" />
                                            <div class="d-flex flex-column">
                                                <a class="fs-5 text-gray-900 text-hover-primary fw-bold">Facebook</a>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <label
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" name="facebook" type="checkbox"
                                                    value="facebook" id="connected_accounts_facebook" disabled
                                                    {{ in_array('facebook', $user->sociallogin->pluck('type')->toArray()) ? 'checked' : '' }} />
                                                <span class="form-check-label fw-semibold text-muted"
                                                    for="connected_accounts_facebook"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            {{-- <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab"
                                        href="#user_view_overview_tab">Overview</a>
                                </li> --}}
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#user_overview_events_and_logs_tab">Sessions & Logs</a>
                            </li>
                            <li class="nav-item ms-auto">
                                <a class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-2 me-0"></i></a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                                    data-kt-menu="true">
                                    <div class="menu-item px-5">
                                        <a href="#" class="menu-link text-danger px-5">Delete customer</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            {{-- <div class="tab-pane fade" id="user_view_overview_tab" role="tabpanel">
                                    <div class="card card-flush mb-6 mb-xl-9">
                                        <div class="card-header mt-6">
                                            <div class="card-title flex-column">
                                                <h2 class="mb-1">User's Schedule</h2>
                                                <div class="fs-6 fw-semibold text-muted">2 upcoming meetings</div>
                                            </div>
                                            <div class="card-toolbar">
                                                <button type="button" class="btn btn-light-primary btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
                                                    <i class="ki-duotone ki-brush fs-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Add Schedule</button>
                                            </div>
                                        </div>
                                        <div class="card-body p-9 pt-4">
                                            <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2">
                                                @foreach ($daysList as $key => $day)
                                                    <li class="nav-item me-1">
                                                        <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary {{ $loop->first ? 'active' : '' }}"
                                                            data-bs-toggle="tab"
                                                            href="#schedule_day_{{ $key }}">
                                                            <span
                                                                class="opacity-50 fs-7 fw-semibold">{{ $day }}</span>
                                                            <span class="fs-6 fw-bolder">{{ $key }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @foreach ($daysList as $key => $day)
                                                    <div id="schedule_day_{{ $key }}"
                                                        class="tab-pane fade show {{ $loop->first ? 'active' : '' }}">
                                                        <div class="d-flex flex-stack position-relative mt-6">
                                                            <div
                                                                class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                            </div>
                                                            <div class="fw-semibold ms-5">
                                                                <div class="fs-7 mb-1">9:00 - 10:00
                                                                    <span class="fs-7 text-muted text-uppercase">am</span>
                                                                </div>
                                                                <a href="#"
                                                                    class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">{{ $key }}</a>
                                                                <div class="fs-7 text-muted">Lead by
                                                                    <a>Mark Randall</a>
                                                                </div>
                                                            </div>
                                                            <a href="#"
                                                                class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-flush mb-6 mb-xl-9">
                                        <div class="card-header mt-6">
                                            <div class="card-title flex-column">
                                                <h2 class="mb-1">User's Tasks</h2>
                                                <div class="fs-6 fw-semibold text-muted">Total 25 tasks in backlog</div>
                                            </div>
                                            <div class="card-toolbar">
                                                <button type="button" class="btn btn-light-primary btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal_add_task">
                                                    <i class="ki-duotone ki-add-files fs-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>Add Task</button>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex align-items-center position-relative mb-7">
                                                <div
                                                    class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                                </div>
                                                <div class="fw-semibold ms-5">
                                                    <a href="#"
                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary">Create
                                                        FureStibe branding logo</a>
                                                    <div class="fs-7 text-muted">Due in 1 day
                                                        <a href="#">Karina Clark</a>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="ki-duotone ki-setting-3 fs-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                    data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-gray-900 fw-bold">Update Status</div>
                                                    </div>
                                                    <div class="separator border-gray-200"></div>
                                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                        <div class="fv-row mb-10">
                                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                                            <select class="form-select form-select-solid"
                                                                name="task_status" data-kt-select2="true"
                                                                data-placeholder="Select option" data-allow-clear="true"
                                                                data-hide-search="true">
                                                                <option></option>
                                                                <option value="1">Approved</option>
                                                                <option value="2">Pending</option>
                                                                <option value="3">In Process</option>
                                                                <option value="4">Rejected</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button"
                                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                                data-kt-users-update-task-status="reset">Reset</button>
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                data-kt-users-update-task-status="submit">
                                                                <span class="indicator-label">Apply</span>
                                                                <span class="indicator-progress">Please wait...
                                                                    <span
                                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center position-relative mb-7">
                                                <div
                                                    class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                                </div>
                                                <div class="fw-semibold ms-5">
                                                    <a href="#"
                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary">Schedule a
                                                        meeting with FireBear CTO John</a>
                                                    <div class="fs-7 text-muted">Due in 3 days
                                                        <a href="#">Rober Doe</a>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="ki-duotone ki-setting-3 fs-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                    data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-gray-900 fw-bold">Update Status</div>
                                                    </div>
                                                    <div class="separator border-gray-200"></div>
                                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                        <div class="fv-row mb-10">
                                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                                            <select class="form-select form-select-solid"
                                                                name="task_status" data-kt-select2="true"
                                                                data-placeholder="Select option" data-allow-clear="true"
                                                                data-hide-search="true">
                                                                <option></option>
                                                                <option value="1">Approved</option>
                                                                <option value="2">Pending</option>
                                                                <option value="3">In Process</option>
                                                                <option value="4">Rejected</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button"
                                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                                data-kt-users-update-task-status="reset">Reset</button>
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                data-kt-users-update-task-status="submit">
                                                                <span class="indicator-label">Apply</span>
                                                                <span class="indicator-progress">Please wait...
                                                                    <span
                                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center position-relative mb-7">
                                                <div
                                                    class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                                </div>
                                                <div class="fw-semibold ms-5">
                                                    <a href="#"
                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary">9 Degree
                                                        Project Estimation</a>
                                                    <div class="fs-7 text-muted">Due in 1 week
                                                        <a href="#">Neil Owen</a>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="ki-duotone ki-setting-3 fs-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                    data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-gray-900 fw-bold">Update Status</div>
                                                    </div>
                                                    <div class="separator border-gray-200"></div>
                                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                        <div class="fv-row mb-10">
                                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                                            <select class="form-select form-select-solid"
                                                                name="task_status" data-kt-select2="true"
                                                                data-placeholder="Select option" data-allow-clear="true"
                                                                data-hide-search="true">
                                                                <option></option>
                                                                <option value="1">Approved</option>
                                                                <option value="2">Pending</option>
                                                                <option value="3">In Process</option>
                                                                <option value="4">Rejected</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button"
                                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                                data-kt-users-update-task-status="reset">Reset</button>
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                data-kt-users-update-task-status="submit">
                                                                <span class="indicator-label">Apply</span>
                                                                <span class="indicator-progress">Please wait...
                                                                    <span
                                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center position-relative mb-7">
                                                <div
                                                    class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                                </div>
                                                <div class="fw-semibold ms-5">
                                                    <a href="#"
                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary">Dashboard UI
                                                        & UX for Leafr CRM</a>
                                                    <div class="fs-7 text-muted">Due in 1 week
                                                        <a href="#">Olivia Wild</a>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="ki-duotone ki-setting-3 fs-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                    data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-gray-900 fw-bold">Update Status</div>
                                                    </div>
                                                    <div class="separator border-gray-200"></div>
                                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                        <div class="fv-row mb-10">
                                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                                            <select class="form-select form-select-solid"
                                                                name="task_status" data-kt-select2="true"
                                                                data-placeholder="Select option" data-allow-clear="true"
                                                                data-hide-search="true">
                                                                <option></option>
                                                                <option value="1">Approved</option>
                                                                <option value="2">Pending</option>
                                                                <option value="3">In Process</option>
                                                                <option value="4">Rejected</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button"
                                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                                data-kt-users-update-task-status="reset">Reset</button>
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                data-kt-users-update-task-status="submit">
                                                                <span class="indicator-label">Apply</span>
                                                                <span class="indicator-progress">Please wait...
                                                                    <span
                                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center position-relative">
                                                <div
                                                    class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                                </div>
                                                <div class="fw-semibold ms-5">
                                                    <a href="#"
                                                        class="fs-5 fw-bold text-gray-900 text-hover-primary">Mivy App R&D,
                                                        Meeting with clients</a>
                                                    <div class="fs-7 text-muted">Due in 2 weeks
                                                        <a href="#">Sean Bean</a>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="ki-duotone ki-setting-3 fs-3">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </button>
                                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                    data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-gray-900 fw-bold">Update Status</div>
                                                    </div>
                                                    <div class="separator border-gray-200"></div>
                                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                        <div class="fv-row mb-10">
                                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                                            <select class="form-select form-select-solid"
                                                                name="task_status" data-kt-select2="true"
                                                                data-placeholder="Select option" data-allow-clear="true"
                                                                data-hide-search="true">
                                                                <option></option>
                                                                <option value="1">Approved</option>
                                                                <option value="2">Pending</option>
                                                                <option value="3">In Process</option>
                                                                <option value="4">Rejected</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button"
                                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                                data-kt-users-update-task-status="reset">Reset</button>
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                data-kt-users-update-task-status="submit">
                                                                <span class="indicator-label">Apply</span>
                                                                <span class="indicator-progress">Please wait...
                                                                    <span
                                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            <div class="tab-pane fade show active" id="user_overview_events_and_logs_tab"
                                role="tabpanel">
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <div class="card-header border-0">
                                        <div class="card-title">
                                            <h2>Login Sessions</h2>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="{{ route('sessions.logoutAll', $user->id) }}"
                                                class="btn btn-sm btn-flex btn-light-primary">
                                                <i class="ki-duotone ki-entrance-right fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>Sign out all sessions</a>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 pb-5">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                                    <tr class="text-start text-muted text-uppercase gs-0">
                                                        <th class="min-w-100px">Location</th>
                                                        <th>Device</th>
                                                        <th>IP Address</th>
                                                        <th class="min-w-125px">Time</th>
                                                        <th class="min-w-70px">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fs-6 fw-semibold text-gray-600">
                                                    @foreach ($sessions as $session)
                                                        <tr>
                                                            <td>{{ $session->location }}</td>
                                                            <td>{{ $session->device }}</td>
                                                            <td>{{ $session->ip_address }}</td>
                                                            <td>{{ $session->last_activity }}</td>
                                                            <td>
                                                                @if ($session->id === session()->getId())
                                                                    <span class="badge bg-primary">Current
                                                                        session</span>
                                                                @else
                                                                    <a href="{{ route('sessions.logout', $session->id) }}"
                                                                        class="btn btn-sm btn-danger">Sign out</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <div class="card-header border-0">
                                        <div class="card-title">
                                            <h2>Logs</h2>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="{{ route('users.logs.download') }}"
                                                class="btn btn-sm btn-light-primary">
                                                <i class="ki-duotone ki-cloud-download fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>Download Report</a>
                                        </div>
                                    </div>
                                    <div class="card-body py-0">
                                        <div class="table-responsive">
                                            <table
                                                class="table align-middle table-row-dashed fw-semibold text-gray-600 fs-6 gy-5">
                                                <tbody>
                                                    @foreach ($logs as $log)
                                                        <tr>
                                                            <td class="min-w-70px">
                                                                <div
                                                                    class="badge badge-light-{{ $log->status_code == '200' ? 'success' : 'danger' }}">
                                                                    {{ $log->status_code }}
                                                                    {{ $log->status_code == '200' ? 'OK' : 'ERR' }}
                                                                </div>
                                                            </td>
                                                            <td>{{ $log->method }} {{ $log->endpoint }}</td>
                                                            <td class="pe-0 text-end min-w-200px">
                                                                {{ Helper::datetimeFormat($log->created_at) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="kt_modal_add_schedule" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="fw-bold">Add an Event</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                    data-kt-users-modal-action="close">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <form id="kt_modal_add_schedule_form" class="form" action="#">
                                    <div class="fv-row mb-7">
                                        <label class="required fs-6 fw-semibold form-label mb-2">Event Name</label>
                                        <input type="text" class="form-control form-control-solid" name="event_name"
                                            value="" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Date & Time</span>
                                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true" data-bs-content="Select a date & time.">
                                                <i class="ki-duotone ki-information fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <input class="form-control form-control-solid" placeholder="Pick date & time"
                                            name="event_datetime" id="kt_modal_add_schedule_datepicker" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fs-6 fw-semibold form-label mb-2">Event
                                            Organiser</label>
                                        <input type="text" class="form-control form-control-solid" name="event_org"
                                            value="" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fs-6 fw-semibold form-label mb-2">Send Event Details
                                            To</label>
                                        <input id="kt_modal_add_schedule_tagify" type="text"
                                            class="form-control form-control-solid" name="event_invitees"
                                            value="smith@kpmg.com, melody@altbox.com" />
                                    </div>
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                            data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="kt_modal_add_task" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="fw-bold">Add a Task</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                    data-kt-users-modal-action="close">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <form id="kt_modal_add_task_form" class="form" action="#">
                                    <div class="fv-row mb-7">
                                        <label class="required fs-6 fw-semibold form-label mb-2">Task Name</label>
                                        <input type="text" class="form-control form-control-solid" name="task_name"
                                            value="" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Task Due Date</span>
                                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true" data-bs-content="Select a due date.">
                                                <i class="ki-duotone ki-information fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <input class="form-control form-control-solid" placeholder="Pick date"
                                            name="task_duedate" id="kt_modal_add_task_datepicker" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mb-2">Task Description</label>
                                        <textarea class="form-control form-control-solid rounded-3"></textarea>
                                    </div>
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                            data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
