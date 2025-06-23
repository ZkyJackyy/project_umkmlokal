<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function regis(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:customer,saller',
            'alamat' => 'required',
            'no_telpon' => 'required|string|max:25',
        ]);

        // dd($request->alamat);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'remember_token' => Str::random(10),
        ]);

        return redirect()->route('login.view')->with('succes','registrasi berhasil');
    }
    public function viewlogin()
    {
        return view('pages.login');
    }
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect('/list-product');
        }
        return back()->withErrors([
            'email' => 'email tidak terdaftar'
        ])->onlyInput('email');

    }

}
