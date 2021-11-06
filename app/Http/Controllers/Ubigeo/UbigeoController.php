<?php

namespace App\Http\Controllers\Ubigeo;

use App\Http\Controllers\Controller;
use App\Models\Ubigeo\Departamento;
use App\Models\Ubigeo\Provincia;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    public function getProvincias($departamentoid)
    {
        return Departamento::findOrFail($departamentoid)->provincias;
    }
    public function getDistritos($provinciaid)
    {
        return Provincia::findOrFail($provinciaid)->distritos;
    }
}
