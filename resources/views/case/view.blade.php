<x-app-layout>
    @push('title')
        {{ __('labels.edit_case') }}
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.type') }}</span>
                                    </label>
                                    <select class="form-select fw-bold" data-bvalidator="required" name="letter_type"
                                        data-control="select2">
                                        <option selected>{{ $data->topic_type }}</option>
                                    </select>
                                </div>
                                <div id="DivLetter"
                                    class="{{ $data->topic_type == 'Letter' || $data->topic_type == 'VIP Letter' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.letter_no') }}</span>
                                        </label>
                                        <input class="form-control" readonly name="letter_no" data-bvalidator="required"
                                            value="{{ $data->letter_no }}" />
                                    </div>
                                </div>
                                <div id="DivFile" class="{{ $data->letter_type == 'File' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span
                                                class="required">{{ __('labels.file_name/file_number/location/rack_number') }}</span>
                                        </label>
                                        <input class="form-control" name="rack_no" data-bvalidator="required" readonly
                                            value="{{ $data->rack_no }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.received_by') }}</span>
                                    </label>
                                    <select class="form-select fw-bold" data-bvalidator="required" name="received_by"
                                        data-control="select2">
                                        <option selected>{{ $data->received_by }}</option>
                                    </select>
                                </div>
                                <div id="DivByHand" class="{{ $data->received_by == 'By hand' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.person_name') }}</span>
                                        </label>
                                        <input class="form-control" name="by_hand_name" data-bvalidator="required" readonly
                                            value="{{ $data->by_hand_name }}" />
                                    </div>
                                </div>
                                <div id="DivEmail" class="{{ $data->received_by == 'Email' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.email') }}</span>
                                        </label>
                                        <input class="form-control" name="email" data-bvalidator="required" readonly
                                            value="{{ $data->email }}" />
                                    </div>
                                </div>
                                <div id="DivCourier" class="{{ $data->received_by == 'Courier' ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.courier_name') }}</span>
                                        </label>
                                        <input class="form-control" name="courier_name" readonly data-bvalidator="required"
                                            value="{{ $data->courier_name }}" />
                                    </div>
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.tracking_id') }}</span>
                                        </label>
                                        <input class="form-control" name="tracking_id" readonly data-bvalidator="required"
                                            value="{{ $data->tracking_id }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.received_from') }}</span>
                                    </label>
                                    <select class="form-select fw-bold" data-bvalidator="required" name="received_from"
                                        data-control="select2">
                                        <option selected>{{ $data->received_from }}</option>
                                    </select>
                                </div>
                                <div id="DivConcernedPerson"
                                    class="{{ $data->received_from == "People's Representative" ? 'd-none' : '' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.name_of_concerned_person') }}</span>
                                        </label>
                                        <input class="form-control" name="received_from_name" readonly
                                            data-bvalidator="required" value="{{ $data->received_from_name }}" />
                                    </div>
                                </div>
                                <div id="DivPeopleRepresentitive"
                                    class="{{ $data->received_from == "People's Representative" ? '' : 'd-none' }}">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ __('labels.name_of_people_representative') }}</span>
                                        </label>
                                        <input class="form-control" name="received_from_name2" readonly
                                            data-bvalidator="required" value="{{ $data->received_from_name2 }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.department') }}</span>
                                        <span data-bs-toggle="modal" data-bs-target="#add_department"
                                            class="badge badge-primary justify-content-center badge-sm badge-circle fs-6">
                                            <i class="bi bi-plus text-white"></i>
                                        </span>
                                    </label>
                                    <select class="form-select fw-bold" data-bvalidator="required" name="department_id"
                                        data-control="select2">
                                        <option selected>{{ $data->department->name }}</option>
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
                                    <select class="form-select fw-bold" data-bvalidator="required" name="branch_id"
                                        data-control="select2">
                                        <option selected>{{ $data->branch->name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.subject') }}</span>
                                        <span data-bs-toggle="modal" data-bs-target="#add_subject"
                                            class="badge badge-primary justify-content-center badge-sm badge-circle fs-6">
                                            <i class="bi bi-plus text-white"></i>
                                        </span>
                                    </label>
                                    <select class="form-select fw-bold" data-bvalidator="required" name="subject_id"
                                        data-control="select2">
                                        <option selected>{{ $data->subject->name }}</option>
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
                                        <option selected>{{ $data->status }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">{{ __('labels.date') }}</span>
                                    </label>
                                    <input class="form-control" name="date" readonly data-bvalidator="required"
                                        value="{{ $data->date }}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        {{ __('labels.concerned_officer') }}
                                    </label>
                                    <input class="form-control" name="concerned_officer" readonly
                                        value="{{ $data->concerned_officer }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        {{ __('labels.description') }}
                                    </label>
                                    <textarea name="description" rows="4" class="form-control" readonly>{{ $data->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        {{ __('labels.remark') }}
                                    </label>
                                    <textarea name="comment" rows="4" class="form-control" readonly>{{ $data->comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="fv-row form-group">
                                    <label class="fs-6 mb-2 fw-semibold form-label ">
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
                            <div class="col-lg-4 col-md-6">
                                <div class="fv-row mb-7 form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        {{ __('labels.holder_name') }}
                                    </label>
                                    <input class="form-control" name="holder_name" readonly
                                        value="{{ $data->holder_name }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <a href="{{ route('case.edit', base64_encode($data->id)) }}"
                                class="btn btn-light-primary me-3">{{ __('labels.edit') }}</a>
                            <a href="{{ route('case.index') }}"
                                class="btn btn-light-danger">{{ __('labels.close') }}</a>
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
