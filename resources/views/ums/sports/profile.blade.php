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
                                            <!-- <li class="mb-75">
                                                <span class="fw-bolder me-25">Country:</span>
                                                <span>{{ $student->registration->country ?? 'N/A' }}</span>
                                            </li> -->
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
                                    <h5 class="card-title fw-bolder text-primary">My Profile</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2 pb-50">
                                                <!-- <h5>Registration No</h5> -->
                                                <h5 class="fw-bolder">Permanent ID</h5>
                                                <span>{{ $student->registration->registration_number ?? 'N/A' }} </span>
                                            </div>
                                            <div class="mb-2 pb-50">
                                                <!-- <h5>Registration No</h5> -->
                                                <h5 class="fw-bolder">Temporary ID</h5>
                                                <span>{{ $student->registration->document_number ?? 'N/A' }} </span>
                                            </div>
                                            <div class="mb-2 pb-50">
                                                <h5 class="fw-bolder">Date of Joining</h5>
                                                <span>{{ \Carbon\Carbon::parse($student->registration->doj)->format('d-m-Y') .' ' }} <i data-feather="check-circle" class="text-success"></i></span>
                                            </div>
                                            <div class="mb-2 mb-md-1">
                                                <h5 class="fw-bolder">Address</h5>
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
                                        @elseif($student->registration->status == 'submitted' ||$student->registration->status == 'approved')
                                            <div class="col-12">
                                                <a class="btn btn-primary me-1 mt-1" href="{{ route('profile-view-detail', ['id' => $student->registration->id, 'readonly' => true]) }}">
                                                   View Detail
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


                                            {{-- <div class="table-responsive pomrnheadtffotsticky">
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
                                                            <td>{{number_format($totalFees,2)}}</td>
                                                            <td>{{ number_format($paid_amount, 2)}}</td>
                                                           <td>{{number_format(intval($totalFees)- intval( $paid_amount),2)}}</td>
                                                       
                                                            <td><span
                                                                    class="badge rounded-pill @if($student->payment_status == 'paid') badge-light-success @else badge-light-warning @endif  badgeborder-radius">{{$student->payment_status??'Pending'}}</span>
                                                            </td>
                                                            <td><a href="#sponsor" data-bs-toggle="modal"type="button"
                                                                    class="text-primary add-contact-row btn btn-sm   btn-success px-25 font-small-2 py-25">
                                                                        Pay Now</a>
                                                               
                                                                @if($student->payment_status == 'paid')
                                                                <span class="badge bg-success badge rounded-pill">Paid</span>
                                                                @else
                                                             
                                                                @endif
                                                             
                                                                <button
                                                                    data-bs-toggle="modal" data-bs-target="#update-payment" class="btn btn-primary btn-sm px-25 font-small-2 py-25">Payment Details</button>
                                                                
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
                                            </div> --}}
                                            @php
use Carbon\Carbon;

$feeItems = $feeDetails;
$monthlyGrouped = [];
$startDate = Carbon::parse($student->registration->doj);

$paidData = $existingData;     // From DB: 'Paid'
$unpaidData = $UsersideData;   // From DB: 'notconfirm'


// Define intervals for each payment mode
$intervalMap = [
    'Monthly' => 1,
    'Quarterly' => 3,
    'Semi-Yearly' => 6,
    'Yearly' => 12
];

$oneTimeItems = []; 

foreach ($feeItems as $item) {
    $paymentMode = $item['payment_mode'];
    $feeHead = $item['title'];

    // Handle recurring fees
    if (isset($intervalMap[$paymentMode]) && $item['duration'] && $item['mandatory']) {
        $interval = $intervalMap[$paymentMode];
        $installments = ceil($item['duration'] / $interval);
      
        $groupAmount = round($item['net_fee_payable'] / $installments, 2);

        $baseStartDate = $startDate->copy(); 

        for ($i = 0; $i < $installments; $i++) {
            $dueDate = $baseStartDate->copy()->addMonths($i * $interval)->format('Y-m-d');
            $index = $i + 1;
            $paid_amount = 0;
            $status = 'Pending';
            $isDisabled = false;
            $WaitConfirm = false;

            // Check paid data
            if (isset($paidData[$feeHead])) {
                foreach ($paidData[$feeHead]['schedule'] as $paidItem) {
                    if ($paidItem['index'] == $index) {
                        $paid_amount = $paidItem['amount'];
                        $status = $paidItem['status'];
                        $isDisabled = $status === 'Paid';
                        break;
                    }
                }
            }

            // Check unpaid data
            if (isset($unpaidData[$feeHead])) {
                foreach ($unpaidData[$feeHead]['schedule'] as $unpaidItem) {
                    if ($unpaidItem['index'] == $index) {
                        $status = $unpaidItem['status'];
                        $isDisabled = $status === 'notconfirm';
                        $WaitConfirm = true;
                        break;
                    }
                }
            }

            $monthlyGrouped[$dueDate][] = [
                'type' => $paymentMode,
                'title' => $feeHead,
                'amount' => $groupAmount,
                'index' => $index,
                'feeHead' => $feeHead,
                'paid_amount' => $paid_amount,
                'status' => $status,
                'isDisabled' => $isDisabled,
                'waitconfirm' => $WaitConfirm
            ];
        }
    }

    // Handle one-time fees
    if (!isset($intervalMap[$paymentMode]) && $item['mandatory']) {
        $paid_amount = 0;
        $status = 'Pending';
        $isDisabled = false;
        $WaitConfirm = false;

        if (isset($paidData[$feeHead])) {
            foreach ($paidData[$feeHead]['schedule'] as $paidItem) {
                $paid_amount = $paidItem['amount'];
                $status = $paidItem['status'];
                $isDisabled = $status === 'Paid';
                break;
            }
        }

        if (isset($unpaidData[$feeHead])) {
            foreach ($unpaidData[$feeHead]['schedule'] as $unpaidItem) {
                $status = $unpaidItem['status'];
                $isDisabled = $status === 'notconfirm';
                $WaitConfirm = true;
                break;
            }
        }

        $oneTimeItems[] = [
            'type' => $paymentMode,
            'title' => $feeHead,
            'amount' => round($item['net_fee_payable'], 2),
            'index' => 1,
            'feeHead' => $feeHead,
            'paid_amount' => $paid_amount,
            'status' => $status,
            'isDisabled' => $isDisabled,
            'waitconfirm' => $WaitConfirm
        ];
    }
}


