<form action="{{ route('outward-letter.store') }}" autocomplete="off" method="POST" class="form ajax-form-submit"
    data-preloader="true" data-reset="true" data-refresh="true" id="FormId" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="inward_id" value="{{ base64UrlEncode($data->id) }}">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">{{ __('labels.type') }}</span>
                    </label>
                    <select class="form-select fw-bold" data-placeholder="{{ __('labels.select_type') }}"
                        data-bvalidator="required" name="letter_type" data-control="select2">
                        <option hidden></option>
                        <option value="Letter" {{ $data->letter_type == 'Letter' ? 'selected' : '' }}>
                            {{ __('labels.letter') }}</option>
                        <option value="File" {{ $data->letter_type == 'File' ? 'selected' : '' }}>
                            {{ __('labels.file') }}</option>
                        <option value="VIP Letter" {{ $data->letter_type == 'VIP Letter' ? 'selected' : '' }}>
                            {{ __('labels.vip_letter') }}</option>
                    </select>
                </div>
                <div id="DivLetter" class="{{ $data->letter_type == 'File' ? 'd-none' : '' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">{{ __('labels.letter_no') }}</span>
                        </label>
                        <input class="form-control" name="letter_no" placeholder="{{ __('labels.enter_letter_no') }}"
                            data-bvalidator="required" value="{{ $data->letter_no }}" />
                    </div>
                </div>
                <div id="DivFile" class="{{ $data->letter_type == 'File' ? '' : 'd-none' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">{{ __('labels.file_name/file_number/location/rack_number') }}</span>
                        </label>
                        <input class="form-control" name="rack_no"
                            placeholder="{{ __('labels.file_name/file_number/location/rack_number') }}"
                            data-bvalidator="required" value="{{ $data->rack_no }}" />
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">{{ __('labels.received_by') }}</span>
                    </label>
                    <select class="form-select fw-bold" data-placeholder="{{ __('labels.select_received_by') }}"
                        data-bvalidator="required" name="received_by" data-control="select2">
                        <option hidden></option>
                        <option value="By hand" {{ $data->received_by == 'By hand' ? 'selected' : '' }}>
                            {{ __('labels.by_hand') }}</option>
                        <option value="Courier" {{ $data->received_by == 'Courier' ? 'selected' : '' }}>
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
                        <input class="form-control" name="by_hand_name"
                            placeholder="{{ __('labels.enter_person_name') }}" data-bvalidator="required"
                            value="{{ $data->by_hand_name }}" />
                    </div>
                </div>
                <div id="DivEmail" class="{{ $data->received_by == 'Email' ? '' : 'd-none' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">{{ __('labels.email') }}</span>
                        </label>
                        <input class="form-control" name="email" placeholder="{{ __('labels.enter_email') }}"
                            data-bvalidator="required" value="{{ $data->email }}" />
                    </div>
                </div>
                <div id="DivCourier" class="{{ $data->received_by == 'Courier' ? '' : 'd-none' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">{{ __('labels.courier_name') }}</span>
                        </label>
                        <input class="form-control" name="courier_name"
                            placeholder="{{ __('labels.enter_courier_name') }}" data-bvalidator="required"
                            value="{{ $data->courier_name }}" />
                    </div>
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">{{ __('labels.tracking_id') }}</span>
                        </label>
                        <input class="form-control" name="tracking_id"
                            placeholder="{{ __('labels.enter_tracking_id') }}" data-bvalidator="required"
                            value="{{ $data->tracking_id }}" />
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        <span class="required">{{ __('labels.received_from') }}</span>
                    </label>
                    <select class="form-select fw-bold" data-placeholder="{{ __('labels.select_received_from') }}"
                        data-bvalidator="required" name="received_from" data-control="select2">
                        <option hidden></option>
                        <option value="Internal" {{ $data->received_from == 'Internal' ? 'selected' : '' }}>
                            {{ __('labels.internal') }}</option>
                        <option value="Public" {{ $data->received_from == 'Public' ? 'selected' : '' }}>
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
                            placeholder="{{ __('labels.enter_name_of_concerned_person') }}"
                            data-bvalidator="required" value="{{ $data->received_from_name }}" />
                    </div>
                </div>
                <div id="DivPeopleRepresentitive"
                    class="{{ $data->received_from == "People's Representative" ? '' : 'd-none' }}">
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">{{ __('labels.name_of_people_representative') }}</span>
                        </label>
                        <input class="form-control" name="received_from_name2"
                            placeholder="{{ __('labels.enter_name_of_people_representative') }}"
                            data-bvalidator="required" value="{{ $data->received_from_name }}" />
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
                    <select class="form-select fw-bold" data-placeholder="{{ __('labels.select_subject') }}"
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
                    <select class="form-select fw-bold" data-placeholder="{{ __('labels.select_department') }}"
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
                    <select class="form-select fw-bold" data-placeholder="{{ __('labels.select_branch') }}"
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
                        <span class="required">{{ __('labels.current_status') }}</span>
                    </label>
                    <select class="form-select fw-bold" data-bvalidator="required" name="status"
                        data-control="select2">
                        <option value="Received" {{ $data->status == 'Received' ? 'selected' : '' }}>
                            {{ __('labels.received') }}</option>
                        <option value="In Process" {{ $data->status == 'In Process' ? 'selected' : '' }}>
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
                    <input class="form-control flatDatepickr" name="date"
                        placeholder="{{ __('labels.enter_date') }}" data-bvalidator="required"
                        data-min-today="false" data-alt-format="d/m/Y" value="{{ $data->date }}" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        {{ __('labels.concerned_authority') }}
                    </label>
                    <input class="form-control" name="authority_name"
                        placeholder="{{ __('labels.enter_concerned_authority') }}"
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
                    <textarea name="description" rows="4" class="form-control"
                        placeholder="{{ __('labels.enter_description') }}">{{ $data->description }}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fv-row mb-7 form-group">
                    <label class="fs-6 fw-semibold form-label mb-2">
                        {{ __('labels.remark') }}
                    </label>
                    <textarea name="comment" rows="4" class="form-control" placeholder="{{ __('labels.enter_remark') }}">{{ $data->comment }}</textarea>
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
                        {{ __('labels.check_to_confirm_outward_letter') }} {{ $data->inward_no }}
                    </span>
                </label>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-end">
            <a href="{{ route('outward-letter.index') }}"
                class="btn btn-light me-3">{{ __('labels.discard') }}</a>
            <button type="submit" class="btn btn-primary">
                {{ __('labels.submit') }}</button>
        </div>
    </div>
</form>
