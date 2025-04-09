<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
            data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('dashboard*') ? 'active' : '' }}"
                        href="{{ route('dashboard.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-microsoft fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('labels.dashboard') }}</span>
                    </a>
                </div>
                @if (Auth::user()->can('inward-letter.index') ||
                        Auth::user()->can('inward-letter.create') ||
                        Auth::user()->can('outward-letter.create') ||
                        Auth::user()->can('outward-letter.index'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ Route::is('inward-letter*') || Route::is('outward-letter*') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-arrow-down-up fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('labels.inward_outward_management') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('inward-letter.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('inward-letter.index') ? 'active' : '' }}"
                                        href="{{ route('inward-letter.index') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-envelope-fill fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.inward_letter') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('inward-letter.create')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('inward-letter.create') ? 'active' : '' }}"
                                        href="{{ route('inward-letter.create') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-envelope-plus fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.add_inward_letter') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('outward-letter.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('outward-letter.index') ? 'active' : '' }}"
                                        href="{{ route('outward-letter.index') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-envelope-fill fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.outward_letter') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('outward-letter.create')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('outward-letter.create') ? 'active' : '' }}"
                                        href="{{ route('outward-letter.create') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-envelope-plus fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.add_outward_letter') }}</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endif
                @if (Auth::user()->can('case.index') || Auth::user()->can('case.create'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ Route::is('case*') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-journal fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('labels.case_management') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('case.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('case.index') ? 'active' : '' }}"
                                        href="{{ route('case.index') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-journal-text fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.case') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('case.create')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('case.create') ? 'active' : '' }}"
                                        href="{{ route('case.create') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-journal-plus fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.add_case') }}</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endif
                @if (Auth::user()->can('role-permission.index') ||
                        Auth::user()->can('users.index') ||
                        Auth::user()->can('branch.index') ||
                        Auth::user()->can('subject.index') ||
                        Auth::user()->can('department.index') ||
                        Auth::user()->can('permission-listing.index'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ Route::is('role-permission*') ||
                        Route::is('users*') ||
                        Route::is('branch*') ||
                        Route::is('subject*') ||
                        Route::is('department*') ||
                        Route::is('permission-listing*')
                            ? 'show'
                            : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-gear-fill fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('labels.settings') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @if (Auth::user()->can('users.index') ||
                                    Auth::user()->can('role-permission.index') ||
                                    Auth::user()->can('permission-listing.index'))
                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="right-start"
                                    class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention">
                                    <span
                                        class="menu-link {{ Route::is('role-permission*') || Route::is('users*') || Route::is('permission-listing*') ? 'active' : '' }}"
                                        onclick="redirectToIndex('users')">
                                        <span class="menu-icon">
                                            <i class="bi bi-people-fill fs-2"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.users') }}</span>
                                        <span class="menu-arrow"><i
                                                class="bi bi-chevron-right fs-9 text-light"></i></span>
                                    </span>
                                    <div
                                        class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-2 py-4 w-200px mh-75 overflow-auto">
                                        @can('users.index')
                                            <div class="menu-item">
                                                <a class="menu-link {{ Route::is('users*') ? 'active' : '' }}"
                                                    href="{{ route('users.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="bi bi-person-lines-fill fs-3"></i>
                                                    </span>
                                                    <span class="menu-title">{{ __('labels.list') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('role-permission.index')
                                            <div class="menu-item">
                                                <a class="menu-link {{ Route::is('role-permission*') ? 'active' : '' }}"
                                                    href="{{ route('role-permission.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="bi bi-person-heart fs-3"></i>
                                                    </span>
                                                    <span class="menu-title">{{ __('labels.roles') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('permission-listing.index')
                                            <div class="menu-item">
                                                <a class="menu-link {{ Route::is('permission-listing*') ? 'active' : '' }}"
                                                    href="{{ route('permission-listing.index') }}">
                                                    <span class="menu-icon">
                                                        <i class="bi bi-person-fill-gear fs-3"></i>
                                                    </span>
                                                    <span class="menu-title">{{ __('labels.permissions') }}</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            @endif
                            @can('department.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('department*') ? 'active' : '' }}"
                                        href="{{ route('department.index') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-list-columns-reverse fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.department') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('branch.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('branch*') ? 'active' : '' }}"
                                        href="{{ route('branch.index') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-list-columns-reverse fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.branch') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('subject.index')
                                <div class="menu-item">
                                    <a class="menu-link {{ Route::is('subject*') ? 'active' : '' }}"
                                        href="{{ route('subject.index') }}">
                                        <span class="menu-icon">
                                            <i class="bi bi-list-columns-reverse fs-4"></i>
                                        </span>
                                        <span class="menu-title">{{ __('labels.subject') }}</span>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
        <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
            @if ($user->photo == 'public/images/blank.svg')
                <div class="symbol symbol-circle symbol-50px overflow-hidden">
                    <div class="symbol-label fs-3 {{ Helper::randomBsColor() }}">
                        {{ $user->name[0] }}
                    </div>
                </div>
            @else
                <a class="d-block overlay symbol symbol-circle symbol-50px" data-fslightbox="lightbox-basic"
                    href="{{ url('/') }}/{{ $user->photo }}">
                    <img src="{{ url('/') }}/{{ $user->photo }}" alt="" class="overlay-wrapper" />
                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                        <i class="bi bi-eye-fill text-white fs-6"></i>
                    </div>
                </a>
            @endif
            <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
                <div class="d-flex">
                    <div class="flex-grow-1 me-2">
                        <a href="{{ route('profile.index') }}"
                            class="text-white text-hover-primary fs-6 fw-bold">{{ $user->name }}</a>
                        <span
                            class="text-gray-600 fw-semibold d-block fs-8 mb-1">{{ $user->roles->first()->name }}</span>
                        @if ($user->is_online == '1')
                            <div class="d-flex align-items-center text-success fs-9">
                                <span class="bullet bullet-dot bg-success me-1"></span>online
                            </div>
                        @elseif ($user->is_online == '2')
                            <div class="d-flex align-items-center text-warning fs-9">
                                <span class="bullet bullet-dot bg-warning me-1"></span>ideal
                            </div>
                        @endif
                    </div>
                    <div class="me-n2">
                        <a class="btn btn-icon btn-sm btn-active-color-primary mt-n2"
                            data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-setting-2 text-muted fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                            data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    @if ($user->photo == 'public/images/blank.svg')
                                        <div class="symbol symbol-circle symbol-50px me-5 overflow-hidden">
                                            <div class="symbol-label fs-3 {{ Helper::randomBsColor() }}">
                                                {{ $user->name[0] }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="symbol symbol-circle symbol-50px me-5">
                                            <img alt="Logo" src="{{ url('/') }}/{{ $user->photo }}" />
                                        </div>
                                    @endif
                                    <div class="d-flex flex-column">
                                        <div class="fw-bold d-flex align-items-center fs-5">{{ $user->name }}</div>
                                        <span
                                            class="fw-semibold text-muted text-hover-primary fs-7 CopyEmail cursor-pointer"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Click to Copy">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-5">
                                <a href="{{ route('profile.index') }}"
                                    class="menu-link px-5">{{ __('labels.my_profile') }}</a>
                            </div>
                            <div class="menu-item px-5">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn menu-link px-5">{{ __('labels.sign_out') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
