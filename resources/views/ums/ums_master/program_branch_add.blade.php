@extends('ums.admin.admin-meta')

@section('content')
<div class="app-content content">
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
                                    <li class="breadcrumb-item active">Add New</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('program.add.branch.store') }}">
            @csrf

            <div class="content-header-right text-sm-end col-md-12 mb-50 mb-sm-40">
                <div class="form-group breadcrumb-right">
                    <button type="button" onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                        <i data-feather="arrow-left-circle"></i> Back
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                        <i data-feather="check-circle"></i> Submit
                    </button>
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
                                                <p class="card-text">Fill the details</p>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            {{-- Program Type --}}
                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Program Type <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select name="program_type_id" class="form-select select2">
                                                        <option value="">---Select---</option>
                                                        @foreach ($programTypes as $type)
                                                            <option value="{{ $type->id }}" {{ old('program_type_id') == $type->id ? 'selected' : '' }}>
                                                                {{ $type->program_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('program_type_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Course --}}
                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Course <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select name="course_id" class="form-select select2">
                                                        <option value="">Select</option>
                                                        @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                                {{ $course->course_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('course_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Program Branch Code --}}
                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Prog. Branch Code <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="program_branch_code" class="form-control" value="{{ old('program_branch_code') }}">
                                                    @error('program_branch_code')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Program Branch Name --}}
                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Prog. Branch Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="program_branch_name" class="form-control" value="{{ old('program_branch_name') }}">
                                                    @error('program_branch_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Enrollment No Code --}}
                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Enrollment No. Code <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="enrollment_no" class="form-control" value="{{ old('enrollment_no') }}">
                                                    @error('enrollment_no')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Sequence No --}}
                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Sequence No. <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" name="seq_no" class="form-control" value="{{ old('seq_no') }}">
                                                    @error('seq_no')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Description --}}
                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Description</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-4 border-start">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <label class="form-label text-primary"><strong>Status</strong></label>
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" name="status" value="Active" id="customColorRadio3" class="form-check-input" {{ old('status', 'Active') == 'Active' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                            <input type="radio" name="status" value="Inactive" id="customColorRadio4" class="form-check-input" {{ old('status') == 'Inactive' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                        </div>
                                                        @error('status')
                                                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- end .row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>
</div>
@endsection
