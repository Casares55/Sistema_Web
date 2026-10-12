<?php
namespace App\Http\Controllers\Biometrico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\RegistroBiometrico;
use App\Models\CapturaImagen;
use App\Models\Embedding;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ProcessEmbeddingJob;

class RegistroController extends Controller
{
    public function create()
    {
        return view('biometrico.create'); // formulario con captura webcam / upload
    }

    public function store(Request $request)
    {
        // Validaciones básicas
        $request->validate([
            'nombre' => 'required|string|max:150',
            'apellido_paterno' => 'nullable|string|max:150',
            'apellido_materno' => 'nullable|string|max:150',
            'telefono' => 'nullable|string|max:30',
            'correo' => 'nullable|email|max:150',
            'imagen' => 'nullable|image|mimes:jpeg,png|max:5120', // 5MB
            'etiqueta' => 'nullable|string|max:150',
        ]);

        // 1) Crear persona
        $persona = Persona::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
        ]);

        // 2) Crear registro biometrico
        $registro = RegistroBiometrico::create([
            'id_usuario' => Auth::id(),
            'id_persona' => $persona->id_persona,
            'etiqueta_registro' => $request->etiqueta ?? null,
            'activo' => true,
        ]);

        // 3) Si cargó imagen, guardarla y solicitar embedding
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = 'faces/' . date('Ymd') . '/' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public', $filename); // storage/app/public/...
            $ruta = 'storage/' . $filename; // accesible vía storage:link

            $hash = hash_file('sha256', storage_path('app/' . $filename));

            $captura = CapturaImagen::create([
                'id_dispositivo' => null,
                'id_registro' => $registro->id_registro,
                'ruta_imagen' => $ruta,
                'hash_imagen' => $hash,
            ]);

            // Disparar job para procesar embedding en background
            ProcessEmbeddingJob::dispatch($captura->id_imagen);
        }

        return redirect()->route('biometrico.create')->with('success','Registro creado. Si subiste imagen, se procesará en breve.');
    }

    /**
     * Endpoint para la captura desde webcam (envía base64)
     */
    public function capturaAjax(Request $request)
    {
        $request->validate([
            'image_base64' => 'required|string',
            'id_registro' => 'required|exists:registro_biometrico,id_registro'
        ]);

        $data = $request->input('image_base64');

        // retirar prefijo data:image/png;base64,
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = $type[1]; // jpg, png
            $data = base64_decode($data);
        } else {
            return response()->json(['error'=>'Formato inválido'],400);
        }

        $filename = 'faces/' . date('Ymd') . '/' . Str::uuid() . '.' . $type;
        $storagePath = 'public/' . $filename;
        Storage::put($storagePath, $data);
        $ruta = 'storage/' . $filename;
        $hash = hash('sha256', $data);

        $captura = CapturaImagen::create([
            'id_dispositivo' => null,
            'id_registro' => $request->id_registro,
            'ruta_imagen' => $ruta,
            'hash_imagen' => $hash,
        ]);

        // Job para embedding
        ProcessEmbeddingJob::dispatch($captura->id_imagen);

        return response()->json(['ok'=>true,'id_imagen'=>$captura->id_imagen,'ruta'=>$ruta]);
    }
}
