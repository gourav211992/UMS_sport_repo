@extends('ums.admin.admin-meta')
@section('content');
{{-- content --}}
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header pocreate-sticky">
            <div class="row">
                <div class="content-header-left col-md-6 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Activity Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>  
                                <li class="breadcrumb-item active">Add New</li> 
                            </ol>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">   
                        <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button>  
                        <button type="submit" form="cat_form" onClick="javascript: history.go(-1)" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button> 
                    </div>
                </div>
            </div>
        </div>
        {{-- <form id="cat_form" method="POST" action="{{ route('activity-master-add') }}">
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
                                            
                                             
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Sport Master <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select">
                                                        @foreach ($sportName as $name)
                                                        <option value="{{$name->id}}">{{ ucfirst($name->sport_name) }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Parent Group</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="parent_group">
                                                        <option>Select</option>
                                                        <option value="hello">hello</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Activity Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="activity_name"  class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Duration (In Mins) <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number"  name="Duration(min)" class="form-control"   />    
                                                </div>
                                            </div>
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Descriprtion</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="description" class="form-control"   />    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
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
                                        
                                        
                                        <div class="col-md-9">
                                            <div class="table-responsive-md">
                                                <table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable">
                                                    <thead>
                                                        <tr>
                                                            <th>S.NO</th>
                                                            <th>Sub Activity Name<span class="text-danger">*</span></th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="sub-category-box">
                                                        <tr class="sub-category-template">
                                                            <td>1</td>
                                                            <td><input type="text" name="subcategories[0][name]" class="form-control mw-100" placeholder="Enter Sub Activity Name" /></td>
                                                            <!-- Display subcategory initials -->
                                                            <td>
                                                                <a href="#" class="text-primary add-address"><i data-feather="plus-square"></i></a> 
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr class="sub-category-template">
                                                            <td>1</td>
                                                            <td><input type="text" name="subcategories[0][name]" class="form-control mw-100" placeholder="Enter Sub Activity Name" /></td>
                                                            <!-- Display subcategory initials -->
                                                            <td> 
                                                                <a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>
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
                </section>
             

        </div>
    </form> --}}
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
    <form id="cat_form" method="POST" action="{{ route('activity-master-add') }}">
        @csrf
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body customernewsection-form">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Sport Master <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-select" name="sport_name">
                                                    @foreach ($sportName as $name)
                                                        <option value="{{$name->id}}">{{ ucfirst($name->sport_name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Parent Group</label>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-select" name="parent_group">
                                                    <option>Select</option>
                                                    <option value="hello">hello</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Activity Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="activity_name" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Duration (In Mins) <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="number" name="duration_min" class="form-control" />    
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-3">
                                                <label class="form-label">Description</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="description" class="form-control" />    
                                            </div>
                                        </div>
                                    </div>
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
                                    
                                    <div class="col-md-9">
                                        <div class="table-responsive-md">
                                            <table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable">
                                                <thead>
                                                    <tr>
                                                        <th>S.NO</th>
                                                        <th>Sub Activity Name<span class="text-danger">*</span></th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sub-category-box">
                                                    <tr class="sub-category-template">
                                                        <td>1</td>
                                                        <td><input type="text" name="subcategories[0][name]" class="form-control mw-100" placeholder="Enter Sub Activity Name" /></td>
                                                        <td>
                                                            <a href="#" class="text-primary add-address"><i data-feather="plus-square"></i></a> 
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr class="sub-category-template">
                                                        <td>1</td>
                                                        <td><input type="text" name="subcategories[1][name]" class="form-control mw-100" placeholder="Enter Sub Activity Name" /></td>
                                                        <td> 
                                                            <a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>
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
            </section>
        </div>
    </form>
    
    </div>
</div>
{{-- content --}}
<script>
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

    // Restrict input to alphabetic characters only (if needed for sport_name or other fields)
    $('.alphaOnly').keyup(function() {
        this.value = this.value.replace(/[^a-z|A-Z\.]/g, '');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Adding new subcategory row
    document.querySelector('.add-address').addEventListener('click', function(e) {
        e.preventDefault();
        
        // Clone the first sub-category row template
        let row = document.querySelector('.sub-category-template').cloneNode(true);

        // Append the new row to the table body
        document.querySelector('#sub-category-box').appendChild(row);

        // Update the index in the new row's input name
        let newIndex = document.querySelectorAll('.sub-category-template').length - 1;
        row.querySelector('input').name = `subcategories[${newIndex}][name]`;

        // Optional: Reset the input value for the new row
        row.querySelector('input').value = ''; // Clear the input field
    });

    // Deleting a subcategory row
    document.querySelector('#sub-category-box').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-row')) {
            e.preventDefault();
            
            // Remove the closest row (tr) where the delete button was clicked
            e.target.closest('tr').remove();

            // Optionally, adjust the row numbers or reindex them if needed
            let rows = document.querySelectorAll('.sub-category-template');
            rows.forEach((row, index) => {
                row.querySelector('td:first-child').textContent = index + 1; // Re-index rows
                row.querySelector('input').name = `subcategories[${index}][name]`; // Update input name attributes
            });
        }
    });
});

</script>
@endsection