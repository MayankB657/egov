<form action="{{ route('outward-letter.store') }}" autocomplete="off" method="POST" class="form ajax-form-submit"
    data-preloader="true" data-reset="true" data-refresh="true" id="FormId" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="inward_id" value="{{ base64UrlEncode($data->id) }}">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Type</span>
                    </label>
                    <select class="form-select fw-bold" data-placeholder="Select Type" data-bvalidator="required"
                        name="letter_type" data-control="select2">
                        <option hidden></option>
                        <option value="Letter" {{ $data->letter_type == 'Letter' ? 'selected' : '' }}>
                            Letter</option>
                        <option value="File" {{ $data->letter_type == 'File' ? 'selected' : '' }}>File
                        </option>
                        <option value="VIP Letter" {{ $data->letter_type == 'VIP Letter' ? 'selected' : '' }}>VIP Letter
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Received by</span>
                    </label>
                    <select class="form-select fw-bold" data-placeholder="Select Received By" data-bvalidator="required"
                        name="received_by" data-control="select2">
                        <option hidden></option>
                        <option value="By hand" {{ $data->received_by == 'By hand' ? 'selected' : '' }}>
                            By hand</option>
                        <option value="Courier" {{ $data->received_by == 'Courier' ? 'selected' : '' }}>
                            Courier</option>
                        <option value="Email" {{ $data->received_by == 'Email' ? 'selected' : '' }}>
                            Email</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Received from</span>
                    </label>
                    <select class="form-select fw-bold" data-placeholder="Select Received By" data-bvalidator="required"
                        name="received_from" data-control="select2">
                        <option hidden></option>
                        <option value="Internal" {{ $data->received_from == 'Internal' ? 'selected' : '' }}>Internal
                        </option>
                        <option value="Public" {{ $data->received_from == 'Public' ? 'selected' : '' }}>
                            Public</option>
                        <option value="People's Representative"
                            {{ $data->received_from == "People's Representative" ? 'selected' : '' }}>
                            People's Representative</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-lg-4">
                <div id="DivLetter" class="{{ $data->letter_type == 'File' ? 'd-none' : '' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Letter No</span>
                        </label>
                        <input class="form-control" name="letter_no" placeholder="Enter Letter No"
                            data-bvalidator="required" value="{{ $data->letter_no }}" />
                    </div>
                </div>
                <div id="DivFile" class="{{ $data->letter_type == 'File' ? '' : 'd-none' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">File Name / File Number / Location / Rack
                                Number</span>
                        </label>
                        <input class="form-control" name="rack_no"
                            placeholder="File Name / File Number / Location / Rack Number" data-bvalidator="required"
                            value="{{ $data->rack_no }}" />
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div id="DivByHand" class="{{ $data->received_by == 'By hand' ? '' : 'd-none' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Person Name</span>
                        </label>
                        <input class="form-control" name="by_hand_name" placeholder="Enter Person Name"
                            data-bvalidator="required" value="{{ $data->by_hand_name }}" />
                    </div>
                </div>
                <div id="DivEmail" class="{{ $data->received_by == 'Email' ? '' : 'd-none' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input class="form-control" name="email" placeholder="Enter Email" data-bvalidator="required"
                            value="{{ $data->email }}" />
                    </div>
                </div>
                <div id="DivCourier" class="{{ $data->received_by == 'Courier' ? '' : 'd-none' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Courier Name</span>
                        </label>
                        <input class="form-control" name="courier_name" placeholder="Enter Courier Name"
                            data-bvalidator="required" value="{{ $data->courier_name }}" />
                    </div>
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Tracking ID</span>
                        </label>
                        <input class="form-control" name="tracking_id" placeholder="Enter Tracking ID"
                            data-bvalidator="required" value="{{ $data->tracking_id }}" />
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div id="DivConcernedPerson"
                    class="{{ $data->received_from == "People's Representative" ? 'd-none' : '' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Name of concerned person</span>
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
                            <span class="required">Name of People's Representative</span>
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
                        <span class="required">Subject</span>
                        <span data-bs-toggle="modal" data-bs-target="#add_subject"
                            class="badge badge-primary justify-content-center badge-sm badge-circle fs-6">
                            <i class="bi bi-plus text-white"></i>
                        </span>
                    </label>
                    <select class="form-select fw-bold" data-placeholder="Select Subject" data-bvalidator="required"
                        name="subject_id" data-control="select2">
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
                        <span class="required">Department</span>
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
                        <span class="required">Branch</span>
                        <span data-bs-toggle="modal" data-bs-target="#add_branch"
                            class="badge badge-primary justify-content-center badge-sm badge-circle fs-6">
                            <i class="bi bi-plus text-white"></i>
                        </span>
                    </label>
                    <select class="form-select fw-bold" data-placeholder="Select Branch" data-bvalidator="required"
                        name="branch_id" data-control="select2">
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
                        <span class="required">Current Status</span>
                    </label>
                    <select class="form-select fw-bold" data-bvalidator="required" name="status"
                        data-control="select2">
                        <option value="Received" {{ $data->status == 'Received' ? 'selected' : '' }}>
                            Received</option>
                        <option value="In Process" {{ $data->status == 'In Process' ? 'selected' : '' }}>In Process
                        </option>
                        <option value="Rejected" {{ $data->status == 'Rejected' ? 'selected' : '' }}>
                            Rejected</option>
                        <option value="Signed" {{ $data->status == 'Signed' ? 'selected' : '' }}>
                            Signed</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">Date</span>
                    </label>
                    <input class="form-control flatDatepickr" name="date" placeholder="Enter date"
                        data-bvalidator="required" data-min-today="false" data-alt-format="d/m/Y"
                        value="{{ $data->date }}" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        Concerned Authority
                    </label>
                    <input class="form-control" name="authority_name" placeholder="Enter Concerned Authority"
                        value="{{ $data->authority_name }}" />
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        Description
                    </label>
                    <textarea name="description" rows="4" class="form-control" placeholder="Enter description">{{ $data->description }}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        Comment
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
                                <div class="fv-row col-lg-4 mb-5 px-0">
                                    <div class="btn btn-primary position-relative btn-sm m-0">
                                        <a class="text-white" target="_blank"
                                            href="{{ url('/') }}/public/ViewerJS/#{{ url('/') }}/{{ $file->file_path }}">{{ $file->file_name }}</a>
                                        <span data-id="{{ $file->id }}"
                                            class="position-absolute top-5 start-100 translate-middle badge badge-circle badge-sm badge-danger btnRemoveFile">x</span>
                                    </div>
                                </div>
                            @else
                                <div class="fv-row col-lg-4 mb-5 px-0">
                                    <div class="btn btn-primary position-relative btn-sm m-0">
                                        <a data-fslightbox="lightbox-basic" class="text-white"
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
        <div class="row mb-1">
            <div class="fv-row mb-7 form-group">
                <label class="form-check form-check-custom">
                    <input class="form-check-input" data-bvalidator="required"
                        data-bvalidator-msg="Please check this checkbox" type="checkbox" value="1" />
                    <span class="form-check-label">
                        Check to confirm outward {{ $data->inward_no }} letter
                    </span>
                </label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-end">
            <a href="{{ route('outward-letter.index') }}" class="btn btn-light me-3">Discard</a>
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</form>
