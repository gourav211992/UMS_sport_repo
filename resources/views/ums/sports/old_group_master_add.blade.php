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
                                                    <label class="form-label">Section</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="section" id="section" onchange="updateSectionDetails()">
                                                        <option value="" selected>-----Select-----</option>
                                                        @foreach ($section as $item)
                                                            <option value="{{ $item->id }}" data-name="{{ $item->name }}" data-year="{{ $item->year }}" data-batch="{{ $item->batch }}">{{ ucfirst($item->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Section Name (disabled) -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="batch_name" id="batch_name" class="form-control" disabled />
                                                </div>
                                            </div>
                                            
                                            <!-- Section Year (disabled) -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section Year <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="section_year" id="section_year" class="form-control" disabled />
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

<script>
    // This function is triggered when selecting a section
    function updateSectionDetails() {
        var sectionSelect = document.getElementById("section");
        var sectionId = sectionSelect.value;
        var batchInput = document.getElementById("batch_name");
        var sectionYearInput = document.getElementById("section_year");

        // Loop through the options to find the selected section
        for (var i = 0; i < sectionSelect.options.length; i++) {
            var option = sectionSelect.options[i];
            if (option.value == sectionId) {
                // Populate batch name and section year based on selected section
                batchInput.value = option.getAttribute("data-batch");
                sectionYearInput.value = option.getAttribute("data-year");
                break;
            }
        }
    }

    // This function is triggered when submitting the form
    function submitCat(form) {
        // Disabling the submit button while submitting
        form.querySelector('button[type="submit"]').disabled = true;

        // Get the value of the selected status radio button
        var status = document.querySelector('input[name="status"]:checked').value;

        // Set the status value before submitting the form
        document.getElementById('status').value = status;

        // Submit the form
        form.submit();
    }
</script>
@endsection
