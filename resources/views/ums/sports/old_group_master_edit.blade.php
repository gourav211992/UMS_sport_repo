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
            @method('PUT') <!-- Method spoofing to use PUT for update -->
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Group Name Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Group Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="group_name" value="{{ old('group_name', $group->group_name) }}" class="form-control" />
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
                                                        @foreach ($section as $items)
                                                            <option value="{{ $items->id }}" 
                                                                @if($group->section_id == $items->id) selected @endif
                                                                data-batch="{{ $items->batch }}" 
                                                                data-year="{{ $items->year }}">
                                                                {{ ucfirst($items->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Batch Name Field (Disabled) -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Name</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="batch_name" id="batch_name" value="{{ old('batch_name', $group->section_batch) }}" class="form-control" disabled />
                                                </div>
                                            </div>

                                            <!-- Section Year Field (Disabled) -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section Year</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="section_year" id="section_year" value="{{ old('section_year', $group->section_year) }}" class="form-control" disabled />
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

<script>
    // This function is triggered when selecting a section
    function updateSectionDetails() {
        var sectionSelect = document.getElementById("section");
        var sectionId = sectionSelect.value;
        var batchInput = document.getElementById("batch_name");
        var yearInput = document.getElementById("section_year");

        // Loop through the options to find the selected section
        for (var i = 0; i < sectionSelect.options.length; i++) {
            var option = sectionSelect.options[i];
            if (option.value == sectionId) {
                // Populate batch and year fields
                batchInput.value = option.getAttribute("data-batch");
                yearInput.value = option.getAttribute("data-year");
                break;
            }
        }
    }

    // Trigger the function on page load if a section is already selected
    document.addEventListener("DOMContentLoaded", function() {
        updateSectionDetails();
    });
</script>

@endsection
