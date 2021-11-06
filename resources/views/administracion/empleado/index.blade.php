@extends('layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('empleado-active', 'active')
<div id="app">
    <empleado-index-component>
    </empleado-index-component>
</div>
@endsection
@section('css-vue')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('script-vue')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('css-custom')
@endsection
@section('script-custom')
@endsection