if (!empty($oneTimeItems)) {
    if (empty($monthlyGrouped)) {
        $monthlyGrouped[$startDate->format('Y-m-d')] = $oneTimeItems;
    } else {
        $firstDueDate = array_key_first($monthlyGrouped);
        foreach ($oneTimeItems as $oneTimeItem) {
            $alreadyExists = false;
            foreach ($monthlyGrouped[$firstDueDate] as $existingItem) {
                if ($existingItem['feeHead'] === $oneTimeItem['feeHead']) {
                    $alreadyExists = true;
                    break;
                }
            }
            if (!$alreadyExists) {
                $monthlyGrouped[$firstDueDate][] = $oneTimeItem;
            }
        }
    }

    $oneTimeItems = [];
}

ksort($monthlyGrouped);


@endphp




<h4>Monthly Fee Due Schedule</h4>
<table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad ">
    <thead>
        <tr>
            <th>S.NO</th>
            <th>Due Date</th>
            <th>Amount</th>
            <th>Paid Amount</th>
            <th>Remaining Amount</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; $total_amount = 0; $paidAmount = 0; @endphp
        @foreach($monthlyGrouped as $dueDate => $items)
            @php
                $total = array_sum(array_column($items, 'amount'));
                $paid = array_sum(array_column($items, 'paid_amount'));
                $remaining = $total - $paid;
                $status = $paid > 0 ? ($remaining == 0 ? 'Paid' : 'Partial') : 'Pending';

                $isDisabled = collect($items)->every(fn($item) => $item['isDisabled']);
                $WaitConfirm = collect($items)->every(fn($item) => $item['waitconfirm']);
                if ($WaitConfirm && !$paid) {
                    $status = "Confirmation required";
                    
                }

                $total_amount += $total;
                $paidAmount += $paid;
            @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ \Carbon\Carbon::parse($dueDate)->format('d M Y') }}</td>
                <td>₹{{ number_format($total, 2) }}</td>
                <td>₹{{ number_format($paid, 2) }}</td>
                <td>₹{{ number_format($remaining, 2) }}</td>
                <td>
                    <span class="badge
                        {{ $status == 'Paid' ? 'bg-success' :
                            ($status == 'Partial' ? 'bg-info text-dark' :
                            ($status == 'Confirmation required' ? 'bg-secondary text-white' : 'bg-warning text-dark')) }}">
                        {{ $status }}
                    </span>
                </td>
                <td>
    <input type="checkbox" class="due-check" 
        data-date="{{ $dueDate }}"
        data-items='@json($items)'
        data-total="{{ $total }}"
        {{ $isDisabled ? 'checked disabled' : '' }}>

    <i class="fa fa-eye text-primary ms-2 view-schedule" style="cursor:pointer"
       data-bs-toggle="modal"
       data-bs-target="#feeDetailModal"
       data-date="{{ $dueDate }}"
       data-items='@json($items)'
        data-remaining="{{ $remaining }}"
       title="View Fee Schedule">
    </i>
</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td colspan="2"><strong>Total Amount: ₹{{ number_format($total_amount, 2) }}</strong></td>
            <td colspan="2"><strong>Payable Amount: ₹{{ number_format($paidAmount, 2) }}</strong></td>
            <td></td>
            <td>
               <button class="btn btn-primary btn-sm px-25 font-small-2 py-25 pay-now-btn" 
        id="payNowBtn" 
        data-user-id="{{ $student->id }}">
    Pay Now
</button>

            </td>
        </tr>
    </tfoot>
