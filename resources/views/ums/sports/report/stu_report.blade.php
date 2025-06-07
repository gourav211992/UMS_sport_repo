{{-- <!-- @extends('ums.sports.sports-meta.admin-sports-meta') --> --}}
<!-- Feather Icons -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <style>
        table {
            color: #000;
        }


        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
    <!-- @section('content')
    -->

        <div class="container" style="padding-top: 80px; position: relative;">

            <div class="no-print position-absolute top-0 end-0 p-3 z-3">
                <button onclick="window.history.back()" class="btn btn-secondary me-2">
                    Back
                </button>
                <!-- <button form="form" id="submit" class="btn btn-success">
                    Submit
                </button> -->
            </div>



            <form id="form" method="post" action="/submit-report-comment">
                <div id="reportSection" class="border border-dark p-3 text-black font-Arial">
                    <table class="table table-borderless w-100 mb-3 text-black fs-6">
                        <tr>
                            <td class="text-center fw-semibold fs-4">
                                Sports Quest Centre of Excellence
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-semibold py-2 fs-6">
                                Student Fee Ledger
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold pt-4 lh-sm">
                                Between: 01-04-2011 to 25-08-2011
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold pt-4 lh-sm">
                                Student Fee Report
                            </td>
                        </tr>
                    </table>


                    <table class="table table-bordered table-sm w-100 mb-3" style="border: 1px solid #000;">
                        <tbody>
                            <tr>
                                <td class="p-2" style="width: 5%;">1.</td>
                                <td class="fw-bold p-2">Enrollment No:</td>
                                <td class="p-2">{{ $student->registration->registration_number ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td class="p-2">2.</td>
                                <td class="fw-bold p-2">First Name:</td>
                                
                                <td class="p-2">{{ $student->first_name ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td class="p-2">3.</td>
                                <td class="fw-bold p-2">Last Name:</td>
                                <td class="p-2">{{$student->last_name ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td class="p-2">4.</td>
                                <td class="fw-bold p-2">Batch:</td>
                                <td class="p-2">{{$registration->batch->batch_name ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td class="p-2">5.</td>
                                <td class="fw-bold p-2">Section:</td>
                                <td class="p-2">{{ $registration->section->name  ??'-'}}</td>
                            </tr>
                            <tr>
                                <td class="p-2">5.</td>
                                <td class="fw-bold p-2">Quota:</td>
                                <td class="p-2">{{ $registration->quota->quota_name  ?? '-'}}</td>
                            </tr>
                        </tbody>
                    </table>

                    @php
                                                    use Carbon\Carbon;

                                                    $feeItems = $feeDetails;
                                                    // dd($feeItems);
                                                    $monthlyGrouped = [];
                                                    $startDate = Carbon::parse($student->registration->doj);

                                                    $paidData = $existingData;    
                                                    $unpaidData = $UsersideData;   


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
                                                                            $isDisabled = $status === 'paid';
                                                                            if(!empty( $paidItem['isDisabled'])){
                                                                                 $isDisabled=true;
                                                                            }
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
                                                                    $isDisabled = $status === 'paid';
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
                                                <table
                                                  class="table w-100 fw-bolder mb-2 table-bordered " style="font-size: 13px; border: 1px solid #000;  " cellspacing="0" cellpadding="0">
                                                    <thead>
                                                        <tr class="table-secondary" style="border: 1px solid #000;">
                                                            <th>S.NO</th>
                                                            <th>Due Date</th>
                                                            <th>Amount</th>
                                                            <th>Paid Amount</th>
                                                            <th>Remaining Amount</th>
                                                            <th>payment mode</th>
                                                            <th>Bank Name</th>
                                                            <th>Reference No.</th>
                                                            <th>Status</th>
                                                            {{-- <th>Action</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $i = 1;
                                                            $total_amount = 0;
                                                        $paidAmount = 0;
                                                        
                                                        
                                                        @endphp
        
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
                                                                                                            <td>{{ $payment->pay_mode ?? '-'}}</td>
                                                                                                            <td>{{ $payment->bank_name ?? '-'}}</td>
                                                                                                            <td>{{ $payment->ref_no ?? '-'}}</td>
                                                                                                            <td>
                                                                                                                {{$status}}
                                                                                                            </td>
                                                                                                            {{-- <td>
                                                                                                                <input type="checkbox" class="due-check"
                                                                                                                    data-date="{{ $dueDate }}" data-items='@json($items)'
                                                                                                                    data-total="{{ $total }}" {{ $isDisabled ? 'checked disabled' : '' }}>

                                                                                                                <i class="fa fa-eye text-dark ms-2 view-schedule"
                                                                                                                    style="cursor:pointer" data-bs-toggle="modal"
                                                                                                                    data-bs-target="#feeDetailModal"
                                                                                                                    data-date="{{ $dueDate }}" data-items='@json($items)'
                                                                                                                    data-remaining="{{ $remaining }}"
                                                                                                                    title="View Fee Schedule">
                                                                                                                </i>
                                                                                                            </td> --}}
                                                                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="table-secondary" style="border: 1px solid #000;">
                                                        <tr>
                                                            <td></td>
                                                            <td colspan="2"><strong>Total Amount:
                                                                    ₹{{ number_format($total_amount, 2) }}</strong></td>
                                                            <td colspan="2"><strong>Payable Amount:
                                                                    ₹{{ number_format($paidAmount, 2) }}</strong></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            {{-- <td>
                                                                <button
                                                                    class="btn btn-primary btn-sm px-25 font-small-2 py-25 pay-now-btn"
                                                                    id="payNowBtn" data-user-id="{{ $student->id }}">
                                                                    Pay Now
                                                                </button>

                                                            </td> --}}
                                                        </tr>
                                                    </tfoot>
                                                </table>


                    </table>


                </div>
            </form>

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

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
{{-- @endsection --> --}}

</body>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-schedule').forEach(icon => {
        icon.addEventListener('click', function () {
            const dueDate = this.getAttribute('data-date');
            const items = JSON.parse(this.getAttribute('data-items'));
            const remaining = parseFloat(this.getAttribute('data-remaining')) || 0;

            console.log("Remaining:", remaining);
            console.log("Items:", items);

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

</html>
