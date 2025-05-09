<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Objeto;
use App\Models\Galeria;

class DashboardController extends Controller
{
    public function index()
    {
        $objetos = Objeto::where('usuario', Auth::id())->pluck('id');
        $imagenes = Galeria::whereIn('id', $objetos)->get();

        return view('dashboard', compact('imagenes'));
    }
}
