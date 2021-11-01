<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'persona';
    protected $fillable=[
        'tipo_documento',
        'direccion',
        'telefono',
        'fecha_nacimiento',
        'genero',
        'estado_civil',
        'estado'
    ];
    public $timestamps = true;
    public function personaDni()
    {
        return $this->hasOne(PersonaDni::class,'persona_id');
    }
    public function personaRuc()
    {
        return $this->hasOne(PersonaRuc::class,'persona_id');
    }
}
