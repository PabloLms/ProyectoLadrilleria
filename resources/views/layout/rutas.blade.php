<ul class="nav metismenu" id="side-menu">
    <li class="nav-header">
        <div class="dropdown profile-element text-center">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img src="{{ asset('default.jpg') }}" style="display: block;
                                            margin: auto;
                                            width:70%;
                                            height: 80px;" alt="">
                <span class="block m-t-xs font-bold"> <img src="" alt="" width="60">{{ ' ' . auth()->user()->name }}
                </span>
            </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
        <div class="logo-element">
            <img src="{{ asset('img/header.jpg') }}" height="45" width="45">
        </div>
    </li>
    <li class="@yield('map-active')">
        <a href="#"><i class="fa fa-globe"></i> <span
                class="nav-label" >Dashboard</a>
    </li>
        <li class="@yield('administracion-active')">
            <a href="#"><i class="fa fa-list" ></i> <span
                    class="nav-label" >Administracion</span><span
                    class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                    <li class="@yield('tipoempleado-active')"><a href="{{route('tipoempleado.index')}}"><i
                                class="fa fa-building" aria-hidden="true"></i>Tipos de Empleados</a></li>
            </ul>
        </li>
</ul>
