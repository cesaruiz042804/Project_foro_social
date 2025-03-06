<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'comment_id' => $this->comment->id,
            'name' => $this->user->name . ' ' . $this->user->lastname,
            'userReply' => $this->user->username,
            'reply' => $this->reply,
            'date' => Carbon::parse($this->created_at)->setTimezone('America/Panama')->format('F j, Y, g:i A'),
        ];
    }
}
