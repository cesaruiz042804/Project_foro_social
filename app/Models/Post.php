<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory; // <-- And this line is within your class
    protected $table = 'posts'; // <-- Indicar el nombre de la tabla

    protected $fillable = [ // <-- Definir los campos fillable
        'user_id', // Clave foránea (¡importante para asignación masiva al crear posts relacionados a usuarios!)
        'content', // Contenido del post
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
