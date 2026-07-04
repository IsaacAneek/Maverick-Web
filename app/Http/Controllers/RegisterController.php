<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'string', 'max:255', 'unique:users,user_id'],
            'username' => ['required', 'string', 'max:100', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'user_id'=> $data['user_id'],
            'username' => $data['username'],
            'password_hash' => Hash::make($data['password']),
        ]);

        return redirect()->route('login');
    }
}