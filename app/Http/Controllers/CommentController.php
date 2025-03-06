<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLastCommentModal($postId)
    {
        $latestComment = Comment::where('post_id', $postId)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latestComment) {
            return new CommentResource($latestComment);
            //return response()->json(['data' => $latestComment], 200);
        } else {
            return response()->json(['message' => 'No se encontraron comentarios para este post.'], 404);
        }
    }

    public function create(CommentRequest $request)
    {
        $validatedData = $request->validated();

        // Crear el comentario
        $comment = Comment::create($validatedData);

        // Cargar los datos del usuario relacionado
        $comment->load('user');
        return new CommentResource($comment);
        //return response()->json($comment, 201); // Retorna el comentario con el usuario
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //$tuModelo->update($request->all());
        //return response()->json($tuModelo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //$tuModelo->delete();
        //return response()->json(null, 204); // 204 No Content
    }
}
