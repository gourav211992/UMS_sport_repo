@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content');

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
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('screening-master-add') }}"><i data-feather="plus-circle"></i> Add New</a> 
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
                                <table class="datatables-basic table table-striped myrequesttablecbox  "> 
                                    <thead>
                                         <tr>
                                            <th>S.NO</th>
                                            <th>Sport Master</th>
                                            <th>Screening Name </th>
                                            <th>Descriprtion</th>
                                            <th>Parameter Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($screening as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{$item->screen->sport_name}}</td>
                                                <td class="fw-bolder text-dark">{{ $item->screening_name }}</td>
                                                
                                               
                                
                                                
                                                <td>{{ $item->description ?? 'N/A' }}</td>
                                                @php
                                                    $parameters = json_decode($item->parameter_details, true);
                                                    $parameter_names =  $parameters[0]['parametername'];
                                                @endphp
                                                <td>
                                                {{ $parameter_names}}
                                                </td>
                                
                                
                                                <td>
                                                    <span class="badge rounded-pill {{ $item->status == 'active' ? 'badge-light-success' : 'badge-light-danger' }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </td>
                                
                                                
                                                    <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{ url('screening-master-view', $item->id) }}">
                                                                <i data-feather="eye" class="me-50"></i> View Detail
                                                            </a>
                                                            <a class="dropdown-item" href="{{ url('screening-master-edit', $item->id) }}">
                                                                <i data-feather="edit-3" class="me-50"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item" href="{{ url('screening-master-delete', $item->id) }}">
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
                      <input type="text" id="fp-range" class="form-control flatpickr-range bg-white" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                </div>
                
                <div class="mb-1">
                    <label class="form-label">Activity</label>
                    <select class="form-select select2">
                        <option>Select</option> 
                    </select>
                </div> 
                
                <div class="mb-1">
                    <label class="form-label">Trainer</label>
                    <select class="form-select">
                        <option>Select</option>
                    </select>
                </div>
                
                <div class="mb-1">
                    <label class="form-label">Batch</label>
                    <select class="form-select">
                        <option>Select</option>
                    </select>
                </div>
                
                <div class="mb-1">
                    <label class="form-label">Status</label>
                    <select class="form-select select2">
                        <option>Select</option> 
                        <option>Active</option> 
                        <option>Inactive</option> 
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
@endsection