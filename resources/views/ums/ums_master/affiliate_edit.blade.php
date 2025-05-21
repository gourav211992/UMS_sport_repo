@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper container-xxl p-0">
            @include('ums.admin.notifications')
            <div class="content-header pocreate-sticky">
                <div class="row">
                    <div class="content-header-left col-md-6 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Affiliate</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('affiliate')}}">Home</a></li>
                                        <li class="breadcrumb-item active">Add New</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                 

                    <div class="content-header-right text-sm-end col-md-6 mb-50 mb-sm-0">
                        <div class="form-group breadcrumb-right">
                            <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm mb-50 mb-sm-0">
                                <i data-feather="arrow-left-circle"></i> Back
                            </button>
                            <button type="submit" form="formdata" class="btn btn-primary btn-sm mb-50 mb-sm-0">
                                <i data-feather="check-circle"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <form id="formdata" action="{{ route('affiliate_update', $affiliatesData->id) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                                            {{-- Type --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Type <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    @php
                                                        $selectedType = old('type', $affiliatesData->type ?? '');
                                                    @endphp
                
                                                    @foreach (['College', 'University', 'School', 'Sports'] as $type)
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" id="type{{ $type }}" name="type"
                                                                value="{{ $type }}" class="form-check-input"
                                                                {{ trim($selectedType) === $type ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="type{{ $type }}">{{ $type }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('type')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                
                                            {{-- Affiliate Code --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Affiliate Code <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" name="affiliate_code" class="form-control @error('affiliate_code') is-invalid @enderror" 
                                                        value="{{ old('affiliate_code', $affiliatesData->affiliate_code) }}">
                                                    @error('affiliate_code')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Affiliate Name --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Affiliate Name <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" name="affiliate_name" class="form-control @error('affiliate_name') is-invalid @enderror" 
                                                        value="{{ old('affiliate_name', $affiliatesData->affiliate_name) }}">
                                                    @error('affiliate_name')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Head Office --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Head Office <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" name="head_office" class="form-control @error('head_office') is-invalid @enderror" 
                                                        value="{{ old('head_office', $affiliatesData->head_office) }}">
                                                    @error('head_office')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Address --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Address <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" 
                                                        value="{{ old('address', $affiliatesData->address) }}">
                                                    @error('address')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Country --}}
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Country <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="permanent_country" name="family_details[0][permanent_country]"
                                                        class="form-select @error('family_details.0.permanent_country') is-invalid @enderror" >
                                                        <option value="">Select</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}"
                                                                {{ old('family_details.0.permanent_country', $affiliatesData->country_id) == $country->id ? 'selected' : '' }}>
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('family_details.0.permanent_country')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- State --}}
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="permanent_state_id" name="family_details[0][permanent_state]"
                                                        class="form-control @error('family_details.0.permanent_state') is-invalid @enderror" >
                                                        <option value="">Select State</option>
                                                    </select>
                                                    @error('family_details.0.permanent_state')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- City --}}
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="permanent_district_id" name="family_details[0][permanent_district]"
                                                        class="form-control @error('family_details.0.permanent_district') is-invalid @enderror" >
                                                        <option value="">Select City</option>
                                                    </select>
                                                    @error('family_details.0.permanent_district')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Pincode --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Pincode <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" name="pincode" class="form-control @error('pincode') is-invalid @enderror" 
                                                        value="{{ old('pincode', $affiliatesData->pincode) }}">
                                                    @error('pincode')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Contact Person --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Contact Person <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" name="contact_person" class="form-control @error('contact_person') is-invalid @enderror" 
                                                        value="{{ old('contact_person', $affiliatesData->contact_person) }}">
                                                    @error('contact_person')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Email --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Email <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="email" name="email_id" class="form-control @error('email_id') is-invalid @enderror" 
                                                        value="{{ old('email_id', $affiliatesData->email_id) }}">
                                                    @error('email_id')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Mobile --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Mobile No. <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" name="mobile" maxlength="10" pattern="\d{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                                        class="form-control @error('mobile') is-invalid @enderror" 
                                                        value="{{ old('mobile', $affiliatesData->mobile) }}">
                                                    @error('mobile')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            {{-- Phone --}}
                                            <div class="mb-2 row">
                                                <label class="col-md-3 form-label">Phone No. <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" name="phone" maxlength="10" pattern="\d{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                                        class="form-control @error('phone') is-invalid @enderror" 
                                                        value="{{ old('phone', $affiliatesData->phone) }}">
                                                    @error('phone')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                            {{-- Status --}}
                                            <div class="col-md-3 border-start">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing">
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="active" name="status" class="form-check-input" value="Active"
                                                                    {{ $affiliatesData->status == 'Active' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="active">Active</label>
                                                            </div>
                                            
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="inactive" name="status" class="form-check-input" value="Inactive"
                                                                    {{ $affiliatesData->status == 'Inactive' ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="inactive">Inactive</label>
                                                            </div>
                                                            @error('status')
                                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                
                                        
                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                
                
            </section>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Replace with correct values for `country_id`, `state_id`, `city_id`
            const selectedCountry = "{{ old('family_details.0.permanent_country', $affiliatesData->country_id) }}";
            const selectedState = "{{ old('family_details.0.permanent_state', $affiliatesData->state_id) }}";
            const selectedCity = "{{ old('family_details.0.permanent_district', $affiliatesData->city_id) }}";

            if (selectedCountry) {
                loadStates(selectedCountry, 'permanent', selectedState, selectedCity);
            }
        });

        function loadStates(countryId, type, selectedState = null, selectedCity = null) {
            $.ajax({
                url: '/get-states/' + countryId,
                method: 'GET',
                success: function(data) {
                    let stateDropdown = $('#' + type + '_state_id'); // Updated to state_id
                    stateDropdown.empty().append('<option value="">Select State</option>');
                    $.each(data, function(_, state) {
                        let selected = selectedState == state.id ? 'selected' : '';
                        stateDropdown.append('<option value="' + state.id + '" ' + selected + '>' +
                            state.name + '</option>');
                    });

                    if (selectedState) {
                        loadCities(selectedState, type, selectedCity);
                    }
                }
            });
        }

        function loadCities(stateId, type, selectedCity = null) {
            $.ajax({
                url: '/get-cities/' + stateId,
                method: 'GET',
                success: function(data) {
                    let cityDropdown = $('#' + type + '_district_id'); // Updated to district_id
                    cityDropdown.empty().append('<option value="">Select City</option>');
                    $.each(data, function(_, city) {
                        let selected = selectedCity == city.id ? 'selected' : '';
                        cityDropdown.append('<option value="' + city.id + '" ' + selected + '>' + city
                            .name + '</option>');
                    });
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var selected_category = {!! json_encode($affiliatesData) !!};

            if (selected_category['status'] == 'Inactive') {
                $('#active').prop('checked', false);
                $('#inactive').prop('checked', true);
            } else {
                $('#active').prop('checked', true);
                $('#inactive').prop('checked', false);
            }
        });
    </script>

    <script>
        function submitCat(form) {
            if (document.getElementById('active').checked) {
                document.getElementById('affiliate_status').value = 'Active';
            } else {
                document.getElementById('affiliate_status').value = 'Inactive';
            }

            document.getElementById('edit_affiliate_form').submit();
        }
    </script>
@endsection
