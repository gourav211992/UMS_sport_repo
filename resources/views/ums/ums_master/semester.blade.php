@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
<!-- BEGIN: Content -->
<div class="app-content content">
    <div class="content-overlay"></div>
    @include('ums.admin.notifications')
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        
        <!-- Header Section -->
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Semester Type Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('semesters') }}">Home</a></li>
                                <li class="breadcrumb-item active">Semester Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('semesters_add') }}">
                        <i data-feather="plus-circle"></i> Add New
                    </a>
                </div>
            </div>
        </div>

        <!-- Body Section -->
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
                                            <th>Semester Code</th>
                                            <th>Semester Name</th>
                                            <th>Enroll. No. Code</th>
                                            <th>Seq. No.</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semesters as $index => $semester)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="fw-bolder text-dark">{{ $semester->semester_code }}</td>
                                            <td>{{ $semester->semester_name }}</td>
                                            <td>{{ $semester->enrollment_no }}</td>
                                            <td>{{ $semester->seq_no }}</td>
                                            <td>
                                                @if ($semester->status)
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
                                                        <a class="dropdown-item" href="{{ route('semesters.view', $semester->id) }}">
                                                            <i data-feather="eye" class="me-50"></i> <span>View Detail</span>
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('semesters.edit', $semester->id) }}">
                                                            <i data-feather="edit-3" class="me-50"></i> <span>Edit</span>
                                                        </a>
                                                        <form method="POST" action="{{ route('semesters.destroy', $semester->id) }}" onsubmit="return confirm('Are you sure you want to delete this institute?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteAction({{ $semester->id }})">
                                                                <i data-feather="trash-2" class="me-50"></i> <span>Delete</span>
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this institute?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes, Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Script -->
<script>
    function setDeleteAction(id) {
        const form = document.getElementById('deleteForm');
        form.action = "{{ url('semesters') }}/" + id;
    }
</script>
@endsection
