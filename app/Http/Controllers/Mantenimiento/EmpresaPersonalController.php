<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento\EmpresaPersonal;
use App\Models\User;
use Illuminate\Http\Request;

class EmpresaPersonalController extends Controller
{
    public function index()
    {
        return view('mantenimiento.empresaPersonal.index');
    }
    public function getEmpresaPersonal()
    {
        return EmpresaPersonal::count() == 0 ? array() : EmpresaPersonal::first();
    }
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $url_imagen = $request->file('file')->store('public/EmpresaPersonal');
            $nombre_imagen = $request->file('file')->getClientOriginalName();
            $data['nombre_imagen'] = $nombre_imagen;
            $data['url_imagen'] = $url_imagen;
        }

        unset($data['file']);
        if (EmpresaPersonal::count() == 0) {

            EmpresaPersonal::create($data);
        } else {
            $empresa = EmpresaPersonal::first();
            EmpresaPersonal::findOrFail($empresa->id)->fill($data)->save();
        }
    }
    public function verify(Request $request)
    {
        $mensaje = "Exito";
        if (EmpresaPersonal::count() == 0) {
            $mensaje = "No se Registro EmpresaPersonal";
        } else {
            $empresa = EmpresaPersonal::first();
            if (
                $empresa->nombre_comercial == null ||
                $empresa->url_imagen == null ||
                $empresa->codigo_envio == null ||
                $empresa->correo == null
            ) {
                $mensaje="Registre los datos de la EmpresaPersonal";
            }
            else{
                if(User::where('email', $request->email)->count()!=0){
                    $mensaje="El correo ya se esta usando";
                }
            }
        }
        return $mensaje;
    }
}
