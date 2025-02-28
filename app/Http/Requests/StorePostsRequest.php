<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'     => 'unique:users,email|email|required',
            'name'      => 'required',
            'password'  => 'required'
        ];
    }

    public function withValidator($validator)
    {

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'msg'   => 'Los campos son obligatorios.',
                'status' => false,
                'errors'    => $validator->errors(),
                'url'    => route('users.store.post')
            ], 403));
       }
    }
}

/*
Las clases de solicitud de formulario (Form Requests) en Laravel se encuentran típicamente en la carpeta app/Http/Requests.
Su principal función es encapsular la lógica de validación y autorización de las peticiones HTTP, manteniendo tus controladores más limpios y enfocados en la lógica de negocio.
*/
