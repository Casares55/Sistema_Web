<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use App\Models\Persona;
use App\Models\RegistroBiometrico;
use App\Models\CapturaImagen;
use App\Models\Embedding;

class RegistroBiometricoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $tipos = \App\Models\TipoPersona::all();
        return view('registro_usuarios_rostros.form', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tipopersona' => 'required|exists:tipo_personas,id_tipopersona',
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'required|email|unique:personas,correo',
            'direccion' => 'nullable|string|max:255',
            'etiqueta_registro' => 'required|string|max:50',

            'imagenes' => 'required|array|max:5',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        DB::beginTransaction();

        try {
            // 1) Crear registro en DB
            $persona = Persona::create([
                'id_tipopersona' => $request->id_tipopersona,
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
                'direccion' => $request->direccion,
                'fecha_registro' => now(),
                'estado' => true,
            ]);

            RegistroBiometrico::create([
                'id_usuario' => Auth::id(),
                'id_persona' => $persona->id_persona,
                'etiqueta_registro' => $request->etiqueta_registro,
                'fecha_registro' => now(),
                'activo' => true,
            ]);

            // 2) ENVIAR CADA IMAGEN A TU API EN FASTAPI
            foreach ($request->file('imagenes') as $file) {

                Http::attach(
                    'imagen',
                    file_get_contents($file->getRealPath()),
                    $file->getClientOriginalName()
                )->post("http://127.0.0.1:8001/registro", [
                    "nombre" => $persona->id_persona   // 🔥 nombre = id_persona
                ]);
            }

            DB::commit();

            return redirect()
                ->route('registro_biometrico.create')
                ->with('success', 'Registro biométrico guardado correctamente.');


        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
}
