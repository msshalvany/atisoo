<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class packege extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'imags',
        'id2',
        'mp3',
        'vedio',
        'description',
        'price',
        'zip',
        'sort',
    ];
}
