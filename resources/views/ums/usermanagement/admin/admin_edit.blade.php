@extends('ums.admin.admin-meta')

@section('content')
{{-- {{dd($selected_user)}}` --}}
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
								<h2 class="content-header-title float-start mb-0"> User Edit</h2>
								<div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.html">Home</a>
										</li>  
										<li class="breadcrumb-item active">New Edit</li>


									</ol>
								</div>
							</div>
						</div>
					</div>
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                        <form action="/user/edit-user-form" method="POST" id="edit_user_form">
                            @csrf
						<div class="form-group breadcrumb-right">   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i>Go Back</button>    
							<button  onclick="submitCat();" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>Update</button> 
						</div>
					</div>
				</div>
			</div>
            <div class="content-body">
                 
                @include('ums.admin.notifications')
                 
                
				
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
                                                      
                                                    <input type="hidden" name="user_id" value="{{$selected_user->id}}">
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">User Name <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="text" class="form-control" name="name" value="{{$selected_user->name}}">
                                                        </div> 
                                                    
                                                     </div> 
                                                    
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">User Email</label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="email" class="form-control" name="email" readonly value="{{$selected_user->email}}">
                                                        </div> 
                                                   
                                                     </div>
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Mobile</label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="number" class="form-control" name="mobile" value="{{$selected_user->mobile}}">
                                                        </div> 
                                                   
                                                     </div>

                  
                                                    
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-3"> 
                                                                <label class="form-label">Role* <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-5"> 
                                                                <input type="text" class="form-control" name="role" value="{{$selected_user->role}}">
                                                            </div> 
                                                         </div>
                                                    
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-3"> 
                                                                <label class="form-label">Date of Birth <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-5"> 
                                                                <input type="date" class="form-control" name="user_dob" value="{{$selected_user->date_of_birth}}">
                                                            </div> 
                                                         </div>
                                                        
                                                    
                                                    
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Gender<span class="text-danger">*</span></label>  
                                                        </div>  
                                                        <div class="col-md-5">
                                                            <select class="form-select" name="gender">
                                                                <option value="male" <?php echo ($selected_user->gender == 'male') ? 'selected' : ''; ?>>Male</option>
                                                                <option value="female" <?php echo ($selected_user->gender == 'female') ? 'selected' : ''; ?>>Female</option>
                                                                <option value="other" <?php echo ($selected_user->gender == 'other') ? 'selected' : ''; ?>>Other</option>
                                                            </select>
                                                        </div>
                                                        
                                                     </div>
                                                    
                                                     <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Marital Status<span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5">
                                                            <select class="form-select" name="marital">
                                                                <option value="Married" <?php echo ($selected_user->marital_status == 'Married') ? 'selected' : ''; ?>>Married</option>
                                                                <option value="Unmarried" <?php echo ($selected_user->marital_status == 'Unmarried') ? 'selected' : ''; ?>>Unmarried</option>
                                                                <option value="other" <?php echo ($selected_user->marital_status == 'other') ? 'selected' : ''; ?>>Other</option>
                                                            </select>
                                                        </div>
                                                        
                                                     </div>

                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Status</label> 
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <div class="demo-inline-spacing">
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="radio" id="customColorRadio3" name="user_status" class="form-check-input" checked="" value="Active">
                                                                    <label class="form-check-label fw-bolder" for="">Open</label>
                                                                </div> 
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="radio" id="customColorRadio4" name="user_status" class="form-check-input" value="Inactive">
                                                                    <label class="form-check-label fw-bolder" for="customColorRadio4">Close</label>
                                                                </div> 
                                                            </div>  
                                                        </div> 
                                                        

                                                    </div> 

                                                  
                                                
                                                  
 
                                                  
											</div>
                                     
                                     
                                             {{-- <div class="mt-2">
                                                <div class="step-custhomapp bg-light mb-0">
                                                    <ul class="nav nav-tabs my-25 custapploannav" role="tablist"> 
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab" href="#Invoice">Invoice & Order Detail</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Assigned">Assigned Person Detail</a>
                                                        </li> 
                                                    </ul> 
                                                </div>

												 <div class="tab-content pt-2 pb-1 px-1 rounded-3 border">
                                                    <div class="tab-pane active" id="Invoice"> 
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Invoice No. <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <input type="text" class="form-control"  />
                                                            </div> 
                                                         </div>

                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Invoice Date <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <input type="date" value="2024-09-10" disabled class="form-control"  />
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <a href="#" class="btn btn-sm btn-outline-primary waves-effect">
                                                                <i data-feather="file-text"></i> View Invoice</a>
                                                            </div>
                                                         </div>
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Sales Order Number <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <input type="text" class="form-control"  />
                                                            </div> 
                                                         </div>
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Sales Order Date <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <input type="date" value="2024-09-08" disabled class="form-control"  />
                                                            </div> 
                                                         </div>
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Customer Ref. No. <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <input type="text" class="form-control"  />
                                                            </div> 
                                                         </div>
                                                    </div>
                                                     <div class="tab-pane" id="Assigned"> 
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Error Category <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <select class="form-control select2">
                                                                    <option>Select</option>
                                                                </select>
                                                            </div> 
                                                         </div>

                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Sub Category 1</label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <select class="form-control select2">
                                                                    <option>Select</option>
                                                                </select>
                                                            </div> 
                                                         </div>
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Sub Category 2</label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <select class="form-control select2">
                                                                    <option>Select</option>
                                                                </select>
                                                            </div> 
                                                         </div>
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Responsible Dept. <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <select class="form-control select2">
                                                                    <option>Select</option>
                                                                </select>
                                                            </div> 
                                                         </div>
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-2"> 
                                                                <label class="form-label">Assigned To <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-3"> 
                                                                <select class="form-control select2">
                                                                    <option>Select</option>
                                                                </select>
                                                            </div> 
                                                         </div>
                                                    </div>
                                                 </div>
											  
 
											 
											
											
											 
 
								
								</div> --}}
                                     
                                     
                                         {{-- <div class="row mt-2"> 
                                            <div class="col-md-12">
                                                 <div class="col-md-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Upload Document</label>
                                                        <input type="file" class="form-control">
                                                    </div>
                                                </div> 
                                             </div> 
                                            <div class="col-md-12">
                                                <div class="mb-1">  
                                                    <label class="form-label">Incident Description</label> 
                                                    <textarea type="text" rows="4" class="form-control" placeholder="Enter Remarks here..."></textarea> 

                                                </div>
                                            </div> 
                                        </div>  --}}
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

    <!-- BEGIN: Footer-->
 
    <!-- END: Footer-->
	
	
	  <div class="modal fade" id="attribute" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-0 bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 mx-50 pb-2">
                    <h1 class="text-center mb-1" id="shareProjectTitle">Attribute Selling Pricing</h1>
                    <p class="text-center">Enter the details below.</p>

                    <div class="table-responsive-md customernewsection-form">
                                <table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail"> 
                                    <thead>
                                         <tr>  
                                            <th>#</th>
                                            <th>Attribute Name</th>
                                            <th>Attribute Value</th>
                                            <th>Extra Selling Cost</th>
                                            <th>Actual Selling Price</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                             <tr> 
                                                <td>1</td>
                                                <td class="fw-bolder text-dark">Color</td>
                                                <td>Black</td>
                                                <td><input type="text" value="20" class="form-control mw-100" /></td> 
                                                <td><input type="text" disabled value="2000" class="form-control mw-100" /></td> 
                                            </tr>

                                            <tr>   
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>White</td>
                                                <td><input type="text" value="20" class="form-control mw-100" /></td> 
                                                <td><input type="text" disabled value="2000" class="form-control mw-100" /></td> 
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                              <td>Red</td>
                                                <td><input type="text" value="20" class="form-control mw-100" /></td> 
                                                <td><input type="text" disabled value="2000" class="form-control mw-100" /></td> 
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                              <td>Golden</td>
                                                <td><input type="text" value="20" class="form-control mw-100" /></td> 
                                                <td><input type="text" disabled value="2000" class="form-control mw-100" /></td> 
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                              <td>Silver</td>
                                                <td><input type="text" value="20" class="form-control mw-100" /></td> 
                                                <td><input type="text" disabled value="2000" class="form-control mw-100" /></td> 
                                            </tr>
                                            <tr>
                                              <td>2</td>
                                              <td class="fw-bolder text-dark">Size</td>
                                              <td>5.11 Inch</td>
                                                <td><input type="text" value="20" class="form-control mw-100" /></td> 
                                                <td><input type="text" disabled value="2000" class="form-control mw-100" /></td> 
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td> 
                                              <td>6.0 Inch</td>
                                                <td><input type="text" value="20" class="form-control mw-100" /></td> 
                                                <td><input type="text" disabled value="2000" class="form-control mw-100" /></td> 
                                            </tr>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                              <td>6.25 Inch</td>
                                                <td><input type="text" value="20" class="form-control mw-100" /></td> 
                                                <td><input type="text" disabled value="2000" class="form-control mw-100" /></td> 
                                            </tr> 
                                       </tbody>


                                </table>
                            </div>
                </div>

                <div class="modal-footer justify-content-center">  
                        <button type="reset" class="btn btn-outline-secondary me-1">Cancel</button> 
                    <button type="reset" class="btn btn-primary">Select</button>
                </div>
            </div>
        </div>
    </div>
	 
	
	 <div class="modal fade" id="reallocate" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header p-0 bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body px-sm-4 mx-50 pb-2">
					<h1 class="text-center mb-1" id="shareProjectTitle">Re-Allocate Incident</h1>
					<p class="text-center">Enter the details below.</p>

					<div class="row mt-2"> 
						
						<div class="col-md-12 mb-1">
							<label class="form-label">Re-Allocate To <span class="text-danger">*</span></label>
							<select class="form-select select2">
                                <option>Select</option>
                            </select>
						</div>
                        
                        <div class="col-md-12 mb-1">
							<label class="form-label">Re-Allocate Dept. <span class="text-danger">*</span></label>
							<select class="form-select select2">
                                <option>Select</option>
                            </select>
						</div>
                        
                        <div class="col-md-12 mb-1">
							<label class="form-label">PDC Date <span class="text-danger">*</span></label>
							<input type="date" class="form-control" placeholder="Enter Name" />
						</div>
                        
                        <div class="col-md-12 mb-1">
							<label class="form-label">Remarks <span class="text-danger">*</span></label>
							<textarea class="form-control"></textarea>
						</div>
                          
                         
				    </div>
                </div>
				
				<div class="modal-footer justify-content-center">  
						<button type="reset" class="btn btn-outline-secondary me-1">Cancel</button>
					<button type="reset" class="btn btn-primary">Re-Allocate</button>
				</div>
			</div>
		</div>
	</div>

    <!-- BEGIN: Vendor JS-->
    
    @endsection
    <script>
        $(document).ready(function(){
    
            var selected_user = {!! json_encode($selected_user) !!};
    
            if(selected_user['status'] == 'active') {
                $('#active').prop('checked', true);
                $('#inactive').prop('checked', false);
            }
            else {
                $('#active').prop('checked', false);
                $('#inactive').prop('checked', true);
            }
            $('.numbersOnly').keyup(function() {
                this.value = this.value.replace(/[^0-9\.]/g, '');
            });
            $('.alphaOnly').keyup(function() {
                this.value = this.value.replace(/[^a-z|A-Z\.]/g, '');
            });
        });
    </script>
    
    <script>
        function submitCat(form) {
            if(document.getElementById('active').checked) {
                document.getElementById('user_status').value = 'active';
            }
            else {
                document.getElementById('user_status').value = 'inactive';
            }
    
            document.getElementById('edit_user_form').submit();
        }
    </script>