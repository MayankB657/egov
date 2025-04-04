<div id="kt_header" style="" class="header align-items-stretch">
    <div class="header-brand">
        <a href="{{ route('dashboard.index') }}">
            <img alt="Logo" src="{{ url('/') }}/public/images/logo.svg" class="h-35px h-lg-35px" />
        </a>
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <i class="ki-duotone ki-entrance-right fs-1 me-n1 minimize-default">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <i class="ki-duotone ki-entrance-left fs-1 minimize-active">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <div class="d-flex align-items-center d-lg-none me-n2" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
    </div>
    <div class="toolbar d-flex align-items-stretch">
        <div
            class="container-fluid py-6 py-lg-0 d-flex flex-row align-items-stretch justify-content-between">
            <div class="page-title d-flex justify-content-center flex-column me-5">
                <h1 class="d-flex flex-column text-gray-900 fw-bold fs-3 mb-0">
                    @stack('title')
                </h1>
            </div>
            <div class="d-flex align-items-stretch overflow-auto pt-3 pt-lg-0">
                <div class="d-flex align-items-center">
                    <div class="app-navbar-item ms-1 ms-md-4">
                        <div class="btn btn-icon btn-custom btn-active-color-primary w-35px h-35px position-relative"
                            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                            data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
                            <i class="ki-duotone ki-message-text-2 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            @if ($user->unreadNotifications->count() > 0)
                                <span
                                    class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                            @endif
                        </div>
                        <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true"
                            id="kt_menu_notifications">
                            <div class="d-flex flex-stack rounded-top px-9 border-bottom border-2 border-primary">
                                <h3 class="fw-semibold mt-5">Notifications
                                    @if ($user->unreadNotifications->count() > 0)
                                        <span
                                            class="opacity-75 badge badge-sm fs-8 badge-circle badge-outline badge-success badgeCounter">{{ $user->unreadNotifications->count() }}</span>
                                    @endif
                                </h3>
                                @if ($user->unreadNotifications->count() > 0)
                                    <a class="mt-5" href="{{ route('MarkAllRead') }}" id="MarkAllRead">Mark all
                                        read</a>
                                @endif
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active">
                                    <div class="scroll-y mh-325px px-8 noti-div">
                                        @if ($user->unreadNotifications->count() > 0)
                                            @foreach ($user->unreadNotifications as $notification)
                                                <div class="d-flex flex-stack py-4 noti-item"
                                                    data-id="{{ $notification->id }}"
                                                    data-url="{{ route('ShowNotification', $notification->id) }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="mb-0 me-2">
                                                            <a href="#"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-bold">{{ $notification->data['title'] }}
                                                                : <span
                                                                    class="text-muted">{{ substr($notification->data['description'], 0, 18) }}...</span></a>
                                                            <div class="text-gray-500 fs-7">{{ $notification->type }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="badge badge-light fs-8">{{ Helper::DateHumanShort($notification->created_at) }}</span>
                                                </div>
                                                {{-- <div class="d-flex flex-stack py-4">
                                                    <!--begin::Section-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-35px me-4">
                                                            <span class="symbol-label bg-light-warning">
                                                                <i class="ki-duotone ki-briefcase fs-2 text-warning">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Title-->
                                                        <div class="mb-0 me-2">
                                                            <a href="#"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-bold">Company
                                                                HR</a>
                                                            <div class="text-gray-500 fs-7">Corporeate staff profiles
                                                            </div>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Section-->
                                                    <!--begin::Label-->
                                                    <span class="badge badge-light fs-8">5 hrs</span>
                                                    <!--end::Label-->
                                                </div> --}}
                                            @endforeach
                                        @else
                                            <div class="my-5 text-center">
                                                <label>No new notification.</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary ms-1 ms-md-2"
                        data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="bi bi-sun-fill theme-light-show fs-4"></i>
                        <i class="bi bi-moon-fill theme-dark-show fs-4"></i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="bi bi-sun-fill fs-2"></i>
                                </span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="bi bi-moon-fill fs-2"></i>
                                </span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="bi bi-display fs-2"></i>
                                </span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ProfilModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="mt-1 me-1">
                <button style="float: right;" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="text-center">
                    <img src="" id="SetProfile" class="w-100 mh-400px d-none">
                    <video src="" id="SetVideo" controls class="w-100 mh-400px d-none">
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.notification-model')
