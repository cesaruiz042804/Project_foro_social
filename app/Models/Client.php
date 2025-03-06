<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Model implements JWTSubject
{
    use HasFactory, Notifiable, HasApiTokens; // <-- And this line is within your class

    protected $table = 'clients';

    protected $fillable = [ // <-- Definir los campos fillable
        'username',      // Nombre de usuario
        'name',          // Nombre
        'lastname',      // Apellido
        'email',         // Email
        'password',      // Contraseña (al registrar o actualizar, NO al recuperar)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentReplies()
    {
        return $this->hasMany(CommentReplie::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey(); // Usualmente es el ID del usuario.
    }

    /**
     * Obtiene los reclamos personalizados del JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // Aquí puedes agregar cualquier dato extra que quieras incluir en el JWT.
    }
}
