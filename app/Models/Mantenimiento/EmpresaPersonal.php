<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaPersonal extends Model
{
    use HasFactory;
    protected $table="empresa";
    protected $fillable=[
        'ruc',
        'razon_social',
        'nombre_comercial',
        'direccion',
        'direccion_fiscal',
        'nombre_imagen',
        'url_imagen',
        'telefono',
        'correo'
    ];
    public $timestamps=true;
}
