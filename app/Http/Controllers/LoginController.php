<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Jobs\SendEmailConfirmEmail;


class LoginController extends Controller
{

    public function index(Request $request)
    {

        if (Auth::viaRemember($request->user())) return redirect()->route('web.category');

        else if (Auth::check()) return redirect()->route('web.category');

        else return view('auth.login');
    }

    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:10', 'confirmed']
        ]);

        if (Auth::attempt($data, $request->input('remember'))) {

            $request->session()->regenerate();
            
            SendEmailConfirmEmail::dispatch(Auth::user());

            return redirect()->route('web.category');
        }

        return to_route('login')->withErrors(['fail-login' => 'Користувач за цими облікованими даними не знайдений']);
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    /** 
     * Подтверждение email
     *  */
    
    public function confirm(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->intended('/category');
    }

    public function send(Request $request)
    {
        SendEmailConfirmEmail::dispatch(Auth::user());
        return back()->with('message', 'Посилання для верифікаціі email відправлено!');
    }

    /** 
     * Сброс пароля
     *  */

    public function sendResetPassword(Request $request) {
    
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

    }

    public function resetPassword(Request $request) {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);

    }
}
