<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <title>Sport Management</title>

    <link rel="apple-touch-icon" href="../../../sports/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../assets/css/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600;700" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../sports/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../sports/assets/css/login.css">
    <!-- END: Custom CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        .input-group-text i {
            pointer-events: none;
        }

        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<!-- END: Head-->

<!-- @extends('ums.sports.sports-meta.admin-sports-meta')
@section('content')
     -->
<!-- BEGIN: Body-->

<!-- <head>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head> -->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static   menu-collapsed"
    data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="container-fluid p-0 bg-white">
        <div class="row h-100 align-items-lg-center">



            <div class="col-md-5 login-newerp-bg d-none d-md-flex">
                <div class="loginerpnew-designhead">
                    <!--                    <h2>Unbounded imagination</h2>-->
                </div>
                <img src="sports/img/new-image-login.png" alt="The Presence 360" width="100%"
                    style="min-height: 100vh; object-fit: cover;" />
            </div>

            <div class="col-md-7 newdesignerpscreenmob">
                <div class="row justify-content-center">

                    <div class="col-md-7 newdesignerpscreen">
                        <div class="text-center ">
                            <img class="login-logo" src="https://login.thepresence360.com/images/thepresence.svg"
                                alt="The Presence 360" width="150px" />
                        </div>


                        <div class="tab-content login-input-form">

                            <!-- Login with Email & Password -->
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div class="tab-pane active">
                                <form class="auth-login-form mt-2" id="sports_login_form"
                                    action="{{ route('post.sport.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" name="email" placeholder="john@example.com" />
                                        <div class="invalid-feedback" id="email-error" style="font-size: 10px;"></div>


                                        <!-- Add error span -->
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="password" class="form-label">Password</label>
                                            <a href="{{ route('sports.password.request') }}" class="fw-bold"><small> Forgot Password?</small></a>
                                        </div>


                                        <div class="input-group input-group-merge form-password-toggle passwordinputnew">

                                            <div class="input-group input-group-merge form-password-toggle passwordinputnew">
                                                <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" />
                                                <div class="input-group-append cursor-pointer">
                                                    <span id="password-icon" class="input-group-text cursor-pointer">
                                                        <b class="eye-click p-1">
                                                            <i id="eye" class="bi bi-eye"></i>
                                                        </b>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="invalid-feedback" id="password-error" style="font-size: 10px;"></div>
                                            </div>
                                            <div class="form-check form-check-primary mt-1">
                                                <input type="checkbox" class="form-check-input terms-checkbox" id="CarryEmail" required
                                                    style="width: 16px; height: 16px; margin-top: 3px; background-size: 60%;">
                                                <label class="form-check-label fw-bolder" for="CarryEmail" style="font-size: 10px;">
                                                    I hereby agree to the
                                                    <a href="#" target="_blank">Terms & Conditions</a> and
                                                    <a href="#" target="_blank">Privacy Policy</a>
                                                </label>
                                                <div class="invalid-feedback" style="font-size: 10px;">Please check the Terms & Conditions</div>
                                            </div>

                                      

                                        <div class="row">
                                            <!-- <div class="col-lg-6 col-md-6 col-6">
                                                <a class="btn btn-otp-primary w-100" href="">
                                                    <i data-feather="phone" class="mr-1"></i> OTP
                                                </a>
                                            </div> -->
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <button type="button" class="btn btn-primary w-100"
                                                    onclick="sports_login()">Login <i
                                                        data-feather="chevron-right"></i></button>
                                            </div>
                                        </div>

                                        <p class="mt-4 text-center fw-bold">Don't have an account?<a
                                                href="{{ route('sports.register') }}"> Register Now</a></p>

                                </form>
                                <!-- Success Modal -->
                                <div id="sports-login-success-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="sportsLoginSuccessModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content modal-filled bg-success">
                                            <div class="modal-body p-4">
                                                <div class="text-center">
                                                    <i class="dripicons-checkmark h1 text-white"></i>
                                                    <h4 class="mt-2 text-white" style="color:white;">Well Done!</h4>
                                                    <p class="mt-3 text-white" style="color:white;">Logged in
                                                        Successfully.</p>
                                                    {{-- @if (Request::segment(1) == null || Request::segment(1) == 'login' || Request::segment(1) == 'admission-portal') --}}
                                                    <a href="{{ route('sports.dashboard') }}"
                                                        class="btn btn-info my-2">Continue</a>
                                                    {{-- @else --}}
                                                    {{-- <a href="{{url()->current()}}" class="btn btn-info my-2">Continue</a> --}}
                                                    {{-- @endif --}}
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>

                                <!-- Error Modal -->
                                <div id="sports-login-error-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="sportsLoginErrorModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="sportsLoginErrorModalLabel">Login Failed
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="error-message">Invalid credentials. Please try again.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="bubbledots"><span></span><span></span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../sports/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../sports/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../sports/app-assets/js/core/app-menu.js"></script>
    <script src="../../../sports/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../sports/app-assets/js/scripts/pages/auth-login.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- END: Page JS-->

    <script>
        $(document).on('click', '.eye-click', function() {
            const $inputGroup = $(this).closest('.form-password-toggle');
            const $input = $inputGroup.find('input');
            const $icon = $(this).find('i');

            if ($input.attr('type') === 'password') {
                $input.attr('type', 'text');
                $icon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                $input.attr('type', 'password');
                $icon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
    </script>

    <!-- <script>
        function sports_login() {
            // Clear previous error messages
            if (!checkboxcheck()) return;
            $('#email-error').text('');
            $('#password-error').text('');
            $_token = "{{ csrf_token() }}";

            $.ajax({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                },
                type: 'POST',
                dataType: "json",
                url: "{{ route('post.sport.login') }}", // Route defined in web.php
                data: $('#sports_login_form').serialize(),
                success: function(data) {
                    if (data.status == true) {
                        // $('#sports-login-success-modal').modal('show');
                        window.location.href = "{{ route('sports.dashboard') }}"
                    } else {
                        // Show the error message below email field
                        alert(data.message);
                        $('#email-error').innerText(data.message);
                    }
                },
                error: function(request, status, error) {
                    // Handle form validation errors
                    if (request.responseJSON && request.responseJSON.errors) {
                        let errors = request.responseJSON.errors;
                        // Display error messages below the form fields
                        if (errors.email) {
                            $('#email-error').text(errors.email[0]);
                        }
                        if (errors.password) {
                            $('#password-error').text(errors.password[0]);
                        }
                    } else {
                        // General error message
                        $('#email-error').text("An error occurred. Please try again.");
                    }
                }
            });
        }


        function redirectToDashboard() {
            window.location.href = "{{ route('sports.dashboard') }}";
        }
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script> -->


    <script>
        function sports_login() {
            // Reset error states
            $('#email-error').text('');
            $('#password-error').text('');
            $('input[name="email"]').removeClass('is-invalid');
            $('#password').removeClass('is-invalid');
            $('#CarryEmail').removeClass('is-invalid');
            $('#password-icon').css('border-color', '');


            let email = $('input[name="email"]').val().trim();
            let password = $('#password').val().trim();
            let isCheckboxChecked = $('#CarryEmail').is(':checked');


            if (!email) {
                $('#email-error').text('Email is required');
                $('input[name="email"]').addClass('is-invalid');
                return;
            }

            if (!password) {
                $('#password-error').text('Password is required');
                $('#password').addClass('is-invalid');
                $('#password-icon').css('border-color', 'red');
              
                return;
            }

            if (!isCheckboxChecked) {
                $('#CarryEmail').addClass('is-invalid');
                return;
            }

            // CSRF token
            const _token = $("meta[name='_token']").attr('content');

            // AJAX login
            $.ajax({
                headers: {
                    'X-CSRF-Token': _token
                },
                type: 'POST',
                dataType: "json",
                url: "{{ route('post.sport.login') }}",
                data: $('#sports_login_form').serialize(),
                success: function(data) {
                    if (data.status === true) {
                        window.location.href = "{{ route('sports.dashboard') }}";
                    } else {
                        // Server-side validation errors
                        if (data.errors) {
                            if (data.errors.email) {
                                $('#email-error').text(data.errors.email[0]);
                                $('input[name="email"]').addClass('is-invalid');
                            }
                            if (data.errors.password) {
                                $('#password-error').text(data.errors.password[0]);
                                $('#password').addClass('is-invalid');
                            }
                        } else if (data.message) {
                            $('#email-error').html(data.message); // Use `.html()` if message contains anchor tags
                            $('input[name="email"]').addClass('is-invalid');
                        } else {
                            $('#email-error').text("Something went wrong. Please try again.");
                        }
                    }
                },
                error: function() {
                    $('#email-error').text("An unexpected error occurred. Please try again.");
                }
            });
        }
    </script>

    </script>
    @endsection