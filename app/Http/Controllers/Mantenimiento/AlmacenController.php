<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento\Almacen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AlmacenController extends Controller
{
    public function index()
    {
        return view('mantenimiento.almacen.index');
    }
    public function getList()
    {
        return DataTables::of(Almacen::where('estado', 'ACTIVO')->get())->toJson();
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Almacen::create($request->all());
            DB::commit();
            return array("success" => true, "mensaje" => "Registro con Exito");
        } catch (Exception $e) {
            DB::rollBack();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            Almacen::findOrFail($id)->update(
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
            Almacen::findOrFail($id)->update([
                "estado" => "ANULADO"
            ]);
            DB::commit();
            return array("success" => true, "mensaje" => "Eliminado con Exito");
        } catch (Exception $e) {
            DB::rollBack();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
}
