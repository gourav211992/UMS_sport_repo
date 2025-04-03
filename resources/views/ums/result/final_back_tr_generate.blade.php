@extends('ums.admin.admin-meta')
@section("content")
{{-- <body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col=""> --}}
    {{-- @include('header');  --}}
    {{-- @include('sidebar'); --}}
    <!-- BEGIN: Content-->

    <div class="app-content content ">


        <!-- options section -->
    {{-- <div class="col-md-12">
        <div class="row align-items-center mb-1">
            <div class="col-md-4 text-center">
                <label class="form-label ">Base Rate % <span class="text-danger">*</span></label>
                <input type="number" value="5" class="form-control ">
            </div>
            <div class="col-md-4 text-center">
                <label class="form-label">Effective from <span class="text-danger">*</span></label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-4 text-center">
                <label class="form-label">Additional Input <span class="text-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>
    </div> --}}

    <div class="big  d-flex justify-content-between align-items-center">

        <div class="content-header-left col-md-5 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Tabular Record (TR)</h2>
                   
                </div>
            </div>
        </div>
    <div class="submitss text-end me-3">

       
    </div>
  </div>

  <form method="get" id="form_data">
    <div class="row mb-2">
        <div class="col-md-3">
            <label class="form-label">Campus:<span class="text-danger">*</span></label>
            <select data-live-search="true" name="campus_id" id="campus_id" class="form-control" onChange="$('#form_data').submit();">
                <option value="">--Choose Campus--</option>
                @foreach($campuses as $campus)
                    <option value="{{$campus->id}}" @if(Request()->campus_id==$campus->id) selected @endif >{{$campus->name}}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('campus_id') }}</span>
        </div>

        <div class="col-md-3">
            <label class="form-label">Courses:<span class="text-danger">*</span></label>
            <select data-live-search="true" name="course" id="course" class="form-control" onChange="$('#form_data').submit();">
                <option value="">--Choose Course--</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}" @if($course_id==$course->id) selected @endif >{{$course->name}}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('course') }}</span>
        </div>

        <div class="col-md-3">
            <label class="form-label">Semester:<span class="text-danger">*</span></label>
            <select data-live-search="true" name="semester" id="semester" class="form-control" onChange="$('#group_name').prop('selectedIndex',0); $('#form_data').submit();">
                <option value="">--Select Semester--</option>
                @foreach($semesters as $semester)
                    <option value="{{$semester->id}}" @if($semester_id==$semester->id) selected @endif >{{$semester->name}}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('semester') }}</span>
        </div>

        <div class="col-md-3">
            <label class="form-label">Form Type:<span class="text-danger">*</span></label>
            <select name="form_type" id="form_type" class="form-control">
                <option value="final_back_paper" @if(Request()->form_type=='final_back_paper') selected @endif >Final Year Back</option>
            </select>
            <span class="text-danger">{{ $errors->first('form_type') }}</span>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <label class="form-label">Academic Session:<span class="text-danger">*</span></label>
            <select name="academic_session" id="academic_session" class="form-control" onChange="$('#form_data').submit();">
                @foreach($sessions as $sessionRow)
                    <option value="{{$sessionRow->academic_session}}" @if(Request()->academic_session == $sessionRow->academic_session) selected @endif >{{$sessionRow->academic_session}}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('academic_session') }}</span>
        </div>

        <div class="col-md-3">
            <label class="form-label">Exam Month & Year:<span class="text-danger">*</span></label>
            <select name="month_year[]" id="month_year" class="form-control" multiple>
                @foreach($month_years as $month_year)
                    @php $month_year_text = $month_year->year.'-'.sprintf('%02d', $month_year->month); @endphp
                    <option value="{{$month_year_text}}" @if(Request()->month_year && in_array($month_year_text, Request()->month_year)) selected @endif >
                        {{ date('M', strtotime('01-'.$month_year->month.'-2023')).'-'.$month_year->year }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('month_year') }}</span>
        </div>

        <div class="col-md-3">
            <label class="form-label">Subject Group Name:<span class="text-danger">*</span></label>
            <select name="group_name[]" id="group_name" class="form-control" multiple>
                <option value="">Please Select</option>
                @foreach($subjects_header_group as $index_sub=>$subject)
                    <option value="{{$subject->subject}}" @if(Request()->group_name && in_array($subject->subject, Request()->group_name)) selected @endif >
                        {{++$index_sub}}) {{$subject->subject}}
                    </option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('group_name') }}</span>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <input type="submit" class="btn btn-primary" value="Generate TR">
        </div>
    </div>
</form>

    

