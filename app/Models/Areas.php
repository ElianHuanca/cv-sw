<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $fillable = ['nombre'];
    public $timestamps = false;

    public function trabajos()
    {
        return $this->hasMany(Trabajos::class, 'idempresa');
    }
}
