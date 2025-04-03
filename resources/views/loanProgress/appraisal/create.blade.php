@extends('layouts.app')

@section('styles')
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        <div class="content-wrapper container-xxl p-0">

            <!-- Header -->
            <div class="content-header pocreate-sticky">
                <div class="row">
                    <div class="content-header-left col-md-6 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Update Appraisal</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                            <button form="appraisal-form"
                                class="btn btn-outline-primary btn-sm mb-50 mb-sm-0 submission_val" data-val="draft"><i
                                    data-feather="save"></i> Save as draft</button>
                            <button form="appraisal-form" class="btn btn-primary btn-sm mb-50 mb-sm-0 submission_val"
                                data-val="submitted"><i data-feather="check-circle"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Body -->
            <div class="content-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div id="success-message" style="display: none;" class="alert alert-success"></div>

                <div id="error-message" style="display: none;" class="alert alert-danger">
                    <ul id="error-list"></ul>
                </div>

                <section id="basic-datatable">
                    <form id="appraisal-form" method="POST" action="{{ route('loanAppraisal.save') }}"
                        enctype='multipart/form-data'>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body customernewsection-form">

                                        <!-- Main Form -->
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

                                            <div class="col-md-6">
                                                <input type="hidden" name="loan_id" id="loan_id"
                                                    value="{{ $loanAppraisal->loan_id ?? ($loan->id ?? '') }}">
                                                <input type="hidden" name="loan_amount" id="loan_amount"
                                                    value="{{ $loan->loan_amount ?? '' }}">
                                                <input type="hidden" name="status" id="status"
                                                    value="{{ $loanAppraisal->status ?? '' }}">
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Application No. <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="application_no"
                                                            id="application_no"
                                                            value="{{ $loanAppraisal->application_no ?? ($loan->appli_no ?? '') }}"
                                                            readonly />
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Name of Unit <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="unit_name"
                                                            id="unit_name" value="{{ $loanAppraisal->unit_name ?? '' }}" />
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Name of Proprietor <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="proprietor_name"
                                                            id="proprietor_name"
                                                            value="{{ $loanAppraisal->proprietor_name ?? ($loan->name ?? '') }}"
                                                            readonly>
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Address <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="address"
                                                            id="address"
                                                            value="{{ $loanAppraisal->address ?? ($loan->address ?? '') }}">
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Project Cost<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="project_cost"
                                                            id="project_cost" oninput="calculate_contribution()"
                                                            value="{{ $loanAppraisal->project_cost ?? '' }}">
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Term Loan<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="term_loan"
                                                            id="term_loan" oninput="calculate_contribution()"
                                                            value="{{ $loan->loan_amount ?? '' }}" required>
                                                        <p class="error text-danger contri_error"></p>
                                                        @error('term_loan')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Promotor's Contribution <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control"
                                                            name="promotor_contribution" id="promotor_contribution"
                                                            readonly
                                                            value="{{ $loanAppraisal->promotor_contribution ?? '' }}">
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Cibil Score <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="cibil_score"
                                                            id="cibil_score"
                                                            value="{{ $loanAppraisal->cibil_score ?? '' }}" />
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Interest Rate (P.A) <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="interest_rate"
                                                            id="interest_rate"
                                                            value="{{ $loanAppraisal->interest_rate ?? '' }}" />
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Loan Peroid <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control" name="loan_period"
                                                            id="loan_period"
                                                            value="{{ $loanAppraisal->loan_period ?? '' }}">
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Repayment Type <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select mw-100" name="repayment_type"
                                                            id="repayment_type" onchange="year()">
                                                            <option value="">Select</option>
                                                            <option
                                                                {{ $loanAppraisal && $loanAppraisal->repayment_type == 1 ? 'selected' : '' }}
                                                                value="1">Yearly</option>
                                                            <option
                                                                {{ $loanAppraisal && $loanAppraisal->repayment_type == 2 ? 'selected' : '' }}
                                                                value="2">Half-Yearly</option>
                                                            <option
                                                                {{ $loanAppraisal && $loanAppraisal->repayment_type == 3 ? 'selected' : '' }}
                                                                value="3">Quarterly</option>
                                                            <option
                                                                {{ $loanAppraisal && $loanAppraisal->repayment_type == 4 ? 'selected' : '' }}
                                                                value="4">Monthly</option>
                                                        </select>
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">No. of Installment(s) <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control"
                                                            name="no_of_installments" id="no_of_installments"
                                                            value="{{ $loanAppraisal->no_of_installments ?? '' }}"
                                                            readonly>
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div>
                                                {{-- <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Repayment Start After <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select" name="repayment_start_after"
                                                            id="repayment_start_after">
                                                            <option value="">Select</option>
                                                            <option
                                                                {{ $loanAppraisal && $loanAppraisal->repayment_start_after == '1st Disbursement' ? 'selected' : '' }}
                                                                value="1st Disbursement">1st Disbursement</option>
                                                            <option
                                                                {{ $loanAppraisal && $loanAppraisal->repayment_start_after == '2nd Disbursement' ? 'selected' : '' }}
                                                                value="2nd Disbursement">2nd Disbursement</option>
                                                        </select>
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                </div> --}}
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Repayment Start Period <span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-3 pe-0">
                                                        <input type="number" class="form-control"
                                                            name="repayment_start_period" id="repayment_start_period"
                                                            value="{{ $loanAppraisal->repayment_start_period ?? '' }}">
                                                        <p class="error text-danger"></p>
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label year"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tab Form -->
                                        <div class="col-md-12">
                                            <div class="mt-2">

                                                <div class="step-custhomapp bg-light">
                                                    <ul class="nav nav-tabs my-25 custapploannav" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab"
                                                                href="#Report">Detail Project Report</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab"
                                                                href="#Disbursal">Disbursal Schedule</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab"
                                                                href="#Recovery">Recovery Schedule</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab"
                                                                href="#Documentsupload">KYC Documents</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="tab-content ">
                                                    <div class="tab-pane active" id="Report">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">DPR Template<span
                                                                                class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <select class="form-select" name="dpr_template"
                                                                            id="dpr_template">
                                                                            <option value="">Select</option>
                                                                            @if (!empty($dpr_templates))
                                                                                @foreach ($dpr_templates as $template)
                                                                                    <option
                                                                                        {{ $loanAppraisal && !empty($loanAppraisal->dpr[0]) && $loanAppraisal->dpr[0]->dpr_template_id == $template->id ? 'selected' : '' }}
                                                                                        value="{{ $template->id }}">
                                                                                        {{ $template->template_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            @endif

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div id="dprFieldsContainer" class="row">
                                                                @if (!empty($loanAppraisal->dpr))
                                                                    @foreach ($loanAppraisal->dpr as $dpr)
                                                                        <div class="col-md-6">
                                                                            <div class="row align-items-center mb-1">
                                                                                <div class="col-md-4">
                                                                                    <label
                                                                                        class="form-label">{{ $dpr->dpr->field_name }}<span
                                                                                            class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="dpr[{{ $dpr->dpr_id }}]"
                                                                                        placeholder="Enter {{ $dpr->dpr->field_name }}"
                                                                                        value="{{ $dpr->dpr_value }}">
                                                                                    <p class="error text-danger"></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="Disbursal">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Disbursal Milestone <span
                                                                                        class="text-danger">*</span></th>
                                                                                <th>Disbursal Amount <span
                                                                                        class="text-danger">*</span></th>
                                                                                <th>Remarks <span
                                                                                        class="text-danger">*</span>
                                                                                </th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="disbursalTable">
                                                                            @if (!empty($loanAppraisal->disbursal))
                                                                                @php
                                                                                    $i = 0;
                                                                                @endphp
                                                                                @foreach ($loanAppraisal->disbursal as $disbursal)
                                                                                    <tr>
                                                                                        <td>{{ $i + 1 }}</td>
                                                                                        <td>
                                                                                            <input type="text"
                                                                                                name="disbursal_milestone[{{ $i }}]"
                                                                                                id="disbursal_milestone_{{ $i }}"
                                                                                                required
                                                                                                value="{{ old('disbursal_milestone.' . $i, $disbursal->milestone) }}"
                                                                                                class="form-control mw-100">
                                                                                            @error('disbursal_milestone.' .
                                                                                                $i)
                                                                                                <p class="error text-danger">
                                                                                                    {{ $message }}</p>
                                                                                            @enderror
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="number"
                                                                                                name="disbursal_amount[{{ $i }}]"
                                                                                                id="disbursal_amount_{{ $i }}"
                                                                                                required
                                                                                                value="{{ old('disbursal_amount.' . $i, $disbursal->amount) }}"
                                                                                                class="form-control mw-100">
                                                                                            @error('disbursal_amount.' . $i)
                                                                                                <p class="error text-danger">
                                                                                                    {{ $message }}</p>
                                                                                            @enderror
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="text"
                                                                                                name="disbursal_remarks[{{ $i }}]"
                                                                                                id="disbursal_remarks_{{ $i }}"
                                                                                                value="{{ old('disbursal_remarks.' . $i, $disbursal->remarks) }}"
                                                                                                class="form-control mw-100">
                                                                                            @error('disbursal_remarks.' .
                                                                                                $i)
                                                                                                <p class="error text-danger">
                                                                                                    {{ $message }}</p>
                                                                                            @enderror
                                                                                        </td>
                                                                                        <td>
                                                                                            <a href="#"
                                                                                                class="text-primary addDisbursal">
                                                                                                <i data-feather="plus-square"
                                                                                                    class="me-50"></i>
                                                                                            </a>
                                                                                            <a href="#"
                                                                                                class="text-primary deleteDisbursal">
                                                                                                <i
                                                                                                    data-feather="trash-2"></i>
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @php
                                                                                        $i++;
                                                                                    @endphp
                                                                                @endforeach
                                                                            @else
                                                                                <tr>
                                                                                    <td>1</td>
                                                                                    <td>
                                                                                        <input type="text"
                                                                                            name="disbursal_milestone[0]"
                                                                                            id="disbursal_milestone_0"
                                                                                            value="{{ old('disbursal_milestone.0') }}"
                                                                                            class="form-control mw-100">
                                                                                        @error('disbursal_milestone.0')
                                                                                            <p class="error text-danger">
                                                                                                {{ $message }}</p>
                                                                                        @enderror
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text"
                                                                                            name="disbursal_amount[0]"
                                                                                            id="disbursal_amount_0"
                                                                                            value="{{ old('disbursal_amount.0', App\Helpers\Helper::formatIndianNumber($loan->loan_amount)) }}"
                                                                                            required
                                                                                            class="form-control mw-100 disbursal_amount">
                                                                                        @error('disbursal_amount.0')
                                                                                            <p class="error text-danger">
                                                                                                {{ $message }}</p>
                                                                                        @enderror
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text"
                                                                                            name="disbursal_remarks[0]"
                                                                                            id="disbursal_remarks_0"
                                                                                            value="{{ old('disbursal_remarks.0') }}"
                                                                                            class="form-control mw-100">
                                                                                        @error('disbursal_remarks.0')
                                                                                            <p class="error text-danger">
                                                                                                {{ $message }}</p>
                                                                                        @enderror
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="#"
                                                                                            class="text-primary addDisbursal">
                                                                                            <i data-feather="plus-square"
                                                                                                class="me-50"></i>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        </tbody>

                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="Recovery">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="table-responsive">
                                                                    <table id="repaymentTable"
                                                                        class="table myrequesttablecbox table-striped po-order-detail custnewpo-detail border">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th width="100px">Year</th>
                                                                                <th class="text-end">Amt. at Start</th>
                                                                                <th class="text-end">Interest Amt.</th>
                                                                                <th class="text-end">Repayemnt Amt.</th>
                                                                                <th class="text-end">Amount at End <span
                                                                                        class="text-danger">*</span></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @if (!empty($loanAppraisal->recovery))
                                                                                @php
                                                                                    $i = 0;
                                                                                    $totalInterest = 0;
                                                                                    $totalRepayment = 0;
                                                                                @endphp
                                                                                @foreach ($loanAppraisal->recovery as $recovery)
                                                                                    <tr>
                                                                                        <td>{{ $i + 1 }}</td>
                                                                                        <td><input type="text"
                                                                                                class="form-control mw-100 text-end"
                                                                                                name="year[{{ $i }}]"
                                                                                                id="year_{{ $i }}"
                                                                                                value="{{ $recovery->year }}"
                                                                                                readonly></td>
                                                                                        <td><input type="text"
                                                                                                class="form-control mw-100 text-end"
                                                                                                name="start_amount[{{ $i }}]"
                                                                                                id="start_amount_{{ $i }}"
                                                                                                value="{{ App\Helpers\Helper::removeCommas($recovery->start_amount) }}"
                                                                                                readonly></td>
                                                                                        <td><input type="text"
                                                                                                class="form-control mw-100 text-end"
                                                                                                name="interest_amount[{{ $i }}]"
                                                                                                id="interest_amount_{{ $i }}"
                                                                                                value="{{ App\Helpers\Helper::removeCommas($recovery->interest_amount) }}"
                                                                                                readonly></td>
                                                                                        <td><input type="text"
                                                                                                class="form-control mw-100 text-end"
                                                                                                name="repayment_amount[{{ $i }}]"
                                                                                                id="repayment_amount_{{ $i }}"
                                                                                                value="{{ App\Helpers\Helper::removeCommas($recovery->repayment_amount) }}"
                                                                                                readonly></td>
                                                                                        <td><input type="text"
                                                                                                class="form-control mw-100 text-end"
                                                                                                name="end_amount[{{ $i }}]"
                                                                                                id="end_amount_{{ $i }}"
                                                                                                value="{{ App\Helpers\Helper::removeCommas($recovery->end_amount) }}"
                                                                                                readonly></td>
                                                                                    </tr>
                                                                                    @php
                                                                                        $i++;
                                                                                        $totalInterest +=
                                                                                            $recovery->interest_amount;
                                                                                        $totalRepayment +=
                                                                                            $recovery->repayment_amount;
                                                                                    @endphp
                                                                                @endforeach
                                                                                <tr>
                                                                                    <td colspan="3"
                                                                                        class="fw-bolder text-dark">Total
                                                                                    </td>
                                                                                    <td class="fw-bolder text-dark">
                                                                                        {{ App\Helpers\Helper::formatIndianNumber($totalInterest) }}</td>
                                                                                    <td class="fw-bolder text-dark">
                                                                                        {{ App\Helpers\Helper::formatIndianNumber($totalRepayment) }}</td>
                                                                                    <td>&nbsp;</td>
                                                                                </tr>
                                                                            @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="Documentsupload">
                                                        <div class="table-responsive-md">
                                                            <table
                                                                class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Document Name</th>
                                                                        <th>Upload File</th>
                                                                        <th>Attachments</th>
                                                                        <th width="40px">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tableDoc">
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>
                                                                            <select class="form-select mw-100"
                                                                                name="documentname[0]">
                                                                                <option value="">Select</option>
                                                                                @foreach ($doc_type as $document)
                                                                                    <option value="{{ $document->name }}">
                                                                                        {{ ucwords(str_replace('-', ' ', $document->name)) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type="file" multiple
                                                                                class="form-control mw-100"
                                                                                name="attachments[0][]"
                                                                                id="attachments-0">
                                                                        </td>
                                                                        <td id="preview-0">
                                                                        </td>
                                                                        <td><a href="#"
                                                                                class="text-primary addRow"><i
                                                                                    data-feather="plus-square"></i></a>
                                                                        </td>
                                                                    </tr>

                                                                    @if (!empty($loanAppraisal->document))
                                                                        @php
                                                                            $groupedDocuments = $loanAppraisal->document->groupBy(
                                                                                'document_type',
                                                                            );
                                                                            $i = 1;
                                                                        @endphp

                                                                        @foreach ($groupedDocuments as $documentType => $documents)
                                                                            <tr>
                                                                                <td>{{ $i + 1 }}</td>
                                                                                <td>
                                                                                    <select class="form-select mw-100"
                                                                                        disabled>
                                                                                        <option value="">Select
                                                                                        </option>
                                                                                        @foreach ($doc_type as $document)
                                                                                            <option
                                                                                                {{ $documentType == $document->name ? 'selected' : '' }}
                                                                                                value="{{ $document->name }}">
                                                                                                {{ ucwords(str_replace('-', ' ', $document->name)) }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="file" multiple
                                                                                        class="form-control mw-100"
                                                                                        disabled>

                                                                                </td>
                                                                                <td id="preview-{{ $i }}">
                                                                                    @foreach ($documents as $key1 => $doc)
                                                                                        @php
                                                                                            // Extract file extension
                                                                                            $extension = pathinfo(
                                                                                                $doc->document,
                                                                                                PATHINFO_EXTENSION,
                                                                                            );
                                                                                            // Set default icon
                                                                                            $icon = 'file-text';
                                                                                            switch (
                                                                                                strtolower($extension)
                                                                                            ) {
                                                                                                case 'pdf':
                                                                                                    $icon = 'file';
                                                                                                    break;
                                                                                                case 'doc':
                                                                                                case 'docx':
                                                                                                    $icon = 'file';
                                                                                                    break;
                                                                                                case 'xls':
                                                                                                case 'xlsx':
                                                                                                    $icon = 'file';
                                                                                                    break;
                                                                                                case 'png':
                                                                                                case 'jpg':
                                                                                                case 'jpeg':
                                                                                                case 'gif':
                                                                                                    $icon = 'image';
                                                                                                    break;
                                                                                                case 'zip':
                                                                                                case 'rar':
                                                                                                    $icon = 'archive';
                                                                                                    break;
                                                                                                default:
                                                                                                    $icon = 'file';
                                                                                                    break;
                                                                                            }
                                                                                        @endphp
                                                                                        <div class="image-uplodasection expenseadd-sign"
                                                                                            data-file-index="{{ $key1 }}">
                                                                                            <a href="{{ asset('documents/' . $doc->document) }}"
                                                                                                target="_blank"><i
                                                                                                    data-feather="{{ $icon }}"
                                                                                                    class="fileuploadicon"></i></a>
                                                                                            <input type="hidden"
                                                                                                name="oldattachments[{{ $i }}][]"
                                                                                                value="{{ $doc->document }}">

                                                                                        </div>
                                                                                    @endforeach
                                                                                </td>
                                                                                <td>
                                                                                    @php
                                                                                        $ids = '';
                                                                                        foreach ($documents as $doc) {
                                                                                            if ($ids == '') {
                                                                                                $ids = $doc->id;
                                                                                            } else {
                                                                                                $ids =
                                                                                                    $ids .
                                                                                                    '#' .
                                                                                                    $doc->id;
                                                                                            }
                                                                                        }
                                                                                    @endphp

                                                                                    <a href="#"
                                                                                        class="text-danger deleteDocument"
                                                                                        data-id="{{ $ids }}"><i
                                                                                            data-feather="trash-2"></i></a>
                                                                                    @php $i++;@endphp
                                                                                </td>

                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>


                                                            </table>
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
                    <!-- Modal to add new record -->
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Repayment Start Period</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body max_value">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-start" id="rescdule" tabindex="-1" aria-labelledby="myModalLabel17"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h4 class="modal-title fw-bolder text-dark namefont-sizenewmodal" id="myModalLabel17">Select
                            Pending
                            Disbursal</h4>
                        <p class="mb-0">Select from the below list</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-1">
                                <label class="form-label">Loan Type</label>
                                <select class="form-select">
                                    <option>Select</option>
                                    <option>Home Loan</option>
                                    <option>Vehicle Loan</option>
                                    <option>Term Loan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1">
                                <label class="form-label">Customer Name</label>
                                <select class="form-select select2">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1">
                                <label class="form-label">Application No.</label>
                                <select class="form-select select2">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3  mb-1">
                            <label class="form-label">&nbsp;</label><br />
                            <button class="btn btn-warning btn-sm"><i data-feather="search"></i> Search</button>
                        </div>

                        <div class="col-md-12">


                            <div class="table-responsive">
                                <table class="mt-1 table myrequesttablecbox table-striped po-order-detail">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Application No.</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Loan Type</th>
                                            <th>Disbursal Milestone</th>
                                            <th>Disbursal Amt.</th>
                                            <th>Mobile No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-primary">
                                                    <input type="radio" id="customColorRadio3" name="customColorRadio3"
                                                        class="form-check-input" checked="">
                                                </div>
                                            </td>
                                            <td>HL/2024/001</td>
                                            <td>20-07-2024</td>
                                            <td class="fw-bolder text-dark">Kundan Kumar</td>
                                            <td>Term</td>
                                            <td>1st floor completed</td>
                                            <td>200000</td>
                                            <td>9876787656</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check form-check-primary">
                                                    <input type="radio" id="customColorRadio3" name="customColorRadio3"
                                                        class="form-check-input" checked="">
                                                </div>
                                            </td>
                                            <td>HL/2024/001</td>
                                            <td>20-07-2024</td>
                                            <td class="fw-bolder text-dark">Kundan Kumar</td>
                                            <td>Term</td>
                                            <td>2nd floor completed</td>
                                            <td>200000</td>
                                            <td>nishu@gmail.com</td>
                                        </tr>





                                    </tbody>


                                </table>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer text-end">
                    <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i
                            data-feather="x-circle"></i>
                        Cancel</button>
                    <button class="btn btn-primary btn-sm" data-bs-dismiss="modal"><i data-feather="check-circle"></i>
                        Process</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('scripts')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })


        $(function() {
            $(".ledgerselecct").autocomplete({
                source: [
                    "Furniture (IT001)",
                    "Chair (IT002)",
                    "Table (IT003)",
                    "Laptop (IT004)",
                    "Bags (IT005)",
                ],
                minLength: 0
            }).focus(function() {
                if (this.value == "") {
                    $(this).autocomplete("search");
                }
            });
        });


        // -------------------- Form Handling Javascript (Starts) -------------------- //
        $(document).on('submit', '#appraisal-form', function(event) {
            event.preventDefault();

            // Reset messages and error highlights
            $('#success-message').hide().text('');
            $('#error-message').hide();
            $('#error-list').empty();
            $("button[type=submit]").prop('disabled', true);



            // Prepare form data, including file input handling
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('loanAppraisal.save') }}', // Your form action URL
                type: 'POST',
                data: formData, // Send FormData object
                dataType: 'json',
                contentType: false, // Required for file upload
                processData: false, // Prevent jQuery from processing the data
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false); // Enable submit button

                    if (response.status === true) {
                        // On success, reset the form and display the success message
                        $("input[type='text'],input[type='number'],select").removeClass('is-invalid');
                        $('#appraisal-form')[0].reset();
                        $('#success-message').text(response.message).show();
                        window.location.href = '{{ route('loanAppraisal.index') }}'
                    } else {
                        // On validation errors, show errors and highlight fields
                        var errors = response.errors;
                        $("input[type='text'],input[type='number'],select").removeClass('is-invalid');

                        // Loop through the errors and display them
                        $.each(errors, function(key, value) {
                            $(`#${key}`).addClass('is-invalid');
                            $('#error-list').append('<li>' + value[0] + '</li>');
                        });

                        // Show the error message block
                        $('#error-message').show();
                    }
                },
                error: function(jqXHR, exception) {
                    $("button[type=submit]").prop('disabled', false); // Enable submit button on error
                    console.log("An error occurred:", exception);
                    $('#error-message').text('Something went wrong, please try again.').show();
                }
            });
        });


        // Manage Status Input
        document.addEventListener('DOMContentLoaded', function() {
            $('.submission_val').click(function() {
                let data_val = $(this).attr('data-val');
                $("#status").val(data_val);
            });
        });

        $(document).on('keyup', '#term_loan', function() {
            $('#disbursal_amount_0').val(formatIndianNumber($(this).val()))
        });

        // Fetch Interest Rate
        document.addEventListener('DOMContentLoaded', function() {
            $('#cibil_score').on('input', function() {
                let cibil_score = $(this).val();
                $.ajax({
                    url: '{{ route('loanAppraisal.getInterestRate') }}',
                    method: 'POST',
                    data: {
                        cibil_score: cibil_score
                    },
                    success: function(response) {
                        let interestRate = response.base_rate;
                        $('#interest_rate').val(interestRate);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching helper value:', error);
                        $('#interest_rate').val('');
                    }
                });
            });
        });

        function calculateLoanRepayment(loanAmount, interestRate, numYears, gracePeriod) {
            let repaymentSchedule = [];
            let remainingBalance = loanAmount;
            let interestRateDecimal = interestRate / 100;

            // let Repayment = $("#repayment_start_after").val();
            // if (Repayment == '1st Disbursement') {
            //     gracePeriod = 1;
            // }
            // if (Repayment == '2nd Disbursement') {
            //     gracePeriod = 2;
            // }
            let Repayment = removeCommas($("#repayment_start_period").val());
            gracePeriod = Repayment;

            console.log(gracePeriod);

            let principalPerYear = loanAmount / (numYears - gracePeriod);


            console.log(principalPerYear);

            // Year 1 - Grace period, no repayment
            let interestFirstYear = parseFloat((remainingBalance * interestRateDecimal).toFixed(2));
            // repaymentSchedule.push({
            //     year: 1,
            //     amount_at_start: remainingBalance.toFixed(2),
            //     interest_amount: interestFirstYear,
            //     repayment_amount: Repayment === '1st Disbursement' || Repayment === '2nd Disbursement' ? 0 : principalPerYear.toFixed(2),
            //     amount_at_end: Repayment === '1st Disbursement' || Repayment === '2nd Disbursement' ? remainingBalance.toFixed(2) : remainingBalance.toFixed(2) - principalPerYear.toFixed(2)
            // });

            // Years 2 to numYears - Repayment period
            for (let year = 1; year <= numYears; year++) {
                let interest = parseFloat((remainingBalance * interestRateDecimal).toFixed(2));
                let totalRepayment = (interest + parseFloat(principalPerYear)).toFixed(2);

                // remainingBalance -= principalPerYear;

                repaymentSchedule.push({
                    year: year,
                    amount_at_start: parseFloat(remainingBalance.toFixed(2)),
                    interest_amount: parseFloat(interest).toFixed(2),
                    repayment_amount: ((Repayment && Repayment >= year)) ? 0 : parseFloat(principalPerYear).toFixed(
                        2),
                    amount_at_end: ((Repayment && Repayment >= year)) ?
                        parseFloat(remainingBalance).toFixed(2) : (parseFloat(remainingBalance) - parseFloat(
                            principalPerYear)).toFixed(2)
                });

                if (Repayment && Repayment >= year) {

                } else {
                    remainingBalance -= principalPerYear;
                }

            }


            return repaymentSchedule;
        }

        function displaySchedule() {
            // Assuming you have input fields to get loan amount, interest rate, etc.
            let loanAmount = parseFloat(removeCommas($('#term_loan').val()));
            let interestRate = parseFloat(removeCommas($('#interest_rate').val()));
            let numYears = parseInt($('#no_of_installments').val());
            let gracePeriod = 0;

            // Calculate the repayment schedule
            let repaymentSchedule = calculateLoanRepayment(loanAmount, interestRate, numYears, gracePeriod);

            // Append rows to the table
            let tableBody = $('#repaymentTable tbody');
            tableBody.empty(); // Clear any existing rows

            let totalInterest = 0;
            let totalRepayment = 0;

            repaymentSchedule.forEach((data, index) => {
                let rowHtml = `
                    <tr>
                        <td>${index + 1}</td>
                        <td><input type="number" class="form-control mw-100 text-end" name="year[${index}]" id="year_${index}" value="${data.year}" readonly></td>
                        <td><input type="text" class="form-control mw-100 text-end" name="start_amount[${index}]" id="start_amount_${index}" value="${formatIndianNumber(data.amount_at_start)}" readonly></td>
                        <td><input type="text" class="form-control mw-100 text-end" name="interest_amount[${index}]" id="interest_amount_${index}" value="${formatIndianNumber(data.interest_amount)}" readonly></td>
                        <td><input type="text" class="form-control mw-100 text-end" name="repayment_amount[${index}]" id="repayment_amount_${index}" value="${formatIndianNumber(data.repayment_amount)}" readonly></td>
                        <td><input type="text" class="form-control mw-100 text-end" name="end_amount[${index}]" id="end_amount_${index}" value="${formatIndianNumber(data.amount_at_end)}" readonly></td>
                    </tr>
                `;
                tableBody.append(rowHtml);

                totalInterest += parseFloat(data.interest_amount);
                totalRepayment += parseFloat(data.repayment_amount);
            });
            rowHtml = `<tr>
                            <td colspan="3" class="text-end fw-bolder text-dark">Total</td>
                            <td class="fw-bolder text-dark text-end">${formatIndianNumber(totalInterest)}</td>
                            <td class="fw-bolder text-dark text-end">${formatIndianNumber(totalRepayment)}</td>
                        </tr>`;
            tableBody.append(rowHtml);
        }

        // Calculate Number Of Installments
        document.addEventListener('DOMContentLoaded', function() {
            $('#loan_period, #repayment_type').on('input', function() {
                let loan_period = parseFloat($('#loan_period').val()) || 0;
                let repayment_type = parseFloat($('#repayment_type').val()) || 0;
                let no_of_installments = 0;

                if (repayment_type == 1) {
                    no_of_installments = loan_period;
                } else if (repayment_type == 2) {
                    no_of_installments = loan_period * 2;
                } else if (repayment_type == 3) {
                    no_of_installments = loan_period * 4;
                } else if (repayment_type == 4) {
                    no_of_installments = loan_period * 12;
                } else {
                    no_of_installments = 0;
                }

                $('#no_of_installments').val(no_of_installments);
                $('#repayment_start_period').attr('max', no_of_installments);
                displaySchedule();
            });
        });

        // Fetch DPR Fields
        document.addEventListener('DOMContentLoaded', function() {
            $('#dpr_template').on('input', function() {
                let template_id = $(this).val();
                $.ajax({
                    url: '{{ route('loanAppraisal.getDprFields') }}',
                    method: 'POST',
                    data: {
                        template_id: template_id
                    },
                    success: function(response) {
                        let dprFields = response.dprFields;

                        // Clear the previous fields before appending new ones
                        $('#dprFieldsContainer').empty();

                        // Loop through each dprField and dynamically generate the HTML
                        dprFields.forEach(function(field) {
                            let html = `
                            <div class="col-md-6">
                                <div class="row align-items-center mb-1">
                                    <div class="col-md-4">
                                        <label class="form-label">${field.field_name}<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="dpr[${field.id}]" placeholder="Enter ${field.field_name}">
                                        <p class="error text-danger"></p>
                                    </div>
                                </div>
                            </div>
                        `;

                            // Append the generated HTML to the container
                            $('#dprFieldsContainer').append(html);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching fields:', error);
                    }
                });
            });
        });

        // Disbursal Schedule - Append New Row
        $(".addDisbursal").click(function() {

            var rowCount = $("#disbursalTable").find('tr').length + 1;
            var totalAmount = parseFloat(removeCommas($('#term_loan').val()));
            var paidAmount = 0;
            var dis_amnt_nmber;
            let dis_amnt
            for (let i = 0; i < rowCount; i++) {
                dis_amnt_nmber = parseFloat(($(`#disbursal_amount_${i}`).val() || '0').replace(/,/g, '')) || 0;

                paidAmount += dis_amnt_nmber
            }
            var balanceAmount = totalAmount - paidAmount;

            $(`#disbursal_milestone_${rowCount-2}`).attr('readonly', true);
            $(`#disbursal_amount_${rowCount-2}`).attr('readonly', true);
            $(`#disbursal_remarks_${rowCount-2}`).attr('readonly', true);

            var newRow = `
    <tr>
        <td>${rowCount}</td>
        <td>
            <input type="text" name="disbursal_milestone[${rowCount-1}]" required id="disbursal_milestone_${rowCount-1}"
                class="form-control mw-100">
            <p class="error text-danger disbursal_milestone_${rowCount-1}-error"></p> <!-- Error placeholder -->
        </td>
        <td>
            <input type="text" name="disbursal_amount[${rowCount-1}]" required  id="disbursal_amount_${rowCount-1}"
                value="${(formatIndianNumber(balanceAmount))}" class="form-control mw-100">
            <p class="error text-danger disbursal_amount_${rowCount-1}-error"></p> <!-- Error placeholder -->
        </td>
        <td>
            <input type="text" name="disbursal_remarks[${rowCount-1}]"  id="disbursal_remarks_${rowCount-1}"
                class="form-control mw-100">
            <p class="error text-danger disbursal_remarks_${rowCount-1}-error"></p> <!-- Error placeholder -->
        </td>
        <td>
            <a href="#" class="text-primary deleteDisbursal">
                <i data-feather="trash-2"></i>
            </a>
        </td>
    </tr>`;

            $("#disbursalTable").append(newRow);
            feather.replace();
        });

        // Disbursal Schedule - Delete Row
        $("#disbursalTable").on("click", ".deleteDisbursal", function(event) {
            event.preventDefault();
            // Get the previous <tr> of the clicked button's closest <tr>
            let prevTr = $(this).closest('tr').prev();

            // Remove the readonly attribute from all input fields in the previous <tr>
            prevTr.find('input[readonly]').removeAttr('readonly');

            $(this).closest('tr').remove();
        });


        $('#interest_rate').on('change', function() {
            displaySchedule();
        });

        $('#repayment_start_period').on('change', function() {
            displaySchedule();
        });

        // Document Delete
        $(document).on('click', '.deleteDocument', function(e) {
            e.preventDefault();

            var documentId = $(this).data('id'); // Get the document ID
            var $row = $(this).closest('tr');

            if (confirm("Are you sure you want to delete this document?")) {
                var documentIdsArray;

                if (documentId.includes('#')) {
                    documentIdsArray = documentId.split('#'); // Split by `#` if it exists
                } else {
                    documentIdsArray = [documentId]; // Otherwise, wrap `documentId` in an array
                }

                // Loop through each ID
                documentIdsArray.forEach(function(id) {
                    console.log(id);
                    $.ajax({
                        url: '{{ route('loanAppraisal.deleteDocument') }}', // Route to delete document
                        type: 'POST', // Use POST method with '_method' => 'DELETE'
                        data: {
                            "_token": "{{ csrf_token() }}", // Include CSRF token
                            "_method": "DELETE", // Specify the method as DELETE
                            "document_id": id
                        },
                        success: function(response) {
                            if (response.status) { // Check for 'status' in response
                                alert(response.message);
                                $row.remove();
                            } else {
                                alert(response.message || "Something went wrong. Try again.");
                            }
                        },
                        error: function() {
                            alert("Failed to delete the document. Please try again later.");
                        }
                    });
                });
            }
        });





        // Document Upload - Append New Row
        $(".addRow").click(function() {

            var rowCount = $("#tableDoc").find('tr').length + 1; // Counter for row numbering, starting at 1

            var newRow = `
                    <tr>
                        <td>${rowCount}</td>
                        <td>
                            <select class="form-select mw-100" name="documentname[${rowCount-1}]">
                                <option value="">Select</option>
                                @foreach ($doc_type as $document)
                                    <option value="{{ $document->name }}">{{ ucwords(str_replace('-', ' ', $document->name)) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="file" multiple class="form-control mw-100" name="attachments[${rowCount-1}][]" id="attachments-${rowCount-1}">
                        </td>
                        <td id="preview-${rowCount-1}"></td>
                        <td><a href="#" class="text-danger trash"><i data-feather="trash-2"></i></a></td>
                    </tr>`;

            $("#tableDoc").append(newRow);
            feather.replace();
        });


        $(document).on('change', 'input[type="file"]', function(e) {
            var rowIndex = $(this).attr('id').split('-')[1]; // Extract row index from the file input's id
            handleFileUpload(e, `#preview-${rowIndex}`);
        });

        // Function to handle file upload preview with delete icon
        function handleFileUpload(event, previewElement) {

            var files = event.target.files;
            var previewContainer = $(previewElement); // The container where previews will appear
            previewContainer.empty(); // Clear previous previews

            if (files.length > 0) {
                // Loop through each selected file
                for (var i = 0; i < files.length; i++) {
                    var fileName = files[i].name;
                    var fileExtension = fileName.split('.').pop().toLowerCase(); // Get file extension

                    // Set default icon
                    var fileIconType = 'file-text'; // Default icon for unknown types

                    // Map file extension to specific Feather icons
                    switch (fileExtension) {
                        case 'pdf':
                            fileIconType = 'file'; // Icon for PDF files
                            break;
                        case 'doc':
                        case 'docx':
                            fileIconType = 'file'; // Icon for Word documents
                            break;
                        case 'xls':
                        case 'xlsx':
                            fileIconType = 'file'; // Icon for Excel files
                            break;
                        case 'png':
                        case 'jpg':
                        case 'jpeg':
                        case 'gif':
                            fileIconType = 'image'; // Icon for image files
                            break;
                        case 'zip':
                        case 'rar':
                            fileIconType = 'archive'; // Icon for compressed files
                            break;
                        default:
                            fileIconType = 'file'; // Default icon
                            break;
                    }

                    // Generate the file preview div dynamically
                    var fileIcon = `
                        <div class="image-uplodasection expenseadd-sign" data-file-index="${i}">
                            <i data-feather="${fileIconType}" class="fileuploadicon"></i>
                            <div class="delete-img text-danger" data-file-index="${i}">
                                <i data-feather="x"></i>
                            </div>
                        </div>
                    `;

                    // Append the generated fileIcon div to the preview container
                    previewContainer.append(fileIcon);
                }
                // Replace icons with Feather icons after appending the new elements
                feather.replace();
            }

            // Add event listener to delete the file preview when clicked
            previewContainer.find('.delete-img').click(function() {
                var fileIndex = $(this).parent().data('file-index'); // Get the correct index from parent
                removeFilePreview(fileIndex, previewContainer, event.target);
            });

        }

        // Function to remove a single file from the FileList
        function removeFilePreview(fileIndex, previewContainer, inputElement) {

            var dt = new DataTransfer(); // Create a new DataTransfer object to hold the remaining files
            var files = inputElement.files;

            // Loop through the files and add them to the DataTransfer object, except the one to delete
            for (var i = 0; i < files.length; i++) {
                if (i !== fileIndex) {
                    dt.items.add(files[i]); // Add file to DataTransfer if it's not the one being deleted
                }
            }

            // Update the input element with the new file list
            inputElement.files = dt.files;

            // Remove the preview of the deleted file
            previewContainer.children(`[data-file-index="${fileIndex}"]`).remove();

            // Now re-index the remaining file previews
            var remainingPreviews = previewContainer.children();
            remainingPreviews.each(function(index) {
                $(this).attr('data-file-index', index); // Update data-file-index correctly
                $(this).find('.delete-img').attr('data-file-index', index); // Also update delete button index
            });

            // Debugging logs
            console.log(`Remaining files after deletion: ${dt.files.length}`);
            console.log(`Remaining preview elements: ${remainingPreviews.length}`);

            // If no files are left after deleting, reset the file input
            if (dt.files.length === 0) { // Check the updated DataTransfer's files length
                inputElement.value = ""; // Clear the input value to reset it
            }
        }

        $("#tableDoc").on("click", ".trash", function(event) {
            event.preventDefault(); // Prevent default action for <a> tag
            $(this).closest('tr').remove(); // Remove the closest <tr> element
        });

        function cleanInput(input) {
            // Remove negative numbers and special characters
            input.value = input.value.replace(/[^a-zA-Z0-9 ]/g, '');
        }

        function calculate_contribution() {
            let cost = parseFloat(removeCommas($('#project_cost').val())) || 0;
            let loan = parseFloat(removeCommas($('#term_loan').val())) || 0;

            if (isNaN(cost) || isNaN(loan) || cost < 0 || loan < 0) {
                $('.contri_error').text('Please enter valid non-negative numbers for project cost and term loan.');
                $('#promotor_contribution').val('');
                return;
            }

            if (cost > loan) {
                let contribution = cost - loan;
                $('#promotor_contribution').val(formatIndianNumber(contribution));
                $('.contri_error').empty();
            } else {
                $('#term_loan').val(0);
                $('#promotor_contribution').val(formatIndianNumber(
                    cost)); // Entire cost as contribution if loan exceeds or equals cost
                $('.contri_error').text('Term Loan should be less than project cost!');
            }

        }

        function year() {
            let year = $('#repayment_type').val();
            console.log(year);
            switch (year) {
                case '1':
                    $('.year').html("Year");
                    break;
                case '2':
                    $('.year').html("Half Year");
                    break;
                case '3':
                    $('.year').html("Quarter");
                    break;
                case '4':
                    $('.year').html("Month");
                    break;
            }
        }
        $(document).ready(function() {
            $('#repayment_start_period').on('input', function() {
                let max = parseInt($(this).attr('max'), 10);
                let value = parseInt($(this).val(), 10);

                // Show modal if value exceeds max
                if (value > max) {
                    //$('#repayment_start_period').val(max); // Reset input to max value
                    $('.max_value').html('Value Should be less than ' + max);
                    $('#errorModal').modal('show'); // Show Bootstrap modal
                }
            });
            // calculate_contribution();
            year();
        });

        $('#project_cost, #term_loan, #interest_rate, .disbursal_amount').on('blur', function() {
            // Get the value of the input field
            var amount = $(this).val();
            amount = amount ? formatIndianNumber(removeCommas(amount)) : 0

            // Format the value with commas before saving or processing it
            var formattedAmount = amount;

            // Set the formatted value back into the input field
            $(this).val(formattedAmount);
        });
    </script>
@endsection
