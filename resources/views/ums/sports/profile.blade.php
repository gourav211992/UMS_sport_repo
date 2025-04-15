@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')

<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static   menu-collapsed" data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->


    <!-- BEGIN: Content-->
    <div class="app-content content ms-0">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="mx-auto content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <section class="app-user-view-billing">
                    <div class="row">
                        <!-- User Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <!-- User Card -->
                            {{-- <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2"
                                                src="../../../app-assets/images/portrait/small/avatar-s-4.jpg"
                                                height="110" width="110" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h4>Aniket Kumar</h4>
                                                <span class="badge bg-light-secondary">Tennis Ball</span>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1 mt-2">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Email:</span>
                                                <span>hello@sport.com</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Contact:</span>
                                                <span>9876789876</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Status:</span>
                                                <span class="badge bg-light-success">Active</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Guardian Contact:</span>
                                                <span>Aniket Singh</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Guardian No.:</span>
                                                <span>933-44-22</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Guardian Email:</span>
                                                <span>aniket@gmail.com</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Country:</span>
                                                <span>India</span>
                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div> --}}
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <!-- Display profile image or default image -->
                                            <img class="img-fluid rounded mt-3 mb-2"
                                                src="{{ $student->registration->image ? asset($student->registration->image) : asset('app-assets/images/portrait/small/avatar-s-4.jpg') }}"
                                                height="110" width="110" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h4>{{ $student->registration->name ?? $student->name }}</h4>
                                                {{-- <span class="badge bg-light-secondary">{{ $student->registration->sport->name ?? 'No Sport' }}</span> <!-- Assuming there's a relationship with a sport --> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1 mt-2">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Email:</span>
                                                <span>{{ $student->registration->email ?? $student->email }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Contact:</span>
                                                <span>{{ $student->registration->mobile_number ?? $student->mobile }}</span>
                                            </li>
                                            {{-- @dump($student)--}}
                                            {{-- @dump($student->registration->status)--}}
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Status:</span>
                                                <span class="badge {{ ($student->registration->status == 'submitted' || $student->registration->status == 'approved') ? 'badge-light-success' : ($student->registration->status == 'rejected' ? 'badge-light-danger' : 'badge-light-warning') }}">{{ ucfirst($student->registration->status) }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Guardian Name:</span>
                                                <span>{{ $familyDetails->name ?? 'N/A' }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Guardian No.:</span>
                                                <span>{{ $student->mobile ?? 'N/A' }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Guardian Email:</span>
                                                <span>{{ $student->email ?? 'N/A' }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Country:</span>
                                                <span>{{ $student->registration->country ?? 'N/A' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!--/ User Sidebar -->

                        <!-- User Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

                            {{-- <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">My Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2 pb-50">
                                                <h5>Registration No</h5>
                                                <span>98765434567 <i data-feather="alert-triangle"
                                                        class="text-warning"></i></span>
                                            </div>
                                            <div class="mb-2 pb-50">
                                                <h5>Date of Joining</h5>
                                                <span>25-01-2025 <i data-feather="check-circle"
                                                        class="text-success"></i></span>
                                            </div>
                                            <div class="mb-2 mb-md-1">
                                                <h5>Address <span
                                                        class="badge badge-light-primary ms-50">Primary</span></h5>
                                                <span>Plot No 4, Sector 135, Noida 201301</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="alert alert-warning mb-2" role="alert">
                                                <div class="alert-body fw-normal font-small-3"><i
                                                        data-feather='alert-triangle'></i> Your Account is pending for
                                                    Verification.</div>
                                            </div>
                                            <div class="plan-statistics pt-1">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="fw-bolder">Profile Completed</h5>
                                                    <h6 class="fw-bold font-small-3">40% of 100%</h6>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar w-25" role="progressbar"
                                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <p class="mt-50">Atlease 80% Registration complete to verify your
                                                    account.</p>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <a class="btn btn-primary me-1 mt-1" href="registration.html">
                                                Update Profile
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div> --}}


                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">My Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2 pb-50">
                                                <!-- <h5>Registration No</h5> -->
                                                <h5>Permanent ID</h5>
                                                <span>{{ $student->registration->registration_number ?? 'N/A' }} </span>
                                            </div>
                                            <div class="mb-2 pb-50">
                                                <!-- <h5>Registration No</h5> -->
                                                <h5>Temporary ID</h5>
                                                <span>{{ $student->registration->document_number ?? 'N/A' }} </span>
                                            </div>
                                            <div class="mb-2 pb-50">
                                                <h5>Date of Joining</h5>
                                                <span>{{ \Carbon\Carbon::parse($student->registration->doj)->format('d-m-Y') .' ' }} <i data-feather="check-circle" class="text-success"></i></span>
                                            </div>
                                            <div class="mb-2 mb-md-1">
                                                <h5>Address</h5>
                                                <span>{{ $familyDetails->permanent_street1 ?? 'N/A' }}<span class="badge badge-light-primary ms-50">Primary</span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if($student->registration->status == 'submitted')
                                            <div class="alert alert-warning mb-2" role="alert">
                                                <div class="alert-body fw-normal font-small-3"><i
                                                        data-feather='alert-triangle'></i> Your Account is pending for Verification.</div>
                                            </div>
                                            @elseif($student->registration->status == 'rejected')
                                            <div class="alert alert-danger mb-2" role="alert">
                                                <div class="alert-body fw-normal font-small-3">
                                                    <i data-feather='alert-circle'></i>Your application has been rejected.
                                                    @if($student->registration->remarks)
                                                    <br><strong>Remarks:</strong> {{ $student->registration->remarks }}
                                                    @endif
                                                </div>
                                            </div>
                                            @elseif($student->registration->status == 'on-hold')
                                            <div class="alert alert-warning mb-2" role="alert">
                                                <div class="alert-body fw-normal font-small-3"><i
                                                        data-feather='alert-triangle'></i>  Admin has reviewed your profile, so you can now pay your fees and submit your profile.</div>
                                            </div>
                                            @endif
                                            <!-- <div class="plan-statistics pt-1">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="fw-bolder">Profile Completed</h5>
                                                    <h6 class="fw-bold font-small-3">80% of 100%</h6>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar w-75" role="progressbar"
                                                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <p class="mt-50">Atleast 80% Registration complete to verify your account.</p>
                                            </div> -->
                                        </div>
                                        @if($student->registration->status == 'draft' || $student->registration->status == 'rejected' || $student->registration->status == 'on-hold')
                                        <div class="col-12">
                                            <a class="btn btn-primary me-1 mt-1" href="{{route('update.registration',$student->registration->id)}}">
                                                Profile Detail
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body customernewsection-form">


                                    <div class="border-bottom mb-2 pb-25">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="newheader ">
                                                    <h4 class="card-title text-theme">Fee Schedule</h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>





                                    <div class="row">

                                        <div class="col-md-12">


                                            <div class="table-responsive pomrnheadtffotsticky">
                                                <table
                                                    class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad">
                                                    <thead>
                                                        <tr>
                                                            <th width="69">S.NO </th>
                                                            <th width="202">Due Date</th>
                                                            <th width="141">Amount</th>
                                                            <th width="141">Paid Amount</th>
                                                            <th width="141">Remaining Amount</th>
                                                            <th width="226">Status</th>
                                                            <th width="108">Action</th>
                                                        </tr>
                                                    </thead>
                                                   
                                                        <tr>
                                                            <td class="poprod-decpt">1</td>
                                                            <td class="poprod-decpt">{{$date}}</td>
                                                            <td>{{$totalFees}}</td>
                                                            <td>{{$paid_amount}}</td>
{{--                                                            <td>{{$totalFees-$paid_amount}}</td>--}}
                                                            <td></td>
                                                            <td><span
                                                                    class="badge rounded-pill @if($student->payment_status == 'paid') badge-light-success @else badge-light-warning @endif  badgeborder-radius">{{$student->payment_status??'Pending'}}</span>
                                                            </td>
                                                            <td><a href="#sponsor" data-bs-toggle="modal"
                                                                    class="text-primary add-contact-row"><i
                                                                        data-feather="eye" class="me-50"></i></a>
                                                                {{-- @if($student->payment_status != 'paid')--}}
                                                                {{-- Paid--}}
                                                                {{-- @else--}}
                                                                @if($student->payment_status == 'paid')
                                                                <span class="badge bg-success badge rounded-pill">Paid</span>
                                                                @else
                                                                <!-- <button class="btn btn-success btn-sm px-25 font-small-2 py-25 pay-now-btn" data-user-id="{{ $student->id }}">Pay Now</button> -->
                                                                <button class="btn btn-success btn-sm px-25 font-small-2 py-25 pay-now-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#paymentModal"
                                                                        data-user-id="{{ $user->id }}"
                                                                        >Pay Now</button>
                                                                @endif
                                                                {{-- @if($student->payments != null)--}}
                                                                <button
                                                                    data-bs-toggle="modal" data-bs-target="#update-payment" class="btn btn-primary btn-sm px-25 font-small-2 py-25">Payment Details</button>
                                                                {{-- @endif--}}
                                                                {{-- @endif--}}
                                                            </td>
                                                        </tr>


                                                    </tbody>

                                                </table>
                                            </div>


                                            <div class="modal fade" id="pay_now" tabindex="-1" aria-labelledby="pay_now" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title fs-2" id="pay_now">Payment </h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="">
                                                                @csrf
                                                                <div class="mb-3 text-center">
                                                                  
                                                                    <p class="">Are you sure you're paying under the correct quota? If not, please contact the admin on ......... before proceeding with payment.</p>
                                                                 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-success pay-now-btn" data-user-id="{{ $student->id }}" >Submit</button> 
                                                                </div>
                                                                <!-- <button type="button" class="btn btn-success pay-now-btn" data-user-id="{{ $student->id }}" >Submit</button> -->
                                                            </form>
                                                        </div>
                                                        <!-- <div class="modal-footer"> -->
                                                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                                            <!-- <button type="button" class="btn btn-success" data-user-id="{{ $student->id }}" >Submit</button>  -->
                                                            <!-- // <button type="button" class="btn btn-danger" onclick="submitRejectForm()">Submit</button> -->
                                                         <!-- </div> -->
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Payment Modal -->





                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--/ Billing Address -->
                        </div>


                        <!--/ User Content -->
                    </div>
                </section>


            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->

    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <div class="modal fade" id="update-payment" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            @if(!empty($user->payments))
            <div class="modal-content p-3">
                <h2 class="mb-3">Payment Details</h2>

                <table class="table table-bordered bg-white" style="border-collapse: collapse; background-color: white;">
                    <tr>
                     <th>User Name</th>
                        <td>{{ $user->first_name . ' '. ($user->middle_name ?? ''). ' '. $user->last_name }}</td>
                    </tr>

                    @if($user->payments)
                    <tr>
                        <th>Payment Status</th>
                        <td>{{ $user->payments->status ?? 'Pending' }}</td>
                    </tr>
                    <tr>
                        <th>Bank Name</th>
                        <td>{{ $user->payments->bank_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Payment Mode</th>
                        <td>{{ $user->payments->pay_mode ?? 'N/A' }}</td>
                    </tr>
                     <tr>
                        <th>Paid Amount</th>
                        <td>{{ $user->payments->paid_amount ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Reference No.</th>
                        <td>{{ $user->payments->ref_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Payment Document</th>
                        <td>
                            @if(!empty($user->payments->pay_doc))
                            <a href="{{ $user->payments->pay_doc }}" target="_blank">View Document</a>
                            @else
                            No document uploaded
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td>{{ $user->payments->remarks ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Transaction Date</th>
                        <td>{{ $user->payments->created_at ?? 'N/A' }}</td>
                    </tr>
                    @else
                    <tr>
                        <th colspan="2" class="text-center">No payment information available</th>
                    </tr>
                    @endif
                </table>
            </div>
            @else
            <form id="paymentForm" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $student->id }}">
                <div class="modal-content">
                    <div class="modal-header p-0 bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-4 mx-50 pb-2">
                        <h1 class="text-center mb-1" id="shareProjectTitle">Payment Details</h1>
                        <p class="text-center">Enter the details below.</p>

                        <div class="row mt-2">
                            <div class="col-md-12 mb-1" id="bankNameDiv">
                                <label class="form-label">Bank name <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="bank_name" id="bank_name" required>
                                    <option value="">Select</option>
                                    <option value="HDFC Bank">HDFC Bank</option>
                                    <option value="ICICI Bank">ICICI Bank</option>
                                    <option value="Axis Bank">Axis Bank</option>
                                    <option value="State Bank of India">State Bank of India</option>
                                    <option value="Bank of Baroda">Bank of Baroda</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-1">
                                <label class="form-label">Payment Mode <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="pay_mode" required>
                                    <option value="">Select</option>
                                    <option value="IMPS/RTGS">IMPS/RTGS</option>
                                    <option value="NEFT">NEFT</option>
                                    <option value="By Cheque">By Cheque</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-1" id="refNoDiv">
                                <label class="form-label">Ref No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="ref_no" id="ref_no" required />
                            </div>

                               <div class="col-md-12 mb-1">
                                <label class="form-label">Paid Amount <span class="text-danger"></span></label>
                                <input type="text" class="form-control" name="paid_amount" />
                            </div>

                            <div class="col-md-12 mb-1">
                                <label class="form-label">Payment Document <span class="text-danger"></span></label>
                                <input type="file" class="form-control" name="pay_doc" />
                            </div>

                            <div class="col-md-12 mb-1">
                                <label class="form-label">Remarks</label>
                                <textarea class="form-control" name="pay_remark"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitPayment">Submit</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>




    <div class="modal fade" id="sponsor" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header p-0 bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 mx-50 pb-2">
                    <h1 class="text-center mb-1" id="shareProjectTitle">View Fees Structure</h1>
                    <p class="text-center">View the details below.</p>



                    <div class="table-responsive pomrnheadtffotsticky">
                        <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fee Title</th>
                                    <th>Total Fees</th>
                                    <th>Fee Discount %</th>
                                    <th>Fee Discount Value</th>
                                    <th>Net Fee Payable Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feeDetails as $index => $fee)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $fee['title'] }}</td>
                                    <td>{{ number_format($fee['total_fees'], 2) }}</td>
                                    <td>{{ $fee['fee_discount_percent'] }}%</td>
                                    <td>{{ number_format($fee['fee_discount_value'], 2) }}</td>
                                    <td>{{ number_format($fee['net_fee_payable'], 2) }}</td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td colspan="4" class="text-end fw-bolder text-dark font-large-1">Total Fees</td>
                                    <td class="fw-bolder text-dark font-large-1">{{ number_format($totalFees, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="infodetail" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" style="max-width: 1200px">
            <div class="modal-content">
                <div class="modal-header p-0 bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 mx-50 pb-2">
                    <h1 class="text-center mb-1" id="shareProjectTitle">View Fees Discount</h1>
                    <p class="text-center">View the details below.</p>



                    <div class="table-responsive pomrnheadtffotsticky">
                        <table
                            class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fee Title</th>
                                    <th>Fee Sponsor %</th>
                                    <th>Fee Sponsor Value</th>
                                    <th>Fee Discount %</th>
                                    <th>Fee Discount Value</th>
                                    <th>Fee Sponsorship<br />+ Discount %</th>
                                    <th>Fee Sponsorship<br />+ Discount Value</th>
                                    <th>Net Discount %</th>
                                    <th>Net Discount Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Training</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>Security Deposit</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Khelo India</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                    <td>10%</td>
                                    <td>1000</td>
                                </tr>



                                <tr>
                                    <td></td>
                                    <td colspan="7" class="text-end fw-bolder text-dark font-large-1">Total Fees
                                    </td>
                                    <td class="fw-bolder text-dark font-large-1">10%</td>
                                    <td class="fw-bolder text-dark font-large-1">100000</td>
                                </tr>


                            </tbody>


                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Make Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <div class="mb-3">
                            <label for="paymentMode" class="form-label">Payment Mode</label>
                            <select class="form-select" id="paymentMode" required>
                                <option value="">Select Payment Mode</option>
                                <option value="UPI">UPI</option>
                                <option value="IMPS">IMPS</option>
                            </select>
                        </div>

                        <div id="upiSection" style="display:none;">
                            <div class="text-center mb-3">
                                <p>Scan the QR code to make payment</p>
                                <img src="{{asset('sports/img/sampleqr.jpeg')}}"
                                     alt="UPI QR Code" class="img-fluid">
                                {{--                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=UPI_ID:your-upi-id@bank&amount={{ $totalNetFeePayableValue }}"--}}
                                {{--                                     alt="UPI QR Code" class="img-fluid">--}}
                                {{--                                <p class="mt-2">OR</p>--}}
                                {{--                                <p>Send payment to: your-upi-id@bank</p>--}}
                            </div>
                        </div>

                        <div id="impsSection" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Bank Details for IMPS</label>
                                <div class="card p-3">
                                    <p><strong>Account Name:</strong> Your Academy Name</p>
                                    <p><strong>Account Number:</strong> 1234567890</p>
                                    <p><strong>IFSC Code:</strong> ABCD0123456</p>
                                    <p><strong>Bank Name:</strong> Example Bank</p>
                                </div>
                                <p class="mt-2 text-muted">Please share the transaction reference after payment.</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmPayment">Confirm Payment</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script>

        $(document).ready(function() {
            // Handle payment mode selection
            $('#paymentMode').change(function() {
                const mode = $(this).val();
                $('#upiSection, #impsSection').hide();

                if (mode === 'UPI') {
                    $('#upiSection').show();
                } else if (mode === 'IMPS') {
                    $('#impsSection').show();
                }
            });
            // Handle confirm payment button
            $('#confirmPayment').click(function() {
                const paymentMode = $('#paymentMode').val();

                if (!paymentMode) {
                    toastr.error('Please select a payment mode');
                    return;
                }

                const userId = $('.pay-now-btn').data('user-id');
                const amount = $('.pay-now-btn').data('total-amount');

                // Disable confirm button to prevent multiple submissions
                $('#confirmPayment').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

                // Send AJAX request to update payment status
                $.ajax({
                    url: "{{ url('update-payment-status') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        payment_mode: paymentMode
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(`Payment of ₹${amount} via ${paymentMode} was successful`, 'Success');

                            // Close the modal
                            $('#paymentModal').modal('hide');

                            // Replace button with "Paid" badge
                            $('.pay-now-btn').replaceWith('<span class="badge bg-success">Paid</span>');
                        } else {
                            toastr.error(response.message, 'Error');
                            $('#confirmPayment').prop('disabled', false).html('Confirm Payment');
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message
                            ? xhr.responseJSON.message
                            : 'Something went wrong. Please try again.';
                        toastr.error(errorMessage, 'Error');
                        $('#confirmPayment').prop('disabled', false).html('Confirm Payment');
                    }
                });
            });
        });
        $(document).ready(function() {
            // Handle form submission
            function toggleBankName() {
                var payMode = $('select[name="pay_mode"]').val();

                if (payMode === 'Cash') {
                    $('#bankNameDiv').hide();
                    $('#refNoDiv').hide();
                    $('#bank_name').val('').prop('required', false);
                    $('#ref_no').val('').prop('required', false);
                } else {
                    $('#bankNameDiv').show();
                    $('#refNoDiv').show();
                    $('#bank_name').prop('required', true);
                    $('#ref_no').prop('required', true);
                }
            }

            toggleBankName();

            $('select[name="pay_mode"]').on('change', function() {
                toggleBankName();
            });

            $('#paymentForm').on('submit', function(e) {
                e.preventDefault();

                // Get form data
                var formData = new FormData(this);

                // Disable submit button to prevent multiple submissions
                $('#submitPayment').prop('disabled', true);

                // Show loading indicator (optional)
                $('#submitPayment').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

                $.ajax({
                    url: "{{ url('update-payment') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Show success message
                            toastr.success(response.message, 'Success');

                            // Close modal after 1.5 seconds
                            setTimeout(function() {
                                $('#update-payment').modal('hide');
                            }, 1500);

                            // Optionally refresh part of the page or update UI
                        } else {
                            // Show error message
                            toastr.error(response.message, 'Error');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                            xhr.responseJSON.message :
                            'An error occurred while processing your request.';
                        $('#submitPayment').prop('disabled', false);
                        $('#submitPayment').html('Submit');
                        toastr.error(errorMessage, 'Error');
                    },
                    complete: function() {
                        // Re-enable submit button
                        $('#submitPayment').prop('disabled', false);
                        $('#submitPayment').html('Submit');
                        location.reload();
                    }
                });
            });

            // Reset form when modal is closed
            $('#update-payment').on('hidden.bs.modal', function() {
                $('#paymentForm')[0].reset();
            });
            {{--$(document).on('click', '.pay-now-btn', function() {--}}
            {{--    var userId = $(this).data('user-id');--}}
            {{--    var $button = $(this);--}}

            {{--    // Disable button to prevent multiple clicks--}}
            {{--    $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');--}}

            {{--    $.ajax({--}}
            {{--        url: "{{ url('update-payment-status') }}", // Define the correct route--}}
            {{--        type: "POST",--}}
            {{--        data: {--}}
            {{--            _token: '{{ csrf_token() }}', // Ensure CSRF protection--}}
            {{--            user_id: userId--}}
            {{--        },--}}
            {{--        success: function(response) {--}}
            {{--            if (response.success) {--}}
            {{--                toastr.success(response.message, 'Success');--}}

            {{--                // Replace "Pay Now" button with "Paid" badge--}}
            {{--                $button.replaceWith('<span class="badge bg-success">Paid</span>');--}}
            {{--                setTimeout(function() {--}}
            {{--                    // location.reload()--}}
            {{--                }, 1500);--}}

            {{--            } else {--}}
            {{--                toastr.error(response.message, 'Error');--}}
            {{--                $button.prop('disabled', false).html('Pay Now');--}}
            {{--            }--}}
            {{--        },--}}
            {{--        error: function(xhr, status, error) {--}}
            {{--            var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?--}}
            {{--                xhr.responseJSON.message :--}}
            {{--                'An error occurred while processing your request.';--}}
            {{--            toastr.error(errorMessage, 'Error');--}}
            {{--            $button.prop('disabled', false).html('Pay Now');--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
        });
    </script>
    @endsection