<?php

namespace App\Models\Ubigeo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    protected $table="provincia";
    protected $fillable=[
        "departamento_id",
        "nombre",
        "ubiego"
    ];
    public $timestamps = true;
    public function distritos(){
        return $this->hasMany(Distrito::class,'provincia_id');
    }
    public function departamento(){
        return $this->belongsTo(Departamento::class,'departamento_id');
    }
}
