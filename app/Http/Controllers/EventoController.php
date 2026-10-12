<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Persona;
use App\Models\Dispositivo;
use App\Models\Embedding;
use App\Models\TipoEvento;
use App\Http\Requests\EventoRequest;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $eventos = Evento::with(['persona', 'dispositivo', 'tipoEvento'])
            ->orderByDesc('fecha_evento')
            ->paginate(15);
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        $personas = Persona::all();
        $dispositivos = Dispositivo::all();
        $embeddings = Embedding::all();
        $tipos = TipoEvento::all();

        return view('eventos.create', compact('personas', 'dispositivos', 'embeddings', 'tipos'));
    }

    public function store(EventoRequest $request)
    {
        Evento::create(array_merge($request->validated(), [
            'fecha_evento' => $request->fecha_evento ?? now(),
        ]));

        return redirect()->route('eventos.index')->with('success', 'Evento registrado correctamente.');
    }

    public function edit(Evento $evento)
    {
        $personas = Persona::all();
        $dispositivos = Dispositivo::all();
        $embeddings = Embedding::all();
        $tipos = TipoEvento::all();

        return view('eventos.edit', compact('evento', 'personas', 'dispositivos', 'embeddings', 'tipos'));
    }

    public function update(EventoRequest $request, Evento $evento)
    {
        $evento->update($request->validated());
        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
}
