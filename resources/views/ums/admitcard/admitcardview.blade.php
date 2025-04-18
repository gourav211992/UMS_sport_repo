@if(Request()->segment(1)=='admin')
@php $layout_check = 'ums.layouts.app1'; @endphp
@elseif(Request()->segment(1)=='student')
@php $layout_check = 'ums.layouts.app1'; @endphp
@else
@php $layout_check = 'ums.layouts.app1'; @endphp
@endif

@extends($layout_check)

{{-- Web site Title --}} 
@section('title') Admit Card Download :: @parent @stop 

@section('content')

@section('styles')
<style type="text/css">
@media print {
	strong,p,td,th,h5,li,b,code{
		font-size:18px;
	}
	 .break_print{page-break-after: always;}
	 * {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
    color-adjust: exact !important;                 /*Firefox*/
}
.pae_conainter{
    border: none !important;
}
}
.admit-card {border: 2px solid #000;
				padding: 15px;
				margin: 20px 0;}
	body {background: #ffff !important;}
	div.heading {justify-content: space-between;
				margin-left: 25%;}
.viewapplication-form p {
    color: #939393;
    font-weight: bold;
    border: #eee thin solid;
    min-height: 40px;
    border-radius: 4px;
    padding: 6px;
    background: #fefefe;
}
.pae_conainter{
    border: black thin solid;
    width:700px;
    padding: 10px;
    font-family:Arial;
}
.candidate_photograph{
	width: 120px;
    height: 130px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: top;
}
.candidate_signature{
	width: 120px;
    height: 50px;
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
}
.headingfontsize{
    font-size: 14px;
}
</style>
@endsection

@if(!$AdmitCard->examfee)
{{dd('Exam Form Not Available.')}}
@endif
@if($AdmitCard->examfee->bank_name==null || $AdmitCard->examfee->bank_name=='')
{{dd('Payment Not Done.')}}
@endif

@if($AdmitCard)

<p style="text-align: center; margin-top: 0px; cursor: pointer; margin-bottom: 0px;"><button onclick="window.print();" class="noPrint"> <img src="{{asset('assets\frontend\images\print.png')}}" style="height: 12px; margin-top: 2px;"> Print</button></p>
<center>
<div class="pae_conainter" style="border:none;text-align:left;">
{{date('d-m-Y')}}
</div>
</center>
<center>
<div class="pae_conainter">

        <p style="text-align: center; margin-bottom: 0px; margin-top: 0px;"><img src="{{asset('assets\frontend\images\cerlogo.png')}}" alt=""></p> 
        <p class="headingfontsize"><b>{{$examfee->course->name}} EXAMINATION {{strtoupper($AdmitCard->current_exam_session)}}</b></p>
        <h5 style="text-align: center;  margin-bottom: 0px; margin-top: 0px; line-height: 5px;">
        @if($examfee->form_type == 'back_paper')
        BACK
        @elseif($examfee->form_type == 'final_back_paper')
        BACK / FINAL BACK
        @elseif($examfee->form_type == 'special_back')
        SPECIAL BACK
        @elseif($examfee->form_type == 'regular')
        REGULAR
        @endif
        PAPER EXAMINATION ADMIT CARD</h5>

        <table style="font-size: 12px; width: 100%; margin-top: 20px;" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <table style="font-size: 12px; width: 100%;" cellspacing="0" cellpadding="0">
                        <tr>
                                <td>
                                    <p style="margin-top: 0;"> <strong>1. Roll No:</strong></p> 
                                </td>
            
                                <td style=" vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$examfee->roll_no}}</p>
                                
                                </td>
                        </tr>
            
                        <tr>
                            <td>
                                <p style="margin-top: 0;"> <strong>2. Enrollment No. :</strong> </p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$examfee->enrollment_no}}</p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p style="margin-top: 0;"> <strong>3. Institute Name. :</strong> </p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$AdmitCard->center->center_code}} :- ( {{ $AdmitCard->examfee->course->campuse->name }})</p>
                            </td>
                        </tr>
            
                        <tr>
                            <td>
                                <p style="margin-top: 0;"> <strong>4. Name of the Student :</strong> </p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0; text-transform: uppercase;">{{$examfee->students->full_name}}</p>
                            </td>
                        </tr>
            
                        <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>5. Father’s Name :</Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$examfee->students->father_name}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>6. Mother’s Name :</Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$examfee->students->mother_name}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>7. Course :</Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$examfee->course->name}}</p>
                            </td>
                        </tr>            
                        <!-- <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>8. Branch/Stream :</Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">
                                @if($examfee->students && $examfee->students->enrollments && $examfee->students->enrollments->stream)
                                {{$examfee->students->enrollments->stream->name}}
                                @else
                                {{$examfee->course->name}}
                                @endif
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>9. Sem/Prof :</Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$examfee->semesters->name}}</p>
                            </td>
                        </tr> -->
                        <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>8.Category</Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$examfee->students->category}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>9. Category of Disability :<br>
                                    (if any)  </Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$examfee->students->disabilty_category}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>10. Exam Center :</Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{$AdmitCard->center->center_name}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <p style="margin-top: 0px;"> <Strong>11. Writer/Scribe Required</Strong></p>
                            </td>
                            <td style="vertical-align: bottom; margin-top: 0;">
                                <p style="border-bottom: black thin solid; margin-top: 0;">{{ucfirst($examfee->scribe)}}</p>
                            </td>
                        </tr>
                       
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table style="width: 50%; font-size: 12px; text-align: center; padding-left: 20px;float:right; margin-left:20px" cellspacing="0" cellpadding="0" border="2">
                    <tr>
                        <td>
						<div class="candidate_photograph">
                        @if($student_details && $student_details->photo)
                        <img style="height:130px; width: 120px;" src="{{$student_details->photo}}" alt="">
                        @elseif($examData_photo && $examData_photo->photo)
                        <img style="height:130px; width: 120px;" src="{{$examData_photo->photo}}" alt="">

                        @endif
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px; border-top-width: 2px;">
						<div class="candidate_signature">
                        @if($student_details && $student_details->signature)
                        <img style="height:50px; width: 120px;" src="{{$student_details->signature}}" alt="">
                        @elseif($examData_photo && $examData_photo->signature)
                        <img style="height:50px; width: 120px;" src="{{$examData_photo->signature}}" alt="">
                        @endif
                        </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="font-size: 12px; width: 100%; text-align: center;" cellspacing="0" cellpadding="0">
        <tr>
            <td style="border: black thin solid; border-right: none;"> <strong>S No.</strong></td>
            <td style="border: black thin solid; border-right: none;">  <strong>Date</strong> </td>
            <td style="border: black thin solid; border-right: none;">  <strong>Shift</strong> </td>
            @if($examfee->form_type!='regular')
            <td style="border: black thin solid; border-right: none;">  <strong>MID / ASS.</strong> </td>
            <td style="border: black thin solid; border-right: none;">  <strong>EXT.</strong> </td>
            <td style="border: black thin solid; border-right: none;">  <strong>VIVA</strong> </td>
            <td style="border: black thin solid; border-right: none;">  <strong>P INT. / P EXT.</strong> </td>
            @endif
            <td style="border: black thin solid; border-right: none;">  <strong>Paper Code</strong> </td>
            <td style="border: black thin solid;width:300px;"> <strong>Paper Name</strong></td>
            @if($examfee->form_type!='regular')
            <td style="border: black thin solid;"> <strong>Semester</strong></td>
            @endif
			@php $key = 0; @endphp
        </tr>
        @foreach($subjects as $subject)
        @php
        $selectedPapers = $subject->getBackPaper($examfee->id,$examfee->roll_no);
        @endphp
        <tr>
            <td style="border: black thin solid;  border-right: none; border-top: none;">{{++$key}}</td>
            <!-- <td style="border: black thin solid;  border-right: none; border-top: none;">-</td>
            <td style="border: black thin solid;  border-right: none; border-top: none;">-</td> -->
            @if($subject->schedule && $subject->schedule->date)
            <!-- <td style="border: black thin solid;  border-right: none; border-top: none;">{{date('d-n-Y',strtotime($subject->schedule->date))}}</td> -->
            <td style="border: black thin solid;  border-right: none; border-top: none;">As per examinations schedule</td>
            @else
            <td style="border: black thin solid;  border-right: none; border-top: none;">As per examinations schedule</td>
            @endif
            @if($subject->schedule && $subject->schedule->shift)
            <!-- <td style="border: black thin solid;  border-right: none; border-top: none;">{{ucwords($subject->schedule->shift)}}</td> -->
            <td style="border: black thin solid;  border-right: none; border-top: none;">As per examinations schedule</td>
            @else
            <td style="border: black thin solid;  border-right: none; border-top: none;">As per examinations schedule</td>
            @endif
            @if($examfee->form_type!='regular')
            <td  style="border: black thin solid; padding: 3px; border-top: none;">
                <input type="checkbox" class="checkboxstyle" @if($selectedPapers && $selectedPapers->mid==1) checked @endif disabled />
            </td>
            <td  style="border: black thin solid; padding: 3px; border-top: none;">
                <input type="checkbox" class="checkboxstyle" @if($selectedPapers && $selectedPapers->external==1) checked @endif disabled />
            </td>
            <td  style="border: black thin solid; padding: 3px; border-top: none;">
                <input type="checkbox" class="checkboxstyle" @if($selectedPapers && $selectedPapers->viva==1) checked @endif disabled />
            </td>
            <td  style="border: black thin solid; padding: 3px; border-top: none;">
                <input type="checkbox" class="checkboxstyle" @if($selectedPapers && $selectedPapers->p_internal==1) checked @endif disabled />
            </td>
            @endif
            <td style="border: black thin solid;  border-right: none; border-top: none;">{{$subject->sub_code}}
			@if($subject->subject_type=='Practical') (P) @endif
			@if($subject->subject_type=='Theory') (T) @endif
			</td>
            <td style="border: black thin solid;  border-top: none;">{{$subject->name}}</td>
            @if($examfee->form_type!='regular')
            <td style="border: black thin solid;  border-top: none;">{{$subject->semester->semester_number}}</td>
            @endif
        </tr>@endforeach
        
    </table>

 </table>

        <div class="col-4 mt-3 break_print" border="2px">
					
				</div>
				<section class="col-md-12 connectedSortable"> 
				   <div class="row">
					   <table width="100%" border="1" style="border:transparent;">
                       <tr> <th><h5 class="text-center">Exam Instruction</h5></th></tr>
                       <tr> <th> IMPORTANT INSTRUCTIONS:</th></tr>
					 <tr><td><ol style="padding-left: 20px;"><li>
