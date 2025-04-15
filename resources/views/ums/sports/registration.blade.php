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
                                <h2 class="content-header-title float-start mb-0">Registration</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('') }}>Home</a>
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
                            <button onClick="saveDraft()" class="btn btn-outline-primary btn-sm mb-50 mb-sm-0"><i
                                    data-feather="save"></i> Save as Draft</button>
                            <button onClick="proceed()" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                                <i data-feather="check-circle"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Success Message -->


                <form action="{{ route('sport-registration-post') }}" method="post"
                    id="postRegister" enctype="multipart/form-data">
                    @csrf

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
                                            {{-- @dump($errors)--}}
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
                                            <div class="col-md-8">


                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Series <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select @error('book_id') is-invalid @enderror" name="book_id" id="series" required>
                                                            <option value="" disabled {{ old('book_id') ? '' : 'selected' }}>Select</option>
                                                            @foreach ($series as $ser)
                                                            <option value="{{ $ser->id }}" {{ old('book_id') == $ser->id ? 'selected' : '' }}>
                                                                {{ $ser->book_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('book_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Temporary ID <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control @error('document_number') is-invalid @enderror"
                                                            name="document_number" readonly id="requestno" value="{{ old('document_number') }}">

                                                        <input type="hidden" name="status" id="status" value="{{old('status')}}">
                                                        <input type="hidden" name="doc_no" id="doc_no" value="{{old('doc_no')}}">
                                                        <input type="hidden" name="book_code" id="book_code_input" value="{{old('book_code')}}">
                                                        <input type="hidden" name="doc_number_type" id="doc_number_type" value="{{old('doc_number_type')}}">
                                                        <input type="hidden" name="doc_reset_pattern" id="doc_reset_pattern" value="{{old('doc_reset_pattern')}}">
                                                        <input type="hidden" name="doc_prefix" id="doc_prefix" value="{{old('doc_prefix')}}">
                                                        <input type="hidden" name="doc_suffix" id="doc_suffix" value="{{old('doc_suffix')}}">

                                                        @error('document_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
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
                                                            value="{{ old('document_date', date('Y-m-d')) }}">
                                                        @error('document_date')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="First Name" class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name', $user->first_name) }}">
                                                        @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Middle Name" class="form-control @error('middle_name') is-invalid @enderror"
                                                            name="middle_name" value="{{ old('middle_name', $user->middle_name) }}">
                                                        @error('middle_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror"
                                                            name="last_name" value="{{ old('last_name', $user->last_name) }}">
                                                        @error('last_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio1" name="gender" class="form-check-input @error('gender') is-invalid @enderror"
                                                                    value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio1">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="service" name="gender" class="form-check-input @error('gender') is-invalid @enderror"
                                                                    value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
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
                                                        <label class="form-label">Sport Name <span class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <select class="form-select @error('sport_id') is-invalid @enderror" name="sport_id" id="sport_id">
                                                            <option value="" disabled {{ old('sport_id') ? '' : 'selected' }}>Select</option>
                                                            @foreach ($sport_types as $type)
                                                            <option value="{{ $type->id }}" {{ old('sport_id') == $type->id ? 'selected' : '' }}>
                                                                {{ $type->sport_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('sport_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="batch_id" id="batch_name" required>
                                                            <option value="" selected>-----Select Batch-----</option>
                                                            @foreach ($batches as $batch)
                                                            <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
                                                                {{ $batch->batch }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @error('batch_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Section <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="section_id" id="section" required>
                                                            <option value="" selected>-----Select Section-----</option>
                                                            <!-- Sections will be loaded dynamically based on batch selection -->
                                                        </select>
                                                        @error('section_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Quota <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="quota_id" id="quota" disabled>
                                                            <option value="" selected>-----Select-----</option>
                                                            @foreach ($quotas as $quota)
                                                            <option value="{{ $quota->id }}" @if($quota->quota_name == 'General') selected @endif>
                                                                {{ ucfirst($quota->quota_name) }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" value="{{ $qouta_id->id  }}" name="quota_id" id="sport_id">
                                                    </div>
                                                </div>

                                                <!-- <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Group <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select @error('group') is-invalid @enderror" name="group">
                                                        <option value="" disabled {{ old('group') ? '' : 'selected' }}>Select</option>
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}" {{ old('group') == $group->id ? 'selected' : '' }}>
                                                                {{ $group->group_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('group')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> -->

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" id="dobInput"
                                                            value="{{ old('dob') }}"
                                                            onfocus="this.min=getDate(-50); this.max=getDate(-10);"
                                                            onblur="validateDOB()">
                                                        <small id="dobError" class="text-danger"></small>
                                                        @error('dob')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Date of Joining <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" class="form-control" name="doj" id="dojInput"
                                                            onfocus="this.min=getDate(-1); this.max=getDate(1);"
                                                            onblur="validateDOJ()" >
                                                        <small id="dojError" class="text-danger"></small>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-4 border-start">
                                                <div class="appli-photobox">
                                                    <p id="photoSizeText">Photo Size<br />25mm X 35mm</p>
                                                    <img id="previewImg" src="{{ old('image') ? asset('storage/' . old('image')) : '' }}" alt="Profile Image" style="max-width: 150px; border-radius: 5px; display: {{ old('image') ? 'block' : 'none' }};">
                                                </div>

                                                <div class="mt-2 text-center">
                                                    <div class="image-uploadhide">
                                                        <label for="imageUpload" class="btn btn-outline-primary btn-sm waves-effect">
                                                            <i data-feather="upload"></i> Upload Profile Image
                                                        </label>
                                                        <input type="file" id="imageUpload" name="image" accept="image/*" style="display: none;">
                                                    </div>
                                                    @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="row align-items-center mb-2 mt-4 justify-content-center text-center">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing justify-content-center">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3" name="image_status" class="form-check-input" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25 me-0">
                                                                <input type="radio" id="customColorRadio4" name="image_status" class="form-check-input" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                            </div>
                                                        </div>
                                                        @error('status')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
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
                                                            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text" id="basic-addon5"><i data-feather='phone'></i></span>
                                                                <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $user->mobile) }}">
                                                            </div>
                                                            @error('mobile_number')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-1 align-items-center">
                                                        <div class="col-md-2">
                                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text" id="basic-addon5"><i data-feather='mail'></i></span>
                                                                <input type="text" class="form-control" placeholder="hello@student.com" name="email"
                                                                    @if($user->email != null) readonly @endif value="{{ old('email', $user->email) }}">
                                                            </div>
                                                            @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-1 align-items-center">
                                                        <div class="col-md-2">
                                                            <label class="form-label">BAI ID</label>
                                                        </div>
                                                        <div class="col-md-3 mb-sm-0 mb-1">
                                                            <input type="text" class="form-control" name="bai_id" value="{{ old('bai_id') }}" id="bai_id">
                                                            @error('bai_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">BAI State</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select id="other_state" class="form-select" name="bai_state">
                                                                <option value="">Select State</option>
                                                                <!-- Add state options here -->
                                                            </select>
                                                            @error('bai_state')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Modified BWF ID and Country row -->
                                                    <div class="row mb-1 align-items-center">
                                                        <div class="col-md-2">
                                                            <label class="form-label">BWF ID</label>
                                                        </div>
                                                        <div class="col-md-3 mb-sm-0 mb-1">
                                                            <input type="text" class="form-control" name="bwf_id" value="{{ old('bwf_id') }}" id="bwf_id">
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
                                                                <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
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

                                                            <!-- Address Street 1 -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Address</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <textarea id="permanent_street1" class="form-control @error('family_details.0.permanent_street1') is-invalid @enderror"
                                                                        placeholder="Street 1" name="family_details[0][permanent_street1]">{{ old('family_details.0.permanent_street1') }}</textarea>
                                                                    @error('family_details.0.permanent_street1')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Address Street 2 -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-6">
                                                                    <textarea id="permanent_street2" class="form-control @error('family_details.0.permanent_street2') is-invalid @enderror"
                                                                        placeholder="Street 2" name="family_details[0][permanent_street2]">{{ old('family_details.0.permanent_street2') }}</textarea>
                                                                    @error('family_details.0.permanent_street2')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Town -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Town</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="permanent_town" class="form-control @error('family_details.0.permanent_town') is-invalid @enderror"
                                                                        name="family_details[0][permanent_town]" value="{{ old('family_details.0.permanent_town') }}" />
                                                                    @error('family_details.0.permanent_town')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Country Dropdown -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Country</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="permanent_country" class="form-select @error('family_details.0.permanent_country') is-invalid @enderror"
                                                                        name="family_details[0][permanent_country]" onchange="loadStates(this.value, 'permanent')">
                                                                        <option>Select</option>
                                                                        @foreach($countries as $country)
                                                                        <option value="{{ $country->id }}" {{ old('family_details.0.permanent_country') == $country->id ? 'selected' : '' }}>
                                                                            {{ $country->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('family_details.0.permanent_country')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- State Dropdown -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">State</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="permanent_state" class="form-select @error('family_details.0.permanent_state') is-invalid @enderror"
                                                                        name="family_details[0][permanent_state]" onchange="loadCities(this.value, 'permanent')">
                                                                        <option>Select State</option>
                                                                        <!-- Load states dynamically here -->
                                                                    </select>
                                                                    @error('family_details.0.permanent_state')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- City Dropdown -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">City</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="permanent_district" class="form-select @error('family_details.0.permanent_district') is-invalid @enderror"
                                                                        name="family_details[0][permanent_district]">
                                                                        <option>Select City</option>
                                                                        <!-- Load cities dynamically here -->
                                                                    </select>
                                                                    @error('family_details.0.permanent_district')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Pin Code -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Pin Code</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="permanent_pincode" class="form-control @error('family_details.0.permanent_pincode') is-invalid @enderror"
                                                                        name="family_details[0][permanent_pincode]" value="{{ old('family_details.0.permanent_pincode') }}" />
                                                                    @error('family_details.0.permanent_pincode')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Correspondence Address -->
                                                        <div class="col-md-6">
                                                            <div class="mt-1 mb-2 d-flex flex-column">
                                                                <h5 class="text-dark mb-0 me-1"><strong>Correspondence Address</strong></h5>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="colorCheck2" onclick="copyPermanentAddress(this)">
                                                                    <label class="form-check-label" for="colorCheck2">Same As Permanent Address</label>
                                                                </div>
                                                            </div>

                                                            <!-- Correspondence Address Street 1 -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Address</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <textarea id="correspondence_street1" class="form-control @error('family_details.0.correspondence_street1') is-invalid @enderror"
                                                                        placeholder="Street 1" name="family_details[0][correspondence_street1]">{{ old('family_details.0.correspondence_street1') }}</textarea>
                                                                    @error('family_details.0.correspondence_street1')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Correspondence Address Street 2 -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-6">
                                                                    <textarea id="correspondence_street2" class="form-control @error('family_details.0.correspondence_street2') is-invalid @enderror"
                                                                        placeholder="Street 2" name="family_details[0][correspondence_street2]">{{ old('family_details.0.correspondence_street2') }}</textarea>
                                                                    @error('family_details.0.correspondence_street2')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Correspondence Town -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Town</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="correspondence_town" class="form-control @error('family_details.0.correspondence_town') is-invalid @enderror"
                                                                        name="family_details[0][correspondence_town]" value="{{ old('family_details.0.correspondence_town') }}" />
                                                                    @error('family_details.0.correspondence_town')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Correspondence Country Dropdown -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Country</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="correspondence_country" class="form-select @error('family_details.0.correspondence_country') is-invalid @enderror"
                                                                        name="family_details[0][correspondence_country]" onchange="loadStates(this.value, 'correspondence')">
                                                                        <option>Select</option>
                                                                        @foreach($countries as $country)
                                                                        <option value="{{ $country->id }}" {{ old('family_details.0.correspondence_country') == $country->id ? 'selected' : '' }}>
                                                                            {{ $country->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('family_details.0.correspondence_country')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Correspondence State Dropdown -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">State</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="correspondence_state" class="form-select @error('family_details.0.correspondence_state') is-invalid @enderror"
                                                                        name="family_details[0][correspondence_state]" onchange="loadCities(this.value, 'correspondence')">
                                                                        <option>Select State</option>
                                                                        <!-- Load states dynamically here -->
                                                                    </select>
                                                                    @error('family_details.0.correspondence_state')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Correspondence City Dropdown -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">City</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select id="correspondence_district" class="form-select @error('family_details.0.correspondence_district') is-invalid @enderror"
                                                                        name="family_details[0][correspondence_district]">
                                                                        <option>Select City</option>
                                                                        <!-- Load cities dynamically here -->
                                                                    </select>
                                                                    @error('family_details.0.correspondence_district')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- Correspondence Pin Code -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Pin Code</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" id="correspondence_pincode" class="form-control @error('family_details.0.correspondence_pincode') is-invalid @enderror"
                                                                        name="family_details[0][correspondence_pincode]" value="{{ old('family_details.0.correspondence_pincode') }}" />
                                                                    @error('family_details.0.correspondence_pincode')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
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
                                                                <tr class="family-row">
                                                                    <td>#</td>
                                                                    <td>
                                                                        <select class="form-select mw-100 relation @error('family_details.0.relation') is-invalid @enderror" name="family_details[0][relation]">
                                                                            <option>Select</option>
                                                                            <option value="Father" {{ old('family_details.0.relation') == 'Father' ? 'selected' : '' }}>Father</option>
                                                                            <option value="Mother" {{ old('family_details.0.relation') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                                                            <option value="Grandfather" {{ old('family_details.0.relation') == 'Grandfather' ? 'selected' : '' }}>Grandfather</option>
                                                                            <option value="Grandmother" {{ old('family_details.0.relation') == 'Grandmother' ? 'selected' : '' }}>Grandmother</option>
                                                                            <option value="Uncle" {{ old('family_details.0.relation') == 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                                                            <option value="Aunt" {{ old('family_details.0.relation') == 'Aunt' ? 'selected' : '' }}>Aunt</option>
                                                                            <option value="Sibling" {{ old('family_details.0.relation') == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                                                                            <option value="Local Guardian" {{ old('family_details.0.relation') == 'Local Guardian' ? 'selected' : '' }}>Local Guardian</option>
                                                                            <option value="Other" {{ old('family_details.0.relation') == 'Other' ? 'selected' : '' }}>Other</option>
                                                                        </select>
                                                                        @error('family_details.0.relation')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control mw-100 name @error('family_details.0.name') is-invalid @enderror" name="family_details[0][name]" value="{{ old('family_details.0.name') }}">
                                                                        @error('family_details.0.name')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control mw-100 contact @error('family_details.0.contact_no') is-invalid @enderror" name="family_details[0][contact_no]" value="{{ old('family_details.0.contact_no') }}">
                                                                        @error('family_details.0.contact_no')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control mw-100 email @error('family_details.0.email') is-invalid @enderror" name="family_details[0][email]" value="{{ old('family_details.0.email') }}">
                                                                        @error('family_details.0.email')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <input type="radio" name="family_details[0][is_guardian]" class="guardian" {{ old('family_details.0.is_guardian') ? 'checked' : '' }}>
                                                                        @error('family_details.0.is_guardian')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="text-primary add-contact-row"><i data-feather="plus-square" class="me-50"></i></a>
                                                                        <a href="#" class="text-danger delete-row"><i data-feather="trash-2" class="me-50"></i></a>
                                                                    </td>
                                                                </tr>
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
                                                                    <input type="text" name="emergency_contacts[0][name]" class="form-control @error('emergency_contacts.0.name') is-invalid @enderror" value="{{ old('emergency_contacts.0.name') }}" required />
                                                                    @error('emergency_contacts.0.name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Relation <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[0][relation]" class="form-control @error('emergency_contacts.0.relation') is-invalid @enderror" value="{{ old('emergency_contacts.0.relation') }}" required />
                                                                    @error('emergency_contacts.0.relation')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[0][contact_no]" class="form-control @error('emergency_contacts.0.contact_no') is-invalid @enderror" value="{{ old('emergency_contacts.0.contact_no') }}" required />
                                                                    @error('emergency_contacts.0.contact_no')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Email Id <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[0][email]" class="form-control @error('emergency_contacts.0.email') is-invalid @enderror" value="{{ old('emergency_contacts.0.email') }}" required />
                                                                    @error('emergency_contacts.0.email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
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
                                                                    <input type="text" name="emergency_contacts[1][name]" class="form-control @error('emergency_contacts.1.name') is-invalid @enderror" value="{{ old('emergency_contacts.1.name') }}" required />
                                                                    @error('emergency_contacts.1.name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Relation <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[1][relation]" class="form-control @error('emergency_contacts.1.relation') is-invalid @enderror" value="{{ old('emergency_contacts.1.relation') }}" required />
                                                                    @error('emergency_contacts.1.relation')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[1][contact_no]" class="form-control @error('emergency_contacts.1.contact_no') is-invalid @enderror" value="{{ old('emergency_contacts.1.contact_no') }}" required />
                                                                    @error('emergency_contacts.1.contact_no')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Email Id <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="emergency_contacts[1][email]" class="form-control @error('emergency_contacts.1.email') is-invalid @enderror" value="{{ old('emergency_contacts.1.email') }}" required />
                                                                    @error('emergency_contacts.1.email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="tab-pane" id="Medical">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 class="mt-1 mb-2 text-dark"><strong>Badminton Playing Exp.</strong></h5>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Total Playing Experience (No of Years)</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="number" class="form-control" name="badminton_experience" value="{{ old('badminton_experience') }}" />
                                                                    @error('badminton_experience')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Highest Achievement</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="highest_achievement" value="{{ old('highest_achievement') }}" />
                                                                    @error('highest_achievement')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Level of Play</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select class="form-select" name="level_of_play">
                                                                        <option value="">Select</option>
                                                                        <option value="Beginner" {{ old('level_of_play') == 'Beginner' ? 'selected' : '' }}>Level 1</option>
                                                                        <option value="Intermediate" {{ old('level_of_play') == 'Intermediate' ? 'selected' : '' }}>Level 2</option>
                                                                        <option value="Advanced" {{ old('level_of_play') == 'Advanced' ? 'selected' : '' }}>Level 2</option>
                                                                    </select>
                                                                    @error('level_of_play')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h5 class="mt-1 mb-2 text-dark"><strong>Medical Information</strong></h5>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Any Medical Conditions/Allergies</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="medical_conditions" value="{{ old('medical_conditions') }}" />
                                                                    @error('medical_conditions')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Current Medications</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="current_medications" value="{{ old('current_medications') }}" />
                                                                    @error('current_medications')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Dietary Restrictions</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="dietary_restrictions" value="{{ old('dietary_restrictions') }}" />
                                                                    @error('dietary_restrictions')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Blood Group</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" name="blood_group" value="{{ old('blood_group') }}" />
                                                                    @error('blood_group')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
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
                                                                        @foreach (old('previous_coach', ['']) as $index => $previous_coach)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td><input type="text" class="form-control mw-100" name="previous_coach[]" value="{{ $previous_coach }}" /></td>
                                                                            <td><input type="text" class="form-control mw-100" name="training_academy[]" value="{{ old('training_academy.'.$index) }}" /></td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" class="text-primary add-row">
                                                                                    <i class="fas fa-plus-square"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="tab-pane" id="Sponsor">
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
                                                                        <tr id="fee_tr">
                                                                            <td>1</td>
                                                                            <td>
                                                                                <input type="text" class="form-control mw-100" name="sponsor[0][name]" value="{{ old('sponsor.0.name') }}" required />
                                                                                @error('sponsor.0.name')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control mw-100" name="sponsor[0][spoc]" value="{{ old('sponsor.0.spoc') }}" required />
                                                                                @error('sponsor.0.spoc')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control mw-100" name="sponsor[0][phone]" value="{{ old('sponsor.0.phone') }}" required />
                                                                                @error('sponsor.0.phone')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control mw-100" name="sponsor[0][email]" value="{{ old('sponsor.0.email') }}" />
                                                                                @error('sponsor.0.email')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control mw-100" name="sponsor[0][email_position]" value="{{ old('sponsor.0.email_position') }}" />
                                                                                @error('sponsor.0.email_position')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" class="text-primary add-sponsor-row">
                                                                                    <i data-feather="plus-square"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
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
{{--                                                                @foreach ($feeDetails as $key => $fees)--}}
{{--                                                                @php--}}
{{--                                                                // Calculate missing values if not provided in $fees--}}
{{--                                                                $totalFees = old("feeDetails.$key.total_fees", $fees['total_fees'] ?? 0);--}}
{{--                                                                $feeSponsorshipPercent = old("feeDetails.$key.fee_sponsorship_percent", $fees['fee_sponsorship_percent'] ?? 0);--}}
{{--                                                                $feeSponsorshipValue = old("feeDetails.$key.fee_sponsorship_value", $fees['fee_sponsorship_value'] ?? ($totalFees * $feeSponsorshipPercent / 100));--}}
{{--                                                                $feeDiscountPercent = old("feeDetails.$key.fee_discount_percent", $fees['fee_discount_percent'] ?? 0);--}}
{{--                                                                $feeDiscountValue = old("feeDetails.$key.fee_discount_value", $fees['fee_discount_value'] ?? ($totalFees * $feeDiscountPercent / 100));--}}
{{--                                                                $feeSponsorshipPlusDiscountPercent = $feeSponsorshipPercent + $feeDiscountPercent;--}}
{{--                                                                $feeSponsorshipPlusDiscountValue = $feeSponsorshipValue + $feeDiscountValue;--}}
{{--                                                                $netFeePayablePercent = 100 - $feeSponsorshipPlusDiscountPercent;--}}
{{--                                                                $netFeePayableValue = $totalFees - $feeSponsorshipPlusDiscountValue;--}}
{{--                                                                @endphp--}}
{{--                                                                <tr>--}}
{{--                                                                    <td>{{ $key + 1 }}</td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <input type="text" name="feeDetails[{{ $key }}][title]" class="form-control" value="{{ old("feeDetails.$key.title", $fees['title'] ?? 'N/A') }}" disabled />--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <input type="number" name="feeDetails[{{ $key }}][total_fees]" class="form-control" value="{{ $totalFees }}" disabled />--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <input type="number" name="feeDetails[{{ $key }}][fee_sponsorship_percent]" class="form-control" value="{{ $feeSponsorshipPercent }}" disabled />--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <input type="number" name="feeDetails[{{ $key }}][fee_sponsorship_value]" class="form-control" value="{{ $feeSponsorshipValue }}" disabled />--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <input type="number" name="feeDetails[{{ $key }}][fee_discount_percent]" class="form-control" value="{{ $feeDiscountPercent }}" disabled />--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <input type="number" name="feeDetails[{{ $key }}][fee_discount_value]" class="form-control" value="{{ $feeDiscountValue }}" disabled />--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>{{ $feeSponsorshipPlusDiscountPercent }}%</td>--}}
{{--                                                                    <td>{{ $feeSponsorshipPlusDiscountValue }}</td>--}}
{{--                                                                    <td>{{ $netFeePayablePercent }}%</td>--}}
{{--                                                                    <td>{{ $netFeePayableValue }}</td>--}}
{{--                                                                    <td>--}}
{{--                                                                        @if ($key != 0)--}}
{{--                                                                        <a href="#" class="text-danger ms-25">--}}
{{--                                                                            <i data-feather="trash-2" class="me-50"></i>--}}
{{--                                                                        </a>--}}
{{--                                                                        @endif--}}
{{--                                                                    </td>--}}
{{--                                                                </tr>--}}
{{--                                                                @endforeach--}}

{{--                                                                <!-- Total Fees Row -->--}}
{{--                                                                @php--}}
{{--                                                                $totalFeesSum = array_sum(array_column($feeDetails, 'total_fees'));--}}
{{--                                                                $totalNetFeePayableValue = array_sum(array_map(function ($fees) {--}}
{{--                                                                return ($fees['total_fees'] ?? 0) - (($fees['fee_sponsorship_value'] ?? 0) + ($fees['fee_discount_value'] ?? 0));--}}
{{--                                                                }, $feeDetails));--}}
{{--                                                                @endphp--}}
{{--                                                                <tr>--}}
{{--                                                                    <td></td>--}}
{{--                                                                    <td colspan="9" class="text-end fw-bolder text-dark font-large-1">Total Fees</td>--}}
{{--                                                                    <td class="fw-bolder text-dark font-large-1">{{ $totalNetFeePayableValue }}</td>--}}
{{--                                                                    <td>--}}
{{--                                                                        @if($user->payment_status == 'paid')--}}
{{--                                                                        <span class="badge bg-success">Paid</span>--}}
{{--                                                                        @else--}}
{{--                                                                        <button class="btn btn-success btn-sm px-25 font-small-2 py-25 pay-now-btn"--}}
{{--                                                                                data-bs-toggle="modal"--}}
{{--                                                                                data-bs-target="#paymentModal"--}}
{{--                                                                                data-user-id="{{ $user->id }}"--}}
{{--                                                                                data-total-amount="{{ $totalNetFeePayableValue }}">Pay Now</button>--}}
{{--                                                                        @endif--}}
{{--                                                                        <button data-bs-target="#update-payment" data-bs-toggle="modal" class="btn btn-primary btn-sm px-25 font-small-2 py-25">Payment Detail</button>--}}
{{--                                                                    </td>--}}
{{--                                                                </tr>--}}
                                                            </tbody>
                                                        </table>
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
                                                                            <input type="radio" id="hostel_required_yes"
                                                                                name="hostel_required"
                                                                                class="form-check-input" value="yes"
                                                                                {{ old('hostel_required') == 'yes' ? 'checked' : '' }}>
                                                                            <label class="form-check-label fw-bolder" for="hostel_required1">Yes</label>
                                                                        </div>
                                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                                            <input type="radio" id="hostel_required_no"
                                                                                name="hostel_required"
                                                                                class="form-check-input" value="no"
                                                                                {{ old('hostel_required') == 'no' ? 'checked' : '' }} checked>
                                                                            <label class="form-check-label fw-bolder" for="hostel_required2">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4" id="check_in_date_label">
                                                                    <label class="form-label">Check-In Date <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="date" class="form-control" name="check_in_date" id="check_in_date" disabled
                                                                        value="{{ old('check_in_date') }}">
                                                                    @error('check_in_date')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4" id="check_out_date_label">
                                                                    <label class="form-label">Check-Out Date <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="date" class="form-control" name="check_out_date" id="check_out_date" disabled
                                                                        value="{{ old('check_out_date') }}">
                                                                    @error('check_out_date')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4" id="room_preference_label">
                                                                    <label class="form-label">Room Preference</label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select class="form-select" name="room_preference" id="room_preference" disabled>
                                                                        <option>Select</option>
                                                                        <option value="single" {{ old('room_preference') == 'single' ? 'selected' : '' }}>Single</option>
                                                                        <option value="double" {{ old('room_preference') == 'double' ? 'selected' : '' }}>Double</option>
                                                                    </select>
                                                                    @error('room_preference')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="tab-pane" id="document">
                                                    <div class="row">
                                                        <div class="col-md-6">

                                                            <div class="row mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Identity Proof <span class="text-danger"></span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="file" class="form-control" name="id_proof[]" />
                                                                    @error('id_proof')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Aadhar Card <span class="text-danger"></span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="file" class="form-control" name="aadhar_card[]" />
                                                                    @error('aadhar_card')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Parent's Aadhar Card <span class="text-danger"></span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="file" class="form-control" name="parent_aadhar[]" />
                                                                    @error('parent_aadhar')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Birth's Certificate <span class="text-danger"></span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="file" class="form-control" name="birth_certificate[]" />
                                                                    @error('birth_certificate')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Medical Records <span class="text-danger"></span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="file" class="form-control" name="medical_record[]" />
                                                                    @error('medical_record')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
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
                                                                <td>{{ old('user_name', $user->first_name . ' '. ($user->middle_name ?? ''). ' '. $user->last_name) }}</td>
                                                            </tr>

                                                            @if($user->payments)
                                                            <tr>
                                                                <th>Payment Status</th>
                                                                <td>
                                                                    <input type="text" class="form-control" name="payment_status" value="{{ old('payment_status', $user->payments->status ?? 'Pending') }}" />
                                                                    @error('payment_status')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Bank Name</th>
                                                                <td>
                                                                    <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name', $user->payments->bank_name ?? 'N/A') }}" />
                                                                    @error('bank_name')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Payment Mode</th>
                                                                <td>
                                                                    <input type="text" class="form-control" name="pay_mode" value="{{ old('pay_mode', $user->payments->pay_mode ?? 'N/A') }}" />
                                                                    @error('pay_mode')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Reference No.</th>
                                                                <td>
                                                                    <input type="text" class="form-control" name="ref_no" value="{{ old('ref_no', $user->payments->ref_no ?? 'N/A') }}" />
                                                                    @error('ref_no')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Paid Amount</th>
                                                                <td>
                                                                    <input type="text" class="form-control" name="paid_amount" value="{{ old('paid_amount', $user->payments->paid_amount ?? 'N/A') }}" />
                                                                    @error('paid_amount')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </td>
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
                                                                <td>
                                                                    <textarea class="form-control" name="remarks">{{ old('remarks', $user->payments->remarks ?? 'N/A') }}</textarea>
                                                                    @error('remarks')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            @else
                                                            <tr>
                                                                <th colspan="2">No payment information available</th>
                                                            </tr>
                                                            @endif
                                                        </table>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal to add new record -->

                    </section>
                </form>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <div class="modal fade" id="update-payment" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="paymentForm" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="modal-content">
                    <div class="modal-header p-0 bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-4 mx-50 pb-2">
                        <h1 class="text-center mb-1" id="shareProjectTitle">Update Payment</h1>
                        <p class="text-center">Enter the details below.</p>

                        <div class="row mt-2" id="bankNameDiv">
                            <div class="col-md-12 mb-1">
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
                                </select>
                            </div>

                            <div class="col-md-12 mb-1" id="refNoDiv">
                                <label class="form-label">Ref No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="ref_no" id="ref_no" required />
                            </div>

                            <div class="col-md-12 mb-1">
                                <label class="form-label">Paid Amount <span class="text-danger"></span></label>
                                <input type="text" class="form-control" name="paid_amount" />
                            </div>

                            <div class="col-md-12 mb-1">
                                <label class="form-label">Payment Document <span class="text-danger"></span></label>
                                <input type="file" class="form-control" name="pay_doc" />
                            </div>

                            <div class="col-md-12 mb-1">
                                <label class="form-label">Remarks</label>
                                <textarea class="form-control" name="pay_remark"></textarea>
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


    <div class="modal fade" id="sponsor" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header p-0 bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-2 mx-50 pb-2">
                    <h1 class="text-center mb-1" id="shareProjectTitle">Add Sponsor</h1>
                    <p class="text-center">Enter the details below.</p>


                    <div class="text-end"><a href="#" class="text-primary add-contactpeontxt mt-50"><i
                                data-feather='plus'></i> Add Sponsor</a></div>

                    <div class="table-responsive-md customernewsection-form">
                        <table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="150px">Sponsor Name</th>
                                    <th>Sponsor %</th>
                                    <th>Sponsor Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" class="form-control mw-100" name="sponsor[name]" /></td>
                                    <td><input type="text" class="form-control mw-100" name="sponsor[percentage]" /></td>
                                    <td><input type="text" class="form-control mw-100" name="sponsor[value]" /></td>
                                    <td>
                                        <a href="#" class="text-danger"><i data-feather="trash-2"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-dark"><strong>Total</strong></td>
                                    <td class="text-dark"><strong>1000</strong></td>
                                    <td></td>
                                </tr>


                            </tbody>


                        </table>
                    </div>

                </div>

                <div class="modal-footer justify-content-center">
                    <button type="reset" class="btn btn-outline-secondary me-1">Cancel</button>
                    <button type="reset" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade text-start" id="disclaimer" tabindex="-1" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h4 class="modal-title fw-bolder text-dark namefont-sizenewmodal" id="myModalLabel17">Disclaimer
                        </h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>

                        <div class="form-check mb-3 form-check-primary mt-25 custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="disclaimer3">
                            <label class="form-check-label disclaimercustapplicant" for="disclaimer3">
                                I/We, hereby declares that the information provided above is true and accurate to the best
                                of my knowledge. I understand that any false information may lead to the rejection of myt
                                application.
                            </label>
                        </div>


                        <div class="row align-items-center mb-1">
                            <div class="col-md-1">
                                <label class="form-label">Place</label>
                            </div>

                            <div class="col-md-3">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row align-items-center mb-1">
                            <div class="col-md-1">
                                <label class="form-label">Date</label>
                            </div>

                            <div class="col-md-3">
                                <input type="date" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer text-end">
                    <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i
                            data-feather="x-circle"></i> Cancel</button>
                    <a href="index.html" class="btn btn-primary btn-sm"><i data-feather="check-circle"></i> Final
                        Submit</a>
                </div>
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
    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Make Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <div class="mb-3">
                            <div class="alert alert-danger">
                                Are you sure you're paying under the correct quota? If not, please contact the admin on ......... before proceeding with payment.
                            </div>
                            <label for="paymentMode" class="form-label">Payment Mode</label>
                            <select class="form-select" id="paymentMode" required>
                                <option value="">Select Payment Mode</option>
                                <option value="UPI">UPI</option>
                                <option value="IMPS">IMPS</option>
                            </select>
                        </div>

                        <div id="upiSection" style="display:none;">
                            <div class="text-center mb-3">
                                <p>Scan the QR code to make payment</p>
                                <img src="{{asset('sports/img/sampleqr.jpeg')}}"
                                     alt="UPI QR Code" class="img-fluid">
{{--                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=UPI_ID:your-upi-id@bank&amount={{ $totalNetFeePayableValue }}"--}}
{{--                                     alt="UPI QR Code" class="img-fluid">--}}
{{--                                <p class="mt-2">OR</p>--}}
{{--                                <p>Send payment to: your-upi-id@bank</p>--}}
                            </div>
                        </div>

                        <div id="impsSection" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label">Bank Details for IMPS</label>
                                <div class="card p-3">
                                    <p><strong>Account Name:</strong> Your Academy Name</p>
                                    <p><strong>Account Number:</strong> 1234567890</p>
                                    <p><strong>IFSC Code:</strong> ABCD0123456</p>
                                    <p><strong>Bank Name:</strong> Example Bank</p>
                                </div>
                                <p class="mt-2 text-muted">Please share the transaction reference after payment.</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmPayment">Confirm Payment</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add this modal before the closing </body> tag -->
    <div class="modal fade" id="paymentReasonModal" tabindex="-1" aria-labelledby="paymentReasonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentReasonModalLabel">Payment Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentReasonForm">
                        <div class="mb-3">
                            <label for="paymentReason" class="form-label">Reason for not paying now <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="paymentReason" name="paymentReason" rows="3" required placeholder="Please provide the reason for not making payment now"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitWithReason">Submit Form</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script>
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
                formData.append('pay_doc', $('input[name="pay_doc"]')[0].files[0]);
                formData.append('pay_remark', $('textarea[name="pay_remark"]').val());

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
                            // location.reload()
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
        $(document).ready(function() {
            // Store the form submission function
            let formSubmissionFunction = null;

            // Override the proceed function to check payment status
            function proceed() {
                // Check if payment is made (you'll need to implement this check based on your logic)
                const isPaymentMade = checkIfPaymentIsMade(); // Implement this function

                if (!isPaymentMade) {
                    // Show payment reason modal
                    $('#paymentReasonModal').modal('show');
                    // Store the original submission function
                    formSubmissionFunction = function() {
                        document.getElementById('status').value = 'submitted';
                        document.getElementById('postRegister').submit();
                    };
                } else {
                    // If payment is made, submit directly
                    document.getElementById('status').value = 'submitted';
                    document.getElementById('postRegister').submit();
                }
            }

            // Function to check if payment is made (you need to implement this based on your logic)
            function checkIfPaymentIsMade() {
                // Example: Check if payment status is 'paid'
                // You might need to check your fee table or payment status
                return $('.badge.bg-success:contains("Paid")').length > 0;
            }

            // Handle the submit with reason button
            $('#submitWithReason').click(function() {
                const reason = $('#paymentReason').val().trim();

                if (!reason) {
                    toastr.error('Please provide a reason for not paying now');
                    return;
                }

                // Add the reason to a hidden input or append to form
                if (!$('#paymentReasonInput').length) {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'paymentReasonInput',
                        name: 'payment_reason',
                        value: reason
                    }).appendTo('#postRegister');
                } else {
                    $('#paymentReasonInput').val(reason);
                }

                // Close the modal
                $('#paymentReasonModal').modal('hide');

                // Submit the form
                if (formSubmissionFunction) {
                    formSubmissionFunction();
                }
            });

            // Reset the reason when modal is closed
            $('#paymentReasonModal').on('hidden.bs.modal', function() {
                $('#paymentReason').val('');
            });

            // Make the functions available globally
            window.proceed = proceed;
            window.saveDraft = saveDraft;
        });
        $(document).ready(function() {
            // Handle payment mode selection
            $('#paymentMode').change(function() {
                const mode = $(this).val();
                $('#upiSection, #impsSection').hide();

                if (mode === 'UPI') {
                    $('#upiSection').show();
                } else if (mode === 'IMPS') {
                    $('#impsSection').show();
                }
            });
            // Handle confirm payment button
            $('#confirmPayment').click(function() {
                const paymentMode = $('#paymentMode').val();

                if (!paymentMode) {
                    toastr.error('Please select a payment mode');
                    return;
                }

                const userId = $('.pay-now-btn').data('user-id');
                const amount = $('.pay-now-btn').data('total-amount');

                // Disable confirm button to prevent multiple submissions
                $('#confirmPayment').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

                // Send AJAX request to update payment status
                $.ajax({
                    url: "{{ url('update-payment-status') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        payment_mode: paymentMode
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(`Payment of ₹${amount} via ${paymentMode} was successful`, 'Success');

                            // Close the modal
                            $('#paymentModal').modal('hide');

                            // Replace button with "Paid" badge
                            $('.pay-now-btn').replaceWith('<span class="badge bg-success">Paid</span>');
                        } else {
                            toastr.error(response.message, 'Error');
                            $('#confirmPayment').prop('disabled', false).html('Confirm Payment');
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message
                            ? xhr.responseJSON.message
                            : 'Something went wrong. Please try again.';
                        toastr.error(errorMessage, 'Error');
                        $('#confirmPayment').prop('disabled', false).html('Confirm Payment');
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
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

        function fetchFeeStructure() {
            const sportId = $('#sport_id').val();
            const sectionId = $('#section').val();
            const batchYear = $('#batch_year').val();
            const batchId = $('#batch_name').val();
            const quotaId = $('#quota').val();

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
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        updateFeeTable(response.feeStructure);
                    } else {
                        alert('Failed to fetch fee structure.');
                    }
                },
                error: function() {
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

                // Create checkbox with proper state
                let mandatoryCheckbox = `
<input type="hidden" name="fee_details[${index}][mandatory]" value=" ${fee.mandatory ? 1 : 0}">
            <input type="checkbox" class="form-check-input mandatory-checkbox"
                data-index="${index}"
                data-fee-id="${fee.id}"
                data-title="${fee.title}"
                ${fee.mandatory ? 'checked' : ''}
                ${fee.mandatory ? 'disabled' : ''}
                name="fee_details[${index}][mandatory]"
                ${(fee.mandatory || fee.is_checked) ? 'checked' : ''}>
        `;

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

                // Add to total if mandatory or checked
                if (fee.mandatory) {
                    totalNetFeePayableValue += netFeePayableValue;
                }
            });

            // Add total row
            feeTableBody.append(`
        <tr>
            <td></td>
            <td colspan="9" class="text-end fw-bolder text-dark font-large-1">Total Fees</td>
            <td class="fw-bolder text-dark font-large-1 total-net-fee">${totalNetFeePayableValue.toFixed(2)}</td>
            <td>
                @if($user->payment_status == 'paid')
            <span class="badge bg-success">Paid</span>
@else
            <button class="btn btn-success btn-sm px-25 font-small-2 py-25 pay-now-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#paymentModal"
                    data-user-id="{{ $user->id }}"
                            data-total-amount="${totalNetFeePayableValue.toFixed(2)}">Pay Now</button>
                @endif
            <button data-bs-target="#update-payment" data-bs-toggle="modal" class="btn btn-primary btn-sm px-25 font-small-2 py-25">Payment Detail</button>
        </td>
    </tr>
`);

            feather.replace();
        }
        $(document).on('change', '.mandatory-checkbox', function() {
            updateTotalFee();
        });
        // Function to update the total fee
        function updateTotalFee() {
            let totalNetFeePayableValue = 0;

            // Loop through all rows in the table (excluding the total row)
            $('#feeTable tbody tr').not(':last').each(function() {
                let checkbox = $(this).find('.mandatory-checkbox');
                let netFeeValue = parseFloat($(this).find('.net-fee-value').val()) || 0;

                // If checkbox is checked or mandatory (disabled), add to total
                if (checkbox.is(':checked') || checkbox.prop('disabled')) {
                    totalNetFeePayableValue += netFeeValue;
                }
            });

            // Update the total display
            $('.total-net-fee').text(totalNetFeePayableValue.toFixed(2));

            // Update the Pay Now button with the new total amount
            $('.pay-now-btn').data('total-amount', totalNetFeePayableValue.toFixed(2));
        }


        function updateMandatoryStatus(feeId, feeTitle, isChecked) {
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
                    fee_id: feeId,
                    fee_title: feeTitle,
                    is_checked: isChecked ? 1 : 0
                },
                success: function(response) {
                    console.log("Update Success:", response);
                    alert('Mandatory status updated successfully!');
                    // updateTotalFee()
                },
                error: function(xhr, status, error) {
                    console.log("Update Error:", error);
                    alert('An error occurred while updating mandatory status.');
                }
            });
        }

        $(document).on('click', '.add-sponsor-btn', function() {
            let index = $(this).data('index');
            console.log('Index being set:', index); // Log index for debugging
            console.log('feeStructure before modal opens:', feeStructure);
            $('#feeIndex').val(index); // Store the index in the hidden input
        });

        // Handle the Save Sponsor button in the modal
        $('#saveSponsor').on('click', function() {
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
                    stateDropdown.empty();
                    stateDropdown.append('<option value="">Select State</option>');

                    $.each(data, function(key, state) {
                        // var isSelected = (state.id == selectedState) ? 'selected' : '';
                        stateDropdown.append('<option value="' + state.id + '">' + state.name + '</option>');
                    });

                    // If there's a selected state but it's not in the list, add it
                    // if (selectedState && !data.some(state => state.id == selectedState)) {
                    //     // You might need an additional AJAX call here to get the state name
                    //     stateDropdown.append('<option value="' + selectedState + '" selected>Previously Selected State</option>');
                    // }
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
        {{--document.getElementById('batch_year').addEventListener('change', function () {--}}
        {{--    var selectedYear = this.value;--}}
        {{--    var batchNameDropdown = document.getElementById('batch_name');--}}

        {{--    // Clear previous options--}}
        {{--    batchNameDropdown.innerHTML = '<option value="">Select Name</option>';--}}
        {{--    // Filter batches based on the selected year--}}
        {{--    @json($batch).forEach(function(batch) {--}}
        {{--        if (batch.batch_year == selectedYear) {--}}
        {{--            var option = document.createElement('option');--}}
        {{--            option.value = batch.id;--}}
        {{--            option.text = batch.batch_name;--}}
        {{--            batchNameDropdown.appendChild(option);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
        document.addEventListener("DOMContentLoaded", function() {
            const imageInput = document.getElementById("imageUpload");
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

        // function proceed() {
        //     document.getElementById('status').value = 'submitted';
        //     document.getElementById('postRegister').submit();
        // }
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


        {{--$(document).ready(function() {--}}
        {{--    let familyRowIndex = {{ count($familyDetails) }};--}}

        {{--    // Add new row--}}
        {{--    $(".add-contactpeontxt, .add-contact-row").on("click", function(e) {--}}
        {{--        e.preventDefault();--}}

        {{--        familyRowIndex++;--}}

        {{--        let newRow = `--}}
        {{--<tr class="family-row">--}}
        {{--    <td>${familyRowIndex}</td>--}}
        {{--    <td>--}}
        {{--        <select class="form-select mw-100 relation" name="family_details[${familyRowIndex}][relation]">--}}
        {{--            <option>Select</option>--}}
        {{--            <option>Father</option>--}}
        {{--            <option>Mother</option>--}}
        {{--            <option>Grandfather</option>--}}
        {{--            <option>Grandmother</option>--}}
        {{--            <option>Uncle</option>--}}
        {{--            <option>Aunt</option>--}}
        {{--            <option>Sibling</option>--}}
        {{--            <option>Local Guardian</option>--}}
        {{--            <option>Other</option>--}}
        {{--        </select>--}}
        {{--    </td>--}}
        {{--    <td><input type="text" class="form-control mw-100 name" name="family_details[${familyRowIndex}][name]"></td>--}}
        {{--    <td><input type="text" class="form-control mw-100 contact" name="family_details[${familyRowIndex}][contact_no]"></td>--}}
        {{--    <td><input type="text" class="form-control mw-100 email" name="family_details[${familyRowIndex}][email]"></td>--}}
        {{--    <td>--}}
        {{--        <input type="radio" name="family_details[${familyRowIndex}][is_guardian]" class="guardian">--}}
        {{--    </td>--}}
        {{--    <td>--}}
        {{--        <a href="#" class="text-danger delete-row"><i data-feather="trash-2" class="me-50"></i></a>--}}
        {{--    </td>--}}
        {{--</tr>--}}
        {{--`;--}}

        {{--        $("#familyTable tbody").append(newRow);--}}
        {{--        feather.replace();--}}
        {{--    });--}}

        {{--    // Delete row--}}
        {{--    $(document).on("click", ".delete-row", function(e) {--}}
        {{--        e.preventDefault();--}}
        {{--        $(this).closest("tr").remove();--}}
        {{--        updateRowNumbers();--}}
        {{--    });--}}

        {{--    function updateRowNumbers() {--}}
        {{--        $("#familyTable tbody tr").each(function(index) {--}}
        {{--            $(this).find("td:first").text(index + 1);--}}
        {{--        });--}}
        {{--    }--}}
        {{--});--}}


    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#colorCheck2').change(function() {
                if ($(this).is(':checked')) {
                    // Copy permanent address to correspondence address
                    $('#correspondence_street1').val($('#permanent_street1').val());
                    $('#correspondence_street2').val($('#permanent_street2').val());
                    $('#correspondence_town').val($('#permanent_town').val());
                    $('#correspondence_pincode').val($('#permanent_pincode').val());

                    // Copy country, state, and city
                    $('#correspondence_country').val($('#permanent_country').val()).trigger('change');

                    // Wait for the states to load, then set the state
                    setTimeout(function() {
                        $('#correspondence_state').val($('#permanent_state').val()).trigger('change');

                        // Wait for the cities to load, then set the city
                        setTimeout(function() {
                            $('#correspondence_district').val($('#permanent_district').val());
                        }, 500); // Adjust the timeout as needed
                    }, 500); // Adjust the timeout as needed
                } else {
                    // Clear correspondence address fields
                    $('#correspondence_street1, #correspondence_street2, #correspondence_town, #correspondence_district, #correspondence_state, #correspondence_country, #correspondence_pincode').val('');
                }
            });
        });
    </script>

    @endsection
    <!-- BEGIN: Vendor JS-->
    {{--
    <!-- BEGIN: Vendor JS-->
     <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
	 <script src="../../../app-assets/vendors/js/editors/quill/katex.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/highlight.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
	<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
	 <script src="../../../app-assets/js/scripts/forms/form-quill-editor.js"></script>
	<script src="../../../app-assets/js/scripts/forms/form-select2.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })


    </script>
</body>
<!-- END: Body-->

</html> --}}