</table> 
<!-- Confirm Payment Modal -->
<div class="modal fade" id="confirmPayModal" tabindex="-1" aria-labelledby="confirmPayModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmPayModalLabel">Confirm Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to proceed with the payment?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary btn-sm" id="confirmPaymentBtn">Yes, Pay Now</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="feeDetailModal" tabindex="-1" aria-labelledby="feeDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="feeDetailModalLabel">Fee Schedule Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 id="modalDueDate"></h6>
        <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad ">
          <thead>
            <tr>
              <th>#</th>
              <th>Fee Head</th>
              <th>Type</th>
              <th>Amount</th>
              <th>Paid</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="modalFeeDetails"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
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
                    
                    @if (isset($studentActivities) && count($studentActivities) > 0 && ($student->registration->status == 'approved')  )
                        
                   
                        <div class="col-md-12">
                            <div class="card">
                                 <div class="card-body customernewsection-form"> 
    
    
                                            <div class="border-bottom mb-2 pb-25">
                                                     <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="newheader "> 
                                                                <h4 class="card-title text-theme">My Activity</h4> 
                                                            </div>
                                                        </div>
                                                        
                                                     </div>
                                           
    
    
    
    
    
                                            <div class="row"> 
    
                                                 <div class="col-md-12">
                                                     
                                                     <div class="">
                                                        <div class="step-custhomapp bg-light"> 
                                                            <ul class="nav nav-tabs my-25 custapploannav" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-bs-toggle="tab" href="#Today">Schedule</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-bs-toggle="tab" href="#Schedule">Previous Activity</a>
                                                                </li> 
                                                            </ul>
                                                        </div>
                                                         <div class="tab-content pb-1">
                                                                 <div class="tab-pane active" id="Today">
                                                                    <div class="d-flex justify-content-end align-items-center mb-75">
                                                                        <div class="form-label text-nowrap me-1">
                                                                            <strong>Activity Date</strong>
                                                                        </div>
                                                                    
                                                                        <form method="GET" action="{{ url('/sports/profile/' . $student->id) }}" id="filterForm" class="d-flex align-items-center">
                                                                            <input type="text" id="fp-range" class="form-control flatpickr-range bg-white mw-100" placeholder="DD-MM-YYYY to DD-MM-YYYY" />
                                                                            <input type="hidden" name="fromDate" id="fromDate" />
                                                                            <input type="hidden" name="toDate" id="toDate" />
                                                                        </form>
                                                                    
                                                                        <div class="ms-1">
                                                                            <a href="{{ url()->current() }}" class="btn btn-sm btn-secondary">Reset</a>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                     <div class="table-responsive pomrnheadtffotsticky">
                                                                         <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad"> 
                                                                              <thead>
                                                                                 <tr>
                                                                                    <th>#</th>
                                                                                    <th>Date</th>
                                                                                    <th>Activity</th>
                                                                                    <th>Trainer</th>
                                                                                    <th>Time</th>
                                                                                    <th>Students</th>
                                                                                    <th>Status</th>
                                                                                  </tr>
                                                                                </thead>
                                                                                {{-- <tbody>
                                                               
                                                                                  @php
        $hasFilter = request()->has('fromDate') && request()->has('toDate');
        $counter = 1;
    @endphp
    
    @foreach($studentActivities as $index => $activity)
        @php
            $subActivities = json_decode($activity->sub_activities, true);
            $tooltip = is_array($subActivities) ? implode(', ', $subActivities) : '';
            $batchCount = is_array(json_decode($activity->batch_student, true)) ? count(json_decode($activity->batch_student, true)) : 0;
        @endphp
    
        @foreach($activity->activities as $scheduled)
            @php
                $activityDate = \Carbon\Carbon::parse($scheduled['date']);
            @endphp
    
    @if(($hasFilter && $activityDate->between(\Carbon\Carbon::parse(request('fromDate')), \Carbon\Carbon::parse(request('toDate')))) || (!$hasFilter && $activityDate->isToday()))
                <tr>
                    <td>{{ $counter++}}</td>
                    <td>{{ $activityDate->format('d-m-Y') }}</td>
    
                    <td>
                        <div 
                            data-bs-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-bs-placement="top"
                            title="{{ $tooltip }}">
                            {{ strtoupper($activity->activity) }}
                        </div>
                    </td>
    
                    <td>{{ ucwords($activity->trainer) }}</td>
    
                    <td>
                        {{ \Carbon\Carbon::createFromFormat('H:i', $scheduled['start_time'])->format('h:i A') }}
                        -
                        {{ \Carbon\Carbon::createFromFormat('H:i', $scheduled['end_time'])->format('h:i A') }}
                    </td>
    
                    <td>
                        <span class="badge rounded-pill badge-light-secondary badgeborder-radius">
                            {{ $batchCount }}
                        </span>
                    </td>
    
                    <td>
                        @php
                            $dayData = json_decode($activity->day, true);
                            $firstDay = array_key_first($dayData);
                    
                            $startTimeStr = $scheduled['start_time'] ?? '00:00';  
                            $endTimeStr = $scheduled['end_time'] ?? '00:00';      
                            // dd(  $startTimeStr,  $endTimeStr);
                    
                            $activityDateStr = $scheduled['date'];
                    
                            $startDateTime = \Carbon\Carbon::parse($activityDateStr . ' ' . $startTimeStr);
                            $endDateTime = \Carbon\Carbon::parse($activityDateStr . ' ' . $endTimeStr);
                    
                            $currentTime = \Carbon\Carbon::now('Asia/Kolkata');
                        @endphp
                    
                        @if($currentTime->between($startDateTime, $endDateTime))
                            <span class="badge rounded-pill badge-light-info badgeborder-radius">Ongoing</span>
                        @elseif($currentTime->greaterThan($endDateTime))
                            <span class="badge rounded-pill badge-light-success badgeborder-radius">Closed</span>
                        @else
                            <span class="badge rounded-pill badge-light-warning badgeborder-radius">Upcoming</span>
                        @endif
                    </td>
                        
                </tr>
            @endif
        @endforeach
    @endforeach
    
                                                                                  
    
    
    
    
    
    
    
                                                                                     
                                                                                   </tbody> --}}
    
    
                                                                                   <tbody>
                                                                                   @php
    $hasFilter = request()->has('fromDate') && request()->has('toDate');
    $counter = 1;
    $hasActivityToday = false;
@endphp

@foreach($studentActivities as $index => $activity)
    @php
        $subActivities = json_decode($activity->sub_activities, true);
        $tooltip = is_array($subActivities) ? implode(', ', $subActivities) : '';
        $batchCount = is_array(json_decode($activity->batch_student, true)) ? count(json_decode($activity->batch_student, true)) : 0;
    @endphp

    @foreach($activity->activities as $scheduled)
        @php
            $activityDate = \Carbon\Carbon::parse($scheduled['date']);
        @endphp

        @if(($hasFilter && $activityDate->between(\Carbon\Carbon::parse(request('fromDate')), \Carbon\Carbon::parse(request('toDate')))) || (!$hasFilter && $activityDate->isToday()))
            @php $hasActivityToday = true; @endphp

            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $activityDate->format('d-m-Y') }}</td>
                <td>
                    <div 
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        title="{{ $tooltip }}">
                        {{ strtoupper($activity->activity) }}
                    </div>
                </td>
                <td>{{ ucwords($activity->trainerRelation->name) }}</td>
                <td>
                    {{ \Carbon\Carbon::createFromFormat('H:i', $scheduled['start_time'])->format('h:i A') }}
                    -
                    {{ \Carbon\Carbon::createFromFormat('H:i', $scheduled['end_time'])->format('h:i A') }}
                </td>
                <td>
                    <span class="badge rounded-pill badge-light-secondary badgeborder-radius">
                        {{ $batchCount }}
                    </span>
                </td>
                <td>
                    @php
                        $startTimeStr = $scheduled['start_time'] ?? '00:00';
                        $endTimeStr = $scheduled['end_time'] ?? '00:00';
                        $activityDateStr = $scheduled['date'];
                
                        $startDateTime = \Carbon\Carbon::parse($activityDateStr . ' ' . $startTimeStr);
                        $endDateTime = \Carbon\Carbon::parse($activityDateStr . ' ' . $endTimeStr);
                        $currentDateTime = \Carbon\Carbon::now('Asia/Kolkata');
                        $currentTimeFormatted = $currentDateTime->format('h:i A');
                    @endphp
                
                  
                
                    @if(($currentTimeFormatted >=$startDateTime) && ( $currentTimeFormatted<=$endDateTime))
                        <span class="badge rounded-pill badge-light-info badgeborder-radius">Ongoing</span>
                    @elseif($currentDateTime->greaterThan($endDateTime))
                        <span class="badge rounded-pill badge-light-success badgeborder-radius">Closed</span>
                    @else
                        <span class="badge rounded-pill badge-light-warning badgeborder-radius">Upcoming</span>
                    @endif
                </td>
            </tr>
        @endif
    @endforeach
