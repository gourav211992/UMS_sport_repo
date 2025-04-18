@extends("ums.admin.admin-meta")
@section('content')
{{-- <body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col=""> --}}
  
    <div class="app-content content ">
        <h4>MBBS TR For Batch 2019-2020 & 2020-2021</h4>

        <!-- options section -->
    {{-- <div class="col-md-12">
        <div class="row align-items-center mb-1">
            <div class="col-md-4 text-center">
                <label class="form-label ">Base Rate % <span class="text-danger">*</span></label>
                <input type="number" value="5" class="form-control ">
            </div>
            <div class="col-md-4 text-center">
                <label class="form-label">Effective from <span class="text-danger">*</span></label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-4 text-center">
                <label class="form-label">Additional Input <span class="text-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>
    </div> --}}
      
    {{-- <div class="submitss text-end me-3">
        <button onclick="javascript: history.go(-1)" class=" btn btn-primary btn-sm mb-50 mb-sm-0r waves-effect waves-float waves-light "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Submit</button>
        <button class="btn btn-warning btn-sm mb-50 mb-sm-0r " type="reset">
            <i data-feather="refresh-cw"></i> Reset
        </button>
    </div> --}}
@php
	$selected_semester = ($selectet_semester_data)?$selectet_semester_data->name:'';
	$selected_form_type = (Request()->form_type)?ucfirst(Request()->form_type):'';
	$selected_session = Request()->session;
	$selected_batch = '';
@endphp
    <form method="get">
        <div class="submitss text-end me-3">
            <button type="submit" onclick="javascript: history.go(-1)" class=" btn btn-primary btn-sm mb-50 mb-sm-0r waves-effect waves-float waves-light "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Submit</button>
            <button class="btn btn-warning btn-sm mb-50 mb-sm-0r " type="reset">
                <i data-feather="refresh-cw"></i> Reset
            </button>
        </div>
    <div class="col-md-12">
        <div class="row align-items-center mb-1">
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Courses:</label>
                <select data-live-search="true" name="course" id="course" class="form-control js-example-basic-single ">
                    <option value="49">MBBS</option>
                </select>
                <span class="text-danger">{{ $errors->first('course') }}</span>
            </div>
    
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Semester:</label>
                <select data-live-search="true" name="semester" id="semester" class="form-control js-example-basic-single" >
                    <option value="">--Select Semester--</option>
                    <option value="9" @if(Request()->semester=='9') selected @endif>THIRD PROFESSIONAL (PART-I)</option>
                    <option value="10" @if(Request()->semester=='10') selected @endif>THIRD PROFESSIONAL (PART-II)</option>
                </select>
                <span class="text-danger">{{ $errors->first('semester') }}</span>
            </div>
    
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Form Type:</label>
                <select name="form_type" id="form_type" class="form-control">
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
                <select name="session" id="session" class="form-control">
                    <option value="2023-2024" @if(Request()->session=='2023-2024') selected @endif>2023-2024</option>
                 </select>
                 <span class="text-danger">{{ $errors->first('session') }}</span>          
            </div>
    
            <div class="col-md-4 d-flex align-items-center">
                <label class="form-label mb-0 me-2 col-3">Batch:</label>
                <select name="batch" id="batch" class="form-control">
                    <option value="2019-2020" @if(Request()->batch=='2019-2020') selected @endif >2019-2020</option>
                    <option value="2020-2021" @if(Request()->batch=='2020-2021') selected @endif >2020-2021</option>
                 </select>
                 <span class="text-danger">{{ $errors->first('session') }}</span>
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
                                    <table id="dtHorizontalVerticalExample" class="table table-hover table-bordered table-sm-s "  cellspacing="0">

                                        <thead>
                                                <tr>
                                                    <td rowspan="3">SN#</td>
                                                    <td rowspan="3">ROLL NO.</td>
                                                    <td rowspan="3">NAME</td>
                                                    @foreach($subjects_group_all as $subjects_group)
                                                    <td class="text-center" colspan="{{$subjects_group->combined_count}}">{{strtoupper($subjects_group->combined_subject_name)}}</td>
                                                    <td class="text-center" >{{strtoupper($subjects_group->combined_subject_name)}} PRACTICAL</td>
                                                    <td class="text-center" rowspan="2">TOTAL</td>
                                                    <td class="text-center" colspan="3">INTERNAL ASSESSMENT</td>
                                                    @endforeach
                                                    <td rowspan="2">GRAND TOTAL</td>
                                                    <td rowspan="3">RESULT</td>
                                                </tr>
                                    
                                                <tr>
                                                    @foreach($subjects_group_all as $subjects_group)
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Theory')
                                                            <td class="text-center">{{$subject->sub_code}}</td>
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">Total</td>
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Practical')
                                                            <td class="text-center">{{$subject->sub_code}} (PRAC)</td>
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">THEORY</td>
                                                        <td class="text-center">PRACTICAL</td>
                                                        <td class="text-center">TOTAL</td>
                                                    @endforeach
                                                </tr>
                                    
                                                <tr>
                                                    @foreach($subjects_group_all as $subjects_group)
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Theory')
                                                            <td class="text-center">{{($subject->maximum_mark)}}</td>
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">{{$subjects_group->sub_theory_external}}</td>
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Practical')
                                                            <td class="text-center">{{$subject->maximum_mark}}</td>
                                                            <td class="text-center">{{$subjects_group->subjects_total}}</td>
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">{{$subjects_group->sub_theory_internal}}</td>
                                                        <td class="text-center">{{$subjects_group->sub_practical_internal}}</td>
                                                        <td class="text-center">{{$subjects_group->sub_theory_practical_internal}}</td>
                                                    @endforeach
                                                    <td>{{$subject_total}}</td>
                                                </tr>
                                        </thead>
                                        <tbody>		
                                                
                                                @foreach($students as $index=>$student)
                                                @php $result_array = array(); @endphp
                                                <tr>
                                                    <td class="text-center">{{++$index}}</td>
                                                    <td class="text-center">{{$student->roll_no}}</td>
                                                    <td class="text-center">{{strtoupper($student->student->first_Name)}}</td>
                                                    @foreach($student->subjects_group_all as $subjects_group)
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Theory')
                                                                @if($subject->subject_result)
                                                                    @php
                                                                        $theory_external_marks = $subject->subject_result->external_marks;
                                                                        $theory_max_marks = $subject->subject_result->max_external_marks;
                                                                        $mbbs_mark_40_percentage = mbbs_mark_40_percentage($theory_max_marks,$theory_external_marks);
                                                                        $result_array[] = $mbbs_mark_40_percentage;
                                                                    @endphp
                                                                    <td class="text-center">{{$theory_external_marks}}{{$mbbs_mark_40_percentage}}</td>
                                                                @else
                                                                    <td class="text-center">-</td>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">{{$subjects_group->student_theory_external}}</td>
                                                        @foreach($subjects_group->subjects as $subject)
                                                            @if($subject->subject_type=='Practical')
                                                                @if($subject->subject_result)
                                                                    @php
                                                                        $practical_external_marks = $subject->subject_result->external_marks;
                                                                        $practical_max_marks = $subject->subject_result->max_external_marks;
                                                                        $subjects_total = $subjects_group->subjects_total;
                                                                        $student_total = $subjects_group->student_total;
                                                                        $mbbs_mark_40_percentage = mbbs_mark_40_percentage($practical_max_marks,$practical_external_marks);
                                                                        $mbbs_mark_50_percentage = mbbs_mark_50_percentage($subjects_total,$student_total);
                                                                        $result_array[] = $mbbs_mark_40_percentage;
                                                                        $result_array[] = $mbbs_mark_50_percentage;
                                                                    @endphp
                                                                    <td class="text-center">{{$practical_external_marks}}{{$mbbs_mark_40_percentage}}</td>
                                                                    <td class="text-center">{{$student_total}}{{($mbbs_mark_50_percentage=='#')?'*':$mbbs_mark_50_percentage}}</td>
                                                                @else
                                                                    <td class="text-center">-</td>
                                                                    <td class="text-center">-</td>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <td class="text-center">{{$subjects_group->student_theory_internal}}</td>
                                                        <td class="text-center">{{$subjects_group->student_practical_internal}}</td>
                                                        <td class="text-center">{{$subjects_group->student_theory_practical_internal}}</td>
                                    
                                                    @endforeach
                                                    <td>{{$student->grand_total}}</td>
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
                                                        mbbsUpdateTrResult($student->roll_no,Request()->semester,Request()->session,$subject_total,$student->grand_total,$result);
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
   <script src="/assets/admin/js/jquery.min.js"></script>
        <script src="/assets/admin/js/jquery-ui.min.js"></script>
        <script src="/assets/admin/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/admin/css/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="/assets/admin/js/adminlte.js"></script>
        <script src="/assets/admin/js/bootstrap-select.js"></script>
        <script src="/assets/admin/js/custom-app.js"></script>
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		
    
        

