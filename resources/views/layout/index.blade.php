<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ladrilleria System</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css-vue')
    <link href="{{ asset('Inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('Inspinia/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"> --}}
    @yield('css-midle')
    <link href="{{ asset('Inspinia/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('Inspinia/css/style.css') }}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{ asset('Inspinia/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    @yield('css-custom')
    <style>
    </style>

</head>

@routes

<body style="color:rgb(37, 36, 64);">
    @auth
        <div id="">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    @include('layout.rutas')
                </div>
            </nav>
        </div>
        <div id="page-wrapper" class="gray-bg p-0">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2" href="#" id="ocultar" data-ocultar="0"><i
                                class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            @auth
                                <span class="m-r-sm text-muted welcome-message">Bienvenido <b>
                                        {{ auth()->user()->usuario }}</b></span>
                            @endauth
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>
                                Cerrar
                                Sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            <div id="content-system" style="">
                <!-- Contenido del Sistema -->
                @auth
                    @yield('contenido')
                @endauth
                <!-- /.Contenido del Sistema -->
            </div>
            @csrf
        </div>
        </div>
    @endauth
    @yield('script-vue')
    <script src="{{ asset('Inspinia/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/popper.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/bootstrap.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/inspinia.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/scripts.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('script-custom')
</body>

</html>
