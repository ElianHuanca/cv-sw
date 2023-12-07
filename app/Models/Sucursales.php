<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    use HasFactory;

    protected $table = 'sucursales';
    protected $fillable = ['direccion','ciudad','latitud','longitud', 'idempresa'];
    public $timestamps = false;
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idempresa');
    }
}
