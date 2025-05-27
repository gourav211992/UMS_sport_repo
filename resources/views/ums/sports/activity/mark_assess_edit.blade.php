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

                            <form id="form" method="POST" action="{{ route('screening-details-edit') }}">
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
                                                        <label class="form-label">Date of Screening
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                    </div>

                                                    <div class="col-md-3 mb-1 mb-sm-0">
                                                        <input type="date" class="form-control"name='screening_date'
                                                            value="{{ \Carbon\Carbon::parse($screeningAssesment->screening_date)->format('Y-m-d') }}"
                                                            id="screening_date" />
                                                    </div>

                                                </div>

                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Batch Yr. <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <input type="hidden" id="id"
                                                        value="{{ $screeningAssesment->id }}">
                                                    <input type="hidden" id="selected_batch_year"
                                                        value="{{ $screeningAssesment->batch_year }}">
                                                    <input type="hidden" id="selected_batch_id"
                                                        value="{{ $screeningAssesment->batch_id }}">
                                                    <input type="hidden" id="selected_section_id"
                                                        value="{{ $screeningAssesment->section_id }}">
                                                    <input type="hidden" id="selected_group_id"
                                                        value="{{ $screeningAssesment->group_id }}">
                                                    <input type="hidden" id="selected_player_id"
                                                        value="{{ $screeningAssesment->registration_id }}">



                                                    <div class="col-md-3 mb-1 mb-sm-0">
                                                        <select class="form-select select2" name="batch_year"
                                                            id="batch_year">
                                                            <option value="" selected>-----Select Year-----</option>
                                                            @foreach ($batchs->pluck('batch_year')->unique() as $batch)
                                                                <option value="{{ $batch }}"
                                                                    {{ $batch == $screeningAssesment->batch_year ? 'selected' : '' }}>
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

                                                    <div class="col-md-2 mb-1 mb-sm-0">
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
                                                            {{-- <option value="1"
                                                                {{ $screeningAssesment->trainer_id == 1 ? 'selected' : '' }}>
                                                                ankit</option>
                                                            <option value="2"
                                                                {{ $screeningAssesment->trainer_id == 2 ? 'selected' : '' }}>
                                                                dhan</option>
                                                            <option value="3"
                                                                {{ $screeningAssesment->trainer_id == 3 ? 'selected' : '' }}>
                                                                danish</option> --}}

                                                            @foreach ($trainers as $item)
                                                                <option value={{ $item['id'] }}
                                                                    {{ $item['id'] == $screeningAssesment->trainer_id ? 'selected' : '' }}>
                                                                    {{ ucfirst($item['name']) }}
                                                                </option>
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
                                                                <option value={{ $screeningItem['id'] }}
                                                                    {{ $screeningItem['id'] == $screeningAssesment->screening_id ? 'selected' : '' }}>
                                                                    {{ $screeningItem['screening_name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('screening_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                        <input type="hidden" id="parmetersLength" value="">
                                                        <input type="hidden" id="selparmetersLength"
                                                            value="{{ count($sel_parameter_values) }}">
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
                                                                @foreach ($sel_parameter_values as $param)
                                                                    <tr>
                                                                        <td class="poprod-decpt">
                                                                            {{ $loop->index + 1 }}
                                                                        </td>
                                                                        <td class="poprod-decpt">
                                                                            <strong>{{ $param['parameter'] }}</strong>
                                                                            <input type="hidden"
                                                                                name="parametername{{ $loop->index + 1 }}"
                                                                                id="parametername{{ $loop->index + 1 }}"
                                                                                value="{{ $param['parameter'] }}">
                                                                        </td>
                                                                        <td><input type="text"
                                                                                name="response{{ $loop->index + 1 }}"
                                                                                id="response{{ $loop->index + 1 }}"
                                                                                class="form-control mw-100"
                                                                                placeholder="Enter Response"
                                                                                value="{{ $param['response'] }}"></td>
                                                                        <td><input type="text"
                                                                                name="comment{{ $loop->index + 1 }}"
                                                                                id="comment{{ $loop->index + 1 }}"
                                                                                class="form-control mw-100"
                                                                                placeholder="Enter Comments"
                                                                                value="{{ $param['comment'] }}"></td>

                                                                        <td><select class="form-select mw-100"
                                                                                name="rating{{ $loop->index + 1 }}"
                                                                                id="rating{{ $loop->index + 1 }}">
                                                                                <option value="">Select</option>
                                                                                @for ($i = 10; $i >= 1; $i--)
                                                                                    <option value="{{ $i }}"
                                                                                        {{ $param['rating'] == $i ? 'selected' : '' }}>
                                                                                        {{ $i }}</option>
                                                                                @endfor
                                                                            </select></td>
                                                                    </tr>
                                                                @endforeach
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

    <div class="sidenav-overlay">
    </div>
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

        let selectedBatchYear = $('#selected_batch_year').val();
        let selectedBatchId = $('#selected_batch_id').val();
        let selectedSectionId = $('#selected_section_id').val();
        let selectedGroupId = $('#selected_group_id').val();
        let selectedPlayerId = $('#selected_player_id').val();


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
                        tbody.empty(); // clear previous

                        if (response.length > 0) {
                            $.each(response, function(index, param) {
                                let row = `<tr>
                                    <td class="poprod-decpt">${index + 1}</td>
                                    <td class="poprod-decpt"><strong>${param.parametername}</strong>
                                        <input type="hidden"  name="parametername${index + 1}"   id="parametername${index + 1}" value="${param.parametername}">
                                                                               </td>
                                <td><input type="text" name="response${index + 1}"  id="response${index + 1}"  class="form-control mw-100" placeholder="Enter Response"></td>
                                <td><input type="text" name="comment${index + 1}" id="comment${index + 1}"  class="form-control mw-100" placeholder="Enter Comments"></td>
                                <td><select class="form-select mw-100" name="rating${index + 1}"  id="rating${index + 1}">
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
                                </select></td>
                                </tr>`;
                                tbody.append(row);
                            });
                        }
                    }
                })
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
                console.log("ssd", field.val())
                if (field.val().trim() === '') {
                    isValid = false;
                    field.addClass('is-invalid');
                    if ($('#' + fieldId + '-error').length === 0) {
                        $('<div>', {
                            id: fieldId + '-error',
                            class: 'text-danger',
                            text: 'required.'
                        }).insertAfter(field);
                    }
                }
            });

            $('select[id^="rating"]').each(function() {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');

                    // Add error message if needed
                    if (!$(this).next('.text-danger').length) {
                        $(this).after('<div class="text-danger">Rating is required.</div>');
                    }

                    isValid = false;
                }
            });


            if (!isValid) return;
            // Collect form data
            const formData = {};
            $('#form').find(':input').each(function() {
                const id = $(this).attr('id');
                if (id) {
                    formData[id] = $(this).val();
                }
            });

            const parameterArray = [];
            const totalParams = formData.parmetersLength != "" ? parseInt(formData.parmetersLength) :
                parseInt($("#selparmetersLength").val()) // Default to 13 if not found
            let paramValid = true;

            for (let i = 1; i <= totalParams; i++) {
                const name = formData[`parametername${i}`];
                const response = formData[`response${i}`];
                const comment = formData[`comment${i}`];
                const rating = formData[`rating${i}`];

                if (name) {
                    parameterArray.push({
                        parameter: name,
                        response,
                        comment,
                        rating
                    });
                }
            }

            // Final Payload
            const payload = {
                ...formData,
                parameters: parameterArray,
                _token: csrfToken
            };


            // Remove the separate parameter fields from the main object
            for (let i = 1; i <= totalParams; i++) {
                delete payload[`parametername${i}`];
                delete payload[`response${i}`];
                delete payload[`comment${i}`];
                delete payload[`rating${i}`];
            }

            // delete payload['selected_batch_id'];
            // delete payload['selected_batch_year'];
            // delete payload['selected_group_id'];
            // delete payload['selected_player_id'];
            // delete payload['selected_section_id'];


            console.log("payload", payload)
            // Submit via AJAX
            $.post("{{ route('screening-details-edit') }}", payload)
                .done(function(response) {
                    console.log("Updated successfully:", response);
                    toastr.success(response.message || 'Updated successfully');
                    setTimeout(() => {
                        window.location.href = "{{ url('screening-assessment') }}"

                    }, 3000);
                    // window.location.href = "{{ url('screening-assessment') }}"
                    // Show success or redirect
                })
                .fail(function(xhr) {
                    console.error("Submission failed:", xhr.responseText);
                });
        });




        if (selectedBatchYear) {
            $('#batch_year').val(selectedBatchYear).trigger('change');

            // Load batch names
            $.post("{{ route('get.batch.names.screening') }}", {
                batch_year: selectedBatchYear,
                _token: csrfToken
            }).done(function(batches) {
                const $batchName = $('#batch_name');
                batches.forEach(batch => {
                    $batchName.append(
                        `<option value="${batch.id}" ${selectedBatchId == batch.id ? 'selected' : ''}>${batch.batch_name}</option>`
                    );
                });
                $batchName.prop('disabled', false);

                // Step 2: Load sections
                $.post("{{ route('get.batch.section.screening') }}", {
                    batch_id: selectedBatchId,
                    _token: csrfToken
                }).done(function(sections) {
                    console.log("sections", sections)
                    const $section = $('#section_name');
                    sections.forEach(section => {
                        $section.append(
                            `<option value="${section.id}" ${selectedSectionId == section.id ? 'selected' : ''}>${section.name}</option>`
                        );
                    });
                    $section.prop('disabled', false);

                    // Step 3: Load groups
                    $.post("{{ route('get.section.group.screening') }}", {
                        section_id: selectedSectionId,
                        _token: csrfToken
                    }).done(function(groups) {
                        const $group = $('#group_name');
                        console.log("groups", groups)

                        groups.forEach(group => {
                            $group.append(
                                `<option value="${group.id}" ${selectedGroupId == group.id ? 'selected' : ''}>${group.name}</option>`
                            );
                        });
                        $group.prop('disabled', false);

                        // Step 4: Load players
                        $.post("{{ route('get.group.players.screening') }}", {
                            group: selectedGroupId,
                            _token: csrfToken
                        }).done(function(players) {
                            const $player = $('#player_name');
                            players.forEach(player => {
                                $player.append(
                                    `<option value="${player.id}" ${selectedPlayerId == player.id ? 'selected' : ''}>${player.name}</option>`
                                );
                            });
                            $player.prop('disabled', false);
                        });
                    });
                });
            });
        }


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
</script>
