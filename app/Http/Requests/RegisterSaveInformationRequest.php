<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSaveInformationRequest extends FormRequest
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
            'username' => 'required|string|unique:clients,username',
            'name' => 'required|string',
            'lastname' => 'required|string',
            'description' => ['string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'El nombre de usuario es requerido',
            'username.string' => 'El nombre de usuario debe ser una cadena de texto',
            'username.unique' => 'El nombre de usuario ya está registrado',
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'lastname.required' => 'El apellido es requerido',
            'lastname.string' => 'El apellido debe ser una cadena de texto',
            'description.string' => 'La descripción debe ser una cadena de texto',
            'description.max' => 'La descripción no puede ser mayor a 500 carácteres',
        ];
    }

}
