<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbicacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'descripcion' => 'required|string|max:150|unique:ubicaciones,descripcion,' . $this->id_ubicacion . ',id_ubicacion',
        ];
    }
}
