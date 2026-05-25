<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => 'required|string|min:3|max:100',
            'descripcion' => 'required|string',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'usuario_id'  => 'required|exists:usuarios,id',
            // Fotos opcionales al actualizar, deben ser imágenes válidas
            'fotos'       => 'nullable|array',
            'fotos.*'     => 'image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'      => 'El nombre del producto es obligatorio.',
            'nombre.min'           => 'El nombre debe tener al menos 3 caracteres.',
            'precio.numeric'       => 'El precio debe ser un número.',
            'precio.min'           => 'El precio no puede ser negativo.',
            'stock.integer'        => 'El stock debe ser un número entero.',
            'usuario_id.exists'    => 'El vendedor seleccionado no existe.',
            'fotos.*.image'        => 'Cada archivo debe ser una imagen válida.',
            'fotos.*.max'          => 'Cada imagen no debe superar 2MB.',
        ];
    }
}