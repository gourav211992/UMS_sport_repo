@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
{{-- content --}}
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    @include('ums.admin.notifications')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Group Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>  
                                <li class="breadcrumb-item active">Group Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('group-master-add') }}"><i data-feather="plus-circle"></i> Add New</a> 
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive candidates-tables">
                                <table class="datatables-basic table myrequesttablecbox "> 
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Batch Year</th>
                                            <th>Batch Name</th>
                                            <th>Section Name</th>
                                            <th>Group Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groups as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->batch_year }}</td>
                                                <td>{{ $item->batch->batch_name ?? 'No Batch' }}</td>
                                                <td>{{ $item->section->name ?? 'No Section' }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if($item->status == 'inactive')
                                                        <span class="badge rounded-pill badge-light-danger">Inactive</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-light-success">Active</span>
                                                    @endif
                                                </td>
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#" onclick="viewGroup('{{ $item->id }}')">
                                                                <i data-feather="edit" class="me-50"></i>
                                                                <span>View Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#" onclick="editGroup('{{ $item->id }}')">
                                                                <i data-feather="edit-3" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="setDeleteId('{{ $item->id }}', '{{ $item->name }}')">
                                                                <i data-feather="edit-3" class="me-50"></i>
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

@include('ums.admin.search-model', ['searchTitle' => 'sport List Search'])

<!-- Modal for Deletion -->
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

<script>
    let groupIdToDelete = null;
    let groupNameToDelete = '';

    function setDeleteId(groupId, groupName) {
    groupIdToDelete = groupId;  // Store the group ID
    groupNameToDelete = groupName;  // Store the group name
    
    document.getElementById('deleteGroupName').innerHTML = `Are you sure you want to delete the group <strong>${groupNameToDelete}</strong>?`;
}


    function deleteGroup() {
        if (groupIdToDelete) {
            var url = "{{ url('group-master-delete') }}/" + groupIdToDelete;

            window.location.href = url;
        } else {
            alert('No group selected for deletion.');
        }
    }

    function editGroup(slug) {
        var url = "{{ url('group-master-edit') }}/" + slug;
        window.location.href = url;
    }

    function viewGroup(slug) {
        var url = "{{ url('group-master-view') }}/" + slug;
        window.location.href = url;
    }
</script>
@endsection
