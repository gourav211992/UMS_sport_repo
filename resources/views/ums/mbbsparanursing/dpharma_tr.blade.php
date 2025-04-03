@extends("ums.admin.admin-meta")
@section('content')
    
    <!-- BEGIN: Content-->

    <div class="app-content content ">
        <h4>Tabular Record (TR)</h4>

    <form method="get">
    <div class="col-md-12">
        <div class="row align-items-center mb-1">
            <div class="col-sm-2" style="display: none;">

                <span style="color: black;">COURSES:</span>
                <select name="course" id="course" style="border-color: #c0c0c0;" class="form-control" onchange="showSemesters($(this));">
                        @foreach($courses as $course)
                         
                          <option value="{{$course->id}}" @if($course_id==$course->id) selected @endif >{{$course->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('course') }}</span>
                </div>
            <div class="col-md-3 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Semester <span class="text-danger">*</span></label>
                <select name="semester" id="semester" style="border-color: #c0c0c0;" class="form-control">
                    <option value="">--Select Semester--</option>
                    @foreach($semesters as $semester)
                    <option value="{{$semester->id}}" @if($semester_id==$semester->id) selected @endif >{{$semester->name}}</option>
                    @endforeach       
                </select>
                <span class="text-danger">{{ $errors->first('semester') }}</span>
                </div>
                
            <div class="col-md-3 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-5">Academic Session <span class="text-danger">*</span></label>
                <select name="session" id="session" class="form-control" style="border-color: #c0c0c0;">
                    @foreach($sessions as $session)
                    <option value="{{$session->academic_session}}" @if(Request()->session==$session->academic_session) selected @endif >{{$session->academic_session}}</option>
                    @endforeach
                 </select>
                 <span class="text-danger">{{ $errors->first('session') }}</span>  
                </div>

                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2 col-3">Form Type <span class="text-danger ">*</span></label>
                    <select name="form_type" id="form_type" class="form-control" style="border-color: #c0c0c0;">
                        <option value="REGULAR" @if(Request()->form_type=='REGULAR') selected @endif >REGULAR</option>
                        <option value="BACK" @if(Request()->form_type=='BACK') selected @endif >BACK</option>
                     </select>
                     <span class="text-danger">{{ $errors->first('semester') }}</span>
                </div>

                <div class="col-md-2 submit text-end">
        <button type="submit" class=" btn btn-primary btn-sm mb-50 mb-sm-0r waves-effect waves-float waves-light "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Submit</button>
        
        <button onclick="window.location.reload()" class="btn btn-warning btn-sm mb-50 mb-sm-0r " type="reset">
            <i data-feather="refresh-cw"></i> Reset
        </button>
    </div>

        </div>
    </div>
    
</form>

    

