<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Evento;
use App\Models\RelacionPersonal;
use App\Models\Persona;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function menu()
    {
        $personas = Persona::orderBy('nombre')->get();

        return view('reportes.index', compact('personas'));
    }

    public function buscarPersona(Request $request)
    {
        $q = $request->q;

        $personas = Persona::where('nombre', 'LIKE', "%$q%")
            ->orWhere('apellido_paterno', 'LIKE', "%$q%")
            ->orWhere('apellido_materno', 'LIKE', "%$q%")
            ->limit(15)
            ->get(['id_persona', 'nombre', 'apellido_paterno', 'apellido_materno']);

        return response()->json($personas);
    }

    public function dashboard()
    {
        $tipos = \DB::table('eventos')
            ->join('tipo_eventos', 'tipo_eventos.id_tipoevento', '=', 'eventos.id_tipoevento')
            ->select('tipo_eventos.descripcion', \DB::raw('COUNT(*) as total'))
            ->groupBy('tipo_eventos.descripcion')
            ->pluck('total', 'descripcion');

        return view('reportes.dashboard', compact('tipos'));
    }

    /**
     * Reporte PDF de eventos (entradas/salidas)
     */
    public function reporteEventos(Request $request)
    {
        $eventos = Evento::with(['persona', 'dispositivo', 'tipoEvento'])
            ->orderByDesc('fecha_evento')
            ->get();

        $pdf = PDF::loadView('reportes.eventos', compact('eventos'))
            ->setPaper('letter', 'portrait');

        return $pdf->download('reporte_eventos.pdf');
    }

    /**
     * Reporte PDF de tutores/niños/parentescos
     */
    public function reporteParentescos()
    {
        $relaciones = RelacionPersonal::with(['tutor', 'nino', 'parentesco'])
            ->orderByDesc('fecha_registro')
            ->get();

        $pdf = PDF::loadView('reportes.parentescos', compact('relaciones'))
            ->setPaper('letter', 'portrait');

        return $pdf->download('reporte_parentescos.pdf');
    }

    /**
     * Reporte PDF del historial de una persona
     */
    public function reportePersona($id_persona)
    {
        $persona = Persona::findOrFail($id_persona);

        $eventos = Evento::where('id_persona', $id_persona)
            ->with(['dispositivo', 'tipoEvento'])
            ->orderByDesc('fecha_evento')
            ->get();

        $pdf = PDF::loadView('reportes.historial_persona', compact('persona', 'eventos'))
            ->setPaper('letter', 'portrait');

        return $pdf->download('historial_'.$persona->nombre.'.pdf');
    }
}
