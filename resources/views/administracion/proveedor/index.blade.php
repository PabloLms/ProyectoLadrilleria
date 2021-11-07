@extends('layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('proveedor-active', 'active')
<div id="app">
    <proveedor-index-component>
    </proveedor-index-component>
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
