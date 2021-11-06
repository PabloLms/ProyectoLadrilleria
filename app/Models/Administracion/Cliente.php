<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "cliente";
    protected $fillable = [
        'persona_id',
    ];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
