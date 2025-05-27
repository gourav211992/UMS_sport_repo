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
                            <h2 class="content-header-title float-start mb-0">Fee Refund Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('fee-refund')}}">Home</a></li>  
                                    <li class="breadcrumb-item active">Fee Refund  view</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">   
                        <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button> 
 
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form id="submitData" method="POST" action="{{ route('FeeRefund-Update', $feeRefund->id) }}">
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

                                            <!-- Student Name Dropdown -->
                                         
                                           <!-- Batch Dropdown -->
<div class="row align-items-center mb-1">
    <div class="col-md-3">
        <label class="form-label">Batch <span class="text-danger">*</span></label>
    </div>
    <div class="col-md-5">
        <select class="form-select" id="batchSelect" name="batch_id"  disabled>
            <option value="">---Select Batch---</option>
            <option value="all" {{ old('batch_id', $feeRefund->batch_id) == 'all' ? 'selected' : '' }}  readonly>All</option>
            @foreach($batches as $batch)
                <option value="{{ $batch->id }}" {{ old('batch_id', $feeRefund->batch_id) == $batch->id ? 'selected' : '' }}  readonly>
                    {{ $batch->batch_name }}
                </option>
            @endforeach
        </select>
        @error('batch_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

<!-- Section Dropdown -->
<div class="row align-items-center mb-1">
    <div class="col-md-3">
        <label class="form-label">Section <span class="text-danger">*</span></label>
    </div>
    <div class="col-md-5">
        <select class="form-select" id="sectionSelect" name="section_id"  disabled>
            <option value="">---Select Section---</option>
            <option value="all" {{ old('section_id') == 'all' ? 'selected' : '' }}  readonly>All</option>
            <!-- Dynamically add sections here -->
        </select>
        @error('section_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

<!-- Student Dropdown -->
<div class="row align-items-center mb-1">
    <div class="col-md-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
    </div>
    <div class="col-md-5">
        <select class="form-select" id="studentSelect" name="registration_id" disabled>
            <option value="">---Select Student---</option  readonly>
            <option value="all" {{ old('registration_id') == 'all' ? 'selected' : '' }}  readonly>All</option>
            <!-- Dynamically add students here -->
        </select>
        @error('student_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

                                            <!-- Registration Number -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Registration Number <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="regNoInput" name="registration_no" 
                                                    value="{{ old('registration_no', $feeRefund->registration_number) }}" readonly>
                                                    @error('registration_no')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Total Fee Paid -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Total Fee Paid <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" id="feePaidInput" name="total_fee_paid" value="{{ old('total_fee_paid', $feeRefund->total_fee_paid) }}" readonly>
                                                </div>
                                            </div>

                                            <!-- Total Discount -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Total Discount <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" id="discountInput" name="total_discount" value="{{ old('total_discount', $feeRefund->total_discount) }}" readonly >
                                                </div>
                                            </div>

                                            <!-- Refund Balance -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Refund Balance <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" id="refund_balance" name="refund_balance" value="{{ old('refund_balance', $feeRefund->total_refunded) }}" readonly>
                                                    @error('refund_balance')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Refund Breakdown -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Refund Breakdown <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" id="refundBreakdownInput" name="refund_breakdown" value="{{ old('refund_breakdown', $feeRefund->refund_breakdown) }}" readonly>
                                                </div>
                                            </div>

                                            <!-- Refund Method -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Refund Method <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="refund_method" id="refundMethodSelect"  disabled>
                                                        <option value="">---Select refund method---</option>
                                                        <option value="UPI" {{ old('refund_method', $feeRefund->refund_method) == 'UPI' ? 'selected' : '' }} readonly>UPI</option>
                                                        <option value="Paytm" {{ old('refund_method', $feeRefund->refund_method) == 'Paytm' ? 'selected' : '' }} readonly>Paytm</option>
                                                    </select>
                                                    @error('refund_method')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Transaction Number<span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="text" class="form-control" id="transaction_number" name="transaction_number" value="{{ old('transaction_number',$feeRefund->transaction_number) }}" disabled>
                                                    @error('transaction_number')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div> 
                                            </div>
                                            <!-- Refund Date -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Refund Date <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="date" name="refund_date" class="form-control" value="{{ old('refund_date', $feeRefund->refund_date) }}" readonly>
                                                </div>
                                            </div>

                                            <!-- Reason -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Reason <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="reason" class="form-control" value="{{ old('reason', $feeRefund->reason) }}" readonly>
                                                </div>
                                            </div>

                                            <!-- Approved By -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Approved By <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text"  name="approved_by" class="form-control" value="{{ old('approved_by', $feeRefund->approved_by) }}" disabled>
                                                    @error('approved_by')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
<!-- END: Content-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        let totalFee = 0;
        let totalDiscount = 0;

        // Listen for student selection change to fetch fee details
        $('#studentSelect').change(function () {
            const studentId = $(this).val();

            if (!studentId) return;

            $('#regNoInput').val('');
            $('#feePaidInput').val('');
            $('#discountInput').val('');
            $('#refund_balance').val('');
            $('#refundBreakdownInput').val('');

            $.ajax({
                url: '/get-fee-details/' + studentId,  // The route to your controller method
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.error) {
                        console.error('Error:', data.error);
                        return;
                    }

                    totalFee = data.total_fee || 0;
                    totalDiscount = data.total_discount || 0;

                    $('#regNoInput').val(data.document_number || '');
                    $('#feePaidInput').val(totalFee);
                    $('#discountInput').val(totalDiscount);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching fee details:', error);
                }
            });
        });

        // Listen for change in Refund Balance input
        $('#refund_balance').on('input', function () {
            const refundBalance = parseFloat($(this).val()) || 0;

            // Calculate refund breakdown based on fee balance
            const refundBreakdown = totalFee - refundBalance;
            $('#refundBreakdownInput').val(refundBreakdown);
        });
    });
