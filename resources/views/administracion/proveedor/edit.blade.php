@extends('layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('proveedor-active', 'active')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-10">
        <h2 style="text-transform: uppercase">
            <b>Proveedor</b>
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a>Proveedor</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Editar</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-content">
                    {{ $errors }}
                    <h2>Crear Proveedor</h2>
                    <form id="form" action="{{ route('proveedor.update', $proveedor->id) }}" method="POST"
                        class="wizard-big" enctype="multipart/form-data">
                        @csrf
                        <h1>Datos Personales</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Tipo de Documento</label>
                                            {{-- <select id="tipo_documento" name="tipo_documento"
                                                class="select2_form form-control" readonly>
                                                <option value="DNI"
                                                    {{ $proveedor->persona->tipo_documento == 'DNI' ? 'selected' : '' }}>
                                                    Dni
                                                </option>
                                                <option value="RUC"
                                                    {{ $proveedor->persona->tipo_documento == 'RUC' ? 'selected' : '' }}>
                                                    Ruc
                                                </option>
                                            </select> --}}
                                            <input type="text" class="form-control" id="tipo_documento"
                                                name="tipo_documento" readonly
                                                value="{{ $proveedor->persona->tipo_documento }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Numero de Documento</label>
                                            <input type="text" name="numero_documento" id="numero_documento"
                                                value="{{ old('numero_documento', $proveedor->persona->personaDni ? $proveedor->persona->personaDni->dni : $proveedor->persona->personaRuc->ruc) }}"
                                                class="form-control {{ $errors->has('numero_documento') ? 'is-invalid' : '' }}" />
                                            @if ($errors->has('numero_documento'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('numero_documento') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row div-dni">
                                        <div class="col-md-6">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" id="nombres"
                                                class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}"
                                                value="{{ old('nombres', $proveedor->persona->personaDni ? $proveedor->persona->personaDni->nombres : '') }}" />
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
                                                value="{{ old('apellidos', $proveedor->persona->personaDni ? $proveedor->persona->personaDni->apellidos : '') }}" />
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
                                                class="form-control {{ $errors->has('nombre_comercial') ? 'is-invalid' : '' }}"
                                                value="{{ old('nombre_comercial', $proveedor->persona->personaDni ? '' : $proveedor->persona->personaRuc->nombre_comercial) }}" />
                                            @if ($errors->has('nombre_comercial'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nombre_comercial') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Razon Social</label>
                                            <input type="text" name="razon_social" id="razon_social"
                                                value="{{ old('razon_social', $proveedor->persona->personaDni ? '' : $proveedor->persona->personaRuc->nombre_comercial) }}"
                                                class="form-control {{ $errors->has('razo_social') ? 'is-invalid' : '' }}" />
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
                                                class="form-control {{ $errors->has('departamento') ? 'is-invalid' : '' }} select2_form">
                                                @foreach (getDepartamentos() as $departamento)
                                                    <option value="{{ $departamento->id }}"
                                                        {{ $proveedor->persona->distrito->provincia->departamento->id == $departamento->id ? 'selected' : '' }}>
                                                        {{ $departamento->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Provincia</label>
                                            <select name="provincia" id="provincia"
                                                class="form-control {{ $errors->has('provincia') ? 'is-invalid' : '' }} select2_form">
                                                @foreach ($proveedor->persona->distrito->provincia->departamento->provincias as $provincia)
                                                    <option value="{{ $provincia->id }}"
                                                        {{ $proveedor->persona->distrito->provincia->id == $provincia->id ? 'selected' : '' }}>
                                                        {{ $provincia->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Distrito</label>
                                            <select name="distrito" id="distrito"
                                                class="form-control {{ $errors->has('distrito') ? 'is-invalid' : '' }} select2_form">
                                                @foreach ($proveedor->persona->distrito->provincia->distritos as $distrito)
                                                    <option value="{{ $distrito->id }}"
                                                        {{ $proveedor->persona->distrito->id == $distrito->id ? 'selected' : '' }}>
                                                        {{ $distrito->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label for="">Direccion</label>
                                            <input type="text" name="direccion" id="direccion"
                                                class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                                value="{{ old('direccion', $proveedor->persona->direccion) }}" />
                                            @if ($errors->has('direccion'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('direccion') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Telefono</label>
                                            <input type="number" name="telefono" id="telefono"
                                                class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                value="{{ old('telefono', $proveedor->persona->telefono) }}" />
                                            @if ($errors->has('telefono'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Fecha Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                                value="{{ old('fecha_nacimiento', $proveedor->persona->fecha_nacimiento) }}"
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
                                                    form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}
                                                ">
                                                <option value="M"
                                                    {{ $proveedor->persona->genero == 'M' ? 'selected' : '' }}>
                                                    Masculino
                                                </option>
                                                <option value="F"
                                                    {{ $proveedor->persona->genero == 'F' ? 'selected' : '' }}>
                                                    Femenino
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Estado Civil</label>
                                            <select name="estado_civil" id="estado_civil"
                                                class="
                                                    select2_form
                                                    form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}
                                                ">
                                                <option value="Casado"
                                                    {{ $proveedor->persona->estado_civil == 'Casado' ? 'selected' : '' }}>
                                                    Casado(a)
                                                </option>
                                                <option value="Viudo"
                                                    {{ $proveedor->persona->estado_civil == 'Viudo' ? 'selected' : '' }}>
                                                    Viudo(a)
                                                </option>
                                                <option value="Soltero"
                                                    {{ $proveedor->persona->estado_civil == 'Soltero' ? 'selected' : '' }}>
                                                    Soltero(a)
                                                </option>
                                            </select>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/Administracion/Proveedor/edit.js') }}"></script>
@endsection
