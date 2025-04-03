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
                                        <li class="breadcrumb-item"><a href={{ url('') }}>Home</a>
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
                                        data-feather="save"></i> Save as Draft</button>
                            <button onClick="proceed()"
                                    {{--                                    data-bs-toggle="modal" data-bs-target="#disclaimer"--}}
                                    class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i>
                                Update</button>
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
{{--                        @dump($errors)--}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li> <!-- Display each individual error -->
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile-registration-update', $registration->id) }}" method="post"
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
                                                <div class="newheader border-bottom mb-2 pb-25">
                                                    <h4 class="card-title text-theme">Basic Information</h4>
                                                    <p class="card-text">Fill the details</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Series -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Series <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="book_id" id="series" required>
                                                            <option value="" disabled>Select</option>
                                                            @foreach ($series as $ser)
                                                                <option value="{{ $ser->id }}" {{ old('book_id', $registration->book_id) == $ser->id ? 'selected' : '' }}>{{ $ser->book_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('book_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Temporary ID -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Temporary ID <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="document_number" readonly id="requestno" value="{{ $registration->document_number }}">
                                                        @error('document_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                        <input type="hidden" name="status" id="status" value="">
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
                                                <!-- Registration Date -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Reg. Date <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" onchange="getDocNumberByBookId()" class="form-control" name="document_date" id="document_date"
                                                               value="{{ old('document_date', $registration->document_date) }}">
                                                        @error('document_date')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Sport Name -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sport Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="sport_id" id="sport_id">
                                                            <option value="">Select</option>
                                                            @foreach ($sport_types as $type)
                                                                <option value="{{ $type->id }}" {{ old('sport_id', $registration->sport_id) == $type->id ? 'selected' : '' }}>{{ $type->sport_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('sport_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Name -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="First Name" class="form-control" name="name" value="{{ old('name', $registration->name) }}">
                                                        @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Middle Name" class="form-control" name="middle_name" value="{{ old('middle_name', $registration->middle_name) }}">
                                                        @error('middle_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Last Name" class="form-control" name="last_name" value="{{ old('last_name', $registration->last_name) }}">
                                                        @error('last_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Gender -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio1" name="gender" class="form-check-input"
                                                                       value="male" {{ old('gender', $registration->gender) == 'male' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio1">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="service" name="gender" class="form-check-input"
                                                                       value="female" {{ old('gender', $registration->gender) == 'female' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="service">Female</label>
                                                            </div>
                                                        </div>
                                                        @error('gender')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Section <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="section_id" id="section">
                                                            <option value="">-----Select Section-----</option>
                                                            @foreach ($sections->unique('name') as $s)
                                                                <option value="{{ $s->id }}" data-name="{{ $s->name }}" {{ old('section_id', $registration->section_id) == $s->id ? 'selected' : '' }}>
                                                                    {{ ucfirst($s->name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" id="batch_year" name="batch_year">
                                                            <option value="">-----Select Year-----</option>
                                                            @if($selectedBatch)
                                                                <option value="{{ $selectedBatch->year }}" selected>{{ $selectedBatch->year }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" id="batch_name" name="batch_id">
                                                            <option value="">-----Select Batch-----</option>
                                                            @if($selectedBatch)
                                                                <option value="{{ $selectedBatch->id }}" selected>{{ $selectedBatch->batch }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Quota <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="quota_id" id="quota_id" disabled>
                                                            <option value="">-----Select-----</option>
                                                            @foreach ($quotas as $quota)
                                                                <option value="{{ $quota->id }}" {{ old('quota_id', $registration->quota_id) == $quota->id ? 'selected' : '' }}>
                                                                    {{ ucfirst($quota->quota_name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="selected_batch_name" value="{{ $selectedBatch ? $selectedBatch->batch_name : '' }}">
                                                <input type="hidden" value="{{ $registration->quota_id }}" name="quota_id" id="quota_id">

                                                <!-- <div class="row align-items-center mb-1">
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
                                                </div> -->

                                                <!-- Date of Birth -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" class="form-control" name="dob" id="dobInput" onfocus="this.min=getDate(-50); this.max=getDate(-10);"
                                                               onblur="validateDOB()" value="{{ old('dob', $registration->dob) }}">
                                                        <small id="dobError" class="text-danger"></small>
                                                        @error('dob')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Date of Joining -->
                                                <!-- <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Date of Joining <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" class="form-control" name="doj" id="dojInput" onfocus="this.min=getDate(-1); this.max=getDate(1);"
                                                               onblur="validateDOJ()" value="{{ old('doj', $registration->doj) }}" disabled>
                                                        <small id="dojError" class="text-danger"></small>
                                                        @error('doj')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="col-md-6 border-start">
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
                                                    <!-- Mobile Number -->
                                                    <div class="row mb-1 align-items-center">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text" id="basic-addon5"><i data-feather='phone'></i></span>
                                                                <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $registration->mobile_number ?? $user->mobile) }}">
                                                            </div>
                                                            @error('mobile_number')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Email -->
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text" id="basic-addon5"><i data-feather='mail'></i></span>
                                                                <input type="text" class="form-control" placeholder="hello@student.com" name="email" value="{{ old('email', $registration->email ?? $user->email) }}">
                                                            </div>
                                                            @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- BAI ID -->
                                                    <div class="row mb-1 align-items-center">
                                                        <div class="col-md-2">
                                                            <label class="form-label">BAI ID <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3 mb-sm-0 mb-1">
                                                            <input type="text" class="form-control" name="bai_id" value="{{ old('bai_id', $registration->bai_id) }}" id="bai_id">
                                                            @error('bai_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">State</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select id="other_state" class="form-select" name="bai_state">
                                                                <option value="">Select State</option>
                                                                @if(isset($otherStates) && count($otherStates) > 0)
                                                                    @foreach($otherStates as $state)
                                                                        <option value="{{ $state->id }}" {{ old('bai_state', $registration->bai_state) == $state->id ? 'selected' : '' }}>
                                                                            {{ $state->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            @error('bai_state')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- BWF ID -->
                                                    <div class="row align-items-center mb-1">
                                                        <div class="col-md-2">
                                                            <label class="form-label">BWF ID <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="bwf_id" value="{{ old('bwf_id', $registration->bwf_id) }}" id="bwf_id">
                                                            @error('bwf_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">Country</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select id="other_country" class="form-select" name="country">
                                                                <option value="">Select</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->id }}" {{ old('country', $registration->country) == $country->id ? 'selected' : '' }}>
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('country')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
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
                                                                    <input type="text" class="form-control" name="blood_group" value="{{$sportRegistrationDetails->blood_group}}"/>
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
                                                                            <td colspan="4">
                                                                                <a href="javascript:void(0)" class="text-primary add-row">
                                                                                    Add New <i class="fas fa-plus-square"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        @foreach($sportTrainingDetails as $index => $detail)
                                                                            <tr>
                                                                                <td>{{ $index + 1 }}</td>
                                                                                <td>
                                                                                    <input type="text" class="form-control mw-100" name="previous_coach[]" value="{{ $detail->previous_coach }}" required />
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control mw-100" name="training_academy[]" value="{{ $detail->training_academy }}" required />
                                                                                </td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)" class="text-primary add-row">
                                                                                        <i class="fas fa-plus-square"></i>
                                                                                    </a>
{{--                                                                                    <a href="javascript:void(0)" class="text-danger remove-row">--}}
{{--                                                                                        <i class="fas fa-trash"></i>--}}
{{--                                                                                    </a>--}}
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
                                                                                <a href="#" class="text-danger delete-sponsor-row">
                                                                                    <i data-feather="trash-2"></i>
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
                                                                <th>Mandatory</th>
                                                                <th width="150px">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
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
                                                                    <td><input type="text" class="form-control" name="fee_details[{{$key}}][title]" value="{{ $fees['title'] ?? 'N/A' }}" readonly></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][total_fees]" value="{{ $totalFees }}" readonly></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][fee_sponsorship_percent]" value="{{ $feeSponsorshipPercent }}" readonly></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][fee_sponsorship_value]" value="{{ $feeSponsorshipValue }}" readonly></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][fee_discount_percent]" value="{{ $feeDiscountPercent }}" readonly></td>
                                                                    <td><input type="number" class="form-control" name="fee_details[{{$key}}][fee_discount_value]" value="{{ $feeDiscountValue }}" readonly></td>
                                                                    <td><input type="number" class="form-control" value="{{ $feeSponsorshipPlusDiscountPercent }}" readonly></td>
                                                                    <td><input type="number" class="form-control" value="{{ $feeSponsorshipPlusDiscountValue }}" readonly></td>
                                                                    <td><input type="number" class="form-control" value="{{ $netFeePayablePercent }}" readonly></td>
                                                                    <td><input type="number" class="form-control" value="{{ $netFeePayableValue }}" readonly></td>
                                                                    <td>
{{--                                                                        <a href="#sponsor" data-bs-toggle="modal">--}}
{{--                                                                            <span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span>--}}
{{--                                                                        </a>--}}
{{--                                                                        @if ($key != 0)--}}
                                                                            <!-- <a href="#" class="text-danger ms-25">
                                                                                <i data-feather="trash-2" class="me-50"></i>
                                                                            </a> -->
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
                                                                <td class="fw-bolder text-dark font-large-1">{{ $totalNetFeePayableValue }}</td>
                                                                <td></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        {{-- <input type="hidden" name="fee_details" id="feeDetailsInput"> --}}
                                                    </div>
                                                </div>




                                                <div class="tab-pane" id="Hostel">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Hostel Required</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="demo-inline-spacing justify-content-center">
                                                                        <div class="form-check form-check-primary mt-25">
                                                                            <input type="radio" id="hostel_required_yes" name="hostel_required"
                                                                                   class="form-check-input" @if($registration->hostel_required == 'Yes') checked @endif value="yes" >
                                                                            <label class="form-check-label fw-bolder" for="hostel_required_yes">Yes</label>
                                                                        </div>
                                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                                            <input type="radio" id="hostel_required_no" name="hostel_required"
                                                                                   class="form-check-input" @if($registration->hostel_required == 'No') checked @endif value="no">
                                                                            <label class="form-check-label fw-bolder" for="hostel_required_no">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Check-In Date <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="date" class="form-control" name="check_in_date" id="check_in_date"
                                                                           value="{{$registration->check_in_date}}" disabled/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Check-Out Date <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="date" class="form-control" name="check_out_date" id="check_out_date"
                                                                           value="{{$registration->check_out_date}}" disabled/>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Room Preference</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select class="form-select" name="room_preference" id="room_preference" disabled>
                                                                        <option>Select</option>
                                                                    </select>
                                                                </div>
                                                            </div>
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
                            <input type="number" class="form-control" id="sponsorAmount" placeholder="Enter sponsor amount">
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
    <script>
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
            $('#sport_id, #batch_name, #quota').change(function() {
                // Check if all required fields are selected
                const sportId = $('#sport_id').val();
                const sectionId = $('#section').val();
                const batchYear = $('#batch_year').val();
                const batchId = $('#batch_name').val();
                const quotaId = $('#quota').val();

                // if (sportId && sectionId && batchYear && batchId && quotaId) {
                fetchFeeStructure();
                // }
            });

            function fetchFeeStructure()
            {
                // Get all required values
                // alert('testing');
                const sportId = $('#sport_id').val();
                const sectionId = $('#section').val();
                const batchYear = $('#batch_year').val();
                const batchId = $('#batch_name').val();
                const quotaId = $('#quota').val();

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

            function updateFeeTable(feeData) {
                feeStructure = feeData;
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

                    // Check if mandatory or checked
                    if (fee.mandatory || (fee.mandatory === false && fee.isChecked)) {
                        totalNetFeePayableValue += netFeePayableValue;
                    }

                    let mandatoryCheckbox = `<input type="checkbox" class="form-check-input mandatory-checkbox"
                data-index="${index}"
                data-fee-id="${fee.id}"
                data-title="${fee.title}"
                ${fee.mandatory ? 'checked readonly' : ''}
                ${fee.mandatory ? 'disabled' : ''}
                ${(fee.mandatory === false && fee.isChecked) ? 'checked' : ''}>`;

                    let row = `
                <tr>
                    <td>${index + 1}</td>
                    <td><input type="text" class="form-control" name="fee_details[${index}][title]" value="${fee.title}" readonly></td>
                    <td><input type="number" class="form-control" name="fee_details[${index}][total_fees]" value="${totalFees}" readonly></td>
                    <td><input type="number" class="form-control" name="fee_details[${index}][fee_sponsorship_percent]" value="${feeSponsorshipPercent}" readonly></td>
                    <td><input type="number" class="form-control" name="fee_details[${index}][fee_sponsorship_value]" value="${feeSponsorshipValue.toFixed(2)}" readonly></td>
                    <td><input type="number" class="form-control" name="fee_details[${index}][fee_discount_percent]" value="${feeDiscountPercent}" readonly></td>
                    <td><input type="number" class="form-control" name="fee_details[${index}][fee_discount_value]" value="${feeDiscountValue.toFixed(2)}" readonly></td>
                    <td><input type="number" class="form-control" value="${feeSponsorshipPlusDiscountPercent}" readonly></td>
                    <td><input type="number" class="form-control" value="${feeSponsorshipPlusDiscountValue.toFixed(2)}" readonly></td>
                    <td><input type="number" class="form-control" value="${netFeePayablePercent}" readonly></td>
                    <td><input type="number" class="form-control net-fee-value" value="${netFeePayableValue.toFixed(2)}" readonly></td>
                    <td>${mandatoryCheckbox}</td>
                    <td>
                        ${index !== 0 ? '' : ''}
                    </td>
                </tr>
            `;
                    feeTableBody.append(row);
                });

                // Update the total fees row
                feeTableBody.append(`
            <tr>
                <td></td>
                <td colspan="9" class="text-end fw-bolder text-dark font-large-1">Total Fees</td>
                <td class="fw-bolder text-dark font-large-1 total-net-fee">${totalNetFeePayableValue.toFixed(2)}</td>
                <td></td>
            </tr>
        `);

                feather.replace(); // Refresh icons

                // Bind change event to checkboxes
                $('.mandatory-checkbox').off('change').on('change', function() {
                    let index = $(this).data('index');
                    let feeId = $(this).data('fee-id');
                    let feeTitle = $(this).data('title');
                    let isChecked = $(this).is(':checked');

                    // Update the fee structure
                    if (feeStructure[index]) {
                        feeStructure[index].isChecked = isChecked;
                    }

                    // Recalculate the total
                    updateTotalFee();

                    // Send AJAX request to update database if needed
                    updateMandatoryStatus(feeId, feeTitle, isChecked);
                });
            }

            // Function to update the total fee
            function updateTotalFee() {
                let totalNetFeePayableValue = 0;

                // Loop through all rows in the table (excluding the total row)
                $('#feeTable tbody tr').not(':last').each(function() {
                    let checkbox = $(this).find('.mandatory-checkbox');
                    let netFeeValue = parseFloat($(this).find('.net-fee-value').val()) || 0;

                    // If checkbox is checked or mandatory, add to total
                    if (checkbox.is(':checked') || checkbox.prop('disabled')) {
                        totalNetFeePayableValue += netFeeValue;
                    }
                });

                // Update the total display
                $('.total-net-fee').text(totalNetFeePayableValue.toFixed(2));
            }


            function updateMandatoryStatus(feeId,feeTitle, isChecked) {
                console.log("Updating Mandatory Status for Fee ID:", feeId, "Checked:", isChecked);

                let feeItem = feeStructure.find(f => f.id == feeId);
                if (!feeItem) {
                    alert("Error: Fee ID not found in feeStructure!");
                    return;
                }

                // let feeTitle = feeItem.title;
                // console.log(feeTitle)
                // feeItem.isChecked = isChecked;
                //
                // let totalNetFeePayableValue = feeStructure.reduce((total, fee) => {
                //     let totalFees = Number(fee.total_fees) || 0;
                //     let feeSponsorshipValue = Number(fee.fee_sponsorship_value) || (totalFees * Number(fee.fee_sponsorship_percent) / 100);
                //     let feeDiscountValue = Number(fee.fee_discount_value) || (totalFees * Number(fee.fee_discount_percent) / 100);
                //     let netFeePayableValue = totalFees - (feeSponsorshipValue + feeDiscountValue);
                //
                //     if (fee.mandatory || fee.isChecked) {
                //         return total + netFeePayableValue;
                //     }
                //     return total;
                // }, 0);
                //
                // // Update the frontend immediately
                // $('#totalNetFeePayableValue').text(totalNetFeePayableValue.toFixed(2));

                // Send AJAX request to update the database
                $.ajax({
                    url: '{{ route("update.fee.mandatory.status") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        registration_id: '{{ $registration->id ?? 0 }}',
                        fee_id: feeId,
                        fee_title: feeTitle,
                        is_checked: isChecked ? 1 : 0
                    },
                    success: function (response) {
                        console.log("Update Success:", response);
                        alert('Mandatory status updated successfully!');
                        // updateTotalFee()
                    },
                    error: function (xhr, status, error) {
                        console.log("Update Error:", error);
                        alert('An error occurred while updating mandatory status.');
                    }
                });
            }

            $(document).on('click', '.add-sponsor-btn', function () {
                let index = $(this).data('index');
                console.log('Index being set:', index); // Log index for debugging
                console.log('feeStructure before modal opens:', feeStructure);
                $('#feeIndex').val(index); // Store the index in the hidden input
            });

// Handle the Save Sponsor button in the modal
            $('#saveSponsor').on('click', function () {
                let sponsorAmount = Number($('#sponsorAmount').val());
                let index = $('#feeIndex').val();

                console.log('Sponsor amount:', sponsorAmount); // Log sponsorAmount for debugging
                console.log('Index from modal input:', index); // Log index from the hidden input for debugging
                console.log('feeStructure array:', feeStructure); // Log the entire feeStructure array
                console.log(`feeStructure[${index}]:`, feeStructure[index]); // Log the specific feeStructure entry

                // Check if the index is valid and the feeStructure entry exists
                if (!isNaN(sponsorAmount) && sponsorAmount > 0 && feeStructure[index]) {
                    feeStructure[index].fee_sponsorship_value = sponsorAmount;
                    console.log('Sponsorship value updated:', feeStructure[index]); // Log the updated fee structure entry
                    $('#sponsorModal').modal('hide'); // Close the modal
                    updateFeeTable(feeStructure); // Recalculate and update the fee table
                } else {
                    console.error('Invalid index or sponsorship amount.');
                }
            });

           
    var sectionId = $('#section').val();
    var sectionName = $('#section').find(':selected').data('name');

    var selectedBatchYear = "{{ $selectedBatch ? $selectedBatch->year : '' }}";
    var selectedBatchId = "{{ $selectedBatch ? $selectedBatch->id : '' }}";

    if (sectionId && sectionName) {
        // Fetch batch years for the selected section
        $.ajax({
            url: "{{ route('get.batch.year.student') }}",
            type: "POST",
            data: {
                section_name: sectionName,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if (response.length > 0) {
                    $('#batch_year').html('<option value="">-----Select Year-----</option>');

                    $.each(response, function (index, item) {
                        var selected = (item == selectedBatchYear) ? 'selected' : '';
                        $('#batch_year').append('<option value="' + item + '" ' + selected + '>' + item + '</option>');
                    });

                    // If a batch year was selected from DB, trigger change event to fetch batch names
                    if (selectedBatchYear) {
                        $('#batch_year').trigger('change');
                    }
                }
            }
        });
    }

    // Section change event
    $('#section').change(function () {
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
                success: function (response) {
                    if (response.length > 0) {
                        $.each(response, function (index, item) {
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
    $('#batch_year').change(function () {
        var sectionName = $('#section').find(':selected').data('name');
        var batchYear = $(this).val();

        $('#batch_name').html('<option value="">-----Select Batch-----</option>');

        if (sectionName && batchYear) {
            $.ajax({
                url: "{{ route('get.batch.names.student') }}",
                type: "POST",
                data: {
                    section_name: sectionName,
                    batch_year: batchYear,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.length > 0) {
                        $.each(response, function (index, item) {
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

    // If batch year is preselected, trigger change event to fetch batch names
    if (selectedBatchYear) {
        $('#batch_year').trigger('change');
    }
     
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
        const futureDateInputs = document.querySelectorAll('.dobInput');

        function disableDates() {
            const today = new Date().toISOString().split('T')[0];
            futureDateInputs.forEach(input => {
                input.setAttribute('min', today);
            });
        }
        disableDates();
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
        document.getElementById('batch_year').addEventListener('change', function () {
            var selectedYear = this.value;
            var batchNameDropdown = document.getElementById('batch_name');

            // Clear previous options
            batchNameDropdown.innerHTML = '<option value="">Select Name</option>';
            // Filter batches based on the selected year
            @json($batch).forEach(function(batch) {
                if (batch.batch_year == selectedYear) {
                    var option = document.createElement('option');
                    option.value = batch.id;
                    option.text = batch.batch_name;
                    batchNameDropdown.appendChild(option);
                }
            });
        });
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
            document.getElementById('status').value = 'draft';
            document.getElementById('postRegister').submit();
        }

        function proceed() {
            document.getElementById('status').value = 'submitted';
            document.getElementById('postRegister').submit();
        }
        $('#series').on('change', function() {
            // alert(12);
            getDocNumberByBookId();
        });

        $(document).ready(function () {
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

        $(document).ready(function () {
            let rowIndex = 1;

            // Function to add a new row
            $(document).on("click", ".add-row", function () {
                rowIndex++;

                // Remove the "add" icon from the previous row and add the "delete" icon
                $(".add-row").replaceWith(`
            <a href="javascript:void(0)" class="text-danger remove-row">
                <i class="fas fa-trash"></i>
            </a>
        `);

                // Add the new row with the "add" icon
                let newRow = `
            <tr>
                <td>${rowIndex}</td>
                <td><input type="text" class="form-control mw-100" name="previous_coach[]" required /></td>
                <td><input type="text" class="form-control mw-100" name="training_academy[]" required /></td>
                <td>
                    <a href="javascript:void(0)" class="text-primary add-row">
                        <i class="fas fa-plus-square"></i>
                    </a>
                </td>
            </tr>`;

                $("#trainingBody").append(newRow);
                updateRowNumbers();
            });

            // Function to remove a row
            $(document).on("click", ".remove-row", function () {
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


        $(document).ready(function() {
            let familyRowIndex = {{ count($familyDetails) }};

            // Add new row
            $(".add-contactpeontxt, .add-contact-row").on("click", function(e) {
                e.preventDefault();

                familyRowIndex++;

                let newRow = `
        <tr class="family-row">
            <td>${familyRowIndex}</td>
            <td>
                <select class="form-select mw-100 relation" name="family_details[${familyRowIndex}][relation]">
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
            <td><input type="text" class="form-control mw-100 name" name="family_details[${familyRowIndex}][name]"></td>
            <td><input type="text" class="form-control mw-100 contact" name="family_details[${familyRowIndex}][contact_no]"></td>
            <td><input type="text" class="form-control mw-100 email" name="family_details[${familyRowIndex}][email]"></td>
            <td>
                <input type="radio" name="family_details[${familyRowIndex}][is_guardian]" class="guardian">
            </td>
            <td>
                <a href="#" class="text-danger delete-row"><i data-feather="trash-2" class="me-50"></i></a>
            </td>
        </tr>
        `;

                $("#familyTable tbody").append(newRow);
                feather.replace();
            });

            // Delete row
            $(document).on("click", ".delete-row", function(e) {
                e.preventDefault();
                $(this).closest("tr").remove();
                updateRowNumbers();
            });

            function updateRowNumbers() {
                $("#familyTable tbody tr").each(function(index) {
                    $(this).find("td:first").text(index + 1);
                });
            }
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#quota_id').trigger('change');
            $('#colorCheck2').change(function () {
                if ($(this).is(':checked')) {
                    // Copy permanent address fields to correspondence address fields
                    $('#correspondence_street1').val($('#permanent_street1').val());
                    $('#correspondence_street2').val($('#permanent_street2').val());
                    $('#correspondence_town').val($('#permanent_town').val());
                    $('#correspondence_pincode').val($('#permanent_pincode').val());

                    // Copy country, state, and city
                    $('#correspondence_country').val($('#permanent_country').val()).trigger('change');

                    // Wait for the states to load, then set the state
                    setTimeout(function () {
                        $('#correspondence_state').val($('#permanent_state').val()).trigger('change');

                        // Wait for the cities to load, then set the city
                        setTimeout(function () {
                            $('#correspondence_district').val($('#permanent_district').val());
                        }, 500); // Adjust the timeout as needed
                    }, 500); // Adjust the timeout as needed
                } else {
                    // Clear correspondence address fields
                    $('#correspondence_street1, #correspondence_street2, #correspondence_town, #correspondence_district, #correspondence_state, #correspondence_country, #correspondence_pincode').val('');
                }
            });
            $('#quota_id').on('change', function () {
                let quotaId = $(this).val();
                if (quotaId) {
                    fetchFeeStructure(quotaId);
                }
            });

            function fetchFeeStructure(quotaId) {
                $.ajax({
                    url: '{{ route("fetch.fee.structure") }}', // Replace with your route
                    type: 'GET',
                    data: {
                        quota_id: quotaId
                    },
                    success: function (response) {
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

            function updateFeeTable(feeStructure) {
                let feeTableBody = $('#feeTable tbody');
                feeTableBody.empty(); // Clear existing rows

                let totalNetFeePayableValue = 0;

                feeStructure.forEach((fee, index) => {
                    let totalFees = Number(fee.total_fees) || 0;
                    let feeSponsorshipPercent = Number(fee.fee_sponsorship_percent) || 0;
                    let feeSponsorshipValue = Number(fee.fee_sponsorship_value) || (totalFees * feeSponsorshipPercent / 100);
                    let feeDiscountPercent = Number(fee.fee_discount_percent) || 0;
                    let feeDiscountValue = Number(fee.fee_discount_value) || (totalFees * feeDiscountPercent / 100);
                    let feeSponsorshipPlusDiscountPercent = feeSponsorshipPercent + feeDiscountPercent;
                    let feeSponsorshipPlusDiscountValue = feeSponsorshipValue + feeDiscountValue;
                    let netFeePayablePercent = 100 - feeSponsorshipPlusDiscountPercent;
                    let netFeePayableValue = totalFees - feeSponsorshipPlusDiscountValue;

                    // Add the value to total
                    totalNetFeePayableValue += netFeePayableValue;

                    let row = `
        <tr>
            <td>${index + 1}</td>
            <td><input type="text" class="form-control" name="fee_details[${index}][title]" value="${fee.title}" readonly></td>
            <td><input type="number" class="form-control" name="fee_details[${index}][total_fees]" value="${totalFees}"></td>
            <td><input type="number" class="form-control" name="fee_details[${index}][fee_sponsorship_percent]" value="${feeSponsorshipPercent}"></td>
            <td><input type="number" class="form-control" name="fee_details[${index}][fee_sponsorship_value]" value="${feeSponsorshipValue.toFixed(2)}" readonly></td>
            <td><input type="number" class="form-control" name="fee_details[${index}][fee_discount_percent]" value="${feeDiscountPercent}"></td>
            <td><input type="number" class="form-control" name="fee_details[${index}][fee_discount_value]" value="${feeDiscountValue.toFixed(2)}" readonly></td>
            <td><input type="number" class="form-control" value="${feeSponsorshipPlusDiscountPercent}" readonly></td>
            <td><input type="number" class="form-control" value="${feeSponsorshipPlusDiscountValue.toFixed(2)}" readonly></td>
            <td><input type="number" class="form-control" value="${netFeePayablePercent}" readonly></td>
            <td><input type="number" class="form-control" value="${netFeePayableValue.toFixed(2)}" readonly></td>
            <td>
<!--                <a href="#sponsor" data-bs-toggle="modal">-->
<!--                    <span class="btn-outline-primary font-small-2 px25 btn btn-sm">Add Sponsor</span>-->
<!--                </a>-->
                ${index !== 0 ? '<a href="#" class="text-danger ms-25"><i data-feather="trash-2" class="me-50"></i></a>' : ''}
            </td>
        </tr>
        `;
                    feeTableBody.append(row);
                });

                // Update the total fees row
                feeTableBody.append(`
    <tr>
        <td></td>
        <td colspan="9" class="text-end fw-bolder text-dark font-large-1">Total Fees</td>
        <td class="fw-bolder text-dark font-large-1">${totalNetFeePayableValue.toFixed(2)}</td>
        <td></td>
    </tr>
    `);

                feather.replace(); // Refresh icons
            }


            // function updateFeeDetails() {
            //     let feeDetails = [];
            //     $('#feeTable tbody tr').each(function () {
            //         let row = $(this);
            //         let feeDetail = {
            //             title: row.find('input[name="title[]"]').val(),
            //             total_fees: row.find('input[name="total_fees[]"]').val(),
            //             fee_sponsorship_percent: row.find('input[name="fee_sponsorship_percent[]"]').val(),
            //             fee_sponsorship_value: row.find('input[name="fee_sponsorship_value[]"]').val(),
            //             fee_discount_percent: row.find('input[name="fee_discount_percent[]"]').val(),
            //             fee_discount_value: row.find('input[name="fee_discount_value[]"]').val(),
            //             fee_sponsorship_plus_discount_percent: row.find('input[name="fee_sponsorship_plus_discount_percent[]"]').val(),
            //             fee_sponsorship_plus_discount_value: row.find('input[name="fee_sponsorship_plus_discount_value[]"]').val(),
            //             net_fee_payable_percent: row.find('input[name="net_fee_payable_percent[]"]').val(),
            //             net_fee_payable_value: row.find('input[name="net_fee_payable_value[]"]').val(),
            //         };
            //         feeDetails.push(feeDetail);
            //     });
            //     $('#feeDetailsInput').val(JSON.stringify(feeDetails));
            // }
            //
            // $('#feeTable').on('change', 'input', function () {
            //     updateFeeDetails();
            // });


        });

    </script>
    <!-- Modals and scripts can be reused from the registration.blade.php -->
@endsection