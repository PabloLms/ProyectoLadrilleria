<?php

namespace Database\Seeders;

use App\Models\Ubigeo\Departamento;
use App\Models\Ubigeo\Distrito;
use App\Models\Ubigeo\Provincia;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = database_path("data/ubigeo/ubigeo.json");
        $json = file_get_contents($file);
        $data = json_decode($json);
        foreach ($data as $obj) {
            if ($obj->Provincia == "" && $obj->Distrito == "") {
                Departamento::create([
                    "nombre" => $obj->Departamento,
                    "ubigeo" => $obj->IdUbigeo
                ]);
            } elseif ($obj->Distrito == "") {
                $departamento = Departamento::where('nombre', $obj->Departamento)->first();
                Provincia::create(
                    [
                        "departamento_id" => $departamento->id,
                        "nombre" => $obj->Provincia,
                        "ubigeo" => $obj->IdUbigeo
                    ]
                );
            } else {
                $provincia = Provincia::where('nombre', $obj->Provincia)->first();
                Distrito::create(
                    [
                        "provincia_id" => $provincia->id,
                        "nombre" => $obj->Distrito,
                        "ubigeo" => $obj->IdUbigeo
                    ]
                );
            }
        }
    }
}
