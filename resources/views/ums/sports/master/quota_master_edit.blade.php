@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-6 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Quota Master Edit</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('quota-master') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Edit</li>
                                </ol>
                            </div>
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

                                        <div class="col-md-9">
                                            <!-- Alert Container (will be filled by AJAX response) -->


                                            <form id="quotaForm">
                                                @csrf
                                             
                                                    <input type="hidden" name="id" value="{{ $quota->id }}">
                                       
                                            
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Quota Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="quota_name" value="{{ old('quota_name', $quota->quota_name ?? '') }}" required />
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Display Name <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="display_name" value="{{ old('display_name', $quota->display_name ?? '') }}"
                                                            required />
                                                    </div>
                                                </div>
                                            
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Discount% <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="discount" value="{{ old('discount', $quota->discount ?? '') }}" required />
                                                    </div>
                                                </div>
                                            
                                                <div class="mt-3">
                                                    <button type="button" onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm">
                                                        <i data-feather="arrow-left-circle"></i> Back
                                                    </button>
                                                    <button type="submit" class="btn btn-primary btn-sm ms-1">
                                                        <i data-feather="check-circle"></i> {{ isset($quota) ? 'Update' : 'Create' }}
                                                    </button>
                                                </div>
                                            </form>
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
  <script>
    $(document).ready(function() {
    $('#quotaForm').submit(function(e) {
        e.preventDefault(); 

       
        $('#alertContainer').html('');

   
        var formData = new FormData(this);
        var url = "{{ isset($quota) ? url('quota-update/' . $quota->id) : url('quota-edit') }}";

      
        $.ajax({
            url: url, 
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
                    $('#quotaForm')[0].reset();
                }
                window.location.href = "{{ url('/quota-master') }}";
            },
            error: function(xhr, status, error) {
               
                $('#alertContainer').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Something went wrong with the request.
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
            }
        });
    });
});

  </script>
   
@endsection
