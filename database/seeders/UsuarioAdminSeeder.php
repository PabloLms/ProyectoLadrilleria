<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuarioAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User();
        $usuario->name="admin";
        $usuario->email="admin@ladrilleria.com";
        $usuario->password=bcrypt('123456789');
        $usuario->save();
    }
}
