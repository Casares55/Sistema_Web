<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Http\Requests\UbicacionRequest;

class UbicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $ubicaciones = Ubicacion::orderBy('id_ubicacion', 'desc')->paginate(10);
        return view('ubicaciones.index', compact('ubicaciones'));
    }

    public function create()
    {
        return view('ubicaciones.create');
    }

    public function store(UbicacionRequest $request)
    {
        Ubicacion::create($request->validated());
        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación registrada correctamente.');
    }

    public function show(Ubicacion $ubicacion)
    {
        return view('ubicaciones.show', compact('ubicacion'));
    }

    public function edit(Ubicacion $ubicacion)
    {
        return view('ubicaciones.edit', compact('ubicacion'));
    }

    public function update(UbicacionRequest $request, Ubicacion $ubicacion)
    {
        $ubicacion->update($request->validated());
        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación actualizada correctamente.');
    }

    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->delete();
        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación eliminada correctamente.');
    }
}
