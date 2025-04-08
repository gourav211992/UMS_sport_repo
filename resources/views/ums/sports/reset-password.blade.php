<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <title>Reset Password - Sport Management</title>

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
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static   menu-collapsed"
      data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="container-fluid p-0 bg-white">
    <div class="row h-100 align-items-lg-center">
        <div class="col-md-5 login-newerp-bg d-none d-md-flex">
            <div class="loginerpnew-designhead"></div>
            <img src="{{asset('sports/img/new-image-login.png')}}" alt="The Presence 360" width="100%"
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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="tab-pane active">
                            <form class="auth-login-form mt-2" id="sports_reset_form"
                                  action="{{ route('sports.password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <h4 class="mb-2">Reset Password 🔒</h4>
                                <p class="mb-4">Enter your new password</p>

                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control" id="email" name="email"
                                           value="{{ $email ?? old('email') }}" required readonly />
                                    @error('email')
                                    <span class="invalid-feedback" style="display: block; color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password">New Password</label>
                                    <div class="input-group input-group-merge form-password-toggle passwordinputnew">
                                        <input class="form-control form-control-merge" id="password"
                                               type="password" name="password" placeholder="············" required />
                                        <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"> <i
                                                            data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" style="display: block; color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <div class="input-group input-group-merge form-password-toggle passwordinputnew">
                                        <input class="form-control form-control-merge" id="password_confirmation"
                                               type="password" name="password_confirmation" placeholder="············" required />
                                        <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"> <i
                                                            data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                            </form>

                            <p class="text-center mt-3">
                                <a href="{{ route('sports.login') }}"><i data-feather="chevron-left"></i> Back to login</a>
                            </p>
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

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
</script>
</body>
</html>