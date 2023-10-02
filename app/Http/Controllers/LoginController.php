<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Masuk'
        ]);
    }

    public function auth(Request $req)
    {
        $dataLogin = $req->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:255'
        ]);

        if (Auth::attempt($dataLogin)) {
            $req->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Masuk gagal!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
