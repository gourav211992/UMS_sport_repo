@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Candidate Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">Candidate Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <a class="btn btn-dark btn-sm mb-50 mb-sm-0" href="{{ url('sports-students') }}"><i data-feather="refresh-ccw"></i> Reset</a>
                    <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>
                    <!-- <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('sports-registration') }}"><i data-feather="plus-circle"></i> Add New</a> -->
                </div>
            </div>
        </div>
        <div class="content-body">

            @include('ums.admin.notifications')

            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card card-statistics new-cardbox">
                        <!-- <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                                </svg></div>
                                            <h4>{{ $totalRegisteredStudents }}</h4>

                                        </div>
                                        <p>Total<br>Registeration</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon">
                                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                                </svg></div>
                                            <h4>{{ $totalPaidStudents }}</h4>

                                        </div>
                                        <p>Paid<br>Status</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon">
                                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                                </svg></div>
                                            <h4>{{ $totalApprovedStudents }}</h4>

                                        </div>
                                        <p>Approved<br> Status</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon">
                                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                                </svg></div>
                                            <h4>{{ $totalRejectedStudents }}</h4>


                                        </div>
                                        <p>Rejected<br> Status</p>
                                    </div>
                                </div>

                            </div>
                        </div> -->
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                                </svg></div>
                                            <h4>{{ $totalRegisteredStudents }}</h4>

                                        </div>
                                        <p>Total<br>Registeration</p>
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                                fill="none"stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                                stroke-linejoin="round" class="feather feather-dollar-sign avatar-icon">
                                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14.5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg>
                                            </div>
                                            <h4>{{ $totalPaidStudents }}</h4>

                                        </div>
                                        <p>Paid<br>Status</p>
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-check-circle avatar-icon">
                                                <path d="M9 12l2 2l4 -4"></path>
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                            </div>
                                            <h4>{{ $totalApprovedStudents }}</h4>

                                        </div>
                                        <p>Approved<br> Status</p>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box avatar-icon">
                                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                                </svg></div>
                                            <h4>{{ $totalRejectedStudents }}</h4>


                                        </div>
                                        <p>Rejected<br> Status</p>
                                    </div>
                                </div> --}}
                                
                                <div class="col-md">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-slash avatar-icon">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                                            </svg>
                                            
                                            </div>
                                            <h4>{{ $totalRejectedStudents }}</h4>
                                        </div>
                                        <p>Rejected<br> Status</p>
                                    </div>
                                </div>
                                
                                <div class="col-md">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-clock avatar-icon">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                            </div>
                                            <h4>{{  $totalOnholdStudents }}</h4>
                                        </div>
                                        <p>On-Hold<br> Status</p>
                                    </div>
                                </div>
                                
                                <div class="col-md">
                                    <div class="taskboxassign">
                                        <div class="taslcatrdnum">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit avatar-icon">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14l4-4h9a2 2 0 0 0 2-2V8"></path>
                                                    <polyline points="16 3 21 8 8 21 3 21 3 16 16 3"></polyline>
                                                </svg>
                                            </div>
                                            <h4>{{ $totaldraftStudents }}</h4>
                                        </div>
                                        <p>Draft<br> Status</p>
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive candidates-tables">
                                <table class="datatables-basic table table-striped myrequesttablecbox ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reg. No.</th>
                                            <th>Reg. Date</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Age</th>
                                            <th>Date of Joining</th>
                                            <!-- <th>Batch</th> -->
                                            <th>Payment Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-bolder text-dark">{{ $student->document_number }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->document_date)->format('d-m-Y') }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->gender ?: 'Not Provided' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->dob)->format('d-m-Y') }}</td>
                                            <td>
                                                @php
                                                    $age = \Carbon\Carbon::parse($student->dob)->age;
                                                @endphp
                                                {{ $age }} years
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($student->doj)->format('d-m-Y') }}</td>
                                            <!-- <td>{{ $student->batch ? $student->batch->batch_name : 'Not Provided' }}</td> -->
                                            <td>
                                                @php
                                                $paymentStatus = $student->user->payment_status ?? 'pending';
                                                $badgeClass = ($paymentStatus === 'paid') ? 'badge-light-success' : 'badge-light-warning';
                                                if($paymentStatus === 'confirm'){
                                                $badgeClass = 'badge-light-info';
                                                }
                                                @endphp

                                                <span class="badge rounded-pill {{ $badgeClass }}">
                                                    {{ ucfirst($paymentStatus) }}
                                                </span>
                                            </td>
                                            <td>
                                                {{-- @dump($student->status)--}}
                                                <span class="badge rounded-pill
                                                            {{ ($student->status == 'submitted' || $student->status == 'approved') ? 'badge-light-success' : ($student->status == 'rejected' ? 'badge-light-danger' : 'badge-light-warning') }}">
                                                    @if($student->status == 'submitted' || $student->status == 'approved' || $student->status == 'rejected' || $student->status == 'on-hold')
                                                    {{ ucfirst($student->status) }}
                                                    @else
                                                    Draft
                                                    @endif
                                                </span>

                                            </td>
                                            <td class="tableactionnew">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('view-registration',$student->id) }}">
                                                            <i data-feather="edit" class="me-50"></i>
                                                            <span>View Detail</span>
                                                        </a>
                                                        @if( $student->status != 'approved')
                                                        <a class="dropdown-item" href="{{route('edit-registration',$student->id)}}">
                                                            <i data-feather="edit-3" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        @endif
                                                        <!-- <a class="dropdown-item" href="#">
                                                            <i data-feather="trash-2" class="me-50"></i>
                                                            <span>Delete</span>
                                                        </a> -->

                                                        @if( $student->status == 'approved'&& $student->user->payment_status== 'paid')
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $student->id }}">
                                                            <i data-feather="check-circle" class="me-50"></i>
                                                            <span>Confirm</span>
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

                <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
                    <div class="modal-dialog sidebar-sm">
                        <form class="modal-content pt-0" method="GET" action="{{ route('sports-students') }}">
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                            </div>

                            <div class="modal-body flex-grow-1">
                                <!-- Date Range -->
                                <div class="mb-1">
                                    <label class="form-label" for="fp-range">Select Date Range</label>
                                    <input type="text" id="fp-range" name="date_range" class="form-control flatpickr-range"
                                        placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                        value="{{ old('date_range', $selectedate) }}" />
                                </div>

                                <!-- Batch Name -->
                                <div class="mb-1">
                                    <label class="form-label" for="batch_id">Batch Name</label>
                                    <select class="form-select select2" name="batch_id" id="batch_id">
                                        <option value="">Select</option>
                                        @foreach($batchs->unique() as $batch)
                                        <option value="{{ $batch->id }}"
                                            {{ (old('batch_id', $selectebatchname) == $batch->id) ? 'selected' : '' }}>
                                            {{ $batch->batch_name }} ({{ $batch->batch_year }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Profile Status -->
                                <div class="mb-1">
                                    <label class="form-label" for="profile_status">Profile Status</label>
                                    <select class="form-select select2" name="profile_status" id="profile_status">
                                        <option value="">Select</option>
                                        <option value="draft" {{ old('profile_status', $selecteprofilestatus) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="submitted" {{ old('profile_status', $selecteprofilestatus) == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                        <option value="on-hold" {{ old('profile_status', $selecteprofilestatus) == 'on-hold' ? 'selected' : '' }}>On-hold</option>
                                        <option value="rejected" {{ old('profile_status', $selecteprofilestatus) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="approved" {{ old('profile_status', $selecteprofilestatus) == 'approved' ? 'selected' : '' }}>Approved</option>
                                    </select>
                                </div>

                                <!-- Payment Status -->
                                <div class="mb-1">
                                    <label class="form-label" for="payment_Status">Payment Status</label>
                                    <select class="form-select select2" name="payment_Status" id="payment_Status">
                                        <option value="">Select</option>
                                        <option value="paid" {{ old('payment_Status', $selectpaymentstatus) == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="pending" {{ old('payment_Status', $selectpaymentstatus) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirm" {{ old('payment_Status', $selectpaymentstatus) == 'confirm' ? 'selected' : '' }}>Confirm</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-start">
                                <button type="submit" class="btn btn-primary">Apply</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
                    <div class="modal-dialog sidebar-sm">
                       
                        <form class="modal-content pt-0" method="GET" action="{{ route('sports-students') }}">
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <div class="mb-1">
                                    <label class="form-label" for="fp-range">Select Date Range</label>
                                    <input type="text" id="fp-range" name="date_range" class="form-control flatpickr-range"
                                        placeholder="YYYY-MM-DD to YYYY-MM-DD" value="{{ old('date_range', ) }}" />
                                </div>

                                <div class="mb-1">
                                    <label class="form-label" for="request-no">Batch Name</label>
                                    <select class="form-select select2" name="batch_id">
                                        <option value="">Select</option>
                                        @foreach($batchs->unique() as $batch)
                                        <option value="{{ $batch->id}}">
                                            {{ $batch->batch_name  }} {{ $batch->batch_year }} {{ $batch->id}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-1">
                                    <label class="form-label" for="raised-by">Profile status</label>
                                    <select class="form-select select2" name="profile_status">
                                        <option value="">Select</option>
                                        <option value="draft">Draft </option>
                                        <option value="submitted ">Submitted </option>
                                        <option value="on-hold">On-hold</option>
                                        <option value="rejected">Reject</option>
                                        <option value="approved">Approved</option>


                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="raised-by">Payment Status</label>
                                    <select class="form-select select2" name="payment_Status">
                                        <option value="">Select</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                        <option value="confirm ">Confirm</option>

                                    </select>
                                </div>


                            </div>
                            <div class="modal-footer justify-content-start">
                                <button type="submit" class="btn btn-primary ">Apply</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>


                    </div>
                </div> -->
            
            </section>
        </div>
    </div>
</div>




@foreach ($students as $student)
<!-- Modal for each student -->
<div class="modal fade" id="confirmModal{{ $student->id }}" tabindex="-1" aria-labelledby="confirmModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel{{ $student->id }}">Confirm Payment Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to confirm the payment status for {{ $student->name }}?
            </div>
            <div class="modal-footer">
                <!-- Cancel Button -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                <!-- Confirm Button (redirect to the confirmation route) -->
                <a href="{{ route('sport-confirm-stu', $student->id) }}" class="btn btn-success">Confirm</a>
            </div>
        </div>
    </div>
</div>
@endforeach




<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#fp-range", {
            mode: "range",
            dateFormat: "Y-m-d",
            maxDate: "today"
        });
    });
</script>


@endsection