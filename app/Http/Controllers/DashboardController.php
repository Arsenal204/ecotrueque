<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Objeto;
use App\Models\Galeria;
use App\Models\Intercambio;
use App\Models\Categoria;

class DashboardController extends Controller
{

    public function index()
    {
        $userId = Auth::id();

        // Todas las categorías de la base de datos
        $categoriasDisponibles = Categoria::all();

        $intercambiosPendientes = Intercambio::where('id_usuario_receptor', $userId)
            ->where('estado', 'pendiente')
            ->count();

        // Categorías recientemente vistas (ID)
        $categoriasVistas = session()->get('categorias_vistas', []);

        $sugerencias = Objeto::with('imagenes')
            ->whereIn('categoria', $categoriasVistas)
            ->where('usuario', '!=', $userId)
            ->latest()
            ->take(10)
            ->get();

        $imagenes = Objeto::where('usuario', $userId)->with('imagenes')->get()->pluck('imagenes')->flatten();

        return view('dashboard', [
            'sugerencias' => $sugerencias,
            'imagenes' => $imagenes,
            'intercambiosPendientes' => $intercambiosPendientes,
            'categorias' => $categoriasDisponibles
        ]);
    }
}
