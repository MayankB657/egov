<div class="modal-dialog modal-dialog-centered mw-650px">
    <div class="modal-content">
        <div class="modal-header" id="edit_user_header">
            <h2 class="fw-bold">Edit User</h2>
            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                <i class="ki-duotone ki-cross fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <div class="modal-body px-5 my-7">
            <form class="form FormClass ajax-form-submit" action="{{ route('users.update', $user->id) }}"
                enctype="multipart/form-data" method="POST" data-dismiss-modal="edit_user" data-preloader="false"
                data-refresh="false">
                @csrf
                @method('PUT')
                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="add_user_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#edit_user_header" data-kt-scroll-wrappers="#add_user_scroll"
                    data-kt-scroll-offset="300px">
                    <div class="row mb-6 mt-5">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                        <div class="col-lg-8">
                            <div class="image-input image-input-circle glowing-border" data-kt-image-input="true">
                                @if ($user->photo == 'public/images/blank.svg')
                                    <div class="image-input-wrapper w-125px h-125px"></div>
                                @else
                                    <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: url('{{ url('/') }}/{{ $user->photo }}')"></div>
                                @endif
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="file" name="photo" class="imgVal" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
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
                            <div class="form-text">Allowed file types: png, jpg, jpeg.
                            </div>
                        </div>
                    </div>
                    <div class="fv-row mb-7 form-group">
                        <label class="required fw-semibold fs-6 mb-2">Full
                            Name</label>
                        <input type="text" name="name" class="form-control mb-3 mb-lg-0" placeholder="Enter name"
                            data-bvalidator="required" value="{{ $user->name }}" />
                    </div>
                    <div class="fv-row mb-7 form-group">
                        <label class="required fw-semibold fs-6 mb-2">Email</label>
                        <input type="email" name="email" class="form-control mb-3 mb-lg-0"
                            placeholder="example@domain.com" data-bvalidator="email,required"
                            data-bvalidator-msg="Enter email address." value="{{ $user->email }}" />
                    </div>
                    <div class="fv-row mb-2 form-group">
                        <label class="form-label required fs-6 fw-bold mb-2">Password</label>
                        <div class="position-relative mb-3">
                            <input class="form-control form-control-lg" type="password" name="password"
                                autocomplete="off" data-bvalidator="passwordFormat" placeholder="Enter Password"
                                data-bvalidator-msg="Paasword strength must be 100%." />
                            <span
                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showPassword">
                                <i class="mb mb-eye-close text-muted fs-1"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-text mb-5">Password must be at least 8 character
                        and contain number, a-z, A-Z.</div>
                    <div class="fv-row mb-7 form-group">
                        <label class="required fw-semibold fs-6 mb-2">Role</label>
                        <div class="d-flex fv-row">
                            <select class="form-select fw-bold" data-placeholder="Select role"
                                data-bvalidator="required" name="role" data-control="select2"
                                data-dropdown-parent="body" data-hide-search="true">
                                <option hidden></option>
                                @foreach ($RoleList as $role)
                                    <option value="{{ $role->name }}"
                                        @if ($user->roles[0]->id == $role->id) selected @endif>{{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-7 form-group">
                        <label class="fw-semibold fs-6 mb-2">Address</label>
                        <textarea name="address" rows="4" class="form-control mb-3 mb-lg-0" placeholder="Enter address">{{ $user->address }}</textarea>
                    </div>
                    <div class="fv-row mb-7 form-group">
                        <label class="required fw-semibold fs-6 mb-2">Language</label>
                        <div class="d-flex fv-row">
                            <select class="form-select fw-bold" data-placeholder="Select language"
                                data-bvalidator="required" name="language" data-control="select2"
                                data-dropdown-parent="body" data-hide-search="true">
                                <option hidden></option>
                                @foreach (config('app.languages') ?? [] as $key => $lang)
                                    <option value="{{ $lang }}"
                                        @if ($user->language == $lang) selected @endif>{{ $key }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center pt-10">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-success me-10 btn-submit">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
