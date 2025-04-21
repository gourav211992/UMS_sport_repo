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
                                <h2 class="content-header-title float-start mb-0">Add Fee Master</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('sports-fee-schedule')}}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active">Add New</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                            <form action="{{ url('fee-master/add') }}" method="post">
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

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Series <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-select" name="book_id" id="series" required>
                                                        <option value="" disabled selected>Select</option>
                                                        @foreach ($series as $ser)
                                                            <option value="{{ $ser->id }}">{{ $ser->book_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Schedule No. <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="document_number" id="requestno"/>
                                                    <input type="hidden" name="doc_no" id="doc_no">
                                                    <input type="hidden" name="book_code" id="book_code_input">
                                                    <input type="hidden" name="doc_number_type" id="doc_number_type">
                                                    <input type="hidden" name="doc_reset_pattern" id="doc_reset_pattern">
                                                    <input type="hidden" name="doc_prefix" id="doc_prefix">
                                                    <input type="hidden" name="doc_suffix" id="doc_suffix">
                                                </div>
                                            </div>

                                            <!-- <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Admission Yr. <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <input type="date" onchange="getDocNumberByBookId()"
                                                           class="form-control" name="document_date" id="document_date"
                                                           value="{{ old('document_date', date('Y-m-d')) }}">
                                                    @error('document_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> -->

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Sport Name <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-select" name="sport_name">
                                                        <option value="" selected>-----Select-----</option>
                                                        @foreach ($sportmaster as $sport)
                                                            <option value="{{ $sport->sport_name }}">
                                                                {{ ucfirst($sport->sport_name) }}</option>
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
                                                        <option value="{{ $batch }}">
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
                                                        {{-- @foreach ($batchs as $batch)
                                                        <option value="{{ $batch->batch_name }}">
                                                            {{ ucfirst($batch->batch_name) }} </option>
                                                    @endforeach --}}
                                                        

                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="section" id="section">
                                                        <option value="" selected>-----Select Section-----</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Quota <span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-select" name="quota">
                                                        <option value="" selected>-----Select-----</option>
                                                        @foreach ($quotas as $quota)
                                                            <option value="{{ $quota->quota_name }}">
                                                                {{ ucfirst($quota->quota_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                            
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Start & End Date <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5 d-flex gap-2">
                                                    <input type="date" name="start_date" class="form-control" id="start_date" required />
                                                    <input type="date" name="end_date" id="end_date" class="form-control" required />
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
                                                                class="form-check-input" checked value="1">
                                                            <label class="form-check-label fw-bolder"
                                                                for="customColorRadio3">Enable</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="customColorRadio4" name="display" value="0"
                                                                class="form-check-input">
                                                            <label class="form-check-label fw-bolder"
                                                                for="customColorRadio4">Disable</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="fee_details" id="form_details">


                                        </div>


                                        <div class="col-md-4 border-start">
                                            <div class="row align-items-center mb-2">
                                                <div class="col-md-12">
                                                    <label class="form-label text-primary"><strong>Status</strong></label>
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="customColorRadio3" name="status"
                                                                class="form-check-input" checked="" value="Active">
                                                            <label class="form-check-label fw-bolder"
                                                                for="customColorRadio3">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="customColorRadio4" name="status" value="Inactive"
                                                                class="form-check-input">
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
                                                            <tr id="fee_tr" class="add-row">
                                                                <td>1</td>
                                                                <td>
                                                                    <select class="form-control mw-100" name="title" required style="width: 300px">
                                                                        <option value="" disabled selected>Select Title</option>
                                                                        @foreach ($fee_head as $head)
                                                                         <option value="{{ $head->fee_head }}">{{ $head->fee_head }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                  </td>
                                                                <td><input type="number" class="form-control mw-100 total_fee" name="Total_fee" id="total_fee" required /></td>
                                                                <td><input type="number" class="form-control mw-100" name="fee_discount" id="fee_discount" required /></td>
                                                                <td><input type="text" class="form-control mw-100 fee_discount_value" name="fee_discount_value" id="fee_discount_value" required/></td>
                                                                <td><input type="text" class="form-control mw-100 net_fee" name="net_fee" id="net_fee"  readonly /></td>
                                                                <td>
                                                                    <div class="demo-inline-spacing">
                                                                        <div class="form-check form-check-primary mt-25">
                                                                            <input type="checkbox" id="guardian1" name="guardian" checked class="form-check-input">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select mw-100" name="payment_mode" required>
                                                                        <option>Select</option>
                                                                        <option value="Weekly">Weekly</option>
                                                                        <option value="Monthly" selected>Monthly</option>
                                                                        <option value="Quarterly">Quarterly</option>
                                                                        <option value="Semi-Yearly">Semi-Yearly</option>
                                                                        <option selected value="Yearly">Yearly</option>
                                                                        <option value="One Time">One Time</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="text-primary add-contact-row">
                                                                        <i id="icon" data-feather="plus-square"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            

                                                          
                                                            



                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                               
                                                                
                                                                <td  colspan="1" class="fw-bold mw-100" style="color: black" >Total Fee:<span class="fw-bold" id="total_fee1"></span></td>
                                                               
                                                               
                                                                <td colspan="2" class="fw-bold " style="color: black" >Total Discount Value  :    <span class="fw-bold" id="fee_discount1"></span></td>
                                                               
                                                            
                                                                <td colspan="2" class="fw-bold " style="color: black">Total Payable:<span class="fw-bold" id="total_payable"></span></td>
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
      


//         function captureTableData() {
//     let tableData = [];
//     let rows = document.querySelectorAll('.table tbody tr');

//     rows.forEach(row => {
//         let rowData = {
//             title: row.querySelector('td:nth-child(2) select') ? row.querySelector('td:nth-child(2) select').value : '', // Correct selector for select
//             total_fees: row.querySelector('td:nth-child(3) input') ? row.querySelector('td:nth-child(3) input').value : '',
//             fee_discount_percent: row.querySelector('td:nth-child(4) input') ? row.querySelector('td:nth-child(4) input').value : '',
//             fee_discount_value: row.querySelector('td:nth-child(5) input') ? row.querySelector('td:nth-child(5) input').value : '',
//             net_fee_payable_value: row.querySelector('td:nth-child(6) input') ? row.querySelector('td:nth-child(6) input').value : '',
//             mandatory: row.querySelector('td:nth-child(7) input') ? row.querySelector('td:nth-child(7) input').checked : false,
//             payment_mode: row.querySelector('td:nth-child(8) select') ? row.querySelector('td:nth-child(8) select').value : ''
//         };
//         tableData.push(rowData);
//     });

//     // Set data to hidden input
//     document.getElementById('form_details').value = JSON.stringify(tableData);
//     console.log(tableData);
// }


function captureTableData() {
    let tableData = [];
    let rows = document.querySelectorAll('.table tbody tr');

   
    let grand_total_fees = document.getElementById('total_fee1')?.textContent.trim() || "0";
    let grand_total_discount = document.getElementById('fee_discount1')?.textContent.trim() || "0";
    let grand_total_payable = document.getElementById('total_payable')?.textContent.trim() || "0";

    rows.forEach(row => {
        let rowData = {
            title: row.querySelector('td:nth-child(2) select').value,
            total_fees: row.querySelector('td:nth-child(3) input').value,
            fee_discount_percent: row.querySelector('td:nth-child(4) input').value,
            fee_discount_value: row.querySelector('td:nth-child(5) input').value,
            net_fee_payable_value: row.querySelector('td:nth-child(6) input').value,
            mandatory: row.querySelector('td:nth-child(7) input').checked,
            payment_mode: row.querySelector('td:nth-child(8) select').value,
           
            
        
            grand_total_fees: grand_total_fees,
            grand_total_discount: grand_total_discount,
            grand_total_payable: grand_total_payable
        };
        tableData.push(rowData);
    });

  
    document.getElementById('form_details').value = JSON.stringify(tableData);

    
    console.log(tableData);
}
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            var today = new Date().toISOString().split('T')[0];
            $('#start_date').attr('min', today);
            $('#end_date').attr('min', today);
        });
    </script>
  
    <script>
        $(document).ready(function () {
            $('#series').on('change', function() {
                getDocNumberByBookId();
            });

            function getDocNumberByBookId() {
                let currentDate = new Date().toISOString().split('T')[0];
                let bookId = $('#series').val();
                let actionUrl = '{{ route('book.get.doc_no_and_parameters') }}' + '?book_id=' + bookId + "&document_date=" + currentDate;
                fetch(actionUrl).then(response => {
                    return response.json().then(data => {
                        if (data.status == 200) {
                            $("#book_code_input").val(data.data.book_code);
                            if (!data.data.doc.document_number) {
                                $("#requestno").val('');
                                $('#doc_number_type').val('');
                                $('#doc_reset_pattern').val('');
                                $('#doc_prefix').val('');
                                $('#doc_suffix').val('');
                                $('#doc_no').val('');
                            } else {
                                $("#requestno").val(data.data.doc.document_number);
                                $('#doc_number_type').val(data.data.doc.type);
                                $('#doc_reset_pattern').val(data.data.doc.reset_pattern);
                                $('#doc_prefix').val(data.data.doc.prefix);
                                $('#doc_suffix').val(data.data.doc.suffix);
                                $('#doc_no').val(data.data.doc.doc_no);
                            }
                            if (data.data.doc.type == 'Manually') {
                                $("#requestno").attr('readonly', false);
                            } else {
                                $("#requestno").attr('readonly', true);
                            }
                        }
                        if (data.status == 404) {
                            $("#requestno").val('');
                            $('#doc_number_type').val('');
                            $('#doc_reset_pattern').val('');
                            $('#doc_prefix').val('');
                            $('#doc_suffix').val('');
                            $('#doc_no').val('');
                            alert(data.message);
                        }
                    });
                });
            }

           
           
    $(document).on('input', '#total_fee, #fee_discount, #fee_discount_value', function () {
        var $row = $(this).closest('tr');
        var totalFee = parseFloat($row.find('#total_fee').val()) || 0;
        var discountPercent = parseFloat($row.find('#fee_discount').val()) || 0;
        var discountValue = parseFloat($row.find('#fee_discount_value').val()) || 0;

        var inputId = $(this).attr('id');

        // If percent is changed
        if (inputId === 'fee_discount') {
            if (discountPercent > 100) {
                alert("Discount % cannot be greater than 100!");
                discountPercent = 0;
                $row.find('#fee_discount').val(0);
            }
            discountValue = (totalFee * discountPercent) / 100;
            if (discountValue > totalFee) {
                discountValue = 0;
                $row.find('#fee_discount_value').val(0);
                alert("Discount value cannot be greater than Total Fee!");
            } else {
                $row.find('#fee_discount_value').val(discountValue.toFixed(2));
            }
        }

        // If discount value is changed
        if (inputId === 'fee_discount_value') {
            if (discountValue > totalFee) {
                alert("Discount value cannot be greater than Total Fee!");
                discountValue = 0;
                $row.find('#fee_discount_value').val(0);
            }
            discountPercent = totalFee > 0 ? (discountValue / totalFee) * 100 : 0;
            if (discountPercent > 100) discountPercent = 100;
            $row.find('#fee_discount').val(discountPercent.toFixed(2));
        }

        // Always calculate net fee
        var netFee = totalFee - discountValue;
        if (netFee < 0) netFee = 0;

        $row.find('#net_fee').val(netFee.toFixed(2));

        // Optional: total payable calculation
        calculateTotalPayable();
    });

    $(document).on('change', 'input[name="guardian"]', function () {
    calculateTotalPayable(); // only recalculates total based on checkbox
});
    function calculateTotalPayable() {
    let total_fee = 0;
    let total_fee_discount = 0;
    let net_total = 0;

    $('tr').each(function () {
        var isChecked = $(this).find('input[name="guardian"]').is(':checked');

        if (isChecked) {
            var tf = parseFloat($(this).find('.total_fee').val()) || 0;
            var df = parseFloat($(this).find('.fee_discount_value').val()) || 0;
            var nf = parseFloat($(this).find('.net_fee').val()) || 0;

            total_fee += tf;
            total_fee_discount += df;
            net_total += nf;
        }
    });

    $('#total_fee1').text(total_fee.toFixed(2));
    $('#fee_discount1').text(total_fee_discount.toFixed(2));
    $('#total_payable').text(net_total.toFixed(2));
}

   




// function calculateTotalPayable() {
//     let total_fee=0;
//     let total_fee_discount=0;
//     let net_total = 0;

//     $('.net_fee').each(function () { 
//         let val = parseFloat($(this).val());
//         if (!isNaN(val)) {
//             net_total += val;
//         }
//     });
//     $('.total_fee').each(function () { 
//         let val = parseFloat($(this).val());
//         if (!isNaN(val)) {
//             total_fee += val;
//         }
//     });
//     $('.fee_discount_value').each(function () { 
//         let val = parseFloat($(this).val());
//         if (!isNaN(val)) {
//             total_fee_discount += val;
//         }
//     });


  
//     $('#total_payable').text(net_total.toFixed(2));
//     $('#fee_discount1').text(total_fee_discount.toFixed(2));
//     $('#total_fee1').text(total_fee.toFixed(2));
// }


$(document).ready(function() {
    $('#fee_discount_value').prop('readonly', false);
});



$(document).on('change', '.bulk-upload', function() {
    setTimeout(function() {
        $('#fee_tr').trigger('input'); 
    }, 500);
});



            feather.replace();

            // Add new row logic
            $('body').on('click', '.add-contact-row', function (e) {
                e.preventDefault();
               
                var table = $(this).closest('table');
           
        const $lastRow = table.find('tbody tr:last');

        // ✅ Validate required fields in the last row
        let isValid = true;
        $lastRow.find('input[required], select[required]').each(function () {
            const val = $(this).val();
            if (val === null || val === '' || val === 'Select') {
                isValid = false;
               
            } else {
              
            }
        });

        if (!isValid) {
            alert('Please fill all required fields before adding a new row.');
            return;
        }

                // Generate a new row
                var newRow = `
                 <tr class='add-row'>
                            <td></td> <!-- Serial number will be added dynamically -->
                            <td>
                                                                                <select class="form-control mw-100" name="title" required style="width: 300px">
                                                                                    <option value="" disabled selected>Select Title</option>
                                                                                    @foreach ($fee_head as $head)
                                                                                    <option value="{{ $head->fee_head }}">{{ $head->fee_head }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                    </td> 
                            <td><input type="number" class="form-control mw-100 total_fee" value="" id="total_fee" required /></td>
                            <td><input type="number" class="form-control mw-100" value="" id="fee_discount" /></td>
                            <td><input type="text" class="form-control mw-100 fee_discount_value" value="" id="fee_discount_value"  /></td>
                            <td><input type="text" class="form-control mw-100 net_fee" value="" id="net_fee"  readonly /></td>
                            <td><input type="checkbox" class="form-check-input " name="guardian" /></td>
                            <td>
                                <select class="form-select mw-100">
                                    <option>Select</option>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                    <option>Quarterly</option>
                                    <option>Semi-Yearly</option>
                                    <option>Yearly</option>
                                    <option>One Time</option>
                                </select>
                            </td>
                            <td>
                                <a href="#" class="text-primary add-contact-row">
                                    <i data-feather="plus-square"></i>
                                </a>
                            </td>
                        </tr>
            
            `;

             
                table.find('tbody').append(newRow);

                
                var rows = table.find('tbody tr');
                rows.each(function (index) {
                    $(this).find('td:first').text(index + 1);
                });

                
                rows.each(function (index) {
                    var actionCell = $(this).find('td:last');
                    if (index === 0) {
                       
                        actionCell.html(`
                        <a href="#" class="text-primary add-contact-row">
                            <i data-feather="plus-square"></i>
                        </a>
                    `);
                    } else {
                      
                        actionCell.html(`
                        <a href="#" class="text-danger delete-item">
                            <i data-feather="trash-2"></i>
                        </a>
                    `);
                    }
                });

                feather.replace();
            });

            $('tbody').on('click', '.delete-item', function (e) {
                e.preventDefault();
                var row = $(this).closest('tr');
                row.remove();
             
                calculateTotalPayable();
                
                var table = row.closest('table');
                var rows = table.find('tbody tr');
                rows.each(function (index) {
                    $(this).find('td:first').text(index + 1);
                });
            });


      
        });
    </script>

   


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    $('#batch_name').on('change', function () { 
    var batchName = $(this).val();
    $('#section').html('<option value="" selected>-----Select Section-----</option>');

    if (batchName) {
        $.ajax({
            url: "{{ route('section.fetch') }}",
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
                    $('#section').prop('disabled', false);
                } else {
                    $('#section').prop('disabled', true);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", status, error); 
            }
        });
    } else {
        $('#section').prop('disabled', true);
    }
});
    });
</script>
   
@endsection
