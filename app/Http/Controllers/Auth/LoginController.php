<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Retorna la vista con el formulario de login.
        // Por ejemplo: resources/views/auth/login.blade.php
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar el request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerar la sesión para evitar fixation
            $request->session()->regenerate();

            // Redirigir al dashboard (o donde quieras que vaya después del login)
            return redirect()->intended('/dashboard')->with('message', 'Bienvenido!');
        }

        // Si falla la autenticación, retornar con error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message','Has cerrado sesión con éxito.');
    }
}
