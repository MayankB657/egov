<x-app-layout>
    @push('title')
        {{ __('labels.view_inward_letter') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <div class="card-body pb-2">
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.inward_no') }}</span>
                                    </label>
                                    <input type="text" class="form-control" readonly value="{{ $data->inward_no }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.type') }}</span>
                                    </label>
                                    <select class="form-select fw-bold" readonly data-placeholder="Select Type"
                                        data-bvalidator="required" name="letter_type" data-control="select2">
                                        <option selected>{{ $data->letter_type }}</option>
                                    </select>
                                </div>
                                <div id="DivLetter" class="{{ $data->letter_type == 'File' ? 'd-none' : '' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.letter_no') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="letter_no" placeholder="Enter Letter No"
                                            data-bvalidator="required" value="{{ $data->letter_no }}" />
                                    </div>
                                </div>
                                <div id="DivFile" class="{{ $data->letter_type == 'File' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span
                                                class="required">{{ __('labels.file_name/file_number/location/rack_number') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="rack_no"
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
                                    <select class="form-select fw-bold" readonly data-placeholder="Select Received By"
                                        data-bvalidator="required" name="received_by" data-control="select2">
                                        <option selected>{{ $data->received_by }}</option>
                                    </select>
                                </div>
                                <div id="DivByHand" class="{{ $data->received_by == 'By hand' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.person_name') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="by_hand_name"
                                            placeholder="Enter Person Name" data-bvalidator="required"
                                            value="{{ $data->by_hand_name }}" />
                                    </div>
                                </div>
                                <div id="DivEmail" class="{{ $data->received_by == 'Email' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.email') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="email" placeholder="Enter Email"
                                            data-bvalidator="required" value="{{ $data->email }}" />
                                    </div>
                                </div>
                                <div id="DivCourier" class="{{ $data->received_by == 'Courier' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.courier_name') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="courier_name"
                                            placeholder="Enter Courier Name" data-bvalidator="required"
                                            value="{{ $data->courier_name }}" />
                                    </div>
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.tracking_id') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="tracking_id"
                                            placeholder="Enter Tracking ID" data-bvalidator="required"
                                            value="{{ $data->tracking_id }}" />
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
                                        <option selected>{{ $data->received_from }}</option>
                                    </select>
                                </div>
                                <div id="DivConcernedPerson"
                                    class="{{ $data->received_from == "People's Representative" ? 'd-none' : '' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.name_of_concerned_person') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="received_from_name"
                                            placeholder="Enter Name of concerned person" data-bvalidator="required"
                                            value="{{ $data->received_from_name }}" />
                                    </div>
                                </div>
                                <div id="DivPeopleRepresentitive"
                                    class="{{ $data->received_from == "People's Representative" ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.name_of_people_representative') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="received_from_name2"
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
                                    </label>
                                    <select class="form-select fw-bold" readonly data-placeholder="Select Subject"
                                        data-bvalidator="required" name="subject_id" data-control="select2">
                                        <option selected>{{ $data->subject->name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.department') }}</span>
                                    </label>
                                    <select class="form-select fw-bold" readonly data-placeholder="Select Department"
                                        data-bvalidator="required" name="department_id" data-control="select2">
                                        <option selected>{{ $data->department->name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.branch') }}</span>
                                    </label>
                                    <select class="form-select fw-bold" readonly data-placeholder="Select Branch"
                                        data-bvalidator="required" name="branch_id" data-control="select2">
                                        <option selected>{{ $data->branch->name }}</option>
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
                                    <select class="form-select fw-bold" readonly data-bvalidator="required"
                                        name="status" data-control="select2">
                                        <option selected>{{ $data->status }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.date') }}</span>
                                    </label>
                                    <input class="form-control" readonly name="date" placeholder="Enter date"
                                        data-bvalidator="required" data-min-today="false" data-alt-format="d/m/Y"
                                        value="{{ $data->date }}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        {{ __('labels.concerned_authority') }}
                                    </label>
                                    <input class="form-control" readonly name="authority_name"
                                        placeholder="Enter Concerned Authority" value="{{ $data->authority_name }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        {{ __('labels.description') }}
                                    </label>
                                    <textarea name="description" readonly rows="4" class="form-control" placeholder="Enter description">{{ $data->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        {{ __('labels.remark') }}
                                    </label>
                                    <textarea name="comment" readonly rows="4" class="form-control" placeholder="Enter Comment">{{ $data->comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        PDF or Iamge (Multiple)
                                    </label>
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
                                                    </div>
                                                </div>
                                            @else
                                                <div class="fv-row col-lg-4 mb-5 px-0 file">
                                                    <div class="btn btn-primary position-relative btn-sm m-0">
                                                        <a data-fslightbox="gallery" class="text-white"
                                                            href="{{ url('/') }}/{{ $file->file_path }}">{{ $file->file_name }}</a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <div class="text-end">
                            <a href="{{ route('inward-letter.index') }}"
                                class="btn btn-light me-3">{{ __('labels.close') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card mt-5 card-flush">
                    <div class="card-header">
                        <div class="card-title">{{ __('labels.comments') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="timeline-label">
                            @foreach ($comments as $comment)
                                <div class="timeline-item">
                                    <div class="timeline-label w-200px fw-bold text-gray-800 fs-6">
                                        {{ Helper::datetimeFormat($comment->created_at) }}</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-info fs-1"></i>
                                    </div>
                                    <div class="fw-mormal timeline-content text-muted ps-3">
                                        <div>{{ $comment->comment }}</div>
                                        <div class="badge badge-secondary">{{ $comment->user->name }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
