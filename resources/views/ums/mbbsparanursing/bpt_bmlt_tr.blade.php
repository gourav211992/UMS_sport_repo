@extends("ums.admin.admin-meta")
@section('content')
   
    <div class="app-content content ">
        <h4>Tabular Record (TR)</h4>

  
    <form method="get">
    <div class="submitss text-end me-3">
        <button type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0r waves-effect waves-float waves-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            Submit
        </button>        
        <button class="btn btn-warning btn-sm mb-50 mb-sm-0r " type="reset">
            <i data-feather="refresh-cw"></i> Reset
        </button>
    </div>

    <div class="col-md-12">
        <div class="row align-items-center mb-1">
            <div class="col-md-3 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">COURSES <span class="text-danger ">*</span></label>
                <select name="course" id="course"  class="form-control" onchange="showSemesters($(this));">
                    <option value="">--Choose Course--</option>
                         @foreach($courses as $course)
                          
                           <option value="{{$course->id}}" @if($course_id==$course->id) selected @endif >{{$course->name}}</option>
                             @endforeach
                         </select>
                         <span class="text-danger">{{ $errors->first('course') }}</span>        
            </div>

            <div class="col-md-3 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Semester <span class="text-danger">*</span></label>
                <select name="semester" id="semester" class="form-control">
                    <option value="">--Select Semester--</option>
                    @foreach($semesters as $semester)
                             
                              <option value="{{$semester->id}}" @if($semester_id==$semester->id) selected @endif >{{$semester->name}}</option>
                                @endforeach
                                                   
                                 </select>
                             <span class="text-danger">{{ $errors->first('semester') }}</span>
                </div>
                
            <div class="col-md-3 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-5">Academic Session <span class="text-danger">*</span></label>
                <select name="session" id="session" class="form-control">
                    @foreach($sessions as $session)
                    <option value="{{$session->academic_session}}" @if(Request()->session==$session->academic_session) selected @endif >{{$session->academic_session}}</option>
                    @endforeach
                 </select>
                 <span class="text-danger">{{ $errors->first('session') }}</span>             
            </div>

                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2 col-3">Form Type <span class="text-danger ">*</span></label>
                    <select name="form_type" id="form_type" class="form-control">
                        <option value="regular" @if(Request()->form_type=='regular') selected @endif >Regular</option>
                        <option value="compartment" @if(Request()->form_type=='compartment') selected @endif >Compartment</option>
                     </select>
                     <span class="text-danger">{{ $errors->first('semester') }}</span>
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
                                    <table class="table" style="width: 100% !important;" id="example" cellpadding="0" cellspacing="0">
	
                                        @php $tdCount = 5; @endphp
                                        @foreach($subjects_group_all as $subjects_group)
                                            @if($subjects_group->subjects->count()>1)
                                            @php $tdCount = $tdCount + 7; @endphp
                                            @else
                                            @php $tdCount = $tdCount + 3; @endphp
                                            @endif
                                        @endforeach
                                        <thead>
                                            <tr style="border: none;">
                                                <td style="text-align: center;padding:5px;border: none;" colspan="{{$tdCount}}">
                                                <h5><b>DR. SHAKUNTALA MISRA NATIONAL REHABILITATION UNIVERSITY, LUCKNOW<br/>
                                                {{($semester_details)?$semester_details->name:''}} @if(Request()->form_type=='compartment') SUPPLEMENTARY @endif EXAMINATION RESULT, JAN-2024<br/>
                                                STATEMENT OF MARKS</b></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;padding:5px;border:1px solid #c9c9c9;" colspan="{{$tdCount}}">
                                                <b>
                                                    Name of the institution : {{($semester_details)?$semester_details->course->campuse->name:''}}<br/>
                                                    COURSE : {{($semester_details)?$semester_details->course->name:''}}<br/>
                                                    YEAR : {{($semester_details)?$semester_details->semester_number:''}}
                                                </b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="4" style="text-align: center;padding:5px;border:1px solid #c9c9c9;">SN#</td>
                                                <td rowspan="4" style="text-align: center;padding:5px;border:1px solid #c9c9c9;">ROLL NO.</td>
                                                <td rowspan="4" style="text-align: left;padding:5px;border:1px solid #c9c9c9;">NAME</td>
                                                @foreach($subjects_group_all as $subjects_group)
                                                    @if($subjects_group->subjects->count()>1)
                                                    <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;" colspan="7">{{strtoupper($subjects_group->combined_subject_name)}}</td>
                                                    @else
                                                    <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;" colspan="3">{{strtoupper($subjects_group->combined_subject_name)}}</td>
                                                    @endif
                                                @endforeach
                                                <td rowspan="3" style="text-align: center;padding:5px;border:1px solid #c9c9c9;">GRAND TOTAL</td>
                                                <td rowspan="4" style="text-align: center;padding:5px;border:1px solid #c9c9c9;">RESULT</td>
                                            </tr>
                                
                                            <tr>
                                                @foreach($subjects_group_all as $subjects_group)
                                                    @if($subjects_group->subjects->count()>1)
                                                    <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;" colspan="7">{{$subjects_group->subjects[0]->sub_code}}</td>
                                                    @else
                                                    <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;" colspan="3">{{$subjects_group->subjects[0]->sub_code}}</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @foreach($subjects_group_all as $subjects_group)
                                                    <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;" colspan="2">THEORY</td>
                                                    @foreach($subjects_group->subjects as $subject)
                                                        @if($subject->subject_type=='Practical')
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">T. TOTAL</td>
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;" colspan="2">PRACTICAL</td>
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">P. TOTAL</td>
                                                        @endif
                                                    @endforeach
                                                    <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">TOTAL</td>
                                                @endforeach
                                            </tr>
                                
                                            <tr>
                                                @foreach($subjects_group_all as $subjects_group)
                                                    <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">@if(Request()->form_type=='compartment') INT<br>(OLD)<br>NEW<br> @endif{{($subjects_group->theory_oral + $subjects_group->theory_ia)}}</td>
                                                    @foreach($subjects_group->subjects as $subject)
                                                        @if($subject->subject_type=='Theory')
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">@if(Request()->form_type=='compartment') EXT<br>(OLD)<br>NEW<br> @endif{{($subject->maximum_mark)}}</td>
                                                        @endif
                                                    @endforeach
                                                    @foreach($subjects_group->subjects as $subject)
                                                        @if($subject->subject_type=='Practical')
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$subjects_group->sub_theory_external}}</td>
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">@if(Request()->form_type=='compartment') INT<br>(OLD)<br>NEW<br> @endif{{$subject->internal_maximum_mark}}</td>
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">@if(Request()->form_type=='compartment') EXT<br>(OLD)<br>NEW<br> @endif{{$subject->maximum_mark}}</td>
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$subjects_group->sub_practical_internal}}</td>
                                                        @endif
                                                    @endforeach
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$subjects_group->subjects_total}}</td>
                                                @endforeach
                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$subject_total}}</td>
                                            </tr>
                                    </thead>
                                    <tbody>
                                            
                                            @foreach($students as $index=>$student)
                                            @php $grand_total = 0; @endphp
                                            @php $paper_total = 0; @endphp
                                            <tr>
                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{++$index}}</td>
                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$student->roll_no}}</td>
                                                <td style="text-align: left;padding:5px;border:1px solid #c9c9c9;">{{strtoupper($student->student->name)}}</td>
                                                @foreach($student->subjects_group_all as $subjects_group)
                                                @php $gace_mark_check = ''; @endphp
                                                    @foreach($subjects_group->subjects as $subject)
                                                    @php $result = $subject->subject_result; @endphp
                                                        @if($subject->subject_type=='Theory')
                                                            @if($result)
                                                            @php $backResult = $result->backResult(); @endphp
                                                            <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">
                                                            @if($result->max_internal_marks==0)
                                                            -
                                                            @else
                                                                @if($result->current_internal_marks)(@if($backResult){{$backResult->internal_marks}}@endif)@endif
                                
                                                                @if($result->current_internal_marks==null || (int)$result->internal_marks <= (int)$result->current_internal_marks)
                                                                    {{$result->internal_marks}}
                                                                @else
                                                                    {{$result->current_internal_marks}}
                                                                @endif
                                                            @endif
                                                            </td>
                                                            <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">
                                                            @if($result->max_external_marks==0)
                                                            -
                                                            @else
                                                                @if($result->current_external_marks)(@if($backResult){{$backResult->external_marks}}@endif)@endif
                                                                @if($result->current_external_marks==null || (int)$result->external_marks <= (int)$result->current_external_marks)
                                                                    {{$result->external_marks}}
                                                                @else
                                                                    {{$result->current_external_marks}}
                                                                @endif
                                                            @endif
                                                            </td>
                                                            @php $gace_mark_check = ($subjects_group->theory_grace_mark=='#')?'*':$subjects_group->theory_grace_mark; @endphp
                                                            @else
                                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">-</td>
                                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">-</td>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                
                                                    @php $grand_total = $subjects_group->student_theory_external + $grand_total; @endphp
                                                    @php $student_practical_total_sum = 0; @endphp
                                                    @php $student_practical_total_sum = $student_practical_total_sum + (int)$subjects_group->student_practical_internal; @endphp
                                                    @foreach($subjects_group->subjects as $subject)
                                                        @if($subject->subject_type=='Practical')
                                                        <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$subjects_group->student_theory_external}}{{($subjects_group->theory_grace_mark=='#')?'*':$subjects_group->theory_grace_mark}}
                                                            @if($result)
                                                            @php $backResult = $result->backResult(); @endphp
                                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">
                                                                @if($result->current_internal_marks)(@if($backResult){{$backResult->internal_marks}}@endif)@endif
                                                                @if($result->current_internal_marks==null || (int)$result->internal_marks <= (int)$result->current_internal_marks)
                                                                    {{$result->internal_marks}}
                                                                @else
                                                                    {{$result->current_internal_marks}}
                                                                @endif
                                                                </td>
                                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">
                                                                @if($result->current_external_marks)(@if($backResult){{$backResult->external_marks}}@endif)@endif
                                                                @if($result->current_external_marks==null || (int)$result->external_marks <= (int)$result->current_external_marks)
                                                                    {{$result->external_marks}}
                                                                @else
                                                                    {{$result->current_external_marks}}
                                                                @endif
                                                                </td>
                                                                @php $student_practical_total_sum = $student_practical_total_sum + (int)$subject->subject_result->external_marks; @endphp
                                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$student_practical_total_sum}}{{($subjects_group->practical_grace_mark=='#')?'*':$subjects_group->practical_grace_mark}}</td>
                                                                @php $gace_mark_check = ''; @endphp
                                                            @else
                                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">-</td>
                                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">-</td>
                                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">-</td>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @php $grand_total = $student_practical_total_sum + $grand_total; @endphp
                                                    <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$subjects_group->student_theory_external + $student_practical_total_sum}}{{$gace_mark_check}}</td>
                                                @endforeach
                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$grand_total}}</td>
                                                <td style="text-align: center;padding:5px;border:1px solid #c9c9c9;">{{$student->final_result}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="text-align: left;" colspan="{{($tdCount-5)}}">
                                                &nbsp;<br/>
                                                &nbsp;<br/>
                                                &nbsp;<br/>
                                                <b>P=PASSED, PCP=PROMOTED WITH CARRYOVER PAPERS, A=ABSENT, LG=LETTER GRADE, QP=QUALITY POINT, SGPA=SEMESTER GRADE POINT AVERAGE, WH=WITHHELD</b>
                                                </td>
                                                <td style="text-align: center;padding:5px;" colspan="{{($tdCount-($tdCount-5))}}">
                                                &nbsp;<br/>
                                                &nbsp;<br/>
                                                &nbsp;<br/>
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