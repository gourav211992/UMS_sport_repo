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
                        <h2 class="content-header-title float-start mb-0">Section Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href={{url('section-master')}}>Home</a></li>
                                <li class="breadcrumb-item active">Section Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <!-- <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter"
                            data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button> -->
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('section-master/add') }}"><i
                            data-feather="plus-circle"></i> Add New</a>
                </div>
            </div>


            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade p-2 show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible p-2 fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   
            </div>
            @endif


        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive candidates-tables">
                                <table
                                    class="datatables-basic table table-striped myrequesttablecbox  ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Section_Name</th>
                                            <th>Batch</th>
                                            <th>Year</th>
                                            <th>Status</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($section as $sec)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-bolder text-dark">{{ $sec->name }}</td>
                                            <td class="fw-bolder text-dark">{{ $sec->batch }}</td>
                                            <td class="fw-bolder text-dark">{{ $sec->year }}</td>
                                            <td> <span class="badge rounded-pill 
                                                        {{ $sec->status == 'active' ? 'badge-light-success' : 'badge-light-danger' }}">
                                                    {{ ucfirst($sec->status) }}
                                                </span></td>
                                            <!-- <td class="tableactionnew">
                                                <div class="dropdown">
                                                    <button type="button"
                                                        class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                        data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                            href="section-edit/{{ $sec->id }}">
                                                            <i data-feather="edit-3" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="section-delete/{{ $sec->id }}"
                                                            onclick="return confirmDelete({{ $sec->id }})">
                                                            <i data-feather="trash" class="me-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td> -->
                                        
                                            <td class="tableactionnew">
                                                <div class="dropdown">
                                                    <button type="button"
                                                        class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                        data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                            href= "{{ url('section-edit/'.$sec->id ) }}">
                                                            <i data-feather="edit-3" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ url('section-delete/'. $sec->id )}}"
                                                            onclick="return confirm('Are you sure to delete this Item')">
                                                            <i data-feather="trash" class="me-50"></i>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ url('section-list') }}",
method: 'GET',
success: function(response) {
if (response.success) {
var sections = response.data;
var tableBody = $('#SectionTableBody');
tableBody.empty();

sections.forEach(function(section, index) {
var row = `
<tr>
    <td>${index + 1}</td>
    <td class="fw-bolder text-dark">${section.name}</td>
    <td class="tableactionnew">
        <div class="dropdown">
            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                <i data-feather="more-vertical"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="section-edit/${section.id}">
                    <i data-feather="edit-3" class="me-50"></i>
                    <span>Edit</span>
                </a>
                <a class="dropdown-item" href="section-delete/${section.id}" onclick="return confirmDelete(${section.id})">
                    <i data-feather="trash" class="me-50"></i>
                    <span>Delete</span>
                </a>
            </div>
        </div>
    </td>
</tr>
`;
tableBody.append(row);
});


feather.replace();
} else {
alert("Failed to load section");
}
},
error: function(xhr, status, error) {
console.error("Error fetching section: ", error);
alert("An error occurred while fetching the section.");
}
});
});
</script> --}}
@endsection