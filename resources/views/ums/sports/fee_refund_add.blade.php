@extends('ums.admin.admin-meta')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        @include('ums.admin.notifications')
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
                                        <li class="breadcrumb-item active">Fee Refund  add</li>
                                    </ol>
                                </div>
							</div>
						</div>
					</div>
                    

					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button> 
							<button data-bs-toggle="modal" type="submit" form="submitData" data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button> 
						</div>
					</div>
				</div>
			</div>
            <div class="content-body">
                 
                
				<form id="submitData" method="POST" action="{{ route('FeeRefund-add.create') }}">
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
                                  <!-- Batch Dropdown -->
<!-- Batch Dropdown -->
<div class="row align-items-center mb-1">
    <div class="col-md-3">
        <label class="form-label">Batch <span class="text-danger">*</span></label>
    </div>
    <div class="col-md-5">
        <select class="form-select" id="batchSelect" name="batch_id">
            <option value="">---Select Batch---</option>
            <option value="all" {{ old('batch_id') == 'all' ? 'selected' : '' }}>All</option>
            @foreach($batches as $batch)
                <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
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
        <select class="form-select" id="sectionSelect" name="section_id">
            <option value="">---Select Section---</option>
            <option value="all" {{ old('section_id') == 'all' ? 'selected' : '' }}>All</option>
            <!-- Dynamically add sections here -->
        </select>
        @error('section_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

<input type="hidden" name="resolved_batch_id" id="resolvedBatchId" />
<input type="hidden" name="resolved_section_id" id="resolvedSectionId" />
<!-- Student Dropdown -->
<div class="row align-items-center mb-1">
    <div class="col-md-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
    </div>
    <div class="col-md-5">
        <select class="form-select" id="studentSelect" name="registration_id">
            <option value="">---Select Student---</option>
            <option value="all" {{ old('registration_id') == 'all' ? 'selected' : '' }}>All</option>
            <!-- Dynamically add students here -->
        </select>
        @error('registration_id')
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
        <input type="text" class="form-control" id="regNoInput" name="registration_no" readonly value="{{ old('registration_no') }}">
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
        <input type="number" class="form-control" id="feePaidInput" name="total_fee_paid" value="{{ old('total_fee_paid') }}" readonly>
        @error('total_fee_paid')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    </div> 
</div> 

<!-- Total Discount -->
<div class="row align-items-center mb-1">
    <div class="col-md-3"> 
        <label class="form-label">Total Discount <span class="text-danger">*</span></label>  
    </div>  
    <div class="col-md-5"> 
        <input type="number" class="form-control" id="discountInput" name="total_discount" value="{{ old('total_discount') }}" readonly>
        @error('total_discount')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    </div> 
</div>


<!-- Refund Balance -->
<div class="row align-items-center mb-1">
    <div class="col-md-3"> 
        <label class="form-label">Refund Balance <span class="text-danger">*</span></label>  
    </div>  
    <div class="col-md-5"> 
        <input type="number" step="0.01" class="form-control" id="refund_balance" name="refund_balance" value="{{ old('refund_balance') }}">

@error('refund_balance')
    <small class="text-danger">{{ $message }}</small>
@enderror
    </div> 
</div>

<!-- Refund Breakdown -->
<div class="row align-items-center mb-1">
    <div class="col-md-3"> 
        <label class="form-label">Refund Break Down <span class="text-danger">*</span></label>  
    </div>  
    <div class="col-md-5"> 
        <input type="text" class="form-control" id="refundBreakdownInput" name="refund_breakdown" value="{{ old('refund_breakdown') }}" readonly>
        @error('refund_breakdown')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    </div> 
</div>

<div class="row align-items-center mb-1">
    <div class="col-md-3"> 
        <label class="form-label" for="refundMethodSelect">Refund Method <span class="text-danger">*</span></label>  
    </div>  

    <div class="col-md-5"> 
        <select class="form-select" name="refund_method" id="refundMethodSelect">
            <option value="">---Select refund method---</option>
            <option value="UPI" {{ old('refund_method') == 'UPI' ? 'selected' : '' }}>UPI</option>
            <option value="Paytm" {{ old('refund_method') == 'Paytm' ? 'selected' : '' }}>Net Banking</option>
            <option value="Paytm" {{ old('refund_method') == 'Paytm' ? 'selected' : '' }}>Cheque</option>
            {{-- CHEQUE , --}}
        </select>
        {{-- <INPUT>TRANSACTION NUMBER OR CHEQUE NUMBER</INPUT> --}}
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
        <input type="text" maxlength="27" class="form-control" id="transaction_number" name="transaction_number" value="{{ old('transaction_number') }}">
        @error('transaction_number')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div> 
</div>



													<div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Refund Date <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="date" name="refund_date" class="form-control" value="{{ old('refund_date') }}">
@error('refund_date')
    <small class="text-danger">{{ $message }}</small>
@enderror
                                                        </div> 
                                                     </div>
													<div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Reason<span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <input type="text" name="reason" class="form-control" value="{{ old('reason') }}">
                                                            @error('reason')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                        </div> 
                                                     </div>
													
													 <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Approved By<span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                    <input type="text" name="approved_by" class="form-control" value="{{ old('approved_by') }}">
                         @error('approved_by')
                             <small class="text-danger">{{ $message }}</small>
                         @enderror
                                                        </div> 
                                                     </div>
													
                                            	</div> 
                                                
                                                <div class="col-md-4 border-start">
                                                     
                                                
 
											</div>
											  
  
								</div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                     
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
    
            const oldBatchId = "{{ old('batch_id') }}";
            const oldSectionId = "{{ old('section_id') }}";
            const oldStudentId = "{{ old('registration_id') }}";
    
            if (oldBatchId) {
                $('#batchSelect').val(oldBatchId);
                if (oldBatchId === 'all') {
                    loadAllSections(oldSectionId);
                    loadAllStudents(oldStudentId);
                } else {
                    loadSections(oldBatchId, oldSectionId);
                    if (oldSectionId === 'all') {
                        loadStudents(oldBatchId, null, oldStudentId);
                    } else {
                        loadStudents(oldBatchId, oldSectionId, oldStudentId);
                    }
                }
            }
    
            $('#batchSelect').on('change', function () {
                let batchId = $(this).val();
                $('#sectionSelect').html('<option value="all">All</option>');
                $('#studentSelect').html('<option value="all">All</option>');
    
                if (batchId === 'all') {
                    loadAllSections();
                    loadAllStudents();
                } else {
                    loadSections(batchId, null);
                }
            });
    
            $('#sectionSelect').on('change', function () {
                let sectionId = $(this).val();
                let batchId = $('#batchSelect').val();
                $('#studentSelect').html('<option value="all">All</option>');
    
                if (sectionId === 'all') {
                    loadAllSections();
                }
    
                if (batchId === 'all') {
                    if (sectionId === 'all') {
                        loadAllStudents();
                    } else {
                        loadStudentsBySection(sectionId);
                    }
                } else {
                    if (sectionId === 'all') {
                        loadStudents(batchId, null);
                    } else {
                        loadStudents(batchId, sectionId);
                    }
                }
            });
    
            $('#studentSelect').on('change', function () {
                const studentId = $(this).val();
    
                // ✅ New functionality to detect batch/section from selected student
                const selectedOption = $(this).find('option:selected');
                const actualBatchId = selectedOption.data('batch-id');
                const actualSectionId = selectedOption.data('section-id');
                $('#resolvedBatchId').val(actualBatchId);
                $('#resolvedSectionId').val(actualSectionId);
    
                if (!studentId || studentId === 'all') {
                    $('#regNoInput, #feePaidInput, #discountInput, #refund_balance, #refundBreakdownInput').val('');
                    return;
                }
    
                $.ajax({
                    url: '/get-fee-details/' + studentId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data.error) {
                            console.error('Error:', data.error);
                            return;
                        }
    
                        totalFee = parseFloat(data.total_fee) || 0;
                        totalDiscount = parseFloat(data.total_discount) || 0;
    
                        $('#regNoInput').val(data.document_number || '');
                       
                        $('#feePaidInput').val(totalFee.toFixed(2));
                        $('#discountInput').val(totalDiscount.toFixed(2));
                        calculateRefundBreakdown();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching fee details:', error);
                    }
                });
            });
    
            $('#refund_balance').on('input', function () {
                let value = $(this).val();
                if (value.includes('.')) {
                    const [whole, fraction] = value.split('.');
                    if (fraction.length > 2) {
                        value = parseFloat(value).toFixed(2);
                        $(this).val(value);
                    }
                }
                calculateRefundBreakdown();
            });
    
            function calculateRefundBreakdown() {
                let refundBalance = parseFloat($('#refund_balance').val()) || 0;
                if (refundBalance > totalFee) {
                    refundBalance = 0;
                    $('#refund_balance').val('0.00');
                }
    
                let refundBreakdown = totalFee - refundBalance;
                $('#refundBreakdownInput').val(refundBreakdown.toFixed(2));
            }
    
            function loadAllSections(selectedId = null) {
                $.ajax({
                    url: '{{ route("getAllSections") }}',
                    type: 'GET',
                    success: function (sections) {
                        $('#sectionSelect').html('<option value="all">All</option>');
                        $.each(sections, function (key, section) {
                            let selected = section.id == selectedId ? 'selected' : '';
                            $('#sectionSelect').append(`<option value="${section.id}" ${selected}>${section.name}</option>`);
                        });
                        if (selectedId === 'all') {
                            $('#sectionSelect').val('all');
                        }
                    }
                });
            }
    
            function loadSections(batchId, selectedSectionId) {
                $.ajax({
                    url: '{{ route("getSections") }}',
                    type: 'GET',
                    data: { batch_id: batchId },
                    success: function (sections) {
                        $('#sectionSelect').html('<option value="">select section</option>');
                        $('#sectionSelect').append('<option value="all">All</option>');
                        $.each(sections, function (key, section) {
                            let selected = section.id == selectedSectionId ? 'selected' : '';
                            $('#sectionSelect').append(`<option value="${section.id}" ${selected}>${section.name}</option>`);
                        });
                        if (selectedSectionId === 'all') {
                            $('#sectionSelect').val('all');
                        }
                    }
                });
            }
    
            function loadAllStudents(selectedId = null) {
                $.ajax({
                    url: '{{ route("getAllStudent") }}',
                    type: 'GET',
                    success: function (students) {
                        $('#studentSelect').html('<option value="all">All</option>');
                        $.each(students, function (key, student) {
                            let selected = student.id == selectedId ? 'selected' : '';
                            $('#studentSelect').append(
                                `<option value="${student.id}" data-batch-id="${student.batch_id}" data-section-id="${student.section_id}" ${selected}>${student.name} ${student.last_name}</option>`
                            );
                        });
                        if (selectedId === 'all') {
                            $('#studentSelect').val('all');
                        }
                    }
                });
            }
    
            function loadStudents(batchId, sectionId, selectedId = null) {
                $.ajax({
                    url: '{{ route("getStudents") }}',
                    type: 'GET',
                    data: {
                        batch_id: batchId,
                        section_id: sectionId
                    },
                    success: function (students) {
                        $('#studentSelect').html('<option value="">select student</option>');
                        $.each(students, function (key, student) {
                            let selected = student.id == selectedId ? 'selected' : '';
                            $('#studentSelect').append(
                                `<option value="${student.id}" data-batch-id="${student.batch_id}" data-section-id="${student.section_id}" ${selected}>${student.name} ${student.last_name}</option>`
                            );
                        });
                        if (selectedId === 'all') {
                            $('#studentSelect').val('all');
                        }
                    }
                });
            }
    
            function loadStudentsBySection(sectionId, selectedId = null) {
                $.ajax({
                    url: '{{ route("getStudentsBySectionOnly") }}',
                    type: 'GET',
                    data: { section_id: sectionId },
                    success: function (students) {
                        $('#studentSelect').html('<option value="all">All</option>');
                        $.each(students, function (key, student) {
                            let selected = student.id == selectedId ? 'selected' : '';
                            $('#studentSelect').append(
                                `<option value="${student.id}" data-batch-id="${student.batch_id}" data-section-id="${student.section_id}" ${selected}>${student.name} ${student.last_name}</option>`
                            );
                        });
                        if (selectedId === 'all') {
                            $('#studentSelect').val('all');
                        }
                    }
                });
            }
    
            function handleStudentLoad(batchId, sectionId, selectedStudentId) {
                if (batchId === 'all') {
                    loadAllSections(sectionId);
                    if (sectionId === 'all' || !sectionId) {
                        loadAllStudents(selectedStudentId);
                    } else {
                        loadStudentsBySection(sectionId, selectedStudentId);
                    }
                } else {
                    loadSections(batchId, sectionId);
                    if (sectionId === 'all' || !sectionId) {
                        loadStudents(batchId, null, selectedStudentId);
                    } else {
                        loadStudents(batchId, sectionId, selectedStudentId);
                    }
                }
            }
        });
    </script>
    
    
    
         
    @endsection