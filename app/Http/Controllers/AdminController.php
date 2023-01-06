<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeTarjeta;

class AdminController extends Controller
{
    public function index()
    {
        $usuario = \Auth::user();
        $tarjetas = HomeTarjeta::all();
        return view('dashboard', [
			'usuario' => $usuario,
            'tarjetas' => $tarjetas,
		]);
    }
}
