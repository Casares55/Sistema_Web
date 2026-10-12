<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Persona;
use App\Models\Evento;
use App\Models\TipoEvento;
use App\Models\Dispositivo;

class ReconocimientoController extends Controller
{
    public function index()
    {
        $dispositivos = Dispositivo::all();
        return view('reconocimiento.index', compact('dispositivos'));
    }

    public function procesar(Request $request)
    {
        try {
            $urlPython = "http://127.0.0.1:8001/reconocer";

            // Enviar imagen capturada al microservicio Python
            $response = Http::attach(
                'imagen',
                file_get_contents($request->file('imagen')->getRealPath()),
                'captura.jpg'
            )->post($urlPython);

            if (!$response->ok()) {
                return response()->json([
                    "resultado" => "Error",
                    "mensaje"   => "Error en microservicio de reconocimiento"
                ], 500);
            }

            $data = $response->json();

            $personaMatch = null;
            $confianza = $data["confianza"] ?? 0;
            $mensaje = "No reconocido";
            $tipoDescripcion = "Acceso denegado";

            // ============================================================
            // CASO → RECONOCIDO (match == true)
            // ============================================================
            if (!empty($data["match"]) && $data["match"] === true) {

                // Python devuelve el id_persona como string: "10"
                $idPersona = intval($data["persona"]);

                // Buscar en DB por ID real
                $personaMatch = Persona::find($idPersona);

                $mensaje = "Acceso permitido";

                if ($personaMatch) {

                    // Verificar último evento del usuario (Entrada/Salida)
                    $ultimo = Evento::where('id_persona', $personaMatch->id_persona)
                        ->orderBy('fecha_evento', 'desc')
                        ->first();

                    $tipoDescripcion = ($ultimo && $ultimo->tipoEvento->descripcion == "Entrada")
                        ? "Salida"
                        : "Entrada";
                }
            }

            // Crear o buscar tipo de evento
            $tipo = TipoEvento::firstOrCreate(['descripcion' => $tipoDescripcion]);

            // Registrar evento final
            Evento::create([
                'id_persona'     => $personaMatch->id_persona ?? null,
                'id_dispositivo' => $request->id_dispositivo,
                'id_tipoevento'  => $tipo->id_tipoevento,
                'fecha_evento'   => now(),
                'confianza'      => $confianza,
                'resultado'      => $mensaje,
            ]);

            return response()->json([
                "resultado"   => $mensaje,
                "persona"     => $personaMatch,
                "confianza"   => $confianza,
                "tipo_evento" => $tipoDescripcion
            ]);

        } catch (\Exception $e) {
            Log::error("Error reconocimiento: " . $e->getMessage());
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

}
