@extends("ums.admin.admin-meta")
@section("content")


     

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
								<h2 class="content-header-title float-start mb-0">Edit Internal Mapping</h2>
								<div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.html">Home</a>
										</li>  
										<!-- <li class="breadcrumb-item active">Add New</li> -->


									</ol>
								</div>
							</div>
						</div>
					</div>
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">   
            <a href="{{ url('faculty_mapping') }}" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
    <i data-feather="arrow-left-circle"></i> Go Back
</a>
							<button  class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>Reset</button> 
							<button form="add-form" class="btn btn-warning btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>submit</button> 
						</div>
					</div>
				</div>
			</div>
            <div class="content-body">
            <form id="add-form" method="POST" action="{{url('internal_mapping_add')}}">
            @csrf
				
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">  
							
                            <div class="card">
								 <div class="card-body customernewsection-form"> 
											 
											<div class="row">
												<div class="col-md-12">
                                                    <div class="newheader border-bottom mb-2 pb-25 d-flex flex-wrap justify-content-between"> 
														<div>
                                                            <!-- <h4 class="card-title text-theme">Basic Information</h4> -->
														    <!-- <p class="card-text">Fill the details</p> -->
                                                        </div> 
													</div>
                                                    
                                                </div> 
                                                
                                                
                                                <div class="col-md-8"> 
                                                      
                              
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            
                                                            <label class="form-label">Campus Name<span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                        <div class="form-group">
										
                                                        <select class="form-control selectpicker-back campuse_id" id="campuse_id" name="campuse_id">
                                                        <option value="">--Select Campus--</option>
		                                    @foreach($campuses as $campuse)
		                                    <option value="{{$campuse->id}}" {{(old('campuse_id')=="$campuse->id")? 'selected': ''}} >{{$campuse->name}}</option>
		                                    @endforeach
		                                </select>
																			</div>
                                                        </div> 
                                                    
                                                     </div> 

                                                     <div class="row align-items-center mb-1">
  <div class="col-md-3">
    <label class="form-label">Program<span class="text-danger">*</span></label>
  </div>
  <div class="col-md-5">
    <div class="form-group">
    <select class="form-control selectpicker" id="program" name="program">
		                                    <option value="">Select Program</option>
		                                    @foreach($programs as $program)
		                                     <option value="{{$program->id}}" {{(old('program')=="$program->id")? 'selected': ''}}>{{$program->name}}</option>
		                                    @endforeach
		                                </select>
    </div>
  </div>
</div>


<div class="row align-items-center mb-1">
  <div class="col-md-3">
    <label class="form-label">Course<span class="text-danger">*</span></label>
  </div>
  <div class="col-md-5">
    <div class="form-group">
    <select class="form-control selectpicker-back" id="course" name="course">
		                                    <option value="">Select Course</option>
                                        @foreach($courses as $course)
        <option value="{{$course->id}}" {{ (old('course', $selectedCourse ?? '') == $course->id) ? 'selected' : '' }}>{{$course->name}}</option>
    @endforeach
		                                </select>
    </div>
  </div>
</div>


<div class="row align-items-center mb-1">
  <div class="col-md-3">
    <label class="form-label">Branch<span class="text-danger">*</span></label>
  </div>
  <div class="col-md-5">
    <div class="form-group">
    <select class="form-control selectpicker-back" id="branch" name="branch">
		                                    <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
        <option value="{{$branch->id}}" {{ (old('branch', $selectedBranch ?? '') == $branch->id) ? 'selected' : '' }}>{{$branch->name}}</option>
    @endforeach
		                                </select>
    </div>
  </div>
</div>


<div class="row align-items-center mb-1">
  <div class="col-md-3">
    <label class="form-label">Semester<span class="text-danger">*</span></label>
  </div>
  <div class="col-md-5">
    <div class="form-group">
    <select class="form-control selectpicker-back" id="semester" name="semester">
		                                    <option value="">Select Semester</option>
		                                    @foreach($semesters as $semester)
        <option value="{{$semester->id}}" {{ (old('semester', $selectedSemester ?? '') == $semester->id) ? 'selected' : '' }}>{{$semester->name}}</option>
    @endforeach
		                                </select>
    </div>
  </div>
</div>


<div class="row align-items-center mb-1">
  <div class="col-md-3">
    <label class="form-label">Subject Name<span class="text-danger">*</span></label>
  </div>
  <div class="col-md-5">
    <div class="form-group">
    <select class="form-control selectpicker-back" id="subject" name="subject">
		                                    <option value="">Select Subject</option>
		                                    @foreach($subjects as $subject)
        <option value="{{$subject->id}}" {{ (old('subject', $selectedSubject ?? '') == $subject->id) ? 'selected' : '' }}>{{$subject->name}}</option>
    @endforeach
		                                </select>
    </div>
  </div>
</div>



<div class="row align-items-center mb-1">
  <div class="col-md-3">
    <label class="form-label">Faculty Name<span class="text-danger">*</span></label>
  </div>
  <div class="col-md-5">
    <div class="form-group">
    <select class="form-control selectpicker-back faculty" id="faculty" name="faculty">
		                                    <option value="">--Select Faculty--</option>
		                                    @foreach($facultys as $faculty)
		                                    <option value="{{$faculty->id}}" {{(old('faculty')=="$faculty->id")? 'selected': ''}} >{{$faculty->name}}</option>
		                                    @endforeach
		                                </select>
    </div>
  </div>
</div>


<div class="row align-items-center mb-1">
  <div class="col-md-3">
    <label class="form-label">Session<span class="text-danger">*</span></label>
  </div>
  <div class="col-md-5">
    <div class="form-group">
    <select class="form-control selectpicker-back" id="session" name="session">
		                                    <option value="">Select Session</option>
		                                    @foreach($sessions as $session)
		                                    
		                                    <option value="{{$session->academic_session}}" {{(old('session')=="$session->id")? 'selected': ''}} >{{$session->academic_session}}</option>
		                                    @endforeach
		                                </select>
    </div>
  </div>
</div>



<div class="row align-items-center mb-1">
  <div class="col-md-3">
    <label class="form-label" for="permissions">Permission<span class="text-danger">*</span></label>
  </div>
  <div class="col-md-5">
    <div class="form-group">
    <select class="form-control selectpicker-back" id="permissions" name="permissions" required>
		                                    <option value="">Select Permission</option>
		                                    <option value="all" @if(old('permissions')=='all') selected @endif>All</option>
		                                    <option value="1" @if(old('permissions')==1) selected @endif>Internal</option>
		                                    <option value="2" @if(old('permissions')==2) selected @endif>External</option>
		                                    <option value="3" @if(old('permissions')==3) selected @endif>Practical External</option>
		                                </select>
    </div>
  </div>
</div>

                                                     
                                                    
                
                 

            </div>
        </div>
        <form>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

   
	
	
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