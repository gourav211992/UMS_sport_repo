@extends('ums.admin.admin-meta')
@section('content') 
    <form action="{{ route('category-prog-doc.store') }}" method="POST" id="categoryForm">
        @csrf
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header pocreate-sticky">
                    <div class="row">
                        <div class="content-header-left col-md-6 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-start mb-0">Category Program Document</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('cat-prog-doc.index')}}">Home</a></li>
                                            <li class="breadcrumb-item active">Add New</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                            <div class="form-group breadcrumb-right">
                                <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button>
                                <button type="submit" data-bs-toggle="modal" data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button>
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
                                            <div class="col-md-8">
                                                <!-- Document Category -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Document Category <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select name="document_category_id" class="form-select" id="document_category">
                                                            <option value="">Select</option>
                                                            @foreach ($documents as $doc)
                                                                <option value="{{ $doc->id }}">{{$doc->document_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback" id="document_category_error">required.</div>
                                                    </div>
                                                </div>

                                                <!-- Course -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Course <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select name="course_id" class="form-select" id="course_id">
                                                            <option value="">Select</option>
                                                            @foreach ($courses as $course)
                                                                <option value="{{ $course->id }}">{{$course->course_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback" id="course_id_error">required.</div>
                                                    </div>
                                                </div>

                                                <!-- Cat. Programe Doc Code -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Cat. Programe Doc Code <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="cat_prog_doc_code" id="cat_prog_doc_code" class="form-control" />
                                                        <div class="invalid-feedback" id="cat_prog_doc_code_error">required.</div>
                                                    </div>
                                                </div>

                                                <!-- Cat. Programe Doc Name -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Cat. Programe Doc Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="cat_prog_doc_name" id="cat_prog_doc_name" class="form-control"/>
                                                        <div class="invalid-feedback" id="cat_prog_doc_name_error">required.</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 border-start">
                                                <!-- Status -->
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="status_active" name="status" value="Active" class="form-check-input" checked>
                                                                <label class="form-check-label" for="status_active">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="status_inactive" name="status" value="Inactive" class="form-check-input">
                                                                <label class="form-check-label" for="status_inactive">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Document Required Section -->
                                        <div class="border-bottom mb-2 mt-2 pb-25">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="newheader">
                                                        <h4 class="card-title text-theme">Document Required</h4>
                                                        <p class="card-text">View the details</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Document Table -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad">
                                                        <thead>
                                                            <tr>
                                                                <th width="30">#</th>
                                                                <th>Document Name</th>
                                                                <th>Required</th>
                                                                <th>Type</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $docs = [
                                                                    'Aadhar Card',
                                                                    '12th Marksheet',
                                                                    'Pan Card',
                                                                    'Cancel Cheque',
                                                                    '10th Marksheet',
                                                                ];
                                                            @endphp
                                                            @foreach ($docs as $index => $doc)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td><strong>{{ $doc }}</strong></td>
                                                                    <td>
                                                                        <select name="document_details[{{ $index }}][required]" class="form-select" id="document_required_{{ $index }}">
                                                                            <option value="">Select</option>
                                                                            <option value="Yes">Yes</option>
                                                                            <option value="No">No</option>
                                                                        </select>
                                                                        <div class="invalid-feedback" id="document_required_{{ $index }}_error"> required</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="demo-inline-spacing">
                                                                            <div class="form-check form-check-primary mt-25">
                                                                                <input type="radio" id="original_{{ $index }}" name="document_details[{{ $index }}][type]" value="Original" class="form-check-input" disabled>
                                                                                <label class="form-check-label" for="original_{{ $index }}">Original</label>
                                                                            </div>
                                                                            <div class="form-check form-check-primary mt-25">
                                                                                <input type="radio" id="photocopy_{{ $index }}" name="document_details[{{ $index }}][type]" value="Photocopy" class="form-check-input" disabled>
                                                                                <label class="form-check-label" for="photocopy_{{ $index }}">Photocopy</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="invalid-feedback" id="document_type_{{ $index }}_error">required</div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
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
    </form>
    <!-- Form End -->

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.invalid-feedback').hide();

        $('#categoryForm').on('submit', function (e) {
            e.preventDefault();  

            let isValid = true;

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').hide();

            if ($('#document_category').val() === '') {
                isValid = false;
                $('#document_category').addClass('is-invalid');
                $('#document_category_error').show();
            }

            if ($('#course_id').val() === '') {
                isValid = false;
                $('#course_id').addClass('is-invalid');
                $('#course_id_error').show();
            }

            if ($('#cat_prog_doc_code').val().trim() === '') {
                isValid = false;
                $('#cat_prog_doc_code').addClass('is-invalid');
                $('#cat_prog_doc_code_error').show();
            }

            if ($('#cat_prog_doc_name').val().trim() === '') {
                isValid = false;
                $('#cat_prog_doc_name').addClass('is-invalid');
                $('#cat_prog_doc_name_error').show();
            }

            $('table tbody tr').each(function (index) {
                let requiredSelect = $(this).find(`#document_required_${index}`);
                let docTypeRadios = $(this).find(`input[name="document_details[${index}][type]"]`);

                if (requiredSelect.val() === '') {
                    isValid = false;
                    requiredSelect.addClass('is-invalid');
                    $(`#document_required_${index}_error`).show();
                }

                if (requiredSelect.val() === 'Yes') {
                    docTypeRadios.prop('disabled', false);

                    if (!docTypeRadios.is(':checked')) {
                        isValid = false;
                        $(`#document_type_${index}_error`).show();
                    }
                } else {
                    docTypeRadios.prop('disabled', true).prop('checked', false);
                    $(`#document_type_${index}_error`).hide();
                }
            });

            if (isValid) {
                this.submit();
            }
        });

        $('select[id^="document_required_"]').on('change', function () {
            let index = $(this).attr('id').split('_')[2];
            let selectedValue = $(this).val();

            let originalRadio = $(`#original_${index}`);
            let photocopyRadio = $(`#photocopy_${index}`);

            if (selectedValue === 'Yes') {
                originalRadio.prop('disabled', false).prop('checked', false);
                photocopyRadio.prop('disabled', false).prop('checked', false);
            } else {
                originalRadio.prop('disabled', true).prop('checked', false);
                photocopyRadio.prop('disabled', true).prop('checked', false);
            }
        });

        // Trigger change manually to apply correct state on page load
        $('select[id^="document_required_"]').trigger('change');
    });
</script>

@endsection
