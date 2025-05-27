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
                                    <li class="breadcrumb-item active">Program view</li> 
                                </ol>
                            </div>
							</div>
						</div>
					</div>
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button> 
							<button data-bs-toggle="modal" data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button> 
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
													<div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Program Code <span class="text-danger">*</span></label>  
                                                        </div>  
                                                        <div class="col-md-5"> 
                                                            <input type="text" class="form-control" value="{{ $program->program_code }}" disabled>

                                                        </div> 
                                                     </div> 
													<div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Program Name <span class="text-danger">*</span></label>  
                                                        </div>  
                                                        <div class="col-md-5"> 
                                                            <input type="text" class="form-control" value="{{ $program->program_name }}" disabled>
                                                        </div> 
                                                     </div>   
													<div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Enrollment No. Code <span class="text-danger">*</span></label>  
                                                        </div>  
                                                        <div class="col-md-5"> 
                                                            <input type="text" class="form-control" value="{{ $program->enrollment_no }}" disabled>
                                                        </div> 
                                                     </div> 
													<div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Sequence No. <span class="text-danger">*</span></label>  
                                                        </div>  
                                                        <div class="col-md-5"> 
                                                            <input type="number" class="form-control" value="{{ $program->seq_no }}" disabled>
                                                        </div> 
                                                     </div>
													
													 <div class="row align-items-center mb-1">
                                                        <div class="col-md-3"> 
                                                            <label class="form-label">Description <span class="text-danger">*</span></label>  
                                                        </div>  

                                                        <div class="col-md-5"> 
                                                            <textarea class="form-control" disabled>{{ $program->description }}</textarea>
                                                        </div> 
                                                     </div>
                                            	</div> 
                                                <div class="col-md-4 border-start">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12"> 
                                                            <label class="form-label text-primary"><strong>Status</strong></label>   
                                                             <div class="demo-inline-spacing">
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="radio" id="status_active" name="status" class="form-check-input"
                                                                       {{ $program->status == 'active' ? 'checked' : '' }} disabled>
                                                                      <label class="form-check-label fw-bolder" for="status_active">Active</label>
                                                                </div> 
                                                                <div class="form-check form-check-primary mt-25 me-0">
                                                                    <input type="radio" id="status_inactive" name="status" class="form-check-input"
                                                                        {{ $program->status == 'inactive' ? 'checked' : '' }} disabled>
                                                                     <label class="form-check-label fw-bolder" for="status_inactive">Inactive</label>
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
    <!-- END: Content-->
    <script>
        function makeReadOnly() {

            const elements = document.querySelectorAll('input, select, textarea');

            elements.forEach(element => {

                element.disabled = true;  

            });
        }
        window.onload = makeReadOnly();
    </script>
    @endsection