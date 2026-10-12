<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $id = $this->route('persona') ? $this->route('persona')->id_persona : null;

        return [
            'id_tipopersona' => 'required|exists:tipo_personas,id_tipopersona',
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'nullable|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|max:150|unique:personas,correo,' . $id . ',id_persona',
            'direccion' => 'nullable|string|max:255',
            'fecha_registro' => 'nullable|date',
            'estado' => 'boolean'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'estado' => $this->has('estado') ? (bool)$this->input('estado') : false,
            'fecha_registro' => $this->input('fecha_registro') ?? now(),
        ]);
    }
}
