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
									<form action="{{ url('institute-add') }}" method="POST" id="instituteForm">
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
													<div class="col-md-3">
														<label class="form-label">Type <span class="text-danger">*</span></label>
													</div>
													<div class="col-md-8">
														<div class="demo-inline-spacing d-flex flex-wrap gap-1">
															<div class="form-check form-check-primary">
																<input type="radio" id="university" name="type" value="university" class="form-check-input" {{ old('type') == 'university' ? 'checked' : '' }}>
																<label class="form-check-label fw-bolder" for="university">University</label>
															</div>
															<div class="form-check form-check-primary">
																<input type="radio" id="college" name="type" value="College" class="form-check-input" {{ old('type') == 'College' ? 'checked' : '' }}>
																<label class="form-check-label fw-bolder" for="college">College</label>
															</div>
															<div class="form-check form-check-primary">
																<input type="radio" id="sports" name="type" value="Sports" class="form-check-input" {{ old('type') == 'Sports' ? 'checked' : '' }}>
																<label class="form-check-label fw-bolder" for="sports">Sports</label>
															</div>
															<div class="form-check form-check-primary">
																<input type="radio" id="school" name="type" value="School" class="form-check-input" {{ old('type') == 'School' ? 'checked' : '' }}>
																<label class="form-check-label fw-bolder" for="school">School</label>
															</div>
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
														<select class="form-select" name="affiliate_id" id="affiliateSelect">
															<option value="">Select</option>
															@foreach ($affiliates as $affiliate)
																<option value="{{ $affiliate->id }}" {{ old('affiliate_id') == $affiliate->id ? 'selected' : '' }}>
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
														<input type="text" class="form-control" name="institute_name" value="{{ old('institute_name') }}">
														@error('institute_name')
															<small class="text-danger">{{ $message }}</small>
														@enderror
													</div> 
												</div>  

												<div class="row align-items-center mb-1">
													<div class="col-md-3"> 
														<label class="form-label">Enrollment No. Code <span class="text-danger">*</span></label>  
													</div>  
													<div class="col-md-5"> 
														<input type="text" class="form-control" name="enroll_no_code" value="{{ old('enroll_no_code') }}">
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
															<div class="form-check form-check-primary mt-25">
																<input type="radio" id="status_active" name="status" value="Active" class="form-check-input" checked>
																<label class="form-check-label fw-bolder" for="status_active">Active</label>
															</div> 
															<div class="form-check form-check-primary mt-25 me-0">
																<input type="radio" id="status_inactive" name="status" value="Inactive" class="form-check-input">
																<label class="form-check-label fw-bolder" for="status_inactive">Inactive</label>
															</div> 
														</div>
													
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
	<script>
		document.querySelectorAll('input[name="type"]').forEach(function(radio) {
			radio.addEventListener('change', function() {
				const type = this.value;

				fetch(`/get-affiliates-by-type/${type}`)
					.then(response => response.json())
					.then(data => {
						const affiliateSelect = document.getElementById('affiliateSelect');
						affiliateSelect.innerHTML = '<option value="">Select</option>';

						if (data.affiliates.length > 0) {
							data.affiliates.forEach(function(affiliate) {
								const option = document.createElement('option');
								option.value = affiliate.id;
								option.textContent = affiliate.affiliate_name;
								affiliateSelect.appendChild(option);
							});
						} else {
							// Optional: No data found
							const option = document.createElement('option');
							option.value = "";
							option.textContent = "No affiliates found";
							affiliateSelect.appendChild(option);
						}
					})
					.catch(error => {
						console.error('Error fetching affiliates:', error);
					});
			});
		});
</script>
@endsection

