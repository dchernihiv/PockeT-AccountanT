<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;


class RegistrationController extends Controller
{
    public function index () {

        return view('auth.registration');
        
    }

    public function registration (Request $request) {

        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:10']
        ]);

        $data['password'] = bcrypt($data['password']);
        
        $user = User::where('email', $data['email'])->first();
        if ($user) { 
            back()->withErrors('user-exist', 'Пользователь с данным email уже зарегистрирован');
        }
        User::create($data);
        return redirect()->route('login');

    }
}
