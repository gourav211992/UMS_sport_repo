@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header pocreate-sticky">
            <div class="row">
                <div class="content-header-left col-md-6 mb-2">
                    <h2 class="content-header-title float-start mb-0">Group Master</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                        <i data-feather="arrow-left-circle"></i> Back
                    </button>
                </div>
            </div>
        </div>

        <!-- Method spoofing to use PUT for update -->
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <!-- Group Name Field -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Group Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" disabled name="group_name" value="{{ old('group_name', $group->name) }}" class="form-control" />
                                            </div>
                                        </div>

                                        <!-- Batch Year Field -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-select" name="batch_year" id="batch_year" disabled>
                                                    <option value="">Select Year</option>
                                                    @foreach($years as $year)
                                                        <option value="{{ $year }}" {{ old('batch_year', $group->batch_year) == $year ? 'selected' : '' }}>
                                                            {{ $year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Batch Name Field -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-select" name="batch_name" id="batch_name" disabled>
                                                    <option value="">Select Batch</option>
                                                    @foreach($batches as $batch)
                                                        <option value="{{ $batch->id }}" {{ old('batch_name', $group->batch_id) == $batch->id ? 'selected' : '' }}>
                                                            {{ $batch->batch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Section Field -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Section</label>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-select" name="section_id" id="section" disabled>
                                                    <option value="">Select Section</option>
                                                    @foreach($sections as $section)
                                                        <option value="{{ $section->id }}" {{ old('section_id', $group->section_id) == $section->id ? 'selected' : '' }}>
                                                            {{ $section->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Status Field -->
                                        <div class="row align-items-center mb-2">
                                            <div class="col-md-3">
                                                <label class="form-label">Status</label>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="demo-inline-spacing">
                                                    <div class="form-check form-check-primary mt-25">
                                                        <input disabled type="radio" id="active" name="status" value="active" class="form-check-input" {{ $group->status == 'active' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bolder" for="active">Active</label>
                                                    </div>
                                                    <div class="form-check form-check-primary mt-25">
                                                        <input disabled type="radio" id="inactive" name="status" value="inactive" class="form-check-input" {{ $group->status == 'inactive' ? 'checked' : '' }}>
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
