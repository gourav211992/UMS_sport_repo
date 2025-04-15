@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
;
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
                            <h2 class="content-header-title float-start mb-0">Edit Fee Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('sports-fee-schedule') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <form action="{{ url('sports-fee-schedule/update/' . $sportFeeMaster->id) }}" method="POST">
                        @csrf
                        <div class="form-group breadcrumb-right">
                            <button onClick="javascript: history.go(-1)"
                                class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i>
                                Back</button>
                            <button type="submit" onClick="captureTableData()"
                                class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>
                                Submit</button>
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
                                                        <input type="radio" id="customColorRadio3" name="status"
                                                            class="form-check-input" value="Active"
                                                            {{ old('status', $sportFeeMaster->status ?? '') == 'Active' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bolder"
                                                            for="customColorRadio3">Active</label>
                                                    </div>
                                                    <div class="form-check form-check-primary mt-25">
                                                        <input type="radio" id="customColorRadio4" name="status"
                                                            value="Inactive" class="form-check-input"
                                                            {{ old('status', $sportFeeMaster->status ?? '') == 'Inactive' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bolder"
                                                            for="customColorRadio4">Inactive</label>
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
                                                            <th width="150px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- <tr id="fee_tr">
                                                                <td>1</td>
                                                                <td><input type="text" class="form-control mw-100" name="title" value="{{ old('title', $feeDetails[0]['title'] ?? '') }}" required/></td>
                                                        <td><input type="text" class="form-control mw-100" name="Total_fee" value="{{ old('Total_fee', $feeDetails[0]['total_fees'] ?? '') }}" required /></td>
                                                        <td><input type="text" class="form-control mw-100" name="fee_discount" value="{{ old('fee_discount', $feeDetails[0]['fee_discount_percent'] ?? '') }}" required /></td>
                                                        <td><input type="text" class="form-control mw-100" name="fee_discount_value" value="{{ old('fee_discount_value', $feeDetails[0]['fee_discount_value'] ?? '') }}" /></td>
                                                        <td><input type="text" class="form-control mw-100" name="net_fee" value="{{ old('net_fee', $feeDetails[0]['net_fee_payable_value'] ?? '') }}" /></td>
                                                        <td>
                                                            <div class="demo-inline-spacing">
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="checkbox" id="guardian1" name="guardian" {{ old('guardian', $feeDetails[0]['mandatory'] ?? false) ? 'checked' : '' }} class="form-check-input">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select class="form-select mw-100" name="payment_mode">
                                                                <option>Select</option>
                                                                @php
                                                                $paymentMode = old('payment_mode', $feeDetails[0]['payment_mode'] ?? ''); // Default to empty if not set
                                                                @endphp
                                                                <option value="Weekly" {{ $paymentMode == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                                                <option value="Monthly" {{ $paymentMode == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                                                <option value="Quarterly" {{ $paymentMode == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                                                <option value="Semi-Yearly" {{ $paymentMode == 'Semi-Yearly' ? 'selected' : '' }}>Semi-Yearly</option>
                                                                <option value="Yearly" {{ $paymentMode == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                                                <option value="One Time" {{ $paymentMode == 'One Time' ? 'selected' : '' }}>One Time</option>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-primary add-contact-row">
                                                                <i id="icon" data-feather="plus-square"></i>
                                                            </a>
                                                        </td>
                                                        </tr> --}}
                                                        @foreach ($feeDetails as $key => $fees)
                                                        <tr id="fee_tr" class="fee_tr">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                <select class="form-control mw-100" name="title" required style="width: 300px">
                                                                    <option value="" disabled>Select Title</option>
                                                                    @foreach ($fee_head as $head)
                                                                        <option value="{{ $head->fee_head }}" 
                                                                            @if (isset($fees) && $fees['title']== $head->fee_head) selected @endif>
                                                                            {{ $head->fee_head }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td><input type="text" class="form-control mw-100"
                                                                    name="Total_fee[]"
                                                                    value="{{ old('Total_fee.' . $key, $fees['total_fees'] ?? '') }}"
                                                                    id="total_fee"
                                                                    required /></td>
                                                            <td><input type="text" class="form-control mw-100"
                                                                    name="fee_discount[]"
                                                                    value="{{ old('fee_discount.' . $key, $fees['fee_discount_percent'] ?? '') }}"
                                                                    id="fee_discount"
                                                                    required /></td>
                                                            <td><input type="text" class="form-control mw-100"
                                                                    name="fee_discount_value[]"
                                                                    id="fee_discount_value"
                                                                   
                                                                    value="{{ old('fee_discount_value.' . $key, $fees['fee_discount_value'] ?? '') }}" />

                                                            </td>
                                                            <td><input type="text" class="form-control mw-100"
                                                                    name="net_fee[]"
                                                                    id="net_fee"
                                                                    readonly
                                                                    value="{{ old('net_fee.' . $key, $fees['net_fee_payable_value'] ?? '') }}" />
                                                            </td>
                                                            <td>
                                                                <div class="demo-inline-spacing">
                                                                    <div
                                                                        class="form-check form-check-primary mt-25">
                                                                        <input type="checkbox" id="guardian1"
                                                                            name="guardian[]"
                                                                            {{ old('guardian.' . $key, $fees['mandatory'] ?? false) ? 'checked' : '' }}
                                                                            class="form-check-input">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <select class="form-select mw-100" name="payment_mode[]" required>
                                                                    <option>Select</option>
                                                                    @php
                                                                    $paymentMode = old('payment_mode.' . $key, $fees['payment_mode'] ?? ''); // Handle undefined key safely
                                                                    @endphp
                                                                    <option value="Weekly" {{ $paymentMode == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                                                    <option value="Monthly" {{ $paymentMode == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                                                    <option value="Quarterly" {{ $paymentMode == 'Quarterly' ? 'selected' : '' }}>Quarterly</option>
                                                                    <option value="Semi-Yearly" {{ $paymentMode == 'Semi-Yearly' ? 'selected' : '' }}>Semi-Yearly</option>
                                                                    <option value="Yearly" {{ $paymentMode == 'Yearly' ? 'selected' : '' }}>Yearly</option>
                                                                    <option value="One Time" {{ $paymentMode == 'One Time' ? 'selected' : '' }}>One Time</option>
                                                                </select>
                                                            </td>

                                                            <td>

                                                                <a href="#"
                                                                    class="{{ $key == 0 ? 'text-primary add-contact-row' : 'text-danger delete-item' }}">
                                                                    <i id="icon"
                                                                        data-feather="{{ $key == 0 ? 'plus-square' : 'trash' }}"></i>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        @endforeach

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
                <!-- Modal to add new record -->
                </form>
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
    function captureTableData() {
        let tableData = [];
        let rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            let rowData = {
                title: row.querySelector('td:nth-child(2) select').value,
                total_fees: row.querySelector('td:nth-child(3) input').value,
                fee_discount_percent: row.querySelector('td:nth-child(4) input').value,
                fee_discount_value: row.querySelector('td:nth-child(5) input').value,
                net_fee_payable_value: row.querySelector('td:nth-child(6) input').value,
                mandatory: row.querySelector('td:nth-child(7) input').checked,
                payment_mode: row.querySelector('td:nth-child(8) select').value
            };
            tableData.push(rowData);
            console.log(rowData);
            document.getElementById('form_details').value = JSON.stringify(tableData);


        });


    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Event listener for changes in the Total Fee or Discount
        $(document).on('input', '#total_fee, #fee_discount, #fee_discount_value', function() {
    var $row = $(this).closest('tr');
    var totalFee = parseFloat($row.find('#total_fee').val()) || 0;
    var discount = parseFloat($row.find('#fee_discount').val()) || 0;
    var discountValue = parseFloat($row.find('#fee_discount_value').val()) || 0;

    // Condition 1: If user updates discount percentage, calculate discount value
    if(discount>0){
    if ($(this).attr('id') === 'fee_discount') {
        discountValue = (totalFee * discount) / 100;
        $row.find('#fee_discount_value').val(discountValue.toFixed(2));
    }}
    var rowTitle = $row.find('.title').text().trim() || "This Row"; 
    if(totalFee<discount){
       
        $row.find('#fee_discount').val(0);
        discount = 0;
        $row.find('#fee_discount_value').val(0);
        discountValue = 0;
    }

    // Condition 2: If user updates discount value, calculate discount percentage
    if ($(this).attr('id') === 'fee_discount_value') {
        // Validation: Discount Value should not be more than Total Fee
        if (discountValue > totalFee) {
            alert("Discount value cannot be greater than Total Fee!");
            $row.find('#fee_discount_value').val(0);
            discountValue = 0;
        }
        discount = (discountValue / totalFee) * 100||0;
        $row.find('#fee_discount').val(discount.toFixed(2));
    }

    var netFee = totalFee - discountValue;
    $row.find('#net_fee').val(netFee.toFixed(2));
});

// Enable fee_discount_value input field
$(document).ready(function() {
    $('#fee_discount_value').prop('readonly', false);
});




// Handle Bulk Upload

$(document).ready(function() {
    setTimeout(function() {
        $('#fee_tr input').trigger('input'); // Trigger input event after bulk upload
    }, 500);
});




        // Event listener for adding new row
        $('body').on('click', '.add-contact-row', function(e) {
            e.preventDefault();
            var $currentRow = $(this).closest('tr'); // Get current row
            var table = $(this).closest('table'); // Get the table

            // Check if at least one field is filled in the current row before adding a new one
            var isValid = $currentRow.find('input[type=text]').filter(function() {
                return $(this).val().trim() !== '';
            }).length > 0;

            if (!isValid) {
                alert('At least one field must be filled before adding a new row.');
                return;
            }

            // Generate a new row
            var newRow = `
                <tr>
                    <td></td> <!-- Serial number will be added dynamically -->
                    <td>
                                                                <select class="form-control mw-100" name="title" required style="width: 300px">
                                                                    <option value="" disabled>Select Title</option>
                                                                    @foreach ($fee_head as $head)
                                                                        <option value="{{ $head->fee_head }}" 
                                                                            @if (isset($fees) && $fees['title']== $head->fee_head) selected @endif>
                                                                            {{ $head->fee_head }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                    <td><input type="number" class="form-control mw-100" value="" id="total_fee" /></td>
                    <td><input type="number" class="form-control mw-100" value="" id="fee_discount" /></td>
                    <td><input type="text" class="form-control mw-100" value="" id="fee_discount_value"  /></td>
                    <td><input type="text" class="form-control mw-100" value="" id="net_fee" readonly /></td>
                    <td><input type="checkbox" class="form-check-input" /></td>
                    <td><select class="form-select mw-100">
                        <option>Select</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option>Quarterly</option>
                        <option>Semi-Yearly</option>
                        <option>Yearly</option>
                        <option>One Time</option>
                    </select></td>
                    <td><a href="#" class="text-primary add-contact-row">
                        <i data-feather="plus-square"></i>
                    </a></td>
                </tr>
            `;

            // Append the new row to the table
            table.find('tbody').prepend(newRow);
            feather.replace(); // Re-run Feather to update icons

            // Update serial numbers
            var rows = table.find('tbody tr');
            rows.each(function(index) {
                $(this).find('td:first').text(index + 1);
            });

            // Update icons for the newly added row
            rows.each(function(index) {
                var deleteIcon = $(this).find('#icon');
                var changeClass = $(this).find('a');
                if (index === 0) {
                    deleteIcon.attr('data-feather', 'plus-square');
                } else {
                    changeClass.attr('class', 'delete-item');
                    deleteIcon.attr('data-feather', 'trash');
                    deleteIcon.addClass('text-danger');
                }
            });

            feather.replace();


            $('tbody').on('click', '.delete-item', function() {
                var row = $(this).closest('tr');
                row.remove();
                row.removeClass('delete-item');
                var rows = table.find('tbody tr');
                rows.each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            });
        });
    });
</script>
<script>
     $(document).ready(function () {
    
        $('#batch_year').change(function () {
        var batchYear = $(this).val();
        $('#batch_name').html('<option value="" selected>-----Select Batch-----</option>');
        // $('#section').html('<option value="" selected>-----Select Section-----</option>');

        if (batchYear) {
            $.ajax({
                url: "{{ route('get-batches-name') }}",
                type: "POST",
                data: {
                    batch_year: batchYear,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.length > 0) {
                        $.each(response, function (index, item) {
                            $('#batch_name').append('<option value="' + item.batch_name + '">' + item.batch_name + '</option>');
                        });
                        $('#batch_name').prop('disabled', false);
                    } else {
                        $('#batch_name').prop('disabled', true);
                    }
                }
            });
        } else {
            $('#batch_name').prop('disabled', true);
        }
    });
    // Fetch Sections on Batch Select
    $('#batch_name').on('change', function () { // Corrected .on() syntax
    var batchName = $(this).val();
    $('#section').html('<option value="" selected>-----Select Section-----</option>');

    if (batchName) {
        $.ajax({
            url: "{{ route('section.fetch') }}", // Fixed URL syntax
            type: "POST",
            data: {
                batch_name: batchName,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if (response.length > 0) {
                    $.each(response, function (index, item) {
                        $('#section').append('<option value="' + item.name + '">' + item.name + '</option>');
                    });
                    $('#section').prop('disabled', false); // Enable after adding options
                } else {
                    $('#section').prop('disabled', true);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", status, error); // Debugging AJAX failure
            }
        });
    } else {
        $('#section').prop('disabled', true);
    }
});
    });
</script>




@endsection