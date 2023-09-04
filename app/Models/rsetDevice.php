<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsetDevice extends Model
{
    use HasFactory;
    protected $fillable = [
        'imags',
        'id2',
        'mp3',
        'vedio',
        'apps',
        'sort',
        'description',
    ];
}
