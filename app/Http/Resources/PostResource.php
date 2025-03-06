<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // Incluir el 'id' del post
            'autor' => $this->client->name .  ' ' . $this->client->lastname, // Incluir el 'content' del post, cambiando el nombre a 'contenido' en el JSON
            'username' => $this->client->username,
            'content' => $this->content, // Incluir el 'content' del post, cambiando el nombre a 'contenido' en el JSON
            'date' => Carbon::parse($this->created_at)->setTimezone('America/Panama')->format('F j, Y, g:i A'),
            'count_likes' => $this->likes->count(),
            'count_comment' => $this->comments->count(),
            'total_comments_with_replies' => $this->calculateTotalCommentsWithReplies(),
            'comments' => CommentResource::collection($this->comments), // Usar el CommentResource
        ];
    }

    private function calculateTotalCommentsWithReplies(): int
    {
        $totalComments = $this->comments->count();
        foreach ($this->comments as $comment) {
            $totalComments += $comment->replies->count();
        }
        return $totalComments;
    }
}
