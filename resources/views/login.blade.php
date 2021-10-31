{{-- <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Parqueo| Login</title>

    <link href="{{ asset('Inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('Inspinia/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div class="card">
            <div class="card-header" style="height:60px;background-color:#f35731;">
                <span class="h4 text-uppercase" style="color:white;">Ladrilleria</span>
            </div>
            <div class="card-body">

                <p class="h5 text-uppercase">Iniciar Session</p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group text-left">
                        <label class="" for=" username">Correo:</label>
                        <input type="text" placeholder="example@gmail.com" value="{{ old('email') }}" name="email"
                            id="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group text-left">
                        <label class="" for=" password">Contraseña:</label>
                        <input type="password" placeholder="******************" required="" value="" name="password"
                            id="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-danger btn-block" style="background-color:#f35731; border-block-color: #f35731">Login</button>
                </form>
            </div>

        </div>
    </div>

    <script src="{{ asset('Inspinia/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/popper.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/bootstrap.js') }}"></script>

</body>

</html> --}}
<!DOCTYPE html>
<html>

<head>
    <title>Animated Login Form</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('LoginPlantilla/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <img class="wave" src="{{ asset('LoginPlantilla/img/wave.png') }}" />
    <div class="container">
        <div class="img"></div>
        <div class="login-content">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <img src="{{ asset('LoginPlantilla/img/avatar.svg') }}" />
                <br>

                <div style="float: left;">
                    <label for="">USUARIO</label>
                </div>
                <br>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <input type="text" value="{{ old('email') }}" name="email" id="email" class="input">
                    </div>
                </div>
                @error('email')
                <div style="text-align: left">
                    <span style="color:rgb(206, 49, 49)">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror


                <br>
                <div style="float: left;">
                    <label for="">Password</label>
                </div>
                <br>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" id="password" />
                    </div>
                </div>
                @error('password')
                <div style="text-align: left">
                    <span style="color:rgb(206, 49, 49)">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
                <input type="submit" class="btn" value="Login" />
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('LoginPlantilla/js/main.js') }}"></script>
</body>

</html>