</script>
<script>
    // Get old or model values from backend
    const selectedBatchId = "{{ old('batch_id', $feeRefund->batch_id) }}";
    const selectedSectionId = "{{ old('section_id', $feeRefund->section_id) }}";
    const selectedStudentId = "{{ old('registration_id', $feeRefund->registration_id) }}";

    $(document).ready(function () {
        // Reset dropdowns
        $('#sectionSelect').html('<option value="">---Select Section---</option>');
        $('#studentSelect').html('<option value="all">All</option>');

        // On batch change → load sections and students
        $('#batchSelect').on('change', function () {
            let batchId = $(this).val();

            $('#sectionSelect').html('<option value="">---Select Section---</option>');
            $('#studentSelect').html('<option value="all">All</option>');

            if (batchId) {
                $.ajax({
                    url: '{{ route("getSections") }}',
                    type: 'GET',
                    data: { batch_id: batchId },
                    success: function (sections) {
                        $('#sectionSelect').append('<option value="all"' + (selectedSectionId === 'all' ? ' selected' : '') + '>All</option>');

                        $.each(sections, function (key, section) {
                            let selected = section.id == selectedSectionId ? ' selected' : '';
                            $('#sectionSelect').append(`<option value="${section.id}"${selected}>${section.name}</option>`);
                        });

                        // Trigger section change manually to load students
                        $('#sectionSelect').trigger('change');
                    }
                });

                // Load students for batch (without section filter)
                $.ajax({
                    url: '{{ route("getStudents") }}',
                    type: 'GET',
                    data: { batch_id: batchId },
                    success: function (students) {
                        $('#studentSelect').html('<option value="all"' + (selectedStudentId === 'all' ? ' selected' : '') + '>All</option>');

                        $.each(students, function (key, student) {
                            let selected = student.id == selectedStudentId ? ' selected' : '';
                            $('#studentSelect').append(`<option value="${student.id}"${selected}>${student.name} ${student.last_name}</option>`);
                        });
                    }
                });
            }
        });

        // On section change → load students filtered by batch and section
        $('#sectionSelect').on('change', function () {
            let sectionId = $(this).val();
            let batchId = $('#batchSelect').val();

            $('#studentSelect').html('<option value="all">All</option>');

            if (sectionId === 'all') {
                $.ajax({
                    url: '{{ route("getAllStudent") }}',
                    type: 'GET',
                    success: function (students) {
                        $('#studentSelect').html('<option value="all"' + (selectedStudentId === 'all' ? ' selected' : '') + '>All</option>');

                        $.each(students, function (key, student) {
                            let selected = student.id == selectedStudentId ? ' selected' : '';
                            $('#studentSelect').append(`<option value="${student.id}"${selected}>${student.name} ${student.last_name}</option>`);
                        });
                    }
                });
            } else if (batchId && sectionId) {
                $.ajax({
                    url: '{{ route("getStudents") }}',
                    type: 'GET',
                    data: { batch_id: batchId, section_id: sectionId },
                    success: function (students) {
                        $('#studentSelect').html('<option value="all"' + (selectedStudentId === 'all' ? ' selected' : '') + '>All</option>');

                        $.each(students, function (key, student) {
                            let selected = student.id == selectedStudentId ? ' selected' : '';
                            $('#studentSelect').append(`<option value="${student.id}"${selected}>${student.name} ${student.last_name}</option>`);
                        });
                    }
                });
            }
        });

        // If "All" student selected, re-fetch full list
        $('#studentSelect').on('change', function () {
            let selected = $(this).val();
            if (selected === 'all') {
                $.ajax({
                    url: '{{ route("getAllStudent") }}',
                    type: 'GET',
                    success: function (students) {
                        $('#studentSelect').html('<option value="all">All</option>');
                        $.each(students, function (key, student) {
                            $('#studentSelect').append(`<option value="${student.id}">${student.name} ${student.last_name}</option>`);
                        });
                    }
                });
            }
        });

        // Trigger batch change on page load to pre-fill section and student
        if (selectedBatchId) {
            $('#batchSelect').val(selectedBatchId).trigger('change');
        }
    });
</script>

@endsection
