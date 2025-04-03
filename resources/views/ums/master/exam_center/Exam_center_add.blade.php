  @extends('ums.admin.admin-meta')
   @section('content')
  
{{-- <body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click"
    data-menu="vertical-menu-modern" data-col=""> --}}


    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Add Exam-Center
                            </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Add Exam-Center
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button class="btn btn-dark btn-sm mb-50 mb-sm-0"  onclick="location.href='{{url('/exam_center')}}'"  href="javascript:history.back()" > <i data-feather="arrow-left-circle"></i> GO BACK
                            </button>
                        <button form="submitdata" class="btn btn-primary btn-sm mb-50 mb-sm-0" > <i data-feather="check-circle" style="font-size: 40px;"></i>
                            Submit</button>


                    </div>
                </div>
            </div>
            <div class="content-body bg-white py-4 mb-4 shadow">
                <div class="row g-0  mt-3 mb-3 text-center px-5 ">


                <div class="col-md-12">
    <form action="{{ url('/exam_center/add') }}" method="POST" id="submitdata">
        @csrf
        <div class="row align-items-center mb-1">
            <div class="col-md-2 text-start">
                <label class="form-label">Center Code:<span class="text-danger m-0">*</span></label>
            </div>
            <div class="col-md-8">
                <input type="text" name="center_code" class="form-control" placeholder="Enter center code here" required>
            </div>
        </div>
        <div class="row align-items-center mb-1">
            <div class="col-md-2 text-start">
                <label class="form-label">Center Name:<span class="text-danger m-0">*</span></label>
            </div>
            <div class="col-md-8">
                <input type="text" name="center_name" class="form-control" placeholder="Enter center name here" required>
            </div>
        </div>
        <div class="row align-items-center mb-1">
            <div class="col-md-2 text-start">
                <label class="form-label">Status<span class="text-danger m-0">*</span></label>
            </div>
            <div class="col-md-8">
                <select name="status" class="form-control" required>
                    <option value="">Select status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        {{-- <button type="submit" class="btn btn-primary">Add Exam Center</button> --}}
    </form>
</div>

                       


                    </div>
                
            </div>
            </div>
            </div>
        </div>

           
          
            
        
        @endsection