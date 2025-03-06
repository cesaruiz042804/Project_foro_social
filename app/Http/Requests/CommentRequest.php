<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ProfanityFilter;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // para permitir que las solicitudes sean procesadas.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => 'required|integer|exists:posts,id',
            'comment' => ['required', 'string', 'min:1', 'max:500', new ProfanityFilter()],
            'user_id' => 'required|integer|exists:clients,id',
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.required' => 'El ID del post es obligatorio.',
            'post_id.integer' => 'El ID del post debe ser un número entero.',
            'post_id.exists' => 'El ID del post no existe.',
            'comment.required' => 'El comentario es obligatorio.',
            'comment.string' => 'El comentario debe ser texto.',
            'comment.max' => 'El comentario no puede tener más de 500 caracteres.',
            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.integer' => 'El ID del usuario debe ser un número entero.',
            'user_id.exists' => 'El ID del usuario no existe.',
            'content.profanity_filter' => 'El comentario contiene palabras inapropiadas.', // Mensaje para ProfanityFilter
        ];
    }
}
