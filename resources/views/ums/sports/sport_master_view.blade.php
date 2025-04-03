@extends('ums.sports.sports-meta.admin-sports-meta')

@section('content')
{{-- content --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-6 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Sport Master View</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('sport-master')}}">Home</a></li>
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>
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
                                        <div class="newheader border-bottom mb-2 pb-25">
                                            <h4 class="card-title text-theme">ReadOnly Information</h4>
                                            <p class="card-text">ReadOnly details</p>
                                        </div>
                                    </div>
                                  
                                        <div class="col-md-9">
                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Type</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-select" name="sport_type" disabled>
                                                        <option value="" selected>-----Select-----</option>
                                                        @foreach ($SportType as $type)
                                                            <option value="{{ $type->id }}" @if($sportMaster->sport_type == $type->id) selected @endif>
                                                                {{ ucfirst($type->type) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row align-items-center mb-1">
                                                <div class="col-md-3">
                                                    <label class="form-label">Sport Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" disabled name="sport_name" class="form-control" value="{{ old('sport_name', $sportMaster->sport_name) }}" />
                                                </div>
                                            </div>

                                            <div class="row align-items-center mb-2">
                                                <div class="col-md-3">
                                                    <label class="form-label">Status</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" disabled id="closeStatus" name="status" value="inactive" class="form-check-input" @if($sportMaster->status == 'inactive') checked @endif>
                                                            <label class="form-check-label fw-bolder" for="inactive">Inactive</label>
                                                        </div>
                                                        <div class="form-check form-check-primary mt-25">
                                                            <input type="radio" disabled id="openStatus" name="status" value="active" class="form-check-input" @if($sportMaster->status == 'active') checked @endif>
                                                            <label class="form-check-label fw-bolder" for="active">Active</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button onClick="javascript: history.go(-1)" class="btn btn-secondary btn-sm"><i data-feather="arrow-left-circle"></i> Back</button>
                                               
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
{{-- content --}}
@endsection
