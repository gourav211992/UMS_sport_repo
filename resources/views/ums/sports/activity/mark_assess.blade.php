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
								<h2 class="content-header-title float-start mb-0">Assessment</h2> 
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


                                            <div class="col-md-8"> 
													 
                                                
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Player Name <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="text" class="form-control" value="Aniket Singh" disabled />
                                                        </div> 
                                                     </div>
                                                
                                                     <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Activity <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <select class="form-select select2">
                                                                <option>Select</option>
                                                            </select>
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
                                                                <h4 class="card-title text-theme">Assessment Details</h4>
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
                                                                   <th width="30">#</th>
                                                                    <th>Parameter</th>
                                                                    <th>Response</th>
                                                                    <th> Remarks</th>
                                                                    <th>Rating</th>
                                                                 </tr>
                                                                </thead>
                                                                <tbody class="">
                                                                     <tr>
                                                                        <td class="poprod-decpt">1</td>
                                                                        <td class="poprod-decpt"><strong>Random</strong></td>
                                                                        <td>
																			<input type="text" class="form-control mw-100" placeholder="Enter Response" />
																		</td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Comments" /></td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>5</option>
                                                                          <option>4</option>
                                                                          <option>3</option>
                                                                          <option>2</option>
                                                                          <option>1</option>
                                                                        </select></td>
                                                                      </tr>
                                                                      
                                                                    
                                                                     <tr>
                                                                        <td class="poprod-decpt">2</td>
                                                                        <td class="poprod-decpt"><strong>Right Diagonal</strong></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Response" /></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Comments" /></td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>5</option>
                                                                          <option>4</option>
                                                                          <option>3</option>
                                                                          <option>2</option>
                                                                          <option>1</option>
                                                                        </select></td>
                                                                      </tr>
                                                                    
                                                                    <tr>
                                                                        <td class="poprod-decpt">3</td>
                                                                        <td class="poprod-decpt"><strong>Left Diagonal</strong></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Response" /></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Comments" /></td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>5</option>
                                                                          <option>4</option>
                                                                          <option>3</option>
                                                                          <option>2</option>
                                                                          <option>1</option>
                                                                        </select></td>
                                                                      </tr>
                                                                    
                                                                    <tr>
                                                                        <td class="poprod-decpt">4</td>
                                                                        <td class="poprod-decpt">Power Multi</td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Response" /></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Comments" /></td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>5</option>
                                                                          <option>4</option>
                                                                          <option>3</option>
                                                                          <option>2</option>
                                                                          <option>1</option>
                                                                        </select></td>
                                                                      </tr>
                                                                    
                                                                    <tr>
                                                                        <td class="poprod-decpt">5</td>
                                                                        <td class="poprod-decpt"><strong>Defence Multi</strong></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Response" /></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Comments" /></td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>5</option>
                                                                          <option>4</option>
                                                                          <option>3</option>
                                                                          <option>2</option>
                                                                          <option>1</option>
                                                                        </select></td>
                                                                      </tr>
                                                                    
                                                                    <tr>
                                                                        <td class="poprod-decpt">6</td>
                                                                        <td class="poprod-decpt"><strong>Sequence</strong></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Response" /></td>
                                                                        <td><input type="text" class="form-control mw-100" placeholder="Enter Comments" /></td>
                                                                        <td><select class="form-select mw-100">
                                                                          <option>Select</option>
                                                                          <option>5</option>
                                                                          <option>4</option>
                                                                          <option>3</option>
                                                                          <option>2</option>
                                                                          <option>1</option>
                                                                        </select></td>
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

  @endsection