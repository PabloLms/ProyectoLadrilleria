@extends('layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('tipoempleado-active', 'active')
<div id="app">
    <tipoempleadoindex-component
        datatable="{{ asset('Inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}">

    </tipoempleadoindex-component>
</div>
@endsection
@section('css-vue')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('script-vue')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('css-custom')
{{-- <link href="{{ asset('Inspinia/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('Inspinia/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"> --}}
@endsection
@section('script-custom')
{{-- <script src="{{ asset('Inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script> --}}
@endsection
