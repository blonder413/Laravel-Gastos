<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $fecha_inicio = date('Y-m-01 00:00:00');
        $fecha_fin = date('Y-m-31 23:59:59');
        $gastos = Gasto::where('created_at', '>=', $fecha_inicio)->where('created_at', '<=', $fecha_fin)
            ->orderBy('valor', 'desc')->get();
        $total = $gastos->sum('valor');
        return view('welcome', compact('gastos', 'total'));
    }
}
