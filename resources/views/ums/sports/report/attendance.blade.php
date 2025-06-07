@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
 
 <!-- BEGIN: Content-->
 <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        
         
        <div class="content-body"> 
              
            <section id="basic-datatable">
                <div class="card border  overflow-hidden"> 
                    <div class="row">
                        <div class="col-md-12 bg-light border-bottom mb-1 po-reportfileterBox">
                            <div class="row pofilterhead action-button align-items-center">
                                <div class="col-md-4">
                                    <h3>Attendance Sport</h3>
                                    <p>Apply the Basic Filter</p>
                                </div>
                                <div class="col-md-8 text-sm-end pofilterboxcenter mb-0 d-flex flex-wrap align-items-center justify-content-sm-end">
                                    <div class="customernewsection-form">
                                        <div class="demo-inline-spacing">
                                            <!-- <div class="form-check form-check-primary mt-0">
                                                <input type="radio" id="customColorRadio1" name="goodsservice" class="form-check-input" checked="">
                                                <label class="form-check-label fw-bolder" for="customColorRadio1">Goods</label>
                                            </div> 
                                            <div class="form-check form-check-primary mt-0">
                                                <input type="radio" id="service" name="goodsservice" class="form-check-input">
                                                <label class="form-check-label fw-bolder" for="service">Service</label>
                                            </div>  -->
                                        </div>
                                    </div>
                                    <!-- <div class="btn-group new-btn-group my-1 my-sm-0 ps-0">
                                        <input type="radio" class="btn-check" name="Peroid" id="Current" checked />
                                        <label class="btn btn-outline-primary mb-0" for="Current">Current Month</label>

                                        <input type="radio" class="btn-check" name="Peroid" id="Last" />
                                        <label class="btn btn-outline-primary mb-0" for="Last">Last Month</label> 

                                        <input type="radio" class="btn-check" name="Peroid" id="Custom" />
                                        <label class="btn btn-outline-primary mb-0" for="Custom">Custom</label> 
                                    </div> -->
<!--                                        <button data-bs-toggle="modal" data-bs-target="#addcoulmn" class="btn btn-outline-primary btn-sm columnfilterbtn me-1"><i data-feather="plus-square"></i> Add Columns</button>-->
<button type="submit"  form="Attendance_form" class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{url('attendance_report')}}"><i data-feather="file-text"></i> Get Report</button>
                                </div>
                            </div>
                            <form method="GET" action="{{ url('/attendance_report') }}" id="Attendance_form">
                            <div class="customernewsection-form poreportlistview p-1">
                                <div class="row"> 
                                    <div class="col-md-4">
                                        <div class="mb-6 mb-sm-0"> 
                                            <label class="form-label">Batch</label>
                                            <!-- Batch -->
<select name="batch" id="batch"  class="form-select">
    <option value="">Select Batch</option>
    @foreach($batches as $id => $name)
    <option value="{{ $id }}" {{ old('batch') == $id ? 'selected' : '' }}>{{ $name }}</option>
@endforeach
</select>
@error('batch')
    <small class="text-danger">{{ $message }}</small>
@enderror

                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-6 mb-sm-0"> 
                                            <label class="form-label">Section</label>
                                           <!-- Section -->
<select name="section" id="section" class="form-select">
    <option value="" >Select Section</option>
</select>
@error('section')
    <small class="text-danger">{{ $message }}</small>
@enderror

                                         </div>
                                    </div>
                                   
                                    <div class="col-md-4">
                                        <div class="mb-6 mb-sm-0"> 
                                            <label class="form-label">Group</label>
                                            <!-- Group -->
<select name="group" id="group" class="form-select">
    <option value="">Select Group</option>
