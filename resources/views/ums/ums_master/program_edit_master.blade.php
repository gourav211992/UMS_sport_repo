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
                                        <li class="breadcrumb-item active">Program Edit</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                        <div class="form-group breadcrumb-right">
                            <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i
                                    data-feather="arrow-left-circle"></i> Back</button>
                            <button data-bs-toggle="modal" data-bs-target="#disclaimer" type="submit"
                                form="edit_submit_program" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i
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

                                            <form method="POST" id="edit_submit_program"
                                                action="{{ url('program-update-master/' . $program->id) }}">
                                                @csrf
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Program Code <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <input type="text" name="program_code"
                                                            value="{{ old('program_code', $program->program_code) }}"
                                                            class="form-control">
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
                                                        <input type="text" name="program_name"
                                                            value="{{ old('program_name', $program->program_name) }}"
                                                            class="form-control">
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
                                                        <input type="text" name="enrollment_no"
                                                            value="{{ old('enrollment_no', $program->enrollment_no) }}"
                                                            class="form-control">
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
                                                        <input type="number" name="seq_no"
                                                            value="{{ old('seq_no', $program->seq_no) }}"
                                                            class="form-control">
                                                        @error('seq_no')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Description </label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <textarea name="description" class="form-control">{{ $program->description }}</textarea>
                                                    </div>

                                                </div>

                                        </div>

                                        <div class="col-md-4 border-start">


                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <label class="form-label text-primary"><strong>Status</strong></label>
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" name="status" value="active"
                                                                class="form-check-input"
                                                                {{ old('status', $program->status) == 'active' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder"
                                                                for="customColorRadio3">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                            <input type="radio" name="status" value="inactive"
                                                                class="form-check-input"
                                                                {{ old('status', $program->status) == 'inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                for="customColorRadio3">Inactive</label>
                                                        </div>
                                                    </div>
                                                    @error('status')
                                                        <br><small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>


                                            </form>

                                        </div>


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
