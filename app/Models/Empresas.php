<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;
    protected $table = 'empresas';
    protected $fillable = ['razon', 'tipo'];
    public $timestamps = false;
    public function sucursales()
    {
        return $this->hasMany(Sucursales::class, 'idempresa');
    }

    public function trabajos()
    {
        return $this->hasMany(Trabajos::class, 'idempresa');
    }
}
