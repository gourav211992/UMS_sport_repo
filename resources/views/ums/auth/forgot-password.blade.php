<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMNRU | Admin Panel</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link href="{{asset('assets/admin/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet">
	{!! NoCaptcha::renderJs() !!}

    <style>
        .eyebtn {
            cursor: pointer;
        }

        #loading-image {
            background: rgb(217 214 214 / 30%);
            position: fixed;
            z-index: 999999999999999999;
            height: 100%;
            width: 100%;
            top: 0px;
            text-align: center;
        }

        #loading-image img {
            width: 30%;
        }
    </style>
</head>

<body class="loginbg">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box mt-2 min-Loginheight">
                        <div class="row">
                            <div class="col-sm-12 col-md-7 position-relative min-Loginheight">
                                <div class="uplogo">
                                    <img src="{{asset('assets/admin/img/login-logo.png')}}" />
                                </div>
                                <div class="yogiimg">
                                     <img src="{{asset('assets/admin/img/loginbg.png')}}"   /> 
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="loginArea"> 
                                    <form method="POST" action="{{ route('forgot-password') }}" id="myform">
                                        @csrf

										@include('admin.partials.notifications')

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="loginTabs">
                                                    
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="organization" role="tabpanel" aria-labelledby="org-tab">
                                                            @if(isset($errorMsg) && $errorMsg)
                                                                <div class="text-danger login_error">{{$errorMsg}}</div>
                                                            @endif 
                                                            <h5 class="mb-5 "><i class="fa fa-sign-in"></i> Enter Your Email ID</h5>
                                                            <div class="row my-4">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="user_name">Email ID<span class="text-danger">*</span></label>
                                                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your Email Id">
                                                                        @error('email')
                                                                        <div class="text-danger email_error">{{ $message }}</div>
                                                                        @enderror

                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-primary">Submit
                                                                    </button>
																	<a href="{{route('admin-login')}}" class="text-black" style="float: right;">Admin Login?</a>
                                                                </div>
                                                                 

                                                                <div class="col-md-12 mt-4">
                                                                    
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="mt-5">
                                                        <p class="f-12 mb-0">For any query/issue, please write to <a href="mailto:dsmnru.help@gmail.com" class="text-orange">dsmnru.help@gmail.com</a></p>
                                                        <p class="f-12 text-muted mb-0">This site is best viewed with latest version of all browsers.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="rightreserved f-12 my-2">Powered by Sheela Foam Ltd.</div>
                </div>
            </div>
        </div>

    </div>



    <!-- Success Alert Modal -->
    <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-success">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-checkmark h1 text-white"></i>
                        <h4 class="mt-2 text-white">Well Done!</h4>
                        <p class="mt-3 text-white">Logged in successfully.</p>
                        <a href="{{ route('admin-dashboard') }}" class="btn btn-light my-2">Continue</a>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div id="loading-image" style="display:none;">
        <img src="{{asset('images/Ajux_loader.gif')}}" />
    </div>


    <!-- jQuery -->
    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/admin/css/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/adminlte.js')}}"></script>


    <script>
        function show_password() {
            if ('password' == $('#password').attr('type')) {
                $('#password').prop('type', 'text');
            } else {
                $('#password').prop('type', 'password');
            }
        }
    </script>


</body>

</html>