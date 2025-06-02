@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
    ;


    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Activity Assessment</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('screening-assessment') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Assessment List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter"
                            data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>
                        <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i
                                data-feather="arrow-left-circle"></i> Back</button>


                    </div>
                </div>
            </div>
            <div class="content-body">
                @include('ums.admin.notifications')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">


                                <div class="table-responsive candidates-tables">
                                    <table
                                        class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reg. No</th>
                                                <th>Player Name</th>
                                                <th>Screening Date</th>
                                                <th>Section</th>
                                                <th>Group</th>
                                                <th>Assesment Type</th>
                                                <th>Trainer</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($screeningSummary as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td class="fw-bolder text-dark">{{ $item->document_number }}</td>
                                                    <td>{{ $item->name }} </td>
                                                    <td>{{ \Carbon\Carbon::parse($item->screening_date)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $item->sectionName }}</td>
                                                    <td>{{ $item->groupName }}</td>


                                                    <td><span
                                                            class="badge rounded-pill badge-light-secondary badgeborder-radius">{{ $item->screening_name }}</span>
                                                    </td>
                                                    <td>{{ $item->trainerName }}</td>

                                                    <td><span
                                                            class="badge rounded-pill badge-light-success badgeborder-radius">Done</span>
                                                    </td>

                                                    <td class="tableactionnew">
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                {{-- <a class="dropdown-item" href="{{url('view-mark-access')}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail 1</span>
																</a>

                                                                <a class="dropdown-item" href="{{url('mark-assess')}}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit 1</span>
																</a> --}}

                                                                <a class="dropdown-item" href="#"
                                                                    onClick="viewScreeiningAssesment('{{ $item->id }}')">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a>
                                                                <a class="dropdown-item" href="#"
                                                                    onClick="editScreeiningAssesment('{{ $item->id }}')">
                                                                    <i data-feather="edit-3" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="#"
                                                                    onClick="viewStudentReport('{{ $item->sport_register_id }}')">
                                                                    <i data-feather="edit-3" class="me-50"></i>
                                                                    <span>View Report</span>
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
            <form class="add-new-record modal-content pt-0" id="approveds-form" method="GET" novalidate
                action="{{ url('screening-assessment-inner/' . $screening_date . '/' . $sports_group_id) }}">
                @csrf

                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Filter Options</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body flex-grow-1">
                    {{-- <div class="mb-1">
                        <label class="form-label" for="fp-range">Select Date</label>
                        <!--                        <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />-->
                        <input type="text" id="fp-range" class="form-control flatpickr-range bg-white"
                            placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                    </div> --}}

                    {{-- <div class="mb-1">
                        <label class="form-label">Admission Yr.</label>
                        <select class="form-select select2">
                            <option>Select</option>
                        </select>
                    </div> --}}
                    <div class="mb-1">
                        <label class="form-label">Screening Name</label>
                        <select class="form-select" name="screening_name" id="screening_name">
                            <option value="Select">Select</option>
                            @foreach ($allscreening as $allscreen)
                                <option
                                    value="{{ $allscreen->id }}"{{ Request()->screening_name == $allscreen->id ? 'selected' : '' }}>
                                    {{ $allscreen->screening_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1">

                        <label class="form-label">Batch</label>
                        <select class="form-select" name="batch_name" id="batch_name">
                            <option value="Select">Select</option>
                            @foreach ($batchs as $item)
                                <option
                                    value="{{ $item->id }}"{{ Request()->batch_name == $item->id ? 'selected' : '' }}>
                                    {{ $item->batch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="mb-1">
                        <label class="form-label">Batch</label>
                        <select class="form-select">
                            <option>Select</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Section</label>
                        <select class="form-select">
                            <option>Select</option>
                        </select>
                    </div> --}}

                    <div class="mb-1">
                        <label class="form-label">Group</label>
                        <select class="form-select">
                            <option value="Select">Select</option>

                            @foreach ($groups as $item)
                                <option value="{{ $item->id }}"{{ Request()->name == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="mb-1">
                        <label class="form-label">Status</label>
                        <select class="form-select select2">
                            <option>Select</option>
                            <option>Done</option>
                            <option>Not Done</option>
                        </select>
                    </div> --}}



                </div>
                <div class="modal-footer justify-content-start">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function editScreeiningAssesment(slug) {
            var url = "{{ url('screening-assessment-edit') }}" + "/" + slug;
            window.location.href = url;
        }



        function viewScreeiningAssesment(slug) {
            var url = "{{ url('screening-assessment-view') }}" + "/" + slug;
            window.location.href = url;
        }

        function viewStudentReport(slug) {
            // alert(slug);
            var url = "{{ url('/student-screening-report') }}" + "/" + slug;
            // alert(url);
            window.location.href = url;
        }
    </script>
@endsection
