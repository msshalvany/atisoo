<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messegeChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chate_id',
        'text',
        'image',
        'voice',
        'file',
        'reply',
        'hide',
        'admin_id'
    ];
}
