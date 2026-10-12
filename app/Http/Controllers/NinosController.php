<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\RelacionPersonal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class NinosController extends Controller
{
    // Listado de niños para la vista web
    public function index()
    {
        // Obtenemos los IDs de los niños que tienen relaciones
        $idsNinos = RelacionPersonal::distinct()->pluck('id_nino')->toArray();

        // Cargar personas
        $ninos = Persona::whereIn('id_persona', $idsNinos)->get();

        // Preparar las tarjetas para la vista
        $cards = $ninos->map(function($n){
            // 1) Foto: buscar cualquier archivo PNG en la carpeta del niño
            $folder = "C:/py39/Personas/{$n->id_persona}";
            $imagenes = glob($folder . '/*.png');
            $fotoUrl = !empty($imagenes) ? $imagenes[0] : null;

            // 2) Parentescos relacionados
            $relaciones = RelacionPersonal::where('id_nino', $n->id_persona)
                ->with('tutor','parentesco')
                ->get();

            return (object)[
                'persona' => $n,
                'foto' => $fotoUrl,
                'relaciones' => $relaciones
            ];
        });

        return view('ninos.index', ['cards' => $cards]);
    }

    // Generar PDF de un niño específico
    public function pdf($id)
    {
        $nino = Persona::findOrFail($id);

        // Relacionados (tutores + parentesco)
        $relaciones = RelacionPersonal::where('id_nino', $id)
            ->with(['tutor','parentesco'])
            ->get();

        // Foto: buscar en la carpeta del niño (png, jpg, jpeg)
        $folder = "C:/py39/Personas/{$nino->id_persona}";
        $imagenes = glob($folder . '/*.{png,jpg,jpeg}', GLOB_BRACE);
        $foto_local = !empty($imagenes) ? $imagenes[0] : null;

        // Convertir la imagen a base64 si existe
        $foto_base64 = null;
        if ($foto_local && file_exists($foto_local)) {
            $tipo = pathinfo($foto_local, PATHINFO_EXTENSION); // png, jpg, jpeg
            $foto_base64 = 'data:image/' . $tipo . ';base64,' . base64_encode(file_get_contents($foto_local));
        }

        // Preparar datos para la vista PDF
        $data = [
            'nino' => $nino,
            'relaciones' => $relaciones,
            'foto_base64' => $foto_base64
        ];

        $pdf = Pdf::loadView('ninos.pdf', $data)->setPaper('a4', 'portrait');

        $filename = 'Ficha_' . $nino->nombre . '_' . $nino->apellido_paterno . '.pdf';

        return $pdf->download($filename);
    }

}
