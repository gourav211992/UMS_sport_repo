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
                        <h2 class="content-header-title float-start mb-0">Quota Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item active">Quota Master List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bulkUploadModal">
                            Bulk Upload Quotas
                        </button> -->
                    <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('quota-master/add') }}"><i data-feather="plus-circle"></i> Add New</a>
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
                                <table class="datatables-basic table table-striped myrequesttablecbox " id="example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Quota</th>
                                            <th>Display Name</th>
                                            <th>Discount%</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="quotaTableBody">
                                        @foreach ($quotas as $quota)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-bolder text-dark">{{ $quota->quota_name }}</td>
                                            <td class="fw-bolder text-dark">{{ $quota->display_name }}</td>
                                            <td class="fw-bolder text-dark">{{ $quota->discount }}</td>
                                            <!-- <td class="tableactionnew">
                                                <div class="dropdown">
                                                    <button type="button"
                                                        class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                        data-bs-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                            href="quota-edit/{{ $quota->id }}">
                                                            <i data-feather="edit-3" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="quota-delete/{{ $quota->id }}"
                                                            onclick="return confirmDelete({{ $quota->id }})">
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
                                                                    href="{{ url('quota-edit/'.$quota->id )}}">
                                                                    <i data-feather="edit-3" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('quota-delete/'. $quota->id) }}"
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


                <!-- Bulk Upload Modal -->

                <!-- Button to open the modal -->


            </section>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('.myrequesttablecbox')) {
            $('.myrequesttablecbox').DataTable().destroy(); // Destroy existing instance
        }

        $('.myrequesttablecbox').DataTable({
            dom: 'Bfrtip',
            buttons: [] // Removes export buttons
        });
    });
</script>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
    let table = $('.myrequesttablecbox').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'] // Keep this if needed elsewhere
    });

    // Remove export buttons after initialization
    table.buttons().destroy();
});
</script> -->

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch the quotas when the page loads
            $.ajax({
                url: "{{ url('quotas-list') }}", // URL to fetch quotas
method: 'GET',
success: function(response) {
if (response.success) {
var quotas = response.data;
var tableBody = $('#quotaTableBody');
tableBody.empty(); // Clear any existing rows

// Loop through the quotas and add them to the table
quotas.forEach(function(quota, index) {
var row = `
<tr>
    <td>${index + 1}</td>
    <td class="fw-bolder text-dark">${quota.quota_name}</td>
    <td>${quota.discount}</td>
    <td class="tableactionnew">
        <div class="dropdown">
            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                <i data-feather="more-vertical"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">

                <a class="dropdown-item" href="quota-edit/${quota.id}">
                    <i data-feather="edit-3" class="me-50"></i>
                    <span>Edit</span></a>
                <a class="dropdown-item" href="quota-delete/${quota.id}" onclick="return confirmDelete(${quota.id})">
                    <i data-feather="trash" class="me-50"></i>
                    <span>Delete</span></a>
            </div>
        </div>
    </td>
</tr>
`;
tableBody.append(row); // Append the row to the table body
});
} else {
alert("Failed to load quotas");
}
},
error: function(xhr, status, error) {
console.error("Error fetching quotas: ", error);
alert("An error occurred while fetching the quotas.");
}
});
});
</script> --}}


@endsection