<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Ventas\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ProductoController extends Controller
{
    public function index()
    {
        return view('ventas.producto.index');
    }
    public function getList()
    {
        return Producto::where('estado', 'ACTIVO')->with(['tipoProducto'])->get();
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Log::info($request);
            $datos = $request->except(['imagen']);
            if ($request->hasFile('imagen')) {
                $datos['url_imagen'] = $request->file('imagen')->store('public/Producto');
                $datos['nombre_imagen'] = $request->file('imagen')->getClientOriginalName();
            }
            Log::info($datos);
            Producto::create($datos);
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
            $datos = $request->except(['imagen']);
            if ($request->hasFile('imagen')) {
                $datos['url_imagen'] = $request->file('imagen')->store('public/Producto');
                $datos['nombre_imagen'] = $request->file('imagen')->getClientOriginalName();
            }
            Producto::findOrFail($id)->update(
                $datos
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
            Producto::findOrFail($id)->update([
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