@endforeach

@if(!$hasActivityToday)
    <tr>
        <td colspan="12" class="text-center text-muted">No activity today</td>
    </tr>
@endif

                                                                                    </tbody>
                                                                                    
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="Schedule">
                                                                    <div class="table-responsive pomrnheadtffotsticky">
                                                                         <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad"> 
                                                                              <thead>
                                                                                 <tr>
                                                                                    <th>#</th>
                                                                                    <th>Activity</th>
                                                                                    <th>Trainer</th>
                                                                                    <th>Date</th>
                                                                                    <th>Time</th>
                                                                                    <th>Total Classes</th>
                                                                                    <th>Remaining</th>
                                                                                    <th>Attended</th>
                                                                                    <th>Absent</th>
                                                                                    <th>Status</th>
                                                                                  </tr>
                                                                                </thead>
                                                                                <tbody>
                                                           
                                                                                        @php
                                                                                          $hasPrevActivity=false;
                                                                                        @endphp
          
                                                                                       @foreach($previousStudentActivities as $index => $activity)
                                                                                       @php $hasPrevActivity = true; @endphp
                                                                                       <tr>
                                                                                           <td>{{ $loop->iteration }}</td>
                                                                                   
                                                                                           <td>
                                                                                               <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                                                                   title="{{ implode(', ', json_decode($activity->sub_activities, true) ?? []) }}">
                                                                                                   {{ $activity->activity ?? 'N/A' }}
                                                                                               </div>
                                                                                           </td>
                                                                                   
                                                                                           <td>{{ $activity->trainer ?? 'N/A' }}</td>
                                                                                   
                                                                                           <td>{{ \Carbon\Carbon::parse($activity->start_date)->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($activity->end_date)->format('d-m-Y') }}</td>
                                                                                   
                                                                                           <td>
                                                                                               @php
                                                                                                   $firstActivity = $activity->activities[0] ?? null;
                                                                                   
                                                                                                   if ($firstActivity) {
                                                                                                       $startTime = \Carbon\Carbon::createFromFormat('H:i', $firstActivity['start_time'])->format('h:i A');
                                                                                                       $endTime = \Carbon\Carbon::createFromFormat('H:i', $firstActivity['end_time'])->format('h:i A');
                                                                                                       echo $startTime . ' - ' . $endTime;
                                                                                                   } else {
                                                                                                       echo 'N/A';
                                                                                                   }
                                                                                               @endphp
                                                                                           </td>
                                                                                   
                                                                                           <td>{{ $activity->activity_occurrences }}</td>
                                                                                   
                                                                                           <td>{{ $activity->remaining_count ?? 0 }}</td>
                                                                                   
                                                                                           <td>{{ $activity->attended_count ?? 0 }}</td>
                                                                                   
                                                                                           <td>{{ $activity->absent_count ?? 0 }}</td>
                                                                                   
                                                                                        <td>
                                                                                            @php
                                                                                                $now = \Carbon\Carbon::now('Asia/Kolkata');
                                                                                                $isOngoing = false;
                                                                                        
                                                                                                foreach ($activity->activities ?? [] as $act) {
                                                                                                    $start = \Carbon\Carbon::parse($act['date'] . ' ' . $act['start_time']);
                                                                                                    $end = \Carbon\Carbon::parse($act['date'] . ' ' . $act['end_time']);
                                                                                                    
                                                                                                    if ($now->between($start, $end)) {
                                                                                                        $isOngoing = true;
                                                                                                        break; 
                                                                                                    }
                                                                                                }
                                                                                        
                                                                                                $startDate = \Carbon\Carbon::parse($activity->start_date);
                                                                                                $endDate = \Carbon\Carbon::parse($activity->end_date);
                                                                                                // $isOngoingInRange = $now->between($startDate, $endDate);
                                                                                                $currentDateTime = \Carbon\Carbon::now('Asia/Kolkata');
                                                                                                $currentTimeFormatted = $currentDateTime->format('h:i A');
                                                                                                @endphp
                                                                                        
                                                                                        @if ($isOngoing || ($currentTimeFormatted>=$startDate||$currentTimeFormatted <= $end ))
                                                                                        <span class="badge rounded-pill badge-light-info badgeborder-radius">Ongoing</span>
                                                                                        
                                                                                            @else
                                                                                                <span class="badge rounded-pill badge-light-secondary badgeborder-radius">Completed</span>
                                                                                            @endif
                                                                                        </td>
    
                                                                                        {{-- <td>
                                                                                            @php
                                                                                              
                                                                                        
                                                                                                $now = \Carbon\Carbon::now('Asia/Kolkata');
                                                                                                $isOngoing = false;
                                                                                        
                                                                                              
                                                                                                foreach ($activity->activities ?? [] as $act) {
                                                                                                    $start =  \Carbon\Carbon::parse($act['date'] . ' ' . $act['start_time']);
                                                                                                    $end = \Carbon\Carbon::parse($act['date'] . ' ' . $act['end_time']);
                                                                                        
                                                                                                    if ($now->between($start, $end)) {
                                                                                                        $isOngoing = true;
                                                                                                        break;
                                                                                                    }
                                                                                                }
                                                                                        
                                                                                                $startDate =  \Carbon\Carbon::parse($activity->start_date);
                                                                                                $endDate = \Carbon\Carbon::parse($activity->end_date);
                                                                                                $dayMap = [
                                                                                                    'Sunday' => 0,
                                                                                                    'Monday' => 1,
                                                                                                    'Tuesday' => 2,
                                                                                                    'Wednesday' => 3,
                                                                                                    'Thursday' => 4,
                                                                                                    'Friday' => 5,
                                                                                                    'Saturday' => 6,
                                                                                                ];
                                                                                        
                                                                                                $days = json_decode($activity->day, true); 
                                                                                        
                                                                                                $lastSessionDate = null;
                                                                                        
                                                                                                $period =  \Carbon\CarbonPeriod::create($startDate, $endDate);
                                                                                        
                                                                                                foreach ($period as $date) {
                                                                                                    $dayOfWeek = $date->dayOfWeek;
                                                                                        
                                                                                                    foreach ($days as $dayName => $timeRange) {
                                                                                                        if ($dayOfWeek === $dayMap[$dayName]) {
                                                                                                            $lastSessionDate = $date->copy();
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                        
                                                                                                $lastSessionEnd = null;
                                                                                        
                                                                                                if ($lastSessionDate) {
                                                                                                    $lastDayName = $lastSessionDate->format('l');
                                                                                                    $lastEndTime = $days[$lastDayName]['end_time'] ?? '23:59';
                                                                                                    $lastSessionEnd =  \Carbon\Carbon::parse($lastSessionDate->format('Y-m-d') . ' ' . $lastEndTime);
                                                                                                }
                                                                                        
                                                                                                $isCompleted = !$isOngoing && ($lastSessionEnd && $now->greaterThan($lastSessionEnd));
                                                                                            @endphp
                                                                                        
                                                                                            @if ($isOngoing)
                                                                                                <span class="badge rounded-pill badge-light-info badgeborder-radius">Ongoing</span>
                                                                                            @elseif($isCompleted)
                                                                                                <span class="badge rounded-pill badge-light-secondary badgeborder-radius">Completed</span>
                                                                                            @else
                                                                                                <span class="badge rounded-pill badge-light-warning badgeborder-radius">Upcoming</span>
                                                                                            @endif
                                                                                        </td> --}}
                                                                                        
                                                                                        
                                                                                       
                                                                                        
                                                                                        
                                                                                       </tr>
                                                                                   @endforeach
                                                                                   @if(!$hasPrevActivity)
    <tr>
        <td colspan="12" class="text-center text-muted">No  Previous Activity </td>
    </tr>
@endif

                                                                                   

                                                                                   
                                                                                   
                                                                                   </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                 
                                                         </div>
                                                     
    
    
    
    
    
    
    
                                                </div> 
    
                                             </div> 
                                </div>
                            </div>
    
                        </div>
                        
                         
                        
                    </div>
                            </div>
                    @endif
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


<!-- Main Fee Modal -->
{{-- <div class="modal fade" id="sponsor" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
        <div class="modal-content">
            <div class="modal-header p-0 bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-2 mx-50 pb-2">
                <h1 class="text-center mb-1" id="shareProjectTitle">View Fees Structure</h1>
                <p class="text-center">View the details below.</p>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fee Title</th>
                                <th>Total Fees</th>
                                <th>Fee Discount %</th>
                                <th>Fee Discount Value</th>
                                <th>Net Fee Payable</th>
                                <th>Payment Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $onetimefees=0;
                            @endphp
                            @foreach($feeDetails as $index => $fee)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $fee['title'] }}</td>
                                    <td>{{ number_format($fee['total_fees'], 2) }}</td>
                                    <td>{{ $fee['fee_discount_percent'] }}%</td>
                                    <td>{{ number_format($fee['fee_discount_value'], 2) }}</td>
                                    <td>{{ number_format($fee['net_fee_payable'], 2) }}</td>
                                    <td>
                                        @if(isset($fee['payment_mode']) && $fee['payment_mode'] === 'Monthly' && $fee['mandatory'])

                                            <button class="btn btn-sm btn-primary view-schedule-btn"
                                                    data-fee-id="{{ $index }}"
                                                    data-user-id="{{ $user->id }}"
                                                    data-total-amount="{{ $fee['net_fee_payable'] }}"
                                                    data-duration="{{ $fee['duration'] }}"
                                                    data-fee-head="{{ $fee['title'] }}">

                                                View Schedule
                                            </button>
                                        @else
                                            One-time Payment
                                        @endif

                                        @php
                                         $totalFees1 = floatval($fee['total_fees'] ?? 0);
                                           $feeDiscountPercent =$fee['fee_discount_percent'];
                                            $feeDiscountValue = $fee['fee_discount_value'] ?? ($totalFees1 * $feeDiscountPercent / 100);
                                           $netFee =   $totalFees1- $feeDiscountValue;
                                        if(isset($fee['payment_mode']) && $fee['payment_mode'] != 'Monthly' && $fee['mandatory']){
                                        $onetimefees+= $netFee;
                                        }
                                      
                                        @endphp
                                      
                                    </td>
                                </tr>

                            @endforeach

                            <tr>
                                
                                <td colspan="2" class="text-end fw-bolder text-dark ">Total Fees</td>
                                <td>{{ number_format($totalFees, 2) }}</td>
                         
                                <td colspan="2" class="text-end fw-bolder text-dark ">One Time PayableFee</td>
                                <td id="onetime">{{  number_format($onetimefees , 2) }}</td>
                                <td colspan="2">
                                    <button class="btn btn-sm btn-success pay-monthly-btn" style="padding: 6px">
                                        Pay Now
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


  

<!-- Monthly Schedule Modal -->
<div class="modal fade" id="monthlyScheduleModal" tabindex="-1" aria-labelledby="monthlyScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="monthlyScheduleModalLabel">Monthly Payment Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody id="scheduleTableBody">
                            <!-- JS will populate rows -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}




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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#fp-range", {
            mode: "range",
            dateFormat: "d-m-Y",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    document.getElementById("fromDate").value = instance.formatDate(selectedDates[0], "d-m-Y");
                    document.getElementById("toDate").value = instance.formatDate(selectedDates[1], "d-m-Y");

                    document.getElementById("filterForm").submit();
                }
            }
        });
    });
