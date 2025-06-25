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
                        <div class="col-xl-4 col-lg-5 col-md-5 col  order-md-0">
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
                                           @php
    $guardian = null;
    $nameToShow = 'N/A';
    $emailToShow = 'N/A';
    $contactToShow = 'N/A';

    if ($familyDetails instanceof \Illuminate\Support\Collection) {
        $guardian = $familyDetails->first(function ($item) {
            return $item->is_guardian == 1;
        });

        $firstMember = $familyDetails->first();

        $nameToShow = $guardian->name ?? ($firstMember->name ?? 'N/A');
        $emailToShow = $guardian->email ?? ($firstMember->email ?? 'N/A');
        $contactToShow = $guardian->contact_no ?? ($firstMember->contact_no ?? 'N/A');

    } elseif (is_object($familyDetails)) {
        $nameToShow = $familyDetails->name ?? 'N/A';
        $emailToShow = $familyDetails->email ?? 'N/A';
        $contactToShow = $familyDetails->contact_no ?? 'N/A';
    }
@endphp

<li class="mb-75">
    <span class="fw-bolder me-25">Guardian Name:</span>
    <span>{{ $nameToShow }}</span>
</li>
<li class="mb-75">
    <span class="fw-bolder me-25">Guardian No.:</span>
    <span>{{ $contactToShow }}</span>
</li>
<li class="mb-75">
    <span class="fw-bolder me-25">Guardian Email:</span>
    <span>{{ $emailToShow }}</span>
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


                                          
                                            @php
use Carbon\Carbon;

$feeItems = $feeDetails;

$monthlyGrouped = [];
$startDate = Carbon::parse($student->registration->doj);

$paidData = $existingData;     
$unpaidData = $UsersideData;   


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
                        $isDisabled =$paidItem['isDisabled'] ;
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
                $isDisabled = $paidItem['isDisabled'] ;
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
   <div class="table-responsive ">
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
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
        <input type="checkbox" class="due-check"
            data-date="{{ $dueDate }}"
            data-items='@json($items)'
            data-total="{{ $total }}"
            {{ $isDisabled ? 'checked disabled' : '' }}>

        <i class="fa fa-eye text-primary mt-1 mt-md-0 ms-md-2 view-schedule"
            style="cursor:pointer"
            data-bs-toggle="modal"
            data-bs-target="#feeDetailModal"
            data-date="{{ $dueDate }}"
            data-items='@json($items)'
            data-remaining="{{ $remaining }}"
            title="View Fee Schedule">
        </i>
    </div>
</td>

            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td colspan="2"><strong>Total Amount: ₹{{ number_format($total_amount, 2) }}</strong></td>
            <td colspan="2"><strong>Paid Amount: ₹{{ number_format($paidAmount, 2) }}</strong></td>
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
</div>
</div>
</div>



