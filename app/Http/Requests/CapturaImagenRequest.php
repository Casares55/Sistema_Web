<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapturaImagenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'id_dispositivo' => 'required|exists:dispositivos,id_dispositivo',
            'id_registro' => 'required|exists:registro_biometrico,id_registro',
            'ruta_imagen' => 'required|string|max:255',
            'hash_imagen' => 'required|string|max:255|unique:captura_imagen,hash_imagen,' . $this->id_imagen . ',id_imagen',
        ];
    }
}
