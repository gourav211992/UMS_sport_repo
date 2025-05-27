@extends('ums.admin.admin-meta')     

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        @include('ums.admin.notifications')
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Document Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('document') }}">Home</a></li>  
                                    <li class="breadcrumb-item active">Document Master List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        {{-- <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>  --}}
						<a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('document-add') }}"><i data-feather="plus-circle"></i> Add New</a> 
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
												<th>Document Code</th>
												<th>Document Name</th>
												<th>Document Type</th>
												<th>Status</th>
												<th>Action</th>
											  </tr>
											</thead>
											<tbody>
    @foreach ($documents as $key => $document)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td class="fw-bolder text-dark">{{ $document->document_code }}</td>
            <td>{{ $document->document_name }}</td>
            <td>
                @if ($document->document_type == 1)
                    <span class="badge rounded-pill badge-light-success badgeborder-radius">Yes</span>
                @else
                    <span class="badge rounded-pill badge-light-danger badgeborder-radius">No</span>
                @endif
            </td>
            <td>
                @if ($document->status == 1)
                    <span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span>
                @else
                    <span class="badge rounded-pill badge-light-danger badgeborder-radius">Inactive</span>
                @endif
            </td>
            <td class="tableactionnew">
                <div class="dropdown dropup">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                        <i data-feather="more-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('document.show', $document->id) }}">
                               <i data-feather="edit" class="me-50"></i>
                               <span>View Detail</span>
                           </a>
                           <a class="dropdown-item" href="{{ route('document.edit', $document->id) }}">
                               <i data-feather="edit-3" class="me-50"></i>
                               <span>Edit</span>
                           </a>

                      
                               <form id="deleteForm-{{ $document->id }}" action="{{ route('document.destroy', $document->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="setDeleteId('{{ $document->id }}', '{{ $document->name }}')">
        <i data-feather="trash-2" class="me-50"></i>
        <span>Delete</span>
    </button>
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

    <!-- Delete Confirmation Modal -->

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
		let groupIdToDelete = null;
		let groupNameToDelete = '';
	
		function setDeleteId(groupId, groupName) {
			groupIdToDelete = groupId;
			groupNameToDelete = groupName;
			document.getElementById('deleteGroupName').innerHTML = 
				`Are you sure you want to delete the group <strong>${groupNameToDelete}</strong>?`;
		}
	
		function deleteGroup() {
			if (groupIdToDelete) {
				// Find the form by ID and submit it
				const form = document.getElementById('deleteForm-' + groupIdToDelete);
				if (form) {
					form.submit();
				}
			} else {
				alert('No group selected for deletion.');
			}
		}
	</script>
    
@endsection
