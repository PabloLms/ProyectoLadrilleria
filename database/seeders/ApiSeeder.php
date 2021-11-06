<?php

namespace Database\Seeders;

use App\Models\Apis;
use Illuminate\Database\Seeder;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Apis::create([
            "http"=>"https://apiperu.dev/api/dni/",
            "token" =>"2c5644b9cec147b1d85fcfd087e90a1ded15a5d86c6723214c8613db3e54c37e",
            "descripcion" =>"dni"
        ]);
        Apis::create([
            "http"=>"https://apiperu.dev/api/ruc/",
            "token" =>"2c5644b9cec147b1d85fcfd087e90a1ded15a5d86c6723214c8613db3e54c37e",
            "descripcion" =>"ruc"
        ]);
    }
}
