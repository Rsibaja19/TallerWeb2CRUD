<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // registrar el middleware de autenticación en el controlador
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('is_admin');
    }

    // retornar el home no autenticado
    public function index()
    {
        return view('user.home');
    }

    // retornar el index no autenticado
    public function adminHome()
    {
        return view('admin.home');
    }
}
