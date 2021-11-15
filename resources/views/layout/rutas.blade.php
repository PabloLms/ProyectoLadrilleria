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
        <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Dashboard</a>
    </li>
    <li class="@yield('administracion-active')">
        <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Administracion</span><span
                class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('tipoempleado-active')"><a href="{{ route('tipoempleado.index') }}"><i
                        class="fa fa-building" aria-hidden="true"></i>Tipos de Empleados</a></li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('empleado-active')"><a href="{{ route('empleado.index') }}"><i class="fa fa-users"
                        aria-hidden="true"></i>Empleados</a></li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('proveedor-active')"><a href="{{ route('proveedor.index') }}"><i class="fa fa-users"
                        aria-hidden="true"></i>Proveedores</a></li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('cliente-active')"><a href="{{ route('cliente.index') }}"><i class="fa fa-users"
                        aria-hidden="true"></i>Clientes</a></li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('api-active')"><a href="{{ route('api.index') }}"><i class="fa fa-paper-plane"
                        aria-hidden="true"></i>Apis</a></li>
        </ul>
    </li>
    <li class="@yield('compra-active')">
        <a href="#"><i class="fa fa-cart-plus"></i> <span class="nav-label">Compras</span><span
                class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('insumo-active')"><a href="#"><i class="fa fa-book" aria-hidden="true"></i>Insumos</a>
            </li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('docCompra-active')"><a href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i>Doc
                    Compra</a></li>
        </ul>
    </li>
    <li class="@yield('ventas-active')">
        <a href="#"><i class="fa fa-cart-plus"></i> <span class="nav-label">Ventas</span><span
                class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('tipoProducto-active')"><a href="{{ route('tipoProducto.index') }}"><i class="fa fa-book" aria-hidden="true"></i>Tipos
                    de Productos</a></li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('producto-active')"><a href="{{route('producto.index')}}"><i class="fa fa-cart-plus"
                        aria-hidden="true"></i>Productos</a></li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('docVenta-active')"><a href="#"><i class="fa fa-book" aria-hidden="true"></i>Doc
                    Ventas</a></li>
        </ul>
    </li>
    <li class="@yield('mantenimiento-active')">
        <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Mantenimiento</span><span
                class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('empresa-active')"><a href="{{ route('EmpresaPersonal.index') }}"><i
                        class="fa fa-building" aria-hidden="true"></i>Datos de
                    la Empresa</a></li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('unidadMedida-active')"><a href="{{ route('unidadMedida.index') }}"><i
                        class="fa fa-building" aria-hidden="true"></i>Unidad de Medida</a></li>
        </ul>
        <ul class="nav nav-second-level collapse">
            <li class="@yield('almacen-active')"><a href="{{route('almacen.index')}}"><i class="fa fa-archive"
                        aria-hidden="true"></i>Almacen</a></li>
        </ul>
    </li>
</ul>
