@extends("ums.admin.admin-meta")
@section('content')

<style>
/* @media print {
    .hidden_print{
		display:none;
	}
} */
</style>
<center>
<div class=" ">

<br />
<div class="pt-5">
@if($scrutiny)
@if($scrutiny->fee_status!=1)
<!-- <div class=""> -->
<span class="btn btn-success "><a style="color: white;text-decoration:none;" href="{{route('approve-challenge',$scrutiny->id)}}"><i class="iconly-boldCheck"></i> Approve</a></span>
<!-- </div> -->
@endif
@endif
<a class="btn btn-success print_hidden" href="javascript:window.open('','_self').close();">Back</a>
<button class="btn btn-info print_hidden" onclick="return window.print();">Print</button>
<br />
<br />
</div>
<div style="border: black thin solid; width:700px; padding: 10px; font-family:Arial;">

    <P style="text-align: center; margin-bottom: 5px;"><img src="{{asset('assets\frontend\images\cerlogo.png')}}"></P>
    <form method="POST" action="{{route('challenge-form-view',request()->slug)}}">
        @csrf
        <table style="font-size: 11px; width: 100%;" cellspacing="0" cellpadding="0">
            <tr>

                </strong></td>
            </tr>
            <tr>
                <td colspan="1" style="border: black thin solid; padding-left: 3px;  border-right: none;"><strong>NAME OF THE STUDENT</strong></td>
                <td style="border: black thin solid; padding-left: 3px;  border-right: none;">{{$scrutiny->student_name}} </td>
                <td rowspan="3" style="border: black thin solid; padding-left: 5px; padding-top: 2px; vertical-align: top;"><img src="{{asset($scrutiny->photo)}}" style="height:100px; width: 100px;" alt=""></td>
            </tr>
            <tr>
                <td style="border: black thin solid; padding-left: 3px; border-top: none; border-right: none;"><strong>FATHER'S NAME</strong></td>
                <td style="border: black thin solid; padding-left: 3px; border-top: none; border-right: none;">{{$scrutiny->father}}</td>
            </tr>
            <tr>
                <td style="border: black thin solid; padding-left: 3px; border-top: none; border-right: none;"><strong>MOTHER'S NAME</strong></td>
                <td style="border: black thin solid; padding-left: 3px; border-top: none; border-right: none;">{{$scrutiny->mother}}</td>
            </tr>
            <tr>
                <td style="border: black thin solid; padding-left: 3px; border-top: none; border-right: none;"><strong>ROLL NO.</strong></td>
                <td style="border: black thin solid; padding-left: 3px; border-top: none; border-right: none;">{{$scrutiny->roll_no}}</td>
                <td style="border: black thin solid; padding-left: 3px; border-top: none;"><img src="{{asset($scrutiny->signature)}}" style="height:30px; width: 100px;" alt=""></td>
            </tr>
        </table>


        <table style="font-size: 11px; width: 100%;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong> ENROLLMENT NO.</strong></td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;">{{$scrutiny->enrollment_no}}</td>
                <td style="border: black thin solid; padding: 3px;border-right: none; border-top: none;"><strong>MOBILE NO</strong></td>
                <td style="border: black thin solid; padding: 3px; border-top: none;">{{$scrutiny->mobile}}</td>
            </tr>
            <tr>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong> E-MAIL ID.</strong></td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;">{{$scrutiny->email}}</td>
                <td style="border: black thin solid; padding: 3px;border-right: none; border-top: none;"><strong>AADHAR CARD NO.</strong></td>
                <td style="border: black thin solid; padding: 3px; border-top: none;">{{$scrutiny->aadhar}}</td>
            </tr>

        </table>

        <table style="font-size: 11px; width: 100%;  text-align: left;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>COURSE</strong></td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;">{{$scrutiny->course->name}}</td>

                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>BRANCH/STREAM</strong></td>
                <td style="border: black thin solid; padding: 3px; border-top: none;">{{$scrutiny->stream->name}}</td>

                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>BATCH</strong></td>
                <td style="border: black thin solid; padding: 3px; border-top: none;">{{$scrutiny->batch}}</td>
            </tr>
        </table> @if($scrutiny->challan_number!=NULL)
        <table style="font-size: 11px;  width: 100%;" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="4" style="border: black thin solid; padding: 5px; text-align: center; border-top: none;"><strong>CANDIDATE EXAM FEE DETAIL</strong></td>
            </tr>
            <tr>
                <td colspan="1" style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>BANK NAME</strong></td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;">{{$scrutiny->bank_name}}</td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>BANK BRANCH NAME</strong></td>
                <td style="border: black thin solid; padding: 3px; border-top: none;"></td>
            </tr>
            <tr>
                <td colspan="1" style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>CHALLAN/RTGS/NEFT NO.</strong></td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;">{{$scrutiny->challan_number}}</td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>CHALLAN RECEIPT DATE</strong></td>
                <td style="border: black thin solid; padding: 3px; border-top: none;">{{$scrutiny->challan_reciept_date}}</td>
            </tr>
            <tr>
                <td colspan="1" style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>CHALLAN/RTGS/NEFT AMOUNT</strong></td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;">{{$scrutiny->amount}}</td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>BANK IFSC CODE</strong></td>
                <td style="border: black thin solid; padding: 3px; border-top: none;">{{$scrutiny->bank_ifsc_code}}</td>
            </tr>
        </table>
        <table style="font-size: 11px;  width: 100%;" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="1" style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>CHALLAN/RTGS/NEFT <BR> AMOUNT</strong></td>
                <td style="border: black thin solid; padding: 3px; vertical-align: bottom; border-right: none; border-top: none;"><img src="{{asset($scrutiny->challan)}}" style="height:60px; width: 100px;" alt=""><a target="_blank" href="{{$scrutiny->challan}}">View Doc</a></td>
                <td style="border: black thin solid; padding: 3px; border-right: none; border-top: none;"><strong>DISABILITY <BR>CERTIFICATE</strong></td>
                <td style="border: black thin solid; padding: 3px; border-top: none;">&nbsp;</td>
            </tr>

        </table>@endif
        <table style="font-size: 11px; width: 100%;" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="4" style="border: black thin solid; padding: 5px; border-bottom: none; text-align: center; border-top: none;"><strong> LIST OF CURRENT SEMESTER/PROF./YEAR THEORY AND PRACTICAL PAPER</strong></td>
            </tr>
            <tr>
                <th style="border: black thin solid; padding: 3px; text-align: left; border-right: none; ">SL.</th>
                <th style="border: black thin solid; padding: 3px; text-align: left; border-right: none;">PAPER CODE</th>
                <th style="border: black thin solid; padding: 3px; text-align: left;">PAPER NAME</th>

            </tr>
            @foreach($sublist as $key=>$value)
            <tr>
                <td style="border: black thin solid; padding: 3px; border-top: none; border-right: none;">{{$key+1}}</td>
                <td style="border: black thin solid; padding: 3px; border-top: none; border-right: none;">{{$value->sub_code}}</td>
                <td style="border: black thin solid; padding: 3px; border-top: none;">{{$value->name}}</td>
            </tr>
            @endforeach
        </table>
        <table style="font-size: 11px; width: 100%; text-align: left;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="border: black thin solid; padding: 3px; width: 50%; border-right: none; border-top: none;"><img src="{{asset($scrutiny->signature)}}" style="height:30px; width: 100px;" alt=""><br>
                    Signature/Thumb impression of the student
                </td>
                <td style="vertical-align: bottom; margin-top: 0; border: black thin solid; padding: 7px; width: 50%; border-top: none;"><br>
                    Signature of the HoD/Dean/Principal
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border: black thin solid; border-top: none; text-align: justify; padding: 5px;">
                    <ol>
                        <li><input required type="checkbox" id="check" value="1" name="agree" checked @if($scrutiny->agree==1) disabled @endif >
                            I hereby declare that I am
                            aware of the examination rules of the University. I also affirm that i have appeared in all in the mid semester test, presentation and submitted
                            assingnmentas applicable for the course filled in the online examination form. My registration for the course is valid and not time barred.
                            If any of my statement is found to be untrue, i shall have no claim for taking examination and my examination result may be withheld/cancelled
                            at any stage. I undertake that i shall abide by the rules and regulations of the University.</li>
                        <li>Please Submit a Attested Copy of Application Form along With Payment Details To Your Department.</li>@if ($errors->has('name'))<span class="text-danger">
                            <li>{{ $errors->first('agree') }}</li>
                        </span>
                        @endif
                </td>
            </tr>
            <tr></tr>
        </table>
        @if($scrutiny->agree==null)
        <input value="{{$scrutiny->roll_no}}" name="roll_no" type="text" hidden>
        <input value="{{$scrutiny->university}}" name="university" type="text" hidden>
        <input value="{{$scrutiny->course_id}}" name="course_id" type="text" hidden>
        <input value="{{$scrutiny->branch_id}}" name="branch_id" type="text" hidden>
        <input value="{{$scrutiny->semester_id}}" name="semester_id" type="text" hidden>
        <input value="{{$scrutiny->batch}}" name="batch" type="text" hidden>
        <input value="{{$scrutiny->form_type}}" name="exam_form" type="text" hidden>
        <a href="{{url('scrutiny-delete',$scrutiny->id)}}" class="btn btn-secondary btn-back">Reset</a>
        <button type="submit" class="btn btn-warning"><i class="fa fa-send" aria-hidden="true"></i> Submit</button>
        @endif
    </form>


</div>

<div class=" pt-1">
<button type="button" onclick="print()" class="btn btn-warning hidden_print">
    <i class="fa fa-send" aria-hidden="true"></i> Print
</button>
</div>
</div>
</center>

@endsection