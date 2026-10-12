<?php

namespace App\Http\Controllers;

use App\Models\TipoDispositivo;
use App\Http\Requests\TipoDispositivoRequest;

class TipoDispositivoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $tipos = TipoDispositivo::orderBy('id_tipodispositivo', 'desc')->paginate(10);
        return view('tipo_dispositivos.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipo_dispositivos.create');
    }

    public function store(TipoDispositivoRequest $request)
    {
        TipoDispositivo::create($request->validated());
        return redirect()->route('tipo_dispositivos.index')
            ->with('success', 'Tipo de dispositivo creado correctamente.');
    }

    public function show(TipoDispositivo $tipo_dispositivo)
    {
        return view('tipo_dispositivos.show', compact('tipo_dispositivo'));
    }

    public function edit(TipoDispositivo $tipo_dispositivo)
    {
        return view('tipo_dispositivos.edit', compact('tipo_dispositivo'));
    }

    public function update(TipoDispositivoRequest $request, TipoDispositivo $tipo_dispositivo)
    {
        $tipo_dispositivo->update($request->validated());
        return redirect()->route('tipo_dispositivos.index')
            ->with('success', 'Tipo de dispositivo actualizado correctamente.');
    }

    public function destroy(TipoDispositivo $tipo_dispositivo)
    {
        $tipo_dispositivo->delete();
        return redirect()->route('tipo_dispositivos.index')
            ->with('success', 'Tipo de dispositivo eliminado correctamente.');
    }
}
