<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = "proveedor";
    protected $fillable = [
        'persona_id',
        'url_imagen',
        'nombre_imagen'
    ];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
