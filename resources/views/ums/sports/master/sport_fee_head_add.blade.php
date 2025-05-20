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
                            <h2 class="content-header-title float-start mb-0">Fee Head Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Fee Add New</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                            <i data-feather="arrow-left-circle"></i> Back
                        </button>
                        <button type="submit" form="feeHeadForm" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                            <i data-feather="check-circle"></i> Submit
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
                                <!-- Form Start -->
                                <form action="{{ route('sport_fee_head.store') }}" method="POST" id="feeHeadForm">
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
                                                <div class="col-md-2">
                                                    <label class="form-label">Fee Head <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="fee_head" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-8 mt-2">
                                         <div class="row align-items-center mb-1">
                                             <div class="col-md-2">
                                                 <label class="form-label"><strong>Status</strong></label>
                                             </div>
                                             <div class="col-md-10">
                                                 <div class="form-check form-check-primary form-check-inline">
                                                     <input type="radio" id="status_active" name="status" class="form-check-input" value="Active" checked>
                                                     <label class="form-check-label fw-bolder" for="status_active">Active</label>
                                                 </div>
                                                 <div class="form-check form-check-primary form-check-inline">
                                                     <input type="radio" id="status_inactive" name="status" class="form-check-input" value="Inactive">
                                                     <label class="form-check-label fw-bolder" for="status_inactive">Inactive</label>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                  </div>  
                                </form>
                                <!-- Form End -->
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
