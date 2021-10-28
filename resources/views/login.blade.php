<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Page title -->
    <title>HOMER | WebApp admin theme</title>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->
    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css')}}" />
    <link rel="stylesheet" href="{{ asset('homer/vendor/fontawesome/css/font-awesome.css')}}" />
    <link rel="stylesheet" href="{{ asset('homer/vendor/metisMenu/dist/metisMenu.css')}}" />
    <link rel="stylesheet" href="{{ asset('homer/vendor/animate.css/animate.css')}}" />
    <link rel="stylesheet" href="{{ asset('homer/vendor/bootstrap/dist/css/bootstrap.css')}}" />
    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('homer/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" />
    <link rel="stylesheet" href="{{ asset('homer/fonts/pe-icon-7-stroke/css/helper.css')}}" />
    <link rel="stylesheet" href="{{ asset('homer/styles/style.css')}}" />

</head>
<body class="blank">
    <div class="login-container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center m-b-md">
                    <h3>Login Ladrilleria</h3>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username"
                                    required="" value="" name="username" id="username" class="form-control">
                                <span class="help-block small">Tu usuario para web app</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******"
                                    required="" value="" name="password" id="password" class="form-control">
                                <span class="help-block small">Tu contraseña</span>
                            </div>
                            <button class="btn btn-danger btn-block">Login</button>
                            {{-- <a class="btn btn-default btn-block" href="#">Register</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <strong>System Ladrilleria</strong> -  WEB APP <br /> 2021 Copyright Company Name
            </div>
        </div>
    </div>
    <!-- Vendor scripts -->
    <script src="{{asset('homer/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('homer/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('homer/vendor/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('homer/vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('homer/vendor/metisMenu/dist/metisMenu.min.js')}}"></script>
    <script src="{{asset('homer/vendor/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('homer/vendor/sparkline/index.js')}}"></script>
    <!-- App scripts -->
    <script src="{{asset('homer/scripts/homer.js')}}"></script>
</body>
</html>
