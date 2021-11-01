<?php

namespace App\Models\Administracion;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'empleado';
    protected $fillable=[
        'tipo_id',
        'persona_id',
        'user_id',
        'url_imagen',
        'nombre_imagen'
    ];
    public $timestamps = true;
    public function tipo(){
        return $this->belongsTo(TipoEmpleado::class,'tipo_id');
    }
    public function persona(){
        return $this->belongsTo(Persona::class,'persona_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
