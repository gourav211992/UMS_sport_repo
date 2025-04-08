@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header pocreate-sticky">
            <div class="row">
                <div class="content-header-left col-md-6 mb-2">
                    <h2 class="content-header-title float-start mb-0">Group Master</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                        <i data-feather="arrow-left-circle"></i> Back
                    </button>
                    <button type="submit" form="cat_form" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                        <i data-feather="check-circle"></i> Submit
                    </button>
                </div>
            </div>
        </div>

        <form id="cat_form" method="POST" action="{{ route('group-master-update', $group->id) }}">
            @csrf
            @method('PUT')
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Year Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="batch_year" id="batch_year">
                                                        <option value="">Select Year</option>
                                                        @foreach($years as $year)
                                                           
                                                            <option value="{{ $year }}" {{ (old('batch_year', $group->batch_year) == $year) ? 'selected' : '' }}>
                                                                {{ $year }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    
                                                    
                                                </div>
                                            </div>
                                            

                                            <!-- Batch Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="batch_name" id="batch_name">
                                                        <option value="">Select Batch</option>
                                                        @foreach($batches as $batch_name)
                                                            <option value="{{ $batch_name }}" {{ old('batch_name', $group->batch_name) == $batch_name ? 'selected' : '' }}>
                                                                {{ $batch_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <!-- Section Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="section_id" id="section">
                                                        <option value="">Select section</option>
                                                        @foreach($sections as $section)
                                                            <option value="{{ $section->name }}" {{ old('section_id', $group->section_name) == $section->name ? 'selected' : '' }}>
                                                                {{ $section->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Group Name -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Group Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="group_name" value="{{ old('group_name', $group->name) }}" class="form-control" />
                                                </div>
                                            </div>

                                            <!-- Status Field -->
                                            <div class="row align-items-center mb-2">
                                                <div class="col-md-3">
                                                    <label class="form-label">Status</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="active" name="status" value="active" class="form-check-input" {{ $group->status == 'active' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="active">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="inactive" name="status" value="inactive" class="form-check-input" {{ $group->status == 'inactive' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="inactive">Inactive</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    
$(document).ready(function () {
    // Jab Batch Year select ho
    $('#batch_year').change(function () {
        var batchYear = $(this).val();
        $('#batch_name').html('<option value="" selected>-----Select Batch-----</option>'); // Reset batch dropdown
        $('#section').html('<option value="" selected>-----Select Section-----</option>'); // Reset section dropdown

        if (batchYear) {
            console.log(batchYear);  // Debugging ke liye

            // AJAX call for batches based on selected batch year
            $.ajax({
                url: "{{ route('get-batches-name') }}",  // Correct route to fetch batch names
                type: "POST",
                data: { batch_year: batchYear },
                success: function (response) {
                    $('#batch_name').empty().append('<option value="">Select Batch</option>');
                    if (response.length > 0) {
                        // Agar batches hain toh unhe loop karke dropdown me daalna hai
                        $.each(response, function (index, batch) {
                            $('#batch_name').append('<option value="'+batch.batch_name+'">'+batch.batch_name+'</option>');
                        });
                    } else {
                        // Agar koi batches nahi hain
                        $('#batch_name').append('<option value="">No Batches Available</option>');
                    }
                }
            });
        }
    });

    // Jab Batch Name select ho
   $('#batch_name').change(function () {
    var batchYear = $('#batch_year').val();
    var batchName = $(this).val();
    $('#section').html('<option value="" selected>-----Select Section-----</option>'); // Reset section dropdown

    if (batchYear && batchName) {
        $.ajax({
            url: "{{ route('section.fetch') }}",  // Ensure this route is correct
            type: "POST",
            data: { batch_year: batchYear, batch_name: batchName },
            success: function (response) {
                $('#section').empty().append('<option value="">Select Section</option>');
                if (response.length > 0) {
                    // Loop through the sections and add them to the dropdown
                    $.each(response, function (index, section) {
                        $('#section').append('<option value="'+section.name+'">'+section.name+'</option>');
                    });
                } else {
                    $('#section').append('<option value="">No Sections Available</option>');
                }
            }
        });
    }
});


    // Initial trigger for already selected values when editing
    var selectedBatchYear = $('#batch_year').val();
    var selectedBatchName = $('#batch_name').val();

    if (selectedBatchYear) {
        // Trigger batch fetch on page load
        $.ajax({
            url: "{{ route('get-batches-name') }}",
            type: "POST",
            data: { batch_year: selectedBatchYear },
            success: function (response) {
                $('#batch_name').empty().append('<option value="">Select Batch</option>');
                if (response.length > 0) {
                    $.each(response, function (index, batch) {
                        $('#batch_name').append('<option value="'+batch.batch_name+'" '+(batch.batch_name == selectedBatchName ? 'selected' : '')+'>' + batch.batch_name + '</option>');
                    });
                } else {
                    $('#batch_name').append('<option value="">No Batches Available</option>');
                }
            }
        });
    }

    // Trigger section fetch on page load
    if (selectedBatchYear && selectedBatchName) {
        $.ajax({
            url: "{{ route('section.fetch') }}",
            type: "POST",
            data: { batch_year: selectedBatchYear, batch_name: selectedBatchName },
            success: function (response) {
                $('#section').empty().append('<option value="">Select Section</option>');
                if (response.length > 0) {
                    $.each(response, function (index, section) {
                        $('#section').append('<option value="'+section.name+'" '+(section.name == '{{ old('section.name', $group->section_name) }}' ? 'selected' : '')+'>' + section.name + '</option>');
                    });
                } else {
                    $('#section').append('<option value="">No Sections Available</option>');
                }
            }
        });
    }
});

</script>


@endsection
