<script>

function saveExternalValue($this){
	var markValue = $this.val();
	var roll_no = $this.data('rollno');
	var subject_code = $this.data('scode');
	var columnName = $this.data('type');
	var formData = {
		roll_no : roll_no,
		subject_code : subject_code,
		columnName : columnName,
		markValue : markValue,
		"_token": "{{ csrf_token() }}"
	};
	$.ajax({
		url : "{{route('saveExternalValue')}}",
		type: "POST",
		data : formData,
		success: function(data){
			console.log(data);
		},
	});
}

  	$(document).ready(function(){
  	$('#course').change(function() {
	var course=$('#course').val();
	var formData = {course:course,"_token": "{{ csrf_token() }}"}; //Array 
	$.ajax({
		url : "{{route('semester_list')}}",
		type: "POST",
		data : formData,
		success: function(data, textStatus, jqXHR){
			$('#semester_list').html(data);
		},
	});
});
/*
$('#dtHorizontalVerticalExample').DataTable({
	dom: 'Bfrtip',
	buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
	"paging":   false,
	"ordering": false,
	"info":     false,
	orientation: 'landscape',
});
*/  
});

$(document).ready(function() {
	$('#dd').on('click', function(e){
		$('input').each(function(){
			var currentValue = $(this).val();
			$(this).closest('td').text(currentValue);
			$(this).remove();
		});
		var html = "<html><head><meta charset='utf-8' /></head><body>" + document.getElementsByTagName("table")[0].outerHTML + "</body></html>";
		var blob = new Blob([html], { type: "application/vnd.ms-excel" });
		var a = document.getElementById("dd");
		// Use URL.createObjectURL() method to generate the Blob URL for the a tag.
		a.href = URL.createObjectURL(blob);

		var selmonth = $("#month option:selected").text();
		var selyear = $("#year option:selected").text();
		var show_agreement_type = $("#agreement_type option:selected").text();
		$('.show_agreement_type').text(show_agreement_type);


        
		a.download = "MBBR TR {{$selected_semester}} {{$selected_form_type}} Sesson:{{$selected_session}} Batch:{{$selected_batch}}.xls";
		
	});
});


		
</script>