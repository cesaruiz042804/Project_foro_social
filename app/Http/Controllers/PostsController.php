<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Resources\PostResource;
use App\Services\LikeService; 
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class PostsController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService) // Constructor
    {
        $this->likeService = $likeService; // Inicializa LikeService
    }

    public function posts($user_id): JsonResponse
    {
        $data = Post::with(['client', 'likes', 'comments'])->get(); // Muestra los posts
        $dataLike = $this->likeService->getLikes($user_id); // Muestra los likes

        return response()->json([ // Retorna los posts y los likes
            'posts' => PostResource::collection($data),
            'liked_posts' => $dataLike,
        ]);
    }

    public function show()
    {
        $data = Client::orderBy('name', 'asc')->take(12)->get(); // Muestra los usuarios
        return response()->json($data);
    }

    public function showComment(Post $id)
    {
        return new PostResource($id); // Retorna el post
    }


    public function postsPaginacion($user_id): JsonResponse
    {
        $data = Post::with(['client', 'likes', 'comments'])->paginate(10);
        $dataLike = $this->likeService->getLikes($user_id);

        return response()->json([
            'posts' => PostResource::collection($data),
            'liked_posts' => $dataLike,
        ]);
    }



    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
