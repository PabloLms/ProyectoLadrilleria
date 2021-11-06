<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\TipoEmpleado;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TipoEmpleadoController extends Controller
{
    public function index()
    {
        return view('administracion.tipoempleado.index');
    }
    public function getList()
    {
        return DataTables::of(TipoEmpleado::where('estado', 'ACTIVO')->get())->toJson();
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            TipoEmpleado::create($request->all());
            DB::commit();
            return array("success" => true, "mensaje" => "Registro con Exito");
        } catch (Exception $e) {
            Log::info($e->getMessage());
            DB::rollBack();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            TipoEmpleado::findOrFail($id)->update(
                $request->all()
            );
            DB::commit();
            return array("success" => true, "mensaje" => "Actualizado con Exito");
        } catch (Exception $e) {
            DB::rollBack();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            TipoEmpleado::findOrFail($id)->update([
                "estado" => "ANULADO"
            ]);
            DB::commit();
            return array("success" => true, "mensaje" => "Eliminado con Exito");
        } catch (Exception $e) {
            DB::rollBack();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
    public function verify()
    {
        return TipoEmpleado::where('estado', 'ACTIVO')->count() == 0
            ? array("success" => false, "mensaje" => "no se ha registrado ningun tipo empleado")
            : array("success" => true, "mensaje" => "Si hay registro de tipo empleado");
    }
}
