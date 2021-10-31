<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoEmpleadoController extends Controller
{
    public function index()
    {
        return view('administracion.tipoempleado.index');
    }
    public function store(Request $request)
    {
        try {
            $fa=new fre();


            return array("success"=>true,"mensaje"=>"Registro con Exito");
        }
        catch(Exception $e) {
            return array("success"=>false,"mensaje"=>"Registro con Exito");
        }

    }
    public function update(Request $request){

    }
    public function destroy(){

    }

}
