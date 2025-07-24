<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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
        \Log::info('Login attempt', ['email' => $request->email]);
        
        try {
            $request->authenticate();
            \Log::info('Authentication successful');

            $request->session()->regenerate();
            \Log::info('Session regenerated', ['session_id' => session()->getId()]);

            $user = Auth::user();
            \Log::info('User retrieved', [
                'user_id' => $user->id,
                '2fa_enabled' => $user->google2fa_enabled
            ]);

            if ($user->google2fa_enabled) {
                \Log::info('2FA enabled, preparing 2FA verification');
                Auth::logout();
                $request->session()->put('2fa_user_id', $user->id);
                \Log::info('2FA user ID stored in session', [
                    '2fa_user_id' => session('2fa_user_id'),
                    'session_id' => session()->getId()
                ]);
                return redirect()->route('2fa.verify');
            }

            if (auth()->user()->is_admin) {
                \Log::info('Admin user, redirecting to admin dashboard');
                return redirect()->intended(route('admin.dashboard', absolute: false));
            }

            \Log::info('Regular user, redirecting to dashboard');
            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            \Log::error('Login error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
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
}
