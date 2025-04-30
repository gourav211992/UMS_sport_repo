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
                    <form id="myForm" method="POST" >
                    <button onClick="javascript: history.go(-1)" type="button" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                        <i data-feather="arrow-left-circle"></i> Back
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                        {{-- <a href="{{url('activity_master')}}"></a> --}}
                        <i data-feather="check-circle"></i> Submit
                    </button>
                </div>
            </div>
        </div>
         
           
            
            <div class="content-body">

                <div id="alertContainer"></div>
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
                                                    <label class="form-label">Sport Master <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="sport_id">
                                                        @foreach ($sportName as $name)
                                                            <option value="{{$name->id}}"{{($activity->sport_id==$name->id)?'selected':''}}>{{ ucfirst($name->sport_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Activity Name Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Activity Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="activity_name" class="form-control" value="{{ $activity->activity_name }}"/>
                                                </div>
                                            </div>

                                            <!-- Activity Duration Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label"> Activity Duration (In Mins) <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" name="duration_min" class="form-control"  value="{{ $activity->duration_min }}"/>    
                                                </div>
                                            </div>

                                            <!-- Description Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Description</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="description" class="form-control" value="{{ $activity->description }}" />    
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
                                                       <input type="radio" id="active" name="status" value="active" class="form-check-input" 
                                                           {{ $activity->status === 'active' ? 'checked' : '' }}>
                                                       <label class="form-check-label fw-bolder" for="active">Active</label>
                                                   </div>
                                                   <div class="form-check form-check-primary mt-25">
                                                       <input type="radio" id="inactive" name="status" value="inactive" class="form-check-input" 
                                                           {{ $activity->status === 'inactive' ? 'checked' : '' }}>
                                                       <label class="form-check-label fw-bolder" for="inactive">Inactive</label>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       

                                            <!-- Sub Activity Table -->
                                            <div class="col-md-9">
                                                <div class="table-responsive-md">
                                                    <table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable">
                                                        <thead>
                                                            <tr>
                                                                <th>S.NO</th>
                                                                <th>Sub Activity Name<span class="text-danger">*</span></th>
                                                                <th>Duration(min)<span class="text-danger">*</span></th>
                                                                <th>Shuttle<span class="text-danger">*</span></th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        {{-- @foreach ($sub_activity as $activity) --}}
{{-- 
                                                        <tbody id="sub-category-box">
                                                            <tr class="sub-category-template" style="display:none;">
                                                                <td class="row-number"></td>
                                                                <td><input type="text" name="subcategories[0][name]" class="form-control mw-100" placeholder="Enter Sub Activity Name" /></td>
                                                                <td><input type="number" name="subcategories[0][duration]" class="form-control mw-100" placeholder="Enter Sub Activity Duration" /></td>
                                                                <td>
                                                                    <a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>
                                                                </td>
                                                            </tr>
                                                        </tbody> --}}
                                                        <tbody id="parameter-table-body">
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
                                                                    <div class="d-flex justify-content-around"> 
                                                                    <div class="form-check">
                                                                        <input type="hidden" name="subcategories[0][checkbox_status]" value="0"> <!-- hidden input to send 0 if unchecked -->
                                                                
                                                                        <input type="checkbox" 
                                                                               name="subcategories[0][checkbox_status]" 
                                                                               class="form-check-input parameter-check" 
                                                                               id="toggleCheckbox" 
                                                                               onclick="toggleDropdown(0)" 
                                                                               value="1" 
                                                                               {{ old("subcategories.0.checkbox_status", $subcategory['checkbox_status'] ?? false) ? 'checked' : '' }}>
                                                                    </div>
                                                                <div> 
                                                                    <select id="dropdown" 
                                                                            class="form-control text-dark parameter-condition mw-100" 
                                                                            name="subcategories[0][condition_status]" 
                                                                            style="{{ old("subcategories.0.checkbox_status", $subcategory['checkbox_status'] ?? false) ? '' : 'display: none;' }}">
                                                                        <option value="">---Select---</option>
                                                                        <option value="fresh" {{ old("subcategories.0.condition_status", $subcategory['condition_status'] ?? '') == 'fresh' ? 'selected' : '' }}>Fresh</option>
                                                                        <option value="used" {{ old("subcategories.0.condition_status", $subcategory['condition_status'] ?? '') == 'used' ? 'selected' : '' }}>Used</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                </td>
                                                                
                                                                <td>
                                                                    <a href="#" class="text-primary add-row"><i
                                                                            data-feather="plus-square"></i></a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                        {{-- @endforeach --}}
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

            <input type="hidden" name="sub_activity" id="sub_activity">
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://unpkg.com/feather-icons"></script>
 
        <script>
            $(document).ready(function () {
                let parameterData = @json($sub_activity ?? []);
                let $tableBody = $('#parameter-table-body');
        
                // Populate first row with existing data
                if (parameterData.length > 0) {
                    $tableBody.find('.add-template .parameter-input').val(parameterData[0].name ?? '');
                    $tableBody.find('.add-template .parameter-duration').val(parameterData[0].duration ?? '');
        
                    if (parameterData[0].checkbox_status == 1) {
                        $tableBody.find('.add-template .parameter-check').prop('checked', true);
                        $tableBody.find('.add-template .parameter-condition').show();
                    } else {
                        $tableBody.find('.add-template .parameter-check').prop('checked', false);
                        $tableBody.find('.add-template .parameter-condition').hide();
                    }
        
                    $tableBody.find('.add-template .parameter-condition').val(parameterData[0].condition_status ?? '');
                }
        
                for (let i = 1; i < parameterData.length; i++) {
                    let row = $('.add-template').clone().removeClass('add-template');
                    row.find('.parameter-input').val(parameterData[i].name ?? '');
                    row.find('.parameter-duration').val(parameterData[i].duration ?? '');
        
                    if (parameterData[i].checkbox_status == 1) {
                        row.find('.parameter-check').prop('checked', true);
                        row.find('.parameter-condition').show();
                    } else {
                        row.find('.parameter-check').prop('checked', false);
                        row.find('.parameter-condition').hide();
                    }
        
                    row.find('.parameter-condition').val(parameterData[i].condition_status ?? '');
                    row.find('a')
                        .removeClass('add-row text-primary')
                        .addClass('delete-row text-danger')
                        .html('<i data-feather="trash-2"></i>');
                    $tableBody.append(row);
                }
        
                updateSerialsAndNames();
                collectJsonData();
                setupCheckboxHandlers();
                feather.replace();
        
                // Add row
                $(document).on('click', '.add-row', function (e) {
                    e.preventDefault();
                    let addRow = $('.add-template');
                    let inputVal = addRow.find('.parameter-input').val().trim();
                    let durationVal = addRow.find('.parameter-duration').val().trim();
        
                    if (inputVal === '' || durationVal === '') return;
        
                    collectJsonData();
                    let clone = addRow.clone(false, false).removeClass('add-template');
        
                    clone.find('.parameter-input').val('');
                    clone.find('.parameter-duration').val('');
                    clone.find('.parameter-check').prop('checked', false);
                    clone.find('.parameter-condition').val('').hide();
        
                    clone.find('td:last').html(
                        '<a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>'
                    );
        
                    $('#parameter-table-body').append(clone);
                    feather.replace();
                    updateSerialsAndNames();
                    setupCheckboxHandlers();
                    collectJsonData();
                });
        
                // Delete row
                $(document).on('click', '.delete-row', function (e) {
                    e.preventDefault();
                    $(this).closest('tr').remove();
                    updateSerialsAndNames();
                    setupCheckboxHandlers();
                    collectJsonData();
                });
        
                // Update JSON on input
                $(document).on('input', '.parameter-input, .parameter-duration', function () {
                    collectJsonData();
                });
        
                $(document).on('change', '.parameter-check, .parameter-condition', function () {
                    collectJsonData();
                });
        
                // Remove validation error on typing
                $(document).on('input', '.parameter-input, .parameter-duration, input[name="activity_name"], input[name="duration_min"]', function () {
                    $(this).removeClass('is-invalid');
                    $(this).next('.validation-error').remove();
                });
        
                // Form validation
                $('#myForm').submit(function (e) {
                    e.preventDefault();
        
                    // Remove old errors
                    $('.validation-error').remove();
                    $('.is-invalid').removeClass('is-invalid');
        
                    let isValid = true;
                    let activityName = $('input[name="activity_name"]');
                    let durationMin = $('input[name="duration_min"]');
        
                    if (activityName.val().trim() === '') {
                        isValid = false;
                        activityName.addClass('is-invalid');
                        activityName.after('<div class="text-danger validation-error">Required.</div>');
                    }
        
                    if (durationMin.val().trim() === '' || isNaN(durationMin.val().trim())) {
                        isValid = false;
                        durationMin.addClass('is-invalid');
                        durationMin.after('<div class="text-danger validation-error">Required.</div>');
                    }
        
                    // Validate all rows
                    $('#parameter-table-body .parameter-row').each(function () {
                        let nameField = $(this).find('.parameter-input');
                        let durationField = $(this).find('.parameter-duration');
        
                        if (nameField.val().trim() === '') {
                            isValid = false;
                            nameField.addClass('is-invalid');
                            if (!nameField.next('.validation-error').length) {
                                nameField.after('<div class="text-danger validation-error">Required.</div>');
                            }
                        }
        
                        if (durationField.val().trim() === '') {
                            isValid = false;
                            durationField.addClass('is-invalid');
                            if (!durationField.next('.validation-error').length) {
                                durationField.after('<div class="text-danger validation-error">Required.</div>');
                            }
                        }
                    });
        
                    if (!isValid) return false;
        
                    $('#alertContainer').html('');
                    let formData = new FormData(this);
        
                    $.ajax({
                        url: "{{ url('activity-master-edit/' . $activity->id) }}",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            let alertClass = response.success ? 'alert-success' : 'alert-danger';
                            let alertHTML = `
                                <div class="alert p-2 ${alertClass} alert-dismissible fade show" role="alert">
                                    <strong>${response.success ? 'Success' : 'Error'}:</strong> ${response.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`;
                            $('#alertContainer').html(alertHTML);
        
                            if (response.success) {
                                setTimeout(() => {
                                    window.location.href = "{{ url('activity-master') }}";
                                }, 500);
                            }
                        },
                        error: function () {
                            $('#alertContainer').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Something went wrong. Please try again.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`);
                        }
                    });
                });
            });
        
            function updateSerialsAndNames() {
                $('#parameter-table-body .parameter-row').each(function (index) {
                    $(this).find('.sno').text(index + 1);
                    $(this).find('.parameter-input').attr('name', `subcategories[${index}][name]`);
                    $(this).find('.parameter-duration').attr('name', `subcategories[${index}][duration]`);
                    $(this).find('.parameter-check').attr('name', `subcategories[${index}][checkbox_status]`);
                    $(this).find('.parameter-condition').attr('name', `subcategories[${index}][condition_status]`);
        
                    let hiddenCheckbox = $(this).find(`input[type="hidden"][name="subcategories[${index}][checkbox_status]"]`);
                    if (hiddenCheckbox.length === 0) {
                        $(this).find('.parameter-check').before(`<input type="hidden" name="subcategories[${index}][checkbox_status]" value="0">`);
                    }
                });
            }
        
            function collectJsonData() {
                let data = [];
                $('#parameter-table-body .parameter-row').each(function () {
                    let name = $(this).find('.parameter-input').val();
                    let duration = $(this).find('.parameter-duration').val();
                    let checkboxStatus = $(this).find('.parameter-check').is(':checked') ? 1 : 0;
                    let conditionStatus = $(this).find('.parameter-condition').val();
        
                    data.push({ 
                        name: name, 
                        duration: duration,
                        checkbox_status: checkboxStatus,
                        condition_status: conditionStatus
                    });
                });
                $('#sub_activity').val(JSON.stringify(data));
            }
        
            function toggleDropdown(index) {
                const checkbox = document.querySelector(`input[name="subcategories[${index}][checkbox_status]"][type="checkbox"]`);
                const dropdown = document.querySelector(`select[name="subcategories[${index}][condition_status]"]`);
                if (checkbox && dropdown) {
                    dropdown.style.display = checkbox.checked ? "inline-block" : "none";
                }
            }
        
            function setupCheckboxHandlers() {
                document.querySelectorAll('.parameter-row').forEach((row, index) => {
                    const checkbox = row.querySelector('.parameter-check');
                    if (checkbox) {
                        checkbox.setAttribute('onclick', `toggleDropdown(${index})`);
                        const dropdown = row.querySelector('.parameter-condition');
                        if (dropdown) {
                            dropdown.style.display = checkbox.checked ? "inline-block" : "none";
                        }
                    }
                });
            }
        </script>
        
    
@endsection
