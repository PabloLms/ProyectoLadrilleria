@extends('layout.index')
@section('contenido')
@section('ventas-active', 'active')
@section('producto-active', 'active')
<div id="app">
    <productoindex-component >
    </productoindex-component>
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
