<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $fecha_inicio = date('Y-m-01 00:00:00');
        $fecha_fin = date('Y-m-31 23:59:59');
        $gastos = Gasto::where('created_at', '>=', $fecha_inicio)->where('created_at', '<=', $fecha_fin)
            ->orderBy('valor', 'desc')->get();
        $total = $gastos->sum('valor');
        
        $datos = DB::select(
            'SELECT SUM(valor) as total,
            date_format(created_at, "%Y-%m") as mes from gastos
            group by mes ORDER BY mes ASC LIMIT 0, 12;'
        );
        $gastos_grafico = [];
        foreach ($datos as $key => $value) {
            $gastos_grafico[$key]['mes'] = $value->mes;
            $gastos_grafico[$key]['total'] = $value->total;
        }

        return view('welcome', compact('gastos', 'gastos_grafico', 'total'));
    }
}