Candidates are required to produce this Admit Card with the Photograph pasted along with Identity Card there in as proof of their identity for appearing in examination and entry to the exam hall will be prohibited in absence of the admit card.
</li>
<li>Fill all entries carefully in the Answer Booklet. Candidates must follow all instructions of the Controller of Examination/Supervisor/Invigilator. Any candidate who does not follow such instructions, their examination may be invalidated. Non-compliance with the direction may also result in suspension from all examinations.
</li>
<li>
Electronic and communication on devices like mobile Phone, Textual Material, Smart Watches etc, weapon, smoking, tobacco, gutkha and Bag/Baggage are strictly prohibited in the examination premises. The university will not own the responsibility, if any item is stolen /lost etc. Estables items and water bottles are not allowed inside examination premises.
</li>
<li>
Candidates are to be seated in their respective seat at least 2 minutes prior to scheduled start me of the examination. The entry to the Exam Hall will be permitted maximum up to after 15 minutes of the commencement of the examination.
</li>
<li>
Candidates must not communicate with another candidates or anyone else other than supervisory staff during the examination. If there is need to raise a point of immediate urgency, the candidate is required to raise their hand to draw the invigilator’s attention. The candidate may explain the matter in a quiet and non-disruptive manner.
</li>
<li>
Abusive behaviour in exam centre will not be tolerated. Any candidate in beach of this will be asked to leave the exam room immediately and will forfeit all exam fees paid.
</li>
<li>
All examination material such as Answer Sheet, Rough Work Sheet etc. musti be returned to the invigilator on complaint of the examination.
</li>
<li>
Eligible Scribes/Writers assisting the Visually Impaired (VI) and other than visually Impaired (VI) must bring original valid identity proof.
</li>
<li>
Candidates must not write or change any entry made in the Admit Card after it has been printed.
</li>
<li>
If any candidate is found guilty of beach of any rules mentioned for the examination or guilty of using unfair means, he/she will be liable to be punished by the competent authority of the university.
</li>
<li>
For date and time of exam, see the Examination schedule separately uploaded on University website.
</li>

</ol>
<br/>
<b><code>Note : </code> Please confirm your exam schedule from your respective head of department.</b>
</td></tr>
<tfoot>

    <tr>
        <td class="text-right">
        <img src="{{asset('signatures\coe.png')}}" style="max-width:80px;">
      </td>
    </tr>
    <tr>
        <td>
        <p style="text-align: right; font-weight: bold; font-size: 11px; margin-bottom: 0px;">Controller of Examination</p>
      </td>
    </tr>
  </tfoot>

					   </table>
					</div>
				</section>
         

    </div>
	</center>

<style>
@media print {
  .noPrint{
    display:none;
  }
    .break_print{
      /*  page-break-after: always;*/
    }
    .pae_conainter{
        width:100%;
    }
}

 </style>
@else
<div class="container" style="margin-top: 100px;">
<center>
<b>
    Your Admit Card is Not Generated...
</b>
</center>
</div>
@endif





@section('styles')
    <style type="text/css"></style>


@section('scripts')

@endsection