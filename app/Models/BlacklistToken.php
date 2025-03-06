<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class BlacklistToken extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'blacklist_tokens';

    protected $fillable = [ 
        'token',
    ];
}