</script>



    
<!-- <script type="text/javascript">
    let selectedSchedules = {};
    let scheduleDataGlobal = {};

    function populateSchedule(feeId, userId, totalAmount, duration, feeHead) {
        const scheduleTableBody = document.getElementById('scheduleTableBody');
        scheduleTableBody.innerHTML = '';

        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        const scheduleData = [];
        const monthlyAmount = (totalAmount / duration).toFixed(2);

        for (let i = 0; i < duration; i++) {
            const dueDate = new Date();
            dueDate.setMonth(dueDate.getMonth() + i);
            const index = i + 1;

            scheduleData.push({
                index: index,
                month: monthNames[dueDate.getMonth()],
                dueDate: dueDate.toISOString().split('T')[0],
                amount: monthlyAmount,
                status: 'Pending',
                feeHead: feeHead
            });
        }

        scheduleDataGlobal[feeHead] = scheduleData;
        selectedSchedules[feeHead] = [];

        // scheduleData.forEach((schedule) => {
        //     const row = document.createElement('tr');
        //     row.innerHTML = `
        //         <td>${schedule.month}</td>
        //         <td>${schedule.dueDate}</td>
        //         <td>${schedule.amount}</td>
        //         <td>${schedule.status}</td>
        //         <td><input type="checkbox" class="select-payment" 
        //                 data-fee-head="${schedule.feeHead}" 
        //                 data-index="${schedule.index}" 
        //                 data-amount="${schedule.amount}" 
        //                 data-due-date="${schedule.dueDate}" 
        //                 data-month="${schedule.month}" /></td>
        //     `;
        //     scheduleTableBody.appendChild(row);
        // });
        scheduleDataGlobal[feeHead] = scheduleData;

if (!selectedSchedules[feeHead]) {
    selectedSchedules[feeHead] = [];
}

scheduleData.forEach((schedule) => {
    const isChecked = selectedSchedules[feeHead]?.some(item => item.index === schedule.index);

    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${schedule.month}</td>
        <td>${schedule.dueDate}</td>
        <td>${schedule.amount}</td>
        <td>${schedule.status}</td>
        <td><input type="checkbox" class="select-payment" 
                data-fee-head="${schedule.feeHead}" 
                data-index="${schedule.index}" 
                data-amount="${schedule.amount}" 
                data-due-date="${schedule.dueDate}" 
                data-month="${schedule.month}"
                ${isChecked ? 'checked' : ''} /></td>
    `;
    scheduleTableBody.appendChild(row);
});

    }


    
    document.querySelectorAll('.view-schedule-btn').forEach(button => {
        button.addEventListener('click', function () {
            const feeId = this.getAttribute('data-fee-id');
            const userId = this.getAttribute('data-user-id');
            const totalAmount = parseFloat(this.getAttribute('data-total-amount'));
            const duration = parseInt(this.getAttribute('data-duration'));
            const feeHead = this.getAttribute('data-fee-head');

            populateSchedule(feeId, userId, totalAmount, duration, feeHead);
            $('#monthlyScheduleModal').modal('show');
            document.getElementById('confirmPayment').setAttribute('data-user-id', userId);
        });
    });

    document.getElementById('scheduleTableBody').addEventListener('change', function (event) {
        if (event.target.classList.contains('select-payment')) {
            const checkbox = event.target;
            const feeHead = checkbox.getAttribute('data-fee-head');

            if (!selectedSchedules[feeHead]) {
                selectedSchedules[feeHead] = [];
            }

            const scheduleObj = {
                index: parseInt(checkbox.getAttribute('data-index')),
                month: checkbox.getAttribute('data-month'),
                due_date: checkbox.getAttribute('data-due-date'),
                amount: parseFloat(checkbox.getAttribute('data-amount')),
                payment_date: new Date().toISOString().split('T')[0],
                payment_time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                status: 'notconfirm'
            };

            if (checkbox.checked) {
                selectedSchedules[feeHead].push(scheduleObj);
            } else {
                selectedSchedules[feeHead] = selectedSchedules[feeHead].filter(item => item.index !== scheduleObj.index);
            }
        }
    });

    document.querySelector('.pay-monthly-btn').addEventListener('click', function () {
        let hasSelection = Object.values(selectedSchedules).some(arr => arr.length > 0);
        if (!hasSelection) {
            alert("Please select at least one month to proceed with payment.");
            return;
        }
        $('#paymentModal').modal('show');
    });

    document.getElementById('paymentMode').addEventListener('change', function () {
        const paymentMode = this.value;
        document.getElementById('upiSection').style.display = (paymentMode === 'UPI') ? 'block' : 'none';
        document.getElementById('impsSection').style.display = (paymentMode === 'IMPS') ? 'block' : 'none';
    });

    document.getElementById('confirmPayment').addEventListener('click', function () {
        const paymentMode = document.getElementById('paymentMode').value;
        const userId = this.getAttribute('data-user-id');

        if (!paymentMode) {
            alert("Please select a payment mode.");
            return;
        }

        let hasData = Object.values(selectedSchedules).some(arr => arr.length > 0);
        if (!hasData) {
            alert("No months selected for payment.");
            return;
        }

        const paidAmount = Object.values(selectedSchedules)
            .flat()
            .reduce((acc, item) => acc + parseFloat(item.amount), 0);

        $('#confirmPayment').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');

        const paymentData = {
            _token: '{{ csrf_token() }}',
            user_id: userId,
            payment_mode: paymentMode,
            fee_heads: JSON.stringify(selectedSchedules),
            paid_amount: paidAmount
        };

        $.ajax({
            url: "{{ url('update-payment-status') }}",
            type: "POST",
            data: paymentData,
            success: function (response) {
                if (response.success) {
                    toastr.success(`Payment via ${paymentMode} was successful`, 'Success');
                    $('#paymentModal').modal('hide');
                    $('.pay-now-btn').replaceWith('<span class="badge bg-success">Paid</span>');
                } else {
                    toastr.error(response.message || 'Payment failed.', 'Error');
                }
            },
            error: function (xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
                toastr.error(errorMessage, 'Error');
            },
            complete: function () {
                $('#confirmPayment').prop('disabled', false).html('Confirm Payment');
            }
        });
    });


</script> -->

{{-- <script>
let selectedSchedules = {};
let scheduleDataGlobal = {};
let Onetime = {{ json_encode($onetimefees) }};

const paidData = {!! json_encode($existingData) !!};



let currentFeeId = null;
let currentUserId = null;
let currentTotalAmount = null;
let currentDuration = null;
let currentFeeHead = null;

function populateSchedule(feeId, userId, totalAmount, duration, feeHead) {
    currentFeeId = feeId;
    currentUserId = userId;
    currentTotalAmount = totalAmount;
    currentDuration = duration;
    currentFeeHead = feeHead;

    const scheduleTableBody = document.getElementById('scheduleTableBody');
    scheduleTableBody.innerHTML = '';

    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];

    const scheduleData = [];
    const monthlyAmount = (totalAmount / duration).toFixed(2);

    for (let i = 0; i < duration; i++) {
        const dueDate = new Date();
        dueDate.setMonth(dueDate.getMonth() + i);
        const index = i + 1;

        scheduleData.push({
            index: index,
            month: monthNames[dueDate.getMonth()],
            dueDate: dueDate.toISOString().split('T')[0],
            amount: monthlyAmount,
            status: 'Pending',
            feeHead: feeHead
        });
    }

    scheduleDataGlobal[feeHead] = scheduleData;
    if (!selectedSchedules[feeHead]) {
        selectedSchedules[feeHead] = [];
    }

    scheduleData.forEach((schedule) => {
        const isChecked = selectedSchedules[feeHead].some(item => item.index === schedule.index);
        const scheduleList = paidData[feeHead]?.schedule || [];
        const paidItem = scheduleList.find(item => item.index === schedule.index);
const isPaid = paidItem && paidItem.status.toLowerCase() === 'paid';
const isWaiting = paidItem && paidItem.status.toLowerCase() === 'waiting for confirmation';

if (isPaid) {
    const onetimeEl = document.getElementById('onetime');
    if (onetimeEl) {
        onetimeEl.innerText = '0';
    }
    Onetime = 0;
}
// console.log(isPaid);

       
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${schedule.month}</td>
            <td>${schedule.dueDate}</td>
            <td>${schedule.amount}</td>
            <td>
    <span class="badge ${isPaid ? 'bg-success' : isWaiting ? 'bg-info text-dark' : 'bg-warning text-dark'}">
        ${isPaid ? 'Paid' : isWaiting ? 'Waiting for Confirmation' : schedule.status}
    </span>
</td>
<td>
    <input type="checkbox" class="select-payment" 
        data-fee-head="${schedule.feeHead}" 
        data-index="${schedule.index}" 
        data-amount="${schedule.amount}" 
        data-due-date="${schedule.dueDate}" 
        data-month="${schedule.month}"
        ${isChecked || isPaid || isWaiting ? 'checked' : ''} 
        ${isPaid || isWaiting ? 'disabled' : ''} />
</td>


        `;
        scheduleTableBody.appendChild(row);
    });

    
}

