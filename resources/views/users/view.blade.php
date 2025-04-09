<x-app-layout>
    @push('title')
        {{ __('labels.view_user') }}
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
                                        aria-controls="user_view_details">{{ __('labels.details') }}
                                        <span class="ms-2 rotate-180">
                                            <i class="ki-duotone ki-down fs-3"></i>
                                        </span>
                                    </div>
                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Click To Edit">
                                        <a data-url="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-sm btn-light-primary ajaxedit">{{ __('labels.edit') }}</a>
                                    </span>
                                </div>
                                <div class="modal fade edit" tabindex="-1" aria-hidden="true">
                                </div>
                                <div class="separator"></div>
                                <div id="user_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">
                                        <div class="fw-bold mt-5">{{ __('labels.id') }}</div>
                                        <div class="text-gray-600">ID-{{ $user->id }}</div>
                                        <div class="fw-bold mt-5">{{ __('labels.email') }}</div>
                                        <div class="text-gray-600">
                                            <a
                                                class="text-gray-600 text-hover-primary CopyEmail cursor-pointer">{{ $user->email }}</a>
                                        </div>
                                        <div class="fw-bold mt-5">{{ __('labels.address') }}</div>
                                        <div class="text-gray-600">{{ $user->address }}</div>
                                        <div class="fw-bold mt-5">{{ __('labels.language') }}</div>
                                        <div class="text-gray-600">
                                            {{ array_search($user->language, config('app.languages')) ?: $user->language }}
                                        </div>
                                        <div class="fw-bold mt-5">{{ __('labels.last_login') }}</div>
                                        <div class="text-gray-600">
                                            {{ $user->last_login != null ? Helper::datetimeFormat($user->last_login) : 'NA' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#user_overview_events_and_logs_tab">{{ __('labels.sessions') }}</a>
                            </li>
                            <li class="nav-item ms-auto">
                                <a class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">{{ __('labels.actions') }}
                                    <i class="ki-duotone ki-down fs-2 me-0"></i></a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                                    data-kt-menu="true">
                                    <div class="menu-item px-5">
                                        <a href="#" class="menu-link text-danger px-5">{{ __('labels.delete') }}</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="user_overview_events_and_logs_tab" role="tabpanel">
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <div class="card-header border-0">
                                        <div class="card-title">
                                            <h2>{{ __('labels.login_sessions') }}</h2>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="{{ route('sessions.logoutAll', $user->id) }}"
                                                class="btn btn-sm btn-flex btn-light-primary">
                                                <i class="ki-duotone ki-entrance-right fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>{{ __('labels.logout_all') }}</a>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 pb-5">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                                    <tr class="text-start text-muted text-uppercase gs-0">
                                                        <th class="min-w-100px">{{ __('labels.location') }}</th>
                                                        <th>{{ __('labels.device') }}</th>
                                                        <th>{{ __('labels.ip_address') }}</th>
                                                        <th class="min-w-125px">{{ __('labels.time') }}</th>
                                                        <th class="min-w-70px">{{ __('labels.actions') }}</th>
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
                                                                    <span
                                                                        class="badge bg-primary">{{ __('labels.current_session') }}</span>
                                                                @else
                                                                    <a href="{{ route('sessions.logout', $session->id) }}"
                                                                        class="btn btn-sm btn-danger">{{ __('labels.sign_out') }}</a>
                                                                @endif
                                                            </td>
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
            </div>
        </div>
    @endsection
</x-app-layout>
