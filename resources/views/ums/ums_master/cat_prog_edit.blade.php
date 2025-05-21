@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
    <form action="{{ route('cat-prog-doc.update', $categoryProgDoc->id) }}" method="POST">
        @csrf
        @method('PUT')
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
                                            {{-- <li class="breadcrumb-item active">Edit</li> --}}
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                            <div class="form-group breadcrumb-right">
                                <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                                    <i data-feather="arrow-left-circle"></i> Back</button>
                                <button type="submit" data-bs-toggle="modal" data-bs-target="#disclaimer" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                                    <i data-feather="check-circle"></i> Submit</button>
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
                                                        <select class="form-select" name="document_category_id" required>
                                                            @foreach ($documents as $document)
                                                                <option value="{{ $document->id }}" {{ $categoryProgDoc->document_category_id == $document->id ? 'selected' : '' }}>
                                                                    {{ $document->document_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Course -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Course <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="course_id" required>
                                                            @foreach ($courses as $course)
                                                                <option value="{{ $course->id }}" {{ $categoryProgDoc->course_id == $course->id ? 'selected' : '' }}>
                                                                    {{ $course->course_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Cat. Programe Doc Code -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Cat. Programe Doc Code <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="cat_prog_doc_code" value="{{ $categoryProgDoc->cat_prog_doc_code }}" required />
                                                    </div>
                                                </div>

                                                <!-- Cat. Programe Doc Name -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Cat. Programe Doc Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="cat_prog_doc_name" value="{{ $categoryProgDoc->cat_prog_doc_name }}" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 border-start">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3" name="status" class="form-check-input" value="Active" {{ $categoryProgDoc->status == 'Active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25 me-0">
                                                                <input type="radio" id="customColorRadio4" name="status" class="form-check-input" value="Inactive" {{ $categoryProgDoc->status == 'Inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="30">#</th>
                                                                    <th>Document Name</th>
                                                                    <th>Required</th>
                                                                    <th>Type</th>
                                                                </tr>
                                                            </thead>
                                                            {{-- <tbody>
                                                                @php
                                                                    $docs = [
                                                                        'Aadhar Card',
                                                                        '12th Marksheet',
                                                                        'Pan Card',
                                                                        'Cancel Cheque',
                                                                        '10th Marksheet',
                                                                    ];
                                                                @endphp
                                                                @foreach ($documentDetails as $index => $documentDetail)
                                                                    <tr>
                                                                        <td class="poprod-decpt">{{ $index + 1 }}</td>
                                                                        <td class="poprod-decpt"><strong>{{ $docs[$index] ?? 'Unknown' }}</strong></td>
                                                                        <td>{{ $documentDetail['required'] ?? '' }}</td>
                                                                        <td>
                                                                            <div class="demo-inline-spacing">
                                                                                <div class="form-check form-check-primary mt-25">
                                                                                    <input type="radio" id="Orginal_{{ $index }}" name="document_details[{{ $index }}][required]" class="form-check-input" value="Yes" {{ isset($documentDetail['required']) && $documentDetail['required'] == 'Yes' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label fw-bolder" for="Orginal_{{ $index }}">Original</label>
                                                                                </div>
                                                                                <div class="form-check form-check-primary mt-25">
                                                                                    <input type="radio" id="Photocopy_{{ $index }}" name="document_details[{{ $index }}][required]" class="form-check-input" value="No" {{ isset($documentDetail['required']) && $documentDetail['required'] == 'No' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label fw-bolder" for="Photocopy_{{ $index }}">Photocopy</label>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody> --}}
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
    @foreach ($documentDetails as $index => $documentDetail)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td><strong>{{ $docs[$index] ?? 'Unknown' }}</strong></td>
            <td>
                <select name="document_details[{{ $index }}][required]" class="form-select document-required" data-index="{{ $index }}">
                    <option value="">Select</option>
                    <option value="Yes" {{ isset($documentDetail['required']) && $documentDetail['required'] == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ isset($documentDetail['required']) && $documentDetail['required'] == 'No' ? 'selected' : '' }}>No</option>
                </select>
            </td>
            <td>
                <div class="demo-inline-spacing">
                    <div class="form-check form-check-primary mt-25">
                        <input type="radio" id="original_{{ $index }}" name="document_details[{{ $index }}][type]" value="Original"
                            class="form-check-input document-type"
                            {{ isset($documentDetail['type']) && $documentDetail['type'] == 'Original' ? 'checked' : '' }}>
                        <label class="form-check-label" for="original_{{ $index }}">Original</label>
                    </div>
                    <div class="form-check form-check-primary mt-25">
                        <input type="radio" id="photocopy_{{ $index }}" name="document_details[{{ $index }}][type]" value="Photocopy"
                            class="form-check-input document-type"
                            {{ isset($documentDetail['type']) && $documentDetail['type'] == 'Photocopy' ? 'checked' : '' }}>
                        <label class="form-check-label" for="photocopy_{{ $index }}">Photocopy</label>
                    </div>
                </div>
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
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function toggleDocumentTypeFields(index, isEnabled) {
            let original = $(`#original_${index}`);
            let photocopy = $(`#photocopy_${index}`);

            if (isEnabled) {
                original.prop('disabled', false);
                photocopy.prop('disabled', false);
            } else {
                original.prop('disabled', true).prop('checked', false);
                photocopy.prop('disabled', true).prop('checked', false);
            }
        }

        $('.document-required').each(function () {
            let index = $(this).data('index');
            toggleDocumentTypeFields(index, $(this).val() === 'Yes');
        });

        $('.document-required').on('change', function () {
            let index = $(this).data('index');
            toggleDocumentTypeFields(index, $(this).val() === 'Yes');
        });
    });
</script>

@endsection
