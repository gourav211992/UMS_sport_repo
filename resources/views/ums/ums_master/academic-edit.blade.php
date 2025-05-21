@extends('ums.admin.admin-meta')

@section('content')
<form action="{{ route('academic.update', $year->id) }}" method="POST">
    @csrf
    @method('PUT')

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
								<h2 class="content-header-title float-start mb-0">Academic Year</h2>
                                <div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>  
                                    <li class="breadcrumb-item active">Edit </li> 
                                </ol>
                            </div>
							</div>
						</div>
					</div>
					<div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
						<div class="form-group breadcrumb-right">   
							<button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button> 
                            <button type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                                <i data-feather="check-circle"></i> Update
                            </button> 
                            {{-- <button data-bs-toggle="modal" data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Update</button>  --}}
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
                                                <h4 class="card-title text-theme">Basic Information</h4>
                                                <p class="card-text">Fill the details</p> 
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-8">
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Institute <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <select class="form-select select2" name="institute_id" required>
                                                        <option value="">Select</option>
                                                        @foreach($institutes as $institute)
                                                            <option value="{{ $institute->id }}" {{ $year->institute_id == $institute->id ? 'selected' : '' }}>
                                                                {{ $institute->institute_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div> 
                
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Academic Code <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="text" class="form-control" name="academic_code" value="{{ $year->academic_code }}" required>
                                                </div> 
                                            </div> 
                
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Academic Year <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="text" class="form-control" name="academic_year" value="{{ $year->academic_year }}" required>
                                                </div> 
                                            </div>  
                
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Start Date <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="date" class="form-control" name="start_date" value="{{ $year->start_date }}" required>
                                                </div> 
                                            </div>
                
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">End Date <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="date" class="form-control" name="end_date" value="{{ $year->end_date }}" required>
                                                </div> 
                                            </div>
                
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Enrollment No. Code <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="text" class="form-control" name="enrollment_no" value="{{ $year->enrollment_no }}" required>
                                                </div> 
                                            </div> 
                
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3"> 
                                                    <label class="form-label">Sequence No. <span class="text-danger">*</span></label>  
                                                </div>  
                                                <div class="col-md-5"> 
                                                    <input type="number" class="form-control" name="sequence_no" value="{{ $year->sequence_no }}" required>
                                                </div> 
                                            </div> 
                                        </div> 
                
                                        <div class="col-md-4 border-start">
                                            <div class="row align-items-center">
                                                <div class="col-md-12"> 
                                                    <label class="form-label text-primary"><strong>Status</strong></label>   
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="customColorRadio3" name="status" class="form-check-input" value="Open" {{ $year->status == 'Open' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="customColorRadio3">Open</label>
                                                        </div> 
                                                        <div class="form-check form-check-primary mt-25 me-0">
                                                            <input type="radio" id="customColorRadio4" name="status" class="form-check-input" value="Closed" {{ $year->status == 'Closed' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="customColorRadio4">Closed</label>
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
                
               
                
                </form>
                
                 

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

 
	 
    <div class="modal fade" id="sponsor" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" style="max-width: 700px">
			<div class="modal-content">
				<div class="modal-header p-0 bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body px-sm-2 mx-50 pb-2">
					<h1 class="text-center mb-1" id="shareProjectTitle">Add Sponsor</h1>
					<p class="text-center">Enter the details below.</p>
                    
                    
                    <div class="text-end"><a href="#" class="text-primary add-contactpeontxt mt-50"><i data-feather='plus'></i> Add Sponsor</a></div>

					<div class="table-responsive-md customernewsection-form">
								<table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail"> 
									<thead>
										 <tr>
                                            <th>#</th>
											<th width="150px">Sponsor Name</th> 
											<th>Sponsor %</th>
											<th>Sponsor Value</th>
											<th>Action</th>
										  </tr>
										</thead>
										<tbody>
											 <tr>
                                                <td>1</td> 
                                                 <td><input type="text" class="form-control mw-100" /></td>
                                                 <td><input type="text" class="form-control mw-100" /></td>
                                                 <td><input type="text" class="form-control mw-100" /></td> 
                                                 <td>
                                                     <a href="#" class="text-danger"><i data-feather="trash-2"></i></a>
                                                 </td>
											</tr>
                                             
                                            <tr>
                                                 <td colspan="2"></td>
                                                 <td class="text-dark"><strong>Total</strong></td>
                                                 <td class="text-dark"><strong>1000</strong></td>
                                                 <td></td>
											</tr>
											 

									   </tbody>


								</table>
							</div>
                    
				</div>
				
				<div class="modal-footer justify-content-center">  
						<button type="reset" class="btn btn-outline-secondary me-1">Cancel</button> 
					<button type="reset" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>
    
    
    <div class="modal fade text-start" id="disclaimer" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 800px">
			<div class="modal-content">
				<div class="modal-header">
					<div>
                        <h4 class="modal-title fw-bolder text-dark namefont-sizenewmodal" id="myModalLabel17">Disclaimer</h4> 
                    </div>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					 <div> 

                        <div class="form-check mb-3 form-check-primary mt-25 custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="disclaimer3">
                            <label class="form-check-label disclaimercustapplicant" for="disclaimer3">
                                I/We, hereby declares that the information provided above is true and accurate to the best of my knowledge. I understand that any false information may lead to the rejection of myt application.
                            </label>
                        </div>


                        <div class="row align-items-center mb-1">
                            <div class="col-md-1"> 
                                <label class="form-label">Place</label>  
                            </div>  

                            <div class="col-md-3"> 
                                <input type="text" class="form-control">
                            </div> 
                         </div>

                        <div class="row align-items-center mb-1">
                            <div class="col-md-1"> 
                                <label class="form-label">Date</label>  
                            </div>  

                            <div class="col-md-3"> 
                                <input type="date" class="form-control">
                            </div> 
                         </div>

                    </div>
				</div>
				<div class="modal-footer text-end">
					<button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i data-feather="x-circle"></i> Cancel</button>
					<a href="index.html" class="btn btn-primary btn-sm"><i data-feather="check-circle"></i> Final Submit</a>
				</div>
			</div>
		</div>
	</div>
    @endsection