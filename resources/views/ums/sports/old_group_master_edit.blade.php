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
                                            <!-- Group Name Field -->
                                           

                                            <!-- Section Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Section</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="section" name="section_name" class="form-control">
                                                        <option value="">Select Section</option>
                                                        @foreach($sections->pluck('name')->unique() as $section)
                                                            <option value="{{ $section}}" @if($group->section_name == $section) selected @endif>
                                                                {{ $section }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <!-- Year Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Year <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="batch_year" name="section_year" class="form-control">
                                                    @php
                                                    $selectedYear = isset($group) ? $group->section_name : null;
                                                    $sectionYears= App\Models\ums\Section::where('name', $group->section_name)->pluck('year')->unique();
                                                    @endphp

                                                    @foreach ($sectionYears as $year)
                                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <!-- Batch Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Batch Name<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="batch_name" name="section_batch" class="form-control">
                                                    @if (isset($group))
                                                    <option value="{{ $group->section_batch }}" selected>
                                                        {{ $group->section_batch }}
                                                    </option>
                                                    @endif
                                                       
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Group Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="group_name" value="{{ old('group_name', $group->group_name) }}" class="form-control" />
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







@endsection
