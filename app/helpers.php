<?php

use App\Models\Ubigeo\Departamento;
use App\Models\Ubigeo\Distrito;
use App\Models\Ubigeo\Provincia;

if (!function_exists('getDepartamentos')) {
    function getDepartamentos()
    {
        return Departamento::get();
    }
}
if (!function_exists('getProvincias')) {
    function getProvincias()
    {
        return Provincia::get();
    }
}
if (!function_exists('getDistritos')) {
    function getDistritos()
    {
        return Distrito::get();
    }
}
