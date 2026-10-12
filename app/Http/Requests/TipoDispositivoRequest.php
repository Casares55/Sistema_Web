<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoDispositivoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'descripcion' => 'required|string|max:100|unique:tipo_dispositivos,descripcion,'
                . $this->id_tipodispositivo . ',id_tipodispositivo',
        ];
    }
}
