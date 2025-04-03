@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
	
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
								<h2 class="content-header-title float-start mb-0 border-0">Registration</h2> 
							</div>
						</div>
					</div>
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button>
                            <button onClick="javascript: history.go(-1)" class="btn btn-danger btn-sm mb-50 mb-sm-0"><i data-feather="x-circle"></i> Reject</button> 
							<button onClick="javascript: history.go(-1)" class="btn btn-success btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Approve</button> 
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
                                                    <div class="newheader  border-bottom mb-2 pb-25"> 
														<h4 class="card-title text-theme">Basic Information</h4>
														<p class="card-text">Fill the details</p> 
													</div>
                                                </div>
                                                
                                                
                                                <div class="col-md-8"> 

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Series <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5">  
                                                            <select class="form-select">
                                                                <option>Select</option> 
                                                                <option>Badminton</option> 
                                                            </select>
                                                        </div>
                                                     </div>

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Temporary ID<span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="text" class="form-control">
                                                        </div> 
                                                     </div>  

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Reg. Date <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="date" class="form-control">
                                                        </div> 
                                                     </div>
                                                    
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Sport Name <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <select class="form-select">
                                                                <option>Select</option>
                                                                <option>Badminton</option>
                                                            </select>
                                                        </div> 
                                                     </div>

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="text" class="form-control">
                                                        </div> 
                                                     </div>
                                                
                                                     <div class="row align-items-center mb-1"> 
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Gender <span class="text-danger">*</span></label>  
                                                        </div> 

                                                        <div class="col-md-5"> 
                                                            <div class="demo-inline-spacing">
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="radio" id="customColorRadio1" name="goodsservice" class="form-check-input" checked="">
                                                                    <label class="form-check-label fw-bolder" for="customColorRadio1">Male</label>
                                                                </div> 
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="radio" id="service" name="goodsservice" class="form-check-input">
                                                                    <label class="form-check-label fw-bolder" for="service">Female</label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Quota <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <select class="form-select">
                                                                <option>Select</option>
                                                                <option>All India Ranking Top 4</option>
                                                                <option>National Championships: Gold Medal</option>
                                                                <option>National Championships: Silver Medal</option>
                                                                <option>National Championships: Bronze Medal</option>
                                                                <option>State Championships: Gold Medal</option>
                                                                <option>State Championships: Silver Medal</option>
                                                                <option>State Championships: Bronze Medal</option>
                                                            </select>
                                                        </div> 
                                                     </div>
                                                    
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Date of Birth <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="date" class="form-control">
                                                        </div> 
                                                     </div>
                                                    
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Date of Joining <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="date" class="form-control">
                                                        </div> 
                                                     </div>


                                            </div> 
                                                
                                                <div class="col-md-4 border-start">
                                                    <div class="appli-photobox"> 
                                                        <p>Photo Size<br/>25mm X 35mm</p>
                                                        <!--<img src="img/user.png" />-->
                                                    </div>
                                                    
                                                    <div class="mt-2 text-center">
                                                        <div class="image-uploadhide">
                                                            <a href="attribute.html" class="btn btn-outline-primary btn-sm waves-effect"> <i data-feather="upload"></i> Upload Profile Image</a>
                                                            <input type="file" class="">
                                                        </div>

                                                    </div>
                                                    
                                                    
                                                    <div class="row align-items-center mb-2 mt-4 justify-content-center text-center">
                                                        <div class="col-md-12"> 
                                                            <label class="form-label text-primary"><strong>Status</strong></label>   
                                                             <div class="demo-inline-spacing justify-content-center">
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="radio" id="customColorRadio3" name="customColorRadio3" class="form-check-input" checked="">
                                                                    <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                                </div> 
                                                                <div class="form-check form-check-primary mt-25 me-0">
                                                                    <input type="radio" id="customColorRadio4" name="customColorRadio3" class="form-check-input">
                                                                    <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                                </div> 
                                                            </div> 
                                                        </div> 
                                                     </div> 
                                                    
                                                       
                                                    
                                                    
                                                </div>
                                                
 
											</div>
											  
 
											 
											
											
											<div class="mt-1">
                                                <div class="step-custhomapp bg-light">
                                                    <ul class="nav nav-tabs my-25 custapploannav" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab" href="#other">Other Details</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Medical">Exp. & Medical</a>
                                                        </li>
                                                         <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Hostel">Hostel</a>
                                                        </li> 
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Family">Family Details</a>
                                                        </li> 
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Address">Address</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Emergency">Emergency Detail</a>
                                                        </li>
                                                        
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Sponsor">Sponsor</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Fee">Fee</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#document">Document</a>
                                                        </li>
                                                       
                                                    </ul>
                                                </div>
												 <div class="tab-content pb-1 px-1">
														<div class="tab-pane active" id="other"> 

                                                                 
                                                                <div class="row mb-1 align-items-center">
                                                                    <div class="col-md-2"> 
                                                                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>  
                                                                    </div>  

                                                                    <div class="col-md-3"> 
                                                                        <div class="input-group input-group-merge">
                                                                            <span class="input-group-text" id="basic-addon5"><i data-feather='phone'></i></span>
                                                                            <input type="text" class="form-control">
                                                                        </div> 
                                                                    </div> 
                                                                 </div>
                                                            
                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-2"> 
                                                                        <label class="form-label">Email <span class="text-danger">*</span></label>  
                                                                    </div>  

                                                                    <div class="col-md-3"> 
                                                                        <div class="input-group input-group-merge">
                                                                            <span class="input-group-text" id="basic-addon5"><i data-feather='mail'></i></span>
                                                                            <input type="text" class="form-control" value="hello@student.com" placeholder="">
                                                                        </div>
                                                                    </div> 
                                                                 </div> 
                                                            
                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-2"> 
                                                                        <label class="form-label">Batch <span class="text-danger">*</span></label>  
                                                                    </div>  

                                                                     <div class="col-md-3"> 
                                                                        <select class="form-select">
                                                                            <option>Select</option>  
                                                                        </select> 
                                                                    </div> 
                                                                 </div>
                                                            
                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-2"> 
                                                                        <label class="form-label">BAI ID <span class="text-danger">*</span></label>
                                                                    </div>  

                                                                    <div class="col-md-3 mb-sm-0 mb-1"> 
                                                                        <input type="text" class="form-control"  />
                                                                    </div>
                                                                    
                                                                    <div class="col-md-1 mb-sm-0 mb-1"> 
                                                                        <label class="form-label">State <span class="text-danger">*</span></label> 
                                                                    </div>  

                                                                     <div class="col-md-2"> 
                                                                        <input type="text" class="form-control"  /> 
                                                                    </div> 
                                                                    
                                                                 </div>
                                                                
                                                                
                                                            
                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-2"> 
                                                                        <label class="form-label">BWF ID <span class="text-danger">*</span></label>  
                                                                    </div>  

                                                                     <div class="col-md-3"> 
                                                                        <input type="text" class="form-control"  /> 
                                                                    </div> 
                                                                 </div>
                                                            
                                                                 
														</div>
														 <div class="tab-pane" id="Address">
                                                                <div class="row">
                                                                     <div class="col-md-6">
                                                                         
                                                                         <h5 class="mt-1 mb-4 text-dark"><strong>Permanent Address</strong></h5> 
                                                                          
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Address</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <textarea class="form-control" placeholder="Street 1"></textarea>
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                &nbsp;
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <textarea class="form-control" placeholder="Street 2"></textarea>
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Town</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">District</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                </select> 
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">State</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                </select> 
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Country</label>  
                                                                            </div>  

                                                                             <div class="col-md-6"> 
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                </select> 
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Pin Code</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>  
                                                                         
                                                                    
                                                                     </div>
                                                                    
                                                                    <div class="col-md-6">
                                                                         
                                                                        <div class="mt-1 mb-2 d-flex flex-column">
                                                                            <h5 class="text-dark mb-0 me-1"><strong>Correspondance Address</strong></h5> 
                                                                        
                                                                            <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                                <input type="checkbox" class="form-check-input" id="colorCheck2" checked="">
                                                                                <label class="form-check-label" for="colorCheck2">Same As Permanent Address</label>
                                                                            </div>
                                                                        </div>
                                                                         
                                                                         
                                                                        
                                                                          
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Address</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <textarea class="form-control" placeholder="Street 1"></textarea>
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                &nbsp;
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <textarea class="form-control" placeholder="Street 2"></textarea>
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Town</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">District</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                </select> 
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">State</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                </select> 
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Country</label>  
                                                                            </div>  

                                                                             <div class="col-md-6"> 
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                </select> 
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Pin Code</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>  
                                                                         
                                                                    
                                                                     </div>
                                                                 </div> 
														</div> 
                                                         <div class="tab-pane" id="Family">
															 <div class="table-responsive"> 
                                                                        <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border"> 
                                                                            <thead>
                                                                                 <tr>
                                                                                    <th>#</th>
                                                                                    <th>Relation</th>
                                                                                    <th>Name</th>
                                                                                    <th>Contact No</th>
                                                                                    <th>Email</th> 
                                                                                    <th>Guradian</th>  
                                                                                    <th>Action</th>
                                                                                  </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                     <tr>
                                                                                        <td>#</td>
                                                                                        <td>
                                                                                           <select class="form-select mw-100">
                                                                                               <option>Select</option> 
                                                                                               <option>Father</option>
                                                                                               <option>Mother</option>
                                                                                               <option>Grandfather</option>
                                                                                               <option>Grandmother</option>
                                                                                               <option>Uncle</option>
                                                                                               <option>Aunt</option>
                                                                                               <option>Sibling</option>
                                                                                               <option>Other</option>
                                                                                           </select> 
                                                                                        </td>
                                                                                        <td><input type="text"class="form-control mw-100"></td> 
                                                                                        <td><input type="text"class="form-control mw-100"></td> 
                                                                                        <td><input type="text"class="form-control mw-100"></td>  
                                                                                        <td>
                                                                                            <div class="demo-inline-spacing">
                                                                                                <div class="form-check form-check-primary mt-25">
                                                                                                    <input type="radio" id="guardian1" name="guardian" value="" class="form-check-input"> 
                                                                                                </div> 
                                                                                            </div>
                                                                                        </td>
                                                                                         <td> 
                                                                                            <a href="#" class="text-primary add-contact-row"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                        </td>
                                                                                      </tr>
                                                                                    
                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td>Father</td>
                                                                                        <td>Shiv prasad Singh</td> 
                                                                                        <td>9876567898</td> 
                                                                                        <td>shiv@gmail.com</td>
                                                                                        <td>No</td> 
                                                                                        <td><a href="#" class="text-danger"><i data-feather="trash-2" class="me-50"></i></a></td>
                                                                                      </tr>


                                                                               </tbody>


                                                                        </table>
                                                                    </div>
                                                            
                                                            <a href="#" class="text-primary add-contactpeontxt"><i data-feather='plus'></i> Add New</a>
														</div>
                                                      
														<div class="tab-pane" id="Emergency">
															  <div class="row">
                                                                     <div class="col-md-6">
                                                                         
                                                                         <h5 class="mt-1 mb-2 text-dark"><strong>Emergency 1 Details</strong></h5>
                                                                          
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Name <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>  
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Phone No. <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Email Id <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                              
                                                                     </div>
                                                                    
                                                                    <div class="col-md-6">
                                                                         
                                                                       <h5 class="mt-1 mb-2 text-dark"><strong>Emergency 2 Details</strong></h5>
                                                                          
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Name <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>  
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Phone No. <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Email Id <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                    
                                                                     </div>
                                                                 </div>
                                                            
                                                            
														</div>
                                                     
                                                        <div class="tab-pane" id="Medical">
															  <div class="row">
                                                                     <div class="col-md-6">
                                                                         
                                                                         <h5 class="mt-1 mb-2 text-dark"><strong>Badminton Exp.</strong></h5>
                                                                          
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">No. of yr. Exp.</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>  
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Previous Coach/Training Academy</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Highest Achievemnet</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Level of Play</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                    <option>Beginner</option>
                                                                                    <option>Intermediate</option>
                                                                                    <option>Advanced</option>
                                                                                </select>
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                              
                                                                     </div>
                                                                    
                                                                    <div class="col-md-6">
                                                                         
                                                                       <h5 class="mt-1 mb-2 text-dark"><strong>Medical Information</strong></h5>
                                                                          
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Any Medical Conditions/Allergies</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>  
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Current Medications</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Dietary Restructions</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                        
                                                                        <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Blood Group</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                    
                                                                     </div>
                                                                 </div>
                                                            
                                                            
														</div>
                                                     
                                                        <div class="tab-pane" id="Sponsor">
															  <div class="row">
                                                                     <div class="col-md-6">
                                                                         
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Sponsored Name <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>  
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Sponsored Phone No. <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Sponsored Email Id <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Sponsored Email Position <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                              
                                                                     </div>
                                                                    
                                                                     
                                                                 </div> 
														</div>
														   
														   
														<div class="tab-pane" id="Fee">
                                                             <div class="table-responsive"> 
                                                                        <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border"> 
                                                                            <thead>
                                                                                 <tr>
                                                                                    <th>#</th>
                                                                                    <th>Fee Title</th>
                                                                                    <th>Total Fees</th>
                                                                                    <th>Fee Sponsor<br/> %</th>
                                                                                    <th>Fee Sponsor<br/> Value</th>
                                                                                    <th>Fee Discount<br/> %</th> 
                                                                                    <th>Fee Discount<br/> Value</th>  
                                                                                    <th>Fee Sponsorship<br/>+ Discount %</th>  
                                                                                    <th>Fee Sponsorship<br/> + Discount Value</th>  
                                                                                    <th>Net Fee<br/> Payable %</th>  
                                                                                    <th>Net Fee<br/> Payable Value</th>  
                                                                                    <th width="150px">Action</th>
                                                                                  </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                     <tr>
                                                                                        <td>1</td>
                                                                                        <td>Training</td>
                                                                                        <td>11000</td>
                                                                                        <td>10%</td> 
                                                                                        <td>3000</td> 
                                                                                        <td><input type="text" class="form-control mw-100" value="10%" /></td>
                                                                                        <td>1000</td> 
                                                                                        <td>20%</td> 
                                                                                        <td>4000</td> 
                                                                                        <td>80%</td> 
                                                                                        <td>10000</td> 
                                                                                        <td><a href="#sponsor" data-bs-toggle="modal"><span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>2</td>
                                                                                        <td>Hostel</td>
                                                                                        <td>11000</td>
                                                                                        <td>10%</td> 
                                                                                        <td>3000</td> 
                                                                                        <td><input type="text" class="form-control mw-100" value="10%" /></td>
                                                                                        <td>1000</td> 
                                                                                        <td>20%</td> 
                                                                                        <td>4000</td> 
                                                                                        <td>80%</td> 
                                                                                        <td>10000</td> 
                                                                                        <td><a href="#sponsor" data-bs-toggle="modal"><span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>3</td>
                                                                                        <td>Mess</td>
                                                                                        <td>11000</td>
                                                                                        <td>10%</td> 
                                                                                        <td>3000</td> 
                                                                                        <td><input type="text" class="form-control mw-100" value="10%" /></td>
                                                                                        <td>1000</td> 
                                                                                        <td>20%</td> 
                                                                                        <td>4000</td> 
                                                                                        <td>80%</td> 
                                                                                        <td>10000</td> 
                                                                                        <td><a href="#sponsor" data-bs-toggle="modal"><span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>4</td>
                                                                                        <td>Security Deposit</td>
                                                                                        <td>11000</td>
                                                                                        <td>10%</td> 
                                                                                        <td>3000</td> 
                                                                                        <td><input type="text" class="form-control mw-100" value="10%" /></td>
                                                                                        <td>1000</td> 
                                                                                        <td>20%</td> 
                                                                                        <td>4000</td> 
                                                                                        <td>80%</td> 
                                                                                        <td>10000</td> 
                                                                                        <td><a href="#sponsor" data-bs-toggle="modal"><span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>5</td>
                                                                                        <td>Khelo India</td>
                                                                                        <td>11000</td>
                                                                                        <td>10%</td> 
                                                                                        <td>3000</td> 
                                                                                        <td><input type="text" class="form-control mw-100" value="10%" /></td>
                                                                                        <td>1000</td> 
                                                                                        <td>20%</td> 
                                                                                        <td>4000</td> 
                                                                                        <td>80%</td> 
                                                                                        <td>10000</td> 
                                                                                        <td>
                                                                                            <a href="#sponsor" data-bs-toggle="modal"><span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span></a>
                                                                                            <a href="#" class="text-danger ms-25"><i data-feather="trash-2" class="me-50"></i></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    
                                                                                     <tr>
                                                                                        <td>#</td>
                                                                                        <td>
                                                                                           <select class="form-select mw-100">
                                                                                                <option>Select</option>
                                                                                                <option>Training</option>
                                                                                                <option>Hostel</option>s
                                                                                                <option>Mess</option>
                                                                                                <option>Security Deposit</option>
                                                                                                <option>Khelo India</option>
                                                                                                <option>Khel Nursery</option>
                                                                                                <option>Psychology</option>
                                                                                                <option>Sport Science</option>
                                                                                                <option>Laundry</option>
                                                                                                <option>ID Card</option>
                                                                                                <option>Registration Fee</option>
                                                                                                <option>Nutrition</option>
                                                                                                <option>Physio</option>
                                                                                            </select> 
                                                                                        </td>
                                                                                        <td>-</td>
                                                                                        <td>-</td> 
                                                                                        <td>-</td> 
                                                                                        <td>-</td>
                                                                                        <td>-</td> 
                                                                                        <td>-</td> 
                                                                                        <td>-</td> 
                                                                                        <td>-</td> 
                                                                                        <td>-</td>
                                                                                         <td> 
                                                                                            <a href="#" class="text-primary add-contact-row"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                        </td>
                                                                                      </tr>
                                                                                    
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td colspan="9" class="text-end fw-bolder text-dark font-large-1">Total Fees</td> 
                                                                                        <td class="fw-bolder text-dark font-large-1">100000</td>
                                                                                         <td></td>
                                                                                      </tr>
                                                                                    
                                                                                    
                                                                               </tbody>


                                                                        </table>
                                                                    </div>
                                                             
                                                            
														</div>  
                                                     
                                                     
                                                        <div class="tab-pane" id="Hostel">
															  <div class="row">
                                                                     <div class="col-md-6">
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Hostel Required</label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                                                    <label class="form-check-label" for="colorCheck1">Yes/No</label>
                                                                                </div>
                                                                            </div>  
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Check-In Date <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="date" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Check-Out Date <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="date" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Room Preference <span class="text-danger"></span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                </select>
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                          
<!--
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Hostel ID <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Hostel Present <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Hostel Absent <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="text" class="form-control"  />
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         
                                                                         <div class="row mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Hostel Absence Reason <span class="text-danger">*</span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <textarea class="form-control"></textarea>
                                                                            </div> 
                                                                         </div> 
