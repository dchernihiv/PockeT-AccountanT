<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class LoginController extends Controller {

    public function index() {
    
        return view('auth.login');

    }

    public function login(Request $request) {
    
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:10', 'confirmed']
        ]);

        if (Auth::attempt($data, $request->input('remember'))) {

            event( new Registered(Auth::user()) );
            
            $request->session()->regenerate();
            return redirect()->route('web.category');
        }
        return to_route('login')->withErrors(['fail-login' => 'Ошибка входа']);
       
    }

    public function logout(Request $request) {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');

    }

    public function confirm(EmailVerificationRequest $request) {

        $request->fulfill();
        return redirect()->intended('/category');

    }

    public function send(Request $request) {

        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Посилання для верифікаціі email відправлено!');

    }

}
