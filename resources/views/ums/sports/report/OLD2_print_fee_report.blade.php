<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    body {
        font-family: Arial, sans-serif;
        color: #000;
        margin: 0;
        padding: 0;
        background: #fff;
    }

    .container {
        /* padding: 20px; */
        max-width: 1500px;
        margin: 0 auto;
    }

    #reportSection {
        border: 1px solid black;
        padding: 20px;
        color: #000;
        overflow-x: hidden;
    }


    #reportSection>table:first-child {
        width: 100%;
        font-size: 14px;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    #reportSection>table:first-child td {
        text-align: center;
        font-weight: 600;
        line-height: 1.3;
    }

    #reportSection>table:first-child tr:nth-child(1) td {
        font-size: 22px;
        font-weight: 700;
    }

    #reportSection>table:first-child tr:nth-child(2) td {
        font-weight: normal;
        font-size: 14px;
        padding-top: 5px;
        padding-bottom: 10px;
        font-style: italic;
    }

    #reportSection>table:first-child tr:nth-child(3) td,
    #reportSection>table:first-child tr:nth-child(4) td {
        font-weight: 700;
        font-size: 16px;
        padding-top: 20px;
    }

    #reportSection .info-table {
        width: 100%;
        font-size: 13px;
        border-collapse: collapse;
        margin-bottom: 25px;
    }

    #reportSection .info-table td {
        border: 1px solid #000;
        padding: 8px 10px;
        vertical-align: middle;
        font-weight: normal;
    }

    #reportSection .info-table td:first-child {
        width: 30px;
        font-weight: 700;
        text-align: center;
    }

    #reportSection .info-table td:nth-child(2) {
        width: 150px;
        font-weight: 700;
    }

    #reportSection .info-table td:nth-child(3) {
        width: calc(100% - 180px);
    }

    #reportSection table.data-table {
        width: 100%;
        font-size: 10px;
        border-collapse: collapse;
        table-layout: fixed;
    }

    #reportSection table.data-table th,
    #reportSection table.data-table td {
        border: 1px solid #000;
        padding: 4px 3px;
        text-align: center;
        vertical-align: middle;
        white-space: normal;
        overflow: visible;
        text-overflow: clip;
        word-wrap: break-word;
        word-break: break-word;
    }


    #reportSection table.data-table th:nth-child(1),
    #reportSection table.data-table td:nth-child(1) {
        width: 30px;
        /* SN */
    }

    #reportSection table.data-table th:nth-child(2),
    #reportSection table.data-table td:nth-child(2),
    #reportSection table.data-table th:nth-child(3),
    #reportSection table.data-table td:nth-child(3)
    {
        width: 74px;
        word-break: break-word;
    }
    #reportSection table.data-table th:nth-child(10),
    #reportSection table.data-table td:nth-child(10),
    #reportSection table.data-table th:nth-child(12),
    #reportSection table.data-table td:nth-child(12),
    #reportSection table.data-table th:nth-child(13),
    #reportSection table.data-table td:nth-child(13),
    #reportSection table.data-table th:nth-child(14),
    #reportSection table.data-table td:nth-child(14),
    /* #reportSection table.data-table th:nth-child(15),
    #reportSection table.data-table td:nth-child(15), */
    #reportSection table.data-table th:nth-child(22),
    #reportSection table.data-table td:nth-child(22)
    {
        width: 60px;
    }

    #reportSection table.data-table th:nth-child(17),
    #reportSection table.data-table td:nth-child(17) {
        width: 64px;
    }

    #reportSection table.data-table th:nth-child(9),
    #reportSection table.data-table td:nth-child(9) {
        width: 65px;
    }

    #reportSection table.data-table th:last-child,
    #reportSection table.data-table td:last-child {
        width: 35px;
        /* Action */
    }

    .buttons-container {
        text-align: right;
        margin: 20px 0;
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
    }

    .buttons-container button {
        cursor: pointer;
        border-radius: 5px;
        border: none;
        padding: 8px 20px;
        font-size: 14px;
        color: #fff;
        margin-left: 10px;
        transition: background-color 0.3s ease;
    }

    .buttons-container button.back-btn {
        background-color: #6c757d;
        border: 1px solid #6c757d;
    }

    .buttons-container button.back-btn:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .buttons-container button.print-btn {
        background-color: #007bff;
    }

    .buttons-container button.print-btn:hover {
        background-color: #0069d9;
    }

    #reportSection table.data-table thead {
        background-color: #e2e3e5 !important;
        color: black !important;
    }

    @media print {

        .no-print,
        button,
        a[href^="http"]::after {
            display: none !important;

        }

        #reportSection table.data-table td.text-end {
            white-space: nowrap !important;
            overflow: hidden !important;
            text-align: center !important;
            font-size: 10px !important;
            letter-spacing: 0.3px;
        }

        #reportSection table.data-table th:last-child,
        #reportSection table.data-table td:last-child {
            display: none;
        }

        #reportSection table.data-table th:nth-child(2),
        #reportSection table.data-table td:nth-child(2),
        #reportSection table.data-table th:nth-child(3),
        #reportSection table.data-table td:nth-child(3),
        #reportSection table.data-table th:nth-child(9),
        #reportSection table.data-table td:nth-child(9),
        #reportSection table.data-table th:nth-child(10),
        #reportSection table.data-table td:nth-child(10),
        #reportSection table.data-table th:nth-child(17),
        #reportSection table.data-table td:nth-child(17) {
            width: 35px;

        }

        #reportSection {

            padding: 15px;
            overflow-x: visible !important;
        }

    }
