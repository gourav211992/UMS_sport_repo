@extends('ums.admin.admin-meta')

@section('content')
    
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="app-user-view-billing">
                <div class="row">
                    <!-- User Sidebar -->
                    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                        <!-- User Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="user-avatar-section">
                                    <div class="d-flex align-items-center flex-column">
                                        <img class="img-fluid rounded mt-3 mb-2" src="../../../app-assets/images/portrait/small/avatar-s-4.jpg" height="110" width="110" alt="User avatar">
                                        <div class="user-info text-center">
                                            <h4>Indian Oil Corporation Ltd</h4>
                                            <span class="badge bg-light-secondary">Organization</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around my-2 pt-75">
                                    <div class="d-flex align-items-start me-2">
                                        <span class="badge bg-light-primary p-75 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box font-medium-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                        </span>
                                        <div class="ms-75">
                                            <h4 class="mb-0">200</h4>
                                            <small>Total Products</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start mb-1">
                                        <span class="badge bg-light-primary p-75 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase font-medium-2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                        </span>
                                        <div class="ms-75">
                                            <h4 class="mb-0">854K</h4>
                                            <small>Total Invoice</small>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                <div class="info-container">
                                    <ul class="list-unstyled"> 
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Email:</span>
                                            <span>hello@vendor.com</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Contact:</span>
                                            <span>9876789876</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Status:</span>
                                            <span class="badge bg-light-success">Active</span>
                                        </li>   
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Primary Contact:</span>
                                            <span>Aniket Singh</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">POC No.:</span>
                                            <span>933-44-22</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">POC Email:</span>
                                            <span>aniket@gmail.com</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Country:</span>
                                            <span>India</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Currency:</span>
                                            <span>INR</span>
                                        </li>
                                        
                                    </ul>
                                     
                                </div>
                            </div>
                        </div>
                         
                    </div>
                    <!--/ User Sidebar -->

                    <!-- User Content -->
                    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                         
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">My Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-2 pb-50">
                                            <h5>Aadhar No</h5>
                                            <span>98765434567 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-warning"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></span>
                                        </div>
                                        <div class="mb-2 pb-50">
                                            <h5>PAN</h5>
                                            <span>23456745345 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-success"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>
                                        </div>
                                        <div class="mb-2 mb-md-1">
                                            <h5>Address <span class="badge badge-light-primary ms-50">Primary</span></h5>
                                            <span>Plot No 4, Sector 135, Noida 201301</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-warning mb-2" role="alert"> 
                                            <div class="alert-body fw-normal font-small-3"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> Your Account is pending for Verification.</div>
                                        </div>
                                        <div class="plan-statistics pt-1">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="fw-bolder">Profile Completed</h5>
                                                <h6 class="fw-bold font-small-3">40% of 100%</h6>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar w-25" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-50">Atlease 80% Registration complete to verify your account.</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <a class="btn btn-primary me-1 mt-1 waves-effect waves-float waves-light" href="profile_edit">
                                            Update Profile
                                        </a>
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                         

                    </div>
                    <!--/ User Content -->
                </div>
            </section>
            <!-- Edit User Modal -->
            <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 pt-50">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">Edit User Information</h1>
                                <p>Updating user details will receive a privacy audit.</p>
                            </div>
                            <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false" novalidate="novalidate">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserFirstName">First Name</label>
                                    <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" value="Gertrude" data-msg="Please enter your first name">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserLastName">Last Name</label>
                                    <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" value="Barton" data-msg="Please enter your last name">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalEditUserName">Username</label>
                                    <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" value="gertrude.dev" placeholder="john.doe.007">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserEmail">Billing Email:</label>
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" value="gertrude@gmail.com" placeholder="example@domain.com">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserStatus">Status</label>
                                    <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select" aria-label="Default select example">
                                        <option selected="">Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                        <option value="3">Suspended</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditTaxID">Tax ID</label>
                                    <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="Tax-8894" value="Tax-8894">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserPhone">Contact</label>
                                    <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="+1 (609) 933-44-22" value="+1 (609) 933-44-22">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserLanguage">Language</label>
                                    <div class="position-relative"><select id="modalEditUserLanguage" name="modalEditUserLanguage" class="select2 form-select select2-hidden-accessible" multiple="" data-select2-id="modalEditUserLanguage" tabindex="-1" aria-hidden="true">
                                        <option value="english">English</option>
                                        <option value="spanish">Spanish</option>
                                        <option value="french">French</option>
                                        <option value="german">German</option>
                                        <option value="dutch">Dutch</option>
                                        <option value="hebrew">Hebrew</option>
                                        <option value="sanskrit">Sanskrit</option>
                                        <option value="hindi">Hindi</option>
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserCountry">Country</label>
                                    <div class="position-relative"><select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select select2-hidden-accessible" data-select2-id="modalEditUserCountry" tabindex="-1" aria-hidden="true">
                                        <option value="" data-select2-id="3">Select Value</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                        <option value="China">China</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-modalEditUserCountry-container"><span class="select2-selection__rendered" id="select2-modalEditUserCountry-container" role="textbox" aria-readonly="true" title="Select Value">Select Value</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="form-check form-switch form-check-primary">
                                            <input type="checkbox" class="form-check-input" id="customSwitch10" checked="">
                                            <label class="form-check-label" for="customSwitch10">
                                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                            </label>
                                        </div>
                                        <label class="form-check-label fw-bolder" for="customSwitch10">Use as a billing address?</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">
                                        Discard
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Edit User Modal -->
            <!-- upgrade your plan Modal -->
            <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-upgrade-plan">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-5 pb-2">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">Upgrade Plan</h1>
                                <p>Choose the best plan for user.</p>
                            </div>
                            <form id="upgradePlanForm" class="row pt-50" onsubmit="return false">
                                <div class="col-sm-8">
                                    <label class="form-label" for="choosePlan">Choose Plan</label>
                                    <select id="choosePlan" name="choosePlan" class="form-select" aria-label="Choose Plan">
                                        <option selected="">Choose Plan</option>
                                        <option value="standard">Standard - $99/month</option>
                                        <option value="exclusive">Exclusive - $249/month</option>
                                        <option value="Enterprise">Enterprise - $499/month</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 text-sm-end">
                                    <button type="submit" class="btn btn-primary mt-2 waves-effect waves-float waves-light">Upgrade</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="modal-body px-5 pb-3">
                            <h6>User current plan is standard plan</h6>
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex justify-content-center me-1 mb-1">
                                    <sup class="h5 pricing-currency pt-1 text-primary">$</sup>
                                    <h1 class="fw-bolder display-4 mb-0 text-primary me-25">99</h1>
                                    <sub class="pricing-duration font-small-4 mt-auto mb-2">/month</sub>
                                </div>
                                <button class="btn btn-outline-danger cancel-subscription mb-1 waves-effect">Cancel Subscription</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ upgrade your plan Modal -->
            <!-- edit card modal  -->
            <div class="modal fade" id="editCard" tabindex="-1" aria-labelledby="editCardTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-sm-5 mx-50 pb-5">
                            <h1 class="text-center mb-1" id="editCardTitle">Edit Card</h1>
                            <p class="text-center">Edit your saved card details</p>

                            <!-- form -->
                            <form id="editCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false" novalidate="novalidate">
                                <div class="col-12">
                                    <label class="form-label" for="modalEditCardNumber">Card Number</label>
                                    <div class="input-group input-group-merge">
                                        <input id="modalEditCardNumber" name="modalEditCard" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898" value="5637 8172 1290 7898" aria-describedby="modalEditCard2" data-msg="Please enter your credit card number">
                                        <span class="input-group-text cursor-pointer p-25" id="modalEditCard2">
                                            <span class="edit-card-type"><img src="../../../app-assets/images/icons/payments/maestro-cc.png" height="24"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="modalEditCardName">Name On Card</label>
                                    <input type="text" id="modalEditCardName" class="form-control" placeholder="John Doe">
                                </div>

                                <div class="col-6 col-md-3">
                                    <label class="form-label" for="modalEditCardExpiryDate">Exp. Date</label>
                                    <input type="text" id="modalEditCardExpiryDate" class="form-control expiry-date-mask" placeholder="MM/YY">
                                </div>

                                <div class="col-6 col-md-3">
                                    <label class="form-label" for="modalEditCardCvv">CVV</label>
                                    <input type="text" id="modalEditCardCvv" class="form-control cvv-code-mask" maxlength="3" placeholder="654">
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-switch form-check-primary me-25">
                                            <input type="checkbox" class="form-check-input" id="editSaveCard" checked="">
                                            <label class="form-check-label" for="editSaveCard">
                                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                            </label>
                                        </div>
                                        <label class="form-check-label fw-bolder" for="editSaveCard">Save Card for future billing?</label>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-1 mt-1 waves-effect waves-float waves-light">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-1 waves-effect" data-bs-dismiss="modal" aria-label="Close">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ edit card modal  -->
            <!-- add new card modal  -->
            <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-sm-5 mx-50 pb-5">
                            <h1 class="text-center mb-1" id="addNewCardTitle">Add New Card</h1>
                            <p class="text-center">Add card for future billing</p>

                            <!-- form -->
                            <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false" novalidate="novalidate">
                                <div class="col-12">
                                    <label class="form-label" for="modalAddCardNumber">Card Number</label>
                                    <div class="input-group input-group-merge">
                                        <input id="modalAddCardNumber" name="modalAddCard" class="form-control add-credit-card-mask" type="text" placeholder="1356 3215 6548 7898" aria-describedby="modalAddCard2" data-msg="Please enter your credit card number">
                                        <span class="input-group-text cursor-pointer p-25" id="modalAddCard2">
                                            <span class="add-card-type"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="modalAddCardName">Name On Card</label>
                                    <input type="text" id="modalAddCardName" class="form-control" placeholder="John Doe">
                                </div>

                                <div class="col-6 col-md-3">
                                    <label class="form-label" for="modalAddCardExpiryDate">Exp. Date</label>
                                    <input type="text" id="modalAddCardExpiryDate" class="form-control add-expiry-date-mask" placeholder="MM/YY">
                                </div>

                                <div class="col-6 col-md-3">
                                    <label class="form-label" for="modalAddCardCvv">CVV</label>
                                    <input type="text" id="modalAddCardCvv" class="form-control add-cvv-code-mask" maxlength="3" placeholder="654">
                                </div>

                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-switch form-check-primary me-25">
                                            <input type="checkbox" class="form-check-input" id="saveCard" checked="">
                                            <label class="form-check-label" for="saveCard">
                                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                            </label>
                                        </div>
                                        <label class="form-check-label fw-bolder" for="saveCard">Save Card for future billing?</label>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-1 mt-1 waves-effect waves-float waves-light">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-1 waves-effect" data-bs-dismiss="modal" aria-label="Close">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ add new card modal  -->
            <!-- add new address modal -->
            <div class="modal fade" id="addNewAddressModal" tabindex="-1" aria-labelledby="addNewAddressTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-4 mx-50">
                            <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Add New Address</h1>
                            <p class="address-subtitle text-center mb-2 pb-75">Add address for billing address</p>

                            <form id="addNewAddressForm" class="row gy-1 gx-2" onsubmit="return false" novalidate="novalidate">
                                <div class="col-12">
                                    <div class="row custom-options-checkable">
                                        <div class="col-md-6 mb-md-0 mb-2">
                                            <input class="custom-option-item-check" id="homeAddressRadio" type="radio" name="newAddress" value="HomeAddress" checked="">
                                            <label for="homeAddressRadio" class="custom-option-item px-2 py-1">
                                                <span class="d-flex align-items-center mb-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home font-medium-4 me-50"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                                    <span class="custom-option-item-title h4 fw-bolder mb-0">Home</span>
                                                </span>
                                                <span class="d-block">Delivery time (7am – 9pm)</span>
                                            </label>
                                        </div>
                                        <div class="col-md-6 mb-md-0 mb-2">
                                            <input class="custom-option-item-check" id="officeAddressRadio" type="radio" name="newAddress" value="OfficeAddress">
                                            <label for="officeAddressRadio" class="custom-option-item px-2 py-1">
                                                <span class="d-flex align-items-center mb-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase font-medium-4 me-50"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                                    <span class="custom-option-item-title h4 fw-bolder mb-0">Office</span>
                                                </span>
                                                <span class="d-block">Delivery time (10am – 6pm)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalAddressFirstName">First Name</label>
                                    <input type="text" id="modalAddressFirstName" name="modalAddressFirstName" class="form-control" placeholder="John" data-msg="Please enter your first name">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalAddressLastName">Last Name</label>
                                    <input type="text" id="modalAddressLastName" name="modalAddressLastName" class="form-control" placeholder="Doe" data-msg="Please enter your last name">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalAddressCountry">Country</label>
                                    <div class="position-relative"><div class="position-relative"><select id="modalAddressCountry" name="modalAddressCountry" class="select2 form-select select2-hidden-accessible" tabindex="-1" aria-hidden="true" data-select2-id="modalAddressCountry">
                                        <option value="" data-select2-id="31">Select a Country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                        <option value="China">China</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="30" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-modalAddressCountry-container"><span class="select2-selection__rendered" id="select2-modalAddressCountry-container" role="textbox" aria-readonly="true" title="Select a Country">Select a Country</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div></div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalAddressAddress1">Address Line 1</label>
                                    <input type="text" id="modalAddressAddress1" name="modalAddressAddress1" class="form-control" placeholder="12, Business Park">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalAddressAddress2">Address Line 2</label>
                                    <input type="text" id="modalAddressAddress2" name="modalAddressAddress2" class="form-control" placeholder="Mall Road">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalAddressTown">Town</label>
                                    <input type="text" id="modalAddressTown" name="modalAddressTown" class="form-control" placeholder="Los Angeles">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalAddressState">State / Province</label>
                                    <input type="text" id="modalAddressState" name="modalAddressState" class="form-control" placeholder="California">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalAddressZipCode">Zip Code</label>
                                    <input type="text" id="modalAddressZipCode" name="modalAddressZipCode" class="form-control" placeholder="99950">
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-switch form-check-primary me-25">
                                            <input type="checkbox" class="form-check-input" id="useAsBillingAddress" checked="">
                                            <label class="form-check-label" for="useAsBillingAddress">
                                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>
                                            </label>
                                        </div>
                                        <label class="form-check-label fw-bolder" for="useAsBillingAddress">Use as a billing address?</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-1 mt-2 waves-effect waves-float waves-light">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect" data-bs-dismiss="modal" aria-label="Close">
                                        Discard
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / add new address modal -->

        </div>
    </div>
</div>


</body>
@endsection
