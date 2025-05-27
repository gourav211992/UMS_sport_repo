@extends('ums.admin.admin-meta')     

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header pocreate-sticky">
            <div class="row">
                <div class="content-header-left col-md-6 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Document</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('document') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button>
                        <button type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0" form="document_edit"><i data-feather="check-circle"></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">

            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form action="{{ route('document.update', $document->id) }}" method="POST" id="document_edit">
                                @csrf
                                @method('PUT')

                                <div class="card-body customernewsection-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="newheader border-bottom mb-2 pb-25">
                                                <h4 class="card-title text-theme">Basic Information</h4>
                                                <p class="card-text">Fill the details</p>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <!-- Document Required -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Document Req. <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="doc_type_yes" name="document_type" value="1" class="form-check-input" {{ old('document_type', $document->document_type) == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="doc_type_yes">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="doc_type_no" name="document_type" value="0" class="form-check-input" {{ old('document_type', $document->document_type) == 0 ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="doc_type_no">No</label>
                                                        </div>
                                                    </div>
                                                    @error('document_type')
                                                        <div class="text-danger small mt-50">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Document Code -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Document Code <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control @error('document_code') is-invalid @enderror" name="document_code" value="{{ old('document_code', $document->document_code) }}">
                                                    @error('document_code')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Document Name -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Document Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control @error('document_name') is-invalid @enderror" name="document_name" value="{{ old('document_name', $document->document_name) }}">
                                                    @error('document_name')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="row mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Description</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $document->description) }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
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
                                                            <input type="radio" id="status_active" name="status" value="1" class="form-check-input" {{ old('status', $document->status) == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="status_active">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="status_inactive" name="status" value="0" class="form-check-input" {{ old('status', $document->status) == 0 ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="status_inactive">Inactive</label>
                                                        </div>
                                                    </div>
                                                    @error('status')
                                                        <div class="text-danger small mt-50">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
