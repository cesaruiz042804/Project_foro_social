<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentReplyResource extends JsonResource
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
            'name' => $this->user->name . ' ' . $this->user->lastname,
            'userReply' => $this->user->username,
            'reply' => $this->reply,
            'date' => $this->created_at->format('F j, Y, g:i A'),
        ];
    }
}
