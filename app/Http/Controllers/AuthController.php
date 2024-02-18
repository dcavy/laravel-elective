<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

            // dd($credentials);

            return back()->with('error', 'Email o contraseña incorrecta.');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        try {

            $credentials = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
            ]);

            $newUser = new User();
            $newUser->name = $credentials['name'];
            $newUser->email = $credentials['email'];
            $newUser->password = Hash::make($credentials['password']);
            $newUser->assignRole('user');
            $newUser->save();


            return redirect()->route('login');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
