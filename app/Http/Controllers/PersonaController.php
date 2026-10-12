<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\TipoPersona;
use App\Http\Requests\PersonaRequest;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $personas = Persona::with('tipoPersona')
            ->orderBy('nombre')
            ->paginate(10);

        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        // Quitamos el filtro 'activo'
        $tipos = TipoPersona::pluck('descripcion', 'id_tipopersona');
        return view('personas.create', compact('tipos'));
    }

    public function store(PersonaRequest $request)
    {
        Persona::create($request->validated());

        return redirect()
            ->route('personas.index')
            ->with('success', 'Persona registrada correctamente.');
    }

    public function show(Persona $persona)
    {
        $persona->load('tipoPersona');
        return view('personas.show', compact('persona'));
    }

    public function edit(Persona $persona)
    {
        // También quitamos 'activo' aquí
        $tipos = TipoPersona::pluck('descripcion', 'id_tipopersona');
        return view('personas.edit', compact('persona', 'tipos'));
    }

    public function update(PersonaRequest $request, Persona $persona)
    {
        $persona->update($request->validated());

        return redirect()
            ->route('personas.index')
            ->with('success', 'Datos actualizados correctamente.');
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();

        return redirect()
            ->route('personas.index')
            ->with('success', 'Registro eliminado correctamente.');
    }
}
