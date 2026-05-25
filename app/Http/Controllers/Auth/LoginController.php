<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Importante para los Logs
use App\Models\Usuario;
use App\Models\Codigo2FA;
use App\Mail\Codigo2FAMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }
    
    public function login(Request $request) {
        $request->validate([
            'correo' => 'required|email',
            'clave' => 'required',
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();

        // 1. Validar credenciales manualmente
        if (!$usuario || !Hash::check($request->clave, $usuario->clave)) {
            // Log de Intento Fallido
            Log::channel('autenticacion')->warning('Intento de login fallido', [
                'correo' => $request->correo,
                'ip' => $request->ip()
            ]);
            return back()->withErrors(['error' => 'Las credenciales no coinciden.']);
        }

        // 2. Credenciales correctas -> Login correcto (Fase 1) [Requisito Log]
        Log::channel('autenticacion')->info('Login correcto (fase 1)', [
            'usuario_id' => $usuario->id,
            'ip' => $request->ip()
        ]);

        // 3. Generar código OTP numérico [Requisito 1]
        $codigoOTP = rand(100000, 999999);

        // 4. Guardar en base de datos con expiración de 5 min [Requisito 1]
        Codigo2FA::create([
            'usuario_id' => $usuario->id,
            'codigo' => $codigoOTP,
            'expiracion' => Carbon::now()->addMinutes(5),
        ]);

        // Log de Código Generado [Requisito Log]
        Log::channel('autenticacion')->info('Codigo 2FA generado', [
            'usuario_id' => $usuario->id,
            'ip' => $request->ip()
        ]);

        // 5. Envío de correo
        Mail::to($usuario->correo)->send(new Codigo2FAMail($codigoOTP));

        // 6. Guardar ID en sesión temporal y redirigir
        session(['auth_2fa_user_id' => $usuario->id]);
        return redirect()->route('2fa.index');
    }

    public function show2faForm() {
        if (!session()->has('auth_2fa_user_id')) return redirect('/login');
        return view('auth.2fa');
    }

    public function verify2fa(Request $request) {
        $request->validate(['codigo' => 'required|numeric']);
        $userId = session('auth_2fa_user_id');

        $registro = Codigo2FA::where('usuario_id', $userId)
                    ->where('codigo', $request->codigo)
                    ->latest()
                    ->first();

        // 7. Validar si existe y no ha expirado
        if (!$registro) {
            // Log de Código Inválido [Requisito Log]
            Log::channel('autenticacion')->warning('Código inválido', [
                'usuario_id' => $userId,
                'ip' => $request->ip()
            ]);
            return back()->withErrors(['codigo' => 'El código es incorrecto.']);
        }

        if (Carbon::now()->gt($registro->expiracion)) {
            // Log de Código Expirado [Requisito Log]
            Log::channel('autenticacion')->warning('Código expirado', [
                'usuario_id' => $userId,
                'ip' => $request->ip()
            ]);
            return back()->withErrors(['codigo' => 'El código ha expirado.']);
        }

        // 8. Todo correcto -> Iniciar sesión oficialmente
        Auth::loginUsingId($userId);
        session()->forget('auth_2fa_user_id');

        // Log de Código Validado Correctamente [Requisito Log]
        Log::channel('autenticacion')->info('Código validado correctamente', [
            'usuario_id' => $userId,
            'ip' => $request->ip()
        ]);

        return redirect()->intended('dashboard');
    }
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
}
