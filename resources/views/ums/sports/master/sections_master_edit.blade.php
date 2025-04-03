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
                            <h2 class="content-header-title float-start mb-0">Section Master Edit</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href={{ url('section-master') }}>Home</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
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

                                                <input type="hidden" name="id" value="{{ $section->id }}">


                                               



                                        <!-- Batch -->
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Batch Year<span
                                                        class="text-danger">*</span></label>
                                            </div>

                                            <div class="col-md-5">


                                            <select class="form-select" id="batch_year" name="batch_year">
                                                    <option value="" selected>-----Select Year-----</option>
                                                    @foreach ($batchs->pluck('batch_year')->unique() as $year)
                                                    <option value="{{ $year }}"
                                                    {{ old('batch_year', $section->year ?? '') == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
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
    <option value="">-----Select-----</option>
    @if(isset($section))
        <option value="{{ $section->batch }}" selected>{{ ucfirst($section->batch) }}</option>
    @endif
</select>


                                            <!-- <select class="form-select" name="batch_name" id="batch_name">
                                                    <option value="" selected>-----Select-----</option>
                                                    @foreach ($batchs->pluck('batch_name')->unique() as $batch)
                                                    <option value="{{ $batch}}"
                                                        {{ old('batch_name', $section->batch ?? '' ) == $batch ? 'selected' : '' }}>
                                                        {{ ucfirst($batch) }}
                                                    </option>
                                                    @endforeach
                                                </select> -->
                                                </div>

                                          
                                        </div>


                                        <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Section <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ old('name', $section->name ?? '') }}" required />
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Status</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="demo-inline-spacing">

                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="inactive" name="status"
                                                                    value="inactive" class="form-check-input"
                                                                    {{ old('status', $section->status ?? '') == 'inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="inactive">Inactive</label>
                                                            </div>

                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="active" name="status"
                                                                    value="active" class="form-check-input"
                                                                    {{ old('status', $section->status ?? '') == 'active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="active">Active</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



                                                <div class="mt-3">
                                                    <button type="button" onClick="javascript: history.go(-1)"
                                                        class="btn btn-secondary btn-sm">
                                                        <i data-feather="arrow-left-circle"></i> Back
                                                    </button>
                                                    <button type="submit" class="btn btn-primary btn-sm ms-1">
                                                        <i data-feather="check-circle"></i>Update
                                                    </button>
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
                e.preventDefault();


                $('#alertContainer').html('');


                var formData = new FormData(this);
                var url =
                    "{{ isset($section) ? url('section-update/' . $section->id) : url('section-edit') }}";


                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var alertClass = response.success ? 'alert-success' : 'alert-danger';
                        var message = response.success ? response.message : response.message;


                        var alertHTML = `
                    <div class="alert p-2 ${alertClass} alert-dismissible fade show" role="alert">
                        <strong>${response.success ? 'Success' : 'Error'}!</strong> ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                        $('#alertContainer').html(alertHTML);


                        if (response.success) {
                            $('#sectionForm')[0].reset();
                        }
                        window.location.href = "{{ url('/section-master') }}";
                    },
                    error: function(xhr, status, error) {

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
$(document).ready(function() {
    let selectedYear = $("#batch_year").val();
    let selectedBatch = "{{ $section->batch ?? '' }}"; // Get the batch_name from the section

    function loadBatchNames(year, selectedBatch) {
        $("#batch_name").html('<option value="">-----Select Batch-----</option>'); // Clear previous options
        if (year) {
            $.ajax({
                url: "{{ route('get-batches-name') }}",
                type: "GET",
                data: { batch_year: year },
                success: function(response) {
                    console.log("Batches received:", response);
                    $.each(response, function(index, batch) {
                        let isSelected = (batch.batch_name == selectedBatch) ? 'selected' : '';
                        $("#batch_name").append(`<option value="${batch.batch_name}" ${isSelected}>${batch.batch_name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching batches:", error);
                }
            });
        }
    }

    // Auto-load batch names if editing
    if (selectedYear) {
        loadBatchNames(selectedYear, selectedBatch);
    }

    // Update batch names on year change
    $("#batch_year").change(function() {
        loadBatchNames($(this).val(), "");
    });

     // Prevent overwriting the batch_name dropdown
     $(document).ajaxComplete(function() {
        console.log("AJAX Completed. Checking dropdown contents:", $("#batch_name").html());
    });
});
</script>

@endsection