-->
                                                                         
                                                                              
                                                                     </div>
                                                                    
                                                                     
                                                                 </div>
                                                            
                                                            
														</div>
                                                     
                                                     
                                                         <div class="tab-pane" id="document">
															  <div class="row">
                                                                     <div class="col-md-6">
                                                                          
                                                                         
                                                                         <div class="row mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Identity Proof <span class="text-danger"></span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="file" class="form-control"  />
                                                                                
                                                                                <div>
                                                                                    <div class="image-uplodasection">
                                                                                        <i data-feather="file" class="fileuploadicon"></i>
                                                                                        <div class="delete-img text-danger">
                                                                                            <i data-feather="x"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="image-uplodasection">
                                                                                        <i data-feather="file" class="fileuploadicon"></i>
                                                                                        <div class="delete-img text-danger">
                                                                                            <i data-feather="x"></i>
                                                                                        </div>
                                                                                    </div> 
                                                                                </div>
                                                                                
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Aadhar Card <span class="text-danger"></span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="file" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Parent's Aadhar Card <span class="text-danger"></span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="file" class="form-control"  />
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Birth's Certificate <span class="text-danger"></span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="file" class="form-control"  />
                                                                            </div> 
                                                                         </div>
                                                                         
                                                                         <div class="row align-items-center mb-1">
                                                                            <div class="col-md-4"> 
                                                                                <label class="form-label">Medical Records <span class="text-danger"></span></label>  
                                                                            </div>  

                                                                            <div class="col-md-6"> 
                                                                                <input type="file" class="form-control"  />
                                                                            </div> 
                                                                         </div> 
                                                                           
                                                                     </div>
                                                                    
                                                                     
                                                                 </div>
                                                            
                                                            
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

  
	 
    <div class="modal fade" id="sponsor" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" style="max-width: 700px">
			<div class="modal-content">
				<div class="modal-header p-0 bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body px-sm-2 mx-50 pb-2">
					<h1 class="text-center mb-1" id="shareProjectTitle">Add Sponsor</h1>
					<p class="text-center">Enter the details below.</p>
                    
                    
                    <div class="text-end"><a href="#" class="text-primary add-contactpeontxt mt-50"><i data-feather='plus'></i> Add Sponsor</a></div>

					<div class="table-responsive-md customernewsection-form">
								<table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail"> 
									<thead>
										 <tr>
                                            <th>#</th>
											<th width="150px">Sponsor Name</th> 
											<th>Sponsor %</th>
											<th>Sponsor Value</th>
											<th>Action</th>
										  </tr>
										</thead>
										<tbody>
											 <tr>
                                                <td>1</td> 
                                                 <td><input type="text" class="form-control mw-100" /></td>
                                                 <td><input type="text" class="form-control mw-100" /></td>
                                                 <td><input type="text" class="form-control mw-100" /></td> 
                                                 <td>
                                                     <a href="#" class="text-danger"><i data-feather="trash-2"></i></a>
                                                 </td>
											</tr>
                                             
                                            <tr>
                                                 <td colspan="2"></td>
                                                 <td class="text-dark"><strong>Total</strong></td>
                                                 <td class="text-dark"><strong>1000</strong></td>
                                                 <td></td>
											</tr>
											 

									   </tbody>


								</table>
							</div>
                    
				</div>
				
				<div class="modal-footer justify-content-center">  
						<button type="reset" class="btn btn-outline-secondary me-1">Cancel</button> 
					<button type="reset" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>
    
    
    <div class="modal fade text-start" id="disclaimer" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 800px">
			<div class="modal-content">
				<div class="modal-header">
					<div>
                        <h4 class="modal-title fw-bolder text-dark namefont-sizenewmodal" id="myModalLabel17">Disclaimer</h4> 
                    </div>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					 <div> 

                        <div class="form-check mb-3 form-check-primary mt-25 custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="disclaimer3">
                            <label class="form-check-label disclaimercustapplicant" for="disclaimer3">
                                I/We, hereby declares that the information provided above is true and accurate to the best of my knowledge. I understand that any false information may lead to the rejection of myt application.
                            </label>
                        </div>


                        <div class="row align-items-center mb-1">
                            <div class="col-md-1"> 
                                <label class="form-label">Place</label>  
                            </div>  

                            <div class="col-md-3"> 
                                <input type="text" class="form-control">
                            </div> 
                         </div>

                        <div class="row align-items-center mb-1">
                            <div class="col-md-1"> 
                                <label class="form-label">Date</label>  
                            </div>  

                            <div class="col-md-3"> 
                                <input type="date" class="form-control">
                            </div> 
                         </div>

                    </div>
				</div>
				<div class="modal-footer text-end">
					<button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i data-feather="x-circle"></i> Cancel</button>
					<a href="index.html" class="btn btn-primary btn-sm"><i data-feather="check-circle"></i> Final Submit</a>
				</div>
			</div>
		</div>
	</div>
	 
@endsection