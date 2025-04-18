@extends('ums.admin.admin-meta')
@section('content')
    

    <!-- BEGIN: Content-->
    <form method="get" id="form_data">
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">REPORT</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Nirf Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button  type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle" ></i>Get Report
                            </button>
                            <button class="btn btn-warning  btn-sm me-1 mb-sm-0 mb-50"><i data-feather="refresh-cw"></i>Reset</button>
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
                                    <option value="">---Select Campus---</option>
                                    @foreach($campuses as $campus)
                            @if(Request()->campus == $campus->id)
                            <option value="{{ $campus->id }}" selected>{{ $campus->name }}</option>
                            @php $campus_name = $campus->name; @endphp
                            @else
                            <option value="{{ $campus->id }}" >{{ $campus->name }}</option>
                            @endif
                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md mt-4 mb-3">

                        <div class="row align-items-center mb-1">
                            <div class="col-md-3">
                                <label class="form-label">Academic Session:<span class="text-danger m-0">*</span></label>
                            </div>

                            <div class="col-md-9">
                                <select name="academic_session" id="academic_session" class="form-control" required>
                                    <option value="2023-2024" @if(Request()->academic_session == '2023-2024') selected @endif>
                                        2023-2024
                                    </option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">


                                <div class="table-responsive">
                                    <table
                                        class="datatables-basic table myrequesttablecbox  newerptabledesignlisthome">
                                        <thead>
                                            <tr>

                                                <th>SN#</th>
                                                <th>Academic Session</th>
                                                <th>COURSE Name</th>
                                                <th>Number of male students</th>
                                                <th>Total Students</th>
                                               <th>within state</th>
                                               <th>outside state</th>
                                               <th>outside country</th>
                                               <th>inside country</th>
                                               <th>general category</th>
                                               <th>EWS category</th>
                                               <th>OBS/SC/ST</th>
                                               <th>socially_students</th>
                                            

                                            </tr>

                                        </thead>
                                        <tbody>

                                            @if($courses)
                                            @php
                                           $index = 0;
                                         
                                            @endphp
                                            @foreach($courses as $index => $course)
                                            @php $course_wise_students = $course->course_wise_students(Request()->academic_session); @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ Request()->academic_session }}</td>
                                                <td>{{ $course->name}}</td>
                                                <td>{{ $course_wise_students['male_students']}}</td>
                                                <td>{{ $course_wise_students['female_students']}}</td>
                                                <td>{{ $course_wise_students['all_students']}}</td>
                                                <td>{{ $course_wise_students['within_state_students']}}</td>
                                                <td>{{ $course_wise_students['outside_state_students']}}</td>
                                                <td>{{ $course_wise_students['outside_country_students']}}</td>
                                                <td>{{ $course_wise_students['inside_country_students']}}</td>
                                                <td>{{ $course_wise_students['gen_students']}}</td>
                                                <td>{{ $course_wise_students['ews_students']}}</td>
                                                <td>{{ $course_wise_students['socially_challenged_students']}}</td>
                                                <!-- Add more columns as needed -->
                                            </tr>
                                            @endforeach
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


            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    {{-- <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">Copyright &copy; 2024 <a
                    class="ml-25" href="#" target="_blank">Presence 360</a><span
                    class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>

        <div class="footerplogo"><img src="../../../assets/css/p-logo.png" /></div>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer--> --}}


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