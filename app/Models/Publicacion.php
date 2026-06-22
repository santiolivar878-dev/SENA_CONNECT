<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';
    protected $primaryKey = 'id_publicacion';
    public $timestamps = false;

    protected $fillable = [
        'contenido',
        'imagen',
        'fecha_publicacion',
        'id_usuario',
    ];

    protected $casts = [
        'fecha_publicacion' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }
}
