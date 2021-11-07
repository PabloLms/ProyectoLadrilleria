@extends('layout.index')
@section('contenido')
@section('mantenimiento-active', 'active')
@section('empresaPersonal-active', 'active')
<div id="app">
    <empresapersonalindex-component></empresapersonalindex-component>
</div>
@endsection
@section('css-vue')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('script-vue')
<script src="{{ asset('js/app.js?v=' . rand()) }}"></script>
@endsection
@section('css')

@endsection
@section('script')

@endsection
