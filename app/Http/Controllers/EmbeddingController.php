<?php

namespace App\Http\Controllers;

use App\Models\Embedding;
use App\Models\CapturaImagen;
use App\Http\Requests\EmbeddingRequest;

class EmbeddingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $embeddings = Embedding::with('imagen')
            ->orderByDesc('fecha_creacion')
            ->paginate(12);

        return view('embeddings.index', compact('embeddings'));
    }

    public function create()
    {
        // mostrar solo imágenes sin embedding si quieres: ejemplo opcional
        $imagenes = CapturaImagen::doesntHave('embedding')->get();
        // si prefieres todas: CapturaImagen::all()
        return view('embeddings.create', compact('imagenes'));
    }

    public function store(EmbeddingRequest $request)
    {
        Embedding::create(array_merge(
            $request->validated(),
            ['fecha_creacion' => now()]
        ));

        return redirect()->route('embeddings.index')
            ->with('success', 'Embedding guardado correctamente.');
    }

    public function show(Embedding $embedding)
    {
        $embedding->load('imagen');
        return view('embeddings.show', compact('embedding'));
    }

    public function edit(Embedding $embedding)
    {
        $imagenes = CapturaImagen::all();
        return view('embeddings.edit', compact('embedding', 'imagenes'));
    }

    public function update(EmbeddingRequest $request, Embedding $embedding)
    {
        $embedding->update($request->validated());
        return redirect()->route('embeddings.index')
            ->with('success', 'Embedding actualizado correctamente.');
    }

    public function destroy(Embedding $embedding)
    {
        $embedding->delete();
        return redirect()->route('embeddings.index')
            ->with('success', 'Embedding eliminado correctamente.');
    }
}
