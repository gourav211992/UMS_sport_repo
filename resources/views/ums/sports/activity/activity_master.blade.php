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
                        <h2 class="content-header-title float-start mb-0">Activity Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>  
                                <li class="breadcrumb-item active">Activity List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button> 
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('activity-master-add') }}"><i data-feather="plus-circle"></i> Add New</a> 
                </div>
            </div>
        </div>
        <div class="content-body">
             
            
            
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            
                               
                            <div class="table-responsive candidates-tables">
                                <table class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist "> 
                                    <thead>
                                         <tr>
                                            <th>#</th>
                                            <th>Sport Name</th>
                                            <th>Activity Name</th>
                                            <th>Sub Activities </th>
                                            <th>Duration (Min)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                             <tr>
                                                <td>1</td>
                                                <td class="fw-bolder text-dark">Bedminton</td>
                                                <td>Gym</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
                                                <td>20 Min</td>
                                                <td><span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span></td> 
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit" class="me-50"></i>
                                                                <span>View Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit-3" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="trash-2" class="me-50"></i>
                                                                <span>Delete</span>
                                                            </a> 
                                                        </div>
                                                    </div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>2</td>
                                                <td class="fw-bolder text-dark">Bedminton</td>
                                                <td>Yoga</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
                                                <td>20 Min</td>
                                                <td><span class="badge rounded-pill badge-light-danger badgeborder-radius">Inactive</span></td>
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit" class="me-50"></i>
                                                                <span>View Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit-3" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="trash-2" class="me-50"></i>
                                                                <span>Delete</span>
                                                            </a> 
                                                        </div>
                                                    </div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>3</td>
                                                <td class="fw-bolder text-dark">Bedminton</td>
                                                <td>Zumba</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
                                                <td>20 Min</td>
                                                <td><span class="badge rounded-pill badge-light-danger badgeborder-radius">Inactive</span></td>
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit" class="me-50"></i>
                                                                <span>View Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit-3" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="trash-2" class="me-50"></i>
                                                                <span>Delete</span>
                                                            </a> 
                                                        </div>
                                                    </div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>4</td>
                                                <td class="fw-bolder text-dark">Cricket</td>
                                                <td>Yoga</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
                                                <td>20 Min</td>
                                                <td><span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span></td>
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit" class="me-50"></i>
                                                                <span>View Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit-3" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="trash-2" class="me-50"></i>
                                                                <span>Delete</span>
                                                            </a> 
                                                        </div>
                                                    </div>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>5</td>
                                                <td class="fw-bolder text-dark">Cricket</td>
                                                <td>Zumba</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">10</span></td>
                                                <td>20 Min</td>
                                                <td><span class="badge rounded-pill badge-light-success badgeborder-radius">Active</span></td>
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit" class="me-50"></i>
                                                                <span>View Detail</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="edit-3" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i data-feather="trash-2" class="me-50"></i>
                                                                <span>Delete</span>
                                                            </a> 
                                                        </div>
                                                    </div>
                                                </td>
                                              </tr>
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
@endsection