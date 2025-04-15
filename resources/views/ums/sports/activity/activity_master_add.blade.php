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
                                                <div class="col-md-9">
                                                    <div class="table-responsive-md">
                                                        <table
                                                            class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.NO</th>
                                                                    <th>Sub Activity Name<span class="text-danger">*</span>
                                                                    </th>
                                                                    <th>Duration(min)<span class="text-danger">*</span></th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                         
                                                            {{-- <tbody id="parameter-table-body">
                                                                <!-- Always first row with + icon -->
                                                                <tr class="parameter-row add-template">
                                                                    <td class="sno">1</td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control parameter-input mw-100"
                                                                            placeholder="Enter Parameter Name" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            class="form-control parameter-duration mw-100"
                                                                            placeholder="Enter Parameter duration" />
                                                                    </td>
    
                                                                    <td>
                                                                        <a href="#" class="text-primary add-row"><i
                                                                                data-feather="plus-square"></i></a>
                                                                    </td>
                                                                </tr>
                                                            </tbody> --}}
                                                            <tbody id="sub-category-box">
                                                                <tr class="sub-category-template">
                                                                    <td class="row-number">1</td>
                                                                    <td><input type="text" name="subcategories[0][name]" class="form-control mw-100" placeholder="Enter Sub Activity Name" /></td>
                                                                    <td><input type="number" name="subcategories[0][duration]" class="form-control mw-100" placeholder="Enter Sub Activity Duration" /></td>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();

            let subCategoryIndex = 1;

            document.getElementById('cat_form').addEventListener('submit', function(e) {
                let activityName = document.querySelector('input[name="activity_name"]');
                let durationMin = document.querySelector('input[name="duration_min"]');
                let subActivity = document.querySelector('input[name="sub_activities"]');
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

                if (subActivity.value.trim() === '') {
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
            document.querySelector('input[name="sub_activities"]').addEventListener('input', function() {
                this.classList.remove('is-invalid');
                document.querySelector('#duration-error')?.remove();
            });
        });
    </script>
    		 
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize Feather icons
                feather.replace();
        
                let subCategoryIndex = 1;
        
                // Add new subcategory row when the plus icon is clicked
                document.querySelector('#sub-category-box').addEventListener('click', function (e) {
                    if (e.target.closest('.add-address')) {
                        e.preventDefault();
        
                        // Get the input values from the current row
                        let subCategoryNameField = document.querySelector('.sub-category-template input[name="subcategories[0][name]"]');
                        let subCategoryDurationField = document.querySelector('.sub-category-template input[name="subcategories[0][duration]"]');
        
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
                            <td><a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a></td>
                        `;
        
                        // Append the new row to the table body
                        document.querySelector('#sub-category-box').appendChild(newRow);
        
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
                document.querySelector('#sub-category-box').addEventListener('click', function (e) {
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
        </script>
@endsection
