<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Daftar'
        ]);
    }

    public function store(Request $req)
    {
        $dataRegister = $req->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:8|max:255'
        ]);

        User::create($dataRegister);

        $req->session()->flash('success', 'Pendaftaran berhasil! Silahkan masuk.');
        return redirect('/login');
    }
}
