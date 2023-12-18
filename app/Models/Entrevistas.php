<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevistas extends Model
{
    use HasFactory;
    protected $table = 'entrevistas';
    protected $fillable = ['fecha', 'hora', 'resultado','estado','iduser','idpostulacion'];

    public $timestamps = false;

    public function postulacion()
    {
        return $this->belongsTo(Postulaciones::class, 'idpostulacion');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
    
}
