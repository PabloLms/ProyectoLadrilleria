<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;
    protected $table="tipo_producto";
    protected $fillable=[
        'tipo',
        'estado'
    ];
    public $timestamps=true;
}
