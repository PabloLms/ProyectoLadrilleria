<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEmpleado extends Model
{
    use HasFactory;
    protected $table="tipo_empleado";
    protected $fillable=[
        'tipo',
        'descripcion',
        'estado'
    ];
    public $timestamps = true;
    public function empleados(){
        return $this->hasMany(Empleado::class,'tipo_id');
    }
}
