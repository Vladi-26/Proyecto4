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
        'clave',
        'rol',
    ];

    protected $hidden = [
        'clave',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->clave;
    }

    // Productos que vende este usuario
    public function productos()
    {
        return $this->hasMany(Producto::class, 'usuario_id');
    }

    // Compras realizadas como cliente
    public function compras()
    {
        return $this->hasMany(Venta::class, 'usuario_id');
    }

    // Ventas realizadas como vendedor
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'vendedor_id');
    }
}