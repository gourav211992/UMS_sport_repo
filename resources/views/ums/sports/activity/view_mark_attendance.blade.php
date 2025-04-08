@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content'); 

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
								<h2 class="content-header-title float-start mb-0">Player Review</h2> 
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
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button>  
							<button onClick="javascript: history.go(-1)" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button> 
						</div>
					</div>
				</div>
			</div>
            <div class="content-body">
                 
                
				
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            
                            
                            <div class="card">
								 <div class="card-body customernewsection-form">  
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="newheader border-bottom mb-2 pb-25 d-flex flex-wrap justify-content-between"> 
                                                    <div>
                                                        <h4 class="card-title text-theme">Basic Information</h4>
                                                        <p class="card-text">Fill the details</p>
                                                    </div> 
                                                </div> 
                                            </div> 
											 
													 

													<div class="contract-details">
														<div class="row">
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Sports</h6>
																<p class="font-small-3">Badminton</p>
															</div>
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Date</h6>
																<p class="font-small-3">01-Apr-2025</p>
															</div>
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Start Time</h6>
																<p class="font-small-3">10:00 AM</p>
															</div>
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">End Time</h6>
																<p class="font-small-3">11:00AM</p>
															</div> 
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Batch Yr.</h6>
																<p class="font-small-3">2025-26</p>
															</div>
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Batch</h6>
																<p class="font-small-3">Intermidate</p>
															</div>
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Section</h6>
																<p class="font-small-3">A</p>
															</div>
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Group</h6>
																<p class="font-small-3">AB +</p>
															</div> 
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Trainer</h6>
																<p class="font-small-3">Aniket Singh</p>
															</div>
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Activity</h6>
																<p class="font-small-3">GYM</p>
															</div>
															
															<div class="col-md-3 mb-75 col-6">
																<h6 class="fw-bolder text-dark mb-25">Sub-Activity</h6>
																<p class="font-small-3">Biceps, Shoulder, Legs</p>
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
                                                            <div class="newheader "> 
                                                                <h4 class="card-title text-theme">Batch Students</h4>
                                                                <p class="card-text">View the details</p>
                                                            </div>
                                                        </div>
                                                         
                                                    </div> 
                                             </div>
											 
											 
											  
  
											
											<div class="row"> 
                                                
                                                 <div class="col-md-12">
                                                     
                                                     
                                                     <div class="table-responsive pomrnheadtffotsticky">
                                                         <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad"> 
                                                            <thead>
                                                                 <tr>
                                                                   <th width="30px">#</th>
                                                                    <th>Reg. No</th>
                                                                    <th>Player Name</th>
                                                                    <th>DOJ</th>
                                                                    <th>
                                                                        <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                            <input type="checkbox" class="form-check-input mt-0" id="Present" readonly>
                                                                            <label class="form-check-label" for="Present">Present (Y/N)</label>
                                                                        </div>
                                                                     </th>
                                                                    <th>Absence Reason</th>
                                                                    <th>Activity Comment</th>
                                                                    <th>Rating</th>
                                                                    <th>Activity Color Code</th>
                                                                    <th>Remarks</th>
                                                                 </tr>
                                                                </thead>
                                                                <tbody class="">
                                                                     <tr>
                                                                        <td class="poprod-decpt">1</td>
                                                                        <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                        <td class="poprod-decpt">Deewan Singh</td>
                                                                        <td class="poprod-decpt">01-01-2025</td>
                                                                        <td>
                                                                            <div class="form-check form-check-primary custom-checkbox">
                                                                                <input class="form-check-input" type="checkbox" id="Present1"  checked readonly >
																				<label class="form-check-label" for="Present1">Auto</label>
                                                                            </div>
                                                                        </td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>Tournament</option>
                                                                          <option>Rest</option>
                                                                          <option>Injury</option>
                                                                          <option>Sickness</option>
                                                                          <option>Weekly Holiday</option>
                                                                          <option>Sanctioned Leave</option>
                                                                          <option>Unauthorised Leave</option>
                                                                        </select></td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>Tournament</option>
                                                                          <option>Rest</option>
                                                                          <option>Injury</option>
                                                                          <option>Sickness</option>
                                                                          <option>Weekly Holiday</option>
                                                                          <option>Sanctioned Leave</option>
                                                                          <option>Unauthorised Leave</option>
                                                                        </select></td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>5</option>
                                                                          <option>4</option>
                                                                          <option>3</option>
                                                                          <option>2</option>
                                                                          <option>1</option>
                                                                        </select></td>
                                                                        <td><span class="badge bg-success badgeborder-radius p-25">&nbsp;</span></td>
                                                                        <td><input type="text" class="form-control mw-100"  readonly/></td>
                                                                      </tr>                                                                                                                                 
                                                                                  
                                                             </tbody> 

                                                        </table>
                                                    </div>
                                                      
                                                       
                                                    
												</div> 
                                                 
                                             </div> 
								</div>
                            </div>
                            
                            
                            
                             
                            
                            
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                     
                </section>
                 

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @endsection