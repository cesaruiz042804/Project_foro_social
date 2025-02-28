<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory; // <-- And this line is within your class
    
    protected $table = 'clients';

    protected $fillable = [ // <-- Definir los campos fillable
        'username',      // Nombre de usuario
        'name',          // Nombre
        'lastname',      // Apellido
        'email',         // Email
        'password',      // Contraseña (al registrar o actualizar, NO al recuperar)
        // 'email_verified_at', //  No suele ser fillable, se maneja diferente
        // 'remember_token',   //  Tampoco fillable, Laravel lo gestiona
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
}
