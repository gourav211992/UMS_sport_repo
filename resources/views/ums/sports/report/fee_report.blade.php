@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-5 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Fee Report</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Apply the Basic Filter</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                <div class="form-group breadcrumb-right">
                    <form id="feeReportForm" action="{{ route('fee.report.print') }}" method="POST" novalidate>
                        @csrf
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter"
                            data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i data-feather="printer"></i> Get Report
                        </button>
                </div>
            </div>
        </div>
        <div class="content-body">

            <section id="basic-datatable">
                <div class="card border overflow-hidden">
                    <div class="row">
                        <!-- Filter Box -->
                        <div class="col-md-12 bg-light border-bottom mb-1 po-reportfileterBox">
                            <div class="row pofilterhead action-button align-items-center">
                                <div class="col-md-4">
                                    <h3></h3>
                                </div>

                            </div>

                            <div class="customernewsection-form poreportlistview p-1">



                                <div class="row">
                                    <!-- Batch -->

                                    <div class="col-md">
                                        <label class="form-label" for="batch_name">Batch
                                            @error('batch_name')
                                            <span class="text-danger">*</span>
                                            @enderror
                                        </label>
                                        <select class="form-select @error('batch_name') is-invalid @enderror"
                                            name="batch_name" id="batch_name">
                                            <option value="">Select</option>
                                            <option value="all" {{ old('batch_name') == 'all' ? 'selected' : '' }}>
                                                All</option>
                                            @foreach ($batches as $batch)
                                            <option value="{{ $batch->id }}"
                                                {{ old('batch_name') == $batch->id ? 'selected' : '' }}>
                                                {{ $batch->batch_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('batch_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <!-- Section -->
                                    <div class="col-md">
                                        <label class="form-label">Section</label>
                                        <select class="form-select" name="section" id="section">
                                            <option value="">Select</option>
                                        </select>
                                    </div>

                                    <!-- Quota -->
                                    <div class="col-md">
                                        <label class="form-label">Quota</label>
                                        <select class="form-select" name="quota" id="quota">
                                            <option value="">Select</option>
                                            @foreach ($quotas as $quota)
                                            <option value="{{ $quota->id }}">{{ $quota->quota_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Start & End Date (optional) -->
                                    <div class="col-md">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" name="start_date"
                                            value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date"
                                            value="{{ request('end_date') }}">
                                    </div>


                                </div>

                                <!-- Submit -->


                            </div>
                        </div>

                        <!-- Table -->


                    </div>
                </div>
            </section>
        </div>
    </div>
    </form>
</div>

<!-- END: Content-->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#batch_name').change(function() {
            var sectionName = $('#section').val();
            var batchName = $(this).val();
            $('#section').html('<option value="" selected>-----Select Section-----</option>');

            if (batchName) {
                $.ajax({
                    url: "{{ route('get.batch.section.fee.report') }}",
                    type: "POST",
                    data: {

                        batch_name: batchName,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            $.each(response, function(index, item) {
                                $('#section').append('<option value="' + item.id +
                                    '">' + item.name + '</option>');
                            });
                            $('#section').prop('disabled', false);
                        } else {
                            $('#section').prop('disabled', true);
                        }
                    }
                });
            } else {
                $('#section').prop('disabled', true);
            }
        });
    })
</script>

<script>
    // Bootstrap 5 custom validation script
    (() => {
        'use strict'
        const form = document.querySelector('#feeReportForm')

        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })()
</script>
@endsection