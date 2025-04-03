@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Student Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('sports-students') }}">Home</a></li>
                                <li class="breadcrumb-item active">Student Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <!-- <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button> -->
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('sports-registration') }}"><i data-feather="plus-circle"></i> Add New</a>
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
                                            <th>Temporary ID</th>
                                            <th>Reg. Date</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Date of Joining</th>
                                            <th>Batch</th>
                                            <th>Payment Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-bolder text-dark">{{ $student->document_number }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->document_date)->format('d-m-Y') }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->gender ?: 'Not Provided' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->dob)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($student->doj)->format('d-m-Y') }}</td>
                                            <td>{{ $student->batch ? $student->batch->batch_name : 'Not Provided' }}</td>
                                            <td>
    <span class="badge rounded-pill
        @if(isset($student->user->payment_status))
            {{ $student->user->payment_status == 'paid' ? 'badge-light-success' : 'badge-light-warning' }}
        @else
            badge-light-warning
        @endif">
        @if(isset($student->user->payment_status))
            {{ ucfirst($student->user->payment_status) }}
        @else
            Pending
        @endif
    </span>
                                            </td>

                                            <td>
                                                {{-- @dump($student->status)--}}
                                                <!-- <span class="badge rounded-pill
                                                            {{ ($student->status == 'submitted' || $student->status == 'approved') ? 'badge-light-success' : ($student->status == 'rejected' ? 'badge-light-danger' : 'badge-light-warning') }}">
                                                            @if($student->status == 'submitted' || $student->status == 'approved' || $student->status == 'rejected' || $student->status == 'on-hold')
                                                            {{ ucfirst($student->status) }}
                                                        @else
                                                            Draft
                                                        @endif
                                                    </span> -->


                                                <span class="badge rounded-pill
                                        {{ ($student->status == 'submitted')
                                            ? 'badge-light-success'
                                            : (($student->status == 'approved')
                                                ? 'badge-light-info'
                                                : (($student->status == 'rejected')
                                                    ? 'badge-light-danger'
                                                    : 'badge-light-warning')) }}">
                                                    @if(in_array($student->status, ['submitted', 'approved', 'rejected', 'on-hold']))
                                                    {{ ucfirst($student->status) }}
                                                    @else
                                                    Draft
                                                    @endif
                                                </span>


                                            </td>
                                            <td class="tableactionnew">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('view-registration',$student->id) }}">
                                                            <i data-feather="edit" class="me-50"></i>
                                                            <span>View Detail</span>
                                                        </a>
                                                        @if( $student->status != 'approved')
                                                        <a class="dropdown-item" href="{{route('edit-registration',$student->id)}}">
                                                            <i data-feather="edit-3" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        @endif
                                                        <a class="dropdown-item" href="#">
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

@endsection
<script>
    $(document).ready(function() {

        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }


        var dt_basic_table = $('.datatables-basic');
        if (dt_basic_table.length) {
            var dt_basic = dt_basic_table.DataTable({
                order: [[0, 'asc']],
                dom:
                    '<"d-flex justify-content-between align-items-center mx-2 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-3 withoutheadbuttin dt-action-buttons text-end"B><"col-sm-12 col-md-3"f>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [
                    {
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle',
                        text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
                        buttons: [
                            {
                                extend: 'print',
                                text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                                className: 'dropdown-item',
                                exportOptions: {


                                    columns: ':not(:last-child)'
                                    // modifier: { page: 'all' }
                                }
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {

                                    columns: ':not(:last-child)'
                                    // modifier: { page: 'all' }
                                }
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {

                                    columns: ':not(:last-child)'
                                    // modifier: { page: 'all' }
                                }
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {

                                    columns: ':not(:last-child)'
                                    // modifier: { page: 'all' }
                                }
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {

                                    columns: ':not(:last-child)'
                                    //modifier: { page: 'all' }
                                }
                            }
                        ]
                    },
                ],
                language: {
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });
        }

        // Flat Date picker initialization
        var dt_date_table = $('.dt-date');
        if (dt_date_table.length) {
            dt_date_table.flatpickr({
                monthSelectorType: 'static',
                dateFormat: 'm/d/Y'
            });
        }

        // Handle new records
        var count = 101;
        $('.data-submit').on('click', function () {
            var $new_name = $('.add-new-record .dt-full-name').val(),
                $new_post = $('.add-new-record .dt-post').val(),
                $new_email = $('.add-new-record .dt-email').val(),
                $new_date = $('.add-new-record .dt-date').val(),
                $new_salary = $('.add-new-record .dt-salary').val();

            if ($new_name != '') {
                dt_basic.row
                    .add({
                        responsive_id: null,
                        id: count,
                        full_name: $new_name,
                        post: $new_post,
                        email: $new_email,
                        start_date: $new_date,
                        salary: '$' + $new_salary,
                        status: 5
                    })
                    .draw();
                count++;
                $('.modal').modal('hide');
            }
        });

        // Handle delete records
        $('.datatables-basic tbody').on('click', '.delete-record', function () {
            dt_basic.row($(this).parents('tr')).remove().draw();
        });

    });
</script>