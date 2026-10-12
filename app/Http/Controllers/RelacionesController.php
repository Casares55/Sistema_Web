<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelacionPersonal;
use App\Models\Parentesco;
use App\Models\Persona;

class RelacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin'); // Solo admins
    }

    public function index()
    {
        $relaciones = RelacionPersonal::with(['tutor', 'nino', 'parentesco'])
            ->orderByDesc('fecha_registro')
            ->paginate(10);

        $parentescos = Parentesco::all();
        $personas = Persona::all();

        return view('relaciones.index', compact('relaciones', 'parentescos', 'personas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tutor' => 'required|exists:personas,id_persona',
            'id_nino' => 'required|exists:personas,id_persona|different:id_tutor',
            'id_parentesco' => 'required|exists:parentescos,id_parentesco',
        ]);

        RelacionPersonal::create([
            'id_tutor' => $request->id_tutor,
            'id_nino' => $request->id_nino,
            'id_parentesco' => $request->id_parentesco,
            'estado_validacion' => 'Validado',
            'fecha_registro' => now(),
            'fecha_validacion' => now()
        ]);

        return back()->with('success', 'Relación registrada correctamente.');
    }

    public function destroy(RelacionPersonal $relacion)
    {
        $relacion->delete();
        return back()->with('success', 'Relación eliminada correctamente.');
    }
}
