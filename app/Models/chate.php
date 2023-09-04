<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'see_admin',
        'see_user',
        'order',
    ];
}
