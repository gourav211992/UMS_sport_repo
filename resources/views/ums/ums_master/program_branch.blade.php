@extends('ums.admin.admin-meta')
@section('content')

<div class="app-content content ">
	@include('ums.admin.notifications')
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Programe Branch</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('program_branch') }}">Home</a></li>  
                                    <li class="breadcrumb-item active">Programe Branch Master List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        {{-- <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>  --}}
						<a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{url('program_branch_add')}}"><i data-feather="plus-circle"></i> Add New</a> 
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
												<th>#</th>
												<th>Programe Type</th>
												<th>Course</th>
												<th>Prog. Branch Code</th>
												<th>Prog. Branch Name</th>
												<th>Enroll. No. Code</th>
												<th>Seq. No.</th>
												<th>Status</th>
												<th>Action</th>
											  </tr>
											</thead>
											<tbody>
												@foreach ($programBranch as $key => $branch)
												<tr>
													<td>{{ $key + 1 }}</td>
													
													{{-- Corrected program type name --}}
													<td class="fw-bolder text-dark">{{ $branch->programType->program_name ?? 'N/A' }}</td>
													
													{{-- Corrected course name --}}
													<td>{{ $branch->course->course_name ?? 'N/A' }}</td>
													
													<td>{{ $branch->program_branch_code }}</td>
													<td>{{ $branch->program_branch_name }}</td>
													<td>{{ $branch->enrollment_no }}</td>
													<td>{{ $branch->seq_no }}</td>
													<td>
														@if ($branch->status == 'Active')
															<span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span>
														@else
															<span class="badge rounded-pill badge-light-danger badgeborder-radius">{{ $branch->status }}</span>
														@endif
													</td>
													<td class="tableactionnew">
														<div class="dropdown dropup">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{ route('program_branch.view', $branch->id) }}">
																	<i data-feather="edit" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																
																<a class="dropdown-item" href="{{ route('program_branch.edit', $branch->id) }}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
																
																<form id="deleteForm-{{ $branch->id }}" action="{{ route('program_branch.destroy', $branch->id) }}" method="POST" style="display: inline;">
																	@csrf
																	@method('DELETE')
																	<button type="button" class="dropdown-item"
																		data-bs-toggle="modal"
																		data-bs-target="#deleteConfirmModal"
																		onclick="setDeleteId('{{ $branch->id }}', '{{ $branch->program_branch_name }}')">
																		<i data-feather="trash-2" class="me-50"></i>
																		<span>Delete</span>
																	</button>
																</form>
																
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

	<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Confirm Deletion</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="deleteBranchName">
					<!-- Branch name appears here -->
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button class="btn btn-danger" onclick="deleteBranch()">Delete</button>
				</div>
			</div>
		</div>
	</div>
	

	<script>
		let branchIdToDelete = null;
		let branchNameToDelete = '';
	
		function setDeleteId(branchId, branchName) {
			branchIdToDelete = branchId;
			branchNameToDelete = branchName;
			document.getElementById('deleteBranchName').innerHTML =
				`Are you sure you want to delete the branch <strong>${branchNameToDelete}</strong>?`;
		}
	
		function deleteBranch() {
			if (branchIdToDelete) {
				const form = document.getElementById('deleteForm-' + branchIdToDelete);
				if (form) {
					form.submit();
				}
			}
		}
	</script>
	
@endsection
