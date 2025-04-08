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
                    <button onClick="javascript: history.go(-1)" type="button" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                        <i data-feather="arrow-left-circle"></i> Back
                    </button>
                    <form id="myForm" method="POST" >
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
                                                    <select class="form-select" name="sport_id" disabled>
                                                        @foreach ($sportName as $name)
                                                            <option value="{{$name->id}}">{{ ucfirst($name->sport_name) }}</option>
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
                                                    <input type="text" name="activity_name" class="form-control" value="{{ $activity->activity_name }}" disabled/>
                                                </div>
                                            </div>

                                            <!-- Activity Duration Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label"> Activity Duration (In Mins) <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" name="duration_min" class="form-control"  value="{{ $activity->activity_duration_min }}" disabled/>    
                                                </div>
                                            </div>

                                            <!-- Description Field -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Description</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="description" class="form-control" value="{{ $activity->description }}" disabled/>    
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
                                                                {{-- <th>Action</th> --}}
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

				if (parameterData.length > 0) {
					$tableBody.find('.add-template .parameter-input').val(parameterData[0].name ?? '');
					$tableBody.find('.add-template .parameter-duration').val(parameterData[1].duration ?? '');
				}

				for (let i = 1; i < parameterData.length; i++) {
					let row = $('.add-template').clone().removeClass('add-template');
					row.find('.parameter-input').val(parameterData[i].name ?? '');
					row.find('.parameter-duration').val(parameterData[i].duration ?? '');
					row.find('a')
						.removeClass('add-row text-primary')
						.addClass('delete-row text-danger')
						.html('<i data-feather="trash-2"></i>');
					$tableBody.append(row);
				}

				updateSerialsAndNames();
				collectJsonData();
				feather.replace(); 
			});
		</script>

		<script>




			function updateSerialsAndNames() {
				$('#parameter-table-body .parameter-row').each(function (index) {
					$(this).find('.sno').text(index + 1); 

					if (!$(this).hasClass('add-template')) {
						$(this).find('.parameter-input').attr('name', `parameters[${index}][name]`); // Start with index = 0
					}
				});
			}

			function collectJsonData() {
				let data = [];
				$('#parameter-table-body .parameter-row').each(function () {
					let value = $(this).find('.parameter-input').val(); 
					let value1 = $(this).find('.parameter-duration').val(); 
					data.push({ name: value, duration:value1 });
				});
				$('#sub_activity').val(JSON.stringify(data));
			}

			$(document).on('click', '.add-row', function (e) {
				e.preventDefault();

				let addRow = $('.add-template');
				let inputVal = addRow.find('input').val().trim();

				if (inputVal === '') {
					alert('Please enter a parameter name before adding a new row.');
					return;
				}
				collectJsonData();
				let clone = addRow.clone(false, false).removeClass('add-template');

				clone.find('input').val('');

				clone.find('td:last').html(
					'<a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>'
				);

				$('#parameter-table-body').append(clone);

				feather.replace();

				updateSerialsAndNames();
				collectJsonData();
			});

			$(document).on('click', '.delete-row', function (e) {
				e.preventDefault();
				$(this).closest('tr').remove();
				updateSerialsAndNames();
				collectJsonData();
			});

			$(document).on('input', '.parameter-input', function () {
				collectJsonData();
			});
			$(document).on('input', '.parameter-duration', function () {
				collectJsonData();
			});

			$(document).ready(function () {
				updateSerialsAndNames();
				collectJsonData();
			});

			
			feather.replace();

		</script>

		<script>
			$(document).ready(function () {
				$('#myForm').submit(function (e) {
					e.preventDefault();
					var input=  $('.parameter-input').val().trim();
	   if(input == ''){
           alert('Please enter a parameter name');
           return false;
       }
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
							</div>
						`;
							$('#alertContainer').html(alertHTML);

							if (response.success) {
							
								$('#myForm')[0].reset();
								setTimeout(() => {
									window.location.href = "{{ url('activity-master') }}";
								},500);
								
							}
						},
						error: function (xhr) {
							$('#alertContainer').html(`
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Error!</strong> Something went wrong.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						`);
						}
					});
				});
			});
		</script>
        <script>
function disableForm() {
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);
                // $('button').prop('disabled', true);
            }
            disableForm();
        </script>
        

@endsection
