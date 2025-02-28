<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments'; // <-- Indicar el nombre de la tabla

    protected $fillable = [ // <-- Definir los campos fillable
        'user_id', // Clave foránea
        'post_id', // Clave foránea
        'comment', // Texto del comentario
    ];

    public function user()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function replies()
    {
        return $this->hasMany(CommentReplie::class);
    }
}
