<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'ap'     => ['nullable', 'string', 'max:100'],
            'am'     => ['nullable', 'string', 'max:100'],
            'email'  => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        // Solo devolvemos los campos que queremos guardar
        return $this->safe()->only(['nombre', 'ap', 'am', 'email']);
    }

}
