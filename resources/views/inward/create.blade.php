<x-app-layout>
    @push('title')
        Add Inward Letter
    @endpush
    @section('content')
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <form action="{{ route('inward-letter.store') }}" autocomplete="off" method="POST"
                        class="form ajax-form-submit" data-preloader="true" data-reset="true" data-refresh="true"
                        id="FormId" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Type</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Type"
                                            data-bvalidator="required" name="letter_type" data-control="select2">
                                            <option hidden></option>
                                            <option value="Letter">Letter</option>
                                            <option value="File">File</option>
                                            <option value="VIP Letter">VIP Letter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Received by</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Received By"
                                            data-bvalidator="required" name="received_by" data-control="select2">
                                            <option hidden></option>
                                            <option value="By hand">By hand</option>
                                            <option value="Courier">Courier</option>
                                            <option value="Email">Email</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Received from</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Received By"
                                            data-bvalidator="required" name="received_from" data-control="select2">
                                            <option hidden></option>
                                            <option value="Internal">Internal</option>
                                            <option value="Public">Public</option>
                                            <option value="People's Representative">People's Representative</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div id="DivLetter" class="d-none">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Letter No</span>
                                            </label>
                                            <input class="form-control" name="letter_no" placeholder="Enter Letter No"
                                                data-bvalidator="required" value="{{ $unique }}"/>
                                        </div>
                                    </div>
                                    <div id="DivFile" class="d-none">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">File Name / File Number / Location / Rack
                                                    Number</span>
                                            </label>
                                            <input class="form-control" name="rack_no"
                                                placeholder="File Name / File Number / Location / Rack Number"
                                                data-bvalidator="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="DivByHand" class="d-none">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Person Name</span>
                                            </label>
                                            <input class="form-control" name="by_hand_name" placeholder="Enter Person Name"
                                                data-bvalidator="required" />
                                        </div>
                                    </div>
                                    <div id="DivEmail" class="d-none">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Email</span>
                                            </label>
                                            <input class="form-control" name="email" placeholder="Enter Email"
                                                data-bvalidator="required" />
                                        </div>
                                    </div>
                                    <div id="DivCourier" class="d-none">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Courier Name</span>
                                            </label>
                                            <input class="form-control" name="courier_name" placeholder="Enter Courier Name"
                                                data-bvalidator="required" />
                                        </div>
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Tracking ID</span>
                                            </label>
                                            <input class="form-control" name="tracking_id"
                                                placeholder="Enter Tracking ID" data-bvalidator="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="DivConcernedPerson" class="d-none">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Name of concerned person</span>
                                            </label>
                                            <input class="form-control" name="received_from_name"
                                                placeholder="Enter Name of concerned person" data-bvalidator="required" />
                                        </div>
                                    </div>
                                    <div id="DivPeopleRepresentitive" class="d-none">
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Name of People's Representative</span>
                                            </label>
                                            <input class="form-control" name="received_from_name2"
                                                placeholder="Enter Name of concerned person" data-bvalidator="required" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Subject</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Subject"
                                            data-bvalidator="required" name="subject_id" data-control="select2">
                                            <option hidden></option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Department</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Department"
                                            data-bvalidator="required" name="department_id" data-control="select2">
                                            <option hidden></option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Branch</span>
                                        </label>
                                        <select class="form-select fw-bold" data-placeholder="Select Branch"
                                            data-bvalidator="required" name="branch_id" data-control="select2">
                                            <option hidden></option>
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
                                            <option value="Received" selected>Received</option>
                                            <option value="In Process">In Process</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Signed">Signed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Date</span>
                                        </label>
                                        <input class="form-control flatDatepickr" name="date" placeholder="Enter date"
                                            data-bvalidator="required" data-min-today="false" data-alt-format="d/m/Y" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            Concerned Authority
                                        </label>
                                        <input class="form-control" name="authority_name"
                                            placeholder="Enter Concerned Authority" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Description</span>
                                        </label>
                                        <textarea name="description" rows="4" class="form-control" placeholder="Enter description"
                                            data-bvalidator="required"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="fv-row mb-7 form-group">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Comment</span>
                                        </label>
                                        <textarea name="comment" rows="4" class="form-control" placeholder="Enter Comment"
                                            data-bvalidator="required"></textarea>
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
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-end">
                                <a href="{{ route('inward-letter.index') }}" class="btn btn-light me-3">Discard</a>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @push('js')
        <script>
            $(document).on('change', 'select[name="department_id"]', function() {
                var department_id = $(this).val();
                var branch_id = $('select[name="branch_id"]');
                branch_id.empty();
                branch_id.append('<option hidden></option>');
                $.ajax({
                    url: "{{ route('getBranches', ['department_id' => '__ID__']) }}".replace('__ID__',
                        department_id),
                    type: "GET",
                    success: function(data) {
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
        </script>
    @endpush
</x-app-layout>
