<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Attendance Report</title>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                margin: 0;
                padding: 0;
            }

            @page {
                size: A4 landscape;
                margin: 10mm;
            }

            .no-print {
                display: none !important;
            }

            .table-responsive {
                overflow: visible !important;
                display: block !important;
            }

            #reportSection {
                transform: scale(0.65);
                transform-origin: top left;
                width: 100%;
            }

            table {
                width: 100% !important;
                border-collapse: collapse;
                font-size: 10px !important;
                page-break-inside: avoid;
            }

            th, td {
                word-break: break-word;
            }
        }
    </style>
</head>
<body>

@php
    use Carbon\Carbon;
    use Carbon\CarbonPeriod;

    $start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);
    $period = CarbonPeriod::create($start, '1 day', $end);
    $calendar = [];

    foreach ($period as $date) {
        $monthKey = $date->format('Y-m');
        $calendar[$monthKey][] = $date;
    }

    $groupedSchedulers = collect($schedulers)->groupBy('batch_name');
@endphp

<div class="container py-5 px-0 mx-2">
    <div class="d-flex justify-content-end gap-2 mb-3 no-print">
        <button type="button" onclick="window.history.back()" class="btn btn-secondary">Back</button>
        <button type="button" onclick="window.print()" class="btn btn-primary">Print Report</button>
    </div>

    @foreach ($groupedSchedulers as $batchId => $entries)
        @php
            $batchName = $entries->first()->batchRelation->batch_name ?? 'N/A';
            $batchSchedulerIds = $entries->pluck('id')->toArray();

            $studentIds = collect($attendanceDetails)
                ->whereIn('scheduler_id', $batchSchedulerIds)
                ->flatMap(function($item) {
                    $students = json_decode($item->students, true);
                    return is_array($students) ? array_keys($students) : [];
                })
                ->unique()
                ->values()
                ->all();

            $batchStudentDetails = collect($studentDetails)->only($studentIds);
            $batchReportData = collect($reportData)->only($studentIds);

            $batchMonthWiseStudentIds = [];
            foreach ($calendar as $monthKey => $dates) {
                $monthStudentIds = [];
                foreach ($studentIds as $id) {
                    foreach ($dates as $date) {
                        $d = $date->format('Y-m-d');
                        if (isset($batchReportData[$id][$d])) {
                            $monthStudentIds[] = $id;
                            break;
                        }
                    }
                }
                $batchMonthWiseStudentIds[$monthKey] = array_unique($monthStudentIds);
            }
        @endphp

        <form method="post" action="/submit-report-comment" class="mb-5">
            @csrf
            <div id="reportSection" class="border border-dark p-3 report-section" style="width: 1500px; font-family: Arial;">
                
                {{-- Header Info --}}
                <table class="w-100 mb-3 text-dark text-center" style="font-size: 13px;">
                    <tr><td class="fw-semibold fs-4">Sports Quest Centre of Excellence</td></tr>
                    <tr><td class="fs-6 py-2">Connecting Aspirations-Creating Champions</td></tr>
                    <tr><td class="fw-bold pt-2 fs-6">Attendance Between <br />({{ $start->format('d-M-Y') }} to {{ $end->format('d-M-Y') }})</td></tr>
                    <tr><td class="fw-bold pt-2 fs-6">Attendance Report</td></tr>
                </table>

                {{-- Info Table --}}
                <table class="table table-bordered border-dark table-sm text-dark" style="font-size: 13px;">
                    <tbody>
                        <tr><td class="fw-bold">1.</td><td class="fw-bold">Batch</td><td class="fw-bold">{{ $batchName }}</td></tr>
                        <tr><td class="fw-bold">2.</td><td class="fw-bold">Section</td>
                            <td class="fw-bold">
                                @php
                                    $sections = $entries->pluck('sectionRelation.name')->unique()->filter()->values();
                                    echo $sections->count() ? implode(', ', $sections->toArray()) : 'All';
                                @endphp
                            </td>
                        </tr>
                        <tr><td class="fw-bold">3.</td><td class="fw-bold">Group</td>
                            <td class="fw-bold">
                                @php
                                    $groups = $entries->pluck('groupRelation.name')->unique()->filter()->values();
                                    echo $groups->count() ? implode(', ', $groups->toArray()) : 'All';
                                @endphp
                            </td>
                        </tr>
                        <tr><td class="fw-bold">4.</td><td class="fw-bold">Start Date</td><td class="fw-bold">{{ $start->format('d-M-Y') }}</td></tr>
                        <tr><td class="fw-bold">5.</td><td class="fw-bold">End Date</td><td class="fw-bold">{{ $end->format('d-M-Y') }}</td></tr>
                    </tbody>
                </table>

                {{-- If no student --}}
                @if (empty($studentIds))
                    <table class="table table-bordered mt-3">
                        <tr>
                            <td class="text-center fw-bold text-danger" style="font-size: 16px;">
                                NO RECORD FOUND
                            </td>
                        </tr>
                    </table>
                @else
                    {{-- Monthly Attendance Tables --}}
                    <div class="table-responsive d-print-block">
                        @foreach ($calendar as $monthKey => $dates)
                            @php
                                $firstDateOfMonth = Carbon::parse($monthKey . '-01');
                                $monthName = $firstDateOfMonth->format('F');
                                $year = $firstDateOfMonth->format('Y');
                                $currentStudentIds = $batchMonthWiseStudentIds[$monthKey] ?? [];
                            @endphp

                            @if (!empty($currentStudentIds))
                                <table class="table table-bordered mb-4" style="font-size: 12px; border: 1px solid #000;">
                                    <tr class="table-secondary">
                                        <th>Year</th><th>{{ $year }}</th><th>Date</th>
                                        @foreach ($dates as $date)
                                            <th>{{ $date->format('d') }}</th>
                                        @endforeach
                                    </tr>
                                    <tr class="table-secondary">
                                        <th>Month</th><th>{{ strtoupper($monthName) }}</th><th>Type of Day</th>
                                        @foreach ($dates as $date)
                                            <th>{{ $date->dayOfWeek == 0 ? 'H' : 'W' }}</th>
                                        @endforeach
                                    </tr>
                                    <tr class="table-secondary">
                                        <th>Emp.id</th><th>Emp.name</th><th>Day</th>
                                        @foreach ($dates as $date)
                                            <th>{{ ucwords(strtolower($date->format('D'))) }}</th>
                                        @endforeach
                                    </tr>

                                    <tbody>
                                        @foreach ($currentStudentIds as $studentId)
                                            @php $student = $batchStudentDetails[$studentId] ?? null; @endphp
                                            @if ($student)
                                                <tr>
                                                    <td>{{ $student->registration_number }}</td>
                                                    <td>{{ ucwords(strtolower($student->name)) }}</td>
                                                    <td>{{ strtoupper($monthName) }}</td>
                                                    @foreach ($dates as $date)
                                                        @php
                                                            $d = $date->format('Y-m-d');
                                                            $isSunday = $date->dayOfWeek === 0;
                                                            $status = $batchReportData[$studentId][$d] ?? null;
                                                        @endphp
                                                        <td class="text-center">
                                                            @if ($isSunday)
                                                                <span class="badge bg-secondary">H</span>
                                                            @elseif ($status === 'present')
                                                                <span class="fw-bold">P</span>
                                                            @elseif ($status === 'absent')
                                                                <span class="badge bg-secondary">A</span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </form>
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</body>
</html>
