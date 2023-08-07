<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
  public function __construct()
  {
    // Método nativo de Laravel para proteger rutas sólo para el usuario autenticado
    $this->middleware('auth');
  }
  public function index()
  {
    return view('profile.index');
  }
}
