@extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
    ;

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
                                <h2 class="content-header-title float-start mb-0">Assessment</h2>
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
                            <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0"><i
                                    data-feather="arrow-left-circle"></i> Back</button>
                            {{-- <button type="button"  id="submit" name="submit" --}}

                            <button form="form" id="submit" class="btn btn-primary btn-sm mb-50 mb-sm-0"><i
                                    data-feather="check-circle"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('ums.admin.notifications')

            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">

                            <form id="form" method="POST" action="{{ route('screening-details-add') }}">
                                @csrf

                                <div class="card">
                                    <div class="card-body customernewsection-form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div
                                                    class="newheader border-bottom mb-2 pb-25 d-flex flex-wrap justify-content-between">
                                                    <div>
                                                        <h4 class="card-title text-theme">Basic Information</h4>
                                                        <p class="card-text">Fill the details</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-8">

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Date of Screening <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <input type="date" class="form-control" id="screening_date"
                                                            name="screening_date">
                                                        @error('screening_date')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Yr. <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3 mb-1 mb-sm-0">
                                                        <select class="form-select select2" name="batch_year"
                                                            id="batch_year">
                                                            <option value="" selected>-----Select Year-----</option>
                                                            @foreach ($batchs->pluck('batch_year')->unique() as $batch)
                                                                <option value="{{ $batch }}">
                                                                    {{ ucfirst($batch) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('batch_year')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-2 mb-1 mb-sm-0">
                                                        <label class="form-label">Batch <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3 mb-1 mb-sm-0">
                                                        <select class="form-select select2"
                                                            name="batch_name"id="batch_name">
                                                            <option value="">Select</option>
                                                        </select>
                                                        @error('batch_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Section <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <select class="form-select select2" id="section_name"
                                                            name="section_name">
                                                            <option value="">Select</option>
                                                        </select>
                                                        @error('section_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2 mb-1 mb-sm-0">
                                                        <label class="form-label">Group <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <select class="form-select select2" id="group_name"
                                                            name="group_name">
                                                            <option value="">Select</option>
                                                        </select>
                                                        @error('group_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Player Name <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <select class="form-select select2" id="player_name"
                                                            name="player_name">
                                                            <option value="">Select</option>


                                                        </select>
                                                        @error('player_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Trainer <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <select class="form-select select2" id="trainer"
                                                            name="trainer">
                                                            <option value="">Select</option>
                                                            @foreach ($trainers as $item)
                                                                <option value={{ $item['id'] }}>
                                                                    {{ $item['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('trainer')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Screening <span
                                                                class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="col-md-3">

                                                        <select class="form-select select2" id="screening_name"
                                                            name="screening_name">
                                                            <option value="">Select</option>
                                                            @foreach ($screening as $screeningItem)
                                                                <option value={{ $screeningItem['id'] }}>
                                                                    {{ $screeningItem['screening_name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('screening_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                        {{-- <input type="hidden" id="parmetersLength" value=""> --}}
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
                                                            <h4 class="card-title text-theme">Assessment Details</h4>
                                                            <p class="card-text">View the details</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">


                                                    <div class="table-responsive pomrnheadtffotsticky">
                                                        <table
                                                            class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border newdesignerptable newdesignpomrnpad">
                                                            <thead>
                                                                <tr>
                                                                    <th width="30">#</th>
                                                                    <th>Parameter</th>
                                                                    <th>Response</th>
                                                                    <th> Remarks</th>
                                                                    <th>Rating</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="" id="screeniningDetails"
                                                                name="screeniningDetails[]">
                                                            </tbody>
                                                        </table>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal to add new record -->
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
@endsection
<style>
  .toast-success {
        background-color: #28a745 !important;
        color: white !important;
    }
    .toast-error {
        background-color: #dc3545 !important;
        color: white !important;
    }
    .toast-message {
        font-size: 14px;
    }
    


</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script>
    $(document).ready(function() {
        const csrfToken = "{{ csrf_token() }}";
        var today = new Date().toISOString().split('T')[0];
        $('input[type="date"]').attr('max', today);

        $('#screening_date').on('change', function() {
            const screening_date = $(this);
            if (screening_date.val().trim() !== '') {
                screening_date.removeClass('is-invalid');
                $('#screening_date-error').remove();
            }
        });


        $('#batch_year').on('change', function() {
            const batchYearEle = $(this);
            let batch_year = batchYearEle.val();
            if (batchYearEle.val().trim() !== '') {
                batchYearEle.removeClass('is-invalid');
                $('#batch_year-error').remove();
            }
            const $batchName = $('#batch_name');
            $batchName.html('<option value="" selected>-----Select Batch-----</option>').prop(
                'disabled', true);
            $('#section_name').html('<option value="" selected>-----Select Section-----</option>').prop(
                'disabled', true);

            if (!batch_year) return;
            $.post("{{ route('get.batch.names.screening') }}", {
                    batch_year: batch_year,
                    _token: csrfToken
                })
                .done(function(response) {
                    if (response.length > 0) {
                        response.forEach(item => {
                            $batchName.append(
                                `<option value="${item.id}">${item.batch_name}</option>`
                            );
                        });
                        $batchName.prop('disabled', false);
                    }
                })
                .fail(console.error);
        });

        $('#batch_name').on('change', function() {
            const batch_id = $(this).val();
            if (batch_id.trim() !== '') {
                $(this).removeClass('is-invalid');
                $('#batch_name-error').remove();
            }
            const $section_name = $('#section_name');

            $section_name.html('<option value="" selected>-----Select Section-----</option>').prop(
                'disabled', true);
            if (!batch_name) return;

            $.post("{{ route('get.batch.section.screening') }}", {
                    batch_id: batch_id,
                    _token: csrfToken
                })
                .done(function(response) {
                    if (response.length > 0) {
                        response.forEach(item => {
                            $section_name.append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });
                        $section_name.prop('disabled', false);
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                });
        });

        $('#section_name').on('change', function() {
            const section_id = $(this).val();
            if (section_id.trim() !== '') {
                $(this).removeClass('is-invalid');
                $('#section_name-error').remove();
            }

            const $group_name = $('#group_name');
            $group_name.html('<option value="" selected>-----Select Group-----</option>').prop(
                'disabled', true);
            if (!section_name) return;
            $.post("{{ route('get.section.group.screening') }}", {
                    section_id: section_id,
                    _token: csrfToken
                })
                .done(function(response) {
                    if (response.length > 0) {
                        response.forEach(item => {
                            $group_name.append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });
                        $group_name.prop('disabled', false);
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                })
        });

        $('#group_name').on('change', function() {
            const group_name = $(this).val();

            if (group_name.trim() !== '') {
                $(this).removeClass('is-invalid');
                $('#group_name-error').remove();
            }
            const $player_name = $('#player_name');
            $player_name.html('<option value="" selected>-----Select Group-----</option>').prop(
                'disabled', true);
            if (!group_name) return;
            $.post("{{ route('get.group.players.screening') }}", {
                    group: group_name,
                    _token: csrfToken
                })
                .done(function(response) {
                    if (response.length > 0) {
                        response.forEach(item => {
                            $player_name.append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });
                        $player_name.prop('disabled', false);
                    }
                })
                .fail(function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                })


        });

        $('#player_name').on('change', function() {
            const player_name = $(this).val();

            if (player_name.trim() !== '') {
                $(this).removeClass('is-invalid');
                $('#player_name-error').remove();
            }
        })


        $('#trainer').on('change', function() {
            const trainer = $(this).val();

            if (trainer.trim() !== '') {
                $(this).removeClass('is-invalid');
                $('#trainer-error').remove();
            }
        })

        $('#screening_name').on('change', function() {
            const screening_name = $(this).val();
            if (screening_name.trim() !== '') {
                $(this).removeClass('is-invalid');
                $('#screening_name-error').remove();
            }

            if (!screening_name) return;
            $.post("{{ url('get-screening-parameters') }}", {
                    screeningId: screening_name,
                    _token: csrfToken
                })


                .done(function(response) {
                    if (response.length > 0) {
                        $("#parmetersLength").val(response.length);
                        let tbody = $('#screeniningDetails');
                        tbody.empty();

                        $.each(response, function(index, param) {
                            let row = `<tr>
                                <td>${index + 1}</td>
                                <td>
                                    <strong>${param.parametername}</strong>
                                    <input type="hidden" name="parameters[${index}][parameter]" value="${param.parametername}">
                                </td>
                                <td><input type="text" name="parameters[${index}][response]" class="form-control" placeholder="Enter Response"></td>
                                <td><input type="text" name="parameters[${index}][comment]" class="form-control" placeholder="Enter Comments"></td>
                                <td>
                                    <select name="parameters[${index}][rating]" class="form-select">
                                        <option value="">Select</option>
                                        <option value="10">10</option>
                                        <option value="9">9</option>
                                        <option value="8">8</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>`;
                            tbody.append(row);
                        });
                    }
                })



                // .done(function(response) {
                //     if (response.length > 0) {
                //         $("#parmetersLength").val(response.length);

                //         let tbody = $('#screeniningDetails');
                //         tbody.empty(); // clear previous

                //         if (response.length > 0) {
                //             $.each(response, function(index, param) {


                //                 let row = `<tr>
                //                     <td>${index + 1}</td>
                //                     <td><strong>${param.parametername}</strong>
                //                         <input type="hidden" name="parameters[${index}][parameter]" value="${param.parametername}">
                //                     </td>
                //                     <td><input type="text" name="parameters[${index}][response]" class="form-control mw-100" placeholder="Enter Response"></td>
                //                     <td><input type="text" name="parameters[${index}][comment]" class="form-control mw-100" placeholder="Enter Comments"></td>
                //                     <td>
                //                         <select name="parameters[${index}][rating]" class="form-select mw-100">
                //                             <option value="">Select</option>
                //                             <option value="5">5</option>
                //                             <option value="4">4</option>
                //                             <option value="3">3</option>
                //                             <option value="2">2</option>
                //                             <option value="1">1</option>
                //                         </select>
                //                     </td>
                //                 </tr>`;



                //                 // let row = `<tr>
                //                 //     <td class="poprod-decpt">${index + 1}</td>
                //                 //     <td class="poprod-decpt"><strong>${param.parametername}</strong>
                //                 //         <input type="hidden"  name="parametername${index + 1}"   id="parametername${index + 1}" value="${param.parametername}">
                //                 //                                                </td>
                //                 // <td><input type="text" name="response${index + 1}"  id="response${index + 1}"  class="form-control mw-100" placeholder="Enter Response"></td>
                //                 // <td><input type="text" name="comment${index + 1}" id="comment${index + 1}"  class="form-control mw-100" placeholder="Enter Comments"></td>
                //                 // <td><select class="form-select mw-100" name="rating${index + 1}"  id="rating${index + 1}">
                //                 // <option value="">Select</option>
                //                 // <option value="5">5</option>
                //                 // <option value="4">4</option>
                //                 // <option value="3">3</option>
                //                 // <option value="2">2</option>
                //                 // <option value="1">1</option>
                //                 // </select></td>
                //                 // </tr>`;
                //                 tbody.append(row);
                //             });
                //         }
                //     }
                // })
                .fail(function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                })



        });

        $('#submit').on('click', function(e) {
            e.preventDefault();

            let isValid = true;
            const requiredFields = [
                'screening_date', 'batch_year', 'batch_name',
                'section_name', 'group_name', 'player_name',
                'trainer', 'screening_name'
            ];

            // Clear previous errors
            $('.is-invalid').removeClass('is-invalid');
            $('.text-danger').remove();

            // Validate required fields
            requiredFields.forEach(fieldId => {
                const field = $('#' + fieldId);
                if (field.val().trim() === '') {
                    isValid = false;
                    field.addClass('is-invalid');
                    $('<div>', {
                        id: fieldId + '-error',
                        class: 'text-danger',
                        text: 'required.'
                    }).insertAfter(field);
                }
            });

            if (!isValid) return;

            // Serialize form data
            const formData = $('#form').serialize();

            $.post("{{ route('screening-details-add') }}", formData)
                .done(function(response) {
                    toastr.success(response.message || 'Assessment saved');
                    setTimeout(() => {
                        window.location.href = "{{ url('screening-assessment') }}";
                    }, 3000);
                })
                .fail(function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'Something went wrong');
                    console.error(xhr.responseText);
                });
        });


//         $('#submit').on('click', function(e) {
//     e.preventDefault();

//     let isValid = true;
//     const requiredFields = [
//         'screening_date', 'batch_year', 'batch_name',
//         'section_name', 'group_name', 'player_name',
//         'trainer', 'screening_name'
//     ];

//     // Clear previous errors
//     $('.is-invalid').removeClass('is-invalid');
//     $('.text-danger').remove();

//     // Validate required fields
//     requiredFields.forEach(fieldId => {
//         const field = $('#' + fieldId);
//         if (field.val().trim() === '') {
//             isValid = false;
//             field.addClass('is-invalid');
//             if ($('#' + fieldId + '-error').length === 0) {
//                 $('<div>', {
//                     id: fieldId + '-error',
//                     class: 'text-danger',
//                     text: 'required.'
//                 }).insertAfter(field);
//             }
//         }
//     });

//     if (!isValid) return;

//     const csrfToken = "{{ csrf_token() }}";
    
//     // Build screening form data
//     const payload = {
//         screening_date: $('#screening_date').val(),
//         batch_year: $('#batch_year').val(),
//         batch_name: $('#batch_name').val(),
//         section_name: $('#section_name').val(),
//         group_name: $('#group_name').val(),
//         trainer: $('#trainer').val(),
//         player_name: $('#player_name').val(),
//         screening_name: $('#screening_name').val(),
//         parameters: [],
//         _token: csrfToken
//     };

//     // Get number of parameters from hidden input
//     const totalParams = parseInt($('#parmetersLength').val() || "0");

//     // Build parameters array
//     for (let i = 1; i <= totalParams; i++) {
//         const name = $(`#parametername${i}`).val();
//         const response = $(`#response${i}`).val();
//         const comment = $(`#comment${i}`).val();
//         const rating = $(`#rating${i}`).val();

//         if (name) {
//             payload.parameters.push({
//                 parameter: name,
//                 response: response,
//                 comment: comment,
//                 rating: rating
//             });
//         }
//     }

//     // Optional: debug
//     console.log("Submitting Payload:", payload);

//     // Submit via AJAX
//     $.post("{{ route('screening-details-add') }}", payload)
//         .done(function(response) {
//             toastr.success(response.message || 'Assessment added successfully');
//             setTimeout(function () {
//                 window.location.href = "{{ url('screening-assessment') }}";
//             }, 3000);
//         })
//         .fail(function(xhr) {
//             console.error("Submission failed:", xhr.responseText);
//             toastr.error(xhr.responseJSON?.message || 'An error occurred.');
//         });
// });



    //     $('#submit').on('click', function(e) {
    //         e.preventDefault();

    //         let isValid = true;
    //         const requiredFields = [
    //             'screening_date', 'batch_year', 'batch_name',
    //             'section_name', 'group_name', 'player_name',
    //             'trainer', 'screening_name'
    //         ];

    //         // Clear previous errors
    //         $('.is-invalid').removeClass('is-invalid');
    //         $('.text-danger').remove();

    //         // Validate required fields
    //         requiredFields.forEach(fieldId => {
    //             const field = $('#' + fieldId);
    //             if (field.val().trim() === '') {
    //                 isValid = false;
    //                 field.addClass('is-invalid');
    //                 if ($('#' + fieldId + '-error').length === 0) {
    //                     $('<div>', {
    //                         id: fieldId + '-error',
    //                         class: 'text-danger',
    //                         text: 'required.'
    //                     }).insertAfter(field);
    //                 }
    //             }
    //         });

    //         if (!isValid) return;
    //         // Collect form data
    //         const formData = {};
    //         $('#form').find(':input').each(function() {
    //             const id = $(this).attr('id');
    //             if (id) {
    //                 formData[id] = $(this).val();
    //             }
    //         });
            

    //         const parameterArray = [];
    //         const totalParams = parseInt(formData.parmetersLength); // Default to 13 if not found
    //         let paramValid = true;

    //         for (let i = 1; i <= totalParams; i++) {
    //             const name = formData[`parametername${i}`];
    //             const response = formData[`response${i}`];
    //             const comment = formData[`comment${i}`];
    //             const rating = formData[`rating${i}`];

    //             if (name) {
    //                 parameterArray.push({
    //                     parameter: name,
    //                     response,
    //                     comment,
    //                     rating
    //                 });
    //             }
    //         }

    //         // Final Payload
    //         const payload = {
    //             ...formData,
    //             parameters: parameterArray,
    //             _token: csrfToken
    //         };


    //         // Remove the separate parameter fields from the main object
    //         for (let i = 1; i <= formData.parmetersLength; i++) {
    //             delete payload[`parametername${i}`];
    //             delete payload[`response${i}`];
    //             delete payload[`comment${i}`];
    //             delete payload[`rating${i}`];
    //         }
    //         // Submit via AJAX
    //         $.post("{{ route('screening-details-add') }}", payload)
    //         .done(function(response) {
    //             console.log("Submitted successfully:", response);

    //             // Show the toast message
    //             toastr.success(response.message || 'Assessment added successfully');

    //             // Wait for 1.5 seconds before redirecting
    //             setTimeout(function () {
    //                 window.location.href = "{{ url('screening-assessment') }}";
    //             }, 3000);  // 1.5 seconds
    //         })
    //         .fail(function(xhr) {
    //     console.error("Submission failed:", xhr.responseText);
    //     toastr.error(xhr.responseJSON?.message || 'An error occurred.');
    // });

    //     });


    });

    // Function to handle error UI
    function markInvalid(field, id) {
        field.addClass('is-invalid');
        if ($(`#${id}-error`).length === 0) {
            $('<div>', {
                id: `${id}-error`,
                class: 'text-danger',
                text: 'required.'
            }).insertAfter(field);
        }
    }
//     toastr.success("This is a success message");
// toastr.error("This is an error message");

</script>

{{-- <!-- In your <head> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- Before </body> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     --}}