<div class="modal fade" id="confirmPayModal" tabindex="-1" aria-labelledby="confirmPayModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-3">
      <form id="paymentForm" enctype="multipart/form-data" method="POST">
        <div class="modal-header bg-primary text-white rounded-top">
          <h5 class="modal-title text-white"  id="confirmPayModalLabel">Confirm Payment</h5>
          <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <p class="text-center fw-semibold text-danger mb-2 p-1">
            Are you sure you want to proceed with the payment?
          </p>

          <div class="mb-2">
            <label class="form-label">Payment Mode <span class="text-danger">*</span></label>
            <select class="form-select" id="paymentMode" name="pay_mode" required>
              <option value="">Select</option>
              <option value="IMPS/RTGS">IMPS/RTGS</option>
              <option value="NEFT">NEFT</option>
              <option value="By Cheque">By Cheque</option>
              <option value="UPI">UPI</option>
            </select>
          </div>

          <div class="mb-2" id="bankNameDiv" style="display:none;">
            <label class="form-label">Bank Name <span class="text-danger">*</span></label>
            <select class="form-select" name="bank_name" id="bank_name">
              <option value="">Select</option>
              <option value="HDFC Bank">HDFC Bank</option>
              <option value="ICICI Bank">ICICI Bank</option>
              <option value="Axis Bank">Axis Bank</option>
              <option value="State Bank of India">State Bank of India</option>
              <option value="Bank of Baroda">Bank of Baroda</option>
            </select>
          </div>
          {{-- <div class= "mb-2">
              <label class="form-label">Payment Document</label>
              <input type="file" class="form-control" name="pay_doc" id="pay_doc" accept="image*/" />
            </div> --}}

          <div class="mb-2" id="refNoDiv" style="display:none;">
            <label class="form-label">Reference No. <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="ref_no" id="ref_no" placeholder="Enter reference number">
          </div>

          <div id="upiSection" style="display:none;" class="text-center">
            <p class="mb-2 fw-semibold">Scan the QR code to make payment</p>
            <img src="{{ asset('sports/img/sampleqr.jpeg') }}" alt="UPI QR Code" class="img-fluid rounded shadow" style="max-width: 200px;">
          </div>
        </div>

        <div class="modal-footer bg-light rounded-bottom">
          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-sm" id="confirmPaymentBtn">Yes, Pay Now</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery Script -->


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

    const $confirmBtn = $('#confirmPaymentBtn');
  const $paymentMode = $('#paymentMode');
  const $bankNameDiv = $('#bankNameDiv');
  const $refNoDiv = $('#refNoDiv');
  const $bankName = $('#bank_name');
  const $refNo = $('#ref_no');
 

  // Initially disable the confirm button
  $confirmBtn.prop('disabled', true);

  function validateForm() {
    const mode = $paymentMode.val();

    if (!mode) {
      return false; // payment mode required
    }

    if (['IMPS/RTGS', 'NEFT', 'By Cheque'].includes(mode)) {
      if (!$bankName.val() || !$refNo.val().trim()) {
        return false;
      }
    }

    return true;
  }

  $paymentMode.on('change', function () {
    const mode = $(this).val();

    $bankNameDiv.hide();
    $refNoDiv.hide();

    $bankName.prop('required', false);
    $refNo.prop('required', false);

    if (mode === 'UPI') {
      $('#upiSection').show();
    } else {
      $('#upiSection').hide();
    }

    if (['IMPS/RTGS', 'NEFT', 'By Cheque'].includes(mode)) {
      $bankNameDiv.show();
      $refNoDiv.show();

      $bankName.prop('required', true);
      $refNo.prop('required', true);
    }

    $confirmBtn.prop('disabled', !validateForm());
  });

  $bankName.on('input change', function () {
    $confirmBtn.prop('disabled', !validateForm());
  });

  $refNo.on('input change', function () {
    $confirmBtn.prop('disabled', !validateForm());
  });

  $('#confirmPayModal').on('shown.bs.modal', function () {
    $confirmBtn.prop('disabled', true);
    $paymentMode.val('');
    $bankNameDiv.hide();
    $refNoDiv.hide();
    $('#upiSection').hide();
    $bankName.val('');
    $refNo.val('');
  });

  


    $('#confirmPaymentBtn').on('click', function () {
         if (!validateForm()) {
      alert('Please fill all required fields correctly.');
      return;}
        $('#confirmPayModal').modal('hide');
           let payMode = $('#paymentMode').val();
          let bankName = $('#bank_name').val();
           let refNo = $('#ref_no').val();
           let pay_doc=$('#pay_doc').val();

        $.ajax({
            url: "{{ url('update-payment-status') }}",
            type: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: JSON.stringify({
                user_id: userId,
                 pay_mode: payMode,
                bank_name: bankName,
             ref_no: refNo,
             pay_doc:pay_doc,
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
$(document).ready(function () {
  $('#paymentMode').on('change', function () {
    const mode = $(this).val();

    $('#bankNameDiv, #refNoDiv, #upiSection').hide();
    $('#bank_name, #ref_no').prop('required', false);

    if (mode === 'UPI') {
      $('#upiSection').show();
    } else if (['IMPS/RTGS', 'NEFT', 'By Cheque'].includes(mode)) {
      $('#bankNameDiv, #refNoDiv').show();
      $('#bank_name, #ref_no').prop('required', true);
    }
  });

  $('#paymentForm').submit(function (e) {
    e.preventDefault();
    let payMode = $('#paymentMode').val();
    alert('Payment confirmed via ' + payMode);
    $('#confirmPayModal').modal('hide');
  });
});
</script>

@endsection

