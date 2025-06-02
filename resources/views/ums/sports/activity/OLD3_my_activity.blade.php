@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">My Schedule</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Schedule List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-dark btn-sm mb-50 mb-sm-0" onclick="window.location.href='my-activity'">
                            <i data-feather="refresh-cw" class="me-50"></i> Reset
                        </button>
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter"
                            data-bs-toggle="modal"><i data-feather="filter"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @if (session('success'))
                    <div class="alert alert-success p-2 alert-dismissible fade show" role="alert">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="table-responsive candidates-tables">

                                    <table
                                        class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist ">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Activity</th>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Section</th>
                                                <th>Group</th>
                                                <th>Students</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($finalActivities as $index => $item)
                                                <tr class="text-center">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->activity }}</td>
                                                    <td>{{ $item->activity_date }}</td>
                                                    <td>{{ $item->start_time }}</td>
                                                    <td>{{ $item->end_time }}</td>
                                                    <td>{{ $item->section }}</td>
                                                    <td>{{ $item->group }}</td>
                                                    <td>
                                                        <span
                                                            class="badge rounded-pill badge-light-secondary badgeborder-radius">{{ $item->student_count }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 'inactive')
                                                            <span
                                                                class="badge rounded-pill badge-light-danger">Inactive</span>
                                                        @else
                                                            <span
                                                                class="badge rounded-pill badge-light-success">Active</span>
                                                        @endif
                                                    </td>
                                                    <td class="tableactionnew">
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('activity-view', ['id' => $item->id, 'date' => $item->activity_date]) }}">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    @include('ums.admin.search-model', ['searchTitle' => 'sport List Search'])
    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
    <div class="modal-dialog sidebar-sm">
        <form class="add-new-record modal-content pt-0" id="approveds-form" method="GET" action="{{ url('my-activity') }}">
            @csrf
            <div class="modal-header mb-1">
                <h5 class="modal-title">List of Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body flex-grow-1">

                <div class="mb-1">
                    <label class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" value="{{ request()->start_date }}">
                </div>

                <div class="mb-1">
                    <label class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" value="{{ request()->end_date }}">
                </div>

                <div class="mb-1">
                    <label class="form-label">Activity</label>
                    <select class="form-select select2" name="activity" id="activity">
                        <option value="Select">Select</option>
                        @foreach ($allActivities as $activity)
                            <option value="{{ $activity->activity_name }}"
                                {{ request()->activity == $activity->activity_name ? 'selected' : '' }}>
                                {{ $activity->activity_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-1">
                    <label class="form-label">Batch</label>
                    <select class="form-select" name="batch" id="batch">
                        <option value="Select">Select</option>
                        @foreach ($allBatches as $batch)
                            <option value="{{ $batch->batch_name }}"
                                {{ request()->batch == $batch->batch_name ? 'selected' : '' }}>
                                {{ $batch->batch_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-1">
                    <label class="form-label">Section</label>
                    <select class="form-select" name="section" id="section">
                        <option value="Select">Select</option>
                        {{-- Populate dynamically or from controller if needed --}}
                    </select>
                </div>

                <div class="mb-1">
                    <label class="form-label">Group</label>
                    <select class="form-select" name="group" id="group">
                        <option value="Select">Select</option>
                        {{-- Populate dynamically or from controller if needed --}}
                    </select>
                </div>
            </div>

            <div class="modal-footer justify-content-start">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </form>
    </div>
</div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const batchSelect = document.getElementById("batch");
            const sectionSelect = document.getElementById("section");
            const groupSelect = document.getElementById("group");

            batchSelect.addEventListener("change", function() {
                const batch = batchSelect.value;

                // Clear existing options
                sectionSelect.innerHTML = '<option value="Select">Select</option>';
                groupSelect.innerHTML = '<option value="Select">Select</option>';

                if (batch && batch !== 'Select') {
                    fetch(`/get-sections?batch=${batch}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(section => {
                                const option = document.createElement("option");
                                option.value = section;
                                option.text = section;
                                sectionSelect.appendChild(option);
                            });
                        });
                }
            });

            sectionSelect.addEventListener("change", function() {
                const batch = batchSelect.value;
                const section = sectionSelect.value;

                groupSelect.innerHTML = '<option value="Select">Select</option>';

                if (batch && section && batch !== 'Select' && section !== 'Select') {
                    fetch(`/get-groups?batch=${batch}&section=${section}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(group => {
                                const option = document.createElement("option");
                                option.value = group;
                                option.text = group;
                                groupSelect.appendChild(option);
                            });
                        });
                }
            });
        });
    </script>
@endsection
