<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentikasi
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // Ambil user dari request (editor-friendly)
        $user = $request->user();

        // Redirect berdasarkan role
        if ($user && $user->role === 'admin') {
            return redirect('/ktm/admin');
        }

        return redirect('/ktm/mahasiswa/dashboard');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout kembali ke login KTM
        return redirect('/ktm/login');
    }
}
