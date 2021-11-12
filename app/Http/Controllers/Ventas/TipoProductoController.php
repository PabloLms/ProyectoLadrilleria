<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Ventas\TipoProducto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TipoProductoController extends Controller
{
    public function index()
    {
        return view('ventas.tipoProducto.index');
    }
    public function getList()
    {
        return DataTables::of(TipoProducto::where('estado', 'ACTIVO')->get())->toJson();
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            TipoProducto::create($request->all());
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
            TipoProducto::findOrFail($id)->update(
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
            TipoProducto::findOrFail($id)->update([
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
