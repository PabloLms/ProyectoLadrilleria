<?php

namespace App\Models\Ubigeo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $table="departamento";
    protected $fillable=[
        "nombre",
        "ubiego"
    ];
    public $timestamps = true;
    public function provincias(){
        return $this->hasMany(Provincia::class,'departamento_id');
    }
}
