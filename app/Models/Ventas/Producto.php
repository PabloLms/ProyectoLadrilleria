<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table="producto";
    protected $fillable=[
        'tipo_producto_id',
        'precio_venta',
        'stock',
        'nombre',
        'nombre_imagen',
        'url_imagen',
        'estado'
    ];
    public $timestamps = true;
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class,'tipo_producto_id');
    }
}