document.querySelectorAll('.view-schedule-btn').forEach(button => {
    button.addEventListener('click', function () {
        const feeId = this.getAttribute('data-fee-id');
        const userId = this.getAttribute('data-user-id');
        const totalAmount = parseFloat(this.getAttribute('data-total-amount'));
        const duration = parseInt(this.getAttribute('data-duration'));
        const feeHead = this.getAttribute('data-fee-head');

        populateSchedule(feeId, userId, totalAmount, duration, feeHead);
        $('#monthlyScheduleModal').modal('show');
        document.getElementById('confirmPayment').setAttribute('data-user-id', userId);
    });
});

document.getElementById('scheduleTableBody').addEventListener('change', function (event) {
    if (event.target.classList.contains('select-payment')) {
        const checkbox = event.target;
        const feeHead = checkbox.getAttribute('data-fee-head');

        if (!selectedSchedules[feeHead]) {
            selectedSchedules[feeHead] = [];
        }

        const scheduleObj = {
            index: parseInt(checkbox.getAttribute('data-index')),
            month: checkbox.getAttribute('data-month'),
            due_date: checkbox.getAttribute('data-due-date'),
            amount: parseFloat(checkbox.getAttribute('data-amount')),
            payment_date: new Date().toISOString().split('T')[0],
            payment_time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
            status: 'notconfirm'
        };

        if (checkbox.checked) {
            if (!selectedSchedules[feeHead].some(item => item.index === scheduleObj.index)) {
                selectedSchedules[feeHead].push(scheduleObj);
            }
        } else {
            selectedSchedules[feeHead] = selectedSchedules[feeHead].filter(item => item.index !== scheduleObj.index);
        }
    }
});

