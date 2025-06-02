@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Screening Assessment</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('screening-assessment') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Assessment List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter"
                            data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>
                        <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('screening-assessment-add') }}"><i
                                data-feather="plus-circle"></i> Add New</a>

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
                                    <table
                                        class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                {{-- <th>Reg. No</th>
												<th>Player Name</th> --}}
                                                <th>Date of screening</th>
                                                {{-- <th>Section</th>
												<th>Group</th> --}}
                                                <th>Assesment Type</th>
                                                <th>Group Name</th>
                                                {{-- <th>Status</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($screeningSummary as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->screening_date)->format('d-m-Y') }}
                                                    </td>
                                                    {{-- <td>{{$item->firstName }} {{$item->lastName}}</td>
													<td>{{ \Carbon\Carbon::parse($item->screening_date)->format('d-m-Y') }}</td> --}}
                                                    <td>{{ $item->screening_names }}</td>
                                                    <td>{{ $item->groupName }}</td>
                                                    {{-- <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">15</span></td>
													<td><span class="badge rounded-pill badge-light-success badgeborder-radius">Done</span></td>  --}}
                                                    <td class="tableactionnew">
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                {{-- <a class="dropdown-item" href="{{url('view-mark-access')}}">
																	<i data-feather="eye" class="me-50"></i>
																	<span>View Detail 1</span>
																</a>

                                                                <a class="dropdown-item" href="{{url('mark-assess')}}">
																	<i data-feather="edit-3" class="me-50"></i>
																	<span>Edit 1</span>
																</a> --}}

                                                                <a class="dropdown-item" href="#"
                                                                    onClick="viewScreeningInner('{{ base64_encode(\Carbon\Carbon::parse($item->screening_date)->format('Y-m-d')) }}','{{ $item->sports_group_id }}')">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>View Detail</span>
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

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    @include('ums.admin.search-model', ['searchTitle' => 'sport List Search'])
    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0" id="approveds-form" method="GET" novalidate
                action="{{ url('screening-assessment') }}">
                @csrf
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">List of Semesters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">

                        <label class="form-label">Screening Name</label>
                        <select class="form-select" name="screening_name" id="screening_name">
                            <option value="Select">Select</option>
                            @foreach ($allscreening as $allscreen)
                                <option
                                    value="{{ $allscreen->id }}"{{ Request()->screening_name == $allscreen->id ? 'selected' : '' }}>
                                    {{ $allscreen->screening_name }}
                                </option>
                            @endforeach`
                        </select>
                    </div>

                    <div class="mb-1">

                        <label class="form-label">Player Name</label>
                        <select class="form-select" name="player_name" id="player_name">
                            <option value="Select">Select</option>
                            @foreach ($allplayers as $item)
                                <option
                                    value="{{ $item->player_id }}"{{ Request()->player_name == $item->player_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach`
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function editScreeiningAssesment(slug) {
        var url = "{{ url('mark-assess') }}" + "/" + slug;
        // alert(url);
        window.location.href = url;
    }

    function viewScreeiningAssesment(slug) {
        var url = "{{ url('view-mark-assess') }}" + "/" + slug;
        // alert(url);
        window.location.href = url;
    }

    function viewScreeningInner(date, id) {
        // let dateOnly = date.split(' ')[0]; // "2025-05-01"

        var url = "{{ url('screening-assessment-inner') }}" + "/" + encodeURIComponent(date) + "/" + id;
        // alert(url);
        window.location.href = url;
    }
</script>
