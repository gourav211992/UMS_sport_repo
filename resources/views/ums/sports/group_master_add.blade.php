@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
{{-- content --}}
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-6 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Group Master Add</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">Add New</li>
                            </ol>
                        </div>
                    </div>
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
                                            <!-- Group Name Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Group Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="group_name" class="form-control" />
                                                </div>
                                            </div>

                                            <!-- Section Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="section" name="section_name" class="form-control">
                                                        <option value="">Select Section</option>
                                                        @foreach($sections as $section)
                                                        <option value="{{ $section->name }}">{{ $section->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Batch Field -->
                                         

                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-select" name="section_year" id="batch_year">
                                                    <option value="" selected>-----Select Year-----</option>
                                                </select>

                                            </div>
                                        </div>



                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Batch Name<span
                                                        class="text-danger">*</span></label>
                                            </div>

                                            <div class="col-md-5">
                                                <select class="form-select" name="section_batch" id="batch_name">
                                                    <option value="" selected>-----Select Batch-----</option>
                                                </select>
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

                                            <!-- Hidden Field for Status Value -->
                                            <input type="hidden" id="status" name="status">

                                            <!-- Submit Button -->
                                            <div class="mt-3">
                                                <button type="submit" onclick="submitCat(this.form)" class="btn btn-primary btn-sm ms-1">
                                                    <i data-feather="check-circle"></i> Create
                                                </button>
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
<script
    src="https://code.jquery.com/jquery-3.7.1.min.js">
</script>


<script>
   $(document).ready(function () {
        // Fetch Batch Years on Section Select
        $('#section').change(function () {
            var sectionName = $(this).val();
            $('#batch_year').html('<option value="" selected>-----Select Year-----</option>');
            $('#batch_name').html('<option value="" selected>-----Select Batch-----</option>');

            if (sectionName) {
                $.ajax({
                    url: "{{ route('get.batch.year') }}",
                    type: "POST",
                    data: {
                        section_name: sectionName,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.length > 0) {
                            $.each(response, function (index, item) {
                                $('#batch_year').append('<option value="' + item    + '">' + item + '</option>');
                            });
                            $('#batch_year').prop('disabled', false);
                        } else {
                            $('#batch_year').prop('disabled', true);
                        }
                    }
                });
            } else {
                $('#batch_year').prop('disabled', true);
                $('#batch_name').prop('disabled', true);
            }
        });

        // Fetch Batch Names on Year Select
        $('#batch_year').change(function () {
            var sectionName = $('#section').val();
            var batchYear = $(this).val();
            $('#batch_name').html('<option value="" selected>-----Select Batch-----</option>');

            if (sectionName && batchYear) {
                $.ajax({
                    url: "{{ route('get.batch.names') }}",
                    type: "POST",
                    data: {
                        section_name: sectionName,
                        batch_year: batchYear,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.length > 0) {
                            $.each(response, function (index, item) {
                                $('#batch_name').append('<option value="' + item.batch + '">' + item.batch + '</option>');
                            });
                            $('#batch_name').prop('disabled', false);
                        } else {
                            $('#batch_name').prop('disabled', true);
                        }
                    }
                });
            } else {
                $('#batch_name').prop('disabled', true);
            }
        });
    });
</script>
<script>
    function submitCat(form) {
        form.querySelector('button[type="submit"]').disabled = true;

        var status = document.querySelector('input[name="status"]:checked').value;

        document.getElementById('status').value = status;

        form.submit();
    }

    $('.alphaOnly').keyup(function() {
        this.value = this.value.replace(/[^a-z|A-Z\.]/g, '');
    });
</script>


@endsection