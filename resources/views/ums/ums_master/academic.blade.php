@extends('ums.admin.admin-meta')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">

        {{-- Header --}}
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Academic Yr Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">Academic Yr Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal">
                        <i data-feather="filter"></i> Filter
                    </button>
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="academic-add">
                        <i data-feather="plus-circle"></i> Add New
                    </a>
                </div>
            </div>
        </div>

        {{-- Body --}}
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
                                            <th>Academic Year</th>
                                            <th>Institute</th>
                                            <th>Code</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Enroll. No. Code</th>
                                            <th>Seq. No.</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($academicYears) && $academicYears->count() > 0)
                                            @foreach ($academicYears as $key => $year)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="fw-bolder text-dark">{{ $year->academic_year }}</td>
                                                    <td>{{ optional($year->institute)->institute_name ?? 'N/A' }}</td>
                                                    <td>{{ $year->academic_code }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($year->start_date)->format('d-M-Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($year->end_date)->format('d-M-Y') }}</td>
                                                    <td>{{ $year->enrollment_no }}</td>
                                                    <td>{{ $year->sequence_no }}</td>
                                                    <td>
                                                        <span class="badge rounded-pill badge-light-{{ strtolower($year->status) == 'open' ? 'success' : 'danger' }} badgeborder-radius">
                                                            {{ ucfirst($year->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="tableactionnew">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="{{ route('academic.view', $year->id) }}">
																	<i data-feather="edit" class="me-50"></i>
																	<span>View Detail</span>
																</a>
																<a class="dropdown-item" href="{{ route('academic.edit', $year->id) }}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit</span>
																</a>
                                                               
                                                         <button type="button"
                                                            class="dropdown-item open-confirm-modal"
                                                            data-href="{{ route('academic.delete', $year->id) }}">
                                                        <i data-feather="trash-2" class="me-50"></i>
                                                        <span>Delete</span>
                                                    </button>

                                                                
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center">No academic years available.</td>
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

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this academic year?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Filter Modal --}}
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
                    <input type="text" id="fp-range" class="form-control flatpickr-range bg-white" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                </div>

                <div class="mb-1">
                    <label class="form-label">Academic Code</label>
                    <select class="form-select select2">
                        <option>Select</option>
                    </select>
                </div>

                <div class="mb-1">
                    <label class="form-label">Academic Yr.</label>
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






    {{-- <script>
      $(document).on('click', '.open-confirm-modal', function (e) {
    e.preventDefault();

    let deleteUrl = $(this).data('href');
    $('#deleteForm').attr('action', deleteUrl);
    $('#confirmDeleteModal').modal('show');
});

    </script> --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.open-confirm-modal').forEach(function (button) {
        button.addEventListener('click', function () {
            const deleteUrl = this.getAttribute('data-href');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.setAttribute('action', deleteUrl);

            const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            modal.show();
        });
    });
});
</script>

@endsection
