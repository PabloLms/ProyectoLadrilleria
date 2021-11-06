<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apis extends Model
{
    use HasFactory;
    protected $table="apis";
    protected $fillable=[
        'http',
        'token',
        'descripcion'
    ];
    public $timestamps = true;
}
