<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    protected $table = 'postulaciones';
    protected $primaryKey = 'id_postulacion';
    public $timestamps = false;

    protected $fillable = [
        'id_vacante',
        'id_usuario',
        'hoja_vida',
        'fecha_postulacion',
        'estado',
    ];

    public function vacante()
    {
        return $this->belongsTo(Vacante::class, 'id_vacante', 'id_vacante');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }
}
