<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentReplyRequest extends FormRequest
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
            'user_id'    => 'required|exists:clients,id',     // Asegura que el 'user_id' sea obligatorio y exista en la tabla 'users'
            'comment_id' => 'required|exists:comments,id',  // Asegura que el 'comment_id' sea obligatorio y exista en la tabla 'comments'
            'reply'      => 'required|string|min:1|max:500', // El 'reply' debe ser un texto de al menos 5 caracteres y no más de 500
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'    => 'El usuario es obligatorio.',
            'user_id.exists'      => 'El usuario seleccionado no existe.',
            'comment_id.required' => 'El comentario es obligatorio.',
            'comment_id.exists'   => 'El comentario seleccionado no existe.',
            'reply.required'      => 'El mensaje de respuesta es obligatorio.',
            'reply.string'        => 'El mensaje de respuesta debe ser un texto.',
            'reply.min'           => 'El mensaje de respuesta debe tener al menos 5 caracteres.',
            'reply.max'           => 'El mensaje de respuesta no puede superar los 500 caracteres.',
        ];
    }
}
