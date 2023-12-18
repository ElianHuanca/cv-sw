<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajos extends Model
{
    use HasFactory;

    protected $table = 'trabajos';
    protected $fillable = ['cargo', 'responsabilidades', 'requisitos', 'salario', 'vacancia', 'fecha', 'fechafin', 'categoria','iduser','idarea', 'idsucursal'];
    public $timestamps = false;

    /* rotected $casts = [
        'responsabilidades' => 'array',
        'requisitos' => 'array',
    ]; */
    /* public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'idempresa');
    } */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
    public function area()
    {
        return $this->belongsTo(Areas::class, 'idarea');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursales::class, 'idsucursal');
    }
    
}
