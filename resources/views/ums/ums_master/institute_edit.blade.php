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
                            <h2 class="content-header-title float-start mb-0">Institute</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('institute') }}">Home</a></li>  
                                    <li class="breadcrumb-item active">Edit</li> 
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">   
                        <a href="{{ url('institute') }}" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                            <i data-feather="arrow-left-circle"></i> Back
                        </a>

                        <button type="submit" form="instituteForm" class="btn btn-primary btn-sm mb-50 mb-sm-0">
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

                                <!-- Form Starts -->
                                <form action="{{ route('institute-update', $institute->id) }}" method="POST" id="instituteForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="newheader border-bottom mb-2 pb-25"> 
                                                <h4 class="card-title text-theme">Edit Institute</h4>
                                                <p class="card-text">Modify the details below</p> 
                                            </div>
                                        </div>
                                
                                        <div class="col-md-8">
                                            <div class="row align-items-center mb-1"> 
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Type <span class="text-danger">*</span></label>  
                                                </div> 
                                                <div class="col-md-8"> 
                                                   <div class="d-flex gap-2">
														@foreach(['University', 'College', 'Sports', 'School'] as $typeOption)
															@php
																$selectedType = trim(strtolower(old('type', $institute->type)));
																$optionValue = trim(strtolower($typeOption));
															@endphp
															<div class="form-check form-check-primary mt-25 mr-3">
																<input type="radio" id="type_{{ $typeOption }}" name="type" value="{{ $typeOption }}"
																	class="form-check-input" {{ $selectedType === $optionValue ? 'checked' : '' }}>
																<label class="form-check-label fw-bolder" for="type_{{ $typeOption }}">{{ $typeOption }}</label>
															</div>
														@endforeach
													</div>

                                                    @error('type')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Affiliate <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5">  
                                                    <select class="form-select select2" name="affiliate_id">
                                                        <option value="">Select</option>  
                                                        @foreach ($affiliates as $affiliate)
                                                            <option value="{{ $affiliate->id }}" 
                                                                {{ old('affiliate_id', $institute->affiliate_id) == $affiliate->id ? 'selected' : '' }}>
                                                                {{ $affiliate->affiliate_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('affiliate_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Institute Name <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="text" class="form-control" name="institute_name" value="{{ old('institute_name', $institute->institute_name) }}">
                                                    @error('institute_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div> 
                                            </div>  

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Enrollment No. Code</label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="text" class="form-control" name="enroll_no_code" value="{{ old('enroll_no_code', $institute->enroll_no_code) }}">
                                                    @error('enroll_no_code')
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
                                                        @foreach(['Active', 'Inactive'] as $statusOption)
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="status_{{ $statusOption }}" name="status" value="{{ $statusOption }}"
                                                                    class="form-check-input" {{ old('status', $institute->status) == $statusOption ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="status_{{ $statusOption }}">{{ $statusOption }}</label>
                                                            </div> 
                                                        @endforeach
                                                    </div> 
                                                    @error('status')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div> 
                                            </div> 
                                        </div>
                                    </div>
                                </form>
                                <!-- Form Ends -->

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
