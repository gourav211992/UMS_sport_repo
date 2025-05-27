@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content');
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
                            <button onClick="javascript: history.go(-1)" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i
                                    data-feather="check-circle"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>
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
                                                    <select class="form-select" name="sport" disabled>
                                                        <option value="{{ $data->sportRelation->sport_name }}" selected>
                                                            {{ $data->sportRelation->sport_name }}</option>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Yr. <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-3 mb-1 mb-sm-0">
                                                    <select class="form-select select2" disabled>
                                                        <option value="{{ $data->batch_year }}" selected>
                                                            {{ ucfirst($data->batch_year) }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mb-1 mb-sm-0">
                                                    <label class="form-label">Batch <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-3">
                                                    <select class="form-select select2" disabled>
                                                        <option value="{{ $data->batchRelation->batch_name }}" selected>
                                                            {{ ucfirst($data->batchRelation->batch_name) }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-3 mb-1 mb-sm-0">
                                                    <select class="form-select select2" name="section" id="section"
                                                        disabled>
                                                        <option value="{{ $data->sectionRelation->name }}" selected>
                                                            {{ ucfirst($data->sectionRelation->name) }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 mb-1 mb-sm-0">
                                                    <label class="form-label">Group <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-3">
                                                    <select class="form-select select2" disabled id="group" name="group">
                                                        <option value="{{ $data->groupRelation->name }}" selected>
                                                            {{ ucfirst($data->groupRelation->name ?? '') }}</option>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Trainer <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-select select2" disabled>
                                                        <option value="" disabled selected>-- Select Trainer
                                                            --</option>
                                                        @foreach ($trainers as $item)
                                                            <option value={{ $item['id'] }}
                                                                {{ $item['id'] == $data->trainer ? 'selected' : '' }}>
                                                                {{ ucfirst($item['name']) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <!-- <div class="col-md-5">
                                                    <select class="form-select select2" disabled>
                                                        <option value="{{ $data->trainer }}">{{ ucfirst($data->trainer) }}
                                                        </option>
                                                    </select>
                                                </div> -->
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Activity <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-select select2" disabled>
                                                        <option value="{{ $data->activity }}" selected>
                                                            {{ ucfirst($data->activity) }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Sub-Activities <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <div id="selected-items" class="mb-2 d-flex flex-wrap gap-1">

                                                    </div>
                                                    @php
                                                        $initialSelected = old(
                                                            'sub_activities',
                                                            $selectedSubActivities ?? [],
                                                        );
                                                    @endphp

                                                    <div id="selected-items" class="mb-2 d-flex flex-wrap gap-1">
                                                        @if (!empty($initialSelected))
                                                            <div id="selected-list" class="d-flex flex-wrap gap-1">
                                                                @foreach ($initialSelected as $selected)
                                                                    <span
                                                                        class="badge rounded-pill bg-primary text-white d-flex align-items-center">
                                                                        {{ $selected }}
                                                                        <span class="close-icon ms-2">&times;</span>

                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>


                                                </div>
                                            </div>


                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Start Date <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-3 mb-1 mb-sm-0">
                                                    <input type="date" class="form-control"name='start_date'
                                                        value="{{ $data->start_date }}" readonly />
                                                </div>
                                                <div class="col-md-2 mb-1 mb-sm-0">
                                                    <label class="form-label">End Date <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" class="form-control" name="end_date"
                                                        value="{{ $data->end_date }}" readonly />
                                                </div>

                                            </div>

                                            {{-- <div class="row mb-1"> 
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Day <span class="text-danger">*</span></label>  
                                                        </div> 

                                                        <div class="col-md-7">
                                                            <div class="demo-inline-spacing">
                                                                @php
                                                                    if (is_string($data->day)) {
                                                                        $daysArray = json_decode($data->day, true); 
                                                                    } else {
                                                                        $daysArray = $data->day;
                                                                    }
                                                                @endphp
                                                        
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Monday" name="day[]" value="Monday" 
                                                                        {{ in_array('Monday', $daysArray) ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label" for="Monday">Monday</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Tuesday" name="day[]" value="Tuesday" 
                                                                        {{ in_array('Tuesday', $daysArray) ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label" for="Tuesday">Tuesday</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Wednesday" name="day[]" value="Wednesday" 
                                                                        {{ in_array('Wednesday', $daysArray) ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label" for="Wednesday">Wednesday</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Thursday" name="day[]" value="Thursday" 
                                                                        {{ in_array('Thursday', $daysArray) ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label" for="Thursday">Thursday</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Friday" name="day[]" value="Friday" 
                                                                        {{ in_array('Friday', $daysArray) ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label" for="Friday">Friday</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Saturday" name="day[]" value="Saturday" 
                                                                        {{ in_array('Saturday', $daysArray) ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label" for="Saturday">Saturday</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Sunday" name="day[]" value="Sunday" 
                                                                        {{ in_array('Sunday', $daysArray) ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label" for="Sunday">Sunday</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
												
													
                                                
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Start Time <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-3 mb-1 mb-sm-0"> 
                                                            <input type="time" class="form-control" name="start_time" value="{{$data->start_time}}" readonly/>
                                                        </div> 
                                                        <div class="col-md-2 mb-1 mb-sm-0"> 
                                                            <label class="form-label">End Time <span class="text-danger">*</span></label>  
                                                        </div>
                                                        <div class="col-md-3"> 
                                                            <input type="time" class="form-control" name="end_time" value="{{$data->end_time}}" readonly/>
                                                        </div> 
                                                        
                                                     </div> --}}




                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Remarks <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <textarea class="form-control" name="remarks" readonly>{{ $data->remarks }}</textarea>
                                                </div>
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Status</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="active" name="status"
                                                                value="active" class="form-check-input"
                                                                {{ $data->status === 'active' ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label fw-bolder"
                                                                for="active">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="inactive" name="status"
                                                                value="inactive" class="form-check-input"
                                                                {{ $data->status === 'inactive' ? 'checked' : '' }}
                                                                disabled>
                                                            <label class="form-check-label fw-bolder"
                                                                for="inactive">Inactive</label>
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
                                                            <a class="nav-link" data-bs-toggle="tab"
                                                                href="#Students">Students</a>
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

                                                                @php
                                                                    $daysOfWeek = [
                                                                        'Monday',
                                                                        'Tuesday',
                                                                        'Wednesday',
                                                                        'Thursday',
                                                                        'Friday',
                                                                        'Saturday',
                                                                        'Sunday',
                                                                    ];
                                                                    $scheduledDays =
                                                                        isset($data) && isset($data->day)
                                                                            ? json_decode($data->day, true)
                                                                            : [];
                                                                @endphp

                                                                <tbody>
                                                                    @foreach ($daysOfWeek as $index => $day)
                                                                        <tr>
                                                                            <td class="poprod-decpt">{{ $index + 1 }}
                                                                            </td>
                                                                            <td class="poprod-decpt">
                                                                                <strong>{{ $day }}</strong>
                                                                            </td>

                                                                            {{-- Start Time --}}
                                                                            <td class="poprod-decpt">
                                                                                <input disabled type="time"
                                                                                    class="form-control mw-100"
                                                                                    name="day[{{ $day }}][start_time]"
                                                                                    value="{{ $scheduledDays[$day]['start_time'] ?? '' }}">
                                                                            </td>

                                                                            {{-- End Time --}}
                                                                            <td class="poprod-decpt">
                                                                                <input disabled type="time"
                                                                                    class="form-control mw-100"
                                                                                    name="day[{{ $day }}][end_time]"
                                                                                    value="{{ $scheduledDays[$day]['end_time'] ?? '' }}">
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
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="select-all-students" disabled>
                                                                            </div>
                                                                        </th>
                                                                        <th width="250px">Registration No</th>
                                                                        <th width="250px">First Player Name</th>
                                                                        <th width="250px">Last Player Name</th>
                                                                        <th>DOJ</th>
                                                                        <th>reason</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="section-data">
                                                                </tbody>
                                                            </table>
                                                        </div>
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

            $('#sub-activities').select2({
                placeholder: "Select sub-activities",
                allowClear: true,
                width: '100%'
            });

            $('#activity').val("{{ old('activity', $data->activity ?? '') }}");

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
                                let selectedItems = @json(old('sub_activities', $selectedSubActivities ?? []));

                                $('#sub-activities').html(''); // Clear first

                                $.each(response.sub_activities, function(index, item) {
                                    let isSelected = selectedItems.includes(item.name) ?
                                        'selected' : '';
                                    $('#sub-activities').append(
                                        `<option value="${item.name}" ${isSelected}>${item.name}</option>`
                                    );
                                });

                                $('#sub-activities').trigger('change');
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

            $('#activity').trigger('change');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#batch_year').change(function() {
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
                                        .batch_name + '">' + item.batch_name +
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
        const selectedGroup = "{{ $data->group }}";

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
                                let isSelected = (item.id == selectedGroup) ?
                                    'selected' : '';
                                $('#group').append(
                                    '<option value="' + item.id + '" ' +
                                    isSelected + '>' + item.name + '</option>'
                                );
                            });
                            $('#group').prop('disabled', false);

                            if (selectedGroup) {
                                $('#group').val(selectedGroup).trigger('change').attr('disabled');
                            }

                        } else {
                            $('#group').prop('disabled', true);
                        }
                    }

                });
            } else {
                $('#group').prop('disabled', true);
            }
        });
        const sectionVal = $('#section').val();
        if (sectionVal) {
            $('#section').trigger('change');
        }
    });
    </script>
    
    <script>
    let preselectedStudents = @json($selectedStudentIds ?? []);
    console.log(preselectedStudents);
    </script>
    
    <script>
    $(document).ready(function() {
        $('#group').on('change', function() {
            let GroupId = $(this).val();

            if (GroupId) {
                $('#section-data').html(
                    '<tr><td colspan="6" class="text-center">Loading students...</td></tr>');

                $.ajax({
                    url: "{{ route('get_batch_student') }}",
                    type: "POST",
                    data: {
                        group_id: GroupId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let rows = '';

                        if (response.length > 0) {
                            $.each(response, function(index, student) {
                                let matched = preselectedStudents.find(s => s.id ==
                                    student.id);
                                let isChecked = matched?.isChecked ? 'checked' : '';
                                let reason = (matched?.reason) ?? '';

                                rows += `
                                <tr>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input student-checkbox" type="checkbox" name="batch_student[]" value="${student.id}" ${isChecked}>
                                        </div>
                                    </td>
                                    <td><strong>${student.document_number ?? 'N/A'}</strong></td>
                                    <td>${student.name ?? 'N/A'}</td>
                                    <td>${student.last_name ?? 'N/A'}</td>
                                    <td>${formatDate(student.document_date)}</td>
                                    <td>
                                        <input type="text" class="form-control mw-100 student-reason" data-student-id="${student.id}" placeholder="Enter reason" value="${reason}">
                                    </td>
                                </tr>
                            `;
                            makeReadOnly();

                            });
                        } else {
                            rows =
                                `<tr><td colspan="6" class="text-center">No students found for this Group.</td></tr>`;
                        }

                        $('#section-data').html(rows);
                        toggleSelectAllCheckbox();
                        toggleReasonVisibility();
                    },
                    error: function(xhr) {
                        console.error('AJAX error:', xhr.responseText);
                        $('#section-data').html(
                            '<tr><td colspan="6" class="text-danger text-center">Something went wrong</td></tr>'
                            );
                    }
                });
            } else {
                $('#section-data').html('');
            }
        });

        $('#submit').on('click', function(e) {
            e.preventDefault();

            let batchStudents = [];
            let allValid = true;

            $('#section-data tr').each(function() {
                let $checkbox = $(this).find('input[name="batch_student[]"]');
                let studentId = $checkbox.val();
                let isChecked = $checkbox.prop('checked');
                let reason = $(this).find('.student-reason').val().trim();

                if (!isChecked && reason === '') {
                    $(this).find('.student-reason').addClass('is-invalid');
                    allValid = false;
                } else {
                    $(this).find('.student-reason').removeClass('is-invalid');
                    batchStudents.push({
                        id: studentId,
                        isChecked: isChecked,
                        reason: reason
                    });
                }
            });

            if (!allValid) {
                alert("Please fill reason for all unchecked students.");
                return;
            }

            let form = $('#form')[0];
            let formData = new FormData(form);
            formData.append('batch_students', JSON.stringify(batchStudents));

            $.ajax({
                url: "{{ route('activity-scheduler-edit', $data->id) }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.location.href = response.redirect;
                    console.log('Success:', response);
                },
                error: function(xhr) {
                    $('#form-errors').html('');

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, message) {
                            errorMessages += `<div>${message}</div>`;
                        });

                        $('#form-errors').html(`<div>${errorMessages}</div>`).show();
                    } else {
                        $('#form-errors').html(
                            `<div>Something went wrong with the request. Please try again.</div>`
                            ).show();
                    }
                }
            });
        });

        const editingSectionId = $('#section').val();
        if (editingSectionId) {
            $('#section').trigger('change');
        }

        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const parts = dateString.split("-");
            return `${parts[2]}-${parts[1]}-${parts[0]}`;
        }

        function toggleReasonVisibility() {
            $('.student-checkbox').each(function() {
                const $checkbox = $(this);
                const $reasonInput = $checkbox.closest('tr').find('.student-reason');

                if ($checkbox.is(':checked')) {
                    $reasonInput.closest('td').hide();
                    $reasonInput.val('');
                } else {
                    $reasonInput.closest('td').show();
                }
            });
        }

        $(document).on('change', '#select-all-students', function() {
            const isChecked = $(this).is(':checked');
            $('.student-checkbox').prop('checked', isChecked);
            toggleReasonVisibility();
        });

        $(document).on('change', '.student-checkbox', function() {
            toggleSelectAllCheckbox();
            toggleReasonVisibility();
        });

        function toggleSelectAllCheckbox() {
            const total = $('.student-checkbox').length;
            const selected = $('.student-checkbox:checked').length;
            $('#select-all-students').prop('checked', total > 0 && total === selected);
        }
    });
    </script>
    
    <script>

    function makeReadOnly() {

        const elements = document.querySelectorAll('input, select, textarea','a');

        elements.forEach(element => {

            element.disabled = true;  

        });

    }

    window.onload = makeReadOnly();

    </script>


@endsection
