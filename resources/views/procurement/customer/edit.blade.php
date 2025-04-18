@extends('layouts.app')

@section('content')
    <!-- BEGIN: Content-->
 <form class="ajax-input-form" method="POST" action="{{ route('customer.update', $customer->id) }}" data-redirect="{{ url('/customers') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header pocreate-sticky">
				<div class="row">
					<div class="content-header-left col-md-6 col-6 mb-2">
						<div class="row breadcrumbs-top">
							<div class="col-12">
								<h2 class="content-header-title float-start mb-0">Customer</h2>
								<div class="breadcrumb-wrapper">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="#">Home</a>
										</li>  
                                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customer</a>
										</li> 
										<li class="breadcrumb-item active">Edit</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
                    <div class="content-header-right text-end col-md-6 col-6 mb-2 mb-sm-0">
                        <input type="hidden" id="document_status" name="document_status" value="{{ $customer->status ?? '' }}">
                        <div class="form-group breadcrumb-right">
                            <a href="{{ route('customer.index') }}" class="btn btn-secondary btn-sm">
                              <i data-feather="arrow-left-circle"></i> Back
                            </a>
                            <button type="button" class="btn btn-danger btn-sm mb-50 mb-sm-0 waves-effect waves-float waves-light delete-btn"
                                    data-url="{{ route('customer.destroy', $customer->id) }}" 
                                    data-redirect="{{ route('customer.index') }}"
                                    data-message="Are you sure you want to delete this customer?">
                                <i data-feather="trash-2" class="me-50"></i> Delete
                            </button>

                            @if($customer->status === 'draft') 
                                <button type="button" class="btn btn-warning btn-sm" id="save-draft-button">
                                    <i data-feather="save"></i> Save as Draft
                                </button>
                             @endif
                            <button type="button" class="btn btn-primary btn-sm" id="submit-button">
                                <i data-feather="check-circle"></i> Submit
                            </button>
                          
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
                                <!-- Start Customer -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="newheader border-bottom mb-2 pb-25"> 
                                                    <h4 class="card-title text-theme">Basic Information</h4>
                                                    <p class="card-text">Fill the details</p> 
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <!-- Customer Code -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Customer Code <span class="text-danger">*</span></label>  
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <input type="text" name="customer_code" class="form-control" value="{{ old('customer_code', $customer->customer_code ?? '') }}" required />
                                                    </div> 
                                                </div>

                                                <!-- Customer Type -->
                                                <div class="row align-items-center mb-1"> 
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Customer Type <span class="text-danger">*</span></label>  
                                                    </div>
                                                    <div class="col-md-5"> 
                                                        <div class="demo-inline-spacing">
                                                            @foreach ($customerTypes as $type)
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input
                                                                        type="radio"
                                                                        id="{{ strtolower($type) }}"
                                                                        name="customer_type"
                                                                        value="{{ $type }}"
                                                                        class="form-check-input"
                                                                        {{ $customer->customer_type == $type ? 'checked' : '' }}
                                                                        required
                                                                    />
                                                                    <label class="form-check-label fw-bolder" for="{{ strtolower($type) }}">
                                                                        {{ $type }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Organization Type -->
                                                <div class="row align-items-center mb-1"> 
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Organization Type <span class="text-danger">*</span></label>  
                                                    </div> 
                                                    <div class="col-md-5">  
                                                        <select name="organization_type_id" class="form-select select2" required>
                                                            <option value="">Select</option>
                                                            @foreach ($organizationTypes as $type)
                                                                <option value="{{ $type->id }}" {{ old('organization_type_id', $customer->organization_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                                            @endforeach
                                                        </select>  
                                                    </div>
                                                </div>

                                                <!-- Company Name -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Company Name <span class="text-danger">*</span></label>  
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $customer->company_name ?? '') }}" required />
                                                    </div> 
                                                </div>
                                                
                                                <!-- Customer Display Name -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3"> 
                                                        <label class="form-label">Customer Display Name</label>  
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <input type="text" name="display_name" class="form-control" value="{{ old('display_name', $customer->display_name ?? '') }}" />
                                                    </div> 
                                                </div>

                                                <!-- Category Mapping -->
                                                <div class="row align-items-center mb-1">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Category Mapping</label>
                                                    </div>
                                                    <div class="col-md-3 pe-sm-0 mb-1 mb-sm-0">
                                                        <input type="text" name="category_name" class="form-control category-autocomplete" placeholder="Type to search category" value="{{ $customer->category->name ?? '' }}">
                                                        <input type="hidden" name="category_id" class="category-id" value="{{ $customer->category_id ?? '' }}">
                                                        <input type="hidden" name="category_type" class="category-type" value="Customer">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="subcategory_name" class="form-control subcategory-autocomplete" placeholder="Type to search sub-category" value="{{ $customer->subCategory->name ?? '' }}">
                                                        <input type="hidden" name="subcategory_id" class="subcategory-id" value="{{ $customer->subcategory_id ?? '' }}">
                                                        <input type="hidden" name="category_type" class="category-type" value="Customer">
                                                    </div>
                                                </div>

                                                   <div class="row align-items-center mb-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Sales Person</label>
                                                        </div>
                                                        <div class="col-md-3 pe-sm-0 mb-1 mb-sm-0">
                                                        <input type="text" name="sales_person_id" class="form-control sales-person-autocomplete" placeholder="Type to search sales-person" value="{{ $customer->sales_person->name ?? '' }}">
                                                            <input type="hidden" name="sales_person_id" class="sales-person-id" value="{{ $customer->sales_person_id ?? '' }}">
                                                        </div>
                                                    </div>
                                                <p class="mb-0" style="color: red;"><b>Note*:</b> File must be 2MB max | Formats: pdf, jpg, jpeg, png</p>
                                            </div>

                                            <div class="col-md-3 border-start">
                                                <!-- Status -->
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Status</strong></label>
                                                        <div class="demo-inline-spacing">
                                                            @foreach ($status as $statusOption)
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input
                                                                        type="radio"
                                                                        id="status_{{ $statusOption }}"
                                                                        name="status"
                                                                        value="{{ ucfirst($statusOption) }}"
                                                                        class="form-check-input"
                                                                        {{ $customer->status == $statusOption ? 'checked' : '' }}
                                                                    />
                                                                    <label class="form-check-label fw-bolder" for="status_{{ $statusOption }}">
                                                                        {{ ucfirst($statusOption) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Stop Billing -->
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-md-12">
                                                        <label class="form-label text-primary"><strong>Stop Billing</strong></label>
                                                        <div class="demo-inline-spacing">
                                                            @foreach ($options as $option)
                                                                <div class="form-check form-check-primary mt-25">
                                                                    <input
                                                                        type="radio"
                                                                        id="stop_billing_{{ strtolower($option) }}"
                                                                        name="stop_billing"
                                                                        value="{{ $option }}"
                                                                        class="form-check-input"
                                                                        {{ $customer->stop_billing== $option ? 'checked' : '' }}
                                                                    />
                                                                    <label class="form-check-label fw-bolder" for="stop_billing_{{ strtolower($option) }}">
                                                                        {{ $option }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Customer -->

											<div class="mt-1">
												<ul class="nav nav-tabs border-bottom mt-25" role="tablist">
													<li class="nav-item">
														<a class="nav-link active" data-bs-toggle="tab" href="#payment">General Details</a>
													</li>
                                                    <li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#Shipping">Addresses</a>
													</li>
                                                    <li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#Financial">Financial</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#amend">Contact Persons</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#schedule">Compliances</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#send">Bank Info</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#latestrates">Notes</a>
													</li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab" href="#Items">Items</a>
                                                    </li>

												</ul>

											<div class="tab-content pb-1 px-1">
                                                        <!-- Customer Detail Start -->
                                                        <div class="tab-pane active" id="payment">
                                                            <!-- Related Party -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Related Party</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                        <input type="checkbox" class="form-check-input" id="Related" name="related_party" {{ $customer->related_party =='Yes'? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="Related">Yes/No</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Email -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Email</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-group input-group-merge">
                                                                        <span class="input-group-text" id="basic-addon5"><i data-feather='mail'></i></span>
                                                                        <input type="email" class="form-control" name="email" value="{{ $customer->email ?? '' }}" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Phone -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Phone</label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="input-group input-group-merge">
                                                                        <span class="input-group-text" id="basic-addon5"><i data-feather='phone'></i></span>
                                                                        <input type="text" class="form-control numberonly" name="phone" value="{{ $customer->phone ?? '' }}" placeholder="Phone">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="input-group input-group-merge">
                                                                        <span class="input-group-text" id="basic-addon5"><i data-feather='smartphone'></i></span>
                                                                        <input type="text" class="form-control numberonly" id="phone_mobile" name="mobile" value="{{ $customer->mobile ?? '' }}" placeholder="Mobile">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Whatsapp Number -->
                                                            <div class="row mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Whatsapp Number</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-group input-group-merge">
                                                                        <span class="input-group-text" id="basic-addon5"><i data-feather='phone'></i></span>
                                                                        <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ $customer->whatsapp_number ?? '' }}">
                                                                    </div>
                                                                    <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                        <input type="checkbox" class="form-check-input" id="colorCheck1" name="whatsapp_same_as_mobile" {{ $customer->whatsapp_same_as_mobile ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="whatsapp_same_as_mobile">Same as Mobile No.</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Notification -->
                                                            <div class="row align-items-center mb-3">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Notification</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="demo-inline-spacing">
                                                                        <div class="form-check form-check-primary mt-2">
                                                                            <input type="checkbox" class="form-check-input" id="Email" name="notification[]" value="email" {{ in_array('email', $notifications ?? []) ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="Email">Email</label>
                                                                        </div>

                                                                        <div class="form-check form-check-primary mt-2">
                                                                            <input type="checkbox" class="form-check-input" id="SMS" name="notification[]" value="sms" {{ in_array('sms', $notifications ?? []) ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="SMS">SMS</label>
                                                                        </div>

                                                                        <div class="form-check form-check-primary mt-2">
                                                                            <input type="checkbox" class="form-check-input" id="Whatsapp" name="notification[]" value="whatsapp" {{ in_array('whatsapp', $notifications ?? []) ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="Whatsapp">Whatsapp</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- PAN -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">PAN</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="pan_number" value="{{ $customer->pan_number ?? '' }}">
                                                                </div>
                                                                <div class="col-md-3 d-flex align-items-center gap-1">
                                                                    <input type="file" class="form-control" name="pan_attachment">
                                                                    @if(!empty($customer->pan_attachment))
                                                                        <div class="mt-0">
                                                                            <a href="{{ Storage::url($customer->pan_attachment) }}" target="_blank" download class="d-block file-link">
                                                                                <i class="fas file-icon"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Tin No. -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Tin No.</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="tin_number" value="{{ $customer->tin_number ?? '' }}">
                                                                </div>
                                                                <div class="col-md-3 d-flex align-items-center gap-1">
                                                                    <input type="file" class="form-control" name="tin_attachment">
                                                                    @if(!empty($customer->tin_attachment))
                                                                        <div class="mt-0">
                                                                            <a href="{{ Storage::url($customer->tin_attachment) }}" target="_blank" download class="d-block file-link">
                                                                                <i class="fas file-icon"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Aadhar No. -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Aadhar No.</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" name="aadhar_number" value="{{ $customer->aadhar_number ?? '' }}">
                                                                </div>
                                                                <div class="col-md-3 d-flex align-items-center gap-1">
                                                                    <input type="file" class="form-control" name="aadhar_attachment">
                                                                    @if(!empty($customer->aadhar_attachment))
                                                                        <div class="mt-0">
                                                                            <a href="{{ Storage::url($customer->aadhar_attachment) }}" target="_blank" download class="d-block file-link">
                                                                                <i class="fas file-icon"></i>
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-1" style="margin-top:24px">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Currency</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select class="form-select select2" id="currencySelect" name="currency_id">
                                                                        <option value="">Select</option>
                                                                        @foreach($currencies as $currency)
                                                                            <option value="{{ $currency->id }}" data-short-name="{{ $currency->short_name ?? '' }}"
                                                                                {{ $customer->currency_id == $currency->id ? 'selected' : '' }}>
                                                                                {{ $currency->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <!-- Org Currency -->
                                                                <div class="col-md-2" id="orgCurrencyRow" style="{{ $customer->currency_id ? '' : 'display: none;' }} position: relative;">
                                                                    <label class="form-label" style="position: absolute;top:-20px">Org Currency</label>
                                                                    <div class="input-group" style="height: 38px;">
                                                                        <span class="input-group-text bg-light" id="orgCurrencySymbol">Code</span>
                                                                        <input type="text" class="form-control" id="orgCurrency" name="org_currency" value="{{ $customer->org_currency ?? '' }}" readonly>
                                                                    </div>
                                                                </div>

                                                                  <!-- Company Currency -->
                                                                  <div class="col-md-2" id="companyCurrencyRow" style="{{ $customer->currency_id ? '' : 'display: none;' }} position: relative;">
                                                                    <label class="form-label" style="position: absolute;top:-20px">Company Currency</label>
                                                                    <div class="input-group" style="height: 38px;">
                                                                        <span class="input-group-text bg-light" id="companyCurrencySymbol">Code</span>
                                                                        <input type="text" class="form-control" id="companyCurrency" name="company_currency" value="{{ $customer->company_currency ?? '' }}" readonly>
                                                                    </div>
                                                                 </div>

                                                                <!-- Group Currency -->
                                                                <div class="col-md-2" id="groupCurrencyRow" style="{{ $customer->currency_id ? '' : 'display: none;' }} position: relative;">
                                                                    <label class="form-label" style="position: absolute;top:-20px">Group Currency</label>
                                                                    <div class="input-group" style="height: 38px;">
                                                                        <span class="input-group-text bg-light" id="groupCurrencySymbol">Code</span>
                                                                        <input type="text" class="form-control" id="groupCurrency" name="group_currency" value="{{ $customer->group_currency ?? '' }}" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1">
                                                                    <a href="{{ route('exchange-rates.index') }}" target="_blank" class="voucehrinvocetxt mt-0">Add Exchange Rate</a>
                                                                </div>
                                                                <input type="hidden" id="transactionDate" name="transaction_date">
                                                            </div>
                                                            <!-- Opening Balance -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Opening Balance</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text bg-light" id="currencyShortName">{{ $customer->currency->short_name ?? 'INR' }}</span>
                                                                        <input type="text" class="form-control" name="opening_balance" value="{{ $customer->opening_balance ?? '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Payment Terms -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Payment Terms</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select class="form-select select2" name="payment_terms_id">
                                                                        <option value="">Select</option>
                                                                        @foreach($paymentTerms as $paymentTerm)
                                                                            <option value="{{ $paymentTerm->id }}" {{ $customer->payment_terms_id == $paymentTerm->id ? 'selected' : '' }}>
                                                                                {{ $paymentTerm->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Upload Documents -->
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label for="document-upload" class="form-label">Upload Documents</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="file" id="document-upload" class="form-control" name="other_documents[]" multiple>
                                                                    @if(!empty($customer->other_documents))
                                                                        <div class="row mt-2">
                                                                            @if(is_array($customer->other_documents))
                                                                                @foreach($customer->other_documents as $document)
                                                                                    <div class="col-md-1 mb-2">
                                                                                        <a href="{{ Storage::url($document) }}" target="_blank" rel="noopener noreferrer" class="d-block file-link" download>
                                                                                          <i class="fas file-icon"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                @endforeach
                                                                            @else
                                                                                <div class="col-md-1 mb-2">
                                                                                    <a href="{{ Storage::url($customer->other_documents) }}" target="_blank" rel="noopener noreferrer" class="d-block file-link" download>
                                                                                      <i class="fas file-icon"></i>
                                                                                    </a>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                         <!--Customer Detail End -->
                                                                 <!-- Vendor Detail End -->
                                                                 <div class="tab-pane" id="Shipping">
                                                            <div class="table-responsive">
                                                                <table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border" id="alternateAddressTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.NO.</th>
                                                                            <th>Country/Region</th>
                                                                            <th>State</th>
                                                                            <th>City</th>
                                                                            <th>Address</th>
                                                                            <th>Pin Code</th>
                                                                            <th>Phone</th>
                                                                            <th>Fax Number</th>
                                                                            <th>Type</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="address-table-body">
                                                                        @foreach(@$customer->addresses as $index => $customerAddress)
                                                                            <tr class="address-row" data-id="{{ $customerAddress->id }}" data-index="{{ $index }}" 
                                                                                data-country-id="{{ $customerAddress->country_id ?? '' }}" 
                                                                                data-state-id="{{ $customerAddress->state_id ?? '' }}" 
                                                                                data-city-id="{{ $customerAddress->city_id ?? '' }}" 
                                                                                data-type="{{ $customerAddress->type ?? '' }}">
                                                                                <input type="hidden" name="addresses[{{ $index }}][id]" value="{{ $customerAddress->id }}">
                                                                                <td class="index">{{ $index + 1 }}</td>
                                                                                <td>
                                                                                    <select class="form-select mw-100 country-select" name="addresses[{{ $index }}][country_id]">
                                                                                        @foreach($countries as $country)
                                                                                            <option value="{{ $country->id }}" {{ @$customerAddress->country_id == $country->id ? 'selected' : '' }}>
                                                                                                {{ $country->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select mw-100 state-select" name="addresses[{{ $index }}][state_id]">
                                                                                      
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select mw-100 city-select" name="addresses[{{ $index }}][city_id]">
                                                                                    </select>
                                                                                </td>
                                                                                <td><input type="text" class="form-control mw-100" name="addresses[{{ $index }}][address]" value="{{ $customerAddress->address ?? '' }}"></td>
                                                                                <td><input type="text" class="form-control mw-100 numberonly" name="addresses[{{ $index }}][pincode]" value="{{ $customerAddress->pincode ?? '' }}"></td>
                                                                                <td><input type="text" class="form-control numberonly mw-100" name="addresses[{{ $index }}][phone]" value="{{ $customerAddress->phone ?? '' }}"></td>
                                                                                <td><input type="text" class="form-control mw-100" name="addresses[{{ $index }}][fax_number]" value="{{ $customerAddress->fax_number ?? '' }}"></td>
                                                                                <td>
                                                                                <div class="demo-inline-spacing">
                                                                                    <div class="form-check form-check-primary mt-25">
                                                                                        <input type="radio" id="is_billing_{{ $index }}_1" name="addresses[{{ $index }}][is_billing]" value="1" class="form-check-input" 
                                                                                            {{ $customerAddress->is_billing ? 'checked' : '' }}>
                                                                                        <label class="form-check-label fw-bolder" for="is_billing_{{ $index }}_1">Billing</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-primary mt-25">
                                                                                        <input type="radio" id="is_shipping_{{ $index }}_1" name="addresses[{{ $index }}][is_shipping]" value="1" class="form-check-input"
                                                                                            {{ $customerAddress->is_shipping ? 'checked' : '' }}>
                                                                                        <label class="form-check-label fw-bolder" for="is_shipping_{{ $index }}_1">Shipping</label>
                                                                                    </div>
                                                                                </div>
                                                                                </td> 
                                                                                <td>
                                                                                    <a href="#" class="text-danger delete-address"><i data-feather="trash-2" class="me-50"></i></a>
                                                                                    <a href="#" class="text-primary add-address"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        @if($customer->addresses->isEmpty())
                                                                        <tr class="address-row" data-index="0">
                                                                            <td class="index">1</td>
                                                                            <td>
                                                                                <select class="form-select mw-100 country-select" name="addresses[0][country_id]">
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-select mw-100 state-select" name="addresses[0][state_id]">
                                                                                </select>
                                                                            </td> 
                                                                            <td>
                                                                                <select class="form-select mw-100 city-select" name="addresses[0][city_id]">
                                                                                </select>
                                                                            </td> 
                                                                        
                                                                            <td><input type="text" class="form-control mw-100" name="addresses[0][address]"></td> 
                                                                            <td><input type="text" class="form-control mw-100 numberonly" name="addresses[0][pincode]"></td> 
                                                                            <td><input type="text" class="form-control mw-100 numberonly" name="addresses[0][phone]"></td> 
                                                                            <td><input type="text" class="form-control mw-100" name="addresses[0][fax_number]"></td>
                                                                            <td>
                                                                                <div class="demo-inline-spacing">
                                                                                    <div class="form-check form-check-primary mt-25">
                                                                                        <input type="radio" id="isDefaultPurchase0" name="addresses[0][is_billing]" value="" class="form-check-input">
                                                                                        <label class="form-check-label fw-bolder" for="isDefaultPurchase0">Billing</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-primary mt-25">
                                                                                        <input type="radio" id="isDefaultSelling0" name="addresses[0][is_shipping]" value="" class="form-check-input">
                                                                                        <label class="form-check-label fw-bolder" for="isDefaultSelling0">Shipping</label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <a href="#" class="text-danger delete-address"><i data-feather="trash-2" class="me-50"></i></a>
                                                                                <a href="#" class="text-primary add-address"><i data-feather="plus-square" class="me-50"></i></a>   
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                          <!-- Financial Start -->
                                                          <div class="tab-pane" id="Financial">
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label for="ledger_name" class="form-label">Ledger</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="ledger_name" name="ledger_name" class="form-control ladger-autocomplete" value="{{ $customer->ledger->name ?? '' }}" placeholder="Type to search...">
                                                                    <input type="hidden" id="ledger_id" name="ledger_id" class="ladger-id"  value="{{($customer->ledger_id ?? '') }}">
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2">
                                                                    <label for="ledger_group_name" class="form-label">Ledger Group</label>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="ledger_group_select" name="ledger_group_id" class="form-control ledger-group-select">
                                                                        <option value="">Select Ledger Group</option>
                                                                        @foreach($ledgerGroups as $group)
                                                                            <option value="{{ $group->id }}" 
                                                                                {{ isset($customer) && $customer->ledger_group_id == $group->id ? 'selected' : '' }}>
                                                                                {{ $group->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="hidden" id="ledger_group_hidden_id" class="ledger-group-id" value="{{($customer->ledger_group_id ?? '') }}">
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2"> 
                                                                    <label for="pricing_type" class="form-label">Pricing Type</label>  
                                                                </div>  
                                                                <div class="col-md-3"> 
                                                                    <select id="pricing_type" name="pricing_type" class="form-select select2">
                                                                        <option value="">Select</option>
                                                                        <option value="fixed" {{ isset($customer->pricing_type) && $customer->pricing_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                                                        <option value="variable" {{ isset($customer->pricing_type) && $customer->pricing_type == 'variable' ? 'selected' : '' }}>Variable</option>
                                                                    </select>
                                                                </div> 
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2"> 
                                                                    <label for="credit_limit" class="form-label">Credit Limit</label>  
                                                                </div>  
                                                                <div class="col-md-3"> 
                                                                    <input type="number" id="credit_limit" name="credit_limit" value="{{ $customer->credit_limit ?? '' }}" class="form-control" placeholder="Enter credit limit" />
                                                                </div> 
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2"> 
                                                                    <label for="credit_days" class="form-label">Credit Days</label>  
                                                                </div>  
                                                                <div class="col-md-3"> 
                                                                    <input type="number" id="credit_days" name="credit_days" value="{{ $customer->credit_days ?? '' }}" class="form-control" placeholder="Enter credit days" min="0" />
                                                                </div> 
                                                            </div>

                                                            <div class="row align-items-center mb-1">
                                                                <div class="col-md-2"> 
                                                                    <label for="interest_percent" class="form-label">Interest %</label>  
                                                                </div>  
                                                                <div class="col-md-3"> 
                                                                    <input type="number" id="interest_percent" name="interest_percent" value="{{ $customer->interest_percent ?? '' }}" class="form-control" placeholder="Enter interest percent" step="0.01" min="0" max="100" />
                                                                </div> 
                                                            </div>
                                                        </div>

                                                        <!-- FinancialEnd -->

                                                        <!-- Start Contact -->
                                                        <div class="tab-pane" id="amend">
                                                            <div class="table-responsive">
                                                                <table class="table myrequesttablecbox table-striped" id="contactsTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.No</th>
                                                                            <th>Salutation</th>
                                                                            <th>Name</th>
                                                                            <th>Email</th>
                                                                            <th>Mobile</th>
                                                                            <th>Work Phone</th>
                                                                            <th>Primary</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse($customer->contacts as $contact)
                                                                            <tr class="contact-info-row" data-id="{{ $contact->id }}">
                                                                                <td>{{ $loop->index + 1 }}</td>
                                                                                <input type="hidden" name="contacts[{{$loop->index }}][id]" value="{{ $contact->id }}">
                                                                                <td>
                                                                                    <select class="form-select px-1" name="contacts[{{ $loop->index }}][salutation]">
                                                                                        <option value="">Select</option>
                                                                                        @foreach($titles as $title)
                                                                                            <option value="{{ $title }}" {{ $contact->salutation == $title ? 'selected' : '' }}>{{ $title }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td><input type="text" name="contacts[{{ $loop->index }}][name]" class="form-control" value="{{ $contact->name ?? '' }}"></td>
                                                                                <td><input type="email" name="contacts[{{ $loop->index }}][email]" class="form-control" value="{{ $contact->email ?? '' }}"></td>
                                                                                <td><input type="text" name="contacts[{{ $loop->index }}][mobile]" class="form-control numberonly" value="{{ $contact->mobile ?? '' }}"></td>
                                                                                <td><input type="text" name="contacts[{{ $loop->index }}][phone]" class="form-control numberonly" value="{{ $contact->phone ?? '' }}"></td>
                                                                                <td>
                                                                                    <input type="radio" name="contacts[{{ $loop->index }}][primary]" value="1" {{ $contact->primary ? 'checked' : '' }} class="primary-radio">
                                                                                </td>
                                                                                <td>
                                                                                    <a href="#" class="text-danger delete-contact-row"><i data-feather="trash-2"></i></a>
                                                                                    <a href="#" class="text-primary add-contact-row"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr class="contact-info-row" data-id="">
                                                                                <td>1</td>
                                                                                <td>
                                                                                    <select class="form-select" name="contacts[0][salutation]">
                                                                                        <option value="">Select</option>
                                                                                        @foreach($titles as $title)
                                                                                            <option value="{{ $title }}">{{ $title }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td><input type="text" name="contacts[0][name]" class="form-control" value=""></td>
                                                                                <td><input type="email" name="contacts[0][email]" class="form-control" value=""></td>
                                                                                <td><input type="text" name="contacts[0][mobile]" class="form-control numberonly" value=""></td>
                                                                                <td><input type="text" name="contacts[0][phone]" class="form-control numberonly" value=""></td>
                                                                                <td>
                                                                                    <input type="radio" name="contacts[0][primary]" value="0" class="primary-radio">
                                                                                </td>
                                                                                <td>
                                                                                    <a href="#" class="text-danger delete-contact-row"><i data-feather="trash-2"></i></a>
                                                                                    <a href="#" class="text-primary add-contact-row"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                      </div>

                                                        <!-- End Contact -->
                                                        <div class="tab-pane" id="schedule">
                                                        <div class="row">
                                                            <!-- TDS Details -->
                                                            <div class="col-md-6">
                                                                <h5 class="mt-1 mb-2 text-dark"><strong>TDS Details</strong></h5>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">TDS Applicable</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                            <input type="checkbox" name="compliance[tds_applicable]" id="tdsApplicableIndia" 
                                                                                class="form-check-input" 
                                                                                @if($customer->compliances && $customer->compliances->tds_applicable) checked @endif>
                                                                            <label class="form-check-label" for="tdsApplicableIndia">Yes/No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Wef Date</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="date" name="compliance[wef_date]" class="form-control" 
                                                                            value="{{ $customer->compliances->wef_date ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">TDS Certificate No.</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="compliance[tds_certificate_no]" class="form-control numberonly" 
                                                                            value="{{ $customer->compliances->tds_certificate_no ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">TDS Tax Percentage</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="compliance[tds_tax_percentage]" class="form-control" 
                                                                            value="{{ $customer->compliances->tds_tax_percentage ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">TDS Category</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="compliance[tds_category]" class="form-control" 
                                                                            value="{{ $customer->compliances->tds_category ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">TDS Value Cap</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="compliance[tds_value_cab]" class="form-control numberonly" 
                                                                            value="{{ $customer->compliances->tds_value_cab ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">TAN Number</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="compliance[tan_number]" class="form-control" 
                                                                            value="{{ $customer->compliances->tan_number ?? '' }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- GST Info -->
                                                            <div class="col-md-6">
                                                                <h5 class="mt-1 mb-2 text-dark"><strong>GST Info</strong></h5>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">GST Applicable</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="demo-inline-spacing">
                                                                            <div class="form-check form-check-primary mt-25">
                                                                                <input type="radio" id="gstRegisteredIndia" name="compliance[gst_applicable]" value="1" 
                                                                                    class="form-check-input" 
                                                                                    @if($customer->compliances && $customer->compliances->gst_applicable == 1) checked @endif>
                                                                                <label class="form-check-label fw-bolder" for="gstRegisteredIndia">Registered</label>
                                                                            </div>
                                                                            <div class="form-check form-check-primary mt-25">
                                                                                <input type="radio" id="gstNonRegisteredIndia" name="compliance[gst_applicable]" value="0" 
                                                                                    class="form-check-input" 
                                                                                    @if($customer->compliances && $customer->compliances->gst_applicable == 0) checked @endif>
                                                                                <label class="form-check-label fw-bolder" for="gstNonRegisteredIndia">Non-Registered</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">GSTIN No.</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="compliance[gstin_no]" class="form-control" 
                                                                            value="{{ $customer->compliances->gstin_no ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">GST Registered Name</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="compliance[gst_registered_name]" class="form-control numberonly" 
                                                                            value="{{ $customer->compliances->gst_registered_name ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">GSTIN Reg. Date</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="date" name="compliance[gstin_registration_date]" class="form-control numberonly" 
                                                                            value="{{ $customer->compliances->gstin_registration_date ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Upload Certificate</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="file" name="compliance[gst_certificate][]" multiple class="form-control">
                                                                        @if(!empty($customer->compliances) && $customer->compliances->gst_certificate)
                                                                            <div class="row mt-2">
                                                                                @if(is_array($customer->compliances->gst_certificate))
                                                                                    <!-- Handle multiple files -->
                                                                                    @foreach($customer->compliances->gst_certificate as $document)
                                                                                        <div class="col-md-1 mb-2">
                                                                                            <a href="{{ Storage::url($document) }}" target="_blank" rel="noopener noreferrer" class="d-block file-link" download>
                                                                                              <i class="fas file-icon"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <!-- Handle single file -->
                                                                                    <div class="col-md-1 mb-2">
                                                                                        <a href="{{ Storage::url($customer->compliances->gst_certificate) }}" target="_blank" rel="noopener noreferrer" class="d-block file-link" download>
                                                                                          <i class="fas file-icon"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- MSME Details -->
                                                            <div class="col-md-6">
                                                                <h5 class="mt-1 mb-2 text-dark"><strong>MSME Details</strong></h5>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">MSME Registered?</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-check form-check-primary mt-25 custom-checkbox">
                                                                            <input type="checkbox" class="form-check-input" name="compliance[msme_registered]" id="msmeRegisteredIndia" 
                                                                                @if($customer->compliances && $customer->compliances->msme_registered) checked @endif>
                                                                            <label class="form-check-label" for="msmeRegisteredIndia">This vendor is MSME registered</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">MSME No.</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="compliance[msme_no]" class="form-control numberonly" 
                                                                            value="{{ $customer->compliances->msme_no ?? '' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">MSME Type</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <select class="form-select" name="compliance[msme_type]">
                                                                            <option value="">Select</option>
                                                                            <option value="Micro" @if($customer->compliances && $customer->compliances->msme_type == 'Micro') selected @endif>Micro</option>
                                                                            <option value="Small" @if($customer->compliances && $customer->compliances->msme_type == 'Small') selected @endif>Small</option>
                                                                            <option value="Medium" @if($customer->compliances && $customer->compliances->msme_type == 'Medium') selected @endif>Medium</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row align-items-center mb-1">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Upload Certificate</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="file" name="compliance[msme_certificate][]" multiple class="form-control">
                                                                        
                                                                        @if(!empty($customer->compliances) && $customer->compliances->msme_certificate)
                                                                            <div class="row mt-2">
                                                                                @if(is_array($customer->compliances->msme_certificate))
                                                                                    <!-- Handle multiple files -->
                                                                                    @foreach($customer->compliances->msme_certificate as $document)
                                                                                        <div class="col-md-1 mb-2">
                                                                                            <a href="{{ Storage::url($document) }}" target="_blank" rel="noopener noreferrer" class="d-block file-link" download>
                                                                                              <i class="fas file-icon"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <!-- Handle single file -->
                                                                                    <div class="col-md-1 mb-2">
                                                                                        <a href="{{ Storage::url($customer->compliances->msme_certificate) }}" target="_blank" rel="noopener noreferrer" class="d-block file-link" download>
                                                                                          <i class="fas file-icon"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                         <!-- Bank Info Tab -->
                                                         <div class="tab-pane" id="send">
                                                            <div class="table-responsive-md">
                                                                <table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.NO.</th>
                                                                            <th>Bank Name</th>
                                                                            <th>Beneficiary Name</th>
                                                                            <th>Account Number</th>
                                                                            <th>Re-enter Account No.</th>
                                                                            <th>IFSC Code</th>
                                                                            <th>Primary</th>
                                                                            <th>Cancel Cheque</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="bank-info-container">
                                                                        @forelse($customer->bankInfos as $index => $bankInfo)
                                                                            <tr data-id="{{ $bankInfo->id }}" class="bank-info-row" data-index="{{ $index }}">
                                                                               <td>{{ $loop->index + 1 }}</td>
                                                                                 <input type="hidden" name="bank_info[{{ $index }}][id]" value="{{ $bankInfo->id ??''}}">
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[{{ $index }}][bank_name]" value="{{ $bankInfo->bank_name ??'' }}" /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[{{ $index }}][beneficiary_name]" value="{{ $bankInfo->beneficiary_name ??'' }}" /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[{{ $index }}][account_number]" value="{{ $bankInfo->account_number ??''}}" /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[{{ $index }}][re_enter_account_number]" value="{{ $bankInfo->re_enter_account_number ??'' }}" /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[{{ $index }}][ifsc_code]" value="{{ $bankInfo->ifsc_code ??'' }}" /></td>
                                                                                <td>
                                                                                    <input type="radio" name="bank_info[{{ $index }}][primary]" value="" {{ $bankInfo->primary ? 'checked' : '' }} class="primary-radio">
                                                                                </td>

                                                                                <td>
                                                                                    <input type="file" class="form-control mw-100" name="bank_info[{{ $index }}][cancel_cheque][]" multiple />
                                                                                    @if(!empty($bankInfo->cancel_cheque))
                                                                                        <div class="mt-2">
                                                                                                <a href="{{ Storage::url($bankInfo->cancel_cheque) }}" target="_blank" rel="noopener noreferrer" class="file-link" download>
                                                                                                    <i class="fas file-icon"></i>
                                                                                                </a>
                                                                                                <br />
                                                                                        </div>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    <a href="#" class="text-primary add-bank-row"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                    <a href="#" class="text-danger delete-bank-row"><i data-feather="trash-2" class="me-50"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr class="bank-info-row" data-index="0">
                                                                                <td>1</td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[0][bank_name]" /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[0][beneficiary_name]" /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[0][account_number]" /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[0][re_enter_account_number]" /></td>
                                                                                <td><input type="text" class="form-control mw-100" name="bank_info[0][ifsc_code]" /></td>
                                                                                <td>
                                                                                    <input type="radio" name="bank_info[0][primary]" value="0" class="primary-radio">
                                                                                </td>
                                                                                <td><input type="file" class="form-control mw-100" name="bank_info[0][cancel_cheque][]" multiple /></td>
                                                                                <td>
                                                                                    <a href="#" class="text-primary add-bank-row"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                    <a href="#" class="text-danger delete-bank-row"><i data-feather="trash-2" class="me-50"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                         <!-- Bank Info Tab -->
                                                       <div class="tab-pane" id="latestrates">
                                                        <label class="form-label">Notes (For Internal Use)</label>  
                                                        <textarea class="form-control" name="notes[remark]" placeholder="Enter Notes...."></textarea>
                                                        @error('notes.remark')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <div class="table-responsive mt-1">
                                                            <table class="table myrequesttablecbox table-striped"> 
                                                                <thead>
                                                                    <tr> 
                                                                        <th class="px-1">S.NO.</th>
                                                                        <th class="px-1">Name</th> 
                                                                        <th class="px-1">Date</th>
                                                                        <th class="px-1">Remarks</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($customer->notes as $index => $note)
                                                                        <tr valign="top">
                                                                            <td>{{ $index + 1 }}</td>
                                                                            <td class="px-1">{{ $note->created_by ? App\Models\User::find($note->created_by)->name : 'N/A' }}</td>
                                                                            <td class="px-1">{{ $note->created_at->format('d-m-Y') }}</td>
                                                                            <td class="px-1">{{ $note->remark }}</td> 
                                                                        </tr> 
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                        <!-- Items start -->
                                                            <div class="tab-pane" id="Items">
                                                                <div class="table-responsive-md">
                                                                    <table class="mt-1 table myrequesttablecbox table-striped po-order-detail custnewpo-detail border" id="vendorTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>S.NO.</th>
                                                                                <th width="300px">Item</th>
                                                                                <th>Customer Item Code</th>
                                                                                <th>Customer Item Name</th>
                                                                                <th>Customer Item Details</th>
                                                                                <th id="sell-price-header">Sell Price</th>
                                                                                <th>Sell Uom</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="vendorTableBody">
                                                                            @forelse ($customer->approvedItems as $index => $item)
                                                                                <tr data-id="{{ $item->id }}" id="row-{{ $index }}">
                                                                                 <input type="hidden" name="customer_item[{{ $index }}][id]" value="{{ $item->id }}">
                                                                                    <td>{{ $index + 1 }}</td>
                                                                                    <td>
                                                                                        <input type="text" name="customer_item[{{ $index }}][item_name]" class="form-control mw-100 vendor-autocomplete" data-id="{{ $index }}" value="{{$item->item->item_name ??''}}" placeholder="Search Item" autocomplete="off">
                                                                                        <input type="hidden" id="item-id_{{ $index }}" name="customer_item[{{ $index }}][item_id]" class="item-id" value="{{ $item->item_id ?? '' }}">
                                                                                    </td>
                                                                                    <td><input type="text" name="customer_item[{{ $index }}][item_code]" class="form-control mw-100" value="{{ $item->item_code ??'' }}"></td>
                                                                                    <td><input type="text" name="customer_item[{{ $index }}][item_name]" class="form-control mw-100" value="{{ $item->item_name ??''}}"></td>
                                                                                    <td><input type="text" name="customer_item[{{ $index }}][item_details]" class="form-control mw-100" value="{{ $item->item_details ??'' }}"></td>
                                                                                    <td><input type="text" name="customer_item[{{ $index }}][sell_price]"  class="form-control sell-price-approved-customer mw-100"  id="sell-price_{{ $index }}" value="{{ number_format($item->sell_price, 2) }}"></td>
                                                                                    <td>
                                                                                        <select name="customer_item[{{ $index }}][uom_id]" id="uom_{{ $index }}" class="form-select mw-100">
                                                                                            <option value="">Select</option>
                                                                                            <input type="hidden" id="uom-id_{{ $index }}" value="{{ $item->uom_id }}">
                                                                                        </select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="#" class="text-danger delete-item"><i data-feather="trash-2" class="me-50"></i></a>
                                                                                        <a href="#" class="text-primary add-item"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            @empty
                                                                                <tr id="row-0">
                                                                                    <td>1</td>
                                                                                    <td>
                                                                                        <input type="text" name="customer_item[0][customer_name]" class="form-control mw-100 vendor-autocomplete" data-id="0" placeholder="Search Vendor" autocomplete="off">
                                                                                        <input type="hidden" id="item-id_0" name="customer_item[0][item_id]" class="item-id">
                                                                                    </td>
                                                                                    <td><input type="text" name="customer_item[0][item_code]" class="form-control mw-100"></td>
                                                                                    <td><input type="text" name="customer_item[0][item_name]" class="form-control mw-100"></td>
                                                                                    <td><input type="text" name="customer_item[0][item_details]" class="form-control mw-100"></td>
                                                                                    <td><input type="text" name="customer_item[0][sell_price]" id="sell-price_0" class="form-control sell-price-approved-customer mw-100"></td>
                                                                                    <td><select name="customer_item[0][uom_id]"  id="uom_0" class="form-select mw-100" disabled></select></td>
                                                                                    <td>
                                                                                        <a href="#" class="text-danger delete-item"><i data-feather="trash-2" class="me-50"></i></a>
                                                                                        <a href="#" class="text-primary add-item"><i data-feather="plus-square" class="me-50"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        <!-- Items End -->    
												</div> 
											 
											</div>
								</div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                     
                </section>
                 
            </div>
        </div>
    </div>
 </form>
    <!-- END: Content-->
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        var selectedItemIds = @json($customer->approvedItems->pluck('item_id')->toArray());
        function fetchUOMs(itemId, rowId) {
        $.ajax({
            url: "{{ url('/vendors/get-uoms') }}", 
            method: 'POST',
            data: { item_id: itemId },
            success: function(data) {
                var uomSelect = $('#uom_' + rowId);
                uomSelect.empty();
                uomSelect.append('<option value="">Select</option>');
                data.alternate_uoms.forEach(function(uom) {
                    uomSelect.append('<option value="' + uom.id + '">' + uom.name + '</option>');
                });
                var selectedUomId = $('#uom-id_' + rowId).val();
                if (selectedUomId) {
                    uomSelect.val(selectedUomId); 
                }
                uomSelect.prop('disabled', false); 
            },
            error: function(xhr) {
                console.error('Error fetching UOM data:', xhr.responseText);
            }
        });
    }

    $('#vendorTable tr').each(function() {
            var rowId = $(this).attr('id');
            if (rowId) {
                var rowIndex = rowId.split('-')[1];  
                var itemId = $('#item-id_' + rowIndex).val();
                if (itemId) {
                    fetchUOMs(itemId, rowIndex);
                }
            }
        });

        $('#vendorTable').on('input', '.sell-price-approved-customer', function () {
            var rowId = $(this).closest('tr').attr('id').split('-')[1]; 
            var sellPrice = $('#sell-price_' + rowId).val(); 
            if (sellPrice && !isNaN(sellPrice)) {
                $('#uom_' + rowId).prop('disabled', false);
            } else {
                $('#uom_' + rowId).prop('disabled', true);
            }
        });
        function initializeVendorAutocomplete(selector) {
            $(selector).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ url('/items/search') }}", 
                        method: 'GET',
                        dataType: 'json',
                        data: {
                            term: request.term 
                        },
                        success: function(data) {
                            var filteredData = data.filter(function(item) {
                                return !selectedItemIds.includes(item.id); 
                            });
                            response($.map(filteredData, function(item) {
                                return {
                                    id: item.id,
                                    label: item.label,
                                    value: item.value,
                                    code: item.code || '', 
                                    item_id: item.id
                                };
                            }));
                        },
                        error: function(xhr) {
                            console.error('Error fetching vendor data:', xhr.responseText); 
                        }
                    });
                },
                minLength: 0, 
                select: function(event, ui) {
                    $(this).val(ui.item.label); 
                    var rowId = $(this).data('id');
                    $('#item-id_' + rowId).val(ui.item.id);
                    $('#item-code_' + rowId).val(ui.item.code);
                    if (!selectedItemIds.includes(ui.item.id)) {
                        selectedItemIds.push(ui.item.id);
                    }
                    fetchUOMs(ui.item.id, rowId);
                    return false;
                },
                change: function(event, ui) {
                    var rowId = $(this).data('id');
                    var currentItemId = $('#item-id_' + rowId).val();
                    
                    if (!ui.item) {
                        $(this).val(""); 
                        $('#item-id_' + rowId).val('');
                        if (currentItemId && selectedItemIds.includes(parseInt(currentItemId))) {
                            var index = selectedItemIds.indexOf(parseInt(currentItemId));
                            if (index > -1) {
                                selectedItemIds.splice(index, 1); 
                            }
                        }
                    }
                }
            }).focus(function() {
                if (this.value === "") {
                    $(this).autocomplete("search", ""); 
                }
            });
        }
        function updateRowIndices() {
            $('#vendorTable tbody tr').each(function(index) {
                var $row = $(this);

                // Update row number in the first cell (index starts from 1)
                $row.find('td:first').text(index + 1);

                // Update name and id attributes for input fields and selects
                $row.find('input, select').each(function() {
                    var $this = $(this);
                    var name = $this.attr('name');
                    if (name) {
                        // Update name by replacing old index with the new one
                        $this.attr('name', name.replace(/\[\d+\]/, '[' + index + ']'));
                    }
                    var id = $this.attr('id');
                    if (id) {
                        // Update id by replacing old index with the new one
                        $this.attr('id', id.replace(/\d+$/, index));
                    }
                    var dataId = $this.data('id');
                    if (dataId !== undefined) {
                        $this.data('id', index); // Update data-id to match the new index
                    }
                });
                $row.attr('id', 'row-' + index);
                $row.find('.delete-item').show();
                $row.find('.add-item').toggle(index === 0);
                var uomSelect = $row.find('select[id^="uom_"]');
                uomSelect.prop('disabled', true);
                var sellPriceInput = $row.find('input[id^="sell-price_"]');
                var sellPrice = sellPriceInput.val();
                if (sellPrice && !isNaN(sellPrice)) {
                    uomSelect.prop('disabled', false); 
                }
            });
            initializeVendorAutocomplete(".vendor-autocomplete");
        }
        $('#vendorTable').on('click', '.add-item', function(e) {
            e.preventDefault();
            var newRow = $('#vendorTable tbody tr:first').clone();
            var rowCount = $('#vendorTable tbody tr').length;
            newRow.find('td:first').text(rowCount + 1);
            newRow.attr('id', 'row-' + rowCount); 
            newRow.attr('data-id', ''); 
            newRow.find('input').each(function() {
                $(this).val(''); 
                var id = $(this).attr('id');
                if (id) {
                    $(this).attr('id', id.replace(/\d+$/, rowCount));
                }
                var dataId = $(this).data('id');
                if (dataId !== undefined) {
                    $(this).data('id', rowCount); 
                }
            });

            newRow.find('select').each(function() {
                var selectId = $(this).attr('id');
                if (selectId) {
                    $(this).attr('id', selectId.replace(/\d+$/, rowCount)); 
                }
                $(this).prop('disabled', true);     });
            $('#vendorTable tbody').append(newRow);
            updateRowIndices();
            feather.replace();
        });

        $('#vendorTable').on('click', '.delete-item', function(e) {
            e.preventDefault();
            var $row = $(this).closest('tr');
            var itemId = $row.data('id');
            var itemRowId = $(this).closest('tr').find('input[data-id]').data('id');
            var itemIdToRemove = $('#item-id_' + itemRowId).val();
            if (itemIdToRemove && selectedItemIds.includes(parseInt(itemIdToRemove))) {
                selectedItemIds.splice(selectedItemIds.indexOf(parseInt(itemIdToRemove)), 1);
            }
            if (itemId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Are you sure you want to delete this record?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/customers/customer-items/' + itemId,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {         
                                if (response.status) {
                                    $row.remove();
                                    Swal.fire('Deleted!', response.message, 'success');
                                    location.reload();
                                    updateRowIndices();
                                } else {
                                    Swal.fire('Error!', response.message || 'Could not delete the record.', 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while deleting the record.', 'error');
                            }
                        });
                    }
                });
            } else {
                $row.remove();
                updateRowIndices();
            }
        });
        initializeVendorAutocomplete(".vendor-autocomplete");
        updateRowIndices();
    });
</script>
 <!-- Item End -->
 <script>
  $(document).ready(function() {
    var titles = @json($titles);
    var $contactsTableBody = $('#contactsTable tbody');
    function updateDropdown($select) {
        var options = '<option value="">Select</option>' + titles.map(function(title) {
            return '<option>' + title + '</option>';
        }).join('');
        $select.html(options);
    }
    function updateIcons() {
        var rows = $contactsTableBody.find('tr');
        rows.each(function(index) {
            var $row = $(this);
            $row.find('td:first').text(index + 1); 
            $row.find('[name]').each(function() {
                var name = $(this).attr('name');
                $(this).attr('name', name.replace(/\[\d+\]/, '[' + index + ']')); 
            });
            $row.find('.delete-contact-row').show();
            $row.find('.add-contact-row').toggle(index === 0);
        });
    }
    function addContactRow() {
        var rowCount = $contactsTableBody.children().length;
        var $currentRow = $contactsTableBody.find('tr:last');
        var $newRow = $currentRow.clone();
        $newRow.find('[name]').each(function() {
            var name = $(this).attr('name');
            $(this).attr('name', name.replace(/\[\d+\]/, '[' + rowCount + ']')); 
            $(this).val('');
        });
        $newRow.attr('data-id', '');
        $newRow.find('input[type=radio]').prop('checked', false).val('0');
        updateDropdown($newRow.find('.form-select'));
        $contactsTableBody.append($newRow);
        feather.replace();
        updateIcons();
    }
    $(document).on('click', '.add-contact-row', function(e) {
        e.preventDefault();
        addContactRow();
    });
    $contactsTableBody.on('click', '.delete-contact-row', function(e) {
        e.preventDefault();
        var $row = $(this).closest('tr');
        var contactId = $row.data('id');
        if (contactId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Are you sure you want to delete this record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/customers/contacts/' + contactId,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(response) {
                            if (response.status) {
                                $row.remove(); 
                                Swal.fire('Deleted!', response.message, 'success');
                                updateIcons();
                            } else {
                                Swal.fire('Error!', response.message || 'Could not delete the contact.', 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while deleting the contact.', 'error');
                        }
                    });
                }
            });
        } else {
            $row.remove();
            updateIcons();
        }
    });
    $contactsTableBody.on('change', 'input[type=radio]', function() {
        var $radioButtons = $contactsTableBody.find('input[type=radio]');
        $radioButtons.prop('checked', false).val('0');
        $(this).prop('checked', true).val('1');
    });
    if ($contactsTableBody.children().length === 0) {
        addContactRow();
    } else {
        updateIcons(); 
    }
    updateIcons();
});
</script>

<script>
    $(document).ready(function() {
        const countries = @json($countries); 
        const addressTypes = @json($addressTypes); 

        function populateSelect(element, data, placeholder, selectedValue = '') {
            let options = `<option value="">${placeholder}</option>`;
            data.forEach(item => {
                const id = item.id || item;
                const name = item.name || item;
                options += `<option value="${id}" ${id === selectedValue ? 'selected' : ''}>${name}</option>`;
            });
            element.html(options);
        }

        function populateDynamicSelects() {
            const $countrySelects = $('.country-select');
            const $addressTypeSelects = $('.address-type');
            populateSelect($countrySelects, countries, 'Select Country');
            populateSelect($addressTypeSelects, addressTypes, 'Select Type');
        }

        function populateRowWithValues($row) {
            const countryId = $row.data('country-id');
            const stateId = $row.data('state-id');
            const cityId = $row.data('city-id');
            const addressType = $row.data('type');

            populateSelect($row.find('.country-select'), countries, 'Select Country', countryId);

            if (countryId) {
                $.get(`{{ url('/vendors/states/') }}/${countryId}`, function(states) {
                    populateSelect($row.find('.state-select'), states, 'Select State', stateId);
                    if (stateId) {
                        $.get(`{{ url('/vendors/cities/') }}/${stateId}`, function(cities) {
                            populateSelect($row.find('.city-select'), cities, 'Select City', cityId);
                        });
                    }
                });
            }

            populateSelect($row.find('.address-type'), addressTypes, 'Select Type', addressType);
        }

        function updateRowIndexes() {
            $('#address-table-body .address-row').each(function(index) {
                $(this).find('.index').text(index + 1);
                $(this).find('input, select').each(function() {
                    $(this).attr('name', $(this).attr('name').replace(/\[\d+\]/, `[${index}]`));
                });
                $(this).find('.delete-address').show(); 
                $(this).find('.add-address').toggle(index === 0);
            });
        }

        function handleRadioSelection() {
            $('#address-table-body').on('change', 'input[type="radio"][name*="[is_billing]"]', function() {
                $('#address-table-body input[type="radio"][name*="[is_billing]"]').not(this).prop('checked', false);
                $(this).val('1');
            });

            $('#address-table-body').on('change', 'input[type="radio"][name*="[is_shipping]"]', function() {
                $('#address-table-body input[type="radio"][name*="[is_shipping]"]').not(this).prop('checked', false);
                $(this).val('1');
            });
        }
        populateDynamicSelects();

        $('#address-table-body .address-row').each(function() {
            populateRowWithValues($(this));
        });

        $('#address-table-body').on('change', '.country-select', function() {
            const $row = $(this).closest('tr');
            const countryId = $(this).val();
            const $stateSelect = $row.find('.state-select');
            const $citySelect = $row.find('.city-select');

            $stateSelect.html('<option value="">Select State</option>');
            $citySelect.html('<option value="">Select City</option>');

            if (countryId) {
                $.get(`/vendors/states/${countryId}`, function(states) {
                    populateSelect($stateSelect, states, 'Select State');
                });
            }
        });

        $('#address-table-body').on('change', '.state-select', function() {
            const $row = $(this).closest('tr');
            const stateId = $(this).val();
            const $citySelect = $row.find('.city-select');

            $citySelect.html('<option value="">Select City</option>');

            if (stateId) {
                $.get(`/vendors/cities/${stateId}`, function(cities) {
                    populateSelect($citySelect, cities, 'Select City');
                });
            }
        });

        $(document).on('click', '.add-address', function(e) {
            e.preventDefault();
            const $lastRow = $('#address-table-body .address-row').last();
            const index = $lastRow.data('index') + 1;
            const $newRow = $lastRow.clone().attr('data-index', index);
            $newRow.find('input').val('');
            $newRow.find('select').val('');
            $newRow.attr('data-id', ''); 
            $newRow.find('input[type="radio"]').prop('checked', false);
            populateRowWithValues($newRow);
            $('#address-table-body').append($newRow);
            updateRowIndexes();
            handleRadioSelection();
        });

        $(document).on('click', '.delete-address', function(e) {
            e.preventDefault();
            var $row = $(this).closest('.address-row');
            var addressId = $row.data('id');
            if (addressId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Are you sure you want to delete this record?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/customers/address/' + addressId,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                if (response.status) {
                                    $row.remove();
                                    Swal.fire('Deleted!', response.message, 'success');
                                    updateRowIndexes();
                                } else {
                                    Swal.fire('Error!', response.message || 'Could not delete the address.', 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while deleting the address.', 'error');
                            }
                        });
                    }
                });
            } else {
                $row.remove();
                updateRowIndexes();
            }
        });
        updateRowIndexes();
        handleRadioSelection();
    });
</script>

<script>
    $(document).ready(function() {
        let $bankTableBody = $('#bank-info-container');
        let index = $bankTableBody.children('.bank-info-row').length;

        function updateRowIndices() {
            $bankTableBody.find('.bank-info-row').each(function(i) {
                let $row = $(this);
                $row.find('td:first').text(i + 1);
                $row.find('input[name]').each(function() {
                    let name = $(this).attr('name');
                    $(this).attr('name', name.replace(/\[\d+\]/, '[' + i + ']'));
                });
                $row.find('.delete-bank-row').show();
                $row.find('.add-bank-row').toggle(i === 0);
            });
        }

        function addNewRow() {
            let $template = $bankTableBody.find('.bank-info-row:first').clone();
            $template.attr('data-index', index++);
            $template.find('input').each(function() {
                let name = $(this).attr('name');
                if ($(this).attr('type') !== 'file') {
                    $(this).val('');
                }
                $(this).attr('name', name.replace(/\d+/, index - 1)); 
            });
            $template.find('input[type=radio]').prop('checked', false).val('0');
            $template.find('input[type=file]').val('');
            $template.attr('data-id', '');
            $template.find('.file-link').parent().hide();
            $bankTableBody.append($template);
            updateRowIndices();
            feather.replace();
        }

        $bankTableBody.on('click', '.add-bank-row', function(e) {
            e.preventDefault();
            addNewRow();
        });

        $bankTableBody.on('click', '.delete-bank-row', function(e) {
            e.preventDefault();
            var $row = $(this).closest('.bank-info-row');
            var bankInfoId = $row.data('id');
            if (bankInfoId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Are you sure you want to delete this record?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/customers/bank-info/' + bankInfoId, 
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                if (response.status) {
                                    $row.remove();
                                    Swal.fire('Deleted!', response.message, 'success');
                                    updateRowIndices();
                                } else {
                                    Swal.fire('Error!', response.message || 'Could not delete the record.', 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while deleting the record.', 'error');
                            }
                        });
                    }
                });
            } else {
                $row.remove();
                updateRowIndices();
            }
        });

        $bankTableBody.on('change', 'input[type=radio]', function() {
            $bankTableBody.find('input[type=radio]').prop('checked', false).val('0');
            $(this).prop('checked', true).val('1');
        });

        if ($bankTableBody.children('.bank-info-row').length === 0) {
            addNewRow();
        }
        updateRowIndices(); 
    });
