<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name . ' ' . $this->user->lastname, // Nombre del usuario que comentó
            'comment' => $this->comment,
            'countReply' => $this->replies->count(),
            'date' => $this->created_at->format('F j, Y, g:i A'),
            'replies' => CommentReplyResource::collection($this->replies), // Llamar a los replies si tienes un modelo para eso
        ];
    }
}
