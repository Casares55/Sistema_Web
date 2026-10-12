<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPersonaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $id = $this->route('tipo_persona') ? $this->route('tipo_persona')->id_tipopersona : null;

        return [
            'descripcion' => 'required|string|max:150|unique:tipo_personas,descripcion,' . $id . ',id_tipopersona',
        ];
    }
}
