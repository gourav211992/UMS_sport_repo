@extends('ums.admin.admin-meta')

@section('content')
    
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Period</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>  
                                    <li class="breadcrumb-item active">Showing 1 to 10 of 0 period</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right"> 
                      <a class="btn btn-dark btn-sm mb-50 mb-sm-0" href="{{ url('period_list_add') }}"><i data-feather="file-text"></i> Add Period</a> 

                      <button class="btn btn-primary btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button> 
                        <button class="btn btn-warning box-shadow-2 btn-sm  mb-sm-0 mb-50" onclick="window.location.reload();" ><i data-feather="refresh-cw"></i>Reset</button>

                            <!-- <button class="btn btn-success btn-sm mb-50 mb-sm-0" data-bs-target="#approved" data-bs-toggle="modal"><i data-feather="check-circle" ></i> Assign Team</button> -->
                             
                    </div>
                </div>
            </div>
            <!-- Success message will show here -->
             @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
             @endif
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
                                                <th>Period</th>
                                                <th>Time</th>
                                                <th>Created On</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($all_periods) > 0)
                                                @foreach($all_periods as $period)
                                                    <tr>
                                                        <td>#{{$period->id}}</td>
                                                        <td>{{$period->name}}</td>
                                                        <td>{{$period->time_rang}}</td>
                                                        <td>{{date('M dS, Y', strtotime($period->created_at))}}</td>
                                                        <td>
                                                            @if($period->status == 0)
                                                            <span class="badge rounded-pill badge-light-danger">Inactive</span>
                                                            @else
                                                            <span class="badge rounded-pill badge-light-success">Active</span>
                                                            @endif
                                                        </td>
                                                        
                                                        <td class="tableactionnew">   
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown">
                                                                    <i data-feather="more-vertical"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#" onclick="editCat({{ $period->id }})">
                                                                        <i data-feather="edit" class="me-50"></i>
                                                                        <span>Edit</span>
                                                                    </a>
                                                                    
                                                                    <a class="dropdown-item" href="#" onclick="softDelete({{ $period->id }})">
                                                                        <i data-feather="trash-2" class="me-50"></i>
                                                                        <span>Delete</span>
                                                                    </a>
                                                                </div>
                                                            </div> 
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">NO DATA FOUND</td>
                                                </tr>
                                            @endif
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
			<form class="add-new-record modal-content pt-0" id="approveds-form" method="GET"  novalidate action="{{url('period_list')}}"> 
                @csrf
				<div class="modal-header mb-1">
					<h5 class="modal-title" id="exampleModalLabel">List of Period<</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
				</div>
				<div class="modal-body flex-grow-1">
					<div class="mb-1">
					
					</div>
					
					<div class="mb-1">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Name</label>
                            <input type="text" name="name" class="form-control" value="{{Request::get('name')}}">
                        </div>
					</div> 
					 
				</div>
				<div class="modal-footer justify-content-start">
                    <button class="btn btn-primary">Apply Filters</button>
				</div>
			</form>
		</div>
	</div>
    <script>
        function exportdata() {
             var fullUrl_count = "{{count(explode('?',urldecode(url()->full())))}}";
             var fullUrl = "{{url()->full()}}";
             if(fullUrl_count>1){
                 fullUrl = fullUrl.split('?')[1];
                 fullUrl = fullUrl.replace(/&amp;/g, '&');
                 fullUrl = '?'+fullUrl;
            }else{
                fullUrl = '';
            }
            var url = "{{url('admin/master/period/period-export')}}"+fullUrl;
            window.location.href = url;
        }
        function editCat(slug) {
            var url = "{{url('period_list_edit')}}"+"/"+slug;
            window.location.href = url;
        }
        function deleteCat(slug) {
            var url = "{{url('admin/master/period/delete-model-trim')}}"+"/"+slug;
            window.location.href = url;
        }
    </script>
  @endsection

  