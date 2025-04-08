@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content');
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">



    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header pocreate-sticky">
				<div class="row">
					<div class="content-header-left col-md-6 mb-2">
						<div class="row breadcrumbs-top">
							<div class="col-12">
								<h2 class="content-header-title float-start mb-0">Screening Master</h2>
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
						<form  method="POST" id="myForm">
						<div class="form-group breadcrumb-right">   
							<button onClick="javascript: history.go(-1)"  type="button" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i data-feather="arrow-left-circle"></i> Back</button> 

							<button  type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button> 
						</div>
					</div>
				</div>
			</div>
            <div class="content-body">
                 
                <div id="alertContainer"></div>
				
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
                                                        <select class="form-select"  name="sport_id" required>
                                                            <option>---Select sport----</option>
															@foreach ($sports as $sport)
															    <option value="{{$sport->id}}">{{$sport->sport_name}}</option>
																
															@endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                 
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Screening Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text"  class="form-control" name="screening_name" required />
                                                    </div>
                                                </div>
                                                
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Descriprtion</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text"  class="form-control" name="description"  required  />    
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="col-md-4 border-start">
                                                    <div class="row align-items-center mb-2">
                                                        <div class="col-md-12"> 
                                                            <label class="form-label text-primary"><strong>Status</strong></label>   
                                                             <div class="demo-inline-spacing">
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="radio" id="customColorRadio3" name="status"  value="active" class="form-check-input" checked="">
                                                                    <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                                </div> 
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input type="radio" id="customColorRadio4" name="status" value="inactive" class="form-check-input" >
                                                                    <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                                </div> 
                                                            </div> 
                                                        </div> 
                                                     </div> 
                                                    
                                                       
                                                    
                                                    
                                                </div>
												<input type="hidden" name="parameter_details" id="parameter-json-data" />
											</form>
											<div class="mt-1">
												 <div class="tab-content pb-1 px-1">
														<div class="tab-pane active" id="othActivitieser"> 
															<div class="col-md-9">
																
                                                                <div class="table-responsive-md">
																	
																	<table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable">
																		<thead>
																			<tr>
																				<th>S.NO</th>
																				<th>Parameter Name <span class="text-danger">*</span></th>
																				<th>Action</th>
																			</tr>
																		</thead>
																		<tbody id="parameter-table-body">
																	
																			<tr class="parameter-row add-template">
																				<td class="sno">1</td>
																				<td>
																					<input type="text" class="form-control parameter-input mw-100" placeholder="Enter Parameter Name" />
																				</td>
																				<td>
																					<a href="#" class="text-primary add-row"><i data-feather="plus-square"></i></a>
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
                        </div>
                    </section>
                 

            </div>
        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://unpkg.com/feather-icons"></script>
	<script>
	function updateSerialsAndNames() {
    $('#parameter-table-body .parameter-row').each(function (index) {
        $(this).find('.sno').text(index + 1); 

        if (!$(this).hasClass('add-template')) {
            
            $(this).find('.parameter-input').attr('name', `parameters[${index}][name]`);
        }
    });
}

function collectJsonData() {
    let data = [];
    $('#parameter-table-body .parameter-row').each(function () {
        let value = $(this).find('.parameter-input').val(); 
        data.push({ parametername: value });
    });
    $('#parameter-json-data').val(JSON.stringify(data));
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

$(document).ready(function() {
    updateSerialsAndNames();
    collectJsonData();
});


feather.replace();

</script>

<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault(); 
       var input=  $('.parameter-input').val().trim();
	   if(input == ''){
           alert('Please enter a parameter name');
           return false;
       }
            $('#alertContainer').html('');

          
            var formData = new FormData(this);

           
            $.ajax({
                url: "{{ url('screening-add') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var alertClass = response.success ? 'alert-success' : 'alert-danger';
                    var message = response.success ? response.message : response.message;

                  
                    var alertHTML = `
                        <div class="alert p-2 ${alertClass} alert-dismissible fade show" role="alert">
                            <strong>${response.success ? 'Success' : 'Error'}!</strong> ${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                    $('#alertContainer').html(alertHTML);

                    if (response.success) {
                        $('#myForm')[0].reset();
						
                    }
					setTimeout(() => {
									window.location.href = "{{ url('screening-master') }}";
								},500);
                },
                error: function(xhr, status, error) {
                    
                    $('#alertContainer').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> Something went wrong with the request.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                }
            });
        });
    });
</script>






	

@endsection