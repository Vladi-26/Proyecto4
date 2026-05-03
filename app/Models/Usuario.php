<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'clave', // Usaremos 'clave' en lugar de password
        'rol',
    ];

    protected $hidden = [
        'clave',
        'remember_token',
    ];

    // Laravel busca por defecto 'password', indicamos que use 'clave'
    public function getAuthPassword()
    {
        return $this->clave;
    }

    // RELACIONES (Requisito 4 y 6)
    public function productos() {
        return $this->hasMany(Producto::class, 'usuario_id');
    }

    public function compras() {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    public function ventas() {
        return $this->hasMany(Venta::class, 'vendedor_id');
    }
}
