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
                         <h2 class="content-header-title float-start mb-0">Student Report</h2>
                         <div class="breadcrumb-wrapper">
                             <ol class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="{{ url('student-report') }}">Home</a></li>
                                 <li class="breadcrumb-item active">Report</li>
                             </ol>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="content-header-right text-sm-end col-md-7 mb-50 mb-sm-0">
                 <form method="get" action="{{ route('get.student.by.section.quota') }}">
                     <div class="form-group breadcrumb-right">
                         <a class="btn btn-dark btn-sm mb-50 mb-sm-0" href="{{ url('student-report') }}">
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
                                             <label class="form-label">Batch</label>
                                             <select class="form-select" name="batch_name" id="batch_name">
                                                 <option value="" selected>-----Select Batch-----</option>
                                                 @foreach ($batch as $item)
                                                 <option value="{{ $item->id }}"
                                                     {{ request('batch_name') == $item->id ? 'selected' : '' }}>
                                                     {{ $item->batch_name }}
                                                 </option>
                                                 @endforeach
                                             </select>

                                         </div>
                                     </div>
                                     <input type="hidden" id="old_section" value="{{ request('section') }}">

                                     <div class="col-md-4">
                                         <div class="mb-1 mb-sm-0">
                                             <label class="form-label">Section</label>
                                             <select class="form-select" name="section" id="section">

                                             </select>
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="mb-1 mb-sm-0">
                                             <label class="form-label">Quota</label>
                                             <select class="form-select" name="quota" id="quota">
                                                 <option value="" selected>-----Select Quota-----</option>
                                                 @foreach ($quota as $item)
                                                 <option value="{{ $item->id }}"
                                                     {{ request('quota') == $item->id ? 'selected' : '' }}>
                                                     {{ $item->quota_name }}
                                                 </option>
                                                 @endforeach
                                             </select>

                                         </div>
                                     </div>
                                 </div>


                                 </form>


                             </div>

                         </div>


                         <section id="basic-datatable">
                             <div class="row">
                                 <div class="col-12">
                                     <div class="card">
                                         <div class="table-responsive candidates-tables">
                                             {{-- <table
                                                     class="datatables-basic table table-striped myrequesttablecbox tasklist ">
                                                     <thead>
                                                         <tr class="text-center">
                                                             <th>#</th>
                                                             <th>Registration Number</th>
                                                             <th>First Name</th>
                                                             <th>Last Name</th>
                                                             <th>Doj</th>
                                                             <th>Quota</th>
                                                             <th>Action</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>

                                                     </tbody>
                                                 </table> --}}

                                             <table
                                                 class="datatables-basic table table-striped myrequesttablecbox tasklist">
                                                 <thead>
                                                     <tr class="text-center">
                                                         <th>#</th>
                                                         <th>Registration</th>
                                                         <th>First Name</th>
                                                         <th>Last Name</th>
                                                         <th>DOJ</th>
                                                         <th>Quota</th>
                                                         <th>Action</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     @forelse($students ??[] as $index => $student)
                                                     <tr class="text-center">
                                                         <td>{{ $index + 1 }}</td>
                                                         <td>{{ $student->registration_number ?? '-' }}</td>
                                                         <td>{{ $student->name ?? '-' }}</td>
                                                         <td>{{ $student->last_name ?? '-' }}</td>
                                                         <td>{{ $student->doj ? \Carbon\Carbon::parse($student->doj)->format('d-m-Y') : '-' }}
                                                         </td>
                                                         <td>{{ $student->quota->quota_name ?? '-' }}</td>
                                                         <td>
                                                             <a href="{{ url('/student-detail-report/' . $student->userable_id) }}"
                                                                 class="btn btn-sm btn-primary">Get Report</a>
                                                         </td>
                                                     </tr>
                                                     @empty
                                                     <tr>
                                                         <td colspan="7" class="text-center">No matching student
                                                             found.</td>
                                                     </tr>
                                                     @endforelse
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
     $(document).ready(function() {
         var oldSection = $('#old_section').val();
         var initialBatch = $('#batch_name').val();

         if (initialBatch) {
             loadSections(initialBatch, oldSection);
         }

         $('#batch_name').change(function() {
             var batchId = $(this).val();
             loadSections(batchId, null);
         });

         function loadSections(batchId, selectedSection = null) {
             $('#section').html('<option value="">-----Select Section-----</option>');

             if (batchId) {
                 $.ajax({
                     url: "{{ route('get.batch.section.report') }}",
                     type: "POST",
                     data: {
                         batch_name: batchId,
                         _token: "{{ csrf_token() }}"
                     },
                     success: function(response) {
                         if (response.length > 0) {
                             $.each(response, function(index, item) {
                                 let selected = selectedSection == item.id ? 'selected' : '';
                                 $('#section').append(
                                     '<option value="' + item.id + '" ' + selected + '>' + item.name + '</option>'
                                 );
                             });
                             $('#section').prop('disabled', false);
                         } else {
                             $('#section').prop('disabled', true);
                         }
                     },
                     error: function(xhr) {
                         console.error("AJAX error:", xhr);
                     }
                 });
             } else {
                 $('#section').prop('disabled', true);
             }
         }
     });
 </script>

 @endsection