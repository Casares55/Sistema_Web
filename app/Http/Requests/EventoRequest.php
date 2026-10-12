<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'id_persona' => 'required|exists:personas,id_persona',
            'id_dispositivo' => 'required|exists:dispositivos,id_dispositivo',
            'id_embedding' => 'required|exists:embeddings,id_embedding',
            'id_tipoevento' => 'required|exists:tipo_eventos,id_tipoevento',
            'fecha_evento' => 'nullable|date',
            'confianza' => 'nullable|numeric|min:0|max:100',
            'resultado' => 'nullable|string|max:100',
        ];
    }
}