<!-- options section end-->

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
              
                
            </div>
            <div class="content-body">
                 
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
								
								   
                                <div class="table-responsive">
                                    <table class="table" style="width: 100% !important;" id="example" cellpadding="0" cellspacing="0" border="1">

                                        <thead>
                                            <tr>
                                                <td style="text-align: center;padding:5px;border: none;" colspan="{{($subjects->count()*3)+5}}">
                                                    <h5><b>DR. SHAKUNTALA MISRA NATIONAL REHABILITATION UNIVERSITY, LUCKNOW<br>
                                                    FIRST YEAR  EXAMINATION RESULT, JAN-2024<br>
                                                    STATEMENT OF MARKS</b></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;padding:5px;border-top: 0px;" colspan="{{($subjects->count()*3)+5}}">
                                                    <b>
                                                        @if($semester_details)
                                                        Name of the institution : {{$semester_details->course->campuse->name}}<br>
                                                        COURSE : {{$semester_details->course->name}}<br>
                                                        YEAR : {{$semester_details->semester_number}}
                                                        @endif
                                                    </b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="4" style="border-top: 1px;">SN#</td>
                                                <td rowspan="4" style="border-top: 1px;">ROLL NO.</td>
                                                <td rowspan="4" style="border-top: 1px;">NAME</td>
                                                @foreach($subjects as $subject)
                                                <td colspan="3" style="border-top: 1px;text-align: center;">{{$subject->name}}</td>
                                                @endforeach
                                                <td rowspan="3" style="border-top: 1px;">Grand Total</td>
                                                <td rowspan="4" style="border-top: 1px;">RESULT</td>
                                            </tr>
                                
                                            <tr>
                                                @foreach($subjects as $subject)
                                                <td colspan="3" style="border-top: 1px;text-align: center;">{{$subject->sub_code}}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @foreach($subjects as $subject)
                                                <td style="border-top: 1px;">INT @if(Request()->form_type=='BACK') (OLD) NEW @endif</td>
                                                <td style="border-top: 1px;">EXT @if(Request()->form_type=='BACK') (OLD) NEW @endif</td>
                                                <td style="border-top: 1px;">TOTAL</td>
                                                @endforeach
                                            </tr>
                                
                                            <tr>
                                                @foreach($subjects as $subject)
                                                <td style="border-top: 1px;">{{$subject->internal_maximum_mark}}</td>
                                                <td style="border-top: 1px;">{{$subject->maximum_mark}}</td>
                                                <td style="border-top: 1px;">{{$subject->internal_maximum_mark + $subject->maximum_mark}}</td>
                                                @endforeach
                                                <td style="border-top: 1px;">{{$subjects->sum('internal_maximum_mark') + $subjects->sum('maximum_mark')}}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                
                                            @foreach($results as $index=>$result_single)
                                            @php
                                            $student = $result_single->student;
                                            $result_array = \App\Models\Result::select('*')
                                            ->where('roll_no',$result_single->roll_no)
                                            ->where('course_id',$result_single->course_id)
                                            ->where('semester',$result_single->semester)
                                            ->where('exam_session',$result_single->exam_session)
                                            ->where('back_status_text',$result_single->back_status_text)
                                            ->orderBy('subject_position','asc')
                                            ->get();
                                            $grand_total = 0;
                                            $result_status = 'PASSED';
                                            @endphp
                                            <tr>
                                                <td style="border-top: 1px;">{{++$index}}</td>
                                                <td style="border-top: 1px;">{{$result_single->roll_no}}</td>
                                                <td style="border-top: 1px;">{{$student->first_Name}}</td>
                                                @foreach($result_array as $result)
                                                @php
                                                $backResult = $result->backResult();
                                                $special_back_table_details = null;
                                                    if(Request()->form_type=='BACK'){
                                                        $result->form_type = 'final_back_paper';
                                                        $special_back_table_details = $result->special_back_table_details();
                                                    }
                                                @endphp
                                                <td style="border-top: 1px;">
                                                    @php $internal_marks_old = ($backResult)?$backResult->internal_marks:'-'; @endphp
                                                    @if($special_back_table_details && ($special_back_table_details->mid==1 || $special_back_table_details->ass==1 || $special_back_table_details->viva==1))
                                                    ({{$internal_marks_old}})
                                                    @endif
                                                     {{(int)$result->internal_marks}}
                                                </td>
                                                <td style="border-top: 1px;">
                                                    @php $external_marks_old = ($backResult)?$backResult->external_marks:'-'; @endphp
                                                    @if($special_back_table_details && ($special_back_table_details->external=='1' || $special_back_table_details->p_internal=='1' || $special_back_table_details->p_external=='1'))
                                                    ({{$external_marks_old}})
                                                    @endif
                                                    {{(int)$result->external_marks}}
                                                </td>
                                                @php 
                                                $papter_total = (int)$result->internal_marks + (int)$result->external_marks;
                                                $grand_total = $grand_total + $papter_total;
                                                if($result->grade_letter=='F'){
                                                    $result_status = 'FAILED';
                                                }
                                                @endphp 
                                                <td style="border-top: 1px; @if($result->grade_letter=='F') color:red; @endif ">{{$papter_total}}@if($result->grade_letter=='F') * @endif</td>
                                                @endforeach
                                                <td style="border-top: 1px;">{{$grand_total}}</td>
                                                <td style="border-top: 1px; @if($result->result=='PCP' || $result->result=='F') color:red; @endif ">{{$result->result_full}}</td>
                                            </tr>
                                            @endforeach
                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="border: none;text-align: left;" colspan="{{($subjects->count()*3)}}">
                                                    &nbsp;
                                                    <br> &nbsp;
                                                    <br> &nbsp;
                                                    <br>
                                                    <b>P=PASSED, PCP=PROMOTED WITH CARRYOVER PAPERS, A=ABSENT, LG=LETTER GRADE, QP=QUALITY POINT, SGPA=SEMESTER GRADE POINT AVERAGE, WH=WITHHELD</b>
                                                </td>
                                                <td style="border: none;text-align: center;padding:5px;" colspan="5">
                                                    &nbsp;
                                                    <br> &nbsp;
                                                    <br> &nbsp;
                                                    <br>
                                                    <b>CONTROLLER OF EXAMINATION</b>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        </table>      
                                    </div>
								
                            </div>

                            
                        </div>
                    </div>
                </section>
                 

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
<script>
    function showSemesters($this){
    var course = $this.val();
    window.location.href = "{{url('bpt_bmlt_tr')}}?course="+course;
}
</script>