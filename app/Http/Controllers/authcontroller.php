<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\User;

class authcontroller extends Controller
{
    public function login()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
        }
        return view('auth/login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
  
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];
  
        Auth::attempt($data);
  
        if (Auth::check()) { 
            return redirect()->route('home')->with('success','Login berhasil');
  
        } else { 
            return redirect()->route('login')->with('error','Login gagal, Email atau Password tidak sesuai');
        }
  
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
  
}
