<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulaciones extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'postulaciones';
    protected $fillable = ['estado','motivo', 'idtrabajo', 'iduser'];
    public function trabajo()
    {
        return $this->belongsTo(Trabajos::class, 'idtrabajo');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
