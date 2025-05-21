@extends('ums.admin.admin-meta')
@section('content')

<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header pocreate-sticky">
				<div class="row">
					<div class="content-header-left col-md-6 mb-2">
						<div class="row breadcrumbs-top">
							<div class="col-12">
								<h2 class="content-header-title float-start mb-0">Course</h2>
                                <div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>  
                                    <li class="breadcrumb-item active">Add New</li> 
                                </ol>
                            </div>
							</div>
						</div>
					</div>
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button> 
							{{-- <button form="form" type="submit" data-bs-toggle="modal" data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button>  --}}
						</div>
					</div>
				</div>
			</div>
            <div class="content-body">
                 
                
				
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">  
							
                            <div class="card">
								 <div class="card-body customernewsection-form"> 
											 
                                    <form id="form" action="{{ route('course-update', $course->id) }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="newheader border-bottom mb-2 pb-25">
                                                    <h4 class="card-title text-theme">Basic Information</h4>
                                                    <p class="card-text">Fill the details</p>
                                                </div>
                                            </div>
                                    
                                            <div class="col-md-8">
                                    
                                                <!-- Program Type Dropdown -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Program Type <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select select2" name="program_id">
                                                            @foreach ($program as $item)
                                                                <option value="{{ $item->id }}" {{ $item->id == $course->program_id ? 'selected' : '' }}>
                                                                    {{ $item->program_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                    
                                                <!-- Course Code -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Course Code <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="course_code"
                                                            value="{{ old('course_code', $course->course_code) }}">
                                                    </div>
                                                </div>
                                    
                                                <!-- Course Name -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Course Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="course_name"
                                                            value="{{ old('course_name', $course->course_name) }}">
                                                    </div>
                                                </div>
                                    
                                                <!-- Enrollment No -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Enrollment No. <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="enrollment_no"
                                                            value="{{ old('enrollment_no', $course->enrollment_no) }}">
                                                    </div>
                                                </div>
                                    
                                                <!-- Sequence No -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sequence No. <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="number" class="form-control" name="sequence_no"
                                                            value="{{ old('sequence_no', $course->sequence_no) }}">
                                                    </div>
                                                </div>
                                    
                                                <!-- Description -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <textarea class="form-control" name="description">{{ old('description', $course->description) }}</textarea>
                                                    </div>
                                                </div>
                                    
                                            </div>
                                    
                                            <!-- Status Radio Buttons -->
                                            <div class="col-md-4 border-start">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3" name="status" value="active"
                                                                    class="form-check-input" {{ $course->status === 'active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                            </div>
                                    
                                                            <div class="form-check form-check-primary mt-25 me-0">
                                                                <input type="radio" id="customColorRadio4" name="status" value="inactive"
                                                                    class="form-check-input" {{ $course->status === 'inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
											  
  
								</div>
                            </div>
                        </div>
                    </div>
                   
                     
                </section>
                 

            </div>
        </div>
    </div>

    <script>

        function makeReadOnly() {
    
            const elements = document.querySelectorAll('input, select, textarea','a');
    
            elements.forEach(element => {
    
                element.disabled = true;  
    
            });
    
        }
    
        window.onload = makeReadOnly();
    
        </script>
@endsection