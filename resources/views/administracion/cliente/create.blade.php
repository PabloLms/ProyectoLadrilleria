@extends('layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('cliente-active', 'active')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-10">
        <h2 style="text-transform: uppercase">
            <b>Cliente</b>
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a>Cliente</a>
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
            <div class="ibox" id="ibox1">
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <h2>Crear Cliente</h2>
                    <form id="form" action="{{ route('cliente.store') }}" method="POST" class="wizard-big"
                        enctype="multipart/form-data">
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
                                                <option value="DNI"
                                                    {{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI
                                                </option>
                                                <option value="RUC"
                                                    {{ old('tipo_documento') == 'RUC' ? 'selected' : '' }}>RUC
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Numero de Documento</label>
                                            <div class="input-group">
                                                <input type="text" name="numero_documento" id="numero_documento"
                                                    value="{{ old('numero_documento') }}"
                                                    class="form-control {{ $errors->has('numero_documento') ? 'is-invalid' : '' }}" />
                                                <span class="input-group-append"><a style="color:white" href="#"
                                                        id="consultarDocumento" class="btn btn-primary"><i
                                                            class="fa fa-search"></i>
                                                        <span></span></a></span>
                                                @if ($errors->has('numero_documento'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('numero_documento') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row div-dni">
                                        <div class="col-md-6">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" id="nombres"
                                                class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}"
                                                value="{{ old('nombres') }}" />
                                            @if ($errors->has('nombres'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nombres') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Apellidos</label>
                                            <input type="text" name="apellidos" id="apellidos"
                                                class="form-control {{ $errors->has('apellidos') ? 'is-invalid' : '' }}"
                                                value="{{ old('apellidos') }}" />
                                            @if ($errors->has('apellidos'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row div-ruc">
                                        <div class="col-md-12">
                                            <label for="">Nombre Comercial</label>
                                            <input type="text" name="nombre_comercial" id="nombre_comercial"
                                                value="{{ old('nombre_comercial') }}"
                                                class="form-control {{ $errors->has('nombre_comercial') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('nombre_comercial'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nombre_comercial') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Razon Social</label>
                                            <input type="text" name="razon_social" id="razon_social"
                                                value="{{ old('razon_social') }}"
                                                class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('razon_social'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('razon_social') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>Departamento</label>
                                            <select name="departamento" id="departamento"
                                                class="form-control select2_form">
                                                @foreach (getDepartamentos() as $departamento)
                                                    <option value="{{ $departamento->id }}">
                                                        {{ $departamento->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Provincia</label>
                                            <select name="provincia" id="provincia" class="form-control select2_form">

                                                {{-- @foreach (getProvincias() as $provincia)
                                                    <option value="{{ $provincia->id }}">{{ $provincia->nombre }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Distrito</label>
                                            <select name="distrito" id="distrito" class="form-control select2_form">
                                                {{-- @foreach (getDistritos() as $distrito)
                                                    <option value="{{ $distrito->id }}">{{ $distrito->nombre }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Direccion</label>
                                            <input type="text" name="direccion" id="direccion"
                                                value="{{ old('direccion') }}"
                                                class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('direccion'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Telefono</label>
                                            <input type="number" name="telefono" id="telefono"
                                                value="{{ old('telefono') }}"
                                                class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('telefono'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Fecha Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                                value="{{ old('fecha_nacimiento') }}"
                                                class="form-control {{ $errors->has('fecha_nacimiento') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('fecha_nacimiento'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Genero</label>
                                            <select name="genero" id="genero"
                                                class="
                                                    select2_form
                                                    form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}">
                                                <option value="M">
                                                    Masculino
                                                </option>
                                                <option value="F">
                                                    Femenino
                                                </option>
                                            </select>
                                            @if ($errors->has('genero'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('genero') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Estado Civil</label>
                                            <select name="estado_civil" id="estado_civil"
                                                class="
                                                    select2_form
                                                    form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}">
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
                                            @if ($errors->has('estado_civil'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('estado_civil') }}</strong>
                                                </span>
                                            @endif
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
    .swal-icon--custom {
        width: 250px;
        height: auto;
    }

</style>
@endsection
@section('script-custom')
<script src="{{ asset('Inspinia/js/plugins/steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/select2/select2.full.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/Administracion/Cliente/create.js') }}"></script>
@endsection
