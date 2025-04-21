@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
    <style>
        .error-box {
            display: none;
            background-color: #ffe0e0;
            border: 1px solid #ff4d4d;
            color: #b30000;
            padding: 15px 20px;
            margin-top: 15px;
            border-radius: 8px;
            font-size: 15px;
            box-shadow: 0 2px 6px rgba(255, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .error-box div {
            margin-bottom: 5px;
            position: relative;
            padding-left: 20px;
        }

        .error-box div::before {
            content: "⚠️";
            position: absolute;
            left: 0;
        }

        .is-invalid {
            border: 1px solid red;
        }
    </style>

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header pocreate-sticky">
                <div class="row">
                    <div class="content-header-left col-md-6 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Activity Scheduler</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active">Add New</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                        <div class="form-group breadcrumb-right">
                            <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i
                                    data-feather="arrow-left-circle"></i> Back</button>
                            <button type="submit" form="form" id="submit"
                                class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>
                                Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <form id="form" method="POST" action="{{ route('activity-scheduler-add') }}">
                @csrf
                <div class="content-body">

                    <section id="basic-datatable">
                        <div class="row">
                            <div class="col-12">

                                <div class="card">
                                    <div class="card-body customernewsection-form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div
                                                    class="newheader border-bottom mb-2 pb-25 d-flex flex-wrap justify-content-between">
                                                    <div>
                                                        <h4 class="card-title text-theme">Basic Information</h4>
                                                        <p class="card-text">Fill the details</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sport <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <select class="form-select" name="sport" id="sport">
                                                            <option value="">-----Select Sport-----</option>
                                                            @foreach ($sport as $name)
                                                                <option value="{{ $name->id }}">
                                                                    {{ ucfirst($name->sport_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Yr. <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3 mb-1 mb-sm-0">
                                                        <select class="form-select" name="batch" id="batch_year">
                                                            <option value="">-- Select Batch Year --</option>
                                                            @foreach ($batch->unique('batch_year') as $item)
                                                                <option value="{{ $item->batch_year }}">
                                                                    {{ $item->batch_year }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mb-1 mb-sm-0">
                                                        <label class="form-label">Batch <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <select class="form-select" name="batch_name" id="batch_name">

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Section <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3 mb-1 mb-sm-0">
                                                        <select class="form-select" name="section" id="section">
                                                            {{-- @foreach ($section as $name)
                                                                    <option value="{{$name->name}}">{{ ucfirst($name->name) }}</option>
                                                                @endforeach --}}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mb-1 mb-sm-0">
                                                        <label class="form-label">Group <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <select class="form-select" name="group" id="group">
                                                            {{-- @foreach ($group as $name)
                                                                    <option value="{{$name->group_name}}">{{ ucfirst($name->group_name) }}</option>
                                                                @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Rows will appear here -->

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Trainer <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <select class="form-select" name="trainer" id="trainer">
                                                            <option value="">-----Select Trainer-----</option>
                                                            <option value="ankit">ankit</option>
                                                            <option value="dhan">dhan</option>
                                                            <option value="danish">danish</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Activity <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="activity" id="activity">
                                                            <option value="">-----Select Activity-----</option>
                                                            @foreach ($activity->pluck('activity_name')->unique() as $activity_name)
                                                                <option value="{{ $activity_name }}">
                                                                    {{ ucfirst($activity_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sub-Activities <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="sub_activities[]"
                                                            id="sub-activities" multiple="multiple" style="width: 100%;">
                                                            <!-- Options will be populated dynamically -->
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Start Date <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3 mb-1 mb-sm-0">
                                                        <input type="date" class="form-control"name='start_date'
                                                            id="start_date" />
                                                    </div>
                                                    <div class="col-md-2 mb-1 mb-sm-0">
                                                        <label class="form-label">End Date <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="date" class="form-control" name="end_date"
                                                            id="end_date" />
                                                    </div>

                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Remarks <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <textarea class="form-control" name="remarks" id="remarks"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Status</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="inactive" name="status"
                                                                    value="inactive" class="form-check-input">
                                                                <label class="form-check-label fw-bolder"
                                                                    for="inactive">Inactive</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="active" name="status"
                                                                    value="active" class="form-check-input" checked>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="active">Active</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>


                <div class="card">
                    <div class="card-body customernewsection-form">
                        <div class="border-bottom mb-2 pb-25">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="newheader">
                                        <h4 class="card-title text-theme">Add Scheduler and View Students</h4>
                                        <p class="card-text">View the details</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="form-errors" class="error-box"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mt-1">
                                    <div class="step-custhomapp bg-light">
                                        <ul class="nav nav-tabs my-25 custapploannav" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab"
                                                    href="#Scheduler">Scheduler</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#Students">Students</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content pb-1 px-1">

                                        <div class="tab-pane fade show active" id="Scheduler">
                                            <div class="table-responsive pomrnheadtffotsticky">
                                                <table
                                                    class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad">
                                                    <thead>
                                                        <tr>
                                                            <th width="33">#</th>
                                                            <th width="107">Day</th>
                                                            <th width="150">Start Time</th>
                                                            <th width="150">End Time</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $index => $day)
                                                            <tr>
                                                                <td class="poprod-decpt">{{ $index + 1 }}</td>
                                                                <td class="poprod-decpt">
                                                                    <strong>{{ $day }}</strong>
                                                                </td>

                                                                <td class="poprod-decpt">
                                                                    <input type="time" class="form-control mw-100"
                                                                        name="day[{{ $day }}][start_time]"
                                                                        value="{{ old('day.' . $day . '.start_time') }}">
                                                                    @error("day.$day.start_time")
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </td>

                                                                <td class="poprod-decpt">
                                                                    <input type="time" class="form-control mw-100"
                                                                        name="day[{{ $day }}][end_time]"
                                                                        value="{{ old('day.' . $day . '.end_time') }}">
                                                                    @error("day.$day.end_time")
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </td>

                                                                <td class="poprod-decpt"></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="Students">
                                            <div class="table-responsive pomrnheadtffotsticky">
                                                <table
                                                    class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad">
                                                    <thead>
                                                        <tr>
                                                            <th width="50px" class="pe-0">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="selectAll">
                                                                </div>
                                                            </th>
                                                            <th width="250px">Registration No</th>
                                                            <th width="250px">First Player Name</th>
                                                            <th width="250px">Last Player Name</th>
                                                            <th>DOJ</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="section-data">
                                                        <!-- Student rows will be populated here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


            </form>

        </div>

    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>

    </section>

    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            // AJAX to load students based on section
            $('#section').on('change', function() {
                var sectionId = $(this).val();

                if (sectionId) {
                    $.ajax({
                        url: "{{ route('get_batch_student') }}", // Your Laravel route
                        type: "POST",
                        data: {
                            section_id: sectionId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            let rows = '';

                            if (response.length > 0) {
                                $.each(response, function(index, student) {
                                    rows += `
                            <tr>
                                <td>
                                    <input class="form-check-input student-checkbox" type="checkbox" value="${student.id}" id="studentCheckbox${index}" name="batch_student[]">
                                </td>
                                <td><strong>${student.document_number ?? 'N/A'}</strong></td>
                                <td>${student.name ?? 'N/A'}</td>
                                <td>${student.last_name ?? 'N/A'}</td>
                                <td>${formatDate(student.document_date)}</td>
                                <td>
                                    <input type="text" class="form-control mw-100 student-reason" data-student-id="${student.id}" placeholder="Enter reason">
                                </td>
                            </tr>
                        `;
                                });
                            } else {
                                rows =
                                    `<tr><td colspan="6" class="text-center">No students found for this section.</td></tr>`;
                            }

                            $('#section-data').html(rows);
                            $('#selectAll').prop('checked', false); // reset Select All checkbox
                        },
                        error: function(xhr) {
                            console.log('AJAX error:', xhr.responseText);
                            $('#section-data').html(
                                '<tr><td colspan="6" class="text-danger text-center">Something went wrong</td></tr>'
                            );
                        }
                    });
                } else {
                    $('#section-data').html('');
                    $('#selectAll').prop('checked', false);
                }
            });

            // Format date from yyyy-mm-dd to dd-mm-yyyy
            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const parts = dateString.split("-");
                return `${parts[2]}-${parts[1]}-${parts[0]}`;
            }

            $(document).on('change', '#selectAll', function() {
                let isChecked = $(this).is(':checked');
                $('.student-checkbox').each(function() {
                    $(this).prop('checked', isChecked);
                    toggleReasonInput($(this), isChecked);
                });
            });

            // Individual checkbox change
            $(document).on('change', '.student-checkbox', function() {
                let allChecked = $('.student-checkbox').length === $('.student-checkbox:checked').length;
                $('#selectAll').prop('checked', allChecked);

                let isChecked = $(this).is(':checked');
                toggleReasonInput($(this), isChecked);
            });

            // Function to toggle reason input visibility
            function toggleReasonInput(checkbox, isChecked) {
                let reasonInput = checkbox.closest('tr').find('.student-reason');

                if (isChecked) {
                    reasonInput.closest('td').hide(); // Hide entire cell
                } else {
                    reasonInput.closest('td').show(); // Show cell again
                }
            }

            // Submit button logic

        });
    </script>



    <script>
        $('#submit').on('click', function(e) {
            e.preventDefault();

            let batchStudents = [];
            let allReasonsValid = true;

            // Iterate through each row in #section-data
            $('#section-data tr').each(function() {
                let studentId = $(this).find('input[name="batch_student[]"]').val();
                let studentReason = $(this).find('.student-reason').val()
            .trim(); // assuming you have input field with class 'student-reason'
                let isChecked = $(this).find('input[name="batch_student[]"]').prop('checked');

                // Check if student is unchecked and reason is empty
                if (!isChecked && studentReason === '') {
                    allReasonsValid = false;
                    $(this).find('.student-reason').addClass('is-invalid');
                } else {
                    // Remove invalid class and push data to batchStudents
                    $(this).find('.student-reason').removeClass('is-invalid');
                    batchStudents.push({
                        id: studentId,
                        reason: studentReason,
                        isChecked: isChecked
                    });
                }
            });

            // If any unchecked student doesn't have a reason, show an alert
            if (!allReasonsValid) {
                alert('Please enter a reason for all unchecked students.');
                return;
            }

            // Prepare form data
            let form = $('#form')[0];
            let formData = new FormData(form);

            // Append batch_students array manually to the FormData object
            formData.append('batch_students', JSON.stringify(batchStudents)); // Convert array to JSON string

            // Perform the AJAX request
            $.ajax({
                url: "{{ route('activity-scheduler-add') }}",
                type: 'POST',
                data: formData,
                contentType: false, // Let jQuery set contentType to multipart/form-data
                processData: false, // Don't let jQuery process the data
                success: function(response) {
                    window.location.href = response.redirect;
                    console.log('Success:', response);
                },
                error: function(xhr) {
                    let errorDiv = $('#form-errors');
                    errorDiv.hide().html(''); // Clear previous errors

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let messages = '';

                        // Loop through all errors and append to the messages
                        $.each(errors, function(key, value) {
                            messages += `<p>${value}</p>`;
                        });

                        errorDiv.html(messages).fadeIn();
                    } else {
                        errorDiv.html('<p>Unexpected error occurred.</p>').fadeIn();
                    }

                    console.log('Error:', xhr.responseText);
                }

            });
        });
    </script>



    <script>
        $(document).ready(function() {
            document.getElementById('start_date').setAttribute('min', new Date().toISOString().split('T')[0]);
            document.getElementById('end_date').setAttribute('min', new Date().toISOString().split('T')[0]);
            $('#sub-activities').select2({
                placeholder: "Select sub-activities",
                allowClear: true,
                width: '100%'
            });

            $('#activity').on('change', function() {
                var activity = $(this).val();

                $('#sub-activities').html('').trigger('change');

                if (activity) {
                    $.ajax({
                        url: "{{ route('get.activity.subactivities.activity') }}",
                        type: "POST",
                        data: {
                            sub_activities: activity,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success && response.sub_activities.length > 0) {
                                let options = '';
                                $.each(response.sub_activities, function(index, item) {
                                    options +=
                                        `<option value="${item.name}">${item.name}</option>`;
                                });
                                $('#sub-activities').html(options).trigger('change');
                            } else {
                                $('#sub-activities').html(
                                        '<option disabled>No sub-activities available</option>')
                                    .trigger('change');
                            }
                        },
                        error: function() {
                            alert('Error fetching sub-activities.');
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#batch_year').change(function() {
                // var sectionName = $('#section').val();
                var batchYear = $(this).val();
                $('#batch_name').html('<option value="" selected>-----Select Batch-----</option>');

                if (batchYear) {
                    $.ajax({
                        url: "{{ route('get.batch.names.activity') }}",
                        type: "POST",
                        data: {

                            batch_year: batchYear,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $.each(response, function(index, item) {
                                    $('#batch_name').append('<option value="' + item
                                        .id + '">' + item.batch_name +
                                        '</option>');
                                });
                                $('#batch_name').prop('disabled', false);
                            } else {
                                $('#batch_name').prop('disabled', true);
                            }
                        }
                    });
                } else {
                    $('#batch_name').prop('disabled', true);
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#batch_name').change(function() {
                // var sectionName = $('#section').val();
                var batchName = $(this).val();
                $('#section').html('<option value="" selected>-----Select Section-----</option>');

                if (batchName) {
                    $.ajax({
                        url: "{{ route('get.batch.section.activity') }}",
                        type: "POST",
                        data: {

                            batch_name: batchName,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $.each(response, function(index, item) {
                                    $('#section').append('<option value="' + item.id +
                                        '">' + item.name + '</option>');
                                });
                                $('#section').prop('disabled', false);
                            } else {
                                $('#section').prop('disabled', true);
                            }
                        }
                    });
                } else {
                    $('#section').prop('disabled', true);
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#section').change(function() {
                var section = $(this).val();
                $('#group').html('<option value="" selected>-----Select Group-----</option>');

                if (section) {
                    $.ajax({
                        url: "{{ route('get.section.group.activity') }}",
                        type: "POST",
                        data: {
                            section: section,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $.each(response, function(index, item) {
                                    $('#group').append('<option value="' + item.id +
                                        '">' + item.name + '</option>');
                                });
                                $('#group').prop('disabled', false);
                            } else {
                                $('#group').prop('disabled', true);
                            }
                        }
                    });
                } else {
                    $('#group').prop('disabled', true);
                }
            });
        })
    </script>
@endsection
