<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class katalog extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'imags',
        'id2',
        'mp3',
        'vedio',
        'zip',
        'sort',
        'description',
    ];
}
