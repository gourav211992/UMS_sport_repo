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
								<h2 class="content-header-title float-start mb-0">New Semester</h2>
								<div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.html">Home</a>
										</li>  
										<li class="breadcrumb-item active">Add New Semester</li>


									</ol>
								</div>
							</div>
						</div>
					</div>
                    
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">
                            <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i>Cancel</button>    
   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i>Go Back</button>    
							<button form="sem_form" onClick="javascript: history.go(-1)" type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>Publish</button> 
						</div>
					</div>
				</div>
			</div>
            <form id="sem_form" method="POST" action="{{ route('semester_list_add') }}">
                @csrf
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
                    
                                            <!-- Campus Field -->
                                            <div class="col-md-8"> 
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Campus <span class="text-danger">*</span></label>  
                                                    </div>  
                    
                                                    <div class="col-md-5">  
                                                        <select class="form-select" name="campus_id" required>
                                                            <option value="">Select</option>
                                                            @foreach($campuselist as $campus)
                                                                <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                    
                                                <!-- Category Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Category <span class="text-danger">*</span></label>  
                                                    </div>  
                    
                                                    <div class="col-md-5">  
                                                        <select class="form-select" name="category_id" required>
                                                            <option value="">Select</option>
                                                            @foreach($categorylist as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                    
                                                <!-- Course Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Course <span class="text-danger">*</span></label>  
                                                    </div>  
                    
                                                    <div class="col-md-5">  
                                                        <select class="form-select" name="course_id" required>
                                                            <option value="">Select</option>
                                                            @foreach($courselist as $course)
                                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                    
                                                <!-- Semester Name Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Semester Name <span class="text-danger">*</span></label>  
                                                    </div>  
                    
                                                    <div class="col-md-5">  
                                                        <input type="text" name="name" class="form-control" placeholder="Enter Semester Name" required>
                                                    </div>
                                                </div>
                    
                                                <!-- Semester Number Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Semester Number <span class="text-danger">*</span></label>  
                                                    </div>  
                    
                                                    <div class="col-md-5">  
                                                        <input type="number" name="semester_number" class="form-control" placeholder="Enter Semester Number" required>
                                                    </div>
                                                </div>
                    
                                                <!-- Submit Button -->
                                                {{-- <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
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
	function submitSemester(form) {
		document.getElementById('sem_form').submit();
	}

$(document).ready(function(){
	$('#category_id').change(function() {
	var university=$('#university').val();
	var id = $('#category_id').val();
	$("#course_id").find('option').remove().end();
	$.ajax({
        url: "/admin/master/stream/get-course-list",
        data: {"_token": "{{ csrf_token() }}",university:university ,id: id},
        type: 'POST',
        success: function(data,textStatus, jqXHR) {
        	$('#course_id').append(data);
        		
        	
        }
    });
});	
});	
</script>