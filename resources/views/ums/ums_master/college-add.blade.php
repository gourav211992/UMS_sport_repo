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
								<h2 class="content-header-title float-start mb-0">College Mapping</h2>
                                <div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('college')}}">Home</a>
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
							<button  type="submit" form="submitData" data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button> 
						</div>
					</div>
				</div>
			</div>
            <div class="content-body">
                <form id="submitData" method="POST" action="{{ url('college-add') }}">
                    @csrf
                    <section id="basic-datatable">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body customernewsection-form">
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="newheader border-bottom mb-2 pb-25">
                                                    <h4 class="card-title text-theme">Basic Information</h4>
                                                    <p class="card-text">Fill the details</p>
                                                </div>
                                            </div>
                
                                            <div class="col-md-8">
                
                                                <!-- Institute Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Institute <span class="text-danger">*</span></label>
                                                    </div>
                
                                                    <div class="col-md-5">
                                                        <select class="form-select @error('institute_id') is-invalid @enderror" name="institute_id">
                                                            <option value="">Select Institute</option>
                                                            @foreach ($instituteData as $institute)
                                                                <option value="{{ $institute->id }}" {{ old('institute_id') == $institute->id ? 'selected' : '' }}>
                                                                    {{ $institute->institute_name ?? 'Unnamed Institute' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('institute_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                
                                                <!-- Program Type Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Program Type <span class="text-danger">*</span></label>
                                                    </div>
                
                                                    <div class="col-md-5">
                                                        <select class="form-select @error('program_type_id') is-invalid @enderror" name="program_type_id" id="programTypeDropdown">
                                                            <option value="">Select Program Type</option>
                                                            @foreach ($programTypeData as $programType)
                                                                <option value="{{ $programType->id }}" {{ old('program_type_id') == $programType->id ? 'selected' : '' }}>
                                                                    {{ $programType->program_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('program_type_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                
                                                <!-- Course Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Course <span class="text-danger">*</span></label>
                                                    </div>
                
                                                    <div class="col-md-5">
                                                        <select class="form-select @error('course_id') is-invalid @enderror" name="course_id" id="courseDropdown">
                                                            <option value="">Select Course</option>
                                                            <!-- You can dynamically populate courses based on the selected program type if needed -->
                                                        </select>
                                                        @error('course_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                
                                            </div>
                
                                            <div class="col-md-4 border-start">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3" name="status" class="form-check-input" value="1" {{ old('status', '1') === '1' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25 me-0">

                                                                <input type="radio" id="customColorRadio4" name="status" class="form-check-input" value="0" {{ old('status') === '0' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                            </div>
                                                        </div>
                                                        @error('status')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div>
                
                                        <div class="border-bottom mb-2 mt-2 pb-25">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="newheader">
                                                        <h4 class="card-title text-theme">Program Branch Mapping</h4>
                                                        <p class="card-text">View the details</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive pomrnheadtffotsticky">
                                                    <table class="table table-striped border" id="programBranchTable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Program Branch</th>
                                                                <th>Semester Type</th>
                                                                <th>Course Duration (Yrs.)</th>
                                                                <th>Max. Course Duration (Yrs.)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Dynamic Rows Will Be Appended Here -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                
                                    </div> <!-- card-body -->
                                </div> <!-- card -->
                            </div>
                        </div>
                    </section>
                </form>
                
                
                

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
  
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
	 
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
					<button data-bs-toggle="modal" type="reset"  class="btn btn-primary">Submit</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function () {
        // Get Courses by Program Type
        $('#programTypeDropdown').on('change', function () {
            let programTypeId = $(this).val();
            console.log(programTypeId,'id');
            $('#courseDropdown').html('<option value="">Loading...</option>');
    
            if (programTypeId) {
                $.ajax({
                    url: '/get-courses/' + programTypeId,
                    type: 'GET',
                    success: function (courses) {
                        let options = '<option value="">Select Course</option>';
                        $.each(courses, function (i, course) {
                        console.log(course,'fghjhg');
                            options += `<option value="${course.id}">${course.course_name}</option>`;
                        });
                        $('#courseDropdown').html(options);
                        $('#programBranchTable tbody').empty(); // Clear branch table
                    }
                });
            } else {
                $('#courseDropdown').html('<option value="">Select Course</option>');
            }
        });
    
        // Get Program Branches by Program Type + Course
        $('#courseDropdown').on('change', function () {
            let courseId = $(this).val();
            let programTypeId = $('#programTypeDropdown').val();
    
            if (courseId && programTypeId) {
                $.ajax({
                    url: '/get-program-branches',
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        program_type_id: programTypeId,
                        course_id: courseId
                    },
                    success: function (branches) {
                        let rows = '';
                        $.each(branches, function (i, branch) {
                            rows += `
    <tr>
        <td>${i + 1}</td>
        <td>
            <strong>${branch.program_branch_name}</strong>
            <input type="hidden" name="program_branch_id[]" value="${branch.id}">
        </td>
        <td>
            <select class="form-select" name="semester_type[]">
                <option value="">Select</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td><input type="text" class="form-control" name="course_duration[]"></td>
        <td><input type="text" class="form-control" name="max_course_duration[]"></td>
    </tr>
    `;
    
                        });
                        $('#programBranchTable tbody').html(rows);
                    }
                });
            }
        });
    });
    </script>
    
    

@endsection