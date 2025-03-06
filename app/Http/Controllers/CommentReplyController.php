<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentReplie;
use App\Http\Requests\CommentReplyRequest;
use App\Http\Resources\CommentReplyResource;

class CommentReplyController extends Controller
{
    public function create(CommentReplyRequest $request){
        $validatedData = $request->validated();

        // Ahora puedes usar $validatedData para crear el comentario
        $comment = CommentReplie::create($validatedData);

        $comment->load('user');
        return new CommentReplyResource($comment);

        //return response()->json($comment, 201); // 201 Created
    }
}
