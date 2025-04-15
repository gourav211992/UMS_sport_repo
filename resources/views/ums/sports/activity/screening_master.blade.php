
@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
    {{-- content --}}
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Screening Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Screening List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-secondary btn-sm mb-50 mb-sm-0"
                        onclick="window.location.href='screening-master'">
                        <i data-feather="refresh-cw" class="me-50"></i> Reset
                    </button>
                    <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter"
                            data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>
                        <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('screening-master-add') }}"><i
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
                                                <th>S.No</th>
                                                <th>Sport Master</th>
                                                <th>Screening Name</th>
                                                <th>Description</th>
                                                <th>Parameter Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($screening as $key => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->screen->sport_name ?? 'N/A' }}</td>
                                                <td class="fw-bolder text-dark">{{ $item->screening_name }}</td>
                                                <td>{{ $item->description ?? 'N/A' }}</td>
                                                <td>
                                                    @php
                                                        $parameters = json_decode($item->parameter_details, true);
                                                        $parameter_names = $parameters[0]['parametername'] ?? 'N/A';
                                                    @endphp
                                                    {{ $parameter_names }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge rounded-pill {{ $item->status == 'active' ? 'badge-light-success' : 'badge-light-danger' }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
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
                                                                href="{{ url('screening-master-view', $item->id) }}">
                                                                <i data-feather="eye" class="me-50"></i> View Detail
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('screening-master-edit', $item->id) }}">
                                                                <i data-feather="edit-3" class="me-50"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('screening-master-delete', $item->id) }}">
                                                                <i data-feather="trash-2" class="me-50"></i> Delete
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
    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0" id="approveds-form" method="GET" novalidate
                action="{{ url('screening-master') }}">
                @csrf
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">List of Semesters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        
                    <label class="form-label">Sport Name</label>
                    <select class="form-select select2" name="sport_id" id="sport_id">
                        <option value="Select">Select</option>
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}"
                                {{ request()->sport_id == $sport->id ? 'selected' : '' }}>
                                {{ $sport->sport_name }}
                            </option>
                        @endforeach
                    </select>
                    </div>

                    <div class="mb-1">
                     
                    <label class="form-label">Screening Name</label>
                    <select class="form-select" name="screening_name" id="screening_name">
                        <option value="Select">Select</option>
                        @foreach ($allscreening as $allscreen)
                            <option
                                value="{{ $allscreen->screening_name }}"{{ request()->screening_name == $allscreen->screening_name ? 'selected' : '' }}>
                                {{ $allscreen->screening_name }}
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
