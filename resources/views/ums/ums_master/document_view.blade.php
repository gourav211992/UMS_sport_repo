@extends('ums.sports.sports-meta.admin-sports-meta')

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
                                    <li class="breadcrumb-item"><a href="{{ route('document') }}">Home</a></li>
                                    <li class="breadcrumb-item active">
                                        View
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <!-- Back Button Positioned Top Right -->
                    <div class="form-group breadcrumb-right">
                        <a href="{{ route('document') }}" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                            <i data-feather="arrow-left-circle"></i> Back
                        </a>
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
                                        <div class="newheader border-bottom mb-2 pb-25">
                                            <h4 class="card-title text-theme">Document Information</h4>
                                            <p class="card-text">Details of the selected document</p>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                       <!-- Document Req. -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Document Req.</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="doc_req_yes" name="document_req" value="1" class="form-check-input" {{ isset($document) && $document->is_required ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label fw-bolder" for="doc_req_yes">Yes</label>
                                                        </div> 
                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                            <input type="radio" id="doc_req_no" name="document_req" value="0" class="form-check-input" {{ isset($document) && !$document->is_required ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label fw-bolder" for="doc_req_no">No</label>
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </div>


                                        <!-- Document Code -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Document Code</label>
                                            </div>
                                            <div class="col-md-5">
                                                <p>{{ $document->document_code ?? 'N/A' }}</p>
                                            </div>
                                        </div>

                                        <!-- Document Name -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Document Name</label>
                                            </div>
                                            <div class="col-md-5">
                                                <p>{{ $document->document_name ?? 'N/A' }}</p>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <div class="row mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Description</label>
                                            </div>
                                            <div class="col-md-5">
                                                <p>{{ $document->description ?? 'No description available' }}</p>
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
                                                            <input type="radio" class="form-check-input" {{ $document->status == 1 ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label fw-bolder">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                            <input type="radio" class="form-check-input" {{ $document->status == 0 ? 'checked' : '' }} disabled>
                                                            <label class="form-check-label fw-bolder">Inactive</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div> <!-- end row -->
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
