<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()->symbols()
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo no es valido.',
            'email.unique' => 'El correo ya esta registrado.',
            'password.required' => 'La contraseña es requerida.',
            'password' => 'Las contraseña debe tener al menos 8 caracteres, una letra, un numero y un simbolo.',
            'password.confirmed' => 'La contraseña no coincide. '
         ];
    }
}
