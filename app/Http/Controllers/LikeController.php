<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function likePost($post_id, $user_id) // Pasa el id del post y el id del usuario
    {
        $like = new Like(); // Se crea un nuevo like
        $like->post_id = $post_id;
        $like->user_id = $user_id;
        $like->save(); // Guarda el like en la base de datos
        return response()->json($like); // Se retorna el like guardado
    }

    public function unlikePost($post_id, $user_id) // Pasamos el id del post y el id del usuario
    {
        $like = Like::where('post_id', $post_id)->where('user_id', $user_id)->first(); // Se busca el like en la base de datos
        $like->delete(); // Elimina el like de la base de datos
        return response()->json($like); // Se retorna el like eliminado
    }
}
