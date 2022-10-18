<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //protected $redirectTo = '/auth/signin';
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.signin.index');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            // guardar mensaje en la sesión
            Session::flash('mensaje', 'El correo o la contraseña son incorrectos.');
            return redirect()->route('login.show')->with('error', 'El correo o la contraseña son incorrectos.');
        }
    }
}
