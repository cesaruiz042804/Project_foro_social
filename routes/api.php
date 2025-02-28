<?php

use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;
use GuzzleHttp\Middleware;

Route::middleware(Cors::class)->group(function () {
    Route::get('/users', [PostsController::class, 'show']);//->middleware('throttle:60,1');
    Route::get('/posts', [PostsController::class, 'posts']);
    Route::get('/posts/{id}', [PostsController::class, 'showComment']);
    Route::get('/students', function () {
        return "Obteniendo datos....";
    });

    // Manejo de peticiones OPTIONS
    Route::options('/{any}', function () {
        return response('', 200);
    })->where('any', '.*');
});

//->name('users.show.posts');

# thunder client, parecido a insomnia

# thunder client, parecido a imsomnio

/*
La sintaxis de 'throttle:limites,minutos' se compone de dos partes numéricas separadas por una coma:

limites (primer número): Indica el número máximo de peticiones que se permiten
dentro del período de tiempo definido. En 'throttle:60,1', 60 significa "60 peticiones".
minutos (segundo número): Indica el período de tiempo en minutos durante el
cual se aplican los limites. En 'throttle:60,1', 1 significa "1 minuto".

*/
