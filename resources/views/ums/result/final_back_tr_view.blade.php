@extends("ums.admin.admin-meta")
@section("content")



    <div class="app-content content ">
        <div class="big-box d-flex justify-content-between mb-1 align-items-center">

        <div class="head">
    <div class="row d-flex justify-content-between">
        <div class="col-md-9">
            <h4>Tabular Record (TR)</h4>
        </div>
        <div class="col-md-3 text-right">
            <div class="breadcrumbs-top">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <!-- <li class="breadcrumb-item active">List of Admins</li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


        
        <div class="submitss text-start me-3 align-item-center">
            <button class="dt-button buttons-collection btn btn-outline-secondary dropdown-toggle" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="true"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share font-small-4 mr-50"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>Export</span></button>
            <button  onclick="window.location.reload();" onclick="javascript: history.go(-1)" class=" mt-1 btn btn-primary btn-sm mb-50 mb-sm-0r waves-effect waves-float waves-light "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Get Data</button>
            <button class="btn btn-warning btn-sm mb-50 mb-sm-0r mt-1"  onclick="window.location.reload();" type="reset">
                <i data-feather="refresh-cw"></i> Reset
            </button>
        </div>
    </div>
   
    <form method="get" id="form_data">
        <div class="col-md-12">
            <div class="row align-items-center mb-1">
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Campus <span class="text-danger">*</span></label>
                    <select data-live-search="true" name="campus_id" id="campus_id" class="form-control" onChange="return $('#form_data').submit();">
                        <option value="">--Choose Campus--</option>
                        @foreach($campuses as $campus)
                        <option value="{{$campus->id}}" @if(Request()->campus_id==$campus->id) selected @endif>{{$campus->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('campus_id') }}</span>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Courses <span class="text-danger">*</span></label>
                    <select data-live-search="true" name="course" id="course" class="form-control js-example-basic-single" onChange="return $('#form_data').submit();">
                        <option value="">--Choose Course--</option>
                        @foreach($courses as $course)
                        <option value="{{$course->id}}" @if(Request()->course==$course->id) selected @endif>{{$course->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('course') }}</span>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Semester <span class="text-danger">*</span></label>
                    <select data-live-search="true" name="semester" id="semester" class="form-control js-example-basic-single" onChange="$('#group_name').prop('selectedIndex',0); return $('#form_data').submit();">
                        <option value="">--Select Semester--</option>
                        @foreach($semesters as $semester)
                        <option value="{{$semester->id}}" @if(Request()->semester==$semester->id) selected @endif>{{$semester->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('semester') }}</span>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Result Type <span class="text-danger">*</span></label>
                    <select name="form_type" id="form_type" class="form-control">
                        <option value="final_back_paper" @if(Request()->form_type=='final_back_paper') selected @endif>Final Back</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('form_type') }}</span>
                </div>
            </div>
        </div>
    
        <div class="col-md-12">
            <div class="row align-items-center mb-1">
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Academic Session <span class="text-danger">*</span></label>
                    <select name="academic_session" id="academic_session" class="form-control" onChange="return $('#form_data').submit();">
                        @foreach($sessions as $sessionRow)
                        <option value="{{$sessionRow->academic_session}}" @if(Request()->academic_session == $sessionRow->academic_session) selected @endif>{{$sessionRow->academic_session}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('academic_session') }}</span>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Paper Size <span class="text-danger">*</span></label>
                    <select name="paper_size" id="paper_size" class="form-control">
                        <option value="">Select</option>
                        <option value="a1">A1</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('paper_size') }}</span>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">One Paper Group <span class="text-danger">*</span></label>
                    <select name="onepagegroup" id="onepagegroup" class="form-control" required>
                        <option value="1" @if(Request()->onepagegroup==1) selected @endif>1</option>
                        <option value="2" @if(Request()->onepagegroup==2) selected @endif>2</option>
                        <option value="3" @if(Request()->onepagegroup==3) selected @endif>3</option>
                        <option value="4" @if(Request()->onepagegroup==4) selected @endif>4</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('onepagegroup') }}</span>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Paper SN# <span class="text-danger">*</span></label>
                    <input type="number" name="sno" class="form-control" value="<?=(Request()->sno)?Request()->sno:1?>" min="1">
                    <span class="text-danger">{{ $errors->first('sno') }}</span>
                </div>
            </div>
        </div>
    
        <div class="col-md-12">
            <div class="row align-items-center mb-1">
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Batch#<span class="text-danger">*</span></label>
                    <select name="batch" class="form-control">
                        <option value="">All</option>
                        @foreach(batchArray() as $batch)
                        <option value="{{ batchPrefixByBatch($batch) }}" @if(batchPrefixByBatch($batch) == Request()->batch) selected @endif>{{ $batch }}</option>
                    @endforeach
                    
                    </select>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Roll Number# <span class="text-danger">*</span></label>
                    <input type="text" name="roll_no" class="form-control" value="<?=(Request()->roll_no)?Request()->roll_no:''?>">
                    <span class="text-danger">{{ $errors->first('roll_no') }}</span>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">TR Academic Session#<span class="text-danger">*</span></label>
                    <input type="text" name="tr_batch" class="form-control" value="<?=(Request()->tr_batch)?Request()->tr_batch:''?>">
                    <span class="text-danger">{{ $errors->first('tr_batch') }}</span>
                </div>
    
                <div class="col-md-3 d-flex align-items-center">
                    <label class="form-label mb-0 me-2">Exam Month & Year<span class="text-danger">*</span></label>
                    <select name="month_year[]" id="month_year" class="form-control" multiple>
                        @foreach($month_years as $month_year)
                        @php $month_year_text = $month_year->year.'-'.sprintf('%02d', $month_year->month); @endphp
                        <option value="{{$month_year_text}}" @if(Request()->month_year && in_array($month_year_text, Request()->month_year)) selected @endif>{{date('M',strtotime('01-'.$month_year->month.'-2023')).'-'.$month_year->year}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('month_year') }}</span>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
    <!-- END: Content-->

    {{-- <div class="sidenav-overlay"></div>
    <div class="drag-target"></div> --}}

@endsection