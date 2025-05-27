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
                                <h2 class="content-header-title float-start mb-0">Batches Master Edit</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('master-batches') }}>Home</a></li>
                                        <li class="breadcrumb-item active">Edit Batches</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                        <form action="{{ route('batches-update', $batch->id) }}" method="POST">
                            @csrf
                        <div class="form-group breadcrumb-right">
                            <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                                <i data-feather="arrow-left-circle"></i> Back
                            </button>

                            <button type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                                <i data-feather="check-circle"></i> Update
                            </button>
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
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="newheader border-bottom mb-2 pb-25">
                                                    <h4 class="card-title text-theme">Basic Information</h4>
                                                    <p class="card-text">Fill the details</p>
                                                </div>
                                            </div>

                                            <!-- Batch ID (Display only, for editing) -->
                                            <div class="col-md-8">
                                              

                                                <!-- Batch Year (Editable) -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control @error('batch_name') is-invalid @enderror" name="batch_name"  value="{{ $batch->batch_name }}" />
                                                        @error('batch_name')
                                                            <div class="text-danger mt-25">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control @error('batch_year') is-invalid @enderror" name="batch_year"  value="{{ $batch->batch_year}}" />
                                                        @error('batch_year')
                                                            <div class="text-danger mt-25">{{ $message }}</div>
                                                        @enderror
                                                    
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Session_Start Date <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        {{-- <input type="date" class="form-control" name="start_date" value="{{ $batch->start_date }}" required /> --}}
                                                        <input type="date" class="form-control" name="start_date" value="{{ $batch->start_date }}" />
                                                        @error('start_date')
                                                            <div class="text-danger mt-25">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Session_end_date <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="date" class="form-control" name="end_date" value="{{ $batch->end_date }}" />
                                                        @error('end_date')
                                                            <div class="text-danger mt-25">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Status</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                      
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="active" name="status"
                                                                    value="active" class="form-check-input"
                                                                    {{ old('status', $batch->status ?? '') == 'active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="active">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="inactive" name="status"
                                                                    value="inactive" class="form-check-input"
                                                                    {{ old('status', $batch->status ?? '') == 'inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="inactive">Inactive</label>
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
    <!-- END: Content-->
@endsection
