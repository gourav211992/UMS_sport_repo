@extends('ums.sports.sports-meta.admin-sports-meta')
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
                            <h2 class="content-header-title float-start mb-0">Fee Head Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('sport_fee_head')}}">Home</a></li>  
                                    <li class="breadcrumb-item active">Fee Master List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                    
						<a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{url('sport_fee_head_add')}}"><i data-feather="plus-circle"></i> Add New</a> 
                    </div>
                </div>
            </div>
            <div class="content-body">
                   @include('ums.admin.notifications')
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive candidates-tables">
									<table class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist"> 
                                        <thead>
                                             <tr>
												<th>S.no</th>
												<th>Fee Head</th>
												<th>Status</th>
												<th>Action</th>
											  </tr>
											</thead>
										<tbody>
                                      <!-- @php $i = 1; @endphp -->
                                       @foreach($feehead as $row)
                                        <tr>
                                                <td>{{ $i++ }}</td>
                                                <td class="fw-bolder text-dark">{{ $row->fee_head }}</td> 
                                                <td>
                                                    @if($row->status == 'Active')
                                                        <span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-light-danger badgeborder-radius">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{ url('sport_fee_head_view/'.$row->id) }}">
                                                                <i data-feather="eye" class="me-50"></i>
                                                                <span>View Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" href="{{ url('sport_fee_head_edit/'.$row->id) }}">
                                                                <i data-feather="edit" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                           
                                                                
                                                               <a href="#"class="dropdown-item open-confirm-modal" data-href="{{ route('sport_fee_head.delete', $row->id) }}">
                                                                  <i data-feather="trash-2" class="me-50"></i>
                                                                  <span>Delete</span>
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
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
		<div class="modal-dialog sidebar-sm">
			<form class="add-new-record modal-content pt-0"> 
				<div class="modal-header mb-1">
					<h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
				</div>
				<div class="modal-body flex-grow-1">
                    <div class="mb-1">
						<label class="form-label">Fee Head</label>
						<select class="form-select select2">
							<option>Select</option> 
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


    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this fee record?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Delete</a>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <script>
        $(document).on('click', '.open-confirm-modal', function (e) {
    e.preventDefault(); 

    let deleteUrl = $(this).data('href');
    $('#confirmDeleteBtn').attr('href', deleteUrl); 

    $('#confirmDeleteModal').modal('show'); 
});

    </script>
    @endsection
   