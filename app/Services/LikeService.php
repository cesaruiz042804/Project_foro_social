<?php

namespace App\Services;

use App\Http\Resources\LikeResource;
use App\Models\Like;

class LikeService
{
    public function getLikes($id)
    {
        $likes = Like::where('user_id', $id)->get();
        return LikeResource::collection($likes);
    }
}
