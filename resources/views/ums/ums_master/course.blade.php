@extends('ums.admin.admin-meta')
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Course Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Course Master List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter"
                            data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>
                        <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('course-add') }}"><i
                                data-feather="plus-circle"></i> Add New</a>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @if (session('success'))
                    <div class="alert alert-success p-2 alert-dismissible fade show" role="alert">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">


                                <div class="table-responsive candidates-tables">
                                    <table
                                        class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Programe Type</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Enroll. No. Code</th>
                                                <th>Seq. No.</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($course as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td class="fw-bolder text-dark">{{ $item->programType->program_name ?? 'N/A' }}</td>
                                                    <td>{{ $item->course_code }}</td>
                                                    <td>{{ $item->course_name }}</td>
                                                    <td>{{ $item->enrollment_no }}</td>
                                                    <td>{{ $item->sequence_no }}</td>
                                                    <td>
                                                        @if ($item->status == 'inactive')
                                                            <span
                                                                class="badge rounded-pill badge-light-danger">Inactive</span>
                                                        @else
                                                            <span
                                                                class="badge rounded-pill badge-light-success">Active</span>
                                                        @endif
                                                    </td>
                                                    <td class="tableactionnew">
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item"
                                                                    href="{{ url('course-view/' . $item->id) }}">
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('course-edit/' . $item->id) }}">
                                                                    <i data-feather="edit-3" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>

                                                                <a href="#" class="dropdown-item open-confirm-modal"
                                                                    data-href="{{ url('course-delete/' . $item->id) }}">
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



                            </div>
                        </div>
                    </div>

                </section>


            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).on('click', '.open-confirm-modal', function(e) {
            e.preventDefault();

            let deleteUrl = $(this).data('href');
            $('#confirmDeleteBtn').attr('href', deleteUrl);

            $('#confirmDeleteModal').modal('show');
        });
    </script>
@endsection