</script>

<script>
    $(document).ready(function() {
        var today = new Date().toISOString().split('T')[0];
        $('#transactionDate').val(today);
        function fetchExchangeRates() {
            var transactionDate = $('#transactionDate').val();
            var currencyId = $('#currencySelect').val();
            $('#orgCurrencyRow, #groupCurrencyRow, #companyCurrencyRow').hide();
            if (currencyId && transactionDate) {
                $.ajax({
                    url: '/exchange-rates/get-currency-exchange-rate',
                    type: 'POST',
                    data: {
                        currency: currencyId,
                        date: transactionDate,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#orgCurrencyRow, #groupCurrencyRow, #companyCurrencyRow').show();
                            $('#orgCurrencySymbol').text(response.data.org_currency_code);
                            $('#groupCurrencySymbol').text(response.data.group_currency_code);
                            $('#companyCurrencySymbol').text(response.data.comp_currency_code);
                            $('#orgCurrency').val(response.data.org_currency_exg_rate);
                            $('#groupCurrency').val(response.data.group_currency_exg_rate);
                            $('#companyCurrency').val(response.data.comp_currency_exg_rate);
                            $('#submit-button').prop('disabled', false);
                            $('#save-draft-button').prop('disabled', false);
                        } else {
                            alert(response.message);
                            $('#submit-button').prop('disabled', true);
                            $('#save-draft-button').prop('disabled', true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', error);
                        alert('An error occurred while fetching exchange rates.');
                        $('#submit-button').prop('disabled', true);
                        ('#save-draft-button').prop('disabled', true);
                    }
                });
            } else {
                alert('Please select a currency and ensure the date is set.');
                $('#submit-button').prop('disabled', true);
                ('#save-draft-button').prop('disabled', true);
            }
        }
        $('#currencySelect').on('change', function() {
            fetchExchangeRates();
        });
        if ($('#currencySelect').val()) {
            fetchExchangeRates();
        }
    });
</script>
@endsection
