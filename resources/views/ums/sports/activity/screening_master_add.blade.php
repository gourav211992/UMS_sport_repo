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
                                                        <select class="form-select"  name="sport_id" id="sport_id">
                                                            <option>---Select sport----</option>
															@foreach ($sports as $sport)
															    <option value="{{$sport->id}}">{{$sport->sport_name}}</option>
																
															@endforeach
                                                        </select>
                                                        <span class="text-danger error-sport_id"></span>
                                                    </div>
                                                </div>
                                                 
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Screening Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text"  class="form-control" name="screening_name"  />
                                                        <span class="text-danger error-screening_name"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Descriprtion</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text"  class="form-control" name="description"/>  

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
                                                                           <th>Weightage <span class="text-danger">*</span></th>
                                                                           <th>Action</th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody id="parameter-table-body">
                                                                       <!-- Example row -->
                                                                       <tr class="parameter-row add-template">
                                                                           <td class="sno">1</td>
                                                                           <td>
                                                                               <input type="text" class="form-control parameter-input mw-100" placeholder="Enter Parameter Name" />
                                                                               <span class="text-danger error-parameter_details"></span>
                                                                           </td>
                                                                           <td>
                                                                               <input type="number" class="form-control weight-input mw-100" placeholder="Enter Weightage value 1 to 100 only">
                                                                               <span class="text-danger error-parameter_details"></span>
                                                                           </td>
                                                                           <td>
                                                                               <a href="#" class="text-primary add-row"><i data-feather="plus-square"></i></a>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>

                                                                   <!-- Total only under Weightage -->
                                                                   <tfoot>
                                                                       <tr>
                                                                           <td></td> <!-- Empty under S.NO -->
                                                                           <td></td> <!-- Empty under Parameter Name -->
                                                                           <td class="fw-bold">Total Weightage: <span id="total-weightage">0</span>%</td>
                                                                           <td></td> <!-- Empty under Action -->
                                                                       </tr>
                                                                   </tfoot>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		



<script>
	function updateSerialsAndNames() {
    $('#parameter-table-body .parameter-row').each(function (index) {
        $(this).find('.sno').text(index + 1); 

        if (!$(this).hasClass('add-template')) {
            
            $(this).find('.parameter-input').attr('name', `parameters[${index}][name]`);
        }
    });
};
</script>
<script>
function collectJsonData() {
    let data = [];
    $('#parameter-table-body .parameter-row').each(function () {
        let parameterName = $(this).find('input').eq(0).val().trim();
        let weightage = $(this).find('.weight-input').val();
        if (parameterName || weightage) {
            data.push({ 
                parametername: parameterName, 
                weightage: weightage 
            });
        }
    });
    console.log(data);
    $('#parameter-json-data').val(JSON.stringify(data));
}


$(document).on('click', '.add-row', function (e) {
    e.preventDefault();

    let $template = $('.add-template');
    let parameterVal = $template.find('.parameter-input').val().trim();
    let weightVal = $template.find('.weight-input').val(); 

    if (parameterVal === '' || weightVal === '') {
        alert('Please enter both Parameter Name and Weightage before adding a new row.');
        return;
    }
    let newRow = $template.clone(false, false)
        .removeClass('add-template')
        .addClass('parameter-row');

    newRow.find('.parameter-input').val(parameterVal);
    newRow.find('.weight-input').val(weightVal);
    newRow.find('output').text(weightVal);

    $template.find('.parameter-input').val('');
    $template.find('.weight-input').val(0);  
    $template.find('output').text('0');      

    newRow.find('td:last').html(
        '<a href="#" class="text-danger delete-row"><i data-feather="trash-2"></i></a>'
    );

    $template.after(newRow);

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


$(document).on('input', '.weight-input', function () {
    let maxTotal = 100;
    let totalWeight = 0;

    $('.weight-input').not(this).each(function () {
        let val = parseFloat($(this).val()) || 0;
        totalWeight += val;
    });

    let allowed = maxTotal - totalWeight;
    let currentVal = parseFloat($(this).val()) || 0;

    if (currentVal > allowed) {
        $(this).val(allowed);
        currentVal = allowed;
    }

    totalWeight += currentVal;
    $('#total-weight').text(totalWeight);

    $('.weight-input').each(function () {
        let othersTotal = 0;
        $('.weight-input').not(this).each(function () {
            othersTotal += parseFloat($(this).val()) || 0;
        });
        let dynamicMax = maxTotal - othersTotal;
        $(this).attr('max', dynamicMax);
    });
   

    
    collectJsonData();
});


$(document).ready(function() {
    updateSerialsAndNames();
    collectJsonData();
});


feather.replace();

</script>

<script>
   
function updateTotalWeightage() {
    let total = 0;

    // Loop through all weight input fields
    $('.weight-input').each(function () {
        let val = parseFloat($(this).val()) || 0;
        total += val;
    });

    // Update the total display
    $('#total-weightage').text(total);
}

$(document).on('input', '.weight-input', function () {
    updateTotalWeightage();
});

$(document).ready(function () {
    updateTotalWeightage();
});

</script>

<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            let total = 0;
   
$('.weight-input').each(function () {
    let val = parseFloat($(this).val()) || 0;
    total += val;
});

if (total < 100) {
    toastr.error('Total weightage must be exactly 100 before submitting.', 'Validation Error', {
            positionClass: 'toast-top-right',
            closeButton: true,
            progressBar: true,
            timeOut: 5000,
            extendedTimeOut: 1000
        })
    e.preventDefault(); 
    return false;
}

e.preventDefault(); 

           
        
            $('.text-danger').text('');

            let valid = true; 

            if ($('#sport_id').val() === '---Select sport----') {
                $('.error-sport_id').text('*Required.');
                valid = false;
            }

            if ($("input[name='screening_name']").val().trim() === '') {
                $('.error-screening_name').text('*Required.');
                valid = false;
            }
            let isParameterValid = true;
            $('#parameter-table-body .parameter-row').each(function () {
                let parameterValue = $(this).find('.parameter-input').val().trim();
                if (parameterValue === '') {
                    isParameterValid = false;
                    $(this).find('.error-parameter_details').text('*Required.');
                }
            });

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

                    if(response.key !== true){
                        setTimeout(() => {
                            window.location.href = "{{ url('screening-master') }}";
                        }, 500);
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('.error-' + key).text(value[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection


