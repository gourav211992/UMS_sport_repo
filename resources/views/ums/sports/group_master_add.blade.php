@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
{{-- content --}}
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
        <div class="content-body">
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

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <form id="cat_form" method="POST" action="{{ route('group-master-add') }}">
                                        @csrf
                                        <div class="col-md-9">
                                           

                                            <!-- Batch Year Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="batch_year" id="batch_year">
                                                        <option value="">Select Year</option>
                                                        @foreach($sections_year as $years)
                                                            <option value="{{ $years->year }}">{{$years->year }}</option> <!-- Displaying the year -->
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            

                                            <!-- Batch Name Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="batch_name" id="batch_name">
                                                        <option value="">Select Batch</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Section Field (This will be populated via AJAX) -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="section" name="section_name" class="form-control">
                                                        <option value="" selected>Select Section</option>
                                                    </select>
                                                </div>
                                            </div>
 <!-- Group Name Field -->
 <div class="row align-items-center mb-1">
    <div class="col-md-3">
        <label class="form-label">Group Name <span class="text-danger">*</span></label>
    </div>
    <div class="col-md-5">
        <input type="text" name="group_name" class="form-control" />
    </div>
</div>
                                            <!-- Status Field (Radio buttons for active/inactive) -->
                                            <div class="row align-items-center mb-2">
                                                <div class="col-md-3">
                                                    <label class="form-label">Status</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="demo-inline-spacing">
                                                        
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="active" name="status" value="active" class="form-check-input" checked>
                                                            <label class="form-check-label fw-bolder" for="active">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="inactive" name="status" value="inactive" class="form-check-input">
                                                            <label class="form-check-label fw-bolder" for="inactive">Inactive</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                           
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
{{-- content --}}

{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        // Jab Batch Year select ho
        $('#batch_year').change(function () {
            var batchYear = $(this).val();
            $('#batch_name').html('<option value="" selected>-----Select Batch-----</option>'); // Reset batch dropdown
            $('#section').html('<option value="" selected>-----Select Section-----</option>'); // Reset section dropdown

            if (batchYear) {
                

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
console.log(batchName,batchYear);
            if (batchYear && batchName) {
                // AJAX call to fetch sections based on selected batch year and batch name
                $.ajax({
                    url: "{{ route('section.fetch') }}",  // Correct route to fetch sections
                    type: "POST",
                    data: { batch_year: batchYear, batch_name: batchName },
                    success: function (response) {
                        $('#section').empty().append('<option value="">Select Section</option>');
                        if (response.length > 0) {
                            // Agar sections hain toh unhe loop karke section dropdown me daalna hai
                            $.each(response, function (index, section) {
                                $('#section').append('<option value="'+section.name+'">'+section.name+'</option>');
                            });
                        } else {
                            // Agar koi section nahi hai
                            $('#section').append('<option value="">No Sections Available</option>');
                        }
                    }
                });
            }
        });
    });
</script>




@endsection
