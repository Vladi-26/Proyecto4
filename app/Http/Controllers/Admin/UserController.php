<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // IMPORTANTE: Usar el nuevo modelo
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Recuperamos los usuarios creados por el Factory (Juan, Maria, etc.)
        $usuarios = Usuario::all();
        
        return view('admin.usuarios.index', compact('usuarios'));
    }
}
