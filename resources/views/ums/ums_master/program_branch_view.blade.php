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
                            <h2 class="content-header-title float-start mb-0">Program Branch</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('program-branch') }}">Home</a></li>
                                    <li class="breadcrumb-item active">View</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-12 mb-50 mb-sm-40">
                    <a href="javascript:history.back()" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                        <i data-feather="arrow-left-circle"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">  
                        <div class="card">
                            <div class="card-body customernewsection-form"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="newheader border-bottom mb-2 pb-25"> 
                                            <h4 class="card-title text-theme">Basic Information</h4>
                                            <p class="card-text">Details of Program Branch</p> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <!-- Program Type -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3"> 
                                                <label class="form-label">Program Type</label>  
                                            </div>  
                                            <div class="col-md-5"> 
                                                <input type="text" class="form-control" value="{{ $branch->programType->program_name }}" disabled>
                                            </div> 
                                        </div>

                                        <!-- Course -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3"> 
                                                <label class="form-label">Course</label>  
                                            </div>  
                                            <div class="col-md-5"> 
                                                <input type="text" class="form-control" value="{{ $branch->course->course_name }}" disabled>
                                            </div> 
                                        </div>

                                        <!-- Other fields (read-only) -->
                                        @php
                                            $fields = [
                                                'program_branch_code' => 'Prog. Branch Code',
                                                'program_branch_name' => 'Prog. Branch Name',
                                                'enrollment_no' => 'Enrollment No. Code',
                                                'seq_no' => 'Sequence No.',
                                            ];
                                        @endphp

                                        @foreach($fields as $field => $label)
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">{{ $label }}</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="{{ is_numeric($branch->$field) ? 'number' : 'text' }}" class="form-control" value="{{ $branch->$field }}" disabled>
                                            </div>
                                        </div>
                                        @endforeach

                                        <!-- Description -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Description</label>
                                            </div>
                                            <div class="col-md-5">
                                                <textarea class="form-control" disabled>{{ $branch->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-4 border-start">
                                        <div class="row align-items-center">
                                            <div class="col-md-12"> 
                                                <label class="form-label text-primary"><strong>Status</strong></label>   
                                                <div class="demo-inline-spacing">
                                                    <div class="form-check form-check-primary mt-25">
                                                        <input type="radio" id="active" name="status" value="Active" {{ $branch->status == 'Active' ? 'checked' : '' }} class="form-check-input" disabled>
                                                        <label class="form-check-label fw-bolder" for="active">Active</label>
                                                    </div> 
                                                    <div class="form-check form-check-primary mt-25">
                                                        <input type="radio" id="inactive" name="status" value="Inactive" {{ $branch->status == 'Inactive' ? 'checked' : '' }} class="form-check-input" disabled>
                                                        <label class="form-check-label fw-bolder" for="inactive">Inactive</label>
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