</select>


                                         </div>
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-6 mb-sm-0">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" name="start_date" id="startDate" class="form-control" value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-6 mb-sm-0">
                                            <label class="form-label">End Date</label>
                                            {{-- <input type="date" name="end_date" id="endDate" class="form-control" /> --}}
                                            <input type="date" name="end_date" class="form-control" id="endDate" value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div> 
                        </form>
                        </div>
                      {{-- <div class="col-md-12"> 
                            <div class="table-responsive trailbalnewdesfinance po-reportnewdesign">
                                <table  class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist "> 
                                    <thead>
                                        <tr>
                                            <th>Year</th> 
                                            <th>2021</th> 
                                            <th>Date</th>
                                            <th>1</th> 
                                            <th>2</th> 
                                            <th>3</th> 
                                            <th>4</th> 
                                            <th>5</th> 
                                            <th>6</th> 
                                            <th>7</th> 
                                            <th>8</th> 
                                            <th>9</th> 
                                            <th>10</th> 
                                            <th>11</th> 
                                            <th>12</th> 
                                            <th>13</th> 
                                            <th>14</th> 
                                            <th>15</th> 
                                            <th>16</th> 
                                            <th>17</th>
                                            <th>18</th> 
                                            <th>19</th> 
                                            <th>20</th> 
                                            <th>21</th> 
                                            <th>22</th> 
                                            <th>23</th> 
                                            <th>24</th>
                                            <th>25</th> 
                                            <th>26</th> 
                                            <th>27</th> 
                                            <th>28</th> 
                                            <th>29</th> 
                                            <th>30</th> 
                                            <th>31</th>
                                         </tr>
                                        <tr>
                                           <th>Month</th> 
                                           <th>January</th> 
                                           <th>Type Of day</th>
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>H</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>H</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>H</th>
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>H</th>
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>W</th> 
                                           <th>H</th>
                                        </tr>

                                         <tr>
                                            <th>Emp.Id</th>
                                            <th>Employee Name</th>
                                            <th>Month</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
                                            <th>Sun</th>
                                           
                                          </tr>
                                        </thead>
                                        <tbody>
                                             <tr>
                                                <td>As216</td>
                                                <td class="fw-bolder text-dark">Rekha Raghav</td>
                                                <td>January</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                              </tr>
                                             
                                              <tr>
                                                <td>As216</td>
                                                <td class="fw-bolder text-dark">Rekha Raghav</td>
                                                <td>January</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                              </tr>
                                              <tr>
                                                <td>As216</td>
                                                <td class="fw-bolder text-dark">Rekha Raghav</td>
                                                <td>January</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                              </tr>
                                              <tr>
                                                <td>As216</td>
                                                <td class="fw-bolder text-dark">Rekha Raghav</td>
                                                <td>January</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                              </tr>
                                              <tr>
                                                <td>As216</td>
                                                <td class="fw-bolder text-dark">Rekha Raghav</td>
                                                <td>January</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td>P</td>
                                                <td>L</td>
                                                <td><span class="badge rounded-pill badge-light-secondary badgeborder-radius">H</span></td>
                                              </tr>
                                           </tbody>


                                </table>
                        </div> 
                        </div>
                    </div> --}}
                </div>
                 
            </section>
            <!-- ChartJS section end -->

        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">Copyright &copy; 2024 <a class="ml-25" href="#" target="_blank">Presence 360</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
    
    <div class="footerplogo"><img src="../../../assets/css/p-logo.png" /></div>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->

 
<div class="modal fade text-start filterpopuplabel " id="addcoulmn" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h4 class="modal-title fw-bolder text-dark namefont-sizenewmodal" id="myModalLabel17">Advance Filter</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
<!--
                            <div class="row"> 
                                <div class="col-md-7 mt-1">
                                    <div class="form-check form-check-success mb-1">
                                        <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                        <label class="form-check-label fw-bolder text-dark" for="colorCheck1">All Columns</label>
                                    </div>
                                </div>
                            </div>
