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
                            <h2 class="content-header-title float-start mb-0">Semester Type</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('semesters') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Add New</li> 
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <a href="{{ url('semesters') }}" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</a>
                        <button type="submit" form="semesterForm" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button>
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
                               <form method="POST" action="{{ url('semesters-add') }}" id="semesterForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="newheader border-bottom mb-2 pb-25">
                                                <h4 class="card-title text-theme">Basic Information</h4>
                                                <p class="card-text">Fill the details</p>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Semester Code <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="semester_code" class="form-control" value="{{ old('semester_code') }}">
                                                    @error('semester_code')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Semester Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="semester_name" class="form-control" value="{{ old('semester_name') }}">
                                                    @error('semester_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Enrollment No <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="enrollment_no" class="form-control" value="{{ old('enrollment_no') }}">
                                                    @error('enrollment_no')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Sequence No <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" name="seq_no" class="form-control" value="{{ old('seq_no') }}">
                                                    @error('seq_no')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 border-start">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <label class="form-label text-primary"><strong>Status</strong></label>
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="status_active" name="status" class="form-check-input" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="status_active">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                            <input type="radio" id="status_inactive" name="status" class="form-check-input" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="status_inactive">Inactive</label>
                                                        </div>
                                                    </div>
                                                    @error('status')
                                                        <div><small class="text-danger">{{ $message }}</small></div>
                                                    @enderror
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
<!-- END: Content-->


  @endsection