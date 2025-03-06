<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            //'username' => 'required|string',
            //'name' => 'required|string',
            //'lastname' => 'required|string',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ];
    }

    public function messages(): array
    {
        return [
            //'username.required' => 'El nombre de usuario es requerido',
            //'name.required' => 'El nombre es requerido',
            //'lastname.required' => 'El apellido es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya está registrado',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            //'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un caracter especial',
        ];
    }
}
