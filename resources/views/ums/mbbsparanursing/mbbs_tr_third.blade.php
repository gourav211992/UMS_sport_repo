@extends("ums.admin.admin-meta")
@section("content")
   
    <div class="app-content content ">
        <h4>Tabular Record (TR)</h4>
    <form method="get">
    <div class="submitss text-end me-3">
        <button type="submit" class=" btn btn-primary btn-sm mb-50 mb-sm-0r waves-effect waves-float waves-light "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Submit</button>
        <button class="btn btn-warning btn-sm mb-50 mb-sm-0r " type="reset">
            <i data-feather="refresh-cw"></i> Reset
        </button>
    </div>


    <div class="col-md-12">
        <div class="row align-items-center mb-1">
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Courses:</label>
                <select data-live-search="true" name="course" id="course" style="border-color: #c0c0c0;" class="form-control" onchange="$('form').submit();">
                    <option value="">--Choose Course--</option>
                         @foreach($courses as $course)
                           <option value="{{$course->id}}" @if($course_id==$course->id) selected @endif >{{$course->name}}</option>
                             @endforeach
                         </select>
                         <span class="text-danger">{{ $errors->first('course') }}</span>
            </div>
    
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Semester:</label>
                <select aria-controls="DataTables_Table_0" class="form-control js-example-basic-single " name="semester" id="semester">
                    <option value="">--Select Semester--</option>
                    @foreach($semesters as $semester)
                    <option value="{{$semester->id}}" @if($semester_id==$semester->id) selected @endif >{{$semester->name}}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('semester') }}</span>
            </div>
    
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Form Type:</label>
                <select name="form_type" id="form_type" class="form-control" style="border-color: #c0c0c0;">
                    <option value="regular" @if(Request()->form_type=='regular') selected @endif >Regular</option>
                    <option value="compartment" @if(Request()->form_type=='compartment') selected @endif >Compartment</option>
                 </select>
                 <span class="text-danger">{{ $errors->first('semester') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row align-items-center mb-1">
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Academic Session:</label>
                <select name="session" id="session" class="form-control" style="border-color: #c0c0c0;">
                    @foreach($sessions as $session)
                    <option value="{{$session->academic_session}}" @if(Request()->session==$session->academic_session) selected @endif >{{$session->academic_session}}</option>
                    @endforeach
                 </select>
                 <span class="text-danger">{{ $errors->first('session') }}</span>           
            </div>
    
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Batch:</label>
                <select name="batch" id="batch" class="form-control" style="border-color: #c0c0c0;">
                    @foreach(batchArray() as $batch)
                    <option value="{{$batch}}" @if(Request()->batch==$batch) selected @endif >{{$batch}}</option>
                    @endforeach
                 </select>
                 <span class="text-danger">{{ $errors->first('batch') }}</span>
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
								   
                                <div class="table-responsive mb-3">
                                    <table id="dtHorizontalVerticalExample" class="table table-hover table-bordered table-sm-s "  cellspacing="0" width="100%">
	
                                        <thead>
                                                <tr>
                                                    <td rowspan="3">SN#</td>
                                                    <td rowspan="3">Roll No.</td>
                                                    <td rowspan="3">Name</td>
                                                    @foreach($subjects_group_all as $subjects_group)
                                                    <td class="text-center" colspan="{{$subjects_group->combined_count+2}}">{{$subjects_group->combined_subject_name}}</td>
                                                    <td class="text-center" colspan="3">{{$subjects_group->combined_subject_name}} Practical</td>
                                                    <td class="text-center" rowspan="2">Total</td>
                                                    @endforeach
                                                    <td rowspan="2">Grand Total</td>
                                                    <td rowspan="3">Result</td>
                                                </tr>
                                    
                                                <tr>
                                                    @foreach($subjects_group_all as $subjects_group)
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Theory')
                                                            <td class="text-center">{{$subject->sub_code}}</td>
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">ORAL</td>
                                                        <td class="text-center">I.A.</td>
                                                        <td class="text-center">Total</td>
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Practical')
                                                            <td class="text-center">Prac.</td>
                                                            <td class="text-center">I.A.</td>
                                                            <td class="text-center">Practical Total</td>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </tr>
                                    
                                                <tr>
                                                    @foreach($subjects_group_all as $subjects_group)
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Theory')
                                                            <td class="text-center">{{($subject->maximum_mark)}}</td>
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">{{($subjects_group->theory_oral)}}</td>
                                                        <td class="text-center">{{($subjects_group->theory_ia)}}</td>
                                                        <td class="text-center">{{$subjects_group->sub_theory_external}}</td>
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Practical')
                                                            <td class="text-center">{{$subject->maximum_mark}}</td>
                                                            <td class="text-center">{{$subject->internal_maximum_mark}}</td>
                                                            <td class="text-center">{{$subjects_group->sub_practical_internal}}</td>
                                                            @endif
                                                        @endforeach
                                                            <td class="text-center">{{$subjects_group->subjects_total}}</td>
                                                    @endforeach
                                                    <td>{{$subject_total}}</td>
                                                </tr>
                                        </thead>
                                        <tbody>		
                                                
                                                @foreach($students as $index=>$student)
                                                @php $grand_total = 0; @endphp
                                                @php $paper_total = 0; @endphp
                                                @php $result_array = array(); @endphp
                                                <tr>
                                                    <td class="text-center">{{++$index}}</td>
                                                    <td class="text-center">{{$student->roll_no}}</td>
                                                    <td class="text-center">{{strtoupper($student->student->first_Name)}}</td>
                                                    @foreach($student->subjects_group_all as $subjects_group)
                                                        @php $subject_theory_total = 0; @endphp
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Theory')
                                                                @if($subject->subject_result)
                                                                <td class="text-center">
                                                                @php $subject_theory_total = $subject_theory_total + ((int)$subject->internal_maximum_mark + (int)$subject->maximum_mark + (int)$subject->oral); @endphp
                                                                {{$subject->subject_result->external_marks}}
                                                                </td>
                                                                @else
                                                                    <td class="text-center">-</td>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <!-- <td class="text-center">{{($subjects_group->student_theory_ia)}}</td> -->
                                                        @if((Request()->session=='2021-2022' || Request()->session=='2022-2023') && (Request()->batch=='2017-2018' || Request()->batch=='2018-2019'))
                                                            <td class="text-center">{{($subjects_group->student_theory_oral)}}</td>
                                                            <td class="text-center">{{$subjects_group->student_theory_ia}}</td>
                                                        @else
                                                            <td class="text-center">{{$subjects_group->student_theory_ia}}</td>
                                                            <td class="text-center">{{($subjects_group->student_theory_oral)}}</td>
                                                        @endif
                                    
                                                        @php
                                                            $mbbs_mark_50_percentage = mbbs_mark_50_percentage($subject_theory_total,$subjects_group->student_theory_external);
                                                            $result_array[] = $mbbs_mark_50_percentage;
                                                        @endphp
                                                        <td class="text-center">{{$subjects_group->student_theory_external}}{{($mbbs_mark_50_percentage=='#')?'*':$mbbs_mark_50_percentage}}
                                    
                                                        @php $grand_total = $subjects_group->student_theory_external + $grand_total; @endphp
                                                        </td>
                                                        @php $student_practical_total_sum = 0; @endphp
                                                        @php $subject_practical_total = 0; @endphp
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Practical')
                                                                @if($subject->subject_result)
                                                                    @php $subject_practical_total = $subject_practical_total + ((int)$subject->internal_maximum_mark + (int)$subject->maximum_mark + (int)$subject->oral); @endphp
                                                                    <td class="text-center">{{$subject->subject_result->external_marks}}</td>
                                                                    @php $student_practical_total_sum = $student_practical_total_sum + (int)$subject->subject_result->external_marks; @endphp
                                                                @else
                                                                    <td class="text-center">-</td>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">{{$subjects_group->student_practical_internal}}
                                                        @php $student_practical_total_sum = $student_practical_total_sum + (int)$subjects_group->student_practical_internal; @endphp
                                                        </td>
                                                        @php
                                                            $mbbs_mark_50_percentage = mbbs_mark_50_percentage($subject_practical_total,$student_practical_total_sum);
                                                            $result_array[] = $mbbs_mark_50_percentage;
                                                        @endphp
                                                        <td class="text-center">{{$student_practical_total_sum}}{{($mbbs_mark_50_percentage=='#')?'*':$mbbs_mark_50_percentage}}
                                                        @php $grand_total = $student_practical_total_sum + $grand_total; @endphp
                                                        </td>
                                                        <td class="text-center">{{$subjects_group->student_theory_external + $student_practical_total_sum}}</td>
                                                    @endforeach
                                                    <td>{{$grand_total}}</td>
                                                    @php
                                                        $result = 'PASS';
                                                        $result_array = array_filter($result_array);
                                                        $result_failed = count(array_keys($result_array, "*"));
                                                        $result_pcp = count(array_keys($result_array, "#"));
                                                        if($result_failed > 0){
                                                            $result = 'FAIL';
                                                        }else if($result_pcp == 1){
                                                            $result = 'PASS WITH GRACE';
                                                        }else if($result_pcp > 1){
                                                            $result = 'FAIL';
                                                        }
                                                        mbbsUpdateTrResult($student->roll_no,Request()->semester,Request()->session,$subject_total,$grand_total,$result);
                                                        if($result=='PASS'){
                                                            $result = 'PASSED';
                                                        }
                                                        if($result=='FAIL'){
                                                            $result = 'FAILED';
                                                        }
                                                        if($result=='PASS WITH GRACE'){
                                                            $result = 'PASSED WITH GRACE';
                                                        }
                                                    @endphp
                                                    <td>{{$result}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
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