@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-6 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Section Master Add</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href={{url('section-master')}}>Home</a></li>
                                    <li class="breadcrumb-item active">Add New</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div id="alertContainer"></div>
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body customernewsection-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="newheader border-bottom mb-2 pb-25">
                                                <h4 class="card-title text-theme">Basic Information</h4>
                                                <p class="card-text">Fill the details</p>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <!-- Alert Container (will be filled by AJAX response) -->


                                            <form id="sectionForm">
                                                @csrf
                                                


                                                <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Year<span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-select" name="batch_year" id="batch_year">
                                                        <option value="" selected>-----Select-----</option>
                                                       
                                                        @foreach ($batchs->pluck('batch_year')->unique() as $batch_year)
                                                      <option value="{{ $batch_year }}">{{ $batch_year }}</option>
                                                      @endforeach
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Name<span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="col-md-5">
                                                    <select class="form-select" name="batch_name" id="batch_name">
                                                     
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Section_name <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="name"
                                                            required />
                                                    </div>
                                                </div>


                                                
                                                
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Status</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="inactive" name="status" value="inactive" class="form-check-input">
                                                                <label class="form-check-label fw-bolder" for="inactive">Inactive</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="active" name="status" value="active" class="form-check-input" checked>
                                                                <label class="form-check-label fw-bolder" for="active">Active</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                             

                                                <div class="mt-3">
                                                    <button type="button" onClick="javascript: history.go(-1)"
                                                        class="btn btn-secondary btn-sm"><i
                                                            data-feather="arrow-left-circle"></i> Back</button>
                                                    <button type="submit" class="btn btn-primary btn-sm ms-1"><i
                                                            data-feather="check-circle"></i> Create</button>
                                                </div>
                                            </form>
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
        $(document).ready(function() {
            $('#sectionForm').submit(function(e) {
                e.preventDefault(); // Prevent form from submitting normally

                // Clear any previous alert messages
                $('#alertContainer').html('');

                // Get form data
                var formData = new FormData(this);

                // Send AJAX request
                $.ajax({
                    url: "{{ url('section-add') }}", // Laravel route to store quota
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var alertClass = response.success ? 'alert-success' : 'alert-danger';
                        var message = response.success ? response.message : response.message;

                        // Create Bootstrap alert and append to the alert container
                        var alertHTML = `
    <div class="alert p-2 ${alertClass} alert-dismissible fade  show" role="alert">
        <strong>${response.success ? 'Success' : 'Error'}!</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
                `;
                        $('#alertContainer').html(alertHTML);
                        window.location.href="{{ url('section-master') }}";

                        // Optionally, reset the form on success
                        if (response.success) {
                            $('#quotaForm')[0].reset();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error and show an alert
                        $('#alertContainer').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Something went wrong with the request.
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
                    }
                });
            });
        });
    </script>
     <script>
    $(document).ready(function () {
        $("#batch_year").change(function () {
            let selectedYear = $(this).val();
            $("#batch_name").html('<option value="" selected>-----Select Batch-----</option>'); // Clear previous options

            if (selectedYear) {
                $.ajax({
                    url: "{{ route('get-batches-name') }}", 
                    type: "GET",
                    data: { batch_year: selectedYear },
                    success: function (response) {
                        $.each(response, function (index, batch) {
                            $("#batch_name").append(`<option value="${batch.batch_name}">${batch.batch_name}</option>`);
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
