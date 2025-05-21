@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
		@include('ums.admin.notifications')
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Affliate Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('affiliate')}}">Home</a></li>  
                                    <li class="breadcrumb-item active">Affliate Master List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
						<a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{url('affiliate_add')}}"><i data-feather="plus-circle"></i> Add New</a> 
                    </div>
                </div>
            </div>
            <div class="content-body">
                 
                
				
				<section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
								
								   
                                <div class="table-responsive candidates-tables">
									<table class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist"> 
                                        <thead>
                                             <tr>
												<th>#</th>
												<th>Type</th>
												<th>Affliate Code</th>
												<th>Affliate Name</th>
												<th>Head Office</th>
												<th>Country</th>
												<th>Contact Person</th>
												<th>Email-ID</th>
												<th>Mobile</th>
												<th>Status</th>
												<th>Action</th>
											  </tr>
											</thead>
											
											
												
										
											
											<tbody>	
												@foreach ($affiliates as $index=>$affiliate)			  
												  <tr>
													<td>{{$index+1}}</td>
													<td class="fw-bolder text-dark">{{$affiliate->type}}</td>
													<td>{{$affiliate->affiliate_code}}</td>
													<td>{{$affiliate->affiliate_name}}</td>
													<td>{{ $affiliate->head_office }}</td>
													<td>{{ $affiliate->country->name ?? 'Unknown' }}</td> <!-- Display country name -->
													{{-- <td>{{ $affiliate->state->name ?? 'Unknown' }}</td>   <!-- Display state name --> --}}
													
													<td>{{$affiliate->contact_person}}</td>
													<td>{{$affiliate->email_id}}</td>
													<td>{{$affiliate->mobile}}</td>
													<td>
                                                        @if($affiliate->status == "Active")
                                                        <span class="badge rounded-pill badge-light-success">Active</span>
                                                        @else
                                                        <span  class="badge rounded-pill badge-light-danger">InActive</span>
                                                        @endif
                                                    </td>
													<td class="tableactionnew mb-auto">
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
																<i data-feather="more-vertical"></i>
															</button>
															<div class="dropdown-menu dropdown-menu-end">
																<a class="dropdown-item" href="{{route('affiliate_view', $affiliate->id)}}">
																	<i data-feather="edit" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																<a class="dropdown-item" href="{{ route('affiliate_edit', $affiliate->id) }}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
																
																<form id="deleteForm-{{ $affiliate->id }}" action="{{ route('affiliate_delete', $affiliate->id) }}" method="POST" style="display: inline;">
																	@csrf
																	@method('DELETE')
																	<a type="button"
																			class="dropdown-item"
																			data-bs-toggle="modal"
																			data-bs-target="#staticBackdrop"
																			onclick="setDeleteId('{{ $affiliate->id }}', '{{ $affiliate->affiliate_name }}')">
																		<i data-feather="trash-2" class="me-50"></i>
																		<span>Delete</span>
																	</a>
																</form>
																
																
																
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

	{{-- model --}}
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Deletion</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="deleteGroupName">
					<!-- Group Name will be inserted here -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
					<button type="button" class="btn btn-danger" onclick="deleteGroup()">Delete</button>
				</div>
			</div>
		</div>
	</div>
	
	
    <!-- END: Content-->
	<script>
		let affiliateIdToDelete = null;
		let affiliateNameToDelete = '';
	
		function setDeleteId(affiliateId, affiliateName) {
			affiliateIdToDelete = affiliateId;
			affiliateNameToDelete = affiliateName;
			document.getElementById('deleteGroupName').innerHTML =
				`Are you sure you want to delete the affiliate <strong>${affiliateNameToDelete}</strong>?`;
		}
	
		function deleteGroup() {
			if (affiliateIdToDelete) {
				const form = document.getElementById('deleteForm-' + affiliateIdToDelete);
				if (form) {
					form.submit();
				} else {
					alert('Form not found for deletion.');
				}
			} else {
				alert('No affiliate selected for deletion.');
			}
		}
	</script>
	
	
	@endsection

    