document.querySelector('.pay-monthly-btn').addEventListener('click', function () {
    let hasSelection = Object.values(selectedSchedules).some(arr => arr.length > 0);
    if (!hasSelection) {
        alert("Please select at least one month to proceed with payment.");
        return;
    }
    $('#paymentModal').modal('show');
});

document.getElementById('paymentMode').addEventListener('change', function () {
    const paymentMode = this.value;
    document.getElementById('upiSection').style.display = (paymentMode === 'UPI') ? 'block' : 'none';
    document.getElementById('impsSection').style.display = (paymentMode === 'IMPS') ? 'block' : 'none';
});

document.getElementById('confirmPayment').addEventListener('click', function () {
    const paymentMode = document.getElementById('paymentMode').value;
    const userId = this.getAttribute('data-user-id');

    if (!paymentMode) {
        alert("Please select a payment mode.");
        return;
    }

    let hasData = Object.values(selectedSchedules).some(arr => arr.length > 0);
    if (!hasData) {
        alert("No months selected for payment.");
        return;
    }

    let paidAmount = Object.values(selectedSchedules)
        .flat()
        .reduce((acc, item) => acc + parseFloat(item.amount), 0);

       

    $('#confirmPayment').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');
    if (Onetime > 0) {
        paidAmount += Onetime;
    }

    const paymentData = {
        _token: '{{ csrf_token() }}',
        user_id: userId,
        payment_mode: paymentMode,
        fee_heads: JSON.stringify(selectedSchedules),
        paid_amount: paidAmount
    };

    $.ajax({
        url: "{{ url('update-payment-status') }}",
        type: "POST",
        data: paymentData,
        success: function (response) {
            if (response.success) {
                toastr.success(`Payment via ${paymentMode} was successful`, 'Success');
                $('#paymentModal').modal('hide');

                // Update paidData with the newly paid months
                Object.entries(selectedSchedules).forEach(([feeHead, schedules]) => {
        if (!paidData[feeHead]) {
            paidData[feeHead] = {
                duration: currentDuration,
                schedule: []
            };
        }

        schedules.forEach(schedule => {
            const existing = paidData[feeHead].schedule;
            if (!existing.some(p => p.index === schedule.index)) {
                existing.push({ 
                    ...schedule, 
                    status: 'Waiting for Confirmation' 
                });
            }
        });
    });
   
    if (Onetime > 0) {
                    document.getElementById('onetime').innerText = 0;
                    Onetime = 0; // Prevent re-adding
                }



             
                // Clear selected schedules because payment confirmed
                selectedSchedules = {};

                // Refresh the current schedule modal with updated paidData
                if (currentFeeHead !== null) {
                    populateSchedule(currentFeeId, currentUserId, currentTotalAmount, currentDuration, currentFeeHead);
                }

            } else {
                toastr.error(response.message || 'Payment failed.', 'Error');
            }
        },
        error: function (xhr) {
            const errorMessage = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
            toastr.error(errorMessage, 'Error');
        },
        complete: function () {
            $('#confirmPayment').prop('disabled', false).html('Confirm Payment');
        }
    });

});
</script> --}}


