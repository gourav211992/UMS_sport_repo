@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content');
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header pocreate-sticky">
            <div class="row">
                <div class="content-header-left col-md-6 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Activity Scheduler</h2> 
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
                        <button onClick="javascript: history.go(-1)" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i data-feather="check-circle"></i> Submit</button> 
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
             
            
            
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        
                        
                        <div class="card">
                             <div class="card-body customernewsection-form">  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="newheader border-bottom mb-2 pb-25 d-flex flex-wrap justify-content-between"> 
                                                <div>
                                                    <h4 class="card-title text-theme">Basic Information</h4>
                                                    <p class="card-text">Fill the details</p>
                                                </div> 
                                            </div> 
                                        </div> 


                                        <div class="col-md-8">
                                                 
                                                 <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Series <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-5"> 
                                                        <select class="form-select">
                                                            <option>Scheduler</option>
                                                        </select>
                                                    </div> 
                                                 </div>
                                            
                                                 <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Scheduler No. <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-5"> 
                                                        <input type="text" class="form-control">
                                                    </div> 
                                                 </div>    

                                                 <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Start Date <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-5"> 
                                                        <input type="date" class="form-control">
                                                    </div> 
                                                 </div>  

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Admission Yr. <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-3 mb-1 mb-sm-0"> 
                                                        <select class="form-select select2">
                                                            <option>Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mb-1 mb-sm-0"> 
                                                        <label class="form-label">Batch <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-3"> 
                                                        <select class="form-select select2">
                                                            <option>Select</option>
                                                        </select>
                                                    </div>
                                                 </div>  
                                            
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Section <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-3 mb-1 mb-sm-0"> 
                                                        <select class="form-select select2">
                                                            <option>Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mb-1 mb-sm-0"> 
                                                        <label class="form-label">Group <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-3"> 
                                                        <select class="form-select select2">
                                                            <option>Select</option>
                                                        </select>
                                                    </div>
                                                 </div>
                                            
                                                 <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Sport <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-5"> 
                                                        <select class="form-select select2">
                                                            <option>Select</option>
                                                        </select>
                                                    </div> 
                                                 </div>
                                            
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Activity <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-5"> 
                                                        <select class="form-select select2">
                                                            <option>Select</option>
                                                        </select>
                                                    </div> 
                                                 </div>
                                            
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Sub-Activities <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-5"> 
                                                        <select class="form-select select2">
                                                            <option>Select</option>
                                                        </select>
                                                    </div> 
                                                 </div>
                                             
                                                <div class="row mb-1"> 
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Day <span class="text-danger">*</span></label>  
                                                    </div> 

                                                    <div class="col-md-7"> 
                                                         <div class="demo-inline-spacing">
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Email">
                                                                    <label class="form-check-label" for="Email">Monday</label>
                                                                </div>
                                                                 <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="SMS">
                                                                    <label class="form-check-label" for="SMS">Tuesday</label>
                                                                </div>
                                                                 <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Whatsapp">
                                                                    <label class="form-check-label" for="Whatsapp">Wednesday</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Traded">
                                                                    <label class="form-check-label" for="Traded">Thursday</label>
                                                                </div>
                                                                 <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Asset">
                                                                    <label class="form-check-label" for="Asset">Friday</label>
                                                                </div>
                                                                 <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Expense">
                                                                    <label class="form-check-label" for="Expense">Saturday</label>
                                                                </div>
                                                                <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                    <input type="checkbox" class="form-check-input" id="Sunday">
                                                                    <label class="form-check-label" for="Sunday">Sunday</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                            
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Start Time <span class="text-danger">*</span></label>  
                                                    </div>  

                                                    <div class="col-md-3 mb-1 mb-sm-0"> 
                                                        <input type="time" class="form-control" />
                                                    </div> 
                                                    <div class="col-md-2 mb-1 mb-sm-0"> 
                                                        <label class="form-label">End Time <span class="text-danger">*</span></label>  
                                                    </div>
                                                    <div class="col-md-3"> 
                                                        <input type="time" class="form-control" />
                                                    </div> 
                                                    
                                                 </div>
                                            
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Status</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio3" name="customColorRadio3" class="form-check-input" checked="">
                                                                <label class="form-check-label fw-bolder" for="customColorRadio3">Active</label>
                                                            </div> 
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="customColorRadio4" name="customColorRadio3" class="form-check-input">
                                                                <label class="form-check-label fw-bolder" for="customColorRadio4">Inactive</label>
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                </div>
                                             


                                        </div> 
                                        
                                        <div class="col-md-4"> 

                                                <div class="step-custhomapp bg-light p-1 customerapptimelines customerapptimelinesapprovalpo">
                                                    <h5 class="mb-2 text-dark border-bottom pb-50 d-flex align-items-center justify-content-between">
                                                        <strong><i data-feather="arrow-right-circle"></i> Approval History</strong> 
                                                    </h5>
                                                    <ul class="timeline ms-50 newdashtimline ">
                                                          
                                                        <li class="timeline-item">
                                                            <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                                                            <div class="timeline-event">
                                                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                                    <h6>Deewan Singh</h6>
                                                                    <span class="badge rounded-pill badge-light-warning">Pending</span>
                                                                </div>
                                                                <h5>(5 min ago)</h5>
                                                                <p>Description will come here</p> 
                                                            </div>
                                                        </li>
                                                        <li class="timeline-item">
                                                            <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                                            <div class="timeline-event">
                                                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                                    <h6>Brijesh Kumar</h6>
                                                                    <span class="badge rounded-pill badge-light-success">Approved</span>
                                                                </div>
                                                                <h5>(10 min ago)</h5>
                                                                <p>Description will come here</p> 
                                                            </div>
                                                        </li> 
                                                        <li class="timeline-item">
                                                            <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                                            <div class="timeline-event">
                                                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                                    <h6>Deepender Singh</h6>
                                                                   <span class="badge rounded-pill badge-light-success">Approved</span>
                                                                </div>
                                                                <h5>(5 day ago)</h5>
                                                                <p><a href="#"><i data-feather="download"></i></a> Description will come here </p> 
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>

                                    </div> 
                            </div>
                        </div>
                        
                         
                          
                        
                        
                        
                        <div class="card">
                             <div class="card-body customernewsection-form"> 
                                 
                                 
                                        <div class="border-bottom mb-2 pb-25">
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="newheader "> 
                                                            <h4 class="card-title text-theme">Batch Students</h4>
                                                            <p class="card-text">View the details</p>
                                                        </div>
                                                    </div>
                                                     
                                                </div> 
                                         </div>
                                         
                                         
                                          

                                        
                                        <div class="row"> 
                                            
                                             <div class="col-md-12">
                                                 
                                                 
                                                 <div class="table-responsive pomrnheadtffotsticky">
                                                     <table class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad"> 
                                                        <thead>
                                                             <tr>
                                                                <th width="50px">#</th>
                                                                <th width="150px">Registration No</th>
                                                                <th width="250px">Player Name</th>
                                                                <th>DOJ</th>
                                                          </tr>
                                                            </thead>
                                                            <tbody class="">
                                                                 <tr>
                                                                    <td>1</td>
                                                                    <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                    <td class="poprod-decpt">Deewan Singh</td>
                                                                    <td class="poprod-decpt">01-01-2025</td>
                                                                  </tr>
                                                                  
                                                                
                                                                 <tr>
                                                                    <td>2</td>
                                                                    <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                    <td class="poprod-decpt">Deewan Singh</td>
                                                                    <td class="poprod-decpt">01-01-2025</td>
                                                                  </tr>
                                                                
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                    <td class="poprod-decpt">Deewan Singh</td>
                                                                    <td class="poprod-decpt">01-01-2025</td>
                                                                  </tr>
                                                                
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                    <td class="poprod-decpt">Deewan Singh</td>
                                                                    <td class="poprod-decpt">01-01-2025</td>
                                                                  </tr>
                                                                
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                    <td class="poprod-decpt">Deewan Singh</td>
                                                                    <td class="poprod-decpt">01-01-2025</td>
                                                                  </tr>
                                                                
                                                                <tr>
                                                                    <td>6</td>
                                                                    <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                    <td class="poprod-decpt">Deewan Singh</td>
                                                                    <td class="poprod-decpt">01-01-2025</td>
                                                                  </tr>
                                                                
                                                                <tr>
                                                                    <td>7</td>
                                                                    <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                    <td class="poprod-decpt">Deewan Singh</td>
                                                                    <td class="poprod-decpt">01-01-2025</td>
                                                                  </tr>
                                                                
                                                                <tr>
                                                                    <td>8</td>
                                                                    <td class="poprod-decpt"><strong>Reg001</strong></td>
                                                                    <td class="poprod-decpt">Deewan Singh</td>
                                                                    <td class="poprod-decpt">01-01-2025</td>
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
                <!-- Modal to add new record -->
                 
            </section>
             

        </div>
    </div>
</div>
@endsection