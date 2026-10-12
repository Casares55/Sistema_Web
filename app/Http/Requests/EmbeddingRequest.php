<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmbeddingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        // $this->route('embedding') si usas route model binding en update
        $id = $this->route('embedding') ? $this->route('embedding')->id_embedding : null;

        return [
            'id_imagen' => 'required|exists:captura_imagen,id_imagen',
            'vector_embedding' => 'required|string',
            // fecha_creacion se asigna en el controlador al crear
        ];
    }
}
