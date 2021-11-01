<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Empleado;
use App\Models\Administracion\Persona;
use App\Models\Administracion\PersonaDni;
use App\Models\Administracion\PersonaRuc;
use App\Models\Administracion\TipoEmpleado;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class EmpleadoController extends Controller
{
    public function index()
    {
        return view('administracion.empleado.index');
    }
    public function getList()
    {
        $empleados = Empleado::get()->map(function ($empleado) {
            return array(
                "id" => $empleado->id,
                "nombre" => $empleado->persona->personaDni ? $empleado->persona->personaDni->nombres_apellidos() : $empleado->persona->personaRuc->nombre_comercial,
                "documento" => $empleado->persona->personaDni ? $empleado->persona->personaDni->dni : $empleado->persona->personaRuc->ruc,
                "direccion" => $empleado->persona->direccion,
                "telefono" => $empleado->persona->telefono,
            );
        });
        return DataTables::of($empleados)->toJson();
    }
    public function create()
    {
        $tiposEmpleado = TipoEmpleado::where('estado', 'ACTIVO')->get();
        return view('administracion.empleado.create', ["tiposEmpleado" => $tiposEmpleado]);
    }
    public function store(Request $request)
    {
        Log::info($request);
        $data = $request->all();

        $rules = [
            'telefono' =>[ 'required','numeric'],
            'direccion' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' =>'required',
            'edad' => ['required','numeric'],
            'estado_civil' => 'required',
            'email' => ['required','email:rfc,dns',Rule::unique('users','email')->where(function ($query) {
            })],
            'password' => ['required','same:confirm_password'],
            'confirm_password' => 'required',
        ];
        $message = [
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',
            'fecha_nacimiento.required' => 'El Campo Fecha es Obligatorio',
            'estado_civil.required' => 'El Campo estado Civil es Obligatorio',
            'email.required' => 'El Campo email es Obligatorio',
            'email.unique' => 'El Campo email ya esta registrado',
            'email.email' => 'formato no valido',
            'genero.required' =>'El Campo genero es Obligatorio',
            'password.required' => 'El Campo password es Obligatorio',
            'password.same' => 'No coinciden los campos de contraseña',
            'confirm_password.required' => 'El Campo password es Obligatorio',


        ];

        Validator::make($data, $rules, $message)->validate();
        try {
            DB::commit();
            $persona = new Persona();
            $persona->tipo_documento = $request->tipo_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->genero = $request->genero;
            $persona->estado_civil = $request->estado_civil;
            $persona->save();
            if ($request->tipo_documento == "DNI") {
                $persona_dni = new PersonaDni();
                $persona_dni->nombres = $request->nombres;
                $persona_dni->apellidos = $request->apellidos;
                $persona_dni->persona_id = $persona->id;
                $persona_dni->dni = $request->numero_documento;
                $persona_dni->save();
            } else {
                $persona_ruc = new PersonaRuc();
                $persona_ruc->nombre_comercial = $request->nombre_comercial;
                $persona_ruc->razon_social = $request->razon_social;
                $persona_ruc->ruc = $request->numero_documento;
                $persona_ruc->save();
            }
            $usuario = new User();
            $usuario->name = $request->email;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->save();
            $empleado = new Empleado();
            $empleado->tipo_id = $request->tipo;
            $empleado->persona_id = $persona->id;
            $empleado->user_id = $usuario->id;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $name = $file->getClientOriginalName();
                $empleado->nombre_imagen = $name;
                $empleado->url_imagen = $request->file('logo')->store('public/empleados');
            }
            $empleado->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
        }
        return redirect()->route('empleado.index');
    }
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $tiposEmpleado = TipoEmpleado::where('estado', 'ACTIVO')->get();
        return view('administracion.empleado.edit', ["empleado" => $empleado, "tiposEmpleado" => $tiposEmpleado]);
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Empleado::findOrFail($id)->update([
                "estado" => "ANULADO"
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
}