<!-- options section end-->

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                {{-- <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Admin <br> <small>List of Admins</small></h2>
                            {{-- <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>  
                                    <li class="breadcrumb-item active">Incident List</li>
                                </ol>
                            </div> --}}
                        {{-- </div>
                    </div>
                </div>  --}}
                {{-- <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right"> 
                        <button class="btn btn-primary btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal">
                            <i data-feather="filter"></i> Filter
                        </button> 
                        <!-- <button class="btn btn-success btn-sm mb-50 mb-sm-0" data-bs-target="#approved" data-bs-toggle="modal"><i data-feather="check-circle" ></i> Assign Team</button> -->
                        <a class="btn btn-dark btn-sm mb-50 mb-sm-0" href="incident-add.html">
                            <i data-feather="user-plus"></i> Add Admin
                        </a>  
                        <!-- Reset Button -->
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" type="reset">
                            <i data-feather="refresh-cw"></i> Reset
                        </button>
                    </div>
                </div> --}}
                
            </div>
            <div class="content-body">
                 
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
								
{{-- 								   
                                <div class="table-responsive">
                                        <table class="datatables-basic table myrequesttablecbox loanapplicationlist">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>ROLL NO</th>
                                                    <th>NAME</th>
                                                    <th>GRAND TOTAL</th>
                                                    <th>RESULT</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td class="fw-bolder text-dark">Description will come here</td>
                                                    <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">Sarah Burley</span></td>
                                                    <td><span class="badge rounded-pill badge-light-danger badgeborder-radius">Description will come here</span></td> 
                                                    <td>pass</td> 
                                                    <td class="tableactionnew">  
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow p-0 " data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item">
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a> 
                                                                <a class="dropdown-item" href="incident-view.html">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a> <a class="dropdown-item" data-bs-toggle="modal" href="#reallocate">
                                                                    <i data-feather="copy" class="me-50"></i>
                                                                    <span>Re-Allocate</span>
                                                                </a> <a class="dropdown-item" href="#">
                                                                    <i data-feather="trash-2" class="me-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td class="fw-bolder text-dark">05-Sep-2024</td>
                                                    <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">Sarah Burley</span></td>
                                                    <td><span class="badge rounded-pill badge-light-warning badgeborder-radius">Open</span></td> 
                                                    <td>pass</td> 
                                                    <td class="tableactionnew">  
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow p-0 " data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" >
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a> 
                                                                <a class="dropdown-item" href="incident-view.html">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a> <a class="dropdown-item" data-bs-toggle="modal" href="#reallocate">
                                                                    <i data-feather="copy" class="me-50"></i>
                                                                    <span>Re-Allocate</span>
                                                                </a> <a class="dropdown-item" href="#">
                                                                    <i data-feather="trash-2" class="me-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr>
                                                  <tr>
                                                    <td>3</td>
                                                    <td class="fw-bolder text-dark">05-Sep-2024</td>
                                                    <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">Sarah Burley</span></td>
                                                    <td><span class="badge rounded-pill badge-light-success badgeborder-radius">Close</span></td> 
                                                    <td>pass</td> 
                                                    <td class="tableactionnew">  
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow p-0 " data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item">
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a> 
                                                                <a class="dropdown-item" href="incident-view.html">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a> <a class="dropdown-item" data-bs-toggle="modal" href="#reallocate">
                                                                    <i data-feather="copy" class="me-50"></i>
                                                                    <span>Re-Allocate</span>
                                                                </a> <a class="dropdown-item" href="#">
                                                                    <i data-feather="trash-2" class="me-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td>4</td>
                                                    <td class="fw-bolder text-dark">05-Sep-2024</td>
                                                    <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">Sarah Burley</span></td>
                                                    <td><span class="badge rounded-pill badge-light-danger badgeborder-radius">Re-Allocatted</span></td> 
                                                    <td>pass</td> 
                                                    <td class="tableactionnew">  
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow p-0 " data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" >
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a> 
                                                                <a class="dropdown-item" href="incident-view.html">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a> <a class="dropdown-item" data-bs-toggle="modal" href="#reallocate">
                                                                    <i data-feather="copy" class="me-50"></i>
                                                                    <span>Re-Allocate</span>
                                                                </a> <a class="dropdown-item" href="#">
                                                                    <i data-feather="trash-2" class="me-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td class="fw-bolder text-dark">05-Sep-2024</td>
                                                    <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">Sarah Burley</span></td> 
                                                    <td><span class="badge rounded-pill badge-light-warning badgeborder-radius">Open</span></td>
                                                    <td>pass</td>   
                                                    <td class="tableactionnew">  
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow p-0 " data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item">
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a> 
                                                                <a class="dropdown-item" href="incident-view.html">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a> <a class="dropdown-item" data-bs-toggle="modal" href="#reallocate">
                                                                    <i data-feather="copy" class="me-50"></i>
                                                                    <span>Re-Allocate</span>
                                                                </a> <a class="dropdown-item" href="#">
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
								
                            </div> --}}

                            
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
 @endsection