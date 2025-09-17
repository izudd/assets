<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ActivityLog;


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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'super admin') {
            return redirect()->route('dashboard.superadmin');
        } elseif ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        } elseif ($user->role === 'staf') {
            return redirect()->route('dashboard.staff');
        } elseif ($user->role === 'validator') {
            return redirect()->route('dashboard.validator');
        } elseif ($user->role === 'verifikator') {
            return redirect()->route('dashboard.verifikator');
        } elseif ($user->role === 'guest') {
            return redirect()->route('dashboard.guest');
        } else {
            // fallback, kalau role belum di-handle
            return redirect()->route('dashboard');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    
protected function authenticated(Request $request, $user)
{
    ActivityLog::create([
        'user_id' => $user->id,
        'role' => $user->role, // pastikan di model User ada field role
        'activity' => 'login',
    ]);
}

public function logout(Request $request)
{
    ActivityLog::create([
        'user_id' => Auth::id(),
        'role' => Auth::user()->role,
        'activity' => 'logout',
    ]);

    Auth::logout();
    return redirect('/login');
}

}
