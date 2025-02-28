<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentReplie extends Model
{
    use HasFactory; // <-- And this line is within your class

    protected $table = 'comment_replies'; // <-- Indicar el nombre de la tabla

    protected $fillable = [ // <-- Definir los campos fillable
        'user_id',    // Clave foránea
        'comment_id', // Clave foránea
        'reply',      // Texto de la respuesta
    ];

    public function user()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
