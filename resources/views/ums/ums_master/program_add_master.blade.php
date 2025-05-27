@extends('ums.admin.admin-meta')

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
                                <h2 class="content-header-title float-start mb-0">Program Type</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url('program-master') }}">Home</a>
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
                            <button data-bs-toggle="modal" type="submit" form="submit_program"
                                data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i
                                    data-feather="check-circle"></i> Submit</button>
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

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="newheader  border-bottom mb-2 pb-25">
                                                <h4 class="card-title text-theme">Basic Information</h4>
                                                <p class="card-text">Fill the details</p>
                                            </div>
                                        </div>


                                        <div class="col-md-8">
                                            <form method="POST" id="submit_program"
                                                action="{{ route('program.add.master.store') }}">
                                                @csrf

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Program Code <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <input type="text" name="program_code" class="form-control"
                                                            maxlength="15" value="{{ old('program_code') }}">
                                                        @error('program_code')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Program Name <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <input type="text" name="program_name" class="form-control"
                                                            maxlength="80" value="{{ old('program_name') }}">
                                                        @error('program_name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Enrollment No. Code <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <input type="text" name="enrollment_no" class="form-control"
                                                            maxlength="15" value="{{ old('enrollment_no') }}">
                                                        @error('enrollment_no')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sequence No. <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <input type="number" name="seq_no" class="form-control"
                                                            value="{{ old('seq_no') }}">
                                                        @error('seq_no')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Description</label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                                    </div>
                                                </div>

                                        </div>

                                        <div class="col-md-4 border-start">


                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <label class="form-label text-primary"><strong>Status</strong></label>
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="status_active" name="status"
                                                                value="active" class="form-check-input"
                                                                {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder"
                                                                for="status_active">Active</label>

                                                        </div>
                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                            <input type="radio" id="status_inactive" name="status"
                                                                value="inactive" class="form-check-input"
                                                                {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder"
                                                                for="status_inactive">Inactive</label>
                                                        </div>
                                                        @error('status')
                                                            <br><small class="text-danger">{{ $message }}</small>
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
                    </div>
                    <!-- Modal to add new record -->

                </section>


            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
