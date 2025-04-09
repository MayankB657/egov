<x-app-layout>
    @push('title')
        {{ __('labels.edit_inward_letter') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <form action="{{ route('inward-letter.update', base64UrlEncode($data->id)) }}" autocomplete="off"
                        method="POST" class="form ajax-form-submit" data-preloader="true" data-reset="true"
                        data-refresh="true" id="FormId" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.type') }}</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Type"
                                            data-bvalidator="required" name="letter_type" data-control="select2">
                                            <option hidden></option>
                                            <option value="Letter" {{ $data->letter_type == 'Letter' ? 'selected' : '' }}>
                                                {{ __('labels.letter') }}</option>
                                            <option value="File" {{ $data->letter_type == 'File' ? 'selected' : '' }}>
                                                {{ __('labels.file') }}
                                            </option>
                                            <option value="VIP Letter"
                                                {{ $data->letter_type == 'VIP Letter' ? 'selected' : '' }}>
                                                {{ __('labels.vip_letter') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div id="DivLetter" class="{{ $data->letter_type == 'File' ? 'd-none' : '' }}">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.letter_no') }}</span>
                                            </label>
                                            <input class="form-control" name="letter_no" placeholder="Enter Letter No"
                                                data-bvalidator="required" value="{{ $data->letter_no }}" />
                                        </div>
                                    </div>
                                    <div id="DivFile" class="{{ $data->letter_type == 'File' ? '' : 'd-none' }}">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span
                                                    class="required">{{ __('labels.file_name/file_number/location/rack_number') }}</span>
                                            </label>
                                            <input class="form-control" name="rack_no"
                                                placeholder="File Name / File Number / Location / Rack Number"
                                                data-bvalidator="required" value="{{ $data->rack_no }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.received_by') }}</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Received By"
                                            data-bvalidator="required" name="received_by" data-control="select2">
                                            <option hidden></option>
                                            <option value="By hand"
                                                {{ $data->received_by == 'By hand' ? 'selected' : '' }}>
                                                {{ __('labels.by_hand') }}</option>
                                            <option value="Courier"
                                                {{ $data->received_by == 'Courier' ? 'selected' : '' }}>
                                                {{ __('labels.courier') }}</option>
                                            <option value="Email" {{ $data->received_by == 'Email' ? 'selected' : '' }}>
                                                {{ __('labels.email') }}</option>
                                        </select>
                                    </div>
                                    <div id="DivByHand" class="{{ $data->received_by == 'By hand' ? '' : 'd-none' }}">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.person_name') }}</span>
                                            </label>
                                            <input class="form-control" name="by_hand_name" placeholder="Enter Person Name"
                                                data-bvalidator="required" value="{{ $data->by_hand_name }}" />
                                        </div>
                                    </div>
                                    <div id="DivEmail" class="{{ $data->received_by == 'Email' ? '' : 'd-none' }}">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.email') }}</span>
                                            </label>
                                            <input class="form-control" name="email" placeholder="Enter Email"
                                                data-bvalidator="required" value="{{ $data->email }}" />
                                        </div>
                                    </div>
                                    <div id="DivCourier" class="{{ $data->received_by == 'Courier' ? '' : 'd-none' }}">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.courier_name') }}</span>
                                            </label>
                                            <input class="form-control" name="courier_name" placeholder="Enter Courier Name"
                                                data-bvalidator="required" value="{{ $data->courier_name }}" />
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.tracking_id') }}</span>
                                            </label>
                                            <input class="form-control" name="tracking_id" placeholder="Enter Tracking ID"
                                                data-bvalidator="required" value="{{ $data->tracking_id }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.received_from') }}</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Received By"
                                            data-bvalidator="required" name="received_from" data-control="select2">
                                            <option hidden></option>
                                            <option value="Internal"
                                                {{ $data->received_from == 'Internal' ? 'selected' : '' }}>
                                                {{ __('labels.internal') }}
                                            </option>
                                            <option value="Public"
                                                {{ $data->received_from == 'Public' ? 'selected' : '' }}>
                                                {{ __('labels.public') }}</option>
                                            <option value="People's Representative"
                                                {{ $data->received_from == "People's Representative" ? 'selected' : '' }}>
                                                {{ __('labels.people_representative') }}</option>
                                        </select>
                                    </div>
                                    <div id="DivConcernedPerson"
                                        class="{{ $data->received_from == "People's Representative" ? 'd-none' : '' }}">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.name_of_concerned_person') }}</span>
                                            </label>
                                            <input class="form-control" name="received_from_name"
                                                placeholder="Enter Name of concerned person" data-bvalidator="required"
                                                value="{{ $data->received_from_name }}" />
                                        </div>
                                    </div>
                                    <div id="DivPeopleRepresentitive"
                                        class="{{ $data->received_from == "People's Representative" ? '' : 'd-none' }}">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span
                                                    class="required">{{ __('labels.name_of_people_representative') }}</span>
                                            </label>
                                            <input class="form-control" name="received_from_name2"
                                                placeholder="Enter Name of concerned person" data-bvalidator="required"
                                                value="{{ $data->received_from_name }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.subject') }}</span>
                                            <span data-bs-toggle="modal" data-bs-target="#add_subject"
                                                class="badge badge-primary justify-content-center badge-sm badge-circle fs-6">
                                                <i class="bi bi-plus text-white"></i>
                                            </span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Subject"
                                            data-bvalidator="required" name="subject_id" data-control="select2">
                                            <option hidden></option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ $data->subject_id == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.department') }}</span>
                                            <span data-bs-toggle="modal" data-bs-target="#add_department"
                                                class="badge badge-primary justify-content-center badge-sm badge-circle fs-6">
                                                <i class="bi bi-plus text-white"></i>
                                            </span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Department"
                                            data-bvalidator="required" name="department_id" data-control="select2">
                                            <option hidden></option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $data->department_id == $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.branch') }}</span>
                                            <span data-bs-toggle="modal" data-bs-target="#add_branch"
                                                class="badge badge-primary justify-content-center badge-sm badge-circle fs-6">
                                                <i class="bi bi-plus text-white"></i>
                                            </span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Branch"
                                            data-bvalidator="required" name="branch_id" data-control="select2">
                                            <option hidden></option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    {{ $data->branch_id == $branch->id ? 'selected' : '' }}>
                                                    {{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.status') }}</span>
                                        </label>
                                        <select class="form-select fw-bold" data-bvalidator="required" name="status"
                                            data-control="select2">
                                            <option value="Received" {{ $data->status == 'Received' ? 'selected' : '' }}>
                                                {{ __('labels.received') }}</option>
                                            <option value="In Process"
                                                {{ $data->status == 'In Process' ? 'selected' : '' }}>
                                                {{ __('labels.in_process') }}</option>
                                            <option value="Rejected" {{ $data->status == 'Rejected' ? 'selected' : '' }}>
                                                {{ __('labels.rejected') }}</option>
                                            <option value="Signed" {{ $data->status == 'Signed' ? 'selected' : '' }}>
                                                {{ __('labels.signed') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.date') }}</span>
                                        </label>
                                        <input class="form-control flatDatepickr" name="date" placeholder="Enter date"
                                            data-bvalidator="required" data-min-today="false" data-alt-format="d/m/Y"
                                            value="{{ $data->date }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            {{ __('labels.concerned_authority') }}
                                        </label>
                                        <input class="form-control" name="authority_name"
                                            placeholder="Enter Concerned Authority"
                                            value="{{ $data->authority_name }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            {{ __('labels.description') }}
                                        </label>
                                        <textarea name="description" rows="4" class="form-control" placeholder="Enter description">{{ $data->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            {{ __('labels.remark') }}
                                        </label>
                                        <textarea name="comment" rows="4" class="form-control" placeholder="Enter Comment">{{ $data->comment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            PDF or Iamge (Multiple)
                                        </label>
                                        <input class="form-control" type="file" name="media_files[]" multiple
                                            data-bvalidator="extension[jpg:jpeg:png:pdf]"
                                            data-bvalidator-msg="Please select file of type png, jpg, jpeg or pdf." />
                                    </div>
                                    <div class="border border-success px-3 py-5 rounded">
                                        <div class="row px-3">
                                            @foreach ($data->mediafiles as $file)
                                                @php
                                                    $ext = pathinfo($file->file_path, PATHINFO_EXTENSION);
                                                @endphp
                                                @if ($ext == 'pdf')
                                                    <div class="fv-row col-lg-4 mb-5 px-0 file">
                                                        <div class="btn btn-primary position-relative btn-sm m-0">
                                                            <a class="text-white"
                                                                href="{{ url('/') }}/public/ViewerJS/#{{ url('/') }}/{{ $file->file_path }}">{{ $file->file_name }}</a>
                                                            <span data-id="{{ $file->id }}"
                                                                class="position-absolute top-5 start-100 translate-middle badge badge-circle badge-sm badge-danger btnRemoveFile">x</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="fv-row col-lg-4 mb-5 px-0 file">
                                                        <div class="btn btn-primary position-relative btn-sm m-0">
                                                            <a data-fslightbox="gallery" class="text-white"
                                                                href="{{ url('/') }}/{{ $file->file_path }}">{{ $file->file_name }}</a>
                                                            <span data-id="{{ $file->id }}"
                                                                class="position-absolute top-5 start-100 translate-middle badge badge-circle badge-sm badge-danger btnRemoveFile">x</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <a href="{{ route('inward-letter.index') }}"
                                    class="btn btn-light me-3">{{ __('labels.discard') }}</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('labels.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal fade" id="add_department" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_add_department_header">
                                <h2 class="fw-bold">{{ __('labels.add_department') }}</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <form class="form FormClass AddDepartment" action="{{ route('AddDepartment') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                        id="kt_modal_add_department_scroll" data-kt-scroll="true"
                                        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_department_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_department_scroll"
                                        data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="required fs-6 fw-semibold form-label mb-2">
                                                {{ __('labels.name') }}
                                            </label>
                                            <input class="form-control" name="name" placeholder="Enter Name"
                                                data-bvalidator="required" />
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="required fs-6 fw-semibold form-label mb-2">
                                                {{ __('labels.email') }}
                                            </label>
                                            <input class="form-control" name="email" placeholder="Enter Email"
                                                data-bvalidator="required" />
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="required fs-6 fw-semibold form-label mb-2">
                                                {{ __('labels.contact') }}
                                            </label>
                                            <input class="form-control" name="contact" placeholder="Enter Contact"
                                                data-bvalidator="required" />
                                        </div>
                                        <div class="text-center pt-10">
                                            <button type="reset" class="btn btn-light me-3"
                                                data-bs-dismiss="modal">{{ __('labels.discard') }}</button>
                                            <button type="submit" class="btn btn-success me-10 btn-submit">
                                                <span class="indicator-label">
                                                    {{ __('labels.submit') }}
                                                </span>
                                                <span class="indicator-progress">
                                                    {{ __('labels.please_wait') }} <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="add_branch" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_add_branch_header">
                                <h2 class="fw-bold">{{ __('labels.add_branch') }}</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <form class="form FormClass AddBranch" action="{{ route('AddBranch') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_branch_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="true"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_branch_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_branch_scroll"
                                        data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.name') }}</span>
                                            </label>
                                            <input class="form-control" name="name" placeholder="Enter Name"
                                                data-bvalidator="required" />
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.department') }}</span>
                                            </label>
                                            <select class="form-select fw-bold" data-placeholder="Select Department"
                                                data-bvalidator="required" name="department_id" data-control="select2">
                                                <option hidden></option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.address') }}</span>
                                            </label>
                                            <textarea name="address" rows="4" class="form-control" placeholder="Enter Address"
                                                data-bvalidator="required"></textarea>
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.email') }}</span>
                                            </label>
                                            <input class="form-control" name="email" placeholder="Enter Email"
                                                data-bvalidator="required" />
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.contact') }}</span>
                                            </label>
                                            <input class="form-control" name="contact" placeholder="Enter Contact Number"
                                                data-bvalidator="required" />
                                        </div>
                                        <div class="text-center pt-10">
                                            <button type="reset" class="btn btn-light me-3"
                                                data-bs-dismiss="modal">{{ __('labels.discard') }}</button>
                                            <button type="submit" class="btn btn-success me-10 btn-submit">
                                                <span class="indicator-label">
                                                    {{ __('labels.submit') }}
                                                </span>
                                                <span class="indicator-progress">
                                                    {{ __('labels.please_wait') }} <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="add_subject" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_add_subject_header">
                                <h2 class="fw-bold">{{ __('labels.add_subject') }}</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <form class="form FormClass AddSubject" action="{{ route('AddSubject') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                                        id="kt_modal_add_subject_scroll" data-kt-scroll="true"
                                        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_subject_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_subject_scroll"
                                        data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.name') }}</span>
                                            </label>
                                            <input class="form-control" name="name" placeholder="Enter Name"
                                                data-bvalidator="required" />
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.department') }}</span>
                                            </label>
                                            <select class="form-select fw-bold" data-placeholder="Select Department"
                                                data-bvalidator="required" name="department_id" data-control="select2">
                                                <option hidden></option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">{{ __('labels.branch') }}</span>
                                            </label>
                                            <select class="form-select fw-bold" data-placeholder="Select Branch"
                                                data-bvalidator="required" name="branch_id" data-control="select2">
                                                <option hidden></option>
                                            </select>
                                        </div>
                                        <div class="text-center pt-10">
                                            <button type="reset" class="btn btn-light me-3"
                                                data-bs-dismiss="modal">{{ __('labels.discard') }}</button>
                                            <button type="submit" class="btn btn-success me-10 btn-submit">
                                                <span class="indicator-label">
                                                    {{ __('labels.submit') }}
                                                </span>
                                                <span class="indicator-progress">
                                                    {{ __('labels.please_wait') }} <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
        <script>
            $(document).on('change', 'select[name="department_id"]', function() {
                var department_id = $(this).val();
                $.ajax({
                    url: "{{ route('getBranches', ['department_id' => '__ID__']) }}".replace('__ID__',
                        department_id),
                    type: "GET",
                    success: function(data) {
                        var branch_id = $('select[name="branch_id"]');
                        branch_id.empty();
                        branch_id.append('<option hidden></option>');
                        $.each(data.branches, function(key, value) {
                            branch_id.append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        branch_id.select2({
                            placeholder: "Select Branch",
                        });
                        branch_id.val(null).trigger('change');
                    }
                });
            });
            $(document).on('change', 'select[name="letter_type"]', function() {
                var letter_type = $(this).val();
                $('#DivLetter').addClass('d-none');
                $('#DivFile').addClass('d-none');
                if (letter_type == "File") {
                    $('#DivFile').removeClass('d-none');
                } else {
                    $('#DivLetter').removeClass('d-none');
                }
            });
            $(document).on('change', 'select[name="received_by"]', function() {
                var received_by = $(this).val();
                $('#DivByHand').addClass('d-none');
                $('#DivEmail').addClass('d-none');
                $('#DivCourier').addClass('d-none');
                if (received_by == "By hand") {
                    $('#DivByHand').removeClass('d-none');
                } else if (received_by == "Email") {
                    $('#DivEmail').removeClass('d-none');
                } else if (received_by == "Courier") {
                    $('#DivCourier').removeClass('d-none');
                }
            });
            $(document).on('change', 'select[name="received_from"]', function() {
                var received_from = $(this).val();
                $('#DivPeopleRepresentitive').addClass('d-none');
                $('#DivConcernedPerson').addClass('d-none');
                if (received_from == "People's Representative") {
                    $('#DivPeopleRepresentitive').removeClass('d-none');
                } else {
                    $('#DivConcernedPerson').removeClass('d-none');
                }
            });
            $(document).on('submit', '.AddDepartment', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData(this);
                $(this).bValidator();
                if ($(this).data('bValidator').isValid()) {
                    let button = form.find('.btn-submit')[0];
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        dataType: "JSON",
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            if (button) {
                                button.setAttribute('disabled', 'disabled');
                                button.setAttribute("data-kt-indicator", "on");
                            }
                        },
                        success: function(response) {
                            if (button) {
                                button.removeAttribute('disabled');
                                button.setAttribute("data-kt-indicator", "off");
                            }
                            if (response.status == true) {
                                $('#add_department').modal('hide');
                                form[0].reset();
                                var department = $(document).find('select[name="department_id"]');
                                department.append('<option value="' + response.data.id + '" selected>' +
                                    response.data.name + '</option>');
                                department.val(response.data.id).trigger('change');
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: response.msg
                                });
                            }
                        },
                        complete: function() {
                            if (button) {
                                button.removeAttribute('disabled');
                                button.setAttribute("data-kt-indicator", "off");
                            }
                        }
                    });
                }
            });
            $(document).on('submit', '.AddBranch', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData(this);
                $(this).bValidator();
                if ($(this).data('bValidator').isValid()) {
                    let button = form.find('.btn-submit')[0];
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        dataType: "JSON",
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            showPageLoader();
                            if (button) {
                                button.setAttribute('disabled', 'disabled');
                                button.setAttribute("data-kt-indicator", "on");
                            }
                        },
                        success: function(response) {
                            if (button) {
                                button.removeAttribute('disabled');
                                button.setAttribute("data-kt-indicator", "off");
                            }
                            if (response.status == true) {
                                var branch = $(document).find('select[name="branch_id"]');
                                var department = $(document).find('select[name="department_id"]');
                                department.val(response.data.department_id).trigger('change');
                                form[0].reset();
                                setTimeout(() => {
                                    $('#add_branch').modal('hide');
                                    branch.val(response.data.id).trigger('change');
                                    hidePageLoader();
                                }, 2000);
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: response.msg
                                });
                            }
                        },
                        complete: function() {
                            if (button) {
                                button.removeAttribute('disabled');
                                button.setAttribute("data-kt-indicator", "off");
                            }
                        }
                    });
                }
            });
            $(document).on('submit', '.AddSubject', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData(this);
                $(this).bValidator();
                if ($(this).data('bValidator').isValid()) {
                    let button = form.find('.btn-submit')[0];
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        dataType: "JSON",
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            showPageLoader();
                            if (button) {
                                button.setAttribute('disabled', 'disabled');
                                button.setAttribute("data-kt-indicator", "on");
                            }
                        },
                        success: function(response) {
                            if (button) {
                                button.removeAttribute('disabled');
                                button.setAttribute("data-kt-indicator", "off");
                            }
                            if (response.status == true) {
                                var subject = $(document).find('select[name="subject_id"]');
                                var branch = $(document).find('select[name="branch_id"]');
                                var department = $(document).find('select[name="department_id"]');
                                subject.append('<option value="' + response.data.id + '" selected>' +
                                    response.data.name + '</option>');
                                subject.val(response.data.id).trigger('change');
                                department.val(response.data.department_id).trigger('change');
                                setTimeout(() => {
                                    form[0].reset();
                                    $('#add_subject').modal('hide');
                                    branch.val(response.data.branch_id).trigger('change');
                                    hidePageLoader();
                                }, 2000);
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: response.msg
                                });
                            }
                        },
                        complete: function() {
                            if (button) {
                                button.removeAttribute('disabled');
                                button.setAttribute("data-kt-indicator", "off");
                            }
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
