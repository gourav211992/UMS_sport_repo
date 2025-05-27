@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        @include('ums.admin.notifications')
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-6 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Rating Scale Add</h2>
                            <div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('rating-scale')}}">Home</a>
                                    </li>  
                                    <li class="breadcrumb-item active">Add New</li> 
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                </div>
                 
            </div>
            <div class="content-body">
                 
                <form method="POST" action="{{ route('rating-scale.add') }}">
                    @csrf
                
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
                
                                            <div class="col-md-9">
                
                                                <!-- Scores Input -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Scores <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input name="scores" type="number" class="form-control @error('scores') is-invalid @enderror" value="{{ old('scores') }}" />
                                                        @error('scores')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                
                                                <!-- Remarks Input -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Remarks <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="remarks" class="form-control @error('remarks') is-invalid @enderror" value="{{ old('remarks') }}" />
                                                        @error('remarks')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                
                                                <!-- Status Radio Buttons -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Status</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3" name="status" class="form-check-input"
                                                                    value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25 me-0">
                                                                <input type="radio" id="customColorRadio4" name="status" class="form-check-input"
                                                                    value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                            </div>
                                                            @error('status')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <!-- Buttons -->
                                                <div class="mt-3">
                                                    <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm"><i data-feather="arrow-left-circle"></i> Back</button>
                                                    <button type="submit" class="btn btn-primary btn-sm ms-1"><i data-feather="check-circle"></i> Create</button>
                                                </div>
                
                                            </div>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal to add new record -->
                
                    </section>
                
                </form>
                
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

   
	
	 
    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
		<div class="modal-dialog sidebar-sm">
			<form class="add-new-record modal-content pt-0"> 
				<div class="modal-header mb-1">
					<h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
				</div>
				<div class="modal-body flex-grow-1">
					<div class="mb-1">
						  <label class="form-label" for="fp-range">Select Date</label>
<!--                        <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />-->
						  <input type="text" id="fp-range" class="form-control flatpickr-range bg-white" placeholder="YYYY-MM-DD to YYYY-MM-DD"  />
					</div>
					
					<div class="mb-1">
						<label class="form-label">Select Sport Name</label>
						<select class="form-select">
							<option>Select</option>
						</select>
					</div>  
                    
                    <div class="mb-1">
						<label class="form-label">Status</label>
						<select class="form-select">
							<option>Select</option>
							<option>Active</option>
							<option>Inactive</option>
						</select>
					</div> 
					 
				</div>
				<div class="modal-footer justify-content-start">
					<button type="button" class="btn btn-primary data-submit mr-1">Apply</button>
					<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
				</div>
			</form>
		</div>
	</div>
    @endsection