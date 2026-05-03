<?php

namespace App\Models; // Asegúrate de que el namespace coincida con tu estructura (usualmente App\Models)

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Habilitamos la asignación masiva para los campos necesarios
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'usuario_id' // Agregado para la relación con el vendedor
    ];

    // Un producto pertenece a muchas categorías
    public function categorias() {
        return $this->belongsToMany(Categoria::class, 'categoria_producto');
    }

    // Relación inversa: El producto pertenece a un usuario (vendedor)
    public function vendedor() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}