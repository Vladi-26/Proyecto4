<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'usuario_id',
        'fotos',
    ];

    protected $casts = [
        'fotos' => 'array',
    ];

    // Un producto pertenece a muchas categorías
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_producto');
    }

    // El producto pertenece a un usuario (vendedor)
    public function vendedor()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Detalles de ventas donde aparece este producto
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'producto_id');
    }
}