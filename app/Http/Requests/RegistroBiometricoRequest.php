<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroBiometricoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            // Persona
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'required|email|unique:personas,correo',
            'direccion' => 'nullable|string|max:255',
            'id_tipopersona' => 'required|exists:tipo_personas,id_tipopersona',

            // Registro biométrico
            'etiqueta_registro' => 'required|string|max:50',

            // Imagen(es)
            'imagenes.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
