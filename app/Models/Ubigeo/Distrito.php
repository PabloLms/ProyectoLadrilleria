<?php

namespace App\Models\Ubigeo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;
    protected $table="distrito";
    protected $fillable=[
        "provincia_id",
        "nombre",
        "ubiego"
    ];
    public $timestamps = true;
    public function provincia()
    {
        return $this->belongsTo(Provincia::class,'provincia_id');
    }
}
