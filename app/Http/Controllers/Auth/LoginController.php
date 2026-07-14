<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $data['username'])->first();

        if (!$user || !Hash::check($data['password'], $user->password_hash)) {
            return back()->withErrors([
                'username' => 'Invalid username or password.'
            ]);
        }

        // Store user information in the session
        session([
            'user_id' => $user->user_id,
            'username' => $user->username,
        ]);

        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}