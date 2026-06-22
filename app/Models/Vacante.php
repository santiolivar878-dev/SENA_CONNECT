<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    protected $table = 'vacantes';
    protected $primaryKey = 'id_vacante';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'modalidad',
        'ubicacion',
        'estado',
        'id_usuario',
    ];

    public function empresa()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'id_vacante', 'id_vacante');
    }
}
