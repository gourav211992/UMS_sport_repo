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
                                <h2 class="content-header-title float-start mb-0">Edit Registration</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active">Edit Registration</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                        <div class="form-group breadcrumb-right">
                            <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i
                                        data-feather="arrow-left-circle"></i> Back</button>
                            <button onClick="saveDraft()" class="btn btn-outline-primary btn-sm mb-50 mb-sm-0"><i
                                        data-feather="save"></i> Save</button>
                            <button onClick="openRejectModal()" class="btn btn-danger btn-sm mb-50 mb-sm-0">
                                <i data-feather="x-circle"></i> Reject
                            </button>
                            <button onClick="proceed()"
                                    {{--                                    data-bs-toggle="modal" data-bs-target="#disclaimer"--}}
                                    class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>
                                Approve</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalLabel">Reject Registration</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="rejectForm">
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="3" required></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" onclick="submitRejectForm()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li> <!-- Display each individual error -->
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sport-registration-update', $registration->id) }}" method="post"
                      id="postRegister" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <section id="basic-datatable">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body customernewsection-form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="newheader  border-bottom mb-2 pb-25">
                                                    <h4 class="card-title text-theme">Basic Information</h4>
                                                    <p class="card-text">Fill the details</p>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Series <span
                                                                    class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="book_id" id="series" required>
                                                            <option value="" disabled>Select</option>
                                                            @foreach ($series as $ser)
                                                                <option value="{{ $ser->id }}" {{ $registration->book_id == $ser->id ? 'selected' : '' }}>{{ $ser->book_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Reg. No <span
                                                                    class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="document_number"
                                                               readonly id="requestno" value="{{ $registration->document_number }}">
                                                        <input type="hidden" name="status" id="status" value="">
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Reg. Date <span
                                                                    class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" onchange="getDocNumberByBookId()"
                                                               class="form-control" name="document_date" id="document_date"
                                                               value="{{ old('document_date', $registration->document_date) }}">
                                                        @error('document_date')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @if($registration->status == 'approved')
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Registration Number <span
                                                                        class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" name="registration_number"
                                                                   readonly value="{{ $registration->registration_number }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sport Name <span
                                                                    class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="sport_id" id="sport_id">
                                                            <option>Select</option>
                                                            @foreach ($sport_types as $type)
                                                                <option value="{{ $type->id }}" {{ $registration->sport_id == $type->id ? 'selected' : '' }}>{{ $type->sport_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Name <span
                                                                    class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="First Name" class="form-control"
                                                               name="name" value="{{ $registration->name }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Middle Name"
                                                               class="form-control" name="middle_name" value="{{ $registration->middle_name }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Last Name"
                                                               class="form-control" name="last_name" value="{{ $registration->last_name }}">
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Gender <span
                                                                    class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio1"
                                                                       name="gender" class="form-check-input"
                                                                       value="male" {{ $registration->gender == 'male' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                       for="customColorRadio1">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="service" name="gender"
                                                                       class="form-check-input" value="female" {{ $registration->gender == 'female' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                       for="service">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" id="batch_name" name="batch_id">
                                                            <option value="">-----Select Batch-----</option>
                                                            @foreach($batch as $ba)
                                                                <option value="{{ $ba->id }}" @if ($ba->id == $registration->batch_id) selected @endif >{{ $ba->batch }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
{{--                                                <div class="row align-items-center mb-1">--}}
{{--                                                    <div class="col-md-3">--}}
{{--                                                        <label class="form-label">Batch Year <span class="text-danger">*</span></label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-5">--}}
{{--                                                        <select class="form-select" id="batch_year" name="batch_year" disabled>--}}
{{--                                                            <option value="">-----Select Year-----</option>--}}
{{--                                                            @foreach($batch as $ba)--}}
{{--                                                                <option value="{{ $ba->id }}" @if ($ba->id == $registration->batch_id) selected @endif>{{ $ba->batch_year }}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Section <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="section_id" id="section">
                                                            <option value="">-----Select Section-----</option>
                                                            @foreach($sections as $section)
                                                                <option value="{{ $section->id }}" @if ($section->id == $registration->section_id) selected @endif>{{ $section->section }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Quota <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="quota_id" id="quota_id">
                                                            <option value="">-----Select-----</option>
                                                            @foreach ($quotas as $quota)
                                                                <option value="{{ $quota->id }}" {{ old('quota_id', $registration->quota_id) == $quota->id ? 'selected' : '' }}>
                                                                    {{ ucfirst($quota->quota_name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
{{--                                                        <input type="hidden" value="{{ $registration->quota_id }}" name="quota_id" id="quota_id">--}}
                                                    </div>
                                                </div>
                                                <input type="hidden" id="selected_batch_name" value="{{ $selectedBatch ? $selectedBatch->batch_name : '' }}">

                                                <div class="row align-items-center mb-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Group <span
                                                                        class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <select class="form-select" name="group">
                                                                <option>Select</option>
                                                                @foreach($groups as $group)
                                                                    <option value="{{$group->id}}" @if($registration->group == $group->id) selected @endif>{{$group->group_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" class="form-control" name="dob" id="dobInput"
                                                               onfocus="this.min=getDate(-50); this.max=getDate(-10);"
                                                               onblur="validateDOB()" value="{{ $registration->dob }}">
                                                        <small id="dobError" class="text-danger"></small>
                                                    </div>
                                                </div>
{{--                                                @dump($registration)--}}
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Date of Joining <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" class="form-control" name="doj" id="dojInput"
                                                               onfocus="this.min=getDate(-1); this.max=getDate(1);"
                                                               onblur="validateDOJ()" value="{{ $registration->doj }}">
                                                        <small id="dojError" class="text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 border-start">
                                                @if($registration->image)
                                                    <div class="appli-photobox">
                                                        {{--                                                        <p id="photoSizeText">Photo Size<br />25mm X 35mm</p>--}}
                                                        <img id="previewImg" src="{{ asset($registration->image) }}"
                                                             alt="Profile Image"
                                                             class="img-fluid rounded mt-3 mb-2"
                                                             height="110"
                                                             width="110">
                                                    </div>
                                                    <div class="mt-2 text-center">
                                                        <div class="mt-2">
                                                            <label for="replace-image" class="btn btn-outline-primary btn-sm waves-effect">
                                                                <i data-feather="upload"></i> Replace Profile Image
                                                            </label>
                                                            <input type="file" id="replace-image" name="image" class="d-none">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mt-2 text-center">
                                                        <div class="image-uploadhide">
                                                            <label for="imageUpload" class="btn btn-outline-primary btn-sm waves-effect">
                                                                <i data-feather="upload"></i> Upload Profile Image
                                                            </label>
                                                            <input type="file" id="imageUpload" name="image" class="d-none">
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row align-items-center mb-2 mt-4 justify-content-center text-center">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing justify-content-center">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3"
                                                                       name="customColorRadio3" class="form-check-input"
                                                                       checked="">
                                                                <label class="form-check-label fw-bolder"
                                                                       for="customColorRadio3">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25 me-0">
                                                                <input type="radio" id="customColorRadio4"
                                                                       name="customColorRadio3" class="form-check-input">
                                                                <label class="form-check-label fw-bolder"
                                                                       for="customColorRadio4">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-1">
                                            <div class="step-custhomapp bg-light">
                                                <ul class="nav nav-tabs my-25 custapploannav" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-bs-toggle="tab" href="#other">Other
                                                            Details</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#Medical">Exp. &
                                                            Medical</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#Hostel">Hostel</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#Family">Family
                                                            Details</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#Address">Address</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#Emergency">Emergency
                                                            Detail</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#Sponsor">Sponsor</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#Fee">Fee</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab"
                                                           href="#document">Document</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab"
                                                           href="#payment">Payment Details</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content pb-1 px-1">
                                                <div class="tab-pane active" id="other">
                                                    <div class="row mb-1 align-items-center">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Mobile Number <span
                                                                        class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text" id="basic-addon5"><i
                                                                            data-feather='phone'></i></span>
                                                                <input type="text" class="form-control" name="mobile_number" value="{{ $registration->mobile_number }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Email <span
                                                                        class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text" id="basic-addon5"><i
                                                                            data-feather='mail'></i></span>
                                                                <input type="text" class="form-control"
                                                                       placeholder="hello@student.com" name="email" value="{{ $registration->email }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-select" id="batch_year" name="batch_year">
                                                                <option value="">Select Year</option>
{{--                                                                @foreach ($batchYears as $by)--}}
{{--                                                                    <option value="{{ $by->batch_year }}" @if($selectedBatch && $by->batch_year == $selectedBatch->batch_year) selected @endif>--}}
{{--                                                                        {{ $by->batch_year }}--}}
{{--                                                                    </option>--}}
{{--                                                                @endforeach--}}
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                        </div>
{{--                                                        @dump($selectedBatch)--}}
                                                        <div class="col-md-3">
                                                            <select class="form-select" id="batch_name" name="batch_id">
                                                                <option value="">Select Name</option>
{{--                                                                @foreach ($batch as $b)--}}
{{--                                                                    @if($b->batch_year == ($selectedBatch ? $selectedBatch->batch_year : ''))--}}
{{--                                                                        <option value="{{ $b->id }}" @if($selectedBatch && $b->id == $selectedBatch->id) selected @endif>--}}
{{--                                                                            {{ $b->batch_name }}--}}
{{--                                                                        </option>--}}
{{--                                                                    @endif--}}
{{--                                                                @endforeach--}}
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id="selected_batch_name" value="{{ $selectedBatch ? $selectedBatch->batch_name : '' }}">

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Section <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-select" name="section_id">
                                                                <option value="">Select</option>
                                                                @foreach ($sections as $s)
                                                                    <option value="{{ $s->id }}" {{ $registration->section_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Group <span
                                                                        class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-select" name="group">
                                                                <option>Select</option>
                                                                @foreach($groups as $group)
                                                                    <option value="{{$group->id}}" @if($registration->group == $group->id) selected @endif>{{$group->group_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> -->

                                                    <div class="row mb-1 align-items-center">
                                                        <div class="col-md-2">
                                                            <label class="form-label">BAI ID <span
                                                                        class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3 mb-sm-0 mb-1">
                                                            <input type="text" class="form-control" name="bai_id" value="{{ $registration->bai_id }}"/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">State</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            {{--                                                            @dump($states)--}}
                                                            <select id="other_state" class="form-select" name="bai_state">
                                                                <option value="">Select State</option>
                                                                @if(isset($otherStates) && count($otherStates) > 0)
                                                                    @foreach($otherStates as $state)
                                                                        <option value="{{ $state->id }}"
                                                                                @if($registration->bai_state == $state->id) selected @endif>
                                                                            {{ $state->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <label class="form-label">BWF ID <span
                                                                        class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="bwf_id" value="{{ $registration->bwf_id }}"/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">Country</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select id="other_country" class="form-select" name="country">
                                                                <option value="">Select</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->id }}"
                                                                            @if($registration->country == $country->id) selected @endif>
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="Address">
                                                    <div class="row">
                                                        <!-- Permanent Address -->
                                                        <div class="col-md-6">
                                                            <h5 class="mt-1 mb-4 text-dark"><strong>Permanent Address</strong></h5>
                                                            {{--                                                            @dump($familyDetails)--}}
                                                            <div class="row align-items-center mb-1">
                                                                {{--                                                                @dump($familyDetails)--}}
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Address</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <textarea id="permanent_street1" class="form-control" placeholder="Street 1" name="family_details[0][permanent_street1]">{{isset($familyDetails[0]->permanent_street1) ?$familyDetails[0]->permanent_street1: null}}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-6">
                                                                    <textarea id="permanent_street2" class="form-control" placeholder="Street 2" name="family_details[0][permanent_street2]">{{isset($familyDetails[0]->permanent_street2) ?$familyDetails[0]->permanent_street2: null}}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Town</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="permanent_town" class="form-control" name="family_details[0][permanent_town]" value="{{isset($familyDetails[0]->permanent_town) ?$familyDetails[0]->permanent_town: null}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Country</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="permanent_country" class="form-select" name="family_details[0][permanent_country]" onchange="loadStates(this.value, 'permanent')">
                                                                        <option>Select</option>
                                                                        @foreach($countries as $country)
                                                                            <option value="{{ $country->id }}" {{ $selectedCountry && $country->id == $selectedCountry->id ? 'selected' : '' }}>
                                                                                {{ $country->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">State</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="permanent_state" class="form-select" name="family_details[0][permanent_state]" onchange="loadCities(this.value, 'permanent')">
                                                                        <option>Select</option>
                                                                        @if($states)
                                                                            @foreach($states as $state)
                                                                                <option value="{{ $state->id }}" {{ $selectedState && $state->id == $selectedState->id ? 'selected' : '' }}>
                                                                                    {{ $state->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">City</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="permanent_district" class="form-select" name="family_details[0][permanent_district]">
                                                                        <option>Select</option>
                                                                        @if($cities)
                                                                            @foreach($cities as $city)
                                                                                <option value="{{ $city->id }}" {{ $selectedCity && $city->id == $selectedCity->id ? 'selected' : '' }}>
                                                                                    {{ $city->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Pin Code</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="permanent_pincode" class="form-control" name="family_details[0][permanent_pincode]" value="{{isset($familyDetails[0]->permanent_pincode) ?$familyDetails[0]->permanent_pincode: null}}"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Correspondence Address -->
                                                        <div class="col-md-6">
                                                            <div class="mt-1 mb-2 d-flex flex-column">
                                                                <h5 class="text-dark mb-0 me-1"><strong>Correspondence Address</strong></h5>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="colorCheck2">
                                                                    <label class="form-check-label" for="colorCheck2">Same As Permanent Address</label>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Address</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <textarea id="correspondence_street1" class="form-control" placeholder="Street 1" name="family_details[0][correspondence_street1]">{{isset($familyDetails[0]->correspondence_street1) ?$familyDetails[0]->correspondence_street1: null}}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-6">
                                                                    <textarea id="correspondence_street2" class="form-control" placeholder="Street 2" name="family_details[0][correspondence_street2]">{{isset($familyDetails[0]->correspondence_street2) ?$familyDetails[0]->correspondence_street2: null}}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Town</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="correspondence_town" class="form-control" name="family_details[0][correspondence_town]" value="{{isset($familyDetails[0]->correspondence_town) ?$familyDetails[0]->correspondence_town: null}}"/>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Country</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="correspondence_country" class="form-select" name="family_details[0][correspondence_country]" onchange="loadStates(this.value, 'correspondence')">
                                                                        <option>Select</option>
                                                                        @foreach($countries as $country)
                                                                            <option value="{{ $country->id }}" {{ $selectedCorrespondenceCountry && $country->id == $selectedCorrespondenceCountry->id ? 'selected' : '' }}>
                                                                                {{ $country->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">State</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="correspondence_state" class="form-select" name="family_details[0][correspondence_state]" onchange="loadCities(this.value, 'correspondence')">
                                                                        <option>Select</option>
                                                                        @if($states)
                                                                            @foreach($states as $state)
                                                                                <option value="{{ $state->id }}" {{ $selectedCorrespondenceState && $state->id == $selectedCorrespondenceState->id ? 'selected' : '' }}>
                                                                                    {{ $state->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">City</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="correspondence_district" class="form-select" name="family_details[0][correspondence_district]">
                                                                        <option>Select</option>
                                                                        @if($cities)
                                                                            @foreach($cities as $city)
                                                                                <option value="{{ $city->id }}" {{ $selectedCorrespondenceCity && $city->id == $selectedCorrespondenceCity->id ? 'selected' : '' }}>
                                                                                    {{ $city->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Pin Code</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="correspondence_pincode" class="form-control" name="family_details[0][correspondence_pincode]" value="{{isset($familyDetails[0]->correspondence_pincode) ?$familyDetails[0]->correspondence_pincode: null}}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="Family">
                                                    <div class="table-responsive">
                                                        <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border" id="familyTable">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Relation</th>
                                                                <th>Name</th>
                                                                <th>Contact No</th>
                                                                <th>Email</th>
                                                                <th>Guardian</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($familyDetails as $index => $family)
                                                                <tr class="family-row">
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        <select class="form-select mw-100 relation" name="family_details[{{ $index }}][relation]">
                                                                            <option>Select</option>
                                                                            <option {{ $family->relation == 'Father' ? 'selected' : '' }}>Father</option>
                                                                            <option {{ $family->relation == 'Mother' ? 'selected' : '' }}>Mother</option>
                                                                            <option {{ $family->relation == 'Grandfather' ? 'selected' : '' }}>Grandfather</option>
                                                                            <option {{ $family->relation == 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                                                            <option {{ $family->relation == 'Aunt' ? 'selected' : '' }}>Aunt</option>
                                                                            <option {{ $family->relation == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                                                                            <option {{ $family->relation == 'Local Guardian' ? 'selected' : '' }}>Local Guardian</option>
                                                                            <option {{ $family->relation == 'Other' ? 'selected' : '' }}>Other</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text" class="form-control mw-100 name" name="family_details[{{ $index }}][name]" value="{{ $family->name }}"></td>
                                                                    <td><input type="text" class="form-control mw-100 contact" name="family_details[{{ $index }}][contact_no]" value="{{ $family->contact_no }}"></td>
                                                                    <td><input type="text" class="form-control mw-100 email" name="family_details[{{ $index }}][email]" value="{{ $family->email }}"></td>
                                                                    <td>
                                                                        <input type="radio" name="family_details[{{ $index }}][is_guardian]" class="guardian" {{ $family->is_guardian ? 'checked' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="text-danger delete-row" data-id="{{ $family->id }}"><i data-feather="trash-2" class="me-50"></i></a>
                                                                    </td>
                                                                    <input type="hidden" name="family_details[{{ $index }}][id]" value="{{ $family->id }}">
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <a href="#" class="text-primary add-contactpeontxt"><i data-feather='plus'></i> Add New</a>
                                                </div>



                                                <div class="tab-pane" id="Emergency">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 class="mt-1 mb-2 text-dark"><strong>Emergency 1 Details</strong></h5>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[0][name]" class="form-control" required value="{{$sportEmergencyContact[0]->name ?? ''}}" />
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Relation <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[0][relation]" class="form-control" required value="{{$sportEmergencyContact[0]->relation ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[0][contact_no]" class="form-control" required value="{{$sportEmergencyContact[0]->contact_no ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Email Id <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[0][email]" class="form-control" required  value="{{$sportEmergencyContact[0]->email ?? ''}}"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h5 class="mt-1 mb-2 text-dark"><strong>Emergency 2 Details</strong></h5>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[1][name]" class="form-control" required  value="{{$sportEmergencyContact[1]->name ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Relation <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[1][relation]" class="form-control" required  value="{{$sportEmergencyContact[1]->relation ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[1][contact_no]" class="form-control" required  value="{{$sportEmergencyContact[1]->contact_no ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Email Id <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[1][email]" class="form-control" required value="{{$sportEmergencyContact[1]->email ?? ''}}"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="tab-pane" id="Medical">
                                                    <div class="row">
                                                        <div class="col-md-6">

                                                            <h5 class="mt-1 mb-2 text-dark"><strong>Badminton Exp.</strong>
                                                            </h5>


                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Total Experience (No of
                                                                        Years)</label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="badminton_experience" value="{{$sportRegistrationDetails->badminton_experience ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            {{-- <div class="row align-items-center mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">Previous Coach/Training Academy</label>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control"  />
                                                                                </div>
                                                                             </div> --}}


                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Highest Achievemnet</label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="highest_achievement" value="{{$sportRegistrationDetails->highest_achievement ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Level of Play</label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <select class="form-select" name="level_of_play" >
                                                                        <option value="">Select</option>
                                                                        <option value="Beginner" @if(isset($sportRegistrationDetails->level_of_play))  @if($sportRegistrationDetails->level_of_play == 'Beginner') selected @endif @endif>Beginner</option>
                                                                        <option value="Intermediate" @if(isset($sportRegistrationDetails->level_of_play))  @if($sportRegistrationDetails->level_of_play == 'Intermediate') selected @endif @endif >Intermediate</option>
                                                                        <option value="Advanced" @if(isset($sportRegistrationDetails->level_of_play))  @if($sportRegistrationDetails->level_of_play == 'Advanced') selected @endif @endif>Advanced</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            {{-- <div class="tab-pane active " id="other">
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Previous Coach</th>
                                                                                <th>Training Academy</th>
                                                                                <th width="150px">Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr id="fee_tr">
                                                                                <td>1</td>
                                                                                <td><input type="text"
                                                                                        class="form-control mw-100"
                                                                                        name="title" required /></td>
                                                                                <td><input type="text"
                                                                                        class="form-control mw-100"
                                                                                        name="title" required /></td>
                                                                                <td>
                                                                                    <a href="#"
                                                                                        class="text-primary add-contact-row">
                                                                                        <i id="icon"
                                                                                            data-feather="plus-square"></i></a>
                                                                                </td>
                                                                            </tr>



                                                                        </tbody>


                                                                    </table>
                                                                </div>


                                                            </div> --}}

                                                        </div>

                                                        <div class="col-md-6">

                                                            <h5 class="mt-1 mb-2 text-dark"><strong>Medical
                                                                    Information</strong></h5>


                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Any Medical
                                                                        Conditions/Allergies</label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="medical_conditions" value="{{$sportRegistrationDetails->medical_conditions ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Current Medications</label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="current_medications" {{$sportRegistrationDetails->current_medications ?? ''}}/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Dietary Restructions</label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="dietary_restrictions" value="{{$sportRegistrationDetails->dietary_restrictions ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Blood Group</label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="blood_group" value="{{$sportRegistrationDetails->blood_group ?? ''}}"/>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="tab-pane active" id="other">
                                                            <div class="table-responsive">
                                                                <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border" id="trainingTable">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Previous Coach</th>
                                                                        <th>Training Academy</th>
                                                                        <th width="150px">Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="trainingBody">
                                                                    @if($sportTrainingDetails->isEmpty())
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td><input type="text" class="form-control mw-100" name="previous_coach[]" required /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="training_academy[]" required /></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" class="text-primary add-row">
                                                                                    <i class="fas fa-plus-square"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        @foreach($sportTrainingDetails as $index => $detail)
                                                                            <tr>
                                                                                <td>{{ $index + 1 }}</td>
                                                                                <td><input type="text" class="form-control mw-100" name="previous_coach[]" value="{{ $detail->previous_coach }}" required /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="training_academy[]" value="{{ $detail->training_academy }}" required /></td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)" class="text-primary add-row">
                                                                                        <i class="fas fa-plus-square"></i>
                                                                                    </a>
                                                                                    @if($index > 0)
                                                                                        <a href="javascript:void(0)" class="text-danger remove-row ms-2">
                                                                                            <i class="fas fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="tab-pane" id="Sponsor">
                                                    {{-- <div class="row">
                                                                         <div class="col-md-6">


                                                                             <div class="row align-items-center mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">Sponsor Name <span class="text-danger">*</span></label>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control"  />
                                                                                </div>
                                                                             </div>

                                                                             <div class="row align-items-center mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">Sponsor SPOC <span class="text-danger">*</span></label>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control"  />
                                                                                </div>
                                                                             </div>

                                                                             <div class="row align-items-center mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">SPOC Phone No. <span class="text-danger">*</span></label>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control"  />
                                                                                </div>
                                                                             </div>

                                                                             <div class="row align-items-center mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">SPOC Email Id <span class="text-danger">*</span></label>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control"  />
                                                                                </div>
                                                                             </div>

                                                                             <div class="row align-items-center mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">SPOC Email Position <span class="text-danger">*</span></label>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <input type="text" class="form-control"  />
                                                                                </div>
                                                                             </div>


                                                                         </div>


                                                                     </div> --}}

                                                    <div class="tab-content pb-1">

                                                        <div class="tab-pane active" id="other">
                                                            <div class="table-responsive">
                                                                <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border" id="sponsorTable">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Sponsor Name</th>
                                                                        <th>Sponsor SPOC</th>
                                                                        <th>SPOC Phone No.</th>
                                                                        <th>SPOC Email Id</th>
                                                                        <th>SPOC Email Position</th>
                                                                        <th width="150px">Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @forelse ($sportSponsor as $index => $sponsor)
                                                                        <tr id="fee_tr">
                                                                            <td>{{ $index + 1 }}</td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[{{ $index }}][name]" value="{{ $sponsor->name }}" required /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[{{ $index }}][spoc]" value="{{ $sponsor->spoc }}" required /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[{{ $index }}][phone]" value="{{ $sponsor->phone }}" required /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[{{ $index }}][email]" value="{{ $sponsor->email }}" /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[{{ $index }}][email_position]" value="{{ $sponsor->email_position }}" /></td>
                                                                            <td>
                                                                                <a href="#" class="text-primary add-sponsor-row">
                                                                                    <i data-feather="plus-square"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @empty
                                                                        <tr id="fee_tr">
                                                                            <td>1</td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[0][name]" required /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[0][spoc]" required /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[0][phone]" required /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[0][email]" /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="sponsor[0][email_position]" /></td>
                                                                            <td>
                                                                                <a href="#" class="text-primary add-sponsor-row">
                                                                                    <i data-feather="plus-square"></i>
                                                                                </a>
                                                                                <a href="#" class="text-danger delete-sponsor-row">
                                                                                    <i data-feather="trash-2"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforelse
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="tab-pane" id="Fee">
                                                    <div class="table-responsive">
                                                        <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border" id="feeTable">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Fee Title</th>
                                                                <th>Total Fees</th>
                                                                <th>Fee Sponsorship<br /> %</th>
                                                                <th>Fee Sponsorship<br /> Value</th>
                                                                <th>Fee Discount<br /> %</th>
                                                                <th>Fee Discount<br /> Value</th>
                                                                <th>Fee Sponsorship<br />+ Discount %</th>
                                                                <th>Fee Sponsorship<br /> + Discount Value</th>
                                                                <th>Net Fee<br /> Payable %</th>
                                                                <th>Net Fee<br /> Payable Value</th>
                                                                <th width="150px">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
{{--                                                            @dump($feeDetails)--}}
                                                            @foreach ($feeDetails as $key => $fees)
                                                                @php
                                                                    $totalFees = $fees['total_fees'] ?? 0;
                                                                    $feeSponsorshipPercent = $fees['fee_sponsorship_percent'] ?? 0;
                                                                    $feeSponsorshipValue = $fees['fee_sponsorship_value'] ?? ($totalFees * $feeSponsorshipPercent / 100);
                                                                    $feeDiscountPercent = $fees['fee_discount_percent'] ?? 0;
                                                                    $feeDiscountValue = $fees['fee_discount_value'] ?? ($totalFees * $feeDiscountPercent / 100);
                                                                    $feeSponsorshipPlusDiscountPercent = $feeSponsorshipPercent + $feeDiscountPercent;
                                                                    $feeSponsorshipPlusDiscountValue = $feeSponsorshipValue + $feeDiscountValue;
                                                                    $netFeePayablePercent = 100 - $feeSponsorshipPlusDiscountPercent;
                                                                    $netFeePayableValue = $totalFees - $feeSponsorshipPlusDiscountValue;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td><input type="text" class="form-control" name="fee_details[{{$key}}][title]" value="{{ $fees['title'] ?? 'N/A' }}"></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][total_fees]" value="{{ $totalFees }}"></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][fee_sponsorship_percent]" value="{{ $feeSponsorshipPercent }}"></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][fee_sponsorship_value]" value="{{ $feeSponsorshipValue }}"></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][fee_discount_percent]" value="{{ $feeDiscountPercent }}"></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][fee_discount_value]" value="{{ $feeDiscountValue }}"></td>
                                                                    <td><input type="number" class="form-control" value="{{ $feeSponsorshipPlusDiscountPercent }}"></td>
                                                                    <td><input type="number" class="form-control" value="{{ $feeSponsorshipPlusDiscountValue }}"></td>
                                                                    <td><input type="number" class="form-control" value="{{ $netFeePayablePercent }}"></td>
                                                                    <td><input type="number" class="form-control" value="{{ $netFeePayableValue }}"></td>
                                                                    <td>
                                                                        <a href="#sponsorModal" data-bs-toggle="modal">
                                                                            <span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span>
                                                                        </a>
{{--                                                                        @if ($key != 0)--}}
                                                                            <a href="#" class="text-danger ms-25">
                                                                                <i data-feather="trash-2" class="me-50"></i>
                                                                            </a>

{{--                                                                        @endif--}}
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            <!-- Add New Row -->
{{--                                                            <tr>--}}
{{--                                                                <td>#</td>--}}
{{--                                                                <td>--}}
{{--                                                                    <select class="form-select mw-100">--}}
{{--                                                                        <option>Select</option>--}}
{{--                                                                        <option>Training</option>--}}
{{--                                                                        <option>Hostel</option>--}}
{{--                                                                        <option>Mess</option>--}}
{{--                                                                        <option>Security Deposit</option>--}}
{{--                                                                        <option>Khelo India</option>--}}
{{--                                                                        <option>Khel Nursery</option>--}}
{{--                                                                        <option>Psychology</option>--}}
{{--                                                                        <option>Sport Science</option>--}}
{{--                                                                        <option>Laundry</option>--}}
{{--                                                                        <option>ID Card</option>--}}
{{--                                                                        <option>Registration Fee</option>--}}
{{--                                                                        <option>Nutrition</option>--}}
{{--                                                                        <option>Physio</option>--}}
{{--                                                                    </select>--}}
{{--                                                                </td>--}}
{{--                                                                <td><input type="number" class="form-control" placeholder="Total Fees"></td>--}}
{{--                                                                <td><input type="number" class="form-control" placeholder="Sponsorship %"></td>--}}
{{--                                                                <td><input type="number" class="form-control" placeholder="Sponsorship Value"></td>--}}
{{--                                                                <td><input type="number" class="form-control" placeholder="Discount %"></td>--}}
{{--                                                                <td><input type="number" class="form-control" placeholder="Discount Value"></td>--}}
{{--                                                                <td>-</td>--}}
{{--                                                                <td>-</td>--}}
{{--                                                                <td>-</td>--}}
{{--                                                                <td>-</td>--}}
{{--                                                                <td>--}}
{{--                                                                    <a href="#" class="text-primary add-contact-row">--}}
{{--                                                                        <i data-feather="plus-square" class="me-50"></i>--}}
{{--                                                                    </a>--}}
{{--                                                                </td>--}}
{{--                                                            </tr>--}}

                                                            <!-- Total Fees Row -->
                                                            @php
                                                                $totalFeesSum = array_sum(array_column($feeDetails, 'total_fees'));
                                                                $totalNetFeePayableValue = array_sum(array_map(function ($fees) {
                                                                    return ($fees['total_fees'] ?? 0) - (($fees['fee_sponsorship_value'] ?? 0) + ($fees['fee_discount_value'] ?? 0));
                                                                }, $feeDetails));
                                                            @endphp
                                                            <tr>
                                                                <td></td>
                                                                <td colspan="9" class="text-end fw-bolder text-dark font-large-1">Total Fees</td>
                                                                <td class="fw-bolder text-dark font-large-1" id="totalNetFeePayableValue">{{ $totalNetFeePayableValue }}</td>
{{--                                                                <td></td>--}}
                                                                <td>
                                                                    @if($registration->user->payment_status == 'paid')
                                                                        <button type="button" class="btn btn-primary btn-sm px-25 font-small-2 py-25">Paid</button>
                                                                    @else
                                                                        @if(empty($user->payments))
                                                                            <button type="button" data-bs-target="#update-payment" data-bs-toggle="modal" class="btn btn-primary btn-sm px-25 font-small-2 py-25">Payment Details</button>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
{{--                                                        <input type="hidden" name="fee_details" id="feeDetailsInput">--}}
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="update-payment" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <form id="paymentForm" method="post" enctype="multipart/form-data">
                                                            @csrf
{{--                                                            @dump($registration->user->id)--}}
                                                            <input type="hidden" name="user_id" value="{{ $registration->userable_id }}">
                                                            <input type="hidden" name="confirm_payment" value="yes">
                                                            <div class="modal-content">
                                                                <div class="modal-header p-0 bg-transparent">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body px-sm-4 mx-50 pb-2">
                                                                    <h1 class="text-center mb-1" id="shareProjectTitle">Payment Details</h1>
                                                                    <p class="text-center">Enter the details below.</p>

                                                                    <div class="row mt-2">
                                                                        <div class="col-md-12 mb-1" id="bankNameDiv">
                                                                            <label class="form-label">Bank name <span class="text-danger">*</span></label>
                                                                            <select class="form-control select2" name="bank_name" id="bank_name" required>
                                                                                <option value="">Select</option>
                                                                                <option value="HDFC Bank">HDFC Bank</option>
                                                                                <option value="ICICI Bank">ICICI Bank</option>
                                                                                <option value="Axis Bank">Axis Bank</option>
                                                                                <option value="State Bank of India">State Bank of India</option>
                                                                                <option value="Bank of Baroda">Bank of Baroda</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-12 mb-1">
                                                                            <label class="form-label">Payment Mode <span class="text-danger">*</span></label>
                                                                            <select class="form-control select2" name="pay_mode" required>
                                                                                <option value="">Select</option>
                                                                                <option value="IMPS/RTGS">IMPS/RTGS</option>
                                                                                <option value="NEFT">NEFT</option>
                                                                                <option value="By Cheque">By Cheque</option>
                                                                                <option value="Cash">Cash</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-12 mb-1" id="refNoDiv">
                                                                            <label class="form-label">Ref No. <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="ref_no" id="ref_no" required/>
                                                                        </div>

                                                                        <div class="col-md-12 mb-1">
                                                                            <label class="form-label">Payment Document <span class="text-danger"></span></label>
                                                                            <input type="file" class="form-control" name="pay_doc" />
                                                                        </div>

                                                                         <div class="col-md-12 mb-1">
                                                                            <label class="form-label">Paid Amount <span class="text-danger"></span></label>
                                                                            <input type="text" class="form-control" name="paid_amount" />
                                                                        </div>

                                                                        <div class="col-md-12 mb-1">
                                                                            <label class="form-label">Remarks</label>
                                                                            <textarea class="form-control" name="pay_remark"></textarea>
                                                                        </div>

                                                                        <!-- New Fields -->
                                                                        <div class="col-md-12 mb-1">
                                                                            <label class="form-label">Payment Confirmation Date <span class="text-danger">*</span></label>
                                                                            <input type="date" class="form-control" name="pay_confirmation_date" required />
                                                                        </div>

                                                                        <div class="col-md-12 mb-1">
                                                                            <label class="form-label">Payment Confirmation Time <span class="text-danger">*</span></label>
                                                                            <input type="time" class="form-control" name="pay_confirmation_time" required />
                                                                        </div>

                                                                        <div class="col-md-12 mb-1">
                                                                            <label class="form-label">Who has taken the fees <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="pay_collector" placeholder="Enter name" required />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer justify-content-center">
                                                                    <button type="button" class="btn btn-outline-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary" id="submitPayment">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>


                                                <div class="tab-pane" id="Hostel">
                                                    <div class="row">
                                                        <div class="col-md-6">

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Hostel Required</label>
                                                                </div>
                                                                {{-- <div class="row align-items-center mb-2 mt-4 justify-content-center text-center"> --}}
                                                                <div class="col-md-3">
                                                                    {{-- <label class="form-label text-primary"><strong>Hostel Required</strong></label> --}}
                                                                    <div class="demo-inline-spacing justify-content-center">
                                                                        <div class="form-check form-check-primary mt-25">
                                                                            <input type="radio" id="hostel_required_yes"
                                                                                   name="hostel_required"
                                                                                   class="form-check-input" @if($registration->hostel_required == 'Yes') checked="" @endif value="yes">
                                                                            <label class="form-check-label fw-bolder"
                                                                                   for="hostel_required1">Yes</label>
                                                                        </div>
                                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                                            <input type="radio" id="hostel_required_no"
                                                                                   name="hostel_required"
                                                                                   class="form-check-input" @if($registration->hostel_required == 'No') checked="" @endif value="no">
                                                                            <label class="form-check-label fw-bolder"
                                                                                   for="hostel_required2">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- </div> --}}

                                                                {{-- <div class="col-md-6">
                                                                                    <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                                        <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                                                        <label class="form-check-label" for="colorCheck1">Yes/No</label>
                                                                                    </div>
                                                                                </div> --}}
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4" id="check_in_date_label">
                                                                    <label class="form-label">Check-In Date <span
                                                                                class="text-danger">*</span></label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="date" class="form-control" name="check_in_date" value="{{$registration->check_in_date}}" id="check_in_date"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4" id="check_out_date_label">
                                                                    <label class="form-label">Check-Out Date <span
                                                                                class="text-danger">*</span></label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="date" class="form-control" name="check_out_date" value="{{$registration->check_out_date}}" id="check_out_date"/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4" id="room_preference_label">
                                                                    <label class="form-label">Room Preference <span
                                                                                class="text-danger"></span></label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <select class="form-select" name="room_preference" id="room_preference">
                                                                        <option>Select</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <!--
                                                                                 <div class="row align-items-center mb-1">
                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Hostel ID <span class="text-danger">*</span></label>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <input type="text" class="form-control"  />
                                                                                    </div>
                                                                                 </div>

                                                                                 <div class="row align-items-center mb-1">
                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Hostel Present <span class="text-danger">*</span></label>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <input type="text" class="form-control"  />
                                                                                    </div>
                                                                                 </div>

                                                                                 <div class="row align-items-center mb-1">
                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Hostel Absent <span class="text-danger">*</span></label>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <input type="text" class="form-control"  />
                                                                                    </div>
                                                                                 </div>


                                                                                 <div class="row mb-1">
                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Hostel Absence Reason <span class="text-danger">*</span></label>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <textarea class="form-control"></textarea>
                                                                                    </div>
                                                                                 </div>
        -->


                                                        </div>


                                                    </div>


                                                </div>


                                                <div class="tab-pane" id="document">
                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <!-- Identity Proof -->
                                                            <div class="row mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Identity Proof <span class="text-danger"></span></label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    @if(isset($sportDocuments->id_proof) && $sportDocuments->id_proof)
                                                                        <a href="{{ asset($sportDocuments->id_proof) }}" target="_blank">View Uploaded Identity Proof</a><br>
                                                                    @endif
                                                                    <input type="file" class="form-control" name="id_proof[]" />
                                                                </div>
                                                            </div>

                                                            <!-- Aadhar Card -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Aadhar Card <span class="text-danger"></span></label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    @if(isset($sportDocuments->aadhar_card) && $sportDocuments->aadhar_card)
                                                                        <a href="{{ asset($sportDocuments->aadhar_card) }}" target="_blank">View Uploaded Aadhar Card</a><br>
                                                                    @endif
                                                                    <input type="file" class="form-control" name="aadhar_card[]" />
                                                                </div>
                                                            </div>

                                                            <!-- Parent's Aadhar Card -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Parent's Aadhar Card <span class="text-danger"></span></label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    @if(isset($sportDocuments->parent_aadhar) && $sportDocuments->parent_aadhar)
                                                                        <a href="{{ asset($sportDocuments->parent_aadhar) }}" target="_blank">View Uploaded Parent's Aadhar Card</a><br>
                                                                    @endif
                                                                    <input type="file" class="form-control" name="parent_aadhar[]" />
                                                                </div>
                                                            </div>

                                                            <!-- Birth Certificate -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Birth Certificate <span class="text-danger"></span></label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    @if(isset($sportDocuments->birth_certificate) && $sportDocuments->birth_certificate)
                                                                        <a href="{{ asset($sportDocuments->birth_certificate) }}" target="_blank">View Uploaded Birth Certificate</a><br>
                                                                    @endif
                                                                    <input type="file" class="form-control" name="birth_certificate[]" />
                                                                </div>
                                                            </div>

                                                            <!-- Medical Records -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Medical Records <span class="text-danger"></span></label>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    @if(isset($sportDocuments->medical_record) && $sportDocuments->medical_record)
                                                                        <a href="{{ asset($sportDocuments->medical_record) }}" target="_blank">View Uploaded Medical Records</a><br>
                                                                    @endif
                                                                    <input type="file" class="form-control" name="medical_record[]" />
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>


                                                </div>
                                                <div class="tab-pane" id="payment">
                                                    <div class="row">

                                                        <h2 class="mb-3">Payment Details</h2>

                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>User Name</th>
                                                                <td>{{ $user->first_name . ' '. ($user->middle_name ?? ''). ' '. $user->last_name }}</td>
                                                            </tr>

                                                            @if($user->payments)
                                                                <tr>
                                                                    <th>Payment Status</th>
                                                                    <td>{{ $user->payments->status ?? 'Pending' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Bank Name</th>
                                                                    <td>{{ $user->payments->bank_name ?? 'N/A' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Payment Mode</th>
                                                                    <td>{{ $user->payments->pay_mode ?? 'N/A' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Reference No.</th>
                                                                    <td>{{ $user->payments->ref_no ?? 'N/A' }}</td>
                                                                </tr>
                                                                      <tr>
                                                                        <th>Paid Amount</th>
                                                                        <td>{{ $user->payments->paid_amount ?? 'N/A' }}</td>
                                                                    </tr>
                                                                <tr>
                                                                    <th>Payment Document</th>
                                                                    <td>
                                                                        @if(!empty($user->payments->pay_doc))
                                                                            <a href="{{ $user->payments->pay_doc }}" target="_blank">View Document</a>
                                                                        @else
                                                                            No document uploaded
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Remarks</th>
                                                                    <td>{{ $user->payments->remarks ?? 'N/A' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Pay Confirmation date</th>
                                                                    <td>{{ $user->payments->pay_confirmation_date ?? 'N/A' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Pay Confirmation time</th>
                                                                    <td>{{ $user->payments->pay_confirmation_time ?? 'N/A' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Collector</th>
                                                                    <td>{{ $user->payments->pay_collector ?? 'N/A' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Transaction Date</th>
                                                                    <td>{{ $user->payments->created_at ?? 'N/A' }}</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <th colspan="2">No payment information available</th>
                                                                </tr>
                                                            @endif
                                                        </table>


                                                    </div>


                                                </div>

                                                <!-- Other tabs like Address, Family, Emergency, Medical, Sponsor, Fee, Hostel, Document -->
                                                <!-- You can follow the same pattern as above to pre-fill the data in these tabs -->
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
    <div class="modal fade" id="sponsorModal" tabindex="-1" aria-labelledby="sponsorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sponsorModalLabel">Add Sponsor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="sponsorForm">
                        <div class="mb-3">
                            <label for="sponsorAmount" class="form-label">Sponsorship Amount</label>
                            <input type="number" class="form-control" id="sponsorAmount" placeholder="Enter sponsor amount" step="0.01" min="0">
                        </div>
                        <input type="hidden" id="feeIndex" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveSponsor">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script>
        $(document).ready(function () {
            let rowIndex = {{ count($sportTrainingDetails) }};

            // Function to add a new row
            $(document).on("click", ".add-row", function (e) {
                e.preventDefault();
                rowIndex++;

                // Get the table body
                let tableBody = $("#trainingBody");

                // Create new row
                let newRow = `
            <tr>
                <td>${rowIndex}</td>
                <td><input type="text" class="form-control mw-100" name="previous_coach[]" required /></td>
                <td><input type="text" class="form-control mw-100" name="training_academy[]" required /></td>
                <td>
<!--                    <a href="javascript:void(0)" class="text-primary add-row">-->
<!--                        <i class="fas fa-plus-square"></i>-->
<!--                    </a>-->
                    <a href="javascript:void(0)" class="text-danger remove-row">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>`;

                // Append new row
                tableBody.append(newRow);

                // Update row numbers
                updateRowNumbers();
            });

            // Function to remove a row
            $(document).on("click", ".remove-row", function (e) {
                e.preventDefault();
                $(this).closest("tr").remove();
                updateRowNumbers();
            });

            // Update row numbering dynamically
            function updateRowNumbers() {
                $("#trainingBody tr").each(function (index) {
                    $(this).find("td:first").text(index + 1);
                });
            }
        });
        // Recalculate when sponsorship percent changes
        // let feeStructure = [];
        document.addEventListener('DOMContentLoaded', function () {
            const hostelRequiredYes = document.getElementById('hostel_required_yes');
            const hostelRequiredNo = document.getElementById('hostel_required_no');
            const checkInDate = document.getElementById('check_in_date');
            const checkInDateLabel = document.getElementById('check_in_date_label');
            const checkOutDate = document.getElementById('check_out_date');
            const checkOutDateLabel = document.getElementById('check_out_date_label');
            const roomPreference = document.getElementById('room_preference');
            const roomPreferenceLabel = document.getElementById('room_preference_label');

            // Function to toggle hostel fields
            function toggleHostelFields() {
                if (hostelRequiredYes.checked) {
                    // Enable fields when "Yes" is selected
                    checkInDate.disabled = false;
                    checkOutDate.disabled = false;
                    roomPreference.disabled = false;
                    checkInDate.style.display = 'block';
                    checkOutDate.style.display = 'block';
                    roomPreference.style.display = 'block';
                    checkInDateLabel.style.display = 'block';
                    checkOutDateLabel.style.display = 'block';
                    roomPreferenceLabel.style.display = 'block';

                    // Make fields required
                    checkInDate.required = true;
                    checkOutDate.required = true;
                    roomPreference.required = true;
                } else {
                    // Disable fields when "No" is selected or initially
                    checkInDate.disabled = true;
                    checkOutDate.disabled = true;
                    roomPreference.disabled = true;

                    // Remove required attribute
                    checkInDate.required = false;
                    checkOutDate.required = false;
                    roomPreference.required = false;

                    // Clear values
                    checkInDate.value = '';
                    checkOutDate.value = '';
                    roomPreference.value = '';

                    checkInDate.style.display = 'none';
                    checkOutDate.style.display = 'none';
                    roomPreference.style.display = 'none';
                    checkInDateLabel.style.display = 'none';
                    checkOutDateLabel.style.display = 'none';
                    roomPreferenceLabel.style.display = 'none';
                }
            }

            // Add event listeners to both radio buttons
            hostelRequiredYes.addEventListener('change', toggleHostelFields);
            hostelRequiredNo.addEventListener('change', toggleHostelFields);

            // Initial call to set the correct state on page load
            toggleHostelFields();
        });
        $(document).ready(function() {
            // When BAI ID field changes
            $('#bai_id').on('input', function() {
                if ($(this).val().trim() !== '') {
                    // Set country to India (assuming India's ID is 101)
                    $('#country').val(101).trigger('change');

                    // Load Indian states
                    loadStates(101, 'other');
                }
            });

            // When BWF ID field changes
            $('#bwf_id').on('input', function() {
                if ($(this).val().trim() !== '') {
                    // Country becomes required
                    $('#country').prop('required', true);
                } else {
                    // Only make country required if BAI ID is also empty
                    if ($('#bai_id').val().trim() === '') {
                        $('#country').prop('required', false);
                    }
                }
            });

            // Ensure the script runs on page load as well
            if ($('#bai_id').val().trim() !== '') {
                $('#country').val(101).trigger('change');
                loadStates(101, 'other');
            }

            if ($('#bwf_id').val().trim() !== '') {
                $('#country').prop('required', true);
            }
        });
        $(document).ready(function() {
            $('#batch_name').change(function() {
                let batchId = $(this).val();
                $('#section').html('<option value="" selected>-----Select Section-----</option>');

                if (batchId) {
                    $.ajax({
                        url: "{{ route('get.sections.by.batch') }}",
                        type: "POST",
                        data: {
                            batch_id: batchId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $.each(response, function(index, section) {
                                    $('#section').append('<option value="' + section.id + '">' + section.section + '</option>');
                                });
                            }
                        }
                    });
                }
            });
            $('#section').change(function() {
                fetchFeeStructure();
            });
            $('#quota_id').change(function() {
                fetchFeeStructure();
            });

            function fetchFeeStructure() {
                // Get all required values
                // alert('testing');
                const sportId = $('#sport_id').val();
                const sectionId = $('#section').val();
                const batchYear = $('#batch_year').val();
                const batchId = $('#batch_name').val();
                const quotaId = $('#quota_id').val();

                // Make sure all fields are selected
                // if (!sportId || !sectionId || !batchYear || !batchId || !quotaId) {
                //     return;
                // }

                $.ajax({
                    url: '{{ route("fetch.fee.structure") }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        sport_id: sportId,
                        section_id: sectionId,
                        batch_year: batchYear,
                        batch_id: batchId,
                        quota_id: quotaId
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status === 'success') {
                            updateFeeTable(response.feeStructure);
                        } else {
                            alert('Failed to fetch fee structure.');
                        }
                    },
                    error: function () {
                        alert('An error occurred while fetching the fee structure.');
                    }
                });
            }
            let feeStructure = [];

// Function to update the fee table
            function updateFeeTable(feeData) {
                feeStructure = feeData; // Update the global feeStructure
                let feeTableBody = $('#feeTable tbody');
                feeTableBody.empty(); // Clear existing rows

                let totalNetFeePayableValue = 0;

                feeData.forEach((fee, index) => {
                    let totalFees = Number(fee.total_fees) || 0;
                    let feeSponsorshipPercent = Number(fee.fee_sponsorship_percent) || 0;
                    let feeSponsorshipValue = Number(fee.fee_sponsorship_value) || (totalFees * feeSponsorshipPercent / 100);
                    let feeDiscountPercent = Number(fee.fee_discount_percent) || 0;
                    let feeDiscountValue = Number(fee.fee_discount_value) || (totalFees * feeDiscountPercent / 100);
                    let feeSponsorshipPlusDiscountPercent = feeSponsorshipPercent + feeDiscountPercent;
                    let feeSponsorshipPlusDiscountValue = feeSponsorshipValue + feeDiscountValue;
                    let netFeePayablePercent = 100 - feeSponsorshipPlusDiscountPercent;
                    let netFeePayableValue = totalFees - feeSponsorshipPlusDiscountValue;

                    // Add row to the table
                    let row = `
            <tr>
                <td>${index + 1}</td>
                <td><input type="text" class="form-control" name="fee_details[${index}][title]" value="${fee.title || ''}" readonly></td>
                <td><input type="number" class="form-control total-fee" name="fee_details[${index}][total_fees]" value="${totalFees}" readonly></td>
                <td><input type="number" class="form-control sponsorship-percent" name="fee_details[${index}][fee_sponsorship_percent]" value="${feeSponsorshipPercent}"></td>
                <td><input type="number" class="form-control sponsorship-value" name="fee_details[${index}][fee_sponsorship_value]" value="${feeSponsorshipValue.toFixed(2)}" readonly></td>
                <td><input type="number" class="form-control discount-percent" name="fee_details[${index}][fee_discount_percent]" value="${feeDiscountPercent}"></td>
                <td><input type="number" class="form-control discount-value" name="fee_details[${index}][fee_discount_value]" value="${feeDiscountValue.toFixed(2)}" readonly></td>
                <td><input type="number" class="form-control total-discount-percent" value="${feeSponsorshipPlusDiscountPercent}" readonly></td>
                <td><input type="number" class="form-control total-discount-value" value="${feeSponsorshipPlusDiscountValue.toFixed(2)}" readonly></td>
                <td><input type="number" class="form-control net-percent" value="${netFeePayablePercent}" readonly></td>
                <td><input type="number" class="form-control net-value" value="${netFeePayableValue.toFixed(2)}" readonly></td>
                <td>
                    <button type="button" class="btn btn-sm btn-outline-primary add-sponsor-btn" data-index="${index}" data-bs-toggle="modal" data-bs-target="#sponsorModal">
                        Add Sponsor
                    </button>
                    ${index !== 0 ? '<a href="#" class="text-danger ms-25 delete-fee-row"><i data-feather="trash-2" class="me-50"></i></a>' : ''}
                </td>
            </tr>
        `;
                    feeTableBody.append(row);

                    // Add to total only if applicable
                    if (fee.mandatory || fee.isChecked) {
                        totalNetFeePayableValue += netFeePayableValue;
                    }
                });

                // Add total row
                feeTableBody.append(`
        <tr class="total-row">
            <td></td>
            <td colspan="9" class="text-end fw-bolder text-dark font-large-1">Total Fees</td>
            <td class="fw-bolder text-dark font-large-1" id="totalNetFeePayableValue">${totalNetFeePayableValue.toFixed(2)}</td>
            <td></td>
        </tr>
    `);

                feather.replace();
            }

            $(document).on('click', '.add-sponsor-btn', function() {
                let index = $(this).data('index');
                $('#feeIndex').val(index);

                // Pre-fill the modal with current sponsorship value if exists
                if (feeStructure[index]) {
                    let currentSponsorship = feeStructure[index].fee_sponsorship_value || 0;
                    $('#sponsorAmount').val(currentSponsorship);
                }
            });

            $('#sponsorModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var index = button.data('index'); // Extract info from data-* attributes
                $('#feeIndex').val(index);

                // Pre-fill the modal with current sponsorship value if exists
                var currentSponsorship = feeStructure[index]?.fee_sponsorship_value || 0;
                $('#sponsorAmount').val(currentSponsorship);
            });
            $('#saveSponsor').on('click', function () {
                let sponsorAmount = Number($('#sponsorAmount').val());
                let index = $('#feeIndex').val();
                let totalNetFeePayableValue = Number($('#totalNetFeePayableValue').text());
                console.log(feeStructure);
                console.log('Sponsor amount:', sponsorAmount); // Log sponsorAmount for debugging
                console.log('Index from modal input:', index); // Log index from the hidden input for debugging
                console.log('Net fee:', totalNetFeePayableValue); // Log index from the hidden input for debugging
                // console.log('feeStructure array:', feeStructure); // Log the entire feeStructure array
                // console.log(`feeStructure[${index}]:`, feeStructure[index]); // Log the specific feeStructure entry

                // Check if the index is valid and the feeStructure entry exists
                if (!isNaN(sponsorAmount) && sponsorAmount > 0) {
                    // feeStructure[index].fee_sponsorship_value = sponsorAmount;
                    // console.log('Sponsorship value updated:', feeStructure[index]); // Log the updated fee structure entry
                    let totalFee = totalNetFeePayableValue - sponsorAmount;
                    $('#totalNetFeePayableValue').text(totalFee);
                    $('#sponsorModal').modal('hide'); // Close the modal
                    // updateFeeTable(feeStructure); // Recalculate and update the fee table
                } else {
                    console.error('Invalid index or sponsorship amount.');
                }
            });
            $(document).on('change', '.sponsorship-percent', function() {
                let row = $(this).closest('tr');
                let totalFee = parseFloat(row.find('.total-fee').val()) || 0;
                let percent = parseFloat($(this).val()) || 0;
                let value = (totalFee * percent / 100).toFixed(2);

                row.find('.sponsorship-value').val(value);
                recalculateRow(row);
            });

            // Recalculate when discount percent changes
            $(document).on('change', '.discount-percent', function() {
                let row = $(this).closest('tr');
                let totalFee = parseFloat(row.find('.total-fee').val()) || 0;
                let percent = parseFloat($(this).val()) || 0;
                let value = (totalFee * percent / 100).toFixed(2);

                row.find('.discount-value').val(value);
                recalculateRow(row);
            });

            function recalculateRow(row) {
                let totalFee = parseFloat(row.find('.total-fee').val()) || 0;
                let sponsorshipValue = parseFloat(row.find('.sponsorship-value').val()) || 0;
                let discountValue = parseFloat(row.find('.discount-value').val()) || 0;

                let totalDiscountValue = sponsorshipValue + discountValue;
                let totalDiscountPercent = (totalDiscountValue / totalFee * 100).toFixed(2);
                let netValue = totalFee - totalDiscountValue;
                let netPercent = 100 - totalDiscountPercent;

                row.find('.total-discount-percent').val(totalDiscountPercent);
                row.find('.total-discount-value').val(totalDiscountValue.toFixed(2));
                row.find('.net-percent').val(netPercent);
                row.find('.net-value').val(netValue.toFixed(2));

                // Update the total row
                updateTotalRow();
            }

            function updateTotalRow() {
                let totalNetFee = 0;
                $('tr:not(.total-row)').each(function() {
                    let netValue = parseFloat($(this).find('.net-value').val()) || 0;
                    totalNetFee += netValue;
                });

                $('.total-row .font-large-1').last().text(totalNetFee.toFixed(2));
            }
            // Initialize the dropdowns based on the selected section
            {{--var sectionName = $('#section').val();--}}
            {{--if (sectionName) {--}}
            {{--    // Fetch batch years for the selected section--}}
            {{--    $.ajax({--}}
            {{--        url: "{{ route('get.batch.year') }}",--}}
            {{--        type: "POST",--}}
            {{--        data: {--}}
            {{--            section_name: sectionName,--}}
            {{--            _token: "{{ csrf_token() }}"--}}
            {{--        },--}}
            {{--        success: function(response) {--}}
            {{--            if (response.length > 0) {--}}
            {{--                var selectedYear = "{{ $selectedBatch ? $selectedBatch->batch_year : '' }}";--}}
            {{--                $('#batch_year').html('<option value="">-----Select Year-----</option>');--}}

            {{--                $.each(response, function(index, item) {--}}
            {{--                    var selected = (item == selectedYear) ? 'selected' : '';--}}
            {{--                    $('#batch_year').append('<option value="' + item + '" ' + selected + '>' + item + '</option>');--}}
            {{--                });--}}

            {{--                // If there's a selected year, trigger the change to load batch names--}}
            {{--                if (selectedYear) {--}}
            {{--                    $('#batch_year').trigger('change');--}}
            {{--                }--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}
            {{--}--}}

            // Section change event (same as create)
            $('#section').change(function() {
                var sectionId = $(this).val();
                var sectionName = $(this).find(':selected').data('name');

                $('#batch_year').html('<option value="">-----Select Year-----</option>');
                $('#batch_name').html('<option value="">-----Select Batch-----</option>');

                if (sectionId && sectionName) {
                    $.ajax({
                        url: "{{ route('get.batch.year.student') }}",
                        type: "POST",
                        data: {
                            section_name: sectionName,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $.each(response, function(index, item) {
                                    $('#batch_year').append('<option value="' + item + '">' + item + '</option>');
                                });
                                $('#batch_year').prop('disabled', false);
                            }
                        }
                    });
                } else {
                    $('#batch_year').prop('disabled', true);
                    $('#batch_name').prop('disabled', true);
                }
                fetchFeeStructure();
            });

            // Batch Year change event
            $('#batch_year').change(function() {
                var sectionId = $('#section').val();
                var sectionName = $('#section').find(':selected').data('name');
                var batchYear = $(this).val();

                $('#batch_name').html('<option value="">-----Select Batch-----</option>');
                if (sectionId && sectionName && batchYear) {
                    $.ajax({
                        url: "{{ route('get.batch.names.student') }}",
                        type: "POST",
                        data: {
                            section_name: sectionName,
                            batch_year: batchYear,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response)
                            {{--console.log("{{ $selectedBatch ? $selectedBatch->id : '' }}")--}}
                            if (response.length > 0) {
                                var selectedBatchId = "{{ $selectedBatch ? $selectedBatch->id : '' }}";

                                $.each(response, function(index, item) {
                                    console.log(index, item)
                                    var selected = (item.id == selectedBatchId) ? 'selected' : '';
                                    $('#batch_name').append('<option value="' + item.id + '" ' + selected + '>' + item.batch + '</option>');
                                });
                                $('#batch_name').prop('disabled', false);
                            }
                        }
                    });
                } else {
                    $('#batch_name').prop('disabled', true);
                }
                fetchFeeStructure();
            });
        });
        var initialCountry = $('#other_country').val();
        if (initialCountry) {
            loadStates(initialCountry, 'other');
        }

        // Your existing change handler
        // $('#other_country').change(function() {
        //     let countryId = $(this).val();
        //     if (countryId) {
        //         loadStates(countryId, 'other');
        //     } else {
        //         $('#other_state').html('<option value="">Select State</option>');
        //         $('#other_district').html('<option value="">Select City</option>');
        //     }
        // });

        // Load cities when state changes in Other Details section
        $('#other_state').change(function() {
            let stateId = $(this).val();
            if (stateId) {
                loadCities(stateId, 'other');
            } else {
                $('#other_district').html('<option value="">Select City</option>');
            }
        });
        function getDate(yearsAgo) {
            let d = new Date();
            d.setFullYear(d.getFullYear() + yearsAgo);
            return d.toISOString().split('T')[0];
        }

        function validateDOB() {
            let dob = document.getElementById("dobInput").value;
            let minDate = getDate(-50);
            let maxDate = getDate(-10);
            let errorField = document.getElementById("dobError");

            if (dob < minDate || dob > maxDate) {
                errorField.textContent = "Age must be between 10 and 50 years.";
            } else {
                errorField.textContent = "";
            }
        }

        function validateDOJ() {
            let doj = document.getElementById("dojInput").value;
            let minDate = getDate(-1);
            let maxDate = getDate(0);
            let errorField = document.getElementById("dojError");

            if (doj < minDate || doj > maxDate) {
                errorField.textContent = "You can only select a date within the last 1 year.";
            } else {
                errorField.textContent = "";
            }
        }
        $(document).ready(function () {
            // Add new row
            $(".add-contactpeontxt, .add-contact-row").on("click", function (e) {
                e.preventDefault();
                // alert(12);
                let newRow = `
            <tr class="family-row">
                <td>#</td>
                <td>
                    <select class="form-select mw-100 relation" name="family_details[0][relation]">
                        <option>Select</option>
                        <option>Father</option>
                        <option>Mother</option>
                        <option>Grandfather</option>
                        <option>Grandmother</option>
                        <option>Uncle</option>
                        <option>Aunt</option>
                        <option>Sibling</option>
                        <option>Local Guardian</option>
                        <option>Other</option>
                    </select>
                </td>
                <td><input type="text" class="form-control mw-100 name" name="family_details[0][name]"></td>
                <td><input type="text" class="form-control mw-100 contact" name="family_details[0][contact_no]"></td>
                <td><input type="text" class="form-control mw-100 email" name="family_details[0][email]"></td>
                <td>
                    <input type="radio" name="guardian" class="guardian">
                </td>
                <td>
                    <a href="#" class="text-danger delete-row"><i data-feather="trash-2" class="me-50"></i></a>
                </td>
            </tr>
        `;

                $("#familyTable tbody").append(newRow);
                feather.replace(); // Refresh icons
            });

            // Delete row
            $(document).on("click", ".delete-row", function (e) {
                e.preventDefault();
                $(this).closest("tr").remove();
            });
            let sponsorRowIndex = 1;

            // Function to add a new sponsor row
            $(document).on("click", ".add-sponsor-row", function (e) {
                e.preventDefault();

                sponsorRowIndex++;

                let newRow = `
            <tr>
                <td>${sponsorRowIndex}</td>
                <td><input type="text" class="form-control mw-100" name="sponsor[${sponsorRowIndex}][name]" required /></td>
                <td><input type="text" class="form-control mw-100" name="sponsor[${sponsorRowIndex}][spoc]" required /></td>
                <td><input type="text" class="form-control mw-100" name="sponsor[${sponsorRowIndex}][phone]" required /></td>
                <td><input type="text" class="form-control mw-100" name="sponsor[${sponsorRowIndex}][email]" /></td>
                <td><input type="text" class="form-control mw-100" name="sponsor[${sponsorRowIndex}][email_position]" /></td>
                <td>
                    <a href="#" class="text-danger delete-sponsor-row">
                        <i data-feather="trash-2"></i>
                    </a>
                </td>
            </tr>
        `;

                $("#sponsorTable tbody").append(newRow);
                feather.replace(); // Refresh icons
            });

            // Function to delete a sponsor row
            $(document).on("click", ".delete-sponsor-row", function (e) {
                e.preventDefault();
                $(this).closest("tr").remove();
                updateSponsorRowNumbers();
            });

            // Update sponsor row numbering dynamically
            function updateSponsorRowNumbers() {
                $("#sponsorTable tbody tr").each(function (index) {
                    $(this).find("td:first").text(index + 1);
                });
            }
        });
        {{--document.getElementById('batch_year').addEventListener('change', function () {--}}
        {{--    var selectedYear = this.value;--}}
        {{--    var batchNameDropdown = document.getElementById('batch_name');--}}
        {{--    batchNameDropdown.innerHTML = '<option value="">Select Name</option>'--}}
        {{--    console.log(@json($batch));--}}
        {{--    @json($batch).forEach(function(batch) {--}}
        {{--            if (batch.batch_year == selectedYear) {--}}
        {{--                var option = document.createElement('option');--}}
        {{--                option.value = batch.id;--}}
        {{--                option.text = batch.batch_name;--}}
        {{--                batchNameDropdown.appendChild(option);--}}
        {{--            }--}}
        {{--        });--}}
        {{--});--}}

        document.getElementById('batch_name').addEventListener('change', function () {
            var selectedBatchName = this.options[this.selectedIndex].text;
            document.getElementById('selected_batch_name').value = selectedBatchName;
        });
        $(document).ready(function() {
            // Handle form submission for update payment
            function toggleBankName() {
                var payMode = $('select[name="pay_mode"]').val();

                if (payMode === 'Cash') {
                    $('#bankNameDiv').hide();
                    $('#refNoDiv').hide();
                    $('#bank_name').val('').prop('required', false);
                    $('#ref_no').val('').prop('required', false);
                } else {
                    $('#bankNameDiv').show();
                    $('#refNoDiv').show();
                    $('#bank_name').prop('required', true);
                    $('#ref_no').prop('required', true);
                }
            }

            toggleBankName();

            $('select[name="pay_mode"]').on('change', function() {
                toggleBankName();
            });
            $('#submitPayment').on('click', function(e) {
                e.preventDefault();  // Prevent the default form submission

                // Disable the button to prevent multiple submissions
                $('#submitPayment').prop('disabled', true);

                // Show loading indicator
                $('#submitPayment').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

                // Collect all input values manually
                var formData = new FormData();
                formData.append('user_id', $('input[name="user_id"]').val());
                formData.append('confirm_payment', $('input[name="confirm_payment"]').val());
                formData.append('bank_name', $('#bank_name').val());
                formData.append('pay_mode', $('select[name="pay_mode"]').val());
                formData.append('ref_no', $('input[name="ref_no"]').val());
                formData.append('pay_doc', $('input[name="pay_doc"]')[0].files[0]);  // Handle file input
                formData.append('pay_remark', $('textarea[name="pay_remark"]').val());
                formData.append('pay_confirmation_date', $('input[name="pay_confirmation_date"]').val());
                formData.append('pay_confirmation_time', $('input[name="pay_confirmation_time"]').val());
                formData.append('pay_collector', $('input[name="pay_collector"]').val());

                // Perform the Ajax request
                $.ajax({
                    url: "{{ route('update-payment') }}",
                    type: "POST",
                    data: formData,
                    processData: false,  // Important for FormData
                    contentType: false,   // Important for FormData
                    success: function(response) {
                        if(response.success) {
                            // Show success message
                            toastr.success(response.message, 'Success');

                            // Close the modal after 1.5 seconds
                            setTimeout(function() {
                                $('#update-payment').modal('hide');
                            }, 1500);
                            location.reload()
                            // Optionally refresh part of the page or update the UI
                        } else {
                            // Show error message
                            toastr.error(response.message, 'Error');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message
                            ? xhr.responseJSON.message
                            : 'An error occurred while processing your request.';
                        toastr.error(errorMessage, 'Error');
                    },
                    complete: function() {
                        // Re-enable the submit button
                        $('#submitPayment').prop('disabled', false);
                        $('#submitPayment').html('Submit');
                    }
                });
            });

            // Reset form when modal is closed
            $('#update-payment').on('hidden.bs.modal', function () {
                $('#paymentForm')[0].reset();
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
        $(document).on('input', '#total_fee, #fee_discount', function () {
            var $row = $(this).closest('tr');
            var totalFee = parseFloat($row.find('#total_fee').val()) || 0;
            var discount = parseFloat($row.find('#fee_discount').val()) || 0;

            var discountValue = (totalFee * discount) / 100;
            var netFee = totalFee - discountValue;

            $row.find('#fee_discount_value').val(discountValue.toFixed(2));
            $row.find('#net_fee').val(netFee.toFixed(2));
        });

        feather.replace();

        // Add new row logic
        $('body').on('click', '.add-contact-row', function (e) {
            e.preventDefault();
            var $currentRow = $(this).closest('tr');
            var table = $(this).closest('table');

            // Validate if at least one field is filled
            var isValid = $currentRow.find('input[type=text], input[type=number]').filter(function () {
                return $(this).val().trim() !== '';
            }).length > 0;

            if (!isValid) {
                alert('At least one field must be filled before adding a new row.');
                return;
            }

            // Generate a new row
            var newRow = `
                <tr>
                    <td></td> <!-- Serial number will be added dynamically -->
                    <td><input type="text" class="form-control mw-100" value="" required /></td>
                    <td><input type="number" class="form-control mw-100" value="" id="total_fee" required /></td>
                    <td><input type="number" class="form-control mw-100" value="" id="fee_discount" /></td>
                    <td><input type="text" class="form-control mw-100" value="" id="fee_discount_value" readonly /></td>
                    <td><input type="text" class="form-control mw-100" value="" id="net_fee" readonly /></td>
                    <td><input type="checkbox" class="form-check-input" /></td>
                    <td>
                        <select class="form-select mw-100">
                            <option>Select</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                            <option>Quarterly</option>
                            <option>Semi-Yearly</option>
                            <option>Yearly</option>
                            <option>One Time</option>
                        </select>
                    </td>
                    <td>
                        <a href="#" class="text-primary add-contact-row">
                            <i data-feather="plus-square"></i>
                        </a>
                    </td>
                </tr>
            `;

            // Add the new row to the table
            table.find('tbody').prepend(newRow);

            // Update serial numbers
            var rows = table.find('tbody tr');
            rows.each(function (index) {
                $(this).find('td:first').text(index + 1);
            });

            // Update icons
            rows.each(function (index) {
                var actionCell = $(this).find('td:last');
                if (index === 0) {
                    // Latest row: Add icon
                    actionCell.html(`
                        <a href="#" class="text-primary add-contact-row">
                            <i data-feather="plus-square"></i>
                        </a>
                    `);
                } else {
                    // Previous rows: Delete icon
                    actionCell.html(`
                        <a href="#" class="text-danger delete-item">
                            <i data-feather="trash"></i>
                        </a>
                    `);
                }
            });

            // Replace Feather Icons
            feather.replace();
        });

        // Handle delete icon click
        $('tbody').on('click', '.delete-item', function (e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            row.remove();

            // Update serial numbers after deletion
            var table = row.closest('table');
            var rows = table.find('tbody tr');
            rows.each(function (index) {
                $(this).find('td:first').text(index + 1);
            });
        });
        // const futureDateInputs = document.querySelectorAll('.dobInput');
        //
        // function disableDates() {
        //     const today = new Date().toISOString().split('T')[0];
        //     futureDateInputs.forEach(input => {
        //         input.setAttribute('min', today);
        //     });
        // }
        // disableDates();
        function loadStates(countryId, type) {
            $.ajax({
                url: '/get-states/' + countryId,
                method: 'GET',
                success: function(data) {
                    var stateDropdown = $('#' + type + '_state');
                    var selectedState = "{{ $registration->bai_state }}"; // Get the selected state from PHP

                    stateDropdown.empty();
                    stateDropdown.append('<option value="">Select State</option>');

                    $.each(data, function(key, state) {
                        var isSelected = (state.id == selectedState) ? 'selected' : '';
                        stateDropdown.append('<option value="' + state.id + '" ' + isSelected + '>' + state.name + '</option>');
                    });

                    // If there's a selected state but it's not in the list, add it
                    if (selectedState && !data.some(state => state.id == selectedState)) {
                        // You might need an additional AJAX call here to get the state name
                        stateDropdown.append('<option value="' + selectedState + '" selected>Previously Selected State</option>');
                    }
                }
            });
        }

        function loadCities(stateId, type) {
            $.ajax({
                url: '/get-cities/' + stateId,
                method: 'GET',
                success: function(data) {
                    var cityDropdown = $('#' + type + '_district');
                    cityDropdown.empty();
                    cityDropdown.append('<option>Select City</option>');
                    $.each(data, function(key, city) {
                        cityDropdown.append('<option value="' + city.id + '">' + city.name + '</option>');
                    });
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const imageInput = document.getElementById('{{ $registration->image ? "replace-image" : "imageUpload" }}');
            const previewImg = document.getElementById("previewImg");
            const photoSizeText = document.getElementById("photoSizeText");

            imageInput.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.style.display = "block";
                        if (photoSizeText) photoSizeText.style.display = "none";
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
        function saveDraft() {
            document.getElementById('status').value = 'on-hold';
            document.getElementById('postRegister').submit();
        }

        function proceed() {
            document.getElementById('status').value = 'approved';
            document.getElementById('postRegister').submit();
        }
        function openRejectModal() {
            $('#rejectModal').modal('show');
        }

        // Function to submit the reject form
        function submitRejectForm() {
            // Get the remarks from the modal
            let remarks = $('#remarks').val();

            // Set the status to 'rejected'
            document.getElementById('status').value = 'rejected';

            // Add the remarks to the form
            let remarksInput = document.createElement('input');
            remarksInput.type = 'hidden';
            remarksInput.name = 'remarks';
            remarksInput.value = remarks;
            document.getElementById('postRegister').appendChild(remarksInput);

            // Submit the form
            document.getElementById('postRegister').submit();
        }
        $('#series').on('change', function() {
            // alert(12);
            getDocNumberByBookId();
        });

        $(document).ready(function () {

        });

        function getDocNumberByBookId() {
            let currentDate = new Date().toISOString().split('T')[0];
            let bookId = $('#series').val();
            let actionUrl = '{{ route('book.get.doc_no_and_parameters') }}' + '?book_id=' + bookId + "&document_date=" +
                currentDate;
            fetch(actionUrl).then(response => {
                return response.json().then(data => {
                    if (data.status == 200) {
                        $("#book_code_input").val(data.data.book_code);
                        if (!data.data.doc.document_number) {
                            $("#requestno").val('');
                            $('#doc_number_type').val('');
                            $('#doc_reset_pattern').val('');
                            $('#doc_prefix').val('');
                            $('#doc_suffix').val('');
                            $('#doc_no').val('');
                        } else {
                            $("#requestno").val(data.data.doc.document_number);
                            $('#doc_number_type').val(data.data.doc.type);
                            $('#doc_reset_pattern').val(data.data.doc.reset_pattern);
                            $('#doc_prefix').val(data.data.doc.prefix);
                            $('#doc_suffix').val(data.data.doc.suffix);
                            $('#doc_no').val(data.data.doc.doc_no);
                        }
                        if (data.data.doc.type == 'Manually') {
                            $("#requestno").attr('readonly', false);
                        } else {
                            $("#requestno").attr('readonly', true);
                        }
                    }
                    if (data.status == 404) {
                        $("#requestno").val('');
                        $('#doc_number_type').val('');
                        $('#doc_reset_pattern').val('');
                        $('#doc_prefix').val('');
                        $('#doc_suffix').val('');
                        $('#doc_no').val('');
                        alert(data.message);
                    }
                });
            });
        }
    </script>
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function () {--}}
{{--            $('#quota_id').trigger('change');--}}
{{--            $(document).ready(function () {--}}
{{--                $('#colorCheck2').change(function () {--}}
{{--                    if ($(this).is(':checked')) {--}}
{{--                        // Copy permanent address fields to correspondence address fields--}}
{{--                        $('#correspondence_street1').val($('#permanent_street1').val());--}}
{{--                        $('#correspondence_street2').val($('#permanent_street2').val());--}}
{{--                        $('#correspondence_town').val($('#permanent_town').val());--}}
{{--                        $('#correspondence_pincode').val($('#permanent_pincode').val());--}}

{{--                        // Copy country, state, and city--}}
{{--                        $('#correspondence_country').val($('#permanent_country').val()).trigger('change');--}}

{{--                        // Wait for the states to load, then set the state--}}
{{--                        setTimeout(function () {--}}
{{--                            $('#correspondence_state').val($('#permanent_state').val()).trigger('change');--}}

{{--                            // Wait for the cities to load, then set the city--}}
{{--                            setTimeout(function () {--}}
{{--                                $('#correspondence_district').val($('#permanent_district').val());--}}
{{--                            }, 500); // Adjust the timeout as needed--}}
{{--                        }, 500); // Adjust the timeout as needed--}}
{{--                    } else {--}}
{{--                        // Clear correspondence address fields--}}
{{--                        $('#correspondence_street1, #correspondence_street2, #correspondence_town, #correspondence_district, #correspondence_state, #correspondence_country, #correspondence_pincode').val('');--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            $('#quota_id').on('change', function () {--}}
{{--                let quotaId = $(this).val();--}}
{{--                if (quotaId) {--}}
{{--                    fetchFeeStructure(quotaId);--}}
{{--                }--}}
{{--            });--}}

{{--            function fetchFeeStructure(quotaId) {--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route("fetch.fee.structure") }}', // Replace with your route--}}
{{--                    type: 'GET',--}}
{{--                    data: {--}}
{{--                        quota_id: quotaId--}}
{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                        console.log(response);--}}
{{--                        if (response.status === 'success') {--}}
{{--                            updateFeeTable(response.feeStructure);--}}
{{--                        } else {--}}
{{--                            alert('Failed to fetch fee structure.');--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function () {--}}
{{--                        alert('An error occurred while fetching the fee structure.');--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}

{{--            function updateFeeTable(feeStructure) {--}}
{{--                let feeTableBody = $('#feeTable tbody');--}}
{{--                feeTableBody.empty(); // Clear existing rows--}}

{{--                let totalNetFeePayableValue = 0;--}}

{{--                feeStructure.forEach((fee, index) => {--}}
{{--                    console.log(fee);--}}
{{--                    let totalFees = Number(fee.total_fees) || 0;--}}
{{--                    let feeSponsorshipPercent = Number(fee.fee_sponsorship_percent) || 0;--}}
{{--                    let feeSponsorshipValue = Number(fee.fee_sponsorship_value) || (totalFees * feeSponsorshipPercent / 100);--}}
{{--                    let feeDiscountPercent = Number(fee.fee_discount_percent) || 0;--}}
{{--                    let feeDiscountValue = Number(fee.fee_discount_value) || (totalFees * feeDiscountPercent / 100);--}}
{{--                    let feeSponsorshipPlusDiscountPercent = feeSponsorshipPercent + feeDiscountPercent;--}}
{{--                    let feeSponsorshipPlusDiscountValue = feeSponsorshipValue + feeDiscountValue;--}}
{{--                    let netFeePayablePercent = 100 - feeSponsorshipPlusDiscountPercent;--}}
{{--                    let netFeePayableValue = totalFees - feeSponsorshipPlusDiscountValue;--}}

{{--                    // Add the value to total--}}
{{--                    totalNetFeePayableValue += netFeePayableValue;--}}

{{--                    let row = `--}}
{{--        <tr>--}}
{{--            <td>${index + 1}</td>--}}
{{--            <td><input type="text" class="form-control" name="fee_details[${index}][title]" value="${fee.title}" readonly></td>--}}
{{--            <td><input type="number" class="form-control" name="fee_details[${index}][total_fees]" value="${totalFees}"></td>--}}
{{--            <td><input type="number" class="form-control" name="fee_details[${index}][fee_sponsorship_percent]" value="${feeSponsorshipPercent}"></td>--}}
{{--            <td><input type="number" class="form-control" name="fee_details[${index}][fee_sponsorship_value]" value="${feeSponsorshipValue.toFixed(2)}" readonly></td>--}}
{{--            <td><input type="number" class="form-control" name="fee_details[${index}][fee_discount_percent]" value="${feeDiscountPercent}"></td>--}}
{{--            <td><input type="number" class="form-control" name="fee_details[${index}][fee_discount_value]" value="${feeDiscountValue.toFixed(2)}" readonly></td>--}}
{{--            <td><input type="number" class="form-control" value="${feeSponsorshipPlusDiscountPercent}" readonly></td>--}}
{{--            <td><input type="number" class="form-control" value="${feeSponsorshipPlusDiscountValue.toFixed(2)}" readonly></td>--}}
{{--            <td><input type="number" class="form-control" value="${netFeePayablePercent}" readonly></td>--}}
{{--            <td><input type="number" class="form-control" value="${netFeePayableValue.toFixed(2)}" readonly></td>--}}
{{--            <td>--}}
{{--                <a href="#sponsor" data-bs-toggle="modal">--}}
{{--                    <span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span>--}}
{{--                </a>--}}
{{--                ${index !== 0 ? '<a href="#" class="text-danger ms-25"><i data-feather="trash-2" class="me-50"></i></a>' : ''}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        `;--}}
{{--                    feeTableBody.append(row);--}}
{{--                });--}}

{{--                // Update the total fees row--}}
{{--                feeTableBody.append(`--}}
{{--    <tr>--}}
{{--        <td></td>--}}
{{--        <td colspan="9" class="text-end fw-bolder text-dark font-large-1">Total Fees</td>--}}
{{--        <td class="fw-bolder text-dark font-large-1" id="totalNetFeePayableValue">${totalNetFeePayableValue.toFixed(2)}</td>--}}
{{--        <td></td>--}}
{{--    </tr>--}}
{{--    `);--}}

{{--                feather.replace(); // Refresh icons--}}
{{--            }--}}


{{--            // function updateFeeDetails() {--}}
{{--            //     let feeDetails = [];--}}
{{--            //     $('#feeTable tbody tr').each(function () {--}}
{{--            //         let row = $(this);--}}
{{--            //         let feeDetail = {--}}
{{--            //             title: row.find('input[name="title[]"]').val(),--}}
{{--            //             total_fees: row.find('input[name="total_fees[]"]').val(),--}}
{{--            //             fee_sponsorship_percent: row.find('input[name="fee_sponsorship_percent[]"]').val(),--}}
{{--            //             fee_sponsorship_value: row.find('input[name="fee_sponsorship_value[]"]').val(),--}}
{{--            //             fee_discount_percent: row.find('input[name="fee_discount_percent[]"]').val(),--}}
{{--            //             fee_discount_value: row.find('input[name="fee_discount_value[]"]').val(),--}}
{{--            //             fee_sponsorship_plus_discount_percent: row.find('input[name="fee_sponsorship_plus_discount_percent[]"]').val(),--}}
{{--            //             fee_sponsorship_plus_discount_value: row.find('input[name="fee_sponsorship_plus_discount_value[]"]').val(),--}}
{{--            //             net_fee_payable_percent: row.find('input[name="net_fee_payable_percent[]"]').val(),--}}
{{--            //             net_fee_payable_value: row.find('input[name="net_fee_payable_value[]"]').val(),--}}
{{--            //         };--}}
{{--            //         feeDetails.push(feeDetail);--}}
{{--            //     });--}}
{{--            //     $('#feeDetailsInput').val(JSON.stringify(feeDetails));--}}
{{--            // }--}}
{{--            //--}}
{{--            // $('#feeTable').on('change', 'input', function () {--}}
{{--            //     updateFeeDetails();--}}
{{--            // });--}}


{{--        });--}}

{{--    </script>--}}
    <!-- Modals and scripts can be reused from the registration.blade.php -->
@endsection