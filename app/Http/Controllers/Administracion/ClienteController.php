<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Cliente;
use App\Models\Administracion\Persona;
use App\Models\Administracion\PersonaDni;
use App\Models\Administracion\PersonaRuc;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    public function index()
    {
        return view('administracion.cliente.index');
    }
    public function getList()
    {
        $clientes = DB::table('cliente as e')
            ->join('persona as p', 'p.id', '=', 'e.persona_id')
            ->select('e.id')
            ->where('p.estado', 'ACTIVO')->get()->map(function ($value) {
                $cliente=Cliente::findOrFail($value->id);
                return array(
                    "id" => $cliente->id,
                    "nombre" => $cliente->persona->personaDni ? $cliente->persona->personaDni->nombres_apellidos() : $cliente->persona->personaRuc->nombre_comercial,
                    "documento" => $cliente->persona->personaDni ? $cliente->persona->personaDni->dni : $cliente->persona->personaRuc->ruc,
                    "direccion" => $cliente->persona->direccion,
                    "telefono" => $cliente->persona->telefono,
                );
            });
        return DataTables::of($clientes)->toJson();
    }
    public function create()
    {
        return view('administracion.cliente.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'telefono' => ['required', 'numeric'],
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'direccion' => 'required',
            'fecha_nacimiento' => 'required',
            // 'numero_documento' => 'required',
            'genero' => 'required',
            'estado_civil' => 'required',
            // 'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->where(function ($query) {
            // })],
            // 'password' => ['required', 'same:confirm_password'],
            // 'confirm_password' => 'required',
        ];
        $message = [
            'departamento.required' => 'El Campo departamento es Obligatorio',
            'provincia.required' => 'El Campo provincia es Obligatorio',
            'distrito.required' => 'El Campo distrito es Obligatorio',
            // 'numero_documento.required' => 'El Campo numero_documento es Obligatorio',
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',
            'fecha_nacimiento.required' => 'El Campo Fecha es Obligatorio',
            'estado_civil.required' => 'El Campo estado Civil es Obligatorio',
            // 'email.required' => 'El Campo email es Obligatorio',
            // 'email.unique' => 'El Campo email ya esta registrado',
            // 'email.email' => 'formato no valido',
            'genero.required' => 'El Campo genero es Obligatorio',
            // 'password.required' => 'El Campo password es Obligatorio',
            // 'password.same' => 'No coinciden los campos de contraseña',
            // 'confirm_password.required' => 'El Campo password es Obligatorio',
        ];
        if ($request->tipo_documento == "DNI") {
            $rules += array("nombres" => "required");
            $rules += array("apellidos" => "required");
            $rules += array("numero_documento" => ['required','unique:persona_dni,dni']);

            $message += array("nombres.required" => "El Campo nombre es Obligatorio");
            $message += array("apellidos.required" => "El Campo Apellidos es Obligatorio");
            $message += array('numero_documento.required' => 'El Campo numero_documento es Obligatorio');
            $message += array("numero_documento.unique"=>"El numero documento ya esta registrado");
        } else {
            $rules += array("nombre_comercial" => "required");
            $rules += array("razon_social" => "required");
            $rules += array("numero_documento" => ['required','unique:persona_ruc,ruc']);

            $message += array("nombre_comercial.required" => "El Campo nombre comercial es Obligatorio");
            $message += array("razon_social.required" => "El Campo razon social es Obligatorio");
            $message += array('numero_documento.required' => 'El Campo numero_documento es Obligatorio');
            $message += array("numero_documento.unique"=>"El numero documento ya esta registrado");
        }

        Validator::make($data, $rules, $message)->validate();
        DB::beginTransaction();
        try {
            $persona = new Persona();
            $persona->tipo_documento = $request->tipo_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->genero = $request->genero;
            $persona->estado_civil = $request->estado_civil;
            $persona->distrito_id = $request->distrito;
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
                $persona_ruc->persona_id = $persona->id;
                $persona_ruc->save();
            }
            $cliente = new Cliente();
            $cliente->persona_id = $persona->id;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $name = $file->getClientOriginalName();
                $cliente->nombre_imagen = $name;
                $cliente->url_imagen = $request->file('logo')->store('public/clientes');
            }
            $cliente->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
        }
        return redirect()->route('cliente.index');
    }
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('administracion.cliente.edit', ["cliente" => $cliente]);
    }
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $data = $request->all();
        $rules = [
            'telefono' => ['required', 'numeric'],
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'direccion' => 'required',
            'fecha_nacimiento' => 'required',
            // 'numero_documento' => 'required',
            'genero' => 'required',
            'estado_civil' => 'required',
            // 'email' => ['required', 'email:rfc,dns'],
            // 'password' => ['same:confirm_password'],
            // 'confirm_password' => 'required',
        ];
        $message = [
            'departamento.required' => 'El Campo departamento es Obligatorio',
            'provincia.required' => 'El Campo provincia es Obligatorio',
            'distrito.required' => 'El Campo distrito es Obligatorio',
            // 'numero_documento.required' => 'El Campo numero_documento es Obligatorio',
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',
            'fecha_nacimiento.required' => 'El Campo Fecha es Obligatorio',
            'estado_civil.required' => 'El Campo estado Civil es Obligatorio',
            // 'email.required' => 'El Campo email es Obligatorio',
            // 'email.unique' => 'El Campo email ya esta registrado',
            // 'email.email' => 'formato no valido',
            'genero.required' => 'El Campo genero es Obligatorio',
            // 'password.required' => 'El Campo password es Obligatorio',
            // 'password.same' => 'No coinciden los campos de contraseña',
            // 'confirm_password.required' => 'El Campo password es Obligatorio',
        ];
        if ($request->tipo_documento == "DNI") {
            $rules += array("nombres" => "required");
            $rules += array("apellidos" => "required");
            $rules += array("numero_documento" => ['required',Rule::unique('persona_dni', 'dni')->ignore($cliente->persona->personaDni->id)]);


            $message += array("nombres.required" => "El Campo nombre es Obligatorio");
            $message += array("apellidos.required" => "El Campo Apellidos es Obligatorio");
            $message += array('numero_documento.required' => 'El Campo numero_documento es Obligatorio');
            $message += array("numero_documento.unique"=>"El numero documento ya esta registrado");
        } else {
            $rules += array("nombre_comercial" => "required");
            $rules += array("razon_social" => "required");
            $rules += array("numero_documento" => ['required',Rule::unique('persona_ruc', 'ruc')->ignore($cliente->persona->personaRuc->id)]);

            $message += array("nombre_comercial.required" => "El Campo nombre comercial es Obligatorio");
            $message += array("razon_social.required" => "El Campo razon social es Obligatorio");
            $message += array('numero_documento.required' => 'El Campo numero_documento es Obligatorio');
            $message += array("numero_documento.unique"=>"El numero documento ya esta registrado");
        }
        Validator::make($data, $rules, $message)->validate();
        DB::beginTransaction();
        try {
            $persona = $cliente->persona;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->genero = $request->genero;
            $persona->estado_civil = $request->estado_civil;
            $persona->distrito_id = $request->distrito;
            $persona->save();
            if ($request->tipo_documento == "DNI") {
                $persona_dni = $persona->personaDni;
                $persona_dni->nombres = $request->nombres;
                $persona_dni->apellidos = $request->apellidos;
                $persona_dni->dni = $request->numero_documento;
                $persona_dni->save();
            } else {
                $persona_ruc = $persona->personaRuc;
                $persona_ruc->nombre_comercial = $request->nombre_comercial;
                $persona_ruc->razon_social = $request->razon_social;
                $persona_ruc->ruc = $request->numero_documento;
                $persona_ruc->save();
            }
            if ($request->get('password')) {
                $usuario = $cliente->user;
                $usuario->password = bcrypt($request->password);
                $usuario->save();
            }
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $name = $file->getClientOriginalName();
                $cliente->nombre_imagen = $name;
                $cliente->url_imagen = $request->file('logo')->store('public/clientes');
                $cliente->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
        }
        return redirect()->route('cliente.index');
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Cliente::findOrFail($id)->persona->update([
                "estado" => "ANULADO"
            ]);
            DB::commit();
            return array("success" => true, "mensaje" => "Exito");
        } catch (Exception $e) {
            DB::rollback();
            return array("success" => false, "mensaje" => $e->getMessage());
        }
    }
}
