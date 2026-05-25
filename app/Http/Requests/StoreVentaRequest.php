<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usuario_id'  => 'required|exists:usuarios,id',
            'vendedor_id' => 'required|exists:usuarios,id',
            'total'       => 'required|numeric|min:0',
            'estatus'     => 'nullable|string|in:pendiente,validada,cancelada',
            // Ticket opcional al crear, debe ser imagen
            'ticket'      => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'usuario_id.required'  => 'El comprador es obligatorio.',
            'usuario_id.exists'    => 'El comprador seleccionado no existe.',
            'vendedor_id.required' => 'El vendedor es obligatorio.',
            'vendedor_id.exists'   => 'El vendedor seleccionado no existe.',
            'total.required'       => 'El total de la venta es obligatorio.',
            'total.numeric'        => 'El total debe ser un número.',
            'total.min'            => 'El total no puede ser negativo.',
            'estatus.in'           => 'El estatus debe ser: pendiente, validada o cancelada.',
            'ticket.image'         => 'El ticket debe ser una imagen válida.',
            'ticket.max'           => 'El ticket no debe superar 2MB.',
        ];
    }
}