<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1'); // Esto es para loguearse
Route::post('/register/create', [AuthController::class, 'create_register'])->middleware('throttle:5,1'); // Esto es para loguearse
Route::get('/register/complete/data/information', [AuthController::class, 'sendCompleteDataEmail']); // Esto es para enviar el correo
Route::post('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->middleware('throttle:5,1');
Route::get('/users' , [PostsController::class, 'show']); // Esto muestra los usuarios
Route::get('/posting/{id}', [PostsController::class, 'postsPaginacion']); // Esto muestra los posts de los usuarios
Route::get('/post/{id}', [PostsController::class, 'showComment']); // Esto muestra los comentarios del post
Route::get('/posts/{postId}/latest-comment', [CommentController::class, 'showLastCommentModal']); // Esto muestra el último comentario
Route::post('/posts/comments', [CommentController::class, 'create']); // Esto crea un comentario
Route::post('/posts/reply', [CommentReplyController::class, 'create']); // Esto crea una respuesta a un comentario
Route::post('/post/{postId}/{userId}/like', [LikeController::class, 'likePost']); // Esto da like a un post
Route::delete('/post/{postId}/{userId}/like', [LikeController::class, 'unlikePost']); // Esto quita el like a un post

Route::options('{any}', function (Request $request) {
    // Orígenes permitidos
    $allowedOrigins = ['http://localhost:5173', 'http://tusitio.com'];

    // Verifica si el origen de la solicitud está permitido
    $origin = $request->headers->get('Origin');
    if (in_array($origin, $allowedOrigins)) {
        return response()->json([], 204)
                        ->header('Access-Control-Allow-Origin', $origin)
                        ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')
                        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }

    // Si el origen no está permitido, devuelve un error
    return response()->json(['message' => 'CORS policy violation'], 403);
})->where('any', '.*');

// sactum es un middleware de autenticación y throttle (code 429) es un middleware de limitación de peticiones (5 x min).
// cada dirección IP tendrá su propio límite de 5 intentos por minuto.

/*
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [PostsController::class, 'show']);
    Route::get('/posting/{id}', [PostsController::class, 'postsPaginacion']);
    Route::get('/post/{id}', [PostsController::class, 'showComment']);
    Route::get('/posts/{postId}/latest-comment', [CommentController::class, 'showLastCommentModal']);
    Route::post('/posts/comments', [CommentController::class, 'create']);
    Route::post('/posts/reply', [CommentReplyController::class, 'create']);
    Route::post('/post/{postId}/{userId}/like', [LikeController::class, 'likePost']);
    Route::delete('/post/{postId}/{userId}/like', [LikeController::class, 'unlikePost']);
});
*/

























// npm run dev -- --host


// php -S localhost:8000 -t public

// composer require laravel/sanctum
// php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# thunder client, parecido a insomnia

# thunder client, parecido a imsomnio

/*
La sintaxis de 'throttle:limites,minutos' se compone de dos partes numéricas separadas por una coma:

limites (primer número): Indica el número máximo de peticiones que se permiten
dentro del período de tiempo definido. En 'throttle:60,1', 60 significa "60 peticiones".
minutos (segundo número): Indica el período de tiempo en minutos durante el
cual se aplican los limites. En 'throttle:60,1', 1 significa "1 minuto".

*/
