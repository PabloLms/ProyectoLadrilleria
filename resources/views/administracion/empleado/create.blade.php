@extends('layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('empleado-active', 'active')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-10">
        <h2 style="text-transform: uppercase">
            <b>Empleado</b>
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a>Empleado</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Create</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-content">
                    <h2>Crear Empleado</h2>
                    <form id="form" action="{{route('empleado.store')}}" method="POST" class="wizard-big" enctype="multipart/form-data">
                        @csrf
                        <h1>Datos Personales</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Tipo de Documento</label>
                                            <select id="tipo_documento" name="tipo_documento"
                                                class="select2_form form-control">
                                                <option value="DNI">
                                                    Dni
                                                </option>
                                                <option value="RUC">
                                                    Ruc
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Numero de Documento</label>
                                            <input type="text" name="numero_documento" id="numero_documento"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row div-dni">
                                        <div class="col-md-6">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" id="nombres" class="form-control" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Apellidos</label>
                                            <input type="text" name="apellidos" id="apellidos" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row div-ruc">
                                        <div class="col-md-12">
                                            <label for="">Nombre Comercial</label>
                                            <input type="text" name="nombre_comercial" id="nombre_comercial"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Razon Social</label>
                                            <input type="text" name="razon_social" id="razon_social"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Direccion</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control" />
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Telefono</label>
                                            <input type="number" name="telefono" id="telefono" class="form-control" />
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Fecha Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Genero</label>
                                            <select name="genero" id="genero"
                                                class="
                                                    select2_form
                                                    form-control
                                                ">
                                                <option value="M">
                                                    Masculino
                                                </option>
                                                <option value="F">
                                                    Femenino
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Estado Civil</label>
                                            <select name="estado_civil" id="estado_civil"
                                                class="
                                                    select2_form
                                                    form-control
                                                ">
                                                <option value="Casado">
                                                    Casado
                                                </option>
                                                <option value="Viudo">
                                                    Viudo
                                                </option>
                                                <option value="Soltero">
                                                    Soltero
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <h1>Datos de Usuario</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Email</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Confirm Password</label>
                                            <input type="password" name="confirm_password" id="confirm_password"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Tipo de Empleado</label>
                                            <select name="tipo" id="tipo" class="form-control select2_form">
                                                @foreach ($tiposEmpleado as $tipo)
                                                    <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <div>
                                                <label id="logo_label">Logo:</label>
                                                <div class="custom-file">
                                                    <input id="logo" type="file" name="logo"
                                                        onchange="seleccionarimagen()" class="custom-file-input"
                                                        accept="image/*">
                                                    <label for="logo" id="logo_txt" name="logo_txt"
                                                        class="custom-file-label selected"> Seleccionar</label>
                                                    <div class="invalid-feedback"><b><span
                                                                id="error-logo_mensaje"></span></b></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="row  justify-content-end">
                                                <a href="javascript:void(0);" id="limpiar_logo" onclick="limpiar()">
                                                    <span class="badge badge-danger">x</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-7">
                                            <p>
                                                <img class="logo" style="width: 100%;"
                                                    src="{{ asset('default.jpg') }}" alt="">
                                                <input id="url_logo" name="url_logo" type="hidden" value="">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('css-custom')
<link href="{{ asset('Inspinia/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('Inspinia/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
<style>

</style>
@endsection
@section('script-custom')
<script src="{{ asset('Inspinia/js/plugins/steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/select2/select2.full.min.js') }}"></script>

<script src="{{ asset('js/Administracion/Empleado/create.js') }}"></script>
@endsection