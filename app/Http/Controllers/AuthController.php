<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credenciales = $request->validate([
            "email" => "required|email",
            "password" => "required|string"
        ]);
        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return redirect()
            ->route("login")
            ->with('error', "Credenciales incorrectas");
    }

    public function logout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->intended("/login");
    }
}
