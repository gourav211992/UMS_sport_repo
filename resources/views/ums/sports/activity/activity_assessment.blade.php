@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content'); 
     

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
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>  
                                    <li class="breadcrumb-item active">Assessment List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-primary btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button> 
                    </div>
                </div>
            </div>
            <div class="content-body">
                 
                
				
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
								
								   
                                <div class="table-responsive candidates-tables">
									<table class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist "> 
                                        <thead>
                                             <tr>
												<th>#</th>
												<th>Reg. No</th>
												<th>Player Name</th>
												<th>DOJ</th>
												<th>Section</th>
												<th>Group</th>
												<th>Activity</th>
												<th>Status</th>
												<th>Action</th>
											  </tr>
											</thead>
											<tbody>
												 <tr>
													<td>1</td>
													<td class="fw-bolder text-dark">Reg001</td>
													<td>Deepak Kumar</td>
													<td>18-03-2024</td>
													<td>AB</td>
													<td>A</td>
													<td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">15</span></td>
													<td><span class="badge rounded-pill badge-light-success badgeborder-radius">Done</span></td> 
													<td class="tableactionnew">
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{url('view-mark-access')}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail</span>
																</a>
                                                                <a class="dropdown-item" href="{{url('mark-assess')}}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
															</div>
														</div>
													</td>
												  </tr>
												  
												 
												   
												   
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
<!--                        <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />-->
						  <input type="text" id="fp-range" class="form-control flatpickr-range bg-white" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
					</div>
                    
                    <div class="mb-1">
						<label class="form-label">Admission Yr.</label>
						<select class="form-select select2">
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
						<label class="form-label">Section</label>
						<select class="form-select">
							<option>Select</option>
						</select>
					</div>
                    
                    <div class="mb-1">
						<label class="form-label">Group</label>
						<select class="form-select">
							<option>Select</option>
						</select>
					</div>
                    
                    <div class="mb-1">
						<label class="form-label">Status</label>
						<select class="form-select select2">
							<option>Select</option> 
							<option>Done</option> 
							<option>Not Done</option> 
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