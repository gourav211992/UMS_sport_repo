
@extends('ums.admin.admin-meta')

@section('content')
{{-- <body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click"
    data-menu="vertical-menu-modern" data-col=""> --}}

   

    <!-- BEGIN: Content-->
     <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Enrolled Students</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Report List</li>
                                </ol>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <form method="get" id="form_data">

                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-primary btn-sm mb-50 mb-sm-0"  type="submit" name="submit_form" value="true"><i data-feather="clipboard"></i> GET
                            REPORT</button>
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" href="Enrollment_Summary" ><i data-feather="bar-chart-2"></i>
                            ENROLLMENT COUNT</button>


                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row  ">

                    <div class="col-md mt-4 mb-3">

                        <div class="row align-items-center mb-1">
                            <div class="col-md-3">
                                <label class="form-label">Campus Name:<span class="text-danger m-0">*</span></label>
                            </div>

                            <div class="col-md-9">
                                <select name="campus" id="campus" class="form-control" onchange="$('#form_data').submit()">
                                    <option value="">--Select Campus--</option>
                                    @foreach($campuses as $campus)
                                        <option value="{{ $campus->id }}" @if(Request()->campus == $campus->id) selected @endif >{{ $campus->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                      

                    </div>
                    <div class="col-md mt-4 mb-3">

                        <div class="row align-items-center mb-1">
                            <div class="col-md-3">
                                <label class="form-label">Course Name:<span class="text-danger m-0">*</span></label>
                            </div>

                            <div class="col-md-9">
                                <select name="course_id" id="course_id" class="form-control">
                                    <option value="">--Select Course--</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" @if(Request()->course_id == $course->id) selected @endif >{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                       

                    </div>
                    
                    <div class="col-md mt-4 mb-3">

                        <div class="row align-items-center mb-1">
                            <div class="col-md-3">
                                <label class="form-label">Batch:<span class="text-danger m-0">*</span></label>
                            </div>

                            <div class="col-md-9">
                                <select name="batch" id="academic_session" class="form-control" required>
                                    <option value="">--Select Session--</option>
                                    @foreach($sessions as $session)
                                        <option value="{{$session->academic_session}}" @if(Request()->academic_session==$session->academic_session) selected @endif >{{$session->academic_session}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                       

                    </div>
                </form>
                    


                </div>

                @if($students)
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">


                                <div class="table-responsive">
                                    <table
                                        class="datatables-basic table myrequesttablecbox tableistlastcolumnfixed newerptabledesignlisthome">
                                        <thead>
                                            {{-- <tr>
                                                <th colspan="8">Course Name: {{ $course_name }}</th>
                                                <th colspan="4">Student Count: {{$students->count()}} </th>
                                            </tr> --}}
                                            <tr>

                                                <th>SN#</th>
                                                <th>Campus</th>
                                                <th>Course Name</th>
                                                <th>Academic Session</th>
                                                <th>Enrollment Number</th>
                                                <th>Roll Number</th>
                                                <th>Student Name</th>
                                                <th>Father's Name</th>
                                                <th>Gender</th>
                                                <th>Disability</th>
                                                <th>Category (Gen/OBC/SC/ST)</th>
                                                <th>Religion</th>
                                            </tr>

                                        </thead>
                              <tbody>
                                @if($students && $students->count() > 0)
                                @foreach($students as $index => $enr)
                                    @php
                                    $student = $enr->studentData;
                                    @endphp
                                    @if($student)
                                    {{-- @dd($student) --}}
                                    <tr>
                                        <td>{{++$index}}</td>
                                        <td>{{$selected_campus->name}}</td>
                                        <td>{{$selected_course->name}}</td>
                                        <td>{{Request()->batch}}</td>
                                        <td>{{$student->enrollment_no}}</td>
                                        <td>{{$student->roll_number}}</td>
                                        <td>{{$student->first_Name}}</td>
                                        <td>{{$student->father_first_name}}</td>
                                        <td>{{$student->gender}}</td>
                                        <td>{{$student->disabilty_category}}</td>
                                        <td>{{$student->category}}</td>
                                        <td>{{$student->religion}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            @else
                                <p>No applications available.</p>
                            @endif
                 </tbody>
                     </table>
                     </div>





                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input type="text" class="form-control dt-full-name"
                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                            aria-label="John Doe" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Post</label>
                                        <input type="text" id="basic-icon-default-post"
                                            class="form-control dt-post" placeholder="Web Developer"
                                            aria-label="Web Developer" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <input type="text" id="basic-icon-default-email"
                                            class="form-control dt-email" placeholder="john.doe@example.com"
                                            aria-label="john.doe@example.com" />
                                        <small class="form-text"> You can use letters, numbers & periods </small>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                        <input type="text" class="form-control dt-date"
                                            id="basic-icon-default-date" placeholder="MM/DD/YYYY"
                                            aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                        <input type="text" id="basic-icon-default-salary"
                                            class="form-control dt-salary" placeholder="$12000"
                                            aria-label="$12000" />
                                    </div>
                                    <button type="button" class="btn btn-primary data-submit me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                @endif

            </div>
        </div>
    </div> 
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">Copyright &copy; 2024 <a
                    class="ml-25" href="#" target="_blank">Presence 360</a><span
                    class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>

        <div class="footerplogo"><img src="../../../assets/css/p-logo.png" /></div>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0">
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="fp-range">Select Date</label>
                        <!--                        <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />-->
                        <input type="text" id="fp-range" class="form-control flatpickr-range bg-white"
                            placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                    </div>

                    <div class="mb-1">
                        <label class="form-label">PO No.</label>
                        <select class="form-select">
                            <option>Select</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Vendor Name</label>
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


{{-- </body> --}}
@endsection

