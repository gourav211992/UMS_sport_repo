@extends('ums.admin.admin-meta')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
		@include('ums.admin.notifications')
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Program Type Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('program-master') }}">Home</a></li>  
                                    <li class="breadcrumb-item active">Program Master List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                    {{-- <button class="btn btn-secondary btn-sm mb-50 mb-sm-0"
                        onclick="window.location.href='program_master'">
                        <i data-feather="refresh-cw" class="me-50"></i> Reset
                    </button> --}}
                        {{-- <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>  --}}
						<a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{url('program-add-master')}}"><i data-feather="plus-circle"></i> Add New</a> 
                    </div>
                </div>
            </div>
            <div class="content-body">
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive candidates-tables">
									<table class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist"> 
                                        <thead>
                                             <tr>
												<th>S.no</th>
												<th>Program Code</th>
												<th>Program Name</th>
												<th>Enroll. No. Code</th>
												<th>Seq. No.</th>
												<th>Status</th>
												<th>Action</th>
											  </tr>
											</thead>
											<tbody>
												@forelse($programTypes as $key => $program)
													<tr>
														<td>{{ $key + 1 }}</td>
														<td class="fw-bolder text-dark">{{ $program->program_code }}</td>
														<td>{{ $program->program_name }}</td>
														<td>{{ $program->enrollment_no }}</td>
														<td>{{ $program->seq_no }}</td>
														<td>
															<span class="badge rounded-pill 
																badge-light-{{ strtolower($program->status) === 'active' ? 'success' : 'danger' }} 
																badgeborder-radius">
																{{ ucfirst($program->status) }}
															</span>
														</td>
														<td class="tableactionnew">
															<div class="dropdown">
																<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																	<i data-feather="more-vertical"></i>
																</button>
																<div class="dropdown-menu dropdown-menu-end">
																	<a class="dropdown-item" href="{{ url('program-view-master/'.$program->id) }}">
																		<i data-feather="edit" class="me-50"></i> <span>View Detail</span>
																	</a>
																	<a class="dropdown-item" href="{{ url('program-edit-master/'.$program->id) }}">
																		<i data-feather="edit-3" class="me-50"></i> <span>Edit</span>
																	</a>
																	<form id="deleteForm-{{ $program->id }}" action="{{ url('program-delete-master', $program->id) }}" method="POST" style="display: inline;">
																		@csrf
																		@method('DELETE')
																		<button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="setDeleteId('{{ $program->id }}', '{{ $program->name }}')">
																			<i data-feather="trash-2" class="me-50"></i>
																			<span>Delete</span>
																		</button>
																	</form>
																	
																</div>
															</div>
														</td>
													</tr>
												@empty
													<tr>
														<td colspan="7" class="text-center">No data found.</td>
													</tr>
												@endforelse
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
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Deletion</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="deleteGroupName">
					<!-- Group Name will be inserted here -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
					<button type="button" class="btn btn-danger" onclick="deleteGroup()">Delete</button>
				</div>
			</div>
		</div>
	</div>
	
    <!-- END: Content-->
	<script>
		let groupIdToDelete = null;
		let groupNameToDelete = '';
	
		function setDeleteId(groupId, groupName) {
			groupIdToDelete = groupId;
			groupNameToDelete = groupName;
			document.getElementById('deleteGroupName').innerHTML = 
				`Are you sure you want to delete the group <strong>${groupNameToDelete}</strong>?`;
		}
	
		function deleteGroup() {
			if (groupIdToDelete) {
				// Find the form by ID and submit it
				const form = document.getElementById('deleteForm-' + groupIdToDelete);
				if (form) {
					form.submit();
				}
			} else {
				alert('No group selected for deletion.');
			}
		}
	</script>
    <!-- END: Content-->
    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
		<div class="modal-dialog sidebar-sm">
			<form class="add-new-record modal-content pt-0"> 
				<div class="modal-header mb-1">
					<h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
				</div>
				<div class="modal-body flex-grow-1">
                    <div class="mb-1">
						<label class="form-label">program Code</label>
						<select class="form-select select2">
							<option>Select</option> 
						</select>
					</div>
					
					<div class="mb-1">
						<label class="form-label">program Name</label>
						<select class="form-select select2">
							<option>Select</option> 
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
    @endsection
   