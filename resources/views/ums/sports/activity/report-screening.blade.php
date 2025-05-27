@extends('ums.sports.sports-meta.admin-sports-meta')
<!-- Feather Icons -->
<style>
    .toast-success {
        background-color: #28a745 !important;
        color: white !important;
    }

    .toast-error {
        background-color: #dc3545 !important;
        color: white !important;
    }

    table {
        color: #000;
    }

    .toast-message {
        font-size: 14px;
    }

    h6 {
        color: #000;
    }

    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
@php
    $screeningTotalScore = [];

@endphp
@section('content')
    <div class="container" style="padding-top: 200px;">
        <form id="form" method="post" action="/submit-report-comment">
            <div id="reportSection"
                style="border: black thin solid; width:700px; padding: 10px; font-family:Arial; color:#000; ">
                <table style="width: 100%; font-size: 13px; margin-bottom: 10px; color:#000; " cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="text-align: center; font-weight: 600; font-size: 22px; ">Sports Quest Centre of
                            Excellence
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 14px; padding: 5px 0px;">Connecting Aspirations-Creating
                            Champions
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-weight: bold; padding-top: 20px; line-height: 18px;">
                            "Aspirant's Achievement <br />
                            (1st April to 30th April)"
                        </td>
                    </tr>

                </table>

                <table style="width: 100%; font-size: 13px; margin-bottom: 10px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; width: 5px; border-right: none;">
                            1.
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none;">
                            Training Session
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none;">
                            Jan - 2025 to June - 2025
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-right: none; border-top: none;">
                            2.
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                            Registration No
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none;">
                            {{ $studentDetails->registration_number }}
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-right: none; border-top: none;">
                            3.
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                            Batch ID
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none;">
                            {{ $studentDetails->batch_name }} </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-right: none; border-top: none;">
                            4.
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                            Player's Name
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none;">
                            {{ ucwords($studentDetails->name) . ' ' . ucwords($studentDetails->last_name) }} </td>

                    </tr>

                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-right: none; border-top: none;">
                            5.
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                            Parent's Name

                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none;">
                            {{ ucwords($studentDetails->parent_name) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-right: none; border-top: none;">
                            6.
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                            Address
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none;">
                            {{ ucwords($studentDetails->student_address) }} </td>
                    </tr>

                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-right: none; border-top: none;">
                            7.
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                            Contact No
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none;">
                            {{ ucwords($studentDetails->mobile_number) }}
                        </td>
                    </tr>

                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-right: none; border-top: none;">
                            8.
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                            Date
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none;">
                            {{ date('d-m-Y') }} </td>
                    </tr>

                </table>

                <h6 style="margin: 0px; font-size: 16px; padding-bottom: 6px; padding-top: 6px;">1) Attendance</h6>

                <table style="width: 100%; font-size: 13px; margin-bottom: 10px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; width: 5px; background: #dcd7d7; vertical-align: top;">
                            SN
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Activity
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Weightage
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Total No. of classes
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Classes Attended
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Attendance Percentage
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Scores(Round Down)
                        </th>
                    </tr>
                    <?php $activityTotalWeightage = 0;
                    $activityTotalScore = 0;
                    ?>

                    @foreach ($studentActivityData as $in => $activityItem)
                        @php
                            $activityTotalWeightage += $activityItem['weightage'];
                            $activityScore = floor(
                                ($activityItem['attendance_percentage'] * $activityItem['weightage']) / 100,
                            );
                            $activityTotalScore += $activityScore;
                        @endphp
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 5px; border-top: none;">
                                {{ $in + 1 }}
                            </td>
                            <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                                {{ ucwords($activityItem['activity']) }}
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; text-align: center;">
                                {{ $activityItem['weightage'] }}%
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; text-align: right;">
                                {{ $activityItem['total_classes'] }}
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; text-align: right;">
                                {{ $activityItem['total_attended'] }}
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; text-align: right;">
                                {{ $activityItem['attendance_percentage'] }}

                            </td>

                            <td
                                style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; text-align: right;">
                                {{ $activityScore }}
                            </td>
                        </tr>
                    @endforeach


                    <tr>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px; border-top: none; font-weight: bold; background: #dcd7d7;">
                            {{ $in + 2 }}
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; font-weight: bold; background: #dcd7d7;">
                            Total / Weighted Average
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; font-weight: bold; background: #dcd7d7; text-align: center; ">
                            {{ $activityTotalWeightage }}%
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; background: #dcd7d7; text-align: right;">

                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; background: #dcd7d7; text-align: right;">

                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; font-weight: bold; background: #dcd7d7; text-align: right;">

                        </td>

                        <td
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; font-weight: bold; background: #dcd7d7; text-align: right;">
                            {{ $activityTotalScore }}

                        </td>
                    </tr>


                </table>
                @php
                    // Group and handle missing ratings
                    foreach ($studentScreeningData as $month => $screenings) {
                        foreach ($screenings as $screeningEntries) {
                            foreach ($screeningEntries as $entry) {
                                $screening = $entry['screening_name'];
                                $parameter = $entry['parameter'];
                                $weightage = $entry['weightage'];
                                $rating = $entry['rating'];

                                $grouped[$screening][$parameter]['weightage'] = $weightage;

                                if ($rating === '-' && !empty($grouped[$screening][$parameter]['months'])) {
                                    // Get previous valid ratings
                                    $previousRatings = array_filter(
                                        $grouped[$screening][$parameter]['months'],
                                        fn($r) => $r !== '-',
                                    );

                                    // Use last valid rating if available
                                    $lastValidRating = end($previousRatings);
                                    $grouped[$screening][$parameter]['months'][$month] =
                                        $lastValidRating !== false ? $lastValidRating : '-';
                                } else {
                                    $grouped[$screening][$parameter]['months'][$month] = $rating;
                                }
                            }
                        }
                    }

                    // Month headers (formatted, e.g. Jan, Feb)
                    $allMonths = collect($studentScreeningData)
                        ->keys()
                        ->map(fn($month) => \Carbon\Carbon::parse($month . '-01')->format('M'))
                        ->unique()
                        ->toArray();

                    // Raw month keys (e.g. '2024-01') used for lookups
                    $monthKeys = collect($studentScreeningData)->keys()->toArray();
                @endphp
                <?php
                $lindex = 0;
                $indexforgrandTotal = 0;
                ?>
                @foreach ($grouped as $screeningName => $parameters)
                    @php
                        $totalScreeningScore = 0;
                        $remark = '';
                        $finalRowRemark = '';
                        $totalWeightage = 0;
                        $indexforgrandTotal = $loop->iteration;
                    @endphp

                    <h6 style="margin: 0px; font-size: 16px; padding-bottom: 6px; padding-top: 6px;">
                        {{ $loop->iteration }}) {{ ucwords($screeningName) }}
                    </h6>
                    <table style="width: 100%; font-size: 13px; margin-bottom: 10px;" cellspacing="0" cellpadding="0">
                        <tr>
                            <th rowspan="2" style="border: 1px solid #000; padding: 5px; background: #dcd7d7;">SN</th>
                            <th rowspan="2" style="border: 1px solid #000; padding: 5px; background: #dcd7d7;">Skill</th>
                            <th rowspan="2" style="border: 1px solid #000; padding: 5px; background: #dcd7d7;">Weightage
                            </th>
                            <th colspan="{{ count($allMonths) }}"
                                style="border: 1px solid #000; padding: 5px; background: #dcd7d7;">Out of 10</th>
                            <th rowspan="2" style="border: 1px solid #000; padding: 5px; background: #dcd7d7;">Scores
                            </th>
                            <th rowspan="2" style="border: 1px solid #000; padding: 5px; background: #dcd7d7;">Remarks
                            </th>
                        </tr>
                        <tr>
                            @foreach ($allMonths as $month)
                                <th style="border: 1px solid #000; padding: 5px;">{{ $month }}</th>
                            @endforeach
                        </tr>

                        @foreach ($parameters as $parameterName => $paramData)
                            @php
                                $ratings = $paramData['months'];
                                $weightage = $paramData['weightage'];
                                $totalRating = collect($ratings)->sum();
                                $count = collect($ratings)->count();
                                $totalWeightage += $weightage;
                            @endphp
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px;">{{ $loop->iteration }}</td>
                                <td style="border: 1px solid #000; padding: 5px;">{{ $parameterName }}</td>
                                <td style="border: 1px solid #000; padding: 5px; text-align:center;">{{ $weightage }}%
                                </td>

                                @foreach ($monthKeys as $rawMonth)
                                    @php
                                        $finalScore = 0;
                                    @endphp
                                    <td style="border: 1px solid #000; padding: 5px; text-align:right; ">
                                        {{ $paramData['months'][$rawMonth] ?? '-' }}
                                    </td>
                                    @php
                                        $monthIndex = array_search($rawMonth, $monthKeys);

                                        $rating = $paramData['months'][$rawMonth] ?? '-';

                                        if ($rating === '-' && $monthIndex > 0) {
                                            for ($i = $monthIndex - 1; $i >= 0; $i--) {
                                                $previousMonth = $monthKeys[$i];
                                                $previousRating = $paramData['months'][$previousMonth] ?? null;

                                                if ($previousRating !== null && $previousRating !== '-') {
                                                    $rating = $previousRating;
                                                    $finalScore = ((int) $rating * $weightage) / 100;
                                                    break;
                                                }
                                            }
                                        } else {
                                            $finalScore = ((int) $rating * $weightage) / 100;
                                        }

                                    @endphp
                                @endforeach



                                <td style="border: 1px solid #000; padding: 5px; text-align:right;">
                                    {{ $rating > 0 ? $finalScore : '-' }}</td>
                                <td style="border: 1px solid #000; padding: 5px; text-align:left;">
                                    {{ $ratingScaleArray[(int) $rating] }}</td>
                            </tr>
                            @php

                                $lindex = $loop->iteration++;
                                $totalScreeningScore += $finalScore;
                            @endphp
                        @endforeach

                        <tr>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px; border-top: none; font-weight: bold; background: #dcd7d7;">
                                {{ $lindex + 1 }}
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; font-weight: bold; background: #dcd7d7;">
                                Total / Weighted Average
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; font-weight: bold; background: #dcd7d7; text-align: center;">
                                {{ $totalWeightage }}%
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; background: #dcd7d7;">

                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; background: #dcd7d7;">

                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; background: #dcd7d7; text-align: right;">
                                {{ $totalScreeningScore }}
                            </td>
                            @php
                                $screeningTotalScore[$indexforgrandTotal] = $totalScreeningScore;
                            @endphp


                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; font-weight: bold; background: #dcd7d7; text-align: left;">
                                {{ $ratingScaleArray[(int) $totalScreeningScore] }}

                            </td>


                        </tr>
                    </table>
                @endforeach




                <h6 style="margin: 0px; font-size: 16px; padding-bottom: 6px; padding-top: 6px;">6) My Recommendations</h6>

                <table style="width: 100%; font-size: 13px; margin-bottom: 10px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; width: 5px; background: #dcd7d7; vertical-align: top;">
                            SN
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Coach Area
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Recommendations
                        </th> <input type="hidden" id="registration_id" name="registration_id"
                            value="{{ $sports_registers_id }}">
                    </tr>
                    @php

                    @endphp
                    @foreach ($allactivities as $index => $activityItem)
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 5px; border-top: none;">
                                {{ $index + 1 }}
                            </td>
                            <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                                Coach {{ ucwords($activityItem->activity_name) }}
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; text-align: center;">
                                <input type="text" name="report_comment[]" value="{{ $activityItem->comment }}"
                                    id="report_comment_{{ $activityItem->id }}" style="width: 94%; padding: 4px 8px;">
                            </td>
                        </tr>
                    @endforeach

                </table>

                <h6 style="margin: 0px; font-size: 16px; padding-bottom: 6px; padding-top: 6px;">7) What scores SAY?</h6>

                <table style="width: 100%; font-size: 13px; margin-bottom: 10px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; width: 5px; background: #dcd7d7; vertical-align: top;">
                            SN
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Criteria
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Weightage
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Scores
                        </th>
                        <th
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; background: #dcd7d7; vertical-align: top;">
                            Remarks
                        </th>
                    </tr>

                    <tr>
                        <td style="border: 1px solid #000; padding: 5px 5px; border-top: none;">
                            1
                        </td>
                        <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                            Attendance
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; text-align: center;">
                            20%
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; text-align: right;">
                            {{ floor($activityTotalScore / 10) }}
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; text-align: center;">
                            {{ $ratingScaleArray[floor($activityTotalScore / 10)] }}
                        </td>
                    </tr>



                    @foreach ($grouped as $screeningName => $parameters)
                        @php
                            $thiScore = $screeningTotalScore[$loop->iteration];
                        @endphp
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 5px; border-top: none;">
                                {{ $loop->iteration + 1 }}
                            </td>
                            <td style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none;">
                                {{ ucwords($screeningName) }}
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; text-align: center;">
                                20%
                            </td>
                            <td
                                style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; text-align: right;">
                                {{ $thiScore }}
                            </td>

                            <td
                                style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; text-align: center;">
                                {{ $ratingScaleArray[floor((int) $thiScore)] }}
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px; border-top: none; font-weight: bold; background: #dcd7d7;">
                            7
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; font-weight: bold; background: #dcd7d7;">
                            Total / Weighted Average
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; font-weight: bold; background: #dcd7d7; text-align: center;">
                            100%
                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px;  border-top: none; border-left: none; background: #dcd7d7;">

                        </td>
                        <td
                            style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; font-weight: bold; background: #dcd7d7; text-align: center;">

                        </td>
                    </tr>

                </table>


                <table style="width: 100%; font-size: 13px; margin-bottom: 10px; padding-top: 35px;" cellspacing="0"
                    cellpadding="0">
                    <tr>
                        <td style="border-top: 1px solid #000; width: 40%;"></td>
                        <td style="width: 20%;"></td>
                        <td style="border-top: 1px solid #000; width: 40%;"></td>
                    </tr>

                    <tr>
                        <td style="text-align: center; padding-top: 10px;">
                            "Head Coach <br>
                            Sports Quest (COE)"
                        </td>
                        <td></td>
                        <td style="text-align: center; padding-top: 10px;">
                            "Dr. Ameeta Sinh <br>
                            Founder Chairman, Sports Quest"
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold; padding-top: 20px; font-size: 14px;">Report Criteria
                            and
                            Ratings</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding-top: 8px;">
                            Please note that the intention of generating the report card is merely to draw your attention
                            towards
                            areas of improvements and your significant improvements in skills and unwinding of hidden
                            potentials.
                            The rating scores will keep changing with your hard work and determination.
                            Do not compare the score card with teammates as it is very individual and unique.
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; font-size: 13px;  padding-top: 15px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width: 45%;">
                            <table style="width: 100%; font-size: 13px; margin-bottom: 10px;" cellspacing="0"
                                cellpadding="0">
                                <tr>
                                    <th colspan="2"
                                        style=" text-align: center; border: 1px solid #000; padding: 5px 5px; width: 5px; background: #dcd7d7; vertical-align: top;">
                                        Rating Scale
                                    </th>
                                </tr>

                                <tr>
                                    <td
                                        style="border: 1px solid #000; padding: 5px 5px; border-top: none; text-align: center; font-weight: bold; background: #f4ebeb;">
                                        Scores
                                    </td>

                                    <td
                                        style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; text-align: center; font-weight: bold; background: #f4ebeb;">
                                        Remarks
                                    </td>
                                </tr>
                                @foreach ($allRatingScale as $index => $scaleItem)
                                    @if ($scaleItem->scores <= 5)
                                        <tr>
                                            <td
                                                style="border: 1px solid #000; padding: 5px 5px; border-top: none; text-align: center;">
                                                {{ $scaleItem->scores }}

                                            </td>

                                            <td
                                                style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; text-align: center;">
                                                {{ $scaleItem->remarks }}

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach


                            </table>
                        </td>
                        <td style="width: 10%;"></td>
                        <td style="width: 45%;">
                            <table style="width: 100%; font-size: 13px; margin-bottom: 10px;" cellspacing="0"
                                cellpadding="0">
                                <tr>
                                    <th colspan="2"
                                        style=" text-align: center; border: 1px solid #000; padding: 5px 5px; width: 5px; background: #dcd7d7; vertical-align: top;">
                                        Rating Scale
                                    </th>
                                </tr>

                                <tr>
                                    <td
                                        style="border: 1px solid #000; padding: 5px 5px; border-top: none; text-align: center; font-weight: bold; background: #f4ebeb;">
                                        Scores
                                    </td>

                                    <td
                                        style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; text-align: center; font-weight: bold; background: #f4ebeb;">
                                        Remarks
                                    </td>
                                </tr>
                                @foreach ($allRatingScale as $index => $scaleItem)
                                    @if ($scaleItem->scores > 5)
                                        <tr>
                                            <td
                                                style="border: 1px solid #000; padding: 5px 5px; border-top: none; text-align: center;">
                                                {{ $scaleItem->scores }}
                                            </td>

                                            <td
                                                style="border: 1px solid #000; padding: 5px 5px; border-left: none; border-top: none; text-align: center;">
                                                {{ $scaleItem->remarks }} </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </table>
                        </td>
                    </tr>
                </table>

                <div style="text-align: center; margin-top: 20px;">
                    <button type="button" class="no-print"
                        style="padding: 6px 20px; margin-right: 10px; border-radius: 5px; border: 1px solid #6c757d; background: #6c757d;  color: #fff;">Back</button>
                    <button type="button" id="previewBtn" class="no-print"
                        style="padding: 6px 20px; margin-right: 10px; border-radius: 5px; border: 1px solid #0069d9; color: #fff; background: #0069d9;">Preview</button>
                    <button form="form" id="submit" class="no-print"
                        style="padding: 6px 20px; border-radius: 5px; border: 1px solid #218838; background: #218838; color: #fff;">Submit</button>
                </div>

            </div>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script>
        $(document).ready(function() {
            const csrfToken = "{{ csrf_token() }}";
            $('#submit').on('click', function(e) {
                e.preventDefault();

                let isValid = true;
                const remarkArray = [];

                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger').remove();

                // Validate registration_id
                const registrationId = $('#registration_id').val();
                if (!registrationId || registrationId.trim() === '') {
                    isValid = false;
                    $('#registration_id').addClass('is-invalid');
                    $('<div>', {
                        class: 'text-danger',
                        text: 'Registration ID is required.'
                    }).insertAfter('#registration_id');
                }

                // Loop through all input fields
                $('input[name="report_comment[]"]').each(function() {
                    const input = $(this);
                    const idAttr = input.attr('id');
                    const match = idAttr.match(
                        /report_comment_\s*(\d+)/); // Note: your id has a space after "_"
                    const comment = input.val();

                    if (match) {
                        const activityId = parseInt(match[1]);

                        if (!comment || comment.trim() === '') {
                            isValid = false;
                            input.addClass('is-invalid');
                            $('<div>', {
                                class: 'text-danger',
                                text: 'Comment is required.'
                            }).insertAfter(input);
                        } else {
                            remarkArray.push({
                                activity_id: activityId,
                                comment: comment.trim()
                            });
                        }
                    }
                });

                if (!isValid) return;

                const postData = {
                    registration_id: registrationId,
                    remark: remarkArray,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.post("{{ route('submit-report-comment') }}", postData)
                    .done(function(response) {
                        toastr.success(response.message || 'Comments saved successfully.');
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);
                    })
                    .fail(function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong.');
                        console.error(xhr.responseText);
                    });
            });

            $('#previewBtn').on('click', function() {
                var printContents = $('#reportSection').html();
                var originalContents = $('body').html();

                $('body').html(printContents);
                window.print();
                $('body').html(originalContents);
                location.reload(); // Optional: reload to restore original JS/CSS/events
            });

        });
    </script>
@endsection
