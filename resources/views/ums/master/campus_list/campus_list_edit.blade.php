@extends('ums.admin.admin-meta')

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
								<h2 class="content-header-title float-start mb-0">Campus Edit</h2>
								<div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.html">Home</a>
										</li>  
										<li class="breadcrumb-item active">Edit New Campus</li>


									</ol>
								</div>
							</div>
						</div>
					</div>
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">
                            {{-- <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i>Cancel</button>     --}}
   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i>Go Back</button>    
							<button type="submit" form="edit_campus_form" onClick="javascript: history.go(-1)" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>Update</button> 
						</div>
					</div>
				</div>
			</div>
            <form id="edit_campus_form" method="POST" action="{{route('campus_list_edit')}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="campus_id" value="{{$selected_campuse->id}}">
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
                                                            <label class="form-label">Campus Code <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="text" name="campus_code" value="{{$selected_campuse->campus_code}}" class="form-control">
                                                        </div> 
                                                    
                                                     </div> 
                                                    
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Name</label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="text" name="name" value="{{$selected_campuse->name}}" class="form-control">
                                                        </div> 
                                                   
                                                     </div>
                                                     <?php $types = ['DSMNRU CAMPUS'=>'DSMNRU CAMPUS','AFFILIATED COLLEGE'=> 'AFFILIATED COLLEGE']?>
                                                     <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Type<span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5">  
                                                            <select class="form-select" name="is_affiliated">
                                                                <option>Select</option> 
                                                                <option value="1"@if($selected_campuse->is_affiliated=='1')selected @endif>DSMNRU Campus</option> 
                                                                <option value="0"@if($selected_campuse->is_affiliated=='0')selected @endif>AFFILIATED COLLAGE</option> 
                                                            </select>
                                                        </div>
                                                     </div>

                                                     <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Short Name</label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="text" name="short_name" value="{{$selected_campuse->short_name}}" class="form-control">
                                                        </div> 
                                                   
                                                     </div>
                                                    
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-3"> 
                                                                <label class="form-label">Email <span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-5"> 
                                                                <input type="email"  name="email" value="{{$selected_campuse->email}}" class="form-control">
                                                            </div> 
                                                         </div>
                                                    
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col-md-3"> 
                                                                <label class="form-label">contact<span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-5"> 
                                                                <input type="number" name="contact" value="{{$selected_campuse->contact}}" class="form-control">
                                                            </div> 
                                                         </div>
                                                        
                                                    
                                                    
                                                         <div class="row align-items-center mb-1">
                                                            <div class="col-md-3"> 
                                                                <label class="form-label">Website<span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-5"> 
                                                                <input type="text" name="website" value="{{$selected_campuse->website}}" class="form-control">
                                                            </div> 
                                                         </div>
                                                        

                                                         <div class="row align-items-center mb-1">
                                                            <div class="col-md-3"> 
                                                                <label class="form-label">address<span class="text-danger">*</span></label>  
                                                            </div>  

                                                            <div class="col-md-5"> 
                                                                <input type="text" name="address" value="{{$selected_campuse->address}}"  class="form-control">
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
            </form>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">Copyright &copy; 2024 <a class="ml-25" href="#" target="_blank">Presence 360</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
        
        <div class="footerplogo"><img src="../../../assets/css/p-logo.png" /></div>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
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

    @endsection
    <script>
        function submitCat(form) {
            document.getElementById('edit_campus_form').submit();
        }
        $(document).ready(function() {
        $('.numbersOnly').keyup(function() {
                this.value = this.value.replace(/[^0-9\.]/g, '');
            });
                });
    </script>