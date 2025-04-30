@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header pocreate-sticky">
                <div class="row">
                    <div class="content-header-left col-md-6 mb-2">
                        <h2 class="content-header-title float-start mb-0">Activity Master</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">Add New</li>
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

            <form id="cat_form" method="POST" action="{{ route('activity-master-add') }}">
                @csrf
                <div class="content-body">
                    <section id="basic-datatable">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <!-- Sport Master Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Sport Master <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select class="form-select" name="sport_id" id="sport_id">
                                                            <option value="">--Select Sport</option>
                                                            @foreach ($sportName as $name)
                                                                <option value="{{ $name->id }}">
                                                                    {{ ucfirst($name->sport_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Activity Name Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Activity Name <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="activity_name" class="form-control"
                                                            value="{{ old('activity_name') }}" />
                                                        @error('activity_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Activity Duration Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label"> Activity Duration (In Mins) <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="number" name="duration_min" class="form-control"
                                                            value="{{ old('duration_min') }}" />
                                                        @error('duration_min')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="hidden" id="sub_activity">
                                                
                                                <!-- Description Field -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Description</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" name="description" class="form-control"
                                                            value="{{ old('description') }}" />
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
                                                                <input type="radio" id="active" name="status"
                                                                    value="active" class="form-check-input" checked>
                                                                <label class="form-check-label fw-bolder"
                                                                    for="active">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="inactive" name="status"
                                                                    value="inactive" class="form-check-input">
                                                                <label class="form-check-label fw-bolder"
                                                                    for="inactive">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Sub Activity Table -->
                                                <div class="col-md-12">
                                                    <div class="table-responsive-md">
                                                        <table
                                                            class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.NO</th>
                                                                    <th>Sub Activity Name<span class="text-danger">*</span>
                                                                    </th>
                                                                    <th>Duration(min)<span class="text-danger">*</span></th>
                                                                    <th>Shuttle<span class="text-danger"></span></th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="sub-category-box">
                                                                <tr class="sub-category-template">
                                                                    <td class="row-number">1</td>
                                                                    <td><input type="text"
                                                                            name="subcategories[0][name]"
                                                                            class="form-control mw-100"
                                                                            placeholder="Enter Sub Activity Name" /></td>
                                                                    <td><input type="number"
                                                                            name="subcategories[0][duration]"
                                                                            class="form-control mw-100"
                                                                            placeholder="Enter Sub Activity Duration" />
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex justify-content-around">
                                                                            <div class="form-check">
                                                                                <input type="hidden" name="subcategories[0][checkbox_status]" class="form-check-input" value="0">
                                                                                <input type="checkbox" name="subcategories[0][checkbox_status]" class="form-check-input" id="toggleCheckbox0" value="1">
                                                                            </div>
                                                                            <div>
                                                                                <select id="dropdown0" class="form-control text-dark mw-100" name="subcategories[0][condition_status]" style="display: none;">
                                                                                    <option value="">---Select---</option>
                                                                                    <option value="fresh">Fresh</option>
                                                                                    <option value="used">Used</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="text-primary add-address"><i
                                                                                data-feather="plus-square"></i></a>
                                                                    </td>
                                                                </tr>
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
            </form>
        </div>
    </div>

    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
     
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            feather.replace();

            let subCategoryIndex = 1;

            // Add new row
            $('#sub-category-box').on('click', '.add-address', function (e) {
                e.preventDefault();

                let $templateRow = $('.sub-category-template').first().clone();

                $templateRow.find('input[type="text"], input[type="number"]').val('');
                $templateRow.find('input[type="checkbox"]').prop('checked', false);
                $templateRow.find('select').val('').hide();
                $templateRow.find('.text-danger.validation-error').remove();

                $templateRow.find('input, select').each(function () {
                    const attrName = $(this).attr('name');
                    if (attrName) {
                        $(this).attr('name', attrName.replace(/\[\d+]/, `[${subCategoryIndex}]`));
                    }

                    const attrId = $(this).attr('id');
                    if (attrId?.includes('toggleCheckbox')) {
                        $(this).attr('id', `toggleCheckbox${subCategoryIndex}`);
                    }

                    if ($(this).is('select')) {
                        $(this).attr('id', `dropdown${subCategoryIndex}`);
                    }
                });

                const newDropdownId = `dropdown${subCategoryIndex}`;
                $templateRow.find('input[type="checkbox"]').off('click').on('click', function () {
                    const isChecked = $(this).is(':checked');
                    $(`#${newDropdownId}`).toggle(isChecked);
                });

                $templateRow.find('td:last').html(`
                    <a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>
                `);

                $('#sub-category-box').append($templateRow);
                updateRowNumbers();
                feather.replace();
                subCategoryIndex++;
            });

            // Delete row
            $('#sub-category-box').on('click', '.delete-row', function (e) {
                e.preventDefault();
                $(this).closest('tr').remove();
                updateRowNumbers();
                subCategoryIndex = $('#sub-category-box tr').length;
            });

            $('#toggleCheckbox0').on('click', function () {
                $('#dropdown0').toggle(this.checked);
            });

            function updateRowNumbers() {
                $('#sub-category-box tr').each(function (i) {
                    $(this).find('.row-number').text(i + 1);
                });
            }

            // Form validation
            $('#cat_form').on('submit', function (e) {
                let isValid = true;
                $('.text-danger.validation-error').remove();
                $('.is-invalid').removeClass('is-invalid');

                const activityName = $('input[name="activity_name"]');
                if (activityName.val().trim() === '') {
                    isValid = false;
                    activityName.addClass('is-invalid');
                    activityName.after('<div class="text-danger validation-error">Required.</div>');
                }

                const durationMin = $('input[name="duration_min"]');
                if (durationMin.val().trim() === '' || isNaN(durationMin.val())) {
                    isValid = false;
                    durationMin.addClass('is-invalid');
                    durationMin.after('<div class="text-danger validation-error">Required.</div>');
                }

                const sportSelect = $('select[name="sport_id"]');
                if (sportSelect.val().trim() === '') {
                    isValid = false;
                    sportSelect.addClass('is-invalid');
                    sportSelect.after('<div class="text-danger validation-error">Required.</div>');
                }

                $('#sub-category-box tr').each(function () {
                    const nameInput = $(this).find('input[name^="subcategories"][name$="[name]"]');
                    const durationInput = $(this).find('input[name^="subcategories"][name$="[duration]"]');

                    if (nameInput.val().trim() === '') {
                        isValid = false;
                        nameInput.addClass('is-invalid');
                        nameInput.after('<div class="text-danger validation-error">Required.</div>');
                    }

                    if (durationInput.val().trim() === '') {
                        isValid = false;
                        durationInput.addClass('is-invalid');
                        durationInput.after('<div class="text-danger validation-error">Required.</div>');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });

            $(document).on('input change', 'input, select', function () {
                $(this).removeClass('is-invalid');
                $(this).next('.validation-error').remove();
            });
        });
    </script>
@endsection
