@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content');
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Activity Scheduler</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Home</a></li>  
                                    <li class="breadcrumb-item active">Scheduler List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        {{-- <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>  --}}
						<a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{url('activity-scheduler-add')}}"><i data-feather="plus-circle"></i> Add New</a> 
                    </div>
                </div>
            </div>
            <div class="content-body">
			 @if(session('success'))
				<div class="alert alert-success p-2 alert-dismissible fade show" role="alert">
					<span>{{ session('success') }}</span>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			 @endif

	        <div id="ajax-success-container"></div>


				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive candidates-tables">
									<table class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist "> 
                                        <thead>
                                             <tr class="text-center">
												<th>#</th>
												<th>Activity</th>
												<th>Scheduler No.</th>
												<th>Trainer</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th>Section</th>
												<th>Group</th>
												<th>Students</th>
												<th>Status</th>
												<th>Action</th>
											  </tr>
											</thead>
											<tbody>
												@foreach ($activityScheduler as $index=>$item)
												 <tr class="text-center">
													<td>{{$index+1}}</td>
													<td class="fw-bolder text-dark">{{$item->activity}}</td>
													<td>{{$item->scheduler_no}}</td>
													<td>{{$item->trainer}}</td>
													<td>{{$item->start_date}}</td>
													<td>{{$item->end_date}}</td>
													<td>{{ $item->sectionRelation->name ?? 'N/A' }}</td>
													<td>{{ $item->groupRelation->name ?? 'N/A' }}</td>												
													@php
													$student = json_decode($item->batch_student , true);
													$count = is_array($student) ? count($student) : 0;
												    @endphp
												
												<td>
													<span class="badge rounded-pill badge-light-secondary badgeborder-radius">{{$count}}</span>
												</td>
											    <td>
											    	@if($item->status == 'inactive')
											    	<span class="badge rounded-pill badge-light-danger">Inactive</span>
										        	@else
											     	<span class="badge rounded-pill badge-light-success">Active</span>
											       @endif
										        </td>	
											  			<td class="tableactionnew">
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{url('activity-scheduler-view/'.$item->id)}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																<a class="dropdown-item" href="{{url('activity-scheduler-edit/'.$item->id)}}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
																{{-- <a class="dropdown-item" href="{{ url('activity-scheduler-delete/'.$item->id) }}" onclick="return confirm('Are you sure you want to delete this data?')">
																 <i data-feather="trash-2" class="me-50"></i>
																 <span>Delete</span>
															 </a> --}}
															 <a href="#" 
															 class="dropdown-item open-confirm-modal" 
															 data-href="{{ url('activity-scheduler-delete/'.$item->id) }}">
															  <i data-feather="trash-2" class="me-50"></i>
															  <span>Delete</span>
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

	<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Confirm Deletion</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			  Are you sure you want to delete this fee record?
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			  <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Delete</a>
			</div>
		  </div>
		</div>
	  </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
		<div class="modal-dialog sidebar-sm">
			<form class="add-new-record modal-content pt-0"> 
				<div class="modal-header mb-1">
					<h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
				</div>
				<div class="modal-body flex-grow-1">
					<div class="mb-1">
						  <label class="form-label" for="fp-range">Select Date</label>
						  <input type="text" id="fp-range" class="form-control flatpickr-range bg-white" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
					</div>
                    
                    <div class="mb-1">
						<label class="form-label">Activity</label>
						<select class="form-select select2">
							<option>Select</option> 
						</select>
					</div> 
					
					<div class="mb-1">
						<label class="form-label">Trainer</label>
						<select class="form-select">
							<option>Select</option>
						</select>
					</div>
                    
                    <div class="mb-1">
						<label class="form-label">Batch</label>
						<select class="form-select">
							<option>Select</option>
						</select>
					</div>
                    
                    <div class="mb-1">
						<label class="form-label">Status</label>
						<select class="form-select select2">
							<option>Select</option> 
							<option>Active</option> 
							<option>Inactive</option> 
						</select>
					</div> 
 
				</div>
				<div class="modal-footer justify-content-start">
					<button type="button" class="btn btn-primary data-submit mr-1">Apply</button>
					<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
	
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const msg = sessionStorage.getItem('successMessage');
			if (msg) {
				const alertBox = `
					<div class="alert alert-success p-2 alert-dismissible fade show" role="alert">
						<span>${msg}</span>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				`;
				document.getElementById('ajax-success-container').innerHTML = alertBox;
				sessionStorage.removeItem('successMessage');
			}
		});
	</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const msg = sessionStorage.getItem('successMessage');
        if (msg) {
            const alertBox = `
                <div class="alert alert-success p-2 alert-dismissible fade show" role="alert">
                    <span>${msg}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            document.getElementById('ajax-success-container').innerHTML = alertBox;
            sessionStorage.removeItem('successMessage');
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).on('click', '.open-confirm-modal', function (e) {
e.preventDefault(); 

let deleteUrl = $(this).data('href');
$('#confirmDeleteBtn').attr('href', deleteUrl); 

$('#confirmDeleteModal').modal('show'); 
});

</script>

@endsection