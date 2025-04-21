@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content');
    {{-- <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow erpnewsidemenu" data-scroll-to-active="true">
        
        <div class="shadow-bottom"></div>
        <div class="main-menu-content newmodulleftmenu">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
<!--
                <li class="nav-ite"><a class="d-flex align-items-center" href="#"><i data-feather="home"></i><span class="menu-title text-truncate">Dashboard</span></a> 
                </li>  
-->
                <li class="nav-item"><a class="d-flex align-items-center" href="sport-master.html"><i data-feather="grid"></i><span class="menu-title text-truncate">Sports Master</span></a>
                </li>
                
                <li class="nav-item"><a class="d-flex align-items-center" href="fee-schedule.html"><i data-feather="file-text"></i><span class="menu-title text-truncate">Fee Master</span></a>
                </li>
                
                <li class="nav-item"><a class="d-flex align-items-center" href="students.html"><i data-feather="users"></i><span class="menu-title text-truncate">Student</span></a>
                </li> 
                
                <li class="nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="activity"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Activity</span></a>
                    <ul class="menu-content"> 
                        <li><a class="d-flex align-items-center" href="activity-master.html"><i data-feather="circle"></i><span class="menu-item text-truncate">Master</span></a></li>
                        <li><a class="d-flex align-items-center" href="activity-scheduler.html"><i data-feather="circle"></i><span class="menu-item text-truncate">Scheduler</span></a></li>
                        <li><a class="d-flex align-items-center" href="activity-attendance.html"><i data-feather="circle"></i><span class="menu-item text-truncate">Player Review</span></a></li>
						<li><a class="d-flex align-items-center" href="activity-assessment.html"><i data-feather="circle"></i><span class="menu-item text-truncate">Assessment</span></a></li>
                    </ul>
                </li> 
                
                 
            </ul>
        </div>
		
    </div> --}}
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
                            <h2 class="content-header-title float-start mb-0">Activity Scheduler</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>  
                                    <li class="breadcrumb-item active">Scheduler List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button> 
						<a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{url('activity-scheduler-add')}}"><i data-feather="plus-circle"></i> Add New</a> 
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
												<th>Activity</th>
												<th>Scheduler No.</th>
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
												 <tr>
													<td>1</td>
													<td class="fw-bolder text-dark">GYM</td>
													<td>1</td>
													<td>Aniket Singh</td>
													<td>27-02-2025</td>
													<td> 10:00 AM</td>
													<td>27-02-2025</td>
													<td> 10:00 AM</td>
													<td>AB</td>
													<td>10</td>
													<td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
													<td><span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span></td> 
													<td class="tableactionnew">
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{url('activity-scheduler-view')}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																<a class="dropdown-item" href="{{url('activity-scheduler-edit')}}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
																<a class="dropdown-item" href="#">
																	<i data-feather="trash-2" class="me-50"></i>
																	<span>Delete</span>
																</a> 
															</div>
														</div>
													</td>
												  </tr>
												  <tr>
													<td>2</td>
													<td class="fw-bolder text-dark">Yoga</td>
													<td>2</td>
													<td>Aniket Singh</td>
													<td>27-02-2025</td>
													<td> 10:00 AM</td>
													<td>27-02-2025</td>
													<td> 10:00 AM</td>
													<td>AB</td>
													<td>10</td>
													<td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
													<td><span class="badge rounded-pill badge-light-danger badgeborder-radius">Inactive</span></td>
													<td class="tableactionnew">
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{url('activity-scheduler-view')}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																<a class="dropdown-item" href="">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
																<a class="dropdown-item" href="#">
																	<i data-feather="trash-2" class="me-50"></i>
																	<span>Delete</span>
																</a> 
															</div>
														</div>
													</td>
												  </tr>
												  <tr>
													<td>3</td>
													<td class="fw-bolder text-dark">Zumba</td>
													<td>3</td>
													<td>Aniket Singh</td>
													<td>27-02-2025</td>
													<td>10:00 AM</td>
													<td>27-02-2025</td>
													<td>10:00 AM</td>
													<td>AB</td>
													<td>10</td>
													<td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
													<td><span class="badge rounded-pill badge-light-danger badgeborder-radius">Inactive</span></td>
													<td class="tableactionnew">
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{url('activity-scheduler-view')}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																<a class="dropdown-item" href="{{url('activity-scheduler-edit')}}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
																<a class="dropdown-item" href="#">
																	<i data-feather="trash-2" class="me-50"></i>
																	<span>Delete</span>
																</a> 
															</div>
														</div>
													</td>
												  </tr>
												  <tr>
													<td>4</td>
													<td class="fw-bolder text-dark">Dance</td>
													<td>4</td>
													<td>Aniket Singh</td>
													<td>27-02-2025</td>
													<td> 10:00 AM</td>
													<td>27-02-2025</td>
													<td> 10:00 AM</td>
													<td>AB</td>
													<td>10</td>
													<td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
													<td><span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span></td>
													<td class="tableactionnew">
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{url('activity-scheduler-view')}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																<a class="dropdown-item" href="{{url('activity-scheduler-edit')}}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
																<a class="dropdown-item" href="#">
																	<i data-feather="trash-2" class="me-50"></i>
																	<span>Delete</span>
																</a> 
															</div>
														</div>
													</td>
												  </tr>
												  <tr>
													<td>5</td>
													<td class="fw-bolder text-dark">High Intensity</td>
													<td>5</td>
													<td>Aniket Singh</td>
													<td>27-02-2025</td>
													<td>10:00 AM</td>
													<td>27-02-2025</td>
													<td>10:00 AM</td>
													<td>AB</td>
													<td>10</td>
													<td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
													<td><span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span></td>
													<td class="tableactionnew">
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{url('activity-scheduler-view')}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																<a class="dropdown-item" href="{{url('activity-scheduler-edit')}}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
																<a class="dropdown-item" href="#">
																	<i data-feather="trash-2" class="me-50"></i>
																	<span>Delete</span>
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


@endsection