<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'usuario_id',
        'vendedor_id',
        'total',
        'estatus',
        'ticket',
    ];

    // Una venta pertenece a un cliente (Usuario)
    public function comprador()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Una venta pertenece a un vendedor (Usuario)
    public function vendedor()
    {
        return $this->belongsTo(Usuario::class, 'vendedor_id');
    }

    // Has Many Through: productos de una venta a través de detalle_ventas
    public function productos()
    {
        return $this->hasManyThrough(
            Producto::class,
            DetalleVenta::class,
            'venta_id',    // FK en DetalleVenta
            'id',          // FK en Producto
            'id',          // PK en Venta
            'producto_id'  // PK local en DetalleVenta
        );
    }
}