@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    @include('ums.admin.notifications')
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
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

        <div class="content-body">
            <section id="basic-datatable">
                <form method="POST" id="formdata" action="{{ url('affiliate-add') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body customernewsection-form">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <!-- Type -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Type <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="demo-inline-spacing">
                                                        @foreach (['College', 'University', 'School', 'Sports'] as $type)
                                                            <div class="form-check form-check-primary mt-25">
                                                                <input type="radio" id="type{{ $type }}" name="type" value="{{ $type }}" class="form-check-input" {{ old('type') == $type ? 'checked' : '' }}>
                                                                <label class="form-check-label fw-bolder" for="type{{ $type }}">{{ $type }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @error('type')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Affiliate Code -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Affiliate Code <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="affiliate_code" class="form-control @error('affiliate_code') is-invalid @enderror" value="{{ old('affiliate_code') }}">
                                                    @error('affiliate_code')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Affiliate Name -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Affiliate Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="affiliate_name" class="form-control @error('affiliate_name') is-invalid @enderror" value="{{ old('affiliate_name') }}">
                                                    @error('affiliate_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Head Office -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Head Office <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="head_office" class="form-control @error('head_office') is-invalid @enderror" value="{{ old('head_office') }}">
                                                    @error('head_office')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Address -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Country -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Country <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select id="permanent_country" name="family_details[0][permanent_country]" class="form-select @error('family_details.0.permanent_country') is-invalid @enderror" onchange="loadStates(this.value, 'permanent')">
                                                        <option value="">Select</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->id }}" {{ old('family_details.0.permanent_country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('family_details.0.permanent_country')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- State -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">State<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="hidden" id="old_state" value="{{ old('family_details.0.permanent_state') }}">
                                                    <select id="permanent_state" name="family_details[0][permanent_state]" class="form-select @error('family_details.0.permanent_state') is-invalid @enderror" onchange="loadCities(this.value, 'permanent')">
                                                        @if(old('family_details.0.permanent_state') && $oldState)
                                                            <option value="{{ $oldState->id }}" selected>{{ $oldState->name }}</option>
                                                        @else
                                                            <option value="">Select State</option>
                                                        @endif
                                                    </select>
                                                    @error('family_details.0.permanent_state')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- City -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="hidden" id="old_city" value="{{ old('family_details.0.permanent_district') }}">
                                                    <select id="permanent_district" name="family_details[0][permanent_district]" class="form-select @error('family_details.0.permanent_district') is-invalid @enderror">
                                                        <option>Select City</option>
                                                    </select>
                                                    @error('family_details.0.permanent_district')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Pincode -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" maxlength="6" name="pincode" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}">
                                                    @error('pincode')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Contact Person -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Contact Person <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="contact_person" class="form-control @error('contact_person') is-invalid @enderror" value="{{ old('contact_person') }}">
                                                    @error('contact_person')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Email -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Email-ID <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="email" name="email_id" class="form-control @error('email_id') is-invalid @enderror" value="{{ old('email_id') }}">
                                                    @error('email_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Mobile -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="mobile" maxlength="10" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}">
                                                    @error('mobile')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- Phone -->
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="phone" maxlength="10" pattern="\d{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                
                                        </div>
                
                                        <!-- Status (unchanged) -->
                                        <div class="col-md-3 border-start">
                                            <div class="row align-items-center">
                                                <div class="col-md-12">
                                                    <label class="form-label text-primary"><strong>Status</strong></label>
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="active" name="status" value="Active" class="form-check-input" {{ old('status', 'Active') == 'Active' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="active">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" id="inactive" name="status" value="Inactive" class="form-check-input" {{ old('status') == 'Inactive' ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bolder" for="inactive">Inactive</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div> <!-- row -->
                                </div> <!-- card-body -->
                            </div> <!-- card -->
                        </div> <!-- col-12 -->
                    </div> <!-- row -->
                </form>
                
                
            </section>
        </div>
    </div>
</div>

<!-- AJAX Scripts for States and Cities -->
{{-- <script>
    function loadStates(countryId, addressType) {
    var stateSelect = document.getElementById(addressType + '_state');
    var citySelect = document.getElementById(addressType + '_district');
    stateSelect.innerHTML = '<option>Loading...</option>';
    citySelect.innerHTML = '<option>Select City</option>';

    if (countryId) {
        fetch('/get-states/' + countryId)
            .then(response => response.json())
            .then(data => {
                stateSelect.innerHTML = '<option>Select State</option>';
                data.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                });
            });
    }
}

function loadCities(stateId, addressType) {
    var citySelect = document.getElementById(addressType + '_district');
    citySelect.innerHTML = '<option>Loading...</option>';

    if (stateId) {
        fetch('/get-cities/' + stateId)
            .then(response => response.json())
            .then(data => {
                citySelect.innerHTML = '<option>Select City</option>';
                data.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
            });
    }
}

</script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let oldCountry = document.getElementById('permanent_country').value;
        let oldState = document.getElementById('old_state').value;
        let oldCity = document.getElementById('old_city').value;
    
        if (oldCountry) {
            loadStates(oldCountry, 'permanent', oldState, oldCity);
        }
    });
    
    function loadStates(countryId, addressType, selectedStateId = null, selectedCityId = null) {
        let stateSelect = document.getElementById(addressType + '_state');
        let citySelect = document.getElementById(addressType + '_district');
        stateSelect.innerHTML = '<option>Loading...</option>';
        citySelect.innerHTML = '<option>Select City</option>';
    
        fetch('/get-states/' + countryId)
            .then(res => res.json())
            .then(data => {
                stateSelect.innerHTML = '<option>Select State</option>';
                data.forEach(state => {
                    let selected = selectedStateId == state.id ? 'selected' : '';
                    stateSelect.innerHTML += `<option value="${state.id}" ${selected}>${state.name}</option>`;
                });
    
                if (selectedStateId) {
                    loadCities(selectedStateId, addressType, selectedCityId);
                }
            });
    }
    
    function loadCities(stateId, addressType, selectedCityId = null) {
        let citySelect = document.getElementById(addressType + '_district');
        citySelect.innerHTML = '<option>Loading...</option>';
    
        fetch('/get-cities/' + stateId)
            .then(res => res.json())
            .then(data => {
                citySelect.innerHTML = '<option>Select City</option>';
                data.forEach(city => {
                    let selected = selectedCityId == city.id ? 'selected' : '';
                    citySelect.innerHTML += `<option value="${city.id}" ${selected}>${city.name}</option>`;
                });
            });
    }
    </script>
    
@endsection
