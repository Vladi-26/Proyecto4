<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Auth\Access\Response;

class VentaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Venta $venta): bool
    {
        // Regla: El Gerente puede ver cualquier ticket
        if ($usuario->rol === 'gerente') {
            return true;
        }

        // Regla: El Cliente solo puede ver su propia venta
        return $usuario->id === $venta->comprador_id;
    }

    public function validate(Usuario $usuario)
    {
        // El administrador o gerente pueden validar cualquier venta
        return in_array($usuario->rol, ['admin', 'gerente', 'administrador']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Venta $venta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Venta $venta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Venta $venta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Venta $venta): bool
    {
        return false;
    }
}
