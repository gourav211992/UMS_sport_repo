@extends('ums.admin.admin-meta')

@section('content')
    

{{-- <body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col=""> --}}
  
  <!-- BEGIN: Header-->
  
  {{-- @include('header')  --}}
  
  <!-- END: Header-->
  
{{-- @include('sidebar') --}}
   
    <!-- END: Main Menu-->
    
    <!-- BEGIN: Content-->
    <div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
          <div class="content-header-left col-md-5 mb-2">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>  
                                <li class="breadcrumb-item active">Affiliate Circular</li>
                            </ol>
                          </div>
                        </div>
                      </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
              <div class="form-group breadcrumb-right">
                <a class="btn btn-dark btn-sm mb-50 mb-sm-0" href="{{url('affiliate_circular_add')}}"><i data-feather="file-text"></i> Add Affiliate Circular</a> 
                </div>
            </div>
        </div>
            <div class="content-body">
              
				<section id="basic-datatable">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          
								   
                                <div class="table-responsive">
                                        <table class="datatables-basic table myrequesttablecbox loanapplicationlist">
                                            <thead>
                                                <tr>
                                                  <th>ID#</th>
                                                    <th>Affiliate Circular Description</th>
                                                    <th>Circular Date</th>
                                                    <th>Circular Details</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @foreach($items as $item)
                                                <tr>
                                                  <td>{{$item->id}}</td>
                                                  <td class="fw-bolder text-dark">{{$item->circular_description}}</td>
                                                  <td>{{$item->circular_date}}</td>
                                                  <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">{{$item->circular_file}}</span></td>

                                                    
                                                    <td class="tableactionnew">  
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow p-0 " data-bs-toggle="dropdown">
                                                              <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                              <a class="dropdown-item" href="{{url('affiliate_circular_edit',$item->id)}}" >
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a> 
                                                             <a class="dropdown-item" href="{{url('affiliate_circular_delete',$item->id)}}">
                                                                    <i data-feather="trash-2" class="me-50"></i>
                                                                    <span onclick="return confirm('Are you sure?');">Delete</span>                                                                </a>
                                                                </a>
                                                            </div>
                                                        </div> 
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
								
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record modal-content pt-0">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                  <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
                                      </div>
                                    <div class="mb-1">
                                      <label class="form-label" for="basic-icon-default-post">Post</label>
                                        <input type="text" id="basic-icon-default-post" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" />
                                    </div>
                                    <div class="mb-1">
                                      <label class="form-label" for="basic-icon-default-email">Email</label>
                                      <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                        <small class="form-text"> You can use letters, numbers & periods </small>
                                    </div>
                                    <div class="mb-1">
                                      <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                        <input type="text" class="form-control dt-date" id="basic-icon-default-date" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                        <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" placeholder="$12000" aria-label="$12000" />
                                    </div>
                                    <button type="button" class="btn btn-primary data-submit me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                 

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    
    <!-- BEGIN: Footer-->
    {{-- @include('footer') --}}
    <!-- END: Footer-->
	
    
    
    <div class="modal fade" id="reallocate" tabindex="-1" aria-labelledby="shareProjectTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-0 bg-transparent">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body px-sm-4 mx-50 pb-2">
          <h1 class="text-center mb-1" id="shareProjectTitle">Re-Allocate Incident</h1>
					<p class="text-center">Enter the details below.</p>
          
					<div class="row mt-2"> 
            
            <div class="col-md-12 mb-1">
              <label class="form-label">Re-Allocate To <span class="text-danger">*</span></label>
							<select class="form-select select2">
                <option>Select</option>
              </select>
						</div>
            
            <div class="col-md-12 mb-1">
							<label class="form-label">Re-Allocate Dept. <span class="text-danger">*</span></label>
							<select class="form-select select2">
                                <option>Select</option>
                              </select>
                            </div>
                            
                        <div class="col-md-12 mb-1">
                          <label class="form-label">PDC Date <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" placeholder="Enter Name" />
                        </div>
                        
                        <div class="col-md-12 mb-1">
							<label class="form-label">Remarks <span class="text-danger">*</span></label>
							<textarea class="form-control"></textarea>
						</div>
                          
                         
				    </div>
                </div>
				
				<div class="modal-footer justify-content-center">  
          <button type="reset" class="btn btn-outline-secondary me-1">Cancel</button>
					<button type="reset" class="btn btn-primary">Re-Allocate</button>
				</div>
			</div>
		</div>
	</div>
    
  
  
  
  <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
    <div class="modal-dialog sidebar-sm">
      <form class="add-new-record modal-content pt-0"> 
        <div class="modal-header mb-1">
          <h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
				</div>
				<div class="modal-body flex-grow-1">
					<div class="mb-1">
            <label class="form-label" for="fp-range">Select Date Range</label>
            <input type="text" id="fp-range" class="form-control flatpickr-range" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
					</div>
					
					<div class="mb-1">
            <label class="form-label">Select Incident No.</label>
						<select class="form-select select2">
              <option>Select</option>
						</select>
					</div> 
          
          <div class="mb-1">
            <label class="form-label">Select Customer</label>
						<select class="form-select select2">
              <option>Select</option>
						</select>
					</div> 
          
          <div class="mb-1">
            <label class="form-label">Assigned To</label>
						<select class="form-select select2">
              <option>Select</option>
						</select>
					</div> 
          
          <div class="mb-1">
            <label class="form-label">Status</label>
						<select class="form-select">
							<option>Select</option> 
							<option>Open</option>
							<option>Close</option>
							<option>Re-Allocatted</option>
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
{{-- </body> --}}

