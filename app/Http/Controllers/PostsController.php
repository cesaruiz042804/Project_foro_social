<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Transformers\User\PostsResource;
use App\Transformers\User\PostsResourceCollection;
use App\Services\ResponseService;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $posts;

    public function __construct()
    {
        //$this->posts = $posts;
    }

    public function posts()
    {
        //$data = Post::take(12)->get();
        //$data = $post->client;
        //return response()->json(['message' => 'Hello']);
        $data = Post::with(['client', 'likes', 'comments'])->get();
        return PostResource::collection($data);
        //return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostsRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show()
    {
        /*
        try {
            $posts = $this->posts;
            $data = Posts::all();
            } catch (\Throwable | \Exception $e) {
                return ResponseService::exception('users.store.posts', null, $e);
                }
                */
        //$data = Client::all();
        $data = Client::orderBy('name', 'asc')->take(12)->get();
        return response()->json($data);
        //return response()->json(['message' => 'Hello']);
    }

    public function showComment(Post $id)
    {
        return new PostResource($id);
        //$comment = Post::with(['comments.user', 'comments.replies'])->find($id);
        //return response()->json($comment);
        // Seguridad
        // Ver si esta logueado
        // Ver si se envia en realidad un id

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
