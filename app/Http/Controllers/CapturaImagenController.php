<?php

namespace App\Http\Controllers;

use App\Models\CapturaImagen;
use App\Models\Dispositivo;
use App\Models\RegistroBiometrico;
use App\Http\Requests\CapturaImagenRequest;

class CapturaImagenController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $imagenes = CapturaImagen::with(['dispositivo', 'registroBiometrico'])
            ->orderBy('id_imagen', 'desc')
            ->paginate(10);

        return view('captura_imagen.index', compact('imagenes'));
    }

    public function create()
    {
        $dispositivos = Dispositivo::all();
        $registros = RegistroBiometrico::all();
        return view('captura_imagen.create', compact('dispositivos', 'registros'));
    }

    public function store(CapturaImagenRequest $request)
    {
        CapturaImagen::create(array_merge(
            $request->validated(),
            ['fecha_captura' => now()]
        ));

        return redirect()->route('captura_imagen.index')
            ->with('success', 'Imagen capturada registrada correctamente.');
    }

    public function show(CapturaImagen $captura_imagen)
    {
        return view('captura_imagen.show', compact('captura_imagen'));
    }

    public function edit(CapturaImagen $captura_imagen)
    {
        $dispositivos = Dispositivo::all();
        $registros = RegistroBiometrico::all();
        return view('captura_imagen.edit', compact('captura_imagen', 'dispositivos', 'registros'));
    }

    public function update(CapturaImagenRequest $request, CapturaImagen $captura_imagen)
    {
        $captura_imagen->update($request->validated());
        return redirect()->route('captura_imagen.index')
            ->with('success', 'Registro de imagen actualizado correctamente.');
    }

    public function destroy(CapturaImagen $captura_imagen)
    {
        $captura_imagen->delete();
        return redirect()->route('captura_imagen.index')
            ->with('success', 'Registro eliminado correctamente.');
    }
}
