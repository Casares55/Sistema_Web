<?php

namespace App\Http\Controllers;

use App\Models\TipoPersona;
use Illuminate\Http\Request;
use App\Http\Requests\TipoPersonaRequest;

class TipoPersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']); // O puedes agregar: ,'checkrole:admin'
    }

    /**
     * Muestra la lista de tipos de persona
     */
    public function index()
    {
        $tipos = TipoPersona::orderBy('descripcion')->paginate(10);
        return view('tipo_personas.index', compact('tipos'));
    }

    /**
     * Muestra el formulario de creación
     */
    public function create()
    {
        return view('tipo_personas.create');
    }

    /**
     * Guarda un nuevo registro
     */
    public function store(TipoPersonaRequest $request)
    {
        TipoPersona::create($request->validated());
        return redirect()->route('tipo_personas.index')
            ->with('success', 'Tipo de persona creado correctamente.');
    }

    /**
     * Muestra un registro específico
     */
    public function show(TipoPersona $tipo_persona)
    {
        return view('tipo_personas.show', compact('tipo_persona'));
    }

    /**
     * Muestra el formulario de edición
     */
    public function edit(TipoPersona $tipo_persona)
    {
        return view('tipo_personas.edit', compact('tipo_persona'));
    }

    /**
     * Actualiza un registro existente
     */
    public function update(TipoPersonaRequest $request, TipoPersona $tipo_persona)
    {
        $tipo_persona->update($request->validated());
        return redirect()->route('tipo_personas.index')
            ->with('success', 'Tipo de persona actualizado correctamente.');
    }

    /**
     * Elimina un registro
     */
    public function destroy(TipoPersona $tipo_persona)
    {
        $tipo_persona->delete();
        return redirect()->route('tipo_personas.index')
            ->with('success', 'Tipo de persona eliminado correctamente.');
    }
}
