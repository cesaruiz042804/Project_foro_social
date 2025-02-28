<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory; // <-- And this line is within your class

    protected $table = 'likes'; // <-- Indicar el nombre de la tabla

    protected $fillable = [ // <-- Definir los campos fillable
        'user_id', // Clave foránea (necesario para crear likes asociándolos a usuarios)
        'post_id', // Clave foránea (necesario para crear likes asociándolos a posts)
    ];

    public function user()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
