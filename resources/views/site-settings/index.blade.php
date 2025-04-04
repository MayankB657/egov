<x-app-layout>
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Basic Details</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <form class="form FormClass" method="POST" action="{{ route('site-settings.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="details">
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">Logo</label>
                                    <div class="col-lg-4 form-group">
                                        <div class="image-input image-input-circle" data-kt-image-input="true">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-size: contain; background-position: center; background-repeat: no-repeat;background-image: url('{{ url('/') }}/{{ $data->logo }}')">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change logo">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="photo"
                                                    data-bvalidator="extension[jpg|jpeg|png|svg]"
                                                    data-bvalidator-msg="Please select valid file type."
                                                    accept=".png, .jpg, .jpeg, .svg" />
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel logo">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg, svg.</div>
                                    </div>
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">Favicon</label>
                                    <div class="col-lg-4 form-group">
                                        <div class="image-input image-input-circle" data-kt-image-input="true">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-size: contain; background-position: center; background-repeat: no-repeat;background-image: url('{{ url('/') }}/{{ $data->favicon }}')">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change favicon">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="favicon"
                                                    data-bvalidator="extension[jpg|jpeg|png|ico|svg]"
                                                    data-bvalidator-msg="Please select valid file type."
                                                    accept=".png, .jpg, .jpeg, .svg, .ico" />
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel favicon">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg, svg, ico.</div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">App Name</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <input type="text" name="name" class="form-control form-control-lg"
                                            placeholder="App Name" data-bvalidator="required" value="{{ $data->title }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Email Details</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <form class="form FormClass ajax-form-submit" method="POST"
                            action="{{ route('site-settings.store') }}" enctype="multipart/form-data" data-refresh="false"
                            data-preloader="false">
                            @csrf
                            <input type="hidden" name="type" value="mail_details">
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Mailer</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <input type="text" name="default" class="form-control form-control-lg"
                                            placeholder="MAIL MAILER" data-bvalidator="required"
                                            value="{{ config('mail.default') }}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Host</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <input type="text" name="host" class="form-control form-control-lg"
                                            placeholder="Mail HOST" data-bvalidator="required"
                                            value="{{ config('mail.mailers.smtp.host') }}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Port</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <input type="text" name="port" class="form-control form-control-lg"
                                            placeholder="Port" data-bvalidator="required"
                                            value="{{ config('mail.mailers.smtp.port') }}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Username</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <input type="text" name="username" class="form-control form-control-lg"
                                            placeholder="Mail Username" data-bvalidator="required"
                                            value="{{ config('mail.mailers.smtp.username') }}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Password</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <input type="text" name="password" class="form-control form-control-lg"
                                            placeholder="Mail Password" data-bvalidator="required"
                                            value="{{ config('mail.mailers.smtp.password') }}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Encryption</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <input type="text" name="encryption" class="form-control form-control-lg"
                                            placeholder="Mail Encryption" data-bvalidator="required"
                                            value="{{ config('mail.mailers.smtp.encryption') }}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">From Address</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <div class="input-group mb-5">
                                            <input type="text" name="from_address"
                                                class="form-control form-control-lg" placeholder="Mail From Address"
                                                value="{{ Str::replace('@' . request()->getHost(), '', config('mail.from.address')) }}"
                                                aria-label="Mail From Address" aria-describedby="basic-addon2" />
                                            <span class="input-group-text"
                                                id="basic-addon2"><span>@</span>{{ request()->getHost() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">From Name</label>
                                    <div class="col-lg-10 fv-row form-group">
                                        <input type="text" name="from_name" class="form-control form-control-lg"
                                            placeholder="Mail From Name" value="{{ config('mail.from.name') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <span class="indicator-label">
                                        Save Changes
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
                <div class="card mb-5 border-danger mb-xl-10">
                    <div class="card-header  cursor-pointer" role="button" data-bs-toggle="collapse">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Danger Zone</h3>
                        </div>
                    </div>
                    <div class="collapse show">
                        <form class="form FormClass" method="POST" action="{{ route('site-settings.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="danger">
                            <div class="card-body border-top border-danger p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Web Url</label>
                                    <div class="col-lg-10 fv-row form-group d-flex align-items-center">
                                        <div id="kt_clipboard_4" class="me-5 form-control form-control-lg">
                                            {{ URL::to('/') }}</div>
                                        <button class="btn btn-icon btn-sm btn-light" type="button"
                                            data-bs-toggle="tooltip" data-bs-title="Click to copy"
                                            data-bs-placement="bottom" data-clipboard-target="#kt_clipboard_4">
                                            <i class="ki-duotone ki-copy fs-2 text-muted"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-danger d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-danger me-2">Discard</button>
                                <button type="submit" class="btn btn-danger">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
        <script>
            $(document).ready(function() {
                const size = $('#DiskSize').val();
                let sizeInGB = (size / 1073741824).toFixed(2);
                $('#SizeInGB').html(sizeInGB + ' GB');
            });
        </script>
    @endpush
</x-app-layout>
