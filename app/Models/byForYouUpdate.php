<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class byForYouUpdate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name1',
        'name2',
        'name3',
        'ic',
        'imags',
        'lable',
        'chanel',
        'mp3',
        'sort',
        'id2',
        'price',
        'description',
        'hide',
    ];
}
