<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Models\Ubicacion;
use App\Models\TipoDispositivo;
use App\Http\Requests\DispositivoRequest;

class DispositivoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $dispositivos = Dispositivo::with(['ubicacion', 'tipoDispositivo'])
            ->orderBy('id_dispositivo', 'desc')
            ->paginate(10);
        return view('dispositivos.index', compact('dispositivos'));
    }

    public function create()
    {
        $ubicaciones = Ubicacion::all();
        $tipos = TipoDispositivo::all();
        return view('dispositivos.create', compact('ubicaciones', 'tipos'));
    }

    public function store(DispositivoRequest $request)
    {
        Dispositivo::create(array_merge(
            $request->validated(),
            ['fecha_creacion' => now()]
        ));
        return redirect()->route('dispositivos.index')
            ->with('success', 'Dispositivo registrado correctamente.');
    }

    public function show(Dispositivo $dispositivo)
    {
        return view('dispositivos.show', compact('dispositivo'));
    }

    public function edit(Dispositivo $dispositivo)
    {
        $ubicaciones = Ubicacion::all();
        $tipos = TipoDispositivo::all();
        return view('dispositivos.edit', compact('dispositivo', 'ubicaciones', 'tipos'));
    }

    public function update(DispositivoRequest $request, Dispositivo $dispositivo)
    {
        $dispositivo->update($request->validated());
        return redirect()->route('dispositivos.index')
            ->with('success', 'Dispositivo actualizado correctamente.');
    }

    public function destroy(Dispositivo $dispositivo)
    {
        $dispositivo->delete();
        return redirect()->route('dispositivos.index')
            ->with('success', 'Dispositivo eliminado correctamente.');
    }
}
