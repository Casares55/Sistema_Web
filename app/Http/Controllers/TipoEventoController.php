<?php

namespace App\Http\Controllers;

use App\Models\TipoEvento;
use App\Http\Requests\TipoEventoRequest;

class TipoEventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tipos = TipoEvento::paginate(10);
        return view('tipo_eventos.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipo_eventos.create');
    }

    public function store(TipoEventoRequest $request)
    {
        TipoEvento::create($request->validated());
        return redirect()->route('tipo_eventos.index')->with('success', 'Tipo de evento creado.');
    }

    public function edit(TipoEvento $tipo_evento)
    {
        return view('tipo_eventos.edit', compact('tipo_evento'));
    }

    public function update(TipoEventoRequest $request, TipoEvento $tipo_evento)
    {
        $tipo_evento->update($request->validated());
        return redirect()->route('tipo_eventos.index')->with('success', 'Tipo de evento actualizado.');
    }

    public function destroy(TipoEvento $tipo_evento)
    {
        $tipo_evento->delete();
        return redirect()->route('tipo_eventos.index')->with('success', 'Tipo de evento eliminado.');
    }
}
