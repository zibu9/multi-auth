<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        //dd(Auth::guard('admin')->user());
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return redirect()->route('admin.login')->with('error', 'Adresse email ou mot de passe incorrect.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('admin/');
    }

    public function loginView()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }
        return view('admin.auth.login');
    }

    public function registerView()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin');
        }
        return view('admin.auth.register');
    }
}