-->
                    
                            <div class="step-custhomapp bg-light">
                                <ul class="nav nav-tabs my-25 custapploannav" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#Employee" role="tab" ><i data-feather="columns"></i> Columns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Bank" role="tab" ><i data-feather="bar-chart"></i> More Filter</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#Location" role="tab" ><i data-feather="calendar"></i> Scheduler</a>
                                    </li> 

                                </ul>
                            </div>

                            <div class="tab-content tablecomponentreport">
                                <div class="tab-pane active" id="Employee">
                                    <div class="compoenentboxreport">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check form-check-primary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">Select All Columns</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row sortable">
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">PO NO</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">PO Date</label>
                                                </div>
                                            </div> 
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">Vendor</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">Vendor Rating</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">Category</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">Sub Category</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">Item Type</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">Sub Type</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="Item" checked="">
                                                    <label class="form-check-label" for="Item">Item</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="Status" checked="">
                                                    <label class="form-check-label" for="Status">Status</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="Amount" checked="">
                                                    <label class="form-check-label" for="Amount">PO Amount</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-secondary">
                                                    <input type="checkbox" class="form-check-input" id="colorCheck1" checked="">
                                                    <label class="form-check-label" for="colorCheck1">Sub Type</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div> 
                                </div>
                                <div class="tab-pane" id="Bank">
                                     <div class="compoenentboxreport advanced-filterpopup customernewsection-form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check ps-0"> 
                                                    <label class="form-check-label">Add Filter</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"> 
                                                <label class="form-label">Select Category</label>
                                                <select class="form-select select2"> 
                                                    <option>Select</option>
                                                </select> 
                                            </div>
                                            <div class="col-md-4"> 
                                                <label class="form-label">Select Sub-Category</label>
                                                <select class="form-select select2"> 
                                                    <option>Select</option>
                                                </select> 
                                            </div>


                                            <div class="col-md-4"> 
                                                <label class="form-label">Select Attribute</label>
                                                <select class="form-select select2"> 
                                                    <option>Select</option>
                                                </select> 
                                            </div>
                                            <div class="col-md-4"> 
                                                <label class="form-label">Select Attribute Value</label>
                                                <select class="form-select select2"> 
                                                    <option>Select</option>
                                                </select> 
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="Location"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                             <div class="compoenentboxreport advanced-filterpopup customernewsection-form mb-1">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check ps-0"> 
                                                            <label class="form-check-label">Add Scheduler</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row camparboxnewcen">
                                                    <div class="col-md-8"> 
                                                        <label class="form-label">To</label>
                                                        <select class="form-select select2" multiple> 
                                                            <option>Select</option>
                                                            <option>Pawan Kuamr</option>
                                                            <option>Deepak Singh</option>
                                                        </select> 
                                                    </div>
                                                 </div>
                                                 <div class="row camparboxnewcen">
                                                    <div class="col-md-4"> 
                                                        <label class="form-label">Type</label>
                                                        <select class="form-select"> 
                                                            <option>Select</option>
                                                            <option>Daily</option>
                                                            <option>Weekly</option>
                                                            <option>Monthly</option>
                                                        </select> 
                                                    </div>

                                                    <div class="col-md-4"> 
                                                        <label class="form-label">Select Date</label>
                                                        <input type="datetime-local" class="form-select" />
                                                    </div>

                                                    <div class="col-md-12"> 
                                                        <label class="form-label">Remarks</label>
                                                        <textarea class="form-control" placeholder="Enter Remarks"></textarea>
                                                    </div>




                                                </div>

                                            </div>
                                         </div>


                                     </div>
                                      
                                </div> 
                            </div>
                                 
                </div> 
                
                <div class="modal-footer "> 
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary data-submit mr-1">Apply</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Laravel se old values leke JS variables me store kar liya
    const oldBatch = "{{ old('batch') }}";
    const oldSection = "{{ old('section') }}";
    const oldGroup = "{{ old('group') }}";

    $(document).ready(function () {
        if (oldBatch) {
            $('#batch').val(oldBatch);
            $('#section').html('<option value="">Loading...</option>');
            $('#group').html('<option value="">Loading...</option>');

            // Fetch sections based on old batch
            $.get(`/get-sections/${oldBatch}`, function (sections) {
                let sectionOptions = '<option value="">Select Section</option>';
                sections.forEach(section => {
                    const selected = (section.id == oldSection) ? 'selected' : '';
                    sectionOptions += `<option value="${section.id}" ${selected}>${section.name}</option>`;
                });
                $('#section').html(sectionOptions);

                // Now fetch groups based on old batch + old section
                if (oldSection) {
                    $.get(`/get-groups/${oldBatch}/${oldSection}`, function (groups) {
                        let groupOptions = '<option value="">Select Group</option>';
                        groups.forEach(group => {
                            const selected = (group.id == oldGroup) ? 'selected' : '';
                            groupOptions += `<option value="${group.id}" ${selected}>${group.name}</option>`;
                        });
                        $('#group').html(groupOptions);
                    });
                }
            });
        }
    });

    // Batch Change Handler
    $('#batch').on('change', function () {
        let batchId = $(this).val();
        $('#section').html('<option value="">Loading...</option>');
        $('#group').html('<option value="">Select Group</option>');

        if (batchId) {
            $.get(`/get-sections/${batchId}`, function (data) {
                let options = '<option value="">Select Section</option>';
                data.forEach(section => {
                    options += `<option value="${section.id}">${section.name}</option>`;
                });
                $('#section').html(options);
            });
        }
    });

    // Section Change Handler
    $('#section').on('change', function () {
        let batchId = $('#batch').val();
        let sectionId = $(this).val();
        $('#group').html('<option value="">Loading...</option>');

        if (batchId && sectionId) {
            $.get(`/get-groups/${batchId}/${sectionId}`, function (data) {
                let options = '<option value="">Select Group</option>';
                data.forEach(group => {
                    options += `<option value="${group.id}">${group.name}</option>`;
                });
                $('#group').html(options);
            });
        }
    });
</script>

<script>
    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];

    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');

    // Start date: disallow future dates
    startDateInput.setAttribute('max', today);

    // When start date changes, update end date constraints
    startDateInput.addEventListener('change', function () {
        const selectedStartDate = this.value;

        // End date can't be before start date
        endDateInput.setAttribute('min', selectedStartDate);

        // End date can't be after today
        endDateInput.setAttribute('max', today);

        // Optional: reset end date if it is outside valid range
        if (endDateInput.value && (endDateInput.value < selectedStartDate || endDateInput.value > today)) {
            endDateInput.value = '';
        }
    });

    // On page load, also restrict end date to today by default
    endDateInput.setAttribute('max', today);
</script>

    @endsection