<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-schedule').forEach(icon => {
        icon.addEventListener('click', function () {
            const dueDate = this.getAttribute('data-date');
            const items = JSON.parse(this.getAttribute('data-items'));
            const remaining = parseFloat(this.getAttribute('data-remaining')) || 0;

            console.log("Remaining:", remaining);
            console.log("Items:", items);

            // If remaining is 0, mark all statuses as 'Paid'
            if (remaining === 0) {
                items.forEach(item => {
                    item.status = 'Paid';
                });
            }

            document.getElementById('modalDueDate').textContent = "Due Date: " + new Date(dueDate).toLocaleDateString();
            const tbody = document.getElementById('modalFeeDetails');
            tbody.innerHTML = '';

            items.forEach((item, index) => {
                if (item.status === 'notconfirm') {
                    item.status = 'Confirmation required';
                }

                let statusClass = 'bg-warning text-dark';
                if (item.status === 'Paid') {
                    statusClass = 'bg-success';
                } else if (item.status === 'Partial') {
                    statusClass = 'bg-info text-dark';
                } else if (item.status === 'Confirmation required') {
                    statusClass = 'bg-secondary text-white';
                }

                const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.feeHead}</td>
                    <td>${item.type}</td>
                    <td>₹${parseFloat(item.amount).toFixed(2)}</td>
                    <td>₹${parseFloat(item.paid_amount).toFixed(2)}</td>
                    <td><span class="badge ${statusClass}">${item.status}</span></td>
                </tr>`;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        });
    });
});
</script>



<script>
let selectedPayments = [];

$(document).ready(function () {
    $('.due-check').on('change', function () {
        const dueDate = $(this).data('date');
        const feeItems = JSON.parse($(this).attr('data-items'));

        const formattedDueDate = new Date(dueDate).toLocaleDateString('en-GB');
        const currentDate = new Date();
        const formattedDateTime = currentDate.toLocaleString('en-GB', {
            day: '2-digit', month: '2-digit', year: 'numeric',
            hour: '2-digit', minute: '2-digit', second: '2-digit',
            hour12: false
        });

        if ($(this).is(':checked')) {
            feeItems.forEach(item => {
                item.status = 'notconfirm';
                item.due_date = formattedDueDate;
                item.selected_at = formattedDateTime;

                const key = `${item.due_date}-${item.feeHead}`;
                const exists = selectedPayments.find(sp => `${sp.due_date}-${sp.feeHead}` === key);

                if (!exists) selectedPayments.push(item);
            });
        } else {
            // Remove unchecked
            feeItems.forEach(item => {
                selectedPayments = selectedPayments.filter(sp =>
                    !(sp.due_date === formattedDueDate && sp.feeHead === item.feeHead)
                );
            });
        }

        console.log('Selected:', selectedPayments);
    });

  $(document).ready(function () {
    let userId = null;

    $('#payNowBtn').on('click', function () {
        userId = $(this).data('user-id');

        if (selectedPayments.length === 0) {
            toastr.info("Please select at least one due month.");
            return;
        }

        // Show confirmation modal
        $('#confirmPayModal').modal('show');
    });

    // Handle confirmation modal's "Yes, Pay Now" button
    $('#confirmPaymentBtn').on('click', function () {
        $('#confirmPayModal').modal('hide');

        $.ajax({
            url: "{{ url('update-payment-status') }}",
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: JSON.stringify({
                user_id: userId,
                payments: selectedPayments
            }),
            success: function (response) {
                if (response.success) {
                    toastr.success("Payment submitted successfully!");

                    $('.due-check:checked:not(:disabled)').each(function () {
                        $(this).prop('disabled', true);

                        const row = $(this).closest('tr');
                        const badge = row.find('span.badge');
                        badge
                            .removeClass()
                            .addClass('badge bg-secondary text-white')
                            .text('Confirmation required');
                    });

                    selectedPayments = [];

                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    toastr.error("Failed to submit payment.");
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                toastr.error("Something went wrong.");
            }
        });
    });
});

});

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000"
};
</script>



<script>
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
                        toastr.success(response.message, 'Success');

                        // Close modal after 1.5 seconds
                        setTimeout(function() {
                            $('#update-payment').modal('hide');
                        }, 1500);
                    } else {
                        toastr.error(response.message, 'Error');
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred while processing your request.';
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

        $('#update-payment').on('hidden.bs.modal', function() {
            $('#paymentForm')[0].reset();
        });
    });
</script>
@endsection

