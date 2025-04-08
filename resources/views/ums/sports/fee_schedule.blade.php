@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-5 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Fee Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                                    <li class="breadcrumb-item active">Fee Master List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#uploadExcelModal">
                                <i data-feather="upload"></i> Bulk Upload Fee
                            </button>
                            
                                  
				 <a class="btn btn-primary btn-sm mb-50 mb-sm-0" href="{{ url('sports-fee-schedule/add') }}"><i
                                data-feather="plus-circle"></i> Add New</a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @include('ums.admin.notifications')

             
          
			
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive candidates-tables">
                                    <table
                                        class="datatables-basic table table-striped myrequesttablecbox tasklist">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                {{-- <th>Admission Yr.</th> --}}
                                                <th>Sport Name</th>
                                                <th>Batch Year</th>
                                                <th>Batch Name</th>
                                                <th>Section</th>
                                                <th>Quota</th>
                                                <!-- <th>Total Fees</th>
                                                <th>Discount</th>
                                                <th>Net Fees</th> -->
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sportFeeMaster ?? [] as $fee)
                                                @php
                                                  
                                                    $feeDetails = json_decode($fee->fee_details, true);

                                                    $totalFees = $feeDetails[0]['total_fees'] ?? 0; // Assuming the first item is the one you're working with
                                                    $discount = $feeDetails[0]['fee_discount_value'] ?? 0;
                                                    $netFees = $feeDetails[0]['net_fee_payable_value'] ?? 0;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    {{-- <td class="fw-bolder text-dark">{{ $fee->document_date }}</td> --}}
                                                    <td>{{ $fee->sport_name }}</td>
                                                    <td>{{  $fee->batch_year}}</td>
                                                    <td>{{ $fee->batch }}</td>
                                                    <td>{{ $fee->section }}</td>
                                                    <td>{{ $fee->quota }}</td>
                                                    <!-- <td>{{ $totalFees }}</td>
                                                    <td>{{ $discount }}</td>
                                                    <td>{{ $netFees }}</td> -->
                                                    <td>
                                                        <span
                                                            class="badge rounded-pill badge-light-{{ ($fee->status == 'Active' || $fee->status == 'active') ? 'success' : 'danger' }} badgeborder-radius">{{ Str::ucfirst($fee->status) }}</span>
                                                    </td>
                                                    <td class="tableactionnew">
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="{{'sports-fee-schedule/view/'.$fee->id}}">
                                                                    <i data-feather="edit" class="me-50"></i>
                                                                    <span>View Detail</span>
                                                                </a>
                                                                <a class="dropdown-item" href="{{'sports-fee-schedule/edit/'.$fee->id}}">
                                                                    <i data-feather="edit-3" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="{{'sports-fee-schedule/delete/'.$fee->id}}">
                                                                    <i data-feather="trash-2" class="me-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $fee->id }}" href="javascript:void(0)">
                                                                    <i data-feather="copy" class="me-50"></i>
                                                                    <span>Clone</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal for Confirm Clone -->
                                        <div class="modal fade" id="confirmModal{{ $fee->id }}" tabindex="-1" aria-labelledby="confirmModalLabel{{ $fee->id }}" aria-hidden="true">
                                            <div class="modal-dialog d-flex align-items-center" style="min-height: 100vh;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmModalLabel{{ $fee->id }}">Fee Schedule Clone</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('sports-fee-schedule-clone', $fee->id) }}" method="POST">
                                                            @csrf
                                                            <div class="mt-1 d-flex align-items-center"> 
                                                                <label for="quota" class="mr-2 me-2">Select Quota</label> 
                                                                <select id="quota" name="quota" class="form-select w-50 b-0 "> 
                                                                    @foreach ($quotas as $item)
                                                                        @if ($item->quota_name != $fee->quota)  
                                                                            <option value="{{ $item->quota_name }}">{{ $item->quota_name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>  
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Confirm Clone</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
  

<!-- The Modal -->
<div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadExcelModalLabel">Upload Excel File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Choose Excel File</label>
                        <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        
                    </div>
                    <p>Download Bulk Fee Format</p>
                    <a href="{{ url('/download-template') }}" class="btn btn-primary btn-sm">
                        Download Template
                    </a>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
