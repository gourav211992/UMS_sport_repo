@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content');
{{-- content --}}
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    @include('ums.admin.notifications')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Sport Type Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>  
                                <li class="breadcrumb-item active">Sport Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <!-- <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>  -->
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('sport-type-add') }}"><i data-feather="plus-circle"></i> Add New</a> 
                </div>
            </div>
        </div>
        <div class="content-body">
             
            
            
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            
                               
                            <div class="table-responsive candidates-tables">
                                <table class="datatables-basic table table-striped myrequesttablecbox tasklist"> 
                                    <thead>
                                         <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>action</th>
                                          </tr>
                                        </thead>
                                       
                                            
                                        
                                        <tbody>
                                            @foreach ($Sporttype as $index=>$item)
                                             <tr>
                                                <td>{{$index+1}}</td>
                                               
                                                <td class="fw-bolder text-dark">{{$item->type}}</td>
                                               
                                            
                                            
                                                <td class="tableactionnew">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            
                                                            <a class="dropdown-item" href="#"  onclick="editSportType('{{$item->id}}')">
                                                                <i data-feather="edit-3" class="me-50" ></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <a class="dropdown-item" href="#" onclick="if(window.confirm('Are you sure you want to delete this data?')) { deleteSport('{{$item->id}}'); }" >
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
                                        <div class="d-flex justify-content-end cstm-pgn">
                                            {{ $Sporttype->onEachSide(2)->links('pagination::bootstrap-4') }}
                                        </div>
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
        <form class="add-new-record modal-content pt-0" id="approveds-form" method="GET" novalidate action="{{url('sport-master')}}"> 
            @csrf
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">List of Semesters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Name</label>
                        <input type="text" name="sport_name" class="form-control" value="{{Request::get('sport_name')}}">
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
    function editSportType(slug) {
		var url = "{{url('sport-type-edit')}}"+"/"+slug;
        // alert(url);
		window.location.href = url;
	}
    function viewSport(slug) {
		var url = "{{url('sport-master-view')}}"+"/"+slug;
        // alert(url);
		window.location.href = url;
	}
    function deleteSport(slug) {
		var url = "{{url('sport-type-delete')}}"+"/"+slug;
        // alert(url);
		window.location.href = url;
	}
</script>
@endsection