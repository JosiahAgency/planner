<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function loginView(){
        return view('auth.login');
    }

    public function registerView(){
        return view('auth.register');
    }

    public function createAccount(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Account created successfully');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('plannerApp')->plainTextToken;

        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return redirect('/')->with('success', 'Logged-In successfully');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
