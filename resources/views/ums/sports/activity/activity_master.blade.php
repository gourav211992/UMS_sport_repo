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
             
            @if(session('delete'))
    <div class="alert alert-success p-2">
        {{ session('delete') }}
    </div>
        @endif

            
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
                                            {{-- <th>Sub Activities </th> --}}
                                            {{-- <th>Sub Activities Duration_min </th> --}}
                                            <th>Duration (Min)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activityMaster as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td class="fw-bolder text-dark">{{ $item->sport->sport_name }}</td>
                                                    <td>{{ $item->activity_name }}</td>
                                                    {{-- <td>
                                                        @if (isset($item->sub_activities) && count($item->sub_activities) > 0)
                                                            <span class="badge rounded-pill badge-light-secondary badgeborder-radius">
                                                                @foreach ($item->sub_activities as $subActivity)
                                                                    @if (is_array($subActivity)) <!-- Ensure it's an array -->
                                                                        {{ $subActivity['name'] }} @if(!$loop->last), @endif
                                                                    @else
                                                                        <span>Invalid Data Format</span>
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                        @else
                                                            <span>No Sub Activities</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (isset($item->sub_activities) && count($item->sub_activities) > 0)
                                                            <span class="badge rounded-pill badge-light-secondary badgeborder-radius">
                                                                @foreach ($item->sub_activities as $subActivity)
                                                                    @if (is_array($subActivity)) <!-- Ensure it's an array -->
                                                                        {{ $subActivity['duration'] }} @if(!$loop->last), @endif
                                                                    @else
                                                                        <span>Invalid Data Format</span>
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                        @else
                                                            <span>No Sub Activities Duration</span>
                                                        @endif
                                                    </td> --}}
                                                    <td>{{ $item->activity_duration_min }}</td>
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
                                                                <a class="dropdown-item" href="#" onclick="viewActivity('{{$item->id}}')">
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a>
                                                                <a class="dropdown-item" href="#" onclick="editActivity('{{$item->id}}')">
                                                                    <i data-feather="edit-3" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="#" onclick="if(window.confirm('Are you sure you want to delete this data?')) { deleteActivity('{{ $item->id }}'); }">
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
@include('ums.admin.search-model', ['searchTitle' => 'sport List Search'])
<div class="modal modal-slide-in fade filterpopuplabel" id="filter">
    <div class="modal-dialog sidebar-sm">
        <form class="add-new-record modal-content pt-0" id="approveds-form" method="GET" novalidate action="{{url('activity-master')}}"> 
            @csrf
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">List of Semesters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"> Activity Name</label>
                        <input type="text" name="activity_name" class="form-control" value="{{Request::get('activity_name')}}">
                    </div>
                </div>
             
                 
            </div>
            <div class="modal-footer justify-content-start">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </form>
    </div>
</div>
{{-- content --}}
<script>
    function editActivity(slug) {
		var url = "{{url('activity-master-edit')}}"+"/"+slug;
        // alert(url);
		window.location.href = url;
	}
    function viewActivity(slug) {
		var url = "{{url('activity-master-view')}}"+"/"+slug;
        // alert(url);
		window.location.href = url;
	}
    function deleteActivity(slug) {
		var url = "{{url('activity-master-delete')}}"+"/"+slug;
        // alert(url);
		window.location.href = url;
	}
</script>
@endsection