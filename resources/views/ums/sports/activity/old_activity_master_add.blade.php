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
                @include('ums.admin.notifications')
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
                                                        <select class="form-select" name="sport_id">
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
                            
                                                                    <th>Shuddle<span class="text-danger"></span></th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>

                                                            {{-- <tbody id="sub-category-box">
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
                                                                            <input type="checkbox" name="subcategories[0][checkbox_status]" class="form-check-input" id="toggleCheckbox0" onclick="toggleDropdown0()" value="1">
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
                                                                        <a href="#"
                                                                            class="text-primary add-address"><i
                                                                                data-feather="plus-square"></i></a>
                                                                    </td>
                                                                </tr>
                                                            </tbody> --}}
                                                            
                                                            <tbody id="sub-category-box">
                                                                <!-- Template Row (hidden by default) -->
                                                                <tr class="sub-category-template" >
                                                                    <td class="row-number">1</td>
                                                                    <td><input type="text" name="subcategories[0][name]" class="form-control mw-100" placeholder="Enter Sub Activity Name" /></td>
                                                                    <td><input type="number" name="subcategories[0][duration]" class="form-control mw-100" placeholder="Enter Sub Activity Duration" /></td>
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
                                                                        <a href="#" class="text-primary add-address"><i data-feather="plus-square"></i></a>
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();

            let subCategoryIndex = 1;

            document.getElementById('cat_form').addEventListener('submit', function(e) {
                let activityName = document.querySelector('input[name="activity_name"]');
                let durationMin = document.querySelector('input[name="duration_min"]');
                let subActivity = document.querySelectorAll('.parameter-input');
                let isValid = true;

                if (activityName.value.trim() === '') {
                    isValid = false;
                    activityName.classList.add('is-invalid');
                    if (!document.querySelector('#activity-name-error')) {
                        let errorMsg = document.createElement('div');
                        errorMsg.id = 'activity-name-error';
                        errorMsg.classList.add('text-danger');
                        errorMsg.textContent = 'required.';
                        activityName.parentElement.appendChild(errorMsg);
                    }
                }

                if (durationMin.value.trim() === '' || isNaN(durationMin.value.trim())) {
                    isValid = false;
                    durationMin.classList.add('is-invalid');
                    if (!document.querySelector('#duration-error')) {
                        let errorMsg = document.createElement('div');
                        errorMsg.id = 'duration-error';
                        errorMsg.classList.add('text-danger');
                        errorMsg.textContent = 'required.';
                        durationMin.parentElement.appendChild(errorMsg);
                    }
                }

                if (subActivity.value && subActivity.value.trim() === '') {
                    isValid = false;
                    subActivity.classList.add('is-invalid');
                    if (!document.querySelector('#subactivity-name-error')) {
                        let errorMsg = document.createElement('div');
                        errorMsg.id = 'activity-name-error';
                        errorMsg.classList.add('text-danger');
                        errorMsg.textContent = 'required.';
                        subActivity.parentElement.appendChild(errorMsg);
                    }
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            document.querySelector('input[name="activity_name"]').addEventListener('input', function() {
                this.classList.remove('is-invalid');
                document.querySelector('#activity-name-error')?.remove();
            });

            document.querySelector('input[name="duration_min"]').addEventListener('input', function() {
                this.classList.remove('is-invalid');
                document.querySelector('#duration-error')?.remove();
            });
            
            // Check if sub_activities input exists before adding event listener
            const subActivitiesInput = document.querySelector('input[name="sub_activities"]');
            if (subActivitiesInput) {
                subActivitiesInput.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                    document.querySelector('#duration-error')?.remove();
                });
            }
        });
    </script>

    <script>
        function toggleDropdown0() {
            const checkbox = document.getElementById("toggleCheckbox0");
            const dropdown = document.getElementById("dropdown0");
            
            // Show dropdown if checkbox is checked
            if (checkbox.checked) {
                dropdown.style.display = "inline-block";
            } else {
                dropdown.style.display = "none";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Feather icons
            feather.replace();

            let subCategoryIndex = 1;

            // Add new subcategory row when the plus icon is clicked
            document.querySelector('#sub-category-box').addEventListener('click', function(e) {
                if (e.target.closest('.add-address')) {
                    e.preventDefault();

                    // Get the input values from the current row
                    let subCategoryNameField = document.querySelector(
                        '.sub-category-template input[name="subcategories[0][name]"]');
                    let subCategoryDurationField = document.querySelector(
                        '.sub-category-template input[name="subcategories[0][duration]"]');

                    let subCategoryName = subCategoryNameField.value.trim();
                    let subCategoryDuration = subCategoryDurationField.value.trim();

                    if (subCategoryName === "" || subCategoryDuration === "") {
                        alert("Please enter both subcategory name and duration.");
                        return;
                    }

                    // Create a new row to display the filled subcategory and duration
                    let newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td>${subCategoryIndex + 1}</td>
                        <td><input type="text" name="subcategories[${subCategoryIndex}][name]" class="form-control mw-100" value="${subCategoryName}" /></td>
                        <td><input type="number" name="subcategories[${subCategoryIndex}][duration]" class="form-control mw-100" value="${subCategoryDuration}" /></td>
                        <td>
                            <div class="d-flex justify-content-around"> 
                                <div class="form-check">
                                    <input type="hidden" name="subcategories[${subCategoryIndex}][checkbox_status]" class="form-check-input" value="0">
                                    <input type="checkbox" name="subcategories[${subCategoryIndex}][checkbox_status]" class="form-check-input" id="toggleCheckbox${subCategoryIndex}" onclick="toggleDropdown${subCategoryIndex}()" value="1" checked>
                                </div>
                                <div> 
                                    <select id="dropdown${subCategoryIndex}" class="form-control text-dark mw-100" name="subcategories[${subCategoryIndex}][condition_status]" style="display: inline-block;">
                                        <option value="">---Select---</option>
                                        <option value="fresh">Fresh</option>
                                        <option value="used">Used</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td><a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a></td>
                    `;

                    // Append the new row to the table body
                    document.querySelector('#sub-category-box').preappend(newRow);

                    // Create toggle function for this specific row
                    window[`toggleDropdown${subCategoryIndex}`] = function() {
                        const checkbox = document.getElementById(`toggleCheckbox${subCategoryIndex}`);
                        const dropdown = document.getElementById(`dropdown${subCategoryIndex}`);
                        
                        // Show dropdown if checkbox is checked
                        if (checkbox.checked) {
                            dropdown.style.display = "inline-block";
                        } else {
                            dropdown.style.display = "none";
                        }
                    };

                    // Reinitialize Feather icons for the new row
                    feather.replace();

                    // Clear the input fields and focus on the name field for the next entry
                    subCategoryNameField.value = '';
                    subCategoryDurationField.value = '';
                    subCategoryNameField.focus();

                    // Increment the index for the next subcategory
                    subCategoryIndex++;
                }
            });

            // Delete a subcategory row when the delete button is clicked
            document.querySelector('#sub-category-box').addEventListener('click', function(e) {
                if (e.target.closest('.delete-row')) {
                    e.preventDefault();

                    // Remove the row
                    let row = e.target.closest('tr');
                    row.remove();

                    // Re-index the rows
                    let rows = document.querySelectorAll('#sub-category-box tr');
                    rows.forEach((row, index) => {
                        row.querySelector('td:first-child').textContent = index + 1; // Update the row number
                    });

                    // Update subCategoryIndex based on the remaining rows
                    subCategoryIndex = rows.length;
                }
            });
        });
    </script> --}}

{{-- 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            feather.replace();
    
            let subCategoryIndex = 1;
    
            // Add row on plus icon click
            $('#sub-category-box').on('click', '.add-address', function (e) {
                e.preventDefault();
    
                let $templateRow = $('.sub-category-template').first().clone();
    
                // Clear input values
                $templateRow.find('input[type="text"], input[type="number"]').val('');
                $templateRow.find('input[type="checkbox"]').prop('checked', false);
                $templateRow.find('select').val('').hide();
    
                // Remove any old errors
                $templateRow.find('.text-danger').remove();
    
                // Update name and id attributes for cloned row
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
    
                // Set new onclick toggle function for checkbox to show/hide dropdown
                const newCheckboxId = `toggleCheckbox${subCategoryIndex}`;
                const newDropdownId = `dropdown${subCategoryIndex}`;
    
                $templateRow.find('input[type="checkbox"]').off('click').on('click', function () {
                    const isChecked = $(this).is(':checked');
                    $(`#${newDropdownId}`).toggle(isChecked);
                });
    
                // Change last <td> to delete icon for newly cloned rows
                $templateRow.find('td:last').html(`
                    <a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>
                `);
    
                // Append and update row number
                $('#sub-category-box').append($templateRow);
                updateRowNumbers();
    
                feather.replace(); // Refresh icons
                subCategoryIndex++;
            });
    
            // Delete row on trash icon click
            $('#sub-category-box').on('click', '.delete-row', function (e) {
                e.preventDefault();
                $(this).closest('tr').remove();
                updateRowNumbers();
                subCategoryIndex = $('#sub-category-box tr').length;
            });
    
            // Handle checkbox toggle for initial row
            $('#toggleCheckbox0').on('click', function () {
                $('#dropdown0').toggle(this.checked);
            });
    
            // Re-index row numbers
            function updateRowNumbers() {
                $('#sub-category-box tr').each(function (i) {
                    $(this).find('.row-number').text(i + 1);
                });
            }
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            feather.replace();
    
            let subCategoryIndex = 1;
    
            // Add row on plus icon click
            $('#sub-category-box').on('click', '.add-address', function (e) {
                e.preventDefault();
    
                let $templateRow = $('.sub-category-template').first().clone();
    
                // Clear input values
                $templateRow.find('input[type="text"], input[type="number"]').val('');
                $templateRow.find('input[type="checkbox"]').prop('checked', false);
                $templateRow.find('select').val('').hide();
    
                // Remove any old errors
                $templateRow.find('.text-danger').remove();
    
                // Update name and id attributes for cloned row
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
    
                // Set new onclick toggle function for checkbox to show/hide dropdown
                const newCheckboxId = `toggleCheckbox${subCategoryIndex}`;
                const newDropdownId = `dropdown${subCategoryIndex}`;
    
                // Handle checkbox toggle for each row individually
                $templateRow.find('input[type="checkbox"]').off('click').on('click', function () {
                    const isChecked = $(this).is(':checked');
                    $(`#${newDropdownId}`).toggle(isChecked);
                });
    
                // Change last <td> to delete icon for newly cloned rows
                $templateRow.find('td:last').html(`
                    <a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>
                `);
    
                // Append and update row number
                $('#sub-category-box').append($templateRow);
                updateRowNumbers();
    
                feather.replace(); // Refresh icons
                subCategoryIndex++;
            });
    
            // Delete row on trash icon click
            $('#sub-category-box').on('click', '.delete-row', function (e) {
                e.preventDefault();
                $(this).closest('tr').remove();
                updateRowNumbers();
                subCategoryIndex = $('#sub-category-box tr').length;
            });
    
            // Handle checkbox toggle for initial row
            $('#toggleCheckbox0').on('click', function () {
                $('#dropdown0').toggle(this.checked);
            });
    
            // Re-index row numbers
            function updateRowNumbers() {
                $('#sub-category-box tr').each(function (i) {
                    $(this).find('.row-number').text(i + 1);
                });
            }
        });
    </script>
    
   
@endsection