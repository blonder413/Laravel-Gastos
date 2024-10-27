<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $detalle = $request->detalle;
        $valor = $request->valor;
        $fecha = $request->fecha;
        $gastos = Gasto::orderBy('id', 'desc')->detalle($detalle)->valor($valor)->fecha($fecha)->paginate(10);
        $gastos->appends(['detalle' => $detalle, 'valor' => $valor, 'fecha' => $fecha]);

        return view('gasto/index', compact('gastos', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gasto/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gastos = request()->validate([
            'detalle' => 'required',
            'valor' => 'required'
        ]);
        Gasto::create($gastos);
        return redirect()->route('gastos.index')->with('success', 'Gasto agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gasto = Gasto::where(['id' => $id])->firstOrFail();
        return view('gasto/edit', compact('gasto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gasto = Gasto::where(['id' => $id])->firstOrFail();
        $datos = request()->validate([
            'detalle' => 'required',
            'valor' => 'required'
        ]);
        $gasto->update($datos);
        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gasto = Gasto::where(['id' => $id])->firstOrFail();
        $gasto->delete();
        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado');
    }
}
