<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
        <title>Khải Huy Company</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Vue js -->
{{--        <link href="{{asset('public/css/app.css')}}">--}}

        {{--Template --}}
        <link rel="icon" type="image/png" sizes="16x16" href="public/assets/images/favicon.png">
        <link rel="stylesheet" href="https://unpkg.com/element-ui@2.4.6/lib/theme-chalk/index.css">
        <!-- Bootstrap Core CSS -->
        <link href="public/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        {{-- Select 2 --}}
        <link rel="stylesheet" href="public/assets/plugins/select2/dist/css/select2.min.css">

        {{-- Toast CSS --}}
        <link rel="stylesheet" href="public/assets/plugins/toast-master/css/jquery.toast.css">
        {{-- Sweetalert CSS --}}
        <link rel="stylesheet" href="public/assets/plugins/sweetalert/sweetalert.css">

        <!-- morris CSS -->
        <link href="public/assets/plugins/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="public/template/css/style.css" rel="stylesheet">

        <!-- You can change the theme colors from here -->
        <link href="public/css/colors/blue-dark.css" id="theme" rel="stylesheet">

        {{--custom css--}}
        <link rel="stylesheet" href="public/template/css/custom.css">
        <link rel="stylesheet" href="public/template/css/custom_table.css">
        <link rel="stylesheet" href="public/template/css/custom-menu-left.css">
    </head>
<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>
    </div>
    <div>
        <section id="wrapper">
            <div class="login-register" style="background-image:url(public/assets/images/background/login-register.jpg);">
                <div class="login-box card">
                    <div class="card-body">
                        <form method="POST" class="form-horizontal form-material" id="loginform" action="{{url('api/auth/login')}}">
                            {{ csrf_field() }}
                            <h3 class="box-title m-b-20">Sign In</h3>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input name="email" class="form-control" type="text" required="" placeholder="Username">
                                    @if($errors->has('email'))
                                        <p style="color:red">{{$errors->first('email')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input name="password" class="form-control" type="password" required="" placeholder="Password"> </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 font-14">
                                    <div class="checkbox checkbox-primary pull-left p-t-0">
                                        <input id="checkbox-signup" type="checkbox">
                                        <label for="checkbox-signup"> Remember me </label>
                                    </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><!-- <i class="fa fa-lock m-r-5"></i> --> Forgot pwd?</a> </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                    <div class="social">
                                        <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                        <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <div>Don't have an account? <a href="pages-register.html" class="text-info m-l-5"><b>Sign Up</b></a></div>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal" id="recoverform" action="index.html">
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <h3>Recover Password</h3>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="Email"> </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{--Vue js--}}
    {{-- <script src="{{asset('public/js/app.js')}}"></script> --}}
    {{--<script type="" src="public/js/app.js"></script>--}}

    {{--PLUG IN--}}
    <script src="public/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="public/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="public/template/js/jquery.slimscroll.js"></script>

    <!--Wave Effects -->
    <script src="public/template/js/waves.js"></script>

    <!--Menu sidebar -->
    <script src="public/template/js/sidebarmenu.js"></script>

    <!--stickey kit -->
    <script src="public/assets/plugins/sticky-kit-master/dist/sticky-kit.js"></script>
    <!--Custom JavaScript -->
    <script src="public/template/js/custom.js"></script>

    <!--sparkline JavaScript -->
    <script src="public/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--morris JavaScript -->
    <script src="public/assets/plugins/raphael/raphael-min.js"></script>

    <script src="public/template/js/dashboard1.js"></script>

    <script src="public/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    {{-- Toast --}}
    <script src="public/assets/plugins/toast-master/js/jquery.toast.js"></script>

    {{-- Sweetalert --}}
    <script src="public/assets/plugins/sweetalert/sweetalert.min.js"></script>

    {{-- select 2 --}}
    <script src="public/assets/plugins/select2/dist/js/select2.js"></script>

    <script src="public/assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>

    <script src="public/template/js/custom_end.js"></script>
    <footer></footer>
</body>
</html>