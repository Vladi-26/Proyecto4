<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Codigo2FA extends Model
{
    protected $table = 'codigo_2fas'; // Asegúrate de que coincida con la migración

    protected $fillable = [
        'usuario_id',
        'codigo',
        'expiracion'
    ];

    // Relación inversa: Un código pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
