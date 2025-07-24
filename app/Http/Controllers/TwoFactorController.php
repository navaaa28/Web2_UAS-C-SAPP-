<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct(Google2FA $google2fa)
    {
        $this->google2fa = $google2fa;
    }

    public function index()
    {
        $user = Auth::user();
        $secretKey = $this->google2fa->generateSecretKey();
        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secretKey
        );

        return view('2fa.index', [
            'secretKey' => $secretKey,
            'qrCodeUrl' => $qrCodeUrl
        ]);
    }

    public function enable(Request $request)
    {
        $request->validate([
            'secret' => 'required',
            'code' => 'required',
        ]);

        $valid = $this->google2fa->verifyKey($request->secret, $request->code);

        if ($valid) {
            $user = Auth::user();
            $user->google2fa_secret = $request->secret;
            $user->google2fa_enabled = true;
            $user->save();

            return redirect()->route('profile.edit')->with('status', '2fa-enabled');
        }

        return back()->withErrors(['code' => 'Invalid verification code.']);
    }

    public function verify()
    {
        if (!session()->has('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('2fa.verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $userId = session()->get('2fa_user_id');
        $user = \App\Models\User::find($userId);

        if (!$user) {
            return redirect()->route('login');
        }

        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            Auth::login($user);
            session()->forget('2fa_user_id');
            session(['2fa_verified' => true]);
            
            if ($user->is_admin) {
                return redirect()->intended(route('admin.dashboard'));
            }
            
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['code' => 'Invalid verification code.']);
    }

    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        $user = Auth::user();
        $user->google2fa_enabled = false;
        $user->google2fa_secret = null;
        $user->save();

        return redirect()->route('profile.edit')->with('status', '2fa-disabled');
    }
}
