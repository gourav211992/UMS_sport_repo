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
								<h2 class="content-header-title float-start mb-0">Document</h2>
                                <div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('document') }}">Home</a>
                                    </li>  
                                    <li class="breadcrumb-item active">Add New</li> 
                                </ol>
                            </div>
							</div>
						</div>
					</div>
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button> 
							<button data-bs-toggle="modal" data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0" form="document_add"><i data-feather="check-circle"></i> Submit</button> 
						</div>
					</div>
				</div>
			</div>
            <div class="content-body">


				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">  
							
                            <div class="card">
                             <form action="{{ route('document-store') }}" method="POST" id="document_add">
                                @csrf
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
                                <input type="radio" id="doc_type_yes" name="document_type" value="1" class="form-check-input" {{ old('document_type') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-bolder" for="doc_type_yes">Yes</label>
                            </div> 
                            <div class="form-check form-check-primary mt-25 me-0">
                                <input type="radio" id="doc_type_no" name="document_type" value="0" class="form-check-input" {{ old('document_type') == '0' ? 'checked' : '' }}>
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
                                                    <input type="text" class="form-control  @error('document_code') is-invalid @enderror" value="{{ old('document_code') }}" name="document_code">
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
                                                    <input type="text" class="form-control @error('document_name') is-invalid @enderror" value="{{ old('document_name') }}" name="document_name" >
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
                                                    <textarea class="form-control" value="{{ old('document_code') }}" name="description"></textarea>
                                                  
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
            <input type="radio" 
                   id="status_active" 
                   name="status" 
                   value="1" 
                   class="form-check-input"
                   {{ old('status') == '1' ? 'checked' : '' }} checked>
            <label class="form-check-label fw-bolder text-black" for="status_active">Active</label>
        </div> 
        <div class="form-check form-check-primary mt-25 me-0">
            <input type="radio" 
                   id="status_inactive" 
                   name="status" 
                   value="0" 
                   class="form-check-input"
                   {{ old('status') == '0' ? 'checked' : '' }}>
            <label class="form-check-label fw-bolder text-black" for="status_inactive">Inactive</label>
        </div>

   
       
    </div>
     @error('status')
            <div class="text-danger mt-50">{{ $message }}</div>
        @enderror
</div>

                                            </div> 
                                        </div>
                                    </div>

                                    <!-- Modal Submit Button now becomes a regular Submit -->
                                 
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
