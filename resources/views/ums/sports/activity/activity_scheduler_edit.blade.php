@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
    ;
    <style>
        .error-box {
            display: none;
            background-color: #ffe0e0;
            border: 1px solid #ff4d4d;
            color: #b30000;
            padding: 15px 20px;
            margin-top: 15px;
            border-radius: 8px;

            max-width: 1197px;

            box-shadow: 0 2px 6px rgba(255, 0, 0, 0.1);
            margin-left: 16px;

            transition: all 0.3s ease-in-out;
        }

        .error-box div {
            margin-bottom: 5px;
            position: relative;
            padding-left: 20px;
            margin-left: 20px;
        }

        .error-box div::before {
            content: "⚠️";
            position: absolute;
            left: 0;
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

            <form id="form" method="POST" action="{{ route('activity-scheduler-edit', $data->id) }}"
                enctype="multipart/form-data">
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
                                                        <select class="form-select" name="sport">
                                                            @if ($data->sport)
                                                                @php
                                                                    $selectedSport = $sport->firstWhere(
                                                                        'id',
                                                                        $data->sport,
                                                                    );
                                                                @endphp
                                                                <option value="{{ $data->sport }}" selected>
                                                                    {{ ucfirst($selectedSport->sport_name ?? 'Selected Sport') }}
                                                                </option>
                                                            @else
                                                                <option value="" selected disabled>-- Select Sport --
                                                                </option>
                                                            @endif

                                                            @foreach ($sport as $s)
                                                                <option value="{{ $s->id }}"
                                                                    {{ old('sport', $data->sport) == $s->id ? 'selected' : '' }}>
                                                                    {{ ucfirst($s->sport_name) }}
                                                                </option>
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
                                                            <option value="" disabled
                                                                {{ !$data->batch_year ? 'selected' : '' }}>-- Select Batch
                                                                Year --</option>
                                                            @foreach ($batch->pluck('batch_year')->unique() as $batch_year)
                                                                <option value="{{ $batch_year }}"
                                                                    {{ old('batch', $data->batch_year) == $batch_year ? 'selected' : '' }}>
                                                                    {{ ucfirst($batch_year) }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <div class="col-md-2 mb-1 mb-sm-0">
                                                        <label class="form-label">Batch <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <select class="form-select" name="batch_name" id="batch_name">
                                                            @if ($data->batchRelation)
                                                                <option value="{{ $data->batchRelation->id }}" selected>
                                                                    {{ ucfirst($data->batchRelation->batch_name) }}
                                                                </option>
                                                            @else
                                                                <option value="" disabled selected>-- Select Batch --
                                                                </option>
                                                            @endif

                                                            @foreach ($batch as $b)
                                                                <option value="{{ $b->id }}"
                                                                    {{ old('batch_name', $data->batch_name) == $b->id ? 'selected' : '' }}>
                                                                    {{ ucfirst($b->batch_name) }}
                                                                </option>
                                                            @endforeach
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
                                                            <option value="" disabled
                                                                {{ !$data->sectionRelation ? 'selected' : '' }}>-- Select
                                                                Section --</option>
                                                            @foreach ($section as $sec)
                                                                <option value="{{ $sec->id }}"
                                                                    {{ old('section', $data->section) == $sec->id ? 'selected' : '' }}>
                                                                    {{ ucfirst($sec->name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>




                                                    </div>
                                                    <div class="col-md-2 mb-1 mb-sm-0">
                                                        <label class="form-label">Group <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <select class="form-select" name="group" id="group">
                                                            @if ($data->groupRelation)
                                                                <option value="{{ $data->groupRelation->id }}" selected>
                                                                    {{ ucfirst($data->groupRelation->group_name) }}
                                                                </option>
                                                            @else
                                                                <option value="" disabled selected>-----Select
                                                                    Group-----</option>
                                                            @endif
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Trainer <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select select2" name="trainer" id="trainer">
                                                            <option value="" disabled>-- Select Trainer --</option>
                                                            @foreach ($trainers as $trainer)
                                                                <option value="{{ $trainer->id }}"
                                                                    {{ $trainer->id == $data->trainer ? 'selected' : '' }}>
                                                                    {{ ucfirst($trainer->name) }}
                                                                    @if ($trainer->designation)
                                                                        - {{ $trainer->designation->name }}
                                                                    @endif
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Support Staff <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select name="staff[]" id="staff" class="form-select select2" multiple >
                                                            @foreach ($trainers as $trainer)
                                                                <option value="{{ $trainer->id }}"
                                                                    {{ in_array($trainer->id, $supportStaff ?? []) ? 'selected' : '' }}>
                                                                    {{ ucfirst($trainer->name) }}
                                                                    @if ($trainer->designation)
                                                                        - {{ $trainer->designation->name }}
                                                                    @endif
                                                                </option>
                                                            @endforeach
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
                                                            <option value="" disabled
                                                                {{ !$data->activity ? 'selected' : '' }}>-- Select Activity
                                                                --</option>
                                                            @foreach ($activity as $name)
                                                                <option value="{{ $name->activity_name }}"
                                                                    {{ old('activity', $data->activity ?? '') == $name->activity_name ? 'selected' : '' }}>
                                                                    {{ ucfirst($name->activity_name) }}
                                                                </option>
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
                                                        <div id="selected-items" class="mb-2 d-flex flex-wrap gap-1">

                                                        </div>
                                                        @php
                                                            $initialSelected = old(
                                                                'sub_activities',
                                                                $selectedSubActivities ?? [],
                                                            );
                                                        @endphp

                                                        <select class="form-select" name="sub_activities[]"
                                                            id="sub-activities" multiple>
                                                            @foreach ($sub_activity as $activity)
                                                                @php
                                                                    $subActivities = json_decode(
                                                                        $activity->sub_activities,
                                                                        true,
                                                                    );
                                                                @endphp
                                                                @foreach ($subActivities as $sub)
                                                                    <option value="{{ $sub['name'] }}"
                                                                        @if (in_array($sub['name'], is_array($selectedSubActivities) ? $selectedSubActivities : [])) selected @endif>
                                                                        {{ ucfirst($sub['name']) }}
                                                                    </option>
                                                                @endforeach
                                                            @endforeach
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
                                                            value="{{ $data->start_date }}" id="start_date" />
                                                    </div>
                                                    <div class="col-md-2 mb-1 mb-sm-0">
                                                        <label class="form-label">End Date <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="date" class="form-control" name="end_date"
                                                            value="{{ $data->end_date }}" id="end_date" />
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Remarks <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <textarea class="form-control" name="remarks">{{ $data->remarks }}</textarea>
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
                                                                    {{ $data->status === 'active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="active">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="inactive" name="status"
                                                                    value="inactive" class="form-check-input"
                                                                    {{ $data->status === 'inactive' ? 'checked' : '' }}>
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
                                                        <h4 class="card-title text-theme">Add Scheduler and View Students
                                                        </h4>
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

                                                    <div id="form-errors" class="error-box"></div>


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
                                                                                <td class="poprod-decpt">
                                                                                    {{ $index + 1 }}</td>
                                                                                <td class="poprod-decpt">
                                                                                    <strong>{{ $day }}</strong>
                                                                                </td>

                                                                                <td class="poprod-decpt">
                                                                                    <input type="time"
                                                                                        class="form-control mw-100 @error('day.' . $day . '.start_time') is-invalid @enderror"
                                                                                        name="day[{{ $day }}][start_time]"
                                                                                        value="{{ old('day.' . $day . '.start_time', $scheduledDays[$day]['start_time'] ?? '') }}">
                                                                                    @error('day.' . $day . '.start_time')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                    <button type="button"
                                                                                        class="btn btn-link clear-time"
                                                                                        data-day="{{ $day }}"
                                                                                        data-field="start_time">Clear</button>
                                                                                </td>

                                                                                <td class="poprod-decpt">
                                                                                    <input type="time"
                                                                                        class="form-control mw-100 @error('day.' . $day . '.end_time') is-invalid @enderror"
                                                                                        name="day[{{ $day }}][end_time]"
                                                                                        value="{{ old('day.' . $day . '.end_time', $scheduledDays[$day]['end_time'] ?? '') }}">
                                                                                    @error('day.' . $day . '.end_time')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                    <button type="button"
                                                                                        class="btn btn-link clear-time"
                                                                                        data-day="{{ $day }}"
                                                                                        data-field="end_time">Clear</button>
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
                                                                                        id="select-all-students">
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
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        $(document).ready(function() {
            $('.clear-time').on('click', function() {
                var day = $(this).data('day');
                var field = $(this).data('field');

                var inputName = 'day[' + day + '][' + field + ']';

                $("input[name='" + inputName + "']").val('');
            });
        });
    </script>

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
            const preselectedBatchId = "{{ $data->batch_name }}";
            const preselectedBatchYear = "{{ $data->batch_year }}";

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
                                    if ($('#batch_name option[value="' + item.id + '"]')
                                        .length === 0) {
                                        $('#batch_name').append('<option value="' + item
                                            .id + '">' + item.batch_name +
                                            '</option>');
                                    }
                                });
                                $('#batch_name').prop('disabled', false);

                                if (preselectedBatchId) {
                                    $('#batch_name').val(preselectedBatchId).trigger('change');
                                }
                            } else {
                                $('#batch_name').prop('disabled', true);
                            }
                        }
                    });
                } else {
                    $('#batch_name').prop('disabled', true);
                }
            });

            const batchYear = $('#batch_year').val();
            if (batchYear) {
                $('#batch_year').trigger('change');
            } else {
                $('#batch_name').prop('disabled', true);
            }

            if (preselectedBatchId) {
                $('#batch_name').val(preselectedBatchId);
            }

            if (preselectedBatchYear) {
                $('#batch_year').val(preselectedBatchYear);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            const preselectedSectionId = "{{ $data->section }}";

            $('#batch_name').change(function() {
                const batchName = $(this).val();
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

                                if (preselectedSectionId) {
                                    $('#section').val(preselectedSectionId).trigger('change');
                                }
                            } else {
                                $('#section').prop('disabled', true);
                            }
                        }
                    });
                } else {
                    $('#section').prop('disabled', true);
                }
            });

            const currentBatchName = $('#batch_name').val();
            if (currentBatchName) {
                $('#batch_name').trigger('change');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            const selectedGroup = "{{ $data->group }}";

            $('#section').change(function() {
                var section = $(this).val();
                $('#group').html('<option value="" selected disabled>-----Select Group-----</option>');

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
                                let groupAdded = false;

                                $.each(response, function(index, item) {
                                    if (item.id == selectedGroup && !groupAdded) {
                                        $('#group').append(
                                            `<option value="${item.id}" selected>${item.name}</option>`
                                        );
                                        groupAdded = true;
                                    } else if (item.id != selectedGroup) {
                                        $('#group').append(
                                            `<option value="${item.id}">${item.name}</option>`
                                        );
                                    }
                                });

                                $('#group').prop('disabled', false);

                                if (selectedGroup && groupAdded) {
                                    $('#group').val(selectedGroup).trigger('change');
                                }

                            } else {
                                $('#group').prop('disabled', true);
                            }
                        },
                        error: function(xhr) {
                            console.error('Error fetching groups:', xhr.responseText);
                            $('#group').html(
                                    '<option value="" disabled>Failed to load groups</option>')
                                .prop('disabled', true);
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
            let lastGroupId = null;

            $('#group').on('change', function() {
                let GroupId = $(this).val();

                if (!GroupId || GroupId === lastGroupId) {
                    return;
                }

                lastGroupId = GroupId;

                $('#section-data').html(
                    '<tr><td colspan="6" class="text-center">Loading students...</td></tr>'
                );

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
                                let reason = matched?.reason ?? '';

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
                                    </tr>`;
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
@endsection