</style>

<div class="buttons-container no-print">
    <button type="button" onclick="window.history.back()" class="back-btn">Back</button>
    <button type="button" onclick="window.print()" class="print-btn">Print Report</button>
</div>

<div class="container">
    <form id="form" method="post" action="/submit-report-comment">
        <div id="reportSection">
            <table>
                <tr>
                    <td>Sports Quest Centre of Excellence</td>
                </tr>
                <tr>
                    <td>Connecting Aspirations-Creating Champions</td>
                </tr>
                @if ($startDate && $endDate)
                    <tr>
                        <td>
                            Fee Collected Head Wise between
                            {{ \Carbon\Carbon::parse($startDate)->format('jS F') }}
                            to
                            {{ \Carbon\Carbon::parse($endDate)->format('jS F') }}
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>Fee Collected Head Wise</td>
                    </tr>
                @endif
                <tr>
                    <td>Fee Report</td>
                </tr>
            </table>

            <table class="info-table">
                <tr>
                    <td>1.</td>
                    <td>Batch</td>
                    <td>{{ optional($batches->where('id', $batchId)->first())->batch_name ?? '' }}</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Section</td>
                    <td>{{ optional($sections->where('id', $sectionId)->first())->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Quota</td>
                    <td>{{ optional($quotas->where('id', $quotaId)->first())->quota_name ?? '' }}</td>
                </tr>
            </table>

            <table class="table table-bordered data-table mb-0" cellspacing="0" cellpadding="0">
                <thead class=" text-white">
                    <tr class="table-secondary">
                        <th>SN</th>
                        <th>Temporary Reg. No.</th>
                        <th>Permanent Reg. No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Quota</th>
                        <th>Batch</th>
                        <th>Section</th>
                        <th>Registration Fee</th>
                        <th>Training Beg</th>
                        <th>Hostel</th>
                        <th>Mess</th>
                        <th>Security Deposit Beg</th>
                        <th>ID Card</th>
                        <th>Khelo India</th>
                        <th>Khel Nursery</th>
                        <th>Psychology</th>
                        <th>Sport Science</th>
                        <th>Laundry</th>
                        <th>Nutrition</th>
                        <th>Physio</th>
                        <th>Total Fee</th>
                        <th>Paid Fee</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        @php
                            $feeHeadsRaw = $student->fee_details ?? [];
                            $feeHeads = [];
                            $totalPayable = 0;

                            foreach ($feeHeadsRaw as $item) {
                                $title = $item['title'];
                                $total = floatval($item['total_fees']);
                                $discount = floatval($item['fee_discount_value']);
                                $net = $total - $discount;
                                $feeHeads[$title] = $net;
                                $totalPayable += $net;
                            }
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->document_number }}</td>
                            <td>{{ $student->registration_number ?? '-' }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->quota->quota_name ?? '-' }}</td>
                            <td>{{ $student->batch->batch_name ?? '-' }}</td>
                            <td>{{ $student->section->name ?? '-' }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Registration Fee'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Training Beg'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Hostel'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Mess'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Security Deposit Beg'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['ID Card'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Khelo India'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Khel Nursery'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Psychology'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Sport Science'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Laundry'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Nutrition'] ?? 0, 2) }}</td>
                            <td class="text-end">₹{{ number_format($feeHeads['Physio'] ?? 0, 2) }}</td>
                            <td class="text-end fw-bold">₹{{ number_format($totalPayable) }}</td>
                            <td class="text-end">₹{{ number_format($student->paid_fee ?? 0, 2) }}</td>
                            <td>
                                <a href="{{ url('student-detail-report/' . $student->userable_id) }}">
                                <img src="{{ asset('assets/eye.png') }}" alt="View Report" title="View Report"
                                    style="width: 20px; height: 20px; object-fit: contain; cursor: pointer;">
                                    </a>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>
