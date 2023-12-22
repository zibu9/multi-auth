<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EleveController extends Controller
{
    public function index()
    {
        //dd(Auth::guard('eleve')->user());
        return view('eleve.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('eleve')->attempt($credentials)) {
            return redirect()->route('eleve.index');
        }
        return redirect()->route('eleve.login')->with('error', 'Adresse email ou mot de passe incorrect.');
    }

    public function loginView()
    {
        if (Auth::guard('eleve')->check()) {
            return redirect('/eleve');
        }
        return view('eleve.auth.login');
    }

    public function logout()
    {
        Auth::guard('eleve')->logout();

        return redirect('eleve/');
    }

    public function registerView()
    {
        if (Auth::guard('eleve')->check()) {
            return redirect('/eleve');
        }
        return view('eleve.auth.register');
    }

}
