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
                            <h2 class="content-header-title float-start mb-0">Player Review</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Add New</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i
                                data-feather="arrow-left-circle"></i> Back</button>
                        @php
                        use Carbon\Carbon;
                        $activityDateObj = Carbon::parse($activityDate['date'] ?? null);
                        $today = Carbon::today();
                        @endphp

                        @if ($activityDateObj->lessThanOrEqualTo($today))
                        <button type="submit" id="submit" form="form"
                            class="btn btn-primary btn-sm mb-50 mb-sm-0">
                            <i data-feather="check-circle"></i> Submit
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <form id="form" name="form" action="{{ route('save-player-details') }}" method="POST">
                @csrf
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-body customernewsection-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div
                                                class="newheader border-bottom mb-2 pb-25 d-flex flex-wrap justify-content-between">
                                                <div>
                                                    <h4 class="card-title text-theme">Basic Information</h4>
                                                    <p class="card-text">Fill the details</p>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="scheduler_id" value="{{ $data->id }}">
                                        <input type="hidden" name="date" value="{{ $activityDate['date'] }}">



                                        <div class="contract-details">
                                            <div class="row">
                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Sports</h6>
                                                    <p class="font-small-3">{{ $data->sportRelation->sport_name }}</p>
                                                </div>
                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Date</h6>
                                                    <p class="font-small-3">{{ $activityDate['date'] }}</p>
                                                </div>

                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Start Time</h6>
                                                    <p class="font-small-3">
                                                        {{ \Carbon\Carbon::createFromFormat('H:i', $activityDate['start_time'])->format('h:i A') }}
                                                    </p>
                                                </div>

                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">End Time</h6>
                                                    <p class="font-small-3">
                                                        {{ \Carbon\Carbon::createFromFormat('H:i', $activityDate['end_time'])->format('h:i A') }}
                                                    </p>
                                                </div>



                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Batch Yr.</h6>
                                                    <p class="font-small-3">{{ $data->batch_year }}</p>
                                                </div>

                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Batch</h6>
                                                    <p class="font-small-3">{{ $data->batchRelation->batch_name }}</p>
                                                </div>

                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Section</h6>
                                                    <p class="font-small-3">{{ $data->sectionRelation->name }}</p>
                                                </div>

                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Group</h6>
                                                    <p class="font-small-3">{{ $data->groupRelation->name }}</p>
                                                </div>

                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Trainer</h6>
                                                    <p class="font-small-3">{{ $data->trainerRelation->name }}</p>
                                                </div>

                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Activity</h6>
                                                    <p class="font-small-3">{{ $data->activity }}</p>
                                                </div>

                                                <div class="col-md-3 mb-75 col-6">
                                                    <h6 class="fw-bolder text-dark mb-25">Sub-Activity</h6>
                                                    <p class="font-small-3">
                                                        @php
                                                        $subActivities = json_decode(
                                                        $data['sub_activities'],
                                                        true,
                                                        );
                                                        @endphp

                                                        @if (!empty($subActivities) && is_array($subActivities))
                                                        {{ implode(' , ', $subActivities) }}
                                                        @else
                                                        N/A
                                                        @endif
                                                    </p>
                                                </div>


                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body customernewsection-form">
                                    <div class="border-bottom mb-2 pb-25">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="newheader">
                                                    <h4 class="card-title text-theme">Batch Students</h4>
                                                    <p class="card-text">View the details</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive pomrnheadtffotsticky">
                                                <table
                                                    class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad">
                                                    <thead>
                                                        <tr>
                                                            <th width="30px">#</th>
                                                            <th>Reg. No</th>
                                                            <th>Player Name</th>
                                                            <th>DOJ</th>
                                                            <th>
                                                                <div
                                                                    class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox"
                                                                        class="form-check-input mt-0 present-checkbox"
                                                                        id="checkAll">
                                                                    <label class="form-check-label"
                                                                        for="checkAll">Present (Y/N)</label>
                                                                </div>
                                                            </th>
                                                            <th>Absence Reason</th>
                                                            <th>Activity Comment</th>
                                                            <th>Rating</th>
                                                            <th>Activity Color Code</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($students as $index => $stu)
                                                        @php
                                                        $data = $attendanceData[$stu->id] ?? [];
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $stu->document_number }}</td>
                                                            <td>{{ $stu->name }}</td>
                                                            <td>{{ $stu->doj }}</td>

                                                            <td>
                                                                <input type="hidden"
                                                                    name="students[{{ $stu->id }}][attendance]"
                                                                    value="absent">

                                                                <input type="checkbox" class="present-checkbox"
                                                                    name="students[{{ $stu->id }}][attendance]"
                                                                    value="present" data-id="{{ $stu->id }}"
                                                                    @if (!empty($data['attendance']) && $data['attendance']==='present' ) checked @endif>
                                                            </td>

                                                            <td>
                                                                <select
                                                                    name="students[{{ $stu->id }}][absence_reason]"
                                                                    class="form-select attendance-related absence-reason attendance-{{ $stu->id }}">
                                                                    <option value="">Select</option>
                                                                    @foreach (['Tournament', 'Rest', 'Injury', 'Sickness', 'Weekly Holiday', 'Sanctioned Leave', 'Unauthorised Leave'] as $reason)
                                                                    <option value="{{ $reason }}"
                                                                        @if (($data['absence_reason'] ?? '' )===$reason) selected @endif>
                                                                        {{ $reason }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>

                                                            <!-- <td>
                                                                        <select
                                                                            name="students[{{ $stu->id }}][activity_comment]"
                                                                            class="form-select attendance-related attendance-{{ $stu->id }}">
                                                                            <option value="">Select</option>
                                                                            @foreach (['Tournament', 'Rest', 'Injury', 'Sickness', 'Weekly Holiday', 'Sanctioned Leave', 'Unauthorised Leave'] as $comment)
                                                                                <option value="{{ $comment }}"
                                                                                    @if (($data['activity_comment'] ?? '') === $comment) selected @endif>
                                                                                    {{ $comment }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td> -->

                                                            <td>
                                                                <select name="students[{{ $stu->id }}][activity_comment]"
                                                                    class="form-select attendance-related attendance-{{ $stu->id }}">
                                                                    <option value="">--Select--</option>
                                                                    <option value="Shows consistent participation and enthusiasm." @if(($data['activity_comment'] ?? '' )==='Shows consistent participation and enthusiasm.' ) selected @endif>Shows consistent participation and enthusiasm.</option>
                                                                    <option value="Demonstrates improvement in physical fitness and stamina." @if(($data['activity_comment'] ?? '' )==='Demonstrates improvement in physical fitness and stamina.' ) selected @endif>Demonstrates improvement in physical fitness and stamina.</option>
                                                                    <option value="Exhibits strong coordination and skill development." @if(($data['activity_comment'] ?? '' )==='Exhibits strong coordination and skill development.' ) selected @endif>Exhibits strong coordination and skill development.</option>
                                                                    <option value="Participates actively and promotes team spirit." @if(($data['activity_comment'] ?? '' )==='Participates actively and promotes team spirit.' ) selected @endif>Participates actively and promotes team spirit.</option>
                                                                    <option value="Shows understanding of game rules and strategies." @if(($data['activity_comment'] ?? '' )==='Shows understanding of game rules and strategies.' ) selected @endif>Shows understanding of game rules and strategies.</option>
                                                                    <option value="Displays positive attitude and good sportsmanship." @if(($data['activity_comment'] ?? '' )==='Displays positive attitude and good sportsmanship.' ) selected @endif>Displays positive attitude and good sportsmanship.</option>
                                                                    <option value="Needs improvement in focus and consistency." @if(($data['activity_comment'] ?? '' )==='Needs improvement in focus and consistency.' ) selected @endif>Needs improvement in focus and consistency.</option>
                                                                    <option value="Shows potential; continued practice recommended." @if(($data['activity_comment'] ?? '' )==='Shows potential; continued practice recommended.' ) selected @endif>Shows potential; continued practice recommended.</option>
                                                                    <option value="Follows instructions and responds well to feedback." @if(($data['activity_comment'] ?? '' )==='Follows instructions and responds well to feedback.' ) selected @endif>Follows instructions and responds well to feedback.</option>
                                                                    <option value="Encouraged to build confidence in competitive settings." @if(($data['activity_comment'] ?? '' )==='Encouraged to build confidence in competitive settings.' ) selected @endif>Encouraged to build confidence in competitive settings.</option>
                                                                    <option value="Represents the team with discipline and dedication." @if(($data['activity_comment'] ?? '' )==='Represents the team with discipline and dedication.' ) selected @endif>Represents the team with discipline and dedication.</option>
                                                                    <option value="Maintains respect for teammates, opponents, and officials." @if(($data['activity_comment'] ?? '' )==='Maintains respect for teammates, opponents, and officials.' ) selected @endif>Maintains respect for teammates, opponents, and officials.</option>
                                                                    <option value="Demonstrates leadership and supports peers." @if(($data['activity_comment'] ?? '' )==='Demonstrates leadership and supports peers.' ) selected @endif>Demonstrates leadership and supports peers.</option>
                                                                    <option value="Achieved notable progress in skill execution." @if(($data['activity_comment'] ?? '' )==='Achieved notable progress in skill execution.' ) selected @endif>Achieved notable progress in skill execution.</option>
                                                                    <option value="Regularly attends and contributes to training sessions." @if(($data['activity_comment'] ?? '' )==='Regularly attends and contributes to training sessions.' ) selected @endif>Regularly attends and contributes to training sessions.</option>
                                                                </select>
                                                            </td>



                                                            <td>
                                                                <select
                                                                    name="students[{{ $stu->id }}][rating]"
                                                                    class="form-select attendance-related attendance-{{ $stu->id }} rating-select"
                                                                    data-id="{{ $stu->id }}">
                                                                    <option value="">Select</option>
                                                                    @foreach ($RatingScale as $rating)
                                                                    <option value="{{ $rating->id }}"
                                                                        @if(isset($data['rating']) && $data['rating']==$rating->id) selected @endif>
                                                                        {{ $rating->scores }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>

                                                            <td>
                                                                @php
                                                                $rating = $data['rating'] ?? '';
                                                                $badgeClass = 'bg-secondary';

                                                                switch ((int)$rating) {
                                                                case 1:
                                                                case 2:
                                                                case 3:
                                                                $badgeClass = 'bg-danger';
                                                                break;
                                                                case 4:
                                                                case 5:
                                                                $badgeClass = 'bg-warning';
                                                                break;
                                                                case 6:
                                                                case 7:
                                                                $badgeClass = 'bg-info';
                                                                break;
                                                                case 8:
                                                                case 9:
                                                                $badgeClass = 'bg-primary';
                                                                break;
                                                                case 10:
                                                                case 11:
                                                                $badgeClass = 'bg-success';
                                                                break;
                                                                }
                                                                @endphp


                                                                <span
                                                                    class="badge {{ $badgeClass }} badgeborder-radius p-25 rating-badge"
                                                                    id="badge-{{ $stu->id }}">&nbsp;</span>
                                                            </td>

                                                            <td>
                                                                <input type="text"
                                                                    name="students[{{ $stu->id }}][remarks]"
                                                                    class="form-control attendance-related attendance-{{ $stu->id }}"
                                                                    value="{{ $data['remarks'] ?? '' }}">
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

                </section>
            </form>


        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.rating-select').on('change', function() {
            const rating = $(this).val();
            const studentId = $(this).data('id');
            const badge = $('#badge-' + studentId);

            let badgeClass = 'bg-secondary';

            switch (parseInt(rating)) {
                case 1:
                    badgeClass = 'bg-danger';
                    break;
                case 2:
                    badgeClass = 'bg-danger';
                    break;
                case 3:
                    badgeClass = 'bg-danger';
                    break;
                case 4:
                    badgeClass = 'bg-warning';
                    break;
                case 5:
                    badgeClass = 'bg-warning';
                    break;
                case 6:
                    badgeClass = 'bg-info';
                    break;
                case 7:
                    badgeClass = 'bg-info';
                    break;
                case 8:
                    badgeClass = 'bg-primary';
                    break;
                case 9:
                    badgeClass = 'bg-primary';
                    break;
                case 10:
                    badgeClass = 'bg-success';
                    break;
                case 11:
                    badgeClass = 'bg-success';
                    break;
                default:
                    $badgeClass = 'bg-secondary';

            }


            badge.removeClass(function(index, className) {
                return (className.match(/(^|\s)bg-\S+/g) || []).join(' ');
            });

            badge.addClass(badgeClass);
        });
    });
</script>

<script>
    $(document).ready(function() {
        function toggleFields(studentId, isPresent) {
            if (isPresent) {
                $('.attendance-' + studentId).prop('disabled', false);
                $('.attendance-' + studentId + '.absence-reason').prop('disabled', true);
            } else {
                $('.attendance-' + studentId).prop('disabled', true);
                $('.attendance-' + studentId + '.absence-reason').prop('disabled', false);
            }
        }

        $('.present-checkbox').each(function() {
            var studentId = $(this).data('id');
            toggleFields(studentId, $(this).prop('checked'));

            $(this).on('change', function() {
                toggleFields(studentId, $(this).prop('checked'));
            });
        });

        $('#checkAll').on('change', function() {
            var isChecked = $(this).prop('checked');
            $('.present-checkbox').prop('checked', isChecked);

            $('.present-checkbox').each(function() {
                var studentId = $(this).data('id');
                toggleFields(studentId, isChecked);
            });
        });
    });
</script>
@endsection