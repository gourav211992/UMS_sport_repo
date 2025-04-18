@extends("ums.admin.admin-meta")
@section("content")

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Counselled Students</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right"> 
                    {{-- <button class="btn btn-primary btn-sm mb-50 mb-sm-0" ><i></i>Remove Pagination</button>  --}}
							<button class="btn btn-primary btn-sm mb-50 mb-sm-0" data-bs-target="#filter1" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button> 
							<!-- <button class="btn btn-success btn-sm mb-50 mb-sm-0" data-bs-target="#approved" data-bs-toggle="modal"><i data-feather="check-circle" ></i> Assign Team</button> -->
                            <button class="btn btn-warning box-shadow-2 btn-sm me-1 mb-sm-0 mb-50" onclick="window.location.reload();"><i data-feather="refresh-cw"></i>Reset</button>  
                    </div>
                </div>
            </div>
            <div class="content-body">
                 
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                           
								   
                                <div class="table-responsive">
                                        <table class="datatables-basic table myrequesttablecbox loanapplicationlist">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No</th>
                                                    <th>Campuse</th>
                                                    <th>Course</th>
                                                    <th>Roll number</th>
                                                    <th>Application No</th>
                                                    <th>Student Name</th>
                                                    <th>Father Name</th>
                                                    <th>Mother Name</th>
                                                    <th>Adhar No</th>
                                                    <th>Contact</th>
                                                    <th>Email</th>
                                                    <th>DOB</th>
                                                    <th>Gender</th>
                                                    <th>Counceling</th>
                                                </tr>
                                            </thead>
                                           
                                            @if(count($Application_sort) > 0)
                                            @php $serial_no = ((($current_page - 1) * $per_page) + 1); @endphp
                                            @foreach( $Application_sort as $index => $app)
                                <tbody>
									<tr>
                                        <td>{{$app->id}}</td>
                                        <td>{{$app->campus->name}}</td>
                                        <td>{{$app->course->name}}</td>
                                        <td>{{$app->roll_number}}</td>
                                        <td>{{$app->application_no}}</td>
                                        <td>{{$app->first_Name}} {{$app->middle_Name}} {{$app->last_Name}}</td>
                                        <td>{{$app->father_first_name}}</td>
                                        <td>{{$app->mother_first_name}}</td>
                                        <td>{{$app->adhar_card_number}}</td>
                                        <td>{{$app->mobile}}</td>
                                        <td>{{$app->email}}</td>
                                        <td>{{$app->date_of_birth}}</td>
                                        <td>{{$app->gender}}</td>
                                        <td><input type="checkbox" name="counceling[]" value="{{$app->id}}" class="checkbox_style" @if($app->enrollment_status ==1) checked disabled @endif></td>
                                        <!-- <td><input type="hidden" name="application_id" value="{{$app->id}}"></td> -->
                                        
                                    </tr>
								</tbody>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="14" class="text-center">NO DATA FOUND</td>
                                    </tr>
                                @endif
                                @if(Request()->filter_course && Request()->academic_session && count($Application_sort) > 0)
                                <tfoot>
                                    <tr>
                                        <td colspan="14"><a href="{{route('bulk-enrollment-submit',['course_id'=>Request()->filter_course,'academic_session'=>Request()->academic_session])}}" class="btn btn-success" onclick="return comfirm('Are you sure about the bulk enrollment?');">Click Here to Bulk Enrollment Generation of the Current Selected Course and Acacemic Year</a></td>
                                    </tr>
                                </tfoot>
                                @endif


                                        </table>
                                    </div>
								
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Post</label>
                                        <input type="text" id="basic-icon-default-post" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                        <small class="form-text"> You can use letters, numbers & periods </small>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                        <input type="text" class="form-control dt-date" id="basic-icon-default-date" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                        <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" placeholder="$12000" aria-label="$12000" />
                                    </div>
                                    <button type="button" class="btn btn-primary data-submit me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                 

            </div>
        </div>
    </div>
    <!-- END: Content-->


     
