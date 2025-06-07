<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
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
        transform: scale(0.65); /* Shrink more */
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
              /* padding: 2px !important; */
              word-break: break-word;

          }
      }
  </style>
  
</head>
<body>
    <!-- Include Bootstrap CSS (if not already included) -->



<div class="container  py-5 px-0 mx-2" >

    <!-- Button Section -->
    <div class="d-flex justify-content-end gap-2 mb-3 no-print">
        <button type="button" onclick="window.history.back()" class="btn btn-secondary">
            Back
        </button>

        <button type="button" onclick="window.print()" class="btn btn-primary">
            Print Report
        </button>
    </div>

    <!-- Form Section -->
    <form id="form" class="center-form" method="post" action="/submit-report-comment">
        <div id="reportSection" class="border border-dark p-3" style="width: 1500px; font-family: Arial;">

            <!-- Header Table -->
            <table class="w-100 mb-3 text-dark text-center" style="font-size: 13px;">
                <tr>
                    <td class="fw-semibold fs-4">Sports Quest Centre of Excellence</td>
                </tr>
                <tr>
                    <td class="fs-6 py-2">Connecting Aspirations-Creating Champions</td>
                </tr>
                <tr>
                    <td class="fw-bold pt-2 fs-6" style="line-height: 18px;">
                        Attendance Between <br />
                        ({{ \Carbon\Carbon::parse($startDate)->format('d-M-Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('d-M-Y') }})
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold pt-2 fs-6" style="line-height: 18px;">
                        Attendance Report
                    </td>
                </tr>
            </table>

            <!-- Info Table -->
            <table class="table table-bordered border-dark table-sm text-dark" style="font-size: 13px; ">
                <tbody>
                  <tr>
                    <td class="fw-bold">1.</td>
                    <td class="fw-bold">Batch</td>
                    <td class="fw-bold">{{ $schedulers[0]->batchRelation->batch_name ?? 'All' }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">2.</td>
                    <td class="fw-bold">Section</td>
                    <td class="fw-bold">{{ $schedulers[0]->sectionRelation->name ?? 'All' }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">3.</td>
                    <td class="fw-bold">Group</td>
                    <td class="fw-bold">{{ $schedulers[0]->groupRelation->name ?? 'All' }}</td>
                </tr>
                
                    <tr>
                        <td class="fw-bold">4.</td>
                        <td class="fw-bold">Start Date</td>
                        <td class="fw-bold">{{ \Carbon\Carbon::parse($startDate)->format('d-M-Y') }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">5.</td>
                        <td class="fw-bold">End Date</td>
                        <td class="fw-bold">{{ \Carbon\Carbon::parse($endDate)->format('d-M-Y') }}</td>
                    </tr>
                 </tbody>
            </table> 

        <!-- </div>
    </form>
</div> -->

<!-- hell -->
@php
use Carbon\CarbonPeriod;

$start = \Carbon\Carbon::parse($startDate);
$end = \Carbon\Carbon::parse($endDate);
$period = CarbonPeriod::create($start, '1 day', $end);

// Group dates by month
$calendar = [];
foreach ($period as $date) {
    $monthKey = $date->format('Y-m');
    $calendar[$monthKey][] = $date;
}
@endphp

<div class="table-responsive d-print-block">
    @foreach ($calendar as $monthKey => $dates)
      @php
        $firstDateOfMonth = \Carbon\Carbon::parse($monthKey . '-01');
        $monthName = $firstDateOfMonth->format('F');
        $year = $firstDateOfMonth->format('Y');
        $currentMonth = $firstDateOfMonth->format('Y-m');
        $currentStudentIds = $monthWiseStudentIds[$currentMonth] ?? [];
      @endphp
  
      <table class="table table-bordered mb-4" style="font-size: 12px; border: 1px solid #000;">
        <!-- Header rows -->
        <tr class="table-secondary" style="border: 1px solid #000;">
            <th>Year</th>
            <th>{{ $year }}</th>
            <th>Date</th>
            @foreach ($dates as $date)
                <th>{{ $date->format('d') }}</th>
            @endforeach
        </tr>
  
        <tr class="table-secondary" style="border: 1px solid #000;">
            <th>Month</th>
            <th>{{ strtoupper($monthName) }}</th>
            <th>Type of Day</th>
            @foreach ($dates as $date)
                <th>{{ $date->dayOfWeek == 0 ? 'H' : 'W' }}</th>
            @endforeach
        </tr>
  
        <tr class="table-secondary" style="border: 1px solid #000;">
            <th>Emp.id</th>
            <th>Emp.name</th>
            <th>Day</th>
            @foreach ($dates as $date)
                <th>{{ ucwords(strtolower($date->format('D'))) }}</th>
            @endforeach
        </tr>
  
        <!-- Student attendance rows -->
        <tbody>
          @foreach($currentStudentIds as $studentId)
            @php
              $student = $studentDetails[$studentId] ?? null;
            @endphp
  
            @if($student)
              <tr>
                <td>{{ $student->registration_number }}</td>
                <td>{{ ucwords(strtolower($student->name)) }}</td>
                <td>{{ strtoupper($monthName) }}</td>
  
                @foreach($dates as $date)
                  @php
                    $d = $date->format('Y-m-d');
                    $isSunday = $date->dayOfWeek === 0;
                    $status = $reportData[$studentId][$d] ?? 'absent';
                  @endphp
  
                  <td class="bg-light text-center">
                    @if($isSunday)
                      <span class="badge bg-secondary">H</span>
                    @elseif($status === 'present')
                      <span class="fw-bold">P</span>
                    @else
                      <span class="badge bg-secondary">A</span>
                    @endif
                  </td>
                @endforeach
              </tr>
            
            @endif
          @endforeach
          @if(!$currentStudentIds)
          <tr>
            <td colspan="{{ 3 + count($dates) }}" class="text-center fw-bold">NO RECORD FOUND</td>
          </tr>
        @endif
        </tbody>
      </table>
    @endforeach
  </div>
  

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</body>
</html>