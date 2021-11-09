<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $table="almacen";
    protected $fillable=[
        'nombre',
        'descripcion',
        'estado'
    ];
    public $timestamps=true;
}
