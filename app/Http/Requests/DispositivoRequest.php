<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DispositivoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'codigo_interno' => 'required|string|max:50|unique:dispositivos,codigo_interno,' . $this->id_dispositivo . ',id_dispositivo',
            'descripcion' => 'required|string|max:150',
            'id_ubicacion' => 'required|exists:ubicaciones,id_ubicacion',
            'direccion_ip' => 'required|ip|unique:dispositivos,direccion_ip,' . $this->id_dispositivo . ',id_dispositivo',
            'id_tipodispositivo' => 'required|exists:tipo_dispositivos,id_tipodispositivo',
            'estatus' => 'required|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'estatus' => $this->has('estatus') ? (bool)$this->input('estatus') : false,
        ]);
    }
}
