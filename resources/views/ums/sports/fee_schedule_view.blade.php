@extends('ums.sports.sports-meta.admin-sports-meta')

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
                                <h2 class="content-header-title float-start mb-0">View Fee Master</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('sports-fee-schedule')}}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active">View</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                         
                            <div class="form-group breadcrumb-right">
                                <button class="btn btn-secondary btn-sm mb-50 mb-sm-0" onClick="window.location.href='{{ url('sports-fee-schedule') }}'">
                                    <i data-feather="arrow-left-circle"></i> Back
                                </button>
                                
                              
                            </div>
                        </div>
                </div>
            </div>
            <div class="content-body">



                <section id="basic-datatable">

                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body customernewsection-form">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="newheader  border-bottom mb-2 pb-25">
                                                <h4 class="card-title text-theme">Basic Information</h4>
                                                <p class="card-text">Fill the details</p>
                                            </div>
                                        </div>
                           
                                     
                                        <div class="col-md-8">
                                            <!-- Series Dropdown -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Series <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="book_id" id="series" required>
                                                        <option value="" disabled>Select</option>
                                                        @foreach ($series as $ser)
                                                        <option value="{{ $ser->id }}" {{ $sportFeeMaster->book_id == $ser->id ? 'selected' : '' }}>{{ $ser->book_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
    
                                            <!-- Schedule No. -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Schedule No. <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="document_number"
                                                        value="{{ old('schedule_no', $sportFeeMaster->document_number ?? '') }}" />
                                                </div>
                                            </div>
    
                                            <!-- Admission Year -->
                                            {{-- <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Admission Yr. <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="document_date" class="form-control"
                                                        value="{{ old('admission_year', $sportFeeMaster->document_date ?? '') }}">
                                                </div>
                                            </div> --}}
    
                                            <!-- Sport Name -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Sport Name <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="sport_name">
                                                        <option value="" selected>-----Select-----</option>
                                                        @foreach ($sportmaster as $sport)
                                                        <option value="{{ $sport->sport_name }}"
                                                            {{ old('sport_name', $sportFeeMaster->sport_name ?? '') == $sport->sport_name ? 'selected' : '' }}>
                                                            {{ ucfirst($sport->sport_name) }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
    
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="batch_year" id="batch_year">
                                                        <option value="" selected>-----Select Year-----</option>
                                                        @foreach ($batchs->pluck('batch_year')->unique() as $batch)
                                                        <option value="{{ $batch }}"
                                                            @if (isset($sportFeeMaster) && $sportFeeMaster->batch_year == $batch) selected @endif>
                                                            {{ ucfirst($batch) }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
    
    
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                </div>
                                            
                                                <div class="col-md-5">
                                                    <select class="form-select" name="batch_name" id="batch_name">
    
                                                        <option value="" selected>-----Select Batch-----</option>
                                                        @foreach ($batchs as $batch)
                                                        <option value="{{ $batch->batch_name }}" 
                                                            @if (isset($sportFeeMaster) && $sportFeeMaster->batch == $batch->batch_name) selected @endif>
                                                            {{ ucfirst($batch->batch_name) }}
                                                        </option>
                                                    @endforeach
    
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section</label><span
                                                    class="text-danger">*</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="section" id="section">
                                                        <option value="" selected>-----Select Section-----</option>
                                                        @if (isset($sportFeeMaster))
                                                        <option value="{{ $sportFeeMaster->section }}" selected>
                                                            {{ $sportFeeMaster->section }}
                                                        </option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
    
    
    
    
    
                                            <!-- Section -->
    
                                            <!-- Quota -->
    
    
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Quota <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="quota">
                                                        <option value="" selected>-----Select-----</option>
                                                        @foreach ($quotas as $quota)
                                                        <option value="{{ $quota->quota_name }}"
                                                            {{ old('quota', $sportFeeMaster->quota ?? '') == $quota->quota_name ? 'selected' : '' }}>
                                                            {{ ucfirst($quota->quota_name) }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Start & End Date <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5 d-flex gap-2">
                                                    <input type="date" name="start_date" class="form-control" id="start_date" value="{{$sportFeeMaster->start_date}}" required />
                                                    <input type="date" name="end_date" class="form-control" id="end_date" value="{{$sportFeeMaster->end_date}}" required />
                                                </div>
                                            </div>
    
                                            <div class="row align-items-center mb-2">
                                                <div class="col-md-3">
                                                        <label class="form-label">Display <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                       
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3" name="display"
                                                                    class="form-check-input"  value="1"
                                                                     checked=  {{ old('display', $sportFeeMaster->display ?? '') == '1' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="customColorRadio3">Enable</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio4" name="display" value="0"
                                                                    class="form-check-input"
                                                                    {{ old('display', $sportFeeMaster->display ?? '') == '0' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="customColorRadio4">Disable</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
    
                                            <!-- Hidden fee_details input -->
                                            <input type="hidden" name="fee_details" id="form_details">
                                        
                                            <!-- Status (Radio Buttons) -->
                                            <div class="col-md-4 border-start">
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3" name="status" class="form-check-input" value="Active"
                                                                       {{ old('status', $sportFeeMaster->status ?? '') == 'Active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio4" name="status" value="Inactive" class="form-check-input"
                                                                       {{ old('status', $sportFeeMaster->status ?? '') == 'Inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        
                                    </div>





                                    <div class="mt-1">

                                        <div class="border-bottom mb-2 pb-25">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="newheader ">
                                                        <h4 class="card-title text-theme">Fee Item Detail</h4>
                                                        <p class="card-text">Fill the details</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-content pb-1">

                                            <div class="tab-pane active" id="other">
                                                <div class="table-responsive">
                                                    <table
                                                        class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Title</th>
                                                                <th>Total Fees</th>
                                                                <th>Fee Discount<br /> %</th>
                                                                <th>Fee Discount<br /> Value</th>
                                                                <th>Net Fee<br /> Payable Value</th>
                                                                <th>Mandatory</th>
                                                                <th>Payment Frequency</th>
                         


                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           @if (!empty($feeDetails) && is_array($feeDetails))
                                                        @foreach ($feeDetails as $key => $fees)
                                                            @php
                                                                $title = old("title.$key", $fees['title'] ?? '');
                                                                $total_fee = old("Total_fee.$key", $fees['total_fees'] ?? '');
                                                                $fee_discount = old("fee_discount.$key", $fees['fee_discount_percent'] ?? '');
                                                                $fee_discount_value = old("fee_discount_value.$key", $fees['fee_discount_value'] ?? '');
                                                                $net_fee = old("net_fee.$key", $fees['net_fee_payable_value'] ?? '');
                                                                $mandatory = old("guardian.$key", $fees['mandatory'] ?? false);
                                                                $payment_mode = old("payment_mode.$key", $fees['payment_mode'] ?? '');





                                                            @endphp

                                                            <tr id="fee_tr">
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    <input type="text" class="form-control mw-100" name="title[]" value="{{ $title }}" required/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mw-100" name="Total_fee[]" value="{{ $total_fee }}" required />
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mw-100" name="fee_discount[]" value="{{ $fee_discount }}" required />
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mw-100" name="fee_discount_value[]" value="{{ $fee_discount_value }}" />
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mw-100" name="net_fee[]" value="{{ $net_fee }}" />
                                                                </td>
                                                                <td>
                                                                    <div class="demo-inline-spacing">
                                                                        <div class="form-check form-check-primary mt-25">
                                                                            <input type="checkbox" id="guardian{{ $key }}" name="guardian[]" class="form-check-input" 
                                                                            {{ $mandatory ? 'checked' : '' }}>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select mw-100" name="payment_mode[]">
                                                                        <option value="" {{ $payment_mode == '' ? 'selected' : '' }}>Select</option>
                                                                        <option value="Weekly" {{ $payment_mode == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                                                        <option value="Monthly" {{ $payment_mode == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                                                        <option value="Quarterly" {{ $payment_mode == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                                                        <option value="Semi-Yearly" {{ $payment_mode == 'Semi-Yearly' ? 'selected' : '' }}>Semi-Yearly</option>
                                                                        <option value="Yearly" {{ $payment_mode == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                                                        <option value="One Time" {{ $payment_mode == 'One Time' ? 'selected' : '' }}>One Time</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="8" class="text-center">No fee details available.</td>
                                                        </tr>
                                                    @endif

                                                        
                                                        
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                               
                                                                
                                                                <td  colspan="1" class="fw-bold mw-100" style="color: black" >Total Fee:<span class="fw-bold" id="total_fee1">{{$fees['grand_total_fees']}}</span></td>
                                                               
                                                               
                                                                <td colspan="2" class="fw-bold " style="color: black" >Total Discount Value  :    <span class="fw-bold" id="fee_discount1">{{$fees['grand_total_discount']}}</span></td>
                                                               
                                                            
                                                                <td class="fw-bold " style="color: black">Total Payable:<span class="fw-bold" id="total_payable">{{$fees['grand_total_payable']}}</span></td>
                                                                <td colspan="3"></td>
                                                            </tr>
                                                        </tfoot>


                                                    </table>
                                                </div>


                                            </div>



                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                   
                </section>


            </div>
        </div>
    </div>
    <!-- END: Content-->
   
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

     <script>
        function makeReadOnly() {
            const elements = document.querySelectorAll('input, select, textarea');
            elements.forEach(element => {
                element.disabled = true;  
            });
        }
        window.onload = makeReadOnly();
    </script>


  

   
    
@endsection