<div class="modal fade" id="filter1" tabindex="-1" role="dialog" aria-labelledby="loginpopupTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    
            <div class="modal-content bg-light modalPad">
                <form id="approveds-form" method="GET" class="needs-validation" novalidate action="{{url('council_data')}}">
                    <div class="modal-header position-relative border-0">
                        <div class="">
                            <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                                <img src="/assets/admin/img/close.svg" />
                            </button>
                            <div class="">
                                <h5>List of Campuses</h5>
                                <p class="mb-0">Filter</p>
                            </div>
    
                        </div>
                    </div>
                    <div class="modal-body pt-0">
    
                        <div class="row">
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Campus</label>
                                    <select class="form-control selectpicker" id="campus" name="campus">
                                        <option value="">Select</option>
                                        @foreach($campuses as $campus)
                                        <option value="{{$campus->id}}">{{$campus->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Program</label>
                                    <select class="form-control selectpicker" id="filter_program" name="filter_program">
                                        <option value="">Select Program</option>
                                        @foreach($programs as $program)
                                        
                                        <option value="{{$program->id}}" >{{$program->name}}</option>
                                        @endforeach
                                    </select>
                            
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Course</label>
                                    <select class="form-control selectpicker-back" id="filter_course" name="filter_course">
                                        <option value="">Select Course</option>
                                        @foreach($courses as $course)
                                        <option value="{{$course->id}}" >{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Academic Session</label>
                                    <select class="form-control selectpicker" id="academic_session" name="academic_session">
                                        <option value="">Select Program</option>
                                        @foreach($academic_sessions as $academic_session)
                                        <option value="{{$academic_session->academic_session}}" >{{$academic_session->academic_session}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Counceled</label>
                                        <select class="form-control selectpicker-back" id="council_user" name="council_user">
                                            <option value="">Select Counceling Type</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Disability</label>
                                        <select class="form-control selectpicker-back" id="disability_category" name="disability_category">
                                            <option value="all">All</option>
                                            <option value="disabled">Disabled</option>
                                            <option value="non_disabled">Non Disabled</option>
                                        </select>
                                    </div>
                                </div> -->
                            </div> 
                           <!--  <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Cast Category</label>
                                        <select class="form-control selectpicker-back" id="category" name="category">
                                            <option value="">Select</option>
                                            @foreach($cast_category as $category_row)
                                            <option value="{{$category_row}}">{{$category_row}}</option>
                                            @endforeach
                                        </select>
                                            @if($errors->has('category'))
                                                <span class="text-danger">{{ $errors->first('category') }}</span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Education Order</label>
                                        <select class="form-control selectpicker-back" id="education_order" name="education_order">
                                            <option value="">Select</option>
                                            <option value="ASC">Ascending</option>
                                            <option value="DESC">Descending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>  -->               
                            <div class="col-md-12 mt-1">
                                <button class="btn btn-primary">Apply Filters</button>
                            </div>
    
                    </div>
    
                </form>
            </div>
    
        </div>
    </div>


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    
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
    
      
    
	 
    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
		<div class="modal-dialog sidebar-sm">
			<form class="add-new-record modal-content pt-0"> 
				<div class="modal-header mb-1">
					<h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
				</div>
				<div class="modal-body flex-grow-1">
					<div class="mb-1">
						  <label class="form-label" for="fp-range">Select Date Range</label>
						  <input type="text" id="fp-range" class="form-control flatpickr-range" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
					</div>
					
					<div class="mb-1">
						<label class="form-label">Select Incident No.</label>
						<select class="form-select select2">
							<option>Select</option>
						</select>
					</div> 
                    
                    <div class="mb-1">
						<label class="form-label">Select Customer</label>
						<select class="form-select select2">
							<option>Select</option>
						</select>
					</div> 
                    
                    <div class="mb-1">
						<label class="form-label">Assigned To</label>
						<select class="form-select select2">
							<option>Select</option>
						</select>
					</div> 
                    
                    <div class="mb-1">
						<label class="form-label">Status</label>
						<select class="form-select">
							<option>Select</option> 
							<option>Open</option>
							<option>Close</option>
							<option>Re-Allocatted</option>
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

   
    <script>
        function exportdata() {
             var fullUrl_count = "{{count(explode('?',urldecode(url()->full())))}}";
             var fullUrl = "{{url()->full()}}";
             if(fullUrl_count>1){
                 fullUrl = fullUrl.split('?')[1];
                 fullUrl = fullUrl.replace(/&amp;/g, '&');
                 fullUrl = '?'+fullUrl;
            }else{
                fullUrl = '';
            }
            var url = "{{url('admin/master/campus/campus-export')}}"+fullUrl;
            window.location.href = url;
        }
        function editCourse(slug) {
            var url = "{{url('admin/master/campus/edit-campus')}}"+"/"+slug;
            window.location.href = url;
        }
        function deleteCourse(slug) {
            var url = "{{url('admin/master/campus/delete-model-trim')}}"+"/"+slug;
            window.location.href = url;
        }
        $(document).ready(function() {
        $('.alphaOnly').keyup(function() {
                this.value = this.value.replace(/[^a-z|^A-Z\.]/g, '');
            });
        
            $('#dd').on('click', function(e){
    
                var html = "<html><head><meta charset='utf-8' /></head><body>" + document.getElementsByTagName("table")[0].outerHTML + "</body></html>";
                var blob = new Blob([html], { type: "application/vnd.ms-excel" });
                var a = document.getElementById("dd");
                // Use URL.createObjectURL() method to generate the Blob URL for the a tag.
                a.href = URL.createObjectURL(blob);
    
                var selmonth = $("#month option:selected").text();
                var selyear = $("#year option:selected").text();
                var show_agreement_type = $("#agreement_type option:selected").text();
                $('.show_agreement_type').text(show_agreement_type);
                
                // Set the download file name.
                a.download = "Application_Report.xls";
            });
        });
    
         $(document).ready(function(){
            $('#program').change(function() {
                    var course_type = $('#program').val();
                    var campuse_id = $('#type').val();
                // console.log('campuse id>>>>>>>>>>>',course_type);
                //  $("#course").find('option').remove().end();
                    var formData = {
                        program: course_type,
                        campuse_id: campuse_id,
                        "_token": "{{ csrf_token() }}"
                    }; //Array 
                    $.ajax({
                        url: "{{route('course_list')}}",
                        type: "POST",
                        data: formData,
                        success: function(data, textStatus, jqXHR) {
                            $('#course').html(data);
                            console.log(data);
                        },
                    });
            });
    
            $('#filter_program').change(function() {
                    var course_type = $('#filter_program').val();
                    var campuse_id = $('#campus').val();
                // console.log('campuse id>>>>>>>>>>>',course_type);
                //  $("#course").find('option').remove().end();
                    var formData = {
                        program: course_type,
                        campuse_id: campuse_id,
                        "_token": "{{ csrf_token() }}"
                    }; //Array 
                    $.ajax({
                        url: "{{route('course_list')}}",
                        type: "POST",
                        data: formData,
                        success: function(data, textStatus, jqXHR) {
                            $('#filter_course').html(data);
                            console.log(data);
                        },
                    });
            });
            
    
    
    });
    </script>
@endsection