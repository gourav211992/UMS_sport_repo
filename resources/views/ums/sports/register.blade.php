
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    
    <title>Sport Management</title>
     	
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
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
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo-->
                         <a class="brand-logo">
                            {{-- <img style="width: 180px;" src="{{asset('assets/css/thepresence.svg')}}" alt=""> --}}
                            {{-- sports/img/ --}}
                            <img style="width: 180px;" src="{{asset('sports/assets/css/logo.jpg')}}" alt="">

                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                                <img class="img-fluid" src="../../../app-assets/images/pages/login-v2.svg" alt="Login V2" />
                                <!-- <img class="img-fluid" src="sports/img/new-image-login.png" alt="Login V2" /> -->
                            </div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">


                                <h4 class="card-title text-dark mb-1">Welcome to Sports Academy!</h4>
                                <p class="card-text mb-2">Please sign-up to your account and complete your <strong>Registration</strong></p>

                               <form class="auth-login-form mt-2 customernewsection-form" action="{{ route('sports-register') }}" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label for="first_name" class="form-label">First Name<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" />
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>

                                <div class="mb-1">
                                    <label for="middle_name" class="form-label">Middle Name<span class="required"></span></label>
                                    <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" placeholder="Enter Middle Name" />
                                    @if ($errors->has('middle_name'))
                                        <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                                    @endif
                                </div>

                                <div class="mb-1">
                                    <label for="last_name" class="form-label">Last Name<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" />
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>

                                <div class="mb-1">
                                    <label class="form-label" for="login-email">Email<span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="eg: john@vendor.com" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Mobile No.<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="Enter Mobile No." />
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                    @endif
                                </div>

                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Password<span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="Password must be at least 8 characters" />
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Confirm Password<span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Password." />
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary btn-primary-new w-100 mt-2"><i data-feather="send"></i> Register</button>
                            </form>


                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
                <div>
                    <a class="brand-logo">
                             <img style="width: 180px;" src="{{asset('assets/css/thepresence.svg')}}" alt=""> 
                            {{-- sports/img/ --}}
                            <!-- <img style="width: 180px;" src="{{asset('sports/assets/css/logo.jpg')}}" alt=""> -->

                        </a>
                    </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/auth-login.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
</html>
<!-- END: Body-->
