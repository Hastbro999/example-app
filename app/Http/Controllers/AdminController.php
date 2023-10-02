<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin', [
            'users' => User::all()
        ]);
    }

 }
