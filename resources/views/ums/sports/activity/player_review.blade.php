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
                            <h2 class="content-header-title float-start mb-0">Player Review</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Add New</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-dark btn-sm mb-50 mb-sm-0" onclick="window.location.href='player-review'">
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
                                                <th>Date</th>
                                                <th>Activity</th>
                                                <th>Trainer</th>
                                                <th>Start Date</th>
                                                <th>Start Time</th>
                                                <th>End Date</th>
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
                                                    <td>{{ $item->activity_date }}</td>
                                                    <td>{{ $item->activity }}</td>
                                                    <td>{{ $item->trainer }}</td>
                                                    <td>{{ $item->start_date }}</td>
                                                    <td>{{ $item->start_time }}</td>
                                                    <td>{{ $item->end_date }}</td>
                                                    <td>{{ $item->end_time }}</td>
                                                    <td>{{ $item->section }}</td>
                                                    <td>{{ $item->group }}</td>
                                                    <td>
                                                        <span
                                                            class="badge rounded-pill badge-light-secondary badgeborder-radius">{{ $item->student_count }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($item->marked_status === 'Marked')
                                                            <span
                                                                class="badge rounded-pill badge-light-success">Marked</span>
                                                        @else
                                                            <span
                                                                class="badge rounded-pill badge-light-danger">Unmarked</span>
                                                        @endif
                                                    </td>

                                                    <td class="tableactionnew">
                                                        <div class="dropdown dropup">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                @if ($item->marked_status === 'Marked')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('player-review-view', ['id' => $item->id, 'date' => $item->activity_date]) }}">
                                                                        <i data-feather="eye" class="me-50"></i>
                                                                        <span>View</span>
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('player-review-edit', ['id' => $item->id, 'date' => $item->activity_date]) }}">
                                                                        <i data-feather="edit" class="me-50"></i>
                                                                        <span>Edit</span>
                                                                    </a>
                                                                @else
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('player-review-edit', ['id' => $item->id, 'date' => $item->activity_date]) }}">
                                                                        <i data-feather="check-circle" class="me-50"></i>
                                                                        <span>Mark</span>
                                                                    </a>
                                                                @endif
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
            <form class="add-new-record modal-content pt-0" id="approveds-form" method="GET" novalidate
                action="{{ url('player-review') }}">
                @csrf
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">List of Activity</h5>
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
                                <option value="{{ $activity }}"
                                    {{ request()->activity == $activity ? 'selected' : '' }}>
                                    {{ $activity }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Trainer</label>
                        <select class="form-select select2" name="trainer" id="trainer">
                            <option value="Select"> Select </option>
                            @foreach ($allTrainers as $trainer)
                                <option value="{{ $trainer }}"
                                    {{ request()->trainer == $trainer ? 'selected' : '' }}>
                                    {{ $trainer }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-start">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>
@endsection
