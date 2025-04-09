<x-app-layout>
    @push('title')
        {{ __('labels.profile') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('labels.profile_details') }}</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <form class="form FormClass" method="POST" action="{{ route('profile.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="details">
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('labels.photo') }}</label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-circle glowing-border"
                                            data-kt-image-input="true">
                                            <div class="image-input-wrapper w-125px h-125px bgi-size-contain bgi-position-center"
                                                @if ($user->photo != 'public/images/blank.svg') style="background-image: url('{{ url('/') }}/{{ $user->photo }}')" @endif>
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="photo" class="imgVal"
                                                    accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            @if ($user->photo != 'public/images/blank.svg')
                                                <span
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                    title="Remove avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-text">{{ __('labels.allowed_file_types') }}: png, jpg, jpeg.</div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label
                                        class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('labels.name') }}</label>
                                    <div class="col-lg-8 fv-row form-group">
                                        <input type="text" name="name" class="form-control form-control-lg"
                                            placeholder="Name" data-bvalidator="required" value="{{ $user->name }}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label
                                        class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('labels.address') }}</label>
                                    <div class="col-lg-8 fv-row form-group">
                                        <textarea name="address" rows="4" class="form-control form-control-lg" placeholder="Address">{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label
                                        class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('labels.language') }}</label>
                                    <div class="col-lg-8 fv-row form-group">
                                        <select class="form-select fw-bold" data-control="select2"
                                            data-placeholder="Select language" data-bvalidator="required" name="language">
                                            <option hidden></option>
                                            @foreach (config('app.languages') ?? [] as $key => $lang)
                                                <option value="{{ $lang }}"
                                                    {{ $lang == $user->language ? 'selected' : '' }}>
                                                    {{ $key }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">{{ __('labels.discard') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('labels.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-10" id="LoginSessions">
                    <div class="card-header border-0">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('labels.login_sessions') }}</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('sessions.logoutAll', Auth::id()) }}"
                                class="btn btn-sm btn-flex btn-light-primary">
                                <i class="ki-duotone ki-entrance-right fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>{{ __('labels.logout_all') }}</a>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body pt-0 pb-0 border-top px-9">
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
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('labels.signin_method') }}</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="d-flex flex-wrap align-items-center">
                                <div id="kt_signin_email">
                                    <div class="fs-6 fw-bold mb-1">{{ __('labels.email') }}</div>
                                    <div class="fw-semibold text-gray-600">{{ $user->email }}</div>
                                </div>
                                <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                    <form class="form FormClass" action="{{ route('profile.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="email">
                                        <div class="row mb-6">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <label for="emailaddress"
                                                        class="form-label fs-6 fw-bold mb-3">{{ __('labels.new_email') }}</label>
                                                    <input type="email" class="form-control form-control-lg"
                                                        id="emailaddress" placeholder="Email Address" name="email"
                                                        value="{{ $user->email }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="fv-row mb-0 form-group">
                                                    <label for="confirmemailpassword"
                                                        class="form-label fs-6 fw-bold mb-3">{{ __('labels.confirm_password') }}</label>
                                                    <input type="password" class="form-control form-control-lg"
                                                        data-bvalidator="required" name="confirmemailpassword"
                                                        id="confirmemailpassword" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button id="kt_signin_cancel" type="reset"
                                                class="btn btn-color-gray-500 btn-active-light-primary me-2 px-6">{{ __('labels.discard') }}</button>
                                            <button type="submit"
                                                class="btn btn-primary px-6">{{ __('labels.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="kt_signin_email_button" class="ms-auto">
                                    <button
                                        class="btn btn-light btn-active-light-primary">{{ __('labels.change_email') }}</button>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-6"></div>
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <div id="kt_signin_password">
                                    <div class="fs-6 fw-bold mb-1">{{ __('labels.password') }}</div>
                                    <div class="fw-semibold text-gray-600">************</div>
                                </div>
                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                    <form class="form FormClass" action="{{ route('profile.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="password">
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0 form-group">
                                                    <label for="currentpassword"
                                                        class="form-label required fs-6 fw-bold mb-3">{{ __('labels.current_password') }}</label>
                                                    <input type="password" class="form-control form-control-lg"
                                                        name="currentpassword" data-bvalidator="required"
                                                        id="currentpassword" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0 form-group">
                                                    <label for="newpassword"
                                                        class="form-label required fs-6 fw-bold mb-3">{{ __('labels.new_password') }}</label>
                                                    <input type="password" class="form-control form-control-lg"
                                                        name="newpassword" data-bvalidator="required,passwordFormat"
                                                        id="newpassword" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0 form-group">
                                                    <label for="confirmpassword"
                                                        class="form-label required fs-6 fw-bold mb-3">{{ __('labels.confirm_password') }}</label>
                                                    <input type="password" class="form-control form-control-lg"
                                                        name="confirmpassword"
                                                        data-bvalidator="required,equal[newpassword]"
                                                        id="confirmpassword" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-text mb-5">{{ __('labels.password_requirements') }}</div>
                                        <div class="d-flex justify-content-end">
                                            <button id="kt_password_cancel" type="button"
                                                class="btn btn-color-gray-500 btn-active-light-primary me-2 px-6">{{ __('labels.discard') }}</button>
                                            <button type="submit"
                                                class="btn btn-primary px-6">{{ __('labels.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="kt_signin_password_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">{{ __('labels.reset') }}
                                        {{ __('labels.password') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_deactivate" aria-expanded="true"
                        aria-controls="kt_account_deactivate">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('labels.delete_account') }}</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_deactivate" class="collapse show">
                        <form id="kt_account_deactivate_form" class="form" method="POST"
                            action="{{ route('profile.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="card-body border-top p-9">
                                <div class="form-check form-check-solid fv-row">
                                    <input name="deactivate" class="form-check-input" type="checkbox" value=""
                                        id="deactivate" />
                                    <label class="form-check-label fw-semibold ps-2 fs-6"
                                        for="deactivate">{{ __('labels.i_confirm_to_delete_my_account') }}</label>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button id="kt_account_deactivate_account_submit" type="submit"
                                    class="btn btn-danger fw-semibold">{{ __('labels.delete_account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
        @push('js')
            <script type="text/javascript">
                $(document).on('click', '[data-kt-element="options"]', function() {
                    $('[data-kt-element="apps"]').removeClass('d-none');
                    $('[data-kt-element="options"]').addClass('d-none');
                });
            </script>
        @endpush
    @endpush
</x-app-layout>
