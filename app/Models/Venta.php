<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    /**
     * Los atributos que se pueden asignar de forma masiva.
     * Esto corrige el error MassAssignmentException.
     */
    protected $fillable = [
        'usuario_id',
        'vendedor_id',
        'total',
        'estatus',
    ];

    /**
     * Una venta pertenece a un cliente (Usuario).
     * Nota: Asegúrate de que el nombre de la columna sea 'comprador_id' o 'usuario_id' 
     * según tu migración.
     */
    public function comprador() 
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Una venta pertenece a un vendedor (Usuario).
     */
    public function vendedor() 
    {
        return $this->belongsTo(Usuario::class, 'vendedor_id');
    }

    /**
     * PUNTO CLAVE: Relación a través de (Has Many Through)
     * Permite ver los productos de una venta a través de la tabla pivote de detalles.
     * Requisito para el Punto 5 del reporte.
     */
    public function productos() 
    {
        return $this->hasManyThrough(
            Producto::class, 
            DetalleVenta::class,
            'venta_id',       // Llave foránea en DetalleVenta
            'id',             // Llave foránea en Producto
            'id',             // Llave local en Venta
            'producto_id'     // Llave local en DetalleVenta
        );
    }
}