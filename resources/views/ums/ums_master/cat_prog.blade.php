@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Cat. Prog. Document Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                                <li class="breadcrumb-item active">Prog. Doc. Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ route('category-prog-doc.create') }}">
                        <i data-feather="plus-circle"></i> Add New
                    </a>
                </div>
            </div>
        </div>

        <div class="content-body">
            @include('ums.admin.notifications')
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive candidates-tables ts">
                                <table class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Document Category</th>
                                            <th>Course</th>
                                            <th>Cat. Prog. Doc. Code</th>
                                            <th>Cat. Prog. Doc. Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td class="fw-bolder text-dark">{{ $item->document_name }}</td>
                                                <td>{{ $item->course_name }}</td>
                                                <td>{{ $item->cat_prog_doc_code }}</td>
                                                <td>{{ $item->cat_prog_doc_name }}</td>
                                                <td>
                                                    <span class="badge rounded-pill badge-light-{{ $item->status == 'Active' ? 'success' : 'danger' }} badgeborder-radius">
                                                        {{ $item->status }}
                                                    </span>
                                                </td>
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{route('cat-prog-doc.view', $item->id)}}">
                                                                <i data-feather="eye" class="me-50"></i>
                                                                <span>View Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('cat-prog-doc.edit', $item->id) }}">
                                                                <i data-feather="edit" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>

                                                            <!-- Soft Delete Link -->
                                                            <a href="#" class="dropdown-item open-confirm-modal" data-href="{{ route('cat-prog-doc.delete', $item->id) }}">
                                                                <i data-feather="trash-2" class="me-50"></i>
                                                                <span>Delete</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if($data->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-center">No data available</td>
                                            </tr>
                                        @endif
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



<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Script for Modal -->
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
