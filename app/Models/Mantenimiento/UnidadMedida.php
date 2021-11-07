<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;
    protected $table="unidad_medida";
    protected $fillable=[
        'simbolo',
        'descripcion',
        'estado'
    ];

}
