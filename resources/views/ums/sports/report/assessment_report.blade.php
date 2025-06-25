 @extends('ums.sports.sports-meta.admin-sports-meta')
 @section('content')
     <!-- BEGIN: Content-->
     <div class="app-content content">
         <div class="content-overlay"></div>
         <div class="header-navbar-shadow"></div>
         <div class="content-wrapper container-xxl p-0">
             <div class="content-header row">
                 <div class="content-header-left col-md-5 mb-2">
                     <div class="row breadcrumbs-top">
                         <div class="col-12">
                             <h2 class="content-header-title float-start mb-0">Assessment Report</h2>
                             <div class="breadcrumb-wrapper">
                                 <ol class="breadcrumb">
                                     <li class="breadcrumb-item"><a href="{{ url('assessment-report') }}">Home</a></li>
                                     <li class="breadcrumb-item active">Report</li>
                                 </ol>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                     <form method="get" action="{{ route('get-assessment-report') }}">
                         <div class="form-group breadcrumb-right">
                             <a class="btn btn-dark btn-sm mb-50 mb-sm-0" href="{{ url('assessment-report') }}">
                                 <i data-feather="refresh-cw" class="me-50"></i> Reset
                             </a>
                             <button type="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                                 <i data-feather="file-text"></i> Get Report</button>
                         </div>
                 </div>
             </div>
             <div class="content-body">
                 <section id="basic-datatable">
                     <div class="card border overflow-hidden">
                         <div class="row">
                             <div class="col-md-12 bg-light border-bottom mb-1 po-reportfileterBox">
                                 <div class="row pofilterhead action-button align-items-center">
                                     <div class="col-md-4">
                                         <h3></h3>
                                     </div>

                                 </div>


                                 <div class="customernewsection-form poreportlistview p-1">

                                     <div class="row ">


                                         <div class="col-md-4">
                                             <div class="mb-1 mb-sm-0">
                                                 <label class="form-label">
                                                     Batch
                                                     @error('batch_name')
                                                         <span class="text-danger">*</span>
                                                     @enderror
                                                 </label>
                                                 <select class="form-select @error('batch_name') is-invalid @enderror"
                                                     name="batch_name" id="batch_name">
                                                     <option value="" selected>-----Select Batch-----</option>
                                                     @foreach ($batch as $item)
                                                         <option value="{{ $item->id }}"
                                                             {{ request('batch_name') == $item->id ? 'selected' : '' }}>
                                                             {{ $item->batch_name }}
                                                         </option>
                                                     @endforeach
                                                 </select>
                                                 @error('batch_name')
                                                     <div class="invalid-feedback">
                                                         {{ $message }}
                                                     </div>
                                                 @enderror
                                             </div>
                                         </div>

                                         <input type="hidden" id="old_section" value="{{ request('section') }}">
                                         <input type="hidden" id="old_group" value="{{ request('group') }}">

                                         <div class="col-md-4">
                                             <div class="mb-1 mb-sm-0">
                                                 <label class="form-label">Section</label>
                                                 <select class="form-select" name="section" id="section">

                                                 </select>
                                             </div>
                                         </div>
                                         <div class="col-md-4">
                                             <div class="mb-1 mb-sm-0">
                                                 <label class="form-label">Group</label>
                                                 <select class="form-select" name="group" id="group">

                                                 </select>
                                             </div>
                                         </div>

                                     </div>

                                     <!-- <div class="row mt-1">
                                         <div class="col-md-4">
                                             <label class="form-label">Screening Date</label>
                                             <input type="date" class="form-control" name="screening_date"
                                                 value="{{ request('screening_date') }}">
                                         </div>

                                         <div class="col-md-4">
                                             <div class="mb-1 mb-sm-0">
                                                 <label class="form-label">Trainer</label>
                                                 <select class="form-select" name="trainer" id="trainer">
                                                     <option value="" selected>-----Select Trainer-----</option>
                                                     @foreach ($trainers as $item)
                                                         <option value="{{ $item->id }}"
                                                             {{ request('trainer') == $item->id ? 'selected' : '' }}>
                                                             {{ $item->name }}
                                                         </option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>

                                     </div> -->

                                 </div>
                                 </form>

                                 <section id="basic-datatable">
                                     <div class="row">
                                         <div class="col-12">
                                             <div class="card">
                                                 <div class="table-responsive candidates-tables">
                                                     <table
                                                         class="datatables-basic table table-striped myrequesttablecbox loanapplicationlist tasklist ">
                                                         <thead>
                                                             <tr>
                                                                 <th>#</th>
                                                                 <th>Reg. No</th>
                                                                 <th>Player Name</th>
                                                                 <th>Screening Date</th>
                                                                 <th>Section</th>
                                                                 <th>Group</th>
                                                                 <th>Assesment Type</th>
                                                                 <th>Trainer</th>
                                                                 <th>Status</th>
                                                                 <th>Action</th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                                             {{-- @dd($screeningSummary); --}}
                                                             @if (isset($screeningSummary) && count($screeningSummary) > 0)
                                                                 @foreach ($screeningSummary as $index => $item)
                                                                     <tr>
                                                                         <td>{{ $index + 1 }}</td>
                                                                         <td class="fw-bolder text-dark">
                                                                             {{ $item->document_number }}</td>
                                                                         <td>{{ $item->name }} </td>
                                                                         <td>{{ \Carbon\Carbon::parse($item->screening_date)->format('d-m-Y') }}
                                                                         </td>
                                                                         <td>{{ $item->sectionName }}</td>
                                                                         <td>{{ $item->groupName }}</td>


                                                                         <td><span
                                                                                 class="badge rounded-pill badge-light-secondary badgeborder-radius">{{ $item->screening_name }}</span>
                                                                         </td>
                                                                         <td>{{ $item->trainerName }}</td>

                                                                         <td><span
                                                                                 class="badge rounded-pill badge-light-success badgeborder-radius">Done</span>
                                                                         </td>

                                                                         <td>
                                                                             <a href="#"
                                                                                 onClick="viewStudentReport('{{ $item->sport_register_id }}')"
                                                                                 class="btn btn-sm btn-primary">
                                                                                 <span>View Report</span>
                                                                             </a>
                                                                         </td>
                                                                     </tr>
                                                                 @endforeach
                                                             @elseif(isset($screeningSummary))
                                                                 <tr>
                                                                     <td colspan="10" class="text-center">No data found
                                                                     </td>
                                                                 </tr>
                                                             @endif
                                                         </tbody>
                                                     </table>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </section>

                                 <div class="col-md-12">
                                     <div class="table-responsive po-reportnewdesign">
                                     </div>
                                 </div>

                             </div>
                         </div>
                 </section>
             </div>
         </div>
     </div>

     <!-- END: Content-->



     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

     <script>
         function viewStudentReport(slug) {
             var url = "{{ url('/student-screening-report') }}" + "/" + slug;
             window.location.href = url;
         }

         $(document).ready(function() {
             var initialBatch = $('#batch_name').val();
             var selectedSection = $('#old_section').val();
             var selectedGroup = $('#old_group').val();

             if (initialBatch) {
                 loadSections(initialBatch, selectedSection, function() {
                     if (selectedSection) {
                         loadGroups(selectedSection, selectedGroup);
                     }
                 });
             }

             $('#batch_name').change(function() {
                 var batchId = $(this).val();
                 loadSections(batchId, null);
                 $('#group').html('<option value="">Select Group</option>');
             });

             $('#section').on('change', function() {
                 var sectionId = $(this).val();
                 loadGroups(sectionId, null);
             });

             function loadSections(batchId, selectedSection = null, callback = null) {
                 $('#section').html('<option value="">Loading Sections...</option>');
                 $('#group').html('<option value="">Select Group</option>');

                 if (batchId) {
                     $.ajax({
                         url: "{{ route('get.batch.section.report') }}",
                         type: "POST",
                         data: {
                             batch_name: batchId,
                             _token: "{{ csrf_token() }}"
                         },
                         success: function(response) {
                             var options = '<option value="">-----Select Section-----</option>';
                             $.each(response, function(index, item) {
                                 var selected = (item.id == selectedSection) ? 'selected' : '';
                                 options += '<option value="' + item.id + '" ' + selected + '>' +
                                     item.name + '</option>';
                             });
                             $('#section').html(options).prop('disabled', false);
                             if (callback) callback();
                         },
                         error: function(xhr) {
                             console.error("AJAX error:", xhr);
                         }
                     });
                 } else {
                     $('#section').html('<option value="">-----Select Section-----</option>').prop('disabled', true);
                 }
             }

             function loadGroups(sectionId, selectedGroup = null) {
                 $('#group').html('<option value="">Loading...</option>');

                 if (sectionId) {
                     $.ajax({
                         url: '/get-groups-by-sections/' + sectionId,
                         method: 'GET',
                         success: function(response) {
                             var options = '<option value="">Select Group</option>';
                             response.forEach(function(group) {
                                 var selected = (group.id == selectedGroup) ? 'selected' : '';
                                 options += '<option value="' + group.id + '" ' + selected +
                                     '>' + group.name + '</option>';
                             });
                             $('#group').html(options);
                         }
                     });
                 } else {
                     $('#group').html('<option value="">Select Group</option>');
                 }
             }
         });
     </script>

 @endsection
