@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
;


<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Batch Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href={{url('master-batches')}}>Home</a></li>
                                <li class="breadcrumb-item active">Batch Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <!-- <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter"
                            data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button> -->
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="master-batches-add"><i
                            data-feather="plus-circle"></i> Add New</a>
                </div>
            </div>

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade p-2 show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible p-2 fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
            </div>
            @endif


        </div>



        <div class="content-body">



            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">


                            <div class="table-responsive candidates-tables">
                                <table class="datatables-basic table table-striped myrequesttablecbox ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Batch Year </th>
                                            <th>Batch Name</th>
                                            <th>Session Start Date</th>
                                            <th>Session End Date</th>

                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                        <tr>
                                            <!-- <td>{{ $row->id }}</td> -->
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-bolder text-dark">{{ $row->batch_year }}</td>
                                            <td class="fw-bolder text-dark">{{ $row->batch_name }}</td>
                                            <td class="fw-bolder text-dark">
                                                {{ $row->start_date ? \Carbon\Carbon::parse($row->start_date)->format('d-m-Y') : '' }}
                                            </td>
                                            
                                            <td class="fw-bolder text-dark">
                                                {{ $row->end_date ? \Carbon\Carbon::parse($row->end_date)->format('d-m-Y') : '' }}
                                            </td>
                                            <td><span class="badge rounded-pill 
                                                        {{ $row->status == 'active' ? 'badge-light-success' : 'badge-light-danger' }}">
                                                    {{ ucfirst($row->status) }}
                                                </span></td>
                                            <td class="tableactionnew">
                                                <div class="dropdown">
                                                    <button type="button"
                                                        class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                        data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <!-- Corrected href link to include the $row->id -->
                                                        <a class="dropdown-item"
                                                            href="{{ url('master-batches-edit/' . $row->id) }}">
                                                            <i data-feather="edit-3" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        
                                                            <form id="deleteForm-{{ $row->id }}" action="{{ route('batches-destroy', $row->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a type="button"
                                                                        class="dropdown-item"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#staticBackdrop"
                                                                        onclick="setDeleteId('{{ $row->id }}')">
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
                    <input type="text" id="fp-range" class="form-control flatpickr-range bg-white"
                        placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                </div>

                <div class="mb-1">
                    <label class="form-label">Admision Yr.</label>
                    <select class="form-select">
                        <option>Select</option>
                    </select>
                </div>

                <div class="mb-1">
                    <label class="form-label">Sport Name</label>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		let affiliateIdToDelete = null;
		let affiliateNameToDelete = '';
	
		function setDeleteId(affiliateId) {
			affiliateIdToDelete = affiliateId;
			// affiliateNameToDelete = affiliateName;
			document.getElementById('deleteGroupName').innerHTML =
				`Are you sure you want to delete the sportBatch ?`;
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