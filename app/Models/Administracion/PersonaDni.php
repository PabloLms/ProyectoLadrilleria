<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaDni extends Model
{
    use HasFactory;
    protected $table="persona_dni";
    protected $fillable=[
        "persona_id",
        "nombres",
        "apellidos",
        "dni"
    ];
    public $timestamps=true;
    public function persona()
    {
        return $this->belongsTo(Persona::class,"persona_id");
    }
    public function nombres_apellidos(){
        return $this->nombres." ".$this->apellidos;
    }
}
