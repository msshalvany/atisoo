<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name1',
        'name2',
        'name3',
        'price',
        'ic',
        'imags',
        'path',
        'lable',
        'chanel',
        'description',
        'id2',
    ];
}
